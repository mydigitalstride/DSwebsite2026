<?php
/**
 * Who We Serve — image-card mega menu panel.
 *
 * Loops the `who_we_serve_cards` repeater (Theme Settings > Who We Serve Menu).
 * Until cards are entered there, it falls back to AEC / Home Services /
 * Realtors cards linked to the Audiences pages, so the dropdown works out
 * of the box. Card images fall back to the destination page's featured image.
 *
 * Rendered by header.php under the "Who We Serve" nav item.
 */

if (!defined('ABSPATH')) {
    exit;
}

$cards = [];

if (function_exists('have_rows') && have_rows('who_we_serve_cards', 'option')) {
    while (have_rows('who_we_serve_cards', 'option')) {
        the_row();
        $link = get_sub_field('card_link');
        $cards[] = [
            'title'    => get_sub_field('card_title'),
            'cta'      => get_sub_field('card_cta_text'),
            'image_id' => (int) get_sub_field('card_image'),
            'url'      => $link['url'] ?? '',
            'target'   => $link['target'] ?? '',
        ];
    }
}

if (!$cards) {
    $wws       = home_url('/who-we-serve/');
    $audiences = function_exists('ds_audiences') ? ds_audiences() : [];
    $realtors  = get_page_by_path('realtors');

    $cards = [
        ['title' => 'AEC Industry', 'url' => ($audiences['aec']['url'] ?? '') ?: add_query_arg('industry', 'aec', $wws)],
        ['title' => 'Home Services', 'url' => ($audiences['home_services']['url'] ?? '') ?: add_query_arg('industry', 'home-services', $wws)],
        ['title' => 'Realtors', 'url' => $realtors ? get_permalink($realtors) : $wws],
    ];
}

$cards = array_filter($cards, function ($card) {
    return !empty($card['title']) && !empty($card['url']);
});
if (!$cards) {
    return;
}
?>
<div class="ds-mega-menu ds-mega-menu--cards">
    <ul class="ds-wws-grid">
        <?php foreach ($cards as $card) :
            $cta      = !empty($card['cta']) ? $card['cta'] : __('Explore More', 'digitalstride');
            $target   = $card['target'] ?? '';
            $image_id = $card['image_id'] ?? 0;
            if (!$image_id && ($page_id = url_to_postid($card['url']))) {
                $image_id = (int) get_post_thumbnail_id($page_id);
            }
            ?>
            <li class="ds-wws-grid__item">
                <a class="ds-wws-card" href="<?php echo esc_url($card['url']); ?>"<?php echo $target ? ' target="' . esc_attr($target) . '" rel="noopener"' : ''; ?>>
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
                        <span class="ds-wws-card__title"><?php echo esc_html($card['title']); ?></span>
                        <span class="ds-wws-card__cta" aria-hidden="true"><?php echo esc_html($cta); ?> <span class="ds-wws-card__arrow">&rarr;</span></span>
                    </span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
