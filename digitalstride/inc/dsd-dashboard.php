<?php
/**
 * Digital Stride Dashboard (DSD) page (page-dsd.php).
 *
 * DSD is positioned as a perk included with every growth partnership, not a
 * standalone product. Section order follows the approved mockup: hero, perks
 * row, agency comparison, industry tabs, lead simulator (+ partner CTA),
 * testimonials and the DSD call to action.
 *
 * Field groups (one per section, all shown on the "DSD Dashboard Page"
 * template): acf-json/group_dsd_hero.json, group_dsd_simulator.json,
 * group_dsd_comparison.json, group_dsd_industries.json and
 * group_dsd_testimonials.json. Every section reads its ACF fields first and
 * falls back to the launch copy below, so a fresh page renders complete.
 *
 * Page CSS / JS: assets/css/dsd.css, assets/js/dsd.js. The testimonial
 * carousel (arrows, dots, pause button) is the site one in main.js, and
 * the closing CTA reuses the Global CTA layout with DSD copy.
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
            'subtitle'  => 'When you partner with Digital Stride, you get more than growth marketing. You receive full, 24/7 access to DSD (Digital Stride Dashboard), your personal live control center for data and reports, task approvals, and real-time agency visibility.',
            'cta_label' => 'Unlock Your Benefits',
            'cta_url'   => $contact,
            'perks'     => [
                ['icon' => null, 'fa' => 'fa-solid fa-bolt', 'title' => 'Zero Wait Time', 'subtitle' => 'Live metric streams update instantly.'],
                ['icon' => null, 'fa' => 'fa-solid fa-phone-volume', 'title' => 'Lead Feed & Audio Logs', 'subtitle' => 'Every call from Google Local Services Ads (LSA) is recorded and transcribed.'],
                ['icon' => null, 'fa' => 'fa-solid fa-envelope-open-text', 'title' => '80% Fewer Emails', 'subtitle' => 'Everything centralized in one place.'],
                ['icon' => null, 'fa' => 'fa-solid fa-thumbs-up', 'title' => '1-Click Approvals', 'subtitle' => 'Approve copy & creative in seconds.'],
            ],
        ],
        'comparison' => [
            'eyebrow'           => 'The Digital Stride Difference',
            'headline'          => 'Why Traditional Agency Reporting Fails',
            'subheadline'       => 'We built DSD to eliminate the anxiety, obscurity, and back-and-forth emails of standard agency retainers.',
            'traditional_title' => 'Traditional Marketing Agencies',
            'dsd_title'         => 'Digital Stride + DSD Included',
            'dsd_badge'         => 'Included Free',
            'traditional'       => [
                ['item' => 'Zero Phone Call Audit Access', 'item_desc' => 'You have no idea if phone leads were actually qualified or if the receptionist dropped the ball.'],
                ['item' => 'Outdated Monthly PDF Reports', 'item_desc' => 'You receive metrics 30 days late, after ad dollars have already been wasted.'],
                ['item' => 'Constant “Status Update” Meetings', 'item_desc' => 'Wasting valuable hours sitting in meetings just to ask “How are campaigns performing?”'],
                ['item' => 'Slow Email Approval Bottlenecks', 'item_desc' => 'Creative sits in long email threads for days while campaigns wait to launch.'],
            ],
            'dsd'               => [
                ['item' => 'Live Call Audio Recordings & Transcripts', 'item_desc' => 'Hear exactly how every lead was handled and whether it was qualified.'],
                ['item' => 'Single Centralized Asset & Milestone Hub', 'item_desc' => 'Log in anytime to see real-time leads, conversion rates, and ROAS performance.'],
                ['item' => 'Reclaim 5+ Hours Every Single Week', 'item_desc' => 'No status check calls needed. You have total answers at your fingertips 24/7.'],
                ['item' => '1-Tap Field Asset Approvals', 'item_desc' => 'Approve ads, photos and pages from the job site in seconds.'],
            ],
        ],
        'industries' => [
            'eyebrow'     => 'Built for Your Exact Sector',
            'headline'    => 'Tailored Solutions For Your Industry',
            'subheadline' => 'Select your sector to view custom DSD client portal perks.',
            'cards'       => [
                [
                    'industry_title' => 'Home Services & Trades',
                    'panel_title'    => 'HVAC, Plumbing, Roofing, & Electrical Contractors',
                    'industry_desc'  => 'Capture high-intent emergency service calls and replacement leads.',
                    'feature_points' => [
                        ['point' => 'LSA Call Recording', 'point_desc' => 'Listen to emergency repair calls to ensure your dispatch team converts incoming leads.', 'point_icon' => 'fa-solid fa-phone-volume'],
                        ['point' => 'Local Services Radius', 'point_desc' => 'See cost per lead broken down by zip codes and service territories.', 'point_icon' => 'fa-solid fa-map-location-dot'],
                        ['point' => 'Job Ticket Tracking', 'point_desc' => 'Log high-value system replacements vs. minor repair service tickets.', 'point_icon' => 'fa-solid fa-clipboard-list'],
                    ],
                ],
                [
                    'industry_title' => 'AEC & General Contractors',
                    'panel_title'    => 'Architects, Engineers, Custom Home & Commercial Builders',
                    'industry_desc'  => 'Keep long sales cycles and big-ticket bids visible from first inquiry to signed contract.',
                    'feature_points' => [
                        ['point' => 'Drone Asset Approvals', 'point_desc' => 'Review and approve drone photo and video of active projects from the job site.', 'point_icon' => 'fa-solid fa-camera'],
                        ['point' => 'Commercial Contract Tracking', 'point_desc' => 'Follow bids and contract values from first inquiry through signed agreement.', 'point_icon' => 'fa-solid fa-file-signature'],
                        ['point' => 'Local Landing Page Reviews', 'point_desc' => 'Sign off on localized service-area pages before they go live.', 'point_icon' => 'fa-solid fa-laptop-code'],
                    ],
                ],
                [
                    'industry_title' => 'Realtors & Real Estate Agencies',
                    'panel_title'    => 'Realtors, Brokers & Property Managers',
                    'industry_desc'  => 'See every buyer and seller inquiry the moment it lands, and how fast your team responded.',
                    'feature_points' => [
                        ['point' => 'Listing Inquiry Tracking', 'point_desc' => 'See which listings and neighborhoods drive buyer and seller inquiries.', 'point_icon' => 'fa-solid fa-house-chimney'],
                        ['point' => 'Meta Retargeting Feeds', 'point_desc' => 'Watch retargeted Facebook and Instagram leads arrive in real time.', 'point_icon' => 'fa-solid fa-bullseye'],
                        ['point' => 'Speed-to-Lead Logs', 'point_desc' => 'Track how quickly every inquiry received a call back or reply.', 'point_icon' => 'fa-solid fa-stopwatch'],
                    ],
                ],
            ],
        ],
        'simulator' => [
            'headline'      => 'Test The DSD Trade Simulator',
            'subheadline'   => 'Click through the tabs below to test how easy it is to review leads, track ROI, and approve assets from your phone.',
            'pipeline_val'  => 124500,
            'partner_label' => 'Already a Digital Stride Partner?',
            'partner_btn'   => 'Test Your Capabilities',
            'partner_url'   => 'https://partners.mydigitalstride.com/partner-login/',
        ],
        'testimonials' => [
            'title' => 'Partner Feedback',
        ],
        'cta' => [
            'heading' => 'Ready For Full Growth Transparency?',
            'text'    => "Partner with Digital Stride & Get DSD Included Free.\nBook a 15-minute introductory strategy session. We’ll audit your current growth channels and show you a live walkthrough of DSD tailored to your brand.",
            'btn'     => 'Book Strategy Call + See DSD Live',
            'url'     => $contact,
        ],
    ];

    return $defaults[$section] ?? [];
}

/**
 * Sample leads shown in the simulator. Demo data only (555 numbers); edit
 * here or with the `ds_dsd_sim_leads` filter.
 *
 * category: trades | aec | realty. type: Inbound Call | Web Form.
 * source: Google LSA | Google PPC | Meta Retargeting.
 * status: one of ds_dsd_statuses(). duration: call length in seconds.
 */
function ds_dsd_sim_leads() {
    $leads = [
        ['name' => 'David Miller', 'phone' => '(555) 234-8901', 'service' => 'Commercial HVAC Chiller Repair Quote Request', 'value' => 12000, 'type' => 'Inbound Call', 'source' => 'Google LSA', 'status' => 'Booked / Sold', 'time' => '10 mins ago', 'category' => 'trades', 'duration' => 154],
        ['name' => 'Rachel Stevens', 'phone' => '(555) 876-5432', 'service' => 'Full Roof Replacement Consultation Request', 'value' => 18500, 'type' => 'Web Form', 'source' => 'Meta Retargeting', 'status' => 'New Lead', 'time' => '1 hr ago', 'category' => 'trades', 'duration' => 0],
        ['name' => 'Linda Park', 'phone' => '(555) 332-6610', 'service' => 'Custom Home Build Consultation', 'value' => 640000, 'type' => 'Web Form', 'source' => 'Meta Retargeting', 'status' => 'New Lead', 'time' => '3 hrs ago', 'category' => 'aec', 'duration' => 0],
        ['name' => 'Harbor Dental Partners', 'phone' => '(555) 718-4402', 'service' => 'Office Remodel', 'value' => 86000, 'type' => 'Inbound Call', 'source' => 'Google PPC', 'status' => 'Booked / Sold', 'time' => '5 hrs ago', 'category' => 'aec', 'duration' => 189],
        ['name' => 'Brian Vance', 'phone' => '(555) 678-9012', 'service' => 'Home Listing Consultation – 4 Bed / 3 Bath', 'value' => 22500, 'type' => 'Inbound Call', 'source' => 'Google PPC', 'status' => 'Estimate Scheduled', 'time' => '3 hrs ago', 'category' => 'realty', 'duration' => 173],
        ['name' => 'Westgate Properties LLC', 'phone' => '(555) 563-1184', 'service' => 'Property Management (24 units)', 'value' => 28800, 'type' => 'Inbound Call', 'source' => 'Google LSA', 'status' => 'Disqualified', 'time' => '4 hrs ago', 'category' => 'realty', 'duration' => 61],
    ];

    return apply_filters('ds_dsd_sim_leads', $leads);
}

/**
 * Monthly ad spend per source for the simulator's "Job & Ad ROI" tab.
 * Revenue is worked out live from the leads marked Booked / Sold.
 */
function ds_dsd_sim_spend() {
    return apply_filters('ds_dsd_sim_spend', [
        'Google LSA'       => 2400,
        'Google PPC'       => 6800,
        'Meta Retargeting' => 1900,
    ]);
}

/**
 * Sample assets for the simulator's "Field Approvals" tab.
 */
function ds_dsd_sim_approvals() {
    return apply_filters('ds_dsd_sim_approvals', [
        ['title' => 'Spring AC Tune-Up Ad', 'meta' => 'Meta · 3 creatives', 'icon' => 'fa-solid fa-rectangle-ad'],
        ['title' => 'Drone Roof Footage – 412 Oak St', 'meta' => 'Video · 0:48', 'icon' => 'fa-solid fa-video'],
        ['title' => 'Emergency Plumbing Landing Page', 'meta' => 'Web page · York, PA', 'icon' => 'fa-solid fa-laptop-code'],
    ]);
}

function ds_dsd_statuses() {
    return ['New Lead', 'Booked / Sold', 'Estimate Scheduled', 'Disqualified'];
}

function ds_dsd_industries() {
    return [
        'trades' => 'Home Services & Trades',
        'aec'    => 'AEC & Contractors',
        'realty' => 'Real Estate',
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
 * Font Awesome icon in the site's blue icon gradient, or an uploaded
 * SVG / image tinted with .ds-icon--blue-gradient (as on Home Services).
 */
function ds_dsd_icon($upload, $fa, $class = '') {
    $class = trim('ds-dsd-icon ' . $class);
    if (!empty($upload['url'])) {
        return '<span class="' . esc_attr($class . ' ds-icon--blue-gradient') . '" aria-hidden="true">' . ds_inline_svg($upload) . '</span>';
    }
    return '<span class="' . esc_attr($class . ' ds-dsd-icon--fa') . '" aria-hidden="true"><i class="' . esc_attr($fa) . '"></i></span>';
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
 * The launch row whose `$key` is closest to `$title` (ignoring case,
 * punctuation and small typos), or null when none is close enough.
 */
function ds_dsd_closest($title, array $defaults, $key) {
    $norm  = function ($text) { return preg_replace('/[^a-z0-9]/', '', strtolower(wp_strip_all_tags((string) $text))); };
    $title = $norm($title);
    if ($title === '') return null;

    $best = null;
    $best_score = 75; // minimum similarity, in percent
    foreach ($defaults as $default) {
        similar_text($title, $norm($default[$key] ?? ''), $score);
        if ($score >= $best_score) {
            $best_score = $score;
            $best = $default;
        }
    }
    return $best;
}

/**
 * Fill empty keys of saved repeater rows from the launch copy, so a row
 * saved before a sub-field existed (or left blank) doesn't show a title
 * with no description. Only keys that are empty on the saved row change.
 */
function ds_dsd_fill_rows(array $rows, array $defaults, $title_key, array $fill_keys) {
    foreach ($rows as $i => $row) {
        $match = ds_dsd_closest($row[$title_key] ?? '', $defaults, $title_key);
        if (!$match) continue;
        foreach ($fill_keys as $key) {
            if (empty($row[$key]) && !empty($match[$key])) {
                $rows[$i][$key] = $match[$key];
            }
        }
    }
    return $rows;
}

/**
 * Partner Feedback quotes: the site's global testimonials (Theme Settings >
 * Testimonials), shown exactly as elsewhere on the site.
 */
function ds_dsd_testimonials() {
    $items = function_exists('get_field') ? get_field('gtm_items', 'option') : [];
    return array_values(array_filter((array) $items, function ($item) { return !empty($item['quote']); }));
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
