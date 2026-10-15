<?php
/**
 * ECHO SEO: Core features (s4_* fields).
 *
 * The Home Services segment boxes (aec-landing.css / .js): every box shows
 * its title only; clicking one highlights it and opens its description,
 * clicking it again closes it. A card flagged `is_highlighted` starts open.
 * Without JavaScript every description stays visible.
 */
$d     = ds_echos_defaults('features');
$kick  = get_field('s4_kicker') ?: $d['kicker'];
$title = get_field('s4_headline') ?: $d['headline'];
$sub   = get_field('s4_subtext') ?: $d['subtext'];
$cards = [];

foreach ((array) (get_field('s4_feature_cards') ?: []) as $row) {
    $cards[] = [
        'title'       => $row['card_title'] ?? '',
        'description' => $row['card_description'] ?? '',
        'active'      => !empty($row['is_highlighted']),
    ];
}
$cards = array_values(array_filter($cards, function ($c) { return trim((string) $c['title']) !== ''; }));
if (!$cards) $cards = $d['cards'];

// At most one box starts open: the first one flagged.
$active = -1;
foreach ($cards as $i => $c) {
    if ($c['active']) { $active = $i; break; }
}
$uid = 'ds-echos-seg-' . wp_unique_id();
?>
<section class="ds-section ds-aec-segments ds-echos-features" aria-labelledby="<?php echo esc_attr($uid); ?>-heading">
    <div class="ds-container">
        <div class="ds-echos-head">
            <?php if ($kick) : ?><p class="ds-aec-tag"><?php echo esc_html($kick); ?></p><?php endif; ?>
            <h2 class="ds-section__heading ds-section__heading--center" id="<?php echo esc_attr($uid); ?>-heading"><?php echo esc_html($title); ?></h2>
            <?php if ($sub) : ?><p class="ds-echos-head__text"><?php echo esc_html($sub); ?></p><?php endif; ?>
        </div>

        <div class="ds-aec-segments__grid ds-echos-features__grid" data-aec-segments role="group" aria-label="<?php echo esc_attr($title); ?>">
            <?php foreach ($cards as $i => $c) :
                $on      = $i === $active;
                $desc_id = $uid . '-desc-' . $i;
                ?>
                <button type="button" class="ds-aec-segment<?php echo $on ? ' is-active' : ''; ?>" aria-expanded="<?php echo $on ? 'true' : 'false'; ?>"
                    <?php if (!empty($c['description'])) : ?>aria-controls="<?php echo esc_attr($desc_id); ?>"<?php endif; ?>>
                    <span class="ds-aec-segment__title"><?php echo esc_html($c['title']); ?></span>
                    <?php if (!empty($c['description'])) : ?>
                        <span class="ds-aec-segment__reveal">
                            <span class="ds-aec-segment__desc" id="<?php echo esc_attr($desc_id); ?>"><?php echo esc_html($c['description']); ?></span>
                        </span>
                    <?php endif; ?>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>
