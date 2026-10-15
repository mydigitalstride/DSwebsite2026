<?php
/**
 * ECHO SEO: 3-step integration process (s6_* fields).
 *
 * The site action-plan step cards (label, title, text, arrows between
 * cards) in a single row, each with an icon, then a stand-alone button that
 * links to the ECHO SEO site or download page. Cards stack on phones.
 */
$d     = ds_echos_defaults('steps');
$title = get_field('s6_headline') ?: $d['headline'];
$btn   = ds_echos_button('s6_bottom_button', $d['button']);
$steps = [];

foreach ((array) (get_field('s6_steps') ?: []) as $row) {
    if (trim((string) ($row['step_title'] ?? '')) === '') continue;
    $steps[] = [
        'number'      => $row['step_number'] ?? '',
        'icon'        => $row['step_icon'] ?? null,
        'fa'          => '',
        'title'       => $row['step_title'],
        'description' => $row['step_description'] ?? '',
    ];
}
if (!$steps) $steps = $d['steps'];
?>
<section class="ds-section ds-echos-steps" aria-labelledby="echos-steps-title">
    <div class="ds-container">
        <div class="ds-echos-head">
            <h2 class="ds-section__heading ds-section__heading--center" id="echos-steps-title"><?php echo esc_html($title); ?></h2>
        </div>

        <ol class="ds-echos-steps__row">
            <?php foreach ($steps as $i => $step) : ?>
                <?php if ($i > 0) : ?>
                    <li class="ds-echos-steps__arrow" aria-hidden="true"><i class="fa-solid fa-angles-right"></i></li>
                <?php endif; ?>
                <li class="ds-echos-step">
                    <?php echo ds_echos_icon($step['icon'], $step['fa'], 'ds-echos-step__icon'); ?>
                    <?php if ($step['number']) : ?><p class="ds-echos-step__label"><?php echo esc_html($step['number']); ?></p><?php endif; ?>
                    <h3 class="ds-echos-step__title"><?php echo esc_html($step['title']); ?></h3>
                    <?php if ($step['description']) : ?><p class="ds-echos-step__text"><?php echo esc_html($step['description']); ?></p><?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ol>

        <?php if ($btn) : ?>
            <div class="ds-echos-solo-cta"><?php ds_echos_print_button($btn, 'ds-btn ds-echos-btn'); ?></div>
        <?php endif; ?>
    </div>
</section>
