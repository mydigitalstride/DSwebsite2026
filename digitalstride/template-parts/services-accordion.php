<?php
/**
 * Template Part: Services Accordion (Home page)
 */
?>

<?php if (have_rows('home_services')) : ?>
<section class="ds-section ds-section--home-services">
    <div class="ds-container">
        <div class="ds-accordion ds-accordion--services">
            <?php while (have_rows('home_services')) : the_row(); ?>
                <div class="ds-accordion__item">
                    <button class="ds-accordion__header" aria-expanded="false">
                        <span class="ds-accordion__title">
                            <?php $icon = get_sub_field('icon'); ?>
                            <?php if ($icon) : ?>
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="" class="ds-accordion__icon-img">
                            <?php endif; ?>
                            <?php echo esc_html(get_sub_field('title')); ?>
                        </span>
                        <i class="fa-solid fa-chevron-down ds-accordion__icon"></i>
                    </button>
                    <div class="ds-accordion__body">
                        <?php if (have_rows('sub_services')) : ?>
                            <div class="ds-grid ds-grid--3">
                                <?php while (have_rows('sub_services')) : the_row(); ?>
                                    <div class="ds-service-card">
                                        <h6 class="ds-service-card__title"><?php echo esc_html(get_sub_field('title')); ?></h6>
                                        <p class="ds-service-card__text"><?php echo esc_html(get_sub_field('description')); ?></p>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($cta = get_sub_field('cta_link')) : ?>
                            <div class="ds-accordion__cta">
                                <a href="<?php echo esc_url($cta['url']); ?>" class="ds-btn ds-btn--outline"><?php echo esc_html($cta['title']); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php endif; ?>
