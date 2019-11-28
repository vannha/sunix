<?php
/**
 * Template Name: Blog List No sidebar
 *
 * @package sunix
 * @subpackage sunix
 * @since 1.0.0
 * @author EF5 Team
 */
get_header();

?>
    <div class="container">
        <div class="row">
            <div id="red-content-area" class="red-content-area col-lg-8 col-md-12 red-blog-list-template offset-lg-2">
                <div id="red-posts" class="red-posts red-blogs">
                    <?php global $wp_query, $wp;
                    if (!isset($wp->query_vars['paged'])){
                        $page=1;
                    }
                    else{
                        $page=$wp->query_vars['paged'];
                    }
                    $wp_query->query('post_type=post&showposts='.get_option('posts_per_page').'&paged='.$page );

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
                    } ?>
                </div>
            </div>
        </div>
    </div>


<?php

get_footer();