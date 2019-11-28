<?php
/**
 * The template for displaying Current Discussion on posts
 */

/* Get data from current discussion on post. */
$discussion    = sunix_get_discussion_data();
$has_responses = $discussion->responses > 0;

if ( $has_responses ) {
	/* translators: %1(X comments)$s */
	$meta_label = sprintf( _n( '%d Comment', '%d Comments', $discussion->responses, 'sunix' ), $discussion->responses );
} else {
	$meta_label = __( 'No comments', 'sunix' );
}

?>

<div class="discussion-meta">
	<?php
	if ( $has_responses ) {
		//sunix_discussion_avatars_list( $discussion->authors );
	}
	?>
	<h4 class="discussion-meta-info">
		<span><?php echo esc_html( $meta_label ); ?></span>
	</h4>
</div><!-- .discussion-meta -->
