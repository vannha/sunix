<?php 
/**
 * Custom output HTML of some widget 
*/
/**
 * Widget
 * Expander parent item
*/
if(!function_exists('sunix_widget_expander')){
    add_filter('ef5systems_megamenu_expander', 'sunix_widget_expander'); // add expander for megamenu
    function sunix_widget_expander(){
        return '<span class="red-toggle"><span class="red-toggle-inner"></span></span>';
    }
}

/**
 * Widget Categories
 * Custom HTML output
*/
if(!function_exists('sunix_widget_categories_args')){
    add_filter('widget_categories_args', 'sunix_widget_categories_args');
    function sunix_widget_categories_args($cat_args){
        $cat_args['walker'] = new sunix_Categories_Walker;
        return $cat_args; 
    }
}

/** 
 * Custom Widget Archive 
 * This code filters the Archive widget to include the post count inside the link 
 * @since 1.0.0
*/
if(!function_exists('sunix_get_archives_link_text')){
    add_filter('get_archives_link', 'sunix_get_archives_link_text', 10, 6);
    function sunix_get_archives_link_text($link_html, $url, $text, $format, $before, $after ){
        $text = wptexturize( $text );
        $url  = esc_url( $url );
     
        if ( 'link' == $format ) {
            $link_html = "\t<link rel='archives' title='" . esc_attr( $text ) . "' href='$url' />\n";
        } elseif ( 'option' == $format ) {
            $link_html = "\t<option value='$url'>$before $text $after</option>\n";
        } elseif ( 'html' == $format ) {
            $link_html = "\t<li>$before<a href='$url'><span class='title'>$text</span></a>$after</li>\n";
        } else { // custom
            $link_html = "\t$before<a href='$url'><span class='title'>$text</span>$after</a>\n";
        }
        return $link_html;
    }
}

if(!function_exists('sunix_archive_count_span')){
    add_filter('get_archives_link', 'sunix_archive_count_span');
    function sunix_archive_count_span($links) {
        $links = str_replace('<li>', '<li class="red-menu-item">', $links);
        $links = str_replace('</a>&nbsp;(', ' <span class="count">', $links);
        $links = str_replace(')</li>', '</span></a></li>', $links);
        return $links;
    }
}

/**
 * Widget Page
 * Custom output HTMl
*/
if(!function_exists('sunix_widget_page_args')){
    add_filter('widget_pages_args', 'sunix_widget_page_args');
    function sunix_widget_page_args($page_args){
        $page_args['walker'] = new sunix_Page_Walker;
        return $page_args; 
    }
}

/**
 * Widget Navigation
 * Custom HTML Output
 * 
*/
if(!function_exists('sunix_widget_navigation_menu')){
    add_filter('widget_nav_menu_args', 'sunix_widget_navigation_menu');
    function sunix_widget_navigation_menu($nav_menu_args){
        $nav_menu_args['walker'] = new sunix_Menu_Walker();
        return $nav_menu_args;
    }
}

/**
 * Widget Tag Cloud WP / WooCommerce
 * Change separator text, font size, ...
 * Hook filter: widget_tag_cloud_args, woocommerce_product_tag_cloud_widget_args
*/
if(!function_exists('sunix_widget_tag_cloud_args')){
    add_filter('widget_tag_cloud_args', 'sunix_widget_tag_cloud_args');
    function sunix_widget_tag_cloud_args($args){
        $_args =[
            'smallest'  => '12',
            'largest'   => '12',
            'unit'      => 'px',
            'separator' => ''
        ];
        $args = wp_parse_args($args, $_args);
        return $args;
    }
}
if(!function_exists('sunix_woocommerce_widget_tag_cloud_args')){
    add_filter('woocommerce_product_tag_cloud_widget_args', 'sunix_woocommerce_widget_tag_cloud_args');
    function sunix_woocommerce_widget_tag_cloud_args($args){
        $_args =[
            'smallest'  => '12',
            'largest'   => '12',
            'unit'      => 'px',
            'separator' => ''
        ];
        $args = wp_parse_args($args, $_args);
        return $args;
    }
}