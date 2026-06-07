<?php
/**
 * Front Page — Homepage template.
 * WordPress loads this automatically when a static front page is set.
 * Content is managed entirely through ACF flexible content.
 */
get_header();
ds_render_flex('page_sections');
get_footer();
