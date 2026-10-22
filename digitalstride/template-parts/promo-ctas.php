<?php
/**
 * Centred primary (orange gradient) + secondary (white outline) button pair
 * for the DSD and ECHOs promo sections.
 *
 * Expects $args['primary'] and $args['secondary']: ACF link arrays or empty.
 */
$buttons = array_filter([
    'primary' => $args['primary'] ?? null,
    'outline' => $args['secondary'] ?? null,
], function ($link) {
    return !empty($link['url']) && !empty($link['title']);
});
if (!$buttons) return;
?>
<div class="ds-promo__ctas">
    <?php foreach ($buttons as $style => $link) : ?>
        <a href="<?php echo esc_url($link['url']); ?>" class="ds-btn ds-btn--<?php echo esc_attr($style); ?>"<?php echo !empty($link['target']) ? ' target="' . esc_attr($link['target']) . '" rel="noopener"' : ''; ?>><?php echo esc_html($link['title']); ?></a>
    <?php endforeach; ?>
</div>
