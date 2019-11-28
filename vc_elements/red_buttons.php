<?php
vc_map(array(
    'name'          => 'sunix Button',
    'base'          => 'red_button',
    'category'      => esc_html__('RedExp', 'sunix'),
    'description'   => esc_html__('Red button style', 'sunix'),
    'icon'         => 'icon-wpb-ui-button',
    'params'        => array_merge(
        array(
            array(
                'type'          => 'textfield',
                'param_name'    => 'btn_text',
                'heading'       => esc_html__( 'Button Text', 'sunix' ),
                'value'         => 'Button',
                'std'           => 'Button',
                'admin_label'   => true
            ),
            array(
                'type'          => 'vc_link',
                'heading'       => esc_html__('Button link','sunix'),
                'param_name'    => 'button_link',
                'value'         => '',
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_display',
                'heading'       => esc_html__( 'Button Display', 'sunix' ),
                'value'         => array(
                    esc_html__( 'List', 'sunix' )  => 'list',
                    esc_html__( 'Block', 'sunix' ) => 'block',
                ),
                'std'           => 'block',
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_align',
                'heading'       => esc_html__( 'Button Alignment', 'sunix' ),
                'value'         => array(
                    esc_html__( 'Default', 'sunix' ) => '',
                    esc_html__( 'Start', 'sunix' )   => 'start',
                    esc_html__( 'End', 'sunix' )     => 'end',
                    esc_html__( 'Center', 'sunix' )  => 'center',
                ),
                'std'           => '',
                'dependency'    => array(
                    'element'   => 'btn_display',
                    'value'     => 'block',
                ),
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_style',
                'heading'       => esc_html__( 'Button Style', 'sunix' ),
                'value'         => sunix_button_style(),
                'std'           => 'fill',
                'admin_label'   => true,
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_color',
                'heading'       => esc_html__( 'Button Color', 'sunix' ),
                'value'         => sunix_button_colors(),
                'std'           => 'primary',
                'admin_label'   => true,
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'colorpicker',
                'param_name'    => 'btn_custom_bg_color',
                'heading'       => esc_html__( 'Background/Border Color', 'sunix' ),
                'value'         => '',
                'std'           => '',
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'    => array(
                    'element'   => 'btn_color',
                    'value'     => 'custom',
                ),
            ),
            array(
                'type'          => 'colorpicker',
                'param_name'    => 'btn_custom_text_color',
                'heading'       => esc_html__( 'Text Color', 'sunix' ),
                'value'         => '',
                'std'           => '',
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'    => array(
                    'element'   => 'btn_color',
                    'value'     => 'custom',
                ),
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_shape',
                'heading'       => esc_html__( 'Button Shape', 'sunix' ),
                'value'         => sunix_button_shapes(),
                'std'           => '',
                'admin_label'   => true,
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'    => array(
                    'element'            => 'btn_style',
                    'value_not_equal_to' => 'simple',
                ),
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_size',
                'heading'       => esc_html__( 'Button Size', 'sunix' ),
                'value'         => sunix_button_size(),
                'std'           => 'df',
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_underline',
                'heading'       => esc_html__( 'Add Underline', 'sunix' ),
                'value'         => array(
                    esc_html__( 'None', 'sunix' )      => '',
                    esc_html__( 'Default', 'sunix' )   => 'underline-default',
                    esc_html__( 'Primary', 'sunix' )   => 'underline-primary',
                    esc_html__( 'Accent', 'sunix' )    => 'underline-accent',
                    esc_html__( 'Secondary', 'sunix' ) => 'underline-secondary',
                ),
                'std'           => '',
                'dependency'    => array(
                    'element'   => 'btn_style',
                    'value'     => 'simple',
                ),
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_hover_style',
                'heading'       => esc_html__( 'Hover Style', 'sunix' ),
                'value'         => array(
                    esc_html__('Default', 'sunix') => '',
                    esc_html__('Slide', 'sunix')   => 'red-btn-slide',
                    //esc_html__('3D', 'sunix')      => 'red-btn-3d',
                ),
                'std'              => '',
                'edit_field_class' => 'vc_col-sm-6',
                'dependency'       => array(
                    'element'            => 'btn_style',
                    'value_not_equal_to' => 'simple',
                ),
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'add_icon',
                'heading'       => esc_html__( 'Add Icon?', 'sunix' ),
                'std'           => false,
                'group'         => esc_html__('Icon','sunix')
            ),
        ),
        sunix_icon_libs(),
        sunix_icon_libs_icon(),
        array(
            array(
                'type'          => 'dropdown',
                'param_name'    => 'icon_position',
                'heading'       => esc_html__( 'Icon Position', 'sunix' ),
                'value'         => array(
                    esc_html__( 'Left', 'sunix' )     => 'icon-left',
                    esc_html__( 'Right', 'sunix' )    => 'icon-right',
                ),
                'std'           => 'icon-right',
                'dependency'    => array(
                    'element'   => 'add_icon',
                    'value'     => 'true',
                ),
                'group'         => esc_html__('Icon','sunix'),
                'edit_field_class' => 'vc_col-sm-4'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_icon_style',
                'heading'       => esc_html__( 'Icon Style', 'sunix' ),
                'value'         => array(
                    esc_html__( 'Default', 'sunix' ) => '',
                ),
                'std'           => '',
                'dependency'    => array(
                    'element'   => 'add_icon',
                    'value'     => 'true',
                ),
                'group'         => esc_html__('Icon','sunix'),
                'edit_field_class' => 'vc_col-sm-4'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_icon_color',
                'heading'       => esc_html__( 'Icon Color', 'sunix' ),
                'value'         => array(
                    esc_html__( 'Default', 'sunix' )   => '',
                    esc_html__( 'Primary', 'sunix' )   => 'primary',
                    esc_html__( 'Accent', 'sunix' )    => 'accent',
                    esc_html__( 'Secondary', 'sunix' ) => 'secondary',
                ),
                'std'           => '',
                'dependency'    => array(
                    'element'   => 'add_icon',
                    'value'     => 'true',
                ),
                'group'         => esc_html__('Icon','sunix'),
                'edit_field_class' => 'vc_col-sm-4'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_icon_animation',
                'heading'       => esc_html__( 'Icon Animation', 'sunix' ),
                'value'         => array(
                    esc_html__( 'None', 'sunix' )        => '',
                    esc_html__( 'Default', 'sunix' )     => 'anim-default'
                ),
                'std'           => '',
                'dependency'    => array(
                    'element'   => 'add_icon',
                    'value'     => 'true',
                ),
                'group'         => esc_html__('Icon','sunix'),
                'edit_field_class' => 'vc_col-sm-6'
            ),
        )
    )
));

class WPBakeryShortCode_red_button extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}