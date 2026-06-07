<?php
/**
 * Template Name: Resources
 */
get_header();
?>

<?php get_template_part('template-parts/hero'); ?>

<?php // Anchor Nav ?>
<nav class="ds-anchor-nav">
    <div class="ds-container">
        <ul class="ds-anchor-nav__list">
            <?php if (have_rows('resource_sections')) : while (have_rows('resource_sections')) : the_row(); ?>
                <li><a href="#<?php echo esc_attr(sanitize_title(get_sub_field('section_title'))); ?>" class="ds-anchor-nav__link"><?php echo esc_html(get_sub_field('section_title')); ?></a></li>
            <?php endwhile; endif; ?>
        </ul>
    </div>
</nav>

<?php // Resource Sections (Case Studies, Marketing Guides, Industry Tips) ?>
<?php if (have_rows('resource_sections')) : while (have_rows('resource_sections')) : the_row(); ?>
    <section class="ds-section ds-section--resources" id="<?php echo esc_attr(sanitize_title(get_sub_field('section_title'))); ?>">
        <div class="ds-container">
            <h2 class="ds-section__heading"><?php echo esc_html(get_sub_field('section_title')); ?></h2>

            <?php
            $category = get_sub_field('category');
            $args = [
                'post_type'      => 'post',
                'posts_per_page' => get_sub_field('posts_count') ?: 6,
                'post_status'    => 'publish',
            ];
            if ($category) {
                $args['cat'] = $category;
            }
            $query = new WP_Query($args);
            ?>

            <?php if ($query->have_posts()) : ?>
                <div class="ds-grid ds-grid--2">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <article class="ds-article-card">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="ds-article-card__image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('case-study-thumb'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="ds-article-card__content">
                                <h3 class="ds-article-card__title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <p class="ds-article-card__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 25); ?></p>
                                <div class="ds-article-card__meta">
                                    <a href="<?php the_permalink(); ?>" class="ds-article-card__readmore">Read More</a>
                                    <time class="ds-article-card__date" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('F j, Y'); ?></time>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endwhile; endif; ?>

<?php get_template_part('template-parts/cta-banner'); ?>
<?php get_template_part('template-parts/feature-cards'); ?>

<?php get_footer(); ?>
