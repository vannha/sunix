<?php
/**
 * Add custom attributes from custom param to VC Element
 * wp-content/plugins/js_composer/include/classes/shortcodes/shortcodes.php
 * https://kb.wpbakery.com/docs/developers-how-tos/
 * https://kb.wpbakery.com/docs/filters/
 *
*/
add_filter('vc_shortcode_output', 'alacarte_vc_shortcode_output', 10, 3);
function alacarte_vc_shortcode_output($html = '', $sc_obj = '', $atts = [])
{
    extract($atts);
    //modify shortcode use div as container
    $shortcode_modify = ['vc_section','vc_row', 'vc_row_inner', 'vc_column','vc_pie'];
    $shortcode_name = $sc_obj->getShortcode();
    if (!in_array($shortcode_name, $shortcode_modify))
        return $html;
    //
    $modify = [
        'attrs'       => [], // for add attrs can use string or array
        'before'      => '',
        'after'       => '',
        'first-child' => '',
        'last-child'  => '',
        'vc-pie-icon' => ''
    ];
    switch ($shortcode_name) {
        //case for $shortcode_modify element
        case 'vc_section':
            if(isset($parallax_overlay) && !empty($parallax_overlay))
                $modify['first-child'] = '<div class="parallax_overlay" style="background-color:'.esc_attr($parallax_overlay).'"></div>';
            break;
        case 'vc_row':
            $container_style = [];
            $container_class = ['container', 'clearfix'];
            if(isset($vc_row_container_background_color)){
                $container_class[] = $vc_row_container_background_color;
            }

            if(isset($text_color)){
            	$modify['attrs']['style'] = 'color:'.$text_color.';';
            }
            // Background Text
            if(isset($vc_row_background_text) && !empty($vc_row_background_text)){
                $vc_row_background_text_attrs = $vc_row_background_text_css = [];
                $vc_row_background_text_css_class = [
                    'red-heading',
                    'red-row-bg-text',
                    !empty($vc_row_background_text_pos) ? $vc_row_background_text_pos : '',
                    !empty($vc_row_background_text_style) ? 'font-style-'.$vc_row_background_text_style : '',
                    !empty($vc_row_background_text_transform) ? 'text-'.$vc_row_background_text_transform : '',
                ];
                $vc_row_background_text_attrs[] = 'class="'.alacarte_optimize_css_class(implode(' ', $vc_row_background_text_css_class)).'"';
                if(!empty($vc_row_background_text_size)) $vc_row_background_text_css[]           = 'font-size:'.(int)$vc_row_background_text_size.'px';
                if(!empty($vc_row_background_text_color)) $vc_row_background_text_css[]          = 'color:'.$vc_row_background_text_color;
                if(!empty($vc_row_background_text_letter_spacing)) $vc_row_background_text_css[] = 'letter-spacing:'.(int)$vc_row_background_text_letter_spacing.'px';
                if(!empty($vc_row_background_text_line_height)) $vc_row_background_text_css[]    = 'line-height:'.$vc_row_background_text_line_height;
                if(!empty($vc_row_background_text_css))
                    $vc_row_background_text_attrs[] = 'style="'.trim(implode(';',$vc_row_background_text_css)).'"';

                $vc_row_background_text_tag = 'div';
                if(isset($vc_row_background_text_behavior)){
                    //var_dump($vc_row_background_text_direction);
                    $direction = isset($vc_row_background_text_direction) ? $vc_row_background_text_direction : 'left';
                    $vc_row_background_text_tag = 'marquee';
                    $vc_row_background_text_attrs[] = 'behavior="'.$vc_row_background_text_behavior.'"';
                    $vc_row_background_text_attrs[] = 'direction="'.$direction.'"';
                    if($direction === 'left' || $direction === 'right'){
                        $vc_row_background_text_attrs[] = 'scrollamount="30"';
                        $vc_row_background_text_attrs[] = 'scrolldelay="60"';
                    }
                }

                $modify['first-child'] .= '<'.$vc_row_background_text_tag.' '.implode(' ', $vc_row_background_text_attrs).'>'.alacarte_html($vc_row_background_text).'</'.$vc_row_background_text_tag.'>';
            }
            /* parallax overlay color */
            if(isset($parallax_overlay) && !empty($parallax_overlay)){
            	$modify['first-child'] .= '<div class="parallax-overlay" style="background-color:'.esc_attr($parallax_overlay).'"></div>';
            }
            if(!isset($full_width) || $full_width === ''){
	            $modify['before']      .= '<div class="container">'; //ex: '<div class="d-none">Row Before</div>';
	            $modify['after']       .= '</div>'; //ex: '<div class="d-none">Row after</div>';
	        }
	        if(isset($full_width) && $full_width === 'stretch_row'){
                $align_items = '';
                if(isset($content_placement) && !empty($content_placement)){
                    switch ($content_placement) {
                        case 'top':
                            $align_items = 'align-items-start';
                            break;
                        case 'middle':
                            $align_items = 'align-items-center';
                            break;
                        case 'bottom':
                            $align_items = 'align-items-end';
                    }
                }
	        	$modify['first-child'] .= '<div class="'.implode(' ', $container_class).'"><div class="row '.$align_items.'">';
	        	$modify['last-child']  .= '</div></div>';
	        }
            // Stretch row style 2
            if(isset($full_width) && $full_width === 'stretch_row_content2'){
                $align_items = '';
                $container_class[] = 'red-container2';
                if(isset($content_placement) && !empty($content_placement)){
                    switch ($content_placement) {
                        case 'top':
                            $align_items = 'align-items-start';
                            break;
                        case 'middle':
                            $align_items = 'align-items-center';
                            break;
                        case 'bottom':
                            $align_items = 'align-items-end';
                    }
                }
                $modify['first-child'] .= '<div class="'.implode(' ', $container_class).'"><div class="row '.$align_items.'">';
                $modify['last-child']  .= '</div></div>';
            }
            // Stretch row style 3
            if(isset($full_width) && $full_width === 'stretch_row_content3'){
                $align_items = '';
                $container_class[] = 'red-container3';
                if(isset($content_placement) && !empty($content_placement)){
                    switch ($content_placement) {
                        case 'top':
                            $align_items = 'align-items-start';
                            break;
                        case 'middle':
                            $align_items = 'align-items-center';
                            break;
                        case 'bottom':
                            $align_items = 'align-items-end';
                    }
                }
                $modify['first-child'] .= '<div class="'.implode(' ', $container_class).'"><div class="row '.$align_items.'">';
                $modify['last-child']  .= '</div></div>';
            }
            break;
        case 'vc_row_inner':
            if(isset($vc_row_inner_stretch) && $vc_row_inner_stretch === 'container'){
                $modify['before']      .= '<div class="container">';
                $modify['after']       .= '</div>';
            }
            break;
        case 'vc_column':
            if(isset($text_color)) $modify['attrs']['style'] = 'color:'.$text_color.';';//modify by array
            if(isset($parallax_overlay) && !empty($parallax_overlay))$modify['first-child'] = '<div class="parallax-overlay" style="background-color:'.esc_attr($parallax_overlay).'"></div>'; //ex: '<div class="d-none">col first child</div>';
            $modify['last-child']  = ''; //ex: '<div class="d-none">col last child</div>';
            $modify['before']      = ''; //ex: '<div class="d-none">col Before</div>';
            $modify['after']       = ''; //ex: '<div class="d-none">col after</div>';
            break;
        case 'vc_pie':
            if(isset($add_icon) &&  $add_icon){
                $i_type = isset($i_type) ? $i_type : 'linear';
                // Enqueue needed icon font.
                vc_icon_element_fonts_enqueue( $i_type );
                $icon_name = isset($i_type) ? 'i_icon_' . $i_type : 'i_icon_linear';
                $iconClass = isset($atts[$icon_name]) ? $atts[$icon_name] : '';
                if(!empty($iconClass)) $modify['vc-pie-icon'] = '<span class="vc-pie-icon '.$iconClass.'"></span>';
            }
            break;
        default:
            return $html;
            break;
    }
    //begin modify
    if (!empty($modify['attrs'])) {
        if (is_array($modify['attrs']))
        {
            $custom_attr_str =[];
            foreach ($modify['attrs'] as $key => $value) {
                $value = esc_attr($value);
                $custom_attr_str[] = "{$key}=\"{$value}\"";
            }
            $custom_attr_str = join(' ',$custom_attr_str);
        }
        else
            $custom_attr_str = $modify['attrs'];
        $html = '<div ' . $custom_attr_str . substr($html, 4);
    }
    if (!empty($modify['first-child'])) {
        $html_exp = explode('>', $html);
        $html_exp[1] = $modify['first-child'] . $html_exp[1];
        $html = join('>', $html_exp);
    }
    if (!empty($modify['last-child'])) {
        $html_exp = explode('</div>', $html);
        if (count($html_exp) > 2) {
            for ($index = count($html_exp) - 1; $index > 0; $index--) {
                if (empty(trim($html_exp[$index - 1])))
                    break;
            }
            $html_exp[$index - 1] .= $modify['last-child'];
            $html = join('</div>', $html_exp);
        } else
            $html = substr($html, 0, -6) . $modify['last-child'] . '</div>';
    }
    if (!empty($modify['before']))
        $html = $modify['before'] . $html;
    if (!empty($modify['after']))
        $html = $html . $modify['after'];

    if (!empty($modify['vc-pie-icon'])) {
        $html = str_replace ('<span class="vc_pie_chart_value"></span>', $modify['vc-pie-icon'].'<span class="vc_pie_chart_value"></span>', $html );
    }

    return $html;
}

/**
 * Change default class name of VC to use Bootstrap 4.x
 *
 * Filter to replace default css class names for vc_row shortcode and vc_column
 * https://kb.wpbakery.com/docs/filters/vc_shortcodes_css_class/
*/
add_filter( 'vc_shortcodes_css_class', 'alacarte_css_classes_for_vc_row_and_vc_column', 10, 2 );
function alacarte_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
    if ( $tag == 'vc_section' ) {
        //$class_string = str_replace( 'vc_section-has-fill', 'vc-section-has-fill vc-has-fill', $class_string );
        //$class_string = str_replace( 'vc_column-gap-', 'vc-column-gap-', $class_string );
        //$class_string = str_replace( 'vc_row-o-full-height', 'vc-full-height', $class_string );
        //$class_string = str_replace( 'vc_section-o-content-', 'vc-content-', $class_string );
        //$class_string = str_replace( 'vc_section-flex', 'vc-flex', $class_string );
    }
    if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
        $class_string = str_replace( 'vc_row ', 'vc_row row ', $class_string );
        $class_string = str_replace( 'vc_row-has-fill', 'has-fill', $class_string );
        //$class_string = str_replace( 'vc_column-gap-', 'vc-column-gap-', $class_string );
        //$class_string = str_replace( 'vc_row-o-full-height', 'vc-full-height', $class_string );
        //$class_string = str_replace( 'vc_row-o-columns-', 'vc-content-', $class_string );
        //$class_string = str_replace( 'vc_row-flex', 'vc-flex', $class_string );
    }
    if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
        //$class_string = preg_replace( '/wpb_column/', '', $class_string );
        //$class_string = preg_replace( '/vc_column_container/', 'vc-column-container', $class_string );
        $class_string = preg_replace( '/vc_col-has-fill/', 'vc-col-has-fill', $class_string );
        //$class_string = preg_replace( '/vc_column-inner/', 'vc-column-inner', $class_string );

        $class_string = preg_replace( '/vc_col-lg-(\d{1,2})/', 'col-xl-$1', $class_string );
        $class_string = preg_replace( '/vc_col-md-(\d{1,2})/', 'col-lg-$1', $class_string );
        $class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'col-md-$1', $class_string );
        $class_string = preg_replace( '/vc_col-xs-(\d{1,2})/', 'col-$1', $class_string );
        // offset
        $class_string = preg_replace( '/vc_col-lg-offset-(\d{1,2})/', 'offset-xl-$1', $class_string );
        $class_string = preg_replace( '/vc_col-md-offset-(\d{1,2})/', 'offset-lg-$1', $class_string );
        $class_string = preg_replace( '/vc_col-sm-offset-(\d{1,2})/', 'offset-md-$1', $class_string );
        $class_string = preg_replace( '/vc_col-xs-offset-(\d{1,2})/', 'offset-$1', $class_string );
    }
    return $class_string; // Important: you should always return modified or original $class_string
}

/**
 * Add custom class from custom param to VC Element
 * https://kb.wpbakery.com/docs/filters/vc_shortcodes_css_class/
 *
 */
add_filter('vc_shortcodes_css_class', 'alacarte_vc_shortcodes_css_class', 10, 3);
function alacarte_vc_shortcodes_css_class($class_string, $tag, $atts = '')
{
    $custom_class = array();
    extract($atts);
    if ($tag == 'vc_section') {
        if (isset($vc_row_priority)) {
            $custom_class[] = $vc_row_priority;
        }
        if (isset($vc_row_default_theme_background_img_pos)) {
            $custom_class[] = $vc_row_default_theme_background_img_pos;
        }
    }
    if ($tag == 'vc_row') {
        if (isset($vc_row_priority)) {
            $custom_class[] = $vc_row_priority;
        }
        if (isset($row_overfolow)) {
            $custom_class[] = $row_overfolow;
        }
        if (isset($row_bg_left_content)) {
            $custom_class[] = $row_bg_left_content;
        }
        if (isset($row_half_background)) {
            $custom_class[] = $row_half_background;
        }
        if (isset($row_display_default)) {
            $custom_class[] = $row_display_default;
        }
        if (isset($row_footer_bottom)) {
            $custom_class[] = $row_footer_bottom;
        }
        if (isset($vc_row_padding)) {
            $custom_class[] = $vc_row_padding;
        }
        if (isset($vc_row_default_theme_background_img_pos)) {
            $custom_class[] = $vc_row_default_theme_background_img_pos;
        }
        if (isset($vc_row_default_theme_background_color)) {
            $custom_class[] = $vc_row_default_theme_background_color;
        }
        if(isset($vc_row_divider) && !empty($vc_row_divider))
            $custom_class[] = $vc_row_divider;
        if(isset($vc_row_divider_color) && !empty($vc_row_divider_color))
            $custom_class[] = $vc_row_divider_color;
        if(isset($remove_overflow) && $remove_overflow === '1'){
            $custom_class[] = 'no-overflow-hidden';
        }
    }
    if ($tag == 'vc_column' || $tag == 'vc_column_inner') {
        if (isset($gap)) {
            $custom_class[] = 'vc-column-gap-'.$gap;
        }
        if (isset($vc_col_priority)) {
            $custom_class[] = $vc_col_priority;
        }
        if (isset($vc_col_padding)) {
            $custom_class[] = $vc_col_padding;
        }
        if (isset($vc_col_content_align)) {
            $custom_class[] = $vc_col_content_align;
        }
        if (isset($reservation_style)) {
            $custom_class[] = $reservation_style;
        }
        if (isset($contact_style)) {
            $custom_class[] = $contact_style;
        }
        if (isset($priority_style)) {
            $custom_class[] = $priority_style;
        }
        if (isset($col_box_shadow)) {
            $custom_class[] = $col_box_shadow;
        }
        if (isset($order_style)) {
            $custom_class[] = $order_style;
        }
        if (isset($element_display) && !empty($element_display) ) {
            $custom_class[] = 'element-'.$element_display;
        }
        if (isset($vc_col_element_align) && !empty($vc_col_element_align)) {
            $custom_class[] = 'justify-content-'.$vc_col_element_align;
        }
        if (isset($vc_col_default_theme_background_color)) {
            $custom_class[] = $vc_col_default_theme_background_color;
        }
        if(isset($vc_col_custom_position)){
            $custom_class[] = $vc_col_custom_position;
        }
    }
    /* add custom loading delay time for VC Grid */
    if ($tag == 'vc_basic_grid' || $tag == 'vc_masonry_grid' || $tag == 'vc_media_grid' || $tag == 'vc_masonry_media_grid') {
        if (isset($element_width) && $element_width) {
            $custom_class[] = 'red-iw-' . $element_width;
        }
        if (isset($item) && $item) {
            $custom_class[] = $item;
        }

        if (isset($vcbg_hover) && $vcbg_hover) {
            $custom_class[] = $vcbg_hover;
        }

        if (isset($vcbg_space) && $vcbg_space) {
            $custom_class[] = 'vc_gitem-row-' . $vcbg_space;
        }

        if (isset($delay_time) && $delay_time) {
            $custom_class[] = 'zk-loading-delay-' . $delay_time;
        }

        if (isset($pagination_top_space) && $pagination_top_space) {
            $custom_class[] = 'pagination-top-' . $pagination_top_space;
        }
    }
    /* add css class for vc single image */
    if($tag == 'vc_single_image'){
        if(isset($style) && !empty($style) ){
            $custom_class[] = $style;
        }
        if(isset($border_color) && !empty($border_color) ){
            $custom_class[] = 'vc_box_border_'.$border_color;
        }
    }
    // add css class to vc_progress_bar
    if($tag == 'vc_progress_bar'){
        if(isset($vc_progress_bar_template))
            $custom_class[] = 'layout-'.$vc_progress_bar_template;
    }

    $class_string .= ' ' . trim(implode(' ', $custom_class));
    //$class_string = vc_remove_class('wpb_single_image',$class_string);
    return $class_string;
}

/**
 *
 * Custom  VC Row
 *
 */
vc_add_params('vc_row', array(
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__('Overfolow', 'alacarte'),
        'param_name'  => 'row_overfolow',
        'value'       => array(
            esc_html__('Default', 'alacarte')      => '',
            esc_html__('Initial', 'alacarte')       => 'row-overfolow-initial',
        ),
        'edit_field_class' => 'vc_col-sm-6',
        'group'       => esc_html__('Alacarte Custom', 'alacarte')
    ),
  array(
        'type'             => 'colorpicker',
        'heading'          => esc_html__('Background Overlay Color', 'alacarte'),
        'param_name'       => 'parallax_overlay',
        'value'            => '',
        'description'      => esc_html__('Choose overlay color.', 'alacarte'),
        'edit_field_class' => 'vc_col-sm-6',
        'group'            => esc_html__('Alacarte Custom', 'alacarte')
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__('Row Footer Bottom', 'alacarte'),
        'param_name'  => 'row_footer_bottom',
        'value'       => array(
            esc_html__('Default', 'alacarte')      => '',
            esc_html__('Row Footer Bottom', 'alacarte')       => 'row-footer-bottom',
        ),
        'edit_field_class' => 'vc_col-sm-6',
        'group'       => esc_html__('Alacarte Custom', 'alacarte')
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__('Background Row and content Left', 'alacarte'),
        'param_name'  => 'row_bg_left_content',
        'value'       => array(
            esc_html__('Default', 'alacarte')      => '',
            esc_html__('Row Content Left', 'alacarte')       => 'row_bg_left_content',
        ),
        'edit_field_class' => 'vc_col-sm-6',
        'group'       => esc_html__('Alacarte Custom', 'alacarte')
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__('Row Style', 'alacarte'),
        'param_name'  => 'row_half_background',
        'value'       => array(
            esc_html__('None', 'alacarte')      => '',
            esc_html__('Half Row Background', 'alacarte')       => 'row-half-bg',
            esc_html__('Row Border', 'alacarte')       => 'row-border-bg',
            esc_html__('Row Full Background', 'alacarte')       => 'row-full-bg',
            esc_html__('Row Background Color', 'alacarte')       => 'row-bg-color',
            esc_html__('Row Background Image and overlay color', 'alacarte')       => 'vc_row-bg-image-overlay-color',
            esc_html__('Row No Padding', 'alacarte')       => 'vc_row-no-padding',
            esc_html__('Row Padding 225px', 'alacarte')       => 'vc_row-padding-225',
            esc_html__('Row Default Display Flex', 'alacarte')       => 'vc_row-default-display-flex',
            esc_html__('Row Default Padding', 'alacarte')       => 'vc_row-default-padding',

        ),
        'edit_field_class' => 'vc_col-sm-6',
        'group'       => esc_html__('Alacarte Custom', 'alacarte')
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__('Row Display', 'alacarte'),
        'param_name'  => 'row_display_default',
        'value'       => array(
            esc_html__('None', 'alacarte')      => '',
            esc_html__('Row Default Display Flex', 'alacarte')       => 'vc_row-default-display-flex'

        ),
        'edit_field_class' => 'vc_col-sm-6',
        'group'       => esc_html__('Alacarte Custom', 'alacarte')
    ),
));
/**
 *
 * Custom  VC Column
 *
 */
vc_add_params('vc_column', array(
    array(
        'type'        => 'dropdown',
        'heading'     => esc_html__('Text Align', 'alacarte'),
        'param_name'  => 'vc_col_content_align',
        'value'       => array(
            esc_html__('Default', 'alacarte') => '',
            esc_html__('Center', 'alacarte')  => 'text-center',
            esc_html__('Left', 'alacarte')  => 'text-left',
            esc_html__('Right', 'alacarte')  => 'text-right',
        ),
        'edit_field_class' => 'vc_col-sm-6',
        'group'       => esc_html__('Alacarte Custom', 'alacarte')
    ),
    array(
        "type" => "dropdown",
        "class" => "",
        "heading" => esc_html__("Reservation Style", 'alacarte'),
        "admin_label" => true,
        "param_name" => "reservation_style",
        "value" => array(
            "Style 1" => "",
            "Style 2" => "reservation-style2",
            "Style 3" => "reservation-style3",
            "Style 4" => "reservation-style4"
        ),
        'edit_field_class' => 'vc_col-sm-6',
        'group'       => esc_html__('Alacarte Custom', 'alacarte')
    ), array(
        "type" => "dropdown",
        "class" => "",
        "heading" => esc_html__("Order Column", 'alacarte'),
        "admin_label" => true,
        "param_name" => "order_style",
        "value" => array(
            "Default" => "",
            "First" => "order-md-first",
            "Last" => "order-md-last",
        ),
        'edit_field_class' => 'vc_col-sm-6',
        'group'       => esc_html__('Alacarte Custom', 'alacarte')
    ),
    array(
        "type" => "dropdown",
        "heading" => esc_html__("Contact Form 7 Style",'alacarte'),
        "admin_label" => true,
        "param_name" => "contact_style",
        "value" => array(
            esc_html__('None','alacarte') => '',
            esc_html__('Style 1','alacarte') => 'contact-style1',
            esc_html__('Style 2','alacarte') => 'contact-style2',
            esc_html__('Style 3','alacarte') => 'contact-style3',
        ),
        "std" => '',
        'edit_field_class' => 'vc_col-sm-6',
        'group'       => esc_html__('Alacarte Custom', 'alacarte')
    ),
    array(
        "type" => "dropdown",
        "heading" => esc_html__("Priority",'alacarte'),
        "admin_label" => true,
        "param_name" => "priority_style",
        "value" => array(
            esc_html__('None','alacarte') => '',
            esc_html__('Priority 1','alacarte') => 'priority-style1',
        ),
        "std" => '',
        'edit_field_class' => 'vc_col-sm-6',
        'group'       => esc_html__('Alacarte Custom', 'alacarte')
    ),
    array(
        "type" => "dropdown",
        "heading" => esc_html__("Box Shadow",'alacarte'),
        "admin_label" => true,
        "param_name" => "col_box_shadow",
        "value" => array(
            esc_html__('None','alacarte') => '',
            esc_html__('Box Shadow','alacarte') => 'col-box-shadow',
        ),
        "std" => '',
        'edit_field_class' => 'vc_col-sm-6',
        'group'       => esc_html__('Alacarte Custom', 'alacarte')
    ),

));
/**
 *
 * Custom  VC custom heading
 * 
 *
 */
vc_add_params('vc_custom_heading', array(
    array(
        "type" => "dropdown",
        "heading" => esc_html__("Heading on Footer",'alacarte'),
        "admin_label" => true,
        "param_name" => "el_class",
        "value" => array(
            esc_html__('None','alacarte') => '',
            esc_html__('Heading Title','alacarte') => 'widget-title',
        ),
        "std" => '',
    ),
));
/**
*
* Custom  VC Column Text
*
 */
vc_add_params('vc_column_text', array(
    array(
        "type" => "dropdown",
        "heading" => esc_html__("List Style",'alacarte'),
        "admin_label" => true,
        "param_name" => "list_style",
        "value" => array(
            esc_html__('None','alacarte') => '',
            esc_html__('Primary list','alacarte') => 'primary-list',
            esc_html__('Checked list','alacarte') => 'checked-list',
            esc_html__('Arrow list','alacarte') => 'arrow-list',
        ),
        "std" => '',
        'group'       => esc_html__('Syring Custom', 'alacarte')
    ),
    array(
        "type" => "textfield",
        "heading" => esc_html__("Font size",'alacarte'),
        "param_name" => "font_size",
        "value" => "",
        'group'       => esc_html__('Syring Custom', 'alacarte')
    ),

    array(
        "type" => "textfield",
        "heading" => esc_html__("Line height",'alacarte'),
        "param_name" => "line_height",
        "value" => "",
        'group'            => esc_html__('Syring Custom', 'alacarte')
    ),
    array(
        "type" => "textfield",
        "heading" => esc_html__("Letter spacing (0.3px, 0.03em)",'alacarte'),
        "param_name" => "letter_spacing",
        "value" => "",
        'group'       => esc_html__('Syring Custom', 'alacarte')
    ),
    array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => esc_html__("Color", 'alacarte'),
        "param_name" => "color",
        "value" => "",
        'group'       => esc_html__('Syring Custom', 'alacarte')
    ),
));