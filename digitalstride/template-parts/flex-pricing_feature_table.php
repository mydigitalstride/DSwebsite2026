<?php
/**
 * Flex Layout: Pricing Feature Table
 * Tabbed system: each tab is a service/product. Each tab shows a comparison
 * table with tier columns and feature rows. Values can be "yes", "no", or
 * any custom text (e.g. "$395", "15 Months", "4/Month").
 */
$heading    = get_sub_field('heading');
$disclaimer = get_sub_field('disclaimer');

$tabs = [];
if (have_rows('tabs')) :
    while (have_rows('tabs')) : the_row();
        $tier_names = array_filter([
            get_sub_field('tier_1_name'),
            get_sub_field('tier_2_name'),
            get_sub_field('tier_3_name'),
            get_sub_field('tier_4_name'),
        ]);
        $rows = [];
        if (have_rows('rows')) :
            while (have_rows('rows')) : the_row();
                $rows[] = [
                    'feature' => get_sub_field('feature_name'),
                    'values'  => [
                        get_sub_field('tier_1_value'),
                        get_sub_field('tier_2_value'),
                        get_sub_field('tier_3_value'),
                        get_sub_field('tier_4_value'),
                    ],
                ];
            endwhile;
        endif;
        $tabs[] = [
            'name'        => get_sub_field('tab_name'),
            'tier_names'  => array_values($tier_names),
            'rows'        => $rows,
            'cta'         => get_sub_field('cta_button'),
        ];
    endwhile;
endif;

if (!$tabs) return;
$tier_count = count($tabs[0]['tier_names']);
?>

<section class="ds-section ds-section--pft">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <!-- Tab buttons -->
        <div class="ds-pft__tabs" role="tablist">
            <?php foreach ($tabs as $i => $tab) : ?>
                <button class="ds-pft__tab <?php echo $i === 0 ? 'is-active' : ''; ?>"
                        role="tab"
                        aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                        aria-controls="pft-panel-<?php echo $i; ?>"
                        data-tab="<?php echo $i; ?>">
                    <?php echo esc_html($tab['name']); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Tab panels -->
        <?php foreach ($tabs as $i => $tab) : ?>
            <div class="ds-pft__panel <?php echo $i === 0 ? 'is-active' : ''; ?>"
                 role="tabpanel"
                 id="pft-panel-<?php echo $i; ?>"
                 aria-hidden="<?php echo $i === 0 ? 'false' : 'true'; ?>">

                <!-- Desktop table -->
                <div class="ds-pft__table-wrap ds-pft__desktop">
                    <table class="ds-pft__table">
                        <thead>
                            <tr>
                                <th class="ds-pft__col-feature">Service</th>
                                <?php foreach ($tab['tier_names'] as $tname) : ?>
                                    <th><?php echo esc_html($tname); ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tab['rows'] as $row) : ?>
                                <tr>
                                    <td class="ds-pft__col-feature"><?php echo esc_html($row['feature']); ?></td>
                                    <?php for ($t = 0; $t < count($tab['tier_names']); $t++) :
                                        $val = trim($row['values'][$t] ?? '');
                                        $lower = strtolower($val);
                                    ?>
                                        <td class="ds-pft__cell">
                                            <?php if ($lower === 'yes' || $lower === '✓') : ?>
                                                <span class="ds-pft__check" aria-label="Included">
                                                    <svg viewBox="0 0 512 512" width="22" height="22" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill="url(#ds-gradient-orange)" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/>
                                                    </svg>
                                                </span>
                                            <?php elseif ($lower === 'no' || $lower === '✗' || $lower === 'x' || $lower === '') : ?>
                                                <span class="ds-pft__no"><i class="fa-solid fa-ban"></i></span>
                                            <?php else : ?>
                                                <span class="ds-pft__text"><?php echo esc_html($val); ?></span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile tier cards -->
                <div class="ds-pft__mobile-cards">
                    <?php foreach ($tab['tier_names'] as $t => $tname) : ?>
                        <div class="ds-pft-card">
                            <div class="ds-pft-card__header">
                                <h3 class="ds-pft-card__tier"><?php echo esc_html($tname); ?></h3>
                            </div>
                            <ul class="ds-pft-card__list">
                                <?php foreach ($tab['rows'] as $row) :
                                    $val   = trim($row['values'][$t] ?? '');
                                    $lower = strtolower($val);
                                    $is_yes = ($lower === 'yes' || $lower === '✓');
                                    $is_no  = ($lower === 'no' || $lower === '✗' || $lower === 'x' || $lower === '');
                                ?>
                                    <li class="ds-pft-card__item <?php echo $is_yes ? 'ds-pft-card__item--yes' : ''; ?><?php echo $is_no ? 'ds-pft-card__item--no' : ''; ?><?php echo (!$is_yes && !$is_no) ? 'ds-pft-card__item--text' : ''; ?>">
                                        <span class="ds-pft-card__feature"><?php echo esc_html($row['feature']); ?></span>
                                        <?php if ($is_yes) : ?>
                                            <span class="ds-pft-card__val ds-pft-card__val--yes"><i class="fa-solid fa-check"></i></span>
                                        <?php elseif ($is_no) : ?>
                                            <span class="ds-pft-card__val ds-pft-card__val--no"><i class="fa-solid fa-ban"></i></span>
                                        <?php else : ?>
                                            <span class="ds-pft-card__val ds-pft-card__val--custom"><?php echo esc_html($val); ?></span>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($tab['cta']) : ?>
                    <div class="ds-pft__cta">
                        <a href="<?php echo esc_url($tab['cta']['url']); ?>" class="ds-btn ds-btn--primary"><?php echo esc_html($tab['cta']['title']); ?></a>
                    </div>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>

        <?php if ($disclaimer) : ?>
            <p class="ds-pft__disclaimer"><?php echo esc_html($disclaimer); ?></p>
        <?php endif; ?>
    </div>
</section>
