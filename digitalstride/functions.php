<?php
/**
 * Digital Stride Theme Functions
 */

define('DS_VERSION', '2.1.0');
define('DS_DIR', get_template_directory());
define('DS_URI', get_template_directory_uri());

// ── Theme Setup ──────────────────────────────────────
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('custom-logo');
    add_theme_support('menus');

    register_nav_menus([
        'primary' => __('Primary Menu', 'digitalstride'),
        'footer'  => __('Footer Menu', 'digitalstride'),
    ]);

    add_image_size('partner-logo', 200, 100, false);
    add_image_size('team-photo', 400, 400, true);
    add_image_size('hero-bg', 1920, 900, true);
    add_image_size('card-thumb', 600, 400, true);
});

// ── Enqueue Assets ───────────────────────────────────
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Merriweather+Sans:wght@300;400;500;600;700&display=swap',
        [],
        null
    );
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', [], '6.5.0');
    wp_enqueue_style('digitalstride-main', DS_URI . '/assets/css/digitalstride-main.min.css', ['google-fonts', 'font-awesome'], DS_VERSION);
    wp_enqueue_script('digitalstride-main', DS_URI . '/assets/js/main.js', [], DS_VERSION, true);
});

// ── ACF JSON Sync ────────────────────────────────────
add_filter('acf/settings/save_json', function () {
    return DS_DIR . '/acf-json';
});
add_filter('acf/settings/load_json', function ($paths) {
    $paths[] = DS_DIR . '/acf-json';
    return $paths;
});

// ── ACF Init: Options Pages + Fields ─────────────────
add_action('acf/init', function () {
    // Options pages
    acf_add_options_page([
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug'  => 'theme-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
    ]);
    acf_add_options_sub_page([
        'page_title'  => 'Header & Menu',
        'menu_title'  => 'Header & Menu',
        'parent_slug' => 'theme-settings',
    ]);
    acf_add_options_sub_page([
        'page_title'  => 'Footer Settings',
        'menu_title'  => 'Footer',
        'parent_slug' => 'theme-settings',
    ]);
    acf_add_options_sub_page([
        'page_title'  => 'Global CTA',
        'menu_title'  => 'Global CTA',
        'menu_slug'   => 'acf-options-global-cta',
        'parent_slug' => 'theme-settings',
    ]);
    acf_add_options_sub_page([
        'page_title'  => 'Global Testimonials',
        'menu_title'  => 'Testimonials',
        'menu_slug'   => 'acf-options-global-testimonials',
        'parent_slug' => 'theme-settings',
    ]);
    acf_add_options_sub_page([
        'page_title'  => 'Global Partners',
        'menu_title'  => 'Partners / Clients',
        'menu_slug'   => 'acf-options-global-partners',
        'parent_slug' => 'theme-settings',
    ]);
    acf_add_options_sub_page([
        'page_title'  => 'Global Core Values',
        'menu_title'  => 'Core Values',
        'menu_slug'   => 'acf-options-global-core-values',
        'parent_slug' => 'theme-settings',
    ]);

    // Register field groups
    require_once DS_DIR . '/inc/acf-fields.php';
});

// ── Disable Gutenberg + classic editor body for pages ─
// Pages are built entirely with ACF flexible content.
// The block editor and classic editor textarea are hidden so
// editors only see the title field + ACF sections below it.
add_filter('use_block_editor_for_post_type', function ($use, $post_type) {
    if ($post_type === 'page') return false;
    return $use;
}, 10, 2);

add_action('init', function () {
    remove_post_type_support('page', 'editor');
});

// ── Includes ─────────────────────────────────────────
require_once DS_DIR . '/inc/helpers.php';
