<?php
/**
 * The main template file
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
                    if ( have_posts() )
                    {
                        while ( have_posts() )
                        {
                            the_post();
                            get_template_part( 'template-parts/loop/content', get_post_format() );
                        }
                        alacarte_loop_pagination();
                    }
                    else
                    {
                        get_template_part( 'template-parts/content', 'none' );
                    }
                    ?>
                </div>
            </div>
            <?php alacarte_sidebar(); ?>
        </div>
    </div>
<?php
get_footer();