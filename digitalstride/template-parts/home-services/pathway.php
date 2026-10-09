<?php
/**
 * Home Services: Guided Pathway — "What Is Your Biggest Growth Bottleneck
 * Right Now?" (repeater `hs_guided_accordion`).
 *
 * Same accordion as the AEC page (aec-landing.js): one tab open at a time,
 * the open tab gets the yellow-orange gradient border and its guidance shows
 * beneath it. Regular tabs end with an "Explore …" text link; a tab flagged
 * `is_consult_tab` ends with the primary "Book A Consult" button instead.
 */
$d       = ds_hs_defaults('guided');
$heading = get_field('hs_guided_heading') ?: $d['heading'];
$tabs    = [];

if (have_rows('hs_guided_accordion')) {
    while (have_rows('hs_guided_accordion')) {
        the_row();
        $tabs[] = [
            'title'   => get_sub_field('tab_title'),
            'content' => get_sub_field('tab_content_text'),
            'label'   => get_sub_field('cta_button_label'),
            'link'    => get_sub_field('cta_button_link'),
            'consult' => (bool) get_sub_field('is_consult_tab'),
        ];
    }
}
if (!$tabs) $tabs = $d['tabs'];

$tabs = array_values(array_filter($tabs, function ($t) { return !empty($t['title']); }));
if (!$tabs) return;

$uid = 'ds-hs-path-' . wp_unique_id();
?>
<section class="ds-section ds-aec-path ds-hs-path">
    <div class="ds-container ds-container--narrow">
        <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>

        <div class="ds-aec-path__list" data-aec-accordion>
            <?php foreach ($tabs as $i => $t) :
                $btn_id   = $uid . '-btn-' . $i;
                $panel_id = $uid . '-panel-' . $i;
                $cta      = ds_aec_link($t['link'], $t['consult'] ? __('Book A Consult', 'digitalstride') : '');
                $label    = $t['label'] ?: ($cta['title'] ?? '');
                ?>
                <div class="ds-aec-path__item<?php echo $t['consult'] ? ' ds-hs-path__item--consult' : ''; ?>">
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
                                <?php if ($cta && $label) : ?>
                                    <p class="ds-aec-path__cta">
                                        <?php if ($t['consult']) : ?>
                                            <a href="<?php echo esc_url($cta['url']); ?>" class="ds-btn ds-btn--primary ds-hs-path__consult-btn"<?php ds_aec_target_attrs($cta['target']); ?>><?php echo esc_html($label); ?></a>
                                        <?php else : ?>
                                            <a href="<?php echo esc_url($cta['url']); ?>" class="ds-aec-path__link"<?php ds_aec_target_attrs($cta['target']); ?>>
                                                <?php echo esc_html($label); ?> <span class="ds-aec-path__arrow" aria-hidden="true">&rarr;</span>
                                            </a>
                                        <?php endif; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
