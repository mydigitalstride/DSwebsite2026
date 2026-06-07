<?php get_header(); ?>
<section class="ds-hero">
    <div class="ds-hero__overlay"></div>
    <div class="ds-container">
        <div class="ds-hero__content" style="text-align:center;max-width:100%">
            <h1 class="ds-hero__heading">404</h1>
            <p class="ds-hero__subheading">Page Not Found</p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="ds-btn ds-btn--primary">Back to Home</a>
        </div>
    </div>
</section>
<?php get_footer(); ?>
