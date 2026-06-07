<?php
/**
 * Flex Layout: Community Logos
 * Scrolling carousel of organization/membership logos with center-scale effect.
 */
$heading = get_sub_field('heading');
$text    = get_sub_field('text');
?>

<section class="ds-section ds-section--community">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($text) : ?>
            <p class="ds-section__text ds-section__text--center"><?php echo esc_html($text); ?></p>
        <?php endif; ?>
        <?php if (have_rows('logos')) : ?>
            <div class="ds-logo-carousel">
                <div class="ds-logo-carousel__track">
                    <?php while (have_rows('logos')) : the_row(); ?>
                        <?php $logo = get_sub_field('logo'); ?>
                        <?php if ($logo) : ?>
                            <div class="ds-logo-carousel__slide">
                                <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
                            </div>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
