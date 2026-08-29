<?php
/**
 * Team Medical Receipt Reimbursements — secure upload portal.
 *
 * Design goals (in order):
 *
 * 1. The ORIGINAL photo never reaches the server. The browser loads the
 *    photo into a canvas, the employee draws solid black boxes over anything
 *    sensitive, and only the flattened, redacted copy is uploaded
 *    (assets/js/receipt-redactor.js). Redacted pixels are destroyed, not
 *    layered, so there is nothing to "un-redact".
 *
 * 2. Stored files are never web-accessible. Receipts live in
 *    uploads/ds-receipts/ behind an .htaccess / web.config deny-all, with
 *    unguessable random filenames, and are only served through the
 *    authenticated ds_reimb_file endpoint (owner or finance manager, with a
 *    nonce). They are never added to the media library.
 *    NOTE for nginx hosts: .htaccess is ignored there — add
 *      location ~* /wp-content/uploads/ds-receipts/ { deny all; }
 *    to the server config. Random filenames remain a second layer either way.
 *
 * 3. Least-privilege access. Any logged-in team member can submit and see
 *    only their own claims. Reviewing claims requires the
 *    'ds_manage_reimbursements' capability (administrators, plus the
 *    "Finance / HR" role this module registers).
 *
 * 4. Defense in depth on upload: only real JPEG/PNG/WebP images are
 *    accepted, and every file is re-encoded server-side with the WP image
 *    editor, which strips metadata (EXIF/GPS) and guarantees the stored
 *    bytes are a fresh image and nothing else.
 *
 * 5. Notification emails deliberately contain no medical details — just
 *    who, how much, and a link to the admin screen. Email is not a secure
 *    channel.
 */

const DS_REIMB_MAX_FILES = 6;
const DS_REIMB_MAX_BYTES = 8388608; // 8 MB per redacted image

// ── Config ───────────────────────────────────────────

function ds_reimb_categories() {
    return [
        'Medical visit / copay',
        'Prescription',
        'Dental',
        'Vision',
        'Lab / imaging',
        'Other medical expense',
    ];
}

function ds_reimb_statuses() {
    return [
        'submitted' => 'Submitted',
        'in_review' => 'In review',
        'approved'  => 'Approved',
        'paid'      => 'Paid',
        'rejected'  => 'Needs attention',
    ];
}

/**
 * Where finance notifications go. Configurable under Theme Settings →
 * Reimbursements; falls back to the site admin email.
 */
function ds_reimb_notify_email() {
    $email = function_exists('get_field') ? get_field('reimb_notification_email', 'option') : '';
    return is_email($email) ? $email : get_option('admin_email');
}

/**
 * Protected storage directory. Created on demand with deny-all guards for
 * Apache (.htaccess) and IIS (web.config) plus an empty index.php.
 */
function ds_reimb_upload_dir() {
    $dir = wp_upload_dir()['basedir'] . '/ds-receipts';

    if (!is_dir($dir)) {
        wp_mkdir_p($dir);
    }
    if (!file_exists($dir . '/.htaccess')) {
        file_put_contents(
            $dir . '/.htaccess',
            "# Receipts are served only through the authenticated endpoint.\n"
            . "<IfModule mod_authz_core.c>\n\tRequire all denied\n</IfModule>\n"
            . "<IfModule !mod_authz_core.c>\n\tOrder deny,allow\n\tDeny from all\n</IfModule>\n"
        );
    }
    if (!file_exists($dir . '/web.config')) {
        file_put_contents(
            $dir . '/web.config',
            "<configuration><system.webServer><security><authorization>"
            . "<remove users=\"*\" roles=\"\" verbs=\"\" /></authorization></security>"
            . "</system.webServer></configuration>\n"
        );
    }
    if (!file_exists($dir . '/index.php')) {
        file_put_contents($dir . '/index.php', "<?php // Silence is golden.\n");
    }

    return $dir;
}

// ── Roles & capabilities ─────────────────────────────
// Administrators can always review claims; the "Finance / HR" role exists so
// review access can be granted without handing out full admin.

function ds_reimb_grant_caps() {
    $admin = get_role('administrator');
    if ($admin && !$admin->has_cap('ds_manage_reimbursements')) {
        $admin->add_cap('ds_manage_reimbursements');
    }
    if (!get_role('ds_finance')) {
        add_role('ds_finance', 'Finance / HR', [
            'read'                     => true,
            'ds_manage_reimbursements' => true,
        ]);
    }
}
add_action('after_switch_theme', 'ds_reimb_grant_caps');
add_action('admin_init', 'ds_reimb_grant_caps');

// ── Claims CPT (visible only to ds_manage_reimbursements) ──

add_action('init', function () {
    register_post_type('ds_reimbursement', [
        'labels' => [
            'name'          => 'Reimbursements',
            'singular_name' => 'Reimbursement Claim',
            'menu_name'     => 'Reimbursements',
            'edit_item'     => 'Review Claim',
        ],
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-money-alt',
        'supports'            => ['title'],
        'map_meta_cap'        => false,
        'capabilities'        => [
            'edit_post'              => 'ds_manage_reimbursements',
            'read_post'              => 'ds_manage_reimbursements',
            'delete_post'            => 'ds_manage_reimbursements',
            'edit_posts'             => 'ds_manage_reimbursements',
            'edit_others_posts'      => 'ds_manage_reimbursements',
            'edit_private_posts'     => 'ds_manage_reimbursements',
            'edit_published_posts'   => 'ds_manage_reimbursements',
            'read_private_posts'     => 'ds_manage_reimbursements',
            'delete_posts'           => 'ds_manage_reimbursements',
            'delete_others_posts'    => 'ds_manage_reimbursements',
            'delete_private_posts'   => 'ds_manage_reimbursements',
            'delete_published_posts' => 'ds_manage_reimbursements',
            'publish_posts'          => 'do_not_allow',
            'create_posts'           => 'do_not_allow', // claims only enter via the portal
        ],
        'exclude_from_search' => true,
        'show_in_rest'        => false,
    ]);
});

// ── Settings (Theme Settings → Reimbursements) ───────

add_action('acf/init', function () {
    if (!function_exists('acf_add_options_sub_page')) return;

    acf_add_options_sub_page([
        'page_title'  => 'Reimbursement Settings',
        'menu_title'  => 'Reimbursements',
        'menu_slug'   => 'acf-options-reimbursements',
        'parent_slug' => 'theme-settings',
        'capability'  => 'manage_options',
    ]);

    acf_add_local_field_group([
        'key'    => 'group_ds_reimbursements',
        'title'  => 'Reimbursement Settings',
        'fields' => [
            [
                'key'          => 'field_ds_reimb_notify_email',
                'label'        => 'Notification email',
                'name'         => 'reimb_notification_email',
                'type'         => 'email',
                'instructions' => 'New-claim notifications go here (finance / payroll). Falls back to the site admin email. The email contains no medical details — just a link to the claim.',
            ],
        ],
        'location' => [[[
            'param'    => 'options_page',
            'operator' => '==',
            'value'    => 'acf-options-reimbursements',
        ]]],
    ]);
});

// ── Portal assets ────────────────────────────────────

add_action('wp_enqueue_scripts', function () {
    if (!is_page_template('page-reimbursements.php') && !is_page('reimbursements')) return;

    wp_enqueue_style('ds-reimbursements', DS_URI . '/assets/css/reimbursements.css', ['digitalstride-main'], DS_VERSION);
    wp_enqueue_script('ds-receipt-redactor', DS_URI . '/assets/js/receipt-redactor.js', [], DS_VERSION, true);
    wp_localize_script('ds-receipt-redactor', 'dsReimb', [
        'ajaxUrl'  => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('ds_reimb_submit'),
        'maxFiles' => DS_REIMB_MAX_FILES,
        'maxBytes' => DS_REIMB_MAX_BYTES,
    ]);
});

// ── Submit handler (logged-in users only — no nopriv) ──

add_action('wp_ajax_ds_reimb_submit', function () {
    check_ajax_referer('ds_reimb_submit', 'nonce');

    $user = wp_get_current_user();
    if (!$user->exists()) {
        wp_send_json_error(['message' => 'Please log in again.'], 403);
    }

    // — Fields —
    $category = sanitize_text_field(wp_unslash($_POST['category'] ?? ''));
    if (!in_array($category, ds_reimb_categories(), true)) {
        wp_send_json_error(['message' => 'Please choose an expense category.'], 400);
    }

    $date = sanitize_text_field(wp_unslash($_POST['expense_date'] ?? ''));
    $dt   = DateTime::createFromFormat('Y-m-d', $date);
    if (!$dt || $dt->format('Y-m-d') !== $date || $dt->getTimestamp() > time()) {
        wp_send_json_error(['message' => 'Please enter a valid expense date (not in the future).'], 400);
    }

    $amount_raw = str_replace(['$', ','], '', sanitize_text_field(wp_unslash($_POST['amount'] ?? '')));
    if (!is_numeric($amount_raw) || (float) $amount_raw < 0.01 || (float) $amount_raw > 25000) {
        wp_send_json_error(['message' => 'Please enter a valid amount between $0.01 and $25,000.'], 400);
    }
    $amount = round((float) $amount_raw, 2);

    $note = sanitize_textarea_field(wp_unslash($_POST['note'] ?? ''));
    $note = mb_substr($note, 0, 1000);

    // — Files —
    if (empty($_FILES['receipts']) || !is_array($_FILES['receipts']['tmp_name'] ?? null)) {
        wp_send_json_error(['message' => 'Please add at least one redacted receipt image.'], 400);
    }

    $count = count($_FILES['receipts']['tmp_name']);
    if ($count < 1 || $count > DS_REIMB_MAX_FILES) {
        wp_send_json_error(['message' => sprintf('Please attach between 1 and %d receipt images.', DS_REIMB_MAX_FILES)], 400);
    }

    $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    $dir     = ds_reimb_upload_dir();
    $stored  = [];

    $bail = function ($message) use (&$stored, $dir) {
        // Remove anything saved before the failing file so nothing is orphaned.
        foreach ($stored as $f) {
            @unlink($dir . '/' . $f['file']);
        }
        wp_send_json_error(['message' => $message], 400);
    };

    for ($i = 0; $i < $count; $i++) {
        $tmp  = $_FILES['receipts']['tmp_name'][$i];
        $err  = $_FILES['receipts']['error'][$i] ?? UPLOAD_ERR_NO_FILE;
        $size = (int) ($_FILES['receipts']['size'][$i] ?? 0);
        $n    = $i + 1;

        if ($err !== UPLOAD_ERR_OK || !is_uploaded_file($tmp)) {
            $bail("Receipt {$n} failed to upload. Please try again.");
        }
        if ($size < 1 || $size > DS_REIMB_MAX_BYTES) {
            $bail("Receipt {$n} is too large (8 MB max).");
        }

        $info = @getimagesize($tmp);
        $mime = $info['mime'] ?? '';
        if (!$info || !isset($allowed[$mime])) {
            $bail("Receipt {$n} is not a supported image. Please use the redaction tool on this page.");
        }

        // Re-encode: proves the bytes are a real image and strips all
        // metadata. PNG stays PNG (crisp screenshots); everything else
        // becomes JPEG.
        $editor = wp_get_image_editor($tmp);
        if (is_wp_error($editor)) {
            $bail("Receipt {$n} could not be processed. Please try again.");
        }
        $editor->resize(2400, 2400, false);

        $is_png    = ($mime === 'image/png');
        $dest_mime = $is_png ? 'image/png' : 'image/jpeg';
        if (!$is_png) {
            $editor->set_quality(85);
        }
        $dest  = $dir . '/' . bin2hex(random_bytes(16)) . ($is_png ? '.png' : '.jpg');
        $saved = $editor->save($dest, $dest_mime);
        if (is_wp_error($saved)) {
            $bail("Receipt {$n} could not be saved. Please try again.");
        }

        $stored[] = [
            'file' => basename($saved['path']),
            'mime' => $saved['mime-type'],
            'size' => (int) filesize($saved['path']),
        ];
    }

    // — Claim record —
    $claim_id = wp_insert_post([
        'post_type'   => 'ds_reimbursement',
        'post_status' => 'private',
        'post_author' => $user->ID,
        'post_title'  => sprintf('%s — $%s — %s', $user->display_name, number_format_i18n($amount, 2), $dt->format('M j, Y')),
        'meta_input'  => [
            '_ds_reimb_status'       => 'submitted',
            '_ds_reimb_amount'       => $amount,
            '_ds_reimb_expense_date' => $date,
            '_ds_reimb_category'     => $category,
            '_ds_reimb_note'         => $note,
            '_ds_reimb_files'        => $stored,
        ],
    ], true);

    if (is_wp_error($claim_id)) {
        foreach ($stored as $f) {
            @unlink($dir . '/' . $f['file']);
        }
        wp_send_json_error(['message' => 'Your claim could not be saved. Please try again.'], 500);
    }

    // — Notify finance. No medical details, no attachments: just enough to
    //   act on, plus the admin link. —
    wp_mail(
        ds_reimb_notify_email(),
        sprintf('Reimbursement claim: %s ($%s)', $user->display_name, number_format_i18n($amount, 2)),
        "A new medical receipt reimbursement claim was submitted.\n\n"
        . 'Team member: ' . $user->display_name . ' (' . $user->user_email . ")\n"
        . 'Expense date: ' . $dt->format('F j, Y') . "\n"
        . 'Amount: $' . number_format_i18n($amount, 2) . "\n"
        . 'Receipts: ' . count($stored) . " image(s)\n\n"
        . 'Review (login required): ' . admin_url('post.php?post=' . $claim_id . '&action=edit') . "\n"
    );

    wp_send_json_success([
        'message' => 'Your claim was submitted. Finance has been notified and you can track its status below.',
        'claim'   => [
            'date'     => $dt->format('M j, Y'),
            'amount'   => number_format_i18n($amount, 2),
            'category' => $category,
            'status'   => ds_reimb_statuses()['submitted'],
            'receipts' => count($stored),
        ],
    ]);
});

// ── Authenticated file endpoint ──────────────────────
// Only the claim's owner or a reimbursement manager can view a receipt.

function ds_reimb_file_url($claim_id, $index) {
    return add_query_arg([
        'action' => 'ds_reimb_file',
        'claim'  => (int) $claim_id,
        'f'      => (int) $index,
        'nonce'  => wp_create_nonce('ds_reimb_file_' . (int) $claim_id),
    ], admin_url('admin-ajax.php'));
}

add_action('wp_ajax_ds_reimb_file', function () {
    $claim_id = absint($_GET['claim'] ?? 0);
    $index    = absint($_GET['f'] ?? 0);

    if (!wp_verify_nonce($_GET['nonce'] ?? '', 'ds_reimb_file_' . $claim_id)) {
        wp_die('This link has expired. Please reload the page you came from.', 'Link expired', 403);
    }

    $claim = get_post($claim_id);
    if (!$claim || $claim->post_type !== 'ds_reimbursement') {
        wp_die('Not found.', 'Not found', 404);
    }
    if ((int) $claim->post_author !== get_current_user_id() && !current_user_can('ds_manage_reimbursements')) {
        wp_die('You do not have permission to view this file.', 'Forbidden', 403);
    }

    $files = get_post_meta($claim_id, '_ds_reimb_files', true);
    if (!is_array($files) || !isset($files[$index]['file'])) {
        wp_die('Not found.', 'Not found', 404);
    }

    $path = ds_reimb_upload_dir() . '/' . basename($files[$index]['file']);
    if (!file_exists($path)) {
        wp_die('Not found.', 'Not found', 404);
    }

    nocache_headers();
    header('Content-Type: ' . $files[$index]['mime']);
    header('Content-Length: ' . filesize($path));
    header('Content-Disposition: inline; filename="receipt-' . $claim_id . '-' . ($index + 1) . '.' . pathinfo($path, PATHINFO_EXTENSION) . '"');
    header('X-Content-Type-Options: nosniff');
    readfile($path);
    exit;
});

// ── Portal: the current user's claim history ─────────

function ds_reimb_render_user_claims() {
    $claims = get_posts([
        'post_type'      => 'ds_reimbursement',
        'post_status'    => 'private',
        'author'         => get_current_user_id(),
        'posts_per_page' => 50,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    if (!$claims) {
        echo '<p class="ds-reimb__empty" id="ds-reimb-no-claims">No claims yet — your submissions will appear here.</p>';
        return;
    }

    $statuses = ds_reimb_statuses();
    echo '<div class="ds-reimb__claims">';
    foreach ($claims as $claim) {
        $status = get_post_meta($claim->ID, '_ds_reimb_status', true) ?: 'submitted';
        $amount = (float) get_post_meta($claim->ID, '_ds_reimb_amount', true);
        $date   = get_post_meta($claim->ID, '_ds_reimb_expense_date', true);
        $cat    = get_post_meta($claim->ID, '_ds_reimb_category', true);
        $files  = get_post_meta($claim->ID, '_ds_reimb_files', true);
        $files  = is_array($files) ? $files : [];
        ?>
        <div class="ds-reimb__claim">
            <div class="ds-reimb__claim-main">
                <span class="ds-reimb__claim-amount">$<?php echo esc_html(number_format_i18n($amount, 2)); ?></span>
                <span class="ds-reimb__claim-meta">
                    <?php echo esc_html($cat); ?> ·
                    <?php echo esc_html(date_i18n('M j, Y', strtotime($date))); ?> ·
                    submitted <?php echo esc_html(get_the_date('M j, Y', $claim)); ?>
                </span>
                <span class="ds-reimb__claim-files">
                    <?php foreach ($files as $i => $f) : ?>
                        <a href="<?php echo esc_url(ds_reimb_file_url($claim->ID, $i)); ?>" target="_blank" rel="noopener">
                            Receipt <?php echo (int) ($i + 1); ?>
                        </a>
                    <?php endforeach; ?>
                </span>
            </div>
            <span class="ds-reimb__status ds-reimb__status--<?php echo esc_attr($status); ?>">
                <?php echo esc_html($statuses[$status] ?? $status); ?>
            </span>
        </div>
        <?php
    }
    echo '</div>';
}

// ── Admin review screen ──────────────────────────────

add_action('add_meta_boxes_ds_reimbursement', function () {
    add_meta_box('ds_reimb_details', 'Claim Details', 'ds_reimb_details_metabox', 'ds_reimbursement', 'normal', 'high');
    add_meta_box('ds_reimb_status', 'Status', 'ds_reimb_status_metabox', 'ds_reimbursement', 'side', 'high');
});

function ds_reimb_details_metabox($post) {
    $author = get_userdata($post->post_author);
    $amount = (float) get_post_meta($post->ID, '_ds_reimb_amount', true);
    $date   = get_post_meta($post->ID, '_ds_reimb_expense_date', true);
    $cat    = get_post_meta($post->ID, '_ds_reimb_category', true);
    $note   = get_post_meta($post->ID, '_ds_reimb_note', true);
    $files  = get_post_meta($post->ID, '_ds_reimb_files', true);
    $files  = is_array($files) ? $files : [];
    ?>
    <table class="widefat striped" style="max-width:640px">
        <tr><th style="width:160px">Team member</th>
            <td><?php echo $author ? esc_html($author->display_name . ' (' . $author->user_email . ')') : '—'; ?></td></tr>
        <tr><th>Expense date</th><td><?php echo esc_html($date ? date_i18n('F j, Y', strtotime($date)) : '—'); ?></td></tr>
        <tr><th>Amount</th><td><strong>$<?php echo esc_html(number_format_i18n($amount, 2)); ?></strong></td></tr>
        <tr><th>Category</th><td><?php echo esc_html($cat ?: '—'); ?></td></tr>
        <tr><th>Note</th><td><?php echo $note ? nl2br(esc_html($note)) : '—'; ?></td></tr>
        <tr><th>Receipts</th>
            <td>
                <?php if ($files) : foreach ($files as $i => $f) : ?>
                    <a class="button" style="margin:0 6px 6px 0"
                       href="<?php echo esc_url(ds_reimb_file_url($post->ID, $i)); ?>" target="_blank" rel="noopener">
                        View receipt <?php echo (int) ($i + 1); ?>
                    </a>
                <?php endforeach; else : ?>—<?php endif; ?>
                <p class="description">Images were redacted by the team member before upload; the originals were never sent to the server.</p>
            </td></tr>
    </table>
    <?php
}

function ds_reimb_status_metabox($post) {
    $current = get_post_meta($post->ID, '_ds_reimb_status', true) ?: 'submitted';
    wp_nonce_field('ds_reimb_set_status', 'ds_reimb_status_nonce');
    echo '<select name="ds_reimb_status" style="width:100%">';
    foreach (ds_reimb_statuses() as $key => $label) {
        printf('<option value="%s" %s>%s</option>', esc_attr($key), selected($current, $key, false), esc_html($label));
    }
    echo '</select>';
    echo '<p class="description">The team member is emailed when the status changes.</p>';
}

add_action('save_post_ds_reimbursement', function ($post_id, $post) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['ds_reimb_status'], $_POST['ds_reimb_status_nonce'])) return;
    if (!wp_verify_nonce($_POST['ds_reimb_status_nonce'], 'ds_reimb_set_status')) return;
    if (!current_user_can('ds_manage_reimbursements')) return;

    $new = sanitize_key($_POST['ds_reimb_status']);
    if (!array_key_exists($new, ds_reimb_statuses())) return;

    $old = get_post_meta($post_id, '_ds_reimb_status', true) ?: 'submitted';
    if ($new === $old) return;

    update_post_meta($post_id, '_ds_reimb_status', $new);

    $author = get_userdata($post->post_author);
    if ($author) {
        $amount = (float) get_post_meta($post_id, '_ds_reimb_amount', true);
        wp_mail(
            $author->user_email,
            'Your reimbursement claim was updated: ' . ds_reimb_statuses()[$new],
            sprintf(
                "Hi %s,\n\nYour reimbursement claim for $%s is now marked: %s.\n\nYou can review your claims here: %s\n",
                $author->display_name,
                number_format_i18n($amount, 2),
                ds_reimb_statuses()[$new],
                home_url('/reimbursements/')
            )
        );
    }
}, 10, 2);

// Admin list columns.
add_filter('manage_ds_reimbursement_posts_columns', function ($cols) {
    return [
        'cb'            => $cols['cb'] ?? '<input type="checkbox" />',
        'title'         => 'Claim',
        'reimb_status'  => 'Status',
        'reimb_amount'  => 'Amount',
        'reimb_cat'     => 'Category',
        'reimb_expense' => 'Expense date',
        'date'          => 'Submitted',
    ];
});
add_action('manage_ds_reimbursement_posts_custom_column', function ($col, $post_id) {
    switch ($col) {
        case 'reimb_status':
            $status = get_post_meta($post_id, '_ds_reimb_status', true) ?: 'submitted';
            echo esc_html(ds_reimb_statuses()[$status] ?? $status);
            break;
        case 'reimb_amount':
            echo '$' . esc_html(number_format_i18n((float) get_post_meta($post_id, '_ds_reimb_amount', true), 2));
            break;
        case 'reimb_cat':
            echo esc_html(get_post_meta($post_id, '_ds_reimb_category', true));
            break;
        case 'reimb_expense':
            $d = get_post_meta($post_id, '_ds_reimb_expense_date', true);
            echo esc_html($d ? date_i18n('M j, Y', strtotime($d)) : '—');
            break;
    }
}, 10, 2);

// Remove the stored images when a claim is deleted for good.
add_action('before_delete_post', function ($post_id, $post) {
    if (!$post || $post->post_type !== 'ds_reimbursement') return;
    $files = get_post_meta($post_id, '_ds_reimb_files', true);
    if (!is_array($files)) return;
    $dir = ds_reimb_upload_dir();
    foreach ($files as $f) {
        if (!empty($f['file'])) {
            @unlink($dir . '/' . basename($f['file']));
        }
    }
}, 10, 2);
