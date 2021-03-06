<?php
/**
 * Header Book Now
 * @since 1.0.0 
*/
if (!class_exists('FlexReservations'))
	return;
if(!function_exists('sunix_header_book_now')) {
	function sunix_header_book_now(){
		$show_book_now = sunix_get_opts('header_book_now', '0');
		if('0' === $show_book_now) return;
		?>
		<a href="#red-header-book-now" class="btn-book-table red-header-popup"> <?php echo esc_html__('Book Now', 'sunix'); ?></a>
		<?php
	}
}
if(!function_exists('sunix_header_book_now3')) {
	function sunix_header_book_now3(){
		$show_book_now = sunix_get_opts('header_book_now', '0');
		if('0' === $show_book_now) return;
		?>
		<a href="#red-header-book-now" class="btn-book-table red-header-popup "> <?php echo esc_html__('Reservation', 'sunix'); ?></a>
		<?php
	}
}

if(!function_exists('sunix_header_book_now_popup_html')){
	function sunix_header_book_now_popup_html(){
		$show_book_now = sunix_get_opts('header_book_now', '0');
		if('0' === $show_book_now) return;
		?>
		<div id="red-header-book-now" class="red-book-now mfp-hide container">
			<div class="row justify-content-center">
				<div class="col-auto">
					<?php echo do_shortcode('[reservation]'); ?>
				</div>
			</div>
		</div>
		<?php
	}
}
add_action('wp_footer','sunix_header_book_now_popup_html');
