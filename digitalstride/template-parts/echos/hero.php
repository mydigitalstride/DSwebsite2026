<?php
/**
 * ECHO SEO: Hero (hero_* fields).
 *
 * The site hero, exactly as on the service pages (flex-hero.php): brand
 * gradient over the background image, orange accent line, italic
 * subheading, headline, text and the primary hero button.
 */
$d     = ds_echos_defaults('hero');
$kick  = get_field('hero_kicker') ?: $d['kicker'];
$title = get_field('hero_headline') ?: $d['headline'];
$text  = get_field('hero_subheadline') ?: $d['subheadline'];
$btn   = ds_echos_button('hero_button', $d['button']);
$bg    = get_field('hero_background_image');

$title_tags = ['br' => [], 'em' => [], 'strong' => [], 'span' => ['class' => []]];
?>
<section class="ds-hero ds-echos-hero"<?php if (!empty($bg['url'])) : ?> style="background-image:url(<?php echo esc_url($bg['url']); ?>)"<?php endif; ?>>
    <div class="ds-hero__overlay"></div>
    <div class="ds-container ds-hero__inner">
        <div class="ds-hero__content">
            <div class="ds-hero__title-block">
                <div class="ds-hero__accent-line"></div>
                <div class="ds-hero__title-text">
                    <?php if ($kick) : ?>
                        <p class="ds-hero__subheading"><?php echo esc_html($kick); ?></p>
                    <?php endif; ?>
                    <h1 class="ds-hero__heading"><?php echo wp_kses($title, $title_tags); ?></h1>
                    <?php if ($text) : ?>
                        <div class="ds-hero__text"><?php echo wp_kses_post(wpautop($text)); ?></div>
                    <?php endif; ?>
                    <?php ds_echos_print_button($btn, 'ds-btn ds-btn--primary ds-btn--hero'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
