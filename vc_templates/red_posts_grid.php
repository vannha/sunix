<?php
    $lists = $icon = '';
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );

    $el_id = !empty($el_id) ? 'red-posts-'.$el_id : uniqid('red-posts-');
    /* get value for Design Tab */
    $css_classes = array(
        'red-posts-grid',
        'red-grid',
        'red-posts-grid-'.$layout_template,
        'row',
        vc_shortcode_custom_css_class( $css ),
    );
    
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

    /* Post query */
    $tax_query = sunix_tax_query($post_type, $taxonomies, $taxonomies_exclude);
    if ( get_query_var('paged') ) {
        $paged = get_query_var('paged');
    } elseif ( get_query_var('page') ) {
        $paged = get_query_var('page');
    } else {
        $paged = 1;
    }
    $posts_args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $posts_per_page,
        'post_status'    => 'publish',
        'tax_query'      => $tax_query,
        'paged'          => $paged,
    );
    global $wp_query;
    $posts = $wp_query = new WP_Query($posts_args);
    // Grid columns css class
    $grid_item_css_class = ['red-grid-item', $this->getCSSAnimation( $css_animation ), 'col-'.$col_sm, 'col-md-'.$col_md, 'col-lg-'.$col_lg, 'col-xl-'.$col_xl];
    // Items CSS Classes
    $item_css_class = ['post-grid-item','transition', 'red-hover-wrap'];

    $has_shadow = ['2','5','6','10','11','12'];
    if(in_array($layout_template, $has_shadow)) $item_css_class[] = 'red-box-shadow';

    $slide_overlay = ['8','9'];
    if(in_array($layout_template, $slide_overlay)) $item_css_class[] = 'hoverdir-wrap fade-in red-line-corner-wrap';
    
    // Title 
    $title_class = '';
?>
<div class="red-posts" id="<?php echo esc_attr($el_id);?>">
<div class="<?php echo esc_attr(trim($css_class));?>">
<?php 
    $d = 0;
    while($posts->have_posts()){
        $d++;
        $posts->the_post();
        // Post Metas
        $post_metas   = [];
        $post_metas[] = sunix_posted_on(['show_date'=>'1','echo' => false]);
        $post_metas[] = sunix_posted_by(['show_author'=>'1','author_avatar' => false, 'echo' => false]);
        //$post_metas[] = sunix_comments_popup_link(['show_cmt'=>'1','echo' => false]);
        //$post_metas[] = sunix_post_count_view(['show_view'=>'1','echo' => false]);
        //$post_metas[] = sunix_post_count_like(['show_like'=>'1','echo' => false]);
        /**
         * Layout 5 Post Metas 
        */
        $post_metas_5   = [];
        $post_metas_5[] = sunix_posted_by(['show_author'=>'1','author_avatar' => false, 'echo' => false]);
        $post_metas_5[] = sunix_comments_popup_link(['show_cmt'=>'1','echo' => false]);

        // Readmore button 
        $sunix_post_media_readmore = sunix_post_read_more(['echo' => false, 'show_readmore' => '1', 'readmore_class' => ' center-align']);
        $sunix_post_media_readmore2 = sunix_post_read_more_circle(['echo' => false, 'show_readmore' => '1', 'readmore_class' => 'center-align']);
        $sunix_post_media_readmore3 = sunix_post_read_more_circle([
            'echo'    => false,
            'class'   => 'sonarWarning',
            'size'    => '50',
            'bgcolor' => 'bg-accent',
            'icon'    => 'flaticon-right-arrow-1 text-white',
        ]);
        $sunix_post_media_cat   = sunix_posted_in(['echo' => false, 'show_cat' => '1','class' => 'red-box-meta red-box-meta2', 'sep' => '']);
        $sunix_post_media_share = sunix_post_share(['echo' => false, 'class' => 'col-auto', 'show_share' => '0', 'show_title' => false, 'social_args' => ['class' => 'shape-circle colored-hover outline justify-content-center', 'size' => '30']]);
        $sunix_post_media_date  = sunix_posted_on(['echo' => false, 'show_date' => '1','class' => 'red-box-meta red-box-meta2 text-uppercase', 'sep' => '']);
    ?>
    <div class="<?php echo sunix_optimize_css_class(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d)*100;?>ms">
    <?php
        switch ($layout_template) {
            case '4':
    ?>
            <article class="<?php echo sunix_optimize_css_class(implode(' ', $item_css_class)); ?>">
                <div class="event-thumb">
                    <div class="event-type">
                        <?php $event_type = sunix_get_post_format_value('event_type',''); ?>
                        <?php if ($event_type==1){ echo esc_html('TICKET AVAILABLE','sunix');}else{ echo esc_html('SOLD OUT','sunix');}?>

                    </div>
                     <?php
                        sunix_post_media([
                            'thumbnail_size' => sunix_default_value($thumbnail_size,'370x260'),
                            'default_thumb'  => true,
                            'after'          => ''
                        ]);
                     ?>
                </div>
                <?php
                    sunix_post_header([
                        'heading_tag' => sunix_default_value($heading_tag,'h4'),
                        'before_args' => ['show_cat'=> '0','show_date'=> '1'],
                        'after_args'  => ['show_cat' => '0','show_author' => '0', 'show_date'=> '0', 'show_cmt' => '0', 'show_view' => '0', 'show_like' => '0', 'sep' => '/' ]]);
                    ?>

            </article>
            <?php
                break;
            case '3':
    ?>
                <article class="<?php echo sunix_optimize_css_class(implode(' ', $item_css_class)); ?>">
                    <?php
                    sunix_post_media([
                        'thumbnail_size' => sunix_default_value($thumbnail_size,'740x690'),
                        'default_thumb'  => true
                    ]);
                    ?>
                    <?php
                    sunix_post_header([
                        'heading_tag' => sunix_default_value($heading_tag,'h2'),
                        'before_args' => ['show_cat'=> '0','show_date'=> '0'],
                        'after_args'  => ['show_cat' => '0','show_author' => '0', 'show_date'=> '0', 'show_cmt' => '0', 'show_view' => '0', 'show_like' => '0', 'sep' => '/' ]]);
                    ?>
                </article>
            <?php
                break;
            case '2':
    ?>
                <article class="<?php echo sunix_optimize_css_class(implode(' ', $item_css_class)); ?>">
                    <?php
                    sunix_post_media([
                        'thumbnail_size' => sunix_default_value($thumbnail_size,'740x490'),
                        'default_thumb'  => true
                    ]);
                    ?>
                    <?php
                    sunix_post_header([
                        'heading_tag' => sunix_default_value($heading_tag,'h2'),
                        'before_args' => ['show_cat'=> '1','show_date'=> '1'],
                        'after_args'  => ['show_cat' => '0','show_author' => '0', 'show_date'=> '0', 'show_cmt' => '0', 'show_view' => '0', 'show_like' => '0', 'sep' => '/' ]]);
                    ?>
                </article>
            <?php
                break;
            default:
    ?>	
    	<article class="<?php echo sunix_optimize_css_class(implode(' ', $item_css_class)); ?>">
            <?php 
                sunix_post_media([
                    'thumbnail_size' => sunix_default_value($thumbnail_size,'740x490'),
                    'default_thumb'  => true
                ]);
            ?>
            <?php
                sunix_post_header([
                    'heading_tag' => sunix_default_value($heading_tag,'h2'),
                    'before_args' => ['show_cat'=> '0','show_date'=> '0'],
                    'after_args'  => ['show_cat' => '1','show_author' => '0', 'show_date'=> '1', 'show_cmt' => '0', 'show_view' => '0', 'show_like' => '0', 'sep' => '/' ]]);
            ?>
        </article>
    <?php
            break;
        }
    ?>
    </div>
    <?php
    } // end while
?>
</div>
<?php sunix_loop_pagination(['show_pagination' => $show_pagination, 'style' => '']); ?>
</div>
