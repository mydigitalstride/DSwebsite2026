<?php
/**
 * Flex Layout: Proposal Templates
 * Grid of RFP/RFQ and proposal templates from /proposal-templates/.
 * See inc/proposal-templates.php.
 */
$heading    = get_sub_field('heading');
$intro      = get_sub_field('intro');
$industries = get_sub_field('industries') ?: [];
$type       = get_sub_field('template_type') ?: 'all';
$filters    = get_sub_field('show_filters');
?>

<section class="ds-section ds-section--proposal-templates">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($intro) : ?>
            <p class="ds-section__text"><?php echo esc_html($intro); ?></p>
        <?php endif; ?>

        <?php ds_pt_render_library([
            'industries'    => (array) $industries,
            'type'          => $type,
            'filters'       => $filters === null ? true : (bool) $filters,
            'heading_level' => $heading ? 3 : 2,
        ]); ?>

        <p class="ds-section__cta">
            <a class="ds-btn ds-btn--outline" href="<?php echo esc_url(ds_pt_url()); ?>"><?php esc_html_e('See all templates', 'digitalstride'); ?></a>
        </p>
    </div>
</section>
