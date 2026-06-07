<?php
/**
 * Flex Layout: FAQ
 * Accordion of question/answer pairs.
 * Used on: Contact Us, Landing Page
 */
$heading = get_sub_field('heading');
?>

<section class="ds-section ds-section--faq">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if (have_rows('questions')) : ?>
            <div class="ds-accordion">
                <?php while (have_rows('questions')) : the_row(); ?>
                    <div class="ds-accordion__item">
                        <button class="ds-accordion__header" aria-expanded="false">
                            <span><?php echo esc_html(get_sub_field('question')); ?></span>
                            <i class="fa-solid fa-chevron-down ds-accordion__chevron"></i>
                        </button>
                        <div class="ds-accordion__body">
                            <?php echo wp_kses_post(get_sub_field('answer')); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
