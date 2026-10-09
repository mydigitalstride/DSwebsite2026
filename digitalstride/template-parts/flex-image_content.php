<?php
/**
 * Flex Layout: Image + Picture or Text
 * Same look as Core Values: heading on top, a picture on the left, and on the
 * right either a second picture or rich text (chosen per section).
 */
$heading    = get_sub_field('heading');
$image      = get_sub_field('image');
$link       = get_sub_field('link');
$right_type = get_sub_field('right_type') ?: 'text';
$right_img  = get_sub_field('right_image');
$right_text = get_sub_field('right_text');
?>

<style>
/* Inline so the section is styled even when a cache serves an older main stylesheet.
   Column split matches the Core Values section. */
.ds-image-content__heading { margin-bottom: 1.5em; }
.ds-image-content__row { display: flex; gap: 4em; align-items: flex-start; }
.ds-image-content__left { flex: 0 0 35%; min-width: 0; display: flex; flex-direction: column; gap: 1.5em; }
.ds-image-content__right { flex: 1; min-width: 0; }
.ds-image-content__left img,
.ds-image-content__right img { width: 100%; height: auto; display: block; border-radius: 4px; }
.ds-image-content__text { font-size: 1.1em; line-height: 1.6; }
.ds-image-content__text > :first-child { margin-top: 0; }
.ds-image-content__text p + p { margin-top: 1.25em; }
@media (max-width: 1024px) {
    .ds-image-content__row { flex-direction: column; gap: 2em; }
    .ds-image-content__left, .ds-image-content__right { flex-basis: auto; width: 100%; }
}
</style>

<section class="ds-section ds-section--image-content">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-image-content__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <div class="ds-image-content__row">
            <?php if ($image || $link) : ?>
                <div class="ds-image-content__left">
                    <?php if ($image) : ?>
                        <img src="<?php echo esc_url($image['sizes']['large'] ?? $image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" loading="lazy">
                    <?php endif; ?>
                    <?php if ($link) : ?>
                        <a href="<?php echo esc_url($link['url']); ?>" class="ds-btn ds-btn--primary"<?php echo !empty($link['target']) ? ' target="' . esc_attr($link['target']) . '" rel="noopener"' : ''; ?>><?php echo esc_html($link['title']); ?></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="ds-image-content__right">
                <?php if ($right_type === 'image' && $right_img) : ?>
                    <img src="<?php echo esc_url($right_img['sizes']['large'] ?? $right_img['url']); ?>" alt="<?php echo esc_attr($right_img['alt']); ?>" loading="lazy">
                <?php elseif ($right_type === 'text' && $right_text) : ?>
                    <div class="ds-image-content__text"><?php echo wp_kses_post($right_text); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
