<?php
if (!class_exists('ReduxFramework')) {
    return;
}
if (class_exists('ReduxFrameworkPlugin')) {
    //remove_ef5_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);
    remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
}
$opt_name = sunix_get_theme_opt_name();
$theme = wp_get_theme();
$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type'            => class_exists('EF5Systems') ? 'submenu' : '',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__('Theme Options', 'sunix'),
    'page_title'           => esc_html__('Theme Options', 'sunix'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => false,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-admin-generic',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    // Show the time the page took to load, etc
    'update_notice'        => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
//    'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => class_exists('EF5Systems') ? $theme->get('TextDomain') : '',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => 'theme-options',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    ),
);

Redux::SetArgs($opt_name, $args);

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('General', 'sunix'),
    'icon'   => 'el-icon-home',
    'fields' => array_merge(
        sunix_general_opts()
    )
));

/*--------------------------------------------------------------
# Header Top
--------------------------------------------------------------*/
Redux::setSection($opt_name, array(
    'title'         => esc_html__('Header Top', 'sunix'),
    'heading'       => '',
    'icon'          => 'el-icon-credit-card',
    'fields'        => sunix_header_top_opts()
    )
);
/*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Header', 'sunix'),
    'icon'   => 'el-icon-website',
    'fields' => array_merge(
        sunix_header_opts(),
        sunix_header_atts()
    )
));

Redux::setSection($opt_name, sunix_header_main_logo());
/* Ontop Header */
Redux::setSection($opt_name, sunix_ontop_header_opts());
/* Sticky Header */
Redux::setSection($opt_name, sunix_sticky_header_opts());

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Dropdown & Mobile Menu', 'sunix'),
    'icon'       => 'el-icon-lines',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'dropdown_bg',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Dropdown Background', 'sunix'),
            'subtitle' => esc_html__('Choose dropdown background color', 'sunix'),
            'output'   => array(
                'background-color' => '.oc-header-menu .sub-menu',
            )
        ),
        array(
            'id'          => 'dropdown_text_color',
            'type'        => 'color_rgba',
            'title'       => esc_html__('Text Color', 'sunix'),
            'default'     => '',
            'output'      => array('.oc-header-menu ul'),
        ),
        array(
            'id'    => 'dropdown_link_colors',
            'type'  => 'link_color',
            'title' => esc_html__('Link colors', 'sunix'),
            'output' => array(
                'color' => '.oc-header-menu ul a'
            ),
        ),
    )
));
/*--------------------------------------------------------------
# Page Title area
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Page Title', 'sunix'),
    'icon'   => 'el-icon-map-marker',
    'fields' => sunix_page_title_opts()
));

/*--------------------------------------------------------------
# WordPress default content
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title' => esc_html__('Content', 'sunix'),
    'icon'  => 'el-icon-pencil',
    'fields'  => array(
        array(
            'title'     => esc_html__('Padding', 'sunix'),
            'subtitle'  => esc_html__('Choose space for: Top, Right, Bottom, Left', 'sunix'),
            'id'        => 'main_padding',
            'type'      => 'spacing',
            'mode'      => 'padding',
            'units'     => array('px'),
            'default'   => array(),
            'output'    => array('.red-main')
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Archive', 'sunix'),
    'icon'       => 'el-icon-list',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'archive_sidebar_pos',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Position', 'sunix'),
            'subtitle' => esc_html__('Select a sidebar position for blog home, archive, search...', 'sunix'),
            'options'  => array(
                'left'  => esc_html__('Left', 'sunix'),
                'right' => esc_html__('Right', 'sunix'),
                'none'  => esc_html__('Disabled', 'sunix')
            ),
            'default'  => sunix_archive_sidebar_position()
        ),
        array(
            'id'       => 'archive_author_on',
            'title'    => esc_html__('Author', 'sunix'),
            'subtitle' => esc_html__('Show author name on each post.', 'sunix'),
            'type'     => 'switch',
            'default'  => '1',
        ),
        array(
            'id'       => 'archive_date_on',
            'title'    => esc_html__('Date', 'sunix'),
            'subtitle' => esc_html__('Show date posted on each post.', 'sunix'),
            'type'     => 'switch',
            'default'  => '1',
        ),
        array(
            'id'       => 'archive_categories_on',
            'title'    => esc_html__('Categories', 'sunix'),
            'subtitle' => esc_html__('Show category names on each post.', 'sunix'),
            'type'     => 'switch',
            'default'  => '1',
        ),
        array(
            'id'       => 'archive_tags_on',
            'title'    => esc_html__('Tags', 'sunix'),
            'subtitle' => esc_html__('Show tag names on each post.', 'sunix'),
            'type'     => 'switch',
            'default'  => '1',
        ),
        array(
            'id'       => 'archive_comments_on',
            'title'    => esc_html__('Comments', 'sunix'),
            'subtitle' => esc_html__('Show comments count on each post.', 'sunix'),
            'type'     => 'switch',
            'default'  => '1',
        ),
        array(
            'id'       => 'archive_like_on',
            'title'    => esc_html__('Like', 'sunix'),
            'subtitle' => esc_html__('Show Like count on each post.', 'sunix'),
            'type'     => 'switch',
            'default'  => '1',
        ),
        array(
            'id'       => 'archive_view_on',
            'title'    => esc_html__('View', 'sunix'),
            'subtitle' => esc_html__('Show view count on each post.', 'sunix'),
            'type'     => 'switch',
            'default'  => '1',
        ),
        array(
            'id'       => 'archive_readmore',
            'title'    => esc_html__('Read more', 'sunix'),
            'subtitle' => esc_html__('Show readmore button on archive page.', 'sunix'),
            'type'     => 'switch',
            'default'  => '1',
        )
    )
));
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Single Page', 'sunix'),
    'icon'       => 'el-icon-file-edit',
    'subsection' => true,
    'fields'     => array_merge(
        sunix_page_opts()
    )
));
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Single Post', 'sunix'),
    'icon'       => 'el-icon-file-edit',
    'subsection' => true,
    'fields'     => array_merge(
        sunix_single_header_top_opts(),
        array(
            array(
                'id'       => 'body_single_boxed',
                'type'     => 'button_set',
                'title'    => esc_html__('Body Boxed', 'sunix'),
                'options'  => array(
                    '-1'       => esc_html__('Default','sunix'),
                    'bordered' => esc_html__('Bordered','sunix'),
                ),
                'default'  => '-1'
            ),
            array(
                'id'       => 'single_bordered_w',
                'type'     => 'spacing',
                'mode'     => 'padding',
                'all'      => false,
                'title'    => esc_html__('Bordered Width', 'sunix'),
                'subtitle' => esc_html__('Enter bordered with.', 'sunix'),
                'units'    => array('px'),
                'default'  => array(
                    'padding-top'    => '0px',
                    'padding-right'  => '48px',
                    'padding-bottom' => '0px',
                    'padding-left'   => '48px',
                    'units'          => 'px'
                ),
                'required' => array(
                    array('body_single_boxed', '=', 'bordered')
                ),
                'output'       => array('.single-bordered')
            ),
            array(
                'id'       => 'post_sidebar_pos',
                'type'     => 'button_set',
                'title'    => esc_html__('Layouts', 'sunix'),
                'subtitle' => esc_html__('select a layout for single...', 'sunix'),
                'options'  => array(
                    'left'   => esc_html__('Left Sidebar', 'sunix'),
                    'right'  => esc_html__('Right Sidebar', 'sunix'),
                    'none' => esc_html__('No sidebar (Center)', 'sunix')
                ),
                'default'  => 'right'
            ),
            array(
                'id'       => 'post_date_on',
                'title'    => esc_html__('Date', 'sunix'),
                'subtitle' => esc_html__('Show date posted.', 'sunix'),
                'type'     => 'switch',
                'default'  => '1'
            ),
            array(
                'id'       => 'post_author_on',
                'title'    => esc_html__('Author', 'sunix'),
                'subtitle' => esc_html__('Show author name.', 'sunix'),
                'type'     => 'switch',
                'default'  => '1'
            ),
            array(
                'id'       => 'post_categories_on',
                'title'    => esc_html__('Categories', 'sunix'),
                'subtitle' => esc_html__('Show category names.', 'sunix'),
                'type'     => 'switch',
                'default'  => '1'
            ),
            array(
                'id'       => 'post_tags_on',
                'title'    => esc_html__('Tags', 'sunix'),
                'subtitle' => esc_html__('Show tag names.', 'sunix'),
                'type'     => 'switch',
                'default'  => '0'
            ),
            array(
                'id'       => 'post_comments_on',
                'title'    => esc_html__('Comments Count', 'sunix'),
                'subtitle' => esc_html__('Show comments count.', 'sunix'),
                'type'     => 'switch',
                'default'  => '1'
            ),
            array(
                'id'       => 'post_like_on',
                'title'    => esc_html__('Like', 'sunix'),
                'subtitle' => esc_html__('Show Likes Count.', 'sunix'),
                'type'     => 'switch',
                'default'  => '0'
            ),
        )
    )


));

Redux::setSection($opt_name, array(
    'title' => esc_html__('Page 404', 'sunix'),
    'icon'  => 'el-icon-pencil',
    'fields'  => array(
        array(
            'title'     => esc_html__('Background Image', 'sunix'),
            'subtitle'  => esc_html__('choose Background for page 404', 'sunix'),
            'id'        => 'background_404',
            'type'      => 'background',
            'default'   => array(),
            'output'    => array('body.error404')
        ),
    )
));
/*--------------------------------------------------------------
# Portfolio
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Portfolio', 'sunix'),
    'icon'   => 'el el-th',
    'subsection' => true,
    'fields' => array(
        array(
            'id'      => 'portfolio_slug',
            'type'    => 'text',
            'title'   => esc_html__('Portfolio slug rewrite', 'sunix'),
            'default' => esc_html__('portfolio', 'sunix')
        ),
        array(
            'id'      => 'portfolio_page',
            'type'    => 'select',
            'title'   => esc_html__('Portfolio Page', 'sunix'),
            'options' => sunix_list_page(['value' => '-1', 'label' => esc_html__('Archive page','sunix')]),
            'default' => esc_html__('-1', 'sunix')
        ),
    )
));


/*--------------------------------------------------------------
# Colors
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Colors', 'sunix'),
    'icon'   => 'el-icon-file-edit',
    'fields' => array(
        array(
            'id'          => 'primary_color',
            'type'        => 'color',
            'title'       => esc_html__('Primary Color', 'sunix'),
            'transparent' => false,
            'default'     => ''
        ),
        array(
            'id'          => 'accent_color',
            'type'        => 'color',
            'title'       => esc_html__('Accent Color', 'sunix'),
            'transparent' => false,
            'default'     => ''
        ),
    )
));

/*--------------------------------------------------------------
# Typography
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Typography', 'sunix'),
    'icon'   => 'el-icon-text-width',
    'fields' => array(
        array(
            'id'          => 'font_main',
            'type'        => 'typography',
            'title'       => esc_html__('Main Font', 'sunix'),
            'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'sunix'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'output'      => array('body'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'font_heading',
            'type'        => 'typography',
            'title'       => esc_html__('Heading Font', 'sunix'),
            'google'      => true,
            'font-backup' => true,
            'text-transform' => true,
            'all_styles'  => true,
            'output'      => array('h1, h2, h3, h4, h5, h6,.h1, .h2, .h3, .h4, .h4-1, .h5, .h6,.red-heading'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'font_h1',
            'type'        => 'typography',
            'title'       => esc_html__('H1', 'sunix'),
            'subtitle'    => esc_html__('Heading 1 typography.', 'sunix'),
            'google'      => true,
            'font-backup' => true,
            'text-transform' => true,
            'all_styles'  => true,
            'output'      => array('h1', '.h1'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'font_h2',
            'type'        => 'typography',
            'title'       => esc_html__('H2', 'sunix'),
            'subtitle'    => esc_html__('Heading 2 typography.', 'sunix'),
            'google'      => true,
            'font-backup' => true,
            'text-transform' => true,
            'all_styles'  => true,
            'output'      => array('h2', '.h2'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'font_h3',
            'type'        => 'typography',
            'title'       => esc_html__('H3', 'sunix'),
            'subtitle'    => esc_html__('Heading 3 typography.', 'sunix'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-transform' => true,
            'output'      => array('h3', '.h3'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'font_h4',
            'type'        => 'typography',
            'title'       => esc_html__('H4', 'sunix'),
            'subtitle'    => esc_html__('Heading 4 typography.', 'sunix'),
            'google'      => true,
            'font-backup' => true,
            'text-transform' => true,
            'all_styles'  => true,
            'output'      => array('h4', '.h4'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'font_h5',
            'type'        => 'typography',
            'title'       => esc_html__('H5', 'sunix'),
            'subtitle'    => esc_html__('Heading 5 typography.', 'sunix'),
            'google'      => true,
            'font-backup' => true,
            'text-transform' => true,
            'all_styles'  => true,
            'output'      => array('h5', '.h5'),
            'units'       => 'px'
        ),
        array(
            'id'          => 'font_h6',
            'type'        => 'typography',
            'title'       => esc_html__('H6', 'sunix'),
            'subtitle'    => esc_html__('Heading 6 typography.', 'sunix'),
            'google'      => true,
            'font-backup' => true,
            'text-transform' => true,
            'all_styles'  => true,
            'output'      => array('h6', '.h6'),
            'units'       => 'px'
        )
    )
));

$custom_font_selectors_1 = Redux::getOption($opt_name, 'custom_font_selectors_1');
$custom_font_selectors_1 = !empty($custom_font_selectors_1) ? explode(',', $custom_font_selectors_1) : array();

$custom_font_selectors_2 = Redux::getOption($opt_name, 'custom_font_selectors_2');
$custom_font_selectors_2 = !empty($custom_font_selectors_2) ? explode(',', $custom_font_selectors_2) : array();

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Extra Fonts', 'sunix'),
    'icon'       => 'el el-fontsize',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'custom_font_1',
            'type'        => 'typography',
            'title'       => esc_html__('Custom Font', 'sunix'),
            'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'sunix'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'output'      => $custom_font_selectors_1,
            'units'       => 'px',

        ),
        array(
            'id'       => 'custom_font_selectors_1',
            'type'     => 'textarea',
            'title'    => esc_html__('CSS Selectors', 'sunix'),
            'subtitle' => esc_html__('Add css selectors to apply above font.', 'sunix'),
            'validate' => 'no_html'
        )
    )
));
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Extra Fonts 2', 'sunix'),
    'icon'       => 'el el-fontsize',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'custom_font_2',
            'type'        => 'typography',
            'title'       => esc_html__('Custom Font', 'sunix'),
            'subtitle'    => esc_html__('Typography option with each property can be called individually.', 'sunix'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'output'      => $custom_font_selectors_2,
            'units'       => 'px',
            'text-transform' => true,

        ),
        array(
            'id'       => 'custom_font_selectors_2',
            'type'     => 'textarea',
            'title'    => esc_html__('CSS Selectors', 'sunix'),
            'subtitle' => esc_html__('Add css selectors to apply above font.', 'sunix'),
            'validate' => 'no_html',

        )
    )
));
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Button', 'sunix'),
    'icon'   => 'el-icon-text-width',
    'fields' => array(
        array(
            'id'          => 'font_button',
            'type'        => 'typography',
            'title'       => esc_html__('Button Font', 'sunix'),
            'subtitle'    => esc_html__('Apply fot all button', 'sunix'),
            'google'      => true,
            'font-backup' => false,
            'color' => false,
            'all_styles'  => true,
            'output'      => array('form .button, form button, form [type="button"], form [type="reset"], form [type="submit"], .red-btn, .cart-collaterals .wc-proceed-to-checkout a, .woocommerce-mini-cart__buttons .button, .btn'),
            'units'       => 'px'
        ),
    )
));
/* Social Media */
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Social Media', 'sunix'),
    'desc'       => esc_html__('Add your socials network', 'sunix'),
    'icon'       => 'el el-twitter',
    'subsection' => false,
    'fields'     => array(
        array(
            'id'      => 'social_facebook_url',
            'type'    => 'text',
            'title'   => esc_html__('Facebook URL', 'sunix'),
            'default' => '',
        ),
        array(
            'id'      => 'social_twitter_url',
            'type'    => 'text',
            'title'   => esc_html__('Twitter URL', 'sunix'),
            'default' => '',
        ),
        array(
            'id'      => 'social_inkedin_url',
            'type'    => 'text',
            'title'   => esc_html__('Inkedin URL', 'sunix'),
            'default' => '',
        ),
        array(
            'id'      => 'social_rss_url',
            'type'    => 'text',
            'title'   => esc_html__('Rss URL', 'sunix'),
            'default' => '',
        ),
        array(
            'id'      => 'social_instagram_url',
            'type'    => 'text',
            'title'   => esc_html__('Instagram URL', 'sunix'),
            'default' => '',
        ),
        array(
            'id'      => 'social_google_url',
            'type'    => 'text',
            'title'   => esc_html__('Google URL', 'sunix'),
            'default' => '',
        ),
        array(
            'id'      => 'social_skype_url',
            'type'    => 'text',
            'title'   => esc_html__('Skype URL', 'sunix'),
            'default' => '',
        ),
        array(
            'id'      => 'social_pinterest_url',
            'type'    => 'text',
            'title'   => esc_html__('Pinterest URL', 'sunix'),
            'default' => '',
        ),
        array(
            'id'      => 'social_vimeo_url',
            'type'    => 'text',
            'title'   => esc_html__('Vimeo URL', 'sunix'),
            'default' => '',
        ),
        array(
            'id'      => 'social_youtube_url',
            'type'    => 'text',
            'title'   => esc_html__('Youtube URL', 'sunix'),
            'default' => '',
        ),
        array(
            'id'      => 'social_yelp_url',
            'type'    => 'text',
            'title'   => esc_html__('Yelp URL', 'sunix'),
            'default' => '',
        ),
        array(
            'id'      => 'social_tumblr_url',
            'type'    => 'text',
            'title'   => esc_html__('Tumblr URL', 'sunix'),
            'default' => '',
        ),
        array(
            'id'      => 'social_tripadvisor_url',
            'type'    => 'text',
            'title'   => esc_html__('Tripadvisor URL', 'sunix'),
            'default' => '',
        ),
    )
));

/**
 * Social API
 *
 * @author CMSSuperHeroes
 * @since 1.0.0
 */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('API', 'sunix'),
    'icon'   => 'dashicons dashicons-share',
    'fields' => array()
));
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Google Maps', 'sunix'),
    'icon'       => 'dashicons dashicons-googleplus',
    'desc'      => sprintf(__('Click here to <a href="%s" target="_blank">Get your google API key</a>','sunix'), 'https://developers.google.com/maps/documentation/javascript/get-api-key'),
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('API Key', 'sunix'),
            'id'        => 'google_api_key',
            'type'      => 'text',
            'default'   => '',
        )
    )
));
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Twitter', 'sunix'),
    'icon'       => 'dashicons dashicons-twitter',
    'subsection' => true,
    'fields'     => array(
        
        array(
            'title'     => esc_html__('Consumer Key (API Key)', 'sunix'),
            'id'        => 'twitter_api_consumer_key',
            'type'      => 'text',
            'default'   => 'i90SevLFwZDscXPo3Wj89Y4eO',
        ),
        array(
            'title'     => esc_html__('Consumer Secret (API Secret)', 'sunix'),
            'id'        => 'twitter_api_consumer_secret',
            'type'      => 'text',
            'default'   => '61AmOoAxacZeQneXjCOzKZGRwXwcRFgMsIhhYnQ5JTAOvMdlmL',
        ),
        array(
            'title'     => esc_html__('Access Token', 'sunix'),
            'id'        => 'twitter_api_access_key',
            'type'      => 'text',
            'default'   => '107960275-v9RLlUdpW7xW0wbh0Xtg8X2mVFbaCDtFNAs8vwAc',
        ),
        array(
            'title'     => esc_html__('Access Token Secret', 'sunix'),
            'id'        => 'twitter_api_access_secret',
            'type'      => 'text',
            'default'   => 'VewAXAcJEyDpqlrDfDO40HbRq6rzkYPEHgXz3WNhxAbSv',
        ),
        array(
            'id'        => 'twitter_api_dasboard',
            'type'      => 'info',
            'style'     => 'warning',
            'desc'      => sprintf(__('These details are available in <a href="%s" target="_blank">Your Twitter dashboard</a>','sunix'), 'https://dev.twitter.com/apps')
        ),
    )
));
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Instagram', 'sunix'),
    'icon'       => 'el el-instagram',
    'subsection' => true,
    'fields'     => array(
        array(
            'title'     => esc_html__('User ID', 'sunix'),
            'desc'      => esc_html__('Ex: https://www.instagram.com/zooka.studio/. Get zooka.studio','sunix'),
            'id'        => 'instagram_api_username',
            'type'      => 'text',
            'default'   => 'thuylinh3112507'
        )
    )
));

/*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/

Redux::setSection($opt_name, sunix_footer_opts());

/**
 # WooCommerce
*/
Redux::setSection($opt_name, sunix_woocommerce_theme_opts());
Redux::setSection($opt_name, array(
    'title' => esc_html__('Shop Product page', 'sunix'),
    'icon' => 'el el-shopping-cart',
    'subsection'    => true,
    'fields' => array(
        array(
            'id'       => 'woo_shop_sidebar_pos',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Position', 'sunix'),
            'subtitle' => esc_html__('Select a sidebar position for single product', 'sunix'),
            'options'  => array(
                'left'  => esc_html__('Left', 'sunix'),
                'right' => esc_html__('Right', 'sunix'),
                'none'  => esc_html__('Disabled', 'sunix')
            ),
            'default'  => 'right'
        ),
        array(
            'id'          => 'woo_archive_footer_layout',
            'type'        => 'image_select',
            'title'       => esc_html__('Layout Footer', 'sunix'),
            'subtitle'    => esc_html__('Select a layout footer for archive product page.', 'sunix'),
            'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom footer layout first.','sunix'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=sunix_footer' ) ) . '">','</a>'),
            'placeholder' => esc_html__('Default','sunix'),
            'options'     => sunix_list_post_thumbnail('ef5_footer', ''),
            'default'     => '1',
        ),
    )
));
Redux::setSection($opt_name, array(
    'title' => esc_html__('Single Product page', 'sunix'),
    'icon' => 'el el-shopping-cart',
    'subsection'    => true,
    'fields' => array(
        array(
            'id'       => 'woo_single_sidebar_pos',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Position', 'sunix'),
            'subtitle' => esc_html__('Select a sidebar position for single product', 'sunix'),
            'options'  => array(
                'left'  => esc_html__('Left', 'sunix'),
                'right' => esc_html__('Right', 'sunix'),
                'none'  => esc_html__('Disabled', 'sunix')
            ),
            'default'  => 'none'
        ),
        array(
            'id'          => 'woo_single_footer_layout',
            'type'        => 'image_select',
            'title'       => esc_html__('Layout Footer', 'sunix'),
            'subtitle'    => esc_html__('Select a layout footer for Single Product Page.', 'sunix'),
            'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom footer layout first.','sunix'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=sunix_footer' ) ) . '">','</a>'),
            'placeholder' => esc_html__('Default','sunix'),
            'options'     => sunix_list_post_thumbnail('ef5_footer', ''),
            'default'     => '2',
        ),
    )
));
/*--------------------------------------------------------------
# Development
--------------------------------------------------------------*/
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Development Tools', 'sunix'),
    'icon'   => 'el-icon-edit',
    'fields' => array(
        array(
            'id'       => 'gutenberg',
            'type'     => 'switch',
            'title'    => esc_html__('Gutenberg Editor', 'sunix'),
            'subtitle' => esc_html__('Choose Default to use default Editor from WordPress or other plugin like Visual Composer, WPBakery Page Builder, Classic Editor,...', 'sunix'),
            'description' => esc_html__('Disable option will remove Gutenberg Editor', 'sunix'),
            'on'       => esc_html__('Default', 'sunix'),
            'off'      => esc_html__('Disable', 'sunix'),
            'default'  => true
        ),
        array(
            'id'          => 'dev_mode',
            'type'        => 'switch',
            'default'     => true,
            'title'       => esc_html__('Development Mode', 'sunix'),
            'subtitle'    => esc_html__('Not Recommended', 'sunix'),
            'description' => esc_html__('When it is ON, the css will be passed from sccc in all time.', 'sunix'),
        )
    ),
));