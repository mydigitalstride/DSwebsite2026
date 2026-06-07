<?php
/**
 * Flex Layout: Industry Tabs
 * Desktop: 3-column layout —
 *   Col 1: Tab buttons (accordion-style, gradient border)
 *   Col 2: Active tab's description text + optional icon feature list
 *   Col 3: Active tab's image (fixed height, cover crop)
 * Mobile: standard accordion, all closed by default.
 */
$heading    = get_sub_field('heading');
$subheading = get_sub_field('subheading');

$items = [];
if (have_rows('industries')) :
    while (have_rows('industries')) : the_row();
        $features = [];
        if (have_rows('features')) :
            while (have_rows('features')) : the_row();
                $features[] = [
                    'icon'  => get_sub_field('icon'),
                    'title' => get_sub_field('feature_title'),
                    'text'  => get_sub_field('feature_text'),
                ];
            endwhile;
        endif;
        $items[] = [
            'title'    => get_sub_field('title'),
            'image'    => get_sub_field('image'),
            'text'     => get_sub_field('description'),
            'features' => $features,
            'cta'      => get_sub_field('cta_button'),
        ];
    endwhile;
endif;

/**
 * Render the content column (description + feature list + CTA).
 * Used for both desktop panels and mobile accordion bodies.
 */
function ds_render_industry_content( $item ) { ?>
    <?php if ( $item['text'] ) : ?>
        <div class="ds-industry-tabs__text"><?php echo wp_kses_post( $item['text'] ); ?></div>
    <?php endif; ?>

    <?php if ( $item['features'] ) : ?>
        <div class="ds-industry-tabs__features">
            <?php foreach ( $item['features'] as $f ) : ?>
                <div class="ds-industry-tabs__feature">
                    <?php if ( $f['icon'] ) : ?>
                        <div class="ds-industry-tabs__feature-icon">
                            <?php echo ds_inline_svg( $f['icon'] ); ?>
                        </div>
                    <?php endif; ?>
                    <div class="ds-industry-tabs__feature-body">
                        <?php if ( $f['title'] ) : ?>
                            <h6 class="ds-industry-tabs__feature-title"><?php echo esc_html( $f['title'] ); ?></h6>
                        <?php endif; ?>
                        <?php if ( $f['text'] ) : ?>
                            <p class="ds-industry-tabs__feature-text"><?php echo esc_html( $f['text'] ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ( $item['cta'] ) : ?>
        <div class="ds-industry-tabs__cta">
            <a href="<?php echo esc_url( $item['cta']['url'] ); ?>" class="ds-btn ds-btn--secondary">
                <?php echo esc_html( $item['cta']['title'] ); ?>
            </a>
        </div>
    <?php endif; ?>
<?php }
?>

<section class="ds-section ds-section--industry-tabs">
    <div class="ds-container">
        <?php if ($subheading) : ?>
            <p class="ds-section__subheading"><?php echo esc_html($subheading); ?></p>
        <?php endif; ?>
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <?php if ($items) : ?>
            <div class="ds-industry-tabs">

                <!-- Col 1: Tab buttons -->
                <div class="ds-industry-tabs__list" role="tablist">
                    <?php foreach ($items as $i => $item) : ?>
                        <button
                            class="ds-industry-tabs__tab <?php echo $i === 0 ? 'is-active' : ''; ?>"
                            role="tab"
                            aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                            aria-controls="industry-panel-<?php echo $i; ?>"
                            data-tab="<?php echo $i; ?>">
                            <?php echo esc_html($item['title']); ?>
                        </button>

                        <!-- Mobile accordion body -->
                        <div class="ds-industry-tabs__mobile-panel <?php echo $i === 0 ? 'is-active' : ''; ?>"
                             id="industry-mobile-<?php echo $i; ?>">
                            <?php if ($item['image']) : ?>
                                <div class="ds-industry-tabs__img-wrap">
                                    <img src="<?php echo esc_url($item['image']['url']); ?>"
                                         alt="<?php echo esc_attr($item['image']['alt']); ?>">
                                </div>
                            <?php endif; ?>
                            <?php ds_render_industry_content($item); ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Col 2 + Col 3: Desktop panels (content + image side by side) -->
                <div class="ds-industry-tabs__panels">
                    <?php foreach ($items as $i => $item) : ?>
                        <div class="ds-industry-tabs__panel <?php echo $i === 0 ? 'is-active' : ''; ?>"
                             role="tabpanel"
                             id="industry-panel-<?php echo $i; ?>"
                             aria-hidden="<?php echo $i === 0 ? 'false' : 'true'; ?>">

                            <div class="ds-industry-tabs__panel-inner">

                                <!-- Content column -->
                                <div class="ds-industry-tabs__content">
                                    <?php ds_render_industry_content($item); ?>
                                </div>

                                <!-- Image column -->
                                <?php if ($item['image']) : ?>
                                    <div class="ds-industry-tabs__img-wrap">
                                        <img src="<?php echo esc_url($item['image']['url']); ?>"
                                             alt="<?php echo esc_attr($item['image']['alt']); ?>">
                                    </div>
                                <?php endif; ?>

                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        <?php endif; ?>
    </div>
</section>
