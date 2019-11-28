<?php
vc_map(array(
    'name'        => 'sunix Portfolio',
    'base'        => 'red_portfolio',
    'category'    => esc_html__('RedExp', 'sunix'),
    'icon'        => 'icon-wpb-single-image',
    'class'       => 'wpb_vc_single_image',
    'params'      => array_merge(
        array(
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Post Per Page','sunix'),
                'param_name' => 'posts_per_page',
                'value'      =>  get_option('posts_per_page'),
            ),
            array(
                'type'        => 'el_id',
                'settings' => array(
                    'auto_generate' => true,
                ),
                'heading'     => esc_html__( 'Element ID', 'sunix' ),
                'param_name'  => 'el_id',
                'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'sunix' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Extra Class','sunix'),
                'param_name' => 'el_class',
                'value'      => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'sunix'),
            )
        )
    )
));

class WPBakeryShortCode_red_portfolio extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        wp_enqueue_script( 'imagesloaded');
        wp_enqueue_script( 'isotope');
        return parent::content($atts, $content);
    }
}