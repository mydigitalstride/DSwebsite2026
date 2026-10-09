<?php
/**
 * Template Name: Home Services Landing Page
 *
 * Home Services & Trades landing page. Sections are fixed (fields:
 * acf-json/group_home_services_landing.json, helpers: inc/home-services.php)
 * and share the AEC landing components; any Page Sections added below them
 * render after this content.
 */
get_header();

foreach (['hero', 'who-we-serve', 'value', 'tools', 'pathway', 'testimonials'] as $section) {
    if (!ds_hs_hidden($section)) {
        get_template_part('template-parts/home-services/' . $section);
    }
}

// Site-wide call to action (Theme Settings > Global CTA).
if (!ds_hs_hidden('global-cta')) {
    get_template_part('template-parts/flex', 'global_cta');
}

ds_render_flex('page_sections');

get_footer();
