<?php
vc_map(array(
    'name'          => 'AlaCarte Button',
    'base'          => 'red_button',
    'category'      => esc_html__('RedExp', 'alacarte'),
    'description'   => esc_html__('Red button style', 'alacarte'),
    'icon'         => 'icon-wpb-ui-button',
    'params'        => array_merge(
        array(
            array(
                'type'          => 'textfield',
                'param_name'    => 'btn_text',
                'heading'       => esc_html__( 'Button Text', 'alacarte' ),
                'value'         => 'Button',
                'std'           => 'Button',
                'admin_label'   => true
            ),
            array(
                'type'          => 'vc_link',
                'heading'       => esc_html__('Button link','alacarte'),
                'param_name'    => 'button_link',
                'value'         => '',
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_display',
                'heading'       => esc_html__( 'Button Display', 'alacarte' ),
                'value'         => array(
                    esc_html__( 'List', 'alacarte' )  => 'list',
                    esc_html__( 'Block', 'alacarte' ) => 'block',
                ),
                'std'           => 'block',
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_align',
                'heading'       => esc_html__( 'Button Alignment', 'alacarte' ),
                'value'         => array(
                    esc_html__( 'Default', 'alacarte' ) => '',
                    esc_html__( 'Start', 'alacarte' )   => 'start',
                    esc_html__( 'End', 'alacarte' )     => 'end',
                    esc_html__( 'Center', 'alacarte' )  => 'center',
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
                'heading'       => esc_html__( 'Button Style', 'alacarte' ),
                'value'         => alacarte_button_style(),
                'std'           => 'fill',
                'admin_label'   => true,
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_color',
                'heading'       => esc_html__( 'Button Color', 'alacarte' ),
                'value'         => alacarte_button_colors(),
                'std'           => 'primary',
                'admin_label'   => true,
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'colorpicker',
                'param_name'    => 'btn_custom_bg_color',
                'heading'       => esc_html__( 'Background/Border Color', 'alacarte' ),
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
                'heading'       => esc_html__( 'Text Color', 'alacarte' ),
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
                'heading'       => esc_html__( 'Button Shape', 'alacarte' ),
                'value'         => alacarte_button_shapes(),
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
                'heading'       => esc_html__( 'Button Size', 'alacarte' ),
                'value'         => alacarte_button_size(),
                'std'           => 'df',
                'edit_field_class' => 'vc_col-sm-6'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_underline',
                'heading'       => esc_html__( 'Add Underline', 'alacarte' ),
                'value'         => array(
                    esc_html__( 'None', 'alacarte' )      => '',
                    esc_html__( 'Default', 'alacarte' )   => 'underline-default',
                    esc_html__( 'Primary', 'alacarte' )   => 'underline-primary',
                    esc_html__( 'Accent', 'alacarte' )    => 'underline-accent',
                    esc_html__( 'Secondary', 'alacarte' ) => 'underline-secondary',
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
                'heading'       => esc_html__( 'Hover Style', 'alacarte' ),
                'value'         => array(
                    esc_html__('Default', 'alacarte') => '',
                    esc_html__('Slide', 'alacarte')   => 'red-btn-slide',
                    //esc_html__('3D', 'alacarte')      => 'red-btn-3d',
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
                'heading'       => esc_html__( 'Add Icon?', 'alacarte' ),
                'std'           => false,
                'group'         => esc_html__('Icon','alacarte')
            ),
        ),
        alacarte_icon_libs(),
        alacarte_icon_libs_icon(),
        array(
            array(
                'type'          => 'dropdown',
                'param_name'    => 'icon_position',
                'heading'       => esc_html__( 'Icon Position', 'alacarte' ),
                'value'         => array(
                    esc_html__( 'Left', 'alacarte' )     => 'icon-left',
                    esc_html__( 'Right', 'alacarte' )    => 'icon-right',
                ),
                'std'           => 'icon-right',
                'dependency'    => array(
                    'element'   => 'add_icon',
                    'value'     => 'true',
                ),
                'group'         => esc_html__('Icon','alacarte'),
                'edit_field_class' => 'vc_col-sm-4'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_icon_style',
                'heading'       => esc_html__( 'Icon Style', 'alacarte' ),
                'value'         => array(
                    esc_html__( 'Default', 'alacarte' ) => '',
                ),
                'std'           => '',
                'dependency'    => array(
                    'element'   => 'add_icon',
                    'value'     => 'true',
                ),
                'group'         => esc_html__('Icon','alacarte'),
                'edit_field_class' => 'vc_col-sm-4'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_icon_color',
                'heading'       => esc_html__( 'Icon Color', 'alacarte' ),
                'value'         => array(
                    esc_html__( 'Default', 'alacarte' )   => '',
                    esc_html__( 'Primary', 'alacarte' )   => 'primary',
                    esc_html__( 'Accent', 'alacarte' )    => 'accent',
                    esc_html__( 'Secondary', 'alacarte' ) => 'secondary',
                ),
                'std'           => '',
                'dependency'    => array(
                    'element'   => 'add_icon',
                    'value'     => 'true',
                ),
                'group'         => esc_html__('Icon','alacarte'),
                'edit_field_class' => 'vc_col-sm-4'
            ),
            array(
                'type'          => 'dropdown',
                'param_name'    => 'btn_icon_animation',
                'heading'       => esc_html__( 'Icon Animation', 'alacarte' ),
                'value'         => array(
                    esc_html__( 'None', 'alacarte' )        => '',
                    esc_html__( 'Default', 'alacarte' )     => 'anim-default'
                ),
                'std'           => '',
                'dependency'    => array(
                    'element'   => 'add_icon',
                    'value'     => 'true',
                ),
                'group'         => esc_html__('Icon','alacarte'),
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