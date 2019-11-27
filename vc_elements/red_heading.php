<?php
vc_map(array(
    'name'        => 'AlaCarte Heading',
    'base'        => 'red_heading',
    'category'    => esc_html__('RedExp', 'alacarte'),
    'description' => esc_html__('Add your custom heading', 'alacarte'),
    'icon'        => 'icon-wpb-ui-custom_heading',
    'params'      => array_merge(
        array(
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','alacarte'),
                'param_name' => 'layout_template',
                'value'      =>  array(
                    '1' => get_template_directory_uri().'/vc_extends/layouts/heading/heading-1.jpg',
                    '2' => get_template_directory_uri().'/vc_extends/layouts/heading/heading-2.jpg',
                    '3' => get_template_directory_uri().'/vc_extends/layouts/heading/heading-3.jpg',
                    '4' => get_template_directory_uri().'/vc_extends/layouts/heading/heading-4.jpg',
                ),
                'std'              => '1',
                'admin_label'      => true,
                'edit_field_class' => 'red-select-img-2col'
            ),
            alacarte_vc_content_align_opts(),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Element Class','alacarte'),
                'param_name' => 'el_class',
                'value'      => '',
                'std'        => ''
            ),
            // Small Heading 
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text','alacarte'),
                'param_name' => 'small_heading_text',
                'value'      => '',
                'holder'     => 'div',
                'group'      => esc_html__('Small Heading','alacarte'),
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Text Color','alacarte'),
                'param_name' => 'small_heading_color',
                'group'      => esc_html__('Small Heading','alacarte'),
                'dependency' => array(
                    'element'   => 'small_heading_text',
                    'not_empty' => true
                ), 
            ),
            // Heading 
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text','alacarte'),
                'param_name' => 'heading_text',
                'value'      => 'This is AlaCarte custom heading element',
                'holder'     => 'h4',
                'group'      => esc_html__('Heading','alacarte')
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Tag','alacarte'),
                'param_name' => 'heading_tag',
                'value'      => array_merge(
                    alacarte_heading_tag(),
                    array(
                        esc_html__('Custom Size (40)','alacarte') => 'text-40',
                        esc_html__('Enter Custom Size','alacarte') => 'custom'
                    )
                ),
                'std'        => 'red-heading',
                'group'      => esc_html__('Heading','alacarte')
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Font Size','alacarte'),
                'description'=> esc_html__('Enter the number only','alacarte'),
                'param_name' => 'heading_size',
                'group'      => esc_html__('Heading','alacarte'),
                'dependency' => array(
                    'element' => 'heading_tag',
                    'value'   => array('custom')
                ),
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Font Style','alacarte'),
                'param_name' => 'heading_style',
                'value'      => alacarte_heading_font_weight(),
                'std'        => '',
                'group'      => esc_html__('Heading','alacarte'),
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Text Transform','alacarte'),
                'param_name' => 'heading_text_transform',
                'value'      => alacarte_heading_text_transform(),
                'std'        => '',
                'group'      => esc_html__('Heading','alacarte'),
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Font Color','alacarte'),
                'param_name' => 'heading_font_color',
                'value'      => alacarte_theme_colors(true, true),
                'std'        => 'custom',
                'group'      => esc_html__('Heading','alacarte'),
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Custom Font Color','alacarte'),
                'param_name' => 'heading_color',
                'value'      => '',
                'dependency' => array(
                    'element' => 'heading_font_color',
                    'value'   => array('custom')
                ),
                'group'      => esc_html__('Heading','alacarte'),
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Line Height','alacarte'),
                'description'=> esc_html__('Enter the number only. Example: 1.2','alacarte'),
                'param_name' => 'heading_line_height',
                'group'      => esc_html__('Heading','alacarte'),
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Letter Spacing','alacarte'),
                'description'=> esc_html__('Enter the number only','alacarte'),
                'param_name' => 'heading_letter_spacing',
                'group'      => esc_html__('Heading','alacarte'),
                'edit_field_class' => 'vc_col-sm-6'
            ),
            // Heading 2 
            array(
                'type'       => 'checkbox',
                'param_name' => 'show_heading2',
                'value'      => array(
                    esc_html__('Show Heading Part 2','alacarte') => '1',
                ),
                'std'        => '0',
                'group'      => esc_html__('Heading 2','alacarte')
            ),
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text','alacarte'),
                'param_name' => 'heading2_text',
                'value'      => '',
                'std'        => '',
                'dependency' => array(
                    'element' => 'show_heading2',
                    'value'   => array('1')
                ),
                'holder'     => 'h4',
                'group'      => esc_html__('Heading 2','alacarte')
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Font Size','alacarte'),
                'description'=> esc_html__('Enter the number only','alacarte'),
                'param_name' => 'heading2_size',
                'group'      => esc_html__('Heading 2','alacarte'),
                'dependency' => array(
                    'element' => 'heading2_tag',
                    'value'   => array('custom')
                ),
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Font Style','alacarte'),
                'param_name' => 'heading2_style',
                'value'      => alacarte_heading_font_weight(),
                'std'        => '',
                'group'      => esc_html__('Heading 2','alacarte'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'show_heading2',
                    'value'   => array('1')
                ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Text Transform','alacarte'),
                'param_name' => 'heading2_text_transform',
                'value'      => alacarte_heading_text_transform(),
                'std'        => '',
                'group'      => esc_html__('Heading 2','alacarte'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'show_heading2',
                    'value'   => array('1')
                ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Font Color','alacarte'),
                'param_name' => 'heading2_font_color',
                'value'      => alacarte_theme_colors(true, true),
                'std'        => 'custom',
                'group'      => esc_html__('Heading 2','alacarte'),
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Custom Font Color','alacarte'),
                'param_name' => 'heading2_color',
                'value'      => '',
                'dependency' => array(
                    'element' => 'heading2_font_color',
                    'value'   => array('custom')
                ),
                'group'      => esc_html__('Heading 2','alacarte'),
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Line Height','alacarte'),
                'description'=> esc_html__('Enter the number only. Example: 1.2','alacarte'),
                'param_name' => 'heading2_line_height',
                'group'      => esc_html__('Heading 2','alacarte'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'show_heading2',
                    'value'   => array('1')
                ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Letter Spacing','alacarte'),
                'description'=> esc_html__('Enter the number only','alacarte'),
                'param_name' => 'heading2_letter_spacing',
                'group'      => esc_html__('Heading 2','alacarte'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'show_heading2',
                    'value'   => array('1')
                ),
            ),

            // Description 
            array(
                'type'       => 'textarea',
                'heading'    => esc_html__('Text','alacarte'),
                'param_name' => 'desc_text',
                'value'      => 'This is AlaCarte custom description. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse et justo.',
                'holder'     => 'div',
                'group'      => esc_html__('Description','alacarte'),
                /*'dependency' => array(
                    'element' => 'layout_template',
                    'value'   => array('1','2','3','4','5','6','7')
                ),*/
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Font Size','alacarte'),
                'description'=> esc_html__('Enter the number only','alacarte'),
                'param_name' => 'desc_size',
                'group'      => esc_html__('Description','alacarte'),
                'dependency' => array(
                    'element' => 'desc_tag',
                    'value'   => array('custom')
                ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element'   => 'desc_text',
                    'not_empty' => true
                ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Font Style','alacarte'),
                'param_name' => 'desc_style',
                'value'      => alacarte_heading_font_weight(),
                'std'        => '',
                'group'      => esc_html__('Description','alacarte'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element'   => 'desc_text',
                    'not_empty' => true
                ),
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Text Transform','alacarte'),
                'param_name' => 'desc_text_transform',
                'value'      => alacarte_heading_text_transform(),
                'std'        => '',
                'group'      => esc_html__('Description','alacarte'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element'   => 'desc_text',
                    'not_empty' => true
                ),
            ),
            array(
                'type'       => 'colorpicker',
                'heading'    => esc_html__('Font Color','alacarte'),
                'param_name' => 'desc_color',
                'value'      => '',
                'group'      => esc_html__('Description','alacarte'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element'   => 'desc_text',
                    'not_empty' => true
                ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Letter Spacing','alacarte'),
                'description'=> esc_html__('Enter the number only','alacarte'),
                'param_name' => 'desc_letter_spacing',
                'group'      => esc_html__('Description','alacarte'),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element'   => 'desc_text',
                    'not_empty' => true
                ),
            ),
        )
    )
));
class WPBakeryShortCode_red_heading extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
    }
}