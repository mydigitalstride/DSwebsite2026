<?php
/**
 * Digital Stride Dashboard (DSD) page (page-dsd.php).
 *
 * DSD is positioned as a perk included with every growth partnership, not a
 * standalone product. Section order: hero + perks ribbon, the interactive
 * lead simulator, the agency comparison, industry solutions, testimonials.
 *
 * Field groups (one per section, all shown on the "DSD Dashboard Page"
 * template): acf-json/group_dsd_hero.json, group_dsd_simulator.json,
 * group_dsd_comparison.json, group_dsd_industries.json and
 * group_dsd_testimonials.json. Every section reads its ACF fields first and
 * falls back to the launch copy below, so a fresh page renders complete.
 *
 * Page CSS / JS: assets/css/dsd.css, assets/js/dsd.js. The testimonial
 * carousel (arrows, dots, pause button) is the site one in main.js.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('DS_DSD_TEMPLATE', 'page-dsd.php');

/**
 * Launch copy used when a field is empty.
 */
function ds_dsd_defaults($section) {
    $contact = home_url('/contact-us/');

    $defaults = [
        'hero' => [
            'eyebrow'   => 'Digital Stride Dashboard (DSD)',
            'title'     => 'The Transparency You Deserve. No Status Meetings Required.',
            'subtitle'  => 'When you’re running a trade, contracting, or real estate business, you don’t have time to wait for monthly PDFs or status calls. DSD gives you 24/7 real-time visibility into every lead, call, and dollar spent.',
            'cta_label' => 'Unlock Your Benefits',
            'cta_url'   => $contact,
            'perks'     => [
                ['icon' => null, 'fa' => 'fa-solid fa-bolt', 'title' => 'Zero Wait Time', 'subtitle' => 'Always-on analytics'],
                ['icon' => null, 'fa' => 'fa-solid fa-phone-volume', 'title' => 'Every Call Recorded', 'subtitle' => 'Listen from the job site'],
                ['icon' => null, 'fa' => 'fa-solid fa-envelope-open-text', 'title' => 'Instant Lead Alerts', 'subtitle' => 'Email & text the moment they land'],
                ['icon' => null, 'fa' => 'fa-solid fa-thumbs-up', 'title' => '1-Click Approvals', 'subtitle' => 'Sign off on creative in seconds'],
            ],
        ],
        'simulator' => [
            'headline'     => 'Test The DSD Trade Simulator',
            'subheadline'  => 'Experience how easy it is to review inbound calls, tag lead statuses, and track revenue right from your phone or job site.',
            'pipeline_val' => 124500,
        ],
        'comparison' => [
            'headline'          => 'Why Traditional Agency Reporting Fails',
            'subheadline'       => 'Most agencies hide behind vanity metrics and end-of-month PDFs. Here is how we do it differently.',
            'traditional_title' => 'Traditional Marketing Agencies',
            'dsd_title'         => 'Digital Stride + DSD Included',
            'dsd_badge'         => 'Included Free',
            'traditional'       => [
                ['item' => 'Results arrive weeks late in an end-of-month PDF'],
                ['item' => 'Vanity metrics: impressions, clicks and “reach”'],
                ['item' => 'Endless status meetings just to get an update'],
                ['item' => 'No idea which calls turned into paying jobs'],
                ['item' => 'Creative approvals lost in long email threads'],
            ],
            'dsd'               => [
                ['item' => 'Real-time ROI, 24/7, from any phone or job site'],
                ['item' => 'Revenue tracked to the lead, job and ad that drove it'],
                ['item' => 'Every inbound call recorded and ready to play back'],
                ['item' => 'Full transparency on spend: no status calls required'],
                ['item' => '1-click approvals for ads, pages and media'],
            ],
        ],
        'industries' => [
            'headline'    => 'Tailored Solutions For Your Industry',
            'subheadline' => 'DSD is configured around how your business actually wins work, so the numbers you see are the numbers you care about.',
            'cards'       => [
                [
                    'industry_title' => 'HVAC, Plumbing, Roofing & Electrical',
                    'industry_desc'  => 'Know which calls became booked jobs, and which ads paid for the truck roll.',
                    'industry_icon'  => 'fa-solid fa-screwdriver-wrench',
                    'feature_points' => [
                        ['point' => 'Real-time call recording & playback'],
                        ['point' => 'Local Services Ads (LSA) lead tracking'],
                        ['point' => 'Job-value attribution by campaign'],
                    ],
                ],
                [
                    'industry_title' => 'AEC & General Contractors',
                    'industry_desc'  => 'Keep long sales cycles and big-ticket bids visible from first inquiry to signed contract.',
                    'industry_icon'  => 'fa-solid fa-helmet-safety',
                    'feature_points' => [
                        ['point' => 'Drone photo & video asset approvals'],
                        ['point' => 'Commercial contract & bid tracking'],
                        ['point' => 'Localized landing page reviews'],
                    ],
                ],
                [
                    'industry_title' => 'Realtors & Real Estate',
                    'industry_desc'  => 'See every buyer and seller inquiry the moment it lands, and how fast your team responded.',
                    'industry_icon'  => 'fa-solid fa-house-chimney',
                    'feature_points' => [
                        ['point' => 'Listing inquiry tracking'],
                        ['point' => 'Meta retargeting lead feeds'],
                        ['point' => 'Speed-to-lead notification logs'],
                    ],
                ],
            ],
        ],
        'testimonials' => [
            'title' => 'Partner Feedback',
        ],
    ];

    return $defaults[$section] ?? [];
}

/**
 * Sample leads shown in the simulator. Demo data only (555 numbers); edit
 * here or with the `ds_dsd_sim_leads` filter.
 *
 * category: trades | aec | realty. status: one of ds_dsd_statuses().
 * duration: call length in seconds for the simulated player.
 */
function ds_dsd_sim_leads() {
    $leads = [
        ['name' => 'Robert Miller', 'phone' => '(555) 234-8901', 'service' => 'Full Roof Replacement', 'value' => 18500, 'source' => 'Google PPC', 'status' => 'Estimate Scheduled', 'time' => '12m ago', 'category' => 'trades', 'duration' => 154],
        ['name' => 'Sarah Jenkins', 'phone' => '(555) 876-5432', 'service' => 'Emergency HVAC Repair', 'value' => 1200, 'source' => 'LSA', 'status' => 'Booked / Sold', 'time' => '45m ago', 'category' => 'trades', 'duration' => 97],
        ['name' => 'Dale Okafor', 'phone' => '(555) 410-7781', 'service' => 'Electrical Panel Upgrade', 'value' => 3400, 'source' => 'LSA', 'status' => 'New Lead', 'time' => '2h ago', 'category' => 'trades', 'duration' => 128],
        ['name' => 'Apex Commercial Group', 'phone' => '(555) 901-2345', 'service' => 'Warehouse Buildout', 'value' => 125000, 'source' => 'Google PPC', 'status' => 'Estimate Scheduled', 'time' => '1h ago', 'category' => 'aec', 'duration' => 312],
        ['name' => 'Linda Park', 'phone' => '(555) 332-6610', 'service' => 'Custom Home Build', 'value' => 640000, 'source' => 'Meta Retargeting', 'status' => 'New Lead', 'time' => '3h ago', 'category' => 'aec', 'duration' => 246],
        ['name' => 'Harbor Dental Partners', 'phone' => '(555) 718-4402', 'service' => 'Office Remodel', 'value' => 86000, 'source' => 'Google PPC', 'status' => 'Booked / Sold', 'time' => '5h ago', 'category' => 'aec', 'duration' => 189],
        ['name' => 'Marcus Thorne', 'phone' => '(555) 678-9012', 'service' => 'Seller Listing ($750k)', 'value' => 22500, 'source' => 'Meta Retargeting', 'status' => 'Booked / Sold', 'time' => '30m ago', 'category' => 'realty', 'duration' => 173],
        ['name' => 'Priya Desai', 'phone' => '(555) 245-0937', 'service' => 'Buyer Consultation ($480k)', 'value' => 14400, 'source' => 'Google PPC', 'status' => 'New Lead', 'time' => '1h ago', 'category' => 'realty', 'duration' => 82],
        ['name' => 'Westgate Properties LLC', 'phone' => '(555) 563-1184', 'service' => 'Property Management (24 units)', 'value' => 28800, 'source' => 'LSA', 'status' => 'Disqualified', 'time' => '4h ago', 'category' => 'realty', 'duration' => 61],
    ];

    return apply_filters('ds_dsd_sim_leads', $leads);
}

function ds_dsd_statuses() {
    return ['New Lead', 'Booked / Sold', 'Estimate Scheduled', 'Disqualified'];
}

function ds_dsd_industries() {
    return [
        'trades' => 'Home Services & Trades',
        'aec'    => 'AEC & Contractors',
        'realty' => 'Realtors & Real Estate',
    ];
}

/**
 * CSS modifier for a status, e.g. "Booked / Sold" → "booked---sold"
 * (same rule as dsd.js uses when the status changes).
 */
function ds_dsd_status_class($status) {
    return preg_replace('/[^a-z0-9]/', '-', strtolower($status));
}

/**
 * Is this request rendering the DSD template? Covers pages that have the
 * template assigned and a page with the slug "dsd" (which WordPress routes
 * to page-dsd.php on its own).
 */
function ds_dsd_is_page() {
    if (is_page_template(DS_DSD_TEMPLATE)) return true;
    return is_page() && !empty($GLOBALS['template']) && basename($GLOBALS['template']) === DS_DSD_TEMPLATE;
}

/**
 * Rows of a repeater, or the launch copy when it has none. Rows with every
 * listed key empty are dropped.
 */
function ds_dsd_rows($field, $fallback, array $required) {
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
 * Partner Feedback quotes: this page's `testimonials` repeater, or the
 * global testimonials (Theme Settings > Testimonials) when it is empty.
 */
function ds_dsd_testimonials() {
    $out = [];
    foreach ((array) get_field('testimonials') as $item) {
        if (empty($item['quote'])) continue;
        $out[] = [
            'quote'   => $item['quote'],
            'name'    => $item['client_name'] ?? '',
            'company' => $item['company_name'] ?? '',
            'avatar'  => $item['avatar'] ?? null,
        ];
    }
    if ($out || !function_exists('ds_get_testimonials')) return $out;

    foreach (ds_get_testimonials() as $t) {
        $out[] = ['quote' => $t['quote'], 'name' => $t['name'], 'company' => $t['title_company'], 'avatar' => null];
    }
    return $out;
}

/**
 * Page CSS / JS.
 */
add_action('wp_enqueue_scripts', function () {
    if (!ds_dsd_is_page()) return;
    wp_enqueue_style('ds-dsd', ds_asset_url('assets/css/dsd.css'), ['digitalstride-main'], null);
    wp_enqueue_script('ds-dsd', ds_asset_url('assets/js/dsd.js'), ['digitalstride-main'], null, true);
});

add_filter('body_class', function ($classes) {
    if (ds_dsd_is_page()) $classes[] = 'ds-page-dsd';
    return $classes;
});

add_filter('ds_show_breadcrumbs', function ($show) {
    return ds_dsd_is_page() ? false : $show;
});
