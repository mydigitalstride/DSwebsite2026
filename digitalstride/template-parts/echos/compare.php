<?php
/**
 * ECHO SEO: Tailored value comparison (s3_*, p1_*, p2_* fields).
 *
 * The DSD comparison layout (two slate cards with a label and a checked
 * list) in ECHO colours: gold labels, gold checks, slate panels. Left is
 * the retainer partner card, right the standalone card.
 */
$d     = ds_echos_defaults('compare');
$title = get_field('s3_headline') ?: $d['headline'];
$sub   = get_field('s3_subheadline') ?: $d['subheadline'];

$rows = function ($name, $fallback) {
    $out = [];
    foreach ((array) (get_field($name) ?: []) as $row) {
        $text = trim((string) ($row['bullet_text'] ?? ''));
        if ($text !== '') $out[] = $text;
    }
    return $out ?: $fallback;
};

$cards = [
    ['mod' => 'partner', 'title' => get_field('p1_title') ?: $d['p1_title'], 'desc' => get_field('p1_description') ?: $d['p1_desc'], 'rows' => $rows('p1_bullet_points', $d['p1_bullets'])],
    ['mod' => 'standalone', 'title' => get_field('p2_title') ?: $d['p2_title'], 'desc' => get_field('p2_description') ?: $d['p2_desc'], 'rows' => $rows('p2_bullet_points', $d['p2_bullets'])],
];
?>
<section class="ds-section ds-echos-compare" aria-labelledby="echos-compare-title">
    <div class="ds-container">
        <div class="ds-echos-head">
            <h2 class="ds-section__heading ds-section__heading--center" id="echos-compare-title"><?php echo esc_html($title); ?></h2>
            <?php if ($sub) : ?><p class="ds-echos-head__text"><?php echo esc_html($sub); ?></p><?php endif; ?>
        </div>

        <div class="ds-echos-compare__grid">
            <?php foreach ($cards as $card) : ?>
                <div class="ds-echos-compare__card ds-echos-compare__card--<?php echo esc_attr($card['mod']); ?>">
                    <h3 class="ds-echos-compare__label"><?php echo esc_html($card['title']); ?></h3>
                    <?php if ($card['desc']) : ?><p class="ds-echos-compare__desc"><?php echo esc_html($card['desc']); ?></p><?php endif; ?>
                    <ul class="ds-echos-compare__list">
                        <?php foreach ($card['rows'] as $row) : ?>
                            <li>
                                <svg class="ds-echos-compare__icon" viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><circle cx="12" cy="12" r="12" fill="url(#ds-echos-gradient-gold)"/><path d="M7 12.5l3.2 3.2L17 9" fill="none" stroke="#111625" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span><?php echo ds_echos_inline($row); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
