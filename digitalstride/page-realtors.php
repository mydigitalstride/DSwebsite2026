<?php
/**
 * Template Name: Realtors Landing Page
 *
 * Who We Serve: Realtors & Real Estate Agencies. Sections are fixed (fields:
 * acf-json/group_realtors_landing.json, helpers: inc/realtors.php) and share
 * the AEC landing components; any Page Sections added below them render
 * after this content.
 */
get_header();

foreach (['hero', 'pain-points', 'comparison', 'capabilities', 'spotlight', 'faq'] as $section) {
    if (!ds_rlt_hidden($section)) {
        get_template_part('template-parts/realtors/' . $section);
    }
}

// Site-wide call to action (Theme Settings > Global CTA).
if (!ds_rlt_hidden('global-cta')) {
    get_template_part('template-parts/flex', 'global_cta');
}

ds_render_flex('page_sections');

get_footer();
