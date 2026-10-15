<?php
/**
 * Template Name: ECHO SEO Landing Page
 *
 * ECHO SEO product page. Sections are fixed (fields and helpers:
 * inc/echos-landing.php, styles: assets/css/echos.css) and end with the
 * page's own call to action instead of the Global CTA; any Page Sections
 * added below them render after this content.
 */
get_header();
?>
<svg width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false">
    <defs>
        <linearGradient id="ds-echos-gradient-gold" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#FFC700"/>
            <stop offset="100%" stop-color="#F5B800"/>
        </linearGradient>
    </defs>
</svg>
<?php

foreach (['hero', 'intro', 'compare', 'features', 'pricing', 'steps', 'cta'] as $section) {
    if (!ds_echos_hidden($section)) {
        get_template_part('template-parts/echos/' . $section);
    }
}

ds_render_flex('page_sections');

get_footer();
