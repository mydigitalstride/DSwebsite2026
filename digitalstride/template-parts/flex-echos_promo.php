<?php
/**
 * Flex Layout: ECHOs SEO Promo
 * ECHOs logo beside a centred caption / heading / intro (stacked on
 * mobile), three boxed feature cards with orange icons, then a primary +
 * outline button.
 * Used on: Home
 */
$logo      = get_sub_field('logo');
$caption   = get_sub_field('caption');
$heading   = get_sub_field('heading');
$text      = get_sub_field('text');
$echos_url = ds_template_page_url('page-templates/template-echos-landing.php', '/echo-seo/');
$primary   = ds_link_with_default(get_sub_field('primary_button'), 'Explore ECHO SEO', $echos_url);
$secondary = ds_link_with_default(get_sub_field('secondary_button'), 'Deploy ECHOs For Your Site', home_url('/contact-us/'));
$features  = ds_promo_features([
    ['fa' => 'fa-solid fa-map-location-dot', 'title' => 'Automated Local Schema', 'text' => 'Generate precise trade schema to help Google identify your exact service areas.'],
    ['fa' => 'fa-solid fa-magnifying-glass', 'title' => 'Trade Keyword Mapping',  'text' => 'Target high-intent search terms tailored specifically for contractors and AEC firms.'],
    ['fa' => 'fa-solid fa-bolt',             'title' => 'AI Search Optimization', 'text' => 'Structure your content to rank inside AI tools like ChatGPT, Claude, and Gemini.'],
]);
$id = 'ds-echos-promo-' . get_row_index();
?>

<section class="ds-section ds-promo ds-promo--echos"<?php if ($heading) : ?> aria-labelledby="<?php echo esc_attr($id); ?>"<?php endif; ?>>
    <div class="ds-container">
        <div class="ds-promo__intro<?php echo $logo ? ' ds-promo__intro--logo' : ''; ?>">
            <?php if ($logo) : ?>
                <div class="ds-promo__logo">
                    <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?: 'ECHOs SEO'); ?>"<?php if (!empty($logo['width'])) : ?> width="<?php echo (int) $logo['width']; ?>" height="<?php echo (int) $logo['height']; ?>"<?php endif; ?> loading="lazy">
                </div>
            <?php endif; ?>
            <div class="ds-promo__head">
                <?php if ($caption) : ?><p class="ds-promo__caption"><?php echo esc_html($caption); ?></p><?php endif; ?>
                <?php if ($heading) : ?>
                    <h2 class="ds-section__heading ds-section__heading--center ds-promo__heading" id="<?php echo esc_attr($id); ?>"><?php echo esc_html($heading); ?></h2>
                <?php endif; ?>
                <?php if ($text) : ?><p class="ds-promo__text"><?php echo esc_html($text); ?></p><?php endif; ?>
            </div>
        </div>

        <ul class="ds-promo__features ds-promo__features--boxed">
            <?php foreach ($features as $feature) : ?>
                <li class="ds-promo__card">
                    <div class="ds-promo__card-head">
                        <?php echo ds_gradient_icon($feature['icon'], $feature['fa'], 'ds-promo__card-icon'); ?>
                        <?php if ($feature['title']) : ?><h3 class="ds-promo__card-title"><?php echo esc_html($feature['title']); ?></h3><?php endif; ?>
                    </div>
                    <?php if ($feature['text']) : ?><p class="ds-promo__card-text"><?php echo esc_html($feature['text']); ?></p><?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php get_template_part('template-parts/promo-ctas', null, ['primary' => $primary, 'secondary' => $secondary]); ?>
    </div>
</section>
