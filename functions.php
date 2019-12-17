<?php
/**
 * sunix functions and definitions
 *
 * @package sunix
 * @subpackage sunix
 * @since 1.0.0
 * @author EF5 Team
 *
*/
if(!function_exists('sunix_configs')){
    function sunix_configs($value){
        $configs = [
            'primary_color'    => '#f4436d',
            'accent_color'     => '#333',
            'secondary_color'     => '#CE0023',
            // Typo
            'body_bg'               => '#fff',
            'body_font'             => 'Roboto',
            'body_font_size'        => '18px',
            'body_font_size_large'  => '20px',
            'body_font_size_medium' => '16px',
            'body_font_size_small'  => '14px',
            'body_font_size_xsmall' => '13px',
            'body_font_size_xxsmall'=> '12px',
            'body_font_color'       => '#666666',
            'body_line_height'      => '1.8',
            'content_width'         => 1170,
            'h1_size'               => '36px',
            'h2_size'               => '30px',
            'h3_size'               => '24px',
            'h4_size'               => '20px',
            'h5_size'               => '16px',
            'h6_size'               => '14px',
            'heading_font'          => '\'Roboto\', sans-serif',
            'heading_color'         => '#333',
            'heading_color_hover'   => '#f4436d',
            'heading_font_weight'   => 700,
            'meta_font'             => '\'Roboto\', sans-serif',    
            'meta_color'            => '#777',
            'meta_color_hover'      => '#FBB040',
            // Boder
            'main_border'           => '1px solid #D8D8D8;',
            'main_border2'          => '2px solid #D8D8D8',
            'main_border_color'     => '#111',
            // Thumbnail Size
            'large_size_w'     => 1170,
            'large_size_h'     => 638,
            'medium_size_w'    => 375,
            'medium_size_h'    => 280,
            'thumbnail_size_w' => 110,
            'thumbnail_size_h' => 110,
            'post_thumbnail_size_w' => 1170,
            'post_thumbnail_size_h' => 679,
            // Header 
            'header_height'       => '116px',
            'logo_width'       => '149',
            'logo_height'      => '55',
            'logo_units'       => 'px',
            'header_sidewidth' => '320px',
            'dropdown_bg'      => 'rgba(#fff, 1)',
            // Comments 
            'cmt_avatar_size'  => 80,
            'cmt_border'       => '1px solid #D8D8D8',
            // WooCommerce,
            'sunix_product_single_image_w' => '570',
            'sunix_product_single_image_h' => '748',

            'sunix_product_loop_image_w' => '370',
            'sunix_product_loop_image_h' => '470',

            'sunix_product_gallery_thumbnail_w' => '180',
            'sunix_product_gallery_thumbnail_h' => '220',

            'sunix_product_gallery_thumbnail_v_w' => '180',
            'sunix_product_gallery_thumbnail_v_h' => '220',

            'sunix_product_gallery_thumbnail_h_w' => '180',
            'sunix_product_gallery_thumbnail_h_h' => '220',

            'sunix_product_gallery_thumbnail_space' => '15'

        ];
        return $configs[$value];
    }
}
if (!function_exists('sunix_setup')) {
    function sunix_setup()
    {
        // Make theme available for translation.
        load_theme_textdomain('sunix', get_template_directory() . '/languages');

        // Custom Header
        add_theme_support("custom-header");

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');
        
        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails'); 
        set_post_thumbnail_size(sunix_configs('post_thumbnail_size_w'), sunix_configs('post_thumbnail_size_h'), 1);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'red-primary' => esc_html__('Primary Menu', 'sunix'),
            'red-primary-left' => esc_html__('Menu Left', 'sunix'),
            'red-primary-right' => esc_html__('Menu Right', 'sunix'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('sunix_custom_background_args', array(
            'default-color' => '#ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Add support for core custom logo.
        add_theme_support('custom-logo', array(
            'width'       => sunix_configs('logo_width'),
            'height'      => sunix_configs('logo_height'),
            'flex-width'  => true,
            'flex-height' => true,
        ));
        add_theme_support('post-formats', array(
            'gallery',
            'video',
            'audio',
            'quote',
            'link',
            'image'
        ));
        /* WooCommerce */
        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');    
        /*
         * Add style for editor
        */
        sunix_require_folder( '/inc/editor',get_template_directory());
        add_image_size('sunix-436-544', 436,544, true);
    }
    add_action('after_setup_theme', 'sunix_setup');
}

function sunix_update(){
    /* Change default image thumbnail sizes in wordpress */
    $thumbnail_size = array(
        'large_size_w'        => sunix_configs('large_size_w'),
        'large_size_h'        => sunix_configs('large_size_h'),
        'large_crop'          => 1, 
        'medium_size_w'       => sunix_configs('medium_size_w'),
        'medium_size_h'       => sunix_configs('medium_size_h'),
        'medium_crop'         => 1, 
        'thumbnail_size_w'    => sunix_configs('thumbnail_size_w'),
        'thumbnail_size_h'    => sunix_configs('thumbnail_size_h'),
        'thumbnail_crop'      => 1,
    );

    foreach ($thumbnail_size as $option => $value) {
        if (get_option($option, '') != $value)
            update_option($option, $value);
    }
}
add_action('after_switch_theme', 'sunix_update');

/* add editor styles */
function sunix_editor_styles()
{
    add_editor_style('assets/admin/css/editor.css');
}
add_action('admin_init', 'sunix_editor_styles');

/* add admin styles */
function sunix_admin_style()
{
    wp_enqueue_style('sunix', get_template_directory_uri() . '/assets/admin/css/admin.css');
}
add_action('admin_enqueue_scripts', 'sunix_admin_style');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
// Set up the content width value based on the theme's design and stylesheet.
if (!isset($content_width))
    $content_width = apply_filters('sunix_content_width', 1170);
function sunix_content_width()
{
    $GLOBALS['content_width'] = apply_filters('sunix_content_width', 1170);
}
add_action('after_setup_theme', 'sunix_content_width', 0);


/**
 * Incudes file
 *
*/
if(!function_exists('sunix_require_folder')){
    function sunix_require_folder($foldername,$path)
    {
        $dir = $path . DIRECTORY_SEPARATOR . $foldername;
        if (!is_dir($dir)) {
            return;
        }
        $files = array_diff(scandir($dir), array('..', '.'));
        foreach ($files as $file) {
            $patch = $dir . DIRECTORY_SEPARATOR . $file;
            if (file_exists($patch) && strpos($file, ".php") !== false) {
                require_once $patch;
            }
        }
    }
}

/**
 * Register widget area.
 */
function sunix_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Main Sidebar', 'sunix'),
        'id'            => 'sidebar-main',
        'description'   => esc_html__('Add widgets here.', 'sunix'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="red-heading h4 widgettitle">',
        'after_title'   => '</div>',
    ));

    if(class_exists('EF5Systems')){
        register_sidebar(array(
            'name'          => esc_html__('Nav Sidebar', 'sunix'),
            'id'            => 'sidebar-nav',
            'description'   => esc_html__('Add widgets here.', 'sunix'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="red-heading h3 widgettitle">',
            'after_title'   => '</div>',
        ));
    }
    if(class_exists('WooCommerce')){
        register_sidebar(array(
            'name'          => esc_html__('Shop Sidebar', 'sunix'),
            'id'            => 'sidebar-shop',
            'description'   => esc_html__('Add widgets here.', 'sunix'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<div class="red-heading h4 widgettitle">',
            'after_title'   => '</div>',
        ));
    }
     register_sidebar(array(
        'name'          => esc_html__('Language Currency Switcher ', 'sunix'),
        'id'            => 'sidebar-language-currency',
        'description'   => esc_html__('Add widgets here.', 'sunix'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="red-heading h3 widgettitle">',
        'after_title'   => '</div>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('Page Sidebar', 'sunix'),
        'id'            => 'sidebar-page',
        'description'   => esc_html__('Add widgets here.', 'sunix'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="red-heading h3 widgettitle">',
        'after_title'   => '</div>',
    ));
}

add_action('widgets_init', 'sunix_widgets_init');
/**
 * Script Debug
 * Add suffix '.min' to scripts file
 *
*/
if(!function_exists('sunix_script_debug')){
    function sunix_script_debug() {
        $suffix   = defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';
        $dev_mode = sunix_get_opts('dev_mode', true);
        if(!$dev_mode) $suffix = '.min';
        return apply_filters( 'sunix_get_dev_mode', $suffix );
    }
}
/**
 * Enqueue scripts and styles.
 */
function sunix_scripts()
{
    $min = sunix_script_debug();
    // Comment
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    // Custom Options
    $filter_reset = function_exists('ef5systems_uri') ? ef5systems_uri() : '';;
    $sunix_ajax_opts = array(
        'ajaxurl'             => admin_url( 'admin-ajax.php' ),
        'primary_color'       => sunix_configs('primary_color'),
        'accent_color'        => sunix_configs('accent_color'),
        'shop_url'            => function_exists('wc_get_page_id') ? get_permalink( wc_get_page_id( 'shop' )) : '',
        'filter_reset'        => ( strpos($filter_reset,'filter_') !== false || strpos($filter_reset,'min_price') !== false || strpos($filter_reset,'max_price') || strpos($filter_reset, 'rating_filter')) ? 'true' : 'false',
        'filter_clear_text' => esc_html__('Clear All', 'sunix')
    );
    // Scripts
    wp_enqueue_script('sunix-theme', get_template_directory_uri() . '/assets/js/theme'.$min.'.js', array('jquery'), '', true);
    wp_localize_script( 'sunix-theme', 'sunix_ajax_opts', $sunix_ajax_opts);
    // Owl Carousel
    wp_register_script('owl-carousel', get_template_directory_uri() . '/assets/libs/owl/owl.carousel'.$min.'.js', array('jquery'), '', true);
    wp_register_script('owl-carousel-theme', get_template_directory_uri() . '/assets/libs/owl/owl.carousel.theme'.$min.'.js', array('owl-carousel'), '', true);
    wp_register_style('owl-carousel', get_template_directory_uri() . '/assets/libs/owl/owl.carousel'.$min.'.css');

    /* Masonry */
    wp_register_script( 'vc_masonry', get_template_directory_uri() . '/assets/libs/masonry/masonry.pkgd.min.js', '','', true );
    /* Isotope */
    wp_register_script( 'isotope', get_template_directory_uri() . '/assets/libs/isotope/isotope.pkgd.min.js', '','', true );

    // magnific-popup
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/libs/magnific-popup/magnific-popup.min.js', array('jquery'), '', true);
    // CounterUp
    wp_register_script('counterup', get_template_directory_uri() . '/assets/libs/counter-up/jquery.counterup'.$min.'.js', array('waypoints'), '1.0.0', true);
    // Date Picker
    wp_register_script('moment-theme', get_template_directory_uri() . '/assets/libs/datepicker/moment-theme'.$min.'.js', array(), '2.9.0', true);
    wp_register_script('bootstrap-datetimepicker', get_template_directory_uri() . '/assets/libs/datepicker/bootstrap-datetimepicker'.$min.'.js', array('moment-theme'), '4.17.47', true);
    wp_register_script('bootstrap-datetimepicker-theme', get_template_directory_uri() . '/assets/libs/datepicker/bootstrap-datetimepicker-theme'.$min.'.js', array('bootstrap-datetimepicker'), '4.17.47', true);
    wp_register_style('bootstrap-datetimepicker', get_template_directory_uri() . '/assets/libs/datepicker/bootstrap-datetimepicker'.$min.'.css');
    // Countdown 
    wp_register_script('countdown', get_template_directory_uri() . '/assets/libs/countdown/jquery-countdown.min.js', array( 'jquery' ), '2.1.0', true);
    wp_register_script('countdown-theme', get_template_directory_uri() . '/assets/libs/countdown/theme-countdown'.$min.'.js', array( 'jquery' ), '2.1.0', true);
    // Zoom Image 
    wp_register_script( 'zoom', get_template_directory_uri() . '/assets/libs/zoom/jquery.zoom'.$min.'.js', array(), '1.7.21', true);
    wp_register_script( 'red-image-zoom', get_template_directory_uri() . '/assets/libs/zoom/theme.zoom'.$min.'.js' , array(
        'jquery',
        'zoom',
    ), '', true );
    // Video
    wp_register_script('red-video', get_template_directory_uri() . '/assets/js/theme.video'.$min.'.js', array( 'jquery' ), '1.0', true);
    // Google Maps
    // AIzaSyCCiVYiUyjDnoO9nC36gYP0sEIU-Ladx3c
    // AIzaSyAAByOm-tGlKaElJ68tmEZFGX6BZ4EyvQI
    $gmapapi = sunix_get_theme_opt('google_api_key','AIzaSyD9ZvNhgXVBQZbncEqhIcUfMN3p_6j1I3s');
    $gmapapi_js = "https://maps.googleapis.com/maps/api/js?key=".$gmapapi;
    wp_register_script('maps-googleapis', $gmapapi_js, array(), '3.0.0', true);
    wp_register_script('red-googlemap', get_template_directory_uri() . '/assets/js/googlemap.js', array('maps-googleapis'), '3.0.0', true);
    
    // WooCommerce Smart Wishlist
    if(class_exists('WPcleverWoosw')){
        add_filter('ef5_remove_scripts', function($scripts){$scripts[] = 'woosw-frontend'; return $scripts;});
        wp_enqueue_script( 'red-woosw-frontend', get_template_directory_uri() . '/inc/extensions/smart-wishlist.js', array( 'jquery' ), '', true );
        wp_localize_script( 'red-woosw-frontend', 'woosw_vars', array(
                'ajax_url'          => admin_url( 'admin-ajax.php' ),
                'menu_action'       => get_option( 'woosw_menu_action', 'open_page' ),
                'popup_content'     => get_option( 'woosw_popup_content', 'list' ),
                'button_text'       => apply_filters( 'woosw_button_text', get_option( 'woosw_button_text', esc_html__( 'Add to Wishlist', 'sunix' ) ) ),
                'button_text_added' => apply_filters( 'woosw_button_text_added', get_option( 'woosw_button_text_added', esc_html__( 'Browse Wishlist', 'sunix' ) ) )
            )
        );
    }
}
add_action('wp_enqueue_scripts', 'sunix_scripts', 0);

function sunix_styles()
{
    $min = sunix_script_debug();
    // font awesome
    wp_enqueue_style('font-awesome5', get_template_directory_uri() . '/assets/fonts/awesome5/css/all.css', '', '5.1.0');
    wp_enqueue_style('font-awesome5-shim', get_template_directory_uri() . '/assets/fonts/awesome5/css/v4-shims.min.css', array('font-awesome5'), '5.1.0');
    // Font FlatIcon
    wp_enqueue_style('font-flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/flaticon.css', '');
    // hint
    wp_enqueue_style('hint', get_template_directory_uri() . '/assets/libs/hint/hint.min.css');
    // magnific-popup
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/libs/magnific-popup/magnific-popup.css');
    // Theme Style
    wp_enqueue_style('sunix', get_template_directory_uri() . '/assets/css/theme'.$min.'.css');
    // Animate
    wp_enqueue_style('animate', get_template_directory_uri() . '/assets/libs/animate/animate.min.css');
}
add_action('wp_enqueue_scripts', 'sunix_styles', 0);

/**
 * Remove all Font Awesome from 3rd extension 
 * to use only font-awesome latest from our theme
*/
add_filter('ef5_remove_styles', 'sunix_remove_styles');
function sunix_remove_styles($styles){
    $_styles = [
        //'font-awesome',
        //'gglcptch',
        'newsletter'
    ];
    $styles = array_merge($styles, $_styles);
    return $styles;
}


/**
 * Register Google Fonts
 *
 * https://gist.github.com/kailoon/e2dc2a04a8bd5034682c
 * https://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 *
*/
function sunix_fonts_url() {
    $fonts_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';
    if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'sunix' ) )
    {
        $fonts[] = 'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i';
    }
    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $fonts ) ),
            'subset' => urlencode( $subsets ),
        ), 'https://fonts.googleapis.com/css' );
    }

    return $fonts_url;

}
function sunix_font_scripts() {
    wp_enqueue_style( 'red-fonts', sunix_fonts_url() );
}
add_action( 'wp_enqueue_scripts', 'sunix_font_scripts' );
/**
 * All Theme Function
*/
sunix_require_folder('inc', get_template_directory());
sunix_require_folder('inc/extends', get_template_directory());
sunix_require_folder('inc/classes', get_template_directory());
sunix_require_folder('inc/walker', get_template_directory());
sunix_require_folder('inc/core', get_template_directory());
sunix_require_folder('inc/functions', get_template_directory());
sunix_require_folder('inc/theme-options', get_template_directory());
sunix_require_folder('inc/custom-post', get_template_directory());

if(function_exists('register_ef5_widget')){
    sunix_require_folder('inc/widgets', get_template_directory());
}

if(class_exists('VC_Manager')){
    sunix_require_folder('vc_extends', get_template_directory());
    sunix_require_folder('vc_extends/icons', get_template_directory());
    
    add_action('vc_after_init', 'sunix_vc_before');
    function sunix_vc_before(){
        sunix_require_folder('vc_elements', get_template_directory());
    }
}

if(class_exists('WooCommerce')){
    sunix_require_folder('inc/woo', get_template_directory());
}
/**
 * Custom Extensions
 * Custom some extension used in theme
 *
*/
sunix_require_folder('inc/extensions', get_template_directory());

// Upload media 
if(!function_exists('sunix_media_support')){
    add_filter('upload_mimes', 'sunix_media_support');
    function sunix_media_support($mimes) {
      $mimes['svg'] = 'image/svg+xml';
      return $mimes;
    }
}
add_action( 'template_redirect', function(){
    ob_start( function( $buffer ){
        $buffer = str_replace( array('t.defer=t.type="text/javascript",', 'type="text/javascript"', "type='text/javascript'", 'type="text/css"', "type='text/css'"), '', $buffer );
        return $buffer;
    });
});