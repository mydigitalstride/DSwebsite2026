<?php
/**
 * Lead form (sends to DSD via our server — see inc/dsd-leads.php).
 * Front end: assets/js/main.js (.ds-lead). Without JS the form posts
 * normally and the handler redirects back here with ?ds_lead=<status>.
 *
 * $args:
 *  - services       string  one per line (ACF textarea); defaults if empty
 *  - button_label   string
 *  - success_heading string
 *  - success_text   string
 */
$GLOBALS['ds_lead_instances'] = ($GLOBALS['ds_lead_instances'] ?? 0) + 1;
$ds_lead_instance = $GLOBALS['ds_lead_instances'];

$args = wp_parse_args($args ?? [], [
    'services'        => '',
    'button_label'    => '',
    'success_heading' => '',
    'success_text'    => '',
]);
$services        = ds_lead_parse_services($args['services']);
$button_label    = $args['button_label'] ?: 'Send Message';
$success_heading = $args['success_heading'] ?: 'Thanks — we got it!';
$success_text    = $args['success_text'] ?: "We'll be in touch within one business day.";
$prefix          = 'ds-lead-' . $ds_lead_instance;

// Result of a no-JS submit (first form on the page only).
$status     = $ds_lead_instance === 1 ? sanitize_key($_GET['ds_lead'] ?? '') : '';
$bad_fields = $status === 'invalid' ? array_map('sanitize_key', explode(',', (string) ($_GET['ds_lead_fields'] ?? ''))) : [];
$messages   = ds_lead_error_messages();

// Email and phone aren't tagged "(optional)" — one of the two is required.
$fields = [
    ['name' => 'contact_name',  'label' => 'Name',  'type' => 'text',  'required' => true,  'autocomplete' => 'name',  'maxlength' => 100],
    ['name' => 'contact_email', 'label' => 'Email', 'type' => 'email', 'required' => false, 'autocomplete' => 'email', 'maxlength' => 254, 'help' => 'An email or a phone number is required so we can reach you.'],
    ['name' => 'contact_phone', 'label' => 'Phone', 'type' => 'tel',   'required' => false, 'autocomplete' => 'tel',   'maxlength' => 40],
];
?>
<div class="ds-lead" id="<?php echo $ds_lead_instance === 1 ? 'ds-lead' : esc_attr($prefix); ?>">
    <form class="ds-survey__form ds-lead__form" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="post"<?php echo $status === 'thanks' ? ' hidden' : ''; ?>>
        <input type="hidden" name="action" value="ds_lead_submit">
        <input type="hidden" name="ds_lead_source" value="<?php echo esc_attr(get_queried_object_id()); ?>">
        <input type="hidden" name="ds_ts" value="<?php echo esc_attr(ds_lead_time_token()); ?>">
        <input type="hidden" name="page_url" value="<?php echo esc_url(get_permalink(get_queried_object_id())); ?>">
        <input type="hidden" name="mds_attribution" value="">
        <div class="ds-survey__hp" aria-hidden="true">
            <label>Leave this field empty <input type="text" name="ds_hp_website" tabindex="-1" autocomplete="off"></label>
        </div>

        <p class="ds-survey__form-error" role="alert"<?php echo in_array($status, ['invalid', 'error'], true) ? '' : ' hidden'; ?>>
            <?php
            if ($status === 'invalid') echo 'Please check the highlighted fields.';
            elseif ($status === 'error') echo "Sorry, something went wrong on our end. Please try again, or call or email us.";
            ?>
        </p>

        <div class="ds-lead__fields">
            <?php foreach ($fields as $f) :
                $id      = $prefix . '-' . $f['name'];
                $invalid = in_array($f['name'], $bad_fields, true);
                $desc    = trim((!empty($f['help']) ? $id . '-help ' : '') . $id . '-error');
            ?>
                <div class="ds-lead__field<?php echo $invalid ? ' has-error' : ''; ?>" data-name="<?php echo esc_attr($f['name']); ?>">
                    <label class="ds-survey__label" for="<?php echo esc_attr($id); ?>">
                        <?php echo esc_html($f['label']); ?>
                                            </label>
                    <input class="ds-survey__input" id="<?php echo esc_attr($id); ?>"
                        type="<?php echo esc_attr($f['type']); ?>"
                        name="<?php echo esc_attr($f['name']); ?>"
                        autocomplete="<?php echo esc_attr($f['autocomplete']); ?>"
                        maxlength="<?php echo esc_attr($f['maxlength']); ?>"
                        aria-describedby="<?php echo esc_attr($desc); ?>"
                        <?php echo $f['required'] ? 'required aria-required="true"' : ''; ?>
                        <?php echo $invalid ? 'aria-invalid="true"' : ''; ?>>
                    <?php if (!empty($f['help'])) : ?>
                        <p class="ds-survey__help ds-lead__help" id="<?php echo esc_attr($id); ?>-help"><?php echo esc_html($f['help']); ?></p>
                    <?php endif; ?>
                    <p class="ds-survey__error" id="<?php echo esc_attr($id); ?>-error"<?php echo $invalid ? '' : ' hidden'; ?>><?php echo esc_html($messages[$f['name']]); ?></p>
                </div>
            <?php endforeach; ?>

            <?php $id = $prefix . '-service'; $invalid = in_array('service', $bad_fields, true); ?>
            <div class="ds-lead__field<?php echo $invalid ? ' has-error' : ''; ?>" data-name="service">
                <label class="ds-survey__label" for="<?php echo esc_attr($id); ?>">
                    Service you're interested in <em class="ds-survey__optional">(optional)</em>
                </label>
                <select class="ds-survey__input ds-lead__select" id="<?php echo esc_attr($id); ?>" name="service"
                    aria-describedby="<?php echo esc_attr($id); ?>-error"<?php echo $invalid ? ' aria-invalid="true"' : ''; ?>>
                    <option value="">Choose a service…</option>
                    <?php foreach ($services as $service) : ?>
                        <option value="<?php echo esc_attr($service); ?>"><?php echo esc_html($service); ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="ds-survey__error" id="<?php echo esc_attr($id); ?>-error"<?php echo $invalid ? '' : ' hidden'; ?>><?php echo esc_html($messages['service']); ?></p>
            </div>

            <?php $id = $prefix . '-message'; $invalid = in_array('message', $bad_fields, true); ?>
            <div class="ds-lead__field ds-lead__field--wide<?php echo $invalid ? ' has-error' : ''; ?>" data-name="message">
                <label class="ds-survey__label" for="<?php echo esc_attr($id); ?>">
                    Message <em class="ds-survey__optional">(optional)</em>
                </label>
                <textarea class="ds-survey__input" id="<?php echo esc_attr($id); ?>" name="message" rows="5" maxlength="5000"
                    autocomplete="off" aria-describedby="<?php echo esc_attr($id); ?>-error"<?php echo $invalid ? ' aria-invalid="true"' : ''; ?>></textarea>
                <p class="ds-survey__error" id="<?php echo esc_attr($id); ?>-error"<?php echo $invalid ? '' : ' hidden'; ?>><?php echo esc_html($messages['message']); ?></p>
            </div>
        </div>

        <div class="ds-lead__actions">
            <button type="submit" class="ds-btn ds-btn--primary ds-lead__submit"><?php echo esc_html($button_label); ?></button>
        </div>
    </form>

    <div class="ds-survey__success ds-lead__success" role="status" tabindex="-1"<?php echo $status === 'thanks' ? '' : ' hidden'; ?>>
        <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
        <h3><?php echo esc_html($success_heading); ?></h3>
        <p><?php echo esc_html($success_text); ?></p>
    </div>
</div>
