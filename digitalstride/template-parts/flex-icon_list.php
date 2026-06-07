<?php
/**
 * Flex Layout: Icon List
 * Centred heading + intro text, then a vertical stack of icon + title + description rows.
 * Optional background image with overlay. Optional CTA button at the bottom.
 */
$heading    = get_sub_field('heading');
$intro      = get_sub_field('intro_text');
$bg         = get_sub_field('background_image');
$cta        = get_sub_field('cta_button');

$items = [];
if (have_rows('items')) :
    while (have_rows('items')) : the_row();
        $items[] = [
            'icon'        => get_sub_field('icon'),
            'icon_color'  => get_sub_field('icon_color'),
            'title'       => get_sub_field('title'),
            'description' => get_sub_field('description'),
        ];
    endwhile;
endif;
?>

<section class="ds-section ds-section--icon-list"
    <?php if ($bg) : ?>style="background-image: url(<?php echo esc_url($bg['url']); ?>); background-size: cover; background-position: center;"<?php endif; ?>>

    <?php if ($bg) : ?><div class="ds-icon-list__overlay"></div><?php endif; ?>

    <div class="ds-container ds-icon-list__wrap">

        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if ($intro) : ?>
            <div class="ds-icon-list__intro"><?php echo wp_kses_post($intro); ?></div>
        <?php endif; ?>

        <?php if ($items) : ?>
            <div class="ds-icon-list__items">
                <?php foreach ($items as $item) : ?>
                    <div class="ds-icon-list__item">
                        <?php if ($item['icon']) : ?>
                            <div class="ds-icon-list__icon <?php echo $item['icon_color'] ? 'ds-icon--' . esc_attr($item['icon_color']) : ''; ?>">
                                <?php echo ds_inline_svg($item['icon']); ?>
                            </div>
                        <?php endif; ?>
                        <div class="ds-icon-list__body">
                            <?php if ($item['title']) : ?>
                                <h3 class="ds-icon-list__title"><?php echo esc_html($item['title']); ?></h3>
                            <?php endif; ?>
                            <?php if ($item['description']) : ?>
                                <div class="ds-icon-list__text"><?php echo wp_kses_post($item['description']); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($cta) : ?>
            <div class="ds-icon-list__cta">
                <a href="<?php echo esc_url($cta['url']); ?>" class="ds-btn ds-btn--primary"><?php echo esc_html($cta['title']); ?></a>
            </div>
        <?php endif; ?>

    </div>
</section>
