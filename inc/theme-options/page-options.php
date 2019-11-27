<?php
function alacarte_page_options_register($metabox)
{
    
    if (!$metabox->isset_args('page')) {
        $metabox->set_args('page', array(
            'opt_name'     => alacarte_get_page_opt_name(),
            'display_name' => esc_html__('Page Settings', 'alacarte'),
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    $metabox->add_section('page', array(
        'title'  => esc_html__('General', 'alacarte'),
        'desc'   => esc_html__('General settings for the page.', 'alacarte'),
        'icon'   => 'el-icon-home',
        'fields' => array_merge(
            array(
                array(
                    'title'     => esc_html__('Padding Content', 'alacarte'),
                    'subtitle'  => esc_html__('Choose space for: Top, Right, Bottom, Left', 'alacarte'),
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
                    'title'    => esc_html__('Page Overlay Hidden', 'alacarte'),
                    'options'  => array(
                        '1'     => esc_html__('Yes', 'alacarte'),
                        '0'   => esc_html__('No', 'alacarte'),

                    ),
                    'default'  => '1'
                ),
                array(
                    'id'          => 'primary_color',
                    'type'        => 'color',
                    'title'       => esc_html__('Primary Color', 'alacarte'),
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
                    'title'       => esc_html__('Accent Color', 'alacarte'),
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
                                                .AlaCarte-Primary-Button-Large,
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
            alacarte_page_opts(true),
            alacarte_general_opts(['default' => true])
        )
    ));
    $metabox->add_section('page', array(
        'title'  => esc_html__('Header Top', 'alacarte'),
        'desc'   => esc_html__('Header Top settings for the page.', 'alacarte'),
        'icon'   => 'el-icon-website',
        'fields' => array_merge(
            alacarte_header_top_opts(['default' => true])
        )
    ));
    $metabox->add_section('page', array(
        'title'  => esc_html__('Header', 'alacarte'),
        'desc'   => esc_html__('Header settings for the page.', 'alacarte'),
        'icon'   => 'el-icon-website',
        'fields' => array_merge(
            alacarte_header_opts(['default' => true]),
            alacarte_header_atts(true)
        )
    ));
    // Logo 
    $metabox->add_section('page', array(
        'title'      => esc_html__('Logo', 'alacarte'),
        'icon'       => 'el-icon-picture',
        'subsection' => 'true',
        'fields'     => array(
            array(
                'id'             => 'page_logo',
                'type'           => 'media',
                'library_filter' => array('gif','jpg','jpeg','png','svg'),
                'title'          => esc_html__('Logo', 'alacarte'),
                'subtitle'       => esc_html__('Choose your logo. If not set, default Logo will be used', 'alacarte')
            ),
            array(
                'id'       => 'logo_size',
                'type'     => 'dimensions',
                'title'    => esc_html__('Logo Size', 'alacarte'),
                'subtitle' => esc_html__('Enter size (width x height) for your logo, just in case the logo is too large. If not set, default size will be used', 'alacarte'),
                'units'     => array('px'),
                'default'   => array(),
            ),
        )
    )

    );
    // Ontop Header
    $metabox->add_section('page', alacarte_ontop_header_opts(['default' => true,'subsection' => false]));

    $metabox->add_section('page', array(
        'title'  => esc_html__('Page Title', 'alacarte'),
        'desc'   => esc_html__('Settings for page header area.', 'alacarte'),
        'icon'   => 'el-icon-map-marker',
        'fields' => alacarte_page_title_opts(['default' => true])
    ));

    $metabox->add_section('page', alacarte_footer_opts(['default' => true]));

    /* Config Post Options */
    if (!$metabox->isset_args('post')) {
        $metabox->set_args('post', array(
            'opt_name'     => alacarte_get_page_opt_name(),
            'display_name' => esc_html__('Post Settings', 'alacarte'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default',
            'panels'   => true
        ));
    }

    $metabox->add_section('post', array(
        'title'  => esc_html__('General', 'alacarte'),
        'desc'   => esc_html__('General settings for this post.', 'alacarte'),
        'icon'   => 'el-icon-home',
        'fields' => array_merge(
            array(
                array(
                    'id'       => 'post_sidebar_pos',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Layouts', 'alacarte'),
                    'subtitle' => esc_html__('select a layout for single...', 'alacarte'),
                    'options'  => array(
                        '-1'     => esc_html__('Default', 'alacarte'),
                        'left'   => esc_html__('Left Sidebar', 'alacarte'),
                        'right'  => esc_html__('Right Sidebar', 'alacarte'),
                        'none'   => esc_html__('No sidebar (Full)', 'alacarte'),
                        'center' => esc_html__('No sidebar (Center)', 'alacarte')
                    ),
                    'default'  => '-1'
                )
            )
        )
    ));
    $metabox->add_section('post', array(
        'title'  => esc_html__('Post Title', 'alacarte'),
        'desc'   => esc_html__('Settings for page header area.', 'alacarte'),
        'icon'   => 'el-icon-map-marker',
        'fields' => alacarte_page_title_opts(['default' => true])
    ));

    /**
     * Config post format meta options
     *
    */
    if (!$metabox->isset_args('ef5_pf_audio')) {
        $metabox->set_args('ef5_pf_audio', array(
            'opt_name'     => 'post_format_audio',
            'display_name' => esc_html__('Audio', 'alacarte'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_link')) {
        $metabox->set_args('ef5_pf_link', array(
            'opt_name'     => 'post_format_link',
            'display_name' => esc_html__('Link', 'alacarte'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_quote')) {
        $metabox->set_args('ef5_pf_quote', array(
            'opt_name'     => 'post_format_quote',
            'display_name' => esc_html__('Quote', 'alacarte'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_video')) {
        $metabox->set_args('ef5_pf_video', array(
            'opt_name'     => 'post_format_video',
            'display_name' => esc_html__('Video', 'alacarte'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }

    if (!$metabox->isset_args('ef5_pf_gallery')) {
        $metabox->set_args('ef5_pf_gallery', array(
            'opt_name'     => 'post_format_gallery',
            'display_name' => esc_html__('Gallery', 'alacarte'),
            'class'        => 'fully-expanded'
        ), array(
            'context'  => 'advanced',
            'priority' => 'default'
        ));
    }
    $metabox->add_section('ef5_pf_video', array(
        'title'  => esc_html__('Video', 'alacarte'),
        'fields' => array(
            array(
                'id'    => 'post-video-url',
                'type'  => 'text',
                'title' => esc_html__( 'Video URL', 'alacarte' ),
                'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'alacarte' )
            ),

            array(
                'id'             => 'post-video-file',
                'type'           => 'media',
                'library_filter' => array('mp4','m4v','wmv','avi','mpg','ogv','3gp','3g2','ogg','mine'),
                'title'          => esc_html__( 'Video Upload', 'alacarte' ),
                'desc'           => esc_html__( 'Upload or Choose video file', 'alacarte' ),
                'url'            => true                       
            ),

            array(
                'id'        => 'post-video-html',
                'type'      => 'textarea',
                'title'     => esc_html__( 'Embadded video', 'alacarte' ),
                'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo', 'alacarte' )
            )
        )
    ));

    $metabox->add_section('ef5_pf_gallery', array(
        'title'  => esc_html__('Gallery', 'alacarte'),
        'fields' => array(
            array(
                'id'       => 'post-gallery-lightbox',
                'type'     => 'switch',
                'title'    => esc_html__('Lightbox?', 'alacarte'),
                'subtitle' => esc_html__('Enable lightbox for gallery images.', 'alacarte'),
                'default'  => true
            ),
            array(
                'id'          => 'post-gallery-images',
                'type'        => 'gallery',
                'title'       => esc_html__('Gallery Images ', 'alacarte'),
                'subtitle'    => esc_html__('Upload images or add from media library.', 'alacarte')
            )
        )
    ));

    $metabox->add_section('ef5_pf_audio', array(
        'title'  => esc_html__('Audio', 'alacarte'),
        'fields' => array(
            array(
                'id'       => 'post-audio-url',
                'type'     => 'text',
                'title'    => esc_html__('Audio URL', 'alacarte'),
                'description' => esc_html__('Audio file URL in format: mp3, ogg, wav.','alacarte'),
                'validate' => 'url',
                'msg'      => 'Url error!'
            ),
            array(
                'id'             => 'post-audio-file',
                'type'           => 'media',
                'library_filter' => array('mp3','m4a','ogg','wav'),
                'title'          => esc_html__( 'Add a audio', 'alacarte' ),
                'desc'           => esc_html__( 'Upload or Choose audio file', 'alacarte' ),
            ),
        )
    ));

    $metabox->add_section('ef5_pf_link', array(
        'title'  => esc_html__('Link', 'alacarte'),
        'fields' => array(
            array(
                'id'       => 'post-link-title',
                'type'     => 'text',
                'title'    => esc_html__('Title', 'alacarte'),
            ),
            array(
                'id'       => 'post-link-url',
                'type'     => 'text',
                'title'    => esc_html__('URL', 'alacarte'),
                'validate' => 'url',
                'msg'      => 'Url error!'
            )
        )
    ));

    $metabox->add_section('ef5_pf_quote', array(
        'title'  => esc_html__('Quote', 'alacarte'),
        'fields' => array(
            array(
                'id'       => 'post-quote-text',
                'type'     => 'textarea',
                'title'    => esc_html__('Quote Text', 'alacarte')
            ),
            array(
                'id'       => 'post-quote-cite',
                'type'     => 'text',
                'title'    => esc_html__('Cite', 'alacarte')
            )
        )
    ));
}
add_action('ef5_post_metabox_register', 'alacarte_page_options_register');