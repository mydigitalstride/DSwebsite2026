<?php
/**
 * Flex Layout: Process Steps
 * Numbered 4-step process with title and description per step.
 * Used on: Who We Serve
 */
$heading = get_sub_field('heading');
$cta     = get_sub_field('cta_button');
?>

<section class="ds-section ds-section--process">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading ds-section__heading--center"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>
        <?php if (have_rows('steps')) : ?>
            <div class="ds-steps-cards">
                <?php while (have_rows('steps')) : the_row();
                    $img = get_sub_field('image');
                ?>
                    <div class="ds-step-card">
                        <div class="ds-step-card__inner">
                            <div class="ds-step-card__front">
                                <?php if ($img) : ?>
                                    <img class="ds-step-card__bg" src="<?php echo esc_url($img['url']); ?>" alt="">
                                <?php endif; ?>
                                <div class="ds-step-card__overlay"></div>
                                <div class="ds-step-card__content">
                                    <h3 class="ds-step-card__title"><?php echo esc_html(get_sub_field('title')); ?></h3>
                                </div>
                            </div>
                            <div class="ds-step-card__back">
                                <h3 class="ds-step-card__title"><?php echo esc_html(get_sub_field('title')); ?></h3>
                                <p class="ds-step-card__text"><?php echo esc_html(get_sub_field('description')); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php if ($cta) : ?>
            <div class="ds-section__cta">
                <a href="<?php echo esc_url($cta['url']); ?>" class="ds-btn ds-btn--primary"><?php echo esc_html($cta['title']); ?></a>
            </div>
        <?php endif; ?>
    </div>
</section>
