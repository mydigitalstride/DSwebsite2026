<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

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

        <button class="ds-header__hamburger" id="ds-hamburger" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>

        <nav class="ds-nav" id="ds-nav">
            <ul class="ds-nav__list">
                <?php if (have_rows('nav_items', 'option')) : while (have_rows('nav_items', 'option')) : the_row(); ?>
                    <?php $has_mega = get_sub_field('enable_mega_menu'); ?>
                    <li class="ds-nav__item<?php echo $has_mega ? ' ds-nav__item--mega' : ''; ?>">
                        <?php $link = get_sub_field('link'); ?>
                        <a href="<?php echo esc_url($link['url']); ?>" class="ds-nav__link">
                            <?php echo esc_html($link['title']); ?>
                            <?php if ($has_mega) : ?>
                                <i class="fa-solid fa-chevron-down ds-nav__arrow"></i>
                            <?php endif; ?>
                        </a>

                        <?php if ($has_mega && have_rows('mega_columns')) : ?>
                            <div class="ds-mega-menu">
                                <div class="ds-mega-menu__inner">
                                    <?php while (have_rows('mega_columns')) : the_row(); ?>
                                        <div class="ds-mega-menu__column">
                                            <h6 class="ds-mega-menu__heading"><?php echo esc_html(get_sub_field('column_heading')); ?></h6>
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

<main class="ds-main">
