<?php
vc_map(array(
    'name'          => 'Red Team',
    'base'          => 'red_team',
    'icon'          => '',
    'category'      => esc_html__('RedExp', 'alacarte'),
    'description'   => esc_html__('Add your team member', 'alacarte'),
    'params'        => array_merge(
        array(
            /* Template Settings */
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Content Alignments','alacarte'),
                'param_name'    => 'content_align',
                'value'         => array(
                    'Default'       => '',
                    'Text Left'     => 'left',
                    'Text Right'    => 'right',
                    'Text Center'   => 'center',
                ),
                'std'           => '',
            ),
            array(
                'type' => 'img',
                'heading' => esc_html__('Layout Template','alacarte'),
                'param_name' => 'layout_template',
                'value' =>  array(
                    '1' => get_template_directory_uri().'/vc_extends/layouts/team/team-1.jpg',
                    '2' => get_template_directory_uri().'/vc_extends/layouts/team/team-2.jpg',
                ),
                'std' => '1',
                'admin_label' => true
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
            ),
            /* Members Settings */
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Member image size','alacarte'),
                'param_name'    => 'thumbnail_size',
                'value'         => alacarte_thumbnail_sizes(),
                'std'           => 'custom',
                'group'         => esc_html__('Members','alacarte'),
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Custom member image size','alacarte'),
                'description'   => esc_html__('Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','alacarte'),
                'param_name'    => 'thumbnail_size_custom',
                'value'         => '',
                'std'           => '',
                'group'         => esc_html__('Members','alacarte'),
                'dependency'    => array(
                    'element'   => 'thumbnail_size',
                    'value'     => 'custom',
                ),
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'thumbnail_bw',
                'value'         => array(
                    esc_html__('Make Member image as Black & White','alacarte') => '1'
                ),
                'std'           => '0',
                'group'         => esc_html__('Members', 'alacarte')
            ),
            array(
                'type'          => 'param_group',
                'heading'       => esc_html__( 'Add Member', 'alacarte' ),
                'param_name'    => 'teams',
                'std'           => urlencode( json_encode( array(
                    array(
                        'name'     => 'Roberto Antonio',
                        'position' => 'Director',
                        'link'     => 'title:Roberto Antonio||url:#',
                    ),
                    array(
                        'name'     => 'Damien Ruth',
                        'position' => 'Ceo & Architect',
                        'link'     => 'title:Damien Ruth||url:#',
                    ),
                    array(
                        'name'     => 'Ashley Fletcher',
                        'position' => 'Director',
                        'link'     => 'title:Ashley Fletcher||url:#',
                    ),
                    array(
                        'name'     => 'Marie Mercury',
                        'position' => 'Elevator',
                        'link'     => 'title:Marie Mercury||url:#',
                    ),
                    array(
                        'name'     => 'William',
                        'position' => 'Founder & CEO',
                        'desc'     => '',
                        'link'     => 'title:William||url:#',
                    ),
                    array(
                        'name'     => 'Charlotte',
                        'position' => 'Marketing',
                        'desc'     => '',
                        'link'     => 'title:Charlotte||url:#',
                    ),
                    array(
                        'name'     => 'Benjamin',
                        'position' => 'Graphic Designer',
                        'desc'     => '',
                        'link'     => 'title:Benjamin||url:#',
                    ),
                    array(
                        'name'     => 'Amelia',
                        'position' => 'Support',
                        'desc'     => '',
                        'link'     => 'title:Amelia||url:#',
                    ),
                ) ) ),
                'params'        => array(
                    array(
                        'type'          => 'attach_image',
                        'heading'       => esc_html__( 'Image', 'alacarte' ),
                        'param_name'    => 'image',
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Name', 'alacarte' ),
                        'param_name'    => 'name',
                        'admin_label'   => true,
                    ),
                    array(
                        'type'          => 'textfield',
                        'heading'       => esc_html__( 'Position', 'alacarte' ),
                        'param_name'    => 'position',
                    ),
                    array(
                        'type'          => 'textarea',
                        'heading'       => esc_html__( 'Description', 'alacarte' ),
                        'param_name'    => 'desc',
                    ),
                    array(
                        'type'          => 'vc_link',
                        'heading'       => esc_html__( 'Member Page', 'alacarte' ),
                        'param_name'    => 'link',
                        'description'   => esc_html__( 'Enter link to member details page.', 'alacarte' ),
                    ),
                    array(
                        'type'          => 'param_group',
                        'heading'       => esc_html__( 'Member Social', 'alacarte' ),
                        'param_name'    => 'social',
                        'std'           => urlencode( json_encode( array(
                            array(
                                'icon' => 'fa fa-facebook',
                                'link' => 'title:Facebook||url:facebook.com'
                            ),
                            array(
                                'icon' => 'fa fa-twitter',
                                'link' => 'title:Twitter||url:twitter.com'
                            ),
                            array(
                                'icon' => 'fa fa-google-plus',
                                'link' => 'title:Google Plus||url:plus.google.com'
                            ),
                            array(
                                'icon' => 'fa fa-linkedin',
                                'link' => 'title:Linkedin||url:linkedin.com'
                            ),
                        ) ) ),
                        'params'        => array(
                            array(
                                'type'          => 'iconpicker',
                                'heading'       => esc_html__( 'Social icon', 'alacarte' ),
                                'param_name'    => 'icon',
                                'admin_label'   => true,
                            ),
                            array(
                                'type'          => 'vc_link',
                                'heading'       => esc_html__( 'Enter social link', 'alacarte' ),
                                'param_name'    => 'link',
                            ),
                        ),
                    ),
                    
                ),
                'group'     => esc_html__('Members','alacarte')
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
            )
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

class WPBakeryShortCode_red_team extends WPBakeryShortCode
{
    protected function content($atts, $content = null){
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        alacarte_owl_call_settings($atts);
        return parent::content($atts, $content);
    }
}