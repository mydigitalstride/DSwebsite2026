<?php
/**
 * Realtors 4: Featured Partner Spotlight (s4_* fields).
 *
 * Auto mode: global testimonials tagged with the Industry slugs in
 * `s4_category_slug`; Manual mode: the page's own quotes (see
 * ds_rlt_testimonials()). Uses the site testimonial carousel, initialised by
 * main.js. Yellow/orange heading bar.
 */
$d     = ds_rlt_defaults('spotlight');
$title = get_field('s4_title') ?: $d['title'];
$items = ds_rlt_testimonials();

if (!$items) {
    if (current_user_can('edit_posts')) {
        echo '<!-- Realtors spotlight: no testimonials. Add quotes under Theme Settings > Testimonials, or switch this page to Manual and add them here. -->';
    }
    return;
}
?>
<section class="ds-section ds-section--testimonials ds-aec-clients ds-rlt-spotlight" id="rlt-spotlight">
    <div class="ds-container">
        <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($title); ?></h2>

        <div class="ds-testimonial-carousel" aria-label="<?php echo esc_attr($title); ?>">
            <div class="ds-testimonial-carousel__track">
                <?php foreach ($items as $i => $item) :
                    $photo = $item['image'] ?? null;
                    ?>
                    <div class="ds-testimonial-carousel__slide <?php echo $i === 0 ? 'is-active' : ''; ?>" aria-hidden="<?php echo $i === 0 ? 'false' : 'true'; ?>">
                        <div class="ds-testimonial">
                            <span class="ds-testimonial__mark">&ldquo;</span>
                            <blockquote class="ds-testimonial__quote"><?php echo esc_html($item['quote']); ?></blockquote>
                            <?php if ($item['name'] || $item['title_company'] || !empty($photo['url'])) : ?>
                                <div class="ds-testimonial__author<?php echo !empty($photo['url']) ? ' ds-rlt-spotlight__author' : ''; ?>">
                                    <?php if (!empty($photo['url'])) : ?>
                                        <img class="ds-rlt-spotlight__photo" src="<?php echo esc_url($photo['sizes']['thumbnail'] ?? $photo['url']); ?>" alt="" width="64" height="64" loading="lazy">
                                    <?php endif; ?>
                                    <div>
                                        <?php if ($item['name']) : ?><strong><?php echo esc_html($item['name']); ?></strong><?php endif; ?>
                                        <?php if ($item['title_company']) : ?><span><?php echo esc_html($item['title_company']); ?></span><?php endif; ?>
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
