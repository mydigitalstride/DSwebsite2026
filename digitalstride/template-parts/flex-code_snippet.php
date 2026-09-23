<?php
/**
 * Flex Layout: Code Snippet
 * Displays code as text in a styled window with syntax highlighting
 * (Prism, loaded only when this layout is on the page) and a Copy button.
 */
$heading      = get_sub_field('heading');
$intro        = get_sub_field('intro');
$language     = get_sub_field('language');
$filename     = get_sub_field('filename');
$line_numbers = get_sub_field('line_numbers');
$code         = (string) get_sub_field('code', false);

if (!trim($code)) {
    return;
}

$lang_value = is_array($language) ? ($language['value'] ?? 'plain') : ($language ?: 'plain');
$lang_label = is_array($language) ? ($language['label'] ?? '') : '';
$lang_value = sanitize_html_class($lang_value, 'plain');

ds_enqueue_code_highlighting();

$pre_classes = ['ds-code-snippet__pre', 'language-' . $lang_value];
if ($line_numbers) {
    $pre_classes[] = 'line-numbers';
}
?>

<section class="ds-section ds-section--code-snippet">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($intro) : ?>
            <div class="ds-post-content ds-code-snippet__intro"><?php echo wp_kses_post($intro); ?></div>
        <?php endif; ?>
        <figure class="ds-code-snippet">
            <figcaption class="ds-code-snippet__bar">
                <span class="ds-code-snippet__name"><?php echo esc_html($filename ?: $lang_label); ?></span>
                <button type="button" class="ds-code-snippet__copy" data-ds-copy-code aria-label="<?php esc_attr_e('Copy code to clipboard', 'digitalstride'); ?>">
                    <i class="fa-regular fa-copy" aria-hidden="true"></i>
                    <span class="ds-code-snippet__copy-label"><?php esc_html_e('Copy', 'digitalstride'); ?></span>
                </button>
            </figcaption>
            <pre class="<?php echo esc_attr(implode(' ', $pre_classes)); ?>" tabindex="0"><code class="language-<?php echo esc_attr($lang_value); ?>"><?php echo esc_html(rtrim($code)); ?></code></pre>
        </figure>
    </div>
</section>
