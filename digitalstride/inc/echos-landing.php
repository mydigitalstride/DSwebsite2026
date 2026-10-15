<?php
/**
 * ECHO SEO Landing Page (page-templates/template-echos-landing.php).
 *
 * Product page for the ECHO SEO WordPress plugin. Seven fixed sections,
 * each in template-parts/echos/: hero, intro banner, partner / standalone
 * comparison, core features grid, plans & pricing table, 3-step
 * integration and a page-specific call to action (not the Global CTA).
 *
 * Fields are registered below with acf_add_local_field_group() and shown
 * on pages using the "ECHO SEO Landing Page" template. Like the other
 * landing pages, every section reads its ACF fields first and falls back
 * to the launch copy in ds_echos_defaults(), so a fresh page renders
 * complete. Sections are removed with the "Hide sections" checkboxes on
 * the Settings tab.
 *
 * Page CSS: assets/css/echos.css. The ECHO yellow and slate palette is
 * scoped to body.ds-page-echos, so the site variables are untouched. Link
 * helpers come from inc/aec-landing.php.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('DS_ECHOS_TEMPLATE', 'page-templates/template-echos-landing.php');

/**
 * Launch copy used when a field is empty.
 */
function ds_echos_defaults($section) {
    $contact  = home_url('/contact-us/');
    $echo_url = 'https://echo-seo.com/';

    $defaults = [
        'hero' => [
            'kicker'      => 'ECHO SEO',
            'headline'    => 'Next-Gen Organic Growth: Powered by the ECHOes Engine',
            'subheadline' => 'Built for construction, engineering, and home service platforms. ECHO SEO automates technical schema, instant indexing, 404 monitoring, and AI-first visibility directly inside WordPress.',
            'button'      => ['title' => 'Deploy ECHOes for Your Site', 'url' => $echo_url, 'target' => '_blank'],
        ],
        'intro' => [
            'headline' => 'The AI-Ready SEO Engine Engineered for High-Performing Web Platforms',
            'subtext'  => 'Powering Trades, AEC, and Regional Enterprise Websites.',
        ],
        'compare' => [
            'headline'    => 'Tailored Value for Every Relationship',
            'subheadline' => 'Whether you are an existing Digital Stride partner or a standalone business, ECHO SEO scales with your goals.',
            'p1_title'    => 'Included Partner Benefits',
            'p1_desc'     => 'Active Digital Stride retainer partners get ECHO SEO Premium installed, configured and monitored by our team at no extra cost.',
            'p1_bullets'  => [
                '<strong>ECHO SEO Premium included</strong> with every active growth retainer.',
                '<strong>Done-for-you setup:</strong> schema, redirects, tracking and indexing configured by our team.',
                '<strong>Monthly technical audits</strong> reviewed alongside your campaign reporting.',
                '<strong>Priority technical support</strong> from the people who build your site.',
            ],
            'p2_title'    => 'For Standalone Businesses',
            'p2_desc'     => 'Not a retainer client? Install ECHO SEO on any WordPress site and grow at your own pace.',
            'p2_bullets'  => [
                '<strong>Free core plugin</strong> with LocalBusiness schema, redirects and 404 monitoring.',
                '<strong>Upgrade to Premium</strong> any time for AI search readiness and advanced schema.',
                '<strong>One-click PDF reports</strong> you can share with your team or clients.',
                '<strong>Optional strategy support</strong> from Digital Stride whenever you need it.',
            ],
        ],
        'features' => [
            'kicker'   => 'Built For Your Growth Engine',
            'headline' => 'Tailored Solutions For Your Industry',
            'subtext'  => 'Turn-key technical features designed to remove friction and drive organic results.',
            'cards'    => [
                ['title' => 'AI & GEO Search Readiness', 'description' => 'Generate llms.txt and structured data so AI assistants and generative search engines understand, cite and recommend your business.', 'highlight' => false],
                ['title' => 'Weighted Technical Site Audits', 'description' => 'Every issue is scored by its real impact on rankings, so your team fixes what matters first instead of chasing noise.', 'highlight' => false],
                ['title' => 'One-Click PDF Reporting', 'description' => 'Turn audit results into a clean, branded PDF report you can send to stakeholders in seconds.', 'highlight' => false],
                ['title' => 'Deployment Regression Tracking', 'description' => 'Catch lost schema, broken redirects and new 404s right after a theme, plugin or content update goes live.', 'highlight' => false],
                ['title' => 'Smart Keyword & Intent Matrix', 'description' => 'Map every service page to the searches and buyer intent it should win, and spot gaps before competitors do.', 'highlight' => false],
                ['title' => 'Lightweight Core Web Vitals Compatibility', 'description' => 'Built lean to load nothing on the front end it doesn’t need, so your PageSpeed scores stay fast.', 'highlight' => true],
            ],
        ],
        'pricing' => [
            'kicker'      => 'Built for the Trades. Engineered for Growth.',
            'headline'    => 'Plans & Price',
            'col1_header' => 'ECHO SEO Plan Features',
            'col2_header' => 'ECHO SEO Free',
            'col2_price'  => 'FREE',
            'col2_button' => ['title' => 'Download', 'url' => $echo_url, 'target' => '_blank'],
            'col3_header' => 'ECHO SEO Premium',
            'col3_price'  => '$99 / year',
            'col3_button' => ['title' => 'Get ECHO SEO Premium', 'url' => $echo_url, 'target' => '_blank'],
            'rows'        => [
                ['feature' => 'WordPress Compatible', 'col2' => 'check', 'col2_text' => '', 'col3' => 'check', 'col3_text' => ''],
                ['feature' => 'LocalBusiness Schema', 'col2' => 'check', 'col2_text' => '', 'col3' => 'check', 'col3_text' => ''],
                ['feature' => '301 Redirects & 404 Monitoring', 'col2' => 'check', 'col2_text' => '', 'col3' => 'check', 'col3_text' => ''],
                ['feature' => 'Google Tag Manager & Meta Pixel Integration', 'col2' => 'check', 'col2_text' => '', 'col3' => 'check', 'col3_text' => ''],
                ['feature' => 'IndexNow Instant Indexing', 'col2' => 'check', 'col2_text' => '', 'col3' => 'check', 'col3_text' => ''],
                ['feature' => 'Google PageSpeed Insights API Checks', 'col2' => 'cross', 'col2_text' => '', 'col3' => 'check', 'col3_text' => ''],
                ['feature' => 'llms.txt AI Search Readiness', 'col2' => 'cross', 'col2_text' => '', 'col3' => 'check', 'col3_text' => ''],
                ['feature' => 'SEO Checklist & Import Manager', 'col2' => 'cross', 'col2_text' => '', 'col3' => 'check', 'col3_text' => ''],
                ['feature' => 'Custom Technical Schema Deployment', 'col2' => 'cross', 'col2_text' => '', 'col3' => 'check', 'col3_text' => ''],
                ['feature' => 'Priority Technical Support', 'col2' => 'cross', 'col2_text' => '', 'col3' => 'check', 'col3_text' => ''],
            ],
        ],
        'steps' => [
            'headline' => 'Simple 3-Step Integration Process',
            'steps'    => [
                ['number' => 'Step 1', 'icon' => null, 'fa' => 'fa-solid fa-plug', 'title' => 'Download & Connect', 'description' => 'Install ECHO SEO from your WordPress dashboard and connect Google Search Console in a couple of clicks.'],
                ['number' => 'Step 2', 'icon' => null, 'fa' => 'fa-solid fa-magnifying-glass-chart', 'title' => 'Audit & Align', 'description' => 'Run your first weighted audit, deploy schema and redirects, and align every page with the searches it should win.'],
                ['number' => 'Step 3', 'icon' => null, 'fa' => 'fa-solid fa-chart-line', 'title' => 'Scale Organic Reach', 'description' => 'Instant indexing, regression tracking and AI search readiness keep your visibility growing with every update.'],
            ],
            'button'   => ['title' => 'Download ECHO SEO For Free', 'url' => $echo_url, 'target' => '_blank'],
        ],
        'cta' => [
            'headline'  => 'Ready to Build an AI-First Search Foundation?',
            'subtext'   => 'Speak with the Digital Stride team to discover how ECHO SEO can be integrated into your website ecosystem.',
            'primary'   => ['title' => 'Download ECHO SEO', 'url' => $echo_url, 'target' => '_blank'],
            'secondary' => ['title' => 'Contact Strategy Team', 'url' => $contact, 'target' => ''],
            'features'  => [
                ['icon' => null, 'fa' => 'fa-solid fa-screwdriver-wrench', 'title' => 'Built for Services', 'desc' => 'Made for trades, AEC firms and local service brands.'],
                ['icon' => null, 'fa' => 'fa-solid fa-ranking-star', 'title' => 'Rank Higher on Google', 'desc' => 'Technical SEO and schema handled automatically.'],
                ['icon' => null, 'fa' => 'fa-solid fa-arrow-trend-up', 'title' => 'Higher Conversions', 'desc' => 'Faster pages and clearer search listings win more clicks.'],
                ['icon' => null, 'fa' => 'fa-solid fa-camera', 'title' => 'Quality Photos', 'desc' => 'Image SEO that shows off your real work in search.'],
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
 * Bullet text: plain text plus a few inline tags.
 */
function ds_echos_inline($text) {
    return wp_kses((string) $text, [
        'strong' => [],
        'b'      => [],
        'em'     => [],
        'i'      => [],
        'br'     => [],
        'span'   => ['class' => []],
        'a'      => ['href' => [], 'target' => [], 'rel' => []],
    ]);
}

/**
 * An icon: uploaded image (SVGs inline so CSS can tint them) or the
 * Font Awesome fallback.
 */
function ds_echos_icon($image, $fa, $class) {
    if (!empty($image['url'])) {
        return '<span class="' . esc_attr($class) . '">' . ds_inline_svg($image) . '</span>';
    }
    if ($fa) {
        return '<span class="' . esc_attr($class . ' ' . $class . '--fa') . '"><i class="' . esc_attr($fa) . '" aria-hidden="true"></i></span>';
    }
    return '';
}

/**
 * Pricing table cell: check, cross or custom text.
 */
function ds_echos_cell($type, $text) {
    $text = trim((string) $text);
    if ($type === 'text' && $text !== '') {
        return '<span class="ds-pft__text">' . esc_html($text) . '</span>';
    }
    if ($type === 'check') {
        return '<span class="ds-echos-pricing__check"><svg viewBox="0 0 24 24" width="24" height="24" aria-hidden="true"><circle cx="12" cy="12" r="12" fill="url(#ds-echos-gradient-gold)"/><path d="M7 12.5l3.2 3.2L17 9" fill="none" stroke="#111625" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg></span>'
            . '<span class="screen-reader-text">' . esc_html__('Included', 'digitalstride') . '</span>';
    }
    return '<span class="ds-pft__no"><i class="fa-solid fa-xmark" aria-hidden="true"></i></span>'
        . '<span class="screen-reader-text">' . esc_html__('Not included', 'digitalstride') . '</span>';
}

/**
 * Page CSS.
 */
add_action('wp_enqueue_scripts', function () {
    if (!is_page_template(DS_ECHOS_TEMPLATE)) return;
    wp_enqueue_style('ds-echos', ds_asset_url('assets/css/echos.css'), ['digitalstride-main'], null);
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
            'instructions' => 'Wrap a lead-in in <strong>…</strong> to make it bold. Leave empty to use the launch bullets.',
            'sub_fields'   => [
                ['key' => 'field_echos_' . $key . '_text', 'label' => 'Bullet text', 'name' => 'bullet_text', 'type' => 'text'],
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
            $text('hero_headline', 'hero_headline', 'Headline', $hero['headline'], 'text', ['instructions' => 'Allowed tags: <br>, <em>, <strong>, <span class="ds-echos-gold">.']),
            $text('hero_subheadline', 'hero_subheadline', 'Subheadline', $hero['subheadline'], 'textarea'),
            $button('hero_button', 'hero_button', 'Button', $hero['button']['title']),
            $image('hero_background_image', 'hero_background_image', 'Background image', 'Shown under a dark slate overlay. 1920×900 or larger.'),

            // 2. Intro banner
            $tab('intro', 'Intro Banner'),
            $image('intro_logo', 'intro_logo', 'ECHO SEO logo', 'Without a logo the banner shows an ECHO SEO wordmark.'),
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
                'instructions' => 'Shown 3 per row on desktop (6 recommended). Leave empty to use the launch cards.',
                'collapsed'    => 'field_echos_s4_card_title',
                'sub_fields'   => [
                    ['key' => 'field_echos_s4_card_title', 'label' => 'Title', 'name' => 'card_title', 'type' => 'text', 'wrapper' => ['width' => '70']],
                    ['key' => 'field_echos_s4_card_highlight', 'label' => 'Highlight', 'name' => 'is_highlighted', 'type' => 'true_false', 'ui' => 1, 'message' => 'Gold border & glow', 'wrapper' => ['width' => '30']],
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
                    ['key' => 'field_echos_s6_step_title', 'label' => 'Title', 'name' => 'step_title', 'type' => 'text', 'wrapper' => ['width' => '70']],
                    ['key' => 'field_echos_s6_step_icon', 'label' => 'Icon', 'name' => 'step_icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all', 'instructions' => 'SVG recommended (tinted gold).', 'wrapper' => ['width' => '30']],
                    ['key' => 'field_echos_s6_step_desc', 'label' => 'Description', 'name' => 'step_description', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'wrapper' => ['width' => '70']],
                ],
            ],
            $button('s6_bottom_button', 's6_bottom_button', 'Button below the steps', $steps['button']['title'], 'Links to https://echo-seo.com/ (new tab) by default. Point it at a download page if you prefer.'),

            // 7. CTA
            $tab('cta', 'Call to Action'),
            ['key' => 'field_echos_cta_msg', 'label' => '', 'name' => '', 'type' => 'message', 'message' => 'This page uses its own call to action instead of the Global CTA.'],
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
                'instructions' => 'Leave empty to use the launch highlights.',
                'sub_fields'   => [
                    ['key' => 'field_echos_cta_feature_icon', 'label' => 'Icon', 'name' => 'feature_icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all', 'wrapper' => ['width' => '20']],
                    ['key' => 'field_echos_cta_feature_title', 'label' => 'Title', 'name' => 'feature_title', 'type' => 'text', 'wrapper' => ['width' => '30']],
                    ['key' => 'field_echos_cta_feature_desc', 'label' => 'Description', 'name' => 'feature_desc', 'type' => 'text', 'wrapper' => ['width' => '50']],
                ],
            ],
            $image('cta_background_image', 'cta_background_image', 'Background image', 'Shown under a dark slate overlay.'),

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
