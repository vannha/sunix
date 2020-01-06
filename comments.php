<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sunix
 * @subpackage sunix
 * @since 1.0.0
 * @author EF5 Team
 *
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="<?php echo comments_open() ? 'comments-area' : 'comments-area comments-closed'; ?>">
	<?php if ( have_comments() ) : ?>
		<div class="commentlist-wrap">
			<div class="comments-title h3"><?php
				$comments_number = get_comments_number();
				printf(
					_nx(
						'%1$s %2$s',
						'%1$s %3$s',
						$comments_number,
						'comments title',
						'sunix'
					),
					number_format_i18n( $comments_number ),
					esc_html__('Comment','sunix'),
					esc_html__('Comments','sunix')
				);
			?></div>
			<ol class="commentlist">
				<?php
					wp_list_comments(
						sunix_wp_list_comments_args()
					);
				?>
			</ol>
			<?php
			//sunix_comment_pagination_loadmore();
            the_comments_pagination();
			?>
		</div>
	<?php
	endif;  
	// Show comment form at bottom if showing newest comments at the bottom.
	if ( comments_open() ) :
		?>
		<div class="red-comment-form-flex">
			<?php
			$args = array(
				'title_reply' => have_comments() ? esc_html__( 'Leave A Comment', 'sunix' ) : sprintf( esc_html__( 'Leave A Comment', 'sunix' ), get_the_title() ),
				'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title"><i class="icon-comment-2"></i>',
				'label_submit'      => esc_html__( 'Submit','sunix'),
				'comment_notes_before' => esc_html__( 'Your email address will not be published. Required fields are marked *', 'sunix' ),
				'fields' => apply_filters( 'sunix_comment_form_default_fields', array(

						'author' =>
							'<div class="row"><div class="col-md-6"><p class="comment-form-author"><label>'.esc_html__('Your Name*','sunix').'</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
							'" size="30" aria-required="true" required="required" placeholder="e.g, Andrea Robesson"/></p></div>',

						'email' =>
							'<div class="col-md-6"><p class="comment-form-email"><label>'.esc_html__('Your Email*','sunix').'</label><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
							'" size="30" aria-required="true" required="required" placeholder="name@youraddress.com"/></p></div></div>',
					)
				),
				'comment_field' =>  '<p class="comment-form-comment"><label>'.esc_html__('Comment*','sunix').'</label><textarea id="comment" name="comment" cols="45" rows="3" aria-required="true" required="required" placeholder="'.esc_attr__('Your text','sunix').'"></textarea></p>',
			);
			comment_form($args); ?>
		</div>
		<?php
	endif;	
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() ) :
		?>
		<div class="red-no-comments required">
			<?php esc_html_e( 'Comments are closed.', 'sunix' ); ?>
		</div>
		<?php
	endif; 
	?>
</div>