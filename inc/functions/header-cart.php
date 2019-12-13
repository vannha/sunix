<?php
/**
 * Header WC Cart 
 * @since 1.0.0
*/
if(!function_exists('sunix_header_cart')){
	function sunix_header_cart($args = []){
		$args = wp_parse_args($args, [
			'before' => '',
			'after'  => '', 
			'icon'	 => 'fas fa-shopping-bag'
		]);
		if(!class_exists( 'WooCommerce' )) return;
		$show_cart = sunix_get_opts('header_cart', '0');
		if('0' === $show_cart) return;
		echo wp_kses_post($args['before']);
	?>
		<a href="#red-cart-popup" class="red-header-popup red-header-cart-icon header-icon has-badge"><span class="icon <?php echo esc_attr($args['icon']);?>"><span class="header-count cart_total"><?php echo WC()->cart->cart_contents_count; ?></span></span></a>
	<?php
		echo wp_kses_post($args['after']);
	}
}
/**
 * Add Header WooCommerce Cart 
 * @since 1.0.0
 */
if(!function_exists('sunix_header_wc_cart')){
	add_filter('woocommerce_add_to_cart_fragments', 'sunix_woocommerce_add_to_cart_fragments', 10, 1 );
	function sunix_header_wc_cart() {
	    if(!class_exists('WooCommerce')) return;
	    $show_cart = sunix_get_opts('header_cart', '0');
	    if('0' === $show_cart) return;
	    ?>
	    <div id="red-cart-popup" class="cartform mfp-hide container">
	    	<div class="row justify-content-center">
	    		<div class="col-auto">
			        <div class="widget_shopping_cart">
			            <div class="widget_shopping_cart_content">
			                <?php woocommerce_mini_cart(); ?>
			            </div>
			        </div>
			    </div>
			</div>
	    </div>
	    <?php
	}
	add_action('wp_footer', 'sunix_header_wc_cart');
}
if(!function_exists('sunix_woocommerce_add_to_cart_fragments')){
    function sunix_woocommerce_add_to_cart_fragments( $fragments ) {
    	if(!class_exists('WooCommerce')) return;
        ob_start();
        ?>
        <span class="header-count cart_total"><?php echo WC()->cart->cart_contents_count; ?></span>
        <?php
        $fragments['.cart_total'] = ob_get_clean();
        return $fragments;
    }
}
