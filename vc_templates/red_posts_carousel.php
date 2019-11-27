<?php
    $lists = $icon = '';
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    /* get value for Design Tab */
    $css_classes = array(
        'red-posts-carousel',
        'red-posts-grid-'.$layout_template,
        'red-owl',
        'owl-carousel',
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
    // Grid columns css class
    $grid_item_css_class = ['red-grid-item red-carousel-item', $this->getCSSAnimation( $css_animation )];
    // Items CSS Classes
    $item_css_class = ['post-grid-item','transition', 'red-hover-wrap'];

    $has_shadow = ['2','3','4','5','6','10','11','12'];
    if(in_array($layout_template, $has_shadow)) $item_css_class[] = 'red-box red-box-shadow';

    // Title 
    $title_class = '';

    // Thumbnail Size
    $thumbnail_size_index = -1;
    $thumbnail_size = explode(',', $thumbnail_size);
?>
<div id="<?php echo esc_attr('red-posts-'.$el_id);?>" class="red-posts red-posts-layout-<?php echo esc_attr($layout_template);?> <?php echo alacarte_owl_css_class($atts);?>">
    <div id="<?php echo esc_attr($el_id);?>" class="<?php echo esc_attr(trim($css_class));?>">
    <?php 
        $d = 0;
        while($posts->have_posts()){
            $d++;
            // Thumbnail Size
            $thumbnail_size_index++;
            if($thumbnail_size_index >= count($thumbnail_size))
                $thumbnail_size_index = $thumbnail_size_index - count($thumbnail_size) ;
            $posts->the_post();
            // Post Metas
            $post_metas   = [];
            $post_metas[] = alacarte_posted_on(['show_date'=>'1','echo' => false]);
            $post_metas[] = alacarte_posted_by(['show_author'=>'1','author_avatar' => false, 'echo' => false]);
            /**
             * Layout 5 Post Metas 
            */
            $post_metas_5   = [];
            $post_metas_5[] = alacarte_posted_by(['show_author'=>'1','author_avatar' => false, 'echo' => false]);
            $post_metas_5[] = alacarte_comments_popup_link(['show_cmt'=>'1','echo' => false]);

            // Readmore button 
            $alacarte_post_media_readmore = alacarte_post_read_more(['echo' => false, 'show_readmore' => '1', 'readmore_class' => ' center-align']);
            $alacarte_post_media_readmore2 = alacarte_post_read_more_circle(['echo' => false, 'show_readmore' => '1', 'readmore_class' => 'center-align']);
            $alacarte_post_media_readmore3 = alacarte_post_read_more_circle([
                'echo'    => false,
                'class'   => 'sonarWarning', 
                'size'    => '50',
                'bgcolor' => 'bg-accent',
                'icon'    => 'flaticon-right-arrow-1 text-white',
            ]);
            $alacarte_post_media_cat   = alacarte_posted_in(['echo' => false, 'show_cat' => '1','class' => 'red-box-meta red-box-meta2', 'sep' => '']);
            $alacarte_post_media_share = alacarte_post_share(['echo' => false, 'class' => 'col-auto', 'show_share' => '0', 'show_title' => false, 'social_args' => ['class' => 'shape-circle colored-hover outline justify-content-center', 'size' => '30']]);
            $alacarte_post_media_date  = alacarte_posted_on(['echo' => false, 'show_date' => '1','class' => 'red-box-meta red-box-meta2 text-uppercase', 'sep' => '']);
        ?>
        <div class="<?php echo alacarte_optimize_css_class(implode(' ',$grid_item_css_class )); ?>" style="animation-delay: <?php echo esc_html($d)*100;?>ms">
        <?php
            switch ($layout_template) {
                case '4':
                    ?>
                    <article class="<?php echo alacarte_optimize_css_class(implode(' ', $item_css_class)); ?>">
                        <?php
                        alacarte_post_media([
                            'class'          => '',
                            'thumbnail_size' => $thumbnail_size[$thumbnail_size_index],
                            'default_thumb'  => true,
                            'after'          => ''
                        ]);
                        ?>
                        <div class="content">
                            <?php

                            alacarte_post_meta([
                                'class'       => '',
                                'show_author' => '0',
                                'show_date'   => '1',
                                'show_cat'    => '1',
                                'show_cmt'    => '0',
                                'show_view'   => '0',
                                'show_like'   => '0',
                                'sep'         => '/'
                            ]);
                            alacarte_post_title([
                                'heading_tag' => alacarte_default_value($heading_tag,'h4'),
                                'class'       => 'loop'
                            ]);

                            ?>
                        </div>


                    </article>
                    <?php
                    break;
                case '3':
                    ?>
                    <article class="<?php echo alacarte_optimize_css_class(implode(' ', $item_css_class)); ?>">
                        <?php
                        alacarte_post_media([
                            'thumbnail_size' => $thumbnail_size[$thumbnail_size_index],
                            'default_thumb'  => true,
                            'after'          => '',
                        ]);

                        alacarte_post_meta([
                            'class'       => '',
                            'show_author' => '0',
                            'show_date'   => '0',
                            'show_cat'    => '1',
                            'show_cmt'    => '0',
                            'show_view'   => '0',
                            'show_like'   => '0',
                            'sep'         => ''
                        ]);
                        alacarte_post_title([
                            'heading_tag' => alacarte_default_value($heading_tag,'h4'),
                            'class'       => 'loop'
                        ]);
                        ?>
                    </article>
                    <?php
                    break;
                case '2':
        ?>
                <article class="<?php echo alacarte_optimize_css_class(implode(' ', $item_css_class)); ?>">
                    <?php 
                        alacarte_post_media([
                            'thumbnail_size' => $thumbnail_size[$thumbnail_size_index], 
                            'default_thumb'  => true,
                            'after'          => '',
                        ]); 

                        alacarte_post_meta([
                            'class'       => '',
                            'show_author' => '0',
                            'show_date'   => '0',
                            'show_cat'    => '1',
                            'show_cmt'    => '0',
                            'show_view'   => '0',
                            'show_like'   => '0',
                            'sep'         => ''
                        ]);
                        alacarte_post_title([
                            'heading_tag' => alacarte_default_value($heading_tag,'h4'),
                            'class'       => 'loop'
                        ]);
                    ?>
                </article>
                <?php
                    break;
                default:
        ?>
                    <article class="<?php echo alacarte_optimize_css_class(implode(' ', $item_css_class)); ?>">
                        <?php
                        alacarte_post_media([
                            'class'          => '',
                            'thumbnail_size' => $thumbnail_size[$thumbnail_size_index],
                            'default_thumb'  => true,
                            'after'          => ''
                        ]);
                        ?>
                        <?php
                        alacarte_post_header([
                            'heading_tag' => alacarte_default_value($heading_tag,'h2'),
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
        wp_reset_query();
    ?>
    </div>
    <?php alacarte_loading_animation(); ?>
    <div class="red-posts-footer"><?php
        alacarte_owl_dots_container($atts);
        alacarte_owl_nav_container($atts);
        alacarte_owl_dots_in_nav_container($atts);
        if($show_view_all && !empty($show_view_all_page)){
            echo '<div class="red-posts-view-all"><a class="red-btn simple red-btn-lg underline-default icon-right transition d-inline-block" href="'.esc_url(get_permalink($show_view_all_page)).'"><span class="btn-title">'
                .sprintf(
                    '%s', 
                    $show_view_all_text
                ).'</span> <span class="btn-icon flaticon-right-arrow"></span></a></div>';
        }
    ?></div>
</div>
