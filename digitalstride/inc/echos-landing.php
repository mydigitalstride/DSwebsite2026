<?php
/**
 * ECHO SEO Landing Page (page-templates/template-echos-landing.php).
 *
 * Product page for the ECHO SEO WordPress plugin, built from the site
 * components so it reads as a Digital Stride page. Seven fixed sections,
 * each in template-parts/echos/: hero (site sub-page hero), intro banner,
 * partner / standalone comparison (DSD comparison cards), core features
 * (Home Services click-to-open boxes), plans & pricing table, 3-step
 * integration and a call to action in the Global CTA layout with this
 * page's own copy.
 *
 * Fields are registered below with acf_add_local_field_group() and shown
 * on pages using the "ECHO SEO Landing Page" template. Like the other
 * landing pages, every section reads its ACF fields first and falls back
 * to the launch copy in ds_echos_defaults(), so a fresh page renders
 * complete. Sections are removed with the "Hide sections" checkboxes on
 * the Settings tab.
 *
 * Page CSS / JS: the shared AEC landing components (aec-landing.css / .js:
 * segment boxes) plus assets/css/echos.css. ECHO yellow is used only where
 * the mockup brands a detail as ECHO (logo, standalone card, Premium price,
 * step arrows) and is scoped to body.ds-page-echos. Link helpers come from
 * inc/aec-landing.php.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('DS_ECHOS_TEMPLATE', 'page-templates/template-echos-landing.php');

/**
 * Launch copy used when a field is empty (from the approved mockup).
 */
function ds_echos_defaults($section) {
    $contact  = home_url('/contact-us/');
    $echo_url = 'https://echo-seo.com/';

    $defaults = [
        'hero' => [
            'kicker'      => 'ECHOs SEO',
            'headline'    => 'Next-Gen Organic Growth: Powered by the ECHOs Engine',
            'subheadline' => 'ECHOs blends technical site audits, automated schema, and AI/Generative Engine Optimization (GEO) to keep Digital Stride client and standalone business platforms ranking ahead of search algorithm changes.',
            'button'      => ['title' => 'Deploy ECHOs for Your Site', 'url' => $echo_url, 'target' => '_blank'],
        ],
        'intro' => [
            'headline' => 'The AI-Ready SEO Engine Engineered for High-Performing Web Platforms',
            'subtext'  => 'Active across Digital Stride client sites in Construction, Home Services, Engineering, and Regional Business.',
        ],
        'compare' => [
            'headline'    => 'Tailored Value for Every Relationship',
            'subheadline' => 'ECHOs is built directly into your Digital Stride web strategy, no extra plugin management required.',
            'p1_title'    => 'Included Partner Benefits',
            'p1_desc'     => 'ECHOs is built directly into your Digital Stride web strategy, no extra plugin management required.',
            'p1_bullets'  => [
                ['title' => 'Done-For-You Setups', 'desc' => 'Managed configuration of schema markup and technical audit rules by our strategy team.'],
                ['title' => 'White-Label Executive Reports', 'desc' => 'Receive one-click PDF audit recaps and ranking summaries during monthly performance reviews.'],
                ['title' => 'Continuous Deploy Protection', 'desc' => 'Automated audit checks catch broken tags or technical regressions whenever new pages go live.'],
            ],
            'p2_title'    => 'For Standalone Businesses',
            'p2_desc'     => 'Future-proof your website’s search presence with automated auditing and AI search optimization.',
            'p2_bullets'  => [
                ['title' => 'AI & Generative Engine Optimization (GEO)', 'desc' => 'Prepares your website so modern AI search agents read and cite your site accurately.'],
                ['title' => 'Weighted Audit Scoring', 'desc' => 'Prioritizes critical indexing issues over minor vanity suggestions so you can focus on what matters.'],
                ['title' => 'Content Pipeline Capabilities', 'desc' => 'Accelerate article and blog creation directly aligned with high-intent search keywords.'],
            ],
        ],
        'features' => [
            'kicker'   => 'Built for Your Exact Sector',
            'headline' => 'Tailored Solutions For Your Industry',
            'subtext'  => 'Turn-key technical features designed to remove friction and drive organic results.',
            'cards'    => [
                ['title' => 'AI & GEO Search Readiness', 'description' => 'Generates llms.txt and structured data so AI assistants and generative search engines understand, cite and recommend your business.', 'active' => false],
                ['title' => 'Weighted Technical Site Audits', 'description' => 'Every issue is scored by its real impact on rankings, so your team fixes what matters first.', 'active' => false],
                ['title' => 'One-Click PDF Reporting', 'description' => 'Turn audit results into a clean PDF report you can send to stakeholders in seconds.', 'active' => false],
                ['title' => 'Deployment Regression Tracking', 'description' => 'Catch lost schema, broken redirects and new 404s right after a theme, plugin or content update goes live.', 'active' => false],
                ['title' => 'Smart Keyword & Intent Matrix', 'description' => 'Map every service page to the searches and buyer intent it should win.', 'active' => false],
                ['title' => 'Lightweight Core Web Vitals Compatibility', 'description' => 'Operates cleanly without bloat, integrating directly alongside Google Lighthouse performance scoring.', 'active' => true],
            ],
        ],
        'pricing' => [
            'kicker'       => 'Built for the Trades. Engineered for Growth.',
            'headline'     => 'Plans & Price',
            'col1_header'  => 'ECHO SEO Plan Features',
            'col2_header'  => 'ECHO SEO Basic',
            'col2_price'   => 'FREE',
            'col2_button'  => ['title' => 'Download', 'url' => $echo_url, 'target' => '_blank'],
            'col3_header'  => 'ECHO SEO Premium',
            'col3_was'     => '$95.95 / year',
            'col3_price'   => '$59.95 / year',
            'col3_button'  => ['title' => 'Get ECHO SEO Premium', 'url' => $echo_url, 'target' => '_blank'],
            'rows'         => array_map(function ($r) {
                return ['feature' => $r[0], 'col2' => $r[1], 'col2_text' => '', 'col3' => $r[2], 'col3_text' => ''];
            }, [
                ['WordPress Compatible', 'cross', 'check'],
                ['Simplified SEO', 'cross', 'check'],
                ['Business and Service Schema', 'check', 'check'],
                ['Bulk Editing of Page Meta Descriptions and Titles', 'check', 'check'],
                ['Page Redirects', 'check', 'check'],
                ['FAQ & Advanced Schema Markups', 'check', 'check'],
                ['1-Click Yoast Transfer', 'check', 'check'],
                ['404 Monitoring & Easy Redirects', 'check', 'check'],
                ['Google Business Profile Management', 'cross', 'check'],
                ['Google Business Profile Posting', 'cross', 'check'],
                ['Internal Linking Mapping', 'cross', 'check'],
                ['Bulk Editing of Post Meta Descriptions & Titles', 'cross', 'check'],
            ]),
        ],
        'steps' => [
            'headline' => 'Simple 3-Step Integration Process',
            'steps'    => [
                ['number' => 'Step 1', 'icon' => null, 'title' => 'Download & Connect', 'description' => 'Activate ECHOs on your WordPress or custom site build.', 'highlight' => true],
                ['number' => 'Step 2', 'icon' => null, 'title' => 'Audit & Align', 'description' => 'Run automated site scans to resolve technical blockers and set GEO parameters.', 'highlight' => false],
                ['number' => 'Step 3', 'icon' => null, 'title' => 'Scale Organic Reach', 'description' => 'Track rank updates, publish search-optimized content, and capture high-intent leads.', 'highlight' => false],
            ],
            'button'   => ['title' => 'Download ECHO SEO For Free', 'url' => $echo_url, 'target' => '_blank'],
        ],
        'cta' => [
            'headline'  => 'Ready to Build an AI-First Search Foundation?',
            'subtext'   => 'Speak with Digital Stride today to discover how ECHOs can be integrated into your website ecosystem.',
            'primary'   => ['title' => 'Download ECHO SEO', 'url' => $echo_url, 'target' => '_blank'],
            'secondary' => ['title' => 'Contact Our Team', 'url' => $contact, 'target' => ''],
            'features'  => [
                ['icon' => null, 'fa' => 'fa-solid fa-screwdriver-wrench', 'title' => 'Built for Services', 'desc' => 'Marketing meant for those that serve and build our country.'],
                ['icon' => null, 'fa' => 'fa-solid fa-ranking-star', 'title' => 'Rank Higher on Google', 'desc' => 'Increase visibility on search engines like Google and drive more leads and revenue.'],
                ['icon' => null, 'fa' => 'fa-solid fa-gauge-high', 'title' => 'Higher Conversions', 'desc' => 'Improve your website’s conversions and effectiveness to drive more revenue.'],
                ['icon' => null, 'fa' => 'fa-solid fa-image', 'title' => 'Quality Photos', 'desc' => 'Photos of your greatest work, ready to submit for awards and social media.'],
            ],
        ],
    ];

    return $defaults[$section] ?? [];
}

/**
 * Is a section switched off on the Settings tab?
 */
function ds_echos_hidden($section) {
    static $hidden = null;
    if ($hidden === null) {
        $hidden = (array) (get_field('echos_hide_sections') ?: []);
    }
    return in_array($section, $hidden, true);
}

/**
 * A button group field ({text, url}) as [url, title, target].
 *
 * The text field wins over the link's own title; an empty group falls back
 * to the launch button. Returns null when there is no URL to link to.
 */
function ds_echos_button($name, $fallback) {
    $group = get_field($name);
    $text  = is_array($group) ? trim((string) ($group['text'] ?? '')) : '';
    $link  = is_array($group) ? ds_aec_link($group['url'] ?? null, $text ?: $fallback['title']) : null;

    if (!$link) {
        $link = ds_aec_link($fallback);
    }
    if ($link && $text !== '') {
        $link['title'] = $text;
    }
    return ($link && $link['title'] !== '') ? $link : null;
}

/**
 * Print a button from ds_echos_button().
 */
function ds_echos_print_button($btn, $class) {
    if (!$btn) return;
    printf('<a href="%s" class="%s"', esc_url($btn['url']), esc_attr($class));
    ds_aec_target_attrs($btn['target']);
    printf('>%s</a>', esc_html($btn['title']));
}

/**
 * Pricing table cell: check, cross or custom text.
 */
function ds_echos_cell($type, $text) {
    $text = trim((string) $text);
    if ($type === 'text' && $text !== '') {
        return '<span class="ds-echos-table__text">' . esc_html($text) . '</span>';
    }
    if ($type === 'check') {
        return '<span class="ds-echos-table__mark" aria-hidden="true">&#10003;</span><span class="screen-reader-text">' . esc_html__('Included', 'digitalstride') . '</span>';
    }
    return '<span class="ds-echos-table__mark ds-echos-table__mark--no" aria-hidden="true">&#10005;</span><span class="screen-reader-text">' . esc_html__('Not included', 'digitalstride') . '</span>';
}

/**
 * Page CSS / JS: the shared AEC landing components plus this page's own.
 */
add_action('wp_enqueue_scripts', function () {
    if (!is_page_template(DS_ECHOS_TEMPLATE)) return;
    wp_enqueue_style('ds-aec-landing', ds_asset_url('assets/css/aec-landing.css'), ['digitalstride-main'], null);
    wp_enqueue_style('ds-echos', ds_asset_url('assets/css/echos.css'), ['ds-aec-landing'], null);
    wp_enqueue_script('ds-aec-landing', ds_asset_url('assets/js/aec-landing.js'), ['digitalstride-main'], null, true);
});

add_filter('body_class', function ($classes) {
    if (is_page_template(DS_ECHOS_TEMPLATE)) $classes[] = 'ds-page-echos';
    return $classes;
});

add_filter('ds_show_breadcrumbs', function ($show) {
    return is_page_template(DS_ECHOS_TEMPLATE) ? false : $show;
});

/**
 * Field group: ECHO SEO Landing Page.
 *
 * Registered in PHP (not acf-json) so the whole page is defined in this
 * file. Field keys are stable; values saved in the admin survive edits.
 */
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    $d = function ($section) { return ds_echos_defaults($section); };

    // Text + Link button group.
    $button = function ($key, $name, $label, $default_text, $instructions = '') {
        return [
            'key'          => 'field_echos_' . $key,
            'label'        => $label,
            'name'         => $name,
            'type'         => 'group',
            'layout'       => 'block',
            'instructions' => $instructions ?: 'Leave empty to use the default button.',
            'sub_fields'   => [
                ['key' => 'field_echos_' . $key . '_text', 'label' => 'Button text', 'name' => 'text', 'type' => 'text', 'placeholder' => $default_text, 'wrapper' => ['width' => '50']],
                ['key' => 'field_echos_' . $key . '_url', 'label' => 'Button link', 'name' => 'url', 'type' => 'link', 'return_format' => 'array', 'wrapper' => ['width' => '50']],
            ],
        ];
    };
    $tab = function ($key, $label) {
        return ['key' => 'field_echos_tab_' . $key, 'label' => $label, 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0];
    };
    $text = function ($key, $name, $label, $placeholder = '', $type = 'text', $extra = []) {
        $field = ['key' => 'field_echos_' . $key, 'label' => $label, 'name' => $name, 'type' => $type, 'placeholder' => $placeholder];
        if ($type === 'textarea') {
            $field += ['rows' => 3, 'new_lines' => ''];
        }
        return array_merge($field, $extra);
    };
    $image = function ($key, $name, $label, $instructions = '') {
        return ['key' => 'field_echos_' . $key, 'label' => $label, 'name' => $name, 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium', 'library' => 'all', 'instructions' => $instructions];
    };
    $bullets = function ($key, $name, $label) {
        return [
            'key'          => 'field_echos_' . $key,
            'label'        => $label,
            'name'         => $name,
            'type'         => 'repeater',
            'layout'       => 'table',
            'button_label' => 'Add bullet',
            'instructions' => 'Bold title with a short description under it. Leave empty to use the launch bullets.',
            'sub_fields'   => [
                ['key' => 'field_echos_' . $key . '_text', 'label' => 'Title', 'name' => 'bullet_text', 'type' => 'text', 'wrapper' => ['width' => '40']],
                ['key' => 'field_echos_' . $key . '_desc', 'label' => 'Description', 'name' => 'bullet_desc', 'type' => 'text', 'wrapper' => ['width' => '60']],
            ],
        ];
    };
    $cell = function ($key, $name, $label) {
        return [
            'key'           => 'field_echos_' . $key,
            'label'         => $label,
            'name'          => $name,
            'type'          => 'select',
            'choices'       => ['check' => 'Checkmark', 'cross' => 'Cross', 'text' => 'Custom text'],
            'default_value' => 'check',
            'return_format' => 'value',
            'ui'            => 0,
            'wrapper'       => ['width' => '15'],
        ];
    };
    $cell_text = function ($key, $name, $label, $select_key) {
        return [
            'key'               => 'field_echos_' . $key,
            'label'             => $label,
            'name'              => $name,
            'type'              => 'text',
            'placeholder'       => 'e.g. 5 sites',
            'wrapper'           => ['width' => '20'],
            'conditional_logic' => [[['field' => 'field_echos_' . $select_key, 'operator' => '==', 'value' => 'text']]],
        ];
    };

    $hero     = $d('hero');
    $intro    = $d('intro');
    $compare  = $d('compare');
    $features = $d('features');
    $pricing  = $d('pricing');
    $steps    = $d('steps');
    $cta      = $d('cta');

    acf_add_local_field_group([
        'key'                   => 'group_echos_landing',
        'title'                 => 'ECHO SEO Landing Page',
        'fields'                => [
            // 1. Hero
            $tab('hero', 'Hero'),
            ['key' => 'field_echos_hero_msg', 'label' => '', 'name' => '', 'type' => 'message', 'message' => 'Every field on this page is optional: empty fields fall back to the launch copy.'],
            $text('hero_kicker', 'hero_kicker', 'Kicker', $hero['kicker']),
            $text('hero_headline', 'hero_headline', 'Headline', $hero['headline'], 'text', ['instructions' => 'Allowed tags: <br>, <em>, <strong>, <span>.']),
            $text('hero_subheadline', 'hero_subheadline', 'Subheadline', $hero['subheadline'], 'textarea'),
            $button('hero_button', 'hero_button', 'Button', $hero['button']['title']),
            $image('hero_background_image', 'hero_background_image', 'Background image', 'Shown under the brand gradient. Empty uses the site hero background. 1920×900 or larger.'),

            // 2. Intro banner
            $tab('intro', 'Intro Banner'),
            $image('intro_logo', 'intro_logo', 'ECHO SEO logo', 'Shown left of the headline. Without a logo the banner shows an ECHO SEO wordmark.'),
            $text('intro_headline', 'intro_headline', 'Headline', $intro['headline']),
            $text('intro_subtext', 'intro_subtext', 'Subtext', $intro['subtext']),

            // 3. Comparison
            $tab('compare', 'Value Comparison'),
            $text('s3_headline', 's3_headline', 'Headline', $compare['headline']),
            $text('s3_subheadline', 's3_subheadline', 'Subheadline', $compare['subheadline']),
            $text('p1_title', 'p1_title', 'Left panel: title', $compare['p1_title'], 'text', ['wrapper' => ['width' => '50']]),
            $text('p1_description', 'p1_description', 'Left panel: description', $compare['p1_desc'], 'text', ['wrapper' => ['width' => '50']]),
            $bullets('p1_bullet_points', 'p1_bullet_points', 'Left panel: bullet points'),
            $text('p2_title', 'p2_title', 'Right panel: title', $compare['p2_title'], 'text', ['wrapper' => ['width' => '50']]),
            $text('p2_description', 'p2_description', 'Right panel: description', $compare['p2_desc'], 'text', ['wrapper' => ['width' => '50']]),
            $bullets('p2_bullet_points', 'p2_bullet_points', 'Right panel: bullet points'),

            // 4. Features grid
            $tab('features', 'Core Features'),
            $text('s4_kicker', 's4_kicker', 'Kicker', $features['kicker']),
            $text('s4_headline', 's4_headline', 'Headline', $features['headline']),
            $text('s4_subtext', 's4_subtext', 'Subtext', $features['subtext']),
            [
                'key'          => 'field_echos_s4_feature_cards',
                'label'        => 'Feature cards',
                'name'         => 's4_feature_cards',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Add card',
                'instructions' => 'Boxes show the title only; a click opens the description (as on the Home Services page). Shown 3 per row (6 recommended). Leave empty to use the launch cards.',
                'collapsed'    => 'field_echos_s4_card_title',
                'sub_fields'   => [
                    ['key' => 'field_echos_s4_card_title', 'label' => 'Title', 'name' => 'card_title', 'type' => 'text', 'wrapper' => ['width' => '70']],
                    ['key' => 'field_echos_s4_card_highlight', 'label' => 'Open by default', 'name' => 'is_highlighted', 'type' => 'true_false', 'ui' => 1, 'instructions' => 'Starts open with the highlighted border. Only the first one flagged opens.', 'wrapper' => ['width' => '30']],
                    ['key' => 'field_echos_s4_card_desc', 'label' => 'Description', 'name' => 'card_description', 'type' => 'textarea', 'rows' => 3, 'new_lines' => ''],
                ],
            ],

            // 5. Pricing
            $tab('pricing', 'Plans & Pricing'),
            $text('s5_kicker', 's5_kicker', 'Kicker', $pricing['kicker']),
            $text('s5_headline', 's5_headline', 'Headline', $pricing['headline']),
            $text('s5_col1_header', 's5_col1_header', 'Feature column header', $pricing['col1_header']),
            $text('s5_col2_header', 's5_col2_header', 'Free column: header', $pricing['col2_header'], 'text', ['wrapper' => ['width' => '50']]),
            $text('s5_col2_price', 's5_col2_price', 'Free column: price', $pricing['col2_price'], 'text', ['wrapper' => ['width' => '50']]),
            $button('s5_col2_button', 's5_col2_button', 'Free column: button', $pricing['col2_button']['title']),
            $text('s5_col3_header', 's5_col3_header', 'Premium column: header', $pricing['col3_header'], 'text', ['wrapper' => ['width' => '50']]),
            $text('s5_col3_original_price', 's5_col3_original_price', 'Premium column: original price (struck through)', $pricing['col3_was'], 'text', ['wrapper' => ['width' => '50'], 'instructions' => 'Leave empty to use the launch price; enter "-" to hide it.']),
            $text('s5_col3_price', 's5_col3_price', 'Premium column: price', $pricing['col3_price'], 'text', ['wrapper' => ['width' => '50']]),
            $button('s5_col3_button', 's5_col3_button', 'Premium column: button', $pricing['col3_button']['title']),
            [
                'key'          => 'field_echos_s5_table_rows',
                'label'        => 'Feature rows',
                'name'         => 's5_table_rows',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Add row',
                'instructions' => 'Leave empty to use the launch rows.',
                'sub_fields'   => [
                    ['key' => 'field_echos_s5_feature', 'label' => 'Feature', 'name' => 'feature_name', 'type' => 'text', 'wrapper' => ['width' => '30']],
                    $cell('s5_col2', 'col2_value', 'Free'),
                    $cell_text('s5_col2_text', 'col2_text', 'Free: text', 's5_col2'),
                    $cell('s5_col3', 'col3_value', 'Premium'),
                    $cell_text('s5_col3_text', 'col3_text', 'Premium: text', 's5_col3'),
                ],
            ],

            // 6. Steps
            $tab('steps', '3-Step Process'),
            $text('s6_headline', 's6_headline', 'Headline', $steps['headline']),
            [
                'key'          => 'field_echos_s6_steps',
                'label'        => 'Steps',
                'name'         => 's6_steps',
                'type'         => 'repeater',
                'layout'       => 'block',
                'button_label' => 'Add step',
                'instructions' => 'Three steps fit one row. Leave empty to use the launch steps.',
                'collapsed'    => 'field_echos_s6_step_title',
                'sub_fields'   => [
                    ['key' => 'field_echos_s6_step_number', 'label' => 'Step label', 'name' => 'step_number', 'type' => 'text', 'placeholder' => 'Step 1', 'wrapper' => ['width' => '30']],
                    ['key' => 'field_echos_s6_step_title', 'label' => 'Title', 'name' => 'step_title', 'type' => 'text', 'wrapper' => ['width' => '50']],
                    ['key' => 'field_echos_s6_step_highlight', 'label' => 'Highlight', 'name' => 'is_highlighted', 'type' => 'true_false', 'ui' => 1, 'message' => 'Orange border', 'wrapper' => ['width' => '20']],
                    ['key' => 'field_echos_s6_step_icon', 'label' => 'Icon', 'name' => 'step_icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all', 'instructions' => 'Empty shows a numbered gear.', 'wrapper' => ['width' => '30']],
                    ['key' => 'field_echos_s6_step_desc', 'label' => 'Description', 'name' => 'step_description', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'wrapper' => ['width' => '70']],
                ],
            ],
            $button('s6_bottom_button', 's6_bottom_button', 'Button below the steps', $steps['button']['title'], 'Links to https://echo-seo.com/ (new tab) by default. Point it at a download page if you prefer.'),

            // 7. CTA
            $tab('cta', 'Call to Action'),
            ['key' => 'field_echos_cta_msg', 'label' => '', 'name' => '', 'type' => 'message', 'message' => 'Uses the Global CTA layout with this page’s own copy and buttons. Empty highlights and background fall back to Theme Settings > Global CTA.'],
            $text('cta_headline', 'cta_headline', 'Headline', $cta['headline']),
            $text('cta_subtext', 'cta_subtext', 'Subtext', $cta['subtext'], 'textarea'),
            $button('cta_button_primary', 'cta_button_primary', 'Primary button (solid)', $cta['primary']['title']),
            $button('cta_button_secondary', 'cta_button_secondary', 'Secondary button (outline)', $cta['secondary']['title']),
            [
                'key'          => 'field_echos_cta_right_features',
                'label'        => 'Feature highlights (right side)',
                'name'         => 'cta_right_features',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => 'Add highlight',
                'instructions' => 'Leave empty to use the Global CTA highlights.',
                'sub_fields'   => [
                    ['key' => 'field_echos_cta_feature_icon', 'label' => 'Icon', 'name' => 'feature_icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all', 'wrapper' => ['width' => '20']],
                    ['key' => 'field_echos_cta_feature_title', 'label' => 'Title', 'name' => 'feature_title', 'type' => 'text', 'wrapper' => ['width' => '30']],
                    ['key' => 'field_echos_cta_feature_desc', 'label' => 'Description', 'name' => 'feature_desc', 'type' => 'text', 'wrapper' => ['width' => '50']],
                ],
            ],
            $image('cta_background_image', 'cta_background_image', 'Background image', 'Shown under the brand gradient. Empty uses the Global CTA background.'),

            // Settings
            $tab('settings', 'Settings'),
            [
                'key'          => 'field_echos_hide_sections',
                'label'        => 'Hide sections',
                'name'         => 'echos_hide_sections',
                'type'         => 'checkbox',
                'layout'       => 'vertical',
                'choices'      => [
                    'hero'     => 'Hero',
                    'intro'    => 'Intro banner',
                    'compare'  => 'Value comparison',
                    'features' => 'Core features',
                    'pricing'  => 'Plans & pricing',
                    'steps'    => '3-step process',
                    'cta'      => 'Call to action',
                ],
                'return_format' => 'value',
            ],
        ],
        'location'              => [[['param' => 'page_template', 'operator' => '==', 'value' => DS_ECHOS_TEMPLATE]]],
        'menu_order'            => -10,
        'position'              => 'acf_after_title',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'active'                => true,
        'description'           => 'Fixed sections for the ECHO SEO landing page template.',
    ]);
});
