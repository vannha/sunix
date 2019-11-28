<?php
vc_map(array(
    'name'        => 'sunix Gallery Image',
    'base'        => 'red_gallery_image',
    'category'    => esc_html__('RedExp', 'sunix'),
    'description' => esc_html__('Add image with custom', 'sunix'),
    'icon'        => 'icon-wpb-single-image',
    'class'       => 'wpb_vc_single_image',
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','sunix'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1'         => get_template_directory_uri().'/vc_extends/layouts/gallery/layout-1.jpg',
                    '2'         => get_template_directory_uri().'/vc_extends/layouts/gallery/layout-2.jpg',
                    '3'         => get_template_directory_uri().'/vc_extends/layouts/gallery/layout-3.jpg',
                    '4'         => get_template_directory_uri().'/vc_extends/layouts/gallery/layout-4.jpg',
                    '5'         => get_template_directory_uri().'/vc_extends/layouts/gallery/layout-5.jpg',
                    '6'         => get_template_directory_uri().'/vc_extends/layouts/gallery/layout-6.jpg',
                ),
                'std'        => '1',
                'admin_label' => true
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
        ),
        /* Images Settings */
        array(
            array(
                'type'        => 'attach_images',
                'heading'     => esc_html__( 'Image', 'sunix' ),
                'param_name'  => 'img_id',
                'admin_label' => false,
                'group'       => esc_html__('Images','sunix'),
            )
        )
    )
));

class WPBakeryShortCode_red_gallery_image extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        wp_enqueue_script( 'imagesloaded');
        wp_enqueue_script( 'isotope');
        return parent::content($atts, $content);
    }
}