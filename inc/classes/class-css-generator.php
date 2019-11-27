<?php
if ( ! class_exists( 'ReduxFrameworkInstances' ) )
{
    return;
}

class alacarte_CSS_Generator
{
    /**
     * Compiler class instance
     *
     * @access protected
     * @var scssc
     */
    protected $scssc = null;

    /**
     * ReduxFramework class instance
     *
     * @access protected
     * @var ReduxFramework
     */
    protected $redux = null; 
    /**
     * Debug mode is turn on or not
     *
     * @access protected
     * @var boolean
     */
    protected $dev_mode;

    /**
     * opt_name of ReduxFramework
     *
     * @access protected
     * @var string
     */
    protected $opt_name = '';

    /*
     * Theme Color
    */

    /**
     * Constructor
     */
    function __construct()
    {
        $this->opt_name = alacarte_get_theme_opt_name();

        if ( empty( $this->opt_name ) )
        {
            return;
        }
        add_action( 'init', array( $this, 'init' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 20 );
        /* save option generate css */
        add_action("redux/options/{$this->opt_name}/saved", array($this, 'generate_file'));
    }
    /**
     * init hook - 10
     */
    function init()
    {
        if ( ! class_exists( '\Leafo\ScssPhp\Compiler' ) )
        {
            return;
        }
        $this->redux = ReduxFrameworkInstances::get_instance( $this->opt_name );
        if ( empty( $this->redux ) || ! $this->redux instanceof ReduxFramework )
        {
            return;
        }
        $this->dev_mode = alacarte_get_theme_opt('dev_mode', false);

        if ( $this->dev_mode )
        {
            $this->generate_file();
            $this->generate_min_file();
            $this->generate_owl_style();
            $this->generate_hint_style();
            $this->generate_editor_style();
        }
        else
        {
            add_action( "redux/options/{$this->opt_name}/saved", array( $this, 'generate_file' ) );
        }
    }

    /**
     * Generate options and css files
     */
    function generate_file()
    {   
        // Theme
        $scss_dir = get_template_directory() . '/assets/scss/';
        $css_dir  = get_template_directory() . '/assets/css/';
        $css_file = $css_dir . 'theme.css';
        // Child Theme
        $child_scss_dir = get_stylesheet_directory() . '/assets/scss/';
        $child_css_dir  = get_stylesheet_directory() . '/assets/css/';
        $child_css_file = $child_css_dir . 'child-theme.css';

        $this->scssc = new \Leafo\ScssPhp\Compiler();
        $this->scssc->setImportPaths( $scss_dir );

        $_options = $scss_dir . 'options.scss';

        $this->redux->filesystem->execute( 'put_contents', $_options, array(
            'content' => $this->options_output()
        ) );
            
        /**
         * build source map
         * this used for load scss file when dev_mode is on
         * @source: https://github.com/leafo/scssphp/wiki/Source-Maps
        */
        $this->scssc->setSourceMap(\Leafo\ScssPhp\Compiler::SOURCE_MAP_FILE);
        if(is_child_theme()){
            $this->scssc->setSourceMapOptions(array(
                'sourceMapWriteTo'  => $child_css_file . ".map",
                'sourceMapURL'      => "child-theme.css.map",
                'sourceMapFilename' => $child_css_file,
                'sourceMapBasepath' => $child_scss_dir,
                'sourceRoot'        => $child_scss_dir,
            ));
        } else {
            $this->scssc->setSourceMapOptions(array(
                'sourceMapWriteTo'  => $css_file . ".map",
                'sourceMapURL'      => "theme.css.map",
                'sourceMapFilename' => $css_file,
                'sourceMapBasepath' => $scss_dir,
                'sourceRoot'        => $scss_dir,
            ));
        }
        // end build source map
        
        $this->scssc->setFormatter('Leafo\ScssPhp\Formatter\Nested');
        
        $this->redux->filesystem->execute( 'put_contents', $css_file, array(
            'content' => $this->scssc->compile( '@'.'import "theme.scss"' )
        ) );
        if(is_child_theme()){
            $this->redux->filesystem->execute( 'put_contents', $child_css_file, array(
                'content' => $this->scssc->compile( '@'.'import "child-theme.scss"' )
            ) );
        }
    }

    /**
     * Generate options and css files
     */
    function generate_min_file()
    {   
        // Theme
        $scss_dir = get_template_directory() . '/assets/scss/';
        $css_dir  = get_template_directory() . '/assets/css/';
        $css_file = $css_dir . 'theme.min.css';
        // Child Theme
        $child_scss_dir = get_stylesheet_directory() . '/assets/scss/';
        $child_css_dir  = get_stylesheet_directory() . '/assets/css/';
        $child_css_file = $child_css_dir . 'child-theme.min.css';

        $this->scssc = new \Leafo\ScssPhp\Compiler();
        $this->scssc->setImportPaths( $scss_dir );

        $_options = $scss_dir . 'options.scss';

        $this->redux->filesystem->execute( 'put_contents', $_options, array(
            'content' => $this->options_output()
        ) );
        $this->scssc->setFormatter( 'Leafo\ScssPhp\Formatter\Crunched' );
        
        // Theme
        $this->redux->filesystem->execute( 'put_contents', $css_file, array(
            'content' => $this->scssc->compile( '@'.'import "theme.scss"' )
        ) );
        // Child Theme
        if(is_child_theme()){
            $this->redux->filesystem->execute( 'put_contents', $child_css_file, array(
                'content' => $this->scssc->compile( '@'.'import "child-theme.scss"' )
            ) );
        }
    }
    /**
     * Generate OWL css files
     */
    function generate_owl_style()
    {   
        $scss_dir = get_template_directory() . '/assets/scss/owlcarousel/';
        $css_dir  = get_template_directory() . '/assets/libs/owl/';

        $this->scssc = new \Leafo\ScssPhp\Compiler();
        $this->scssc->setImportPaths( $scss_dir );

        $css_file = $css_dir . 'owl.carousel.css';
        $css_file_min = $css_dir . 'owl.carousel.min.css';
        $this->scssc->setFormatter( 'Leafo\ScssPhp\Formatter\Crunched' );
        
        $this->redux->filesystem->execute( 'put_contents', $css_file, array(
            'content' => $this->scssc->compile( '@'.'import "owl.carousel.scss"' )
        ) );

        $this->redux->filesystem->execute( 'put_contents', $css_file_min, array(
            'content' => $this->scssc->compile( '@'.'import "owl.carousel.scss"' )
        ) );
    }
    /**
     * Generate HINT css files
     */
    function generate_hint_style()
    {   
        $scss_dir = get_template_directory() . '/assets/scss/hint/';
        $css_dir  = get_template_directory() . '/assets/libs/hint/';

        $this->scssc = new \Leafo\ScssPhp\Compiler();
        $this->scssc->setImportPaths( $scss_dir );

        $css_file_min = $css_dir . 'hint.min.css';
        $this->scssc->setFormatter( 'Leafo\ScssPhp\Formatter\Crunched' );

        $this->redux->filesystem->execute( 'put_contents', $css_file_min, array(
            'content' => $this->scssc->compile( '@'.'import "hint.scss"' )
        ) );
    }
    /**
     * Generate Editor css files
     */
    function generate_editor_style()
    {   
        $scss_dir = get_template_directory() . '/assets/scss/';
        $css_dir  = get_template_directory() . '/assets/admin/css/';

        $this->scssc = new \Leafo\ScssPhp\Compiler();
        $this->scssc->setImportPaths( $scss_dir );

        $editor_file = $css_dir . 'editor.css';
        $admin_file = $css_dir . 'admin.css';
        $this->scssc->setFormatter( 'Leafo\ScssPhp\Formatter\Crunched' );
        
        $this->redux->filesystem->execute( 'put_contents', $editor_file, array(
            'content' => $this->scssc->compile( '@'.'import "editor.scss"' )
        ) );
        $this->redux->filesystem->execute( 'put_contents', $admin_file, array(
            'content' => $this->scssc->compile( '@'.'import "admin.scss"' )
        ) );
    }
    /**
     * Output options to _variables.scss
     *
     * @access protected
     * @return string
     */
    protected function options_output()
    {
        ob_start();

        $primary_color = alacarte_get_theme_opt( 'primary_color', apply_filters('alacarte_primary_color',alacarte_configs('primary_color')) );
        $accent_color = alacarte_get_theme_opt( 'accent_color', apply_filters('alacarte_accent_color',alacarte_configs('accent_color') ));
        $secondary_color = alacarte_get_theme_opt( 'secondary_color', apply_filters('alacarte_secondary_color',alacarte_configs('secondary_color') ));
        printf( '$primary_color: %s;', esc_attr( $primary_color ) );
        printf( '$accent_color: %s;', esc_attr( $accent_color ) );
        printf( '$secondary_color: %s;', esc_attr( $secondary_color ) );
        // Typography 
        printf( '$BodyBG: %s;', alacarte_configs('body_bg'));
        printf( '$BodyFont: %s;', alacarte_configs('body_font'));
        printf( '$BodyFontSize: %s;', alacarte_configs('body_font_size'));
        printf( '$BodyLineHeight: %s;',alacarte_configs('body_line_height'));
        printf( '$BodyFontSizeL: %s;', alacarte_configs('body_font_size_large'));
        printf( '$BodyFontSizeM: %s;', alacarte_configs('body_font_size_medium'));
        printf( '$BodyFontSizeS: %s;', alacarte_configs('body_font_size_small'));
        printf( '$BodyFontSizeXS: %s;', alacarte_configs('body_font_size_xsmall'));
        printf( '$BodyFontSizeXXS: %s;', alacarte_configs('body_font_size_xxsmall'));
        printf( '$BodyColor: %s;', alacarte_configs('body_font_color'));
        printf( '$H1Size: %s;', alacarte_configs('h1_size'));
        printf( '$H2Size: %s;', alacarte_configs('h2_size'));
        printf( '$H3Size: %s;', alacarte_configs('h3_size'));
        printf( '$H4Size: %s;', alacarte_configs('h4_size'));
        printf( '$H5Size: %s;', alacarte_configs('h5_size'));
        printf( '$H6Size: %s;', alacarte_configs('h6_size'));
        printf( '$HeadingFont: %s;', alacarte_configs('heading_font'));
        printf( '$HeadingColor: %s;', alacarte_configs('heading_color'));
        printf( '$HeadingColorHover: %s;', alacarte_configs('heading_color_hover'));
        printf( '$HeadingFontW: %s;', alacarte_configs('heading_font_weight'));
        printf( '$MetaFont : %s;', alacarte_configs('meta_font'));
        printf( '$MetaColor: %s;', alacarte_configs('meta_color'));
        printf( '$MetaColorHover: %s;', alacarte_configs('meta_color_hover'));
        // Border
        printf( '$MainBorder: %s;', alacarte_configs('main_border'));
        printf( '$MainBorder2: %s;', alacarte_configs('main_border2'));
        printf( '$MainBorderColor: %s;', alacarte_configs('main_border_color'));
        // Comments
        printf( '$cmt_avatar_size: %s;', alacarte_configs('cmt_avatar_size'));
        printf( '$cmt_border: %s;', alacarte_configs('cmt_border'));

        /*height*/

        $header_height = alacarte_get_theme_opt('header_height', ['height' => apply_filters('alacarte_header_height',alacarte_configs('header_height'))] );
        if ($header_height['height'] === 'px'){
            printf('$header_height: %s;', alacarte_configs('header_height'));
        }
        else{
            printf('$header_height: %s;', esc_attr($header_height['height']));
        }

        /* Header side width */
        $header_sidewidth = alacarte_get_theme_opt('header_sidewidth',['width' => apply_filters('alacarte_header_sidewidth',alacarte_configs('header_sidewidth'))]);
        printf('$header_sidewidth: %s;', esc_attr($header_sidewidth['width']));

        /* Default Header Color */
        $header_link_color = alacarte_get_theme_opt('header_link_colors',apply_filters('alacarte_header_link_color', ['regular' => $accent_color, 'hover' => $primary_color, 'active' => $primary_color]) );
        printf( '$header_regular: %s;', esc_attr( $header_link_color['regular'] ) );
        printf( '$header_hover: %s;', esc_attr( $header_link_color['hover'] ) );
        printf( '$header_active: %s;', esc_attr( $header_link_color['active'] ) );

        /* Ontop Header Color */
        $ontop_link_color = alacarte_get_theme_opt('ontop_link_colors', apply_filters('alacarte_ontop_link_color', ['regular' => '#FFFFFF', 'hover' => $accent_color, 'active' => $accent_color]) );
        printf( '$ontop_regular: %s;', esc_attr( $ontop_link_color['regular'] ) );
        printf( '$ontop_hover: %s;', esc_attr( $ontop_link_color['hover'] ) );
        printf( '$ontop_active: %s;', esc_attr( $ontop_link_color['active'] ) );

        /* Sticky Header Color */
        $sticky_link_color = alacarte_get_theme_opt('sticky_link_colors',apply_filters('alacarte_sticky_link_color',['regular' => '#FFFFFF', 'hover' => $accent_color, 'active' => $accent_color]));
        printf( '$sticky_regular: %s;', esc_attr( $sticky_link_color['regular'] ) );
        printf( '$sticky_hover: %s;', esc_attr( $sticky_link_color['hover'] ) );
        printf( '$sticky_active: %s;', esc_attr( $sticky_link_color['active'] ) );

        /* Dropdown && Mobile */
        $dropdown_bg_opt = alacarte_get_theme_opt('dropdown_bg',['rgba' => apply_filters('alacarte_dropdown_bg', alacarte_configs('dropdown_bg'))]);
        printf('$dropdown_bg: %s;', esc_attr($dropdown_bg_opt['rgba']));
        $dropdown_link_colors = alacarte_get_theme_opt('dropdown_link_colors', apply_filters('alacarte_dropdown_link_colors',['regular' => '#111', 'hover' => $primary_color, 'active' => $primary_color]) );
        printf( '$dropdown_regular: %s;', esc_attr( $dropdown_link_colors['regular'] ) );
        printf( '$dropdown_hover: %s;', esc_attr( $dropdown_link_colors['hover'] ) );
        printf( '$dropdown_active: %s;', esc_attr( $dropdown_link_colors['active'] ) );

        /* Side Header Width */

        /* WooCommerce */
        printf( '$alacarte_product_single_image_w: %s;', alacarte_configs('alacarte_product_single_image_w') );
        printf( '$alacarte_product_single_image_h: %s;', alacarte_configs('alacarte_product_single_image_h') );
        
        printf( '$alacarte_product_loop_image_w: %s;', alacarte_configs('alacarte_product_loop_image_w') );
        printf( '$alacarte_product_loop_image_h: %s;', alacarte_configs('alacarte_product_loop_image_h') );

        printf( '$alacarte_product_gallery_thumbnail_w: %s;', alacarte_configs('alacarte_product_gallery_thumbnail_w') );
        printf( '$alacarte_product_gallery_thumbnail_h: %s;', alacarte_configs('alacarte_product_gallery_thumbnail_h') );

        printf( '$alacarte_product_gallery_thumbnail_v_w: %s;', alacarte_configs('alacarte_product_gallery_thumbnail_v_w') );
        printf( '$alacarte_gallery_thumbnail_v_h: %s;', alacarte_configs('alacarte_product_gallery_thumbnail_v_h') );

        printf( '$alacarte_gallery_thumbnail_h_w: %s;', alacarte_configs('alacarte_product_gallery_thumbnail_h_w') );
        printf( '$alacarte_gallery_thumbnail_h_h: %s;', alacarte_configs('alacarte_product_gallery_thumbnail_h_h') );

        printf( '$alacarte_product_gallery_thumbnail_space: %s;', alacarte_configs('alacarte_product_gallery_thumbnail_space') );


        return ob_get_clean();
    }

    /**
     * Hooked wp_enqueue_scripts - 20
     * Make sure that the handle is enqueued from earlier wp_enqueue_scripts hook.
     */
    function enqueue()
    {
        $css = $this->inline_css();

        if ( $css )
        {
            wp_add_inline_style( 'alacarte', $css );
        }
    }

    /**
     * Generate inline css based on theme options
     */
    protected function inline_css()
    {
        ob_start();
        $primary_color = alacarte_get_theme_opt( 'primary_color', apply_filters('alacarte_primary_color', alacarte_configs('primary_color')) );
        $accent_color  = alacarte_get_theme_opt( 'accent_color', apply_filters('alacarte_accent_color', alacarte_configs('accent_color')) );
        // Menu links color for options page
        //--------------------------------------------------
        $body_padding = alacarte_get_page_opt( 'site_bordered_w', ['padding-top' => '', 'padding-right' => '', 'padding-bottom' => '','padding-left' => ''] );
        if(!empty( $body_padding['padding-top'])){

             printf(
                 '.site-bordered{
                   padding-top: %s;
                }',
                 esc_attr($body_padding['padding-top'])
             );
        }
        if(!empty( $body_padding['padding-right'])){

             printf(
                 '.site-bordered{
                   padding-right: %s;
                }',
                 esc_attr($body_padding['padding-right'])
             );
        }
        if(!empty( $body_padding['padding-bottom'])){

             printf(
                 '.site-bordered{
                   padding-bottom: %s;
                }',
                 esc_attr($body_padding['padding-bottom'])
             );
        }
        if(!empty( $body_padding['padding-left'])){

             printf(
                 '.site-bordered{
                   padding-left: %s;
                }',
                 esc_attr($body_padding['padding-left'])
             );
        }
        $header_link_colors = alacarte_get_page_opt( 'header_link_colors', ['regular' => '', 'hover' => '', 'active' => ''] );
        // menu regular
        if(!empty($header_link_colors['regular'])){
            printf(
                '.menu-default > li > a,
                .header-default a{
                    color: %s!important;
                }',
                esc_attr($header_link_colors['regular'])
            );
            printf(
                '.header-default a:hover{
                    color: %s!important;
                }',
                esc_attr($header_link_colors['hover'])
            );
            printf(
                '.header-default a:active,
                .header-default a.active{
                    color: %s!important;
                }',
                esc_attr($header_link_colors['active'])
            );
            // Mobile Menu Icon
            printf(
                '.header-default .btn-nav-mobile:before, 
                .header-default .btn-nav-mobile:after, 
                .header-default .btn-nav-mobile span{
                    background-color: %s!important;
                }',
                esc_attr($header_link_colors['regular'])
            );
            printf(
                '.header-default .btn-nav-mobile:hover:before, 
                .header-default .btn-nav-mobile:hover:after, 
                .header-default .btn-nav-mobile:hover span{
                    background-color: %s!important;
                }',
                esc_attr($header_link_colors['hover'])
            );
        }
        // menu hover
        if(!empty($header_link_colors['hover'])){
            printf(
                '.menu-default > li:hover > a,
                .menu-default > li:focus > a,
                .menu-default a:hover,
                .menu-default a:focus {
                    color: %s!important;
                }',
                esc_attr($header_link_colors['hover'])
            );
            printf(
                '.menu-default > li:hover > a:after,
                .menu-default > li:focus > a:after {
                    background-color: %s!important;
                }',
                esc_attr($header_link_colors['hover'])
            );
        }
        // menu active
        if(!empty($header_link_colors['active'])){
            printf(
                '.menu-default li.current_page_item > a,
                .menu-default li.current-menu-item > a,
                .menu-default li.current_page_ancestor > a,
                .menu-default li.current-menu-ancestor > a,
                .menu-default a:active {
                    color: %s!important;
                }',
                esc_attr($header_link_colors['active'])
            );
            printf(
                '.menu-default li.current_page_item > a:after,
                .menu-default li.current-menu-item > a:after,
                .menu-default li.current_page_ancestor > a:after,
                .menu-default li.current-menu-ancestor > a:after {
                    background-color: %s!important;
                }',
                esc_attr($header_link_colors['active'])
            );
        }
        // OnTop Menu
        $ontop_link_colors = alacarte_get_page_opt( 'ontop_link_colors', ['regular' => '', 'hover' => '', 'active' => ''] );
        // menu regular
        if(!empty($ontop_link_colors['regular'])){
            printf(
                '.menu-ontop > li > a,.header-ontop .btn-nav-mobile{
                    color: %s!important;
                }',
                esc_attr($ontop_link_colors['regular'])
            );
            printf(
                '.header-ontop .btn-nav-mobile:before, .header-ontop .btn-nav-mobile:after, .header-ontop .btn-nav-mobile span{
                   background: %s!important;
                }',
                esc_attr($ontop_link_colors['regular'])
            );
        }
        // menu hover
        if(!empty($ontop_link_colors['hover'])){
            printf(
                '.menu-ontop > li:hover > a,
                .menu-ontop > li:focus > a,
                .menu-ontop a:hover,
                .header-ontop .btn-nav-mobile:hover,
                .menu-ontop a:focus {
                    color: %s!important;
                }',
                esc_attr($ontop_link_colors['hover'])
            );
            printf(
                '.menu-ontop > li:hover > a:after,
                .menu-ontop > li:focus > a:after,
                 .header-ontop .btn-nav-mobile:before, .header-ontop .btn-nav-mobile:after, .header-ontop .btn-nav-mobile span{
                    background-color: %s!important;
                }',
                esc_attr($ontop_link_colors['hover'])
            );
        }
        // menu active
        if(!empty($ontop_link_colors['active'])){
            printf(
                '.menu-ontop li.current_page_item > a,
                .menu-ontop li.current-menu-item > a,
                .menu-ontop li.current_page_ancestor > a,
                .menu-ontop li.current-menu-ancestor > a,
                .menu-ontop a:active,
                 .header-ontop .btn-nav-mobile.opened{
                    color: %s!important;
                }',
                esc_attr($ontop_link_colors['active'])
            );
            printf(
                '.menu-ontop li.current_page_item > a:after,
                .menu-ontop li.current-menu-item > a:after,
                .menu-ontop li.current_page_ancestor > a:after,
                .menu-ontop li.current-menu-ancestor > a:after,
                 .header-ontop .btn-nav-mobile:before, .header-ontop .btn-nav-mobile:after, .header-ontop .btn-nav-mobile span.opened{
                    background-color: %s!important;
                }',
                esc_attr($ontop_link_colors['active'])
            );
        }
        /*header height*/
        $header_height = alacarte_get_theme_opt('header_height', ['height' => apply_filters('alacarte_header_height',alacarte_configs('header_height'))] );
        $header_height_page = alacarte_get_page_opt('header_height', ['height' => apply_filters('alacarte_header_height',alacarte_configs('header_height'))] );
        if ($header_height_page['height'] !== 'px'){
            $header_height  = $header_height_page;
        }
        if (($header_height['height'] !== 'px') && $header_height['height'] !== ''){
            echo '@media (min-width: 1200px){';
            printf(
                '.red-header-menu > li > a{
                        height: %s;
                    }', esc_attr($header_height['height'])
            );
            echo '}';
        }
        /**
         * Header side menu 
         *
        */
        $header_sidewidth = alacarte_get_theme_opt('header_sidewidth', ['width' => ''] );
        $header_sidewidth_page = alacarte_get_page_opt('header_sidewidth', ['width' => ''] );
        if($header_sidewidth_page['width'] !== 'px' && $header_sidewidth_page['width'] !== $header_sidewidth['width']){
            $header_sidewidth['width'] = $header_sidewidth_page['width'];
        }
        if('' !== $header_sidewidth['width'] && 'px' !== $header_sidewidth['width']){
            echo '@media (min-width: 1200px){';
                printf(
                    'body.header-3:not(.side-header-ontop){
                        padding-%s: %s !important;
                    }', alacarte_align(), esc_attr($header_sidewidth['width'])
                );
                //  Header side menu width
                printf(
                    '.side-header{
                        width: %s !important;
                    }', esc_attr($header_sidewidth['width'])
                );
                //  Fix loading position
                printf(
                    'body.header-3 #red-loading{
                        margin-%s: calc(%s / -2) !important;
                    }', alacarte_align(), esc_attr($header_sidewidth['width'])
                );
            echo '}';
        }

        return ob_get_clean();
    }
}

new alacarte_CSS_Generator();