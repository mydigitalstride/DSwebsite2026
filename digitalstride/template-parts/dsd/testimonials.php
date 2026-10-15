<?php
/**
 * DSD: Partner Feedback (group_dsd_testimonials).
 *
 * The site's global testimonials (Theme Settings > Testimonials) in the
 * same markup as the Global Testimonials block (flex-global_testimonials),
 * so it looks exactly like everywhere else. Arrows, dots and the pause
 * button come from main.js. Only the section title is set on this page.
 */
$d     = ds_dsd_defaults('testimonials');
$title = get_field('testimonials_title') ?: $d['title'];
$items = ds_dsd_testimonials();

if (!$items) {
    if (current_user_can('edit_posts')) {
        echo '<!-- DSD Partner Feedback: no testimonials in Theme Settings > Testimonials. -->';
    }
    return;
}
?>
<section class="ds-section ds-section--testimonials">
    <div class="ds-container">
        <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($title); ?></h2>

        <div class="ds-testimonial-carousel" aria-label="Client testimonials">
            <div class="ds-testimonial-carousel__track">
                <?php foreach ($items as $i => $item) : ?>
                    <div class="ds-testimonial-carousel__slide <?php echo $i === 0 ? 'is-active' : ''; ?>" aria-hidden="<?php echo $i === 0 ? 'false' : 'true'; ?>">
                        <div class="ds-testimonial">
                            <span class="ds-testimonial__mark">&ldquo;</span>
                            <blockquote class="ds-testimonial__quote"><?php echo esc_html($item['quote']); ?></blockquote>
                            <div class="ds-testimonial__author">
                                <strong><?php echo esc_html($item['name'] ?? ''); ?></strong>
                                <?php if (!empty($item['title_company'])) : ?>
                                    <span><?php echo esc_html($item['title_company']); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (count($items) > 1) : ?>
                <button class="ds-testimonial-carousel__btn ds-testimonial-carousel__btn--prev" aria-label="Previous testimonial">
                    <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                </button>
                <button class="ds-testimonial-carousel__btn ds-testimonial-carousel__btn--next" aria-label="Next testimonial">
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
