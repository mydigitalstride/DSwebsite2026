<?php
/**
 * ECHO SEO: Hero (hero_* fields).
 *
 * The landing-page hero, exactly as on the Home Services page
 * (template-parts/home-services/hero.php, aec-landing.css): dark navy
 * overlay over the background photo, orange accent line, italic tag,
 * headline, text and the primary hero button.
 */
$d     = ds_echos_defaults('hero');
$kick  = get_field('hero_kicker') ?: $d['kicker'];
$title = get_field('hero_headline') ?: $d['headline'];
$text  = get_field('hero_subheadline') ?: $d['subheadline'];
$btn   = ds_echos_button('hero_button', $d['button']);
$bg    = get_field('hero_background_image');

$title_tags = ['br' => [], 'em' => [], 'strong' => [], 'span' => ['class' => []]];
?>
<section class="ds-hero ds-aec-hero ds-echos-hero">
    <?php echo ds_hero_bg_img($bg ?: null); ?>
    <div class="ds-hero__overlay"></div>
    <div class="ds-container ds-hero__inner">
        <div class="ds-hero__content">
            <div class="ds-hero__title-block">
                <div class="ds-hero__accent-line"></div>
                <div class="ds-hero__title-text">
                    <?php if ($kick) : ?>
                        <p class="ds-hero__subheading ds-aec-hero__tag"><?php echo esc_html($kick); ?></p>
                    <?php endif; ?>
                    <h1 class="ds-hero__heading"><?php echo wp_kses($title, $title_tags); ?></h1>
                    <?php if ($text) : ?>
                        <div class="ds-hero__text"><?php echo wp_kses_post(wpautop($text)); ?></div>
                    <?php endif; ?>
                    <?php if ($btn) : ?>
                        <div class="ds-aec-hero__buttons">
                            <?php ds_echos_print_button($btn, 'ds-btn ds-btn--primary ds-btn--hero'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
