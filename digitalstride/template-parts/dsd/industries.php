<?php
/**
 * DSD: Tailored Industry Solutions (group_dsd_industries).
 *
 * Three cards, one per target market, each with its own feature points.
 */
$d     = ds_dsd_defaults('industries');
$title = get_field('ind_headline') ?: $d['headline'];
$sub   = get_field('ind_subheadline') ?: $d['subheadline'];
$cards = ds_dsd_rows('ind_cards', $d['cards'], ['industry_title', 'industry_desc']);
$icons = array_column($d['cards'], 'industry_icon');
if (!$cards) return;
?>
<section class="ds-section ds-dsd-industries" aria-labelledby="dsd-ind-title">
    <div class="ds-container">
        <div class="ds-dsd-section-head">
            <h2 class="ds-section__heading ds-section__heading--center" id="dsd-ind-title"><?php echo esc_html($title); ?></h2>
            <?php if ($sub) : ?><p class="ds-dsd-section-head__sub"><?php echo esc_html($sub); ?></p><?php endif; ?>
        </div>

        <ul class="ds-dsd-industries__grid">
            <?php foreach ($cards as $i => $card) :
                $icon   = !empty($card['industry_icon']) ? $card['industry_icon'] : ($icons[$i % count($icons)] ?? 'fa-solid fa-briefcase');
                $points = array_filter((array) ($card['feature_points'] ?? []), function ($p) { return !empty($p['point']); });
                ?>
                <li class="ds-dsd-ind">
                    <span class="ds-dsd-ind__icon" aria-hidden="true"><i class="<?php echo esc_attr($icon); ?>"></i></span>
                    <?php if (!empty($card['industry_title'])) : ?><h3 class="ds-dsd-ind__title"><?php echo esc_html($card['industry_title']); ?></h3><?php endif; ?>
                    <?php if (!empty($card['industry_desc'])) : ?><p class="ds-dsd-ind__desc"><?php echo esc_html($card['industry_desc']); ?></p><?php endif; ?>
                    <?php if ($points) : ?>
                        <ul class="ds-dsd-ind__points">
                            <?php foreach ($points as $point) : ?>
                                <li><i class="fa-solid fa-circle-check" aria-hidden="true"></i><?php echo esc_html($point['point']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
