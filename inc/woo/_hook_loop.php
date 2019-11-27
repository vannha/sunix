<?php

/**
 * Remove all default WC css
*/
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Loop Products 
 * Remove Shop Title
 *
*/
add_filter('woocommerce_show_page_title', function(){ return false;});

/**
 * Archive product 
 * Wrap Result Count and Catalog Ordering
 * Hook: woocommerce_before_shop_loop.
 *
 * @hooked woocommerce_result_count - 20
 * @hooked woocommerce_catalog_ordering - 30
*/
remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);
add_action('woocommerce_before_shop_loop','alacarte_woocommerce_count_ordering', 11);
add_action('alacarte_woocommerce_count_ordering','woocommerce_result_count',20);
add_action('alacarte_woocommerce_count_ordering','woocommerce_catalog_ordering',30);
function alacarte_woocommerce_count_ordering(){
?>
	<div class="red-woo-count-order d-flex justify-content-between align-items-center">
		<?php do_action('alacarte_woocommerce_count_ordering'); ?>
	</div>
<?php
}


/**
 * Add an action to call all AlaCarte function
 * before shop loop
 *
*/
if(!function_exists('alacarte_woocommerce_before_shop_loop')){
	add_action('woocommerce_before_shop_loop', 'alacarte_woocommerce_before_shop_loop', 12);
	function alacarte_woocommerce_before_shop_loop(){
		do_action('alacarte_woocommerce_before_shop_loop');
	}
}
function alacarte_loop_columns(){
    $col_number = alacarte_get_opts('products_columns','3');
    if(isset($_GET['col_number']) && !empty($_GET['col_number']))
        $col_number = $_GET['col_number'];
    return $col_number;
}

/**
 * Change number of products that are displayed per page (shop page)
 * $limit contains the current number of products per page based on the value stored on Options -> Reading
 * Return the number of products you wanna show per page.
 * 
 */
add_filter( 'loop_shop_per_page', 'alacarte_loop_shop_per_page', 20 );
function alacarte_loop_shop_per_page( $limit ) {
  $limit = alacarte_get_opts('products_per_page', 9);
  return $limit;
}

/**
 * Paginate
*/
add_filter('woocommerce_pagination_args','alacarte_woocommerce_pagination_args');
function alacarte_woocommerce_pagination_args($args){
	$custom = [
		'type'      => 'plain',
        'prev_text' => '<span class="prev">'.esc_html__('Previous', 'alacarte').'</span>',
        'next_text' => '<span class="next">'.esc_html__('Next', 'alacarte').'</span>'
    ];
	$args = array_merge($args, $custom);
	return $args;
}
if ( ! function_exists( 'woocommerce_pagination' ) ) {
	/**
	 * Output the pagination.
	 */
	function woocommerce_pagination() {
		if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
			return;
		}

		$args = array(
			'total'   => wc_get_loop_prop( 'total_pages' ),
			'current' => wc_get_loop_prop( 'current_page' ),
			'base'    => esc_url_raw( add_query_arg( 'product-page', '%#%', false ) ),
			'format'  => '?product-page=%#%',
		);

		if ( ! wc_get_loop_prop( 'is_shortcode' ) ) {
			$args['format'] = '';
			$args['base']   = esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
		}
		$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
		$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
		$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
		$format  = isset( $format ) ? $format : '';

		if ( $total <= 1 ) {
			return;
		}
	?>
	<div class="red-loop-pagination">
		<div class="nav-links">
			<?php
				echo paginate_links( apply_filters( 'woocommerce_pagination_args', array( // WPCS: XSS ok.
					'base'         => $base,
					'format'       => $format,
					'add_args'     => false,
					'current'      => max( 1, $current ),
					'total'        => $total,
					'prev_text'    => '&larr;',
					'next_text'    => '&rarr;',
					'type'         => 'list',
					'end_size'     => 3,
					'mid_size'     => 3,
				) ) );
			?>
		</div>
	</div>
	<?php
	}
}