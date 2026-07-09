</main>

<?php // Gradient divider bar above footer ?>
<div class="ds-divider"></div>

<footer class="ds-footer">
    <?php $bg = get_field('footer_bg_image', 'option'); ?>
    <div class="ds-footer__inner" <?php echo $bg ? 'style="background-image:url(' . esc_url($bg['url']) . ')"' : ''; ?>>
        <div class="ds-footer__top">
            <div class="ds-footer__brand">
                <?php $logo = get_field('footer_logo', 'option'); ?>
                <?php if ($logo) : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo esc_url($logo['url']); ?>" alt="Digital Stride">
                    </a>
                <?php endif; ?>

            <div class="ds-footer__contact">
                <?php $email = get_field('footer_email', 'option') ?: 'Results@MyDigitalStride.com'; ?>
                <?php $phone = get_field('footer_phone', 'option') ?: '(717) 727-1400'; ?>
                <?php $address = get_field('footer_address', 'option') ?: '410 Kings Mill Rd, Suite 115, York, PA 17402'; ?>
                <a href="<?php echo esc_url('mailto:' . $email); ?>" rel="nofollow"><i class="fa-solid fa-envelope"></i> <?php echo esc_html($email); ?></a>
                <a href="<?php echo esc_url('tel:' . preg_replace('/[^0-9+]/', '', $phone)); ?>" rel="nofollow"><i class="fa-solid fa-phone"></i> <?php echo esc_html($phone); ?></a>
                <p><i class="fa-solid fa-location-dot"></i> <?php echo esc_html($address); ?></p>
            </div>
            </div>

            <div class="ds-footer__nav">
                <?php if (have_rows('footer_links', 'option')) : ?>
                    <ul>
                        <?php while (have_rows('footer_links', 'option')) : the_row(); ?>
                            <?php $link = get_sub_field('link'); ?>
                            <?php if ($link) : ?>
                                <li><a href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['title']); ?></a></li>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="ds-footer__cta">
                <?php $cta = get_field('footer_cta', 'option'); ?>
                <?php if ($cta) : ?>
                    <a href="<?php echo esc_url($cta['url']); ?>" class="ds-btn ds-btn--primary"><?php echo esc_html($cta['title']); ?></a>
                <?php endif; ?>
                <?php $linkedin = get_field('footer_linkedin', 'option'); ?>
                <?php if ($linkedin) : ?>
                    <a href="<?php echo esc_url($linkedin); ?>" class="ds-footer__social" target="_blank" rel="noopener" aria-label="LinkedIn">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="ds-footer__bottom">
            <p>&copy; <?php echo date('Y'); ?> Digital Stride. All Rights Reserved.</p>
            <?php $privacy = get_field('footer_privacy_url', 'option'); ?>
            <?php if ($privacy) : ?>
                <a href="<?php echo esc_url($privacy); ?>">Privacy Policy</a>
            <?php endif; ?>
        </div>
    </div>
</footer>

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
    <defs>
        <linearGradient id="ds-gradient-blue" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%" stop-color="#051879"/>
            <stop offset="100%" stop-color="#0993BF"/>
        </linearGradient>
        <linearGradient id="ds-gradient-orange" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%" stop-color="#F36E21"/>
            <stop offset="100%" stop-color="#F2C814"/>
        </linearGradient>
    </defs>
</svg>
<?php wp_footer(); ?>
</body>
</html>
