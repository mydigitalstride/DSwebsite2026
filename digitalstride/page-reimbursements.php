<?php
/**
 * Template Name: Team Reimbursements
 *
 * Login-protected portal where team members redact and submit medical
 * receipts. Auto-applies to a page with the slug "reimbursements", or can be
 * assigned to any page via the template dropdown. Visitors who are not
 * logged in are sent to wp-login and returned here afterwards.
 */

if (!is_user_logged_in()) {
    auth_redirect();
    exit;
}

$ds_user = wp_get_current_user();

get_header();
?>

<main class="ds-reimb">
    <section class="ds-reimb__intro">
        <div class="ds-container">
            <h1>Medical Receipt Reimbursement</h1>
            <p class="ds-reimb__welcome">
                Hi <?php echo esc_html($ds_user->display_name); ?> — submit a receipt below and finance
                will review it for reimbursement on your pay.
            </p>

            <div class="ds-reimb__privacy">
                <h2>Your privacy, by design</h2>
                <ul>
                    <li><strong>Redact before anything is sent.</strong> Your photo opens on your device only. Draw black boxes over anything private — the covered pixels are destroyed, not hidden.</li>
                    <li><strong>Only the redacted copy is uploaded.</strong> The original photo never leaves your device, and photo metadata (like location) is stripped.</li>
                    <li><strong>Limited access.</strong> Only you and the finance reviewer can open your receipts. They are stored outside the public website files.</li>
                </ul>
                <p class="ds-reimb__privacy-tip">
                    Please cover: diagnosis or treatment details, prescription names, date of birth,
                    account/member numbers. Leave visible: provider name, date of service, and the amount paid.
                </p>
            </div>
        </div>
    </section>

    <section class="ds-reimb__form-section">
        <div class="ds-container">
            <form id="ds-reimb-form" novalidate>
                <h2>1. Add your receipt photo<?php echo DS_REIMB_MAX_FILES > 1 ? 's' : ''; ?></h2>

                <div class="ds-reimb__dropzone" id="ds-reimb-dropzone">
                    <input type="file" id="ds-reimb-file" accept="image/*" hidden>
                    <p><strong>Take a photo or choose an image</strong></p>
                    <p class="ds-reimb__dropzone-hint">JPG, PNG, or WebP · it stays on your device until you redact and add it</p>
                    <button type="button" class="ds-btn" id="ds-reimb-choose">Choose photo</button>
                </div>

                <div class="ds-reimb__editor" id="ds-reimb-editor" hidden>
                    <p class="ds-reimb__editor-help">
                        <strong>Drag to draw black boxes</strong> over anything private. When it looks right,
                        click <em>Add redacted receipt</em>. Only that redacted version can be uploaded.
                    </p>
                    <div class="ds-reimb__canvas-wrap">
                        <canvas id="ds-reimb-canvas"></canvas>
                    </div>
                    <div class="ds-reimb__editor-actions">
                        <button type="button" class="ds-btn ds-btn--outline" id="ds-reimb-undo">Undo box</button>
                        <button type="button" class="ds-btn ds-btn--outline" id="ds-reimb-clear">Clear boxes</button>
                        <button type="button" class="ds-btn ds-btn--outline" id="ds-reimb-cancel">Discard photo</button>
                        <button type="button" class="ds-btn" id="ds-reimb-add">Add redacted receipt</button>
                    </div>
                </div>

                <ul class="ds-reimb__pending" id="ds-reimb-pending" aria-live="polite"></ul>

                <h2>2. Expense details</h2>
                <div class="ds-reimb__fields">
                    <label>
                        Date of expense <span aria-hidden="true">*</span>
                        <input type="date" name="expense_date" id="ds-reimb-date" max="<?php echo esc_attr(current_time('Y-m-d')); ?>" required>
                    </label>
                    <label>
                        Amount (USD) <span aria-hidden="true">*</span>
                        <input type="text" name="amount" id="ds-reimb-amount" inputmode="decimal" placeholder="0.00" required>
                    </label>
                    <label>
                        Category <span aria-hidden="true">*</span>
                        <select name="category" id="ds-reimb-category" required>
                            <option value="">Select…</option>
                            <?php foreach (ds_reimb_categories() as $cat) : ?>
                                <option value="<?php echo esc_attr($cat); ?>"><?php echo esc_html($cat); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label class="ds-reimb__field--wide">
                        Note for finance (optional — please don't include medical details)
                        <textarea name="note" id="ds-reimb-note" rows="3" maxlength="1000"></textarea>
                    </label>
                </div>

                <div class="ds-reimb__submit-row">
                    <button type="submit" class="ds-btn ds-btn--primary" id="ds-reimb-submit">Submit claim</button>
                    <p class="ds-reimb__msg" id="ds-reimb-msg" role="status" aria-live="polite"></p>
                </div>
            </form>
        </div>
    </section>

    <section class="ds-reimb__history">
        <div class="ds-container">
            <h2>Your claims</h2>
            <?php ds_reimb_render_user_claims(); ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
