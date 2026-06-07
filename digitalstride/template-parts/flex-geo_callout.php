<?php
/**
 * Flex Layout: Geographic Callout
 * Left: region outline image (PNG) layered over a teal radial glow.
 * Right: heading + accent line + body text.
 */
$heading = get_sub_field('heading');
$text    = get_sub_field('text');
$image   = get_sub_field('image');
?>

<section class="ds-section ds-section--geo ds-geo">
    <div class="ds-container ds-geo__inner">

        <!-- Left: glow + map image -->
        <div class="ds-geo__visual">
            <div class="ds-geo__glow"></div>
            <?php if ($image) : ?>
                <img class="ds-geo__map" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: 'Service area map'); ?>">
            <?php endif; ?>
        </div>

        <!-- Right: text -->
        <div class="ds-geo__content">
            <?php if ($heading) : ?>
                <h3 class="ds-section__heading"><?php echo esc_html($heading); ?></h3>
            <?php endif; ?>
            <?php if ($text) : ?>
                <p class="ds-geo__text"><?php echo nl2br(esc_html($text)); ?></p>
            <?php endif; ?>
        </div>

    </div>
</section>
