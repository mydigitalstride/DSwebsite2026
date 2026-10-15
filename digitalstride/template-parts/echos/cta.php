<?php
/**
 * ECHO SEO: Call to action (cta_* fields).
 *
 * This page's own CTA, not the Global CTA: the site split CTA layout with
 * headline, text and two buttons (solid + outline) on the left and the
 * feature highlights list on the right, over the page's own background.
 */
$d     = ds_echos_defaults('cta');
$title = get_field('cta_headline') ?: $d['headline'];
$text  = get_field('cta_subtext') ?: $d['subtext'];
$btn1  = ds_echos_button('cta_button_primary', $d['primary']);
$btn2  = ds_echos_button('cta_button_secondary', $d['secondary']);
$bg    = get_field('cta_background_image');
$items = [];

foreach ((array) (get_field('cta_right_features') ?: []) as $row) {
    if (trim((string) ($row['feature_title'] ?? '')) === '') continue;
    $items[] = ['icon' => $row['feature_icon'] ?? null, 'fa' => 'fa-solid fa-check', 'title' => $row['feature_title'], 'desc' => $row['feature_desc'] ?? ''];
}
if (!$items) $items = $d['features'];
?>
<section class="ds-section ds-cta-split ds-echos-cta"<?php if (!empty($bg['url'])) : ?> style="background-image:url(<?php echo esc_url($bg['url']); ?>)"<?php endif; ?>>
    <div class="ds-echos-cta__overlay"></div>

    <div class="ds-container ds-cta-split__inner ds-echos-cta__inner">
        <div class="ds-cta-split__left">
            <h2 class="ds-section__heading ds-echos-cta__title"><?php echo esc_html($title); ?></h2>
            <?php if ($text) : ?>
                <p class="ds-cta-split__text"><?php echo nl2br(esc_html($text)); ?></p>
            <?php endif; ?>
            <?php if ($btn1 || $btn2) : ?>
                <div class="ds-cta-buttons ds-cta-buttons--left">
                    <?php ds_echos_print_button($btn1, 'ds-btn ds-echos-btn'); ?>
                    <?php ds_echos_print_button($btn2, 'ds-btn ds-echos-btn ds-echos-btn--outline'); ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($items) : ?>
            <ul class="ds-cta-split__right ds-echos-cta__features">
                <?php foreach ($items as $item) : ?>
                    <li class="ds-cta-feature">
                        <?php echo ds_echos_icon($item['icon'], $item['fa'], 'ds-cta-feature__icon ds-echos-cta__icon'); ?>
                        <div class="ds-cta-feature__body">
                            <h3 class="ds-cta-feature__title"><?php echo esc_html($item['title']); ?></h3>
                            <?php if (!empty($item['desc'])) : ?>
                                <p class="ds-cta-feature__text"><?php echo esc_html($item['desc']); ?></p>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>
