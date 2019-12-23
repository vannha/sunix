<?php

/**
 * Post Header
 *
 * Showing post header in loop / single
 *
**/
if(!function_exists('sunix_post_header')){
	function sunix_post_header($args=[]){
		$args = wp_parse_args($args, [
            'heading_tag' => 'h2',
            'class'       => '',
            'before_args' => [],
            'after_args'  => []
		]);
        $classes = ['red-post-header',$args['class']];
        $title_classes = ['red-heading',$args['heading_tag']];
        $stick_icon = ( is_sticky() && is_home() && ! is_paged()) ? '<span class="fa fa-thumb-tack"></span>&nbsp;&nbsp;' : '';

        $link_open = is_singular() ? '' : '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
        $link_close = is_singular() ? '' : '</a>';

	?>
		<header class="<?php echo trim(implode(' ', $classes));?>">
            <div class="red-before-title empty-none"><?php do_action('sunix_before_loop_title', $args['before_args']); ?></div>
	        <?php  the_title( '<div class="'.trim(implode(' ', $title_classes)).'">'.$link_open.$stick_icon, $link_close.'</div>' ); ?>
            <div class="red-after-title empty-none"><?php do_action('sunix_after_loop_title', $args['after_args']); ?></div>
	    </header>
	<?php
	}
}


if(!function_exists('sunix_post_title')){
    function sunix_post_title($args=[]){
        $args = wp_parse_args($args, [
            'heading_tag' => 'h2',
            'class'       => ''
        ]);
        $title_classes = ['red-heading',$args['heading_tag'], $args['class']];
        $stick_icon = ( is_sticky() && is_home() && ! is_paged()) ? '<span class="fa fa-thumb-tack"></span>&nbsp;&nbsp;' : '';
        $link_open = is_singular() ? '' : '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
        $link_close = is_singular() ? '' : '</a>';

        the_title( '<div class="'.trim(implode(' ', $title_classes)).'">'.$link_open.$stick_icon, $link_close.'</div>' ); 
    }
}
/**
 * Post Meta TOp
 * Prints HTML with meta information for the current post.
 */
if ( ! function_exists( 'sunix_post_meta_top' ) ) {
    add_action('sunix_before_loop_title','sunix_post_meta_top');
    function sunix_post_meta_top($args=['show_cat' => false])
    {
        if ( is_singular() ) {
            $author_on   = !empty($args['show_author']) ? $args['show_author'] : sunix_get_theme_opt( 'post_author_on', '1' );
            $date_on     = !empty($args['show_date']) ? $args['show_date'] : sunix_get_theme_opt( 'post_date_on', '1' );
            $cats_on     = !empty($args['show_cat']) ? $args['show_cat'] : sunix_get_theme_opt( 'post_categories_on', '1' );
            $comments_on = !empty($args['show_cmt']) ? $args['show_cmt'] : sunix_get_theme_opt( 'post_comments_on', '1' );
            $show_view = !empty($args['show_view']) ? $args['show_view'] : sunix_get_theme_opt( 'post_view_on', '0' );
            $show_like = !empty($args['show_like']) ? $args['show_like'] : sunix_get_theme_opt( 'post_like_on', '0' );
        }  else {
        $author_on   = !empty($args['show_author']) ? $args['show_author'] : sunix_get_theme_opt( 'archive_author_on', '1' );
        $date_on     = !empty($args['show_date']) ? $args['show_date'] : sunix_get_theme_opt( 'archive_date_on', '1' );
        $cats_on     = !empty($args['show_cat']) ? $args['show_cat'] : sunix_get_theme_opt( 'archive_categories_on', '1' );
        $comments_on = !empty($args['show_cmt']) ? $args['show_cmt'] : sunix_get_theme_opt( 'archive_comments_on', '1' );
        $show_view = !empty($args['show_view']) ? $args['show_view'] : sunix_get_theme_opt( 'archive_view_on', '0' );
        $show_like = !empty($args['show_like']) ? $args['show_like'] : sunix_get_theme_opt( 'archive_like_on', '0' );
    }

        $args = wp_parse_args($args, [
            'class'           => '',
            'show_author'     => $author_on,
            'show_date'       => $date_on,
            'show_cat'        => $cats_on,
            'show_cmt'        => $comments_on,
            'show_view'        => $show_view,
            'show_like'        => $show_like,
            'show_edit'       => false,
            'stretch_content' => false,
            'excludes'        => ['category'=> true],
            'sep'             => '',
        ]);
        $metas = [];
        if($args['show_date']) $metas[] = sunix_posted_on(['show_date' => $args['show_date'], 'echo' => false]);
        if($args['show_cat']) $metas[] = sunix_posted_in(['show_cat' => $args['show_cat'], 'echo' => false]);

        $taxo = sunix_get_post_taxonomies();
        $terms = get_the_term_list( get_the_ID(), $taxo, '', $args['sep'], '' );
        if(!empty($terms))
        {
            $output = implode($args['sep'], $metas);
        }
        else{
            $output = implode('', $metas);
        }

        $css_classes = ['red-meta', $args['class'], 'd-flex', 'align-items-center'];
        if($args['stretch_content']) $css_classes[] = 'justify-content-between';
        $classes = trim(implode(' ',$css_classes ));
        if ( $output )
        {
            printf( '<div class="%s">%s</div>', $classes ,$output);
        }
    }
}
/**
 * Post Meta
 * Prints HTML with meta information for the current post.
*/
if ( ! function_exists( 'sunix_post_meta' ) ) {
    add_action('sunix_after_loop_title','sunix_post_meta');
    function sunix_post_meta($args=['show_cat' => false,'show_date' => false])
    {
        if ( is_singular() ) {
            $author_on   = !empty($args['show_author']) ? $args['show_author'] : sunix_get_theme_opt( 'post_author_on', '1' );
            $date_on     = !empty($args['show_date']) ? $args['show_date'] : sunix_get_theme_opt( 'post_date_on', '1' );
            $cats_on     = !empty($args['show_cat']) ? $args['show_cat'] : sunix_get_theme_opt( 'post_categories_on', '1' );
            $comments_on = !empty($args['show_cmt']) ? $args['show_cmt'] : sunix_get_theme_opt( 'post_comments_on', '1' );
            $show_view = !empty($args['show_view']) ? $args['show_view'] : sunix_get_theme_opt( 'post_view_on', '0' );
            $show_like = !empty($args['show_like']) ? $args['show_like'] : sunix_get_theme_opt( 'post_like_on', '0' );
            $show_tag = !empty($args['show_tag']) ? $args['show_tag'] : sunix_get_theme_opt( 'post_tags_on', '0' );
        }  else {
            $author_on   = !empty($args['show_author']) ? $args['show_author'] : sunix_get_theme_opt( 'archive_author_on', '1' );
            $date_on     = !empty($args['show_date']) ? $args['show_date'] : sunix_get_theme_opt( 'archive_date_on', '1' );
            $cats_on     = !empty($args['show_cat']) ? $args['show_cat'] : sunix_get_theme_opt( 'archive_categories_on', '1' );
            $comments_on = !empty($args['show_cmt']) ? $args['show_cmt'] : sunix_get_theme_opt( 'archive_comments_on', '1' );
            $show_view = !empty($args['show_view']) ? $args['show_view'] : sunix_get_theme_opt( 'archive_view_on', '0' );
            $show_like = !empty($args['show_like']) ? $args['show_like'] : sunix_get_theme_opt( 'archive_like_on', '0' );
            $show_tag = !empty($args['show_tag']) ? $args['show_tag'] : sunix_get_theme_opt( 'archive_tags_on', '0' );

        }

        $args = wp_parse_args($args, [
            'class'           => '',
            'show_author'     => $author_on,
            'show_date'       => $date_on,
            'show_cat'        => $cats_on,
            'show_cmt'        => $comments_on,
            'show_view'        => $show_view,
            'show_like'        => $show_like,
            'show_tag'        => $show_tag,
            'show_edit'       => false,
            'stretch_content' => false,
            'excludes'        => ['category'=> true],
            'sep'             => '',
        ]);
        $metas = [];
        if($args['show_author']) $metas[] = sunix_posted_by(['show_author' => $args['show_author'], 'echo' => false]);
        if($args['show_view']) $metas[] = sunix_post_count_view(['show_view' => $args['show_view'], 'echo' => false, 'icon' =>'flaticon-view']);
        if($args['show_cmt'] && comments_open()) $metas[] = sunix_comments_popup_link(['show_cmt' => $args['show_cmt'], 'echo' => false]);
        if($args['show_like']) $metas[] =  sunix_like_post(['echo' => false]);
        if($args['show_edit']) $metas[] = sunix_edit_link(['show_edit' => $args['show_edit'], 'echo' => false]);
        if(!is_singular()){
            if($args['show_tag']) $metas[] =  sunix_tagged_in(['echo' => false,'icon'=>'flaticon-tag']);
            if($args['show_cat']) $metas[] = sunix_posted_in(['show_cat' => $args['show_cat'], 'echo' => false]);
            if($args['show_date']) $metas[] = sunix_posted_on(['show_date' => $args['show_date'], 'echo' => false]);

        }
        $output = implode($args['sep'], $metas);

        $css_classes = ['red-meta', $args['class'], 'd-flex', 'align-items-center'];
        if($args['stretch_content']) $css_classes[] = 'justify-content-between';
        $classes = trim(implode(' ',$css_classes ));
        if ( $output )
        {
            printf( '<div class="%s">%s</div>', $classes ,$output);
        }
    }
}

/**
 * Post Excerpt
*/
if(!function_exists('sunix_post_excerpt')){
	function sunix_post_excerpt($args =[]){
		$args = wp_parse_args($args,[
            'show_excerpt' => '1',
            'class'        => '',
            'length'       => apply_filters('sunix_excerpt_length', 55),
            'more'         => '&hellip;'
		]);
        if($args['show_excerpt'] !== '1') return;
        $classes   = ['red-excerpt', $args['class']];
        $content      = get_the_excerpt();
        $excerpt_more = apply_filters('sunix_excerpt_more', $args['more']);
        $excerpt      = wp_trim_words($content, $args['length'], $excerpt_more);
        if (!$content){ return;}
	?>
	<div class="<?php echo trim(implode(' ', $classes));?>">
            <?php printf('%s', $excerpt); ?>
	</div>
	<?php
	}
}

/**
 * Post Content
*/
if(!function_exists('sunix_post_content')){
    function sunix_post_content($args = []){
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        $classes = [
            'red-content',
            'red-content-'.get_post_type()
        ];
        if(is_singular()) $classes[] = 'red-single-content clearfix';
    ?>
        <div class="<?php echo trim(implode(' ', $classes));?>">
            <?php the_content(); ?>
        </div>
    <?php
    }
}

/**
 * Loop Pagination 
*/
if(!function_exists('sunix_loop_pagination')){
    function sunix_loop_pagination($args=[]){
        $args = wp_parse_args($args, [
            'show_pagination' => '1',
            'style'           => ''
        ]);
        if($args['show_pagination'] !== '1'){
            wp_reset_query();
            return;
        }
        printf('%s','<div class="red-loop-pagination layout-type-'.esc_attr($args['style']).'">');
        switch ($args['style']) {
            case '5':
                previous_posts_link(
                    apply_filters('sunix_loop_pagination_prev_text', esc_html__('Previous', 'sunix'))
                );
                next_posts_link(
                    apply_filters('sunix_loop_pagination_next_text', esc_html__('Next', 'sunix'))
                );
                break;
            case '4':
                posts_nav_link(
                    apply_filters('sunix_loop_pagination_sep_text', '<span class="d-none"></span>'),
                    apply_filters('sunix_loop_pagination_prev_text', esc_html__('Previous', 'sunix')),
                    apply_filters('sunix_loop_pagination_next_text', esc_html__('Next', 'sunix'))
                );
                break;
            case '3':
                echo '<div class="nav-links">';
                    echo paginate_links([
                        'prev_text' => '<span class="prev hint--top" data-hint="'.apply_filters('sunix_loop_pagination_prev_text', esc_html__('Previous', 'sunix')).'"><span></span></span>',
                        'next_text' => '<span class="next hint--top" data-hint="'.apply_filters('sunix_loop_pagination_next_text', esc_html__('Next', 'sunix')).'"><span></span></span>'
                    ]); 
                echo '</div>';
                break;
            case '2':
                the_posts_pagination([
                    'prev_text' => '<span class="prev">'.esc_html__('Previous', 'sunix').'</span>',
                    'next_text' => '<span class="next">'.esc_html__('Next', 'sunix').'</span>'
                ]);
                break;
            default:
                the_posts_pagination([
                    'prev_text' => '<span class="prev">'.esc_html__('Previous', 'sunix').'</span>',
                    'next_text' => '<span class="next">'.esc_html__('Next', 'sunix').'</span>'
                ]);
                break;
        }
        printf('%s','</div>');
        wp_reset_query();
    }
}


/**
 * Single post Author
 *
 * @since 1.0.0
*/
if(!function_exists('sunix_post_author')){
    function sunix_post_author($args = array()){
        $args = wp_parse_args($args, array('layout' => '1'));
        extract( $args );
        $show_author = sunix_get_opts('post_author_info', '0');
        if('0' === $show_author || empty(get_the_author_meta('description'))) return;
        $user_info = get_userdata(get_the_author_meta('ID'));
    ?>
    <div class="author-box red-box text-center text-md-<?php echo sunix_align();?>">
        <div class="row">
            <div class="author-avatar col-12 col-md-2 col-lg-auto"><?php 
                    echo get_avatar(get_the_author_meta('ID'));
            ?></div>
            <div class="author-info col">
                <div class="author-name text-capitalize">
                    <div class="h4"><?php the_author(); ?></div>
                    <small class="author-roles d-block"><?php echo implode(' / ', $user_info->roles); ?></small>
                </div>
                <div class="author-bio"><?php the_author_meta('description'); ?></div>
                <?php sunix_user_social(['class' => 'align-self-end w-100']); ?>
            </div>
        </div>
    </div>
    <?php
    }
}

/**
 * Display single post related
 * 
 * @since 1.0.0
 */
/**
 * Get custom post type taxonomy TAGS
 *
 * @since 1.0.0
*/
if(!function_exists('sunix_get_custom_post_tag_taxonomy')){
    function sunix_get_custom_post_tag_taxonomy()
    {
        $post = get_post();
        $tax_names = get_object_taxonomies($post);
        $result = 'post_tag';
        if(is_array($tax_names))
        {
            foreach ($tax_names as $name){
                if(strpos($name,apply_filters('sunix_post_related_by', 'cat')) !== false) {
                    $result = $name;
                }
            }
        }
        return $result;
    }
}
if(!function_exists('sunix_post_related')){
    function sunix_post_related( $args = array ()){
        global $post;
        /**
         * Parse incoming $args into an array and merge it with $defaults
         */ 
        $args = wp_parse_args($args, array(
            'title'          => esc_html__('Related Posts','sunix'),
            'posts_per_page' => '2', 
            'columns'        => '2', 
            'carousel'       => apply_filters('sunix_post_related_carousel', false)
        ));
        extract($args);

        $show_related = sunix_get_theme_opt('post_related_on', '0');
        
        if('0' === $show_related) return;

        if($carousel) {
            $col = '';
        } else {
            $col = 'col-md-'.round(12 / $columns);
        }

        //for use in the loop, list 2 posts related to first tag on current post
        $tag_tax_name = sunix_get_custom_post_tag_taxonomy();
        $post = get_post();
        $tags = get_the_terms($post->ID,$tag_tax_name);
        $rtl = is_rtl() ? true : false;
        if ($tags && $show_related) {
            $_tag = array();
            foreach ($tags as $tag) {
                $_tag[] = $tag->slug;
            }        
            $args=array(
                'post_type' => get_post_type(),
                'tax_query' => array(
                    array(
                        'taxonomy' => $tag_tax_name,
                        'field'    => 'slug',
                        'terms'    => $_tag,
                    ),
                ),
                'post__not_in'          => array($post->ID),
                'posts_per_page'        => $posts_per_page,
                'ignore_sticky_posts'   => 1
            );
            $related_query = new WP_Query($args);
            if( $related_query->have_posts() ) {
                echo '<div class="red-related">';
                echo '<div class="related-title h2"><span>'.esc_html($title).'</span></div>';
                echo '<div class="red-grid row" id="red-single-post-related">';
                while ($related_query->have_posts()) : $related_query->the_post(); 
                    echo '<div class="red-grid-item '.esc_attr($col).'">';
                        get_template_part( 'template-parts/loop/content-related', get_post_format() );
                    echo '</div>';
                endwhile;
                echo '</div></div>';
            }
            wp_reset_postdata();
        }
    }
}
/**
 * Single Post Pagination 
*/
if(!function_exists('sunix_post_navigation')){
    function sunix_post_navigation($args = []){
        $args = wp_parse_args($args, [
            'layout' => '1'
        ]);
        $prevthumbnail = $nextthumbnail = '';
        $prevPost = get_previous_post(false);
        $nextPost = get_next_post(false);
        if($prevPost) $prevthumbnail = get_the_post_thumbnail($prevPost->ID);
        if($nextPost) $nextthumbnail = get_the_post_thumbnail($nextPost->ID);
        if(!$prevPost && !$nextPost) return;
        if ( is_singular( 'post' ) ) {
            // Previous/next post navigation.
            ?>
            <div class="post-navigation red-animation move-up">
                <div class="row ">
            <?php
            switch ($args['layout']) {
                default:?>
                    <div class="meta-nav previous col-md-6">
                            <?php if($prevPost) { ?>
                                <div class="row">
                                    <?php
                                        if(!empty($prevthumbnail)) echo '<div class="col-image"><a href="'.esc_url(get_the_permalink($prevPost->ID)).'">'.get_the_post_thumbnail($prevPost->ID,'thumbnail').'</a></div>'; ?>
                                     <div class="col-text <?php if(empty($prevthumbnail)) echo 'full'?>">
                                        <div class="h5"><a href="<?php echo esc_url(get_the_permalink($prevPost->ID));?>"><?php echo get_the_title($prevPost->ID); ?></a></div>
                                        <div class="link"><a href="<?php echo esc_url(get_the_permalink($prevPost->ID));?>"><?php esc_html_e('Previous','sunix'); ?></a></div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="meta-nav next col-md-6 ">
                            <?php if($nextPost) { ?>
                                <div class="row">
                                    <div class="col-text <?php if(empty($nextthumbnail)) echo 'full'?>">
                                       <div class="h5"><a href="<?php echo esc_url(get_the_permalink($nextPost->ID));?>"><?php echo get_the_title($nextPost->ID); ?></a></div>
                                        <div class="link"><a href="<?php echo esc_url(get_the_permalink($nextPost->ID));?>"><?php esc_html_e('Next','sunix'); ?></a></div>
                                    </div>
                                    <?php
                                        if(!empty($nextthumbnail)) echo '<div class="col-image"><a href="'.esc_url(get_the_permalink($nextPost->ID)).'">'.get_the_post_thumbnail($nextPost->ID,'thumbnail').'</a></div>'; ?>
                                   </div>
                            <?php } ?>
                        </div>
                        <?php
                    break;
            }?>
            </div>
        </div>
            <?php
        } elseif (is_singular('ef5_portfolio')){
            sunix_portfolio_navigation($args);
        }
    }
}

/**
 * Single portfolio navigation 
 *
 * @since 1.0.0
*/
if(!function_exists('sunix_portfolio_navigation')){
    function sunix_portfolio_navigation($args = array()){
        $args = wp_parse_args($args, array('layout' => '1'));
        extract( $args );
        $prevthumbnail = $nextthumbnail = '';
        $prevPost = get_previous_post();
        $nextPost = get_next_post();
        if(!$prevPost && !$nextPost) return;

        $portfolio_archive_page = sunix_get_opts('portfolio_page','-1');

        if($portfolio_archive_page === '-1')
            $portfolio_archive_link = get_post_type_archive_link( 'ef5_portfolio' );
        else 
            $portfolio_archive_link = sunix_get_link_by_slug($portfolio_archive_page, 'page');

        switch ($layout) {
            case '2':
                if($prevPost) { ?>
                    <a href="<?php echo esc_url(get_the_permalink($prevPost->ID));?>" class="hint--top" data-hint="<?php echo get_the_title($prevPost->ID); ?>"><span class="flaticon-left-arrow-1"></span></a>
                <?php } ?>
                <a href="<?php echo esc_url($portfolio_archive_link); ?>" class="archive-link hint--top" data-hint="<?php esc_attr_e('View All Projects','sunix');?>"><span class="flaticon-menu"></span></a>
                <?php if($nextPost) { ?>
                    <a href="<?php echo esc_url(get_the_permalink($nextPost->ID));?>" class="hint--top" data-hint="<?php echo get_the_title($nextPost->ID); ?>">
                    <span class="flaticon-right-arrow-1"></span></a>   
                <?php }
            break;
            default:
        ?>
        <nav class="post-navigation portfolio-navigation">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-2 order-md-2 text-center">
                    <a href="<?php echo esc_url($portfolio_archive_link); ?>" class="archive-link"><span class="fa fa-th-large"></span></a>
                </div>
                <div class="nav-box previous col-sm-auto col-md-5 order-md-1 text-<?php echo sunix_align();?>">
                    <?php if($prevPost) { ?>
                        <a class="nav-link" href="<?php echo esc_url(get_the_permalink($prevPost->ID));?>">
                            <div class="meta-nav"><?php esc_html_e('Previous Post','sunix'); ?></div>
                            <div class="post-title h6"><?php echo get_the_title($prevPost->ID); ?></div>
                        </a>            
                    <?php } ?>
                </div>
                <div class="nav-box next col-sm-auto col-md-5 order-md-3 text-<?php echo sunix_align2();?>">
                    <?php if($nextPost) { ?>
                        <a class="nav-link" href="<?php echo esc_url(get_the_permalink($nextPost->ID));?>">
                            <div class="meta-nav"><?php esc_html_e('Next Post','sunix'); ?></div>
                            <div class="post-title h6"><?php echo get_the_title($nextPost->ID); ?></div>
                        </a>   
                    <?php } ?>
                </div>
            </div>
        </nav>
        <?php
            break;
        }
    }
}