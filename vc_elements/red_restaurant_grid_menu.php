<?php
if (!function_exists('fr_get_tax_by')) {
    return;
}
function alacarte_shortcode_grid_menu3()
{
    $menus_type = fr_get_categories();
    $menutype = array();
    foreach ($menus_type as $menu_type) {
        $menutype[$menu_type['name']] = $menu_type['slug'];
    }
    return $menutype;
}

vc_map(array(
    "name"     => 'Restaurant Grid Menu',
    "base"     => "red_restaurant_grid_menu",
    "icon"     => "cs_icon_for_vc",
    "category" => esc_html__('RedExp', 'alacarte'),
    "params"   => array(
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__("Choose Menus Type", 'alacarte'),
            'param_name' => 'choose_menu',
            'value' => alacarte_shortcode_grid_menu3(),
        ),
        array(
            "type"       => "textfield",
            "heading"    => __('Number menu', 'alacarte'),
            "param_name" => "number_menu",
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'show_filter',
            'value'      => array(
                esc_html__('Show Filter','alacarte') => '1'
            ),
            'std'   => '1',
            'group' => esc_html__('Filter','alacarte'),
        ),
        array(
            'type'          => 'textfield',
            'heading'       => esc_html__('Image size','alacarte'),
            'description'   => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "post-thumbnail", "full". Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','alacarte'),
            'param_name'    => 'img_size',
            'value'         => 'medium',
            'std'           => 'medium',
            'group'         => esc_html__('Images','alacarte'),
        ),
        array(
            'type'        => 'el_id',
            'settings' => array(
                'auto_generate' => true,
            ),
            'heading'     => esc_html__( 'Element ID', 'alacarte' ),
            'param_name'  => 'el_id',
            'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'alacarte' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
        ),

    )
));

class WPBakeryShortCode_red_restaurant_grid_menu extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        wp_enqueue_script( 'imagesloaded');
        wp_enqueue_script( 'isotope');
        return  parent::content($atts, $content);
    }
}
add_action('wp_ajax_cms_restaurant_grid_menu_get_content', 'alacarte_cms_restaurant_grid_menu_get_content');
add_action('wp_ajax_nopriv_cms_restaurant_grid_menu_get_content', 'alacarte_cms_restaurant_grid_menu_get_content');
