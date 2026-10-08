<?php
/**
 * AEC Landing: Guided Pathway — "Where Are You Starting?" accordion
 * (repeater `aec_guided_accordion`).
 *
 * One panel open at a time; the open card gets the orange-yellow gradient
 * border and its guidance + "Explore …" text link show beneath it. The
 * "Book A Consult" button (group `aec_guided_consult`) stands on its own
 * below the accordion; its heading / text are optional.
 */
$d       = ds_aec_defaults('guided');
$heading = get_field('aec_guided_heading') ?: $d['heading'];
$tabs    = [];

if (have_rows('aec_guided_accordion')) {
    while (have_rows('aec_guided_accordion')) {
        the_row();
        $tabs[] = [
            'title'   => get_sub_field('tab_title'),
            'content' => get_sub_field('tab_content_text'),
            'label'   => get_sub_field('cta_button_label'),
            'link'    => get_sub_field('cta_button_link'),
        ];
    }
}
if (!$tabs) $tabs = $d['tabs'];

$tabs = array_values(array_filter($tabs, function ($t) { return !empty($t['title']); }));

$consult = get_field('aec_guided_consult') ?: [];
$c_head  = $consult['heading'] ?? '';
$c_text  = $consult['text'] ?? '';
$c_btn   = ds_aec_link(($consult['button'] ?? null) ?: $d['consult']['button'], __('Book A Consult', 'digitalstride'));

if (!$tabs && !$c_btn) return;
$uid = 'ds-aec-path-' . wp_unique_id();
?>
<section class="ds-section ds-aec-path">
    <div class="ds-container ds-container--narrow">
        <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>

        <?php if ($tabs) : ?>
        <div class="ds-aec-path__list" data-aec-accordion>
            <?php foreach ($tabs as $i => $t) :
                $btn_id    = $uid . '-btn-' . $i;
                $panel_id  = $uid . '-panel-' . $i;
                $cta       = ds_aec_link($t['link']);
                $cta_label = $t['label'] ?: ($cta['title'] ?? '');
                ?>
                <div class="ds-aec-path__item">
                    <h3 class="ds-aec-path__heading">
                        <button type="button" class="ds-aec-path__toggle" id="<?php echo esc_attr($btn_id); ?>"
                            aria-expanded="false" aria-controls="<?php echo esc_attr($panel_id); ?>">
                            <span class="ds-aec-path__title"><?php echo esc_html($t['title']); ?></span>
                            <i class="fa-solid fa-chevron-down ds-aec-path__chevron" aria-hidden="true"></i>
                        </button>
                    </h3>
                    <div class="ds-aec-path__panel" id="<?php echo esc_attr($panel_id); ?>" role="region" aria-labelledby="<?php echo esc_attr($btn_id); ?>">
                        <div class="ds-aec-path__panel-inner">
                            <div class="ds-aec-path__content">
                                <?php if ($t['content']) echo wp_kses_post(wpautop($t['content'])); ?>
                                <?php if ($cta && $cta_label) : ?>
                                    <p class="ds-aec-path__cta">
                                        <a href="<?php echo esc_url($cta['url']); ?>" class="ds-aec-path__link"<?php ds_aec_target_attrs($cta['target']); ?>>
                                            <?php echo esc_html($cta_label); ?> <span class="ds-aec-path__arrow" aria-hidden="true">&rarr;</span>
                                        </a>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if ($c_btn) : ?>
            <?php // Just the button by default; heading / text are optional extras. ?>
            <div class="ds-aec-consult<?php echo ($c_head || $c_text) ? ' ds-aec-consult--boxed' : ''; ?>">
                <?php if ($c_head) : ?>
                    <h3 class="ds-aec-consult__heading"><?php echo esc_html($c_head); ?></h3>
                <?php endif; ?>
                <?php if ($c_text) : ?>
                    <p class="ds-aec-consult__text"><?php echo esc_html($c_text); ?></p>
                <?php endif; ?>
                <a href="<?php echo esc_url($c_btn['url']); ?>" class="ds-btn ds-btn--primary ds-aec-consult__btn"<?php ds_aec_target_attrs($c_btn['target']); ?>><?php echo esc_html($c_btn['title']); ?></a>
            </div>
        <?php endif; ?>
    </div>
</section>
