<?php
/**
 * Flex Layout: Case Studies — full-width image carousel
 * Large cinematic slides: full-width image with gradient overlay,
 * title/description/CTA anchored to the bottom-left.
 */
$heading = get_sub_field('heading');
$text    = get_sub_field('text');

$studies = [];
if (have_rows('studies')) :
    while (have_rows('studies')) : the_row();
        $studies[] = [
            'image' => get_sub_field('image'),
            'title' => get_sub_field('title'),
            'desc'  => get_sub_field('description'),
            'link'  => get_sub_field('link'),
        ];
    endwhile;
endif;
?>

<section class="ds-section ds-section--case-studies">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($text) : ?>
            <p class="ds-section__text ds-section__text--center"><?php echo esc_html($text); ?></p>
        <?php endif; ?>
    </div>

    <?php if ($studies) : ?>
        <div class="ds-project-carousel" aria-label="Project showcase">
            <div class="ds-project-carousel__track">
                <?php foreach ($studies as $i => $study) : ?>
                    <div class="ds-project-carousel__slide <?php echo $i === 0 ? 'is-active' : ''; ?>" aria-hidden="<?php echo $i === 0 ? 'false' : 'true'; ?>">
                        <?php if ($study['image']) : ?>
                            <img class="ds-project-carousel__img" src="<?php echo esc_url($study['image']['url']); ?>" alt="<?php echo esc_attr($study['image']['alt']); ?>">
                        <?php endif; ?>
                        <div class="ds-project-carousel__overlay"></div>
                        <div class="ds-project-carousel__caption">
                            <?php if ($study['title']) : ?>
                                <h3 class="ds-project-carousel__title"><?php echo esc_html($study['title']); ?></h3>
                            <?php endif; ?>
                            <?php if ($study['desc']) : ?>
                                <p class="ds-project-carousel__text"><?php echo esc_html($study['desc']); ?></p>
                            <?php endif; ?>
                            <?php if ($study['link']) : ?>
                                <a href="<?php echo esc_url($study['link']['url']); ?>" class="ds-btn ds-btn--secondary ds-project-carousel__cta"><?php echo esc_html($study['link']['title'] ?: 'View Project'); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Controls -->
            <button class="ds-project-carousel__btn ds-project-carousel__btn--prev" aria-label="Previous project">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="ds-project-carousel__btn ds-project-carousel__btn--next" aria-label="Next project">
                <i class="fa-solid fa-chevron-right"></i>
            </button>

            <!-- Dots -->
            <?php if (count($studies) > 1) : ?>
                <div class="ds-project-carousel__dots" aria-hidden="true">
                    <?php foreach ($studies as $i => $study) : ?>
                        <button class="ds-project-carousel__dot <?php echo $i === 0 ? 'is-active' : ''; ?>" data-slide="<?php echo $i; ?>"></button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>
