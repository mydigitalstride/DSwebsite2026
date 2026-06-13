<?php
/**
 * Flex Layout: Shortcode
 * Renders a WordPress shortcode, with an optional heading above it.
 */
$heading   = get_sub_field('heading');
$shortcode = get_sub_field('shortcode');
?>

<section class="ds-section ds-section--shortcode">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($shortcode) : ?>
            <div class="ds-shortcode-content"><?php echo do_shortcode($shortcode); ?></div>
        <?php endif; ?>
    </div>
</section>
