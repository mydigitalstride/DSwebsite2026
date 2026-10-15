<?php
/**
 * DSD: Hero (group_dsd_hero).
 *
 * The site split hero: brand gradient over the blueprint background, orange
 * accent line, italic eyebrow, headline, text and CTA on the left; a light
 * panel with the DSD logo on the right. Without an uploaded `hero_logo` the
 * panel shows a DSD wordmark.
 */
$d        = ds_dsd_defaults('hero');
$eyebrow  = get_field('hero_eyebrow') ?: $d['eyebrow'];
$title    = get_field('hero_title') ?: $d['title'];
$subtitle = get_field('hero_subtitle') ?: $d['subtitle'];
$label    = get_field('hero_cta_label');
$link     = ds_aec_link(get_field('hero_cta_url'), $label ?: $d['cta_label']) ?: ['url' => $d['cta_url'], 'title' => $d['cta_label'], 'target' => ''];
$label    = $label ?: $link['title'];
$logo     = get_field('hero_logo');
$bg       = get_field('hero_background_image');

$title_tags = ['br' => [], 'em' => [], 'strong' => [], 'span' => ['class' => []]];
?>
<section class="ds-hero ds-hero--split ds-dsd-hero"<?php if (!empty($bg['url'])) : ?> style="background-image:url(<?php echo esc_url($bg['url']); ?>)"<?php endif; ?>>
    <div class="ds-hero__overlay"></div>
    <div class="ds-container ds-hero__inner">
        <div class="ds-hero__content">
            <div class="ds-hero__title-block">
                <div class="ds-hero__accent-line"></div>
                <div class="ds-hero__title-text">
                    <?php if ($eyebrow) : ?>
                        <p class="ds-hero__subheading ds-dsd-hero__eyebrow"><?php echo esc_html($eyebrow); ?></p>
                    <?php endif; ?>
                    <h1 class="ds-hero__heading ds-dsd-hero__title"><?php echo wp_kses($title, $title_tags); ?></h1>
                    <?php if ($subtitle) : ?>
                        <div class="ds-hero__text ds-dsd-hero__text"><?php echo wp_kses_post(wpautop($subtitle)); ?></div>
                    <?php endif; ?>
                    <?php if ($label && $link['url']) : ?>
                        <a href="<?php echo esc_url($link['url']); ?>" class="ds-btn ds-btn--primary ds-btn--hero"<?php ds_aec_target_attrs($link['target']); ?>><?php echo esc_html($label); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="ds-dsd-hero__panel">
            <?php if (!empty($logo['url'])) : ?>
                <img class="ds-dsd-hero__logo" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?: __('Digital Stride Dashboard (DSD)', 'digitalstride')); ?>">
            <?php else : ?>
                <svg class="ds-dsd-hero__logo" viewBox="0 0 240 170" role="img" aria-label="<?php esc_attr_e('Digital Stride Dashboard (DSD)', 'digitalstride'); ?>" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="ds-dsd-logo-grad" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#051879"/>
                            <stop offset="100%" stop-color="#0993BF"/>
                        </linearGradient>
                    </defs>
                    <g fill="none" stroke-width="13" stroke-linejoin="round">
                        <rect x="71" y="16" width="46" height="46" rx="10" transform="rotate(45 94 39)" stroke="#1D4382"/>
                        <rect x="123" y="16" width="46" height="46" rx="10" transform="rotate(45 146 39)" stroke="#0993BF"/>
                    </g>
                    <text x="120" y="150" text-anchor="middle" font-family="'Josefin Sans', sans-serif" font-size="74" font-weight="700" font-style="italic" fill="url(#ds-dsd-logo-grad)">DSD</text>
                </svg>
            <?php endif; ?>
        </div>
    </div>
</section>
