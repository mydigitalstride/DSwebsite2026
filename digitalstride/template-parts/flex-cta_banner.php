<?php
/**
 * Flex Layout: CTA Banner
 * Call-to-action with heading, text, and 1-2 buttons.
 * Supports optional background image and right-side image/video carousel.
 */
$heading = get_sub_field('heading');
$text    = get_sub_field('text');
$subtext = get_sub_field('subtext');
$btn1    = get_sub_field('primary_button');
$btn2    = get_sub_field('secondary_button');
$bg      = get_sub_field('background_image');
$slides  = get_sub_field('carousel_images');
$has_carousel = !empty($slides) && is_array($slides);
?>

<section class="ds-section ds-section--cta-banner <?php echo $has_carousel ? 'ds-cta-banner--split' : ''; ?>"
    <?php echo $bg ? 'style="background-image:url(' . esc_url($bg['url']) . ');background-size:cover;background-position:center;"' : ''; ?>>

    <?php if ($bg) : ?>
        <div class="ds-cta-banner__overlay"></div>
    <?php endif; ?>

    <div class="ds-container <?php echo $has_carousel ? 'ds-cta-banner__inner' : 'ds-container--narrow'; ?>">
        <div class="ds-cta-banner__content">
            <?php if ($heading) : ?>
                <h2 class="ds-section__heading <?php echo $has_carousel ? '' : 'ds-section__heading--center'; ?>"><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>
            <?php if ($text) : ?>
                <p class="ds-cta-banner__text"><?php echo esc_html($text); ?></p>
            <?php endif; ?>
            <?php if ($subtext) : ?>
                <p class="ds-cta-banner__subtext"><?php echo esc_html($subtext); ?></p>
            <?php endif; ?>
            <div class="ds-cta-buttons">
                <?php if ($btn1) : ?>
                    <a href="<?php echo esc_url($btn1['url']); ?>" class="ds-btn ds-btn--primary"><?php echo esc_html($btn1['title']); ?></a>
                <?php endif; ?>
                <?php if ($btn2) : ?>
                    <a href="<?php echo esc_url($btn2['url']); ?>" class="ds-btn ds-btn--secondary"><?php echo esc_html($btn2['title']); ?></a>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($has_carousel) : ?>
            <?php ds_render_media_carousel($slides, ['label' => 'Media carousel', 'nav' => true]); ?>
        <?php endif; ?>

    </div>
</section>
