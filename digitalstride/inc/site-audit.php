<?php
/**
 * Free Website & AI Search Readiness Audit — lead magnet.
 *
 * Flow (template-parts/flex-site_audit.php + assets/js/main.js):
 *  1. Visitor submits name / email / website  → ds_site_audit_submit
 *     Lead is saved immediately (so it's captured even if the audit fails)
 *     and a short-lived token is returned to the browser.
 *  2. Browser requests the audit with that token → ds_site_audit_run
 *     - Google PageSpeed Insights API (Lighthouse): Performance, SEO,
 *       Accessibility, Best Practices, and — where PSI exposes it — the
 *       Lighthouse 13 "Agentic Browsing" category.
 *     - Our own AI search readiness checks: AI crawler access in robots.txt,
 *       llms.txt, structured data (JSON-LD), and an agent catalog
 *       (/.well-known/ai-catalog.json or ard.json).
 *     - Optional plain-English summary from Claude (reuses the AI Quote key).
 *     The report is saved to the lead, emailed to the team, and optionally
 *     emailed to the prospect.
 *
 * Settings: Theme Settings → Site Audit. PageSpeed key resolution: the
 * DS_PSI_API_KEY constant (wp-config.php) wins over the options field.
 */

function ds_audit_option($name, $default = null) {
    if (!function_exists('get_field')) return $default;
    $val = get_field($name, 'option');
    return ($val === null || $val === '') ? $default : $val;
}

function ds_audit_psi_key() {
    if (defined('DS_PSI_API_KEY') && DS_PSI_API_KEY) return DS_PSI_API_KEY;
    return (string) ds_audit_option('site_audit_psi_key', '');
}

// ── Audit Leads CPT (admin-only record of requests) ──────────
add_action('init', function () {
    register_post_type('ds_audit_lead', [
        'labels' => [
            'name'          => 'Site Audit Leads',
            'singular_name' => 'Site Audit Lead',
            'menu_name'     => 'Audit Leads',
        ],
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-chart-area',
        'supports'            => ['title', 'editor'],
        'capability_type'     => 'post',
        'capabilities'        => ['create_posts' => 'do_not_allow'],
        'map_meta_cap'        => true,
        'exclude_from_search' => true,
        'show_in_rest'        => false,
    ]);
});

/**
 * Normalize a visitor-entered website into an absolute http(s) URL, or ''.
 */
function ds_audit_normalize_url($raw) {
    $raw = trim((string) $raw);
    if ($raw === '') return '';
    if (!preg_match('#^https?://#i', $raw)) $raw = 'https://' . $raw;
    $url   = esc_url_raw($raw, ['http', 'https']);
    $parts = $url ? wp_parse_url($url) : false;
    if (!$parts || empty($parts['host']) || strpos($parts['host'], '.') === false) return '';
    if (filter_var($parts['host'], FILTER_VALIDATE_IP)) return ''; // domains only
    return $url;
}

function ds_audit_origin($url) {
    $p = wp_parse_url($url);
    return $p['scheme'] . '://' . $p['host'] . (isset($p['port']) ? ':' . $p['port'] : '');
}

/**
 * Fetch a URL on the visitor's site. wp_safe_remote_get() refuses private /
 * loopback addresses, so a submitted URL can't be used to probe our network.
 */
function ds_audit_fetch($url, $max_bytes = 524288) {
    return wp_safe_remote_get($url, [
        'timeout'             => 10,
        'redirection'         => 3,
        'limit_response_size' => $max_bytes,
        'user-agent'          => 'Mozilla/5.0 (compatible; DigitalStrideAudit/1.0; +' . home_url('/') . ')',
    ]);
}

// ── Google PageSpeed Insights (Lighthouse) ───────────────────

/** PSI API category values → display order. */
function ds_audit_psi_categories() {
    return [
        'PERFORMANCE'      => 'performance',
        'SEO'              => 'seo',
        'ACCESSIBILITY'    => 'accessibility',
        'BEST_PRACTICES'   => 'best-practices',
        'AGENTIC_BROWSING' => 'agentic-browsing', // Lighthouse 13+; dropped if PSI rejects it
    ];
}

function ds_audit_run_pagespeed($url) {
    $categories = array_keys(ds_audit_psi_categories());

    // Two attempts: with the Agentic Browsing category, then without it in
    // case this PSI deployment doesn't accept it yet (400 on unknown enum).
    foreach ([$categories, array_diff($categories, ['AGENTIC_BROWSING'])] as $attempt) {
        // PSI expects the category param repeated, which http_build_query can't do.
        $query = 'url=' . rawurlencode($url) . '&strategy=mobile';
        foreach ($attempt as $cat) $query .= '&category=' . $cat;
        if (ds_audit_psi_key()) $query .= '&key=' . rawurlencode(ds_audit_psi_key());

        $response = wp_remote_get('https://www.googleapis.com/pagespeedonline/v5/runPagespeed?' . $query, ['timeout' => 90]);
        if (is_wp_error($response)) return $response;

        $code = wp_remote_retrieve_response_code($response);
        $data = json_decode(wp_remote_retrieve_body($response), true);
        if ($code === 200 && isset($data['lighthouseResult'])) return ds_audit_parse_psi($data);

        $message = $data['error']['message'] ?? ('HTTP ' . $code);
        // A 400 about the URL itself (unreachable, DNS) won't be fixed by retrying.
        if ($code !== 400 || stripos($message, 'category') === false) break;
    }
    return new WP_Error('ds_audit_psi', 'PageSpeed Insights error: ' . $message);
}

function ds_audit_parse_psi($data) {
    $lh     = $data['lighthouseResult'];
    $audits = $lh['audits'] ?? [];
    $report = [
        'lighthouse_version' => $lh['lighthouseVersion'] ?? '',
        'final_url'          => $lh['finalDisplayedUrl'] ?? ($lh['finalUrl'] ?? ''),
        'scores'             => [],
        'metrics'            => [],
        'opportunities'      => [],
        'agentic'            => [],
        'field_speed'        => $data['loadingExperience']['overall_category'] ?? '',
    ];

    foreach (ds_audit_psi_categories() as $id) {
        if (!isset($lh['categories'][$id]['score'])) continue;
        $report['scores'][$id] = [
            'title' => $lh['categories'][$id]['title'],
            'score' => (int) round($lh['categories'][$id]['score'] * 100),
        ];
    }

    $metric_ids = [
        'largest-contentful-paint' => 'Largest Contentful Paint',
        'cumulative-layout-shift'  => 'Cumulative Layout Shift',
        'total-blocking-time'      => 'Total Blocking Time',
        'first-contentful-paint'   => 'First Contentful Paint',
        'speed-index'              => 'Speed Index',
    ];
    foreach ($metric_ids as $id => $label) {
        if (!isset($audits[$id]['displayValue']) || $audits[$id]['displayValue'] === '') continue;
        $report['metrics'][] = [
            'label' => $label,
            'value' => $audits[$id]['displayValue'],
            'score' => isset($audits[$id]['score']) ? (float) $audits[$id]['score'] : null,
        ];
    }

    // Failing audits across categories, heaviest-weighted first.
    $failing = [];
    foreach ($lh['categories'] ?? [] as $cat_id => $cat) {
        foreach ($cat['auditRefs'] ?? [] as $ref) {
            $a = $audits[$ref['id']] ?? null;
            if (!$a || ($ref['group'] ?? '') === 'metrics' || ($ref['group'] ?? '') === 'hidden') continue;
            if (!in_array($a['scoreDisplayMode'] ?? '', ['binary', 'numeric', 'metricSavings'], true)) continue;
            if (!isset($a['score'])) continue;

            $item = [
                'title'    => $a['title'],
                'category' => $cat['title'],
                'detail'   => $a['displayValue'] ?? '',
                'passed'   => $a['score'] >= 0.9,
            ];
            if ($cat_id === 'agentic-browsing') {
                $report['agentic'][] = $item;
                continue;
            }
            if ($item['passed'] || isset($failing[$ref['id']])) continue;
            $item['weight'] = (float) ($ref['weight'] ?? 0);
            $item['score']  = (float) $a['score'];
            $failing[$ref['id']] = $item;
        }
    }
    uasort($failing, function ($a, $b) {
        return [$b['weight'], $a['score']] <=> [$a['weight'], $b['score']];
    });
    foreach (array_slice($failing, 0, 8) as $item) {
        unset($item['weight'], $item['score'], $item['passed']);
        $report['opportunities'][] = $item;
    }

    return $report;
}

// ── AI search readiness checks ───────────────────────────────

/** Crawlers that feed search results / AI answers, and training-only crawlers. */
function ds_audit_ai_bots() {
    return [
        'search'   => ['Googlebot', 'Bingbot', 'OAI-SearchBot', 'Claude-SearchBot', 'PerplexityBot'],
        'training' => ['GPTBot', 'ClaudeBot', 'Google-Extended', 'Applebot-Extended'],
    ];
}

/**
 * Minimal robots.txt reader: is the whole site disallowed for this bot?
 * Uses the bot's own group when one exists, otherwise the * group.
 */
function ds_audit_robots_blocks($robots, $bot) {
    $groups  = [];
    $current = null;
    $in_ua   = false;
    foreach (preg_split('/\r\n|\r|\n/', $robots) as $line) {
        $line = trim(preg_replace('/#.*/', '', $line));
        if (!preg_match('/^([a-z-]+)\s*:\s*(.*)$/i', $line, $m)) continue;
        $field = strtolower($m[1]);
        $value = trim($m[2]);
        if ($field === 'user-agent') {
            if (!$in_ua) {
                $groups[] = ['agents' => [], 'rules' => []];
                $current  = count($groups) - 1;
            }
            $groups[$current]['agents'][] = strtolower($value);
            $in_ua = true;
        } elseif ($current !== null && ($field === 'disallow' || $field === 'allow')) {
            $groups[$current]['rules'][] = [$field, $value];
            $in_ua = false;
        }
    }

    $match = null;
    foreach ($groups as $g) {
        if (in_array(strtolower($bot), $g['agents'], true)) { $match = $g; break; }
    }
    if (!$match) {
        foreach ($groups as $g) {
            if (in_array('*', $g['agents'], true)) { $match = $g; break; }
        }
    }
    if (!$match) return false;

    $blocked = false;
    foreach ($match['rules'] as $rule) {
        if ($rule[1] === '/' || $rule[1] === '/*') $blocked = ($rule[0] === 'disallow');
    }
    return $blocked;
}

/**
 * Collect every @type from decoded JSON-LD (handles @graph and nesting).
 */
function ds_audit_jsonld_types($node, &$types) {
    if (!is_array($node)) return;
    if (isset($node['@type'])) {
        foreach ((array) $node['@type'] as $t) {
            if (is_string($t)) $types[] = $t;
        }
    }
    foreach ($node as $child) ds_audit_jsonld_types($child, $types);
}

function ds_audit_ai_readiness($url) {
    $origin = ds_audit_origin($url);
    $checks = [];
    $bots   = ds_audit_ai_bots();

    // 1. AI crawler access (robots.txt)
    $res = ds_audit_fetch($origin . '/robots.txt', 262144);
    $code = is_wp_error($res) ? 0 : wp_remote_retrieve_response_code($res);
    if ($code === 200) {
        $robots   = wp_remote_retrieve_body($res);
        $search   = array_values(array_filter($bots['search'], function ($b) use ($robots) { return ds_audit_robots_blocks($robots, $b); }));
        $training = array_values(array_filter($bots['training'], function ($b) use ($robots) { return ds_audit_robots_blocks($robots, $b); }));
        if ($search) {
            $checks[] = ['key' => 'crawlers', 'label' => 'Search & AI crawlers can reach your site', 'status' => 'fail',
                'detail' => 'robots.txt blocks ' . implode(', ', $search) . ' — these crawlers power Google, Bing, ChatGPT search, Claude and Perplexity answers.'];
        } elseif ($training) {
            $checks[] = ['key' => 'crawlers', 'label' => 'Search & AI crawlers can reach your site', 'status' => 'warn',
                'detail' => 'Search crawlers are allowed, but ' . implode(', ', $training) . ' are blocked. That limits AI model training only — fine if intentional.'];
        } else {
            $checks[] = ['key' => 'crawlers', 'label' => 'Search & AI crawlers can reach your site', 'status' => 'pass',
                'detail' => 'robots.txt allows the major search and AI crawlers.'];
        }
        if (!preg_match('/^\s*sitemap\s*:/im', $robots)) {
            $checks[] = ['key' => 'sitemap', 'label' => 'Sitemap listed in robots.txt', 'status' => 'warn',
                'detail' => 'Add a "Sitemap:" line so crawlers can find every page.'];
        } else {
            $checks[] = ['key' => 'sitemap', 'label' => 'Sitemap listed in robots.txt', 'status' => 'pass', 'detail' => 'Crawlers can find your sitemap.'];
        }
    } else {
        $checks[] = ['key' => 'crawlers', 'label' => 'Search & AI crawlers can reach your site', 'status' => 'warn',
            'detail' => 'No robots.txt found. Crawlers are allowed by default, but you have no way to point them to your sitemap.'];
    }

    // 2. Structured data on the page
    $res  = ds_audit_fetch($url, 2097152);
    $html = is_wp_error($res) ? '' : (string) wp_remote_retrieve_body($res);
    $types = [];
    if ($html && preg_match_all('#<script[^>]+type=["\']?application/ld\+json["\']?[^>]*>(.*?)</script>#is', $html, $m)) {
        foreach ($m[1] as $block) ds_audit_jsonld_types(json_decode(html_entity_decode(trim($block)), true), $types);
    }
    $types    = array_values(array_unique($types));
    $business = array_filter($types, function ($t) {
        return preg_match('/(Organization|Business|Contractor|Service|Store|Plumber|Electrician|Roofing|HVAC|Architect|Engineer|Corporation)$/i', $t);
    });
    if ($business) {
        $checks[] = ['key' => 'schema', 'label' => 'Business structured data (schema.org)', 'status' => 'pass',
            'detail' => 'Found: ' . implode(', ', array_slice($types, 0, 6)) . '. This helps search engines and AI assistants understand who you are and where you work.'];
    } elseif ($types) {
        $checks[] = ['key' => 'schema', 'label' => 'Business structured data (schema.org)', 'status' => 'warn',
            'detail' => 'Structured data found (' . implode(', ', array_slice($types, 0, 4)) . '), but nothing that describes your business, services or service area.'];
    } else {
        $checks[] = ['key' => 'schema', 'label' => 'Business structured data (schema.org)', 'status' => 'fail',
            'detail' => 'No JSON-LD structured data found. AI assistants and Google rely on it to confirm your business name, services, location and reviews.'];
    }

    // 3. llms.txt — mirrors Lighthouse's check (Markdown with an H1 and links)
    $res  = ds_audit_fetch($origin . '/llms.txt', 262144);
    $body = (!is_wp_error($res) && wp_remote_retrieve_response_code($res) === 200) ? (string) wp_remote_retrieve_body($res) : '';
    if ($body !== '' && stripos(ltrim($body), '<') !== 0 && preg_match('/^#\s+\S/m', $body)) {
        $checks[] = ['key' => 'llms', 'label' => 'llms.txt guide for AI models', 'status' => 'pass',
            'detail' => 'Your llms.txt gives AI models a curated map of your most important pages.'];
    } else {
        $checks[] = ['key' => 'llms', 'label' => 'llms.txt guide for AI models', 'status' => 'fail',
            'detail' => 'No valid /llms.txt. This emerging standard (now checked by Google Lighthouse) tells AI models which pages matter most.'];
    }

    // 4. Agent catalog (Agentic Resource Discovery) — newest, lowest stakes
    $found = false;
    foreach (['/.well-known/ard.json', '/.well-known/ai-catalog.json'] as $path) {
        $res = ds_audit_fetch($origin . $path, 262144);
        if (!is_wp_error($res) && wp_remote_retrieve_response_code($res) === 200
            && is_array(json_decode(wp_remote_retrieve_body($res), true))) {
            $found = true;
            break;
        }
    }
    $checks[] = ['key' => 'ard', 'label' => 'AI agent catalog (Agentic Resource Discovery)', 'status' => $found ? 'pass' : 'warn',
        'detail' => $found
            ? 'Your site publishes an agent catalog AI agents can discover.'
            : 'No /.well-known/ard.json found. This new spec (added to Lighthouse 13.5) lets AI agents discover what your site can do — early adopters get ahead.'];

    $points = ['pass' => 1, 'warn' => 0.5, 'fail' => 0];
    $total  = 0;
    foreach ($checks as $c) $total += $points[$c['status']];

    return [
        'score'  => (int) round($total / count($checks) * 100),
        'checks' => $checks,
    ];
}

// ── Optional Claude summary ──────────────────────────────────

function ds_audit_ai_summary_enabled() {
    return ds_audit_option('site_audit_ai_summary', false)
        && function_exists('ds_survey_ai_api_key') && ds_survey_ai_api_key();
}

function ds_audit_ai_summary($url, $report) {
    $model = (string) ds_audit_option('ai_quote_model', 'claude-opus-4-8');

    $system = "You are a senior web strategist at Digital Stride, a digital marketing agency in York, PA serving AEC (architecture, engineering, construction) and home service companies. "
            . "A prospect just ran our free website and AI search readiness audit on their site. Write a short, plain-English read of the results for a business owner, in second person. "
            . "Rules: use only the data provided; never invent numbers, rankings, traffic figures or guarantees; this audit does not measure search rankings, so don't claim it does. "
            . "Prioritize fixes that most affect whether customers and AI assistants can find and trust them. No jargon — explain any technical term in a few words.";

    $user = "WEBSITE: {$url}\n\nAUDIT DATA (JSON):\n" . wp_json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
          . "\n\nWrite their summary.";

    $schema = [
        'type'       => 'object',
        'properties' => [
            'headline'  => ['type' => 'string', 'description' => 'One-sentence verdict, under 15 words.'],
            'summary'   => ['type' => 'string', 'description' => '2-3 sentences on what the results mean for getting found by customers and AI assistants.'],
            'top_fixes' => [
                'type'  => 'array',
                'items' => [
                    'type'       => 'object',
                    'properties' => [
                        'title' => ['type' => 'string', 'description' => 'The fix, as a short action.'],
                        'why'   => ['type' => 'string', 'description' => 'Why it matters for their business, one sentence.'],
                    ],
                    'required'             => ['title', 'why'],
                    'additionalProperties' => false,
                ],
                'description' => 'The 3 highest-impact fixes, in priority order.',
            ],
        ],
        'required'             => ['headline', 'summary', 'top_fixes'],
        'additionalProperties' => false,
    ];

    $response = wp_remote_post('https://api.anthropic.com/v1/messages', [
        'timeout' => 60,
        'headers' => [
            'content-type'      => 'application/json',
            'x-api-key'         => ds_survey_ai_api_key(),
            'anthropic-version' => '2023-06-01',
        ],
        'body' => wp_json_encode([
            'model'         => $model,
            'max_tokens'    => 1500,
            'output_config' => [
                'effort' => 'low',
                'format' => ['type' => 'json_schema', 'schema' => $schema],
            ],
            'system'   => $system,
            'messages' => [['role' => 'user', 'content' => $user]],
        ]),
    ]);
    if (is_wp_error($response)) return $response;

    $data = json_decode(wp_remote_retrieve_body($response), true);
    if (wp_remote_retrieve_response_code($response) !== 200 || !is_array($data)) {
        return new WP_Error('ds_audit_ai', 'Claude API error: ' . ($data['error']['message'] ?? 'HTTP ' . wp_remote_retrieve_response_code($response)));
    }
    foreach ($data['content'] ?? [] as $block) {
        if (($block['type'] ?? '') !== 'text') continue;
        $summary = json_decode($block['text'], true);
        if (is_array($summary) && !empty($summary['headline'])) return $summary;
    }
    return new WP_Error('ds_audit_ai_parse', 'Could not parse the AI summary.');
}

// ── Plain-text report (emails + admin record) ────────────────

function ds_audit_report_text($report) {
    $lines = ['Website: ' . $report['url'], ''];

    if (!empty($report['ai_summary'])) {
        $s = $report['ai_summary'];
        $lines[] = $s['headline'];
        $lines[] = $s['summary'];
        $lines[] = '';
        foreach ($s['top_fixes'] as $i => $fix) {
            $lines[] = sprintf('%d. %s — %s', $i + 1, $fix['title'], $fix['why']);
        }
        $lines[] = '';
    }

    $lines[] = '== Scores (out of 100) ==';
    $lines[] = 'AI Search Readiness: ' . $report['ai_readiness']['score'];
    foreach ($report['lighthouse']['scores'] ?? [] as $s) $lines[] = $s['title'] . ': ' . $s['score'];
    if (!empty($report['lighthouse_error'])) $lines[] = '(Google Lighthouse could not be run: ' . $report['lighthouse_error'] . ')';

    $lines[] = '';
    $lines[] = '== AI Search Readiness ==';
    $marks = ['pass' => '[PASS]', 'warn' => '[CHECK]', 'fail' => '[FIX]'];
    foreach ($report['ai_readiness']['checks'] as $c) {
        $lines[] = $marks[$c['status']] . ' ' . $c['label'];
        $lines[] = '    ' . $c['detail'];
    }
    foreach ($report['lighthouse']['agentic'] ?? [] as $a) {
        $lines[] = ($a['passed'] ? '[PASS] ' : '[FIX] ') . $a['title'] . ' (Lighthouse)';
    }

    if (!empty($report['lighthouse']['metrics'])) {
        $lines[] = '';
        $lines[] = '== Mobile Speed ==';
        foreach ($report['lighthouse']['metrics'] as $m) $lines[] = $m['label'] . ': ' . $m['value'];
    }
    if (!empty($report['lighthouse']['opportunities'])) {
        $lines[] = '';
        $lines[] = '== Top Issues Found ==';
        foreach ($report['lighthouse']['opportunities'] as $o) {
            $lines[] = '- ' . $o['title'] . ' (' . $o['category'] . ($o['detail'] ? ', ' . $o['detail'] : '') . ')';
        }
    }
    return implode("\n", $lines);
}

/**
 * Settings for the site_audit layout on the source page (set in the CMS,
 * so the notification address can't be spoofed by the request).
 */
function ds_audit_layout_settings($post_id) {
    $settings = ['notification_email' => get_option('admin_email'), 'cta_url' => ''];
    if ($post_id && function_exists('have_rows') && have_rows('page_sections', $post_id)) {
        while (have_rows('page_sections', $post_id)) {
            the_row();
            if (get_row_layout() !== 'site_audit') continue;
            if (is_email(get_sub_field('notification_email'))) $settings['notification_email'] = get_sub_field('notification_email');
            $settings['cta_url'] = (string) get_sub_field('cta_url');
        }
    }
    return $settings;
}

function ds_audit_rate_limited($bucket, $limit) {
    $ip   = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $key  = 'ds_audit_rl_' . $bucket . '_' . md5($ip);
    $hits = (int) get_transient($key);
    if ($hits >= $limit) return true;
    set_transient($key, $hits + 1, HOUR_IN_SECONDS);
    return false;
}

// ── AJAX: capture the lead ───────────────────────────────────
add_action('wp_ajax_ds_site_audit_submit', 'ds_site_audit_handle_submit');
add_action('wp_ajax_nopriv_ds_site_audit_submit', 'ds_site_audit_handle_submit');

function ds_site_audit_handle_submit() {
    if (!empty($_POST['ds_hp_website'])) {
        wp_send_json_error(['message' => 'Please try again.'], 400); // bots
    }

    $lead = [
        'contact_name'  => sanitize_text_field(wp_unslash($_POST['contact_name'] ?? '')),
        'contact_email' => sanitize_email(wp_unslash($_POST['contact_email'] ?? '')),
        'company'       => sanitize_text_field(wp_unslash($_POST['company'] ?? '')),
        'contact_phone' => sanitize_text_field(wp_unslash($_POST['contact_phone'] ?? '')),
        'website_url'   => ds_audit_normalize_url(wp_unslash($_POST['website_url'] ?? '')),
        'consent'       => !empty($_POST['consent']) ? 'Yes' : '',
    ];

    $missing = [];
    foreach (['contact_name', 'contact_email', 'website_url', 'consent'] as $field) {
        if ($lead[$field] === '') $missing[] = $field;
    }
    if ($lead['contact_email'] !== '' && !is_email($lead['contact_email'])) $missing[] = 'contact_email';
    if ($missing) {
        wp_send_json_error(['message' => 'Please check the highlighted fields.', 'fields' => array_values(array_unique($missing))], 400);
    }
    if (ds_audit_rate_limited('submit', 5)) {
        wp_send_json_error(['message' => "You've requested several audits already — please try again in an hour, or contact us directly."], 429);
    }

    $source  = absint($_POST['ds_audit_source'] ?? 0);
    $token   = wp_generate_password(32, false);
    $lead_id = wp_insert_post([
        'post_type'    => 'ds_audit_lead',
        'post_status'  => 'private',
        'post_title'   => sprintf('%s — %s', wp_parse_url($lead['website_url'], PHP_URL_HOST), $lead['contact_name']),
        'post_content' => "Name: {$lead['contact_name']}\nEmail: {$lead['contact_email']}\nCompany: {$lead['company']}\nPhone: {$lead['contact_phone']}\nWebsite: {$lead['website_url']}\n\n(Audit pending)",
        'meta_input'   => [
            '_ds_audit_lead'          => $lead,
            '_ds_audit_source'        => $source,
            '_ds_audit_token'         => $token,
            '_ds_audit_token_expires' => time() + 30 * MINUTE_IN_SECONDS,
        ],
    ]);
    if (!$lead_id || is_wp_error($lead_id)) {
        wp_send_json_error(['message' => 'Something went wrong. Please try again.'], 500);
    }

    wp_send_json_success(['lead' => $lead_id, 'token' => $token]);
}

// ── AJAX: run the audit for a just-captured lead ─────────────
add_action('wp_ajax_ds_site_audit_run', 'ds_site_audit_handle_run');
add_action('wp_ajax_nopriv_ds_site_audit_run', 'ds_site_audit_handle_run');

function ds_site_audit_handle_run() {
    $lead_id = absint($_POST['lead'] ?? 0);
    $token   = sanitize_text_field(wp_unslash($_POST['token'] ?? ''));
    $post    = $lead_id ? get_post($lead_id) : null;

    // Token minted at submit time: only the visitor who just submitted can run it.
    $stored  = (string) get_post_meta($lead_id, '_ds_audit_token', true);
    $expires = (int) get_post_meta($lead_id, '_ds_audit_token_expires', true);
    if (!$post || $post->post_type !== 'ds_audit_lead'
        || $token === '' || !hash_equals($stored, $token) || time() > $expires) {
        wp_send_json_error(['message' => 'This audit link has expired. Please submit the form again.'], 403);
    }

    $cached = get_post_meta($lead_id, '_ds_audit_report', true);
    if (is_array($cached) && $cached) wp_send_json_success(['report' => $cached]);

    $lead = get_post_meta($lead_id, '_ds_audit_lead', true);
    $url  = $lead['website_url'] ?? '';
    if (!$url) wp_send_json_error(['message' => 'Lead data unavailable.'], 400);

    // Finish (and send the emails) even if the browser or a proxy gives up waiting.
    ignore_user_abort(true);
    if (function_exists('set_time_limit')) @set_time_limit(180);

    // Same site audited recently (e.g. two people at one company) — reuse it.
    $cache_key = 'ds_audit_' . md5($url);
    $report    = get_transient($cache_key);
    if (!is_array($report)) {
        $report = ['url' => $url, 'generated' => time()];

        $lighthouse = ds_audit_run_pagespeed($url);
        if (is_wp_error($lighthouse)) {
            error_log('[ds-site-audit] PSI failed for ' . $url . ': ' . $lighthouse->get_error_message());
            $report['lighthouse']       = [];
            $report['lighthouse_error'] = 'Google could not load the page. Make sure the address is correct and publicly reachable.';
        } else {
            $report['lighthouse'] = $lighthouse;
        }
        $report['ai_readiness'] = ds_audit_ai_readiness($url);

        if (ds_audit_ai_summary_enabled()) {
            $summary = ds_audit_ai_summary($url, $report);
            if (is_wp_error($summary)) {
                error_log('[ds-site-audit] AI summary failed for ' . $url . ': ' . $summary->get_error_message());
            } else {
                $report['ai_summary'] = $summary;
            }
        }
        if (empty($report['lighthouse_error'])) set_transient($cache_key, $report, 12 * HOUR_IN_SECONDS);
    }

    $text = ds_audit_report_text($report);
    update_post_meta($lead_id, '_ds_audit_report', $report);
    delete_post_meta($lead_id, '_ds_audit_token');
    wp_update_post([
        'ID'           => $lead_id,
        'post_content' => str_replace('(Audit pending)', $text, $post->post_content),
    ]);

    // Notify the team.
    $settings = ds_audit_layout_settings((int) get_post_meta($lead_id, '_ds_audit_source', true));
    $host     = wp_parse_url($url, PHP_URL_HOST);
    wp_mail(
        $settings['notification_email'],
        sprintf('Site Audit Lead: %s (%s)', $lead['company'] ?: $lead['contact_name'], $host),
        "New free site audit request\n"
            . 'Submitted: ' . wp_date('F j, Y g:i a') . "\n"
            . 'Lead: ' . admin_url('post.php?post=' . $lead_id . '&action=edit') . "\n\n"
            . "Name: {$lead['contact_name']}\nEmail: {$lead['contact_email']}\nCompany: {$lead['company']}\nPhone: {$lead['contact_phone']}\n\n"
            . $text . "\n",
        ['Reply-To: ' . $lead['contact_name'] . ' <' . $lead['contact_email'] . '>']
    );

    // Send the prospect their copy.
    if (ds_audit_option('site_audit_email_prospect', true)) {
        $cta = $settings['cta_url'] ? "\nBook a free walkthrough of your results: " . $settings['cta_url'] . "\n" : "\nReply to this email and we'll walk you through the results — no cost, no pressure.\n";
        wp_mail(
            $lead['contact_email'],
            sprintf('Your free website & AI search audit for %s', $host),
            "Hi {$lead['contact_name']},\n\nThanks for requesting a free audit from Digital Stride. Here are your results:\n\n"
                . $text . "\n" . $cta
                . "\nScores come from Google Lighthouse (via PageSpeed Insights, mobile) plus Digital Stride's AI search readiness checks. They measure how well your site is built to be found and understood — not your current search rankings.\n\n— The Digital Stride team\n",
            ['Reply-To: Digital Stride <' . $settings['notification_email'] . '>']
        );
    }

    wp_send_json_success(['report' => $report]);
}
