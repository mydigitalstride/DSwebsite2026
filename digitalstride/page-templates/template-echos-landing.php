<?php
/**
 * Template Name: ECHO SEO Landing Page
 *
 * ECHO SEO product page. Sections are fixed (fields and helpers:
 * inc/echos-landing.php, styles: assets/css/echos.css on top of the shared
 * aec-landing components); any Page Sections added below them render after
 * this content.
 */
get_header();

foreach (['hero', 'intro', 'compare', 'features', 'pricing', 'steps', 'cta'] as $section) {
    if (!ds_echos_hidden($section)) {
        get_template_part('template-parts/echos/' . $section);
    }
}

ds_render_flex('page_sections');

get_footer();
