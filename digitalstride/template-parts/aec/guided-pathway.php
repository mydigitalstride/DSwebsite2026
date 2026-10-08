<?php
/**
 * AEC Landing: Guided Pathway — "Where Are You Starting?" accordion
 * (repeater `aec_guided_accordion`).
 *
 * One panel open at a time. Regular tabs end with a secondary "Explore …"
 * button; the consult tab (is_consult_tab) ends with the primary button.
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
            'consult' => (bool) get_sub_field('is_consult_tab'),
            'open'    => (bool) get_sub_field('is_open_default'),
        ];
    }
}
if (!$tabs) $tabs = $d['tabs'];

$tabs = array_values(array_filter($tabs, function ($t) { return !empty($t['title']); }));
if (!$tabs) return;

$open = -1;
foreach ($tabs as $i => $t) {
    if ($t['open']) { $open = $i; break; }
}
$uid = 'ds-aec-path-' . wp_unique_id();
?>
<section class="ds-section ds-aec-path">
    <div class="ds-container ds-container--narrow">
        <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>

        <div class="ds-aec-path__list" data-aec-accordion>
            <?php foreach ($tabs as $i => $t) :
                $is_open   = $i === $open;
                $btn_id    = $uid . '-btn-' . $i;
                $panel_id  = $uid . '-panel-' . $i;
                $default   = $t['consult'] ? __('Book A Consult', 'digitalstride') : '';
                $cta       = ds_aec_link($t['link'], $default);
                $cta_label = $t['label'] ?: ($cta['title'] ?? '');
                ?>
                <div class="ds-aec-path__item<?php echo $is_open ? ' is-open' : ''; ?><?php echo $t['consult'] ? ' ds-aec-path__item--consult' : ''; ?>">
                    <h3 class="ds-aec-path__heading">
                        <button type="button" class="ds-aec-path__toggle" id="<?php echo esc_attr($btn_id); ?>"
                            aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr($panel_id); ?>">
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
                                        <a href="<?php echo esc_url($cta['url']); ?>"
                                            class="ds-btn <?php echo $t['consult'] ? 'ds-btn--primary' : 'ds-btn--outline'; ?> ds-aec-path__btn"<?php ds_aec_target_attrs($cta['target']); ?>>
                                            <?php echo esc_html($cta_label); ?><?php if (!$t['consult']) : ?> <span aria-hidden="true">&rarr;</span><?php endif; ?>
                                        </a>
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
