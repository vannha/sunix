<?php
/**
 * The template for displaying Search Results pages
 *
 * @package CMSSuperHeroes
 * @subpackage CMS Theme
 * @since 1.0.0
 */

/* get side-bar position. */
get_header();
?>
    <div class="container">
        <div class="row">
            <?php
            if ( have_posts() ) :?>
            <div id="red-content-area" class="<?php sunix_content_css_class();?>">
                <div id="red-posts" class="red-posts red-blogs">

                       <?php while ( have_posts() ) :
                                   the_post();
                                   get_template_part( 'template-parts/loop/content', get_post_format() );

                        endwhile;
                       sunix_loop_pagination();
                        ?>

                </div>
            </div>
            <?php sunix_sidebar(); ?>
            <?php else :?>
                <div id="red-content-area" class="red-content-area col-lg-12 col-md-12">
                    <div id="red-posts" class="red-posts red-blogs">
                        <article class="no-results not-found">
                            <h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'sunix' ); ?></h1>
                            <div class="entry-content">
                                <p><?php esc_html_e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'sunix' ); ?></p>
                                <?php get_search_form(); ?>
                            </div>
                        </article>
                    </div>
                </div>

            <?php  endif; ?>

        </div>
    </div>
<?php
get_footer();
