<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package sunix
 * @subpackage sunix
 * @since 1.0.0
 * @author EF5 Team
 *
 */
get_header();
?>
    <div class="container">
        <div class="row">
            <div id="red-content-area" class="<?php sunix_content_css_class();?>">
                <div id="red-posts" class="red-posts red-blogs">
                <?php
					while ( have_posts() ) :
						the_post();
                        sunix_post_content();
                        sunix_link_pages();
                        posts_nav_link();
                        sunix_comment();
					endwhile;
                ?>
                </div>
            </div>
            <?php sunix_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();