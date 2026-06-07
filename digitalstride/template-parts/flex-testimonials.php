<?php
/**
 * Flex Layout: Testimonials — single-slide carousel
 * One large quote card visible at a time, prev/next arrows, dot indicators.
 */
$heading = get_sub_field('heading');

$items = [];
if (have_rows('testimonials')) :
    while (have_rows('testimonials')) : the_row();
        $items[] = [
            'quote'         => get_sub_field('quote'),
            'name'          => get_sub_field('name'),
            'title_company' => get_sub_field('title_company'),
        ];
    endwhile;
endif;
?>

<section class="ds-section ds-section--testimonials">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if ($items) : ?>
            <div class="ds-testimonial-carousel" aria-label="Client testimonials">

                <div class="ds-testimonial-carousel__track">
                    <?php foreach ($items as $i => $item) : ?>
                        <div class="ds-testimonial-carousel__slide <?php echo $i === 0 ? 'is-active' : ''; ?>" aria-hidden="<?php echo $i === 0 ? 'false' : 'true'; ?>">
                            <div class="ds-testimonial">
                                <span class="ds-testimonial__mark">&ldquo;</span>
                                <blockquote class="ds-testimonial__quote"><?php echo esc_html($item['quote']); ?></blockquote>
                                <div class="ds-testimonial__author">
                                    <strong><?php echo esc_html($item['name']); ?></strong>
                                    <?php if ($item['title_company']) : ?>
                                        <span><?php echo esc_html($item['title_company']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if (count($items) > 1) : ?>
                    <button class="ds-testimonial-carousel__btn ds-testimonial-carousel__btn--prev" aria-label="Previous testimonial">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="ds-testimonial-carousel__btn ds-testimonial-carousel__btn--next" aria-label="Next testimonial">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>

                    <div class="ds-testimonial-carousel__dots" aria-hidden="true">
                        <?php foreach ($items as $i => $item) : ?>
                            <button class="ds-testimonial-carousel__dot <?php echo $i === 0 ? 'is-active' : ''; ?>" data-slide="<?php echo $i; ?>"></button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>
    </div>
</section>
