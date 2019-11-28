<?php
/**
 * Header Helper Menu 
*/
if(!function_exists('sunix_header_helper_menu')){
    function sunix_header_helper_menu($args = []){
        $header_helper_menu = sunix_get_opts('header_helper_menu','-1');
        if(!is_nav_menu($header_helper_menu)) return;
        $args = wp_parse_args($args,[
            'class'      => 'justify-content-end',
            'menu_class' => 'd-flex align-items-center'
        ]);
        $container_class = trim(implode(' ', ['red-header-helper', 'align-items-center', 'd-none', 'd-xl-flex', $args['class']]));
        $menu_class      = trim(implode(' ', ['red-header-helper-menu', $args['menu_class']]));
        $args =  array(
            'menu'           => $header_helper_menu,
            'container'      => 'div',
            'container_class'=> $container_class,
            'depth'          => '1',
            'menu_id'        => 'red-header-helper-menu',
            'menu_class'     => $menu_class,
            'fallback_cb'    => false
        );
        wp_nav_menu($args);
    }
}