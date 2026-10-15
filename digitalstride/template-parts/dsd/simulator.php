<?php
/**
 * DSD: Interactive Trade & Lead Simulator (group_dsd_simulator), followed
 * by the "Already a Digital Stride Partner?" button.
 *
 * A mock DSD client portal with four working sidebar tabs:
 * - Live Lead Feed: sample leads (ds_dsd_sim_leads()) filtered by industry.
 *   Clicking a lead opens its call recording player and status tagger.
 * - Job & Ad ROI: spend per source against booked revenue.
 * - Field Approvals: 1-click approve / request changes.
 * - Contract Value Log: every Booked / Sold job.
 * dsd.js keeps "Total Revenue Pipeline Identified", the ROI table and the
 * contract log in step as leads are re-tagged.
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

$partner_label = get_field('sim_partner_label') ?: $d['partner_label'];
$partner_link  = ds_aec_link(get_field('sim_partner_link'), $d['partner_btn']) ?: ['url' => $d['partner_url'], 'title' => $d['partner_btn'], 'target' => ''];

$leads      = ds_dsd_sim_leads();
$statuses   = ds_dsd_statuses();
$industries = ds_dsd_industries();
$spend      = ds_dsd_sim_spend();
$approvals  = ds_dsd_sim_approvals();
if (!$leads) return;

$counts = array_count_values(array_column($leads, 'category'));
$clock  = function ($seconds) { return sprintf('%d:%02d', floor($seconds / 60), $seconds % 60); };
$tabs   = [
    'feed'      => ['fa-solid fa-phone', __('Live Lead Feed', 'digitalstride')],
    'roi'       => ['fa-solid fa-chart-line', __('Job & Ad ROI', 'digitalstride')],
    'approvals' => ['fa-solid fa-circle-check', __('Field Approvals', 'digitalstride')],
    'contracts' => ['fa-solid fa-file-invoice-dollar', __('Contract Value Log', 'digitalstride')],
];
?>
<section class="ds-section ds-dsd-sim" id="dsd-simulator" aria-labelledby="dsd-sim-title">
    <div class="ds-container">
        <div class="ds-dsd-head">
            <h2 class="ds-section__heading ds-section__heading--center" id="dsd-sim-title"><?php echo esc_html($headline); ?></h2>
            <?php if ($sub) : ?><p class="ds-dsd-head__text"><?php echo esc_html($sub); ?></p><?php endif; ?>
        </div>

        <div class="ds-dsd-app" data-dsd-sim data-pipeline="<?php echo esc_attr($pipeline); ?>">
            <div class="ds-dsd-app__chrome">
                <span class="ds-dsd-app__dots" aria-hidden="true"><i></i><i></i><i></i></span>
                <span class="ds-dsd-app__url" aria-hidden="true">portal.digitalstride.io/trades/live-demo</span>
                <span class="ds-dsd-live"><?php esc_html_e('Live Trade Portal View', 'digitalstride'); ?></span>
            </div>

            <div class="ds-dsd-app__layout">
                <div class="ds-dsd-app__side">
                    <p class="ds-dsd-app__side-label" id="dsd-sim-tabs-label"><?php esc_html_e('Client Portal Tabs', 'digitalstride'); ?></p>
                    <div class="ds-dsd-app__tabs" role="tablist" aria-labelledby="dsd-sim-tabs-label" aria-orientation="vertical">
                        <?php $first = true; foreach ($tabs as $key => $tab) : ?>
                            <button type="button" class="ds-dsd-app__tab<?php echo $first ? ' is-active' : ''; ?>" role="tab" id="dsd-sim-tab-<?php echo esc_attr($key); ?>" aria-controls="dsd-sim-panel-<?php echo esc_attr($key); ?>" aria-selected="<?php echo $first ? 'true' : 'false'; ?>" tabindex="<?php echo $first ? '0' : '-1'; ?>">
                                <i class="<?php echo esc_attr($tab[0]); ?>" aria-hidden="true"></i><span><?php echo esc_html($tab[1]); ?></span>
                            </button>
                        <?php $first = false; endforeach; ?>
                    </div>
                    <div class="ds-dsd-app__client" aria-hidden="true">
                        <span class="ds-dsd-app__client-avatar">AR</span>
                        <span><strong>Apex Roofing &amp; HVAC</strong><em>Digital Stride Partner</em></span>
                    </div>
                </div>

                <div class="ds-dsd-app__main">
                    <div class="ds-dsd-app__stats">
                        <div class="ds-dsd-stat ds-dsd-stat--pipeline">
                            <span><?php esc_html_e('Total Revenue Pipeline Identified', 'digitalstride'); ?></span>
                            <strong id="dsd-pipeline-total" aria-live="polite" aria-atomic="true">$<?php echo esc_html(number_format($pipeline)); ?></strong>
                            <em class="ds-dsd-stat__delta" aria-hidden="true"></em>
                        </div>
                        <div class="ds-dsd-stat">
                            <span><?php esc_html_e('Avg Speed-to-Lead', 'digitalstride'); ?></span>
                            <strong class="is-teal">2.4 mins</strong>
                        </div>
                    </div>

                    <!-- Live Lead Feed -->
                    <div class="ds-dsd-app__panel" role="tabpanel" id="dsd-sim-panel-feed" aria-labelledby="dsd-sim-tab-feed">
                        <div class="ds-dsd-app__panel-head">
                            <div>
                                <h3><?php esc_html_e('Inbound Phone Calls & Lead Queue', 'digitalstride'); ?></h3>
                                <p><?php esc_html_e('Click a lead to tag contract status or review recording details.', 'digitalstride'); ?></p>
                            </div>
                            <div class="ds-dsd-filters" role="group" aria-label="<?php esc_attr_e('Filter leads by industry', 'digitalstride'); ?>">
                                <button type="button" class="ds-dsd-filter is-active" data-filter="all" aria-pressed="true"><?php esc_html_e('All', 'digitalstride'); ?> <span><?php echo count($leads); ?></span></button>
                                <?php foreach ($industries as $key => $label) : ?>
                                    <button type="button" class="ds-dsd-filter" data-filter="<?php echo esc_attr($key); ?>" aria-pressed="false"><?php echo esc_html($label); ?> <span><?php echo (int) ($counts[$key] ?? 0); ?></span></button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <ul class="ds-dsd-leads">
                            <?php foreach ($leads as $i => $lead) :
                                $id       = 'dsd-lead-' . $i;
                                $status   = in_array($lead['status'], $statuses, true) ? $lead['status'] : $statuses[0];
                                $duration = (int) ($lead['duration'] ?? 0);
                                $is_call  = ($lead['type'] ?? '') !== 'Web Form' && $duration > 0;
                                ?>
                                <li class="sim-lead-card ds-dsd-lead" data-value="<?php echo esc_attr($lead['value']); ?>" data-category="<?php echo esc_attr($lead['category']); ?>" data-source="<?php echo esc_attr($lead['source']); ?>" data-name="<?php echo esc_attr($lead['name']); ?>" data-service="<?php echo esc_attr($lead['service']); ?>">
                                    <button type="button" class="ds-dsd-lead__row" aria-expanded="false" aria-controls="<?php echo esc_attr($id); ?>-detail">
                                        <span class="ds-dsd-lead__main">
                                            <span class="ds-dsd-lead__top">
                                                <strong><?php echo esc_html($lead['name']); ?></strong>
                                                <em class="ds-dsd-type ds-dsd-type--<?php echo esc_attr(sanitize_title($lead['type'] ?? 'inbound-call')); ?>"><?php echo esc_html($lead['type'] ?? 'Inbound Call'); ?></em>
                                                <span class="ds-dsd-lead__meta"><?php echo esc_html($lead['source'] . ' • ' . $lead['time']); ?></span>
                                            </span>
                                            <span class="ds-dsd-lead__service"><?php echo esc_html($lead['service']); ?></span>
                                        </span>
                                        <span class="status-badge <?php echo esc_attr(ds_dsd_status_class($status)); ?>" data-value-label="<?php echo esc_attr(number_format($lead['value'])); ?>"><?php echo esc_html($status === 'Booked / Sold' ? 'Booked ($' . number_format($lead['value']) . ')' : $status); ?></span>
                                        <i class="fa-solid fa-chevron-down ds-dsd-lead__chev" aria-hidden="true"></i>
                                    </button>

                                    <div class="ds-dsd-lead__detail" id="<?php echo esc_attr($id); ?>-detail" hidden>
                                        <div class="ds-dsd-lead__facts">
                                            <span><i class="fa-solid fa-phone" aria-hidden="true"></i> <?php echo esc_html($lead['phone']); ?></span>
                                            <span><i class="fa-solid fa-sack-dollar" aria-hidden="true"></i> <?php esc_html_e('Est. job value', 'digitalstride'); ?> <strong>$<?php echo esc_html(number_format($lead['value'])); ?></strong></span>
                                        </div>

                                        <?php if ($is_call) : ?>
                                            <div class="ds-dsd-call" data-duration="<?php echo esc_attr($duration); ?>">
                                                <button type="button" class="sim-audio-btn ds-dsd-call__btn" aria-pressed="false" aria-label="<?php echo esc_attr(sprintf(__('Play call recording from %s', 'digitalstride'), $lead['name'])); ?>">
                                                    <span class="play-icon" aria-hidden="true">▶</span>
                                                </button>
                                                <span class="ds-dsd-call__wave" aria-hidden="true">
                                                    <?php for ($b = 0; $b < 36; $b++) : ?>
                                                        <i style="--a:<?php echo (int) (25 + abs(sin(($b + 1) * ($i + 2) * 0.7)) * 75); ?>%"></i>
                                                    <?php endfor; ?>
                                                </span>
                                                <span class="ds-dsd-call__timer"><span class="ds-dsd-call__elapsed">0:00</span> / <?php echo esc_html($clock($duration)); ?></span>
                                            </div>
                                        <?php else : ?>
                                            <p class="ds-dsd-lead__form-note"><i class="fa-solid fa-envelope-open-text" aria-hidden="true"></i> <?php esc_html_e('Web form submission: details delivered by email and text the moment it arrived.', 'digitalstride'); ?></p>
                                        <?php endif; ?>

                                        <div class="ds-dsd-lead__tagger">
                                            <label for="<?php echo esc_attr($id); ?>-status"><?php esc_html_e('Lead status', 'digitalstride'); ?></label>
                                            <select class="lead-status-select" id="<?php echo esc_attr($id); ?>-status">
                                                <?php foreach ($statuses as $option) : ?>
                                                    <option value="<?php echo esc_attr($option); ?>"<?php selected($option, $status); ?>><?php echo esc_html($option); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Job & Ad ROI -->
                    <div class="ds-dsd-app__panel" role="tabpanel" id="dsd-sim-panel-roi" aria-labelledby="dsd-sim-tab-roi" hidden>
                        <div class="ds-dsd-app__panel-head">
                            <div>
                                <h3><?php esc_html_e('Job & Ad ROI by Channel', 'digitalstride'); ?></h3>
                                <p><?php esc_html_e('Booked revenue from the lead feed against this month’s ad spend.', 'digitalstride'); ?></p>
                            </div>
                        </div>
                        <div class="ds-dsd-table-wrap">
                            <table class="ds-dsd-table">
                                <thead>
                                    <tr><th scope="col"><?php esc_html_e('Channel', 'digitalstride'); ?></th><th scope="col"><?php esc_html_e('Ad Spend', 'digitalstride'); ?></th><th scope="col"><?php esc_html_e('Leads', 'digitalstride'); ?></th><th scope="col"><?php esc_html_e('Booked Revenue', 'digitalstride'); ?></th><th scope="col"><?php esc_html_e('ROAS', 'digitalstride'); ?></th></tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($spend as $source => $amount) : ?>
                                        <tr data-roi-source="<?php echo esc_attr($source); ?>" data-spend="<?php echo esc_attr($amount); ?>">
                                            <th scope="row"><?php echo esc_html($source); ?></th>
                                            <td>$<?php echo esc_html(number_format($amount)); ?></td>
                                            <td data-roi="leads">0</td>
                                            <td data-roi="revenue">$0</td>
                                            <td><span class="ds-dsd-roas" data-roi="roas">0x</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Field Approvals -->
                    <div class="ds-dsd-app__panel" role="tabpanel" id="dsd-sim-panel-approvals" aria-labelledby="dsd-sim-tab-approvals" hidden>
                        <div class="ds-dsd-app__panel-head">
                            <div>
                                <h3><?php esc_html_e('Field Approvals', 'digitalstride'); ?> <span class="ds-dsd-count" data-approvals-left><?php echo count($approvals); ?></span></h3>
                                <p><?php esc_html_e('Approve ads, photos and pages in one tap, right from the job site.', 'digitalstride'); ?></p>
                            </div>
                        </div>
                        <ul class="ds-dsd-approvals">
                            <?php foreach ($approvals as $asset) : ?>
                                <li class="ds-dsd-approval">
                                    <span class="ds-dsd-approval__thumb" aria-hidden="true"><i class="<?php echo esc_attr($asset['icon']); ?>"></i></span>
                                    <span class="ds-dsd-approval__text"><strong><?php echo esc_html($asset['title']); ?></strong><em><?php echo esc_html($asset['meta']); ?></em></span>
                                    <span class="ds-dsd-approval__actions">
                                        <button type="button" class="ds-dsd-approval__btn ds-dsd-approval__btn--ok" data-approve><?php esc_html_e('Approve', 'digitalstride'); ?></button>
                                        <button type="button" class="ds-dsd-approval__btn" data-changes><?php esc_html_e('Request Changes', 'digitalstride'); ?></button>
                                    </span>
                                    <span class="ds-dsd-approval__state" aria-live="polite"></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Contract Value Log -->
                    <div class="ds-dsd-app__panel" role="tabpanel" id="dsd-sim-panel-contracts" aria-labelledby="dsd-sim-tab-contracts" hidden>
                        <div class="ds-dsd-app__panel-head">
                            <div>
                                <h3><?php esc_html_e('Contract Value Log', 'digitalstride'); ?></h3>
                                <p><?php esc_html_e('Every lead tagged Booked / Sold in the lead feed.', 'digitalstride'); ?></p>
                            </div>
                        </div>
                        <ul class="ds-dsd-contracts" data-contracts></ul>
                        <p class="ds-dsd-contracts__empty" data-contracts-empty hidden><?php esc_html_e('No booked jobs yet. Tag a lead “Booked / Sold” in the Live Lead Feed.', 'digitalstride'); ?></p>
                    </div>

                    <p class="ds-dsd-app__note"><i class="fa-solid fa-circle-info" aria-hidden="true"></i> <?php esc_html_e('Demo data for illustration.', 'digitalstride'); ?></p>
                </div>
            </div>
        </div>

        <?php if ($partner_link['url']) : ?>
            <div class="ds-dsd-partner">
                <?php if ($partner_label) : ?><p class="ds-dsd-tag"><?php echo esc_html($partner_label); ?></p><?php endif; ?>
                <a href="<?php echo esc_url($partner_link['url']); ?>" class="ds-btn ds-btn--primary"<?php ds_aec_target_attrs($partner_link['target']); ?>><?php echo esc_html($partner_link['title']); ?></a>
            </div>
        <?php endif; ?>
    </div>
</section>
