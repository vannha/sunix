<?php
function sunix_page_options_register($metabox)
{
    
    if (!$metabox->isset_args('page')) {
        $metabox->set_args('page', array(
            'opt_name'     => sunix_get_page_opt_name(),
            'display_name' => esc_html__('Page Settings', 'sunix'),
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    $metabox->add_section('page', array(
        'title'  => esc_html__('General', 'sunix'),
        'desc'   => esc_html__('General settings for the page.', 'sunix'),
        'icon'   => 'el-icon-home',
        'fields' => array_merge(
            array(
                array(
                    'title'     => esc_html__('Padding Content', 'sunix'),
                    'subtitle'  => esc_html__('Choose space for: Top, Right, Bottom, Left', 'sunix'),
                    'id'        => 'main_padding',
                    'type'      => 'spacing',
                    'mode'      => 'padding',
                    'units'     => array('px'),
                    'default'   => array(),
                    'output'    => array('.red-main')
                ),
                array(
                    'id'       => 'page_overlay_hidden',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Page Overlay Hidden', 'sunix'),
                    'options'  => array(
                        '1'     => esc_html__('Yes', 'sunix'),
                        '0'   => esc_html__('No', 'sunix'),

                    ),
                    'default'  => '1'
                ),
                array(
                    'id'          => 'primary_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Primary Color', 'sunix'),
                    'transparent' => false,
                    'output'      => array(
                        'background-color' => '
                                            .bg-primary, .red-bg-primary,
                                            .red-btn.primary.fill,
                                            .hover-bg-primary, 
                                            .active-bg-primary,
                                            .red-process-step .step-number,
                                            .red-bg-medium-dark',
                        'color'            => '.red-heading, .text-primary'
                    )  
                ),
                array(
                    'id'          => 'accent_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Accent Color', 'sunix'),
                    'transparent' => false,
                    'output'      => array(
                        'background-color' => '.header-icon .header-count, 
                                                .bg-accent, .red-bg-accent,
                                                .red-bg-accent2,
                                                .red-btn.accent.fill,
                                                .hover-bg-accent, 
                                                .active-bg-accent, 
                                                .red-fancybox-8 .red-fancybox-icon,
                                                .red-filters-3 .filter-item.active,
                                                .red-filters-3 .filter-item:hover,
                                                .vc_progress_bar.layout-1 .vc_single_bar .vc_bar, 
                                                .vc_progress_bar.layout-2 .vc_single_bar .vc_bar, 
                                                .minimal.red-newsletter-5 .tnp-form:after,
                                                .minimal.red-newsletter-6 .tnp-form:after,
                                                .red-heading-3 .divider,
                                                .red-anim-wave .red-wave.wave2,
                                                .red-anim-wave .red-wave.wave3,
                                                form .button, 
                                                form button, 
                                                form [type="button"], 
                                                form [type="reset"], 
                                                form [type="submit"],
                                                .red-box-meta2 a,
                                                .red-toggle .red-toggle-inner:before,
                                                .red-toggle .red-toggle-inner:after,
                                                .sunix-Primary-Button-Large,
                                                .rev_slider .tp-bannertimer', 
                        'color'            => '.text-accent,
                                                .accent-color,
                                                a:hover,
                                                h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .h1 a:hover, .h2 a:hover, .h3 a:hover, .h4 a:hover, .h4-1 a:hover, .h5 a:hover, .h6 a:hover, .red-heading a:hover,
                                                .red-heading-7 .small-heading.no-divider,
                                                .ttmn-rate,
                                                .red-video-4 .small-heading,
                                                .red-testimonial-layout-2 .ttmn-info:before,
                                                .megamenu .widgettitle',
                        'border-color'     => '.red-testimonial-layout-3 .ttmn-info,
                                                .red-testimonial-layout-3-1 .ttmn-info,
                                                .red-box-meta2 a',
                        'border-left-color' => '.mceContentBody ul.red-list.triangle.accent li:before,
                                                .red-single-content ul.red-list.triangle.accent li:before,
                                                .wpb_text_column ul.red-list.triangle.accent li:before',
                        'border-right-color' => '[dir="rtl"] .mceContentBody ul.red-list.triangle.accent li:before,
                                                [dir="rtl"] .red-single-content ul.red-list.triangle.accent li:before,
                                                [dir="rtl"] .wpb_text_column ul.red-list.triangle.accent li:before',
                        'fill'             => 'svg path'
                    )
                ),
            ),
            sunix_page_opts(true),
            sunix_general_opts(['default' => true])
        )
    ));
    $metabox->add_section('page', array(
        'title'  => esc_html__('Header Top', 'sunix'),
        'desc'   => esc_html__('Header Top settings for the page.', 'sunix'),
        'icon'   => 'el-icon-website',
        'fields' => array_merge(
            sunix_header_top_opts(['default' => true])
        )
    ));
    $metabox->add_section('page', array(
        'title'  => esc_html__('Header', 'sunix'),
        'desc'   => esc_html__('Header settings for the page.', 'sunix'),
        'icon'   => 'el-icon-website',
        'fields' => array_merge(
            sunix_header_opts(['default' => true]),
            sunix_header_atts(true)
        )
    ));
    // Logo 
    $metabox->add_section('page', array(
        'title'      => esc_html__('Logo', 'sunix'),
        'icon'       => 'el-icon-picture',
        'subsection' => 'true',
        'fields'     => array(
            array(
                'id'             => 'page_logo',
                'type'           => 'media',
                'library_filter' => array('gif','jpg','jpeg','png','svg'),
                'title'          => esc_html__('Logo', 'sunix'),
                'subtitle'       => esc_html__('Choose your logo. If not set, default Logo will be used', 'sunix')
            ),
            array(
                'id'       => 'logo_size',
                'type'     => 'dimensions',
                'title'    => esc_html__('Logo Size', 'sunix'),
                'subtitle' => esc_html__('Enter size (width x height) for your logo, just in case the logo is too large. If not set, default size will be used', 'sunix'),
                'units'     => array('px'),
                'default'   => array(),
            ),
        )
    )

    );
    // Ontop Header
    $metabox->add_section('page', sunix_ontop_header_opts(['default' => true,'subsection' => false]));

    $metabox->add_section('page', array(
        'title'  => esc_html__('Page Title', 'sunix'),
        'desc'   => esc_html__('Settings for page header area.', 'sunix'),
        'icon'   => 'el-icon-map-marker',
        'fields' => sunix_page_title_opts(['default' => true])
    ));

    $metabox->add_section('page', sunix_footer_opts(['default' => true]));

    /* Config Post Options */
    if (!$metabox->isset_args('post')) {
        $metabox->set_args('post', array(
            'opt_name'     => sunix_get_page_opt_name(),
            'display_name' => esc_html__('Post Settings', 'sunix'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default',
            'panels'   => true
        ));
    }

    $metabox->add_section('post', array(
        'title'  => esc_html__('General', 'sunix'),
        'desc'   => esc_html__('General settings for this post.', 'sunix'),
        'icon'   => 'el-icon-home',
        'fields' => array_merge(
            array(
                array(
                    'id'       => 'post_sidebar_pos',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Layouts', 'sunix'),
                    'subtitle' => esc_html__('select a layout for single...', 'sunix'),
                    'options'  => array(
                        '-1'     => esc_html__('Default', 'sunix'),
                        'left'   => esc_html__('Left Sidebar', 'sunix'),
                        'right'  => esc_html__('Right Sidebar', 'sunix'),
                        'none'   => esc_html__('No sidebar (Full)', 'sunix'),
                        'center' => esc_html__('No sidebar (Center)', 'sunix')
                    ),
                    'default'  => '-1'
                )
            )
        )
    ));


    /**
     * Config post format meta options
     *
    */
    if (!$metabox->isset_args('ef5_pf_audio')) {
        $metabox->set_args('ef5_pf_audio', array(
            'opt_name'     => 'post_format_audio',
            'display_name' => esc_html__('Audio', 'sunix'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_link')) {
        $metabox->set_args('ef5_pf_link', array(
            'opt_name'     => 'post_format_link',
            'display_name' => esc_html__('Link', 'sunix'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_quote')) {
        $metabox->set_args('ef5_pf_quote', array(
            'opt_name'     => 'post_format_quote',
            'display_name' => esc_html__('Quote', 'sunix'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_video')) {
        $metabox->set_args('ef5_pf_video', array(
            'opt_name'     => 'post_format_video',
            'display_name' => esc_html__('Video', 'sunix'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_gallery')) {
        $metabox->set_args('ef5_pf_gallery', array(
            'opt_name'     => 'post_format_gallery',
            'display_name' => esc_html__('Gallery', 'sunix'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }
    $metabox->add_section('ef5_pf_video', array(
        'title'  => esc_html__('Video', 'sunix'),
        'fields' => array(
            array(
                'id'    => 'post-video-url',
                'type'  => 'text',
                'title' => esc_html__( 'Video URL', 'sunix' ),
                'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'sunix' )
            ),

            array(
                'id'             => 'post-video-file',
                'type'           => 'media',
                'library_filter' => array('mp4','m4v','wmv','avi','mpg','ogv','3gp','3g2','ogg','mine'),
                'title'          => esc_html__( 'Video Upload', 'sunix' ),
                'desc'           => esc_html__( 'Upload or Choose video file', 'sunix' ),
                'url'            => true                       
            ),

            array(
                'id'        => 'post-video-html',
                'type'      => 'textarea',
                'title'     => esc_html__( 'Embadded video', 'sunix' ),
                'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo', 'sunix' )
            )
        )
    ));

    $metabox->add_section('ef5_pf_gallery', array(
        'title'  => esc_html__('Gallery', 'sunix'),
        'fields' => array(
            array(
                'id'       => 'post-gallery-lightbox',
                'type'     => 'switch',
                'title'    => esc_html__('Lightbox?', 'sunix'),
                'subtitle' => esc_html__('Enable lightbox for gallery images.', 'sunix'),
                'default'  => true
            ),
            array(
                'id'          => 'post-gallery-images',
                'type'        => 'gallery',
                'title'       => esc_html__('Gallery Images ', 'sunix'),
                'subtitle'    => esc_html__('Upload images or add from media library.', 'sunix')
            )
        )
    ));

    $metabox->add_section('ef5_pf_audio', array(
        'title'  => esc_html__('Audio', 'sunix'),
        'fields' => array(
            array(
                'id'       => 'post-audio-url',
                'type'     => 'text',
                'title'    => esc_html__('Audio URL', 'sunix'),
                'description' => esc_html__('Audio file URL in format: mp3, ogg, wav.','sunix'),
                'validate' => 'url',
                'msg'      => 'Url error!'
            ),
            array(
                'id'             => 'post-audio-file',
                'type'           => 'media',
                'library_filter' => array('mp3','m4a','ogg','wav'),
                'title'          => esc_html__( 'Add a audio', 'sunix' ),
                'desc'           => esc_html__( 'Upload or Choose audio file', 'sunix' ),
            ),
        )
    ));

    $metabox->add_section('ef5_pf_link', array(
        'title'  => esc_html__('Link', 'sunix'),
        'fields' => array(
            array(
                'id'       => 'post-link-title',
                'type'     => 'text',
                'title'    => esc_html__('Title', 'sunix'),
            ),
            array(
                'id'       => 'post-link-url',
                'type'     => 'text',
                'title'    => esc_html__('URL', 'sunix'),
                'validate' => 'url',
                'msg'      => 'Url error!'
            )
        )
    ));

    $metabox->add_section('ef5_pf_quote', array(
        'title'  => esc_html__('Quote', 'sunix'),
        'fields' => array(
            array(
                'id'       => 'post-quote-text',
                'type'     => 'textarea',
                'title'    => esc_html__('Quote Text', 'sunix')
            ),
            array(
                'id'       => 'post-quote-cite',
                'type'     => 'text',
                'title'    => esc_html__('Cite', 'sunix')
            )
        )
    ));
}
add_action('ef5_post_metabox_register', 'sunix_page_options_register');