<?php
/**
 * Header Search Icon
 * @since 1.0.0 
*/
if(!function_exists('sunix_header_search')){
	function sunix_header_search($args = []){
		$args = wp_parse_args($args, [
			'before' => '',
			'after'  => '',
			'icon'	 => 'fal fa-search',
			'type'	 => ''
		]);
		$show_search = sunix_get_opts('header_search', '0');
		if('0' === $show_search) return;

		$link_classes = ['header-icon'];
		
		if($args['type'] === 'popup'){
			$link_classes[] = 'red-header-popup ';
			$form_classes[] = 'mfp-hide container';
		} else {
			$link_classes[] = 'red-search-toggle';
		}
		echo wp_kses_post($args['before']);
	?>
        <a href="#red-header-search" class="<?php echo trim(implode(' ', $link_classes));?>"><span class="icon <?php echo esc_attr($args['icon']);?>"></span> <span class="span-text"><?php esc_html_e('Search','sunix')?></span></a>
	<?php
		echo wp_kses_post($args['after']);
	}
}

if(!function_exists('sunix_header_search_popup_html')){
	function sunix_header_search_popup_html($args = []){
		$show_search = sunix_get_opts('header_search', '0');
		if('0' === $show_search) return;
		$form_classes = ['red-searchform'];
		$args = wp_parse_args($args, [
			'icon'	 => 'fal fa-search',
			'type'	 => 'popup'
		]);

		if($args['type'] === 'popup'){
			$form_classes[] = 'mfp-hide container';
		}
	?>
		<div id="red-header-search" class="<?php echo trim(implode(' ', $form_classes));?>">
			<div class="row justify-content-center">
				<div class="col-auto">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	<?php
	}
}
add_action('wp_footer','sunix_header_search_popup_html');