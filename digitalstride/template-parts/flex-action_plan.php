<?php
/**
 * Flex Layout: Action Plan
 * Desktop: 3-column snake grid.
 *   Row 1 (odd rows):  Step 1 → Step 2 → Step 3  (arrows point right)
 *   Down connector:    right-aligned ↓ icon between rows
 *   Row 2 (even rows): Step 6 ← Step 5 ← Step 4  (PHP reverses, arrows point left)
 * Mobile: closed accordion, one step per item.
 */
$heading = get_sub_field('heading');
$steps   = [];

if (have_rows('steps')) :
    while (have_rows('steps')) : the_row();
        $raw = get_sub_field('bullets') ?: '';
        $bullets = array_filter(array_map('trim', explode("\n", $raw)));
        $steps[] = [
            'label'       => get_sub_field('step_label'),
            'description' => get_sub_field('description'),
            'bullets'     => array_values($bullets),
            'highlight'   => get_sub_field('highlight'),
        ];
    endwhile;
endif;

if (!$steps) return;

$rows = array_chunk($steps, 3);
?>

<section class="ds-section ds-section--action-plan">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <!-- Desktop snake grid -->
        <div class="ds-action-plan ds-action-plan--desktop">
            <?php foreach ($rows as $row_i => $row) :
                // Even rows (0, 2…) go left→right. Odd rows (1, 3…) reverse so the
                // snake reads right→left: last step of row N is on the FAR RIGHT,
                // so the column immediately below Step 3 is Step 4.
                $reversed     = ($row_i % 2 === 1);
                $display_row  = $reversed ? array_reverse(array_values($row)) : array_values($row);
                $arrow_icon   = $reversed ? 'fa-angles-left' : 'fa-angles-right';
            ?>

                <?php if ($row_i > 0) : ?>
                    <!-- Down connector — anchored to far right (under last col of prev row) -->
                    <div class="ds-action-plan__connector">
                        <i class="fa-solid fa-angles-down ds-action-plan__down-icon"></i>
                    </div>
                <?php endif; ?>

                <div class="ds-action-plan__row">
                    <?php foreach ($display_row as $s_i => $step) : ?>

                        <div class="ds-action-plan__card <?php echo $step['highlight'] ? 'is-highlighted' : ''; ?>">
                            <h6 class="ds-action-plan__step-label"><?php echo esc_html($step['label']); ?></h6>
                            <?php if ($step['description']) : ?>
                                <p class="ds-action-plan__desc"><?php echo esc_html($step['description']); ?></p>
                            <?php endif; ?>
                            <?php if ($step['bullets']) : ?>
                                <ul class="ds-action-plan__bullets">
                                    <?php foreach ($step['bullets'] as $b) : ?>
                                        <li><?php echo esc_html($b); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>

                        <?php if ($s_i < count($display_row) - 1) : ?>
                            <div class="ds-action-plan__arrow">
                                <i class="fa-solid <?php echo $arrow_icon; ?>"></i>
                            </div>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </div>

            <?php endforeach; ?>
        </div>

        <!-- Mobile accordion -->
        <div class="ds-action-plan--mobile ds-accordion">
            <?php foreach ($steps as $step) : ?>
                <div class="ds-accordion__item">
                    <button class="ds-accordion__header" aria-expanded="false">
                        <span><?php echo esc_html($step['label']); ?></span>
                        <i class="fa-solid fa-chevron-down ds-accordion__chevron"></i>
                    </button>
                    <div class="ds-accordion__body">
                        <?php if ($step['description']) : ?>
                            <p class="ds-action-plan__desc"><?php echo esc_html($step['description']); ?></p>
                        <?php endif; ?>
                        <?php if ($step['bullets']) : ?>
                            <ul class="ds-action-plan__bullets">
                                <?php foreach ($step['bullets'] as $b) : ?>
                                    <li><?php echo esc_html($b); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
