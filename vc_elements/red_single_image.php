<?php
vc_map(array(
    'name'        => 'AlaCarte Single Image',
    'base'        => 'red_single_image',
    'category'    => esc_html__('RedExp', 'alacarte'),
    'description' => esc_html__('Add image with custom', 'alacarte'),
    'icon'        => 'icon-wpb-single-image',
    'class'       => 'wpb_vc_single_image',
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','alacarte'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1'         => get_template_directory_uri().'/assets/images/default.png',
                ),
                'std'        => '1',
                'admin_label' => true
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Shape','alacarte'),
                'param_name'    => 'shape',
                'value'         => array(
                    esc_html__('Default','alacarte')         => '',
                    esc_html__('Square','alacarte')          => 'square',
                    esc_html__('Square Outline','alacarte')  => 'square outline',
                    esc_html__('Rounded','alacarte')         => 'rounded',
                    esc_html__('Rounded Outline','alacarte') => 'rounded outline',
                    esc_html__('Circle','alacarte')          => 'circle',
                    esc_html__('Circle Outline','alacarte')  => 'circle outline',
                ),
                'std'           => '',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Outline Width','alacarte'),
                'description' => esc_html__('Enter number between 0-100, leave blank to use default. Max is 100','alacarte'),
                'param_name'  => 'box_outline_w',
                'std'         => '15',
                'dependency'  => array(
                    'element' => 'shape',
                    'value'   =>  array(
                        'square outline',
                        'rounded outline',
                        'circle outline'
                    )  
                ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Box Shadow','alacarte'),
                'param_name'    => 'box_shadow',
                'value'         => array(
                    esc_html__('Default','alacarte')                    => '',
                    esc_html__('Default Box Shadow','alacarte')         => 'box-shadow',
                    esc_html__('Small Box Shadow','alacarte')           => 'box-shadow-small',
                    esc_html__('Medium Box Shadow','alacarte')          => 'box-shadow-medium',
                    esc_html__('Large Box Shadow','alacarte')           => 'box-shadow-large',
                    esc_html__('Box Shadow on Hover','alacarte')        => 'box-shadow-hover',
                    esc_html__('Small Box Shadow on Hover','alacarte')  => 'box-shadow-hover-small',
                    esc_html__('Medium Box Shadow on Hover','alacarte') => 'box-shadow-hover-medium',
                    esc_html__('Large Box Shadow on Hover','alacarte')  => 'box-shadow-hover-large',
                ),
                'std'           => '',
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
                'type'       => 'textfield',
                'heading'    => esc_html__('Extra Class','alacarte'),
                'param_name' => 'el_class',
                'value'      => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'alacarte'),
            )
        ),
        /* Images Settings */
        array(
            array(
                'type'        => 'attach_image',
                'heading'     => esc_html__( 'Image', 'alacarte' ),
                'param_name'  => 'img_id',
                'admin_label' => true,
                'group'       => esc_html__('Images','alacarte'),
            ),
            array(
                'type'        => 'checkbox',
                'param_name'  => 'img_show_caption',
                'value'       => array(
                    esc_html__('Show Caption','alacarte') => '1'
                ),
                'std'         => '0',
                'group'       => esc_html__('Images','alacarte'),
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
                'type'        => 'dropdown',
                'heading'     => esc_html__('Action On Hover','alacarte'),
                'param_name'  => 'img_hover_action',
                'std'         => '',
                'value'       => array(
                    esc_html__('None','alacarte')        => '',
                    esc_html__('Custom Link','alacarte') => 'custom_link',
                    esc_html__('Zoom','alacarte')        => 'zoom',
                ),
                'group'         => esc_html__('Images','alacarte'),
            ),
            array(
                'type'        => 'vc_link',
                'heading'     => esc_html__( 'Link', 'alacarte' ),
                'param_name'  => 'img_link',
                'description' => esc_html__( 'Enter link for image.', 'alacarte' ),
                'group'         => esc_html__('Images','alacarte'),
                'dependency'  => array(
                    'element' => 'img_hover_action',
                    'value'   =>  array('custom_link')  
                ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Image Style','alacarte'),
                'param_name'    => 'img_style',
                'value'         => array(
                    esc_html__('Default','alacarte')         => '',
                    esc_html__('Square','alacarte')          => 'square',
                    esc_html__('Square Outline','alacarte')  => 'square outline',
                    esc_html__('Rounded','alacarte')         => 'rounded',
                    esc_html__('Rounded Outline','alacarte') => 'rounded outline',
                    esc_html__('Circle','alacarte')          => 'circle',
                    esc_html__('Circle Outline','alacarte')  => 'circle outline',
                    esc_html__('Default Reponsive','alacarte')  => 'default-responsive',
                ),
                'std'           => '',
                'group'         => esc_html__('Images','alacarte'),
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__('Image Outline Width','alacarte'),
                'description' => esc_html__('Enter number between 0-100, leave blank to use default. Max is 100','alacarte'),
                'param_name'  => 'img_outline_w',
                'std'         => '15',
                'dependency'  => array(
                    'element' => 'img_style',
                    'value'   =>  array(
                        'square outline',
                        'rounded outline',
                        'circle outline'
                    )  
                ),
                'group'         => esc_html__('Images','alacarte'),
            ),
        )
    )
));

class WPBakeryShortCode_red_single_image extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        switch ( $atts['img_hover_action'] ) {
            case 'custom_link':
                // $link is already defined
                break;
            case 'zoom':
                wp_enqueue_script( 'red-image-zoom' );
                break;
        }
        return parent::content($atts, $content);
    }
}