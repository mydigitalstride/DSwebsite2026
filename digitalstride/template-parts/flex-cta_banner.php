<?php
/**
 * Flex Layout: CTA Banner
 * Call-to-action with heading, text, and 1-2 buttons.
 * Supports optional background image and right-side image carousel.
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
            <div class="ds-hero__carousel" aria-label="Image carousel">
                <div class="ds-hero__carousel-track">
                    <?php foreach ($slides as $i => $slide) : ?>
                        <div class="ds-hero__slide <?php echo $i === 0 ? 'is-active' : ''; ?>" aria-hidden="<?php echo $i === 0 ? 'false' : 'true'; ?>">
                            <?php if (!empty($slide['image'])) : ?>
                                <img src="<?php echo esc_url($slide['image']['url']); ?>"
                                     alt="<?php echo esc_attr($slide['image']['alt'] ?: ($slide['caption'] ?: '')); ?>"
                                     loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>">
                            <?php endif; ?>
                            <?php if (!empty($slide['caption'])) : ?>
                                <p class="ds-hero__slide-caption"><?php echo esc_html($slide['caption']); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (count($slides) > 1) : ?>
                    <div class="ds-hero__carousel-nav">
                        <button class="ds-hero__carousel-btn ds-hero__carousel-btn--prev" aria-label="Previous slide">&#10094;</button>
                        <div class="ds-hero__carousel-dots">
                            <?php foreach ($slides as $i => $slide) : ?>
                                <button class="ds-hero__carousel-dot <?php echo $i === 0 ? 'is-active' : ''; ?>"
                                        aria-label="Go to slide <?php echo $i + 1; ?>"
                                        data-slide="<?php echo $i; ?>"></button>
                            <?php endforeach; ?>
                        </div>
                        <button class="ds-hero__carousel-btn ds-hero__carousel-btn--next" aria-label="Next slide">&#10095;</button>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
