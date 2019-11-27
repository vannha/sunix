<?php
if (!function_exists('fr_get_tax_by')) {
    return;
}
vc_map(array(
    "name"     => 'Restaurant Menu Simple',
    "base"     => "red_restaurant_menu_simple",
    "icon"     => "cs_icon_for_vc",
    "category" => esc_html__('RedExp', 'alacarte'),
    "params"   => array_merge(
        array(
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__("Choose Menus Type", 'alacarte'),
                'param_name' => 'choose_menu',
                'value' => alacarte_shortcode_grid_menu(),
            ),
            array(
                "type"       => "textfield",
                "heading"    => __('Number all menu', 'alacarte'),
                "param_name" => "number_menu",
            ),
            array(
                "type"       => "textfield",
                "heading"    => __('Number menu per page', 'alacarte'),
                "param_name" => "number_row",
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
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Layout Style','alacarte'),
                'param_name' => 'layout_style',
                'value'      =>  array(
                    esc_html__('Grid','alacarte')     => 'grid',
                    esc_html__('Carousel','alacarte') => 'carousel'
                ),
                'std'        => 'grid',
                'group'      => esc_html__('Layout Settings','alacarte'),
                'admin_label' => true
            ),
        ),
        /* Grid settings */
        alacarte_grid_settings(array(
                'group'      => esc_html__('Layout Settings','alacarte'),
                'param_name' => 'layout_style',
                'value'      => 'grid'
            )
        ),
        /* Carousel Settings */
        alacarte_owl_settings(array(
                'group'      => esc_html__('Layout Settings','alacarte'),
                'param_name' => 'layout_style',
                'value'      => 'carousel'
            )
        )
    )
));

class WPBakeryShortCode_red_restaurant_menu_simple extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        alacarte_owl_call_settings($atts);
        return parent::content($atts, $content);
    }
}
