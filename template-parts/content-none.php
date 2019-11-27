<?php
/**
 * The template for displaying no content found
 * 
 * @package AlaCarte
 * @subpackage AlaCarte
 * @since 1.0.0
 * @author EF5 Team
 *
*/
get_header();
?>	
	<div class="container">
		<div class="no-content not-found">
			<header class="page-header">
				<h1><?php esc_html_e( 'Nothing Found', 'alacarte' ); ?></h1>
			</header>

			<div class="page-content">
				<?php
				if ( is_home() && current_user_can( 'publish_posts' ) ) :

					printf(
						'<p>' . wp_kses(
							/* translators: 1: link to WP admin new post page. */
							__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'alacarte' ),
							array(
								'a' => array(
									'href' => array(),
								),
							)
						) . '</p>',
						esc_url( admin_url( 'post-new.php' ) )
					);

				else :
					?>

					<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'alacarte' ); ?></p>
					<?php
					get_search_form();

				endif;
				?>
			</div>
		</div>
	</div>
<?php
get_footer();