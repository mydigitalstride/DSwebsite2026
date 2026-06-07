<?php
/**
 * Flex Layout: Feature Strip
 * 4-column row of icon + title + short description. Appears at bottom of pages.
 * Used on: Home, Who We Serve, Service Overview, About Us
 */
?>

<?php if (have_rows('features')) : ?>
<section class="ds-section ds-section--features">
    <div class="ds-container">
        <div class="ds-grid ds-grid--4">
            <?php while (have_rows('features')) : the_row(); ?>
                <div class="ds-feature-card">
                    <?php $icon = get_sub_field('icon'); $icon_color = get_sub_field('icon_color'); ?>
                    <?php if ($icon) : ?>
                        <div class="ds-feature-card__icon <?php echo $icon_color ? 'ds-icon--' . esc_attr($icon_color) : ''; ?>"><?php echo ds_inline_svg($icon); ?></div>
                    <?php endif; ?>
                    <h3 class="ds-feature-card__title"><?php echo esc_html(get_sub_field('title')); ?></h3>
                    <p class="ds-feature-card__text"><?php echo esc_html(get_sub_field('description')); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>
