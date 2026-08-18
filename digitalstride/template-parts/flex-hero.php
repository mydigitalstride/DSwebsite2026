<?php
/**
 * Flex Layout: Hero
 * Split hero: left side has gradient background with text content,
 * right side has an auto-rotating image/video carousel spanning full height.
 * Falls back to full-width text hero when no carousel slides are set.
 */
$heading    = get_sub_field('heading');
$subheading = get_sub_field('subheading');
$text       = get_sub_field('body_text');
$cta        = get_sub_field('cta_button');
$bg         = get_sub_field('background_image');
$slides     = get_sub_field('carousel_images');
$has_carousel = !empty($slides) && is_array($slides);
?>

<section class="ds-hero <?php echo $has_carousel ? 'ds-hero--split' : ''; ?>"<?php if ($bg) : ?> style="background-image:url(<?php echo esc_url($bg['url']); ?>)"<?php endif; ?>>
    <div class="ds-hero__overlay"></div>
    <div class="ds-container ds-hero__inner">
        <div class="ds-hero__content">
            <?php if ($subheading || $heading) : ?>
                <div class="ds-hero__title-block">
                    <div class="ds-hero__accent-line"></div>
                    <div class="ds-hero__title-text">
                        <?php if ($subheading) : ?>
                            <p class="ds-hero__subheading"><?php echo esc_html($subheading); ?></p>
                        <?php endif; ?>
                        <?php if ($heading) : ?>
                            <h1 class="ds-hero__heading"><?php echo esc_html($heading); ?></h1>
                        <?php endif; ?>
                        <?php if ($text) : ?>
                            <div class="ds-hero__text"><?php echo wp_kses_post($text); ?></div>
                        <?php endif; ?>
                        <?php if ($cta) : ?>
                            <a href="<?php echo esc_url($cta['url']); ?>" class="ds-btn ds-btn--primary ds-btn--hero"><?php echo esc_html($cta['title']); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($has_carousel) : ?>
            <?php ds_render_media_carousel($slides, ['label' => 'Hero media carousel']); ?>
        <?php endif; ?>

    </div>
</section>
