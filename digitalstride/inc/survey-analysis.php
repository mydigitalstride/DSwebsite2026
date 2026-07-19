<?php
/**
 * Marketing Needs Survey — automated gap analysis.
 *
 * ds_survey_analyze() turns a sanitized answer set (see ds_survey_config())
 * into a readiness score plus a prioritized list of gaps. Rules are
 * deliberately deterministic so the instant feedback shown to prospects
 * matches what the team sees in the notification email.
 */

/**
 * @param array $answers field name => string|array answers.
 * @return array {
 *   score: int 25–100,
 *   label: string score band,
 *   gaps:  [ ['severity' => high|medium|low, 'title' => ..., 'detail' => ...], ... ]
 * }
 */
function ds_survey_analyze($answers) {
    $platforms = (array) ($answers['platforms'] ?? []);
    $sources   = (array) ($answers['lead_sources'] ?? []);
    $goals     = (array) ($answers['goals'] ?? []);
    $website   = $answers['website_status'] ?? '';
    $gaps      = [];

    $not_marketing = in_array("We're not actively marketing right now", $platforms, true);
    $is_local      = in_array($answers['service_area'] ?? '', ['One city or county', 'Regional — several counties'], true);
    $weak_website  = in_array($website, ['Yes — but it underperforms', "Yes — but it's outdated"], true);
    $paid_channels = array_intersect($platforms, [
        'Google Ads (PPC / Local Services Ads)',
        'Facebook / Instagram',
        'Angi, HomeAdvisor, or Thumbtack',
    ]);
    $digital_sources = array_intersect($sources, [
        'Website / organic search',
        'Paid ads',
        'Social media',
        'Lead-gen platforms (Angi, Thumbtack, etc.)',
    ]);
    $ambitious = in_array($answers['growth_target'] ?? '', ['Grow 25–50%', 'Double or more'], true);

    // ── Foundation ──────────────────────────────────────
    if ($not_marketing) {
        $gaps[] = [
            'severity' => 'high',
            'title'    => 'No active marketing engine',
            'detail'   => "Right now growth depends entirely on who happens to hear about you. That caps how fast you can grow and makes revenue unpredictable — building a repeatable lead engine is step one.",
        ];
    }

    if ($website === "We don't have a website") {
        $gaps[] = [
            'severity' => 'high',
            'title'    => 'No digital home base',
            'detail'   => 'Buyers vet contractors online before they ever call — even referred ones. Without a website, referrals leak to competitors who look more established, and every other channel has nowhere to send people.',
        ];
    } elseif ($weak_website) {
        $gaps[] = [
            'severity' => $paid_channels ? 'high' : 'medium',
            'title'    => $paid_channels ? 'Ad spend leaking through your website' : 'Website conversion gap',
            'detail'   => $paid_channels
                ? "You're paying to send traffic to a site you told us underperforms — some of that budget is walking out the door. Fixing the site usually pays for itself before adding any new spend."
                : "Your website is your hardest-working salesperson. If it's underperforming or outdated, every channel that points to it converts below its potential.",
        ];
    }

    // ── Channel mix ─────────────────────────────────────
    if (!$not_marketing && !in_array('Google Business Profile / local SEO', $platforms, true)) {
        $gaps[] = [
            'severity' => $is_local ? 'high' : 'medium',
            'title'    => 'Local search visibility',
            'detail'   => $is_local
                ? 'For a business serving a defined area, Google Business Profile and local SEO are usually the highest-ROI foundation — that\'s where "near me" and emergency searches happen, and you\'re not competing there yet.'
                : 'Even with a wider footprint, showing up in local map results in each market you serve is one of the cheapest sources of high-intent leads.',
        ];
    }

    if ($sources && !$digital_sources) {
        $gaps[] = [
            'severity' => 'high',
            'title'    => 'Referral dependency',
            'detail'   => 'Referrals are great — but they\'re not a growth lever you control. When they slow down, so does revenue. A digital pipeline alongside word of mouth turns growth from luck into a dial you can turn.',
        ];
    }

    if (in_array('Lead-gen platforms (Angi, Thumbtack, etc.)', $sources, true)
        && in_array($answers['lead_quality'] ?? '', ['Mostly poor fits or price shoppers', 'A mix of good and bad'], true)) {
        $gaps[] = [
            'severity' => 'medium',
            'title'    => 'Renting leads instead of owning your pipeline',
            'detail'   => 'Lead-gen platforms sell the same lead to your competitors and attract price shoppers. Channels you own — your site, local SEO, your list — produce exclusive leads that already chose you.',
        ];
    }

    // ── Measurement ─────────────────────────────────────
    $tracking = $answers['roi_tracking'] ?? '';
    if (in_array($tracking, ["No — but we'd like to", "No — we've never tracked it"], true)) {
        $gaps[] = [
            'severity' => 'medium',
            'title'    => 'No performance tracking',
            'detail'   => "You can't scale what you can't measure. Without cost-per-lead numbers, budget decisions are guesses — and it's impossible to know which channels deserve more money and which are wasting it.",
        ];
    } elseif ($tracking === 'Somewhat — we track a few things') {
        $gaps[] = [
            'severity' => 'low',
            'title'    => 'Partial performance picture',
            'detail'   => 'Some tracking beats none, but partial numbers can mislead — a channel that looks expensive per lead is often the cheapest per closed job. Full-funnel tracking shows which is which.',
        ];
    }

    if (($answers['monthly_leads'] ?? '') === 'Honestly not sure') {
        $gaps[] = [
            'severity' => 'medium',
            'title'    => 'Lead volume unknown',
            'detail'   => 'Not knowing your monthly lead count usually means leads arrive scattered across phone, email, and platforms with no single system capturing them — which also means some are slipping through untouched.',
        ];
    } elseif (($answers['monthly_leads'] ?? '') === 'Fewer than 5') {
        $gaps[] = [
            'severity' => 'medium',
            'title'    => 'Thin lead pipeline',
            'detail'   => 'Under 5 leads a month leaves no room to be selective — you take what comes. Higher volume is what lets you pick better jobs, raise prices, and smooth out slow seasons.',
        ];
    }

    // ── Budget vs. ambition ─────────────────────────────
    $revenue_mid = [
        'Under $500K' => 300000, '$500K–$1M' => 750000, '$1M–$5M' => 2500000,
        '$5M–$10M' => 7000000, 'Over $10M' => 12000000,
    ][$answers['annual_revenue'] ?? ''] ?? 0;
    $budget_mid = [
        "We don't have a set budget" => 0, 'Under $1,000 / month' => 500,
        '$1,000–$2,500 / month' => 1750, '$2,500–$5,000 / month' => 3750,
        '$5,000–$10,000 / month' => 7500, 'Over $10,000 / month' => 12000,
    ][$answers['monthly_budget'] ?? ''] ?? null;

    if ($revenue_mid && $budget_mid !== null && ($budget_mid * 12) / $revenue_mid < 0.02) {
        $gaps[] = [
            'severity' => 'high',
            'title'    => 'Under-investing for your size',
            'detail'   => 'Your marketing spend is under 2% of revenue. Growing service businesses typically invest 5–10% — at your current level, even well-run marketing will struggle to move the needle.',
        ];
    } elseif ($ambitious && in_array($answers['monthly_budget'] ?? '', ["We don't have a set budget", 'Under $1,000 / month'], true)) {
        $gaps[] = [
            'severity' => 'medium',
            'title'    => 'Budget vs. goals mismatch',
            'detail'   => 'Your growth target is ambitious, but the current budget won\'t buy the visibility it takes to hit it. Closing that gap — or sequencing goals to match the budget — is the first strategic call to make.',
        ];
    }

    // ── Goals vs. channels ──────────────────────────────
    if (in_array('Recruiting and hiring', $goals, true) && !in_array('LinkedIn', $platforms, true)) {
        $gaps[] = [
            'severity' => 'low',
            'title'    => 'No employer brand presence',
            'detail'   => 'You want to hire, but the channels where skilled tradespeople and professionals check out an employer — LinkedIn and an active social presence — aren\'t in your mix yet.',
        ];
    }

    if (in_array('Bigger jobs or more commercial work', $goals, true) && !in_array('LinkedIn', $platforms, true)) {
        $gaps[] = [
            'severity' => 'medium',
            'title'    => 'Invisible to commercial buyers',
            'detail'   => 'Commercial work is won on relationships and reputation. GCs, facility managers, and developers vet partners on LinkedIn and through project showcases — a presence there puts you on their shortlist.',
        ];
    }

    if (!$not_marketing
        && !in_array('Email marketing', $platforms, true)
        && !in_array($answers['years_in_business'] ?? '', ['Less than 2 years', '2–5 years'], true)) {
        $gaps[] = [
            'severity' => 'low',
            'title'    => 'Untapped customer list',
            'detail'   => 'Years in business means a list of past customers — the cheapest revenue you\'ll ever generate. Email keeps you first in mind for repeat work, maintenance, and the referrals you already rely on.',
        ];
    }

    // ── Ownership ───────────────────────────────────────
    $manager = $answers['marketing_manager'] ?? '';
    if ($manager === 'No one, honestly') {
        $gaps[] = [
            'severity' => 'medium',
            'title'    => 'Nobody owns marketing',
            'detail'   => 'Marketing that nobody owns happens in bursts — a push when things are slow, silence when you\'re busy. That feast-or-famine cycle is exactly what consistent ownership fixes.',
        ];
    } elseif ($manager === 'Me — the owner, on the side') {
        $gaps[] = [
            'severity' => 'low',
            'title'    => 'Owner-run marketing',
            'detail'   => 'Your hours are worth more running the business than running ads. Owner-led marketing also tends to pause when work picks up — right when the next quarter\'s pipeline should be filling.',
        ];
    }

    // ── Score + ordering ────────────────────────────────
    $weights = ['high' => 15, 'medium' => 8, 'low' => 4];
    $order   = ['high' => 0, 'medium' => 1, 'low' => 2];
    usort($gaps, function ($a, $b) use ($order) {
        return $order[$a['severity']] <=> $order[$b['severity']];
    });

    $score = 100;
    foreach ($gaps as $gap) {
        $score -= $weights[$gap['severity']];
    }
    $score = max(25, $score);

    if ($score >= 80)      $label = 'Strong foundation';
    elseif ($score >= 60)  $label = 'Solid start — with real gaps';
    elseif ($score >= 40)  $label = 'Significant room to grow';
    else                   $label = 'Major growth opportunities';

    return ['score' => $score, 'label' => $label, 'gaps' => $gaps];
}

/**
 * Plain-text rendering of an analysis, for the notification email
 * and the stored Survey Entry.
 */
function ds_survey_analysis_text($analysis) {
    $lines = ['== Gap Analysis ==', sprintf('Readiness score: %d/100 — %s', $analysis['score'], $analysis['label'])];
    foreach ($analysis['gaps'] as $gap) {
        $lines[] = sprintf('[%s] %s', strtoupper($gap['severity']), $gap['title']) . "\n    " . $gap['detail'];
    }
    return implode("\n", $lines);
}
