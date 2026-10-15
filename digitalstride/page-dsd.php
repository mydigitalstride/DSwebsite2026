<?php
/**
 * Template Name: DSD Dashboard Page
 *
 * Digital Stride Dashboard (DSD): the reporting perk included with every
 * growth partnership. Sections are fixed (fields: acf-json/group_dsd_*.json,
 * helpers: inc/dsd-dashboard.php); any Page Sections added below them
 * render after this content.
 */
get_header();

foreach (['hero', 'simulator', 'comparison', 'industries', 'testimonials'] as $section) {
    get_template_part('template-parts/dsd/' . $section);
}

// Site-wide call to action (Theme Settings > Global CTA).
get_template_part('template-parts/flex', 'global_cta');

ds_render_flex('page_sections');

get_footer();
