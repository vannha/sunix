<?php
$custom_menus = array();
if ( 'vc_edit_form' === vc_post_param( 'action' ) && vc_verify_admin_nonce() ) {
    $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
    if ( is_array( $menus ) && ! empty( $menus ) ) {
        foreach ( $menus as $single_menu ) {
            if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
                $custom_menus[ $single_menu->name ] = $single_menu->slug;
            }
        }
    }
}
vc_map(array(
    'name'        => 'AlaCarte Custom Menu',
    'base'        => 'red_wp_menu',
    'category'    => esc_html__('RedExp', 'alacarte'),
    'description' => esc_html__('Use this element to add one of your custom menus', 'alacarte'),
    'icon'        => 'icon-wpb-wp',
    'params'      => array_merge(
    	array(
	        array(
			    'type'        => 'dropdown',
			    'heading'     => esc_html__( 'Menu', 'alacarte' ),
			    'param_name'  => 'nav_menu',
			    'value'       => $custom_menus,
			    'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'alacarte' ) : esc_html__( 'Select menu to display.', 'alacarte' ),
			    'admin_label' => true,
			    'save_always' => true,
			),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Title','alacarte'),
                'description'   => esc_html__('What text use as a title. Leave blank to use menu title created in Menu Manager','alacarte'),
                'param_name'    => 'title',
                'value'         => '',
                'std'           => '',
            ),
            array(
                'type'       => 'checkbox',
                'param_name' => 'show_title_on_desktop',
                'value'      => array(
                    esc_html__('Show Title On Large Screen?','alacarte') => '1'
                ),
                'std'        => '1',
                'description'=> esc_html__('The title will always show on small srceen! This option to make sure you want to show title on large screen or not?','alacarte'),
            ),
			array(
				'type'        => 'el_id',
				'heading'     => esc_html__( 'Element ID', 'alacarte' ),
				'param_name'  => 'el_id',
				'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'alacarte' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'alacarte' ),
				'param_name'  => 'el_class',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'alacarte' ),
			),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Layout Mode','alacarte'),
                'param_name' => 'layout_mode',
                'value'      =>  array(
                    esc_html__('Vertical','alacarte')   => 'vertical',
                    esc_html__('Vertical (2 Columns)','alacarte')   => 'vertical two-col',
                    esc_html__('Horizontal','alacarte') => 'horizontal',
                    esc_html__('Horizontal and Center','alacarte') => 'horizontal justify-content-center',
                ),
                'std'        => 'vertical',
                'admin_label' => true,
                'group' => esc_html__('Layout','alacarte')
            ),
            array(
                'type'       => 'checkbox',
                'param_name' => 'add_divider',
                'value'      => array(
                    esc_html__('Add Divider','alacarte') => 'add-divider'
                ),
                'std'        => '',
                'group' => esc_html__('Layout','alacarte')
            ),
    	)
    )
));
class WPBakeryShortCode_red_wp_menu extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
    }
}