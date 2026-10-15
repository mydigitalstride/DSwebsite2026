<?php
/**
 * DSD: The Digital Stride Difference (group_dsd_comparison).
 *
 * Two cards: traditional agencies (slate, red crosses) vs. Digital Stride
 * with DSD included (glowing border, "Included Free" badge, green checks).
 * Kept to business outcomes; the features themselves are shown in the
 * simulator above.
 */
$d     = ds_dsd_defaults('comparison');
$f     = function ($name, $key) use ($d) { return get_field($name) ?: $d[$key]; };
$bad   = ds_dsd_rows('traditional_agency_list', $d['traditional'], ['item']);
$good  = ds_dsd_rows('dsd_agency_list', $d['dsd'], ['item']);
$sub   = $f('comp_subheadline', 'subheadline');
$badge = $f('comp_dsd_badge', 'dsd_badge');
if (!$bad && !$good) return;
?>
<section class="ds-section ds-dsd-compare" aria-labelledby="dsd-compare-title">
    <div class="ds-container">
        <div class="ds-dsd-section-head">
            <h2 class="ds-section__heading ds-section__heading--center" id="dsd-compare-title"><?php echo esc_html($f('comp_headline', 'headline')); ?></h2>
            <?php if ($sub) : ?><p class="ds-dsd-section-head__sub"><?php echo esc_html($sub); ?></p><?php endif; ?>
        </div>

        <div class="ds-dsd-compare__grid">
            <div class="ds-dsd-compare__card ds-dsd-compare__card--old">
                <h3 class="ds-dsd-compare__title"><?php echo esc_html($f('comp_traditional_title', 'traditional_title')); ?></h3>
                <ul class="ds-dsd-compare__list">
                    <?php foreach ($bad as $row) : ?>
                        <li><i class="fa-solid fa-xmark" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e('Drawback:', 'digitalstride'); ?> </span><?php echo esc_html($row['item']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="ds-dsd-compare__card ds-dsd-compare__card--dsd">
                <?php if ($badge) : ?><span class="ds-dsd-compare__badge"><?php echo esc_html($badge); ?></span><?php endif; ?>
                <h3 class="ds-dsd-compare__title"><?php echo esc_html($f('comp_dsd_title', 'dsd_title')); ?></h3>
                <ul class="ds-dsd-compare__list">
                    <?php foreach ($good as $row) : ?>
                        <li><i class="fa-solid fa-check" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e('Included:', 'digitalstride'); ?> </span><?php echo esc_html($row['item']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
