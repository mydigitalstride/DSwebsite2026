<?php
/**
 * Template Name: DSD Dashboard Page
 *
 * Digital Stride Dashboard (DSD): the reporting perk included with every
 * growth partnership. Sections are fixed (fields: acf-json/group_dsd_*.json,
 * helpers: inc/dsd-dashboard.php); any Page Sections added below them
 * render after this content.
 *
 * Each section renders on its own: if one throws, its partial output is
 * dropped, the rest of the page still renders, the error goes to the PHP
 * error log, and logged-in admins see it in place of the section.
 */
get_header();

foreach (['hero', 'perks', 'comparison', 'industries', 'simulator', 'testimonials', 'cta'] as $section) {
    $level = ob_get_level();
    ob_start();
    try {
        get_template_part('template-parts/dsd/' . $section);
        ob_end_flush();
    } catch (\Throwable $e) {
        while (ob_get_level() > $level) {
            ob_end_clean();
        }
        $where = sprintf('%s (%s:%d)', $e->getMessage(), str_replace(ABSPATH, '', $e->getFile()), $e->getLine());
        error_log('DSD page section "' . $section . '" failed: ' . $where);
        if (current_user_can('manage_options')) {
            printf(
                '<div style="margin:1rem auto;max-width:960px;padding:1rem 1.25rem;border:2px solid #C8372D;background:#fff;color:#141414;font:14px/1.5 monospace">DSD section <strong>%s</strong> failed (only admins see this):<br>%s</div>',
                esc_html($section),
                esc_html(get_class($e) . ': ' . $where)
            );
        }
    }
}

ds_render_flex('page_sections');

get_footer();
