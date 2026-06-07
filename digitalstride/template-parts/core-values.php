<?php
/**
 * Template Part: Core Values
 */
$heading = get_field('values_heading') ?: 'OUR CORE VALUES';
$link    = get_field('values_link');
?>

<?php if (have_rows('core_values')) : ?>
<section class="ds-section ds-section--values">
    <div class="ds-container">
        <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>

        <?php if ($link) : ?>
            <a href="<?php echo esc_url($link['url']); ?>" class="ds-section__link"><?php echo esc_html($link['title']); ?></a>
        <?php endif; ?>

        <div class="ds-values-grid">
            <?php while (have_rows('core_values')) : the_row(); ?>
                <div class="ds-value">
                    <?php $icon = get_sub_field('icon'); ?>
                    <?php if ($icon) : ?>
                        <div class="ds-value__icon">
                            <img src="<?php echo esc_url($icon['url']); ?>" alt="">
                        </div>
                    <?php endif; ?>
                    <p class="ds-value__text"><?php echo esc_html(get_sub_field('value_text')); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>
