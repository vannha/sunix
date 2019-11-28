<?php
/**
 * Register icons for Visual Composer
 */
function sunix_vc_icon_fonts_register()
{
    wp_register_style('font-linear', get_template_directory_uri() . '/assets/fonts/linear/font-linear.css', array(), wp_get_theme()->get('Version'));
    wp_register_style('font-elegant', get_template_directory_uri() . '/assets/fonts/elegant/font-elegant.css', array(), wp_get_theme()->get('Version'));
    wp_register_style('font-etline', get_template_directory_uri() . '/assets/fonts/et-line-font/et-line-font.css', array(), wp_get_theme()->get('Version'));
    wp_register_style('font-flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/flaticon.css', array(), wp_get_theme()->get('Version'));
}
add_action( 'wp_enqueue_scripts', 'sunix_vc_icon_fonts_register' );
add_action( 'admin_enqueue_scripts', 'sunix_vc_icon_fonts_register' );

/**
 * Enqueues icons for Visual Composer
 */
function sunix_vc_icon_fonts_enqueue()
{
    wp_enqueue_style( 'font-linear' );
    wp_enqueue_style( 'font-elegant' );
    wp_enqueue_style( 'font-etline' );
    wp_enqueue_style( 'font-flaticon' );
}
add_action( 'vc_backend_editor_enqueue_js_css', 'sunix_vc_icon_fonts_enqueue' );
add_action( 'vc_frontend_editor_enqueue_js_css', 'sunix_vc_icon_fonts_enqueue' );

add_action('vc_enqueue_font_icon_element', 'sunix_vc_icon_font');
function sunix_vc_icon_font($font)
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

function sunix_icon_libs($args = array()){
    $args = wp_parse_args($args, array(
        'group'            => esc_html__('Icon','sunix'),
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
                     * $icons_params[ $key ]['value'][ esc_html__( 'Linear Icon', 'sunix' ) ] = 'linear';
                    */
                    $icons_params[ $key ]['value'][ esc_html__( 'Linear Icon', 'sunix' ) ]  = 'linear';
                    $icons_params[ $key ]['value'][ esc_html__( 'Elegant Icon', 'sunix' ) ] = 'elegant';
                    $icons_params[ $key ]['value'][ esc_html__( 'ET Line Icon', 'sunix' ) ] = 'etline';
                    $icons_params[ $key ]['value'][ esc_html__( 'Flat Icon', 'sunix' ) ] = 'flaticon';
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
function sunix_icon_libs_icon($args = array()){
    $args = wp_parse_args($args, array(
        'group'        => esc_html__('Icon','sunix'),
        'field_prefix' => 'i_', 
        'return'       => true
    ));
    extract($args);
    if(!$return) return array();
    return array (
        /* Theme Icons */
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon', 'sunix' ),
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
            'description' => esc_html__( 'Select icon from library.', 'sunix' ),
            'group'       => $group
        ),
        /* Elegant */
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon', 'sunix' ),
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
            'description' => esc_html__( 'Select icon from library.', 'sunix' ),
            'group'       => $group
        ),
        // ET Line
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon', 'sunix' ),
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
            'description' => esc_html__( 'Select icon from library.', 'sunix' ),
            'group'       => $group
        ),
        // Flaticon
        array(
            'type'       => 'iconpicker',
            'heading'    => esc_html__( 'Icon', 'sunix' ),
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
            'description' => esc_html__( 'Select icon from library.', 'sunix' ),
            'group'       => $group
        )
    );
}

/**
 * VC Post type list
 * Get post type for vc element 
*/
if (!function_exists('sunix_vc_post_type_list')) {
    function sunix_vc_post_type_list()
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
        $ExtraExcludedPostTypes = apply_filters('sunix_vc_post_type_list', array());
        
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
function sunix_taxonomies_for_autocomplete(){
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
if(!function_exists('sunix_button_colors')){
    function sunix_button_colors(){
        $button_colors = array(
            esc_html__('Primary', 'sunix')   => 'primary',
            esc_html__('Accent', 'sunix')    => 'accent',
            esc_html__('White', 'sunix')    => 'btn-white',
            esc_html__('Secondary', 'sunix') => 'secondary',
            esc_html__('Custom', 'sunix')    => 'custom',
        );
        return $button_colors;
    }
}

/**
 * Button Style
*/
if(!function_exists('sunix_button_style')){
    function sunix_button_style(){
        $button_type = array(
            esc_html__('Fill', 'sunix')        => 'fill',
            esc_html__('Outline', 'sunix')     => 'outline',
            esc_html__('Simple Link', 'sunix') => 'simple',
        );
        return $button_type;
    }
}
/**
 * Button Shape
*/
if(!function_exists('sunix_button_shapes')){
    function sunix_button_shapes(){
        $button_type = array(
            esc_html__('Default', 'sunix')        => '',
            esc_html__('Square', 'sunix')         => 'square',
            esc_html__('Rounded Corner', 'sunix') => 'rounded',
        );
        return $button_type;
    }
}

/**
 * Button Size
*/
if(!function_exists('sunix_button_size')){
    function sunix_button_size(){
        $button_size = array(
            esc_html__('Tiny', 'sunix')        => 'tn',
            esc_html__('Small', 'sunix')       => 'sm',
            esc_html__('Medium', 'sunix')      => 'md',
            esc_html__('Extra Medium', 'sunix')=> 'xmd',
            esc_html__('Default', 'sunix')     => 'df',
            esc_html__('Large', 'sunix')       => 'lg',
            esc_html__('Extra Large', 'sunix') => 'xlg',
        );
        return $button_size;
    }
}

/**
 * List of thumbnails size
 * @since 1.0.0
 * @author CMSSuperHeroes
 */
if(!function_exists('sunix_thumbnail_sizes')){
    function sunix_thumbnail_sizes() {
        $sunix_thumbnail_sizes = $sunix_default_thumbnail_sizes = $sunix_custom_thumbnail_sizes = array();
        $sunix_default_thumbnail_sizes = array(
            esc_html__( 'Post Thumbnail', 'sunix' )             => 'post-thumbnail',
            esc_html__( 'Medium', 'sunix' )                     => 'medium',
            esc_html__( 'Large', 'sunix' )                      => 'large',
            esc_html__( 'Full', 'sunix' )                       => 'full',
            esc_html__( 'Thumbnail', 'sunix' )                  => 'thumbnail',
        );
        $sunix_custom_thumbnail_sizes = array(
            esc_html__( 'Custom', 'sunix' )                 => 'custom',
        );

        $sunix_thumbnail_sizes = array_merge($sunix_default_thumbnail_sizes, $sunix_custom_thumbnail_sizes);

        return $sunix_thumbnail_sizes;
    }
}

/** 
 * Add new param text-align to VC param_type font_container
 * Added text-align INHERIT for get default text-align when 
 * switch LTR to RTL language
 * @author CMSSuperHeroes
 * @since 1.0.0
*/
add_filter('vc_font_container_output_data','sunix_vc_font_container_render_filter',11,4);
function sunix_vc_font_container_render_filter($data, $fields, $values, $settings){
    if ( isset( $fields['text_align'] ) ) {
        $data['text_align'] = '
        <div class="vc_row-fluid vc_column">
            <div class="wpb_element_label">' . esc_html__( 'Text align', 'sunix' ) . '</div>
            <div class="vc_font_container_form_field-text_align-container">
                <select class="vc_font_container_form_field-text_align-select">
                    <option value="inherit" class="inherit" ' . ( 'inherit' === $values['text_align'] ? 'selected="selected"' : '' ) . '>' . esc_html__( 'Default', 'sunix' ) . '</option>
                    <option value="left" class="left" ' . ( 'left' === $values['text_align'] ? 'selected="selected"' : '' ) . '>' . esc_html__( 'left', 'sunix' ) . '</option>
                    <option value="right" class="right" ' . ( 'right' === $values['text_align'] ? 'selected="selected"' : '' ) . '>' . esc_html__( 'right', 'sunix' ) . '</option>
                    <option value="center" class="center" ' . ( 'center' === $values['text_align'] ? 'selected="selected"' : '' ) . '>' . esc_html__( 'center', 'sunix' ) . '</option>
                    <option value="justify" class="justify" ' . ( 'justify' === $values['text_align'] ? 'selected="selected"' : '' ) . '>' . esc_html__( 'justify', 'sunix' ) . '</option>
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
function sunix_grid_columns(){
    return array(
        esc_html__('1 Column','sunix')   => '12',
        esc_html__('2 Columns','sunix')  => '6',
        esc_html__('3 Columns','sunix')  => '4',
        esc_html__('4 Columns','sunix')  => '3',
        esc_html__('5 Columns','sunix')  => '1/5',
        esc_html__('6 Columns','sunix')  => '2',
        esc_html__('7 Columns','sunix')  => '1/7',
        esc_html__('8 Columns','sunix')  => '1/8',
        esc_html__('9 Columns','sunix')  => '1/9',
        esc_html__('10 Columns','sunix') => '1/10',
        esc_html__('11 Columns','sunix') => '1/11',
        esc_html__('12 Columns','sunix') => '1',
        esc_html__('Auto','sunix')       => 'auto',
    );
}
function sunix_grid_settings($args = array()){
    $args = wp_parse_args($args, array(
        'group'      => '',
        'param_name' => '',
        'value'      => ''
    ));
    extract($args);
    
    return array(
        array(
            'type'             => 'dropdown',
            'description'      => esc_html__('Small Devices','sunix'),
            'param_name'       => 'col_sm',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => sunix_grid_columns(),
            'std'              => '12',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'description'      => esc_html__('Medium Devices','sunix'),
            'param_name'       => 'col_md',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => sunix_grid_columns(),
            'std'              => '6',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'description'      => esc_html__('Large Devices','sunix'),
            'param_name'       => 'col_lg',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => sunix_grid_columns(),
            'std'              => '4',
            'dependency' => array(
                'element'=> $param_name,
                'value'  => $value,
            ),
            'group'            => $group
        ),
        array(
            'type'             => 'dropdown',
            'description'      => esc_html__('Extra Large Devices','sunix'),
            'param_name'       => 'col_xl',
            'edit_field_class' => 'vc_col-sm-3',
            'value'            => sunix_grid_columns(),
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
function sunix_owl_settings( $args = array()){
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
            'heading'          => esc_html__('XSmall Devices','sunix'),
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
            'heading'          => esc_html__('Small Devices','sunix'),
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
            'heading'          => esc_html__('Medium Devices','sunix'),
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
            'heading'          => esc_html__('Large Devices','sunix'),
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
            'heading'     => esc_html__('Number Row','sunix'),
            'description' => esc_html__( 'Choose number of row you want to show.', 'sunix' ),
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
            'heading'     => esc_html__('Slide By','sunix'),
            'description' => esc_html__( 'Number/String. Navigation slide by X. "page" string can be set to slide by page.', 'sunix' ),
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
            'heading'     => esc_html__('Slide Transition','sunix'),
            'description' => esc_html__( 'You can define the transition for the stage you want to use eg. linear.', 'sunix' ),
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
            'heading'    => esc_html__('Loop Items','sunix'),
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
            'heading'    => esc_html__('Center','sunix'),
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
            'heading'    => esc_html__('Auto Width','sunix'),
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
            'heading'    => esc_html__('Auto Height','sunix'),
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
            'heading'    => esc_html__('Items Space','sunix'),
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
            'heading'    => esc_html__('Stage Padding','sunix'),
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
            'heading'    => esc_html__('Start Position','sunix'),
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
                esc_html__('Show Next/Preview button','sunix') => 'true'
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
            'heading'    => esc_html__('Nav Style','sunix'),
            'param_name' => 'nav_style',
            'value'      => sunix_carousel_nav_style(),
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
            'heading'    => esc_html__('Nav Position','sunix'),
            'param_name' => 'nav_pos',
            'value'      => sunix_carousel_nav_pos(),
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
            'heading'    => esc_html__('Nav Color','sunix'),
            'param_name' => 'nav_color',
            'value'      => sunix_carousel_color(),
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
                esc_html__('Show Dots','sunix') => 'true'
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
            'heading'    => esc_html__('Dots Style','sunix'),
            'param_name' => 'dot_style',
            'value'      => sunix_carousel_dots_style(),
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
            'heading'    => esc_html__('Dots Position','sunix'),
            'param_name' => 'dot_pos',
            'value'      => sunix_carousel_dot_pos(),
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
            'heading'    => esc_html__('Dots Color','sunix'),
            'param_name' => 'dot_color',
            'value'      => sunix_carousel_color(),
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
            'heading'    => esc_html__('Dots Thumbnail Size','sunix'),
            'description'    => esc_html__('Enter size: widthxheight','sunix'),
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
                esc_html__('Auto Play','sunix') => 'true',
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
            'heading'     => esc_html__('Smart Speed','sunix'),
            'param_name'  => 'smartspeed',
            'value'       => '250',
            'description' => esc_html__('Speed scroll of each item','sunix'),
            'edit_field_class' => 'vc_col-sm-4',
            'dependency' => array(
                'element' =>'autoplay',
                'value'   => 'true',
            ),
            'group'            => $group
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Auto Play TimeOut','sunix'),
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
            'heading'    => esc_html__('Pause on mouse hover','sunix'),
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
            'heading'       => esc_html__('Animation In','sunix'),
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
            'heading'       => esc_html__('Animation Out','sunix'),
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
function sunix_masonry_call_settings($atts)
{
    extract($atts);
    wp_enqueue_script('vc_masonry');
}
/**
 * VC Element Hover Effect
*/
function sunix_hover_effect(){
    return array(
        esc_html__('None','sunix')                           => 'none',
        esc_html__('Push','sunix')                           => 'push',
        esc_html__('Slide','sunix')                          => 'slide',
        esc_html__('Slide Bottom to Top','sunix')            => 'slide-top',
        esc_html__('Slide Bottom to Top with Title','sunix') => 'slide-top2',
        esc_html__('FadeIn','sunix')                         => 'fade-in',
        esc_html__('FadeIn With with Delay','sunix')         => 'fade-in delay1',
    );
}

function sunix_hover_content($args=[]){
    $args = wp_parse_args($args, [
        'dependency' => '',
        'group' => ''
    ]);
    return array(
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Overlay Background','sunix'),
            'param_name' => 'hover_bg',
            'value'      =>  array(
               esc_html__('Accent Color','sunix')  => 'accent-bg',
               esc_html__('Primary Color','sunix') => 'primary-bg',
               esc_html__('Custom Color','sunix')  => 'custom-bg',
            ),
            'dependency' => $args['dependency'],
            'std'        => 'accent-bg',
            'group'      => $args['group']
        ),
        array(
            'type'       => 'colorpicker',
            'heading'    => esc_html__('Custom Overlay Background','sunix'),
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
            'heading'    => esc_html__('Custom Text Color','sunix'),
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
function sunix_vc_content_align_opts($args = []){
    $args = wp_parse_args($args, [
        'heading'    => esc_html__('Content Alignment', 'sunix'),
        'param_name' => 'content_align', 
        'args'       => [], 
        'dependency' => [],
        'group'      => ''
    ]);
    $_args = array_merge(
        array(
            esc_html__('Default', 'sunix') => '',
            esc_html__('Start', 'sunix')   => 'text-start',
            esc_html__('End', 'sunix')     => 'text-end',
            esc_html__('Center', 'sunix')  => 'text-center',
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
function sunix_heading_tag($args=[]){
    $args = array_merge(
        array(
            esc_html__('Default', 'sunix')            => '',
            esc_html__('Heading 2', 'sunix')          => 'h2',
            esc_html__('Heading 3', 'sunix')          => 'h3',
            esc_html__('Heading 4', 'sunix')          => 'h4',
            esc_html__('Heading 5', 'sunix')          => 'h5',
            esc_html__('Heading 6', 'sunix')          => 'h6',
            esc_html__('Div', 'sunix')                => 'div',
            esc_html__('Custom Size (20px)', 'sunix') => 'h4-1',
        ),
        $args
    );
    return $args;
}
function sunix_heading_font_weight(){
    return array(
        esc_html__('Default','sunix')            => '',
        esc_html__('Thin','sunix')               => '100',
        esc_html__('Thin Italic','sunix')        => '100i',
        esc_html__('Extra-Light','sunix')        => '200',
        esc_html__('Extra-Light Italic','sunix') => '200i',
        esc_html__('Light','sunix')              => '300',
        esc_html__('Light Italic','sunix')       => '300i',
        esc_html__('Regular','sunix')            => '400',
        esc_html__('Regular Italic','sunix')     => '400i',
        esc_html__('Medium','sunix')             => '500',
        esc_html__('Medium Italic','sunix')      => '500i',
        esc_html__('Semi-Bold','sunix')          => '600',
        esc_html__('Semi-Bold Italic','sunix')   => '600i',
        esc_html__('Bold','sunix')               => '700',
        esc_html__('Bold Italic','sunix')        => '700i',
        esc_html__('Extra-Bold','sunix')         => '800',
        esc_html__('Extra-Bold Italic','sunix')  => '800i',
        esc_html__('Black','sunix')              => '900',
        esc_html__('Black Italic','sunix')       => '900i',
    );
}
function sunix_heading_font_style(){
    return array(
        esc_html__('Default','sunix') => '',
        esc_html__('Normal','sunix')  => 'normal',
        esc_html__('Italic','sunix')  => 'italic'
    );
}
function sunix_heading_text_transform(){
    return array(
        esc_html__('Default','sunix')    => '',
        esc_html__('Uppercase','sunix')  => 'uppercase',
        esc_html__('Capitalize','sunix') => 'capitalize',
        esc_html__('Lowercase','sunix')  => 'lowercase',
        esc_html__('Unset','sunix')      => 'unset'
    );
}

function sunix_bg_color(){
    return array(
        esc_html__('Default','sunix')                => 'red-bg',
        esc_html__('Accent Color','sunix')           => 'red-bg-accent',
        esc_html__('Darken Accent Color','sunix')    => 'red-bg-darken-accent',
        esc_html__('Primary Color','sunix')          => 'red-bg-primary',
        esc_html__('Secondary Color','sunix')        => 'red-bg-secondary',
        esc_html__('Medium Dark (#1F1F1F)','sunix')  => 'red-bg-medium-dark',
        esc_html__('Light Dark (#303030)','sunix')   => 'red-bg-light-dark',
        esc_html__('Dark (#000)','sunix')            => 'red-bg-dark',
        esc_html__('Medium Light (#f1f1f1)','sunix') => 'red-bg-medium-light',
        esc_html__('Light (#f5f5f5)','sunix')        => 'red-bg-light',
        esc_html__('Dark Blue (#182333)','sunix')    => 'red-bg-dark-blue',
        esc_html__('White (#ffffff)','sunix')        => 'red-bg-white',
    );
}

function sunix_bg_style(){
    return array(
        esc_html__('Default','sunix')     => '',
        esc_html__('Space Left','sunix')  => 'red-bg-space-left',
        esc_html__('Space Right','sunix') => 'red-bg-space-right',
    );
}

if(!function_exists('sunix_theme_colors')){
    function sunix_theme_colors($default = false, $custom = false){
        $_default = $_custom = [];
        if($default) $_default[esc_html__('Default','sunix')] =  '';
        if($custom) $_custom[esc_html__('Custom Color','sunix')] =  'custom';

        $theme_color =  array(
            esc_html__('Accent','sunix')        => 'accent',
            esc_html__('Accent 2','sunix')      => 'accent2',
            esc_html__('Accent Dark','sunix')   => 'darken-accent',
            esc_html__('Primary','sunix')       => 'primary',
            esc_html__('Dark','sunix')          => 'dark',
            esc_html__('Cyan','sunix')          => 'cyan',
            esc_html__('Cyan Dark','sunix')     => 'cyan-dark',
            esc_html__('Green','sunix')         => 'green',
            esc_html__('Green Dark','sunix')    => 'green-dark',
            esc_html__('Blue','sunix')          => 'blue',
            esc_html__('Blue Dark','sunix')     => 'blue-dark',
            esc_html__('Violet','sunix')        => 'violet',
            esc_html__('Violet Dark','sunix')   => 'violet-dark',
            esc_html__('Cello','sunix')         => 'cello',
            esc_html__('Cello Dark','sunix')    => 'cello-dark',
            esc_html__('Yellow','sunix')        => 'yellow',
            esc_html__('Yellow Dark','sunix')   => 'yellow-dark',
            esc_html__('Orange','sunix')        => 'orange',
            esc_html__('Orange Dark','sunix')   => 'orange-dark',
            esc_html__('Red','sunix')           => 'red',
            esc_html__('Red Dark','sunix')      => 'red-dark',
            esc_html__('Grey','sunix')          => 'grey',
            esc_html__('Grey Dark','sunix')     => 'grey-dark',
            esc_html__('Gray','sunix')          => 'gray',
            esc_html__('Gray Dark','sunix')     => 'gray-dark',
            esc_html__('White','sunix')         => 'white'
        );

        return array_merge($_default, $theme_color, $_custom);
    }
}

/**
 * Get Page List 
 * @return array
*/
if(!function_exists('sunix_vc_list_page')){
    function sunix_vc_list_page($args = []){
        $args = wp_parse_args($args, [
            'default' => true
        ]);
        $page_list = array();
        if($args['default'] === true )$page_list[esc_html__('Default','sunix')] = '';
        $pages = get_pages(array('hierarchical' => 0, 'posts_per_page' => '-1'));
        foreach($pages as $page){
            $page_list[$page->post_title] = $page->ID;
        }
        return $page_list;
    }
}


class sunix_VcSharedLibrary extends VcSharedLibrary{
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
new sunix_VcSharedLibrary();


/**
 * Get Contact Form 7 List
 * @return array
*/
if(!function_exists('sunix_vc_get_list_cf7')){
    function sunix_vc_get_list_cf7() {
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
function sunix_default_value($param, $default){
    return !empty($param) ? $param : $default;
}
