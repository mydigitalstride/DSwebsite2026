<?php
/**
 * Who We Serve — image-card mega menu panel.
 *
 * Loops the `who_we_serve_cards` repeater (Theme Settings > Header & Menu).
 * Rendered by header.php under any nav item whose Mega Menu Style is
 * "Who We Serve cards". Outputs nothing when there are no cards.
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('have_rows') || !have_rows('who_we_serve_cards', 'option')) {
    return;
}
?>
<div class="ds-mega-menu ds-mega-menu--cards">
    <ul class="ds-wws-grid">
        <?php while (have_rows('who_we_serve_cards', 'option')) : the_row();
            $title    = get_sub_field('card_title');
            $cta      = get_sub_field('card_cta_text') ?: __('Explore More', 'digitalstride');
            $image_id = (int) get_sub_field('card_image');
            $link     = get_sub_field('card_link');

            if (!$title || empty($link['url'])) {
                continue;
            }
            $target = !empty($link['target']) ? $link['target'] : '';
            ?>
            <li class="ds-wws-grid__item">
                <a class="ds-wws-card" href="<?php echo esc_url($link['url']); ?>"<?php echo $target ? ' target="' . esc_attr($target) . '" rel="noopener"' : ''; ?>>
                    <?php if ($image_id) {
                        echo wp_get_attachment_image($image_id, 'large', false, [
                            'class'    => 'ds-wws-card__img',
                            'alt'      => '', // decorative; the title is the link text
                            'loading'  => 'lazy',
                            'decoding' => 'async',
                            'sizes'    => '(min-width: 1025px) 30vw, 100vw',
                        ]);
                    } ?>
                    <span class="ds-wws-card__overlay ds-wws-card__overlay--default" aria-hidden="true"></span>
                    <span class="ds-wws-card__overlay ds-wws-card__overlay--hover" aria-hidden="true"></span>
                    <span class="ds-wws-card__body">
                        <span class="ds-wws-card__title"><?php echo esc_html($title); ?></span>
                        <span class="ds-wws-card__cta" aria-hidden="true"><?php echo esc_html($cta); ?> <span class="ds-wws-card__arrow">&rarr;</span></span>
                    </span>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>
</div>
