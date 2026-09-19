<?php
/**
 * Flex Layout: Audience Picker
 * Two large buttons (AEC / Home Services). Picking one stores the choice
 * and either reveals that industry's sections on this page or sends the
 * visitor to the industry page. See inc/audiences.php.
 */
$subheading = get_sub_field('subheading');
$heading    = get_sub_field('heading');
$intro      = get_sub_field('intro');
$on_select  = get_sub_field('on_select') ?: 'reveal';
$show_desc  = get_sub_field('show_descriptions');
$show_desc  = ($show_desc === null) ? true : (bool) $show_desc;
?>

<section class="ds-section ds-section--audience-picker ds-audience-picker" data-audience-picker>
    <div class="ds-container ds-container--narrow">
        <?php if ($subheading) : ?>
            <p class="ds-section__subheading"><?php echo esc_html($subheading); ?></p>
        <?php endif; ?>
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($intro) : ?>
            <p class="ds-audience-picker__intro"><?php echo esc_html($intro); ?></p>
        <?php endif; ?>

        <div class="ds-audience-picker__options" role="group" aria-label="<?php esc_attr_e('Choose your industry', 'digitalstride'); ?>">
            <?php foreach (array_keys(ds_audiences()) as $slug) : ?>
                <?php ds_audience_button($slug, [
                    'class'            => 'ds-audience-picker__btn',
                    'on_select'        => $on_select,
                    'show_description' => $show_desc,
                ]); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
