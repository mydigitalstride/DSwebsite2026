<?php
/**
 * Flex Layout: DSD Dashboard Promo
 * Italic caption, heading with a blue-gradient word and the orange bar,
 * intro, three unboxed icon columns, then a primary + outline button.
 * Used on: Home
 */
$caption   = get_sub_field('caption');
$heading   = get_sub_field('heading');
$highlight = get_sub_field('heading_highlight');
$text      = get_sub_field('text');
$primary   = ds_link_with_default(get_sub_field('primary_button'), 'Explore Partner Dashboard', ds_template_page_url('page-dsd.php', '/dsd/'));
$secondary = ds_link_with_default(get_sub_field('secondary_button'), 'Become a Partner to Unlock All Features', home_url('/contact-us/'));
$features  = ds_promo_features([
    ['fa' => 'fa-solid fa-phone',            'title' => 'Real-Time Lead Tracking', 'text' => 'Listen to call recordings, review form submissions, and track booked estimates.'],
    ['fa' => 'fa-solid fa-handshake'       , 'title' => 'Direct Task Board',      'text' => 'Submit changes, review and approve creative assets, and chat directly with our team.'],
    ['fa' => 'fa-solid fa-chart-pie',        'title' => 'All-in-One Metrics',     'text' => 'Monitor website traffic, SEO rankings, social channels, and ad campaigns together.'],
]);
$id = 'ds-dsd-promo-' . get_row_index();
?>

<section class="ds-section ds-promo ds-promo--dsd"<?php if ($heading) : ?> aria-labelledby="<?php echo esc_attr($id); ?>"<?php endif; ?>>
    <div class="ds-container">
        <div class="ds-promo__head">
            <?php if ($caption) : ?><p class="ds-promo__caption"><?php echo esc_html($caption); ?></p><?php endif; ?>
            <?php if ($heading) : ?>
                <h2 class="ds-section__heading ds-section__heading--center ds-promo__heading" id="<?php echo esc_attr($id); ?>"><?php echo ds_gradient_heading($heading, $highlight); ?></h2>
            <?php endif; ?>
            <?php if ($text) : ?><p class="ds-promo__text"><?php echo esc_html($text); ?></p><?php endif; ?>
        </div>

        <ul class="ds-promo__features ds-promo__features--open">
            <?php foreach ($features as $feature) : ?>
                <li class="ds-promo__feature">
                    <?php echo ds_gradient_icon($feature['icon'], $feature['fa'], 'ds-promo__icon'); ?>
                    <?php if ($feature['title']) : ?><h3 class="ds-promo__feature-title"><?php echo esc_html($feature['title']); ?></h3><?php endif; ?>
                    <?php if ($feature['text']) : ?><p class="ds-promo__feature-text"><?php echo esc_html($feature['text']); ?></p><?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php get_template_part('template-parts/promo-ctas', null, ['primary' => $primary, 'secondary' => $secondary]); ?>
    </div>
</section>
