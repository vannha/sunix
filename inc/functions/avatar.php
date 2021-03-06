<?php
/**
 * Add new option avatar to admin
*/
//add_action('switch_theme', 'sunix_update_avatar');
function sunix_update_avatar(){
	$ef5_avatar = get_template_directory_uri() . '/assets/images/avatar.png';
	if (get_option($ef5_avatar, '') != $ef5_avatar)
		update_option( 'avatar_default' , $ef5_avatar );
}
 
// add a new default avatar to the list in WordPress admin
function sunix_default_avatar( $avatar_defaults ) {
	$ef5_avatar = get_template_directory_uri() . '/assets/images/avatar.png';
	$avatar_defaults[$ef5_avatar] = esc_html__('sunix Avatar','sunix');
	return $avatar_defaults;
}
//add_filter( 'avatar_defaults', 'sunix_default_avatar' );

/**
 * Returns the size for avatars used in the theme.
 */
if(!function_exists('sunix_get_avatar_size')){
	//add_filter('woocommerce_review_gravatar_size', 'sunix_get_avatar_size');
	function sunix_get_avatar_size() {
		return sunix_configs('cmt_avatar_size');
	}
}

/**
 * An example to use filter get_avatar
 * https://codex.wordpress.org/Plugin_API/Filter_Reference/get_avatar
 *
*/
if(!function_exists('sunix_custom_avatar')){
	//add_filter( 'get_avatar' , 'sunix_custom_avatar' , 1 , 6 );
	function sunix_custom_avatar($avatar, $id_or_email, $size, $default, $alt, $args) {
	    if ( is_object( $id_or_email )) {
			$alt = $id_or_email->comment_author;
		} elseif ( is_numeric( $id_or_email ) ) {
	        $id = (int) $id_or_email;
	        $user = get_user_by( 'id' , $id );
	        $alt = $user->user_nicename;
    	} else {
    		$user = get_user_by( 'email', $id_or_email );
    		if(!$user){
    			$alt = $id_or_email;
    		}else{
	        	$alt = $user->data->user_nicename;
    		}
    	}
		$url = $args['url'];
		$url2x = get_avatar_url( $id_or_email, array_merge( $args, array( 'size' => $args['size'] * 2 ) ) );
		$classes = trim(implode(' ', ['red-avatar', 'red-avatar-'.$size, $args['class']]));
		
		$avatar = "<img alt='{$alt}' src='{$url}' srcset='{$url2x}' class='{$classes}' height='{$size}' width='{$size}' {$args['extra_attr']} />";
	    return $avatar;
	}
}