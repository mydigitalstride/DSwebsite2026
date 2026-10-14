<?php
/**
 * Realtors 1: Why Traditional Marketing Fails Realtors (s1_* fields).
 * Three bordered cards, using the AEC "How We Help" value cards and their
 * hover. Blue heading bar.
 */
$d     = ds_rlt_defaults('pain_points');
$title = get_field('s1_title') ?: $d['title'];
$cards = ds_rlt_rows('s1_cards', $d['cards'], ['card_title', 'card_description']);
if (!$cards) return;
?>
<section class="ds-section ds-rlt-pain">
    <div class="ds-container">
        <h2 class="ds-section__heading"><?php echo esc_html($title); ?></h2>

        <ul class="ds-rlt-pain__grid">
            <?php foreach ($cards as $card) : ?>
                <li class="ds-aec-value-card ds-rlt-pain__card">
                    <?php if (!empty($card['card_title'])) : ?>
                        <h3 class="ds-aec-value-card__title"><?php echo esc_html($card['card_title']); ?></h3>
                    <?php endif; ?>
                    <?php if (!empty($card['card_description'])) : ?>
                        <p class="ds-aec-value-card__text"><?php echo esc_html($card['card_description']); ?></p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
