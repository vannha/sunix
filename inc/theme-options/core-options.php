<?php
/**
 * Theme Options 
 * Site Boxed
 * Add option repeated Boxed theme/ meta option
*/
if(!function_exists('alacarte_general_opts')){
    function alacarte_general_opts($args = []){
        $args = wp_parse_args($args, [
            'default'   => false
        ]);
        $default_value              = $args['default'] ? '-1' : '0';
        $force_output               = $args['default'] ? true : false;
        $default_dropdown_opts      = $args['default'] ? array('-1' => esc_html__('Default','alacarte')) : array();
        $default_page_loading_value = $args['default'] ? '-1' : 'fading-circle';

        if($args['default'] === true){
            $options_layout = array(
                '-1'       => esc_html__('Default','alacarte'),
                'boxed'    => esc_html__('Boxed','alacarte'),
                'bordered' => esc_html__('Bordered','alacarte'),
            );
            $default_layout = '-1';

            $options_boxed = array(
                '-1' => esc_html__('Default','alacarte'),
                '1'  => esc_html__('Yes','alacarte'),
                '0'  => esc_html__('No','alacarte'),
            );
        } else {
            $options_layout = array(
                '-1'       => esc_html__('Default','alacarte'),
                'boxed'    => esc_html__('Boxed','alacarte'),
                'bordered' => esc_html__('Bordered','alacarte'),
            );
            $default_layout = '-1';
            
            $options_boxed = array(
                '1'  => esc_html__('Yes','alacarte'),
                '0'  => esc_html__('No','alacarte'),
            );
        }
        return array(
            array(
                'id'       => 'body_bg',
                'type'     => 'background',
                'title'    => esc_html__('Body Background', 'alacarte'),
                'subtitle' => esc_html__('Choose background style for body', 'alacarte'),
                'output'   => array('body')
            ),
            array(
                'id'       => 'body_bg_overlay',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Body Overlay Color', 'alacarte'),
                'subtitle' => esc_html__('Add overlay color for body', 'alacarte'),
                'output'   => array(
                    'background-color' => 'body:after'
                ),
                'force_output' => $force_output,
                'default'      => ''
            ),
            array(
                'id'       => 'site_layout',
                'type'     => 'button_set',
                'title'    => esc_html__('Layout', 'alacarte'),
                'subtitle' => esc_html__('Choose site layout', 'alacarte'),
                'options'  => $options_layout,
                'default'  => $default_layout,
            ),
            array(
                'id'       => 'boxed_content_bg',
                'type'     => 'background',
                'title'    => esc_html__('Boxed Content Background', 'alacarte'),
                'subtitle' => esc_html__('Choose background style for boxed content', 'alacarte'),
                'required' => array(
                    array('site_layout', '=', 'boxed')
                ),
                'output'   => array('.site-boxed .red-page'),
                'force_output' => $force_output
            ),
            array(
                'id'       => 'site_bordered_w',
                'type'     => 'spacing',
                'mode'     => 'padding',
                'all'      => false,
                'title'    => esc_html__('Bordered Width', 'alacarte'),
                'subtitle' => esc_html__('Enter bordered with.', 'alacarte'),
                'units'    => array('px'),
                'default'  => array(
                    'padding-top'    => '0px',
                    'padding-right'  => '48px',
                    'padding-bottom' => '0px',
                    'padding-left'   => '48px',
                    'units'          => 'px'
                ),
                'required' => array(
                    array('site_layout', '=', 'bordered')
                ),
                'force_output' => $force_output,
                'output'       => array('.site-bordered')
            ),
            array(
                'id'       => 'bordered_content_bg',
                'type'     => 'background',
                'title'    => esc_html__('Bordered Content Background', 'alacarte'),
                'subtitle' => esc_html__('Choose background style for bordered content', 'alacarte'),
                'required' => array(
                    array('site_layout', '=', 'bordered')
                ),
                'output'   => array('.site-bordered .red-page'),
                'force_output' => $force_output
            ),
            array(
                'id'       => 'show_page_loading',
                'type'     => 'button_set',
                'title'    => esc_html__('Enable Page Loading', 'alacarte'),
                'subtitle' => esc_html__('Enable Page Loading Effect When You Load Site', 'alacarte'),
                'options'  => $options_boxed,
                'default'  => $default_value,
            ),
            array(
                'title'     => esc_html__('Page Loadding Style','alacarte'),
                'subtitle'  => esc_html__('Select Style Page Loadding.','alacarte'),
                'id'        => 'page_loading_style',
                'type'      => 'select',
                'options'   => alacarte_page_loading_styles($args['default']),
                'default'   => $default_page_loading_value,
                'required'  => array('show_page_loading', '=', '1' )
            ),
            array(
                'id'       => 'back_totop_on',
                'type'     => 'button_set',
                'title'    => esc_html__('Back to Top Button', 'alacarte'),
                'subtitle' => esc_html__('Show back to top button when scrolled down.', 'alacarte'),
                'options'  => $options_boxed,
                'default'  => $default_value,
            )
        );
    }
}

/**
 * Theme Options 
 * Header Top Area 
 * Add option repeated for theme/ meta option
*/
if(!function_exists('alacarte_header_top_opts')){
    function alacarte_header_top_opts($default = false){
        $default_value   = '0';
        $title = esc_html__('Enable', 'alacarte');
        $subtitle = esc_html__('Show or hide header top', 'alacarte');
        if($default){
            $enable_opts['-1'] = esc_html__('Default','alacarte');
            $default_value   = '-1';
            $title = esc_html__('Custom', 'alacarte');
            $subtitle = esc_html__('Custom or hide or set default as theme option', 'alacarte');
        }

        $enable_opts['1'] = esc_html__('Yes','alacarte');
        $enable_opts['0'] = esc_html__('No','alacarte');
        return array(
            array(
                'title'     => $title,
                'subtitle'  => $subtitle,
                'id'        => 'header_top_enable',
                'type'      => 'button_set',
                'options' => $enable_opts,
                'default' => $default_value,
            ),
                array(
                    'id'          => 'header_top',
                    'type'        => 'image_select',
                    'title'       => esc_html__('Layout', 'alacarte'),
                    'subtitle'    => esc_html__('Select a layout for upper header top area.', 'alacarte'),
                    'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom header layout first.','alacarte'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=alacarte_header_top' ) ) . '">','</a>'),
                    'options'     => alacarte_list_post_thumbnail('ef5_header_top', $default),
                    'default'     => $default_value,
                    'required'  => array('header_top_enable', '=', '1')
                ),
            array(
                'id'        => 'header_top_background',
                'title'     => esc_html__('Background', 'alacarte'),
                'subtitle'  => esc_html__('Choose background style', 'alacarte'),
                'type'      => 'background',
                'preview'   => false,
                'default'  => array(
                    'background-color' => '',
                ),
                'output'    => array('.red-header-top'),
                'required'  => array('header_top_enable', '=', '1')
            ),
            array(
                'id'        => 'header_top_background_overlay',
                'title'     => esc_html__('Overlay Background', 'alacarte'),
                'subtitle'  => esc_html__('Choose overlay background color', 'alacarte'),
                'type'      => 'color_rgba',
                'output'    => array(
                    'background-color' => '.red-header-top:before',
                ),
                'required'  => array('header_top_enable', '=', '1')
            ),
            array(
                'title'     => esc_html__('Header Top Padding', 'alacarte'),
                'subtitle'  => esc_html__('Choose padding for header top', 'alacarte'),
                'id'        => 'header_top_padding',
                'type'      => 'spacing',
                'mode'      => 'padding',
                'units'     => array('px'),
                'default'   => array(),
                'force_output' => true,
                'output'    => array('.red-header-top'),
                'required'  => array('header_top_enable', '=', '1')
            ),
            array(
                'title'    => esc_html__('Link Color', 'alacarte'),
                'subtitle' => esc_html__('Choose color for link tag', 'alacarte'),
                'id'       => 'header_top_link',
                'type'     => 'link_color',
                'active'   => false,
                'output'   => array( '.red-header-top a,.red-header-top.layout-header-top-2 a, .red-header-top ul li a,.red-header-top.layout-header-top-4 .red-header-atts .header-icon span'),
                'required'  => array('header_top_enable', '=', '1')
            ),

            array(
                'title'          => esc_html__('Typography', 'alacarte'),
                'subtitle'       => esc_html__('Choose typography style', 'alacarte'),
                'id'             => 'header_top_typo',
                'type'           => 'typography',
                'text-transform' =>  true,
                'letter-spacing' =>  true,
                'text-align'     =>  false,
                'default'        => array(
                    'font-family' => 'Oswald',
                    'font-weight' => '500',

                ),
                'output'         => '.red-header-top,.red-header-top.layout-header-top-4,.red-header-top p,.red-header-top .header-top-coontact .header-top-right b,.red-header-top span:not(.social-icon),.red-header-top ul li',
                'required'  => array('header_top_enable', '=', '1')
            ),
            array(
                'title'          => esc_html__('Icon Style', 'alacarte'),
                'subtitle'       => esc_html__('Choose typography style for icon', 'alacarte'),
                'id'             => 'header_top_icon_typo',
                'type'           => 'typography',
                'text-transform' =>  false,
                'letter-spacing' =>  false,
                'font-family' =>  false,
                'color' =>  false,
                'font-style' =>  false,
                'font-weight' =>  false,
                'text-align'     =>  false,
                'default'        => array(),
                'output'         => '.red-header-top .red-social a,.red-header-top .contact-us i,.red-header-top.layout-header-top-4 .red-header-atts .header-icon span',
                'required'  => array('header_top_enable', '=', '1')
            )
        );
    }
}
if(!function_exists('alacarte_single_header_top_opts')){
    function alacarte_single_header_top_opts($default = false){
        $default_value   = '0';
        if($default){
            $default_value   = '-1';
        }
        return array(
            array(
                'id'          => 'single_header_top',
                'type'        => 'image_select',
                'title'       => esc_html__('Header Top Layout', 'alacarte'),
                'subtitle'    => esc_html__('Select a layout for upper header top area.', 'alacarte'),
                'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom header layout first.','alacarte'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=alacarte_header_top' ) ) . '">','</a>'),
                'options'     => alacarte_list_post_thumbnail('ef5_header_top', $default),
                'default'     => $default_value,
                'required'  => array('header_top_enable', '=', '1')
            ),
        );
    }
}
/**
 * Theme Options 
 * Add option repeated for theme/ meta option
*/
if(!function_exists('alacarte_header_layout')){
    function alacarte_header_layout($default = false){
        $layouts = [];
        if($default){
            $layouts['-1'] = get_template_directory_uri() . '/assets/images/default.png';
            $layouts['none'] = get_template_directory_uri() . '/assets/images/none.png';
        }
        $layouts['1'] = get_template_directory_uri() . '/assets/images/header/header-1.png';
        $layouts['2'] = get_template_directory_uri() . '/assets/images/header/header-2.png';
        $layouts['3'] = get_template_directory_uri() . '/assets/images/header/header-3.png';
        $layouts['4'] = get_template_directory_uri() . '/assets/images/header/header-4.jpg';
        $layouts['5'] = get_template_directory_uri() . '/assets/images/header/header-5.jpg';

        return $layouts;
    }
}

if(!function_exists('alacarte_header_opts')){
    function alacarte_header_opts($args = []){
        $args = wp_parse_args($args, [
            'default' => false
        ]);
        $default_value = '1';
        $default_menu = '0';
        if($args['default'] === true){
            $options_width = array(
                '-1' => esc_html__('Default','alacarte'),
                '1'  => esc_html__('Yes','alacarte'),
                '0'  => esc_html__('No','alacarte'),
            );
            
            $default_value = $default_menu = $default_width_value = '-1';
        } else {
            $options_width = array(
                '1'  => esc_html__('Yes','alacarte'),
                '0'  => esc_html__('No','alacarte'),
            );
            $default_width_value = '0';
        }
        return array(
            array(
                'id'       => 'header_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Layout', 'alacarte'),
                'subtitle' => esc_html__('Select a layout for header.', 'alacarte'),
                'options'  => alacarte_header_layout($args['default']),
                'default'  => $default_value
            ),
            array(
                'id'       => 'header_menu',
                'type'     => 'select',
                'options'  => alacarte_get_nav_menu(['default' => $args['default'],'none' => true]),
                'default'  => $default_menu,
                'title'    => esc_html__('Header Menu', 'alacarte'),
                'subtitle' => esc_html__('Choose a menu to show', 'alacarte'),
            ),
            array(
                'id'       => 'header_design',
                'type'     => 'info',
                'style'    => 'success',
                'title'    => esc_html__('Header Design', 'alacarte'),
                'subtitle' => esc_html__('Custom header style like: background, text color, link color, border style, ...', 'alacarte'),
            ),
            array(
                'title'    => esc_html__('Header Width', 'alacarte'),
                'subtitle' => esc_html__('Make header content full width or not', 'alacarte'),
                'id'       => 'header_fullwidth',
                'type'     => 'button_set',
                'options'  => $options_width,
                'default'  => $default_width_value,
                'required' => array(
                    array('header_layout' ,'!=', '3')
                )
            ),
            array(
                'title'    => esc_html__('Header Height', 'alacarte'),
                'subtitle' => esc_html__('Add height for header.', 'alacarte'),
                'id'       => 'header_height',
                'type'     => 'dimensions',
                'units'    => array('px'),
                'width'    => false,
            ),
            array(
                'title'    => esc_html__('Header Width', 'alacarte'),
                'subtitle' => esc_html__('Enter the width for side navigation header', 'alacarte'),
                'id'       => 'header_sidewidth',
                'type'     => 'dimensions',
                'height'   => false,
                'unit'     => array('px'),
                'default'  => array(
                    'unit'  => 'px'
                ), 
                'required' => array(
                    array('header_layout' ,'=', '3')
                ),
                'force_output' => true
            ),
            array(
                'id'     => 'header_bg',
                'type'   => 'background',
                'title'  => esc_html__('Background', 'alacarte'),
                'output' => array('.header-default')
            ),
            array(
                'id'          => 'header_text_color',
                'type'        => 'color_rgba',
                'title'       => esc_html__('Text Color', 'alacarte'),
                'default'     => '',
                'output'      => array('.header-default')
            ),
            array(
                'id'    => 'header_link_colors',
                'type'  => 'link_color',
                'title' => esc_html__('Link colors', 'alacarte'),
            ),
            array(
                'id'       => 'header_border',
                'type'     => 'border',
                'all'      => false,
                'color'    => false,
                'title'    => esc_html__('Border Style', 'alacarte'),
                'subtitle' => esc_html__('Add your custom border design', 'alacarte'),
                'output'   => array('.header-default')
            ),
            array(
                'id'       => 'header_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Border Color', 'alacarte'),
                'subtitle' => esc_html__('Add your custom border color', 'alacarte'),
                'output'   => array(
                    'border-color' => '.header-default'
                )
            )
        ); 
    }
}

/**
 * Theme Option:
 * Header Attributes 
 *
*/
if(!function_exists('alacarte_header_atts')){
    function alacarte_header_atts($default = false){
        $header_side_nav_icon_type = array(
            'icon'            => esc_html__('Icon Only','alacarte'),
            'separator-left'  => esc_html__('Icon with separator left','alacarte'),
            'separator-right' => esc_html__('Icon with separator right','alacarte'),
        );
        $header_popup_nav_icon_type = array(
            'text'            => esc_html__('Text','alacarte'),
            'icon'            => esc_html__('Icon Only','alacarte'),
            'separator-left'  => esc_html__('Icon with separator left','alacarte'),
            'separator-right' => esc_html__('Icon with separator right','alacarte'),
        );
        $header_mobile_nav_icon_type = array(
            'icon' => esc_html__('Icon','alacarte'),
            'text' => esc_html__('Text','alacarte'),
        );
        $header_atts_icon_style = array(
            'icon'           => esc_html__('Icon','alacarte'),
            'circle accent'  => esc_html__('Circle Icon - Accent Color','alacarte'),
            'circle primary' => esc_html__('Circle Icon - Primary Color','alacarte'),
            'circle grey'    => esc_html__('Circle Icon - Grey Color','alacarte'),
        );
        if($default){
            $options = array(
                '-1' => esc_html__('Default','alacarte'),
                '1'  => esc_html__('Yes','alacarte'),
                '0'  => esc_html__('No','alacarte'),
            );
            $default_value = $default_helper_menu_value = $default_popup_menu = $header_mobile_nav_icon_type_value = $header_side_nav_icon_type_value = $header_popup_nav_icon_type_value = $header_atts_icon_style_value = '-1';
            $default_helper_menu = [
                'default' => true,
                'none'    => true
            ];
            $header_mobile_nav_icon_type['-1'] = esc_html__('Default','alacarte');
            $header_side_nav_icon_type['-1']   = esc_html__('Default','alacarte');
            $header_popup_nav_icon_type['-1']  = esc_html__('Default','alacarte');
            $header_atts_icon_style['-1']      = esc_html__('Default','alacarte');
        } else {
            $options = array(
                '1'  => esc_html__('Yes','alacarte'),
                '0'  => esc_html__('No','alacarte'),
            );
            $default_value = '0';
            
            $default_helper_menu_value = '';
            $default_helper_menu  = [];
            $default_popup_menu = '0';
            $header_mobile_nav_icon_type_value = 'icon';
            $header_side_nav_icon_type_value = 'icon';
            $header_popup_nav_icon_type_value = 'text';
            $header_atts_icon_style_value = 'icon';
        }
        return array_merge(
            array(
                array(
                    'id'       => 'header_attr',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Header Attributes', 'alacarte'),
                    'subtitle' => esc_html__('Choose header attributes to show', 'alacarte'),
                ),
                array(
                    'title'    => esc_html__('Mobile Menu Icon Style', 'alacarte'),
                    'subtitle' => esc_html__('Choose style of mobile menu icon', 'alacarte'),
                    'id'       => 'header_mobile_nav_icon_type',
                    'type'     => 'select',
                    'options'  => $header_mobile_nav_icon_type,
                    'default'  => $header_mobile_nav_icon_type_value,
                ),
                array(
                    'title'    => esc_html__('Helper Menu', 'alacarte'),
                    'subtitle' => esc_html__('Show/Hide helper menu', 'alacarte'),
                    'id'       => 'header_helper_menu',
                    'type'     => 'select',
                    'options'  => alacarte_get_nav_menu($default_helper_menu),
                    'default'  => $default_helper_menu_value
                ),
                array(
                    'title'    => esc_html__('Icon Style', 'alacarte'),
                    'subtitle' => esc_html__('Choose style attributes icon', 'alacarte'),
                    'id'       => 'header_atts_icon_style',
                    'type'     => 'select',
                    'options'  => $header_atts_icon_style,
                    'default'  => $header_atts_icon_style_value,
                ),
                array(
                    'title'    => esc_html__('Show Social', 'alacarte'),
                    'subtitle' => esc_html__('Show/Hide social icon', 'alacarte'),
                    'id'       => 'header_social',
                    'type'     => 'button_set',
                    'options'  => $options,
                    'default'  => $default_value,
                ),

                array(
                    'title'    => esc_html__('Show Search', 'alacarte'),
                    'subtitle' => esc_html__('Show/Hide search icon', 'alacarte'),
                    'id'       => 'header_search',
                    'type'     => 'button_set',
                    'options'  => $options,
                    'default'  => $default_value,
                ),
                array(
                    'title'    => esc_html__('Show Translate', 'alacarte'),
                    'subtitle' => esc_html__('Show/Hide translate', 'alacarte'),
                    'id'       => 'header_translate',
                    'type'     => 'button_set',
                    'options'  => $options,
                    'default'  => $default_value,
                ) ,
                array(
                    'title'    => esc_html__('Show Book Now', 'alacarte'),
                    'subtitle' => esc_html__('Show/Hide book now button', 'alacarte'),
                    'id'       => 'header_book_now',
                    'type'     => 'button_set',
                    'options'  => $options,
                    'default'  => $default_value,
                )
            ),
            alacarte_header_wc_attrs($options, $default_value),
            alacarte_header_contact_attrs($options, $default, $default_value),
            alacarte_header_contact_plain_text_attrs($options, $default_value),
            array(
                array(
                    'title'    => esc_html__('Show Nav Sidebar', 'alacarte'),
                    'subtitle' => esc_html__('Show/Hide side menu', 'alacarte'),
                    'desc'     => sprintf(esc_html__('When this option is YES, you need add widget to %sNav Sidebar%s area','alacarte'),'<a href="' . esc_url( admin_url( 'widgets.php#sidebar-nav' ) ) . '" target="_blank">','</a>'),
                    'id'       => 'header_side_nav',
                    'type'     => 'button_set',
                    'options'  => $options,
                    'default'  => $default_value,
                ),
                array(
                    'title'    => esc_html__('Nav Sidebar Icon Style', 'alacarte'),
                    'subtitle' => esc_html__('Choose style of side menu icon', 'alacarte'),
                    'id'       => 'header_side_nav_icon_type',
                    'type'     => 'select',
                    'options'  => $header_side_nav_icon_type,
                    'default'  => $header_side_nav_icon_type_value,
                    'required' => array('header_side_nav', '=', '1'),
                ),
                array(
                    'title'    => esc_html__('Show Popup Menu', 'alacarte'),
                    'subtitle' => esc_html__('Show/Hide poup menu', 'alacarte'),
                    'id'       => 'header_popup_nav',
                    'type'     => 'button_set',
                    'options'  => $options,
                    'default'  => $default_value,
                ),
                array(
                    'title'    => esc_html__('Popup Menu Icon Style', 'alacarte'),
                    'subtitle' => esc_html__('Choose style of icon: Text or Icon', 'alacarte'),
                    'id'       => 'header_popup_nav_icon_type',
                    'type'     => 'select',
                    'options'  => $header_popup_nav_icon_type,
                    'default'  => $header_popup_nav_icon_type_value,
                    'required' => array('header_popup_nav', '=', '1'),
                ),
                array(
                    'id'       => 'header_popup_menu',
                    'type'     => 'select',
                    'options'  => alacarte_get_nav_menu(['default' => $default, 'none' => true]),
                    'default'  => $default_popup_menu,
                    'required' => array('header_popup_nav', '=', '1'),
                    'title'    => esc_html__('Popup Menu', 'alacarte'),
                    'subtitle' => esc_html__('Choose a menu to show', 'alacarte'),
                )
            ),
            alacarte_header_signin_signup_opts(['default' => $default]),
            array(
                array(
                    'id'       => 'header_side_copyright',
                    'type'     => 'textarea',
                    'default'  => sprintf('&copy; Biger. by <a href="%s">CMSSuperheroes</a>', esc_url('http://www.cmssuperheroes.com/')),
                    'required' => array('header_layout', '=', '3'),
                    'title'    => esc_html__('Copyright Text', 'alacarte'),
                    'subtitle' => esc_html__('Enter your copyright text', 'alacarte'),
                )
            )

        );
    }
}
/**
 * Theme Options 
 * Show cart, wishlist, ... icon
 * Require WooCommerce, WooCommerce Smash Wishlist, and more to work
 *
*/
function alacarte_header_wc_attrs($options, $default_value){
    if(!class_exists('WooCommerce')) return array();
    $opts = [
        array(
            'title'    => esc_html__('Show Cart', 'alacarte'),
            'subtitle' => esc_html__('Show/Hide cart icon', 'alacarte'),
            'id'       => 'header_cart',
            'type'     => 'button_set',
            'options'  => $options,
            'default'  => $default_value,
        )
    ];
    if(class_exists('WPcleverWoosw')){
        $opts[] = array(
            'title'    => esc_html__('Show Wishlist', 'alacarte'),
            'subtitle' => esc_html__('Show/Hide Wishlist icon', 'alacarte'),
            'id'       => 'header_wishlist',
            'type'     => 'button_set',
            'options'  => $options,
            'default'  => $default_value,
        );
    }
    if(class_exists('WPcleverWooscp')){
        $opts[] = array(
            'title'    => esc_html__('Show Compare', 'alacarte'),
            'subtitle' => esc_html__('Show/Hide Compare icon', 'alacarte'),
            'id'       => 'header_compare',
            'type'     => 'button_set',
            'options'  => $options,
            'default'  => $default_value,
        );
    }
    return $opts;
}
/**
 * Theme Options 
 * Show Contact button
 * Require Contact form 7 to work
 *
*/
function alacarte_header_contact_attrs($options, $default, $default_value){
    if(!class_exists('WPCF7')) return array();
    $opts = [
         array(
            'title'    => esc_html__('Show Contact', 'alacarte'),
            'subtitle' => esc_html__('Show/Hide contact button', 'alacarte'),
            'id'       => 'header_contact',
            'type'     => 'button_set',
            'options'  => $options,
            'default'  => $default_value,
        ),
        array(
            'title'    => esc_html__('Contact Form', 'alacarte'),
            'subtitle' => esc_html__('Choose an contact form', 'alacarte'),
            'id'       => 'header_contact_form',
            'type'     => 'select',
            'options'  => alacarte_get_list_cf7($default),
            'default'  => $default_value,
            'required' => array(
                array('header_contact', '!=', '-1'),
                array('header_contact', '!=', '0')
            )
        )
    ];
    
    return $opts;
}

/**
 * Theme Options 
 * Show Contact Plain Info
 * hot line, working hour, address, email,
 *
*/
function alacarte_header_contact_plain_text_attrs($options, $default_value){
    $opts = [
         array(
            'title'    => esc_html__('Show Plain Contact Info', 'alacarte'),
            'subtitle' => esc_html__('Show/Hide contact plain text info', 'alacarte'),
            'id'       => 'header_contact_plain',
            'type'     => 'button_set',
            'options'  => $options,
            'default'  => $default_value,
            'required' => array(
                array('header_layout', '=', array('1','2','5','6','6-white')),
            )
        ),
        array(
            'title'    => esc_html__('Icon 1', 'alacarte'),
            'id'       => 'header_contact_plain_icon1',
            'type'     => 'text',
            'default'  => 'lnr lnr-phone-handset',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            )
        ),
        array(
            'title'    => esc_html__('Title 1', 'alacarte'),
            'id'       => 'header_contact_plain_text1',
            'type'     => 'text',
            'default'  => '(+88)222.888.66',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            )
        ),
        array(
            'title'    => esc_html__('Description 1', 'alacarte'),
            'id'       => 'header_contact_plain_subtext1',
            'type'     => 'text',
            'default'  => 'Free call',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            )
        ),
        array(
            'title'    => esc_html__('Icon 2', 'alacarte'),
            'id'       => 'header_contact_plain_icon2',
            'type'     => 'text',
            'default'  => 'lnr lnr-clock',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            )
        ),
        array(
            'title'    => esc_html__('Title 2', 'alacarte'),
            'id'       => 'header_contact_plain_text2',
            'type'     => 'text',
            'default'  => '8:00 AM - 6:00 PM',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            )
        ),
        array(
            'title'    => esc_html__('Description 2', 'alacarte'),
            'id'       => 'header_contact_plain_subtext2',
            'type'     => 'text',
            'default'  => 'Monday - Friday',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            )
        ),
        array(
            'title'    => esc_html__('Icon 3', 'alacarte'),
            'id'       => 'header_contact_plain_icon3',
            'type'     => 'text',
            'default'  => 'lnr lnr-map-marker',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            )
        ),
        array(
            'title'    => esc_html__('Title 3', 'alacarte'),
            'id'       => 'header_contact_plain_text3',
            'type'     => 'text',
            'default'  => '99 Kellen Motorway',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            )
        ),
        array(
            'title'    => esc_html__('Description 3', 'alacarte'),
            'id'       => 'header_contact_plain_subtext3',
            'type'     => 'text',
            'default'  => 'Wallis and Futuna',
            'required' => array(
                array('header_contact_plain', '=', '1'),
            )
        ),
    ];
    
    return $opts;
}

/**
 * Theme Options 
 * Show SingIn / SingUp button
 * Require CSH Login Plugin
 *
*/
if(!function_exists('alacarte_header_signin_signup_opts')){
    function alacarte_header_signin_signup_opts($args = []){
        if(!function_exists('cshlg_add_login_form')) return array();
        $args = wp_parse_args($args,[
            'default' => false
        ]);
        if($args['default']){
            $options = array(
                '-1' => esc_html__('Default','alacarte'),
                '1'  => esc_html__('Yes','alacarte'),
                '0'  => esc_html__('No','alacarte'),
            );
            $default_value = '-1';
        } else {
            $options = array(
                '1'  => esc_html__('Yes','alacarte'),
                '0'  => esc_html__('No','alacarte'),
            );
            $default_value = '0';
        }
        return array (
            array(
                'title'    => esc_html__('Show SignIn', 'alacarte'),
                'subtitle' => esc_html__('Show/Hide SignIn Button', 'alacarte'),
                'id'       => 'header_signin',
                'type'     => 'button_set',
                'options'  => $options,
                'default'  => $default_value,
            ),
            array(
                'title'    => esc_html__('SignIn Label', 'alacarte'),
                'id'       => 'header_signin_label',
                'type'     => 'text',
                'default'  => esc_html__('Sign In','alacarte'),
                'required' => array('header_signin', '!=', '0')
            ),
            array(
                'title'    => esc_html__('Show SignUp', 'alacarte'),
                'subtitle' => esc_html__('Show/Hide SignUp Button', 'alacarte'),
                'id'       => 'header_signup',
                'type'     => 'button_set',
                'options'  => $options,
                'default'  => $default_value,
            ),
            array(
                'title'    => esc_html__('SignUp Label', 'alacarte'),
                'id'       => 'header_signup_label',
                'type'     => 'text',
                'default'  => esc_html__('Sign Up','alacarte'),
                'required' => array('header_signup', '!=', '0')
            )
        );
    }
}

/**
 * Main Logo
*/
if(!function_exists('alacarte_header_main_logo')){
    function alacarte_header_main_logo($args = []){
        $args = wp_parse_args($args, [
            'subsection' => true
        ]);
        return array(
            'title'      => esc_html__('Logo', 'alacarte'),
            'icon'       => 'el-icon-picture',
            'subsection' => $args['subsection'],
            'fields'     => array(
                array(
                    'id'             => 'logo',
                    'type'           => 'media',
                    'library_filter' => array('gif','jpg','jpeg','png','svg'),
                    'title'          => esc_html__('Logo', 'alacarte'),
                    'subtitle'       => esc_html__('Choose your logo. If not set, default Logo will be used', 'alacarte')
                ),
                array(
                    'id'       => 'logo_size',
                    'type'     => 'dimensions',
                    'title'    => esc_html__('Logo Size', 'alacarte'),
                    'subtitle' => esc_html__('Enter size (width x height) for your logo, just in case the logo is too large. If not set, default size will be used', 'alacarte'),
                    'units'     => array('px'),
                    'default'   => array(),
                ),
            )
        );
    }
}

/**
 * Ontop Header 
*/
if(!function_exists('alacarte_ontop_header_opts')){
    function alacarte_ontop_header_opts($args = []){
        $args = wp_parse_args($args, [
            'default'    => false,
            'subsection' => true
        ]);
        $force_output = $args['default'] ? true : false;
        if($args['default']){
            $options = array(
                '-1' => esc_html__('Default','alacarte'),
                '1'  => esc_html__('Yes','alacarte'),
                '0'  => esc_html__('No','alacarte'),
            );
            $default_value = '-1';
        } else {
            $options = array(
                '1'  => esc_html__('Yes','alacarte'),
                '0'  => esc_html__('No','alacarte'),
            );
            $default_value = '0';
        }
        return array(
            'title'      => esc_html__('On Top Header', 'alacarte'),
            'icon'       => 'el-icon-credit-card ',
            'subsection' => $args['subsection'],
            'fields'     => array(
                array(
                    'id'       => 'header_ontop',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Header On top', 'alacarte'),
                    'subtitle' => esc_html__('Header will be on top when applicable.', 'alacarte'),
                    'options'  => $options,
                    'default'  => $default_value
                ),
                array(
                    'id'       => 'ontop_logo_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('On top Logo', 'alacarte'),
                    'subtitle' => esc_html__('Custon Logo', 'alacarte'),
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'       => 'ontop_logo',
                    'type'     => 'media',
                    'title'    => esc_html__('On top Logo', 'alacarte'),
                    'subtitle' => esc_html__('If not set, default logo will be used.', 'alacarte'),
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'       => 'ontop_logo_maxh',
                    'type'     => 'dimensions',
                    'title'    => esc_html__('Logo Size', 'alacarte'),
                    'subtitle' => esc_html__('Enter size for your logo in on top header, just in case the logo is too large. If not set, default size will be used', 'alacarte'),
                    'units'     => array('px'),
                    'default'  => array(),
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'       => 'ontop_header_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Header Design', 'alacarte'),
                    'subtitle' => esc_html__('Custom on top header style like: background, color, space, ...', 'alacarte'),
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'     => 'ontop_header_bg',
                    'type'   => 'color_rgba',
                    'title'  => esc_html__('Background', 'alacarte'),
                    'output' => array(
                        'background-color' => '.header-ontop'),
                    'force_output' => $force_output,
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'          => 'ontop_header_text_color',
                    'type'        => 'color_rgba',
                    'title'       => esc_html__('Text Color', 'alacarte'),
                    'default'     => '',
                    'output'      => array(
                        'color' => '.header-ontop'
                    ),
                    'force_output' => $force_output,
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'    => 'ontop_link_colors',
                    'type'  => 'link_color',
                    'title' => esc_html__('Link colors', 'alacarte'),
                    'output' => array(
                        'color' => '.header-ontop a'
                    ),
                    'force_output' => $force_output,
                    'required' => array('header_ontop', '=', '1')
                ),
                array(
                    'id'       => 'header_ontop_border',
                    'type'     => 'spacing',
                    'mode'     => 'margin',
                    'units'          => array('px'),
                    'title'    => esc_html__('Margin Top', 'alacarte'),
                    'right'   => false,
                    'bottom'  => false,
                    'left'    => false,
                    'output'   => array('.header-ontop'),
                    'force_output' => $force_output,
                    'required' => array('header_ontop', '=', '1')
                ),
            )
        );
    }
}

/**
 * Header Sticky Options
*/
if(!function_exists('alacarte_sticky_header_opts')){
    function alacarte_sticky_header_opts($args=[]){
        $args = wp_parse_args($args, [
            'default'    => false,
            'subsection' => true
        ]);
        if($args['default']){
            $options = array(
                '-1' => esc_html__('Default','alacarte'),
                '1'  => esc_html__('Yes','alacarte'),
                '0'  => esc_html__('No','alacarte'),
            );
            $default_value = '-1';
        } else {
            $options = array(
                '1'  => esc_html__('Yes','alacarte'),
                '0'  => esc_html__('No','alacarte'),
            );
            $default_value = '0';
        }
        return array(
            'title'      => esc_html__('Sticky Header', 'alacarte'),
            'icon'       => 'el-icon-credit-card ',
            'subsection' => $args['subsection'],
            'fields'     => array(
                array(
                    'id'       => 'header_sticky',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Sticky Header', 'alacarte'),
                    'subtitle' => esc_html__('Header will be sticked when applicable.', 'alacarte'),
                    'options'  => $options,
                    'default'  => $default_value
                ),
                array(
                    'id'       => 'sticky_logo_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Sticky Logo', 'alacarte'),
                    'subtitle' => esc_html__('Custon Logo', 'alacarte'),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'       => 'sticky_logo',
                    'type'     => 'media',
                    'title'    => esc_html__('Sticky Header Logo', 'alacarte'),
                    'subtitle' => esc_html__('If not set, default logo will be used.', 'alacarte'),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'       => 'sticky_logo_maxh',
                    'type'     => 'dimensions',
                    'title'    => esc_html__('Logo Size', 'alacarte'),
                    'subtitle' => esc_html__('Enter size for your logo on sticky header, just in case the logo is too large.', 'alacarte'),
                    'units'     => array('px'),
                    'default'  => array(
                        'width'   => '', 
                        'height'  => '',
                        'units'   => ''
                    ),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'       => 'sticky_header_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Sticky Header Design', 'alacarte'),
                    'subtitle' => esc_html__('Custom sticky header style like: background, color, space, ...', 'alacarte'),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'     => 'sticky_header_bg',
                    'type'   => 'color_rgba',
                    'title'  => esc_html__('Background', 'alacarte'),
                    'output' => array(
                        'background-color' => '.header-sticky'
                    ),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'          => 'sticky_header_text_color',
                    'type'        => 'color_rgba',
                    'title'       => esc_html__('Text Color', 'alacarte'),
                    'default'     => '',
                    'output'      => array('.header-sticky'),
                    'required' => array('header_sticky','=', '1')
                ),
                array(
                    'id'    => 'sticky_link_colors',
                    'type'  => 'link_color',
                    'title' => esc_html__('Link colors', 'alacarte'),
                    'output' => array(
                        'color' => '.header-sticky a'
                    ),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'       => 'header_sticky_border',
                    'type'     => 'border',
                    'all'      => false,
                    'color'    => false,
                    'title'    => esc_html__('Border Style', 'alacarte'),
                    'subtitle' => esc_html__('Add your custom border design', 'alacarte'),
                    'output'   => array('.header-sticky'),
                    'required' => array('header_sticky', '=', '1')
                ),
                array(
                    'id'       => 'header_sticky_border_color',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__('Border Color', 'alacarte'),
                    'subtitle' => esc_html__('Add your custom border color', 'alacarte'),
                    'output'   => array(
                        'border-color' => '.header-sticky'
                    ),
                    'required' => array('header_sticky', '=', '1')
                )
            )
        );
    }
}
/**
 * Theme Options
 *
*/
if(!function_exists('alacarte_page_title_opts')){
    function alacarte_page_title_opts($args=[]){
        $args = wp_parse_args($args,[
            'default' => false
        ]);
        $force_output = $args['default'] ? true : false;
        $default_value = '1';

        $custom_title = $custom_desc = '';

        $ptitle_layout = [
            '1' => get_template_directory_uri() . '/assets/images/page-title/01.jpg',
        ];
        $breadcrumb_on_opts = array(
            '1'  => esc_html__('Show','alacarte'),
            '0'  => esc_html__('Hide','alacarte'),
         );
        if($args['default']){
            $default_value = '-1';
            $ptitle_layout = [
                '-1'   => get_template_directory_uri() . '/assets/images/default.png',
                'none' => get_template_directory_uri() . '/assets/images/none.png'
            ] + $ptitle_layout;

            $custom_title = array(
                'id'       => 'custom_title',
                'type'     => 'text',
                'title'    => esc_html__('Custom Title', 'alacarte'),
                'subtitle' => esc_html__('Use custom title for this page. The default title will be used on document title.', 'alacarte')
            );

            $custom_desc = array(
                'id'       => 'custom_desc',
                'type'     => 'textarea',
                'title'    => esc_html__('Custom description', 'alacarte'),
                'subtitle' => esc_html__('Show custom page description under page title', 'alacarte')
            );

            $breadcrumb_on_opts = [
                '-1'  => esc_html__('Default','alacarte')
            ] + $breadcrumb_on_opts;
        }
        return array(
            array(
                'id'       => 'ptitle_layout',
                'type'     => 'image_select',
                'title'    => esc_html__('Layout', 'alacarte'),
                'subtitle' => esc_html__('Select a layout for page title.', 'alacarte'),
                'options'  => $ptitle_layout,
                'default'  => $default_value
            ),
            $custom_title,
            $custom_desc,
           
             array(
                'title'          => esc_html__('Typography Title', 'alacarte'),
                'subtitle'       => esc_html__('Page title typography style', 'alacarte'),
                'id'             => 'page_title_typo',
                'type'           => 'typography',
                'text-transform' =>  true,
                'letter-spacing' =>  true,
                'text-align'     =>  false,
                'default'        => '',
                  'output'       => array(
                    'color' => '.red-pagetitle.ptitle-layout-1 .page-title'
                ),
                'force_output' => $force_output,
            
            ),
            array(
                'id'       => 'pagetitle_image_bg',
                'type'     => 'button_set',
                'title'    => __('Background Image ', 'alacarte'),
                'subtitle' => __('Background Image for Page Title', 'alacarte'),
                'options' => array(
                    '1' => 'Yes',
                    '0' => 'No',
                    
                ),
                'default' => '0',

            ),
            array(
                'id'       => 'ptitle_parallax',
                'type'     => 'media',
                'title'    => esc_html__('Parallax Image', 'alacarte'),
                'subtitle' => esc_html__('Choose your image', 'alacarte'),
                'required'    => array('pagetitle_image_bg', '=', '1')
            ),
            array(
                'id'       => 'ptitle_parallax_overlay',
                'type'     => 'color_rgba',
                'title'    => esc_html__('Parallax Overlay Color', 'alacarte'),
                'subtitle' => esc_html__('Add parallax overlay color.', 'alacarte'),
                'output'   => array(
                    'background-color' => '.red-pagetitle .parallax:before'
                ),
                'force_output' => $force_output,
                'default'      => '',
                'required'    => array('pagetitle_image_bg', '=', '1')
            ),
            array(
                'id'           => 'ptitle_paddings',
                'type'         => 'spacing',
                'title'        => esc_html__('Paddings', 'alacarte'),
                'subtitle'     => esc_html__('Enter inner space.', 'alacarte'),
                'mode'         => 'padding',
                'units'        => array('px'),
                'output'       => array('#red-page .red-pagetitle'),
                'force_output' => $force_output,
                'default'      => array()
            ),
            array(
                'id'           => 'ptitle_margins',
                'type'         => 'spacing',
                'title'        => esc_html__('Margin', 'alacarte'),
                'subtitle'     => esc_html__('Enter outer space.', 'alacarte'),
                'mode'         => 'margin',
                'units'        => array('px'),
                'force_output' => $force_output,
                'output'       => array('#red-page .red-pagetitle-wrap'),
                'default'      => array()
            ),
            array(
                'id'      => 'breadcrumb_on',
                'type'    => 'button_set',
                'options' => $breadcrumb_on_opts,
                'title'   => esc_html__('Breadcrumb', 'alacarte'),
                'default' => $default_value
            ),
            array(
                'id'          => 'breadcrumb_color',
                'type'        => 'color',
                'title'       => esc_html__('Breadcrumb Text Color', 'alacarte'),
                'subtitle'    => esc_html__('Select text color for breadcrumb', 'alacarte'),
                'transparent' => false,
                'output'      => array('.red-pagetitle-wrap .breadcrumb'),
                'force_output'=> $force_output,
                'required'    => array('breadcrumb_on', '=', true)
            ),
            array(
                'id'           => 'breadcrumb_link_colors',
                'type'         => 'link_color',
                'title'        => esc_html__('Breadcrumb Link Colors', 'alacarte'),
                'subtitle'     => esc_html__('Select link colors for breadcrumb', 'alacarte'),
                'output'       => array('.red-pagetitle-wrap .breadcrumb a'),
                'force_output' => $force_output,
                'default'      => array(),
                'required'     => array('breadcrumb_on', '=', true)
            )
        );
    }
}

/* Page Options */
if(!function_exists('alacarte_page_opts')){
    function alacarte_page_opts($default = false){
        $options = array();
        $default_value = 'none';
        if($default){
            $options['-1'] = esc_html__('Default','alacarte');
            $default_value = '-1';
        }
        $options['left']  = esc_html__('Left Sidebar', 'alacarte');
        $options['none']  = esc_html__('No Sidebar', 'alacarte');
        $options['right'] = esc_html__('Right Sidebar', 'alacarte');
        return array(
            array(
                'id'       => 'page_sidebar_pos',
                'type'     => 'button_set',
                'title'    => esc_html__('Layouts', 'alacarte'),
                'subtitle' => esc_html__('select a layout for single...', 'alacarte'),
                'options'  => $options,
                'default'  => $default_value
            )
        );
    }
}

/**
 * WooCommerce Options
*/
if(!function_exists('alacarte_woocommerce_theme_opts')){
    function alacarte_woocommerce_theme_opts($default = false){
        $gallery_layout = $gallery_thumb_position        = array();
        $default_value          = 'none';
        $default_gallery_layout = 'thumbnail_h';
        $default_gallery_thumb_position = 'thumb-right';
        if($default){
            $gallery_layout['-1']         = esc_html__('Default','alacarte');
            $gallery_thumb_position['-1'] = esc_html__('Default','alacarte');
            $default_value                = '-1';
            $default_gallery_layout       = '-1';
            $default_gallery_thumb_position       = '-1';
        }
        $gallery_layout['simple']     = esc_html__('Simple', 'alacarte');
        $gallery_layout['thumbnail_v'] = esc_html__('Thumbnail Vertical', 'alacarte');
        $gallery_layout['thumbnail_h'] = esc_html__('Thumbnail Horizontal', 'alacarte');

        $gallery_thumb_position['thumb-left'] = esc_html__('Left','alacarte');
        $gallery_thumb_position['thumb-right'] = esc_html__('Right','alacarte');

        return array(
            'title'      => esc_html__('WooCommerce', 'alacarte'),
            'icon'       => 'el el-shopping-cart',
            'subsection' => false,
            'fields'     => array(
                array(
                    'id'       => 'loop_product_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Loop Products Design', 'alacarte'),
                    'subtitle' => esc_html__('Custom products design, ...', 'alacarte'),
                ),
                array(
                    'id'       => 'products_per_page',
                    'type'     => 'slider',
                    'title'    => esc_html__('Number Products', 'alacarte'),
                    'subtitle' => esc_html__('Choose number products to show on archive page, ...', 'alacarte'),
                    'default'   => 9,
                    'min'       => 1,
                    'step'      => 1,
                    'max'       => 50,
                    'display_value' => 'label'
                ),
                array(
                    'id'       => 'products_columns',
                    'type'     => 'slider',
                    'title'    => esc_html__('Products Columns', 'alacarte'),
                    'subtitle' => esc_html__('Choose products columns show on archive page, ...', 'alacarte'),
                    'default'   => 4,
                    'min'       => 1,
                    'step'      => 1,
                    'max'       => 6,
                    'display_value' => 'label'
                ),
                array(
                    'id'       => 'single_product_design',
                    'type'     => 'info',
                    'style'    => 'success',
                    'title'    => esc_html__('Single Product Design', 'alacarte'),
                    'subtitle' => esc_html__('Custom single product design, ...', 'alacarte'),
                ),
                array(
                    'id'        => 'shop_page_title_bg',
                    'title'     => esc_html__('Background Page Title', 'alacarte'),
                    'subtitle'  => esc_html__('Choose background style', 'alacarte'),
                    'default'   => array(),
                    'type'      => 'background',
                    'output'    => array('.woocommerce .red-pagetitle'),
                ),
                array(
                    'id'       => 'product_gallery_layout',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Layouts product gallery', 'alacarte'),
                    'subtitle' => esc_html__('select a layout for single...', 'alacarte'),
                    'options'  => $gallery_layout,
                    'default'  => $default_gallery_layout
                ),
                array(
                    'id'       => 'product_gallery_thumb_position',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Thumbnail Position', 'alacarte'),
                    'subtitle' => esc_html__('select a position for gallery thumbnail', 'alacarte'),
                    'options'  => $gallery_thumb_position,
                    'default'  => $default_gallery_thumb_position,
                    'required' => array(
                        array('product_gallery_layout', '=', 'thumbnail_v')
                    )
                ),
                array(
                    'id'       => 'product_share_on',
                    'title'    => esc_html__('Share', 'alacarte'),
                    'subtitle' => esc_html__('Show share product to some socials network on each post.', 'alacarte'),
                    'type'     => 'switch',
                    'default'  => '0',
                ),
            )
        );
    }
}

/**
 * Theme Options 
 * Footer Area 
 * Add option repeated for theme/ meta option
*/
if(!function_exists('alacarte_footer_opts')){
    function alacarte_footer_opts($args = []){
        $args = wp_parse_args($args, [
            'default' => false
        ]);
        $default_value = $args['default'] ? '-1' : '';
        $force_output  = $args['default'] ? true : false;
        $title = esc_html__('Enable', 'alacarte');
        $subtitle = esc_html__('Show or hide footer', 'alacarte');
        if($args['default']){
            $enable_opts['-1'] = esc_html__('Default','alacarte');
            $title = esc_html__('Custom', 'alacarte');
            $subtitle = esc_html__('Custom or hide or set default as theme option', 'alacarte');
        }
        $enable_opts['1'] = esc_html__('Yes','alacarte');
        $enable_opts['0'] = esc_html__('No','alacarte');
        return array(
            'title'  => esc_html__('Footer', 'alacarte'),
            'icon'   => 'el el-website',
            'fields' => array(
                array(
                    'title'     => $title,
                    'subtitle'  => $subtitle,
                    'id'        => 'footer_enable',
                    'type'      => 'button_set',
                    'options' => $enable_opts,
                    'default' => $default_value,
                ),
                array(
                    'id'          => 'footer_layout',
                    'type'        => 'image_select',
                    'title'       => esc_html__('Layout', 'alacarte'),
                    'subtitle'    => esc_html__('Select a layout for upper footer area.', 'alacarte'),
                    'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom footer layout first.','alacarte'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=alacarte_footer' ) ) . '">','</a>'),
                    'placeholder' => esc_html__('Default','alacarte'),
                    'options'     => alacarte_list_post_thumbnail('ef5_footer', $args['default']),
                    'default'     => $default_value,
                    'required'  => array('footer_enable', '=', '1')
                ),
                array(
                    'title'    => esc_html__('Add custom logo on footer for this page', 'alacarte'),
                    'subtitle' => esc_html__('Select an image file for your logo on footer.', 'alacarte'),
                    'id'       => 'page_footer_logo',
                    'type'     => 'media',
                    'required'  => array('footer_enable', '=', '1')
                ),
                array(
                    'id'       => 'page_logo_size',
                    'type'     => 'dimensions',
                    'title'    => esc_html__('Logo Size', 'alacarte'),
                    'subtitle' => esc_html__('Enter size (width x height) for your logo, just in case the logo is too large. If not set, default size will be used', 'alacarte'),
                    'units'     => array('px'),
                    'default'   => array(),
                    'output'         => array(
                        '.footer_logo img'
                    ),
                    'required'  => array('footer_enable', '=', '1')
                ),
                array(
                    'title'     => esc_html__('Background Color', 'alacarte'),
                    'id'        => 'footer_bg_color',
                    'type'      => 'color_rgba',
                    'default'   => array(),
                    'output'    => array(
                        'background-color' => 'footer#red-footer.red-footer-area,.red-footer-area .open-hours li span',
                    ),
                    'validate'  => 'colorrgba',
                    'force_output'   => $force_output,
                    'required'  => array('footer_enable', '=', '1')
                ),
                array(
                    'title'          => esc_html__('Columns Title', 'alacarte'),
                    'subtitle'       => esc_html__('Choose typography style for columns title', 'alacarte'),
                    'id'             => 'footer_typo_title',
                    'type'           => 'typography',
                    'text-transform' =>  true,
                    'letter-spacing' =>  true,
                    'text-align'     =>  false,
                    'default'        => array(),
                    'output'         => 'footer#red-footer.red-footer-area .widget-title',
                    'force_output'   => $force_output,
                    'required'  => array('footer_enable', '=', '1')
                ),
                array(
                    'title'    => esc_html__('Link Color', 'alacarte'),
                    'subtitle' => esc_html__('Choose color for link tag', 'alacarte'),
                    'id'       => 'footer_link_color',
                    'type'     => 'link_color',
                    'active'   => false,
                    'output'         => 'footer#red-footer.red-footer-area a',
                    'force_output'   => $force_output,
                    'required'  => array('footer_enable', '=', '1')
                ),
                array(
                    'title' => esc_html__('Icon color', 'alacarte'),
                    'subtitle' => esc_html__('Set color for icon', 'alacarte'),
                    'id' => 'footer_icon_color',
                    'type' => 'link_color',
                    'active'   => false,
                    'default' => '',
                    'output'         => 'footer#red-footer.red-footer-area .red-social a,.red-footer-area .footer-contact li i',
                    'force_output'   => $force_output,
                    'required'  => array('footer_enable', '=', '1')
                ),
                array(
                    'title'          => esc_html__('Typography', 'alacarte'),
                    'subtitle'       => esc_html__('Choose typography style', 'alacarte'),
                    'id'             => 'footer_typo',
                    'type'           => 'typography',
                    'text-transform' =>  true,
                    'letter-spacing' =>  true,
                    'text-align'     =>  false,
                    'default'        => array(),
                    'force_output'   => $force_output,
                    'output'         => 'footer#red-footer.red-footer-area,footer#red-footer.red-footer-area .wpb_wrapper .wpb_text_column .wpb_wrapper',
                    'required'  => array('footer_enable', '=', '1')
                ),
                array(
                    'id'             => 'footer_margin',
                    'type'           => 'spacing',
                    'mode'           => 'margin',
                    'units'          => array('px'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Footer margin', 'alacarte'),
                    'subtitle'       => esc_html__('Enter outer space', 'alacarte'),
                    'force_output'   => $force_output,
                    'output'         => array(
                        '#red-footer'
                    ),
                    'required'  => array('footer_enable', '=', '1')
                ),
                array(
                    'id'             => 'footer_padding',
                    'type'           => 'spacing',
                    'mode'           => 'padding',
                    'units'          => array('px'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Footer padding', 'alacarte'),
                    'subtitle'       => esc_html__('Enter outer space', 'alacarte'),
                    'force_output'   => $force_output,
                    'output'         => array(
                        'footer#red-footer.red-footer-area'
                    ),
                    'required'  => array('footer_enable', '=', '1')
                ),
            )
        );
    }
}