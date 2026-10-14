<?php
/**
 * Realtors & Real Estate Agencies Landing Page (page-realtors.php).
 *
 * Field group: acf-json/group_realtors_landing.json, shown on pages using
 * the "Realtors Landing Page" template. Like the AEC and Home Services
 * pages, every section reads its ACF fields first and falls back to the
 * launch copy below, so a fresh page renders complete. Sections are removed
 * with the "Hide sections" checkboxes on the Settings tab.
 *
 * Shares the AEC landing components (aec-landing.css: hero overlay, section
 * spacing, value cards) and adds its own in realtors.css / realtors.js
 * (comparison table, capability card deck). Link helpers and the global
 * testimonial lookup come from inc/aec-landing.php.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('DS_RLT_TEMPLATE', 'page-realtors.php');

/**
 * Launch copy used when a field is empty.
 */
function ds_rlt_defaults($section) {
    $services = home_url('/services/');
    $contact  = home_url('/contact-us/');

    $defaults = [
        'hero' => [
            'subheadline' => 'Who We Serve: Realtors & Real Estate Agencies',
            'headline'    => 'Dominate Your Local Market & Turn Clicks Into Closing Table Handshakes',
            'description' => 'Stop losing premium listings to high-budget brokerages. We build high-converting digital pipelines, hyper-local SEO, and automated lead capture systems tailored for realtors.',
            'cta_text'    => 'Build Your Real Estate Growth Blueprint',
            'cta_url'     => $contact,
        ],
        'pain_points' => [
            'title' => 'Why Traditional Marketing Fails Realtors',
            'cards' => [
                ['card_title' => 'Zillow/Portal Dependency', 'card_description' => 'Paying thousands monthly for leads that are shared with 5 other agents.'],
                ['card_title' => 'Low-Quality Paid Leads', 'card_description' => 'Cold leads that never answer the phone or aren’t pre-approved.'],
                ['card_title' => 'Outdated Websites', 'card_description' => 'Generic templates that don’t showcase listings or local authority.'],
            ],
        ],
        'comparison' => [
            'title'          => 'Why Top Agents Partner With Digital Stride',
            'col1_heading'   => 'Traditional Agent Approach',
            'col1_subheading' => '(What most realtors rely on)',
            'col2_heading'   => 'Digital Stride System',
            'col2_subheading' => '(How we help you dominate local listings)',
            'rows'           => [
                ['bad_point_text' => 'Standard MLS links with low-res photos', 'good_point_text' => 'Custom single-property websites'],
                ['bad_point_text' => 'Generic brokerage templates with no SEO', 'good_point_text' => 'High-converting personal agent platform'],
                ['bad_point_text' => 'Inconsistent social media posts', 'good_point_text' => 'Streaming TV & targeted neighborhood ads'],
                ['bad_point_text' => 'Hope-based open house traffic', 'good_point_text' => 'Automated seller lead valuation funnels'],
            ],
        ],
        'capabilities' => [
            'title' => 'Digital Infrastructure Built For Top Producers',
            'cards' => [
                [
                    'tag_text'         => 'Website Design & Local Platforms',
                    'card_title'       => 'High-Converting Agent & Property Sites',
                    'card_description' => 'Ditch generic brokerage templates and slow MLS embeds. We build custom, fast-loading digital platforms and single-property showcase pages that position you as the premium choice for local buyers and sellers.',
                    'button_text'      => 'Explore Website Design',
                    'button_url'       => $services,
                    'card_image'       => null,
                    'card_icon'        => 'fa-solid fa-laptop-code',
                ],
                [
                    'tag_text'         => 'Local SEO & Google Maps',
                    'card_title'       => 'Hyper-Local Search Dominance',
                    'card_description' => 'Be the first agent home sellers see when searching in your target zip codes. We optimize your local search presence, so you capture organic leads before competitors even know they are looking.',
                    'button_text'      => 'Explore Local SEO',
                    'button_url'       => home_url('/search-engine-optimization/'),
                    'card_image'       => null,
                    'card_icon'        => 'fa-solid fa-map-location-dot',
                ],
                [
                    'tag_text'         => 'Digital Advertising & Lead Funnels',
                    'card_title'       => 'Exclusive Homeowner Lead Engines',
                    'card_description' => 'Stop paying portal sites for cold leads resold to five other agents. We launch custom digital advertising campaigns that bring motivated buyers and pre-qualified home sellers straight to your inbox.',
                    'button_text'      => 'Explore Paid Ads',
                    'button_url'       => $services,
                    'card_image'       => null,
                    'card_icon'        => 'fa-solid fa-bullseye',
                ],
                [
                    'tag_text'         => 'Media Production & OTT Advertising',
                    'card_title'       => 'Premium Brand & Property Media',
                    'card_description' => 'Win listing presentations with high-end visual assets. From crisp photography to targeted streaming TV campaigns, we give your personal brand the polished, big-agency presence it deserves.',
                    'button_text'      => 'Explore Photography & TV',
                    'button_url'       => $services,
                    'card_image'       => null,
                    'card_icon'        => 'fa-solid fa-camera',
                ],
            ],
        ],
        'spotlight' => [
            'title'         => 'Featured Partner Spotlight',
            'mode'       => 'auto',
            'industries' => ['realtors'],
        ],
        'faq' => [
            'title' => 'FAQ',
            'faqs'  => [
                ['question' => 'How are your leads different from Zillow, Realtor.com, or traditional portals?', 'answer' => '<p>Portal leads are sold to several agents at once, so you are racing four or five competitors to the same phone number. The leads we generate come from your own website, ads, and search listings, so every inquiry is exclusive to you and already familiar with your brand.</p>'],
                ['question' => 'I already have a brokerage website provided by my firm. Why do I need a custom site?', 'answer' => '<p>Brokerage sites promote the brokerage, not you. They share one template across hundreds of agents, rank for the firm’s name, and go with you nowhere if you switch offices. A custom platform builds search authority and a lead database that belong to your personal brand.</p>'],
                ['question' => 'How fast can we expect to see results?', 'answer' => '<p>Digital advertising campaigns and instant home valuation funnels generate exclusive inbound inquiries within the first 7 to 14 days of launch. Organic search engine optimization and local Google Map Pack rankings typically build dominant, compound lead flow within 60 to 90 days.</p>'],
                ['question' => 'Can you target specific luxury subdivisions, neighborhoods, or zip codes?', 'answer' => '<p>Yes. Ads, streaming TV, and local SEO pages can all be focused on the exact neighborhoods, subdivisions, and zip codes you want to farm, so your budget goes toward the listings you actually want to win.</p>'],
            ],
        ],
    ];

    return $defaults[$section] ?? [];
}

/**
 * Is this request rendering the Realtors template? Covers pages that have
 * the template assigned and a page with the slug "realtors" (which WordPress
 * routes to page-realtors.php on its own).
 */
function ds_rlt_is_page() {
    if (is_page_template(DS_RLT_TEMPLATE)) return true;
    return is_page() && !empty($GLOBALS['template']) && basename($GLOBALS['template']) === DS_RLT_TEMPLATE;
}

/**
 * Is a section switched off on the Settings tab?
 */
function ds_rlt_hidden($section) {
    static $hidden = null;
    if ($hidden === null) {
        $hidden = (array) (get_field('rlt_hide_sections') ?: []);
    }
    return in_array($section, $hidden, true);
}

/**
 * Rows of a repeater, or the launch copy when it has none. Rows with every
 * listed key empty are dropped.
 */
function ds_rlt_rows($field, $fallback, array $required) {
    $rows = get_field($field);
    $rows = is_array($rows) && $rows ? $rows : $fallback;

    return array_values(array_filter((array) $rows, function ($row) use ($required) {
        foreach ($required as $key) {
            if (!empty($row[$key])) return true;
        }
        return false;
    }));
}

/**
 * Testimonials for the "Featured Partner Spotlight" section, by `s4_mode`:
 *
 * auto:     global testimonials (Theme Settings > Testimonials) tagged with
 *           any Industry ticked in `s4_industries` (default Realtors).
 * selected: the global testimonials ticked in `s4_selected_testimonials`.
 * manual:   the quotes entered in `s4_manual_testimonials` on this page.
 *
 * Nothing matching means the section is left out (an HTML comment tells
 * logged-in editors why).
 */
function ds_rlt_testimonials() {
    $d    = ds_rlt_defaults('spotlight');
    $mode = get_field('s4_mode') ?: $d['mode'];

    if ($mode === 'manual') {
        $out = [];
        foreach ((array) get_field('s4_manual_testimonials') as $item) {
            if (empty($item['quote'])) continue;
            $out[] = [
                'quote'         => $item['quote'],
                'name'          => $item['name'] ?? '',
                'title_company' => $item['title_company'] ?? '',
                'image'         => $item['image'] ?? null,
            ];
        }
        return $out;
    }

    if (!function_exists('ds_get_testimonials')) return [];

    if ($mode === 'selected') {
        $picked = array_filter((array) get_field('s4_selected_testimonials'));
        return array_values(array_filter(ds_get_testimonials(), function ($t) use ($picked) {
            return in_array($t['id'], $picked, true);
        }));
    }

    // auto: by ticked industries. A page saved before any box was ticked
    // falls back to the default (Realtors).
    $industries = array_filter((array) get_field('s4_industries')) ?: $d['industries'];
    return array_values(array_filter(ds_get_testimonials(), function ($t) use ($industries) {
        return (bool) array_intersect($industries, $t['industries']);
    }));
}

/**
 * Fill the Spotlight checklists from Theme Settings > Testimonials: the
 * Industry choices, and one box per testimonial.
 */
add_filter('acf/load_field/key=field_rlt_s4_industries', function ($field) {
    $industry = function_exists('acf_get_field') ? acf_get_field('field_gtm_industry') : null;
    if (!empty($industry['choices'])) {
        $field['choices'] = $industry['choices'];
    }
    return $field;
});

add_filter('acf/load_field/key=field_rlt_s4_selected', function ($field) {
    $choices = [];
    foreach (ds_get_testimonials() as $t) {
        $label = $t['name'] ?: __('(no name)', 'digitalstride');
        if ($t['title_company']) $label .= ' — ' . $t['title_company'];
        $label .= ': “' . wp_trim_words($t['quote'], 10, '…') . '”';
        $choices[$t['id']] = $label;
    }
    $field['choices'] = $choices;
    return $field;
});

/**
 * Page CSS / JS: the shared AEC landing components plus this page's own.
 */
add_action('wp_enqueue_scripts', function () {
    if (!ds_rlt_is_page()) return;
    wp_enqueue_style('ds-aec-landing', ds_asset_url('assets/css/aec-landing.css'), ['digitalstride-main'], null);
    wp_enqueue_style('ds-realtors', ds_asset_url('assets/css/realtors.css'), ['ds-aec-landing'], null);
    wp_enqueue_script('ds-realtors', ds_asset_url('assets/js/realtors.js'), ['digitalstride-main'], null, true);
});

add_filter('body_class', function ($classes) {
    if (ds_rlt_is_page()) $classes[] = 'ds-page-rlt';
    return $classes;
});

add_filter('ds_show_breadcrumbs', function ($show) {
    return ds_rlt_is_page() ? false : $show;
});
