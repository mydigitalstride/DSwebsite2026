<?php
/**
 * Flex Layout: Pain Point Cards
 * 3-column grid of pain point cards with icon, title, description.
 * Used on: Who We Serve
 */
$heading = get_sub_field('heading');
?>

<section class="ds-section ds-section--pain-points">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if (have_rows('industries')) : ?>
            <div class="ds-grid ds-grid--3">
                <?php while (have_rows('industries')) : the_row(); ?>
                    <div class="ds-card">
                        <?php $icon = get_sub_field('icon'); $icon_color = get_sub_field('icon_color'); ?>
                        <?php if ($icon) : ?>
                            <div class="ds-card__icon <?php echo $icon_color ? 'ds-icon--' . esc_attr($icon_color) : ''; ?>"><?php echo ds_inline_svg($icon); ?></div>
                        <?php endif; ?>
                        <h3 class="ds-card__title"><?php echo esc_html(get_sub_field('title')); ?></h3>
                        <p class="ds-card__text"><?php echo esc_html(get_sub_field('description')); ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
