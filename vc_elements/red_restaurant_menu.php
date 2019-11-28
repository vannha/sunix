<?php
if (!function_exists('fr_get_tax_by')) {
    return;
}
function sunix_shortcode_grid_menu()
{
    $menus_type = fr_get_categories();
    $menutype = array();
    foreach ($menus_type as $menu_type) {
        $menutype[$menu_type['name']] = $menu_type['slug'];
    }
    return $menutype;
}
function sunix_shortcode_grid_menu_default()
{
    $grid_menu_options = sunix_shortcode_grid_menu();
    if(empty($grid_menu_options))
        return 'none';
    $grid_menu_option_keys = array_keys($grid_menu_options);
    $grid_menu_options_default = $grid_menu_options[$grid_menu_option_keys[0]];
    return $grid_menu_options_default;
}
vc_map(array(
    "name"     => 'Restaurant Carousel Menu',
    "base"     => "red_restaurant_menu",
    "icon"     => "cs_icon_for_vc",
    "category" => esc_html__('RedExp', 'sunix'),
    "params"   => array(
        array(
            'type'       => 'img',
            'heading'    => esc_html__('Layout Mode','sunix'),
            'param_name' => 'layout_template',
            'value'      =>  array(
                '1' => get_template_directory_uri().'/vc_extends/layouts/menu_carousel/layout-1.jpg',
                '2' => get_template_directory_uri().'/vc_extends/layouts/menu_carousel/layout-2.jpg',
                '3' => get_template_directory_uri().'/vc_extends/layouts/menu_carousel/layout-3.jpg',
            ),
            'std'        => '1',
            'admin_label' => true
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__("Choose Menus Type", 'sunix'),
            'param_name' => 'choose_menu',
            'value' => sunix_shortcode_grid_menu(),
        ),
        array(
            "type"       => "textfield",
            "heading"    => __('Number menu', 'sunix'),
            "param_name" => "number_menu",
        ),
        array(
            'type'        => 'checkbox',
            'param_name'  => 'show_nav',
            'value'       => array(
                esc_html__('Show Next/Preview button','sunix') => 'true'
            ),
            'std'         => 'true',
        ),
        array(
            'type'        => 'checkbox',
            'param_name'  => 'show_dot',
            'value'       => array(
                esc_html__('Show Dots','sunix') => 'true'
            ),
            'std'         => 'false',
        ),
        array(
            'type'        => 'checkbox',
            'param_name'  => 'show_loop',
            'value'       => array(
                esc_html__('show_loop','sunix') => 'true'
            ),
            'std'         => 'true',
        ),
    )
));

class WPBakeryShortCode_red_restaurant_menu extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );

        return parent::content($atts, $content);
    }
}
