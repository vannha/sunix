<?php
    $lists = $icon = '';
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $el_id = !empty($el_id) ? 'red-posts-'.$el_id : uniqid('red-posts-');
    /* get value for Design Tab */
    $css_classes = array(
        'red-posts-list',
        'layout-'.$layout_template,
        vc_shortcode_custom_css_class( $css ),
    );
    
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );

    /* Post query */
    $tax_query = alacarte_tax_query($post_type, $taxonomies, $taxonomies_exclude);
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
    $post_type = get_post_type();
    // Items CSS Classes
    $item_css_class = ['red-list','post-list-item',' wpb_fadeInUp fadeInUp'];
    
    // Title 
    $title_class = '';
?>
<div class="red-posts" id="<?php echo esc_attr($el_id);?>">
    <div class="<?php echo esc_attr(trim($css_class));?>">
    <?php 
        while($posts->have_posts()){
            $posts->the_post();
        ?>
        <?php
            switch ($layout_template) {
                case '3': ?>
                    <article class="<?php echo alacarte_optimize_css_class(implode(' ', $item_css_class)); ?> clearfix">
                        <div class="event-date">
                            <div class="day h2"> <?php echo get_the_modified_date('d');?> </div>
                            <div class="date-right">
                                <span> <?php echo get_the_modified_date('M');?></span>
                                <span> <?php echo get_the_modified_date('D');?></span>
                            </div>

                        </div>
                        <?php
                        alacarte_post_header([
                            'heading_tag' => 'h3',
                            'before_args' => ['show_cat'=> '0','show_date'=> '0'],
                            'after_args'  => ['show_cat' => '0','show_author' => '0', 'show_date'=> '0', 'show_cmt' => '0', 'show_view' => '0', 'show_like' => '0', 'sep' => '/' ]]);

                        ?>

                        <a href="#form-app-popup" class="mfp-inline red-btn primary fill">
                            <?php echo esc_html('Book a Table','alacarte'); ?>
                        </a>
                    </article>
                    <?php  break;
                case '2': ?>
                    <article class="<?php echo alacarte_optimize_css_class(implode(' ', $item_css_class)); ?> clearfix">
                        <div class="event-date">
                            <div class="day h2"> <?php echo get_the_modified_date('d');?> </div>
                            <div class="date-right">
                                <span> <?php echo get_the_modified_date('M');?></span>
                                <span> <?php echo get_the_modified_date('D');?></span>
                            </div>

                        </div>
                        <?php
                        alacarte_post_header([
                            'heading_tag' => 'h3',
                            'before_args' => ['show_cat'=> '0','show_date'=> '0'],
                            'after_args'  => ['show_cat' => '0','show_author' => '0', 'show_date'=> '0', 'show_cmt' => '0', 'show_view' => '0', 'show_like' => '0', 'sep' => '/' ]]);

                        ?>

                        <a href="#form-app-popup" class="mfp-inline red-btn accent outline">
                            <?php echo esc_html('Book a Table','alacarte'); ?>
                        </a>
                    </article>
                  <?php  break;
                default:
        ?>
            <article <?php post_class(trim(implode(' ', $item_css_class))); ?>>
                <?php alacarte_post_media(['thumbnail_size' => 'large', 'default_thumb' => false]); ?>
                <?php

                alacarte_post_header([
                    'class' => 'loop',
                    'before_args' => [],
                    'after_args'  => ['show_cat' => '0','show_author' => '0', 'show_date'=> '0', 'show_cmt' => '0', 'show_view' => '0', 'show_like' => '0','show_tag' => '0', 'sep' => '' ]]);

                alacarte_post_excerpt();
                alacarte_post_meta();
                ?>
                <?php alacarte_post_read_more(['show_readmore' => $show_readmore, 'readmore_style' => '']); ?>
            </article>
        <?php
                break;
            }
        }
    ?>
    </div>
    <?php if (($layout_template=='2') || ($layout_template=='3')){ ?>
        <div id="form-app-popup" class="mfp-hide  red-animation fall-perspective app_popup">
            <div class="container">
                <?php echo do_shortcode('[reservation]'); ?>
            </div>
        </div>
    <?php  }?>
    <?php alacarte_loop_pagination(['show_pagination' => $show_pagination, 'style' => '']); ?>
</div>
