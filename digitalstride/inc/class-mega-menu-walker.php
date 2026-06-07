<?php
/**
 * Custom mega menu walker for the Services dropdown
 */
class DS_Mega_Menu_Walker extends Walker_Nav_Menu {

    private $mega_menu_items = [];
    private $in_mega = false;
    private $mega_columns = [];
    private $current_column = '';

    public function start_lvl(&$output, $depth = 0, $args = null) {
        if ($depth === 0 && $this->in_mega) {
            $output .= '<div class="ds-mega-menu">';
            $output .= '<div class="ds-mega-menu__inner">';
            return;
        }
        if ($depth === 1 && $this->in_mega) {
            $output .= '<ul class="ds-mega-menu__links">';
            return;
        }
        $output .= '<ul class="ds-nav__dropdown">';
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        if ($depth === 0 && $this->in_mega) {
            $output .= '</div></div>';
            $this->in_mega = false;
            return;
        }
        if ($depth === 1 && $this->in_mega) {
            $output .= '</ul>';
            return;
        }
        $output .= '</ul>';
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);

        if ($depth === 0 && $item->title === 'Services') {
            $this->in_mega = true;
        }

        if ($depth === 0) {
            $li_class = 'ds-nav__item';
            if ($has_children) {
                $li_class .= ' ds-nav__item--has-children';
            }
            if ($this->in_mega && $item->title === 'Services') {
                $li_class .= ' ds-nav__item--mega';
            }
            if (in_array('current-menu-item', $classes) || in_array('current-menu-ancestor', $classes)) {
                $li_class .= ' ds-nav__item--active';
            }
            $output .= '<li class="' . $li_class . '">';
            $output .= '<a href="' . esc_url($item->url) . '" class="ds-nav__link">';
            $output .= esc_html($item->title);
            if ($has_children) {
                $output .= ' <i class="fa-solid fa-chevron-down ds-nav__arrow"></i>';
            }
            $output .= '</a>';
        } elseif ($depth === 1 && $this->in_mega) {
            $output .= '<div class="ds-mega-menu__column">';
            $output .= '<h6 class="ds-mega-menu__heading">' . esc_html($item->title) . '</h6>';
        } elseif ($depth === 2 && $this->in_mega) {
            $output .= '<li class="ds-mega-menu__link-item">';
            $output .= '<a href="' . esc_url($item->url) . '" class="ds-mega-menu__link">';
            $output .= esc_html($item->title);
            $output .= '</a>';
        } else {
            $output .= '<li class="ds-nav__dropdown-item">';
            $output .= '<a href="' . esc_url($item->url) . '" class="ds-nav__dropdown-link">';
            $output .= esc_html($item->title);
            $output .= '</a>';
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        if ($depth === 1 && $this->in_mega) {
            $output .= '</div>';
            return;
        }
        $output .= '</li>';
    }
}
