<?php
vc_map(array(
    'name'        => 'RedExp Video',
    'base'        => 'red_video',
    'icon'        => 'icon-wpb-film-youtube',
    'category'    => esc_html__('RedExp','alacarte'),
    'description' => esc_html__('Add a HTML5 Videos', 'alacarte'),
    'params'      => array(
        array(
            'type'       => 'img',
            'heading'    => esc_html__('Layout Template','alacarte'),
            'param_name' => 'layout_template',
            'value'      =>  array(
                '1' => get_template_directory_uri().'/vc_extends/layouts/video_popup/layout-1.jpg',

            ),
            'std'         => '1',
            'admin_label' => true,
            'edit_field_class' => 'red-select-img-1col'
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Small Heading','alacarte'),
            'param_name' => 'small_heading',
            'admin_label' => true,
        ),
        array(
            'type'       => 'colorpicker',
            'heading'    => esc_html__('Small Header Color','alacarte'),
            'param_name' => 'small_heading_color',
            'dependency' => array(
                'element'   => 'small_heading',
                'not_empty' => true
            )
        ),
        array(
            'type'       => 'textarea',
            'heading'    => esc_html__('Heading','alacarte'),
            'param_name' => 'title',
            'holder'     => 'h3',
        ),
        array(
            'type'       => 'colorpicker',
            'heading'    => esc_html__('Heading Color','alacarte'),
            'param_name' => 'title_color',
            'dependency' => array(
                'element'   => 'title',
                'not_empty' => true
            )
        ),
        array(
            'type'       => 'textarea',
            'heading'    => esc_html__('Content','alacarte'),
            'param_name' => 'content',
        ),
        array(
            'type'       => 'colorpicker',
            'heading'    => esc_html__('Content Color','alacarte'),
            'param_name' => 'content_color',
            'dependency' => array(
                'element'   => 'content',
                'not_empty' => true
            )
        ),
        array(
            'type'       => 'vc_link',
            'heading'    => esc_html__('Link','alacarte'),
            'description'=> esc_html__('Add a link to another page!','alacarte'),
            'param_name' => 'btn_link',
        ),
        alacarte_vc_content_align_opts(),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__( 'Extra class name', 'alacarte' ),
            'param_name'  => 'el_class',
            'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'alacarte' ),
        ),
        array(
            'type'       => 'el_id',
            'heading'    => esc_html__('Element ID','alacarte'),
            'param_name' => 'el_id',
            'settings'   => array(
                'auto_generate' => true,
            ),
            'description'   => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'alacarte' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
        ),
        array(
            'type'       => 'img',
            'heading'    => esc_html__('Play Button','alacarte'),
            'param_name' => 'play_btn',
            'value'      =>  array(
                '1'      => get_template_directory_uri().'/assets/images/play-btn-1.png',
                '2'      => get_template_directory_uri().'/assets/images/play-btn-2.png',
                '3'      => get_template_directory_uri().'/assets/images/play-btn-3.png',
                '4'      => get_template_directory_uri().'/assets/images/play-btn-4.png',
                '5'      => get_template_directory_uri().'/assets/images/play-btn-5.png',
                'custom' => get_template_directory_uri().'/vc_extends/layouts/play-btn-custom.png',
            ),
            'std'              => '1',
            'group'            => esc_html__( 'Video','alacarte'),
            'edit_field_class' => 'red-vc-list-icon'
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Play Effect','alacarte'),
            'param_name' => 'play_btn_effect',
            'value'      =>  array(
                'wave1',
                'wave2',
                'wave3',
                'wave4',
            ),
            'std'              => 'wave1',
            'group'            => esc_html__( 'Video','alacarte'),
        ),
        array(
            'type'       => 'textfield',
            'heading'    => esc_html__('Play Button Text','alacarte'),
            'param_name' => 'play_btn_text',
            'value'      => 'Watch Video',
            'dependency' => array(
                'element' => 'layout_template',
                'value'   => array('2'),
            ),
            'group'      => esc_html__( 'Video','alacarte'),
        ),
        array(
            'type'       => 'attach_image',
            'class'      => '',
            'param_name' => 'play_btn_custom',
            'heading'    => esc_html__('Custom Play Button','alacarte'),
            'value'      => '',
            'description'      =>esc_html__( 'Upload your play button','alacarte'),
            'dependency' => array(
                'element' => 'play_btn',
                'value'   => array('custom'),
            ),
            'group'       =>esc_html__( 'Video','alacarte'),
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Video Type','alacarte'),
            'param_name' => 'video_type',
            'value'      => array(
                esc_html__('Default','alacarte')   => '1',
                esc_html__('Popup','alacarte')     => '2',
            ),
            'std'         => '2',
            'group'       =>esc_html__( 'Video','alacarte'),
            'admin_label' => true,
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Video Source','alacarte'),
            'param_name' => 'video_source',
            'value'      =>   array(
                esc_html__('Online Video','alacarte')   => '1',
                esc_html__('Uploaded Video','alacarte') => '2',
                esc_html__('Hosted Video','alacarte')   => '3',
                esc_html__('Embed code','alacarte')     => '4',
            ),
            'std'         => '1',
            'group'       =>esc_html__( 'Video','alacarte'),
            'admin_label' => true,
        ),
        
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Online Video','alacarte'),
            'description' => sprintf( __( 'Enter link to video, EX: https://www.youtube.com/watch?v=vI9AxTCSrOU (Note: read more about available formats at WordPress <a href="%s" target="_blank">codex page</a>).', 'alacarte' ), 'http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F' ),
            'param_name'  => 'online_video',
            'value'       => 'https://www.youtube.com/watch?v=vI9AxTCSrOU',
            'std'         => 'https://www.youtube.com/watch?v=vI9AxTCSrOU',
            'dependency'  => array(
                'element'     => 'video_source',
                'value'       => '1',
            ),
            'holder'      => 'div',
            'group'       => esc_html__( 'Video','alacarte'),
        ),
        array(
            'type'        => 'video',
            'heading'     => esc_html__('Uploaded Video','alacarte'),
            'description' => esc_html__('choose your uploaded video','alacarte' ),
            'param_name'  => 'uploaded_video',
            'settings'    => array('single'=>true),
            'dependency'  => array(
                'element' => 'video_source',
                'value'   => '2',
            ),
            'holder' => 'div',
            'group'  => esc_html__( 'Video','alacarte'),
            
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('MP4','alacarte'),
            'description' => esc_html__('Enter your MP4 video file url, ex: http://dev.joomexp.com/libs/videos/video-01.mp4','alacarte'),
            'param_name'  => 'bg_video_src_mp4',
            'value'       => '',
            'dependency'  => array(
                'element'     => 'video_source',
                'value'       => '3',
            ),
            'holder'      => 'div',
            'group'       =>esc_html__( 'Video','alacarte'),
            
        ),
        
        array(
            'type'        => 'textfield',
            'class'       => '',
            'heading'     => esc_html__('OGV','alacarte'),
            'description' => esc_html__('Enter your OGV video file url, ex: http://dev.joomexp.com/libs/videos/video-03.ogv','alacarte'),
            'param_name'  => 'bg_video_src_ogv',
            'value'       => '',
            'dependency'  => array(
                'element'     => 'video_source',
                'value'       => '3',
            ),
            'group'       =>esc_html__( 'Video','alacarte'),
            'holder'      => 'div',
        ),
        array(
            'type'        => 'textfield',
            'class'       => '',
            'heading'     => esc_html__('OGG','alacarte'),
            'description' => esc_html__('Enter your OGV video file url, ex: https://dev.joomexp.com/libs/videos/video-03.ogg','alacarte'),
            'param_name'  => 'bg_video_src_ogg',
            'value'       => '',
            'dependency'  => array(
                'element'     => 'video_source',
                'value'       => '3',
            ),
            'group'       =>esc_html__( 'Video','alacarte'),
            'holder'      => 'div',
        ),
        array(
            'type'        => 'textfield',
            'class'       => '',
            'heading'     => esc_html__('WEBM','alacarte'),
            'description' => esc_html__('Enter your WEBM video file url, ex: http://dev.joomexp.com/libs/videos/video-03.webm','alacarte'),
            'param_name'  => 'bg_video_src_webm',
            'value'       => '',
            'dependency' => array(
                'element' => 'video_source',
                'value'   => '3',
            ),
            'group'  => esc_html__( 'Video','alacarte'),
            'holder' => 'div',
        ),
        array(
            'type'        => 'textarea_raw_html',
            'class'       => '',
            'heading'     => esc_html__('Embed video','alacarte'),
            'description' => esc_html__('Enter your embed code.','alacarte'),
            'param_name'  => 'embed_video',
            'value'       => '',
            'dependency' => array(
                'element' => 'video_source',
                'value'   => '4',
            ),
            'group'  => esc_html__( 'Video','alacarte'),
            'holder' => 'div',
        ),
        array(
            'type'       => 'checkbox',
            'class'      => '',
            'heading'    => esc_html__( 'Loop','alacarte'),
            'param_name' => 'loop',
            'std'        => 'false',
            'group'      => esc_html__( 'Video','alacarte'),
            'dependency' => array(
                'element' => 'video_source',
                'value'   => '3',
            ),
        ),
        array(
            'type'       => 'checkbox',
            'class'      => '',
            'heading'    => esc_html__( 'Autoplay','alacarte'),
            'param_name' => 'autoplay',
            'std'        => 'false',
            'group'      => esc_html__( 'Video','alacarte'),
            'dependency' => array(
                'element' => 'video_source',
                'value'   => '3',
            ),
        ),
        array(
            'type'       => 'checkbox',
            'class'      => '',
            'heading'    => esc_html__( 'Muted','alacarte'),
            'param_name' => 'muted',
            'std'        => 'false',
            'group'      => esc_html__( 'Video','alacarte'),
            'dependency' => array(
                'element' => 'video_source',
                'value'   => '3',
            ),
        ),
        array(
            'type'       => 'checkbox',
            'class'      => '',
            'heading'    => esc_html__( 'Controls','alacarte'),
            'param_name' => 'controls',
            'std'        => 'false',
            'group'      =>esc_html__( 'Video','alacarte'),
            'dependency' => array(
                'element' => 'video_source',
                'value'   => '3',
            ),
        ),
        array(
            'type'       => 'checkbox',
            'heading'    => esc_html__( 'Show Button Play','alacarte'),
            'param_name' => 'show_btn',
            'std'        => 'true',
            'dependency' => array(
                'element'            => 'autoplay',
                'value_not_equal_to' => 'true',
            ),
            'group'      => esc_html__( 'Video','alacarte')
        ),
        array(
            'type'       => 'colorpicker',
            'heading'    => esc_html__( 'Overlay Background color on the video','alacarte'),
            'param_name' => 'bg_video_color',
            'dependency' => array(
                'element'    => 'video_source',
                'value'      => '3',
            ),
            'group'      => esc_html__( 'Video','alacarte'),
            'std'        => ''
        ),
        array(
            'type'       => 'attach_image',
            'class'      => '',
            'param_name' => 'poster',
            'value'      => '',
            'group'      =>esc_html__( 'Poster','alacarte'),
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Poster Style','alacarte'),
            'param_name' => 'poster_style',
            'value'      =>   array(
                esc_html__('Default','alacarte')   => '',
            ),
            'std'         => '',
            'group'       => esc_html__( 'Poster','alacarte'),
            'dependency'  => array(
                'element'   => 'poster',
                'not_empty' => true,
            ),
        ),
    )
));

class WPBakeryShortCode_red_video extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
    protected function alacarte_video_play_button($atts, $args=[])
    {
        global $wp_embed;
        extract($atts);
        if($video_type !== '2') return;
        $args = wp_parse_args($args,[
            'anim'  => 'wave1',
            'class' => ''
        ]);
        
        $play_btn_url = get_template_directory_uri().'/assets/images/play-btn-'.$play_btn.'.png';
        if($play_btn === 'custom') $play_btn_url = alacarte_get_image_url_by_size([
            'id'            => $play_btn_custom,
            'size'          => '80',
            'default_thumb' => true,
            'class'         => 'circle'
        ]);

        $play_css_class = [$args['class'], 'd-flex align-items-center'];
        if(!empty($poster)) $play_css_class[] = 'has-poster';
        $play_css_class = alacarte_optimize_css_class(implode(' ', $play_css_class));

        $ef5_waves = alacarte_html_animation(['anim' => $args['anim']]);
        $play_btn_text = '<span class="play-btn-text">'.$play_btn_text.'</span>';
        switch ($video_source) {
            case '1':
                if ( is_object( $wp_embed ) ) {
                    echo '<a href="'.esc_url($online_video).'" class="red-popupvideo-iframe '.$play_css_class.'"><span class="red-anim-wave loop"><img src="'.esc_url($play_btn_url).'" alt="'.esc_attr($title).'" />'.$ef5_waves.'</span>'.$play_btn_text.'</a>';
                }
                break;
            case '2':
                if(!empty($uploaded_video)) {
                    echo '<a href="#'.esc_url($el_id).'" class="red-popupvideo '.$play_css_class.'"><span class="red-anim-wave loop"><img src="'.esc_url($play_btn_url).'" alt="'.esc_attr($title).'" />'.$ef5_waves.'</span>'.$play_btn_text.'</a>';
                }
                break;
            case '3':
                echo '<a href="#'.esc_url($el_id).'" class="red-popupvideo '.$play_css_class.'"><span class="red-anim-wave loop"><img src="'.esc_url($play_btn_url).'" alt="'.esc_attr($title).'" />'.$ef5_waves.'</span>'.$play_btn_text.'</a>';
                break;
            case '4':
                echo '<a href="#'.esc_attr($el_id).'" class="red-popupvideo '.$play_css_class.'"><span class="red-anim-wave loop"><img src="'.esc_url($play_btn_url).'" alt="'.esc_attr($title).'" />'.$ef5_waves.'</span>'.$play_btn_text.'</a>';
                break;  
        }
    }
    protected function alacarte_video_popup($atts, $args=[]){
        global $wp_embed;
        extract($atts);
        if($video_type !== '2') return;
        $args = wp_parse_args($args,[
            'anim'  => 'wave1',
            'class' => ''
        ]);
        $preload  = '';
        $play_btn_url = get_template_directory_uri().'/assets/images/play-btn-'.$play_btn.'.png';


        if($play_btn === 'custom') $play_btn_url = alacarte_get_image_url_by_size([
            'id'            => $play_btn_custom,
            'size'          => '80',
            'default_thumb' => true,
            'class'         => 'circle'
        ]);

        wp_enqueue_script( 'magnific-popup' );
        wp_enqueue_style( 'magnific-popup' );
        wp_enqueue_script( 'red-video' );
        $play_css_class = ['red-playvideo', 'red-popupvideo', 'red-anim-wave', 'loop'];

        if(!empty($poster)) $play_css_class[] = 'has-poster';

        $ef5_waves = alacarte_html_animation(['anim' => $args['anim']]);

        switch ($video_source) {
            case '1':
                $play_css_class[] = 'red-popupvideo-iframe';
                $video_w = 500;
                $video_h = $video_w / 1.61; //1.61 golden ratio
                if ( is_object( $wp_embed ) ) {
                    echo '<a href="'.esc_url($online_video).'" class="'.implode(' ',$play_css_class).'"><img src="'.esc_url($play_btn_url).'" alt="'.esc_attr($title).'" />'.$ef5_waves.'</a>';
                    echo '<div class="d-none"><div id="'.esc_attr($el_id).'" class="red-video-popup">'.apply_filters('the_content', $online_video).'</div></div>';
                }
                break;

            case '2':
                $play_css_class[] = 'red-popupvideo';
                if(!empty($uploaded_video)) {
                    $video_type = wp_check_filetype(wp_get_attachment_url($uploaded_video), wp_get_mime_types());
                    echo '<a href="#'.esc_url($el_id).'" class="'.implode(' ',$play_css_class).'"><img src="'.esc_url($play_btn_url).'" alt="'.esc_attr($title).'" />'.$ef5_waves.'</a>';
                    if(is_numeric($uploaded_video))
                        $uploaded_video = wp_get_attachment_url($uploaded_video);
                    switch ($video_type['type']) {
                        case 'audio/mpeg':
                            echo '<div class="d-none"><div id="'.esc_attr($el_id).'" class="red-video-popup">'.apply_filters('the_content', '[audio mp3="'.esc_url($uploaded_video).'" autoplay="true"][/audio]').'</div></div>';
                            break;
                        
                        default:
                            echo '<div class="d-none"><div id="'.esc_attr($el_id).'" class="red-video-popup" >'.apply_filters('the_content', '[video poster="'.wp_get_attachment_url($poster).'" '.$video_type['ext'].'="'.esc_url($uploaded_video).'" src="'.esc_url($uploaded_video).'" autoplay="true"][/video]').'</div></div>';
                            break;
                    }
                }
                break;
            case '4':
                $play_css_class[] = 'red-popupvideo';
                echo '<a href="#'.esc_url($el_id).'" class="'.implode(' ',$play_css_class).'"><img src="'.esc_url($play_btn_url).'" alt="'.esc_attr($title).'" />'.$ef5_waves.'</a>';
                $iframe_string = rawurldecode( base64_ef5_decode( strip_tags( $embed_video ) ) );
                preg_match('/src="([^"]+)"/', $iframe_string, $match);
                $url = isset($match[1]) ? $match[1] : $iframe_string;
                echo '<div class="d-none"><div id="'.esc_attr($el_id).'" class="red-video-popup">'.$iframe_string.'</div></div>';
                break;
            default:
                $play_css_class[] = 'red-popupvideo';
                /* Video */
                if(is_numeric($poster)) {
                    $image_src = wp_get_attachment_url( $poster );
                } else {
                    $image_src = $poster;
                }
                $bg_video_args = array();
                if (!empty($bg_video_src_mp4) ) $bg_video_args['mp4']  = $bg_video_src_mp4;
                if (!empty($bg_video_src_ogv) ) $bg_video_args['ogv']  = $bg_video_src_ogv;
                if (!empty($bg_video_src_ogg) ) $bg_video_args['ogg']  = $bg_video_src_ogg;
                if (!empty($bg_video_src_webm)) $bg_video_args['webm'] = $bg_video_src_webm;
                
                if (!empty($bg_video_args)) {
                    $attr_strings = array(
                        'id="'.$el_id.'"',
                        'data-id="'.$el_id.'"',
                    );
                    if (!empty($image_src)) {
                        $attr_strings[] = 'poster="'.$image_src.'"';
                    }
                    if ($autoplay == true) {
                        $attr_strings[] = 'autoplay';
                    }
                    if ($muted == true) {
                        $attr_strings[] = 'muted';
                    }
                    if ($loop == true) {
                        $attr_strings[] = 'loop';
                    }
                    $attr_strings[] = 'controls'; // need it for fix show video on popup
                    if ($preload) {
                        $attr_strings[] = 'preload="'.$preload.'"';
                    }
                    $source_html = null;
                    $source = '<source type="%s" src="%s" />';
                    foreach ($bg_video_args as $video_type => $video_src) {
                        $video_type = wp_check_filetype($video_src, wp_get_mime_types());
                        $source_html .= sprintf($source, $video_type['type'], esc_url($video_src));
                    }
                }
                echo '<a href="#'.esc_url($el_id).'" class="'.implode(' ',$play_css_class).'"><img src="'.esc_url($play_btn_url).'" alt="'.esc_attr($title).'" />'.$ef5_waves.'</a>';
            ?>
            <div class="d-none"> 
                <div id="<?php echo esc_attr($el_id);?>" class="red-video-shortcode red-video-popup">
                    <video class="red-video" <?php echo join(' ', $attr_strings); ?>>
                        <?php echo ''.$source_html;?>
                    </video>
                </div>
            </div>
        <?php        
            break;
        }    
    }

    protected function alacarte_video_plain($atts, $args = []){
        global $wp_embed;
        extract($atts);
        if($video_type !== '1') return;
        $args = wp_parse_args($args,[
            'wave'  => true,
            'class' => ''
        ]);
        $preload  = '';
        switch ($video_source) {
            case '1':
                $video_w = 500;
                $video_h = $video_w / 1.61; //1.61 golden ratio
                if ( is_object( $wp_embed ) ) {
                    echo alacarte_html( $wp_embed->run_shortcode( '[embed width="'.$video_w.'" height="'.$video_h.'"]' . $online_video . '[/embed]' ) );
                }
                break;

            case '2':
                if(!empty($uploaded_video)) {
                    $video_type = wp_check_filetype(wp_get_attachment_url($uploaded_video), wp_get_mime_types());
                    if(is_numeric($uploaded_video))
                        $uploaded_video = wp_get_attachment_url($uploaded_video);
                    switch ($video_type['type']) {
                        case 'audio/mpeg':
                            echo apply_filters('the_content', '[audio mp3="'.esc_url($uploaded_video).'"][/audio]');
                            break;
                        
                        default:
                            echo apply_filters('the_content', '[video poster="'.wp_get_attachment_url($poster).'" '.$video_type['ext'].'="'.esc_url($uploaded_video).'" src="'.esc_url($uploaded_video).'"][/video]');
                            break;
                    }
                }
                break;
            case '4':
                echo rawurldecode( base64_ef5_decode( strip_tags( $embed_video ) ) );
                break;
            default:
                /* js for video html5 */
                wp_enqueue_script( 'red-video' );
                /* Video */
                if(is_numeric($poster)) {
                    $image_src = wp_get_attachment_url( $poster );
                } else {
                    $image_src = $poster;
                }
                $bg_video_args = array();
                if (!empty($bg_video_src_mp4) ) $bg_video_args['mp4']  = $bg_video_src_mp4;
                if (!empty($bg_video_src_ogv) ) $bg_video_args['ogv']  = $bg_video_src_ogv;
                if (!empty($bg_video_src_ogg) ) $bg_video_args['ogg']  = $bg_video_src_ogg;
                if (!empty($bg_video_src_webm)) $bg_video_args['webm'] = $bg_video_src_webm;
                if (!empty($bg_video_args)) {
                    $attr_strings = array(
                        'id="'.$el_id.'"',
                        'data-id="'.$el_id.'"',
                    );
                    if (!empty($image_src)) {
                        $attr_strings[] = 'poster="'.$image_src.'"';
                    }
                    if ($autoplay == true) {
                        $attr_strings[] = 'autoplay';
                    }
                    if ($muted == true) {
                        $attr_strings[] = 'muted';
                    }
                    if ($loop == true) {
                        $attr_strings[] = 'loop';
                    }
                    if ($controls == true) {
                        $attr_strings[] = 'controls';
                    }
                    if ($preload) {
                        $attr_strings[] = 'preload="'.$preload.'"';
                    }
                    $source_html = null;
                    $source = '<source type="%s" src="%s" />';
                    foreach ($bg_video_args as $video_type => $video_src) {
                        $video_type = wp_check_filetype($video_src, wp_get_mime_types());
                        $source_html .= sprintf($source, $video_type['type'], esc_url($video_src));
                    }
                }
            ?>  
            <div class="red-video-shortcode">
                <video class="red-video" <?php echo join(' ', $attr_strings); ?>>
                    <?php echo ''.$source_html;?>
                </video>
                <div class="mejs-overlay play-video" style="width: 100%; height: 100%; background-color:<?php echo esc_attr($bg_video_color);?>;">
                    <?php if(!$autoplay && $show_btn) { ?>
                    <div class="mejs-overlay-button"></div>
                    <?php } ?>
                </div>
            </div>
        <?php        
            break;
        }
    }
}