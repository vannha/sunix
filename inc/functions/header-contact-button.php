<?php
/**
 * Header Contact Button
 * @since 1.0.0 
*/
if(!function_exists('alacarte_header_contact')){
	function alacarte_header_contact($args = []){
		$args = wp_parse_args($args, [
			'before' => '',
			'after'  => '',
		]);
		$show_contact = alacarte_get_opts('header_contact', '0');
		$show_contact_page = alacarte_get_page_opt('header_contact', '-1');
		if($show_contact_page === '-1')
			$cf7_ID = alacarte_get_theme_opt('header_contact_form','0');
		else 
			$cf7_ID = alacarte_get_opts('header_contact_form','0');
		if('0' === $show_contact || 'none' === $cf7_ID || '0' === $cf7_ID ) return;

		printf('%s', $args['before']);
	?>
		<a href="#red-header-contact" class="red-header-popup header-extra-icon btn-nav active"><?php esc_html_e('Contact Me','alacarte'); ?></a>
	<?php
		printf('%s', $args['after']);
	}
}

if(!function_exists('alacarte_header_contact_popup_html')){
	function alacarte_header_contact_popup_html(){
		$show_contact = alacarte_get_opts('header_contact', '0');
		$show_contact_page = alacarte_get_page_opt('header_contact', '-1');
		if($show_contact_page === '-1')
			$cf7_title = alacarte_get_theme_opt('header_contact_form','0');
		else 
			$cf7_title = alacarte_get_opts('header_contact_form','0');
		if('0' === $show_contact || 'none' === $cf7_title || '0' === $cf7_title || !class_exists('WPCF7')) return;
	?>
		<div id="red-header-contact" class="mfp-hide container"><div class="row"><div class="col-lg-6 offset-lg-3 popup-content bg-white"><?php echo do_shortcode('[contact-form-7 title="'.esc_attr($cf7_title).'"]'); ?></div></div></div>
	<?php
	}
}
add_action('wp_footer','alacarte_header_contact_popup_html');