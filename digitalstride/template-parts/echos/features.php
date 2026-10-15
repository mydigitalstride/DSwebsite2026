<?php
/**
 * ECHO SEO: Core features grid (s4_* fields).
 *
 * The Home Services segment grid (3 columns, 2 rows of bordered boxes) with
 * each card's description always shown. A card flagged `is_highlighted`
 * gets the gold border and glow.
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
        'highlight'   => !empty($row['is_highlighted']),
    ];
}
$cards = array_values(array_filter($cards, function ($c) { return trim((string) $c['title']) !== ''; }));
if (!$cards) $cards = $d['cards'];
?>
<section class="ds-section ds-echos-features" aria-labelledby="echos-features-title">
    <div class="ds-container">
        <div class="ds-echos-head">
            <?php if ($kick) : ?><p class="ds-echos-tag"><?php echo esc_html($kick); ?></p><?php endif; ?>
            <h2 class="ds-section__heading ds-section__heading--center" id="echos-features-title"><?php echo esc_html($title); ?></h2>
            <?php if ($sub) : ?><p class="ds-echos-head__text"><?php echo esc_html($sub); ?></p><?php endif; ?>
        </div>

        <ul class="ds-echos-features__grid">
            <?php foreach ($cards as $card) : ?>
                <li class="ds-echos-feature<?php echo $card['highlight'] ? ' is-highlighted' : ''; ?>">
                    <h3 class="ds-echos-feature__title"><?php echo esc_html($card['title']); ?></h3>
                    <?php if (!empty($card['description'])) : ?>
                        <p class="ds-echos-feature__text"><?php echo esc_html($card['description']); ?></p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
