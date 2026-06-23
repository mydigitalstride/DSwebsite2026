<?php
/**
 * ACF Field Registration — Flexible Content Architecture
 *
 * All page content is managed through a single "Page Sections" flexible content field.
 * Each layout maps to a template-parts/flex-{layout_name}.php file.
 */

$ds_icon_color_choices = [
    ''                => 'Default',
    'white'           => 'White',
    'navy'            => 'Dark Navy Blue',
    'blue-gradient'   => 'Navy / Light Blue Gradient',
    'orange-gradient'  => 'Orange / Yellow Gradient',
];

// ═══════════════════════════════════════════════════════
// OPTIONS: Header & Mega Menu
// ═══════════════════════════════════════════════════════
acf_add_local_field_group([
    'key'    => 'group_header_menu',
    'title'  => 'Header & Mega Menu',
    'fields' => [
        [
            'key'           => 'field_header_logo',
            'label'         => 'Site Logo',
            'name'          => 'header_logo',
            'type'          => 'image',
            'return_format' => 'array',
            'preview_size'  => 'medium',
            'instructions'  => 'White-text logo for the dark header. Recommended: PNG with transparency.',
        ],
        [
            'key'          => 'field_nav_items',
            'label'        => 'Navigation Items',
            'name'         => 'nav_items',
            'type'         => 'repeater',
            'layout'       => 'block',
            'button_label' => 'Add Menu Item',
            'instructions' => 'Build the main navigation. Enable mega menu on Services to show a 3-column dropdown.',
            'sub_fields'   => [
                [
                    'key'   => 'field_nav_link',
                    'label' => 'Link',
                    'name'  => 'link',
                    'type'  => 'link',
                    'return_format' => 'array',
                ],
                [
                    'key'           => 'field_nav_mega',
                    'label'         => 'Enable Mega Menu Dropdown',
                    'name'          => 'enable_mega_menu',
                    'type'          => 'true_false',
                    'ui'            => 1,
                    'default_value' => 0,
                    'instructions'  => 'Turn on for the Services item to display a 3-column mega dropdown.',
                ],
                [
                    'key'               => 'field_nav_mega_cols',
                    'label'             => 'Mega Menu Columns',
                    'name'              => 'mega_columns',
                    'type'              => 'repeater',
                    'layout'            => 'block',
                    'button_label'      => 'Add Column',
                    'max'               => 3,
                    'instructions'      => 'Each column has a heading and a list of links.',
                    'conditional_logic' => [
                        [['field' => 'field_nav_mega', 'operator' => '==', 'value' => '1']],
                    ],
                    'sub_fields' => [
                        [
                            'key'   => 'field_mega_col_heading',
                            'label' => 'Column Heading',
                            'name'  => 'column_heading',
                            'type'  => 'text',
                            'instructions' => 'e.g. "Digital Foundation", "Revenue Generation", "Brand Awareness"',
                        ],
                        [
                            'key'          => 'field_mega_col_links',
                            'label'        => 'Column Links',
                            'name'         => 'column_links',
                            'type'         => 'repeater',
                            'layout'       => 'table',
                            'button_label' => 'Add Link',
                            'sub_fields'   => [
                                [
                                    'key'   => 'field_mega_link',
                                    'label' => 'Link',
                                    'name'  => 'link',
                                    'type'  => 'link',
                                    'return_format' => 'array',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        [
            'key'           => 'field_header_btn_1',
            'label'         => 'Header Button 1 (Gradient Fill)',
            'name'          => 'header_btn_1',
            'type'          => 'link',
            'return_format' => 'array',
            'instructions'  => 'Displayed in the nav next to the menu items, orange/yellow gradient fill.',
        ],
        [
            'key'           => 'field_header_btn_2',
            'label'         => 'Header Button 2 (Outline)',
            'name'          => 'header_btn_2',
            'type'          => 'link',
            'return_format' => 'array',
            'instructions'  => 'Displayed in the nav next to the menu items, white outline.',
        ],
    ],
    'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-header-menu']]],
    'menu_order' => 0,
    'position'   => 'normal',
    'style'      => 'default',
    'active'     => true,
]);

// ═══════════════════════════════════════════════════════
// OPTIONS: Footer
// ═══════════════════════════════════════════════════════
acf_add_local_field_group([
    'key'    => 'group_footer',
    'title'  => 'Footer Settings',
    'fields' => [
        ['key' => 'field_footer_logo', 'label' => 'Footer Logo', 'name' => 'footer_logo', 'type' => 'image', 'return_format' => 'array'],
        ['key' => 'field_footer_bg_image', 'label' => 'Background Image', 'name' => 'footer_bg_image', 'type' => 'image', 'return_format' => 'array', 'instructions' => 'Blueprint sketch background for the footer.'],
        ['key' => 'field_footer_email', 'label' => 'Email', 'name' => 'footer_email', 'type' => 'email', 'default_value' => 'Results@MyDigitalStride.com'],
        ['key' => 'field_footer_phone', 'label' => 'Phone', 'name' => 'footer_phone', 'type' => 'text', 'default_value' => '(717) 727-1400'],
        ['key' => 'field_footer_address', 'label' => 'Address', 'name' => 'footer_address', 'type' => 'text', 'default_value' => '410 Kings Mill Rd, Suite 115, York, PA 17402'],
        [
            'key' => 'field_footer_links', 'label' => 'Footer Links', 'name' => 'footer_links',
            'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Link',
            'sub_fields' => [
                ['key' => 'field_fl_link', 'label' => 'Link', 'name' => 'link', 'type' => 'link', 'return_format' => 'array'],
            ],
        ],
        ['key' => 'field_footer_cta', 'label' => 'CTA Button', 'name' => 'footer_cta', 'type' => 'link', 'return_format' => 'array'],
        ['key' => 'field_footer_linkedin', 'label' => 'LinkedIn URL', 'name' => 'footer_linkedin', 'type' => 'url'],
        ['key' => 'field_footer_privacy', 'label' => 'Privacy Policy URL', 'name' => 'footer_privacy_url', 'type' => 'url'],
    ],
    'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-footer']]],
    'active' => true,
]);

// ═══════════════════════════════════════════════════════
// OPTIONS: Global CTA
// ═══════════════════════════════════════════════════════
acf_add_local_field_group([
    'key'    => 'group_global_cta',
    'title'  => 'Global CTA',
    'fields' => [
        ['key' => 'field_gcta_heading',  'label' => 'Heading',         'name' => 'gcta_heading',  'type' => 'text',     'default_value' => 'CREATE A BLUEPRINT'],
        ['key' => 'field_gcta_text',     'label' => 'Body Text',       'name' => 'gcta_text',     'type' => 'textarea', 'rows' => 3],
        ['key' => 'field_gcta_btn1',     'label' => 'Primary Button',  'name' => 'gcta_btn1',     'type' => 'link',     'return_format' => 'array'],
        ['key' => 'field_gcta_btn2',     'label' => 'Outline Button',  'name' => 'gcta_btn2',     'type' => 'link',     'return_format' => 'array'],
        ['key' => 'field_gcta_bg',       'label' => 'Background Image','name' => 'gcta_bg',       'type' => 'image',    'return_format' => 'array'],
        [
            'key' => 'field_gcta_features', 'label' => 'Right-Side Feature List', 'name' => 'gcta_features',
            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Feature',
            'instructions' => 'Icon + title + short description shown as a list on the right side of the CTA.',
            'sub_fields' => [
                ['key' => 'field_gcta_f_icon',  'label' => 'Icon (image)', 'name' => 'icon',        'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
                ['key' => 'field_gcta_f_title', 'label' => 'Title',        'name' => 'title',       'type' => 'text'],
                ['key' => 'field_gcta_f_desc',  'label' => 'Description',  'name' => 'description', 'type' => 'text'],
            ],
        ],
    ],
    'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-global-cta']]],
    'active' => true,
]);

// ═══════════════════════════════════════════════════════
// OPTIONS: Global Testimonials
// ═══════════════════════════════════════════════════════
acf_add_local_field_group([
    'key'    => 'group_global_testimonials',
    'title'  => 'Global Testimonials',
    'fields' => [
        ['key' => 'field_gtm_heading', 'label' => 'Section Heading', 'name' => 'gtm_heading', 'type' => 'text', 'default_value' => 'OUR CLIENTS'],
        [
            'key' => 'field_gtm_items', 'label' => 'Testimonials', 'name' => 'gtm_items',
            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Testimonial',
            'sub_fields' => [
                ['key' => 'field_gtm_quote', 'label' => 'Quote',           'name' => 'quote',         'type' => 'textarea', 'rows' => 4],
                ['key' => 'field_gtm_name',  'label' => 'Name',            'name' => 'name',          'type' => 'text'],
                ['key' => 'field_gtm_title', 'label' => 'Title & Company', 'name' => 'title_company', 'type' => 'text'],
            ],
        ],
    ],
    'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-global-testimonials']]],
    'active' => true,
]);

// ═══════════════════════════════════════════════════════
// OPTIONS: Global Partners
// ═══════════════════════════════════════════════════════
acf_add_local_field_group([
    'key'    => 'group_global_partners',
    'title'  => 'Global Partners / Client Logos',
    'fields' => [
        ['key' => 'field_gp_heading', 'label' => 'Section Heading', 'name' => 'gp_heading', 'type' => 'text', 'default_value' => 'OUR PARTNERS'],
        [
            'key' => 'field_gp_logos', 'label' => 'Logos', 'name' => 'gp_logos',
            'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Logo',
            'sub_fields' => [
                ['key' => 'field_gp_l_logo', 'label' => 'Logo', 'name' => 'logo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
                ['key' => 'field_gp_l_link', 'label' => 'Link (optional)', 'name' => 'link', 'type' => 'url'],
            ],
        ],
    ],
    'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-global-partners']]],
    'active' => true,
]);

// ═══════════════════════════════════════════════════════
// OPTIONS: Global Core Values
// ═══════════════════════════════════════════════════════
acf_add_local_field_group([
    'key'    => 'group_global_core_values',
    'title'  => 'Global Core Values',
    'fields' => [
        ['key' => 'field_gcv_heading', 'label' => 'Heading', 'name' => 'gcv_heading', 'type' => 'text',  'default_value' => 'OUR CORE VALUES'],
        ['key' => 'field_gcv_image',   'label' => 'Image',   'name' => 'gcv_image',   'type' => 'image', 'return_format' => 'array', 'instructions' => 'Displayed below the heading/accent line and above the button in the left column.'],
        ['key' => 'field_gcv_link',    'label' => 'Button',  'name' => 'gcv_link',    'type' => 'link',  'return_format' => 'array'],
        [
            'key' => 'field_gcv_values', 'label' => 'Values', 'name' => 'gcv_values',
            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Value',
            'sub_fields' => [
                ['key' => 'field_gcv_v_title', 'label' => 'Title',       'name' => 'title',       'type' => 'text'],
                ['key' => 'field_gcv_v_desc',  'label' => 'Description', 'name' => 'description', 'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],
            ],
        ],
    ],
    'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'acf-options-global-core-values']]],
    'active' => true,
]);

// ═══════════════════════════════════════════════════════
// PAGES: Flexible Content — "Page Sections"
// ═══════════════════════════════════════════════════════
acf_add_local_field_group([
    'key'    => 'group_page_sections',
    'title'  => 'Page Sections',
    'fields' => [
        [
            'key'          => 'field_page_sections',
            'label'        => 'Sections',
            'name'         => 'page_sections',
            'type'         => 'flexible_content',
            'button_label' => 'Add Section',
            'layouts'      => [ // sorted A–Z by label

                // ── Action Plan ───────────────────────
                'layout_action_plan' => [
                    'key'        => 'layout_action_plan',
                    'name'       => 'action_plan',
                    'label'      => 'Action Plan',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_ap_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text', 'default_value' => 'ACTION PLAN'],
                        [
                            'key' => 'field_ap_steps', 'label' => 'Steps', 'name' => 'steps',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Step',
                            'instructions' => 'Add steps in order (1, 2, 3, 4, 5, 6...). The layout automatically snakes: row 1 goes left→right, row 2 goes right→left.',
                            'sub_fields' => [
                                ['key' => 'field_ap_s_label',     'label' => 'Step Label',   'name' => 'step_label',   'type' => 'text',      'default_value' => 'STEP 1', 'instructions' => 'e.g. "STEP 1", "STEP 2"'],
                                ['key' => 'field_ap_s_desc',      'label' => 'Description',  'name' => 'description',  'type' => 'textarea',  'rows' => 3],
                                ['key' => 'field_ap_s_bullets',   'label' => 'Bullet Points','name' => 'bullets',      'type' => 'textarea',  'rows' => 3, 'instructions' => 'One bullet per line.'],
                                ['key' => 'field_ap_s_highlight', 'label' => 'Highlight (orange border)', 'name' => 'highlight', 'type' => 'true_false', 'default_value' => 0, 'ui' => 1],
                            ],
                        ],
                    ],
                ],

                // ── Article Grid ──────────────────────
                'layout_article_grid' => [
                    'key'        => 'layout_article_grid',
                    'name'       => 'article_grid',
                    'label'      => 'Article Grid',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_ag_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text', 'default_value' => 'BLUEPRINTS FOR GROWTH'],
                        [
                            'key' => 'field_ag_sections', 'label' => 'Sections', 'name' => 'sections',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Section',
                            'sub_fields' => [
                                ['key' => 'field_ag_s_title', 'label' => 'Section Title', 'name' => 'section_title', 'type' => 'text'],
                                ['key' => 'field_ag_s_cat', 'label' => 'Category', 'name' => 'category', 'type' => 'taxonomy', 'taxonomy' => 'category', 'field_type' => 'select', 'return_format' => 'id', 'allow_null' => 1],
                                ['key' => 'field_ag_s_count', 'label' => 'Posts to Show', 'name' => 'posts_count', 'type' => 'number', 'default_value' => 6, 'min' => 1, 'max' => 20],
                            ],
                        ],
                    ],
                ],

                // ── Case Studies ──────────────────────
                'layout_case_studies' => [
                    'key'        => 'layout_case_studies',
                    'name'       => 'case_studies',
                    'label'      => 'Case Studies',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_cs_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text', 'default_value' => 'WHY DIGITAL STRIDE'],
                        ['key' => 'field_cs_text', 'label' => 'Description', 'name' => 'text', 'type' => 'textarea', 'rows' => 3],
                        [
                            'key' => 'field_cs_studies', 'label' => 'Case Studies', 'name' => 'studies',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Case Study',
                            'sub_fields' => [
                                ['key' => 'field_cs_s_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array'],
                                ['key' => 'field_cs_s_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                                ['key' => 'field_cs_s_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 2],
                                ['key' => 'field_cs_s_link', 'label' => 'Link', 'name' => 'link', 'type' => 'link', 'return_format' => 'array'],
                            ],
                        ],
                    ],
                ],

                // ── Community Logos ───────────────────
                'layout_community_logos' => [
                    'key'        => 'layout_community_logos',
                    'name'       => 'community_logos',
                    'label'      => 'Community Logos',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_cl_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text', 'default_value' => 'COMMUNITY INVOLVEMENT'],
                        ['key' => 'field_cl_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 3],
                        [
                            'key' => 'field_cl_logos', 'label' => 'Logos', 'name' => 'logos',
                            'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Logo',
                            'sub_fields' => [
                                ['key' => 'field_cl_l_logo', 'label' => 'Logo', 'name' => 'logo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
                            ],
                        ],
                    ],
                ],

                // ── Contact Form ─────────────────────
                'layout_contact_form' => [
                    'key'        => 'layout_contact_form',
                    'name'       => 'contact_form',
                    'label'      => 'Contact Form',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_cf_heading', 'label' => 'Section Heading', 'name' => 'heading', 'type' => 'text', 'default_value' => "LET'S CONNECT"],
                        ['key' => 'field_cf_form_heading', 'label' => 'Form Heading', 'name' => 'form_heading', 'type' => 'text', 'default_value' => 'Tell Us About Your Business'],
                        ['key' => 'field_cf_embed',     'label' => 'Form Embed Code', 'name' => 'form_embed',     'type' => 'textarea', 'rows' => 6, 'instructions' => 'Paste the full iframe embed code (e.g. from LeadConnector / GoHighLevel). Takes priority over the shortcode field below.'],
                        ['key' => 'field_cf_shortcode', 'label' => 'Form Shortcode (legacy)', 'name' => 'form_shortcode', 'type' => 'text', 'instructions' => 'Legacy: e.g. [contact-form-7 id="123"]. Leave blank if using the Embed Code field above.'],
                        ['key' => 'field_cf_info_heading', 'label' => 'Info Heading', 'name' => 'info_heading', 'type' => 'text', 'default_value' => 'Reach Out Today!'],
                        ['key' => 'field_cf_hours', 'label' => 'Business Hours', 'name' => 'business_hours', 'type' => 'text', 'default_value' => 'Monday-Friday, 9 a.m.-5 p.m. ET'],
                        ['key' => 'field_cf_email', 'label' => 'Email', 'name' => 'email', 'type' => 'email', 'default_value' => 'Results@MyDigitalStride.com'],
                        ['key' => 'field_cf_phone', 'label' => 'Phone', 'name' => 'phone', 'type' => 'text', 'default_value' => '(717) 727-1400'],
                        ['key' => 'field_cf_address', 'label' => 'Address', 'name' => 'address', 'type' => 'text', 'default_value' => '410 Kings Mill Rd, Suite 107B, York, PA 17401'],
                        ['key' => 'field_cf_map', 'label' => 'Google Maps URL', 'name' => 'map_url', 'type' => 'url'],
                    ],
                ],

                // ── Core Values ───────────────────────
                'layout_core_values' => [
                    'key'        => 'layout_core_values',
                    'name'       => 'core_values',
                    'label'      => 'Txt Img Btn | Accordion',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_cv_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text', 'default_value' => 'OUR CORE VALUES'],
                        ['key' => 'field_cv_link', 'label' => 'Button', 'name' => 'link', 'type' => 'link', 'return_format' => 'array'],
                        [
                            'key' => 'field_cv_values', 'label' => 'Values', 'name' => 'values',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Value',
                            'sub_fields' => [
                                ['key' => 'field_cv_v_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                                ['key' => 'field_cv_v_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],
                            ],
                        ],
                    ],
                ],

                // ── CTA Banner ────────────────────────
                'layout_cta_banner' => [
                    'key'        => 'layout_cta_banner',
                    'name'       => 'cta_banner',
                    'label'      => 'CTA Banner',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_cta_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text', 'default_value' => 'CREATE A BLUEPRINT'],
                        ['key' => 'field_cta_text', 'label' => 'Text', 'name' => 'text', 'type' => 'textarea', 'rows' => 3],
                        ['key' => 'field_cta_subtext', 'label' => 'Subtext', 'name' => 'subtext', 'type' => 'text'],
                        ['key' => 'field_cta_btn1', 'label' => 'Primary Button', 'name' => 'primary_button', 'type' => 'link', 'return_format' => 'array'],
                        ['key' => 'field_cta_btn2', 'label' => 'Secondary Button', 'name' => 'secondary_button', 'type' => 'link', 'return_format' => 'array'],
                        ['key' => 'field_cta_bg', 'label' => 'Background Image', 'name' => 'background_image', 'type' => 'image', 'return_format' => 'array', 'instructions' => 'Optional background image. Gradient overlay applied automatically.'],
                        [
                            'key' => 'field_cta_carousel', 'label' => 'Carousel Images', 'name' => 'carousel_images',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Slide', 'max' => 8,
                            'instructions' => 'Add images for a right-side carousel. Leave empty for centered text layout.',
                            'sub_fields' => [
                                ['key' => 'field_cta_carousel_img', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array'],
                                ['key' => 'field_cta_carousel_caption', 'label' => 'Caption', 'name' => 'caption', 'type' => 'text'],
                            ],
                        ],
                    ],
                ],

                // ── FAQ ──────────────────────────────
                'layout_faq' => [
                    'key'        => 'layout_faq',
                    'name'       => 'faq',
                    'label'      => 'FAQ',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_faq_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text', 'default_value' => 'Frequently Asked Questions'],
                        [
                            'key' => 'field_faq_questions', 'label' => 'Questions', 'name' => 'questions',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Question',
                            'sub_fields' => [
                                ['key' => 'field_faq_q', 'label' => 'Question', 'name' => 'question', 'type' => 'text'],
                                ['key' => 'field_faq_a', 'label' => 'Answer', 'name' => 'answer', 'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],
                            ],
                        ],
                    ],
                ],

                // ── Feature Strip ─────────────────────
                'layout_feature_strip' => [
                    'key'        => 'layout_feature_strip',
                    'name'       => 'feature_strip',
                    'label'      => 'Feature Strip',
                    'display'    => 'block',
                    'sub_fields' => [
                        [
                            'key' => 'field_fs_features', 'label' => 'Features', 'name' => 'features',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Feature', 'max' => 4,
                            'sub_fields' => [
                                ['key' => 'field_fs_f_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'image', 'return_format' => 'array'],
                                ['key' => 'field_fs_f_icon_color', 'label' => 'Icon Color', 'name' => 'icon_color', 'type' => 'select', 'choices' => $ds_icon_color_choices, 'default_value' => '', 'wrapper' => ['width' => '25']],
                                ['key' => 'field_fs_f_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                                ['key' => 'field_fs_f_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 2],
                            ],
                        ],
                    ],
                ],

                // ── Full-Width Angled Carousel ────────
                'layout_fullwidth_carousel' => [
                    'key'        => 'layout_fullwidth_carousel',
                    'name'       => 'fullwidth_carousel',
                    'label'      => 'Full-Width Angled Carousel',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_fwc_heading', 'label' => 'Heading (optional)', 'name' => 'heading', 'type' => 'text'],
                        [
                            'key' => 'field_fwc_slides', 'label' => 'Slides', 'name' => 'slides',
                            'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Slide',
                            'instructions' => 'Add 3+ images. The carousel shows one center + two angled side panels at a time.',
                            'sub_fields' => [
                                ['key' => 'field_fwc_s_image',   'label' => 'Image',            'name' => 'image',   'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
                                ['key' => 'field_fwc_s_caption', 'label' => 'Caption (optional)','name' => 'caption', 'type' => 'text'],
                            ],
                        ],
                    ],
                ],

                // ── Gallery Grid ──────────────────────
                'layout_gallery_grid' => [
                    'key'        => 'layout_gallery_grid',
                    'name'       => 'gallery_grid',
                    'label'      => 'Gallery Grid',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_gg_heading',    'label' => 'Heading',    'name' => 'heading',    'type' => 'text'],
                        ['key' => 'field_gg_subheading', 'label' => 'Subheading', 'name' => 'subheading', 'type' => 'text'],
                        ['key' => 'field_gg_text',       'label' => 'Text',       'name' => 'text',       'type' => 'wysiwyg', 'tabs' => 'all', 'toolbar' => 'basic', 'media_upload' => 0],
                        [
                            'key'           => 'field_gg_columns',
                            'label'         => 'Columns',
                            'name'          => 'columns',
                            'type'          => 'select',
                            'choices'       => ['2' => '2 Columns', '3' => '3 Columns', '4' => '4 Columns'],
                            'default_value' => '3',
                        ],
                        [
                            'key' => 'field_gg_images', 'label' => 'Images', 'name' => 'images',
                            'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Image',
                            'sub_fields' => [
                                ['key' => 'field_gg_i_image',   'label' => 'Image',              'name' => 'image',   'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
                                ['key' => 'field_gg_i_caption', 'label' => 'Caption (optional)', 'name' => 'caption', 'type' => 'text'],
                                ['key' => 'field_gg_i_link',    'label' => 'Link (optional)',    'name' => 'link',    'type' => 'url',   'instructions' => 'If set, clicking opens this URL instead of the lightbox.'],
                            ],
                        ],
                    ],
                ],

                // ── Geographic Callout ────────────────
                'layout_geo_callout' => [
                    'key'        => 'layout_geo_callout',
                    'name'       => 'geo_callout',
                    'label'      => 'Geographic Callout',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_geo_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text',     'default_value' => 'CENTRAL PA + BEYOND'],
                        ['key' => 'field_geo_text',    'label' => 'Text',    'name' => 'text',    'type' => 'textarea', 'rows' => 3],
                        ['key' => 'field_geo_image',   'label' => 'Outline / Region Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'instructions' => 'PNG with transparent background (e.g. white-outline state map). Displayed on the left over a teal radial glow.'],
                    ],
                ],

                // ── Global Core Values ────────────────
                'layout_global_core_values' => [
                    'key'        => 'layout_global_core_values',
                    'name'       => 'global_core_values',
                    'label'      => 'Global Core Values',
                    'display'    => 'block',
                    'sub_fields' => [],
                ],

                // ── Global CTA Block ──────────────────
                'layout_global_cta' => [
                    'key'        => 'layout_global_cta',
                    'name'       => 'global_cta',
                    'label'      => 'Global CTA Block',
                    'display'    => 'block',
                    'sub_fields' => [],
                ],

                // ── Global Partners / Client Logos ────
                'layout_global_partners' => [
                    'key'        => 'layout_global_partners',
                    'name'       => 'global_partners',
                    'label'      => 'Global Partners / Client Logos',
                    'display'    => 'block',
                    'sub_fields' => [],
                ],

                // ── Global Testimonials ───────────────
                'layout_global_testimonials' => [
                    'key'        => 'layout_global_testimonials',
                    'name'       => 'global_testimonials',
                    'label'      => 'Global Testimonials',
                    'display'    => 'block',
                    'sub_fields' => [],
                ],

                // ── Hero ──────────────────────────────
                'layout_hero' => [
                    'key'        => 'layout_hero',
                    'name'       => 'hero',
                    'label'      => 'Hero',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_hero_heading',          'label' => 'Heading',          'name' => 'heading',          'type' => 'text'],
                        ['key' => 'field_hero_subheading',       'label' => 'Subheading',       'name' => 'subheading',       'type' => 'text', 'instructions' => 'Italic tagline displayed above the main heading.'],
                        ['key' => 'field_hero_text',             'label' => 'Body Text',        'name' => 'body_text',        'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],
                        ['key' => 'field_hero_cta',              'label' => 'CTA Button',       'name' => 'cta_button',       'type' => 'link', 'return_format' => 'array'],
                        ['key' => 'field_hero_bg',               'label' => 'Background Image', 'name' => 'background_image', 'type' => 'image', 'return_format' => 'array', 'instructions' => 'Full-width background. Gradient overlay is applied automatically.'],
                        [
                            'key' => 'field_hero_carousel', 'label' => 'Carousel Images', 'name' => 'carousel_images',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Slide', 'max' => 8,
                            'instructions' => 'Add images for the right-side carousel. Leave empty for full-width text hero.',
                            'sub_fields' => [
                                ['key' => 'field_hero_carousel_img',     'label' => 'Image',   'name' => 'image',   'type' => 'image', 'return_format' => 'array'],
                                ['key' => 'field_hero_carousel_caption', 'label' => 'Caption', 'name' => 'caption', 'type' => 'text'],
                            ],
                        ],
                    ],
                ],

                // ── Icon List ─────────────────────────
                'layout_icon_list' => [
                    'key'        => 'layout_icon_list',
                    'name'       => 'icon_list',
                    'label'      => 'Icon List',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_il_heading', 'label' => 'Heading',          'name' => 'heading',          'type' => 'text'],
                        ['key' => 'field_il_intro',   'label' => 'Intro Text',       'name' => 'intro_text',       'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],
                        ['key' => 'field_il_bg',      'label' => 'Background Image', 'name' => 'background_image', 'type' => 'image', 'return_format' => 'array', 'instructions' => 'Optional. A gradient overlay is applied automatically.'],
                        ['key' => 'field_il_cta',     'label' => 'CTA Button',       'name' => 'cta_button',       'type' => 'link', 'return_format' => 'array'],
                        [
                            'key' => 'field_il_items', 'label' => 'Items', 'name' => 'items',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Item',
                            'sub_fields' => [
                                ['key' => 'field_il_i_icon',       'label' => 'Icon',        'name' => 'icon',        'type' => 'image',  'return_format' => 'array', 'preview_size' => 'thumbnail'],
                                ['key' => 'field_il_i_icon_color', 'label' => 'Icon Color',  'name' => 'icon_color',  'type' => 'select', 'choices' => ['' => 'Default (white)', 'white' => 'White', 'navy' => 'Navy', 'blue-gradient' => 'Blue Gradient', 'orange-gradient' => 'Orange Gradient'], 'default_value' => ''],
                                ['key' => 'field_il_i_title',      'label' => 'Title',       'name' => 'title',       'type' => 'text'],
                                ['key' => 'field_il_i_desc',       'label' => 'Description', 'name' => 'description', 'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0],
                            ],
                        ],
                    ],
                ],

                // ── Pain Point Cards ──────────────────
                'layout_pain_point_cards' => [
                    'key'        => 'layout_pain_point_cards',
                    'name'       => 'pain_point_cards',
                    'label'      => 'Pain Point Cards',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_ig_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text', 'default_value' => 'INDUSTRIES WE SERVE'],
                        [
                            'key' => 'field_ig_industries', 'label' => 'Industries', 'name' => 'industries',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Industry',
                            'sub_fields' => [
                                ['key' => 'field_ig_i_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'image', 'return_format' => 'array'],
                                ['key' => 'field_ig_i_icon_color', 'label' => 'Icon Color', 'name' => 'icon_color', 'type' => 'select', 'choices' => $ds_icon_color_choices, 'default_value' => '', 'wrapper' => ['width' => '25']],
                                ['key' => 'field_ig_i_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                                ['key' => 'field_ig_i_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 3],
                            ],
                        ],
                    ],
                ],

                // ── Industry Tabs ────────────────────
                'layout_industry_tabs' => [
                    'key'        => 'layout_industry_tabs',
                    'name'       => 'industry_tabs',
                    'label'      => 'Industry Tabs',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_it_heading',    'label' => 'Heading',    'name' => 'heading',    'type' => 'text'],
                        ['key' => 'field_it_subheading', 'label' => 'Subheading', 'name' => 'subheading', 'type' => 'text'],
                        [
                            'key' => 'field_it_industries', 'label' => 'Industries', 'name' => 'industries',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Industry',
                            'sub_fields' => [
                                ['key' => 'field_it_i_title', 'label' => 'Tab Title',   'name' => 'title',       'type' => 'text'],
                                ['key' => 'field_it_i_image', 'label' => 'Image',        'name' => 'image',       'type' => 'image',    'return_format' => 'array', 'instructions' => 'Displayed at a fixed size with cover fit — all images will be cropped uniformly.'],
                                ['key' => 'field_it_i_desc',  'label' => 'Description', 'name' => 'description', 'type' => 'wysiwyg',  'toolbar' => 'basic', 'media_upload' => 0],
                                [
                                    'key' => 'field_it_i_features', 'label' => 'Feature List', 'name' => 'features',
                                    'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Feature',
                                    'instructions' => 'Optional icon + heading + text items shown below the description.',
                                    'sub_fields' => [
                                        ['key' => 'field_it_f_icon',  'label' => 'Icon',        'name' => 'icon',          'type' => 'image',    'return_format' => 'array', 'preview_size' => 'thumbnail'],
                                        ['key' => 'field_it_f_title', 'label' => 'Feature Title','name' => 'feature_title', 'type' => 'text'],
                                        ['key' => 'field_it_f_text',  'label' => 'Feature Text', 'name' => 'feature_text',  'type' => 'textarea', 'rows' => 2],
                                    ],
                                ],
                                ['key' => 'field_it_i_cta',   'label' => 'CTA Button',  'name' => 'cta_button',  'type' => 'link',     'return_format' => 'array'],
                            ],
                        ],
                    ],
                ],

                // ── Partner Logos ─────────────────────
                'layout_partner_logos' => [
                    'key'        => 'layout_partner_logos',
                    'name'       => 'partner_logos',
                    'label'      => 'Scrolling Image Carousel',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_pl_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text', 'default_value' => 'OUR PARTNERS'],
                        [
                            'key' => 'field_pl_logos', 'label' => 'Logos', 'name' => 'logos',
                            'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Logo',
                            'sub_fields' => [
                                ['key' => 'field_pl_l_logo', 'label' => 'Logo', 'name' => 'logo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
                                ['key' => 'field_pl_l_link', 'label' => 'Link (optional)', 'name' => 'link', 'type' => 'url'],
                            ],
                        ],
                    ],
                ],

                // ── Portfolio Showcase ────────────────
                'layout_portfolio_showcase' => [
                    'key'        => 'layout_portfolio_showcase',
                    'name'       => 'portfolio_showcase',
                    'label'      => 'Portfolio Showcase',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_ps2_heading',    'label' => 'Heading',    'name' => 'heading',    'type' => 'text', 'default_value' => 'OUR WORK'],
                        ['key' => 'field_ps2_subheading', 'label' => 'Subheading', 'name' => 'subheading', 'type' => 'text'],
                        ['key' => 'field_ps2_text',       'label' => 'Text',       'name' => 'text',       'type' => 'wysiwyg', 'tabs' => 'all', 'toolbar' => 'basic', 'media_upload' => 0],
                        [
                            'key' => 'field_ps2_projects', 'label' => 'Projects', 'name' => 'projects',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Project',
                            'sub_fields' => [
                                ['key' => 'field_ps2_p_image',    'label' => 'Device Mockup Image', 'name' => 'mockup_image',   'type' => 'image',    'return_format' => 'array', 'instructions' => 'Upload a device mockup (laptop + phone, laptop only, etc.) as a PNG or WebP.'],
                                ['key' => 'field_ps2_p_name',     'label' => 'Project / Site Name', 'name' => 'project_name',   'type' => 'text'],
                                ['key' => 'field_ps2_p_category', 'label' => 'Category / Industry', 'name' => 'category',       'type' => 'text',     'instructions' => 'e.g. "Construction", "Healthcare", "E-Commerce"'],
                                ['key' => 'field_ps2_p_desc',     'label' => 'Description',         'name' => 'description',    'type' => 'textarea', 'rows' => 3],
                                ['key' => 'field_ps2_p_url',      'label' => 'Site URL',            'name' => 'site_url',       'type' => 'url'],
                            ],
                        ],
                    ],
                ],

                // ── Pricing Feature Table ─────────────
                'layout_pricing_feature_table' => [
                    'key'        => 'layout_pricing_feature_table',
                    'name'       => 'pricing_feature_table',
                    'label'      => 'Pricing Feature Table',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_pft_heading',    'label' => 'Heading',    'name' => 'heading',    'type' => 'text'],
                        ['key' => 'field_pft_disclaimer', 'label' => 'Disclaimer', 'name' => 'disclaimer', 'type' => 'text', 'instructions' => 'Small italic note at bottom, e.g. "*Based on historical data..."'],
                        [
                            'key' => 'field_pft_tabs', 'label' => 'Service Tabs', 'name' => 'tabs',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Service Tab',
                            'sub_fields' => [
                                ['key' => 'field_pft_t_name',  'label' => 'Tab Name',               'name' => 'tab_name',    'type' => 'text', 'instructions' => 'e.g. "SEO", "Digital Advertising"'],
                                ['key' => 'field_pft_t_tier1', 'label' => 'Tier 1 Name',            'name' => 'tier_1_name', 'type' => 'text', 'default_value' => 'Journey'],
                                ['key' => 'field_pft_t_tier2', 'label' => 'Tier 2 Name',            'name' => 'tier_2_name', 'type' => 'text', 'default_value' => 'Master'],
                                ['key' => 'field_pft_t_tier3', 'label' => 'Tier 3 Name',            'name' => 'tier_3_name', 'type' => 'text', 'default_value' => 'Enterprise'],
                                ['key' => 'field_pft_t_tier4', 'label' => 'Tier 4 Name (optional)', 'name' => 'tier_4_name', 'type' => 'text'],
                                ['key' => 'field_pft_t_cta',   'label' => 'CTA Button',             'name' => 'cta_button',  'type' => 'link', 'return_format' => 'array'],
                                [
                                    'key' => 'field_pft_t_rows', 'label' => 'Feature Rows', 'name' => 'rows',
                                    'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Row',
                                    'instructions' => 'Enter "yes"/"no" for check/X icons. Any other text (e.g. "$395", "15 Months") displays as-is.',
                                    'sub_fields' => [
                                        ['key' => 'field_pft_r_feature', 'label' => 'Feature Name', 'name' => 'feature_name', 'type' => 'text'],
                                        ['key' => 'field_pft_r_v1',      'label' => 'Tier 1 Value', 'name' => 'tier_1_value', 'type' => 'text'],
                                        ['key' => 'field_pft_r_v2',      'label' => 'Tier 2 Value', 'name' => 'tier_2_value', 'type' => 'text'],
                                        ['key' => 'field_pft_r_v3',      'label' => 'Tier 3 Value', 'name' => 'tier_3_value', 'type' => 'text'],
                                        ['key' => 'field_pft_r_v4',      'label' => 'Tier 4 Value', 'name' => 'tier_4_value', 'type' => 'text'],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],

                // ── Pricing Stack Cards ───────────────
                'layout_pricing_stack' => [
                    'key'        => 'layout_pricing_stack',
                    'name'       => 'pricing_stack',
                    'label'      => 'Pricing Stack Cards',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_pstack_heading',    'label' => 'Heading',    'name' => 'heading',    'type' => 'text'],
                        ['key' => 'field_pstack_subheading', 'label' => 'Subheading', 'name' => 'subheading', 'type' => 'text'],
                        [
                            'key' => 'field_pstack_cards', 'label' => 'Cards', 'name' => 'cards',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Card',
                            'instructions' => 'Add 3+ cards. The middle card starts as the featured/active card.',
                            'sub_fields' => [
                                ['key' => 'field_pstack_c_title',  'label' => 'Title',          'name' => 'title',         'type' => 'text'],
                                ['key' => 'field_pstack_c_desc',   'label' => 'Description',    'name' => 'description',   'type' => 'textarea', 'rows' => 2],
                                ['key' => 'field_pstack_c_slabel', 'label' => 'Services Label', 'name' => 'services_label','type' => 'text',  'default_value' => 'Services Included'],
                                ['key' => 'field_pstack_c_svcs',   'label' => 'Services List',  'name' => 'services',      'type' => 'textarea', 'rows' => 4, 'instructions' => 'One service per line.'],
                                ['key' => 'field_pstack_c_price',  'label' => 'Price Text',     'name' => 'price_text',    'type' => 'text', 'instructions' => 'e.g. "Packages starting at $345"'],
                                ['key' => 'field_pstack_c_btn',    'label' => 'Button Text',    'name' => 'button_text',   'type' => 'text'],
                                ['key' => 'field_pstack_c_link',   'label' => 'Button Link',    'name' => 'button_link',   'type' => 'url'],
                            ],
                        ],
                    ],
                ],

                // ── Pricing Tables ────────────────────
                'layout_pricing_tables' => [
                    'key'        => 'layout_pricing_tables',
                    'name'       => 'pricing_tables',
                    'label'      => 'Pricing Tables',
                    'display'    => 'block',
                    'sub_fields' => [
                        [
                            'key' => 'field_pt_tables', 'label' => 'Tables', 'name' => 'tables',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Table',
                            'sub_fields' => [
                                ['key' => 'field_pt_t_name', 'label' => 'Service Name', 'name' => 'service_name', 'type' => 'text'],
                                [
                                    'key' => 'field_pt_t_tiers', 'label' => 'Tiers', 'name' => 'tiers',
                                    'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Tier', 'max' => 4,
                                    'sub_fields' => [
                                        ['key' => 'field_pt_tier_name', 'label' => 'Tier Name', 'name' => 'name', 'type' => 'text'],
                                        ['key' => 'field_pt_tier_price', 'label' => 'Price', 'name' => 'price', 'type' => 'text'],
                                        [
                                            'key' => 'field_pt_tier_feats', 'label' => 'Features', 'name' => 'features',
                                            'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Feature',
                                            'sub_fields' => [
                                                ['key' => 'field_pt_f_text', 'label' => 'Feature', 'name' => 'feature_text', 'type' => 'text'],
                                                ['key' => 'field_pt_f_incl', 'label' => 'Included', 'name' => 'included', 'type' => 'true_false', 'default_value' => 1, 'ui' => 1],
                                            ],
                                        ],
                                    ],
                                ],
                                ['key' => 'field_pt_t_note', 'label' => 'Note', 'name' => 'note', 'type' => 'text'],
                                ['key' => 'field_pt_t_cta', 'label' => 'CTA Button', 'name' => 'cta_button', 'type' => 'link', 'return_format' => 'array'],
                            ],
                        ],
                    ],
                ],

                // ── Process Steps ─────────────────────
                'layout_process_steps' => [
                    'key'        => 'layout_process_steps',
                    'name'       => 'process_steps',
                    'label'      => 'Process Steps',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_ps_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text', 'default_value' => 'HOW WE HELP'],
                        [
                            'key' => 'field_ps_steps', 'label' => 'Steps', 'name' => 'steps',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Step', 'max' => 4,
                            'sub_fields' => [
                                ['key' => 'field_ps_s_title', 'label' => 'Title',       'name' => 'title',       'type' => 'text'],
                                ['key' => 'field_ps_s_desc',  'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 2],
                                ['key' => 'field_ps_s_image', 'label' => 'Card Image',  'name' => 'image',       'type' => 'image', 'return_format' => 'array', 'instructions' => 'Background image for the hover card. Will be cropped to fill the card.'],
                            ],
                        ],
                        ['key' => 'field_ps_cta', 'label' => 'CTA Button', 'name' => 'cta_button', 'type' => 'link', 'return_format' => 'array'],
                    ],
                ],

                // ── Service Detail Blocks ─────────────
                'layout_service_detail_blocks' => [
                    'key'        => 'layout_service_detail_blocks',
                    'name'       => 'service_detail_blocks',
                    'label'      => 'Service Detail Blocks',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_sdb_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text', 'default_value' => 'OUR SERVICES'],
                        [
                            'key' => 'field_sdb_services', 'label' => 'Services', 'name' => 'services',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Service',
                            'sub_fields' => [
                                ['key' => 'field_sdb_s_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'image', 'return_format' => 'array'],
                                ['key' => 'field_sdb_s_icon_color', 'label' => 'Icon Color', 'name' => 'icon_color', 'type' => 'select', 'choices' => $ds_icon_color_choices, 'default_value' => '', 'wrapper' => ['width' => '25']],
                                ['key' => 'field_sdb_s_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                                [
                                    'key' => 'field_sdb_s_subs', 'label' => 'Sub-Services', 'name' => 'sub_services',
                                    'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Sub-Service',
                                    'sub_fields' => [
                                        ['key' => 'field_sdb_ss_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'image', 'return_format' => 'array'],
                                        ['key' => 'field_sdb_ss_icon_color', 'label' => 'Icon Color', 'name' => 'icon_color', 'type' => 'select', 'choices' => $ds_icon_color_choices, 'default_value' => '', 'wrapper' => ['width' => '25']],
                                        ['key' => 'field_sdb_ss_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                                        ['key' => 'field_sdb_ss_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 3],
                                    ],
                                ],
                                ['key' => 'field_sdb_s_cta', 'label' => 'CTA Button', 'name' => 'cta_button', 'type' => 'link', 'return_format' => 'array'],
                            ],
                        ],
                    ],
                ],

                // ── Shortcode ─────────────────────────
                'layout_shortcode' => [
                    'key'        => 'layout_shortcode',
                    'name'       => 'shortcode',
                    'label'      => 'Shortcode',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_shortcode_heading', 'label' => 'Heading (optional)', 'name' => 'heading', 'type' => 'text'],
                        ['key' => 'field_shortcode_code', 'label' => 'Shortcode', 'name' => 'shortcode', 'type' => 'textarea', 'rows' => 3, 'instructions' => 'Enter a WordPress shortcode, e.g. [contact-form-7 id="123"]. It will be rendered/executed on the page.'],
                    ],
                ],

                // ── Split Content ─────────────────────
                'layout_split_content' => [
                    'key'        => 'layout_split_content',
                    'name'       => 'split_content',
                    'label'      => 'Split Content',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_sc_heading',  'label' => 'Heading',          'name' => 'heading',          'type' => 'text'],
                        ['key' => 'field_sc_content',  'label' => 'Body Content',     'name' => 'body_content',     'type' => 'wysiwyg', 'toolbar' => 'full', 'media_upload' => 0, 'instructions' => 'Supports bullet lists, bold text, etc. Bold a word then follow it with a colon for the "label: text" style.'],
                        ['key' => 'field_sc_image',    'label' => 'Image',            'name' => 'image',            'type' => 'image', 'return_format' => 'array'],
                        ['key' => 'field_sc_cta',      'label' => 'CTA Button',       'name' => 'cta_button',       'type' => 'link',  'return_format' => 'array'],
                        ['key' => 'field_sc_bg',       'label' => 'Background Image', 'name' => 'background_image', 'type' => 'image', 'return_format' => 'array', 'instructions' => 'Optional. Gradient overlay applied automatically.'],
                        ['key' => 'field_sc_flip',     'label' => 'Flip Layout (image on right)', 'name' => 'flip_layout', 'type' => 'true_false', 'default_value' => 0, 'ui' => 1],
                    ],
                ],

                // ── Services Accordion ────────────────
                'layout_services_accordion' => [
                    'key'        => 'layout_services_accordion',
                    'name'       => 'services_accordion',
                    'label'      => 'Services Accordion',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_sa_heading',    'label' => 'Heading',    'name' => 'heading',     'type' => 'text',    'default_value' => 'OUR SERVICES'],
                        ['key' => 'field_sa_intro_text', 'label' => 'Intro Text', 'name' => 'intro_text',  'type' => 'wysiwyg', 'toolbar' => 'basic', 'media_upload' => 0, 'instructions' => 'Optional text shown below the heading and accent line, before the accordion.'],
                        [
                            'key' => 'field_sa_services', 'label' => 'Services', 'name' => 'services',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Service',
                            'sub_fields' => [
                                ['key' => 'field_sa_s_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'image', 'return_format' => 'array'],
                                ['key' => 'field_sa_s_icon_color', 'label' => 'Icon Color', 'name' => 'icon_color', 'type' => 'select', 'choices' => $ds_icon_color_choices, 'default_value' => '', 'wrapper' => ['width' => '25']],
                                ['key' => 'field_sa_s_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                                [
                                    'key' => 'field_sa_s_subs', 'label' => 'Sub-Services', 'name' => 'sub_services',
                                    'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Sub-Service',
                                    'sub_fields' => [
                                        ['key' => 'field_sa_ss_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'image', 'return_format' => 'array'],
                                        ['key' => 'field_sa_ss_icon_color', 'label' => 'Icon Color', 'name' => 'icon_color', 'type' => 'select', 'choices' => $ds_icon_color_choices, 'default_value' => '', 'wrapper' => ['width' => '25']],
                                        ['key' => 'field_sa_ss_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
                                        ['key' => 'field_sa_ss_desc', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 3],
                                        ['key' => 'field_sa_ss_link', 'label' => 'Link', 'name' => 'link', 'type' => 'link', 'return_format' => 'array', 'instructions' => 'Optional link displayed at the end of this sub-service.'],
                                    ],
                                ],
                                ['key' => 'field_sa_s_cta', 'label' => 'CTA Button', 'name' => 'cta_button', 'type' => 'link', 'return_format' => 'array'],
                            ],
                        ],
                    ],
                ],

                // ── Stats Bar ─────────────────────────
                'layout_stats_bar' => [
                    'key'        => 'layout_stats_bar',
                    'name'       => 'stats_bar',
                    'label'      => 'Stats Bar',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_sb_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text', 'default_value' => 'WHY DIGITAL STRIDE'],
                        [
                            'key' => 'field_sb_stats', 'label' => 'Stats', 'name' => 'stats',
                            'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Stat', 'max' => 4,
                            'sub_fields' => [
                                ['key' => 'field_sb_s_icon', 'label' => 'Icon', 'name' => 'icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
                                ['key' => 'field_sb_s_icon_color', 'label' => 'Icon Color', 'name' => 'icon_color', 'type' => 'select', 'choices' => $ds_icon_color_choices, 'default_value' => '', 'wrapper' => ['width' => '25']],
                                ['key' => 'field_sb_s_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text'],
                                ['key' => 'field_sb_s_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text'],
                            ],
                        ],
                    ],
                ],

                // ── Team Grid ─────────────────────────
                'layout_team_grid' => [
                    'key'        => 'layout_team_grid',
                    'name'       => 'team_grid',
                    'label'      => 'Team Grid',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_tg_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text', 'default_value' => 'THE DIGITAL STRIDE TEAM'],
                        [
                            'key' => 'field_tg_members', 'label' => 'Team Members', 'name' => 'members',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Member',
                            'sub_fields' => [
                                ['key' => 'field_tg_m_photo', 'label' => 'Photo', 'name' => 'photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
                                ['key' => 'field_tg_m_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text'],
                                ['key' => 'field_tg_m_role', 'label' => 'Role', 'name' => 'role', 'type' => 'text'],
                            ],
                        ],
                        ['key' => 'field_tg_pet_heading', 'label' => 'Fur-keters Heading', 'name' => 'pet_heading', 'type' => 'text', 'default_value' => 'OUR FUR-KETERS'],
                        [
                            'key' => 'field_tg_pets', 'label' => 'Fur-keters', 'name' => 'pets',
                            'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Fur-keter',
                            'sub_fields' => [
                                ['key' => 'field_tg_p_photo', 'label' => 'Photo', 'name' => 'photo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail'],
                                ['key' => 'field_tg_p_name', 'label' => 'Name', 'name' => 'name', 'type' => 'text'],
                                ['key' => 'field_tg_p_role', 'label' => 'Role', 'name' => 'role', 'type' => 'text'],
                            ],
                        ],
                    ],
                ],

                // ── Text Block ────────────────────────
                'layout_text_block' => [
                    'key'        => 'layout_text_block',
                    'name'       => 'text_block',
                    'label'      => 'Text Block',
                    'display'    => 'block',
                    'sub_fields' => [
                        ['key' => 'field_tb_heading', 'label' => 'Heading', 'name' => 'heading', 'type' => 'text'],
                        ['key' => 'field_tb_content', 'label' => 'Content', 'name' => 'content', 'type' => 'wysiwyg', 'toolbar' => 'full', 'media_upload' => 1],
                    ],
                ],

            ], // end layouts
        ],
    ],
    'location' => [
        [['param' => 'post_type', 'operator' => '==', 'value' => 'page']],
        [['param' => 'post_type', 'operator' => '==', 'value' => 'post']],
    ],
    'menu_order'            => 0,
    'position'              => 'acf_after_title',
    'style'                 => 'seamless',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
    'active'                => true,
]);
