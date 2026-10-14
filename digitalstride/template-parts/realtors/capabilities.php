<?php
/**
 * Realtors 3: Digital Infrastructure Built For Top Producers (s3_* fields).
 *
 * A stacked card deck: the front card is readable, the next ones peek out
 * behind it. The arrows, dots, a click on a peeking card, arrow keys and
 * swipes rotate the deck (realtors.js). Without JavaScript the cards are
 * listed one under another. Blue heading bar.
 */
$d     = ds_rlt_defaults('capabilities');
$title = get_field('s3_title') ?: $d['title'];
$cards = ds_rlt_rows('s3_capabilities', $d['cards'], ['card_title', 'card_description']);
if (!$cards) return;

$uid   = 'ds-rlt-deck-' . wp_unique_id();
$count = count($cards);
?>
<section class="ds-section ds-rlt-caps" aria-labelledby="<?php echo esc_attr($uid); ?>-heading">
    <div class="ds-container">
        <h2 class="ds-section__heading ds-section__heading--center" id="<?php echo esc_attr($uid); ?>-heading"><?php echo esc_html($title); ?></h2>

        <div class="ds-rlt-deck" data-rlt-deck role="region" aria-roledescription="carousel" aria-labelledby="<?php echo esc_attr($uid); ?>-heading">
            <div class="ds-rlt-deck__stack" id="<?php echo esc_attr($uid); ?>-stack" aria-live="polite">
                <?php foreach ($cards as $i => $card) :
                    $img = $card['card_image'] ?? null;
                    $fa  = trim((string) ($card['card_icon'] ?? ''));
                    ?>
                    <article class="ds-rlt-deck__card<?php echo ($img || $fa) ? '' : ' ds-rlt-deck__card--no-media'; ?>" data-index="<?php echo (int) $i; ?>"
                        aria-roledescription="slide" aria-label="<?php echo esc_attr(sprintf(__('%1$d of %2$d', 'digitalstride'), $i + 1, $count)); ?>">
                        <div class="ds-rlt-deck__body">
                            <?php if (!empty($card['tag_text'])) : ?>
                                <p class="ds-rlt-deck__tag"><?php echo esc_html($card['tag_text']); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($card['card_title'])) : ?>
                                <h3 class="ds-rlt-deck__title"><?php echo esc_html($card['card_title']); ?></h3>
                            <?php endif; ?>
                            <?php if (!empty($card['card_description'])) : ?>
                                <p class="ds-rlt-deck__text"><?php echo esc_html($card['card_description']); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($card['button_text']) && !empty($card['button_url'])) : ?>
                                <a href="<?php echo esc_url($card['button_url']); ?>" class="ds-btn ds-btn--primary ds-rlt-deck__btn"><?php echo esc_html($card['button_text']); ?></a>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($img['url'])) : ?>
                            <div class="ds-rlt-deck__media">
                                <img src="<?php echo esc_url($img['sizes']['card-thumb'] ?? $img['url']); ?>" alt="<?php echo esc_attr($img['alt'] ?? ''); ?>" loading="lazy">
                            </div>
                        <?php elseif ($fa) : ?>
                            <div class="ds-rlt-deck__media ds-rlt-deck__media--icon" aria-hidden="true"><i class="<?php echo esc_attr($fa); ?>"></i></div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>

            <?php if ($count > 1) : ?>
                <div class="ds-rlt-deck__controls" hidden>
                    <button type="button" class="ds-rlt-deck__btn-nav ds-rlt-deck__btn-nav--prev" aria-controls="<?php echo esc_attr($uid); ?>-stack" aria-label="<?php esc_attr_e('Previous card', 'digitalstride'); ?>">
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>
                    <div class="ds-rlt-deck__dots">
                        <?php foreach ($cards as $i => $card) : ?>
                            <button type="button" class="ds-rlt-deck__dot" data-index="<?php echo (int) $i; ?>" aria-controls="<?php echo esc_attr($uid); ?>-stack"
                                aria-label="<?php echo esc_attr(!empty($card['card_title']) ? $card['card_title'] : sprintf(__('Card %d', 'digitalstride'), $i + 1)); ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="ds-rlt-deck__btn-nav ds-rlt-deck__btn-nav--next" aria-controls="<?php echo esc_attr($uid); ?>-stack" aria-label="<?php esc_attr_e('Next card', 'digitalstride'); ?>">
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
