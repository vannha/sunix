<?php
vc_map(array(
    'name'        => 'Red Socials',
    'base'        => 'red_socials',
    'icon'         => 'red_el_icon',
    'category'      => esc_html__('RedExp', 'sunix'),
    'description' => esc_html__('Add text with icon', 'sunix'),
    'params'      => array(
        array(
            'type'       => 'dropdown',
            'param_name' => 'source',
            'heading'    => esc_html__( 'Source', 'sunix' ),
            'value'      => array(
                esc_html__( 'Custom', 'sunix' ) => 'custom',
            ),
            'std' => 'custom',
            'description' => esc_html__( 'Choose what social source display.', 'sunix' ),
            'admin_label' => true,
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'el_mode',
            'heading'    => esc_html__( 'Layout Mode', 'sunix' ),
            'value'      => array(
                esc_html__( 'Default', 'sunix' ) => '',
            ),
            'std' => '',
            'admin_label' => true,
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'color_mode',
            'heading'    => esc_html__( 'Color Mode', 'sunix' ),
            'value'      => array_merge(
                array(
                    esc_html__( 'Default', 'sunix' ) => ''
                ),
                sunix_theme_colors(),
                array(
                    esc_html__( 'Colored', 'sunix' ) => 'colored',
                    esc_html__( 'Colored on Hover', 'sunix' ) => 'colored-hover',
                    esc_html__( 'Custom', 'sunix' )  => 'custom'
                )
            ),
            'std' => '',
            'admin_label' => true,
        ),
        array(
            'type'       => 'colorpicker',
            'param_name' => 'custom_color',
            'heading'    => esc_html__( 'Custom Color', 'sunix' ),
            'value'      => '',
            'dependency'    => array(
                'element'   => 'color_mode',
                'value'     => array('custom')
            ),
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'fill_mode',
            'heading'    => esc_html__( 'Fill Mode', 'sunix' ),
            'value'      => array(
                esc_html__( 'Default', 'sunix' ) => '',
                esc_html__( 'Fill', 'sunix' )    => 'fill',
                esc_html__( 'Outline', 'sunix' ) => 'outline',
            ),
            'std' => '',
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'shape_mode',
            'heading'    => esc_html__( 'Shape', 'sunix' ),
            'value'      => array(
                esc_html__( 'Default', 'sunix' )         => '',
                esc_html__( 'Square', 'sunix' )          => 'square',
                esc_html__( 'Rounded', 'sunix' )         => 'rounded',
                esc_html__( 'Circle', 'sunix' )          => 'circle',
            ),
            'std' => '',
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'el_icon_size',
            'heading'    => esc_html__( 'Icon Size', 'sunix' ),
            'value'      => array(
                esc_html__( 'Default', 'sunix' ) => '',
                esc_html__( 'Small', 'sunix' )   => '20',
                esc_html__( 'Medium', 'sunix' )  => '28',
                esc_html__( 'Large', 'sunix' )   => '40',
            ),
            'std' => '30',
            'admin_label' => true,
        ),
        array(
            'type'       => 'dropdown',
            'param_name' => 'el_content_align',
            'heading'    => esc_html__( 'Content Align', 'sunix' ),
            'value'      => array(
                esc_html__( 'Default', 'sunix' ) => '',
                esc_html__( 'Left', 'sunix' )    => 'text-left',
                esc_html__( 'Right', 'sunix' )   => 'text-right',
                esc_html__( 'Center', 'sunix' )  => 'text-center',
            ),
            'std' => '',
        ),
        array(
            'type'       => 'param_group',
            'heading'    => esc_html__( 'Add your icons', 'sunix' ),
            'param_name' => 'values',
            'group'      => esc_html__('Items','sunix'),
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
                sunix_icon_libs(),
                sunix_icon_libs_icon(),
                array(
                    array(
                        'type'       => 'vc_link',
                        'heading'    => esc_html__( 'Icon Link', 'sunix' ),
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