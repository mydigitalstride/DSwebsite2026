<?php
/**
 * Flex Layout: Partner Logos
 * Scrolling carousel of partner/client logos with center-scale effect.
 */
$heading = get_sub_field('heading');
?>

<section class="ds-section ds-section--partners">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if (have_rows('logos')) : ?>
            <div class="ds-logo-carousel">
                <div class="ds-logo-carousel__track">
                    <?php while (have_rows('logos')) : the_row(); ?>
                        <?php $logo = get_sub_field('logo'); ?>
                        <?php if ($logo) : ?>
                            <div class="ds-logo-carousel__slide">
                                <?php $link = get_sub_field('link'); ?>
                                <?php if ($link) : ?><a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener"><?php endif; ?>
                                    <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
                                <?php if ($link) : ?></a><?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
