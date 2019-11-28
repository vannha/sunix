<?php
/* Comment Pagination */
if(!function_exists('sunix_comment_pagination')){
    function sunix_comment_pagination(){
        paginate_comments_links(['echo' => false]);
    }
}
if(!function_exists('sunix_wp_list_comments_args')){
	function sunix_wp_list_comments_args($args=[]){
		$args = wp_parse_args($args, array(
			'walker'      => new sunix_Walker_Comment(),
			'avatar_size' => sunix_get_avatar_size(),
			'short_ping'  => true,
			'style'       => 'ol'
		));
		return $args;
	}
}


if(!function_exists('sunix_comment')){
	function sunix_comment(){
		$show_cmt = sunix_get_opts('show_comment_form', '1');
		if ( '1' === $show_cmt && (comments_open() || get_comments_number()) )
        {
            comments_template();
        }
	}
}

/**
 * Returns true if comment is by author of the post.
 *
 * @see get_comment_class()
 */
function sunix_is_comment_by_post_author( $comment = null ) {
	if ( is_object( $comment ) && $comment->user_id > 0 ) {
		$user = get_userdata( $comment->user_id );
		$post = get_post( $comment->comment_post_ID );
		if ( ! empty( $user ) && ! empty( $post ) ) {
			return $comment->user_id === $post->post_author;
		}
	}
	return false;
}

/**
 * Returns information about the current post's discussion, with cache support.
 */
function sunix_get_discussion_data() {
	static $discussion, $post_id;

	$current_post_id = get_the_ID();
	if ( $current_post_id === $post_id ) {
		return $discussion; /* If we have discussion information for post ID, return cached object */
	} else {
		$post_id = $current_post_id;
	}

	$comments = get_comments(
		array(
			'post_id' => $current_post_id,
			'orderby' => 'comment_date_gmt',
			'order'   => get_option( 'comment_order', 'asc' ), /* Respect comment order from Settings » Discussion. */
			'status'  => 'approve',
			'number'  => 20, /* Only retrieve the last 20 comments, as the end goal is just 6 unique authors */
		)
	);

	$authors = array();
	foreach ( $comments as $comment ) {
		$authors[] = ( (int) $comment->user_id > 0 ) ? (int) $comment->user_id : $comment->comment_author_email;
	}

	$authors    = array_unique( $authors );
	$discussion = (object) array(
		'authors'   => array_slice( $authors, 0, 6 ),           /* Six unique authors commenting on the post. */
		'responses' => get_comments_number( $current_post_id ), /* Number of responses. */
	);

	return $discussion;
}

if ( ! function_exists( 'sunix_discussion_avatars_list' ) ) :
	/**
	 * Displays a list of avatars involved in a discussion for a given post.
	 */
	function sunix_discussion_avatars_list( $comment_authors ) {
		if ( empty( $comment_authors ) ) {
			return;
		}
		echo '<div class="discussion-avatar-list d-flex">';
		foreach ( $comment_authors as $id_or_email ) {
			printf(
				"<div>%s</div>",
				sunix_get_user_avatar_markup( $id_or_email )
			);
		}
		echo '</div>';
	}
endif;

if ( ! function_exists( 'sunix_get_user_avatar_markup' ) ) :
	/**
	 * Returns the HTML markup to generate a user avatar.
	 */
	function sunix_get_user_avatar_markup( $id_or_email = null ) {

		if ( ! isset( $id_or_email ) ) {
			$id_or_email = get_current_user_id();
		}

		return sprintf( '<div class="comment-user-avatar comment-author">%s</div>', get_avatar( $id_or_email, sunix_get_avatar_size() ) );
	}
endif;

// Comment Reply link
//add_filter('comment_reply_link','sunix_comment_reply_link', 10, 4);
function sunix_comment_reply_link($link, $args, $comment, $post){
	if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) {
		$link = sprintf( '<a rel="nofollow" class="comment-reply-login" href="%s"><span class="fa fa-reply"></span>&nbsp;&nbsp;%s</a>',
			esc_url( wp_login_url( get_permalink() ) ),
			$args['login_text']
		);
	} else {
		$onclick = sprintf( 'return addComment.moveForm( "%1$s-%2$s", "%2$s", "%3$s", "%4$s" )',
			$args['add_below'], $comment->comment_ID, $args['respond_id'], $post->ID
		);

		$link = sprintf( "<a rel='nofollow' class='comment-reply-link' href='%s' onclick='%s' aria-label='%s'>%s</a>",
			esc_url( add_query_arg( 'replytocom', $comment->comment_ID, get_permalink( $post->ID ) ) ) . "#" . $args['respond_id'],
			$onclick,
			esc_attr( sprintf( $args['reply_to_text'], $comment->comment_author ) ),
			$args['reply_text']
		);
	}
	
	$link =  $args['before'] . $link . $args['after'];
	return $link;
}

/**
 * Move comment field to above comment text
*/
if(!function_exists('sunix_comment_form_fields')){
	add_filter( 'comment_form_fields', 'sunix_comment_form_fields');
    function sunix_comment_form_fields( $fields ) {
        //author, email, url 
        $fields_first = ['rating','open','author','email','url','close'];
        $fields_resort = [];
        foreach ($fields_first as $key) {
            if(array_key_exists($key,$fields))
                $fields_resort[$key] = $fields[$key];
        }
        foreach ($fields as $key => $value) {
            if(in_array($key,$fields_first))
                continue;
            $fields_resort[$key] = $value;
        }
        return $fields_resort;
    }
}

if(!function_exists('sunix_comment_field_to_bottom')){
	/**
	 * add_filter( 'comment_form_fields', 'sunix_comment_field_to_bottom' );
	*/
	function sunix_comment_field_to_bottom( $fields ) {
	    $comment_field = $fields['comment'];
	    unset( $fields['comment'] );
	    $fields['comment'] = $comment_field;
	    return $fields;
	}
}

/*
 * Comment Form Output
 * 
*/
if ( ! function_exists( 'sunix_comment_form' ) ) :
	/**
	 * Documentation for function.
	 */
	function sunix_comment_form( $order ) {
		if ( true === $order || strtolower( $order ) === strtolower( get_option( 'comment_order', 'asc' ) ) ) {
			comment_form(
				array(
					'title_reply'	=> esc_html__('Write a Comment', 'sunix'),
					'label_submit'  => esc_html__( 'Post Your Comment','sunix' ),
					'class_submit'  => 'btn btn-pri',
					'submit_button' => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s"><span>%4$s</span></button>',
					'submit_field'  => '<div class="form-submit">%1$s %2$s</div>',
				)
			);


		}
	}
endif;

/**
 * Comment form fields
 * Default Fields
 *
 * Name, Email, Url, Phone ...
 *
*/
if(!function_exists('sunix_comment_form_default_fields')){
	add_filter('comment_form_default_fields', 'sunix_comment_form_default_fields', 10, 2);
	function sunix_comment_form_default_fields($fields){
		$commenter       = wp_get_current_commenter();
		$req             = get_option( 'require_name_email' );
		$html_req        = ( $req ? " required='required'" : '' );
		$html_req_markup = ( $req ? '*' : '' );
		$html5           = true;
		$name_pladeholder  = esc_html__('Name *','sunix');
		$email_pladeholder = esc_html__('Email *','sunix');
		$url_pladeholder   = esc_html__('Website','sunix');
		
		$fields    = [
			'open'	  		=> 	'<div class="row red-form-fields">',
			'author'  		=>	'<div class="comment-form-author col-12 col-md-6">'.
							 		'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" maxlength="245"' . $html_req . ' placeholder="'.esc_attr($name_pladeholder).'" />'.
							 	'</div>',
			'email'   		=>	'<div class="comment-form-email col-12 col-md-6">' .
								 	'<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" aria-describedby="email-notes"' . $html_req . ' placeholder="'.esc_attr($email_pladeholder).'" />'.
								'</div>',
			/*'url'     		=> '<div class="comment-form-url col-12 col-md-4">' .
									'<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="'.esc_attr($url_pladeholder).'" />'.
							 	'</div>',*/
			'close'	  		=>  '</div>',
		];
		return $fields;
	}
}

/**
 * Comment form fields
 *
 * Comment text
 *
*/
if(!function_exists('sunix_comment_form_defaults')){
	add_filter('comment_form_defaults', 'sunix_comment_form_defaults');
	function sunix_comment_form_defaults($fields){
		$msg_placeholder   = esc_html__( 'Your Message *', 'sunix' );
		$fields['comment_field'] = '<div class="comment-form-comment">'.
									'<textarea id="comment" name="comment" placeholder="'.esc_attr($msg_placeholder).'" required="required"></textarea>'.
								'</div>';
		$fields['submit_button'] = '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />%4$s</button>';
		return $fields;
	}
}

/***
 * WooCommerce Comment Field
 * 
 * Custom WooCommerce Comment list 
 * 
*/

if(!function_exists('sunix_woocommerce_product_review_list_args')){
	add_filter('woocommerce_product_review_list_args','sunix_woocommerce_product_review_list_args');
	add_filter('woocommerce_review_gravatar_size', 'sunix_get_avatar_size');
	remove_action('woocommerce_review_meta', 'woocommerce_review_display_meta');
	remove_action('woocommerce_review_before_comment_meta','woocommerce_review_display_rating');
	function sunix_woocommerce_product_review_list_args($args){
		$args = array_merge($args, [
			'avatar_size'   => sunix_get_avatar_size(),
			'callback' 		=> 'sunix_woocommerce_comments'
		]);

		return $args;
	}
	function sunix_woocommerce_comments($comment, $args, $depth){
		$verified = wc_review_is_from_verified_owner( $comment->comment_ID );
	?>
		<li id="comment-<?php comment_ID() ?>" <?php comment_class('comment'); ?>>
			<article id="comment-<?php comment_ID(); ?>" class="comment-body row">
				<div class="comment-avatar col-md-auto col-auto">
					<div class="row align-items-center">
						<div class="col-auto"><?php
							/**
							 * The woocommerce_review_before hook
							 *
							 * @hooked woocommerce_review_display_gravatar - 10
							 */
							do_action( 'woocommerce_review_before', $comment );
							
						?></div>
					</div>
				</div>
				<div class="comment-info col">
					<div class="d-flex justify-content-between">
						<div class="author-info">
							<div class="author-name">
								<?php echo get_comment_author( $comment ); ?>
							</div>
						</div>
						<div class="">
							<?php woocommerce_review_display_rating(); ?>
						</div>
					</div>
					<?php
						/**
						 * The woocommerce_review_meta hook.
						 *
						 * @hooked woocommerce_review_display_meta - 10
						 * @hooked WC_Structured_Data::generate_review_data() - 20
						 */
						do_action( 'woocommerce_review_meta', $comment );
						/**
						 * The woocommerce_review_before_comment_meta hook.
						 *
						 * @hooked woocommerce_review_display_rating - 10
						 */
						do_action( 'woocommerce_review_before_comment_meta', $comment );
					?>
					<div class="comment-content">
						<?php					
						do_action( 'woocommerce_review_before_comment_text', $comment );

						/**
						 * The woocommerce_review_comment_text hook
						 *
						 * @hooked woocommerce_review_display_comment_text - 10
						 */
						do_action( 'woocommerce_review_comment_text', $comment );

						do_action( 'woocommerce_review_after_comment_text', $comment ); ?>
					</div>
					<div class="comment-metadata">
						<?php
						if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
							echo '<em class="woocommerce-review__verified verified">(' . esc_attr__( 'verified owner', 'sunix' ) . ')</em> ';
						}
						?>
						<span class="comment-time meta-color" datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>"><?php echo esc_html( get_comment_date( wc_date_format() ) ); ?></span>
					</div>
				</div>
			</article>
	<?php
	}
}

/***
 * WooCommerce Comment Field
 * 
 * Custom WooCommerce Comment field 
 * 
*/
if(!function_exists('sunix_woocommerce_product_review_comment_form_args')){
    add_filter('woocommerce_product_review_comment_form_args', 'sunix_woocommerce_product_review_comment_form_args');
    function sunix_woocommerce_product_review_comment_form_args(){
        $commenter = wp_get_current_commenter();
        if ( !is_user_logged_in() ) {
            $comment_form = array(
                'title_reply'          => have_comments() ? esc_html__( 'Leave a review', 'sunix' ) : sprintf( esc_html__( 'Be the first to review', 'sunix' ), the_title_attribute() ),
                'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'sunix' ),
                'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
                'title_reply_after'    => '</h3><p>'.esc_html__('Your email address will not be published. Required fields are marked *','sunix').'</p>',
                'comment_notes_before' => '',
                'comment_notes_after'  => '',
                'fields'               => array(
                    'rating' => '<div class="comment-form-rating"><span class="lbl">'.esc_html__( 'Your rating','sunix' ).'</span><select name="rating" id="rating" aria-required="true" required>
					<option value="">' . esc_html__( 'Rate&hellip;', 'sunix' ) . '</option>
					<option value="5">' . esc_html__( 'Perfect', 'sunix' ) . '</option>
					<option value="4">' . esc_html__( 'Good', 'sunix' ) . '</option>
					<option value="3">' . esc_html__( 'Average', 'sunix' ) . '</option>
					<option value="2">' . esc_html__( 'Not that bad', 'sunix' ) . '</option>
					<option value="1">' . esc_html__( 'Very poor', 'sunix' ) . '</option>
				</select></div>',
                    'author' => '<div class="row"><div class="col-md-6 col-sm-12"><p class="comment-form-author">'.
                        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" placeholder="'.esc_attr__('Your Name*','sunix').'" required /></p></div>',
                    'email'  => '<div class="col-md-6 col-sm-12"><p class="comment-form-email">'.
                        '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" placeholder="'.esc_attr__('Your Email*','sunix').'" required /></p></div></div>',
                ),
                'label_submit'  => esc_html__( 'Post Your Review', 'sunix' ),
                'logged_in_as'  => '',
                'comment_field' => '',
            );
        }else{
            $comment_form = array(
                'title_reply'          => have_comments() ? esc_html__( 'Leave a comment', 'sunix' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'sunix' ), the_title_attribute() ),
                'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'sunix' ),
                'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
                'title_reply_after'    => '</h3>',
                'comment_notes_before' => '',
                'comment_notes_after'  => '',
                'fields'               => array(
                    'author' => '<div class="row"><div class="col-md-6 col-sm-12"><p class="comment-form-author">'.
                        '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" placeholder="'.esc_attr__('Name*','sunix').'" required /></p></div>',
                    'email'  => '<div class="col-md-6 col-sm-12"><p class="comment-form-email">'.
                        '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" placeholder="'.esc_attr__('Email*','sunix').'" required /></p></div></div>',

                ),
                'label_submit'  => esc_html__( 'Post Your Comment', 'sunix' ),
                'logged_in_as'  => '',
                'comment_field' => '',
            );
        }

        if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
            $comment_form['must_log_in'] = '<p class="must-log-in">' . esc_html__( 'You must be ','sunix').' <a href="'.esc_url( $account_page_url ).'">'. esc_html__( ' logged in ','sunix').'</a>'.esc_html__( 'to post a review.', 'sunix' ) . '</p>';
        }
        if ( is_user_logged_in() ) {
            if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
                $comment_form['comment_field'] = '<div class="comment-form-rating"><span class="lbl">'.esc_html__( 'Your rating','sunix' ).'</span><select name="rating" id="rating" aria-required="true" required>
				<option value="">' . esc_html__( 'Rate&hellip;', 'sunix' ) . '</option>
				<option value="5">' . esc_html__( 'Perfect', 'sunix' ) . '</option>
				<option value="4">' . esc_html__( 'Good', 'sunix' ) . '</option>
				<option value="3">' . esc_html__( 'Average', 'sunix' ) . '</option>
				<option value="2">' . esc_html__( 'Not that bad', 'sunix' ) . '</option>
				<option value="1">' . esc_html__( 'Very poor', 'sunix' ) . '</option>
			</select></div>';
            }
        }
        $comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="3" aria-required="true" placeholder="'.esc_attr__('Your Review*','sunix').'" required></textarea></p>';

        return $comment_form;
    }
}
/**
 * Remove re-Captcha when user logged in
 * plugin: Google Captcha (reCAPTCHA) by BestWebSoft
 * https://wordpress.org/plugins/google-captcha/
 *
*/
if(function_exists('gglcptch_commentform_display')){
	add_action ('init', 'sunix_remove_default_gglcptch_commentform_display');
	function sunix_remove_default_gglcptch_commentform_display(){
		remove_action( 'comment_form_after_fields', 'gglcptch_commentform_display');
		remove_action( 'comment_form_logged_in_after', 'gglcptch_commentform_display');
	}

	function sunix_gglcptch_commentform_display($submit_button, $args){
		$submit_before =  '<span class="gglcptch-none d-none">'.gglcptch_commentform_display().'</span>';
		return $submit_before . $submit_button;
	}
	add_filter('comment_form_submit_button', 'sunix_gglcptch_commentform_display', 10, 2);
}

/**
 * Commnent Pagination
 *
 * Loadmore button
 *
*/
/* Comment Script */
if(!function_exists('cmunittest_comment_scripts')){
	add_action( 'wp_enqueue_scripts', 'cmunittest_comment_scripts', 1 );
	function cmunittest_comment_scripts() {
		$min = sunix_script_debug();
		if (is_singular() && comments_open()) {
		    wp_enqueue_script( 'comment-loadmore', get_template_directory_uri() . '/assets/js/comment-loadmore'.$min.'.js', array('jquery') );
		}
	}
}