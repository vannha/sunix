<?php
vc_map(array(
    'name'          => 'AlaCarte Posts List',
    'base'          => 'red_posts_list',
    'category'      => esc_html__('RedExp', 'alacarte'),
    'description'   => esc_html__('Display your posts with list layout', 'alacarte'),
    'icon'          => 'icon-wpb-toggle-small-expand',
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
                'admin_label' => true
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
                'std'           => '3',
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
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','alacarte'),
                'param_name' => 'layout_template',
                'value' =>  array(
                    '1' => get_template_directory_uri().'/vc_extends/layouts/post_list/post-list1.jpg',
                    '2' => get_template_directory_uri().'/vc_extends/layouts/post_list/post-list2.jpg',
                    '3' => get_template_directory_uri().'/vc_extends/layouts/post_list/post-list3.jpg',

                ),
                'std'   => '1',
                'group' => esc_html__('Layouts','alacarte'),
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_pagination',
                'value'         => array(
                    esc_html__( 'Show pagination', 'alacarte' ) => '1'
                ),
                'std'           => '1',
                'group' => esc_html__('Layouts','alacarte'),
            ),
        ),

        array(
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Heading Size','alacarte'),
                'param_name' => 'heading_size',
                'value' =>  array(
                    'H2' => 'h2',
                    'H3' => 'h3',
                    'H4' => 'h4',
                    'H5' => 'h5',
                ),
                'std'   => 'h3',
                'group' => esc_html__('Post Meta','alacarte'),
            ),
            
            array(
                'type'          => 'textfield',
                'param_name'    => 'thumbnail_size',
                'heading'       => esc_html__('Thumbnail Size','alacarte'),
                'description'   => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','alacarte'),
                'value'         => 'large',
                'std'           => 'large',
                'group'         => esc_html__('Post Meta','alacarte'),
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_excerpt',
                'value'         => array(
                    esc_html__( 'Show post excerpt', 'alacarte' ) => '1'
                ),
                'std'           => '1',
                'group'         => esc_html__('Post Meta','alacarte')
            ),
            array(
                'type'          => 'textfield',
                'param_name'    => 'excerpt_length',
                'heading'       => esc_html__('Enter the number of word you want to show','alacarte'),
                'description'   => esc_html__('Leave blank to use default from our theme','alacarte'),
                'std'           => '15',
                'dependency'  => array(
                    'element' => 'show_excerpt',
                    'value'   => array('1')
                ),
                'group'         => esc_html__('Post Meta','alacarte')
            ),

            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_date',
                'value'         => array(
                    esc_html__( 'Show post date', 'alacarte' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','alacarte')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_author',
                'value'         => array(
                    esc_html__( 'Show post author', 'alacarte' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','alacarte')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_cat',
                'value'         => array(
                    esc_html__( 'Show post categories', 'alacarte' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','alacarte')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_cmt',
                'value'         => array(
                    esc_html__( 'Show comment count', 'alacarte' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','alacarte')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_view',
                'value'         => array(
                    esc_html__( 'Show view count', 'alacarte' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','alacarte')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_like',
                'value'         => array(
                    esc_html__( 'Show like count', 'alacarte' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','alacarte')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_tag',
                'value'         => array(
                    esc_html__( 'Show post tag', 'alacarte' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','alacarte')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_share',
                'value'         => array(
                    esc_html__( 'Show share', 'alacarte' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','alacarte')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_readmore',
                'value'         => array(
                    esc_html__( 'Show readmore button', 'alacarte' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','alacarte')
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Readmore Style','alacarte'),
                'param_name' => 'readmore_style',
                'value'      =>  array(
                    esc_html__('Default','alacarte')     => '',
                    esc_html__('Default Button','alacarte') => 'btn',
                    esc_html__('Primary Button','alacarte') => 'btn-pri'
                ),
                'std'         => 'btn-pri',
                'dependency'  => array(
                    'element'            => 'show_readmore',
                    'value' => array('1')
                ),
                'group'      => esc_html__('Post Meta','alacarte'),
            )
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

class WPBakeryShortCode_red_posts_list extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        return parent::content($atts, $content);
    }
}
