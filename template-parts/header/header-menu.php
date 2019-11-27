<?php
/**
 * Template part for displaying the primary menu of the site
 */
$header_menu   = alacarte_get_opts('header_menu','');
if('none' === $header_menu) return;

/* Mega Menu */
$megamenu = apply_filters('ef5_enable_megamenu', false);
$args =  array(
    'theme_location' => 'red-primary',
    'menu'           => $header_menu,
    'container'      => '',
    'menu_id'        => 'red-header-menu',
    'menu_class'     => alacarte_header_menu_class(),
    'link_before'	 => '<span class="menu-title">',
    'link_after'	 => '</span>',	
    'walker'         => ($megamenu && class_exists( 'EF5Systems_MegaMenu_Walker' )) ? new EF5Systems_MegaMenu_Walker : new alacarte_Main_Menu_Walker,
    'fallback_cb' =>   'alacarte_header_menu_fallback'
);
wp_nav_menu($args);
