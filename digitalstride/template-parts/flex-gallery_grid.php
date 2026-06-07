<?php
/**
 * Flex Layout: Gallery Grid
 * 3-column image grid. Images fill their cells with object-fit cover.
 * Supports optional heading, subheading, and lightbox on click.
 */
$heading    = get_sub_field('heading');
$subheading = get_sub_field('subheading');
$text       = get_sub_field('text');
$columns    = get_sub_field('columns') ?: 3;

$images = [];
if (have_rows('images')) :
    while (have_rows('images')) : the_row();
        $images[] = [
            'image'   => get_sub_field('image'),
            'caption' => get_sub_field('caption'),
            'link'    => get_sub_field('link'),
        ];
    endwhile;
endif;

if (!$images) return;
?>

<section class="ds-section ds-section--gallery">
    <div class="ds-container">
        <?php if ($subheading) : ?>
            <p class="ds-section__subheading"><?php echo esc_html($subheading); ?></p>
        <?php endif; ?>
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($text) : ?>
            <div class="ds-section__intro"><?php echo wp_kses_post($text); ?></div>
        <?php endif; ?>
    </div>

    <div class="ds-gallery ds-gallery--cols-<?php echo esc_attr($columns); ?>">
        <?php foreach ($images as $item) :
            if (empty($item['image'])) continue;
            $img  = $item['image'];
            $link = $item['link'];
            $cap  = $item['caption'];
        ?>
            <div class="ds-gallery__item">
                <?php if ($link) : ?>
                    <a href="<?php echo esc_url($link); ?>" class="ds-gallery__link" target="_blank" rel="noopener">
                <?php else : ?>
                    <a href="<?php echo esc_url($img['url']); ?>" class="ds-gallery__link ds-gallery__lightbox" data-caption="<?php echo esc_attr($cap); ?>">
                <?php endif; ?>
                        <img src="<?php echo esc_url($img['sizes']['large'] ?? $img['url']); ?>"
                             alt="<?php echo esc_attr($img['alt'] ?: $cap); ?>"
                             loading="lazy">
                        <?php if ($cap) : ?>
                            <div class="ds-gallery__caption"><?php echo esc_html($cap); ?></div>
                        <?php endif; ?>
                        <div class="ds-gallery__overlay"><i class="fa-solid fa-expand"></i></div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Lightbox -->
<div class="ds-lightbox" id="ds-lightbox" aria-hidden="true">
    <button class="ds-lightbox__close" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    <button class="ds-lightbox__prev" aria-label="Previous"><i class="fa-solid fa-chevron-left"></i></button>
    <button class="ds-lightbox__next" aria-label="Next"><i class="fa-solid fa-chevron-right"></i></button>
    <div class="ds-lightbox__inner">
        <img class="ds-lightbox__img" src="" alt="">
        <p class="ds-lightbox__caption"></p>
    </div>
</div>
