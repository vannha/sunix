<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_button
 */
/* get Shortcode custom value */
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    /* Button Wrapper Class */
    $btn_wrap_cls   = array('red-btn-wrap', $btn_display);
    $btn_wrap_cls[] = !empty($btn_align) ? 'text-'.$btn_align : '';

    $wrapper_attributes[] = 'class="'.alacarte_optimize_css_class(implode(' ', $btn_wrap_cls)).'"';


    $btn_attributes = $btn_custom_styles = [];
    /* Button Class */
    $_btn_class = ($btn_style === 'simple') ? 'red-btn-link' : 'red-btn';
    $_btn_color = ($btn_style === 'simple') ? $btn_color.'-color' : $btn_color;

    $btn_cls   = array($_btn_class, $_btn_color, $btn_style, $btn_shape, 'red-btn-'.$btn_size, $btn_hover_style, $icon_position, $btn_icon_style, $btn_icon_animation,$btn_underline,'transition','red-scroll');
    $btn_attributes[] = 'class="'.alacarte_optimize_css_class(implode(' ', $btn_cls)).'"';
    // Button link
    $button_link = vc_build_link( $button_link);
    $button_link = ( $button_link == '||' ) ? '' : $button_link;
    $btn_attributes[] = !empty($button_link['url']) ? 'href="'.esc_url($button_link['url']).'"' : '';
    // Button Text
    $btn_text = !empty($button_link['title']) ? $button_link['title'] : $btn_text;
    $btn_attributes[] = 'data-title="'.(!empty($button_link['title']) ? $button_link['title'] : $btn_text).'"';
    // Button target
    $btn_attributes[] = strlen( $button_link['target'] ) > 0 ? 'target="'.$button_link['target'].'"' : '';
    // Button Custom Css Style
    if($btn_color === 'custom'){
        if(!empty($btn_custom_bg_color)) {
           if($btn_style === 'fill')
                $btn_custom_styles[] = 'background-color:'.$btn_custom_bg_color;
           else
                $btn_custom_styles[] = 'border-color:'.$btn_custom_bg_color;
        }
        if(!empty($btn_custom_text_color)) $btn_custom_styles[] = 'color:'.$btn_custom_text_color;

    }
    if(!empty($btn_custom_styles)){
        $btn_attributes[] = 'style="'.implode(';', $btn_custom_styles).'"';
    }

    // Button Icon
    $icon = '';
    if($add_icon){
        vc_icon_element_fonts_enqueue( $i_type );
        $icon_name = 'i_icon_' . $i_type ; /* get icon class */
        $icon_default = is_rtl() ? '' : '';
        $iconClass = (isset($atts[$icon_name]) && !empty($atts[$icon_name])) ? $atts[$icon_name] : $icon_default;
        $icon_css_class = [
            'red-btn-icon',
            $iconClass,
            $btn_icon_style,
            $btn_icon_animation,
            $icon_position,
            !empty($btn_icon_color) ? $btn_icon_color.'-color' : ''
        ];

        if(!empty($iconClass)) {
            if($icon_position === 'icon-left') $icon = '<span class="'.alacarte_optimize_css_class(implode(' ', $icon_css_class)).'"></span>&nbsp;&nbsp;';
            if($icon_position === 'icon-right') $icon = '&nbsp;&nbsp;<span class="'.alacarte_optimize_css_class(implode(' ', $icon_css_class)).'"></span>';
        }
    }
    
?>
<?php if(!empty($btn_text)) { ?>
    <div <?php echo implode( ' ', $wrapper_attributes ); ?>>
        <a <?php echo implode(' ', $btn_attributes);?> >
        <?php 
            switch ($icon_position) {
                case 'icon-right':
            ?>
                <span class="btn-title"><?php echo esc_attr( $btn_text );?></span> <?php echo alacarte_html($icon); ?>
            <?php   
                break;
                default:
            ?>
                <?php echo alacarte_html($icon); ?> <span class="btn-title"><?php echo esc_attr( $btn_text );?></span>
            <?php
                break;
            }
        ?>
        </a>
    </div>
<?php }