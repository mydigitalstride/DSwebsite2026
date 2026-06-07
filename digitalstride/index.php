<?php get_header(); ?>
<section class="ds-section">
    <div class="ds-container">
        <?php if (have_posts()) : ?>
            <div class="ds-grid ds-grid--2">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/card', 'article'); ?>
                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
