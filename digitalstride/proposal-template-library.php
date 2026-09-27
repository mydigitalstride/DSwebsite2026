<?php
/**
 * Proposal & RFP/RFQ template library — served at /proposal-templates/.
 * See inc/proposal-templates.php.
 */
get_header();
?>

<section class="ds-section ds-pt-hero">
    <div class="ds-container">
        <p class="ds-pt-hero__eyebrow"><?php esc_html_e('Free templates', 'digitalstride'); ?></p>
        <h1 class="ds-pt-hero__title"><?php esc_html_e('RFP, RFQ & Proposal Templates', 'digitalstride'); ?></h1>
        <p class="ds-pt-hero__lead">
            <?php esc_html_e('Fill-in-the-blank templates for architects, engineers, general contractors, and HVAC, plumbing, electrical and roofing companies. Type your details once, everything fills in, then print, save as PDF, download for Word, or copy into Google Docs.', 'digitalstride'); ?>
        </p>
        <ul class="ds-pt-hero__points">
            <li><i class="fa-solid fa-check" aria-hidden="true"></i> <?php esc_html_e('Sections in the order evaluators score them', 'digitalstride'); ?></li>
            <li><i class="fa-solid fa-check" aria-hidden="true"></i> <?php esc_html_e('Writing tips for every section', 'digitalstride'); ?></li>
            <li><i class="fa-solid fa-check" aria-hidden="true"></i> <?php esc_html_e('Pre-submission checklist', 'digitalstride'); ?></li>
        </ul>
    </div>
</section>

<section class="ds-section ds-pt-library-section">
    <div class="ds-container">
        <h2 class="screen-reader-text"><?php esc_html_e('Templates', 'digitalstride'); ?></h2>
        <?php ds_pt_render_library(['heading_level' => 3]); ?>
    </div>
</section>

<?php
if (function_exists('ds_render_global_cta')) ds_render_global_cta();
get_footer();
