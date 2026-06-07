<?php
/**
 * Flex Layout: Global CTA Block
 * Pulls all content from Theme Settings → Global CTA options page.
 * Left: heading + accent line + body text + left-aligned buttons.
 * Right: icon / title / description feature list.
 */
$heading  = get_field('gcta_heading',  'option');
$text     = get_field('gcta_text',     'option');
$btn1     = get_field('gcta_btn1',     'option');
$btn2     = get_field('gcta_btn2',     'option');
$bg       = get_field('gcta_bg',       'option');
$features = get_field('gcta_features', 'option');
?>

<section class="ds-section ds-section--cta-banner ds-cta-split"
    <?php echo $bg ? 'style="background-image:url(' . esc_url($bg['url']) . ');background-size:cover;background-position:center;"' : ''; ?>>

    <?php if ($bg) : ?>
        <div class="ds-cta-banner__overlay"></div>
    <?php endif; ?>

    <div class="ds-container ds-cta-split__inner">

        <!-- Left: text + buttons -->
        <div class="ds-cta-split__left">
            <?php if ($heading) : ?>
                <h3 class="ds-section__heading"><?php echo esc_html($heading); ?></h3>
            <?php endif; ?>
            <?php if ($text) : ?>
                <p class="ds-cta-split__text"><?php echo nl2br(esc_html($text)); ?></p>
            <?php endif; ?>
            <div class="ds-cta-buttons ds-cta-buttons--left">
                <?php if ($btn1) : ?>
                    <a href="<?php echo esc_url($btn1['url']); ?>" class="ds-btn ds-btn--primary"><?php echo esc_html($btn1['title']); ?></a>
                <?php endif; ?>
                <?php if ($btn2) : ?>
                    <a href="<?php echo esc_url($btn2['url']); ?>" class="ds-btn ds-btn--outline"><?php echo esc_html($btn2['title']); ?></a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right: feature list -->
        <?php if ($features) : ?>
            <div class="ds-cta-split__right">
                <?php foreach ($features as $f) : ?>
                    <div class="ds-cta-feature">
                        <?php if (!empty($f['icon'])) : ?>
                            <div class="ds-cta-feature__icon">
                                <?php echo ds_inline_svg($f['icon']); ?>
                            </div>
                        <?php endif; ?>
                        <div class="ds-cta-feature__body">
                            <?php if ($f['title']) : ?>
                                <h6 class="ds-cta-feature__title"><?php echo esc_html($f['title']); ?></h6>
                            <?php endif; ?>
                            <?php if ($f['description']) : ?>
                                <p class="ds-cta-feature__text"><?php echo esc_html($f['description']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
