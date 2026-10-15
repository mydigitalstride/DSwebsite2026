<?php
/**
 * ECHO SEO: Branding & intro banner (intro_* fields).
 *
 * ECHO SEO logo on the left, platform headline and tagline beside it.
 * Without an uploaded logo the banner shows an ECHO SEO wordmark.
 */
$d     = ds_echos_defaults('intro');
$logo  = get_field('intro_logo');
$title = get_field('intro_headline') ?: $d['headline'];
$sub   = get_field('intro_subtext') ?: $d['subtext'];
?>
<section class="ds-section ds-echos-intro">
    <div class="ds-container ds-echos-intro__inner">
        <div class="ds-echos-intro__brand">
            <?php if (!empty($logo['url'])) : ?>
                <img class="ds-echos-intro__logo" src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?: 'ECHO SEO'); ?>">
            <?php else : ?>
                <svg class="ds-echos-intro__logo" viewBox="0 0 200 150" role="img" aria-label="ECHO SEO" xmlns="http://www.w3.org/2000/svg">
                    <path d="M72 6 52 52h20L50 98l46-58H74L92 6z" fill="#F5B800"/>
                    <path d="M58 70c-26 4-46 22-40 42 6 18 34 18 52 6" fill="none" stroke="#F5B800" stroke-width="12" stroke-linecap="round"/>
                    <text x="80" y="118" font-family="'Josefin Sans', sans-serif" font-size="50" font-weight="700" fill="#F5B800">CHO</text>
                    <text x="148" y="146" text-anchor="middle" font-family="'Josefin Sans', sans-serif" font-size="24" fill="#F5B800">SEO</text>
                </svg>
            <?php endif; ?>
        </div>
        <div class="ds-echos-intro__text-block">
            <?php if ($title) : ?>
                <h2 class="ds-echos-intro__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
            <?php if ($sub) : ?>
                <p class="ds-echos-intro__text"><?php echo esc_html($sub); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
