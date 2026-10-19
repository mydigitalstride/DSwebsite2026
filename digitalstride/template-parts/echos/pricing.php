<?php
/**
 * ECHO SEO: Plans & price (s5_* fields).
 *
 * The Pricing Feature Table used on the service pages
 * (flex-pricing_feature_table.php, ds-pft__* styles in main.css) for a
 * single product, so no tabs: plan columns with the orange gradient check
 * or the muted "no" icon per feature, then a closing row with each plan's
 * price (Premium can show a struck-through original price) and its button:
 * "Download" for the free plan, "Get ECHO SEO Premium" for Premium. On
 * phones the table becomes the site's plan cards.
 */
$d     = ds_echos_defaults('pricing');
$kick  = get_field('s5_kicker') ?: $d['kicker'];
$title = get_field('s5_headline') ?: $d['headline'];
$col1  = get_field('s5_col1_header') ?: $d['col1_header'];
$was   = trim((string) get_field('s5_col3_original_price')) ?: $d['col3_was'];
if ($was === '-') $was = '';

$plans = [
    ['key' => 'col2', 'name' => get_field('s5_col2_header') ?: $d['col2_header'], 'was' => '', 'price' => get_field('s5_col2_price') ?: $d['col2_price'], 'btn' => ds_echos_button('s5_col2_button', $d['col2_button']), 'btn_class' => 'ds-btn ds-btn--outline'],
    ['key' => 'col3', 'name' => get_field('s5_col3_header') ?: $d['col3_header'], 'was' => $was, 'price' => get_field('s5_col3_price') ?: $d['col3_price'], 'btn' => ds_echos_button('s5_col3_button', $d['col3_button']), 'btn_class' => 'ds-btn ds-btn--primary'],
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

// check | no | text, as the pricing feature table reads "yes" / "no" / text.
$kind = function ($row, $key) {
    $text = trim((string) $row[$key . '_text']);
    if ($row[$key] === 'text' && $text !== '') return ['text', $text];
    return [$row[$key] === 'check' ? 'yes' : 'no', ''];
};
$price = function ($plan) {
    if ($plan['was']) echo '<s class="ds-echos-pricing__was">' . esc_html($plan['was']) . '</s>';
    if ($plan['price']) echo '<span class="ds-pft__text ds-echos-pricing__price">' . esc_html($plan['price']) . '</span>';
};
?>
<section class="ds-section ds-section--pft ds-echos-pricing" aria-labelledby="echos-pricing-title">
    <div class="ds-container">
        <div class="ds-echos-head">
            <?php if ($kick) : ?><p class="ds-aec-tag"><?php echo esc_html($kick); ?></p><?php endif; ?>
            <h2 class="ds-section__heading ds-section__heading--center" id="echos-pricing-title"><?php echo esc_html($title); ?></h2>
        </div>

        <!-- Desktop table -->
        <div class="ds-pft__table-wrap ds-pft__desktop">
            <table class="ds-pft__table">
                <thead>
                    <tr>
                        <th class="ds-pft__col-feature"><?php echo esc_html($col1); ?></th>
                        <?php foreach ($plans as $plan) : ?>
                            <th><?php echo esc_html($plan['name']); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td class="ds-pft__col-feature"><?php echo esc_html($row['feature']); ?></td>
                            <?php foreach ($plans as $plan) :
                                [$type, $text] = $kind($row, $plan['key']);
                                ?>
                                <td class="ds-pft__cell">
                                    <?php if ($type === 'yes') : ?>
                                        <span class="ds-pft__check" aria-label="<?php esc_attr_e('Included', 'digitalstride'); ?>">
                                            <svg viewBox="0 0 512 512" width="22" height="22" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                                <path fill="url(#ds-gradient-orange)" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/>
                                            </svg>
                                        </span>
                                    <?php elseif ($type === 'no') : ?>
                                        <span class="ds-pft__no" aria-label="<?php esc_attr_e('Not included', 'digitalstride'); ?>"><i class="fa-solid fa-ban" aria-hidden="true"></i></span>
                                    <?php else : ?>
                                        <span class="ds-pft__text"><?php echo esc_html($text); ?></span>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="ds-echos-pricing__plans">
                        <td class="ds-pft__col-feature"></td>
                        <?php foreach ($plans as $plan) : ?>
                            <td class="ds-pft__cell">
                                <?php $price($plan); ?>
                                <?php ds_echos_print_button($plan['btn'], $plan['btn_class'] . ' ds-echos-pricing__btn'); ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Mobile plan cards -->
        <div class="ds-pft__mobile-cards">
            <?php foreach ($plans as $plan) : ?>
                <div class="ds-pft-card">
                    <div class="ds-pft-card__header">
                        <h3 class="ds-pft-card__tier"><?php echo esc_html($plan['name']); ?></h3>
                    </div>
                    <ul class="ds-pft-card__list">
                        <?php foreach ($rows as $row) :
                            [$type, $text] = $kind($row, $plan['key']);
                            ?>
                            <li class="ds-pft-card__item ds-pft-card__item--<?php echo esc_attr($type); ?>">
                                <span class="ds-pft-card__feature"><?php echo esc_html($row['feature']); ?></span>
                                <?php if ($type === 'yes') : ?>
                                    <span class="ds-pft-card__val ds-pft-card__val--yes"><i class="fa-solid fa-check" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e('Included', 'digitalstride'); ?></span></span>
                                <?php elseif ($type === 'no') : ?>
                                    <span class="ds-pft-card__val ds-pft-card__val--no"><i class="fa-solid fa-ban" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e('Not included', 'digitalstride'); ?></span></span>
                                <?php else : ?>
                                    <span class="ds-pft-card__val ds-pft-card__val--custom"><?php echo esc_html($text); ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="ds-echos-pricing__card-foot">
                        <?php $price($plan); ?>
                        <?php ds_echos_print_button($plan['btn'], $plan['btn_class'] . ' ds-echos-pricing__btn'); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
