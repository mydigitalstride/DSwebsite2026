<?php
/**
 * Flex Layout: Custom Code
 * Outputs raw HTML / CSS / JS exactly as entered, with an optional heading.
 * For showing code as text, see flex-code_snippet.php.
 */
$heading = get_sub_field('heading');
$full    = get_sub_field('width') === 'full';
$code    = (string) get_sub_field('code', false);

if (!$heading && !trim($code)) {
    return;
}
?>

<section class="ds-section ds-section--custom-code<?php echo $full ? ' ds-section--custom-code-full' : ''; ?>">
    <?php if ($heading) : ?>
        <div class="ds-container">
            <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        </div>
    <?php endif; ?>
    <div class="ds-custom-code<?php echo $full ? '' : ' ds-container'; ?>">
        <?php
        // Intentionally unescaped: this layout exists to run editor-supplied code.
        echo $code; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        ?>
    </div>
</section>
