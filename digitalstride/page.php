<?php
get_header();
while (have_posts()) : the_post();
    ds_render_flex('page_sections');
endwhile;
get_footer();
