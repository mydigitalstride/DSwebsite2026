<?php
/**
 * Realtors 2: Why Top Agents Partner With Digital Stride (s2_* fields).
 * Two-column comparison: warning triangles vs. orange gradient checks
 * (the gradient is the #ds-gradient-orange def in footer.php).
 * Yellow/orange heading bar.
 */
$d    = ds_rlt_defaults('comparison');
$f    = function ($name, $key) use ($d) { return get_field($name) ?: $d[$key]; };
$rows = ds_rlt_rows('s2_comparison_rows', $d['rows'], ['bad_point_text', 'good_point_text']);
if (!$rows) return;

$col1 = $f('s2_col1_heading', 'col1_heading');
$col2 = $f('s2_col2_heading', 'col2_heading');
?>
<section class="ds-section ds-rlt-compare">
    <div class="ds-container">
        <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($f('s2_title', 'title')); ?></h2>

        <table class="ds-rlt-compare__table">
            <thead>
                <tr>
                    <th scope="col" class="ds-rlt-compare__head">
                        <span class="ds-rlt-compare__heading"><?php echo esc_html($col1); ?></span>
                        <span class="ds-rlt-compare__sub"><?php echo esc_html($f('s2_col1_subheading', 'col1_subheading')); ?></span>
                    </th>
                    <th scope="col" class="ds-rlt-compare__head">
                        <span class="ds-rlt-compare__heading"><?php echo esc_html($col2); ?></span>
                        <span class="ds-rlt-compare__sub"><?php echo esc_html($f('s2_col2_subheading', 'col2_subheading')); ?></span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td class="ds-rlt-compare__cell ds-rlt-compare__cell--bad" data-label="<?php echo esc_attr($col1); ?>">
                            <?php if (!empty($row['bad_point_text'])) : ?>
                                <i class="fa-solid fa-triangle-exclamation ds-rlt-compare__icon" aria-hidden="true"></i>
                                <span><?php echo esc_html($row['bad_point_text']); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="ds-rlt-compare__cell ds-rlt-compare__cell--good" data-label="<?php echo esc_attr($col2); ?>">
                            <?php if (!empty($row['good_point_text'])) : ?>
                                <svg class="ds-rlt-compare__icon" viewBox="0 0 512 512" width="20" height="20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="url(#ds-gradient-orange)" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/>
                                </svg>
                                <span><?php echo esc_html($row['good_point_text']); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
