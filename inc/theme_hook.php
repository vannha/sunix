<?php
/**
 * Primary Color 
 * use filter: 'alacarte_primary_color';
 * @return string
 * @example add_filter('alacarte_primary_color', function(){ return '#000000';});
*/
/**
 * Accent Color 
 * use filter : alacarte_accent_color
 * @return string
 * @example add_filter('alacarte_accent_color', function(){ return '#25d6a2';});
*/

/**
 * Page CSS Class
 * use filter: alacarte_page_css_class
 * @return array
 * @example add_filter('alacarte_page_css_class', function($cls) { $cls[] = 'yout-css-class';  return $cls;});
*/

/**
 * Header link color, 
 * use filter: alacarte_header_link_color
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('alacarte_header_link_color', function(){ return ['regular' => 'black', 'hover' => 'red', 'active' => 'violet'];})
*/
/**
 * Header OnTop link color, 
 * use filter: alacarte_ontop_link_color
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('alacarte_ontop_link_color', function(){ return ['regular' => 'black', 'hover' => 'red', 'active' => 'violet'];})
*/

/**
 * Header Sticky link color, 
 * use filter: alacarte_sticky_link_color
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('alacarte_sticky_link_color', function(){ return ['regular' => 'black', 'hover' => 'red', 'active' => 'violet'];})
*/

/**
 * Dropdown Background color, 
 * use filter: alacarte_dropdown_bg
 * 
 * @return string
 * @example add_filter('alacarte_dropdown_bg', function(){ return 'rgba(#000000, 1)';})
*/

/**
 * Dropdown link color, 
 * use filter: alacarte_dropdown_link_colors
 * 
 * @return array('regular' => '', 'hover' => '', 'active' => '')
 * @example add_filter('alacarte_dropdown_link_colors', function(){ return ['regular' => 'white', 'hover' => 'red', 'active' => 'violet'];})
*/

/**
 * Logo Size
 * use filter: alacarte_logo_size
 * @return array(width, height, units)
 * @example add_filter('alacarte_logo_size', function() { return ['width' => '130', 'height' => '51', 'units' => 'px'];});
*/

/**
 * Show Default Post thumbnail
 * use filter : alacarte_default_post_thumbnail
 * @return bool
 * @default false
 * @example add_filter('alacarte_default_post_thumbnail', function(){ return false;});
*/

/**
 * Default sidebar position 
 * use filter: alacarte_archive_sidebar_position
 * @return string left / right / none
 * @example add_filter('alacarte_archive_sidebar_position', function(){ return 'right';});
*/

/**
 * Default Archive grid columns
 * use filter : alacarte_archive_grid_col
 * @return string 1 - 12
 * @example add_filter('alacarte_archive_grid_col', function(){ return '8';});
*/

/**
 * Default Archive Pagination
 * use filter: alacarte_loop_pagination
 * @return string 1 - 5
 * @example: add_filter('alacarte_loop_pagination', function(){ return '3';});
*/

/**
 * Default Archive Pagination Prev Text
 * use filter: alacarte_loop_pagination_prev_text
 * @return string 
 * @example: add_filter('alacarte_loop_pagination_prev_text', function(){ return esc_html__('Previous', 'alacarte');});
*/

/**
 * Default Archive Pagination Next Text
 * use filter: alacarte_loop_pagination_next_text
 * @return string 
 * @example: add_filter('alacarte_loop_pagination_next_text', function(){ return esc_html__('Next', 'alacarte');});
*/

/**
 * Default Archive Pagination Sep Text
 * use filter: alacarte_loop_pagination_sep_text
 * @return string 
 * @example: add_filter('alacarte_loop_pagination_sep_text', function(){ return '<span class="d-none"></span>';});
*/

/**
 * Show post related by taxonomy
 * use filter: alacarte_post_related_by
 * @return string
 * @default cat
 * @example add_filter('alacarte_post_related_by', function(){return 'cat';});
*/

/**
 * Remove Supported post type for VC Element 
 * use filter : alacarte_vc_post_type_list
 * @return array
 * @example add_filter('alacarte_vc_post_type_list', function($post_type){ $post_type[] = 'alacarte_header_top'; return $post_type;});
*/

// Support Portfolio or Not
add_filter('alacarte_cpts_portfolio',function(){ return true;});
// Support header Top
add_filter('alacarte_cpts_header_top', function(){ return true;});
// Support Footer Top
add_filter('alacarte_cpts_footer', function(){ return true;});

/**
 * Custom WooCommerce
 * Custom single images, loop images, gallery thumbnail, cart thumbnail size
 * 
*/
/**
 * WooCommerce loop thumbnail size
 * use filter: 
 * width: alacarte_product_loop_image_w
 * height: alacarte_product_loop_image_h
 * @return string
 * @example 
 * widht : apply_filters('alacarte_product_loop_image_w', funtion(){ return '400';});
 * height : apply_filters('alacarte_product_loop_image_h', funtion(){ return '400';});
*/

/**
 * WooCommerce single thumbnail size
 * use filter: 
 * width: alacarte_product_single_image_w
 * height: alacarte_product_single_image_h
 * @return string
 * @example 
 * widht : apply_filters('alacarte_product_single_image_w', funtion(){ return '600';});
 * height : apply_filters('alacarte_product_single_image_h', funtion(){ return '600';});
*/

/**
 * WooCommerce gallery thumbnail size
 * use filter: 
 * width: alacarte_product_gallery_thumbnail_w
 * height: alacarte_product_gallery_thumbnail_h
 * @return string
 * @example 
 * widht : apply_filters('alacarte_product_gallery_thumbnail_w', funtion(){ return '100';});
 * height : apply_filters('alacarte_product_gallery_thumbnail_h', funtion(){ return '100';});
*/

/**
 * WooCommerce cart thumbnail size
 * use filter: 
 * size: alacarte_woocommerce_cart_item_thumbnail_size
 * @return string
 * @example 
 * size : apply_filters('alacarte_woocommerce_cart_item_thumbnail_size', funtion(){ return '100x100';});
 * 
*/
