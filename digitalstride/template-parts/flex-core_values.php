<?php
/**
 * Flex Layout: Core Values
 * Accordion-style list of company values with expandable descriptions.
 * Used on: Home, About Us
 */
$heading = get_sub_field('heading');
$link    = get_sub_field('link');
?>

<section class="ds-section ds-section--values">
    <div class="ds-container">
        <div class="ds-values-layout">
            <div class="ds-values-layout__left">
                <?php if ($heading) : ?>
                    <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
                <?php endif; ?>
                <?php if ($link) : ?>
                    <a href="<?php echo esc_url($link['url']); ?>" class="ds-btn ds-btn--primary"><?php echo esc_html($link['title']); ?></a>
                <?php endif; ?>
            </div>
            <div class="ds-values-layout__right">
                <?php if (have_rows('values')) : ?>
                    <div class="ds-accordion">
                        <?php while (have_rows('values')) : the_row(); ?>
                            <div class="ds-accordion__item">
                                <button class="ds-accordion__header" aria-expanded="false">
                                    <span><?php echo esc_html(get_sub_field('title')); ?></span>
                                    <i class="fa-solid fa-chevron-down ds-accordion__chevron"></i>
                                </button>
                                <div class="ds-accordion__body">
                                    <?php echo wp_kses_post(get_sub_field('description')); ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
