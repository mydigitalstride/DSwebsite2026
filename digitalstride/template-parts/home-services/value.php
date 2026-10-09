<?php
/**
 * Home Services: Value Beyond Marketing — "How We Help Home Service
 * Companies Scale" (group `hs_value_beyond_marketing`).
 *
 * Centred tag, heading and intro, then a 3-column row of icon cards. Icons
 * are uploaded SVG/images tinted with the brand blue gradient
 * (.ds-icon--blue-gradient); without an upload a Font Awesome icon is shown
 * in the same gradient.
 */
$d     = ds_hs_defaults('value');
$group = get_field('hs_value_beyond_marketing') ?: [];

$tag     = ($group['section_tag'] ?? '') ?: $d['section_tag'];
$heading = ($group['section_heading'] ?? '') ?: $d['section_heading'];
$intro   = ($group['intro_paragraph'] ?? '') ?: $d['intro_paragraph'];

$cards = [];
foreach ((array) ($group['value_cards'] ?? []) as $c) {
    $cards[] = [
        'icon'        => $c['card_icon'] ?? null,
        'fa'          => $c['card_icon_class'] ?? '',
        'title'       => $c['card_title'] ?? '',
        'description' => $c['card_description'] ?? '',
    ];
}
if (!$cards) $cards = $d['value_cards'];
$cards = array_filter($cards, function ($c) { return $c['title'] || $c['description']; });
?>
<section class="ds-section ds-hs-value">
    <div class="ds-container">
        <div class="ds-hs-value__intro">
            <?php if ($tag) : ?>
                <p class="ds-aec-tag"><?php echo esc_html($tag); ?></p>
            <?php endif; ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
            <?php if ($intro) : ?>
                <div class="ds-section__text ds-hs-value__text"><?php echo wp_kses_post(wpautop($intro)); ?></div>
            <?php endif; ?>
        </div>

        <?php if ($cards) : ?>
            <ul class="ds-hs-value__grid">
                <?php foreach ($cards as $c) : ?>
                    <li class="ds-hs-value-card">
                        <?php if (!empty($c['icon'])) : ?>
                            <div class="ds-hs-value-card__icon ds-icon--blue-gradient"><?php echo ds_inline_svg($c['icon']); ?></div>
                        <?php elseif (!empty($c['fa'])) : ?>
                            <div class="ds-hs-value-card__icon ds-hs-value-card__icon--fa"><i class="<?php echo esc_attr($c['fa']); ?>" aria-hidden="true"></i></div>
                        <?php endif; ?>
                        <?php if ($c['title']) : ?>
                            <h3 class="ds-hs-value-card__title"><?php echo esc_html($c['title']); ?></h3>
                        <?php endif; ?>
                        <?php if ($c['description']) : ?>
                            <p class="ds-hs-value-card__text"><?php echo esc_html($c['description']); ?></p>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>
