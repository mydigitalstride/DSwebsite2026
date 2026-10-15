<?php
/**
 * ECHO SEO: Plans & price (s5_* fields).
 *
 * Feature table from the mockup: teal frame, navy feature column, a plain
 * check or cross per plan and a closing row with each plan's price (the
 * Premium price in ECHO yellow, with an optional struck-through original)
 * and its button: "Download" for the free plan, "Get ECHO SEO Premium" for
 * Premium. On phones the table becomes one card per plan (the site pricing
 * table cards from main.css).
 */
$d     = ds_echos_defaults('pricing');
$kick  = get_field('s5_kicker') ?: $d['kicker'];
$title = get_field('s5_headline') ?: $d['headline'];
$col1  = get_field('s5_col1_header') ?: $d['col1_header'];
$was   = trim((string) get_field('s5_col3_original_price')) ?: $d['col3_was'];
if ($was === '-') $was = '';

$plans = [
    ['key' => 'col2', 'mod' => 'free', 'name' => get_field('s5_col2_header') ?: $d['col2_header'], 'was' => '', 'price' => get_field('s5_col2_price') ?: $d['col2_price'], 'btn' => ds_echos_button('s5_col2_button', $d['col2_button']), 'btn_class' => 'ds-btn ds-btn--outline'],
    ['key' => 'col3', 'mod' => 'premium', 'name' => get_field('s5_col3_header') ?: $d['col3_header'], 'was' => $was, 'price' => get_field('s5_col3_price') ?: $d['col3_price'], 'btn' => ds_echos_button('s5_col3_button', $d['col3_button']), 'btn_class' => 'ds-btn ds-btn--primary'],
];

$rows = [];
foreach ((array) (get_field('s5_table_rows') ?: []) as $row) {
    if (trim((string) ($row['feature_name'] ?? '')) === '') continue;
    $rows[] = [
        'feature'   => $row['feature_name'],
        'col2'      => $row['col2_value'] ?? 'check',
        'col2_text' => $row['col2_text'] ?? '',
        'col3'      => $row['col3_value'] ?? 'check',
        'col3_text' => $row['col3_text'] ?? '',
    ];
}
if (!$rows) $rows = $d['rows'];

$price = function ($plan, $class) {
    if ($plan['was']) echo '<s class="' . esc_attr($class) . '__was">' . esc_html($plan['was']) . '</s>';
    if ($plan['price']) echo '<span class="' . esc_attr($class) . '__price ' . esc_attr($class) . '__price--' . esc_attr($plan['mod']) . '">' . esc_html($plan['price']) . '</span>';
};
?>
<section class="ds-section ds-echos-pricing" aria-labelledby="echos-pricing-title">
    <div class="ds-container">
        <div class="ds-echos-head">
            <?php if ($kick) : ?><p class="ds-aec-tag"><?php echo esc_html($kick); ?></p><?php endif; ?>
            <h2 class="ds-section__heading ds-section__heading--center" id="echos-pricing-title"><?php echo esc_html($title); ?></h2>
        </div>

        <!-- Desktop table -->
        <div class="ds-echos-table-wrap">
            <table class="ds-echos-table">
                <thead>
                    <tr>
                        <th scope="col" class="ds-echos-table__feature"><?php echo esc_html($col1); ?></th>
                        <?php foreach ($plans as $plan) : ?>
                            <th scope="col"><?php echo esc_html($plan['name']); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <th scope="row" class="ds-echos-table__feature"><?php echo esc_html($row['feature']); ?></th>
                            <?php foreach ($plans as $plan) : ?>
                                <td><?php echo ds_echos_cell($row[$plan['key']], $row[$plan['key'] . '_text']); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="ds-echos-table__feature"></td>
                        <?php foreach ($plans as $plan) : ?>
                            <td class="ds-echos-table__plan">
                                <?php $price($plan, 'ds-echos-table'); ?>
                                <?php ds_echos_print_button($plan['btn'], $plan['btn_class'] . ' ds-echos-table__btn'); ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Mobile plan cards -->
        <div class="ds-pft__mobile-cards ds-echos-pricing__cards">
            <?php foreach ($plans as $plan) : ?>
                <div class="ds-pft-card">
                    <div class="ds-pft-card__header">
                        <h3 class="ds-pft-card__tier"><?php echo esc_html($plan['name']); ?></h3>
                    </div>
                    <ul class="ds-pft-card__list">
                        <?php foreach ($rows as $row) :
                            $type = $row[$plan['key']];
                            $text = trim((string) $row[$plan['key'] . '_text']);
                            $mod  = ($type === 'text' && $text !== '') ? 'text' : ($type === 'check' ? 'yes' : 'no');
                            ?>
                            <li class="ds-pft-card__item ds-pft-card__item--<?php echo esc_attr($mod); ?>">
                                <span class="ds-pft-card__feature"><?php echo esc_html($row['feature']); ?></span>
                                <span class="ds-pft-card__val ds-pft-card__val--<?php echo esc_attr($mod === 'text' ? 'custom' : $mod); ?>"><?php echo ds_echos_cell($type, $text); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="ds-echos-pricing__card-foot">
                        <?php $price($plan, 'ds-echos-table'); ?>
                        <?php ds_echos_print_button($plan['btn'], $plan['btn_class'] . ' ds-echos-table__btn'); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
