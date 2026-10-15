<?php
/**
 * DSD: Closing call to action (group_dsd_testimonials > CTA fields).
 *
 * The Global CTA layout (Theme Settings > Global CTA: background and the
 * icon feature list on the right) with this page's own heading, text and
 * button on the left. Empty fields fall back to the DSD launch copy.
 */
$d        = ds_dsd_defaults('cta');
$heading  = get_field('cta_heading') ?: $d['heading'];
$text     = get_field('cta_text') ?: $d['text'];
$btn      = ds_aec_link(get_field('cta_button'), $d['btn']) ?: ['url' => $d['url'], 'title' => $d['btn'], 'target' => ''];
$bg       = get_field('gcta_bg', 'option');
$features = get_field('gcta_features', 'option');
?>
<section class="ds-section ds-section--cta-banner ds-cta-split ds-dsd-cta"
    <?php echo $bg ? 'style="background-image:url(' . esc_url($bg['url']) . ');background-size:cover;background-position:center;"' : ''; ?>>

    <?php if ($bg) : ?>
        <div class="ds-cta-banner__overlay"></div>
    <?php endif; ?>

    <div class="ds-container ds-cta-split__inner">
        <div class="ds-cta-split__left">
            <h3 class="ds-section__heading"><?php echo esc_html($heading); ?></h3>
            <?php if ($text) : ?>
                <p class="ds-cta-split__text"><?php echo nl2br(esc_html($text)); ?></p>
            <?php endif; ?>
            <?php if ($btn['url']) : ?>
                <div class="ds-cta-buttons ds-cta-buttons--left">
                    <a href="<?php echo esc_url($btn['url']); ?>" class="ds-btn ds-btn--primary"<?php ds_aec_target_attrs($btn['target']); ?>><?php echo esc_html($btn['title']); ?></a>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($features) : ?>
            <div class="ds-cta-split__right">
                <?php foreach ($features as $f) : ?>
                    <div class="ds-cta-feature">
                        <?php if (!empty($f['icon'])) : ?>
                            <div class="ds-cta-feature__icon"><?php echo ds_inline_svg($f['icon']); ?></div>
                        <?php endif; ?>
                        <div class="ds-cta-feature__body">
                            <?php if (!empty($f['title'])) : ?>
                                <h6 class="ds-cta-feature__title"><?php echo esc_html($f['title']); ?></h6>
                            <?php endif; ?>
                            <?php if (!empty($f['description'])) : ?>
                                <p class="ds-cta-feature__text"><?php echo esc_html($f['description']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
