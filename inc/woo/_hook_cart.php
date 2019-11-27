<?php
/**
 * Change cart item thumbnail size 
*/
if(!function_exists('alacarte_woocommerce_cart_item_thumbnail')){
	add_filter('woocommerce_cart_item_thumbnail','alacarte_woocommerce_cart_item_thumbnail', 10, 3);
	function  alacarte_woocommerce_cart_item_thumbnail($thumbnail, $cart_item, $cart_item_key){
		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		$thumbnail_id = get_post_thumbnail_id($product_id);
		$thumbnail = alacarte_image_by_size(['id' => $thumbnail_id, 'size' => apply_filters('alacarte_woocommerce_cart_item_thumbnail_size', '100x100'),'echo'   => false]);
		return $thumbnail;
	}
}

/**
 * Change Cart Item Name output
 *
 * Add Product Brand at Top
 * Filter: woocommerce_cart_item_name
*/

if(!function_exists('alacarte_woocommerce_cart_item_name')){
	add_filter('woocommerce_cart_item_name','alacarte_woocommerce_cart_item_name', 10, 3);
	function alacarte_woocommerce_cart_item_name($name, $cart_item, $cart_item_key){
		$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

		$terms = get_the_terms($product_id, 'pa_brand');
        if(!is_wp_error($terms)){
            $count = count($terms);
        } else {
            $count = 0;
        }
        $brand = '';
        if(is_array($terms) && $count > 0) {
        	$brand = '<div class="cart-item-brand">';       
            foreach ( $terms as $term ) {
                $brand .=  '<div class="wc-brand '.strtolower(str_replace(array(' ','&','amp;'), '-', $term->name)).'">'.$term->name.'</div>';
            }
         	$brand .= '</div>';
        }

		$name = '<div class="cart-item-name-wrap">';
			$name .= $brand;

			if ( ! $product_permalink ) {
				$name .= $_product->get_name();
			} else {
				$name .= sprintf( '<a class="cart-item-name" href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() );
			}
		$name .= '</div>';
		return $name;
	}
}


/**
 * After Cart Table
 *
 * Add Back to Shop button
 * Add Clear Cart Button
 * Add Update Cart Button
 * Add Process to Checkout button
 *
*/
if(!function_exists('alacarte_woocommerce_after_cart_table')){
	add_action('woocommerce_cart_actions','alacarte_woocommerce_after_cart_table', 1);
	function alacarte_woocommerce_after_cart_table(){
	?>
        <?php do_action('alacarte_woocommerce_after_cart_table_left'); ?>
	<?php
	}
}
/* Return Shop Button */
if(!function_exists('alacarte_woocommerce_return_shop')){
	add_action('woocommerce_cart_actions', 'alacarte_woocommerce_return_shop');
	function alacarte_woocommerce_return_shop(){
		if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
			<a class="btn continue-shopping" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
				<?php esc_html_e( 'Continue Shopping', 'alacarte' ); ?>
			</a>
		<?php endif;
	}
}

// check for empty-cart get param to clear the cart
if(!function_exists('alacarte_woocommerce_clear_cart_url')){
	add_action( 'init', 'alacarte_woocommerce_clear_cart_url' );
	function alacarte_woocommerce_clear_cart_url() {
		if ( isset( $_GET['empty-cart'] ) ) {
			WC()->cart->empty_cart();
		}
	}
}
if(!function_exists('alacarte_woocommerce_clear_cart_button')){
	add_action('alacarte_woocommerce_after_cart_table_left', 'alacarte_woocommerce_clear_cart_button');
	function alacarte_woocommerce_clear_cart_button(){
		$link = wc_get_cart_url();
        $link = add_query_arg( 'empty-cart', '', $link );
		?>
			<a class="btn" href="<?php echo esc_url($link);?>"><?php esc_html_e( 'Clear Cart', 'alacarte' ); ?></a>
		<?php
	}
}

/**
 * Custom Cross Sells Columns and Limit
 *
*/
add_filter('woocommerce_cross_sells_columns', function() { return apply_filters('alacarte_woocommerce_cross_sells_columns', '4');});
add_filter('woocommerce_cross_sells_total', function() { return apply_filters('alacarte_woocommerce_cross_sells_columns', '4');});

