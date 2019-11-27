<?php
vc_map(array(
    'name'          => 'Red Posts Carousel',
    'base'          => 'red_posts_carousel',
    'category'      => esc_html__('RedExp', 'alacarte'),
    'description'   => esc_html__('Display your posts with carousel layout', 'alacarte'),
    'icon'         => 'icon-wpb-application-icon-large',
    'params'        => array_merge(
        array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Data source', 'alacarte' ),
                'param_name'  => 'post_type',
                'value'       => alacarte_vc_post_type_list(),
                'std'         => 'post',
                'description' => esc_html__( 'Select content type for your grid.', 'alacarte' ),
                'admin_label' => true,
            ),
            array(
                'type'       => 'autocomplete',
                'heading'    => esc_html__( 'Narrow data source', 'alacarte' ),
                'param_name' => 'taxonomies',
                'settings'   => array(
                    'multiple'       => true,
                    'min_length'     => 1,
                    'groups'         => true,
                    'unique_values'  => true,
                    'display_inline' => true,
                    'delay'          => 500,
                    'auto_focus'     => true,
                    'values'         => alacarte_taxonomies_for_autocomplete(),
                ),
                'description' => esc_html__( 'Enter categories.', 'alacarte' ),
                'admin_label' => true,
            ),
            array(
                'type'       => 'autocomplete',
                'heading'    => esc_html__( 'Exclude from Content and filter list', 'alacarte' ),
                'param_name' => 'taxonomies_exclude',
                'settings'   => array(
                    'multiple'       => true,
                    'min_length'     => 1,
                    'groups'         => true,
                    'unique_values'  => true,
                    'display_inline' => true,
                    'delay'          => 500,
                    'auto_focus'     => true,
                    'values'         => alacarte_taxonomies_for_autocomplete(),
                ),
                'description' => esc_html__( 'Enter categories won\'t be shown in the content and filters list', 'alacarte' ),
                'admin_label' => true
            ),
            array(
                'type'          => 'textfield',
                'param_name'    => 'posts_per_page',
                'heading'       => esc_html__( 'Number of posts', 'alacarte' ),
                'description'   => esc_html__( 'number of post to show per page', 'alacarte' ),
                'std'           => '8',
            ),
            vc_map_add_css_animation(),
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
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','alacarte'),
                'param_name' => 'layout_template',
                'value' =>  array(
                    '1' => get_template_directory_uri().'/vc_extends/layouts/post_carousel/layout-1.jpg',
                    '2' => get_template_directory_uri().'/vc_extends/layouts/post_carousel/layout-2.jpg',
                    '3' => get_template_directory_uri().'/vc_extends/layouts/post_carousel/layout-3.jpg',
                    '4' => get_template_directory_uri().'/vc_extends/layouts/post_carousel/layout-4.jpg',

                ),
                'std'   => '1',
                'group' => esc_html__('Layouts','alacarte'),
            ),
        ),
        array(
            array(
                'param_name'  => 'grid_settings',
                'type'        => 'custom_markup',
                'value'       => '<strong>'.esc_html__('Carousel Settings','alacarte').'</strong>',
                'std'         => '<strong>'.esc_html__('Carousel Settings','alacarte').'</strong>',
                'group'       => esc_html__('Layouts','alacarte'),
            )
        ),
        /* Grid settings */
        alacarte_owl_settings(array(
            'group'      => esc_html__('Layouts','alacarte'),
            'param_name' => 'layout_type', 
            'value'      => 'carousel'
        )),
        array(
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Heading Tag','alacarte'),
                'param_name' => 'heading_tag',
                'value'      =>  array_merge(
                    array(
                        esc_html__('Default','alacarte') => ''
                    ),
                    alacarte_heading_tag(['H4+' => 'h4-1'])
                ),
                'std'        => '',
                'group'      => esc_html__('Post Meta','alacarte'),
            ),
            array(
                'type'          => 'textfield',
                'param_name'    => 'thumbnail_size',
                'heading'       => esc_html__('Thumbnail Size (Leave blank to use default size)','alacarte'),
                'description'   => esc_html__('Enter our defined size: "thumbnail", "medium", "large", "post-thumbnail", "full". Or alternatively enter size in pixels (Example: 200x100 (Width x Height)).','alacarte'),
                'std'           => '',
                'group'         => esc_html__('Post Meta','alacarte'),
            ),
            array(
                'type'       => 'dropdown',
                'param_name' => 'show_view_all',
                'value'      => array(
                    esc_html__('None','alacarte')          => 'none',
                    esc_html__('Select a Page','alacarte') => 'page'
                ),
                'std'        => 'none',
                'heading'    => esc_html__('Show View All','alacarte'),
                'group'      => esc_html__('Post Meta','alacarte'),
            ),
            array(
                'type'       => 'dropdown',
                'param_name' => 'show_view_all_page',
                'value'      => alacarte_vc_list_page(['default' => false]),
                'std'        => '',
                'dependency'    => array(
                    'element'   => 'show_view_all',
                    'value'     => 'page',
                ),
                'heading'    => esc_html__('Choose a Page for view all!','alacarte'),
                'group'      => esc_html__('Post Meta','alacarte'),
            ),
            array(
                'type'       => 'textfield',
                'param_name' => 'show_view_all_text',
                'value'      => 'View All',
                'std'        => 'View All',
                'dependency'    => array(
                    'element'            => 'show_view_all',
                    'value_not_equal_to' => 'none',
                ),
                'heading'    => esc_html__('View All Text','alacarte'),
                'group'      => esc_html__('Post Meta','alacarte'),
            ),
        ),
        array(
            array(
                'type'       => 'css_editor',
                'heading'    => '',
                'param_name' => 'css',
                'value'      => '',
                'group'      => esc_html__('Design Options','alacarte'),
            )
        )
    )
));

class WPBakeryShortCode_red_posts_carousel extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        $atts['layout_style'] = 'carousel';
        alacarte_owl_call_settings($atts);
        return parent::content($atts, $content);
    }
}
