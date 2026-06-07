<?php
/**
 * Template Name: Services
 */
get_header();
?>

<?php get_template_part('template-parts/hero'); ?>

<?php // Services Overview ?>
<section class="ds-section ds-section--services-overview">
    <div class="ds-container">
        <h2 class="ds-section__heading"><?php echo esc_html(get_field('services_heading') ?: 'OUR SERVICES'); ?></h2>

        <?php if (have_rows('services')) : while (have_rows('services')) : the_row(); ?>
            <div class="ds-service-block" id="<?php echo esc_attr(sanitize_title(get_sub_field('title'))); ?>">
                <div class="ds-service-block__header">
                    <?php $icon = get_sub_field('icon'); ?>
                    <?php if ($icon) : ?>
                        <div class="ds-service-block__icon">
                            <img src="<?php echo esc_url($icon['url']); ?>" alt="">
                        </div>
                    <?php endif; ?>
                    <h3 class="ds-service-block__title"><?php echo esc_html(get_sub_field('title')); ?></h3>
                </div>

                <div class="ds-service-block__content">
                    <?php if (have_rows('sub_services')) : ?>
                        <div class="ds-grid ds-grid--3">
                            <?php while (have_rows('sub_services')) : the_row(); ?>
                                <div class="ds-service-card">
                                    <h6 class="ds-service-card__title"><?php echo esc_html(get_sub_field('title')); ?></h6>
                                    <p class="ds-service-card__text"><?php echo esc_html(get_sub_field('description')); ?></p>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($cta = get_sub_field('cta_link')) : ?>
                        <div class="ds-service-block__cta">
                            <a href="<?php echo esc_url($cta['url']); ?>" class="ds-btn ds-btn--outline"><?php echo esc_html($cta['title']); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; endif; ?>
    </div>
</section>

<?php // Pricing Tables ?>
<?php if (have_rows('pricing_tables')) : ?>
<section class="ds-section ds-section--pricing">
    <div class="ds-container">
        <?php while (have_rows('pricing_tables')) : the_row(); ?>
            <div class="ds-pricing-table">
                <h3 class="ds-pricing-table__title"><?php echo esc_html(get_sub_field('service_name')); ?></h3>

                <?php if (have_rows('tiers')) : ?>
                    <div class="ds-pricing-table__grid">
                        <?php while (have_rows('tiers')) : the_row(); ?>
                            <div class="ds-pricing-tier">
                                <div class="ds-pricing-tier__header">
                                    <h6 class="ds-pricing-tier__name"><?php echo esc_html(get_sub_field('name')); ?></h6>
                                    <div class="ds-pricing-tier__price"><?php echo esc_html(get_sub_field('price')); ?></div>
                                </div>
                                <ul class="ds-pricing-tier__features">
                                    <?php if (have_rows('features')) : while (have_rows('features')) : the_row(); ?>
                                        <li class="<?php echo get_sub_field('included') ? 'included' : 'excluded'; ?>">
                                            <?php echo esc_html(get_sub_field('feature_text')); ?>
                                        </li>
                                    <?php endwhile; endif; ?>
                                </ul>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <?php if ($note = get_sub_field('note')) : ?>
                    <p class="ds-pricing-table__note"><?php echo esc_html($note); ?></p>
                <?php endif; ?>

                <?php if ($cta = get_sub_field('cta_link')) : ?>
                    <div class="ds-pricing-table__cta">
                        <a href="<?php echo esc_url($cta['url']); ?>" class="ds-btn ds-btn--primary"><?php echo esc_html($cta['title']); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<?php endif; ?>

<?php get_template_part('template-parts/why-ds'); ?>
<?php get_template_part('template-parts/cta-banner'); ?>
<?php get_template_part('template-parts/feature-cards'); ?>

<?php get_footer(); ?>
