<?php
/**
 * Flex Layout: Team Grid
 * Large H2 heading + accent line + grid of bordered photo cards.
 * Includes optional "Fur-keters" sub-section with its own heading + grid.
 */
$heading     = get_sub_field('heading');
$pet_heading = get_sub_field('pet_heading');
?>

<section class="ds-section ds-section--team">
    <div class="ds-container">

        <?php if ($heading) : ?>
            <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
            <div class="ds-team__divider"></div>
        <?php endif; ?>

        <?php if (have_rows('members')) : ?>
            <div class="ds-team-grid">
                <?php while (have_rows('members')) : the_row(); ?>
                    <?php $photo = get_sub_field('photo'); ?>
                    <div class="ds-team-card">
                        <div class="ds-team-card__photo-wrap">
                            <?php if ($photo) : ?>
                                <img src="<?php echo esc_url($photo['sizes']['team-photo'] ?? $photo['url']); ?>"
                                     alt="<?php echo esc_attr(get_sub_field('name')); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="ds-team-card__info">
                            <h3 class="ds-team-card__name"><?php echo esc_html(get_sub_field('name')); ?></h3>
                            <p class="ds-team-card__role"><?php echo esc_html(get_sub_field('role')); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <?php // Fur-keters sub-section ?>
        <?php if ($pet_heading || have_rows('pets')) : ?>
            <div class="ds-team__section-break">
                <?php if ($pet_heading) : ?>
                    <h2 class="ds-section__heading"><?php echo esc_html($pet_heading); ?></h2>
                    <div class="ds-team__divider"></div>
                <?php endif; ?>
            </div>
            <?php if (have_rows('pets')) : ?>
                <div class="ds-team-grid ds-team-grid--4">
                    <?php while (have_rows('pets')) : the_row(); ?>
                        <?php $photo = get_sub_field('photo'); ?>
                        <div class="ds-team-card">
                            <div class="ds-team-card__photo-wrap">
                                <?php if ($photo) : ?>
                                    <img src="<?php echo esc_url($photo['sizes']['team-photo'] ?? $photo['url']); ?>"
                                         alt="<?php echo esc_attr(get_sub_field('name')); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="ds-team-card__info">
                                <h6 class="ds-team-card__name"><?php echo esc_html(get_sub_field('name')); ?></h6>
                                <p class="ds-team-card__role"><?php echo esc_html(get_sub_field('role')); ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</section>
