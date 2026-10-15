<?php
/**
 * DSD: Partner Feedback (group_dsd_testimonials).
 *
 * Quotes from this page's `testimonials` repeater, or the global
 * testimonials when it is empty (ds_dsd_testimonials()). Uses the site
 * testimonial carousel: arrows, dots and the autoplay pause button come
 * from main.js.
 */
$d     = ds_dsd_defaults('testimonials');
$title = get_field('testimonials_title') ?: $d['title'];
$items = ds_dsd_testimonials();

if (!$items) {
    if (current_user_can('edit_posts')) {
        echo '<!-- DSD Partner Feedback: no testimonials. Add quotes on this page or in Theme Settings > Testimonials. -->';
    }
    return;
}
?>
<section class="ds-section ds-section--testimonials ds-dsd-feedback" aria-labelledby="dsd-feedback-title">
    <div class="ds-container">
        <h2 class="ds-section__heading ds-section__heading--center" id="dsd-feedback-title"><?php echo esc_html($title); ?></h2>

        <div class="ds-testimonial-carousel" aria-label="<?php echo esc_attr($title); ?>">
            <div class="ds-testimonial-carousel__track">
                <?php foreach ($items as $i => $item) :
                    $photo = $item['avatar'];
                    ?>
                    <div class="ds-testimonial-carousel__slide <?php echo $i === 0 ? 'is-active' : ''; ?>" aria-hidden="<?php echo $i === 0 ? 'false' : 'true'; ?>">
                        <div class="ds-testimonial">
                            <span class="ds-testimonial__mark" aria-hidden="true">&ldquo;</span>
                            <blockquote class="ds-testimonial__quote"><?php echo esc_html($item['quote']); ?></blockquote>
                            <?php if ($item['name'] || $item['company'] || !empty($photo['url'])) : ?>
                                <div class="ds-testimonial__author ds-dsd-quote__author">
                                    <?php if (!empty($photo['url'])) : ?>
                                        <img class="ds-dsd-quote__avatar" src="<?php echo esc_url($photo['sizes']['thumbnail'] ?? $photo['url']); ?>" alt="" width="64" height="64" loading="lazy">
                                    <?php endif; ?>
                                    <div>
                                        <?php if ($item['name']) : ?><strong><?php echo esc_html($item['name']); ?></strong><?php endif; ?>
                                        <?php if ($item['company']) : ?><span><?php echo esc_html($item['company']); ?></span><?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (count($items) > 1) : ?>
                <button class="ds-testimonial-carousel__btn ds-testimonial-carousel__btn--prev" aria-label="<?php esc_attr_e('Previous testimonial', 'digitalstride'); ?>">
                    <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                </button>
                <button class="ds-testimonial-carousel__btn ds-testimonial-carousel__btn--next" aria-label="<?php esc_attr_e('Next testimonial', 'digitalstride'); ?>">
                    <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                </button>
                <div class="ds-testimonial-carousel__dots" aria-hidden="true">
                    <?php foreach ($items as $i => $item) : ?>
                        <button type="button" class="ds-testimonial-carousel__dot <?php echo $i === 0 ? 'is-active' : ''; ?>" aria-label="<?php printf(esc_attr__('Go to slide %d', 'digitalstride'), $i + 1); ?>" data-slide="<?php echo $i; ?>"></button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
