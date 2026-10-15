<?php
/**
 * ECHO SEO: Call to action (cta_* fields).
 *
 * The Global CTA layout (brand gradient over the background, heading with
 * the yellow-orange bar, solid + outline buttons, icon highlights on the
 * right) with this page's own copy and buttons. Empty highlights and
 * background fall back to Theme Settings > Global CTA, then to launch
 * highlights with Font Awesome icons.
 */
$d     = ds_echos_defaults('cta');
$title = get_field('cta_headline') ?: $d['headline'];
$text  = get_field('cta_subtext') ?: $d['subtext'];
$btn1  = ds_echos_button('cta_button_primary', $d['primary']);
$btn2  = ds_echos_button('cta_button_secondary', $d['secondary']);
$bg    = get_field('cta_background_image') ?: get_field('gcta_bg', 'option');
$items = [];

foreach ((array) (get_field('cta_right_features') ?: []) as $row) {
    if (trim((string) ($row['feature_title'] ?? '')) === '') continue;
    $items[] = ['icon' => $row['feature_icon'] ?? null, 'fa' => '', 'title' => $row['feature_title'], 'desc' => $row['feature_desc'] ?? ''];
}
if (!$items) {
    foreach ((array) (get_field('gcta_features', 'option') ?: []) as $row) {
        if (empty($row['title'])) continue;
        $items[] = ['icon' => $row['icon'] ?? null, 'fa' => '', 'title' => $row['title'], 'desc' => $row['description'] ?? ''];
    }
}
if (!$items) $items = $d['features'];
?>
<section class="ds-section ds-section--cta-banner ds-cta-split ds-echos-cta"
    <?php echo !empty($bg['url']) ? 'style="background-image:url(' . esc_url($bg['url']) . ');background-size:cover;background-position:center;"' : ''; ?>>

    <div class="ds-cta-banner__overlay"></div>

    <div class="ds-container ds-cta-split__inner">
        <div class="ds-cta-split__left">
            <h3 class="ds-section__heading"><?php echo esc_html($title); ?></h3>
            <?php if ($text) : ?>
                <p class="ds-cta-split__text"><?php echo nl2br(esc_html($text)); ?></p>
            <?php endif; ?>
            <?php if ($btn1 || $btn2) : ?>
                <div class="ds-cta-buttons ds-cta-buttons--left">
                    <?php ds_echos_print_button($btn1, 'ds-btn ds-btn--primary'); ?>
                    <?php ds_echos_print_button($btn2, 'ds-btn ds-btn--outline'); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="ds-cta-split__right">
            <?php foreach ($items as $item) : ?>
                <div class="ds-cta-feature">
                    <?php if (!empty($item['icon'])) : ?>
                        <div class="ds-cta-feature__icon"><?php echo ds_inline_svg($item['icon']); ?></div>
                    <?php elseif (!empty($item['fa'])) : ?>
                        <div class="ds-cta-feature__icon ds-echos-cta__fa"><i class="<?php echo esc_attr($item['fa']); ?>" aria-hidden="true"></i></div>
                    <?php endif; ?>
                    <div class="ds-cta-feature__body">
                        <h6 class="ds-cta-feature__title"><?php echo esc_html($item['title']); ?></h6>
                        <?php if (!empty($item['desc'])) : ?>
                            <p class="ds-cta-feature__text"><?php echo esc_html($item['desc']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
