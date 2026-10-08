<?php
/**
 * AEC Landing: Our AEC Clients (group `aec_clients`).
 *
 * Uses the site testimonial carousel (initialised by main.js). By default it
 * lists global testimonials whose Industry includes AEC; the page can pick
 * specific ones or enter custom quotes instead (see ds_aec_testimonials()).
 */
$d       = ds_aec_defaults('clients');
$clients = get_field('aec_clients') ?: [];
$heading = ($clients['section_heading'] ?? '') ?: $d['heading'];
$items   = ds_aec_testimonials();

if (!$items) {
    if (current_user_can('edit_posts')) {
        echo '<!-- AEC clients: no testimonials match. Tag testimonials as AEC under Theme Settings > Testimonials, or choose quotes on this page. -->';
    }
    return;
}
?>
<section class="ds-section ds-section--testimonials ds-aec-clients" id="aec-clients">
    <div class="ds-container">
        <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>

        <div class="ds-testimonial-carousel" aria-label="<?php esc_attr_e('AEC client testimonials', 'digitalstride'); ?>">
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
