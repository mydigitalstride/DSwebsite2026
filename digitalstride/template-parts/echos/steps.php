<?php
/**
 * ECHO SEO: 3-step integration process (s6_* fields).
 *
 * The Action Plan component used on the service pages
 * (flex-action_plan.php, ds-action-plan__* styles in main.css): section
 * heading, one row of step cards joined by orange arrows (a highlighted
 * step gets the orange border), the closed accordion on phones, then a
 * centred primary button linking to the ECHO SEO site or download page.
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
        'title'       => $row['step_title'],
        'description' => $row['step_description'] ?? '',
        'highlight'   => !empty($row['is_highlighted']),
    ];
}
$steps = $steps ? ds_echos_fill_rows($steps, $d['steps'], 'title', ['description']) : $d['steps'];
$label = function ($step) {
    return trim(implode(': ', array_filter([trim((string) $step['number']), trim((string) $step['title'])])));
};
?>
<section class="ds-section ds-section--action-plan ds-echos-steps">
    <div class="ds-container">
        <h2 class="ds-section__heading"><?php echo esc_html($title); ?></h2>

        <!-- Desktop: one row of cards -->
        <div class="ds-action-plan ds-action-plan--desktop">
            <div class="ds-action-plan__row">
                <?php foreach ($steps as $i => $step) : ?>
                    <div class="ds-action-plan__card<?php echo $step['highlight'] ? ' is-highlighted' : ''; ?>">
                        <?php if (!empty($step['icon']['url'])) : ?>
                            <div class="ds-echos-steps__icon"><?php echo ds_inline_svg($step['icon']); ?></div>
                        <?php endif; ?>
                        <?php if ($step['number']) : ?><h6 class="ds-action-plan__step-label"><?php echo esc_html($step['number']); ?></h6><?php endif; ?>
                        <h3 class="ds-echos-steps__title"><?php echo esc_html($step['title']); ?></h3>
                        <?php if ($step['description']) : ?>
                            <p class="ds-action-plan__desc"><?php echo esc_html($step['description']); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ($i < count($steps) - 1) : ?>
                        <div class="ds-action-plan__arrow">
                            <i class="fa-solid fa-angles-right" aria-hidden="true"></i>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Mobile accordion -->
        <div class="ds-action-plan--mobile ds-accordion">
            <?php foreach ($steps as $step) : ?>
                <div class="ds-accordion__item">
                    <button class="ds-accordion__header" aria-expanded="false">
                        <span><?php echo esc_html($label($step)); ?></span>
                        <i class="fa-solid fa-chevron-down ds-accordion__chevron" aria-hidden="true"></i>
                    </button>
                    <div class="ds-accordion__body">
                        <?php if ($step['description']) : ?>
                            <p class="ds-action-plan__desc"><?php echo esc_html($step['description']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($btn) : ?>
            <div class="ds-section__cta"><?php ds_echos_print_button($btn, 'ds-btn ds-btn--primary'); ?></div>
        <?php endif; ?>
    </div>
</section>
