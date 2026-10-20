<?php
/**
 * Referral program: "send us people, earn $X for each one we meet with".
 *
 * Flow:
 *  1. The Referral Form section (Page Sections > Referral Form, template:
 *     template-parts/flex-referral_form.php, JS in assets/js/main.js) takes
 *     the referrer's details plus one row per person they're referring.
 *  2. ds_ref_handle_submit() validates, runs the same spam checks as the lead
 *     form (inc/dsd-leads.php) and saves one private "Referral" post per
 *     person, so payouts can be tracked in wp-admin > Referrals.
 *  3. The team gets one email per submission, and each referred person is
 *     also sent to DSD as a lead (best effort, see ds_lead_send_to_dsd()).
 *
 * The reward and the per-referrer cap come from the section's ACF fields
 * (defaults: $20, 15 people). The cap counts every referral already on file
 * for the referrer's email, across all submissions.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('DS_REF_POST_TYPE', 'ds_referral');
define('DS_REF_DEFAULT_REWARD', 20);
define('DS_REF_DEFAULT_MAX', 15);

/** Payout stages, in order. "Met" is when the reward is earned. */
function ds_ref_statuses() {
    return [
        'new'          => 'New',
        'contacted'    => 'Contacted',
        'met'          => 'Met — reward earned',
        'paid'         => 'Paid',
        'not_eligible' => 'Not eligible',
    ];
}

// ── Storage ─────────────────────────────────────────────────
add_action('init', function () {
    register_post_type(DS_REF_POST_TYPE, [
        'labels' => [
            'name'          => 'Referrals',
            'singular_name' => 'Referral',
            'edit_item'     => 'Edit Referral',
            'search_items'  => 'Search Referrals',
            'not_found'     => 'No referrals yet.',
            'all_items'     => 'All Referrals',
        ],
        'public'          => false,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'show_in_rest'    => false,
        'menu_icon'       => 'dashicons-groups',
        'menu_position'   => 26,
        'supports'        => ['title'],
        'capability_type' => 'post',
        'capabilities'    => ['create_posts' => 'do_not_allow'], // only the form adds them
        'map_meta_cap'    => true,
    ]);
});

/**
 * Settings of the Referral Form section on a page (first one wins), so the
 * server enforces the cap the visitor was shown.
 */
function ds_ref_settings($post_id) {
    $settings = ['reward' => DS_REF_DEFAULT_REWARD, 'max' => DS_REF_DEFAULT_MAX, 'notify' => []];
    $rows = $post_id && function_exists('get_field') ? get_field('page_sections', $post_id) : null;
    foreach ((array) $rows as $row) {
        if (($row['acf_fc_layout'] ?? '') !== 'referral_form') continue;
        if (is_numeric($row['reward_amount'] ?? '') && $row['reward_amount'] >= 0) $settings['reward'] = (float) $row['reward_amount'];
        if (!empty($row['max_referrals']) && (int) $row['max_referrals'] > 0) $settings['max'] = min(50, (int) $row['max_referrals']);
        $settings['notify'] = ds_ref_parse_emails($row['notify_email'] ?? '');
        break;
    }
    return $settings;
}

/**
 * The "Send Referrals To" field: one or more addresses separated by commas,
 * semicolons, spaces or new lines. Returns the valid ones.
 */
function ds_ref_parse_emails($raw) {
    $list = preg_split('/[\s,;]+/', (string) $raw, -1, PREG_SPLIT_NO_EMPTY);
    return array_values(array_unique(array_filter(array_map('sanitize_email', $list), 'is_email')));
}

/**
 * Check "Send Referrals To" in the editor: name any address that isn't
 * valid instead of rejecting the whole list.
 */
add_filter('acf/validate_value/key=field_rf_notify', function ($valid, $value) {
    if ($valid !== true || trim((string) $value) === '') return $valid;
    $bad = array_filter(preg_split('/[\s,;]+/', (string) $value, -1, PREG_SPLIT_NO_EMPTY), function ($email) {
        return !is_email($email);
    });
    return $bad ? sprintf('Not a valid email address: %s. Separate several addresses with commas.', implode(', ', $bad)) : $valid;
}, 10, 2);

/** "$20" / "$12.50" */
function ds_ref_money($amount) {
    $amount = (float) $amount;
    return '$' . (floor($amount) == $amount ? number_format($amount) : number_format($amount, 2));
}

/** Referrals already on file for a referrer's email (any status). */
function ds_ref_count_for($email) {
    $q = new WP_Query([
        'post_type'      => DS_REF_POST_TYPE,
        'post_status'    => 'any',
        'posts_per_page' => 1,
        'fields'         => 'ids',
        'no_found_rows'  => false,
        'meta_query'     => [['key' => '_ds_ref_referrer_email', 'value' => strtolower($email)]],
    ]);
    return (int) $q->found_posts;
}

/** Has anyone referred this person already? */
function ds_ref_already_referred($email) {
    return (bool) get_posts([
        'post_type'      => DS_REF_POST_TYPE,
        'post_status'    => 'any',
        'posts_per_page' => 1,
        'fields'         => 'ids',
        'meta_query'     => [['key' => '_ds_ref_email', 'value' => strtolower($email)]],
    ]);
}

// ── Validation ──────────────────────────────────────────────

/** Per-field error text, shared by the template (no-JS) and the JSON response. */
function ds_ref_error_messages() {
    return [
        'referrer_name'  => 'Please enter your name.',
        'referrer_email' => 'Please enter a valid email address so we can send your reward.',
        'referrer_phone' => 'Please enter a valid phone number.',
        'name'           => 'Please enter their name.',
        'email'          => 'Please enter a valid email address.',
        'phone'          => 'Please enter a valid phone number.',
        'note'           => 'Please keep the note under 1,000 characters.',
        'self'           => "You can't refer yourself.",
        'duplicate'      => "You've already listed this person.",
    ];
}

function ds_ref_valid_phone($phone) {
    if ($phone === '') return true;
    $digits = strlen(preg_replace('/\D/', '', $phone));
    return strlen($phone) <= 40 && $digits >= 7 && $digits <= 15 && preg_match('/^[0-9+().\-\s#x]+$/i', $phone);
}

function ds_ref_valid_email($email) {
    return $email !== '' && strlen($email) <= 254 && is_email($email);
}

/**
 * Validate the posted form. Returns [$referrer, $people, $errors]; $errors
 * maps field name (e.g. "referrals[2][email]") => message.
 */
function ds_ref_validate($post, $max) {
    $messages = ds_ref_error_messages();
    $clean    = function ($v) { return trim(sanitize_text_field(wp_unslash((string) $v))); };
    $errors   = [];

    $referrer = [
        'name'  => $clean($post['referrer_name'] ?? ''),
        'email' => strtolower($clean($post['referrer_email'] ?? '')),
        'phone' => $clean($post['referrer_phone'] ?? ''),
    ];
    if ($referrer['name'] === '' || ds_lead_strlen($referrer['name']) > 100) $errors['referrer_name'] = $messages['referrer_name'];
    if (!ds_ref_valid_email($referrer['email'])) $errors['referrer_email'] = $messages['referrer_email'];
    if (!ds_ref_valid_phone($referrer['phone'])) $errors['referrer_phone'] = $messages['referrer_phone'];

    $people = [];
    $seen   = [];
    $rows   = is_array($post['referrals'] ?? null) ? array_slice($post['referrals'], 0, $max + 5, true) : [];
    foreach ($rows as $i => $row) {
        if (!is_array($row)) continue;
        $person = [
            'name'  => $clean($row['name'] ?? ''),
            'email' => strtolower($clean($row['email'] ?? '')),
            'phone' => $clean($row['phone'] ?? ''),
            'note'  => trim(sanitize_textarea_field(wp_unslash((string) ($row['note'] ?? '')))),
        ];
        // A row left completely blank is ignored, not an error.
        if (implode('', $person) === '') continue;

        $key = 'referrals[' . (int) $i . ']';
        if ($person['name'] === '' || ds_lead_strlen($person['name']) > 100) $errors[$key . '[name]'] = $messages['name'];
        if (!ds_ref_valid_email($person['email'])) {
            $errors[$key . '[email]'] = $messages['email'];
        } elseif ($person['email'] === $referrer['email']) {
            $errors[$key . '[email]'] = $messages['self'];
        } elseif (isset($seen[$person['email']])) {
            $errors[$key . '[email]'] = $messages['duplicate'];
        }
        if (!ds_ref_valid_phone($person['phone'])) $errors[$key . '[phone]'] = $messages['phone'];
        if (ds_lead_strlen($person['note']) > 1000) $errors[$key . '[note]'] = $messages['note'];

        $seen[$person['email']] = true;
        $people[] = $person;
    }

    return [$referrer, $people, $errors];
}

// ── Submit handler (admin-ajax.php) ─────────────────────────
add_action('wp_ajax_ds_referral_submit', 'ds_ref_handle_submit');
add_action('wp_ajax_nopriv_ds_referral_submit', 'ds_ref_handle_submit');

/**
 * Respond as JSON for the JS submit, or redirect back to the form for a
 * plain (no-JS) form post.
 */
function ds_ref_respond($ok, $status, $message, $source_id, $fields = []) {
    if (!empty($_POST['ds_ajax'])) {
        $payload = ['message' => $message];
        if ($fields) $payload['errors'] = $fields;
        $ok ? wp_send_json_success($payload) : wp_send_json_error($payload, $status);
    }
    $back = $source_id ? get_permalink($source_id) : home_url('/');
    $args = ['ds_ref' => $ok ? 'thanks' : 'error', 'ds_ref_msg' => $ok ? false : rawurlencode($message)];
    wp_safe_redirect(add_query_arg(array_filter($args), $back) . '#ds-referral');
    exit;
}

function ds_ref_handle_submit() {
    $source_id = absint($_POST['ds_ref_source'] ?? 0);
    if ($source_id && get_post_status($source_id) !== 'publish') $source_id = 0;
    $settings = ds_ref_settings($source_id);
    $thanks   = "Thanks! We've got your referrals.";

    // Honeypot: pretend it worked so bots learn nothing.
    if (!empty($_POST['ds_hp_website'])) {
        ds_ref_respond(true, 200, $thanks, $source_id);
    }
    if (!ds_lead_time_ok($_POST['ds_ts'] ?? '')) {
        ds_ref_respond(false, 400, 'That was quick! Please check your details and submit the form again.', $source_id);
    }

    [$referrer, $people, $errors] = ds_ref_validate($_POST, $settings['max']);
    if ($errors) {
        ds_ref_respond(false, 400, 'Please check the highlighted fields.', $source_id, $errors);
    }
    if (!$people) {
        ds_ref_respond(false, 400, 'Please add at least one person to refer.', $source_id, ['referrals[0][name]' => ds_ref_error_messages()['name']]);
    }

    $left = $settings['max'] - ds_ref_count_for($referrer['email']);
    if (count($people) > $left) {
        $message = $left > 0
            ? sprintf('Each person can refer up to %d people. You have %d %s left — please remove %d.', $settings['max'], $left, $left === 1 ? 'spot' : 'spots', count($people) - $left)
            : sprintf("You've already sent us %d referrals, which is the most we can reward. Thank you!", $settings['max']);
        ds_ref_respond(false, 400, $message, $source_id);
    }
    if (ds_lead_rate_limited()) {
        ds_ref_respond(false, 429, "You've sent us several forms already. Please try again in an hour, or give us a call.", $source_id);
    }

    $page_url = ds_lead_page_url($_POST['page_url'] ?? '', $source_id);
    $saved    = [];
    foreach ($people as $person) {
        $repeat = ds_ref_already_referred($person['email']);
        $id = wp_insert_post([
            'post_type'    => DS_REF_POST_TYPE,
            'post_status'  => 'private',
            'post_title'   => $person['name'],
            // Excerpt + content hold the referrer so the admin search finds them.
            'post_excerpt' => sprintf('Referred by %s <%s>', $referrer['name'], $referrer['email']),
            'post_content' => $person['note'],
            'meta_input'   => [
                '_ds_ref_email'          => $person['email'],
                '_ds_ref_phone'          => $person['phone'],
                '_ds_ref_referrer_name'  => $referrer['name'],
                '_ds_ref_referrer_email' => $referrer['email'],
                '_ds_ref_referrer_phone' => $referrer['phone'],
                '_ds_ref_status'         => 'new',
                '_ds_ref_reward'         => $settings['reward'],
                '_ds_ref_repeat'         => $repeat ? 1 : 0,
                '_ds_ref_page_url'       => $page_url,
            ],
        ], true);
        if (is_wp_error($id) || !$id) continue;
        $saved[] = $person + ['id' => $id, 'repeat' => $repeat];
    }

    if (!$saved) {
        ds_ref_respond(false, 502, "Sorry, something went wrong on our end and your referrals didn't go through. Please call or email us.", $source_id);
    }

    ds_ref_notify($referrer, $saved, $settings);
    ds_ref_send_to_dsd($referrer, $saved, $page_url);

    $count = count($saved);
    ds_ref_respond(true, 200, sprintf(
        "Thanks! We've got your %d %s. You'll earn %s for each one we meet with.",
        $count,
        $count === 1 ? 'referral' : 'referrals',
        ds_ref_money($settings['reward'])
    ), $source_id);
}

/** One email to the team per submission. */
function ds_ref_notify(array $referrer, array $people, array $settings) {
    $to = apply_filters('ds_referral_notify_email', $settings['notify'] ?: [get_option('admin_email')]);
    $to = array_filter((array) $to, 'is_email');
    if (!$to) return false;

    $lines = [
        'Referred by: ' . $referrer['name'],
        'Email: ' . $referrer['email'],
        'Phone: ' . ($referrer['phone'] ?: '—'),
        '',
        sprintf('%d %s (%s each once we meet with them):', count($people), count($people) === 1 ? 'person' : 'people', ds_ref_money($settings['reward'])),
    ];
    foreach ($people as $n => $p) {
        $lines[] = '';
        $lines[] = ($n + 1) . '. ' . $p['name'] . ($p['repeat'] ? '  [already referred before]' : '');
        $lines[] = '   Email: ' . $p['email'];
        if ($p['phone']) $lines[] = '   Phone: ' . $p['phone'];
        if ($p['note'])  $lines[] = '   Note: ' . str_replace("\n", "\n         ", $p['note']);
    }
    $lines[] = '';
    $lines[] = 'Track status and payouts: ' . admin_url('edit.php?post_type=' . DS_REF_POST_TYPE);

    return wp_mail(
        $to,
        sprintf('New referrals from %s (%d)', $referrer['name'], count($people)),
        implode("\n", $lines),
        ['Reply-To: ' . $referrer['name'] . ' <' . $referrer['email'] . '>']
    );
}

/**
 * Each referred person is a lead too: send them to DSD like the lead form
 * does. Best effort — the referral is already saved and emailed. Turn off
 * with add_filter('ds_referral_send_to_dsd', '__return_false').
 */
function ds_ref_send_to_dsd(array $referrer, array $people, $page_url) {
    if (!apply_filters('ds_referral_send_to_dsd', true) || !function_exists('ds_lead_send_to_dsd')) return;
    if (!ds_lead_config('DSD_BASE_URL') || !ds_lead_config('DSD_LEADS_API_KEY')) return;

    foreach ($people as $p) {
        $message = sprintf('Referral from %s (%s%s).', $referrer['name'], $referrer['email'], $referrer['phone'] ? ', ' . $referrer['phone'] : '');
        if ($p['note']) $message .= "\n\nNote: " . $p['note'];
        ds_lead_send_to_dsd(array_filter([
            'name'        => $p['name'],
            'email'       => $p['email'],
            'phone'       => $p['phone'],
            'message'     => $message,
            'page_url'    => $page_url,
            'external_id' => 'referral-' . $p['id'] . '-' . wp_hash((string) $p['id']),
        ], 'strlen'));
    }
}

// ── wp-admin: Referrals list ────────────────────────────────

add_filter('manage_' . DS_REF_POST_TYPE . '_posts_columns', function () {
    return [
        'cb'          => '<input type="checkbox">',
        'title'       => 'Referred person',
        'ds_contact'  => 'Contact',
        'ds_referrer' => 'Referred by',
        'ds_status'   => 'Status',
        'ds_reward'   => 'Reward',
        'date'        => 'Submitted',
    ];
});

add_action('manage_' . DS_REF_POST_TYPE . '_posts_custom_column', function ($column, $post_id) {
    $meta = function ($key) use ($post_id) { return (string) get_post_meta($post_id, '_ds_ref_' . $key, true); };
    switch ($column) {
        case 'ds_contact':
            echo '<a href="mailto:' . esc_attr($meta('email')) . '">' . esc_html($meta('email')) . '</a>';
            if ($meta('phone')) echo '<br>' . esc_html($meta('phone'));
            if ($meta('repeat')) echo '<br><em>Already referred by someone else</em>';
            break;
        case 'ds_referrer':
            $email = $meta('referrer_email');
            echo esc_html($meta('referrer_name')) . '<br>';
            echo '<a href="' . esc_url(add_query_arg(['post_type' => DS_REF_POST_TYPE, 'ds_referrer' => $email], admin_url('edit.php'))) . '" title="Show all of their referrals">' . esc_html($email) . '</a>';
            break;
        case 'ds_status':
            $statuses = ds_ref_statuses();
            echo esc_html($statuses[$meta('status')] ?? $statuses['new']);
            break;
        case 'ds_reward':
            echo esc_html(ds_ref_money($meta('reward')));
            break;
    }
}, 10, 2);

/** Status and referrer filters above the list. */
add_action('restrict_manage_posts', function ($post_type) {
    if ($post_type !== DS_REF_POST_TYPE) return;
    $current = sanitize_key($_GET['ds_status'] ?? '');
    echo '<select name="ds_status"><option value="">All statuses</option>';
    foreach (ds_ref_statuses() as $value => $label) {
        printf('<option value="%s"%s>%s</option>', esc_attr($value), selected($current, $value, false), esc_html($label));
    }
    echo '</select>';
    $referrer = sanitize_email(wp_unslash($_GET['ds_referrer'] ?? ''));
    if ($referrer) echo '<input type="hidden" name="ds_referrer" value="' . esc_attr($referrer) . '">';
});

add_action('pre_get_posts', function ($query) {
    if (!is_admin() || !$query->is_main_query() || $query->get('post_type') !== DS_REF_POST_TYPE) return;
    $meta = [];
    $status = sanitize_key($_GET['ds_status'] ?? '');
    if ($status && isset(ds_ref_statuses()[$status])) $meta[] = ['key' => '_ds_ref_status', 'value' => $status];
    $referrer = strtolower(sanitize_email(wp_unslash($_GET['ds_referrer'] ?? '')));
    if ($referrer) $meta[] = ['key' => '_ds_ref_referrer_email', 'value' => $referrer];
    if ($meta) $query->set('meta_query', $meta);
});

/** When filtered to one referrer, show their running total. */
add_action('admin_notices', function () {
    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    if (!$screen || $screen->id !== 'edit-' . DS_REF_POST_TYPE) return;
    $referrer = strtolower(sanitize_email(wp_unslash($_GET['ds_referrer'] ?? '')));
    if (!$referrer) return;

    $earned = $paid = 0.0;
    $ids = get_posts([
        'post_type' => DS_REF_POST_TYPE, 'post_status' => 'any', 'posts_per_page' => -1, 'fields' => 'ids',
        'meta_query' => [['key' => '_ds_ref_referrer_email', 'value' => $referrer]],
    ]);
    foreach ($ids as $id) {
        $status = get_post_meta($id, '_ds_ref_status', true);
        $reward = (float) get_post_meta($id, '_ds_ref_reward', true);
        if ($status === 'met')  $earned += $reward;
        if ($status === 'paid') $paid += $reward;
    }
    printf(
        '<div class="notice notice-info"><p><strong>%s</strong>: %d %s on file · %s earned and not yet paid · %s paid. <a href="%s">Show everyone</a></p></div>',
        esc_html($referrer),
        count($ids),
        count($ids) === 1 ? 'referral' : 'referrals',
        esc_html(ds_ref_money($earned)),
        esc_html(ds_ref_money($paid)),
        esc_url(admin_url('edit.php?post_type=' . DS_REF_POST_TYPE))
    );
});

// ── wp-admin: edit screen ───────────────────────────────────

add_action('add_meta_boxes_' . DS_REF_POST_TYPE, function () {
    add_meta_box('ds_ref_details', 'Referral', 'ds_ref_render_meta_box', DS_REF_POST_TYPE, 'normal', 'high');
});

function ds_ref_render_meta_box($post) {
    $meta = function ($key) use ($post) { return (string) get_post_meta($post->ID, '_ds_ref_' . $key, true); };
    $status = $meta('status') ?: 'new';
    wp_nonce_field('ds_ref_save', 'ds_ref_nonce');
    $rows = [
        'Email'       => $meta('email'),
        'Phone'       => $meta('phone') ?: '—',
        'Note'        => $post->post_content ?: '—',
        'Referred by' => trim($meta('referrer_name') . ' <' . $meta('referrer_email') . '> ' . $meta('referrer_phone')),
        'Reward'      => ds_ref_money($meta('reward')) . ' once we meet with them',
        'Sent from'   => $meta('page_url') ?: '—',
    ];
    echo '<table class="form-table" role="presentation"><tbody>';
    foreach ($rows as $label => $value) {
        printf('<tr><th scope="row">%s</th><td>%s</td></tr>', esc_html($label), nl2br(esc_html($value)));
    }
    if ($meta('repeat')) {
        echo '<tr><th scope="row">Heads up</th><td>This person was already referred by someone else when this came in.</td></tr>';
    }
    echo '<tr><th scope="row"><label for="ds_ref_status">Status</label></th><td><select name="ds_ref_status" id="ds_ref_status">';
    foreach (ds_ref_statuses() as $value => $label) {
        printf('<option value="%s"%s>%s</option>', esc_attr($value), selected($status, $value, false), esc_html($label));
    }
    echo '</select></td></tr></tbody></table>';
}

add_action('save_post_' . DS_REF_POST_TYPE, function ($post_id) {
    if (!isset($_POST['ds_ref_nonce']) || !wp_verify_nonce(sanitize_key($_POST['ds_ref_nonce']), 'ds_ref_save')) return;
    if (!current_user_can('edit_post', $post_id)) return;
    $status = sanitize_key($_POST['ds_ref_status'] ?? '');
    if (isset(ds_ref_statuses()[$status])) update_post_meta($post_id, '_ds_ref_status', $status);
});

/** Bulk-mark referrals as met / paid from the list. */
add_filter('bulk_actions-edit-' . DS_REF_POST_TYPE, function ($actions) {
    foreach (ds_ref_statuses() as $value => $label) {
        $actions['ds_ref_status_' . $value] = 'Mark as: ' . $label;
    }
    return $actions;
});

add_filter('handle_bulk_actions-edit-' . DS_REF_POST_TYPE, function ($redirect, $action, $ids) {
    if (strpos($action, 'ds_ref_status_') !== 0) return $redirect;
    $status = substr($action, strlen('ds_ref_status_'));
    if (!isset(ds_ref_statuses()[$status])) return $redirect;
    foreach ($ids as $id) {
        if (current_user_can('edit_post', $id)) update_post_meta($id, '_ds_ref_status', $status);
    }
    return $redirect;
}, 10, 3);
