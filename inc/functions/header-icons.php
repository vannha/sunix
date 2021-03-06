<?php
/**
 * All header icon
 *
*/
if(!function_exists('sunix_header_mobile_menu_icon')){
	function sunix_header_mobile_menu_icon(){
		$header_menu = sunix_get_opts('header_menu');
		if($header_menu === 'none') return;
		if('-1' === sunix_get_page_opt('header_mobile_nav_icon_type','icon'))
			$icon_style = sunix_get_theme_opt('header_mobile_nav_icon_type','icon');
		else 
			$icon_style = sunix_get_opts('header_mobile_nav_icon_type','icon');

		switch ($icon_style) {
			case 'text':
				echo '<span id="red-main-menu-mobile" class="text d-inline d-xl-none"><span class="btn-nav-mobile open-menu">'.esc_html__('Menu','sunix').'</span></span>';
				break;
			default:
				sunix_header_mobile_nav_icon(['id' => 'red-main-menu-mobile','class' => 'header-extra-icon d-inline d-xl-none']);
			break;
		}
	}
}

/**
 * Add Header Mobile Nav Icon 
 * @since 1.0
*/
if(!function_exists('sunix_header_mobile_nav_icon')){
	function sunix_header_mobile_nav_icon($args = []){
		$args = wp_parse_args($args, [
			'before'    => '',
			'after'     => '',
			'id' 		=> '',
			'class' 	=> '',
			'title'     => esc_html__('Show menu','sunix')
		]);
		echo wp_kses_post($args['before']);
		$wrap_classes = ['btn-nav-mobile-wrap', $args['class']];
		$classes = ['btn-nav-mobile open-menu'];
	?>
		<span <?php if(!empty($args['id'])) : ?> id="<?php echo esc_attr($args['id']);?>" <?php endif; ?> class="<?php echo trim(implode(' ', $wrap_classes)); ?>">
	        <span class="<?php echo trim(implode(' ', $classes)); ?>" title="<?php echo esc_attr($args['title']);?>">
	            <span></span>
	        </span>
	    </span>
	<?php
		echo wp_kses_post($args['after']);
	}
}