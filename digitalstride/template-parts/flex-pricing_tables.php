<?php
/**
 * Flex Layout: Pricing Tables
 * Multi-tier comparison tables with features checklist.
 * Used on: Service Overview, Service V2
 */
?>

<?php if (have_rows('tables')) : ?>
<section class="ds-section ds-section--pricing">
    <div class="ds-container">
        <?php while (have_rows('tables')) : the_row(); ?>
            <div class="ds-pricing-table">
                <h3 class="ds-pricing-table__title"><?php echo esc_html(get_sub_field('service_name')); ?></h3>
                <?php if (have_rows('tiers')) : ?>
                    <div class="ds-pricing-table__grid">
                        <?php while (have_rows('tiers')) : the_row(); ?>
                            <div class="ds-pricing-tier">
                                <div class="ds-pricing-tier__header">
                                    <h6 class="ds-pricing-tier__name"><?php echo esc_html(get_sub_field('name')); ?></h6>
                                    <div class="ds-pricing-tier__price"><?php echo esc_html(get_sub_field('price')); ?></div>
                                </div>
                                <?php if (have_rows('features')) : ?>
                                    <ul class="ds-pricing-tier__features">
                                        <?php while (have_rows('features')) : the_row(); ?>
                                            <li class="<?php echo get_sub_field('included') ? 'included' : 'excluded'; ?>">
                                                <?php echo esc_html(get_sub_field('feature_text')); ?>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                <?php $note = get_sub_field('note'); ?>
                <?php if ($note) : ?>
                    <p class="ds-pricing-table__note"><?php echo esc_html($note); ?></p>
                <?php endif; ?>
                <?php $cta = get_sub_field('cta_button'); ?>
                <?php if ($cta) : ?>
                    <div class="ds-pricing-table__cta">
                        <a href="<?php echo esc_url($cta['url']); ?>" class="ds-btn ds-btn--primary"><?php echo esc_html($cta['title']); ?></a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<?php endif; ?>
