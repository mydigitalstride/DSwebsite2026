<?php
/**
 * ECHO SEO: Tailored value comparison (s3_*, p1_*, p2_* fields).
 *
 * The DSD comparison cards: heading with the orange bar, intro, then two
 * slate cards, each with a label, a short description and a list of bold
 * points with a line of text. Left (partner) card uses the DSD blue label
 * and blue gradient checks; right (standalone) card uses ECHO yellow.
 */
$d     = ds_echos_defaults('compare');
$title = get_field('s3_headline') ?: $d['headline'];
$sub   = get_field('s3_subheadline') ?: $d['subheadline'];

$rows = function ($name, $fallback) {
    $out = [];
    foreach ((array) (get_field($name) ?: []) as $row) {
        $title = trim((string) ($row['bullet_text'] ?? ''));
        if ($title !== '') $out[] = ['title' => $title, 'desc' => trim((string) ($row['bullet_desc'] ?? ''))];
    }
    return $out ?: $fallback;
};

$cards = [
    ['mod' => 'partner', 'title' => get_field('p1_title') ?: $d['p1_title'], 'desc' => get_field('p1_description') ?: $d['p1_desc'], 'rows' => $rows('p1_bullet_points', $d['p1_bullets']), 'fill' => 'url(#ds-gradient-blue)', 'stroke' => '#F2F5FB'],
    ['mod' => 'echo', 'title' => get_field('p2_title') ?: $d['p2_title'], 'desc' => get_field('p2_description') ?: $d['p2_desc'], 'rows' => $rows('p2_bullet_points', $d['p2_bullets']), 'fill' => '#F5B800', 'stroke' => '#1d2537'],
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
                                <svg class="ds-echos-compare__icon" viewBox="0 0 24 24" width="22" height="22" aria-hidden="true"><circle cx="12" cy="12" r="12" fill="<?php echo esc_attr($card['fill']); ?>"/><path d="M7 12.5l3.2 3.2L17 9" fill="none" stroke="<?php echo esc_attr($card['stroke']); ?>" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <div>
                                    <strong><?php echo esc_html($row['title']); ?></strong>
                                    <?php if (!empty($row['desc'])) : ?><span><?php echo esc_html($row['desc']); ?></span><?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
