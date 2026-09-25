<?php
/**
 * One proposal / RFP-RFQ template — served at /proposal-templates/{slug}/.
 * Content comes from proposal-templates/{slug}.php; see inc/proposal-templates.php.
 */
$slug       = ds_pt_request();
$t          = ds_pt_get($slug);
$industries = ds_pt_industries();
$types      = ds_pt_types();
$ind        = $industries[$t['industry']] ?? null;

get_header();
?>

<div class="ds-pt" data-pt data-pt-slug="<?php echo esc_attr($slug); ?>">

    <section class="ds-section ds-pt-hero ds-pt-hero--single">
        <div class="ds-container">
            <nav class="ds-pt-crumbs" aria-label="<?php esc_attr_e('Breadcrumb', 'digitalstride'); ?>">
                <ol>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'digitalstride'); ?></a></li>
                    <li><a href="<?php echo esc_url(ds_pt_url()); ?>"><?php esc_html_e('Proposal Templates', 'digitalstride'); ?></a></li>
                    <li aria-current="page"><?php echo esc_html($t['title']); ?></li>
                </ol>
            </nav>

            <p class="ds-pt-card__meta">
                <?php if ($ind) : ?>
                    <span class="ds-pt-badge"><i class="fa-solid <?php echo esc_attr($ind['icon']); ?>" aria-hidden="true"></i> <?php echo esc_html($ind['label']); ?></span>
                <?php endif; ?>
                <span class="ds-pt-badge ds-pt-badge--<?php echo esc_attr($t['type']); ?>"><?php echo esc_html($types[$t['type']]); ?></span>
                <?php if ($t['length']) : ?><span class="ds-pt-badge ds-pt-badge--plain"><?php echo esc_html($t['length']); ?></span><?php endif; ?>
            </p>
            <h1 class="ds-pt-hero__title"><?php echo esc_html($t['title']); ?></h1>
            <p class="ds-pt-hero__lead"><?php echo esc_html($t['summary']); ?></p>

            <div class="ds-pt-actions">
                <button type="button" class="ds-btn ds-btn--primary" data-pt-action="print"><i class="fa-solid fa-print" aria-hidden="true"></i> <?php esc_html_e('Print / Save as PDF', 'digitalstride'); ?></button>
                <button type="button" class="ds-btn ds-btn--outline" data-pt-action="word"><i class="fa-solid fa-file-word" aria-hidden="true"></i> <?php esc_html_e('Download for Word', 'digitalstride'); ?></button>
                <button type="button" class="ds-btn ds-btn--outline" data-pt-action="copy"><i class="fa-solid fa-copy" aria-hidden="true"></i> <?php esc_html_e('Copy to Google Docs', 'digitalstride'); ?></button>
            </div>
            <p class="ds-pt-status" role="status" aria-live="polite" data-pt-status></p>
        </div>
    </section>

    <section class="ds-section ds-pt-body">
        <div class="ds-container ds-pt-layout">

            <aside class="ds-pt-side" aria-label="<?php esc_attr_e('Template tools', 'digitalstride'); ?>">

                <?php if ($t['fields']) : ?>
                    <details class="ds-pt-panel ds-pt-fields" data-pt-fields open>
                        <summary><h2 class="ds-pt-panel__title"><?php esc_html_e('1. Your details', 'digitalstride'); ?></h2></summary>
                        <form onsubmit="return false;">
                        <p class="ds-pt-panel__note"><?php esc_html_e('Fills in everywhere below. Saved only in this browser.', 'digitalstride'); ?></p>
                        <?php foreach ($t['fields'] as $key => $label) : $id = 'ds-pt-f-' . sanitize_key($key); ?>
                            <label class="ds-pt-field" for="<?php echo esc_attr($id); ?>">
                                <span><?php echo esc_html($label); ?></span>
                                <input type="text" id="<?php echo esc_attr($id); ?>" name="<?php echo esc_attr($key); ?>" data-pt-field="<?php echo esc_attr($key); ?>" autocomplete="off">
                            </label>
                        <?php endforeach; ?>
                        <button type="button" class="ds-pt-link" data-pt-action="clear"><?php esc_html_e('Clear my details', 'digitalstride'); ?></button>
                        </form>
                    </details>
                <?php endif; ?>

                <div class="ds-pt-panel">
                    <h2 class="ds-pt-panel__title"><?php esc_html_e('2. Fill the highlights', 'digitalstride'); ?></h2>
                    <p class="ds-pt-panel__note">
                        <?php esc_html_e('Anything', 'digitalstride'); ?> <mark class="ds-pt__fill">[<?php esc_html_e('highlighted', 'digitalstride'); ?>]</mark>
                        <?php esc_html_e('is yours to complete after you download.', 'digitalstride'); ?>
                    </p>
                    <label class="ds-pt-toggle">
                        <input type="checkbox" data-pt-tips checked>
                        <span><?php esc_html_e('Show writing tips', 'digitalstride'); ?></span>
                    </label>
                </div>

                <nav class="ds-pt-panel ds-pt-toc" aria-label="<?php esc_attr_e('Template sections', 'digitalstride'); ?>">
                    <h2 class="ds-pt-panel__title"><?php esc_html_e('Sections', 'digitalstride'); ?></h2>
                    <ol>
                        <?php foreach ($t['sections'] as $i => $section) : ?>
                            <li><a href="#pt-section-<?php echo (int) $i + 1; ?>"><?php echo esc_html($section['heading']); ?></a></li>
                        <?php endforeach; ?>
                        <?php if ($t['checklist']) : ?>
                            <li><a href="#pt-checklist"><?php esc_html_e('Before you send', 'digitalstride'); ?></a></li>
                        <?php endif; ?>
                    </ol>
                </nav>
            </aside>

            <div class="ds-pt-main">
                <?php if ($t['use_when']) : ?>
                    <div class="ds-pt-usewhen">
                        <h2><?php esc_html_e('Use this template when', 'digitalstride'); ?></h2>
                        <ul>
                            <?php foreach ($t['use_when'] as $item) : ?>
                                <li><?php echo esc_html($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <article class="ds-pt-doc" data-pt-doc aria-label="<?php echo esc_attr($t['title']); ?>">
                    <?php foreach ($t['sections'] as $i => $section) : ?>
                        <section class="ds-pt-doc__section" id="pt-section-<?php echo (int) $i + 1; ?>">
                            <h2 class="ds-pt-doc__heading"><?php echo esc_html($section['heading']); ?></h2>
                            <?php if (!empty($section['tip'])) : ?>
                                <aside class="ds-pt-tip" data-pt-tip>
                                    <p><strong><i class="fa-solid fa-lightbulb" aria-hidden="true"></i> <?php esc_html_e('Tip:', 'digitalstride'); ?></strong> <?php echo esc_html($section['tip']); ?></p>
                                </aside>
                            <?php endif; ?>
                            <div class="ds-pt-doc__body">
                                <?php echo ds_pt_render_body($section['body'] ?? '', $t['fields']); // phpcs:ignore WordPress.Security.EscapeOutput -- sanitised with wp_kses in ds_pt_render_body(). ?>
                            </div>
                        </section>
                    <?php endforeach; ?>
                </article>

                <?php if ($t['checklist']) : ?>
                    <div class="ds-pt-checklist" id="pt-checklist">
                        <h2><?php esc_html_e('Before you send', 'digitalstride'); ?></h2>
                        <ul>
                            <?php foreach ($t['checklist'] as $i => $item) : $cid = 'ds-pt-check-' . $i; ?>
                                <li>
                                    <input type="checkbox" id="<?php echo esc_attr($cid); ?>" data-pt-check="<?php echo (int) $i; ?>">
                                    <label for="<?php echo esc_attr($cid); ?>"><?php echo esc_html($item); ?></label>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <p class="ds-pt-disclaimer">
                    <?php esc_html_e('This template is a starting point, not legal advice. Follow the solicitation\'s instructions where they differ, and have an attorney review contract terms, warranties, and payment language before you rely on them.', 'digitalstride'); ?>
                </p>

                <p class="ds-pt-back"><a href="<?php echo esc_url(ds_pt_url()); ?>"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> <?php esc_html_e('All templates', 'digitalstride'); ?></a></p>
            </div>
        </div>
    </section>
</div>

<?php
if (function_exists('ds_render_global_cta')) ds_render_global_cta();
get_footer();
