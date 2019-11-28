<?php
/**
 * Template Name: Page Buider
 *
 * This is the template that displays page content with VC.
 *
 * @package sunix
 * @subpackage sunix
 * @since 1.0.0
 * @author EF5 Team
 */

get_header();
?>
    <div class="row">
        <div id="red-content-area" class="<?php sunix_content_css_class();?>">
            <?php
                /* Start the Loop */
                while ( have_posts() ) :
                    the_post();
                    the_content();
                endwhile; // End of the loop.
            ?>
        </div>
        <?php sunix_sidebar(); ?>
    </div>
<?php
get_footer();