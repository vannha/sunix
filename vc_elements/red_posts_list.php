<?php
vc_map(array(
    'name'          => 'sunix Posts List',
    'base'          => 'red_posts_list',
    'category'      => esc_html__('RedExp', 'sunix'),
    'description'   => esc_html__('Display your posts with list layout', 'sunix'),
    'icon'          => 'icon-wpb-toggle-small-expand',
    'params'        => array_merge(
        array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Data source', 'sunix' ),
                'param_name'  => 'post_type',
                'value'       => sunix_vc_post_type_list(),
                'std'         => 'post',
                'description' => esc_html__( 'Select content type for your grid.', 'sunix' ),
                'admin_label' => true,
            ),
            array(
                'type'       => 'autocomplete',
                'heading'    => esc_html__( 'Narrow data source', 'sunix' ),
                'param_name' => 'taxonomies',
                'settings'   => array(
                    'multiple'       => true,
                    'min_length'     => 1,
                    'groups'         => true,
                    'unique_values'  => true,
                    'display_inline' => true,
                    'delay'          => 500,
                    'auto_focus'     => true,
                    'values'         => sunix_taxonomies_for_autocomplete(),
                ),
                'description' => esc_html__( 'Enter categories.', 'sunix' ),
                'admin_label' => true
            ),
            array(
                'type'       => 'autocomplete',
                'heading'    => esc_html__( 'Exclude from Content and filter list', 'sunix' ),
                'param_name' => 'taxonomies_exclude',
                'settings'   => array(
                    'multiple'       => true,
                    'min_length'     => 1,
                    'groups'         => true,
                    'unique_values'  => true,
                    'display_inline' => true,
                    'delay'          => 500,
                    'auto_focus'     => true,
                    'values'         => sunix_taxonomies_for_autocomplete(),
                ),
                'description' => esc_html__( 'Enter categories won\'t be shown in the content and filters list', 'sunix' ),
                'admin_label' => true
            ),
            array(
                'type'          => 'textfield',
                'param_name'    => 'posts_per_page',
                'heading'       => esc_html__( 'Number of posts', 'sunix' ),
                'description'   => esc_html__( 'number of post to show per page', 'sunix' ),
                'std'           => '3',
            ),
            
            array(
                'type'        => 'el_id',
                'settings' => array(
                    'auto_generate' => true,
                ),
                'heading'     => esc_html__( 'Element ID', 'sunix' ),
                'param_name'  => 'el_id',
                'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'sunix' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
            ),
            array(
                'type'       => 'textfield',
                'heading'    => esc_html__('Extra Class','sunix'),
                'param_name' => 'el_class',
                'value'      => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'sunix'),
            ),
            array(
                'type'       => 'img',
                'heading'    => esc_html__('Layout Template','sunix'),
                'param_name' => 'layout_template',
                'value' =>  array(
                    '1' => get_template_directory_uri().'/vc_extends/layouts/post_list/post-list1.jpg',
                    '2' => get_template_directory_uri().'/vc_extends/layouts/post_list/post-list2.jpg',
                    '3' => get_template_directory_uri().'/vc_extends/layouts/post_list/post-list3.jpg',

                ),
                'std'   => '1',
                'group' => esc_html__('Layouts','sunix'),
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_pagination',
                'value'         => array(
                    esc_html__( 'Show pagination', 'sunix' ) => '1'
                ),
                'std'           => '1',
                'group' => esc_html__('Layouts','sunix'),
            ),
        ),

        array(
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Heading Size','sunix'),
                'param_name' => 'heading_size',
                'value' =>  array(
                    'H2' => 'h2',
                    'H3' => 'h3',
                    'H4' => 'h4',
                    'H5' => 'h5',
                ),
                'std'   => 'h3',
                'group' => esc_html__('Post Meta','sunix'),
            ),
            
            array(
                'type'          => 'textfield',
                'param_name'    => 'thumbnail_size',
                'heading'       => esc_html__('Thumbnail Size','sunix'),
                'description'   => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).','sunix'),
                'value'         => 'large',
                'std'           => 'large',
                'group'         => esc_html__('Post Meta','sunix'),
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_excerpt',
                'value'         => array(
                    esc_html__( 'Show post excerpt', 'sunix' ) => '1'
                ),
                'std'           => '1',
                'group'         => esc_html__('Post Meta','sunix')
            ),
            array(
                'type'          => 'textfield',
                'param_name'    => 'excerpt_length',
                'heading'       => esc_html__('Enter the number of word you want to show','sunix'),
                'description'   => esc_html__('Leave blank to use default from our theme','sunix'),
                'std'           => '15',
                'dependency'  => array(
                    'element' => 'show_excerpt',
                    'value'   => array('1')
                ),
                'group'         => esc_html__('Post Meta','sunix')
            ),

            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_date',
                'value'         => array(
                    esc_html__( 'Show post date', 'sunix' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','sunix')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_author',
                'value'         => array(
                    esc_html__( 'Show post author', 'sunix' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','sunix')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_cat',
                'value'         => array(
                    esc_html__( 'Show post categories', 'sunix' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','sunix')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_cmt',
                'value'         => array(
                    esc_html__( 'Show comment count', 'sunix' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','sunix')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_view',
                'value'         => array(
                    esc_html__( 'Show view count', 'sunix' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','sunix')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_like',
                'value'         => array(
                    esc_html__( 'Show like count', 'sunix' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','sunix')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_tag',
                'value'         => array(
                    esc_html__( 'Show post tag', 'sunix' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','sunix')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_share',
                'value'         => array(
                    esc_html__( 'Show share', 'sunix' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','sunix')
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_readmore',
                'value'         => array(
                    esc_html__( 'Show readmore button', 'sunix' ) => '1'
                ),
                'std'           => '',
                'group'         => esc_html__('Post Meta','sunix')
            ),
            array(
                'type'       => 'dropdown',
                'heading'    => esc_html__('Readmore Style','sunix'),
                'param_name' => 'readmore_style',
                'value'      =>  array(
                    esc_html__('Default','sunix')     => '',
                    esc_html__('Default Button','sunix') => 'btn',
                    esc_html__('Primary Button','sunix') => 'btn-pri'
                ),
                'std'         => 'btn-pri',
                'dependency'  => array(
                    'element'            => 'show_readmore',
                    'value' => array('1')
                ),
                'group'      => esc_html__('Post Meta','sunix'),
            )
        ),
        array(
            array(
                'type'       => 'css_editor',
                'heading'    => '',
                'param_name' => 'css',
                'value'      => '',
                'group'      => esc_html__('Design Options','sunix'),
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
