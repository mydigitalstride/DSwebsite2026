<?php
/**
 * Home Services: "Built for Local Home Service Businesses & Trades"
 * segment grid (repeater `hs_who_we_serve`).
 *
 * Same behaviour as the AEC segment selector (aec-landing.js): clicking a
 * box highlights it and reveals its description; clicking it again closes
 * it. A box flagged `is_active_default` starts open. Without JavaScript
 * every description stays visible.
 */
$d        = ds_hs_defaults('who_we_serve');
$heading  = get_field('hs_who_we_serve_heading') ?: $d['heading'];
$segments = [];

if (have_rows('hs_who_we_serve')) {
    while (have_rows('hs_who_we_serve')) {
        the_row();
        $segments[] = [
            'title'       => get_sub_field('segment_title'),
            'description' => get_sub_field('segment_description'),
            'active'      => (bool) get_sub_field('is_active_default'),
        ];
    }
}
if (!$segments) $segments = $d['segments'];

$segments = array_values(array_filter($segments, function ($s) { return !empty($s['title']); }));
if (!$segments) return;

// At most one box starts open: the first one flagged.
$active = -1;
foreach ($segments as $i => $s) {
    if ($s['active']) { $active = $i; break; }
}
$uid = 'ds-hs-seg-' . wp_unique_id();
?>
<section class="ds-section ds-aec-segments ds-hs-segments" aria-labelledby="<?php echo esc_attr($uid); ?>-heading">
    <div class="ds-container">
        <h2 class="ds-section__heading" id="<?php echo esc_attr($uid); ?>-heading"><?php echo esc_html($heading); ?></h2>

        <div class="ds-aec-segments__grid ds-hs-segments__grid" data-aec-segments role="group" aria-label="<?php echo esc_attr($heading); ?>">
            <?php foreach ($segments as $i => $s) :
                $on      = $i === $active;
                $desc_id = $uid . '-desc-' . $i;
                ?>
                <button type="button" class="ds-aec-segment<?php echo $on ? ' is-active' : ''; ?>" aria-expanded="<?php echo $on ? 'true' : 'false'; ?>"
                    <?php if (!empty($s['description'])) : ?>aria-controls="<?php echo esc_attr($desc_id); ?>"<?php endif; ?>>
                    <span class="ds-aec-segment__title"><?php echo esc_html($s['title']); ?></span>
                    <?php if (!empty($s['description'])) : ?>
                        <span class="ds-aec-segment__reveal">
                            <span class="ds-aec-segment__desc" id="<?php echo esc_attr($desc_id); ?>"><?php echo esc_html($s['description']); ?></span>
                        </span>
                    <?php endif; ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>
