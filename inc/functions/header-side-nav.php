<?php
/**
 * Add Header Side Nav Icon
 * @since 1.0
*/
if(!function_exists('sunix_header_side_nav_icon')){
	function sunix_header_side_nav_icon($args = []){
		$show_sidenav = sunix_get_opts('header_side_nav', '0');
		if('0' === $show_sidenav || !is_active_sidebar('sidebar-nav')) return;

		if('-1' === $show_sidenav)
			$icon_type = sunix_get_theme_opt('header_side_nav_icon_type','icon');
		else
			$icon_type = sunix_get_opts('header_side_nav_icon_type','icon');

		$args = wp_parse_args($args, [
			'before'    => '<span id="red-main-sidenav" class="header-extra-icon">',
			'after'     => '</span>',
			'icon_type' => $icon_type
		]);
		echo wp_kses_post($args['before']);
			sunix_header_mobile_nav_icon(['title' => esc_html__('Show Sidebar','sunix'), 'class' => $args['icon_type']]);
		echo wp_kses_post($args['after']);
	}
}

if(!function_exists('sunix_side_nav')){
	function sunix_side_nav($args = []){
		$show_sidenav = sunix_get_opts('header_side_nav', '0');
		if('0' === $show_sidenav || !is_active_sidebar('sidebar-nav')) return;
		$args = wp_parse_args($args, [
			'before' => '<div id="red-sidenav"><div id="red-close-sidenav" class="red-close"><i class="flaticon-add"></i></div><div class="red-mousewheel"><div class="red-mousewheel-inner">',
			'after'  => '</div></div></div>',
			'class'  => ''
		]);
		echo wp_kses_post($args['before']);
			dynamic_sidebar('sidebar-nav');
		echo wp_kses_post($args['after']);
	}
}
add_action('wp_footer','sunix_side_nav', 1);