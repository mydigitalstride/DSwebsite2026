<?php
/**
 * AEC Landing: The Core Pillars for AEC (repeater `aec_core_pillars`).
 *
 * Same flip cards as the Process Steps ("How We Help") section on the Who We
 * Serve page: image + brand overlay + title on the front, orange-yellow back
 * with the overview sentence and "Explore …" link. Styles: .ds-step-card in
 * main.css, plus focus / link rules in aec-landing.css.
 */
$d       = ds_aec_defaults('core_pillars');
$heading = get_field('aec_core_pillars_heading') ?: $d['heading'];
$pillars = [];

if (have_rows('aec_core_pillars')) {
    while (have_rows('aec_core_pillars')) {
        the_row();
        $pillars[] = [
            'title'     => get_sub_field('pillar_title'),
            'image'     => get_sub_field('pillar_background_image'),
            'overview'  => get_sub_field('pillar_overview_sentence'),
            'link_text' => get_sub_field('pillar_link_text'),
            'link_url'  => get_sub_field('pillar_link_url'),
        ];
    }
}
if (!$pillars) $pillars = $d['pillars'];

$pillars = array_filter($pillars, function ($p) { return !empty($p['title']); });
if (!$pillars) return;
?>
<section class="ds-section ds-section--process ds-aec-pillars">
    <div class="ds-container">
        <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>

        <div class="ds-steps-cards ds-aec-pillars__grid">
            <?php foreach ($pillars as $p) :
                $img_url   = is_array($p['image']) ? ($p['image']['url'] ?? '') : ($p['image'] ? wp_get_attachment_image_url((int) $p['image'], 'card-thumb') : '');
                $link_text = $p['link_text'] ?: sprintf(__('Explore %s', 'digitalstride'), $p['title']);
                ?>
                <div class="ds-step-card ds-aec-pillar">
                    <div class="ds-step-card__inner">
                        <div class="ds-step-card__front" aria-hidden="true">
                            <?php if ($img_url) : ?>
                                <img class="ds-step-card__bg" src="<?php echo esc_url($img_url); ?>" alt="" loading="lazy">
                            <?php endif; ?>
                            <div class="ds-step-card__overlay"></div>
                            <div class="ds-step-card__content">
                                <span class="ds-step-card__title"><?php echo esc_html($p['title']); ?></span>
                            </div>
                        </div>
                        <div class="ds-step-card__back">
                            <h3 class="ds-step-card__title"><?php echo esc_html($p['title']); ?></h3>
                            <?php if ($p['overview']) : ?>
                                <p class="ds-step-card__text"><?php echo esc_html($p['overview']); ?></p>
                            <?php endif; ?>
                            <?php if ($p['link_url']) : ?>
                                <a class="ds-aec-pillar__link" href="<?php echo esc_url($p['link_url']); ?>">
                                    <?php echo esc_html($link_text); ?> <span aria-hidden="true">&rarr;</span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
