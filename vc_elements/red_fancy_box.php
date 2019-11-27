<?php
vc_map(array(
    'name'        => 'RedExp Fancy Box',
    'base'        => 'red_fancy_box',
    'category'    => esc_html__('RedExp', 'alacarte'),
    'description' => esc_html__('Add fancy boxes', 'alacarte'),
    'icon'        => 'icon-wpb-ui-icon',
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Mode','alacarte'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1' => get_template_directory_uri().'/vc_extends/layouts/fancybox/layout-1.jpg',
                    '2' => get_template_directory_uri().'/vc_extends/layouts/fancybox/layout-2.png',
                    '3' => get_template_directory_uri().'/vc_extends/layouts/fancybox/layout-3.jpg',
                    '4' => get_template_directory_uri().'/vc_extends/layouts/fancybox/layout-4.jpg',
                    '5' => get_template_directory_uri().'/vc_extends/layouts/fancybox/layout-5.jpg',
                    '6' => get_template_directory_uri().'/vc_extends/layouts/fancybox/layout-6.jpg',
                    '7' => get_template_directory_uri().'/vc_extends/layouts/fancybox/layout-7.jpg',
                    '8' => get_template_directory_uri().'/vc_extends/layouts/fancybox/layout-8.jpg',
                ),
                'std'        => '1',
                'admin_label' => true
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__('Background Color','alacarte'),
                'param_name'  => 'bg_color',
                'value'       => alacarte_bg_color(),
                'std'         => 'red-bg',
                'description' => esc_html__('Choose your box background color','alacarte'),
                'dependency'  => array(
                    'element' => 'layout_template',
                    'value'   => array('6')
                )
            ),
	        array(
				'type'       => 'textfield',
				'heading'    => esc_html__('Element Class','alacarte'),
				'param_name' => 'el_class',
				'std'		 => ''
			)
        ),
        // Content
        array(
        	array(
        		'type'       => 'textarea',
                'heading'    => esc_html__('Heading','alacarte'),
                'param_name' => 'heading',
                'value'      => 'CMS Fancy Icon Box',
                'holder' 	 => 'h3',
                'group'	     => esc_html__('Content','alacarte')
        	),
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Heading Color','alacarte'),
                'param_name' => 'heading_color',
                'value'      => '',
                'std'        => '',
                'dependency'  => array(
                    'element'   => 'heading',
                    'not_empty' => true
                ),
                'group'      => esc_html__('Content','alacarte')
            ),
        	array(
        		'type'       => 'textarea',
                'heading'    => esc_html__('Description','alacarte'),
                'param_name' => 'desc',
                'value'      => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit sit amet justo Suspendisse et justo.',
                'holder' 	 => 'div',
                'group'	     => esc_html__('Content','alacarte')
        	),
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Description Color','alacarte'),
                'param_name' => 'desc_color',
                'value'      => '',
                'std'        => '',
                'dependency'  => array(
                    'element'   => 'desc',
                    'not_empty' => true
                ),
                'group'      => esc_html__('Content','alacarte')
            ),
        	array(
				'type'       => 'vc_link',
				'heading'    => esc_html__('Choose your link','alacarte'),
				'param_name' => 'button_link',
	            'group'	     => esc_html__('Content','alacarte')
		    )
        ),
        // Icon
        array(
        	array(
        		'type'       => 'dropdown',
                'param_name' => 'add_icon',
                'heading'    => esc_html__('Add Icon?','alacarte'),
                'value'      => array(
                    esc_html__('None','alacarte')          => 'none',
                    esc_html__('Font Icon?','alacarte')    => 'true',
                    esc_html__('Upload Icon/Image?','alacarte') => 'upload'
                ),
                'std'		 => 'true',
                'group'	     => esc_html__('Icon','alacarte')
        	),
            array(
                'type'       => 'attach_image',
                'heading'    => esc_html__('Upload your own image?','alacarte'),
                'param_name' => 'icon_upload',
                'value'      => '',
                'std'        => '',
                'dependency' => array(
                    'element' => 'add_icon',
                    'value'   => 'upload',
                ),
                'group'      => esc_html__('Icon','alacarte')
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Icon Size','alacarte'),
                'description'   => esc_html__('Enter image size defined by theme (Example: "thumbnail", "medium", "large","post-thumbnail", "full". Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','alacarte'),
                'param_name'    => 'icon_size',
                'value'         => '60',
                'std'           => '60',
                'group'         => esc_html__('Image', 'alacarte'),
                'dependency'    => array(
                  'element'   => 'icon_upload',
                  'not_empty' => true,
                ),
            ),
        ),
        // icon list 
        alacarte_icon_libs(),
        alacarte_icon_libs_icon(),
        array(
        	array(
				'type'       => 'dropdown',
				'param_name' => 'i_color',
				'heading'    => esc_html__('Icon Color','alacarte'),
				'value'      => array_merge(
        			array(
        				esc_html__('Default','alacarte') => '',
                        esc_html__('Custom Color','alacarte') => 'custom'
        			)
        		),
				'std'        => '',
				'group'      => esc_html__('Icon','alacarte'),
				'dependency' => array(
					'element' => 'add_icon',
					'value'   => 'true',
			    )
        	),
            array(
                'type'       => 'colorpicker',
                'param_name' => 'i_custom_color',
                'heading'    => esc_html__('Icon Custom Color','alacarte'),
                'value'      => '',
                'std'        => '',
                'group'      => esc_html__('Icon','alacarte'),
                'dependency' => array(
                    'element' => 'i_color',
                    'value'   => 'custom',
                )
            ),
            array(
                'type'       => 'dropdown',
                'param_name' => 'i_bg_color',
                'heading'    => esc_html__('Icon Background Color','alacarte'),
                'value'      => alacarte_theme_colors(true),
                'std'        => '',
                'group'      => esc_html__('Icon','alacarte'),
                'dependency' => array(
                    'element' => 'add_icon',
                    'value'   => 'true',
                )
            ),
            array(
                'type'       => 'colorpicker',
                'param_name' => 'i_custom_bg_color',
                'heading'    => esc_html__('Icon Custom Background Color','alacarte'),
                'value'      => '',
                'std'        => '',
                'group'      => esc_html__('Icon','alacarte'),
                'dependency' => array(
                    'element' => 'i_bg_color',
                    'value'   => 'custom',
                )
            ),
        	array(
	           'type'       => 'textfield',
	            'param_name'    => 'i_size',
	            'heading'       => esc_html__( 'Icon Size', 'alacarte' ),
	            'group' 		=> esc_html__('Icon','alacarte'),
	            'dependency'	=> array(
					'element' => 'add_icon',
					'value'   => 'true',
			    )
	        ),
	        array(
	            'type'          => 'dropdown',
	            'param_name'    => 'i_shape',
	            'heading'       => esc_html__( 'Icon Shape', 'alacarte' ),
	            'value'         => array(
					esc_html__('Default (Plain)','alacarte') => 'plain',
            	),
	            'std'           => 'box square',
	            'description'   => esc_html__( 'Choose a shape for icon', 'alacarte' ),
	            'group' 		=> esc_html__('Icon','alacarte'),
	            'dependency'	=> array(
					'element' => 'add_icon',
					'value'   => 'true',
			    )
	        )
	    )
    )
));
class WPBakeryShortCode_red_fancy_box extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
		/* Call icon font stylesheet */
		vc_icon_element_fonts_enqueue( $atts['i_type'] );
        return parent::content($atts, $content);
    }
}