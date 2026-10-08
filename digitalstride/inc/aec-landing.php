<?php
/**
 * AEC Landing Page (page-aec-landing.php).
 *
 * Field group: acf-json/group_aec_landing.json, shown on pages using the
 * "AEC Landing Page" template. Every section reads its ACF fields first and
 * falls back to the approved launch copy below, so a fresh page renders
 * complete before anything is entered. Clearing a section is done with the
 * "Hide sections" checkboxes on the Settings tab.
 *
 * Testimonials come from Theme Settings > Testimonials; items whose
 * "Industry" includes AEC are shown unless the page overrides the selection.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('DS_AEC_TEMPLATE', 'page-aec-landing.php');

/**
 * Launch copy used when a field is empty.
 */
function ds_aec_defaults($section) {
    $defaults = [
        'hero' => [
            'tag'       => 'Who We Serve: Architecture, Engineering & Construction',
            'heading'   => 'B2B Precision: Digital Marketing for AEC Firms',
            'text'      => 'We showcase your structural achievements, build high-performing digital foundations, and execute data-backed SEO strategies for firms that construct commercial landmarks, bridge infrastructure, and engineer the future.',
            'primary'   => ['title' => 'Build Your Firm’s Blueprint', 'url' => home_url('/contact-us/'), 'target' => ''],
            'secondary' => ['title' => 'View Our AEC Case Studies', 'url' => '#aec-clients', 'target' => ''],
        ],
        'who_we_serve' => [
            'heading'  => 'Who We Serve in AEC',
            'segments' => [
                ['title' => 'Architects', 'description' => 'We highlight portfolio presentation, aesthetic preservation, and builder trust.', 'icon' => null, 'active' => false],
                ['title' => 'Engineers', 'description' => 'We focus on technical accuracy, data-backed trust, and clear project capability.', 'icon' => null, 'active' => false],
                ['title' => 'Commercial Contractors', 'description' => 'We focus on job-site proof, bid-readiness, and crew/project scale.', 'icon' => null, 'active' => true],
            ],
        ],
        'how_we_help' => [
            'section_tag'     => 'Value Beyond Marketing',
            'section_heading' => 'How We Help AEC Firms Win & Grow',
            'intro_paragraph' => 'In the AEC industry, winning high-value commercial contracts takes more than standard marketing; it requires an authoritative digital presence that backs up your real-world reputation. We align your online footprint with the exact criteria project managers, developers, and municipalities look for when vetting firms, turning your digital channels into an active engine for long-term growth and high-tier bid inclusion.',
            'value_cards'     => [
                ['card_title' => 'Bid & RFP Credibility', 'card_description' => 'When developers and general contractors evaluate your firm, your website acts as your primary digital resume. We build platforms that prove your technical capability instantly.'],
                ['card_title' => 'Long Sales-Cycle Nurturing', 'card_description' => 'Construction and engineering decisions take months. Through strategic SEO and content architecture, we keep your firm top-of-mind throughout the entire procurement pipeline.'],
                ['card_title' => 'Talent & Partner Acquisition', 'card_description' => 'Highlight your project safety standards, firm culture, and iconic builds to attract top-tier engineering talent and trade partners.'],
            ],
        ],
        'core_pillars' => [
            'heading' => 'The Core Pillars for AEC',
            'pillars' => [
                ['title' => 'Technical B2B SEO', 'image' => null, 'overview' => 'Data-backed local and regional SEO strategies that place your firm on the shortlist for premier commercial and municipal bids.', 'link_text' => 'Explore SEO', 'link_url' => home_url('/services/')],
                ['title' => 'Website Design & Development', 'image' => null, 'overview' => 'Fast, portfolio-driven web platforms engineered to showcase your firm’s technical specs and win developer trust.', 'link_text' => 'Explore Web Design', 'link_url' => home_url('/services/')],
                ['title' => 'Project & Job Site Photography', 'image' => null, 'overview' => 'Professional job-site captures, drone imaging, and award-ready photo assets that bring your real-world craftsmanship to life.', 'link_text' => 'Explore Photography', 'link_url' => home_url('/services/')],
                ['title' => 'Marketing Retainers', 'image' => null, 'overview' => 'Comprehensive monthly management to keep your project portfolio updated, SEO active, and digital leads consistent.', 'link_text' => 'Explore Retainers', 'link_url' => home_url('/services/')],
            ],
        ],
        'guided' => [
            'heading' => 'Where Are You Starting?',
            'tabs'    => [
                ['title' => '“I need to fix an outdated website to win larger bids.”', 'content' => '<p>Your website is the first document a developer or GC reviews before they ever call. We rebuild it around your project portfolio, certifications, and capability statements so it reads like a winning bid package.</p>', 'label' => 'Explore Web Design', 'link' => ['url' => home_url('/services/'), 'target' => ''], 'consult' => false, 'open' => false],
                ['title' => '“I need to show up when developers search in our region.”', 'content' => '<p>Technical B2B SEO puts your firm in front of project managers and owners searching for your exact services, in the markets you want to win.</p>', 'label' => 'Explore SEO', 'link' => ['url' => home_url('/services/'), 'target' => ''], 'consult' => false, 'open' => false],
                ['title' => '“I need high-quality imagery of completed builds for proposals.”', 'content' => '<p>Award-ready job-site and drone photography gives every proposal, RFQ response, and portfolio page the proof your craftsmanship deserves.</p>', 'label' => 'Explore Project Photography', 'link' => ['url' => home_url('/services/'), 'target' => ''], 'consult' => false, 'open' => true],
                ['title' => '“I’m not sure where to start.”', 'content' => '<p>That’s exactly what a consult is for. We’ll review your current digital presence against the criteria your next client uses to vet firms and map out the first steps together.</p>', 'label' => 'Book A Consult', 'link' => ['url' => home_url('/contact-us/'), 'target' => ''], 'consult' => true, 'open' => false],
            ],
        ],
        'clients' => [
            'heading' => 'Our AEC Clients',
        ],
    ];

    return $defaults[$section] ?? [];
}

/**
 * Is a section switched off on the Settings tab?
 */
function ds_aec_hidden($section) {
    static $hidden = null;
    if ($hidden === null) {
        $hidden = (array) (get_field('aec_hide_sections') ?: []);
    }
    return in_array($section, $hidden, true);
}

/**
 * Normalise an ACF link (array) or URL (string) to [url, title, target].
 */
function ds_aec_link($link, $fallback_title = '') {
    if (is_string($link)) {
        $link = ['url' => $link];
    }
    if (!is_array($link) || empty($link['url'])) {
        return null;
    }
    return [
        'url'    => $link['url'],
        'title'  => !empty($link['title']) ? $link['title'] : $fallback_title,
        'target' => $link['target'] ?? '',
    ];
}

/**
 * Print target/rel attributes for a link opened in a new tab.
 */
function ds_aec_target_attrs($target) {
    if ($target === '_blank') {
        echo ' target="_blank" rel="noopener noreferrer"';
    }
}

/**
 * Stable id for a global testimonial, used by the "Choose testimonials"
 * select. Built from name + company + the start of the quote so reordering
 * the global list doesn't change which quotes a page picked.
 */
function ds_testimonial_id($item) {
    $basis = ($item['name'] ?? '') . '|' . ($item['title_company'] ?? '') . '|' . mb_substr((string) ($item['quote'] ?? ''), 0, 60);
    return 't_' . substr(md5($basis), 0, 10);
}

/**
 * All global testimonials (Theme Settings > Testimonials), optionally only
 * those tagged with an industry.
 *
 * @param string $industry '' for all, or 'aec' / 'home_services'.
 * @return array<int, array{id:string, quote:string, name:string, title_company:string, industries:array}>
 */
function ds_get_testimonials($industry = '') {
    $items = function_exists('get_field') ? get_field('gtm_items', 'option') : [];
    $out   = [];

    foreach ((array) $items as $item) {
        if (empty($item['quote'])) continue;
        $industries = array_values(array_filter((array) ($item['industry'] ?? [])));
        if ($industry !== '' && !in_array($industry, $industries, true)) continue;

        $out[] = [
            'id'            => ds_testimonial_id($item),
            'quote'         => $item['quote'],
            'name'          => $item['name'] ?? '',
            'title_company' => $item['title_company'] ?? '',
            'industries'    => $industries,
        ];
    }

    return $out;
}

/**
 * Populate the "Choose testimonials" select with the global testimonials.
 */
add_filter('acf/load_field/key=field_aec_clients_selected', function ($field) {
    $choices = [];
    foreach (ds_get_testimonials() as $t) {
        $label = $t['name'] ?: __('(no name)', 'digitalstride');
        if ($t['title_company']) $label .= ' — ' . $t['title_company'];
        if (in_array('aec', $t['industries'], true)) $label .= ' [AEC]';
        $label .= ': “' . wp_trim_words($t['quote'], 10, '…') . '”';
        $choices[$t['id']] = $label;
    }
    $field['choices'] = $choices;
    return $field;
});

/**
 * Testimonials for the "Our AEC Clients" section, honouring the page's
 * source setting.
 */
function ds_aec_testimonials() {
    $clients = get_field('aec_clients') ?: [];
    $source  = $clients['testimonial_source'] ?? 'aec';

    if ($source === 'custom') {
        $out = [];
        foreach ((array) ($clients['custom_testimonials'] ?? []) as $item) {
            if (empty($item['quote'])) continue;
            $out[] = [
                'quote'         => $item['quote'],
                'name'          => $item['name'] ?? '',
                'title_company' => $item['title_company'] ?? '',
            ];
        }
        return $out;
    }

    if ($source === 'selected') {
        $picked = array_values(array_filter((array) ($clients['selected_testimonials'] ?? [])));
        $by_id  = [];
        foreach (ds_get_testimonials() as $t) $by_id[$t['id']] = $t;

        // Keep the editor's chosen order.
        $out = [];
        foreach ($picked as $id) {
            if (isset($by_id[$id])) $out[] = $by_id[$id];
        }
        return $out;
    }

    return ds_get_testimonials('aec');
}

/**
 * Page-specific CSS / JS.
 */
add_action('wp_enqueue_scripts', function () {
    if (!is_page_template(DS_AEC_TEMPLATE)) return;
    wp_enqueue_style('ds-aec-landing', DS_URI . '/assets/css/aec-landing.css', ['digitalstride-main'], DS_VERSION);
    wp_enqueue_script('ds-aec-landing', DS_URI . '/assets/js/aec-landing.js', ['digitalstride-main'], DS_VERSION, true);
});

add_filter('body_class', function ($classes) {
    if (is_page_template(DS_AEC_TEMPLATE)) $classes[] = 'ds-page-aec';
    return $classes;
});
