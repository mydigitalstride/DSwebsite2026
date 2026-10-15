<?php
/**
 * DSD: Interactive Trade & Lead Simulator (group_dsd_simulator).
 *
 * A mock DSD "Leads Feed" window. Visitors filter the sample leads
 * (ds_dsd_sim_leads()) by industry, play a simulated call recording and
 * re-tag each lead's status; dsd.js keeps the "Total Revenue Pipeline
 * Identified" counter in step.
 *
 * The counter opens at `sim_default_pipeline_val`. That figure covers the
 * leads already marked Booked / Sold plus older pipeline not in the feed,
 * so booking a lead adds its job value and un-booking one takes it away.
 */
$d        = ds_dsd_defaults('simulator');
$headline = get_field('sim_headline') ?: $d['headline'];
$sub      = get_field('sim_subheadline') ?: $d['subheadline'];
$pipeline = get_field('sim_default_pipeline_val');
$pipeline = is_numeric($pipeline) ? max(0, (float) $pipeline) : $d['pipeline_val'];

$leads      = ds_dsd_sim_leads();
$statuses   = ds_dsd_statuses();
$industries = ds_dsd_industries();
if (!$leads) return;

$counts = array_count_values(array_column($leads, 'category'));

$format_time = function ($seconds) {
    return sprintf('%d:%02d', floor($seconds / 60), $seconds % 60);
};
?>
<section class="ds-section ds-dsd-sim" id="dsd-simulator" aria-labelledby="dsd-sim-title">
    <div class="ds-container">
        <div class="ds-dsd-section-head">
            <p class="ds-dsd-eyebrow"><span class="ds-dsd-eyebrow__dot" aria-hidden="true"></span><?php esc_html_e('Interactive Demo', 'digitalstride'); ?></p>
            <h2 class="ds-section__heading ds-section__heading--center" id="dsd-sim-title"><?php echo esc_html($headline); ?></h2>
            <?php if ($sub) : ?><p class="ds-dsd-section-head__sub"><?php echo esc_html($sub); ?></p><?php endif; ?>
        </div>

        <div class="ds-dsd-app" data-dsd-sim data-pipeline="<?php echo esc_attr($pipeline); ?>">
            <div class="ds-dsd-app__chrome" aria-hidden="true">
                <span class="ds-dsd-frame__dots"><i></i><i></i><i></i></span>
                <span class="ds-dsd-app__url"><i class="fa-solid fa-lock"></i> dashboard.digitalstride.com/leads</span>
            </div>

            <div class="ds-dsd-app__layout">
                <nav class="ds-dsd-app__nav" aria-hidden="true">
                    <span class="ds-dsd-app__logo">DSD</span>
                    <span class="is-active"><i class="fa-solid fa-inbox"></i><em>Leads Feed</em></span>
                    <span><i class="fa-solid fa-phone"></i><em>Calls</em></span>
                    <span><i class="fa-solid fa-bullhorn"></i><em>Campaigns</em></span>
                    <span><i class="fa-solid fa-circle-check"></i><em>Approvals</em></span>
                    <span><i class="fa-solid fa-chart-line"></i><em>Reports</em></span>
                </nav>

                <div class="ds-dsd-app__main">
                    <div class="ds-dsd-app__header">
                        <div>
                            <h3 class="ds-dsd-app__title"><?php esc_html_e('Leads Feed', 'digitalstride'); ?></h3>
                            <p class="ds-dsd-app__meta"><span class="ds-dsd-frame__live"><?php esc_html_e('Live', 'digitalstride'); ?></span> <?php esc_html_e('Sample data · updated just now', 'digitalstride'); ?></p>
                        </div>
                        <div class="ds-dsd-pipeline">
                            <span class="ds-dsd-pipeline__label"><?php esc_html_e('Total Revenue Pipeline Identified', 'digitalstride'); ?></span>
                            <strong class="ds-dsd-pipeline__value" id="dsd-pipeline-total" aria-live="polite" aria-atomic="true">$<?php echo esc_html(number_format($pipeline)); ?></strong>
                            <span class="ds-dsd-pipeline__delta" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="ds-dsd-filters" role="group" aria-label="<?php esc_attr_e('Filter leads by industry', 'digitalstride'); ?>">
                        <button type="button" class="ds-dsd-filter is-active" data-filter="all" aria-pressed="true"><?php esc_html_e('All Industries', 'digitalstride'); ?> <span><?php echo count($leads); ?></span></button>
                        <?php foreach ($industries as $key => $label) : ?>
                            <button type="button" class="ds-dsd-filter" data-filter="<?php echo esc_attr($key); ?>" aria-pressed="false"><?php echo esc_html($label); ?> <span><?php echo (int) ($counts[$key] ?? 0); ?></span></button>
                        <?php endforeach; ?>
                    </div>

                    <ul class="ds-dsd-leads">
                        <?php foreach ($leads as $i => $lead) :
                            $id       = 'dsd-lead-' . $i;
                            $status   = in_array($lead['status'], $statuses, true) ? $lead['status'] : $statuses[0];
                            $initials = implode('', array_map(function ($w) { return mb_substr($w, 0, 1); }, array_slice(explode(' ', $lead['name']), 0, 2)));
                            $duration = (int) ($lead['duration'] ?? 120);
                            ?>
                            <li class="sim-lead-card ds-dsd-lead" data-value="<?php echo esc_attr($lead['value']); ?>" data-category="<?php echo esc_attr($lead['category']); ?>">
                                <div class="ds-dsd-lead__who">
                                    <span class="ds-dsd-lead__avatar" aria-hidden="true"><?php echo esc_html($initials); ?></span>
                                    <div>
                                        <strong class="ds-dsd-lead__name" id="<?php echo esc_attr($id); ?>-name"><?php echo esc_html($lead['name']); ?></strong>
                                        <span class="ds-dsd-lead__phone"><?php echo esc_html($lead['phone']); ?></span>
                                        <span class="ds-dsd-lead__time"><i class="fa-regular fa-clock" aria-hidden="true"></i> <?php echo esc_html($lead['time']); ?></span>
                                    </div>
                                </div>

                                <div class="ds-dsd-lead__job">
                                    <strong>$<?php echo esc_html(number_format($lead['value'])); ?></strong>
                                    <span><?php echo esc_html($lead['service']); ?></span>
                                    <em class="ds-dsd-source ds-dsd-source--<?php echo esc_attr(sanitize_title($lead['source'])); ?>"><?php echo esc_html($lead['source']); ?></em>
                                </div>

                                <div class="ds-dsd-call" data-duration="<?php echo esc_attr($duration); ?>">
                                    <button type="button" class="sim-audio-btn ds-dsd-call__btn" aria-pressed="false" aria-label="<?php echo esc_attr(sprintf(__('Play call recording from %s', 'digitalstride'), $lead['name'])); ?>">
                                        <span class="play-icon" aria-hidden="true">▶</span>
                                    </button>
                                    <span class="ds-dsd-call__wave" aria-hidden="true">
                                        <?php for ($b = 0; $b < 28; $b++) : ?>
                                            <i style="--a:<?php echo (int) (25 + abs(sin(($b + 1) * ($i + 2) * 0.7)) * 75); ?>%"></i>
                                        <?php endfor; ?>
                                    </span>
                                    <span class="ds-dsd-call__timer"><span class="ds-dsd-call__elapsed">0:00</span> / <?php echo esc_html($format_time($duration)); ?></span>
                                </div>

                                <div class="ds-dsd-lead__status">
                                    <span class="status-badge <?php echo esc_attr(ds_dsd_status_class($status)); ?>"><?php echo esc_html($status); ?></span>
                                    <label class="screen-reader-text" for="<?php echo esc_attr($id); ?>-status"><?php echo esc_html(sprintf(__('Lead status for %s', 'digitalstride'), $lead['name'])); ?></label>
                                    <select class="lead-status-select" id="<?php echo esc_attr($id); ?>-status" data-initial="<?php echo esc_attr($status); ?>">
                                        <?php foreach ($statuses as $option) : ?>
                                            <option value="<?php echo esc_attr($option); ?>"<?php selected($option, $status); ?>><?php echo esc_html($option); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <p class="ds-dsd-app__note"><i class="fa-solid fa-circle-info" aria-hidden="true"></i> <?php esc_html_e('Demo data. Tag a lead “Booked / Sold” to add its job value to your pipeline.', 'digitalstride'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
