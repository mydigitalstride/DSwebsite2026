<?php
/**
 * ECHO SEO: Branding & intro banner (intro_* fields).
 *
 * Centred ECHO SEO logo, platform headline and tagline. Without an uploaded
 * logo the banner shows an ECHO SEO wordmark.
 */
$d     = ds_echos_defaults('intro');
$logo  = get_field('intro_logo');
$title = get_field('intro_headline') ?: $d['headline'];
$sub   = get_field('intro_subtext') ?: $d['subtext'];
?>
<section class="ds-section ds-echos-intro">
    <div class="ds-container ds-echos-intro__inner">
        <?php if (!empty($logo['url'])) : ?>
            <img class="ds-echos-intro__logo" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?: 'ECHO SEO'); ?>">
        <?php else : ?>
            <svg class="ds-echos-intro__logo" viewBox="0 0 360 96" role="img" aria-label="ECHO SEO" xmlns="http://www.w3.org/2000/svg">
                <g fill="none" stroke="#F5B800" stroke-width="5" stroke-linecap="round">
                    <path d="M18 30a26 26 0 0 0 0 36" opacity="0.45"/>
                    <path d="M30 38a14 14 0 0 0 0 20" opacity="0.75"/>
                    <path d="M60 30a26 26 0 0 1 0 36" opacity="0.45"/>
                    <path d="M48 38a14 14 0 0 1 0 20" opacity="0.75"/>
                </g>
                <circle cx="39" cy="48" r="6" fill="#F5B800"/>
                <text x="80" y="64" font-family="'Josefin Sans', sans-serif" font-size="50" font-weight="700" fill="#F2F5FB">ECHO<tspan fill="#F5B800" dx="12">SEO</tspan></text>
            </svg>
        <?php endif; ?>
        <?php if ($title) : ?>
            <h2 class="ds-echos-intro__title"><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        <?php if ($sub) : ?>
            <p class="ds-echos-intro__text"><?php echo esc_html($sub); ?></p>
        <?php endif; ?>
    </div>
</section>
