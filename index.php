<?php
/**
 * The main template file
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
                    if ( have_posts() )
                    {
                        while ( have_posts() )
                        {
                            the_post();
                            get_template_part( 'template-parts/loop/content', get_post_format() );
                        }
                        sunix_loop_pagination();
                    }
                    else
                    {
                        get_template_part( 'template-parts/content', 'none' );
                    }
                    ?>
                </div>
            </div>
            <?php sunix_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();