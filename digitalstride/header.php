<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="ds-skip-link" href="#main"><?php esc_html_e('Skip to main content', 'digitalstride'); ?></a>

<header class="ds-header" id="ds-header">
    <div class="ds-header__inner">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="ds-header__logo">
            <?php $logo = get_field('header_logo', 'option'); ?>
            <?php if ($logo) : ?>
                <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?: 'Digital Stride'); ?>">
            <?php else : ?>
                <img src="<?php echo DS_URI; ?>/assets/images/logo.png" alt="Digital Stride">
            <?php endif; ?>
        </a>

        <button type="button" class="ds-header__hamburger" id="ds-hamburger" aria-label="<?php esc_attr_e('Menu', 'digitalstride'); ?>" aria-expanded="false" aria-controls="ds-nav">
            <span></span><span></span><span></span>
        </button>

        <nav class="ds-nav" id="ds-nav" aria-label="<?php esc_attr_e('Primary', 'digitalstride'); ?>">
            <?php
            // Who We Serve card panel — rendered once up front so its
            // have_rows() loop doesn't run nested inside nav_items.
            ob_start();
            get_template_part('template-parts/mega-who-we-serve');
            $wws_panel = trim(ob_get_clean());

            global $wp;
            $current_path = trailingslashit('/' . ltrim((string) wp_parse_url(home_url($wp->request ?? ''), PHP_URL_PATH), '/'));
            $home_path    = trailingslashit('/' . ltrim((string) wp_parse_url(home_url('/'), PHP_URL_PATH), '/'));
            ?>
            <ul class="ds-nav__list">
                <?php if (have_rows('nav_items', 'option')) : while (have_rows('nav_items', 'option')) : the_row(); ?>
                    <?php
                    $link     = get_sub_field('link');
                    $has_mega = get_sub_field('enable_mega_menu');
                    $mega_type = get_sub_field('mega_menu_type');

                    // The "Who We Serve" item gets the card panel automatically,
                    // unless it has been given link columns of its own.
                    $is_wws = $link && (
                        strcasecmp(trim(wp_strip_all_tags($link['title'])), 'Who We Serve') === 0
                        || strpos((string) wp_parse_url($link['url'], PHP_URL_PATH), 'who-we-serve') !== false
                    );
                    $has_columns = $has_mega && $mega_type !== 'cards' && get_sub_field('mega_columns');
                    $is_cards = $wws_panel !== '' && !$has_columns
                        && ($is_wws || ($has_mega && $mega_type === 'cards'));
                    if ($is_cards) {
                        $has_mega = true;
                    }
                    // Current page, or a page inside that tab's section (Home only on itself).
                    $link_path  = $link ? trailingslashit('/' . ltrim((string) wp_parse_url($link['url'], PHP_URL_PATH), '/')) : '';
                    $link_host  = $link ? wp_parse_url($link['url'], PHP_URL_HOST) : '';
                    $is_current = $link && strpos($link['url'], '#') !== 0
                        && (!$link_host || $link_host === wp_parse_url(home_url(), PHP_URL_HOST)) && (
                        $link_path === $current_path
                        || ($link_path !== $home_path && strpos($current_path, $link_path) === 0)
                    );

                    $item_class = 'ds-nav__item';
                    if ($has_mega) $item_class .= ' ds-nav__item--mega';
                    if ($is_cards) $item_class .= ' ds-nav__item--mega-cards';
                    if ($is_current) $item_class .= ' is-current';
                    ?>
                    <li class="<?php echo esc_attr($item_class); ?>">
                        <a href="<?php echo esc_url($link['url']); ?>" class="ds-nav__link"<?php echo $has_mega ? ' aria-haspopup="true" aria-expanded="false"' : ''; ?><?php echo $is_current ? ' aria-current="page"' : ''; ?>>
                            <span class="ds-nav__label"><?php echo esc_html($link['title']); ?></span>
                            <?php if ($has_mega) : ?>
                                <i class="fa-solid fa-chevron-down ds-nav__arrow" aria-hidden="true"></i>
                            <?php endif; ?>
                        </a>

                        <?php if ($is_cards) : ?>
                            <?php echo $wws_panel; // escaped in template-parts/mega-who-we-serve.php ?>
                        <?php elseif ($has_mega && have_rows('mega_columns')) : ?>
                            <div class="ds-mega-menu">
                                <div class="ds-mega-menu__inner">
                                    <?php while (have_rows('mega_columns')) : the_row(); ?>
                                        <div class="ds-mega-menu__column">
                                            <p class="ds-mega-menu__heading"><?php echo esc_html(get_sub_field('column_heading')); ?></p>
                                            <?php if (have_rows('column_links')) : ?>
                                                <ul class="ds-mega-menu__links">
                                                    <?php while (have_rows('column_links')) : the_row(); ?>
                                                        <?php $menu_link = get_sub_field('link'); ?>
                                                        <?php if ($menu_link) : ?>
                                                            <li><a href="<?php echo esc_url($menu_link['url']); ?>"><?php echo esc_html($menu_link['title']); ?></a></li>
                                                        <?php endif; ?>
                                                    <?php endwhile; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endwhile; endif; ?>

                <?php $header_btn_1 = get_field('header_btn_1', 'option'); ?>
                <?php if ($header_btn_1) : ?>
                    <li class="ds-nav__item ds-nav__item--btn">
                        <a href="<?php echo esc_url($header_btn_1['url']); ?>"<?php echo $header_btn_1['target'] ? ' target="' . esc_attr($header_btn_1['target']) . '"' : ''; ?> class="ds-btn ds-btn--primary ds-btn--nav">
                            <?php echo esc_html($header_btn_1['title']); ?>
                        </a>
                    </li>
                <?php endif; ?>

                <?php $header_btn_2 = get_field('header_btn_2', 'option'); ?>
                <?php if ($header_btn_2) : ?>
                    <li class="ds-nav__item ds-nav__item--btn">
                        <a href="<?php echo esc_url($header_btn_2['url']); ?>"<?php echo $header_btn_2['target'] ? ' target="' . esc_attr($header_btn_2['target']) . '"' : ''; ?> class="ds-btn ds-btn--outline ds-btn--nav">
                            <?php echo esc_html($header_btn_2['title']); ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

<main id="main" class="ds-main" tabindex="-1">
<?php ds_breadcrumbs(); ?>
