<?php
/**
 * Flex Layout: Who Else We Help
 * Text + CTA on the left, an accordion of industries on the right, and the
 * client logo carousel (Theme Settings → Partners / Clients) underneath.
 *
 * Empty fields fall back to the copy below, and the front page shows this
 * section after Core Values until it is added as a layout (see
 * ds_render_flex()), so it renders complete before anything is entered.
 */
$in_row = get_row_layout() === 'who_else_we_help';

$heading      = $in_row ? get_sub_field('heading') : '';
$text         = $in_row ? get_sub_field('text') : '';
$cta          = $in_row ? get_sub_field('cta_button') : null;
$items        = $in_row ? get_sub_field('items') : [];
$show_clients = $in_row ? get_sub_field('show_clients') !== false : true;

$heading = $heading ?: 'Who Else We Help';
$text    = $text ?: '<p>Not in the trades? We’ve got you covered.</p><p>Construction and home services are our home turf, but the same no-BS, data-driven playbook works for any business that wins on local trust. Realtors, insurance agencies, pharmacies, staffing firms, e-commerce brands, and educational institutions across Central PA count on Digital Stride to keep their phones ringing and their pipelines full.</p>';
$cta     = $cta ?: ['title' => 'Contact Us', 'url' => home_url('/contact-us/'), 'target' => ''];

if (!$items) {
    $filler = '<p>Placeholder text: a short overview of how Digital Stride helps businesses in this industry. Replace this with real copy about the results we deliver, the services that fit best, and a client success story.</p>';
    $items  = array_map(function ($title) use ($filler) {
        return ['title' => $title, 'body' => $filler];
    }, ['Real Estate', 'E-Commerce', 'Insurance', 'Non-Profits', 'Professional Services', 'More']);
}

$logos = $show_clients && function_exists('get_field') ? get_field('gp_logos', 'option') : [];
?>

<section class="ds-section ds-section--who-else">
    <div class="ds-container">
        <div class="ds-who-else">
            <div class="ds-who-else__content">
                <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
                <div class="ds-who-else__text"><?php echo wp_kses_post($text); ?></div>
                <?php if (!empty($cta['url'])) : ?>
                    <a href="<?php echo esc_url($cta['url']); ?>" class="ds-btn ds-btn--primary ds-who-else__cta"<?php echo !empty($cta['target']) ? ' target="' . esc_attr($cta['target']) . '" rel="noopener"' : ''; ?>><?php echo esc_html($cta['title']); ?></a>
                <?php endif; ?>
            </div>

            <div class="ds-who-else__list">
                <div class="ds-accordion ds-accordion--centered">
                    <?php foreach ($items as $item) : ?>
                        <?php if (empty($item['title'])) continue; ?>
                        <div class="ds-accordion__item">
                            <button class="ds-accordion__header" aria-expanded="false">
                                <span><?php echo esc_html($item['title']); ?></span>
                            </button>
                            <div class="ds-accordion__body">
                                <?php echo wp_kses_post($item['body']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <?php if ($logos) : ?>
            <div class="ds-logo-carousel ds-who-else__clients">
                <div class="ds-logo-carousel__track">
                    <?php foreach ($logos as $logo_item) :
                        $logo = $logo_item['logo'] ?? null;
                        $link = $logo_item['link'] ?? '';
                        if (!$logo) continue;
                    ?>
                        <div class="ds-logo-carousel__slide">
                            <?php if ($link) : ?><a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener"><?php endif; ?>
                                <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>">
                            <?php if ($link) : ?></a><?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
