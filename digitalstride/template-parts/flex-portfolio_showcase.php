<?php
/**
 * Flex Layout: Portfolio Showcase
 * Carousel of client website projects. Each slide shows a large device-mockup
 * image (upload a pre-made laptop/phone mockup), project name, description, and a link.
 */
$heading    = get_sub_field('heading');
$subheading = get_sub_field('subheading');
$text       = get_sub_field('text');

$projects = [];
if (have_rows('projects')) :
    while (have_rows('projects')) : the_row();
        $projects[] = [
            'image'    => get_sub_field('mockup_image'),
            'name'     => get_sub_field('project_name'),
            'category' => get_sub_field('category'),
            'desc'     => get_sub_field('description'),
            'url'      => get_sub_field('site_url'),
        ];
    endwhile;
endif;

if (!$projects) return;
?>

<section class="ds-section ds-section--portfolio">
    <div class="ds-container">
        <?php if ($subheading) : ?>
            <p class="ds-section__subheading"><?php echo esc_html($subheading); ?></p>
        <?php endif; ?>
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($text) : ?>
            <div class="ds-section__intro"><?php echo wp_kses_post($text); ?></div>
        <?php endif; ?>
    </div>

    <div class="ds-portfolio-carousel" aria-label="Client portfolio">

        <div class="ds-portfolio-carousel__track">
            <?php foreach ($projects as $i => $project) : ?>
                <div class="ds-portfolio-carousel__slide <?php echo $i === 0 ? 'is-active' : ''; ?>" aria-hidden="<?php echo $i === 0 ? 'false' : 'true'; ?>">
                    <div class="ds-container ds-portfolio-carousel__inner">

                        <!-- Mockup image -->
                        <div class="ds-portfolio-carousel__visual">
                            <?php if ($project['image']) : ?>
                                <img src="<?php echo esc_url($project['image']['url']); ?>" alt="<?php echo esc_attr($project['image']['alt'] ?: $project['name']); ?>">
                            <?php endif; ?>
                        </div>

                        <!-- Project info -->
                        <div class="ds-portfolio-carousel__info">
                            <?php if ($project['category']) : ?>
                                <span class="ds-portfolio-carousel__category"><?php echo esc_html($project['category']); ?></span>
                            <?php endif; ?>
                            <?php if ($project['name']) : ?>
                                <h3 class="ds-portfolio-carousel__name"><?php echo esc_html($project['name']); ?></h3>
                            <?php endif; ?>
                            <?php if ($project['desc']) : ?>
                                <p class="ds-portfolio-carousel__desc"><?php echo esc_html($project['desc']); ?></p>
                            <?php endif; ?>
                            <?php if ($project['url']) : ?>
                                <a href="<?php echo esc_url($project['url']); ?>" class="ds-btn ds-btn--outline" target="_blank" rel="noopener">Visit Site</a>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Controls -->
        <?php if (count($projects) > 1) : ?>
            <button class="ds-portfolio-carousel__btn ds-portfolio-carousel__btn--prev" aria-label="Previous project">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="ds-portfolio-carousel__btn ds-portfolio-carousel__btn--next" aria-label="Next project">
                <i class="fa-solid fa-chevron-right"></i>
            </button>

            <div class="ds-portfolio-carousel__dots" aria-hidden="true">
                <?php foreach ($projects as $i => $p) : ?>
                    <button class="ds-portfolio-carousel__dot <?php echo $i === 0 ? 'is-active' : ''; ?>" data-slide="<?php echo $i; ?>"></button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
