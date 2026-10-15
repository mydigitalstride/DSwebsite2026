<?php
/**
 * ECHO SEO: 3-step integration process (s6_* fields).
 *
 * Left-aligned heading with the orange accent line (as in the hero), three
 * slate step cards joined by yellow chevrons, then a centred primary button
 * that links to the ECHO SEO site or download page. A step flagged
 * `is_highlighted` gets the orange border. Cards stack on phones.
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
if (!$steps) $steps = $d['steps'];
$gid = 'ds-echos-gear-' . wp_unique_id();
?>
<section class="ds-section ds-echos-steps" aria-labelledby="echos-steps-title">
    <div class="ds-container">
        <div class="ds-echos-steps__head">
            <div class="ds-hero__accent-line" aria-hidden="true"></div>
            <h2 class="ds-echos-steps__title" id="echos-steps-title"><?php echo esc_html($title); ?></h2>
        </div>

        <ol class="ds-echos-steps__row">
            <?php foreach ($steps as $i => $step) : ?>
                <?php if ($i > 0) : ?>
                    <li class="ds-echos-steps__arrow" aria-hidden="true">
                        <svg viewBox="0 0 48 24" width="48" height="24"><path d="M3 3l9 9-9 9M17 3l9 9-9 9M31 3l9 9-9 9" fill="none" stroke="currentColor" stroke-width="4.5" stroke-linejoin="miter"/></svg>
                    </li>
                <?php endif; ?>
                <li class="ds-echos-step<?php echo $step['highlight'] ? ' is-highlighted' : ''; ?>">
                    <span class="ds-echos-step__icon">
                        <?php if (!empty($step['icon']['url'])) : ?>
                            <?php echo ds_inline_svg($step['icon']); ?>
                        <?php else : ?>
                            <svg viewBox="0 0 64 64" aria-hidden="true">
                                <defs>
                                    <linearGradient id="<?php echo esc_attr($gid . '-' . $i); ?>" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" stop-color="#F36E21"/>
                                        <stop offset="100%" stop-color="#0993BF"/>
                                    </linearGradient>
                                </defs>
                                <path fill="none" stroke="url(#<?php echo esc_attr($gid . '-' . $i); ?>)" stroke-width="2.5" stroke-linejoin="round" d="M28 4h8l1.5 7 5 2 6-4 5.5 5.5-4 6 2 5 7 1.5v8l-7 1.5-2 5 4 6-5.5 5.5-6-4-5 2L36 60h-8l-1.5-7-5-2-6 4-5.5-5.5 4-6-2-5L4 36v-8l7-1.5 2-5-4-6L14.5 9l6 4 5-2z"/>
                                <circle cx="32" cy="32" r="13" fill="none" stroke="url(#<?php echo esc_attr($gid . '-' . $i); ?>)" stroke-width="2.5"/>
                                <text x="32" y="38.5" text-anchor="middle" font-family="'Josefin Sans', sans-serif" font-size="17" font-weight="600" fill="#F2F5FB"><?php echo (int) ($i + 1); ?></text>
                            </svg>
                        <?php endif; ?>
                    </span>
                    <?php if ($step['number']) : ?><p class="ds-echos-step__label"><?php echo esc_html($step['number']); ?></p><?php endif; ?>
                    <h3 class="ds-echos-step__title"><?php echo esc_html($step['title']); ?></h3>
                    <?php if ($step['description']) : ?><p class="ds-echos-step__text"><?php echo esc_html($step['description']); ?></p><?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ol>

        <?php if ($btn) : ?>
            <div class="ds-echos-solo-cta"><?php ds_echos_print_button($btn, 'ds-btn ds-btn--primary'); ?></div>
        <?php endif; ?>
    </div>
</section>
