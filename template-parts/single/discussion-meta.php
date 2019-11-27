<?php
/**
 * The template for displaying Current Discussion on posts
 */

/* Get data from current discussion on post. */
$discussion    = alacarte_get_discussion_data();
$has_responses = $discussion->responses > 0;

if ( $has_responses ) {
	/* translators: %1(X comments)$s */
	$meta_label = sprintf( _n( '%d Comment', '%d Comments', $discussion->responses, 'alacarte' ), $discussion->responses );
} else {
	$meta_label = __( 'No comments', 'alacarte' );
}

?>

<div class="discussion-meta">
	<?php
	if ( $has_responses ) {
		//alacarte_discussion_avatars_list( $discussion->authors );
	}
	?>
	<h4 class="discussion-meta-info">
		<span><?php echo esc_html( $meta_label ); ?></span>
	</h4>
</div><!-- .discussion-meta -->
