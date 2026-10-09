<?php
/**
 * Flex Layout: Lead Form
 * Name / email / phone / service / message form that sends each lead to DSD
 * through our server (inc/dsd-leads.php, template-parts/lead-form.php).
 */
$heading = get_sub_field('heading');
$intro   = get_sub_field('intro');
?>

<section class="ds-section ds-section--lead-form">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if ($intro) : ?>
            <p class="ds-section__intro ds-lead__intro"><?php echo esc_html($intro); ?></p>
        <?php endif; ?>

        <div class="ds-lead__wrap">
            <?php get_template_part('template-parts/lead-form', null, [
                'services'        => get_sub_field('services'),
                'button_label'    => get_sub_field('button_label'),
                'success_heading' => get_sub_field('success_heading'),
                'success_text'    => get_sub_field('success_text'),
            ]); ?>
        </div>
    </div>
</section>
