<?php
/**
 * Proposal & RFP/RFQ templates.
 *
 * Each template is one PHP file in /proposal-templates/ that returns an
 * array (see proposal-templates/README.md). They are loaded from disk — no
 * post type, no database — so adding a template is "copy a file, edit it".
 *
 * URLs (no WordPress page needed):
 *   /proposal-templates/          library of every template
 *   /proposal-templates/{slug}/   one template, with live fill-in fields,
 *                                 print / PDF, Word download and copy
 *
 * The library can also be placed on any page with the "Proposal Templates"
 * flexible-content layout (template-parts/flex-proposal_templates.php).
 */

if (!defined('ABSPATH')) {
    exit;
}

define('DS_PT_BASE', 'proposal-templates');
define('DS_PT_DIR', DS_DIR . '/proposal-templates');
define('DS_PT_QUERY_VAR', 'ds_pt');
// Bump when the rewrite rules below change so they are flushed once.
define('DS_PT_REWRITE_VERSION', '1');

/**
 * Industries a template can belong to, in display order.
 *
 * @return array<string, array{label:string, audience:string, icon:string}>
 */
function ds_pt_industries() {
    return [
        'architecture' => ['label' => __('Architecture', 'digitalstride'),      'audience' => 'aec',           'icon' => 'fa-compass-drafting'],
        'engineering'  => ['label' => __('Engineering', 'digitalstride'),       'audience' => 'aec',           'icon' => 'fa-gears'],
        'construction' => ['label' => __('Construction / GC', 'digitalstride'), 'audience' => 'aec',           'icon' => 'fa-helmet-safety'],
        'hvac'         => ['label' => __('HVAC', 'digitalstride'),              'audience' => 'home_services', 'icon' => 'fa-fan'],
        'plumbing'     => ['label' => __('Plumbing', 'digitalstride'),          'audience' => 'home_services', 'icon' => 'fa-faucet-drip'],
        'electrical'   => ['label' => __('Electrical', 'digitalstride'),        'audience' => 'home_services', 'icon' => 'fa-bolt'],
        'roofing'      => ['label' => __('Roofing', 'digitalstride'),           'audience' => 'home_services', 'icon' => 'fa-house-chimney'],
    ];
}

/**
 * @return array<string, string>
 */
function ds_pt_types() {
    return [
        'rfp'      => __('RFP / RFQ Response', 'digitalstride'),
        'proposal' => __('Proposal', 'digitalstride'),
    ];
}

/**
 * Every published template, keyed by slug, sorted by industry then type.
 *
 * Files starting with "_" are skipped (drafts / hidden). A file whose slug
 * doesn't match its file name, or with no sections, is skipped too so one
 * bad edit can't break the library.
 *
 * @return array<string, array>
 */
function ds_pt_all() {
    static $cache = null;
    if ($cache !== null) return $cache;

    $cache      = [];
    $industries = ds_pt_industries();
    $types      = ds_pt_types();

    foreach (glob(DS_PT_DIR . '/*.php') ?: [] as $file) {
        $slug = basename($file, '.php');
        if ($slug === '' || $slug[0] === '_') continue;

        $t = include $file;
        if (!is_array($t) || empty($t['sections']) || ($t['slug'] ?? '') !== $slug) {
            if (defined('WP_DEBUG') && WP_DEBUG) {
                trigger_error('Proposal template skipped (bad format or slug mismatch): ' . $file, E_USER_NOTICE);
            }
            continue;
        }

        $industry = isset($industries[$t['industry'] ?? '']) ? $t['industry'] : '';
        $type     = isset($types[$t['type'] ?? '']) ? $t['type'] : 'proposal';

        $cache[$slug] = wp_parse_args($t, [
            'title'     => $slug,
            'summary'   => '',
            'use_when'  => [],
            'length'    => '',
            'fields'    => [],
            'checklist' => [],
        ]);
        $cache[$slug]['industry'] = $industry;
        $cache[$slug]['type']     = $type;
        $cache[$slug]['audience'] = $industry ? $industries[$industry]['audience'] : 'all';
    }

    $order      = array_flip(array_keys($industries));
    $type_order = array_flip(array_keys($types));
    uasort($cache, function ($a, $b) use ($order, $type_order) {
        return [$order[$a['industry']] ?? 99, $type_order[$a['type']], $a['title']]
           <=> [$order[$b['industry']] ?? 99, $type_order[$b['type']], $b['title']];
    });

    return $cache;
}

function ds_pt_get($slug) {
    $all = ds_pt_all();
    return $all[$slug] ?? null;
}

function ds_pt_url($slug = '') {
    return home_url(user_trailingslashit(DS_PT_BASE . ($slug ? '/' . $slug : '')));
}

// ── Routing ──────────────────────────────────────────

add_action('init', function () {
    add_rewrite_rule('^' . DS_PT_BASE . '/?$', 'index.php?' . DS_PT_QUERY_VAR . '=__library', 'top');
    add_rewrite_rule('^' . DS_PT_BASE . '/([a-z0-9-]+)/?$', 'index.php?' . DS_PT_QUERY_VAR . '=$matches[1]', 'top');

    if (get_option('ds_pt_rewrite_version') !== DS_PT_REWRITE_VERSION) {
        flush_rewrite_rules(false);
        update_option('ds_pt_rewrite_version', DS_PT_REWRITE_VERSION);
    }
});

add_filter('query_vars', function ($vars) {
    $vars[] = DS_PT_QUERY_VAR;
    return $vars;
});

/**
 * Current request: '__library', a template slug, or ''.
 */
function ds_pt_request() {
    return (string) get_query_var(DS_PT_QUERY_VAR);
}

add_action('template_redirect', function () {
    $req = ds_pt_request();
    if ($req === '' || $req === '__library' || ds_pt_get($req)) return;

    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    nocache_headers();
});

add_filter('template_include', function ($template) {
    $req = ds_pt_request();
    if ($req === '') return $template;
    if ($req === '__library') return DS_DIR . '/proposal-template-library.php';
    if (ds_pt_get($req)) return DS_DIR . '/proposal-template-single.php';
    return $template;
}, 20);

add_filter('document_title_parts', function ($parts) {
    $req = ds_pt_request();
    if ($req === '__library') {
        $parts['title'] = __('Free RFP, RFQ & Proposal Templates for AEC Firms and Contractors', 'digitalstride');
    } elseif ($req && ($t = ds_pt_get($req))) {
        $parts['title'] = sprintf(__('%s Template', 'digitalstride'), $t['title']);
    }
    return $parts;
});

add_filter('body_class', function ($classes) {
    if (ds_pt_request() !== '') $classes[] = 'ds-pt-page';
    return $classes;
});

// These virtual pages aren't singular, so SEO plugins skip them; give them
// a description and canonical of their own.
add_action('wp_head', function () {
    $req = ds_pt_request();
    if ($req === '') return;

    if ($req === '__library') {
        $desc = __('Free, fill-in-the-blank RFP/RFQ response and proposal templates for architects, engineers, contractors, and HVAC, plumbing, electrical and roofing companies.', 'digitalstride');
        $url  = ds_pt_url();
    } elseif ($t = ds_pt_get($req)) {
        $desc = $t['summary'];
        $url  = ds_pt_url($req);
    } else {
        return;
    }
    printf("<meta name=\"description\" content=\"%s\">\n", esc_attr(wp_strip_all_tags($desc)));
    printf("<link rel=\"canonical\" href=\"%s\">\n", esc_url($url));
    printf("<meta property=\"og:title\" content=\"%s\">\n", esc_attr(wp_get_document_title()));
    printf("<meta property=\"og:description\" content=\"%s\">\n", esc_attr(wp_strip_all_tags($desc)));
    printf("<meta property=\"og:url\" content=\"%s\">\n", esc_url($url));
}, 1);

// Include the templates in WordPress's core sitemap (/wp-sitemap.xml).
add_action('init', function () {
    if (!function_exists('wp_register_sitemap_provider') || !class_exists('WP_Sitemaps_Provider')) return;

    wp_register_sitemap_provider('proposaltemplates', new class extends WP_Sitemaps_Provider {
        public function __construct() {
            $this->name        = 'proposaltemplates';
            $this->object_type = 'proposaltemplates';
        }
        public function get_url_list($page_num, $object_subtype = '') {
            if ($page_num > 1) return [];
            $urls = [['loc' => ds_pt_url()]];
            foreach (array_keys(ds_pt_all()) as $slug) {
                $urls[] = ['loc' => ds_pt_url($slug)];
            }
            return $urls;
        }
        public function get_max_num_pages($object_subtype = '') {
            return 1;
        }
    });
}, 20);

// ── Assets ───────────────────────────────────────────

add_action('wp_enqueue_scripts', function () {
    wp_register_script('ds-proposal-templates', DS_URI . '/assets/js/proposal-templates.js', [], DS_VERSION, true);
    if (ds_pt_request() !== '') wp_enqueue_script('ds-proposal-templates');
});

// ── Rendering ────────────────────────────────────────

/**
 * Template body HTML → safe HTML with fill-in fields and hand-filled
 * [brackets] marked up for the on-page tools.
 */
function ds_pt_render_body($html, array $fields) {
    $allowed = [
        'p' => [], 'h4' => [], 'ul' => [], 'ol' => [], 'li' => [], 'strong' => [], 'em' => [], 'br' => [],
        'table' => [], 'thead' => [], 'tbody' => [], 'tr' => [], 'th' => ['colspan' => true], 'td' => ['colspan' => true],
    ];
    $html = wp_kses((string) $html, $allowed);

    // Tables scroll sideways on phones instead of squashing.
    $html = str_replace(['<table>', '</table>'], ['<div class="ds-pt__table"><table>', '</table></div>'], $html);

    // [Fill this in] — one level of nesting allowed ("[DBE — [State] UCP]").
    // No tag in the allowed set carries brackets, so a regex over the
    // markup is safe here.
    $html = preg_replace('/\[((?:[^\[\]<>]|\[[^\[\]<>]*\]){1,300})\]/u', '<mark class="ds-pt__fill">[$1]</mark>', $html);

    // {{token}} → live field.
    return preg_replace_callback('/\{\{(\w+)\}\}/', function ($m) use ($fields) {
        $label = $fields[$m[1]] ?? $m[1];
        return '<span class="ds-pt__token" data-token="' . esc_attr($m[1]) . '" data-label="' . esc_attr($label) . '">'
            . esc_html($label) . '</span>';
    }, $html);
}

/**
 * Library grid with industry / type filters. Used by the /proposal-templates/
 * page and the flexible-content layout.
 *
 * @param array $args industries (slug[] — empty for all), type ('all'|'rfp'|'proposal'),
 *                    filters (bool), heading_level (int).
 */
function ds_pt_render_library($args = []) {
    $args = wp_parse_args($args, [
        'industries'    => [],
        'type'          => 'all',
        'filters'       => true,
        'heading_level' => 3,
    ]);

    $industries = ds_pt_industries();
    $types      = ds_pt_types();
    $templates  = array_filter(ds_pt_all(), function ($t) use ($args) {
        if ($args['industries'] && !in_array($t['industry'], (array) $args['industries'], true)) return false;
        if ($args['type'] !== 'all' && $t['type'] !== $args['type']) return false;
        return true;
    });
    if (!$templates) return;

    wp_enqueue_script('ds-proposal-templates');

    $used = array_values(array_unique(array_column($templates, 'industry')));
    $h    = 'h' . max(2, min(6, (int) $args['heading_level']));
    ?>
    <div class="ds-pt-library" data-pt-library>
        <?php if ($args['filters'] && count($used) > 1) : ?>
            <div class="ds-pt-library__filters" role="group" aria-label="<?php esc_attr_e('Filter templates by industry', 'digitalstride'); ?>">
                <button type="button" class="ds-pt-library__filter is-active" data-pt-filter="" aria-pressed="true"><?php esc_html_e('All industries', 'digitalstride'); ?></button>
                <?php foreach ($industries as $slug => $ind) : if (!in_array($slug, $used, true)) continue; ?>
                    <button type="button" class="ds-pt-library__filter ds-audience--<?php echo esc_attr($ind['audience']); ?>" data-pt-filter="<?php echo esc_attr($slug); ?>" aria-pressed="false">
                        <i class="fa-solid <?php echo esc_attr($ind['icon']); ?>" aria-hidden="true"></i>
                        <?php echo esc_html($ind['label']); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <ul class="ds-pt-library__grid" role="list">
            <?php foreach ($templates as $slug => $t) :
                $ind = $industries[$t['industry']] ?? null; ?>
                <li class="ds-pt-card<?php echo $ind ? ' ds-audience--' . esc_attr($ind['audience']) : ''; ?>" data-industry="<?php echo esc_attr($t['industry']); ?>">
                    <div class="ds-pt-card__meta">
                        <?php if ($ind) : ?>
                            <span class="ds-pt-badge"><i class="fa-solid <?php echo esc_attr($ind['icon']); ?>" aria-hidden="true"></i> <?php echo esc_html($ind['label']); ?></span>
                        <?php endif; ?>
                        <span class="ds-pt-badge ds-pt-badge--<?php echo esc_attr($t['type']); ?>"><?php echo esc_html($types[$t['type']]); ?></span>
                    </div>
                    <<?php echo $h; ?> class="ds-pt-card__title">
                        <a href="<?php echo esc_url(ds_pt_url($slug)); ?>"><?php echo esc_html($t['title']); ?></a>
                    </<?php echo $h; ?>>
                    <p class="ds-pt-card__summary"><?php echo esc_html($t['summary']); ?></p>
                    <p class="ds-pt-card__foot">
                        <span><?php printf(esc_html(_n('%d section', '%d sections', count($t['sections']), 'digitalstride')), count($t['sections'])); ?></span>
                        <?php if ($t['length']) : ?><span><?php echo esc_html($t['length']); ?></span><?php endif; ?>
                        <span class="ds-pt-card__cta" aria-hidden="true"><?php esc_html_e('Use template', 'digitalstride'); ?> <i class="fa-solid fa-arrow-right"></i></span>
                    </p>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="ds-pt-library__empty" hidden><?php esc_html_e('No templates for this industry yet.', 'digitalstride'); ?></p>
    </div>
    <?php
}

// ── Flexible-content layout ──────────────────────────
// The layout's fields live in acf-json/group_page_sections.json
// (layout_proposal_templates); its choices are filled from ds_pt_industries().
add_filter('acf/load_field/key=field_pt_industries', function ($field) {
    $field['choices'] = wp_list_pluck(ds_pt_industries(), 'label');
    return $field;
});
