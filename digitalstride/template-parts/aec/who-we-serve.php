<?php
/**
 * AEC Landing: Who We Serve in AEC — segment selector
 * (repeater `aec_who_we_serve`).
 *
 * Clicking a box highlights it and reveals its description. Without
 * JavaScript every description stays visible.
 */
$d        = ds_aec_defaults('who_we_serve');
$heading  = get_field('aec_who_we_serve_heading') ?: $d['heading'];
$segments = [];

if (have_rows('aec_who_we_serve')) {
    while (have_rows('aec_who_we_serve')) {
        the_row();
        $segments[] = [
            'title'       => get_sub_field('segment_title'),
            'description' => get_sub_field('segment_description'),
            'icon'        => get_sub_field('segment_icon'),
            'active'      => (bool) get_sub_field('is_active_default'),
        ];
    }
}
if (!$segments) $segments = $d['segments'];

$segments = array_values(array_filter($segments, function ($s) { return !empty($s['title']); }));
if (!$segments) return;

// Exactly one box starts highlighted: the first flagged one, else the first.
$active = 0;
foreach ($segments as $i => $s) {
    if ($s['active']) { $active = $i; break; }
}
$uid = 'ds-aec-seg-' . wp_unique_id();
?>
<section class="ds-section ds-aec-segments" aria-labelledby="<?php echo esc_attr($uid); ?>-heading">
    <div class="ds-container">
        <h2 class="ds-section__heading" id="<?php echo esc_attr($uid); ?>-heading"><?php echo esc_html($heading); ?></h2>

        <div class="ds-aec-segments__grid" data-aec-segments role="group" aria-label="<?php echo esc_attr($heading); ?>">
            <?php foreach ($segments as $i => $s) :
                $is_active = $i === $active;
                $desc_id   = $uid . '-desc-' . $i;
                ?>
                <button type="button"
                    class="ds-aec-segment<?php echo $is_active ? ' is-active' : ''; ?>"
                    aria-pressed="<?php echo $is_active ? 'true' : 'false'; ?>"
                    <?php if (!empty($s['description'])) : ?>aria-describedby="<?php echo esc_attr($desc_id); ?>"<?php endif; ?>>
                    <?php if (!empty($s['icon'])) : ?>
                        <span class="ds-aec-segment__icon"><?php echo ds_inline_svg($s['icon']); ?></span>
                    <?php endif; ?>
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
