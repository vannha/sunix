<?php
/**
 * Build Single Product Gallery and Summary layout 
 *
*/

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
if(!function_exists('alacarte_woocommerce_get_sidebar')){
	add_action('woocommerce_after_main_content','alacarte_woocommerce_get_sidebar', 9);
	function alacarte_woocommerce_get_sidebar(){
        alacarte_sidebar();
    }
}
if(!function_exists('alacarte_woocommerce_before_main_content')){
	add_action('woocommerce_before_main_content','alacarte_woocommerce_before_main_content', 11);
	function alacarte_woocommerce_before_main_content(){
		?><div class="<?php alacarte_content_css_class();?>">
	<?php }
}
if(!function_exists('alacarte_woocommerce_before_main_end_content')){
	add_action('woocommerce_after_main_content','alacarte_woocommerce_before_main_end_content', 6);
	function alacarte_woocommerce_before_main_end_content(){
		?></div>
	<?php }
}

if(!function_exists('alacarte_woocommerce_before_single_product_summary')){
	add_action('woocommerce_before_single_product_summary','alacarte_woocommerce_before_single_product_summary', 0);
	function alacarte_woocommerce_before_single_product_summary(){
		$classes = ['red-wc-img-summary', alacarte_get_opts('product_gallery_layout','simple')];
		echo '<div class="'.trim(implode(' ', $classes)).'">';
	}
}
if(!function_exists('alacarte_woocommerce_after_single_product_summary')){
	add_action('woocommerce_after_single_product_summary','alacarte_woocommerce_after_single_product_summary', 0);
	function alacarte_woocommerce_after_single_product_summary(){
		echo '</div>';
	}
}

/**
 * Wrap Product Image / Gallery in a Div
 * add new acction to add new content
 * new acction: alacarte_before_single_product_gallery, alacarte_after_single_product_gallery
*/
add_action('woocommerce_before_single_product_summary', function() {
	echo '<div class="red-product-gallery-wrap"><div class="red-product-gallery-inner">';
}, 0);
add_action('woocommerce_before_single_product_summary', function() { 
	do_action('alacarte_before_single_product_gallery');
}, 1);
add_action('woocommerce_before_single_product_summary', function() { 
	do_action('alacarte_after_single_product_gallery');
}, 999);
add_action('woocommerce_before_single_product_summary', function() {
	echo '</div></div>';
}, 1000);

/**
 * Wrap gallery in div
*/
if(!function_exists('alacarte_woocommerce_single_gallery')){
	/**
	 * Add product attributes to inside gallery
	 * 
	 * add product badge: hot, new, sale, ...
	 * Hook: woocommerce_product_thumbnails
	*/
	remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash', 10);
	remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_images', 20);

	add_action('woocommerce_before_single_product_summary','alacarte_woocommerce_single_gallery', 1);
	add_action('alacarte_woocommerce_single_gallery', 'alacarte_woocommerce_sale', 1);
	add_action('alacarte_woocommerce_single_gallery', 'alacarte_woocommerce_show_product_loop_badges', 2);
	add_action('alacarte_woocommerce_single_gallery', 'woocommerce_show_product_images', 3);

	function alacarte_woocommerce_single_gallery(){
		$class = alacarte_get_opts('product_gallery_thumb_position', 'thumb-right');
		?>
		<div class="red-single-product-gallery-wraps <?php echo esc_attr($class);?>">
		<div class="red-single-product-gallery-wraps-inner">
			<?php do_action('alacarte_woocommerce_single_gallery'); ?>
		</div>
		</div>
		<?php
	}
}

/**
 * Add Custom CSS class to Gallery
*/
add_filter('woocommerce_single_product_image_gallery_classes','alacarte_woocommerce_single_product_image_gallery_classes');
function alacarte_woocommerce_single_product_image_gallery_classes($class){
	$class[] = 'red-'.alacarte_get_opts('product_gallery_layout', 'thumbnail_h');
	$class[] = alacarte_get_opts('product_gallery_thumb_position', 'thumb-right');
	return $class;
}

/**
 * Single Product 
 *
 * Gallery style with thumbnail carousel in bottom
 *
*/
if(!function_exists('alacarte_wc_single_product_gallery_layout')){
	add_filter('woocommerce_single_product_carousel_options', 'alacarte_wc_single_product_gallery_layout' );
    function alacarte_wc_single_product_gallery_layout($options){
        $gallery_layout = alacarte_get_opts('product_gallery_layout', 'thumbnail_h');

        $options['prevText']     = '<span class="flex-prev-icon"></span>';
		$options['nextText']     = '<span class="flex-next-icon"></span>';

        switch ($gallery_layout) {
	        case 'thumbnail_v':
				$options['directionNav'] = true;
				$options['controlNav']   = false;
	            $options['sync'] = '.wc-gallery-sync';
	            break;
	    
	        case 'thumbnail_h':
	            $options['directionNav'] = true;
				$options['controlNav']   = false;
	            $options['sync'] = '.wc-gallery-sync';
	            break;
	        //default :
	        	//break;

	    }

	    return $options;
    }
}

/**
 * Single Product Gallery
 *
 * Add thumbnail product gallery 
 *
*/
if(!function_exists('alacarte_product_gallery_thumbnail_sync')){
	add_action('alacarte_after_single_product_gallery', 'alacarte_product_gallery_thumbnail_sync');
	function alacarte_product_gallery_thumbnail_sync($args=[]){
		global $product;
		$gallery_layout = alacarte_get_opts('product_gallery_layout', 'thumbnail_h');
		$product_gallery_thumb_position = alacarte_get_opts('product_gallery_thumb_position', 'thumb-right');
        $args = wp_parse_args($args, [
            'gallery_layout' => $gallery_layout
        ]);
        $post_thumbnail_id = $product->get_image_id();
    	$attachment_ids = array_merge( (array)$post_thumbnail_id , $product->get_gallery_image_ids() );

        if('simple' === $args['gallery_layout'] || empty($attachment_ids[0])) return;
        $flex_class = '';

        $thumb_v_w = alacarte_configs('alacarte_product_gallery_thumbnail_v_w');
        $thumb_v_h = alacarte_configs('alacarte_product_gallery_thumbnail_v_h');

       // $thumb_h_w = round((alacarte_configs('alacarte_product_single_image_w') - alacarte_configs('alacarte_product_gallery_thumbnail_space')*3)/3);
        $thumb_h_w = alacarte_configs('alacarte_product_gallery_thumbnail_v_w');
        $thumb_h_h = alacarte_configs('alacarte_product_gallery_thumbnail_h_h');

        $thumb_margin = alacarte_configs('alacarte_product_gallery_thumbnail_space');

        switch ($args['gallery_layout']) {
	        case 'thumbnail_v':
				$thumbnail_size = $thumb_v_w.'x'.$thumb_v_h;
				$thumb_w        = $thumb_v_w;
				$thumb_h        = $thumb_v_h;
				$flex_class     = 'flex-vertical';
	            break;
	    
	        case 'thumbnail_h':
	            $thumbnail_size = $thumb_h_w.'x'.$thumb_h_h;
	            $thumb_w = $thumb_h_w;
	            $thumb_h = $thumb_h_h;
	            $flex_class = 'flex-horizontal';
	            break;

	    }
	    $gallery_css_class = ['wc-gallery-sync', $gallery_layout, $product_gallery_thumb_position];
    ?>
    	<div class="<?php echo trim(implode(' ', $gallery_css_class));?>" data-thumb-w="<?php echo esc_attr($thumb_w);?>" data-thumb-h="<?php echo esc_attr($thumb_h);?>" data-thumb-margin="<?php echo esc_attr($thumb_margin); ?>">
			<div class="wc-gallery-sync-slides flexslider <?php echo esc_attr($flex_class);?>">
	            <?php foreach ( $attachment_ids as $attachment_id ) { ?>
	                <div class="wc-gallery-sync-slide flex-control-thumb"><?php alacarte_image_by_size(['id' => $attachment_id, 'size' => $thumbnail_size]);?></div>
	            <?php } ?>
	        </div>
	    </div>
    <?php
	}
}

/*
 * Single Product title
*/
if ( ! function_exists( 'woocommerce_template_single_title' ) ) {

	/**
	 * Output the product title.
	 */
	function woocommerce_template_single_title() {
		the_title( '<div class="product-single-title red-heading h2">', '</div>' );
	}
}
/**
 * Single Product Price
**/
if ( ! function_exists( 'woocommerce_template_single_price' ) ) {
	/**
	 * Output the product price.
	 */
	function woocommerce_template_single_price() {
		global $product;
		echo ''.$product->get_price_html();

	}
}
/**
 * Single Product Quantity Form
*/
if(!function_exists('alacarte_woocommerce_quantity_input_args')){
	add_filter('woocommerce_quantity_input_args','alacarte_woocommerce_quantity_input_args');
	function alacarte_woocommerce_quantity_input_args($args){
		$args['product_name'] = '';
		return $args;
	}
}
/**
 * Single Product Meta
*/
if ( ! function_exists( 'woocommerce_template_single_meta' ) ) {

	/**
	 * Output the product meta.
	 */
	function woocommerce_template_single_meta() {
		global $product;
	?>
	<div class="red-product-meta">
		<?php do_action( 'woocommerce_product_meta_start' ); ?>

		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

			<span class="red-sku-wrapper meta-item">
				<span class="red-heading text-uppercase"><?php esc_html_e( 'SKU:', 'alacarte' ); ?></span> <span class="sku"><?php if ( $sku = $product->get_sku() ) { echo esc_html($sku); } else { echo esc_html__( 'N/A', 'alacarte' );} ?></span>
			</span>

		<?php endif; ?>

		<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted-in meta-item"><span class="red-heading text-uppercase">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'alacarte' ) . '</span> ', '</span>' ); ?>

		<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged-as meta-item"><span class="red-heading text-uppercase">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'alacarte' ) . '</span> ', '</span>' ); ?>

		<?php do_action( 'woocommerce_product_meta_end' ); ?>

	</div>
	<?php
	}
}
// Product meta share
if(!function_exists('alacarte_woocommerce_product_meta_end')){
	add_action('woocommerce_product_meta_end','alacarte_woocommerce_product_meta_end', 0);
	function alacarte_woocommerce_product_meta_end(){
		$show_share = alacarte_get_theme_opt( 'product_share_on', '0');
		if(!$show_share) return;
        wp_enqueue_script('sharethis');
        global $product;
        $url   = get_the_permalink();
        $image = get_the_post_thumbnail_url($product->get_id());
        $title = get_the_title();
		?>
		<span class="meta-item">
			<span class="red-heading text-uppercase"><?php esc_html_e('Share:','alacarte'); ?></span>
			<span class="meta-share">
                <a data-hint="<?php esc_attr_e('Share this post to Facebook','alacarte'); ?>" data-toggle="tooltip" href="javascript:void(0);" data-network="facebook" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_attr($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php echo get_the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="hint--top hint--bounce facebook st-custom-button"><span class="fab fa-facebook-f"></span></a>
                <a data-hint="<?php esc_attr_e('Share this post to Twitter','alacarte'); ?>" data-toggle="tooltip" href="javascript:void(0);" data-network="twitter" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_attr($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php echo get_the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="hint--top hint--bounce twitter st-custom-button"><span class="fab fa-twitter"></span></a>
                <a data-hint="<?php esc_attr_e('Share this post to Google Plus','alacarte'); ?>" data-toggle="tooltip" href="javascript:void(0);" data-network="googleplus" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_attr($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php echo get_the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="hint--top hint--bounce googleplus st-custom-button"><span class="fab fa-google-plus"></span></a>
                <a data-hint="<?php esc_attr_e('Share this post to Pinterest','alacarte'); ?>" data-toggle="tooltip" href="javascript:void(0);" data-network="pinterest" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_attr($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php echo get_the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="hint--top hint--bounce pinterest st-custom-button"><span class="fab fa-pinterest"></span></a>
                <a data-hint="<?php esc_attr_e('Share this post to','alacarte'); ?>" data-toggle="tooltip" href="javascript:void(0);" data-network="sharethis" data-url="<?php echo esc_url($url);?>" data-short-url="<?php echo esc_url($url);?>" data-title="<?php echo esc_attr($title);?>" data-image="<?php echo esc_url($image); ?>" data-description="<?php echo get_the_excerpt(); ?>" data-username="" data-message="<?php echo bloginfo(); ?>" class="hint--top hint--bounce sharethis st-custom-button"><span class="fa fa-share-alt"></span></a>
			</span>
		</span>
		<?php
	}
}

/**
 * Product Tabs
 * 
 * remove description/additional info heading
*/
add_filter('woocommerce_product_description_heading', function(){ return false;});
add_filter('woocommerce_product_additional_information_heading', function(){ return false;});


/*
 * Change column of related product
 * https://docs.woocommerce.com/document/change-number-of-related-products-output/
*/
if(!function_exists('alacarte_woocommerce_output_related_products_args')){
	add_filter( 'woocommerce_output_related_products_args', 'alacarte_woocommerce_output_related_products_args', 20 );
	function alacarte_woocommerce_output_related_products_args($args){
		$args['posts_per_page'] = 6; // 4 related products
		//$args['columns'] = 3; // arranged in 2 columns
        return $args;
	}
}
// Add carousel to related
if(!function_exists('alacarte_single_product_scripts')){
	add_action('wp_enqueue_scripts', 'alacarte_single_product_scripts', 0);
	function alacarte_single_product_scripts(){
		if(!is_singular('product')) return;
		wp_enqueue_script('owl-carousel');
		wp_enqueue_script('owl-carousel-theme');
		wp_enqueue_style('owl-carousel');
	}
}
remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs',10);
add_action('woocommerce_single_product_summary','woocommerce_output_product_data_tabs',70);
