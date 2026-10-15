<?php
/**
 * DSD: Tailored Industry Solutions (group_dsd_industries).
 *
 * Three sector tabs (gradient-bordered buttons; the active one turns
 * orange) over one panel per sector: a title, a line of text and three
 * feature tiles with orange gradient icons. dsd.js switches the tabs;
 * without JS every panel is listed.
 */
$d     = ds_dsd_defaults('industries');
$tag   = get_field('ind_eyebrow') ?: $d['eyebrow'];
$title = get_field('ind_headline') ?: $d['headline'];
$sub   = get_field('ind_subheadline') ?: $d['subheadline'];
$cards = ds_dsd_rows('ind_cards', $d['cards'], ['industry_title', 'panel_title']);
if (!$cards) return;

$icon_fallback = array_merge(...array_map(function ($c) { return array_column($c['feature_points'], 'point_icon'); }, $d['cards']));
?>
<section class="ds-section ds-dsd-industries" aria-labelledby="dsd-ind-title" data-dsd-tabs>
    <div class="ds-container">
        <div class="ds-dsd-head">
            <?php if ($tag) : ?><p class="ds-dsd-tag"><?php echo esc_html($tag); ?></p><?php endif; ?>
            <h2 class="ds-section__heading ds-section__heading--center" id="dsd-ind-title"><?php echo esc_html($title); ?></h2>
            <?php if ($sub) : ?><p class="ds-dsd-head__text"><?php echo esc_html($sub); ?></p><?php endif; ?>
        </div>

        <div class="ds-dsd-ind__tabs" role="tablist" aria-label="<?php esc_attr_e('Choose your sector', 'digitalstride'); ?>">
            <?php foreach ($cards as $i => $card) : ?>
                <button type="button" class="ds-dsd-ind__tab<?php echo $i === 0 ? ' is-active' : ''; ?>" role="tab" id="dsd-ind-tab-<?php echo $i; ?>" aria-controls="dsd-ind-panel-<?php echo $i; ?>" aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>" tabindex="<?php echo $i === 0 ? '0' : '-1'; ?>">
                    <?php echo esc_html($card['industry_title'] ?: $card['panel_title']); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <?php foreach ($cards as $i => $card) :
            $points = array_values(array_filter((array) ($card['feature_points'] ?? []), function ($p) { return !empty($p['point']) || !empty($p['point_desc']); }));
            ?>
            <div class="ds-dsd-ind__panel" role="tabpanel" id="dsd-ind-panel-<?php echo $i; ?>" aria-labelledby="dsd-ind-tab-<?php echo $i; ?>">
                <h3 class="ds-dsd-ind__title"><?php echo esc_html($card['panel_title'] ?: $card['industry_title']); ?></h3>
                <?php if (!empty($card['industry_desc'])) : ?><p class="ds-dsd-ind__desc"><?php echo esc_html($card['industry_desc']); ?></p><?php endif; ?>
                <?php if ($points) : ?>
                    <ul class="ds-dsd-ind__tiles">
                        <?php foreach ($points as $j => $p) :
                            $icon = !empty($p['point_icon']) ? $p['point_icon'] : ($icon_fallback[($i * 3 + $j) % count($icon_fallback)] ?? 'fa-solid fa-circle-check');
                            ?>
                            <li class="ds-dsd-ind__tile">
                                <h4 class="ds-dsd-ind__tile-title"><span class="ds-dsd-ind__tile-icon" aria-hidden="true"><i class="<?php echo esc_attr($icon); ?>"></i></span><?php echo esc_html($p['point'] ?? ''); ?></h4>
                                <?php if (!empty($p['point_desc'])) : ?><p><?php echo esc_html($p['point_desc']); ?></p><?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
