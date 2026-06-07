<?php
/**
 * Template Part: Partners Logo Grid
 */
$heading = get_field('partners_heading') ?: 'OUR PARTNERS';
?>

<?php if (have_rows('partner_logos')) : ?>
<section class="ds-section ds-section--partners">
    <div class="ds-container">
        <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <div class="ds-logo-grid">
            <?php while (have_rows('partner_logos')) : the_row(); ?>
                <?php $logo = get_sub_field('logo'); ?>
                <?php if ($logo) : ?>
                    <div class="ds-logo-grid__item">
                        <?php $link = get_sub_field('link'); ?>
                        <?php if ($link) : ?>
                            <a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener">
                        <?php endif; ?>
                            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
                        <?php if ($link) : ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>
