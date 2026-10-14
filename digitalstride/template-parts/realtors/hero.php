<?php
/**
 * Realtors: Hero (hero_* fields). Vertical orange accent beside the title,
 * dark overlay over the background photo (aec-landing.css).
 */
$d     = ds_rlt_defaults('hero');
$tag   = get_field('hero_subheadline') ?: $d['subheadline'];
$title = get_field('hero_headline') ?: $d['headline'];
$text  = get_field('hero_description') ?: $d['description'];
$label = get_field('hero_cta_text') ?: $d['cta_text'];
$url   = get_field('hero_cta_url') ?: $d['cta_url'];
$bg    = get_field('hero_background_image');
?>
<section class="ds-hero ds-aec-hero ds-rlt-hero"<?php if (!empty($bg['url'])) : ?> style="background-image:url(<?php echo esc_url($bg['url']); ?>)"<?php endif; ?>>
    <div class="ds-hero__overlay"></div>
    <div class="ds-container ds-hero__inner">
        <div class="ds-hero__content">
            <div class="ds-hero__title-block">
                <div class="ds-hero__accent-line"></div>
                <div class="ds-hero__title-text">
                    <?php if ($tag) : ?>
                        <p class="ds-hero__subheading ds-aec-hero__tag"><?php echo esc_html($tag); ?></p>
                    <?php endif; ?>
                    <h1 class="ds-hero__heading"><?php echo esc_html($title); ?></h1>
                    <?php if ($text) : ?>
                        <div class="ds-hero__text"><?php echo wp_kses_post(wpautop($text)); ?></div>
                    <?php endif; ?>
                    <?php if ($label && $url) : ?>
                        <div class="ds-aec-hero__buttons">
                            <a href="<?php echo esc_url($url); ?>" class="ds-btn ds-btn--primary ds-btn--hero"><?php echo esc_html($label); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
