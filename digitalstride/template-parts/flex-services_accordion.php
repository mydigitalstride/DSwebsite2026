<?php
/**
 * Flex Layout: Services Accordion
 * Desktop: accordion titles start centered and closed; opening one slides the
 * titles left and reveals its content panel on the right.
 * Mobile: standard stacked accordion, all closed by default.
 */
$heading    = get_sub_field('heading');
$intro_text = get_sub_field('intro_text');

$services_data = [];
if (have_rows('services')) :
    while (have_rows('services')) : the_row();
        $service = [
            'icon'       => get_sub_field('icon'),
            'icon_color' => get_sub_field('icon_color'),
            'title'      => get_sub_field('title'),
            'cta'        => get_sub_field('cta_button'),
            'subs'       => [],
        ];
        if (have_rows('sub_services')) :
            while (have_rows('sub_services')) : the_row();
                $service['subs'][] = [
                    'icon'       => get_sub_field('icon'),
                    'icon_color' => get_sub_field('icon_color'),
                    'title'      => get_sub_field('title'),
                    'desc'       => get_sub_field('description'),
                    'link'       => get_sub_field('link'),
                ];
            endwhile;
        endif;
        $services_data[] = $service;
    endwhile;
endif;
?>

<section class="ds-section ds-section--services-accordion">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($intro_text) : ?>
            <div class="ds-section__intro"><?php echo wp_kses_post($intro_text); ?></div>
        <?php endif; ?>

        <?php get_template_part('template-parts/services-split', null, ['services' => $services_data]); ?>
    </div>
</section>
