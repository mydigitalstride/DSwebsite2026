<?php
/**
 * Home Services & Trades Landing Page (page-home-services.php).
 *
 * Field group: acf-json/group_home_services_landing.json, shown on pages
 * using the "Home Services Landing Page" template. Like the AEC page, every
 * section reads its ACF fields first and falls back to the launch copy
 * below, so a fresh page renders complete. Sections are removed with the
 * "Hide sections" checkboxes on the Settings tab.
 *
 * The page shares the AEC landing components (aec-landing.css / .js:
 * segment boxes, flip cards, accordion) and adds its own layout tweaks in
 * home-services.css. Link helpers and the testimonial lookup come from
 * inc/aec-landing.php.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('DS_HS_TEMPLATE', 'page-home-services.php');

/**
 * Launch copy used when a field is empty.
 */
function ds_hs_defaults($section) {
    $services = home_url('/services/');
    $contact  = home_url('/contact-us/');

    $defaults = [
        'hero' => [
            'tag'       => 'Who We Serve: Home Services & Trades',
            'headline'  => 'Marketing That Keeps Your Phone Ringing & Trucks Rolling',
            'subtext'   => 'We build simple, data-backed marketing systems designed to get local home service businesses more call volume, steady residential leads, and reliable year-round growth.',
            'primary'   => ['title' => 'Get More Local Calls', 'url' => $contact],
            'secondary' => ['title' => 'View Home Services Case Studies', 'url' => '#hs-testimonials'],
        ],
        'who_we_serve' => [
            'heading'  => 'Built for Local Home Service Businesses & Trades',
            'segments' => [
                ['title' => 'HVAC', 'description' => 'Capture high-intent emergency call volume and seasonal tune-up leads.', 'active' => false],
                ['title' => 'Masons', 'description' => 'Highlight hardscapes, concrete work, and residential masonry projects.', 'active' => false],
                ['title' => 'Landscaping', 'description' => 'Showcase property transformations and secure recurring maintenance contracts.', 'active' => false],
                ['title' => 'Plumbers', 'description' => 'Drive direct call volume for emergency repairs and local pipe installations.', 'active' => false],
                ['title' => 'Roofing', 'description' => 'Win high-value residential roof replacements and storm repair jobs.', 'active' => false],
                ['title' => 'Cleaning', 'description' => 'Build local trust and capture recurring residential or commercial bookings.', 'active' => false],
            ],
        ],
        'value' => [
            'section_tag'     => 'Value Beyond Marketing',
            'section_heading' => 'How We Help Home Service Companies Scale',
            'intro_paragraph' => 'Homeowners don’t shop around for long when a pipe bursts or the AC quits. They call whoever shows up first and looks trustworthy. We put your business in that spot with marketing built around one goal: more booked jobs from your service area, in every season.',
            'value_cards'     => [
                ['icon' => null, 'fa' => 'fa-solid fa-phone-volume', 'title' => 'Consistent Call Volume', 'description' => 'Turn local search traffic into direct phone calls and service bookings month after month.'],
                ['icon' => null, 'fa' => 'fa-solid fa-map-location-dot', 'title' => 'Google Map Pack Dominance', 'description' => 'Show up right at the top when homeowners in your area search for local trades.'],
                ['icon' => null, 'fa' => 'fa-solid fa-snowflake', 'title' => 'Off-Season Lead Flow', 'description' => 'Keep phone calls coming in consistently through both peak seasons and quieter winter months.'],
            ],
        ],
        'tools' => [
            'heading' => 'Simple, Proven Tools to Grow Your Business',
            'pillars' => [
                ['title' => 'Local SEO & Google Maps', 'image' => null, 'overview' => 'High-visibility maps and search placement so local homeowners find you first for emergency and repair jobs.', 'link_text' => 'Explore SEO', 'link' => $services],
                ['title' => 'Google Local Services Ads (LSA)', 'image' => null, 'overview' => 'Pay-per-lead ads with Google Guaranteed badges that place you at the very top when homeowners are searching.', 'link_text' => 'Explore LSA', 'link' => $services],
                ['title' => 'Website Design', 'image' => null, 'overview' => 'Custom, mobile-first, click-to-call digital hubs built to turn visitors into booked service appointments.', 'link_text' => 'Explore Web Design', 'link' => $services],
                ['title' => 'Marketing Retainers', 'image' => null, 'overview' => 'Consistent monthly management to handle your ad spend, secure reviews, and ensure calls keep coming.', 'link_text' => 'Explore Retainers', 'link' => $services],
                ['title' => 'Targeted Digital Ads', 'image' => null, 'overview' => 'High-ROI paid search and social campaigns designed to reach local homeowners when they need your services most.', 'link_text' => 'Explore Ads', 'link' => $services],
            ],
        ],
        'guided' => [
            'heading' => 'What Is Your Biggest Growth Bottleneck Right Now?',
            'tabs'    => [
                ['title' => '“My phone isn’t ringing enough with local emergency or service calls.”', 'content' => '<p>Local SEO and Google Local Services Ads put your business at the top of the map and the search results, right when homeowners nearby need help now.</p>', 'label' => 'Explore Local SEO & LSA', 'link' => $services, 'consult' => false],
                ['title' => '“Our website looks old and doesn’t convert homeowners into bookings.”', 'content' => '<p>A fast, mobile-first site with click-to-call buttons, reviews and clear service areas turns more of your visitors into booked jobs.</p>', 'label' => 'Explore Website Design', 'link' => $services, 'consult' => false],
                ['title' => '“We experience big drops in revenue during slow seasonal months.”', 'content' => '<p>Targeted search and social campaigns promote maintenance plans, off-season services and offers so the schedule stays full year-round.</p>', 'label' => 'Explore Digital Ads', 'link' => $services, 'consult' => false],
                ['title' => '“I’m not sure where to start.”', 'content' => '<p>That’s what a consult is for. We’ll look at your calls, your Google presence and your website, then map out the few changes that will move the needle fastest for your business.</p>', 'label' => 'Book A Consult', 'link' => $contact, 'consult' => true],
            ],
        ],
        'testimonials' => [
            'heading'       => 'Home Services Client Testimonials',
            'taxonomy_slug' => 'home-services',
        ],
    ];

    return $defaults[$section] ?? [];
}

/**
 * Is a section switched off on the Settings tab?
 */
function ds_hs_hidden($section) {
    static $hidden = null;
    if ($hidden === null) {
        $hidden = (array) (get_field('hs_hide_sections') ?: []);
    }
    return in_array($section, $hidden, true);
}

/**
 * Testimonials for the "Home Services Client Testimonials" section.
 *
 * Global testimonials (Theme Settings > Testimonials) whose Industry matches
 * `hs_testimonial_taxonomy_slug` (default "home-services", i.e. the Home
 * Services tag). A quote entered in `custom_quote_override` is featured as
 * the first slide.
 */
function ds_hs_testimonials() {
    $slug     = trim((string) get_field('hs_testimonial_taxonomy_slug')) ?: ds_hs_defaults('testimonials')['taxonomy_slug'];
    $industry = str_replace('-', '_', sanitize_title($slug));
    $items    = function_exists('ds_get_testimonials') ? ds_get_testimonials($industry) : [];

    $quote = trim((string) get_field('custom_quote_override'));
    if ($quote !== '') {
        array_unshift($items, [
            'quote'         => $quote,
            'name'          => (string) get_field('custom_quote_name'),
            'title_company' => (string) get_field('custom_quote_company'),
        ]);
    }

    return $items;
}

/**
 * Page CSS / JS: the shared AEC landing components plus this page's layout.
 */
add_action('wp_enqueue_scripts', function () {
    if (!is_page_template(DS_HS_TEMPLATE)) return;
    wp_enqueue_style('ds-aec-landing', ds_asset_url('assets/css/aec-landing.css'), ['digitalstride-main'], null);
    wp_enqueue_style('ds-home-services', ds_asset_url('assets/css/home-services.css'), ['ds-aec-landing'], null);
    wp_enqueue_script('ds-aec-landing', ds_asset_url('assets/js/aec-landing.js'), ['digitalstride-main'], null, true);
});

add_filter('body_class', function ($classes) {
    if (is_page_template(DS_HS_TEMPLATE)) $classes[] = 'ds-page-hs';
    return $classes;
});

add_filter('ds_show_breadcrumbs', function ($show) {
    return is_page_template(DS_HS_TEMPLATE) ? false : $show;
});
