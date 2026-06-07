<?php
/**
 * Template Part: Feature Cards (bottom of pages)
 */
$features = get_field('feature_cards', 'option');
if (!$features && !have_rows('feature_cards', 'option')) return;
?>

<section class="ds-section ds-section--features">
    <div class="ds-container">
        <div class="ds-grid ds-grid--4">
            <?php if (have_rows('feature_cards', 'option')) : while (have_rows('feature_cards', 'option')) : the_row(); ?>
                <div class="ds-feature-card">
                    <?php $icon = get_sub_field('icon'); ?>
                    <?php if ($icon) : ?>
                        <div class="ds-feature-card__icon">
                            <img src="<?php echo esc_url($icon['url']); ?>" alt="">
                        </div>
                    <?php endif; ?>
                    <h3 class="ds-feature-card__title"><?php echo esc_html(get_sub_field('title')); ?></h3>
                    <p class="ds-feature-card__text"><?php echo esc_html(get_sub_field('description')); ?></p>
                </div>
            <?php endwhile; endif; ?>
        </div>
    </div>
</section>
