<?php
/**
 * Flex Layout: Article Grid
 * Pulls posts by category with anchor nav. For resource/blog archive sections.
 * Used on: Landing Page (resources-style), Article Archive template
 */
$heading = get_sub_field('heading');
?>

<section class="ds-section ds-section--articles">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if (have_rows('sections')) : ?>
            <nav class="ds-anchor-nav">
                <ul>
                    <?php while (have_rows('sections')) : the_row(); ?>
                        <li><a href="#<?php echo esc_attr(sanitize_title(get_sub_field('section_title'))); ?>"><?php echo esc_html(get_sub_field('section_title')); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </nav>

            <?php // Reset and loop again for content ?>
            <?php while (have_rows('sections')) : the_row(); ?>
                <div class="ds-article-section" id="<?php echo esc_attr(sanitize_title(get_sub_field('section_title'))); ?>">
                    <h3 class="ds-article-section__heading"><?php echo esc_html(get_sub_field('section_title')); ?></h3>
                    <?php
                    $cat = get_sub_field('category');
                    $count = get_sub_field('posts_count') ?: 6;
                    $args = ['post_type' => 'post', 'posts_per_page' => $count, 'post_status' => 'publish'];
                    if ($cat) $args['cat'] = $cat;
                    $q = new WP_Query($args);
                    ?>
                    <?php if ($q->have_posts()) : ?>
                        <div class="ds-grid ds-grid--2">
                            <?php while ($q->have_posts()) : $q->the_post(); ?>
                                <?php get_template_part('template-parts/card', 'article'); ?>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</section>
