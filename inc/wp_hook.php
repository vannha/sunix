<?php
// Body Class
add_filter('body_class', 'sunix_body_class');
function sunix_body_class($classes){
	$header_ontop = sunix_get_opts('header_ontop', '0');
	$header_sticky = sunix_get_opts('header_sticky', '0');

	$classes[] = 'header-'.sunix_get_opts('header_layout', '1');
	// Header Ontop / Sticky
	if($header_ontop === '1' || $header_sticky === '1')
		$classes[] = 'side-header-ontop';
	// Boxed
	if (sunix_get_opts('site_layout', '-1') === 'boxed')
		$classes[] = 'site-boxed site-custom-vc-row';
	// Bordered
	if (sunix_get_opts('site_layout', '-1') === 'bordered')
		$classes[] = 'site-bordered body-bordered';

	if(is_singular() && (sunix_get_opts('body_single_boxed', '-1') === 'bordered') && !is_page() ){
		$classes[] = 'single-bordered body-bordered';
	}
     if (class_exists('WooCommerce') && (is_post_type_archive('product')) ) {
         if((sunix_get_opts('woo_shop_sidebar_pos', 'right') === 'none') || (isset($_GET['layout']) && !empty($_GET['layout']) && $_GET['layout']=='none'))
             $classes[] = 'woo-achirve-no-sidebar';
     }

     if (class_exists('WooCommerce') && (is_singular('product')) ) {
         $classes[] = sunix_get_opts('woo_single_footer_layout', '');
     }
     if (!class_exists('EF5Systems') ) {
         $classes[] = 'no-plugin-system';
     }

    $body_padding = sunix_get_page_opt( 'site_bordered_w', ['padding-top' => '', 'padding-right' => '', 'padding-bottom' => '','padding-left'=>''] );
    if (!empty($body_padding['padding-bottom'])){
         $classes[] = 'body-padding-bottom';
    }

    $single_body_padding = sunix_get_opts( 'single_bordered_w', ['padding-top' => '', 'padding-right' => '', 'padding-bottom' => '','padding-left'=>''] );
    if ( is_singular('event') || is_singular('post')) {
        if (!empty($single_body_padding['padding-bottom'])){
            $classes[] = 'body-padding-bottom';
        }
    }


	return $classes;
}