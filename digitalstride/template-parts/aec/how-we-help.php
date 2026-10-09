<?php
/**
 * AEC Landing: Value Beyond Marketing — "How We Help AEC Firms Win & Grow"
 * (group `aec_how_we_help`).
 */
$d     = ds_aec_defaults('how_we_help');
$group = get_field('aec_how_we_help') ?: [];

$tag     = ($group['section_tag'] ?? '') ?: $d['section_tag'];
$heading = ($group['section_heading'] ?? '') ?: $d['section_heading'];
$intro   = ($group['intro_paragraph'] ?? '') ?: $d['intro_paragraph'];
$cards   = !empty($group['value_cards']) ? $group['value_cards'] : $d['value_cards'];
$cards   = array_filter((array) $cards, function ($c) { return !empty($c['card_title']) || !empty($c['card_description']); });
?>
<section class="ds-section ds-aec-help">
    <div class="ds-container ds-aec-help__inner">
        <div class="ds-aec-help__intro">
            <?php if ($tag) : ?>
                <p class="ds-aec-tag"><?php echo esc_html($tag); ?></p>
            <?php endif; ?>
            <h2 class="ds-section__heading ds-aec-help__heading"><?php echo esc_html($heading); ?></h2>
            <?php if ($intro) : ?>
                <div class="ds-section__text ds-aec-help__text"><?php echo wp_kses_post(wpautop($intro)); ?></div>
            <?php endif; ?>
        </div>

        <?php if ($cards) : ?>
            <ul class="ds-aec-help__cards">
                <?php foreach ($cards as $card) : ?>
                    <li class="ds-aec-value-card">
                        <?php if (!empty($card['card_title'])) : ?>
                            <h3 class="ds-aec-value-card__title"><?php echo esc_html($card['card_title']); ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($card['card_description'])) : ?>
                            <p class="ds-aec-value-card__text"><?php echo esc_html($card['card_description']); ?></p>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>
