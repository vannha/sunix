<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
        <div class="row">
            <div id="red-content-area" class="<?php alacarte_content_css_class();?>">
                <div id="red-posts" class="red-posts red-blogs">
                <?php
					while ( have_posts() ) :
						the_post();
                        alacarte_post_content();
                        alacarte_link_pages();
                        posts_nav_link();
                        alacarte_comment();
					endwhile;
                ?>
                </div>
            </div>
            <?php alacarte_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();