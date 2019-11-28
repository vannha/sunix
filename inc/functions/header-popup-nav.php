<?php
/**
 * Add Header Popup Nav Icon
 * @since 1.0
*/
if(!function_exists('sunix_header_popup_nav_icon')){
	function sunix_header_popup_nav_icon($args = []){
		$header_popup_nav = sunix_get_opts('header_popup_nav', '0');
		$header_popup_menu = sunix_get_opts('header_popup_menu', '0');
		if('0' === $header_popup_nav || 'none' === $header_popup_menu) return;

		if('-1' === sunix_get_page_opt('header_popup_nav', '-1'))
			$icon_type = sunix_get_theme_opt('header_popup_nav_icon_type','text');
		else
			$icon_type = sunix_get_opts('header_popup_nav_icon_type','text');

		$args = wp_parse_args($args, [
			'before' => '<span id="red-main-popup-nav" class="header-extra-icon">',
			'after'  => '</span>',
			'type'	 => $icon_type
		]);

		echo wp_kses_post($args['before']);
		switch ($args['type'] ) {
			case 'text':
				echo sprintf('<a href="#red-popupnav" class="red-header-popup tooltip nav-link" title="%s">%s</a>',
					esc_attr__('Open Menu','sunix'),
					esc_html__('Menu','sunix')
				);
				break;
			default:
				echo '<a href="#red-popupnav" class="red-header-popup tooltip nav-link">';
					sunix_header_mobile_nav_icon(['title' => esc_html__('Show Menu','sunix'), 'class' => $args['type']]);
				echo '</a>';
				break;
		}
		echo wp_kses_post($args['after']);
	}
}

if(!function_exists('sunix_popup_nav')){
	function sunix_popup_nav($args = []){
		$header_popup_nav = sunix_get_opts('header_popup_nav', '0');
		$header_popup_menu = sunix_get_opts('header_popup_menu','0');
		if('0' === $header_popup_nav || 'none' === $header_popup_menu) return;
		$args = wp_parse_args($args, [
			'before' => '<div id="red-popupnav" class="mfp-hide text-center container">',
			'after'  => '</div>',
			'class'  => ''
		]);

		$menu_args =  array(
			'menu'                         => $header_popup_menu,
			'container'                    => 'div',
			'container_class'              => 'red-main-nav',
			'menu_id'                      => 'popup-nav',
			'menu_class'                   => 'popup-nav',
			'sunix_nav_extra_class' => 'popup-item'
		);
		if(has_nav_menu('red-primary')){
			$menu_args['theme_location'] = 'red-primary';
			$menu_args['walker'] = class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '';
		}

		echo wp_kses_post($args['before']);
			wp_nav_menu($menu_args);
			if(is_active_sidebar('sidebar-popup')){
				echo '<div id="sidebar-popup" class="text-start">';
				dynamic_sidebar('sidebar-popup');
				echo '</div>';
			}
		echo wp_kses_post($args['after']);
	}
}
add_action('wp_footer','sunix_popup_nav', 1);