<?php
/**
 * Flex Layout: Split Content
 * Left: image. Right: heading + accent + rich body text + optional CTA.
 * Flip option swaps image to the right.
 * Optional background image with gradient overlay.
 */
$heading  = get_sub_field('heading');
$content  = get_sub_field('body_content');
$image    = get_sub_field('image');
$cta      = get_sub_field('cta_button');
$bg       = get_sub_field('background_image');
$flip     = get_sub_field('flip_layout');
?>

<section class="ds-section ds-section--split-content"
    <?php if ($bg) : ?>style="background-image: url(<?php echo esc_url($bg['url']); ?>); background-size: cover; background-position: center;"<?php endif; ?>>

    <?php if ($bg) : ?><div class="ds-split-content__overlay"></div><?php endif; ?>

    <div class="ds-container ds-split-content__inner <?php echo $flip ? 'ds-split-content__inner--flip' : ''; ?>">

        <!-- Image -->
        <?php if ($image) : ?>
            <div class="ds-split-content__image">
                <img src="<?php echo esc_url($image['sizes']['large'] ?? $image['url']); ?>"
                     alt="<?php echo esc_attr($image['alt']); ?>"
                     loading="lazy">
            </div>
        <?php endif; ?>

        <!-- Text -->
        <div class="ds-split-content__text">
            <?php if ($heading) : ?>
                <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
            <?php endif; ?>
            <?php if ($content) : ?>
                <div class="ds-split-content__body"><?php echo wp_kses_post($content); ?></div>
            <?php endif; ?>
            <?php if ($cta) : ?>
                <div class="ds-split-content__cta">
                    <a href="<?php echo esc_url($cta['url']); ?>" class="ds-btn ds-btn--primary"><?php echo esc_html($cta['title']); ?></a>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>
