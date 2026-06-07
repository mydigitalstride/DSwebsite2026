<?php
/**
 * Single Article
 */
get_header();
?>

<?php while (have_posts()) : the_post(); ?>

<section class="ds-hero ds-hero--post" <?php if (has_post_thumbnail()) : ?>style="background-image:url(<?php echo esc_url(get_the_post_thumbnail_url(null, 'hero-bg')); ?>)"<?php endif; ?>>
    <div class="ds-hero__overlay"></div>
    <div class="ds-container">
        <div class="ds-hero__content">
            <h1 class="ds-hero__heading"><?php the_title(); ?></h1>
            <p class="ds-hero__meta">
                <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date('F j, Y'); ?></time>
                <?php if ($cats = get_the_category()) : ?>
                    <span class="ds-hero__cat"><?php echo esc_html($cats[0]->name); ?></span>
                <?php endif; ?>
            </p>
        </div>
    </div>
</section>

<article class="ds-section ds-section--article">
    <div class="ds-container ds-container--narrow">
        <div class="ds-post-content">
            <?php the_content(); ?>
        </div>
    </div>
</article>

<?php endwhile; ?>

<?php
// Render flexible content if any exists on the single post
ds_render_flex('page_sections');
get_footer();
?>
