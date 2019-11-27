<?php
    $title = $el_class = $video_source = $online_video = $uploaded_video = $embed_video = $poster = $poster_style = $autoplay = $muted = $loop = $preload = $controls = $show_btn = $btn_link = $bg_video_color = $bg_video_src_mp4 = $bg_video_src_ogv = $bg_video_src_ogg = $bg_video_src_webm = $video_width = $video_height = '';
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );

$wrap_css_class = array('red-video-wrapper','red-video-'.$layout_template, 'video-source-'.$video_source, $content_align, $el_class,'row','align-items-center');

$bg_video_args = array();
if ($bg_video_src_mp4)  $bg_video_args['mp4'] = $bg_video_src_mp4;
if ($bg_video_src_ogg)  $bg_video_args['ogg'] = $bg_video_src_ogg;
if ($bg_video_src_ogv)  $bg_video_args['ogv'] = $bg_video_src_ogv;
if ($bg_video_src_webm) $bg_video_args['webm'] = $bg_video_src_webm;
if($video_source == '3' && empty($bg_video_args)){
    esc_html_e('No video found!','alacarte');
    return;
}
/* parse button link */
$use_link = false;
if(!empty($btn_link)){
    $button_link = vc_build_link( $btn_link );
    $button_link = ( $button_link == '||' ) ? '' : $button_link;
    if ( strlen( $button_link['url'] ) > 0 ) {
        $use_link = true; 
        $a_href = $button_link['url'];
        $a_title = strlen($button_link['title']) > 0 ? $button_link['title'] : esc_html__('Read more','alacarte') ;
        $a_target = strlen( $button_link['target'] ) > 0 ? $button_link['target'] : '_self';
    }
}
global $wp_embed;

$title_attrs = ['class="el-title"'];
$desc_attrs = ['class="red-video-desc clearfix"'];
$title_border_style = [];
if(!empty($title_color)) {
    $title_attrs[] = 'style="color:'.esc_attr($title_color).'"';
    $title_border_style[] = '#red-video-'.esc_attr($el_id).' .el-title:after{background-color:'.esc_attr($title_color).'}';
}
if(!empty($title_border_style)) echo '<div class="red-inline-css" data-css="'.trim(implode(';', $title_border_style)).'"></div>';

if(!empty($content_color)) {
    $desc_attrs[] = 'style="color:'.esc_attr($content_color).'"';
}

$play_btn_url = get_template_directory_uri().'/assets/images/play-btn-'.$play_btn.'.png';
if($play_btn === 'custom') $play_btn_url = alacarte_get_image_url_by_size([
    'id'            => $play_btn_custom,
    'size'          => '80',
    'default_thumb' => true,
    'class'         => 'circle'
]);

$ef5_waves = '<div class="red-wave-wrap"><div class="circle delay1 red-wave infinite"></div> <div class="circle delay2 red-wave infinite"></div><div class="circle delay3 red-wave infinite"></div><div class="circle delay4 red-wave infinite"></div></div>';

switch ($layout_template) {
    case '2':
        $video_info_class = 'order-2 offset-lg-1';
        $video_class = '';
        break;
    
    default:
        $video_info_class = '';
        $video_class = '';
        break;
}

?>
<div id="red-video-<?php echo esc_attr($el_id);?>" class="<?php echo alacarte_optimize_css_class(implode(' ', $wrap_css_class));?>">
    <?php if( $title || $content ) : ?>
    <div class="red-video-info col-lg-5 <?php echo esc_attr($video_info_class);?>">
        <?php if($small_heading){ ?>
            <div class="red-heading small-heading text-14"><?php echo esc_html($small_heading);?></div>
        <?php }
        if($title){ ?>
            <div class="red-heading large-heading text-40" <?php echo alacarte_optimize_css_class(implode(' ', $title_attrs));?>><?php echo alacarte_html($title);?></div>
        <?php }
        if($content){ ?>
            <div <?php echo trim(implode(' ', $desc_attrs));?>>
                <?php echo esc_attr($content);?>
            </div>
        <?php } ?>
        <div class="red-button-wrapper d-flex align-items-center">
            <?php if($layout_template === '2') echo ''.$this->alacarte_video_play_button($atts,['anim' => $play_btn_effect]); ?>
            <?php if($use_link) { ?>
                <a class="red-btn red-btn-lg accent fill" alacarte"<?php echo esc_url( $a_href ); ?>" title="<?php echo esc_attr( $a_title ); ?>" target="<?php echo trim( esc_attr( $a_target ) ); ?>"><span><?php echo esc_attr( $a_title ); ?></span></a>
            <?php } ?>
        </div>
    </div>
    <?php endif; ?>
    <div class="red-video-wrap col-lg-12">
    <?php switch ($video_type) {
        case '2':  /* popup video */
            if(!empty($poster)){
                echo '<div class="red-video-popup-wrap text-center overlay-wrap">';
                echo '<img src="'.wp_get_attachment_url($poster).'" alt="'.esc_attr($title).'" class="video-poster '.esc_attr($poster_style).'" />';
            }
                echo ''.$this->alacarte_video_popup($atts,['anim' => $play_btn_effect]);
            if(!empty($poster)) echo '</div>';
            break;
        default:
            echo ''.$this->alacarte_video_plain($atts);
            break;
    } ?>
    </div>
</div>
