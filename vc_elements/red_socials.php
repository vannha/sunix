<?php
vc_map(array(
    'name'        => 'Red Socials',
    'base'        => 'red_socials',
    'icon'         => 'red_el_icon',
    'category'      => esc_html__('RedExp', 'alacarte'),
    'description' => esc_html__('Add text with icon', 'alacarte'),
    'params'      => array(
        array(
            'type'       => 'dropdown',
            'param_name' => 'source',
            'heading'    => esc_html__( 'Source', 'alacarte' ),
            'value'      => array(
                esc_html__( 'Custom', 'alacarte' ) => 'custom',
            ),
            'std' => 'custom',
            'description' => esc_html__( 'Choose what social source display.', 'alacarte' ),
            'admin_label' => true,
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'el_mode',
            'heading'    => esc_html__( 'Layout Mode', 'alacarte' ),
            'value'      => array(
                esc_html__( 'Default', 'alacarte' ) => '',
            ),
            'std' => '',
            'admin_label' => true,
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'color_mode',
            'heading'    => esc_html__( 'Color Mode', 'alacarte' ),
            'value'      => array_merge(
                array(
                    esc_html__( 'Default', 'alacarte' ) => ''
                ),
                alacarte_theme_colors(),
                array(
                    esc_html__( 'Colored', 'alacarte' ) => 'colored',
                    esc_html__( 'Colored on Hover', 'alacarte' ) => 'colored-hover',
                    esc_html__( 'Custom', 'alacarte' )  => 'custom'
                )
            ),
            'std' => '',
            'admin_label' => true,
        ),
        array(
            'type'       => 'colorpicker',
            'param_name' => 'custom_color',
            'heading'    => esc_html__( 'Custom Color', 'alacarte' ),
            'value'      => '',
            'dependency'    => array(
                'element'   => 'color_mode',
                'value'     => array('custom')
            ),
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'fill_mode',
            'heading'    => esc_html__( 'Fill Mode', 'alacarte' ),
            'value'      => array(
                esc_html__( 'Default', 'alacarte' ) => '',
                esc_html__( 'Fill', 'alacarte' )    => 'fill',
                esc_html__( 'Outline', 'alacarte' ) => 'outline',
            ),
            'std' => '',
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'shape_mode',
            'heading'    => esc_html__( 'Shape', 'alacarte' ),
            'value'      => array(
                esc_html__( 'Default', 'alacarte' )         => '',
                esc_html__( 'Square', 'alacarte' )          => 'square',
                esc_html__( 'Rounded', 'alacarte' )         => 'rounded',
                esc_html__( 'Circle', 'alacarte' )          => 'circle',
            ),
            'std' => '',
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'el_icon_size',
            'heading'    => esc_html__( 'Icon Size', 'alacarte' ),
            'value'      => array(
                esc_html__( 'Default', 'alacarte' ) => '',
                esc_html__( 'Small', 'alacarte' )   => '20',
                esc_html__( 'Medium', 'alacarte' )  => '28',
                esc_html__( 'Large', 'alacarte' )   => '40',
            ),
            'std' => '30',
            'admin_label' => true,
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'el_content_align',
            'heading'    => esc_html__( 'Content Align', 'alacarte' ),
            'value'      => array(
                esc_html__( 'Default', 'alacarte' ) => '',
                esc_html__( 'Left', 'alacarte' )    => 'text-left',
                esc_html__( 'Right', 'alacarte' )   => 'text-right',
                esc_html__( 'Center', 'alacarte' )  => 'text-center',
            ),
            'std' => '',
        ),
        array(
            'type'       => 'param_group',
            'heading'    => esc_html__( 'Add your icons', 'alacarte' ),
            'param_name' => 'values',
            'group'      => esc_html__('Items','alacarte'),
            'dependency' => array(
                'element' => 'source',
                'value'   => 'custom',
            ),
            'value' => urlencode( json_encode( array(
                array(
                    'i_type'             => 'fontawesome',
                    'i_icon_fontawesome' => 'fa fa-facebook',
                    'icon_link'          => 'title:Facebook||url:facebook.com'
                ),
                array(
                    'i_type'             => 'fontawesome',
                    'i_icon_fontawesome' => 'fa fa-twitter',
                    'icon_link'          => 'title:Twitter||url:twitter.com'
                ),
                array(
                    'i_type'             => 'fontawesome',
                    'i_icon_fontawesome' => 'fa fa-google-plus',
                    'icon_link'          => 'title:Google Plus||url:plus.google.com'
                ),
                array(
                    'i_type'             => 'fontawesome',
                    'i_icon_fontawesome' => 'fa fa-linkedin',
                    'icon_link'          => 'title:LinkedIn||url:linkedin.com'
                ),
            ) ) ),
            'params'     => array_merge(
                alacarte_icon_libs(),
                alacarte_icon_libs_icon(),
                array(
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Icon Link', 'alacarte' ),
                        'param_name' => 'icon_link',
                        'admin_label'=> true,
                    ),
                )
            ),
        ),
    )
));

class WPBakeryShortCode_red_socials extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}