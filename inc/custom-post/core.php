<?php

/**
 * Add custom post type Header Top
 *
 * This custom post used for build Header Top section
 *
*/
add_filter('ef5_extra_post_types', 'sunix_cpts_header_top', 10 , 1);
function sunix_cpts_header_top($post_types)
{
    $header_top = apply_filters('sunix_cpts_header_top', false);
    if($header_top) {
        $post_types['ef5_header_top'] = array(
            'status'        => true,
            'name'          => esc_html__('Sunix Header Top', 'sunix'),
            'singular_name' => esc_html__('Sunix Headers Top', 'sunix'),
            'args'          => array(
                'description'         => 'Add custom Header Top Layout ',
                'public'              => true,
                'publicly_queryable'  => false,
                'show_ui'             => true,
                'show_in_rest'        => true,
                'rest_base'           => '',
                'has_archive'         => false,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => false,
                'exclude_from_search' => true,
                'capability_type'     => 'post',
                'map_meta_cap'        => true,
                'hierarchical'        => false,
                'rewrite'             => false,
                'query_var'           => true,
                'menu_position'       => 20,
                'menu_icon'           => 'dashicons-editor-insertmore',
                'supports'            => array( 'title', 'editor','thumbnail' ),
            ),
            
        );
    }
    return $post_types;
}


/**
 * Add custom post type Footer 
 * 
 * This custom post used for build Footer Top section
 *
 */
add_filter('ef5_extra_post_types', 'sunix_cpts_footer', 10 , 1);
function sunix_cpts_footer($post_types) {
    $enable_footer = apply_filters('sunix_cpts_footer', false);
    if($enable_footer) {
        $post_types['ef5_footer'] = array(
            'status'        => true,
            'name'          => esc_html__('Sunix Footer', 'sunix'),
            'singular_name' => esc_html__('Sunix Footers', 'sunix'),
            'args'          => array(
                'description'         => 'Add custom Footer Layout ',
                'public'              => true,
                'publicly_queryable'  => false,
                'show_ui'             => true,
                'show_in_rest'        => true,
                'rest_base'           => '',
                'has_archive'         => false,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => false,
                'exclude_from_search' => true,
                'capability_type'     => 'post',
                'map_meta_cap'        => true,
                'hierarchical'        => false,
                'rewrite'             => false,
                'query_var'           => true,
                'menu_position'       => 20,
                'menu_icon'           => 'dashicons-editor-insertmore',
                'supports'            => array( 'title', 'editor', 'thumbnail' ),
            ),
        );
    }
    return $post_types;    
}
