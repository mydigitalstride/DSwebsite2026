<?php
/**
 * DSD: Hero + perks ribbon (group_dsd_hero).
 *
 * 60/40 split: copy and CTA on the left, a DSD dashboard frame on the right
 * over a blueprint grid. The 4-column glass perks ribbon sits below both.
 * The frame shows a built-in dashboard mock unless `hero_visual` is set.
 */
$d        = ds_dsd_defaults('hero');
$eyebrow  = get_field('hero_eyebrow') ?: $d['eyebrow'];
$title    = get_field('hero_title') ?: $d['title'];
$subtitle = get_field('hero_subtitle') ?: $d['subtitle'];
$label    = get_field('hero_cta_label');
$link     = ds_aec_link(get_field('hero_cta_url'), $label ?: $d['cta_label']) ?: ['url' => $d['cta_url'], 'title' => $d['cta_label'], 'target' => ''];
$label    = $label ?: $link['title'];
$visual   = get_field('hero_visual');
$perks    = ds_dsd_rows('hero_perks', $d['perks'], ['title', 'subtitle']);
$perks    = array_slice($perks, 0, 4);
$fa       = array_column($d['perks'], 'fa');

$title_tags = ['br' => [], 'em' => [], 'strong' => [], 'span' => ['class' => []]];
?>
<section class="ds-dsd-hero" aria-labelledby="dsd-hero-title">
    <div class="ds-dsd-hero__grid-bg" aria-hidden="true"></div>
    <div class="ds-container ds-dsd-hero__inner">
        <div class="ds-dsd-hero__copy">
            <?php if ($eyebrow) : ?>
                <p class="ds-dsd-eyebrow"><span class="ds-dsd-eyebrow__dot" aria-hidden="true"></span><?php echo esc_html($eyebrow); ?></p>
            <?php endif; ?>
            <h1 class="ds-dsd-hero__title" id="dsd-hero-title"><?php echo wp_kses($title, $title_tags); ?></h1>
            <?php if ($subtitle) : ?>
                <p class="ds-dsd-hero__subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
            <div class="ds-dsd-hero__actions">
                <?php if ($label && $link['url']) : ?>
                    <a href="<?php echo esc_url($link['url']); ?>" class="ds-btn ds-btn--primary"<?php ds_aec_target_attrs($link['target']); ?>><?php echo esc_html($label); ?></a>
                <?php endif; ?>
                <a href="#dsd-simulator" class="ds-dsd-hero__demo-link"><i class="fa-solid fa-circle-play" aria-hidden="true"></i> <?php esc_html_e('Try the live demo', 'digitalstride'); ?></a>
            </div>
        </div>

        <div class="ds-dsd-hero__visual">
            <div class="ds-dsd-frame">
                <div class="ds-dsd-frame__bar" aria-hidden="true">
                    <span class="ds-dsd-frame__dots"><i></i><i></i><i></i></span>
                    <span class="ds-dsd-frame__brand"><strong>DSD</strong> Digital Stride Dashboard</span>
                    <span class="ds-dsd-frame__live">Live</span>
                </div>
                <?php if (!empty($visual['url'])) : ?>
                    <img class="ds-dsd-frame__img" src="<?php echo esc_url($visual['url']); ?>" alt="<?php echo esc_attr($visual['alt'] ?? ''); ?>" width="<?php echo (int) ($visual['width'] ?? 0); ?>" height="<?php echo (int) ($visual['height'] ?? 0); ?>">
                <?php else : ?>
                    <div class="ds-dsd-frame__body" role="img" aria-label="<?php esc_attr_e('Preview of the Digital Stride Dashboard showing leads, recorded calls, cost per lead and revenue pipeline.', 'digitalstride'); ?>">
                        <div class="ds-dsd-frame__kpis" aria-hidden="true">
                            <div class="ds-dsd-kpi"><span>Leads Today</span><strong>27</strong><em class="is-up">+18%</em></div>
                            <div class="ds-dsd-kpi"><span>Calls Recorded</span><strong>41</strong><em class="is-up">+9%</em></div>
                            <div class="ds-dsd-kpi"><span>Cost / Lead</span><strong>$38</strong><em class="is-down">−12%</em></div>
                            <div class="ds-dsd-kpi ds-dsd-kpi--hl"><span>Pipeline</span><strong>$124.5k</strong><em class="is-up">+31%</em></div>
                        </div>
                        <div class="ds-dsd-frame__chart" aria-hidden="true">
                            <?php foreach ([38, 52, 44, 63, 58, 72, 66, 84, 78, 92, 88, 100] as $h) : ?>
                                <span style="--h:<?php echo (int) $h; ?>%"></span>
                            <?php endforeach; ?>
                        </div>
                        <div class="ds-dsd-frame__toast" aria-hidden="true">
                            <i class="fa-solid fa-phone-volume"></i>
                            <span><strong>New call · LSA</strong> Emergency AC repair · $1,200</span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if ($perks) : ?>
        <div class="ds-container">
            <ul class="ds-dsd-perks">
                <?php foreach ($perks as $i => $perk) :
                    $icon = $perk['icon'] ?? null;
                    $icon_class = !empty($perk['fa']) ? $perk['fa'] : ($fa[$i] ?? 'fa-solid fa-check');
                    ?>
                    <li class="ds-dsd-perk">
                        <span class="ds-dsd-perk__icon" aria-hidden="true">
                            <?php if (!empty($icon['url'])) : ?>
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="" width="28" height="28">
                            <?php else : ?>
                                <i class="<?php echo esc_attr($icon_class); ?>"></i>
                            <?php endif; ?>
                        </span>
                        <span class="ds-dsd-perk__text">
                            <?php if (!empty($perk['title'])) : ?><strong><?php echo esc_html($perk['title']); ?></strong><?php endif; ?>
                            <?php if (!empty($perk['subtitle'])) : ?><span><?php echo esc_html($perk['subtitle']); ?></span><?php endif; ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</section>
