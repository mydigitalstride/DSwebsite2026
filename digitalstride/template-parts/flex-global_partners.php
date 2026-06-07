<?php
/**
 * Flex Layout: Global Partners / Client Logos
 * Pulls all logos from Theme Settings → Partners / Clients options page.
 * Renders the same auto-scrolling logo carousel used by the per-page Partner Logos layout.
 */
$heading = get_field('gp_heading', 'option');
$logos   = get_field('gp_logos',   'option');
?>

<section class="ds-section ds-section--partners">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($logos) : ?>
            <div class="ds-logo-carousel">
                <div class="ds-logo-carousel__track">
                    <?php foreach ($logos as $item) :
                        $logo = $item['logo'];
                        $link = $item['link'];
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
