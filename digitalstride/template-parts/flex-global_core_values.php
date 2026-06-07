<?php
/**
 * Flex Layout: Global Core Values
 * Pulls all content from Theme Settings → Core Values options page.
 * Renders identically to the per-page Txt Img Btn | Accordion layout.
 */
$heading = get_field('gcv_heading', 'option');
$image   = get_field('gcv_image',   'option');
$link    = get_field('gcv_link',    'option');
$values  = get_field('gcv_values',  'option');
?>

<?php if ($heading || $values) : ?>
<section class="ds-section ds-section--values">
    <div class="ds-container">
        <div class="ds-values-layout">
            <div class="ds-values-layout__left">
                <?php if ($heading) : ?>
                    <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
                <?php endif; ?>
                <?php if ($image) : ?>
                    <div class="ds-values-layout__image">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                    </div>
                <?php endif; ?>
                <?php if ($link) : ?>
                    <a href="<?php echo esc_url($link['url']); ?>" class="ds-btn ds-btn--primary"><?php echo esc_html($link['title']); ?></a>
                <?php endif; ?>
            </div>
            <div class="ds-values-layout__right">
                <?php if ($values) : ?>
                    <div class="ds-accordion">
                        <?php foreach ($values as $value) : ?>
                            <div class="ds-accordion__item">
                                <button class="ds-accordion__header" aria-expanded="false">
                                    <span><?php echo esc_html($value['title']); ?></span>
                                    <i class="fa-solid fa-chevron-down ds-accordion__chevron"></i>
                                </button>
                                <div class="ds-accordion__body">
                                    <?php echo wp_kses_post($value['description']); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
