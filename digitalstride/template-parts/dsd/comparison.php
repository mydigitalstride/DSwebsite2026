<?php
/**
 * DSD: The Digital Stride Difference (group_dsd_comparison).
 *
 * Italic eyebrow, heading with the orange bar, intro, then two slate cards:
 * traditional agencies (red label, red crosses) and Digital Stride + DSD
 * (blue label, "Included Free" badge, checks in the site's blue gradient).
 * Each point is a bold title with a short description.
 */
$d     = ds_dsd_defaults('comparison');
$f     = function ($name, $key) use ($d) { return get_field($name) ?: $d[$key]; };
$bad   = ds_dsd_rows('traditional_agency_list', $d['traditional'], ['item', 'item_desc']);
$good  = ds_dsd_rows('dsd_agency_list', $d['dsd'], ['item', 'item_desc']);
$tag   = $f('comp_eyebrow', 'eyebrow');
$sub   = $f('comp_subheadline', 'subheadline');
$badge = $f('comp_dsd_badge', 'dsd_badge');
if (!$bad && !$good) return;

$cards = [
    ['mod' => 'old', 'title' => $f('comp_traditional_title', 'traditional_title'), 'rows' => $bad, 'sr' => __('Drawback:', 'digitalstride')],
    ['mod' => 'dsd', 'title' => $f('comp_dsd_title', 'dsd_title'), 'rows' => $good, 'sr' => __('Included:', 'digitalstride')],
];
?>
<section class="ds-section ds-dsd-compare" aria-labelledby="dsd-compare-title">
    <div class="ds-container">
        <div class="ds-dsd-head">
            <?php if ($tag) : ?><p class="ds-dsd-tag"><?php echo esc_html($tag); ?></p><?php endif; ?>
            <h2 class="ds-section__heading ds-section__heading--center" id="dsd-compare-title"><?php echo esc_html($f('comp_headline', 'headline')); ?></h2>
            <?php if ($sub) : ?><p class="ds-dsd-head__text"><?php echo esc_html($sub); ?></p><?php endif; ?>
        </div>

        <div class="ds-dsd-compare__grid">
            <?php foreach ($cards as $card) : ?>
                <div class="ds-dsd-compare__card ds-dsd-compare__card--<?php echo esc_attr($card['mod']); ?>">
                    <?php if ($card['mod'] === 'dsd' && $badge) : ?><span class="ds-dsd-compare__badge"><?php echo esc_html($badge); ?></span><?php endif; ?>
                    <h3 class="ds-dsd-compare__label"><?php echo esc_html($card['title']); ?></h3>
                    <ul class="ds-dsd-compare__list">
                        <?php foreach ($card['rows'] as $row) : ?>
                            <li>
                                <?php if ($card['mod'] === 'dsd') : ?>
                                    <svg class="ds-dsd-compare__icon" viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><circle cx="12" cy="12" r="12" fill="url(#ds-gradient-blue)"/><path d="M7 12.5l3.2 3.2L17 9" fill="none" stroke="#F2F5FB" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <?php else : ?>
                                    <svg class="ds-dsd-compare__icon" viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><circle cx="12" cy="12" r="12" fill="#C8372D"/><path d="M8 8l8 8M16 8l-8 8" fill="none" stroke="#1d2537" stroke-width="2.4" stroke-linecap="round"/></svg>
                                <?php endif; ?>
                                <div>
                                    <?php if (!empty($row['item'])) : ?><strong><span class="screen-reader-text"><?php echo esc_html($card['sr']); ?> </span><?php echo esc_html($row['item']); ?></strong><?php endif; ?>
                                    <?php if (!empty($row['item_desc'])) : ?><span><?php echo esc_html($row['item_desc']); ?></span><?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
