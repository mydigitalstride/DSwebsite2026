<?php
/**
 * Flex Layout: Text Block
 * Simple heading + WYSIWYG content area for freeform text sections.
 * Used on: About Us (Why DS intro), Landing Page, Service V1, Service V2
 */
$heading = get_sub_field('heading');
$content = get_sub_field('content');
?>

<section class="ds-section ds-section--text">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($content) : ?>
            <div class="ds-post-content"><?php echo wp_kses_post($content); ?></div>
        <?php endif; ?>
    </div>
</section>
