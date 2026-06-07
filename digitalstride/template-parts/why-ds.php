<?php
/**
 * Template Part: Why Digital Stride Stats
 */
$heading = get_field('stats_heading') ?: 'WHY DIGITAL STRIDE';
?>

<?php if (have_rows('stats')) : ?>
<section class="ds-section ds-section--stats">
    <div class="ds-container">
        <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <div class="ds-stats">
            <?php while (have_rows('stats')) : the_row(); ?>
                <div class="ds-stat">
                    <?php $icon = get_sub_field('icon'); ?>
                    <?php if ($icon) : ?>
                        <div class="ds-stat__icon">
                            <img src="<?php echo esc_url($icon['url']); ?>" alt="">
                        </div>
                    <?php endif; ?>
                    <div class="ds-stat__value"><?php echo esc_html(get_sub_field('value')); ?></div>
                    <div class="ds-stat__label"><?php echo esc_html(get_sub_field('label')); ?></div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>
