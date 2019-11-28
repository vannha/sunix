<?php
if(!class_exists('Newsletter')) return;
vc_map(array(
	'name'        => 'sunix Newsletter',
	'base'        => 'red_newsletter',
	'icon'        => 'red-icon-newsletter',
	'category'    => esc_html__('RedExp', 'sunix'),
	'description' => esc_html__('Add Newsletter Form.', 'sunix'),
	'params'      => array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Layout Mode', 'sunix' ),
			'description' => esc_html__( 'Choose Layout mode you want to show', 'sunix' ),
			'param_name'  => 'layout_mode',
			'value'       => array(
				esc_html__('Newsletter','sunix')      	=> 'default',
				esc_html__('Newsletter Minimal','sunix') 	=> 'minimal',
			),
			'std'		  => 'minimal',
			'admin_label' => true,
    	),
    	array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Show lists as', 'sunix' ),
			'param_name'  => 'lists_layout',
			'value'       => array(
				esc_html__('Checkbox','sunix') => '',
				esc_html__('Dropdown','sunix') => 'dropdown'
			),
			'std'		  	=> '',
			'dependency'    => array(
				'element'   => 'layout_mode',
				'value'     => 'default',
			),
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'First dropdown entry label', 'sunix' ),
			'param_name'  => 'lists_empty_label',
			'value'		  => '',
			'dependency'    => array(
				'element'   => 'lists_layout',
				'value'     => 'dropdown',
			),
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Lists field label', 'sunix' ),
			'description' => esc_html__( 'Seperate by comma (,)', 'sunix' ),
			'value'		  => '',		
			'param_name'  => 'lists_field_label',
			'dependency'    => array(
				'element'   => 'layout_mode',
				'value'     => 'default',
			),
    	),
    	array(
            'type'       => 'img',
            'heading'    => esc_html__('Layout Template','sunix'),
            'param_name' => 'layout_template',
            'value'      =>  array(
                '1' => get_template_directory_uri().'/vc_extends/layouts/newsletter/layout-1.jpg',
                '2' => get_template_directory_uri().'/vc_extends/layouts/newsletter2.png',
                '3' => get_template_directory_uri().'/vc_extends/layouts/newsletter3.png',
                '4' => get_template_directory_uri().'/vc_extends/layouts/newsletter4.png',
                '5' => get_template_directory_uri().'/vc_extends/layouts/newsletter5.png',
                '6' => get_template_directory_uri().'/vc_extends/layouts/newsletter6.png',
            ),
            'std'        => '1',
            'admin_label'=> true
        ),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Button Text', 'sunix' ),
			'description' => esc_html__( 'Enter button text', 'sunix' ),
			'param_name'  => 'btn_text',
			'value'       => '',
			'std'		  => 'Subscribe',
			'dependency'    => array(
				'element'   => 'layout_mode',
				'value'     => 'minimal',
			),
    	),
    	array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra Class', 'sunix' ),
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'sunix' ),
			'param_name'  => 'el_class',
			'value'       => '',
			'std'		  => '',
			'admin_label' => true,
    	),
    ) 
));

class WPBakeryShortCode_red_newsletter extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
    }
}