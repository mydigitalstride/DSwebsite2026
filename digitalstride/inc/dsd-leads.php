<?php
/**
 * Lead form → DSD (agency dashboard) webhook.
 *
 * Flow:
 *  1. Every front-end page loads DSD's lead-attribution.js, which remembers
 *     the UTMs / ad click IDs from the page the visitor landed on.
 *  2. The lead form (template-parts/lead-form.php, JS in assets/js/main.js)
 *     posts to admin-ajax.php on OUR domain — never to DSD directly.
 *  3. ds_lead_handle_submit() validates, runs the spam checks, adds an
 *     external_id + page_url and forwards the lead to DSD server-to-server.
 *     If DSD can't be reached the lead is emailed to the site admin instead,
 *     so it isn't lost.
 *
 * Configuration (wp-config.php, or server environment variables):
 *   define('DSD_LEADS_API_KEY', '...');                    // secret — server only
 *   define('DSD_BASE_URL', 'https://your-dsd-domain.com');  // no trailing path
 *
 * The API key can read and delete the whole DSD lead list. It must never be
 * printed, sent to the browser, committed, or written to a log.
 */

if (!defined('ABSPATH')) {
    exit;
}

define('DS_LEAD_MIN_SECONDS', 3);   // faster than this from page render = bot
define('DS_LEAD_RATE_LIMIT', 5);    // submissions per IP per hour
define('DS_LEAD_TIMEOUT', 10);      // seconds per DSD request

function ds_lead_config($name) {
    if (defined($name) && constant($name)) return (string) constant($name);
    $env = getenv($name);
    return $env ? (string) $env : '';
}

function ds_lead_dsd_url($path) {
    $base = untrailingslashit(ds_lead_config('DSD_BASE_URL'));
    return $base ? $base . $path : '';
}

// ── Attribution script on every page ────────────────────────
add_action('wp_head', function () {
    $src = ds_lead_dsd_url('/wp-content/plugins/mds-partner-portal/assets/js/lead-attribution.js');
    if ($src) {
        echo '<script src="' . esc_url($src) . '" async></script>' . "\n";
    }
}, 5);

// ── Form config ─────────────────────────────────────────────

function ds_lead_default_services() {
    return [
        'SEO & Local SEO',
        'Google Ads / PPC',
        'Website Design & Development',
        'Social Media Marketing',
        'Branding',
        'Email Marketing',
        'Marketing Strategy',
        'Not sure yet',
    ];
}

/** Split an ACF "one per line" textarea into a clean list. */
function ds_lead_parse_services($raw) {
    $list = array_values(array_filter(array_map('trim', explode("\n", (string) $raw))));
    return $list ?: ds_lead_default_services();
}

/**
 * Services offered by the lead form(s) on a page, read from the CMS so the
 * server only accepts values the visitor could actually have picked.
 */
function ds_lead_page_services($post_id) {
    $rows = $post_id && function_exists('get_field') ? get_field('page_sections', $post_id) : null;
    $services = [];
    foreach ((array) $rows as $row) {
        $layout = $row['acf_fc_layout'] ?? '';
        if ($layout === 'lead_form' || ($layout === 'contact_form' && !empty($row['use_lead_form']))) {
            $services = array_merge($services, ds_lead_parse_services($row['services'] ?? ''));
        }
    }
    return $services ?: ds_lead_default_services();
}

/** Per-field error text, shared by the template (no-JS) and the JSON response. */
function ds_lead_error_messages() {
    return [
        'contact_name'  => 'Please enter your name.',
        'contact_email' => 'Please enter a valid email address, or your phone number.',
        'contact_phone' => 'Please enter a valid phone number.',
        'service'       => 'Please choose a service from the list.',
        'message'       => 'Please keep your message under 5,000 characters.',
    ];
}

/** Signed render timestamp for the minimum time-to-submit check. */
function ds_lead_time_token() {
    $ts = (string) time();
    return $ts . '.' . substr(hash_hmac('sha256', $ts, wp_salt('nonce')), 0, 24);
}

function ds_lead_time_ok($token) {
    $parts = explode('.', (string) $token);
    if (count($parts) !== 2 || !ctype_digit($parts[0])) return false;
    $expected = substr(hash_hmac('sha256', $parts[0], wp_salt('nonce')), 0, 24);
    if (!hash_equals($expected, $parts[1])) return false;
    return time() - (int) $parts[0] >= DS_LEAD_MIN_SECONDS;
}

function ds_lead_rate_limited() {
    $ip   = sanitize_text_field($_SERVER['REMOTE_ADDR'] ?? '');
    $key  = 'ds_lead_rl_' . md5($ip);
    $hits = (int) get_transient($key);
    if ($hits >= DS_LEAD_RATE_LIMIT) return true;
    set_transient($key, $hits + 1, HOUR_IN_SECONDS);
    return false;
}

function ds_lead_strlen($s) {
    return function_exists('mb_strlen') ? mb_strlen($s) : strlen($s);
}

/**
 * Validate the posted lead. Returns [$lead, $errors] where $errors maps
 * field name => message.
 */
function ds_lead_validate($post, $source_id) {
    $lead = [
        'contact_name'  => sanitize_text_field(wp_unslash($post['contact_name'] ?? '')),
        'contact_email' => trim(sanitize_text_field(wp_unslash($post['contact_email'] ?? ''))),
        'contact_phone' => sanitize_text_field(wp_unslash($post['contact_phone'] ?? '')),
        'service'       => sanitize_text_field(wp_unslash($post['service'] ?? '')),
        'message'       => sanitize_textarea_field(wp_unslash($post['message'] ?? '')),
    ];

    $bad = [];
    if ($lead['contact_name'] === '' || ds_lead_strlen($lead['contact_name']) > 100) $bad[] = 'contact_name';
    if ($lead['contact_email'] !== '' && (strlen($lead['contact_email']) > 254 || !is_email($lead['contact_email']))) $bad[] = 'contact_email';
    if ($lead['contact_phone'] !== '') {
        $digits = strlen(preg_replace('/\D/', '', $lead['contact_phone']));
        if (strlen($lead['contact_phone']) > 40 || $digits < 7 || $digits > 15 || !preg_match('/^[0-9+().\-\s#x]+$/i', $lead['contact_phone'])) {
            $bad[] = 'contact_phone';
        }
    }
    if ($lead['contact_email'] === '' && $lead['contact_phone'] === '') $bad[] = 'contact_email';
    if ($lead['service'] !== '' && !in_array($lead['service'], ds_lead_page_services($source_id), true)) $bad[] = 'service';
    if (ds_lead_strlen($lead['message']) > 5000) $bad[] = 'message';

    $messages = ds_lead_error_messages();
    $errors   = [];
    foreach (array_unique($bad) as $field) $errors[$field] = $messages[$field];
    return [$lead, $errors];
}

/** The page the form was on — must be on this site, else the source page's permalink. */
function ds_lead_page_url($posted, $source_id) {
    $fallback = $source_id ? (string) get_permalink($source_id) : home_url('/');
    $url      = esc_url_raw(wp_unslash((string) $posted), ['http', 'https']);
    if (!$url || strlen($url) > 2000) return $fallback;
    return wp_parse_url($url, PHP_URL_HOST) === wp_parse_url(home_url(), PHP_URL_HOST) ? $url : $fallback;
}

/** mds_attribution must be a JSON object string; anything else is dropped. */
function ds_lead_attribution($raw) {
    $raw = (string) wp_unslash($raw);
    if ($raw === '' || strlen($raw) > 8000) return '';
    $data = json_decode($raw, true);
    return is_array($data) ? wp_json_encode($data) : '';
}

// ── Forward to DSD ──────────────────────────────────────────

/**
 * POST the lead to DSD. Retries once (same external_id, so DSD updates
 * rather than duplicates) on a timeout / connection error or a 5xx.
 * Returns true on 200/201.
 */
function ds_lead_send_to_dsd(array $body) {
    $url = ds_lead_dsd_url('/wp-json/mds/v1/leads/webhook');
    $key = ds_lead_config('DSD_LEADS_API_KEY');
    if (!$url || !$key) {
        error_log('[DSD leads] Not sent: DSD_BASE_URL or DSD_LEADS_API_KEY is not configured.');
        return false;
    }

    $args = [
        'timeout' => DS_LEAD_TIMEOUT,
        'headers' => [
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
            'X-MDS-API-Key' => $key,
        ],
        'body' => wp_json_encode($body),
    ];

    for ($attempt = 1; $attempt <= 2; $attempt++) {
        $response = wp_remote_post($url, $args);
        $status   = is_wp_error($response) ? 0 : (int) wp_remote_retrieve_response_code($response);
        if ($status === 200 || $status === 201) return true;

        // Field names and status only — never values, the URL's query, or the key.
        error_log(sprintf(
            '[DSD leads] Attempt %d failed: %s. Fields sent: %s',
            $attempt,
            is_wp_error($response) ? 'request error (' . $response->get_error_code() . ')' : 'HTTP ' . $status,
            implode(', ', array_keys($body))
        ));
        if ($status && $status < 500) return false; // 4xx won't fix itself on retry
    }
    return false;
}

/** Last resort when DSD is down or misconfigured: email the lead so it isn't lost. */
function ds_lead_fallback_email(array $body) {
    $to = apply_filters('ds_lead_fallback_email', get_option('admin_email'));
    if (!is_email($to)) return false;
    $lines = [];
    foreach ($body as $field => $value) $lines[] = $field . ': ' . $value;
    return wp_mail(
        $to,
        'Website lead (not delivered to DSD): ' . ($body['name'] ?? $body['email'] ?? 'new lead'),
        "This lead could not be sent to DSD, so it was emailed instead. Please add it to DSD manually.\n\n" . implode("\n", $lines)
    );
}

// ── Submit handler (admin-ajax.php) ─────────────────────────
add_action('wp_ajax_ds_lead_submit', 'ds_lead_handle_submit');
add_action('wp_ajax_nopriv_ds_lead_submit', 'ds_lead_handle_submit');

/**
 * Respond as JSON for the JS submit, or redirect back to the form for a
 * plain (no-JS) form post.
 */
function ds_lead_respond($ok, $status, $message, $source_id, $fields = []) {
    if (!empty($_POST['ds_ajax'])) {
        $payload = ['message' => $message];
        if ($fields) $payload['errors'] = $fields;
        $ok ? wp_send_json_success($payload) : wp_send_json_error($payload, $status);
    }
    $back = $source_id ? get_permalink($source_id) : home_url('/');
    $args = ['ds_lead' => $ok ? 'thanks' : ($fields ? 'invalid' : 'error')];
    if ($fields) $args['ds_lead_fields'] = implode(',', array_keys($fields));
    wp_safe_redirect(add_query_arg($args, $back) . '#ds-lead');
    exit;
}

function ds_lead_handle_submit() {
    $source_id = absint($_POST['ds_lead_source'] ?? 0);
    if ($source_id && get_post_status($source_id) !== 'publish') $source_id = 0;
    $thanks = "Thanks! We've got your message and will be in touch shortly.";

    // Honeypot: pretend it worked so bots learn nothing.
    if (!empty($_POST['ds_hp_website'])) {
        ds_lead_respond(true, 200, $thanks, $source_id);
    }
    if (!ds_lead_time_ok($_POST['ds_ts'] ?? '')) {
        ds_lead_respond(false, 400, 'That was quick! Please check your details and submit the form again.', $source_id);
    }

    [$lead, $errors] = ds_lead_validate($_POST, $source_id);
    if ($errors) {
        ds_lead_respond(false, 400, 'Please check the highlighted fields.', $source_id, $errors);
    }
    if (ds_lead_rate_limited()) {
        ds_lead_respond(false, 429, "You've sent us several messages already. Please try again in an hour, or give us a call.", $source_id);
    }

    $body = array_filter([
        'name'            => $lead['contact_name'],
        'email'           => $lead['contact_email'],
        'phone'           => $lead['contact_phone'],
        'service'         => $lead['service'],
        'message'         => $lead['message'],
        'page_url'        => ds_lead_page_url($_POST['page_url'] ?? '', $source_id),
        'mds_attribution' => ds_lead_attribution($_POST['mds_attribution'] ?? ''),
        'external_id'     => wp_generate_uuid4(),
    ], 'strlen');

    if (ds_lead_send_to_dsd($body) || ds_lead_fallback_email($body)) {
        ds_lead_respond(true, 200, $thanks, $source_id);
    }
    ds_lead_respond(false, 502, "Sorry, something went wrong on our end and your message didn't go through. Please call or email us and we'll get right back to you.", $source_id);
}
