<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $values
 * Shortcode class
 * @var $this WPBakeryShortCode_ef5_socials
 */
/* get Shortcode custom value */
    $styles = '';
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $values = (array) vc_param_group_parse_atts( $values );
    $wrap_css_classes = array(
        'red-social',
        $el_mode,
        $color_mode,
        $fill_mode,
        !empty($shape_mode) ? 'shape-'.$shape_mode : '',
        !empty($el_icon_size) ? 'size-'.$el_icon_size : '',
        $el_content_align
    );
    if(!empty($custom_color) && $color_mode === 'custom')
        $styles = 'style="color:'.esc_attr($custom_color).';"';
?>
<div class="<?php echo sunix_optimize_css_class(implode(' ', $wrap_css_classes)); ?>">
    <?php
        switch ($source) {
            case 'custom':
                foreach($values as $value){
                    vc_icon_element_fonts_enqueue( $value['i_type'] );  /* Call icon font libs */
                    $iconClass = isset($value['i_icon_'. $value['i_type']]) ? $value['i_icon_'. $value['i_type']] : ''; /* get icon class */
                    $link_open = '<a href="javascript:void(0)" data-hint="'.esc_html__('Follow Us','sunix').'" '.$styles.'>';
                    $link_close = '</a>';           
                    if (isset($value['icon_link'])){  
                        $link = vc_build_link($value['icon_link']);
                        $link = ( $link == '||' ) ? '' : $link;
                        if ( strlen( $link['url'] ) > 0 ) {
                            $a_href    = $link['url'];
                            $a_title   = isset($link['title']) && !empty($link['title']) ? $link['title'] : esc_html__('Follow Us','sunix');
                            $a_target  = strlen( $link['target'] ) > 0 ? str_replace(' ', '', $link['target']) : '_blank';
                            $link_open = '<a href="'.esc_url($a_href).'" target="'.esc_attr($a_target).'" '.$styles.'>';
                            $link_close = '</a>';
                        }
                    }
                    
                    if($iconClass) {
                        echo wp_kses_post($link_open); 
                        echo '<span class="social-icon '.esc_attr($iconClass).'"></span>';
                        echo wp_kses_post($link_close); 
                    }
                }
                break;
             
            default:
                break;
         } 
        
    ?>
</div>


