<?php
/**
 * Footer Function
*/
if(!function_exists('sunix_footer')){
	function sunix_footer(){
        $footer_enable = sunix_get_opts('footer_enable','-1');
        if(($footer_enable=='0') || is_404()) return;
		$footer_layout = sunix_get_opts('footer_layout','');
        if(is_singular('product')){
            $footer_layout = sunix_get_opts('woo_single_footer_layout','');
        }
        if(is_post_type_archive('product')){
            if(isset($_GET['footer']) && !empty($_GET['footer'])){
                $footer_layout = $_GET['footer'];
            }
            else{
                $footer_layout = sunix_get_opts('woo_archive_footer_layout','');
            }

        }
		if(sunix_have_post('ef5_footer') && $footer_layout !== ''){
	?>
		<footer id="red-footer" class="red-footer-area red-footer-builder <?php echo esc_attr($footer_layout);?>">
			<?php sunix_content_by_slug($footer_layout,'ef5_footer'); ?>
		</footer>
	<?php
		} else {

			sunix_footer_default();
		}
	}
}

/*
 * Default Footer 
 * 
 * Just show when system plugin not actived
 *
*/
if(!function_exists('sunix_footer_default')){
	function sunix_footer_default(){
	?>
	<footer id="red-footer" class="red-footer-area red-footer-default">
		<div class="red-footer-inner container text-center">
			<?php
		printf( esc_html__('&copy; %s %s by %s. All Rights Reserved.','sunix'), date('Y') , get_bloginfo('name'), '<a href="'.esc_url('https://themeforest.net/user/SpyroPress').'">'.esc_html__('SpyroPress','sunix').'</a>'); ?>
		</div>
	</footer>
	<?php
	}
}
/**
 * Default Footer
 *
 * Default Copyright text
 *
*/
if(!function_exists('sunix_default_copyright_text')){
	function sunix_default_copyright_text(){
		printf( esc_html__('&copy; %s %s by %s. All Rights Reserved.','sunix'), date('Y') , get_bloginfo('name'), '<a href="'.esc_url('https://themeforest.net/user/SpyroPress').'">'.esc_html__('SpyroPress','sunix').'</a>');
	}
}

/**
 * Back to Top 
*/
function sunix_backtotop(){
	$show_btt = sunix_get_opts('back_totop_on','0');
	if($show_btt === '0') return;
	?>
		<div class="red-backtotop"><div id="red-btt-btn" class="red-btt-btn"><div id="red-btt-container" class="red-btt-container"><div id="red-btt-border" class="red-btt-border"><div id="red-btt-circle" class="red-btt-circle"><span class="fa fa-long-arrow-up"></span></div></div></div></div></div>
	<?php
}
add_action('wp_footer','sunix_backtotop', 99);