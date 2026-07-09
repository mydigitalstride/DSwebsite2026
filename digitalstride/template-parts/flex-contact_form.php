<?php
/**
 * Flex Layout: Contact Form
 * 3-column layout: form, contact info, address with optional map link.
 * Used on: Contact Us
 */
$heading = get_sub_field('heading');
?>

<section class="ds-section ds-section--contact">
    <div class="ds-container">
        <?php if ($heading) : ?>
            <h2 class="ds-section__heading"><?php echo esc_html($heading); ?></h2>
        <?php endif; ?>

        <div class="ds-contact-grid">
            <div class="ds-contact__form">
                <?php $form_heading = get_sub_field('form_heading'); ?>
                <?php if ($form_heading) : ?>
                    <h3><?php echo esc_html($form_heading); ?></h3>
                <?php endif; ?>
                <?php
                // Support both legacy shortcodes and modern iframe embeds.
                $embed     = get_sub_field('form_embed');
                $shortcode = get_sub_field('form_shortcode');
                if ($embed) :
                    // Allow iframe tags with all necessary attributes for third-party embeds.
                    $allowed = [
                        'iframe' => [
                            'src'                    => true,
                            'id'                     => true,
                            'title'                  => true,
                            'style'                  => true,
                            'width'                  => true,
                            'height'                 => true,
                            'frameborder'            => true,
                            'allowfullscreen'        => true,
                            'loading'                => true,
                            'data-layout'            => true,
                            'data-trigger-type'      => true,
                            'data-trigger-value'     => true,
                            'data-activation-type'   => true,
                            'data-activation-value'  => true,
                            'data-deactivation-type' => true,
                            'data-deactivation-value'=> true,
                            'data-form-name'         => true,
                            'data-height'            => true,
                            'data-layout-iframe-id'  => true,
                            'data-form-id'           => true,
                        ],
                        'script' => ['src' => true, 'type' => true],
                    ];
                    echo wp_kses($embed, $allowed);
                elseif ($shortcode) :
                    echo do_shortcode($shortcode);
                endif;
                ?>
            </div>

            <div class="ds-contact__info">
                <?php $info_heading = get_sub_field('info_heading'); ?>
                <?php if ($info_heading) : ?>
                    <h3><?php echo esc_html($info_heading); ?></h3>
                <?php endif; ?>
                <ul class="ds-contact__details">
                    <?php $hours = get_sub_field('business_hours'); ?>
                    <?php if ($hours) : ?>
                        <li><i class="fa-solid fa-clock"></i> <?php echo esc_html($hours); ?></li>
                    <?php endif; ?>
                    <?php $email = get_sub_field('email'); ?>
                    <?php if ($email) : ?>
                        <li><i class="fa-solid fa-envelope"></i> <a href="<?php echo esc_url('mailto:' . $email); ?>" rel="nofollow"><?php echo esc_html($email); ?></a></li>
                    <?php endif; ?>
                    <?php $phone = get_sub_field('phone'); ?>
                    <?php if ($phone) : ?>
                        <li><i class="fa-solid fa-phone"></i> <a href="<?php echo esc_url('tel:' . preg_replace('/[^0-9+]/', '', $phone)); ?>" rel="nofollow"><?php echo esc_html($phone); ?></a></li>
                    <?php endif; ?>
                    <?php $address = get_sub_field('address'); $map = get_sub_field('map_url'); ?>
                    <?php if ($address) : ?>
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            <?php if ($map) : ?>
                                <a href="<?php echo esc_url($map); ?>" target="_blank" rel="noopener"><?php echo esc_html($address); ?></a>
                            <?php else : ?>
                                <?php echo esc_html($address); ?>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
