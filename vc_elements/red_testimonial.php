<?php
vc_map(array(
    'name' => 'sunix Testimonial',
    'base' => 'red_testimonial',
    'icon'  => 'red-icon-quote',
    'category' => esc_html__('RedExp', 'sunix'),
    'description' => esc_html__('Add clients testimonial', 'sunix'),
    'params' => array_merge(
        array(
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Content Align','sunix'),
                'param_name'    => 'content_align',
                'value'         => array(
                    'Default'       => '',
                    'Text Left'     => 'text-start',
                    'Text Right'    => 'text-end',
                    'Text Center'   => 'text-center',
                ),
                'std'           => '',
            ),
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','sunix'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1'       => get_template_directory_uri().'/vc_extends/layouts/testimonial/testimonial-1.jpg',
                    '2'       => get_template_directory_uri().'/vc_extends/layouts/testimonial/testimonial-2.jpg',
                    '3'       => get_template_directory_uri().'/vc_extends/layouts/testimonial/testimonial-3.jpg',
                    '4'       => get_template_directory_uri().'/vc_extends/layouts/testimonial/testimonial-4.jpg',
                ),
                'std'         => '1',
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
                'heading'    => esc_html__('Element Class','sunix'),
                'param_name' => 'el_class',
                'value'      => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'sunix'),
            ),
            /* Testimonial Settings */
            array(
                'type'          => 'param_group',
                'heading'       => esc_html__( 'Add your testimonial', 'sunix' ),
                'param_name'    => 'testimonials',
                'value'         => urlencode( json_encode( array(
                    array(
                        'author_name'     => 'Dennis Walls',
                        'author_position' => 'Facilities Manager',
                        'author_url'      => '#',
                        'author_avatar'   => '',
                        'author_signature_img'   => '',
                        'text'          => 'For 22 years, REV Recreation Group has partnered with Unbreak on a variety of projects, and each time they are completed on time and on budget.'
                    ),
                    array(
                        'author_name'     => 'Steven Lehman',
                        'author_position' => 'General Manager',
                        'author_url'      => '#',
                        'author_avatar'   => '',
                        'author_signature_img'   => '',
                        'text'          => 'We’ve worked with Briner on eight building projects over the last 24 years, and we’re always impressed with their thoroughness and commitment to quality.'
                    ),
                    array(
                        'author_name'     => 'Mary John',
                        'author_position' => 'Sales Service',
                        'author_url'      => '#',
                        'author_avatar'   => '',
                        'author_signature_img'   => '',
                        'text'          => 'Donec euismod sem ac urna finibus, sit amet efficitur erat tem pus. Ut dapibus dictum turpis, vel faucibus erat posuere vitae icitur erat tem puna'
                    ),
                    array(
                        'author_name'     => 'Benjamin',
                        'author_position' => 'Marketing Manager',
                        'author_url'      => '#',
                        'author_avatar'   => '',
                        'author_signature_img'   => '',
                        'text'          => 'Donec euismod sem ac urna finibus, sit amet efficitur erat tem pus. Ut dapibus dictum turpis, vel faucibus erat posuere vitae icitur erat tem puna'
                    )
                ) ) ),
                'params' => array(
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Author name', 'sunix' ),
                        'param_name'    => 'author_name',
                        'std'			=> 'John Smith',
                        'admin_label'   => true,
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Author Position', 'sunix' ),
                        'param_name'    => 'author_position',
                        'std'			=> 'Project Manager',
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Author URL', 'sunix' ),
                        'param_name'    => 'author_url',
                        'std'			=> '#',
                    ),
                    array(
                        'type'          => 'attach_image',
                        'heading'       => esc_html__( 'Author Image', 'sunix' ),
                        'param_name'    => 'author_avatar',
                        'value'         => '',
                        'edit_field_class' => 'vc_col-sm-6'
                    ),
                    array(
                        'type'          => 'attach_image',
                        'heading'       => esc_html__( 'Author signature image', 'sunix' ),
                        'param_name'    => 'author_signature_img',
                        'value'         => '',
                        'edit_field_class' => 'vc_col-sm-6'
                    ),
                    array(
		                'type'          => 'dropdown',
		                'heading'       => esc_html__( 'Star Rate', 'sunix' ),
		                'param_name'    => 'author_rate',
		                'value'         => array('','1','2','3','4','5'),
		                'std'           => ''
		            ),
                    array(
                        'type'          => 'textarea',
                        'heading'       => esc_html__( 'Testimonial text', 'sunix' ),
                        'description'   => esc_html__('Press double ENTER to get line-break','sunix'),
                        'param_name'    => 'text',
                        'std'           => 'Donec euismod sem ac urna finibus, sit amet efficitur erat tem pus. Ut dapibus dictum turpis, vel faucibus erat posuere vitae icitur erat tem puna'
                    ),
                ),
                'group' => esc_html__('Testimonial Item','sunix')
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Layout Style','sunix'),
                'param_name' => 'layout_style',
                'value'      =>  array(
                    esc_html__('Grid','sunix')     => 'grid',
                    esc_html__('Carousel','sunix') => 'carousel'
                ),
                'std'        => 'grid',
                'group'      => esc_html__('Layout Settings','sunix'),
                'admin_label'=> true
            ),

        ),
        /* Grid settings */
        sunix_grid_settings(array(
            'group'      => esc_html__('Layout Settings','sunix'),
            'param_name' => 'layout_style', 
            'value'      => 'grid'
            )
        ),
        /* Carousel Settings */
        sunix_owl_settings(array(
            'group'      => esc_html__('Layout Settings','sunix'),
            'param_name' => 'layout_style', 
            'value'      => 'carousel'
            )
        )
    )
));

class WPBakeryShortCode_red_testimonial extends WPBakeryShortCode
{
    protected function content($atts, $content = null){
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        sunix_owl_call_settings($atts);
        return parent::content($atts, $content);
    }
}