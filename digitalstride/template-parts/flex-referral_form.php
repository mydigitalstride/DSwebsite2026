<?php
/**
 * Flex Layout: Referral Form
 * The referrer's details plus one row per person they're referring ("Add
 * another person" up to the cap). Saved as Referrals in wp-admin and emailed
 * to the team — see inc/referrals.php. Front end: assets/js/main.js
 * (.ds-referral). Without JS the form posts one person and the handler
 * redirects back here with ?ds_ref=<status>.
 */
$GLOBALS['ds_ref_instances'] = ($GLOBALS['ds_ref_instances'] ?? 0) + 1;
$ds_ref_instance = $GLOBALS['ds_ref_instances'];

$reward_raw = get_sub_field('reward_amount');
$reward     = is_numeric($reward_raw) && $reward_raw >= 0 ? (float) $reward_raw : DS_REF_DEFAULT_REWARD;
$max        = (int) get_sub_field('max_referrals');
$max        = $max > 0 ? min(50, $max) : DS_REF_DEFAULT_MAX;
$money      = ds_ref_money($reward);
$fill       = function ($text) use ($money, $max, $reward) {
    return strtr((string) $text, ['{reward}' => $money, '{max}' => $max, '{total}' => ds_ref_money($reward * $max)]);
};

$heading         = $fill(get_sub_field('heading') ?: 'Refer a Friend, Earn {reward}');
$intro           = $fill(get_sub_field('intro') ?: "Know a business that could use a hand with its marketing? Send them our way. You'll earn {reward} for every person we meet with — they don't have to buy anything. Refer up to {max} people (up to {total}).");
$terms           = $fill(get_sub_field('terms') ?: 'Rewards are paid once we meet with your referral. Up to {max} referrals ({total}) per person. Duplicate referrals and existing clients are not eligible.');
$button_label    = get_sub_field('button_label') ?: 'Send My Referrals';
$success_heading = get_sub_field('success_heading') ?: 'Thank you for the referrals!';
$success_text    = $fill(get_sub_field('success_text') ?: "We'll reach out to them soon. Once we meet, we'll send your {reward}.");
$prefix          = 'ds-ref-' . $ds_ref_instance;
$messages        = ds_ref_error_messages();

// Result of a no-JS submit (first form on the page only).
$status     = $ds_ref_instance === 1 ? sanitize_key($_GET['ds_ref'] ?? '') : '';
$status_msg = $status === 'error' ? sanitize_text_field(wp_unslash($_GET['ds_ref_msg'] ?? '')) : '';

$referrer_fields = [
    ['name' => 'referrer_name',  'label' => 'Your name',  'type' => 'text',  'required' => true,  'autocomplete' => 'name',  'maxlength' => 100],
    ['name' => 'referrer_email', 'label' => 'Your email', 'type' => 'email', 'required' => true,  'autocomplete' => 'email', 'maxlength' => 254],
    ['name' => 'referrer_phone', 'label' => 'Your phone', 'type' => 'tel',   'required' => false, 'autocomplete' => 'tel',   'maxlength' => 40],
];
$person_fields = [
    ['key' => 'name',  'label' => 'Name',  'type' => 'text',  'required' => true,  'maxlength' => 100],
    ['key' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true,  'maxlength' => 254],
    ['key' => 'phone', 'label' => 'Phone', 'type' => 'tel',   'required' => false, 'maxlength' => 40],
    ['key' => 'note',  'label' => 'Note',  'type' => 'textarea', 'required' => false, 'maxlength' => 1000, 'placeholder' => 'How do you know them? What could they use help with?'],
];

/**
 * One referral row. $i is the row index, or "__i__" in the <template> the JS
 * clones (it swaps in the real index).
 */
$render_person = function ($i, $number) use ($person_fields, $prefix, $messages) {
    ?>
    <fieldset class="ds-referral__person" data-index="<?php echo esc_attr($i); ?>">
        <legend class="ds-referral__person-title">Person <span class="ds-referral__person-num"><?php echo esc_html($number); ?></span></legend>
        <button type="button" class="ds-referral__remove" aria-label="Remove person <?php echo esc_attr($number); ?>"<?php echo $number === 1 ? ' hidden' : ''; ?>>
            <i class="fa-solid fa-xmark" aria-hidden="true"></i> Remove
        </button>
        <div class="ds-lead__fields">
            <?php foreach ($person_fields as $f) :
                $name = 'referrals[' . $i . '][' . $f['key'] . ']';
                $id   = $prefix . '-' . $i . '-' . $f['key'];
                $wide = $f['type'] === 'textarea';
            ?>
                <div class="ds-lead__field<?php echo $wide ? ' ds-lead__field--wide' : ''; ?>" data-name="<?php echo esc_attr($name); ?>" data-key="<?php echo esc_attr($f['key']); ?>">
                    <label class="ds-survey__label" for="<?php echo esc_attr($id); ?>">
                        <?php echo esc_html($f['label']); ?>
                        <?php if (!$f['required']) : ?><em class="ds-survey__optional">(optional)</em><?php endif; ?>
                    </label>
                    <?php if ($wide) : ?>
                        <textarea class="ds-survey__input" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($name); ?>" rows="2"
                            maxlength="<?php echo esc_attr($f['maxlength']); ?>" placeholder="<?php echo esc_attr($f['placeholder']); ?>"
                            autocomplete="off" aria-describedby="<?php echo esc_attr($id); ?>-error"></textarea>
                    <?php else : ?>
                        <input class="ds-survey__input" id="<?php echo esc_attr($id); ?>" type="<?php echo esc_attr($f['type']); ?>"
                            name="<?php echo esc_attr($name); ?>" maxlength="<?php echo esc_attr($f['maxlength']); ?>"
                            autocomplete="off" aria-describedby="<?php echo esc_attr($id); ?>-error"
                            <?php echo $f['required'] ? 'required aria-required="true"' : ''; ?>>
                    <?php endif; ?>
                    <p class="ds-survey__error" id="<?php echo esc_attr($id); ?>-error" hidden><?php echo esc_html($messages[$f['key']]); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </fieldset>
    <?php
};
?>

<section class="ds-section ds-section--referral-form">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($intro) : ?>
            <p class="ds-section__intro ds-lead__intro"><?php echo esc_html($intro); ?></p>
        <?php endif; ?>

        <div class="ds-lead__wrap">
            <div class="ds-referral" id="<?php echo $ds_ref_instance === 1 ? 'ds-referral' : esc_attr($prefix); ?>"
                data-max="<?php echo esc_attr($max); ?>" data-reward="<?php echo esc_attr($reward); ?>">
                <form class="ds-survey__form ds-referral__form" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="post"<?php echo $status === 'thanks' ? ' hidden' : ''; ?>>
                    <input type="hidden" name="action" value="ds_referral_submit">
                    <input type="hidden" name="ds_ref_source" value="<?php echo esc_attr(get_queried_object_id()); ?>">
                    <input type="hidden" name="ds_ts" value="<?php echo esc_attr(ds_lead_time_token()); ?>">
                    <input type="hidden" name="page_url" value="<?php echo esc_url(get_permalink(get_queried_object_id())); ?>">
                    <div class="ds-survey__hp" aria-hidden="true">
                        <label>Leave this field empty <input type="text" name="ds_hp_website" tabindex="-1" autocomplete="off"></label>
                    </div>

                    <p class="ds-survey__form-error" role="alert"<?php echo $status === 'error' ? '' : ' hidden'; ?>>
                        <?php echo esc_html($status_msg ?: 'Sorry, something went wrong. Please check your details and try again.'); ?>
                    </p>

                    <fieldset class="ds-referral__group">
                        <legend class="ds-referral__group-title">Your details</legend>
                        <p class="ds-survey__help ds-referral__group-help">So we know who to thank and where to send your reward.</p>
                        <div class="ds-lead__fields">
                            <?php foreach ($referrer_fields as $f) : $id = $prefix . '-' . $f['name']; ?>
                                <div class="ds-lead__field<?php echo $f['name'] === 'referrer_phone' ? ' ds-lead__field--wide' : ''; ?>" data-name="<?php echo esc_attr($f['name']); ?>">
                                    <label class="ds-survey__label" for="<?php echo esc_attr($id); ?>">
                                        <?php echo esc_html($f['label']); ?>
                                        <?php if (!$f['required']) : ?><em class="ds-survey__optional">(optional)</em><?php endif; ?>
                                    </label>
                                    <input class="ds-survey__input" id="<?php echo esc_attr($id); ?>"
                                        type="<?php echo esc_attr($f['type']); ?>"
                                        name="<?php echo esc_attr($f['name']); ?>"
                                        autocomplete="<?php echo esc_attr($f['autocomplete']); ?>"
                                        maxlength="<?php echo esc_attr($f['maxlength']); ?>"
                                        aria-describedby="<?php echo esc_attr($id); ?>-error"
                                        <?php echo $f['required'] ? 'required aria-required="true"' : ''; ?>>
                                    <p class="ds-survey__error" id="<?php echo esc_attr($id); ?>-error" hidden><?php echo esc_html($messages[$f['name']]); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </fieldset>

                    <div class="ds-referral__group">
                        <div class="ds-referral__people-head">
                            <h3 class="ds-referral__group-title">Who are you referring?</h3>
                            <p class="ds-referral__tally" aria-live="polite">
                                <span class="ds-referral__count">1</span> of <?php echo esc_html($max); ?> ·
                                up to <strong class="ds-referral__total"><?php echo esc_html($money); ?></strong>
                            </p>
                        </div>
                        <div class="ds-referral__people">
                            <?php $render_person(0, 1); ?>
                        </div>
                        <template class="ds-referral__template"><?php $render_person('__i__', '__n__'); ?></template>
                        <button type="button" class="ds-btn ds-btn--outline ds-referral__add" hidden>
                            <i class="fa-solid fa-plus" aria-hidden="true"></i> Add another person
                        </button>
                        <p class="ds-survey__help ds-referral__limit" hidden>That's the most you can add — <?php echo esc_html($max); ?> people.</p>
                    </div>

                    <?php if ($terms) : ?>
                        <p class="ds-referral__terms"><?php echo esc_html($terms); ?></p>
                    <?php endif; ?>

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
        </div>
    </div>
</section>
