<?php
/**
 * Template Part: Hero Section
 */
$heading    = get_field('hero_heading');
$subheading = get_field('hero_subheading');
$text       = get_field('hero_text');
$cta        = get_field('hero_cta');
$bg_image   = get_field('hero_background');
$bg_style   = $bg_image ? 'background-image: url(' . esc_url($bg_image['url']) . ');' : '';
?>

<section class="ds-hero" <?php echo $bg_style ? 'style="' . esc_attr($bg_style) . '"' : ''; ?>>
    <div class="ds-hero__overlay"></div>
    <div class="ds-container">
        <div class="ds-hero__content">
            <?php if ($heading) : ?>
                <h1 class="ds-hero__heading"><?php echo esc_html($heading); ?></h1>
            <?php endif; ?>

            <?php if ($subheading) : ?>
                <p class="ds-hero__subheading"><?php echo esc_html($subheading); ?></p>
            <?php endif; ?>

            <?php if ($text) : ?>
                <div class="ds-hero__text"><?php echo wp_kses_post($text); ?></div>
            <?php endif; ?>

            <?php if ($cta) : ?>
                <a href="<?php echo esc_url($cta['url']); ?>" class="ds-btn ds-btn--primary ds-btn--large"><?php echo esc_html($cta['title']); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>
