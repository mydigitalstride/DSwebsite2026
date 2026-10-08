<?php
/**
 * Template Name: AEC Landing Page
 *
 * Architecture, Engineering & Construction landing page. Sections are fixed
 * (fields: acf-json/group_aec_landing.json, helpers: inc/aec-landing.php);
 * any Page Sections added below them render after the AEC content.
 */
get_header();

foreach (['hero', 'who-we-serve', 'how-we-help', 'core-pillars', 'guided-pathway', 'clients'] as $section) {
    if (!ds_aec_hidden($section)) {
        get_template_part('template-parts/aec/' . $section);
    }
}

// Site-wide call to action (Theme Settings > Global CTA).
if (!ds_aec_hidden('global-cta')) {
    get_template_part('template-parts/flex', 'global_cta');
}

ds_render_flex('page_sections');

get_footer();
