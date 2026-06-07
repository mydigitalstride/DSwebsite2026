<?php
/**
 * Flex Layout: Pricing Stack
 * Desktop: 3-card rotating perspective stack. Click side cards to bring to centre.
 * Mobile:  tab bar + single active card.
 * Card data is passed to JS via a data attribute so the existing animation
 * engine in main.js drives it.
 */
$heading    = get_sub_field('heading');
$subheading = get_sub_field('subheading');

$cards = [];
if (have_rows('cards')) :
    while (have_rows('cards')) : the_row();
        $raw_services = get_sub_field('services');
        $services = array_filter(array_map('trim', explode("\n", $raw_services)));
        $cards[] = [
            'title'         => get_sub_field('title'),
            'desc'          => get_sub_field('description'),
            'servicesLabel' => get_sub_field('services_label') ?: 'Services Included',
            'services'      => array_values($services),
            'price'         => get_sub_field('price_text'),
            'btnText'       => get_sub_field('button_text') ?: 'Schedule a Call',
            'btnLink'       => get_sub_field('button_link') ?: '/contact-us/',
        ];
    endwhile;
endif;

if (!$cards) return;

$unique_id = 'ps-' . get_the_ID() . '-' . uniqid();
?>

<section class="ds-section ds-section--pricing-stack">
    <div class="ds-container ds-pricing-stack-header">
        <?php if ($subheading) : ?>
            <p class="ds-section__subheading"><?php echo esc_html($subheading); ?></p>
        <?php endif; ?>
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
    </div>

    <!-- Desktop stack -->
    <div class="pricing-stack-container">
        <div class="pricing-stack" id="pricingStack-<?php echo esc_attr($unique_id); ?>"></div>
    </div>

    <!-- Mobile tabs + card -->
    <div class="mobile-pricing" id="mobilePricing-<?php echo esc_attr($unique_id); ?>"></div>
</section>

<script>
(function () {
    var CARDS = <?php echo wp_json_encode($cards); ?>;
    var stackId  = 'pricingStack-<?php echo esc_js($unique_id); ?>';
    var mobileId = 'mobilePricing-<?php echo esc_js($unique_id); ?>';
    if (typeof window.initPricingStack === 'function') {
        window.initPricingStack(stackId, mobileId, CARDS);
    } else {
        document.addEventListener('ds:pricing-stack-ready', function () {
            window.initPricingStack(stackId, mobileId, CARDS);
        });
    }
})();
</script>
