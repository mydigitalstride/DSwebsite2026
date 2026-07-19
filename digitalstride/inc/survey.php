<?php
/**
 * Marketing Needs Survey — question config, entry storage, submit handler.
 *
 * The question set lives in ds_survey_config() so the front-end renderer
 * (template-parts/flex-marketing_survey.php) and the AJAX submit handler
 * share a single source of truth for names, labels, options, and routing.
 */

require_once __DIR__ . '/survey-analysis.php';
require_once __DIR__ . '/survey-ai-quote.php';

/**
 * Survey definition.
 *
 * Question keys:
 * - name      unique field name (also the POST key)
 * - label     question shown to the visitor
 * - type      radio | checkbox | select | text | textarea | email | tel | url | consent
 * - options   array of choices (radio/checkbox/select)
 * - required  bool — enforced client- and server-side (only when visible)
 * - show_if   ['field' => name, 'values' => [...]] — question only shown/required
 *             when a prior answer matches one of the values
 * - exclusive checkbox option label that clears the others when picked
 * - placeholder / help  optional UI strings
 */
function ds_survey_config() {
    return [
        [
            'title'     => 'Your Business',
            'questions' => [
                [
                    'name'     => 'industry',
                    'label'    => 'Which best describes your business?',
                    'type'     => 'radio',
                    'required' => true,
                    'options'  => [
                        'Architecture',
                        'Engineering',
                        'General Contractor / Construction Management',
                        'Home Builder / Remodeler',
                        'HVAC, Plumbing, or Electrical',
                        'Roofing, Siding, or Exteriors',
                        'Landscaping / Outdoor Living',
                        'Other AEC or Home Service',
                    ],
                ],
                [
                    'name'        => 'industry_other',
                    'label'       => 'Tell us what you do',
                    'type'        => 'text',
                    'required'    => true,
                    'placeholder' => 'e.g. Pool installation, restoration, MEP design…',
                    'show_if'     => ['field' => 'industry', 'values' => ['Other AEC or Home Service']],
                ],
                [
                    'name'     => 'years_in_business',
                    'label'    => 'How long have you been in business?',
                    'type'     => 'radio',
                    'required' => true,
                    'options'  => ['Less than 2 years', '2–5 years', '6–10 years', '11–20 years', 'More than 20 years'],
                ],
                [
                    'name'     => 'team_size',
                    'label'    => 'How big is your team?',
                    'type'     => 'radio',
                    'required' => true,
                    'options'  => ['Just me', '2–10 people', '11–25 people', '26–50 people', 'More than 50 people'],
                ],
                [
                    'name'     => 'service_area',
                    'label'    => 'What area do you serve?',
                    'type'     => 'radio',
                    'required' => true,
                    'options'  => ['One city or county', 'Regional — several counties', 'Statewide', 'Multi-state or national'],
                ],
                [
                    'name'     => 'annual_revenue',
                    'label'    => 'Roughly, what is your annual revenue?',
                    'type'     => 'radio',
                    'required' => false,
                    'help'     => 'It helps us recommend the right level of investment.',
                    'options'  => ['Under $500K', '$500K–$1M', '$1M–$5M', '$5M–$10M', 'Over $10M', 'Prefer not to say'],
                ],
            ],
        ],
        [
            'title'     => 'Current Marketing',
            'questions' => [
                [
                    'name'      => 'platforms',
                    'label'     => 'Where are you currently marketing?',
                    'type'      => 'checkbox',
                    'required'  => true,
                    'help'      => 'Select all that apply.',
                    'exclusive' => "We're not actively marketing right now",
                    'options'   => [
                        'Google Ads (PPC / Local Services Ads)',
                        'Google Business Profile / local SEO',
                        'Facebook / Instagram',
                        'LinkedIn',
                        'YouTube',
                        'TikTok',
                        'Nextdoor',
                        'Angi, HomeAdvisor, or Thumbtack',
                        'Houzz',
                        'Email marketing',
                        'Direct mail or print',
                        'Radio, TV, or billboards',
                        'Truck wraps / jobsite signage',
                        "We're not actively marketing right now",
                    ],
                ],
                [
                    'name'     => 'website_status',
                    'label'    => 'Do you have a website?',
                    'type'     => 'radio',
                    'required' => true,
                    'options'  => [
                        'Yes — it brings in leads consistently',
                        'Yes — but it underperforms',
                        "Yes — but it's outdated",
                        "We don't have a website",
                    ],
                ],
                [
                    'name'     => 'marketing_manager',
                    'label'    => 'Who handles your marketing today?',
                    'type'     => 'radio',
                    'required' => true,
                    'options'  => [
                        'Me — the owner, on the side',
                        'A dedicated in-house person or team',
                        'An outside agency or freelancer',
                        'No one, honestly',
                    ],
                ],
                [
                    'name'        => 'agency_reason',
                    'label'       => "What's prompting you to explore other options?",
                    'type'        => 'textarea',
                    'required'    => false,
                    'placeholder' => 'e.g. Slow reporting, leads dried up, poor communication…',
                    'show_if'     => ['field' => 'marketing_manager', 'values' => ['An outside agency or freelancer']],
                ],
                [
                    'name'     => 'lead_sources',
                    'label'    => 'Where do most of your jobs come from today?',
                    'type'     => 'checkbox',
                    'required' => true,
                    'help'     => 'Select all that apply.',
                    'options'  => [
                        'Referrals / word of mouth',
                        'Repeat customers',
                        'Website / organic search',
                        'Paid ads',
                        'Social media',
                        'Lead-gen platforms (Angi, Thumbtack, etc.)',
                        'Networking, associations, or trade groups',
                        'Bid lists / RFPs / GC relationships',
                    ],
                ],
            ],
        ],
        [
            'title'     => 'Budget & Performance',
            'questions' => [
                [
                    'name'     => 'monthly_budget',
                    'label'    => 'How much do you have budgeted for marketing right now?',
                    'type'     => 'radio',
                    'required' => true,
                    'options'  => [
                        "We don't have a set budget",
                        'Under $1,000 / month',
                        '$1,000–$2,500 / month',
                        '$2,500–$5,000 / month',
                        '$5,000–$10,000 / month',
                        'Over $10,000 / month',
                    ],
                ],
                [
                    'name'     => 'roi_tracking',
                    'label'    => 'Do you track your cost per lead or marketing ROI?',
                    'type'     => 'radio',
                    'required' => true,
                    'options'  => [
                        'Yes — we know our numbers',
                        'Somewhat — we track a few things',
                        "No — but we'd like to",
                        "No — we've never tracked it",
                    ],
                ],
                [
                    'name'     => 'monthly_leads',
                    'label'    => 'About how many leads do you get per month?',
                    'type'     => 'radio',
                    'required' => true,
                    'options'  => ['Fewer than 5', '5–15', '16–30', '31–50', 'More than 50', 'Honestly not sure'],
                ],
                [
                    'name'     => 'lead_quality',
                    'label'    => 'How would you rate the quality of those leads?',
                    'type'     => 'radio',
                    'required' => true,
                    'options'  => [
                        'Mostly good fits',
                        'A mix of good and bad',
                        'Mostly poor fits or price shoppers',
                        "We don't get enough leads to judge",
                    ],
                ],
            ],
        ],
        [
            'title'     => 'Goals & Growth',
            'questions' => [
                [
                    'name'     => 'goals',
                    'label'    => 'What are you hoping marketing does for you?',
                    'type'     => 'checkbox',
                    'required' => true,
                    'help'     => 'Pick your top priorities.',
                    'options'  => [
                        'More leads overall',
                        'Better-quality leads',
                        'Bigger jobs or more commercial work',
                        'Stronger brand awareness in our market',
                        'Recruiting and hiring',
                        'Expanding into new service areas',
                        'Launching a new service line',
                        'Standing out from competitors',
                    ],
                ],
                [
                    'name'     => 'growth_target',
                    'label'    => 'Where do you want revenue to be 12 months from now?',
                    'type'     => 'radio',
                    'required' => true,
                    'options'  => ['Stay steady — maintain current revenue', 'Grow 10–25%', 'Grow 25–50%', 'Double or more', 'Not sure yet'],
                ],
                [
                    'name'        => 'biggest_challenge',
                    'label'       => "What's the single biggest thing holding your growth back right now?",
                    'type'        => 'textarea',
                    'required'    => true,
                    'placeholder' => 'Tell us in your own words…',
                ],
                [
                    'name'     => 'timeline',
                    'label'    => 'When are you looking to get started?',
                    'type'     => 'radio',
                    'required' => true,
                    'options'  => ['Ready to start now', 'In the next 1–3 months', 'In 3–6 months', 'Just researching for now'],
                ],
            ],
        ],
        [
            'title'     => 'Almost Done',
            'questions' => [
                ['name' => 'contact_name',  'label' => 'Your name',    'type' => 'text',  'required' => true,  'placeholder' => 'First and last name'],
                ['name' => 'company',       'label' => 'Company name', 'type' => 'text',  'required' => true],
                ['name' => 'contact_email', 'label' => 'Email',        'type' => 'email', 'required' => true],
                ['name' => 'contact_phone', 'label' => 'Phone',        'type' => 'tel',   'required' => true],
                [
                    'name'        => 'website_url',
                    'label'       => 'Website URL',
                    'type'        => 'url',
                    'required'    => false,
                    'placeholder' => 'https://',
                    'show_if'     => [
                        'field'  => 'website_status',
                        'values' => [
                            'Yes — it brings in leads consistently',
                            'Yes — but it underperforms',
                            "Yes — but it's outdated",
                        ],
                    ],
                ],
                [
                    'name'     => 'preferred_contact',
                    'label'    => 'How should we reach you?',
                    'type'     => 'radio',
                    'required' => false,
                    'options'  => ['Email', 'Phone call', 'Text message'],
                ],
                [
                    'name'        => 'notes',
                    'label'       => 'Anything else we should know?',
                    'type'        => 'textarea',
                    'required'    => false,
                    'placeholder' => 'Optional',
                ],
                [
                    'name'     => 'consent',
                    'label'    => 'I agree to be contacted by Digital Stride about my inquiry.',
                    'type'     => 'consent',
                    'required' => true,
                ],
            ],
        ],
    ];
}

// ── Survey Entries CPT (admin-only record of submissions) ──
add_action('init', function () {
    register_post_type('ds_survey_entry', [
        'labels' => [
            'name'          => 'Survey Entries',
            'singular_name' => 'Survey Entry',
            'menu_name'     => 'Survey Entries',
        ],
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-feedback',
        'supports'            => ['title', 'editor'],
        'capability_type'     => 'post',
        'capabilities'        => ['create_posts' => 'do_not_allow'],
        'map_meta_cap'        => true,
        'exclude_from_search' => true,
        'show_in_rest'        => false,
    ]);
});

/**
 * Is a conditional question visible given the submitted answers?
 */
function ds_survey_condition_met($question, $answers) {
    if (empty($question['show_if'])) return true;
    $dep = $answers[$question['show_if']['field']] ?? null;
    if ($dep === null) return false;
    $dep = (array) $dep;
    return (bool) array_intersect($dep, $question['show_if']['values']);
}

// ── AJAX submit handler ──────────────────────────────────
add_action('wp_ajax_ds_survey_submit', 'ds_survey_handle_submit');
add_action('wp_ajax_nopriv_ds_survey_submit', 'ds_survey_handle_submit');

function ds_survey_handle_submit() {
    // Honeypot: real visitors never fill this field.
    if (!empty($_POST['ds_hp_website'])) {
        wp_send_json_success(['message' => 'Thanks!']); // pretend success to bots
    }

    $config = ds_survey_config();

    // First pass: collect sanitized answers keyed by field name.
    $answers = [];
    foreach ($config as $step) {
        foreach ($step['questions'] as $q) {
            $name = $q['name'];
            if (!isset($_POST[$name])) continue;
            $raw = wp_unslash($_POST[$name]);

            switch ($q['type']) {
                case 'checkbox':
                    $raw = array_map('sanitize_text_field', (array) $raw);
                    $val = array_values(array_intersect($raw, $q['options']));
                    if ($val) $answers[$name] = $val;
                    break;
                case 'radio':
                case 'select':
                    $raw = sanitize_text_field($raw);
                    if (in_array($raw, $q['options'], true)) $answers[$name] = $raw;
                    break;
                case 'consent':
                    if ($raw) $answers[$name] = 'Yes';
                    break;
                case 'email':
                    $val = sanitize_email($raw);
                    if ($val) $answers[$name] = $val;
                    break;
                case 'url':
                    $val = esc_url_raw($raw);
                    if ($val) $answers[$name] = $val;
                    break;
                case 'textarea':
                    $val = sanitize_textarea_field($raw);
                    if ($val !== '') $answers[$name] = $val;
                    break;
                default:
                    $val = sanitize_text_field($raw);
                    if ($val !== '') $answers[$name] = $val;
            }
        }
    }

    // Second pass: enforce required fields (only when their conditions are met).
    $missing = [];
    foreach ($config as $step) {
        foreach ($step['questions'] as $q) {
            if (empty($q['required'])) continue;
            if (!ds_survey_condition_met($q, $answers)) continue;
            if (!isset($answers[$q['name']])) $missing[] = $q['name'];
        }
    }
    if ($missing) {
        wp_send_json_error(['message' => 'Please answer all required questions.', 'fields' => $missing], 400);
    }
    if (!is_email($answers['contact_email'])) {
        wp_send_json_error(['message' => 'Please enter a valid email address.', 'fields' => ['contact_email']], 400);
    }

    // Build a readable summary grouped by step.
    $lines = [];
    foreach ($config as $step) {
        $section = [];
        foreach ($step['questions'] as $q) {
            if (!isset($answers[$q['name']])) continue;
            $val = $answers[$q['name']];
            $section[] = $q['label'] . "\n    " . (is_array($val) ? implode("\n    ", $val) : $val);
        }
        if ($section) {
            $lines[] = '== ' . $step['title'] . " ==\n" . implode("\n", $section);
        }
    }
    $summary = implode("\n\n", $lines);

    // Automated gap analysis — shown to the prospect and sent to the team.
    $analysis = ds_survey_analyze($answers);
    $summary .= "\n\n" . ds_survey_analysis_text($analysis);

    // Store the entry in the admin.
    $entry_id = wp_insert_post([
        'post_type'    => 'ds_survey_entry',
        'post_status'  => 'private',
        'post_title'   => sprintf('%s — %s', $answers['company'], $answers['contact_name']),
        'post_content' => $summary,
        'meta_input'   => [
            '_ds_survey_answers' => $answers,
            '_ds_survey_score'   => $analysis['score'],
        ],
    ]);

    // Resolve the notification email from the survey section on the source page
    // (set in the CMS, so it can't be spoofed by the request).
    $notify  = get_option('admin_email');
    $post_id = absint($_POST['ds_survey_source'] ?? 0);
    if ($post_id && have_rows('page_sections', $post_id)) {
        while (have_rows('page_sections', $post_id)) {
            the_row();
            if (get_row_layout() === 'marketing_survey') {
                $configured = get_sub_field('notification_email');
                if (is_email($configured)) $notify = $configured;
            }
        }
    }

    $subject = sprintf('Marketing Survey: %s (%s)', $answers['company'], $answers['industry'] ?? 'AEC / Home Service');
    $body    = "New marketing needs survey submission\n"
             . 'Submitted: ' . wp_date('F j, Y g:i a') . "\n"
             . ($entry_id && !is_wp_error($entry_id) ? 'Entry: ' . admin_url('post.php?post=' . $entry_id . '&action=edit') . "\n" : '')
             . "\n" . $summary . "\n";
    $headers = ['Reply-To: ' . $answers['contact_name'] . ' <' . $answers['contact_email'] . '>'];
    wp_mail($notify, $subject, $body, $headers);

    // If AI quotes are enabled, mint a short-lived token so this visitor's
    // browser can request the generated quote for this entry.
    $quote = null;
    if ($entry_id && !is_wp_error($entry_id) && ds_survey_ai_enabled()) {
        $token = wp_generate_password(32, false);
        update_post_meta($entry_id, '_ds_quote_token', $token);
        update_post_meta($entry_id, '_ds_quote_token_expires', time() + 30 * MINUTE_IN_SECONDS);
        $quote = ['entry' => $entry_id, 'token' => $token];
    }

    // Prospects see the top gaps only; the email/admin entry keep the full list.
    wp_send_json_success([
        'message'  => 'Thanks!',
        'quote'    => $quote,
        'analysis' => [
            'score' => $analysis['score'],
            'label' => $analysis['label'],
            'gaps'  => array_map(function ($gap) {
                return ['title' => $gap['title'], 'detail' => $gap['detail']];
            }, array_slice($analysis['gaps'], 0, 5)),
        ],
    ]);
}
