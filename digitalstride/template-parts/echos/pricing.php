<?php
/**
 * ECHO SEO: Plans & pricing (s5_* fields).
 *
 * The Services Overview pricing feature table (ds-pft__*: desktop table,
 * one card per plan on phones) for a single product, with the plan price
 * in each column head and a button under each plan: "Download" for Free,
 * "Get ECHO SEO Premium" for Premium. Premium is the gold column.
 */
$d     = ds_echos_defaults('pricing');
$kick  = get_field('s5_kicker') ?: $d['kicker'];
$title = get_field('s5_headline') ?: $d['headline'];
$col1  = get_field('s5_col1_header') ?: $d['col1_header'];

$plans = [
    ['mod' => 'free', 'name' => get_field('s5_col2_header') ?: $d['col2_header'], 'price' => get_field('s5_col2_price') ?: $d['col2_price'], 'btn' => ds_echos_button('s5_col2_button', $d['col2_button']), 'btn_class' => 'ds-btn ds-echos-btn ds-echos-btn--outline'],
    ['mod' => 'premium', 'name' => get_field('s5_col3_header') ?: $d['col3_header'], 'price' => get_field('s5_col3_price') ?: $d['col3_price'], 'btn' => ds_echos_button('s5_col3_button', $d['col3_button']), 'btn_class' => 'ds-btn ds-echos-btn'],
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
?>
<section class="ds-section ds-section--pft ds-echos-pricing" aria-labelledby="echos-pricing-title">
    <div class="ds-container">
        <div class="ds-echos-head">
            <?php if ($kick) : ?><p class="ds-echos-tag"><?php echo esc_html($kick); ?></p><?php endif; ?>
            <h2 class="ds-section__heading ds-section__heading--center" id="echos-pricing-title"><?php echo esc_html($title); ?></h2>
        </div>

        <!-- Desktop table -->
        <div class="ds-pft__table-wrap ds-pft__desktop">
            <table class="ds-pft__table ds-echos-pricing__table">
                <thead>
                    <tr>
                        <th class="ds-pft__col-feature" scope="col"><?php echo esc_html($col1); ?></th>
                        <?php foreach ($plans as $plan) : ?>
                            <th scope="col" class="ds-echos-pricing__plan ds-echos-pricing__plan--<?php echo esc_attr($plan['mod']); ?>">
                                <span class="ds-echos-pricing__name"><?php echo esc_html($plan['name']); ?></span>
                                <?php if ($plan['price']) : ?><span class="ds-echos-pricing__price"><?php echo esc_html($plan['price']); ?></span><?php endif; ?>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <th scope="row" class="ds-pft__col-feature"><?php echo esc_html($row['feature']); ?></th>
                            <td class="ds-pft__cell ds-echos-pricing__cell--free"><?php echo ds_echos_cell($row['col2'], $row['col2_text']); ?></td>
                            <td class="ds-pft__cell ds-echos-pricing__cell--premium"><?php echo ds_echos_cell($row['col3'], $row['col3_text']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="ds-pft__col-feature"></td>
                        <?php foreach ($plans as $plan) : ?>
                            <td class="ds-echos-pricing__action ds-echos-pricing__cell--<?php echo esc_attr($plan['mod']); ?>"><?php ds_echos_print_button($plan['btn'], $plan['btn_class']); ?></td>
                        <?php endforeach; ?>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Mobile plan cards -->
        <div class="ds-pft__mobile-cards">
            <?php foreach ($plans as $i => $plan) :
                $key = $i === 0 ? 'col2' : 'col3';
                ?>
                <div class="ds-pft-card ds-echos-pricing__card--<?php echo esc_attr($plan['mod']); ?>">
                    <div class="ds-pft-card__header">
                        <h3 class="ds-pft-card__tier"><?php echo esc_html($plan['name']); ?></h3>
                        <?php if ($plan['price']) : ?><p class="ds-echos-pricing__card-price"><?php echo esc_html($plan['price']); ?></p><?php endif; ?>
                    </div>
                    <ul class="ds-pft-card__list">
                        <?php foreach ($rows as $row) :
                            $type = $row[$key];
                            $text = trim((string) $row[$key . '_text']);
                            $mod  = ($type === 'text' && $text !== '') ? 'text' : ($type === 'check' ? 'yes' : 'no');
                            ?>
                            <li class="ds-pft-card__item ds-pft-card__item--<?php echo esc_attr($mod); ?>">
                                <span class="ds-pft-card__feature"><?php echo esc_html($row['feature']); ?></span>
                                <span class="ds-pft-card__val ds-pft-card__val--<?php echo esc_attr($mod === 'text' ? 'custom' : $mod); ?>"><?php echo ds_echos_cell($type, $text); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php if ($plan['btn']) : ?>
                        <div class="ds-echos-pricing__card-action"><?php ds_echos_print_button($plan['btn'], $plan['btn_class']); ?></div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
