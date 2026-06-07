<?php
/**
 * Flex Layout: Stats Bar
 * Row of 4 icon-boxes showing key metrics (e.g. "10 Years", "10,000+ Conversions").
 * Used on: Home, Who We Serve, Service Overview
 */
$heading = get_sub_field('heading');
?>

<section class="ds-section ds-section--stats">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if (have_rows('stats')) : ?>
            <div class="ds-stats">
                <?php while (have_rows('stats')) : the_row(); ?>
                    <div class="ds-stat">
                        <?php $icon = get_sub_field('icon'); $icon_color = get_sub_field('icon_color'); ?>
                        <?php if ($icon) : ?>
                            <div class="ds-stat__icon <?php echo $icon_color ? 'ds-icon--' . esc_attr($icon_color) : ''; ?>"><?php echo ds_inline_svg($icon); ?></div>
                        <?php endif; ?>
                        <div class="ds-stat__value"><?php echo esc_html(get_sub_field('value')); ?></div>
                        <div class="ds-stat__label"><?php echo esc_html(get_sub_field('label')); ?></div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
