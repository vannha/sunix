<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * 
 * @package sunix
 * @subpackage sunix
 * @since 1.0.0
 * @author EF5 Team
 *
*/
get_header();
?>	
	<div class="container d-flex justify-content-center text-center">
		<div class="error-404 not-found">
            <div class="err404-wrap align-self-center text-center">
                <div class="text-center">
                    <span class="title-404"><?php esc_html_e( '404', 'sunix' ); ?></span>
                    <h3 class="subtitle-404"><?php esc_html_e( 'Page not found', 'sunix' ); ?></h3>
                    <p class="desc-404"><?php esc_html_e( 'Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'sunix' ); ?></p>
                    <a class="red-btn accent outline red-btn-lg " href="<?php echo esc_url(home_url('/')) ?>"><?php esc_html_e( 'Back home', 'sunix' ); ?></a>
                </div>
            </div>
		</div>
	</div>
<?php
get_footer();