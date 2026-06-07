<?php
/**
 * Template Part: CTA Banner
 * Uses ACF Options page fields
 */
$heading = get_field('cta_heading', 'option') ?: 'CREATE A BLUEPRINT';
$text    = get_field('cta_text', 'option') ?: 'We believe every organization, no matter the size or sector, deserves a digital presence that reflects its passion and purpose.';
$subtext = get_field('cta_subtext', 'option') ?: "We've powered success for many businesses in Central, PA + beyond.";
$btn1    = get_field('cta_button_1', 'option');
$btn2    = get_field('cta_button_2', 'option');
?>

<section class="ds-section ds-section--cta-banner">
    <div class="ds-container ds-container--narrow">
        <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <p class="ds-section__text"><?php echo esc_html($text); ?></p>
        <p class="ds-section__subtext"><?php echo esc_html($subtext); ?></p>
        <div class="ds-cta-buttons">
            <?php if ($btn1) : ?>
                <a href="<?php echo esc_url($btn1['url']); ?>" class="ds-btn ds-btn--primary"><?php echo esc_html($btn1['title']); ?></a>
            <?php endif; ?>
            <?php if ($btn2) : ?>
                <a href="<?php echo esc_url($btn2['url']); ?>" class="ds-btn ds-btn--outline"><?php echo esc_html($btn2['title']); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>
