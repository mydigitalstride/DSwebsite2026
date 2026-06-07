<?php
/**
 * Article Archive (blog listing)
 */
get_header();
?>

<section class="ds-hero ds-hero--archive">
    <div class="ds-hero__overlay"></div>
    <div class="ds-container">
        <div class="ds-hero__content">
            <h1 class="ds-hero__heading"><?php the_archive_title(); ?></h1>
        </div>
    </div>
</section>

<section class="ds-section">
    <div class="ds-container">
        <?php if (have_posts()) : ?>
            <div class="ds-grid ds-grid--2">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/card', 'article'); ?>
                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(['prev_text' => '&laquo;', 'next_text' => '&raquo;']); ?>
        <?php else : ?>
            <p>No articles found.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
