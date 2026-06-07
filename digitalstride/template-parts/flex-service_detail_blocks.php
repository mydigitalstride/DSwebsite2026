<?php
/**
 * Flex Layout: Service Detail Blocks
 * List of service blocks each with icon, title, sub-services grid, and CTA.
 * Used on: Service Overview, Service V1
 */
$heading = get_sub_field('heading');
?>

<section class="ds-section ds-section--service-blocks">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if (have_rows('services')) : while (have_rows('services')) : the_row(); ?>
            <div class="ds-service-block" id="<?php echo esc_attr(sanitize_title(get_sub_field('title'))); ?>">
                <div class="ds-service-block__header">
                    <?php $icon = get_sub_field('icon'); $icon_color = get_sub_field('icon_color'); ?>
                    <?php if ($icon) : ?>
                        <span class="<?php echo $icon_color ? 'ds-icon--' . esc_attr($icon_color) : ''; ?>"><?php echo ds_inline_svg($icon); ?></span>
                    <?php endif; ?>
                    <h3 class="ds-service-block__title"><?php echo esc_html(get_sub_field('title')); ?></h3>
                </div>
                <?php if (have_rows('sub_services')) : ?>
                    <div class="ds-grid ds-grid--3">
                        <?php while (have_rows('sub_services')) : the_row(); ?>
                            <div class="ds-service-card">
                                <?php $sub_icon = get_sub_field('icon'); $sub_icon_color = get_sub_field('icon_color'); ?>
                                <?php if ($sub_icon) : ?>
                                    <div class="ds-service-card__icon <?php echo $sub_icon_color ? 'ds-icon--' . esc_attr($sub_icon_color) : ''; ?>"><?php echo ds_inline_svg($sub_icon); ?></div>
                                <?php endif; ?>
                                <h6 class="ds-service-card__title"><?php echo esc_html(get_sub_field('title')); ?></h6>
                                <p class="ds-service-card__text"><?php echo esc_html(get_sub_field('description')); ?></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <?php $cta = get_sub_field('cta_button'); ?>
                <?php if ($cta) : ?>
                    <div class="ds-service-block__cta">
                        <a href="<?php echo esc_url($cta['url']); ?>" class="ds-btn ds-btn--secondary"><?php echo esc_html($cta['title']); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; endif; ?>
    </div>
</section>
