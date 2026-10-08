<?php
/**
 * Template Part: Service Hero CTAs
 * "Book a Blueprint Meeting" + "Call Digital Stride" buttons shown in the hero
 * of the Services page and every individual service page.
 * The phone number comes from Theme Settings → Footer so it stays in one place.
 */
$phone = get_field('footer_phone', 'option') ?: '(717) 727-1400';
?>
<div class="ds-cta-buttons ds-cta-buttons--left ds-hero__ctas">
    <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="ds-btn ds-btn--primary ds-btn--hero">Book a Blueprint Meeting</a>
    <a href="<?php echo esc_url('tel:' . preg_replace('/[^0-9+]/', '', $phone)); ?>" class="ds-btn ds-btn--outline ds-btn--hero" rel="nofollow">Call Digital Stride</a>
</div>
