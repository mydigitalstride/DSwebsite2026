<?php
/**
 * Flex Layout: Services Accordion
 * Desktop: split layout — accordion titles on left, content panel on right.
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

        <?php if ($services_data) : ?>
            <div class="ds-services-split">
                <div class="ds-services-split__tabs">
                    <?php foreach ($services_data as $i => $service) : ?>
                        <div class="ds-services-split__item <?php echo $i === 0 ? 'is-active' : ''; ?>" data-panel="<?php echo $i; ?>">
                            <button class="ds-services-split__header" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>">
                                <span class="ds-accordion__title-wrap">
                                    <?php if ($service['icon']) : ?>
                                        <span class="<?php echo $service['icon_color'] ? 'ds-icon--' . esc_attr($service['icon_color']) : ''; ?>"><?php echo ds_inline_svg($service['icon']); ?></span>
                                    <?php endif; ?>
                                    <?php echo esc_html($service['title']); ?>
                                </span>
                                <i class="fa-solid fa-chevron-down ds-accordion__chevron ds-services-split__chevron"></i>
                            </button>

                            <div class="ds-services-split__mobile-body">
                                <?php if ($service['subs']) : ?>
                                    <div class="ds-services-split__subs">
                                        <?php foreach ($service['subs'] as $sub) : ?>
                                            <div class="ds-services-split__sub">
                                                <?php if ($sub['icon']) : ?>
                                                    <div class="ds-services-split__sub-icon <?php echo $sub['icon_color'] ? 'ds-icon--' . esc_attr($sub['icon_color']) : ''; ?>">
                                                        <?php echo ds_inline_svg($sub['icon']); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div>
                                                    <h6 class="ds-services-split__sub-title"><?php echo esc_html($sub['title']); ?></h6>
                                                    <p class="ds-services-split__sub-text"><?php echo esc_html($sub['desc']); ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($service['cta']) : ?>
                                    <div class="ds-services-split__cta">
                                        <a href="<?php echo esc_url($service['cta']['url']); ?>" class="ds-btn ds-btn--secondary"><?php echo esc_html($service['cta']['title']); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="ds-services-split__panels">
                    <?php foreach ($services_data as $i => $service) : ?>
                        <div class="ds-services-split__panel <?php echo $i === 0 ? 'is-active' : ''; ?>" data-panel="<?php echo $i; ?>">
                            <?php if ($service['subs']) : ?>
                                <div class="ds-services-split__subs">
                                    <?php foreach ($service['subs'] as $sub) : ?>
                                        <div class="ds-services-split__sub">
                                            <?php if ($sub['icon']) : ?>
                                                <div class="ds-services-split__sub-icon <?php echo $sub['icon_color'] ? 'ds-icon--' . esc_attr($sub['icon_color']) : ''; ?>">
                                                    <?php echo ds_inline_svg($sub['icon']); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <h6 class="ds-services-split__sub-title"><?php echo esc_html($sub['title']); ?></h6>
                                                <p class="ds-services-split__sub-text"><?php echo esc_html($sub['desc']); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($service['cta']) : ?>
                                <div class="ds-services-split__cta">
                                    <a href="<?php echo esc_url($service['cta']['url']); ?>" class="ds-btn ds-btn--secondary"><?php echo esc_html($service['cta']['title']); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
