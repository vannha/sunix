<?php
if (!function_exists('fr_get_tax_by')) {
	return;
}
function alacarte_shortcode_grid_menu2()
{
	$menus_type = fr_get_categories();
	$menutype = array();
	foreach ($menus_type as $menu_type) {
		$menutype[$menu_type['name']] = $menu_type['slug'];
	}
	return $menutype;
}
vc_map(array(
    "name" => 'Red Restaurant Filter Carousel',
    "base" => "red_restaurant_filter_carousel",
    "icon" => "cs_icon_for_vc",
    "category" =>  esc_html__('RedExp', 'alacarte'),
    "description" =>  '',
    "params" => array(
        array(
            'type'       => 'img',
            'heading'    => esc_html__('Layout Mode','alacarte'),
            'param_name' => 'layout_template',
            'value'      =>  array(
                '1' => get_template_directory_uri().'/vc_extends/layouts/filter_menu_carousel/layout-1.jpg',
                '2' => get_template_directory_uri().'/vc_extends/layouts/filter_menu_carousel/layout-2.jpg',
                '3' => get_template_directory_uri().'/vc_extends/layouts/filter_menu_carousel/layout-3.jpg',
            ),
            'std'        => '1',
            'admin_label' => true
        ),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__("Choose Menus Type", 'alacarte'),
			'param_name' => 'choose_menu',
			'value' => alacarte_shortcode_grid_menu2(),
		),
        array(
            "type"       => "textfield",
            "heading"    => __('Number all menu', 'alacarte'),
            "param_name" => "number_menu",
        ),
        array(
            "type"       => "textfield",
            "heading"    => __('Number row of menu per page', 'alacarte'),
            "param_name" => "number_row",
        ),
        array(
            'type'        => 'checkbox',
            'param_name'  => 'show_nav',
            'value'       => array(
                esc_html__('Show Next/Preview button','alacarte') => 'true'
            ),
            'std'         => 'true',
        ),
        array(
            'type'        => 'checkbox',
            'param_name'  => 'show_dot',
            'value'       => array(
                esc_html__('Show Dots','alacarte') => 'true'
            ),
            'std'         => 'true',
        ),
        array(
            'type'        => 'checkbox',
            'param_name'  => 'show_loop',
            'value'       => array(
                esc_html__('show_loop','alacarte') => 'true'
            ),
            'std'         => 'true',
        ),
    )
));
  
class WPBakeryShortCode_red_restaurant_filter_carousel extends WPBakeryShortCode
{
    protected function content($atts, $content = null){
		$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		return parent::content($atts, $content);
    }
     
}
 


?>