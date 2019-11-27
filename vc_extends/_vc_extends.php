<?php
/**
 * Register icons for Visual Composer
 */
function alacarte_vc_icon_fonts_register()
{
    wp_register_style('font-linear', get_template_directory_uri() . '/assets/fonts/linear/font-linear.css', array(), wp_get_theme()->get('Version'));
    wp_register_style('font-elegant', get_template_directory_uri() . '/assets/fonts/elegant/font-elegant.css', array(), wp_get_theme()->get('Version'));
    wp_register_style('font-etline', get_template_directory_uri() . '/assets/fonts/et-line-font/et-line-font.css', array(), wp_get_theme()->get('Version'));
    wp_register_style('font-flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/flaticon.css', array(), wp_get_theme()->get('Version'));
}
add_action( 'wp_enqueue_scripts', 'alacarte_vc_icon_fonts_register' );
add_action( 'admin_enqueue_scripts', 'alacarte_vc_icon_fonts_register' );

/**
 * Enqueues icons for Visual Composer
 */
function alacarte_vc_icon_fonts_enqueue()
{
    wp_enqueue_style( 'font-linear' );
    wp_enqueue_style( 'font-elegant' );
    wp_enqueue_style( 'font-etline' );
    wp_enqueue_style( 'font-flaticon' );
}
add_action( 'vc_backend_editor_enqueue_js_css', 'alacarte_vc_icon_fonts_enqueue' );
add_action( 'vc_frontend_editor_enqueue_js_css', 'alacarte_vc_icon_fonts_enqueue' );

add_action('vc_enqueue_font_icon_element', 'alacarte_vc_icon_font');
function alacarte_vc_icon_font($font)
{
    switch ($font) {
        case 'linear':
            wp_enqueue_style('font-linear');
        case 'elegant':
            wp_enqueue_style('font-elegant');
        case 'etline':
            wp_enqueue_style('font-etline');
        case 'flaticon':
            wp_enqueue_style('font-flaticon');
    }
}

function alacarte_icon_libs($args = array()){
    $args = wp_parse_args($args, array(
        'group'            => esc_html__('Icon','alacarte'),
        'field_prefix'     => 'i_', 
        'dependency'       => 'add_icon',
        'dependency_value' => 'true'
    ));
    extract($args);

    require_once vc_path_dir( 'CONFIG_DIR', 'content/vc-icon-element.php' );
    /**
     * @source 
     * vc_map_integrate_shortcode( $shortcode, $field_prefix = '', $group_prefix = '', $change_fields = null, $dependency = null )
    **/
    $icons_params = vc_map_integrate_shortcode( vc_icon_element_params(), $field_prefix, $group, array(
        'include_only_regex' => '/^(type|icon_\w*)/',
        // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
    ), array(
        'element' => $dependency,
        'value'   => $dependency_value,
    ) );

    // populate integrated vc_icons params.
    if ( is_array( $icons_params ) && ! empty( $icons_params ) ) {
        foreach ( $icons_params as $key => $param ) {
            if ( is_array( $param ) && ! empty( $param ) ) {
                if ( $field_prefix.'type' === $param['param_name'] ) {
                    /* append biger icon to dropdown 
                     * use: 
                     * $icons_params[ $key ]['value'][ esc_html__( 'Linear Icon', 'alacarte' ) ] = 'linear';
                    */
                    $icons_params[ $key ]['value'][ esc_html__( 'Linear Icon', 'alacarte' ) ]  = 'linear';
                    $icons_params[ $key ]['value'][ esc_html__( 'Elegant Icon', 'alacarte' ) ] = 'elegant';
                    $icons_params[ $key ]['value'][ esc_html__( 'ET Line Icon', 'alacarte' ) ] = 'etline';
                    $icons_params[ $key ]['value'][ esc_html__( 'Flat Icon', 'alacarte' ) ] = 'flaticon';
                    /* Change default font icon
                     * $icons_params[ $key ]['std'] = 'fontawesome';
                    */
                    $icons_params[ $key ]['std'] = 'linear';
                }
                if ( isset( $param['admin_label'] ) ) {
                    /*remove admin label*/
                    unset( $icons_params[ $key ]['admin_label'] );
                }
            }
        }
    }
    return $icons_params;
}
function alacarte_icon_libs_icon($args = array()){
    $args = wp_parse_args($args, array(
        'group'        => esc_html__('Icon','alacarte'),
        'field_prefix' => 'i_', 
        'return'       => true
    ));
    extract($args);
    if(!$return) return array();
    return array (
        /* Theme Icons */
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon', 'alacarte' ),
            'param_name' => $field_prefix.'icon_linear',
            'value'      => 'lnr lnr-home',
            'settings'   => array(
              'emptyIcon'    => false,
              'type'         => 'linear',
              'iconsPerPage' => 100,
            ),
            'dependency'  => array(
              'element' => $field_prefix.'type',
              'value'   => 'linear',
            ),
            'description' => esc_html__( 'Select icon from library.', 'alacarte' ),
            'group'       => $group
        ),
        /* Elegant */
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon', 'alacarte' ),
            'param_name' => $field_prefix.'icon_elegant',
            'value'      => 'arrow_up',
            'settings'   => array(
              'emptyIcon'    => false,
              'type'         => 'elegant',
              'iconsPerPage' => 100,
            ),
            'dependency'  => array(
              'element' => $field_prefix.'type',
              'value'   => 'elegant',
            ),
            'description' => esc_html__( 'Select icon from library.', 'alacarte' ),
            'group'       => $group
        ),
        // ET Line
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon', 'alacarte' ),
            'param_name' => $field_prefix.'icon_etline',
            'value'      => 'icon-mobile',
            'settings'   => array(
              'emptyIcon'    => false,
              'type'         => 'etline',
              'iconsPerPage' => 100,
            ),
            'dependency'  => array(
              'element' => $field_prefix.'type',
              'value'   => 'etline',
            ),
            'description' => esc_html__( 'Select icon from library.', 'alacarte' ),
            'group'       => $group
        ),
        // Flaticon
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon', 'alacarte' ),
            'param_name' => $field_prefix.'icon_flaticon',
            'value'      => 'flaticon-medal',
            'settings'   => array(
              'emptyIcon'    => false,
              'type'         => 'flaticon',
              'iconsPerPage' => 100,
            ),
            'dependency'  => array(
              'element' => $field_prefix.'type',
              'value'   => 'flaticon',
            ),
            'description' => esc_html__( 'Select icon from library.', 'alacarte' ),
            'group'       => $group
        )
    );
}

/**
 * VC Post type list
 * Get post type for vc element 
*/
if (!function_exists('alacarte_vc_post_type_list')) {
    function alacarte_vc_post_type_list()
    {
        $post_types = get_post_types(array('public' => true), 'object');
        $DefaultExcludedPostTypes = array(
            'revision',
            'nav_menu_item',
            'vc_grid_item',
            'page',
            'attachment',
            'custom_css',
            'customize_changeset',
            'oembed_cache',
            'ef5_mega_menu',
            'ef5_header_top',
            'ef5_footer'
        );
        $ExtraExcludedPostTypes = apply_filters('alacarte_vc_post_type_list', array());
        
        $excludedPostTypes = array_merge($DefaultExcludedPostTypes, $ExtraExcludedPostTypes );

        $result = [];
        if (!is_array($post_types))
            return $result;
        foreach ($post_types as $post_type) {
            if (!$post_type instanceof WP_Post_Type)
                continue;
            if (in_array($post_type->name, $excludedPostTypes))
                continue;
            $result["{$post_type->label} ({$post_type->name})"] = $post_type->name;
        }
        return $result;
    }
}

/**
 * Custom CPT UI
 * Need to do this to add custom post type registered with CPT UI
 * show in list DATA SOURCE of VC POST GRID Element
 * referent link : https://wordpress.org/support/topic/custom-post-type-and-visual-composer-grid-block/#post-6182678
 * and : https://wordpress.org/support/topic/custom-post-type-and-visual-composer-grid-block/page/2#post-6182761
 *
 * @author Chinh Duong Manh
 * @since 1.0.0
 */
if (function_exists('cptui_create_custom_post_types')) {
    remove_action('init', 'cptui_create_custom_post_types', 10);
    add_action('init', 'cptui_create_custom_post_types', 2);
}
/**
 * Auto Show  taxonomies
*/
function alacarte_taxonomies_for_autocomplete(){
    $taxonomies_types = get_taxonomies( array( 'public' => true ), 'objects' );
    $result = array();
    if ( is_array( $taxonomies_types ) && ! empty( $taxonomies_types ) ) {
        foreach ( $taxonomies_types as $key => $tt ) {
            $taxonomies = get_terms( $key, array(
                'hide_empty' => true,
            ) );
            if ( is_array( $taxonomies ) && ! empty( $taxonomies ) ) {
                foreach ( $taxonomies as $t ) {
                    if ( is_object( $t ) && strpos($tt->name, 'cat') !== false) {
                        $result[] = array(
                            'label'=>$t->name,
                            'value'=>$t->slug,
                            'group'=>$tt->label
                        );
                    }
                }
            }
        }
    }
    return $result;
}

/**
 * Button Colors
*/
if(!function_exists('alacarte_button_colors')){
    function alacarte_button_colors(){
        $button_colors = array(
            esc_html__('Primary', 'alacarte')   => 'primary',
            esc_html__('Accent', 'alacarte')    => 'accent',
            esc_html__('White', 'alacarte')    => 'btn-white',
            esc_html__('Secondary', 'alacarte') => 'secondary',
            esc_html__('Custom', 'alacarte')    => 'custom',
        );
        return $button_colors;
    }
}

/**
 * Button Style
*/
if(!function_exists('alacarte_button_style')){
    function alacarte_button_style(){
        $button_type = array(
            esc_html__('Fill', 'alacarte')        => 'fill',
            esc_html__('Outline', 'alacarte')     => 'outline',
            esc_html__('Simple Link', 'alacarte') => 'simple',
        );
        return $button_type;
    }
}
/**
 * Button Shape
*/
if(!function_exists('alacarte_button_shapes')){
    function alacarte_button_shapes(){
        $button_type = array(
            esc_html__('Default', 'alacarte')        => '',
            esc_html__('Square', 'alacarte')         => 'square',
            esc_html__('Rounded Corner', 'alacarte') => 'rounded',
        );
        return $button_type;
    }
}

/**
 * Button Size
*/
if(!function_exists('alacarte_button_size')){
    function alacarte_button_size(){
        $button_size = array(
            esc_html__('Tiny', 'alacarte')        => 'tn',
            esc_html__('Small', 'alacarte')       => 'sm',
            esc_html__('Medium', 'alacarte')      => 'md',
            esc_html__('Extra Medium', 'alacarte')=> 'xmd',
            esc_html__('Default', 'alacarte')     => 'df',
            esc_html__('Large', 'alacarte')       => 'lg',
            esc_html__('Extra Large', 'alacarte') => 'xlg',
        );
        return $button_size;
    }
}

/**
 * List of thumbnails size
 * @since 1.0.0
 * @author CMSSuperHeroes
 */
if(!function_exists('alacarte_thumbnail_sizes')){
    function alacarte_thumbnail_sizes() {
        $alacarte_thumbnail_sizes = $alacarte_default_thumbnail_sizes = $alacarte_custom_thumbnail_sizes = array();
        $alacarte_default_thumbnail_sizes = array(
            esc_html__( 'Post Thumbnail', 'alacarte' )             => 'post-thumbnail',
            esc_html__( 'Medium', 'alacarte' )                     => 'medium',
            esc_html__( 'Large', 'alacarte' )                      => 'large',
            esc_html__( 'Full', 'alacarte' )                       => 'full',
            esc_html__( 'Thumbnail', 'alacarte' )                  => 'thumbnail',
        );
        $alacarte_custom_thumbnail_sizes = array(
            esc_html__( 'Custom', 'alacarte' )                 => 'custom',
        );

        $alacarte_thumbnail_sizes = array_merge($alacarte_default_thumbnail_sizes, $alacarte_custom_thumbnail_sizes);

        return $alacarte_thumbnail_sizes;
    }
}

/** 
 * Add new param text-align to VC param_type font_container
 * Added text-align INHERIT for get default text-align when 
 * switch LTR to RTL language
 * @author CMSSuperHeroes
 * @since 1.0.0
*/
add_filter('vc_font_container_output_data','alacarte_vc_font_container_render_filter',11,4);
function alacarte_vc_font_container_render_filter($data, $fields, $values, $settings){
    if ( isset( $fields['text_align'] ) ) {
        $data['text_align'] = '
        <div class="vc_row-fluid vc_column">
            <div class="wpb_element_label">' . esc_html__( 'Text align', 'alacarte' ) . '</div>
            <div class="vc_font_container_form_field-text_align-container">
                <select class="vc_font_container_form_field-text_align-select">
                    <option value="inherit" class="inherit" ' . ( 'inherit' === $values['text_align'] ? 'selected="selected"' : '' ) . '>' . esc_html__( 'Default', 'alacarte' ) . '</option>
                    <option value="left" class="left" ' . ( 'left' === $values['text_align'] ? 'selected="selected"' : '' ) . '>' . esc_html__( 'left', 'alacarte' ) . '</option>
                    <option value="right" class="right" ' . ( 'right' === $values['text_align'] ? 'selected="selected"' : '' ) . '>' . esc_html__( 'right', 'alacarte' ) . '</option>
                    <option value="center" class="center" ' . ( 'center' === $values['text_align'] ? 'selected="selected"' : '' ) . '>' . esc_html__( 'center', 'alacarte' ) . '</option>
                    <option value="justify" class="justify" ' . ( 'justify' === $values['text_align'] ? 'selected="selected"' : '' ) . '>' . esc_html__( 'justify', 'alacarte' ) . '</option>
                </select>
            </div>';
        if ( isset( $fields['text_align_description'] ) && strlen( $fields['text_align_description'] ) > 0 ) {
            $data['text_align'] .= '
            <span class="vc_description clear">' . $fields['text_align_description'] . '</span>
            ';
        }
        $data['text_align'] .= '</div>';
    }
    return $data;
}

/*
 * Grid Settings 
*/
function alacarte_grid_columns(){
    return array(
        esc_html__('1 Column','alacarte')   => '12',
        esc_html__('2 Columns','alacarte')  => '6',
        esc_html__('3 Columns','alacarte')  => '4',
        esc_html__('4 Columns','alacarte')  => '3',
        esc_html__('5 Columns','alacarte')  => '1/5',
        esc_html__('6 Columns','alacarte')  => '2',
        esc_html__('7 Columns','alacarte')  => '1/7',
        esc_html__('8 Columns','alacarte')  => '1/8',
        esc_html__('9 Columns','alacarte')  => '1/9',
        esc_html__('10 Columns','alacarte') => '1/10',
        esc_html__('11 Columns','alacarte') => '1/11',
        esc_html__('12 Columns','alacarte') => '1',
        esc_html__('Auto','alacarte')       => 'auto',
    );
}
function alacarte_grid_settings($args = array()){
    $args = wp_parse_args($args, array(
        'group'      => '',
        'param_name' => '',
        'value'      => ''
    ));
    extract($args);
    
    return array(
        array(
            'type'             => 'dropdown',
            'description'      => esc_html__('Small Devices','alacarte'),
            'param_name'       => 'col_sm',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => alacarte_grid_columns(),
            'std'              => '12',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'description'      => esc_html__('Medium Devices','alacarte'),
            'param_name'       => 'col_md',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => alacarte_grid_columns(),
            'std'              => '6',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'description'      => esc_html__('Large Devices','alacarte'),
            'param_name'       => 'col_lg',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => alacarte_grid_columns(),
            'std'              => '4',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'description'      => esc_html__('Extra Large Devices','alacarte'),
            'param_name'       => 'col_xl',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => alacarte_grid_columns(),
            'std'              => '3',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        )
    );
}
/* OWL Carousel Setting 
 * All option will use in element use OWL Carousel Libs
*/
function alacarte_owl_settings( $args = array()){
    $args = wp_parse_args($args, array(
        'group'      => '',
        'param_name' => '',
        'value'      => '',
        'not_value'  => ''
    ));
    extract($args);
    return array(
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('XSmall Devices','alacarte'),
            'param_name'       => 'owl_sm_items',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => array(1,2,3,4,5,6,7,8,9,10,11,12),
            'std'              => 1,
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Small Devices','alacarte'),
            'param_name'       => 'owl_md_items',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => array(1,2,3,4,5,6,7,8,9,10,11,12),
            'std'              => 2,
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Medium Devices','alacarte'),
            'param_name'       => 'owl_lg_items',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => array(1,2,3,4,5,6,7,8,9,10,11,12),
            'std'              => 3,
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Large Devices','alacarte'),
            'param_name'       => 'owl_xl_items',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => array(1,2,3,4,5,6,7,8,9,10,11,12),
            'std'              => 4,
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'        => 'dropdown',
            'heading'     => esc_html__('Number Row','alacarte'),
            'description' => esc_html__( 'Choose number of row you want to show.', 'alacarte' ),
            'param_name'  => 'number_row',
            'value'       => array(1,2,3,4,5,6,7,8,9,10),
            'std'         => 1,
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'       => $group,
            'edit_field_class' => 'vc_col-sm-4',
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Slide By','alacarte'),
            'description' => esc_html__( 'Number/String. Navigation slide by X. "page" string can be set to slide by page.', 'alacarte' ),
            'param_name'  => 'slideby',
            'value'       => 'page',
            'std'         => 'page',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'       => $group,
            'edit_field_class' => 'vc_col-sm-4',
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Slide Transition','alacarte'),
            'description' => esc_html__( 'You can define the transition for the stage you want to use eg. linear.', 'alacarte' ),
            'param_name'  => 'slidetransition',
            'value'       => 'ease',
            'std'         => 'ease',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'       => $group,
            'edit_field_class' => 'vc_col-sm-4',
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__('Loop Items','alacarte'),
            'param_name' => 'loop',
            'std'        => 'false',
            'edit_field_class' => 'vc_col-sm-3',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__('Center','alacarte'),
            'param_name' => 'center',
            'std'        => 'false',
            'edit_field_class' => 'vc_col-sm-3',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__('Auto Width','alacarte'),
            'param_name' => 'autowidth',
            'std'        => 'false',
            'edit_field_class' => 'vc_col-sm-3',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__('Auto Height','alacarte'),
            'param_name' => 'autoheight',
            'std'        => 'true',
            'edit_field_class' => 'vc_col-sm-3',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Items Space','alacarte'),
            'param_name' => 'margin',
            'value'      => 30,
            'edit_field_class' => 'vc_col-sm-4',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Stage Padding','alacarte'),
            'param_name' => 'stagepadding',
            'value'      => '0',
            'edit_field_class' => 'vc_col-sm-4',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Start Position','alacarte'),
            'param_name' => 'startposition',
            'value'      => '0',
            'edit_field_class' => 'vc_col-sm-4',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        
        array(
            'type'        => 'checkbox',
            'param_name'  => 'nav',
            'value'       => array(
                esc_html__('Show Next/Preview button','alacarte') => 'true'
            ),
            'std'         => 'false',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Nav Style','alacarte'),
            'param_name' => 'nav_style',
            'value'      => alacarte_carousel_nav_style(),
            'std'        => 'default',
            'dependency' => array(
                'element'=>'nav',
                'value'  => 'true',
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Nav Position','alacarte'),
            'param_name' => 'nav_pos',
            'value'      => alacarte_carousel_nav_pos(),
            'std'        => 'default',
            'dependency' => array(
                'element'            => 'nav_style',
                'value_not_equal_to' => 'dot-in-nav',
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Nav Color','alacarte'),
            'param_name' => 'nav_color',
            'value'      => alacarte_carousel_color(),
            'std'        => 'default',
            'dependency' => array(
                'element'=> 'nav',
                'value'  => 'true',
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'dots',
            'value'      => array(
                esc_html__('Show Dots','alacarte') => 'true'
            ),
            'std'        => 'true',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'  => $group
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Dots Style','alacarte'),
            'param_name' => 'dot_style',
            'value'      => alacarte_carousel_dots_style(),
            'std'        => 'default',
            'dependency' => array(
                'element'=>'dots',
                'value'  => array('true'),
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Dots Position','alacarte'),
            'param_name' => 'dot_pos',
            'value'      => alacarte_carousel_dot_pos(),
            'std'        => 'default',
            'dependency' => array(
                'element'=>'dots',
                'value'  => array('true'),
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Dots Color','alacarte'),
            'param_name' => 'dot_color',
            'value'      => alacarte_carousel_color(),
            'std'        => 'default',
            'dependency' => array(
                'element'=>'dot_style',
                'value_not_equal_to'  => array('thumbnail'),
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Dots Thumbnail Size','alacarte'),
            'description'    => esc_html__('Enter size: widthxheight','alacarte'),
            'param_name' => 'dot_thumbnail_size',
            'value'      => '100',
            'dependency' => array(
                'element'=>'dot_style',
                'value'  => 'thumbnail',
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'checkbox',
            'value'      => array(
                esc_html__('Auto Play','alacarte') => 'true',
            ),
            'param_name' => 'autoplay',
            'std'        => 'true',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Smart Speed','alacarte'),
            'param_name'  => 'smartspeed',
            'value'       => '250',
            'description' => esc_html__('Speed scroll of each item','alacarte'),
            'edit_field_class' => 'vc_col-sm-4',
            'dependency' => array(
                'element' =>'autoplay',
                'value'   => 'true',
            ),
            'group'            => $group
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Auto Play TimeOut','alacarte'),
            'param_name' => 'autoplaytimeout',
            'value'      => '5000',
            'dependency' => array(
                'element' =>'autoplay',
                'value'   => 'true',
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__('Pause on mouse hover','alacarte'),
            'param_name' => 'autoplayhoverpause',
            'std'        => 'true',
            'dependency' => array(
                'element' =>'autoplay',
                'value'   => 'true',
            ),
            'edit_field_class' => 'vc_col-sm-4',
            'group'            => $group
        ),
      
        array(
            'type'          => 'animation_style',
            'class'         => '',
            'heading'       => esc_html__('Animation In','alacarte'),
            'param_name'    => 'owlanimation_in',
            'std'           => '',
            'settings'      => array(
                'type' => array(
                    'in'
                ),
            ),
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'          => 'animation_style',
            'class'         => '',
            'heading'       => esc_html__('Animation Out','alacarte'),
            'param_name'    => 'owlanimation_out',
            'std'           => '',
            'settings'      => array(
                'type' => array(
                    'out'
                ),
            ),
            'edit_field_class' => 'vc_col-sm-6',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
    );
}
/* Call Masonry Settings */
function alacarte_masonry_call_settings($atts)
{
    extract($atts);
    wp_enqueue_script('vc_masonry');
}
/**
 * VC Element Hover Effect
*/
function alacarte_hover_effect(){
    return array(
        esc_html__('None','alacarte')                           => 'none',
        esc_html__('Push','alacarte')                           => 'push',
        esc_html__('Slide','alacarte')                          => 'slide',
        esc_html__('Slide Bottom to Top','alacarte')            => 'slide-top',
        esc_html__('Slide Bottom to Top with Title','alacarte') => 'slide-top2',
        esc_html__('FadeIn','alacarte')                         => 'fade-in',
        esc_html__('FadeIn With with Delay','alacarte')         => 'fade-in delay1',
    );
}

function alacarte_hover_content($args=[]){
    $args = wp_parse_args($args, [
        'dependency' => '',
        'group' => ''
    ]);
    return array(
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Overlay Background','alacarte'),
            'param_name' => 'hover_bg',
            'value'      =>  array(
               esc_html__('Accent Color','alacarte')  => 'accent-bg',
               esc_html__('Primary Color','alacarte') => 'primary-bg',
               esc_html__('Custom Color','alacarte')  => 'custom-bg',
            ),
            'dependency' => $args['dependency'],
            'std'        => 'accent-bg',
            'group'      => $args['group']
        ),
        array(
            'type'       => 'colorpicker',
            'heading'    => esc_html__('Custom Overlay Background','alacarte'),
            'param_name' => 'custom_hover_bg',
            'dependency' => array(
                'element' => 'hover_bg',
                'value'   => 'custom-bg'
            ),
            'edit_field_class' => 'vc_col-sm-6',
            'group'      => $args['group']
        ),
        array(
            'type'       => 'colorpicker',
            'heading'    => esc_html__('Custom Text Color','alacarte'),
            'param_name' => 'custom_text_color',
            'dependency' => array(
                'element' => 'hover_bg',
                'value'   => 'custom-bg'
            ),
            'edit_field_class' => 'vc_col-sm-6',
            'group'      => $args['group']
        )
    );
}
/**
 * Content Alignment
*/
function alacarte_vc_content_align_opts($args = []){
    $args = wp_parse_args($args, [
        'heading'    => esc_html__('Content Alignment', 'alacarte'),
        'param_name' => 'content_align', 
        'args'       => [], 
        'dependency' => [],
        'group'      => ''
    ]);
    $_args = array_merge(
        array(
            esc_html__('Default', 'alacarte') => '',
            esc_html__('Start', 'alacarte')   => 'text-start',
            esc_html__('End', 'alacarte')     => 'text-end',
            esc_html__('Center', 'alacarte')  => 'text-center',
        ),
        $args['args']
    );
    return array(
        'type'        => 'dropdown',
        'heading'     => $args['heading'],
        'param_name'  => $args['param_name'],
        'value'       => $_args,
        'std'         => '',
        'admin_label' => true,
        'dependency'  => $args['dependency'],
        'group'       => $args['group']
    );
}
/**
 * Heading Tags
*/
function alacarte_heading_tag($args=[]){
    $args = array_merge(
        array(
            esc_html__('Default', 'alacarte')            => '',
            esc_html__('Heading 2', 'alacarte')          => 'h2',
            esc_html__('Heading 3', 'alacarte')          => 'h3',
            esc_html__('Heading 4', 'alacarte')          => 'h4',
            esc_html__('Heading 5', 'alacarte')          => 'h5',
            esc_html__('Heading 6', 'alacarte')          => 'h6',
            esc_html__('Div', 'alacarte')                => 'div',
            esc_html__('Custom Size (20px)', 'alacarte') => 'h4-1',
        ),
        $args
    );
    return $args;
}
function alacarte_heading_font_weight(){
    return array(
        esc_html__('Default','alacarte')            => '',
        esc_html__('Thin','alacarte')               => '100',
        esc_html__('Thin Italic','alacarte')        => '100i',
        esc_html__('Extra-Light','alacarte')        => '200',
        esc_html__('Extra-Light Italic','alacarte') => '200i',
        esc_html__('Light','alacarte')              => '300',
        esc_html__('Light Italic','alacarte')       => '300i',
        esc_html__('Regular','alacarte')            => '400',
        esc_html__('Regular Italic','alacarte')     => '400i',
        esc_html__('Medium','alacarte')             => '500',
        esc_html__('Medium Italic','alacarte')      => '500i',
        esc_html__('Semi-Bold','alacarte')          => '600',
        esc_html__('Semi-Bold Italic','alacarte')   => '600i',
        esc_html__('Bold','alacarte')               => '700',
        esc_html__('Bold Italic','alacarte')        => '700i',
        esc_html__('Extra-Bold','alacarte')         => '800',
        esc_html__('Extra-Bold Italic','alacarte')  => '800i',
        esc_html__('Black','alacarte')              => '900',
        esc_html__('Black Italic','alacarte')       => '900i',
    );
}
function alacarte_heading_font_style(){
    return array(
        esc_html__('Default','alacarte') => '',
        esc_html__('Normal','alacarte')  => 'normal',
        esc_html__('Italic','alacarte')  => 'italic'
    );
}
function alacarte_heading_text_transform(){
    return array(
        esc_html__('Default','alacarte')    => '',
        esc_html__('Uppercase','alacarte')  => 'uppercase',
        esc_html__('Capitalize','alacarte') => 'capitalize',
        esc_html__('Lowercase','alacarte')  => 'lowercase',
        esc_html__('Unset','alacarte')      => 'unset'
    );
}

function alacarte_bg_color(){
    return array(
        esc_html__('Default','alacarte')                => 'red-bg',
        esc_html__('Accent Color','alacarte')           => 'red-bg-accent',
        esc_html__('Darken Accent Color','alacarte')    => 'red-bg-darken-accent',
        esc_html__('Primary Color','alacarte')          => 'red-bg-primary',
        esc_html__('Secondary Color','alacarte')        => 'red-bg-secondary',
        esc_html__('Medium Dark (#1F1F1F)','alacarte')  => 'red-bg-medium-dark',
        esc_html__('Light Dark (#303030)','alacarte')   => 'red-bg-light-dark',
        esc_html__('Dark (#000)','alacarte')            => 'red-bg-dark',
        esc_html__('Medium Light (#f1f1f1)','alacarte') => 'red-bg-medium-light',
        esc_html__('Light (#f5f5f5)','alacarte')        => 'red-bg-light',
        esc_html__('Dark Blue (#182333)','alacarte')    => 'red-bg-dark-blue',
        esc_html__('White (#ffffff)','alacarte')        => 'red-bg-white',
    );
}

function alacarte_bg_style(){
    return array(
        esc_html__('Default','alacarte')     => '',
        esc_html__('Space Left','alacarte')  => 'red-bg-space-left',
        esc_html__('Space Right','alacarte') => 'red-bg-space-right',
    );
}

if(!function_exists('alacarte_theme_colors')){
    function alacarte_theme_colors($default = false, $custom = false){
        $_default = $_custom = [];
        if($default) $_default[esc_html__('Default','alacarte')] =  '';
        if($custom) $_custom[esc_html__('Custom Color','alacarte')] =  'custom';

        $theme_color =  array(
            esc_html__('Accent','alacarte')        => 'accent',
            esc_html__('Accent 2','alacarte')      => 'accent2',
            esc_html__('Accent Dark','alacarte')   => 'darken-accent',
            esc_html__('Primary','alacarte')       => 'primary',
            esc_html__('Dark','alacarte')          => 'dark',
            esc_html__('Cyan','alacarte')          => 'cyan',
            esc_html__('Cyan Dark','alacarte')     => 'cyan-dark',
            esc_html__('Green','alacarte')         => 'green',
            esc_html__('Green Dark','alacarte')    => 'green-dark',
            esc_html__('Blue','alacarte')          => 'blue',
            esc_html__('Blue Dark','alacarte')     => 'blue-dark',
            esc_html__('Violet','alacarte')        => 'violet',
            esc_html__('Violet Dark','alacarte')   => 'violet-dark',
            esc_html__('Cello','alacarte')         => 'cello',
            esc_html__('Cello Dark','alacarte')    => 'cello-dark',
            esc_html__('Yellow','alacarte')        => 'yellow',
            esc_html__('Yellow Dark','alacarte')   => 'yellow-dark',
            esc_html__('Orange','alacarte')        => 'orange',
            esc_html__('Orange Dark','alacarte')   => 'orange-dark',
            esc_html__('Red','alacarte')           => 'red',
            esc_html__('Red Dark','alacarte')      => 'red-dark',
            esc_html__('Grey','alacarte')          => 'grey',
            esc_html__('Grey Dark','alacarte')     => 'grey-dark',
            esc_html__('Gray','alacarte')          => 'gray',
            esc_html__('Gray Dark','alacarte')     => 'gray-dark',
            esc_html__('White','alacarte')         => 'white'
        );

        return array_merge($_default, $theme_color, $_custom);
    }
}

/**
 * Get Page List 
 * @return array
*/
if(!function_exists('alacarte_vc_list_page')){
    function alacarte_vc_list_page($args = []){
        $args = wp_parse_args($args, [
            'default' => true
        ]);
        $page_list = array();
        if($args['default'] === true )$page_list[esc_html__('Default','alacarte')] = '';
        $pages = get_pages(array('hierarchical' => 0, 'posts_per_page' => '-1'));
        foreach($pages as $page){
            $page_list[$page->post_title] = $page->ID;
        }
        return $page_list;
    }
}


class alacarte_VcSharedLibrary extends VcSharedLibrary{
    /**
     * Round box styles
     *
     * @var array
     */
    public function __construct(){
        parent::$round_box_styles = array(
            'Round'               => 'vc_box_rounded',
            'Round Border'        => 'vc_box_border_rounded',
            'Round Outline'       => 'vc_box_outline_rounded',
            'Round Shadow'        => 'vc_box_shadow_rounded',
            'Round Border Shadow' => 'vc_box_shadow_border_rounded',
        );
    }
}
new alacarte_VcSharedLibrary();


/**
 * Get Contact Form 7 List
 * @return array
*/
if(!function_exists('alacarte_vc_get_list_cf7')){
    function alacarte_vc_get_list_cf7() {
        if(!class_exists('WPCF7')) return;
        $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
        $contact_forms = [];
        foreach ( $cf7 as $cform ) {
            $contact_forms[ $cform->post_title ] = $cform->post_title;
        }
        return $contact_forms;
    }
}

/**
 * Default value
 * @param $param
 * @param $default
 * @return 
*/
function alacarte_default_value($param, $default){
    return !empty($param) ? $param : $default;
}
