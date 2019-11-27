<?php
if(!function_exists('alacarte_woocommerce_get_price_html')){
	add_filter('woocommerce_get_price_html', 'alacarte_woocommerce_get_price_html', 10, 1);
	function alacarte_woocommerce_get_price_html($price){
		$class = is_singular('product') ? 'single' : 'loop';
		return '<div class="red-products-price '.esc_attr($class).'">'.$price.'</div>';
	}
}