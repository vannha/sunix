<?php
/**
 * The template for displaying single post
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
                <div class="red-blogs">
                <?php
                    /* Start the Loop */
                    while ( have_posts() ) :
                        the_post();
                        get_template_part( 'template-parts/single/content', get_post_format() );
                        // Post Navigation
                        sunix_post_navigation();
                        // Comment
                        sunix_comment();

                    endwhile; // End of the loop.
                ?>
                </div>
            </div>
            <?php sunix_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();