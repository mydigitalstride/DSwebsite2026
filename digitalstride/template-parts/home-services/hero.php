<?php
/**
 * Home Services: Hero (hero_* fields).
 */
$d       = ds_hs_defaults('hero');
$tag     = get_field('hero_tag') ?: $d['tag'];
$heading = get_field('hero_headline') ?: $d['headline'];
$text    = get_field('hero_subtext') ?: $d['subtext'];
$bg      = get_field('hero_bg_image');
$btn1    = ds_aec_link(get_field('hero_primary_cta_link') ?: $d['primary']['url'], get_field('hero_primary_cta_label') ?: $d['primary']['title']);
$btn2    = ds_aec_link(get_field('hero_secondary_cta_link') ?: $d['secondary']['url'], get_field('hero_secondary_cta_label') ?: $d['secondary']['title']);
// The label fields win over a link's own title.
if ($btn1 && get_field('hero_primary_cta_label')) $btn1['title'] = get_field('hero_primary_cta_label');
if ($btn2 && get_field('hero_secondary_cta_label')) $btn2['title'] = get_field('hero_secondary_cta_label');
?>
<section class="ds-hero ds-aec-hero ds-hs-hero"<?php if (!empty($bg['url'])) : ?> style="background-image:url(<?php echo esc_url($bg['url']); ?>)"<?php endif; ?>>
    <div class="ds-hero__overlay"></div>
    <div class="ds-container ds-hero__inner">
        <div class="ds-hero__content">
            <div class="ds-hero__title-block">
                <div class="ds-hero__accent-line"></div>
                <div class="ds-hero__title-text">
                    <?php if ($tag) : ?>
                        <p class="ds-hero__subheading ds-aec-hero__tag"><?php echo esc_html($tag); ?></p>
                    <?php endif; ?>
                    <h1 class="ds-hero__heading"><?php echo esc_html($heading); ?></h1>
                    <?php if ($text) : ?>
                        <div class="ds-hero__text"><?php echo wp_kses_post(wpautop($text)); ?></div>
                    <?php endif; ?>
                    <?php if ($btn1 || $btn2) : ?>
                        <div class="ds-aec-hero__buttons">
                            <?php if ($btn1) : ?>
                                <a href="<?php echo esc_url($btn1['url']); ?>" class="ds-btn ds-btn--primary ds-btn--hero"<?php ds_aec_target_attrs($btn1['target']); ?>><?php echo esc_html($btn1['title']); ?></a>
                            <?php endif; ?>
                            <?php if ($btn2) : ?>
                                <a href="<?php echo esc_url($btn2['url']); ?>" class="ds-btn ds-btn--outline ds-btn--hero"<?php ds_aec_target_attrs($btn2['target']); ?>><?php echo esc_html($btn2['title']); ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
