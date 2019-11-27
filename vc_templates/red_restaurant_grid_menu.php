<?php

if (!function_exists('fr_get_posts_by_tax')) {
    return;
}
if (!isset($atts['choose_menu'])) {
    return;
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$number_menu = (!empty($number_menu)) ? $number_menu : 100;
$cat_slug = (isset($atts['choose_menu'])) ? $atts['choose_menu'] : '';
$el_id = !empty($el_id) ? 'red-restaurant-grid-menu-'.$el_id : uniqid('red-restaurant-grid-menu--');
$css_classes = array(
    'red-posts-masonry',
    'red-masonry',
);
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$grid_item_css_class = ['red-masonry-item', 'red-grid-item'];
// Items CSS Classes
$item_css_class = ['post-masonry-item','transition'];
// Filters
$filters_class = ['red-filters', 'red-masonry-filters'];
$originLeft = is_rtl() ? false : true;
$masonry_opts = array(
    'itemSelector'    => '.red-masonry-item',
    'columnWidth'     => '.red-masonry-sizer',
    'gutter'          => '.red-masonry-gutter',
    'percentPosition' => true,
    'originLeft'      => $originLeft,
    'horizontalOrder' => true,

);
$data = fr_get_posts_by_tax($cat_slug,array(),$limit = $number_menu,'seperate','date','DESC');
$posts = alacarte_get_post_from_query_seperate_data($data);
$posts_in_all_filter_view = alacarte_cms_menu_get_posts_in_all_cat_filter_view($number_menu,$data);
$terms = $data['infor']['terms'];
?>
<div class="red-posts red-restaurant-grid-menu" id="<?php echo esc_attr($el_id);?>">
    <?php if($show_filter === '1'): ?>
        <div class="filter-wrap">
            <div class="<?php echo alacarte_optimize_css_class(implode(' ', $filters_class));?>">
                <div class="filter-item active" data-filter="*">
                    <span><?php esc_html_e('All','alacarte'); ?></span>
                </div>
                <?php
                foreach ($terms as $term) {
                    echo '<div class="filter-item" data-filter="'.esc_attr('.'.$term->slug).'"><span>'.esc_html($term->name).'</span><span class="d-none">'.$term->count.'</span></div>';
                }

                ?>
            </div>
            <div class="line_action"></div>
        </div>
    <?php endif; ?>
    <div class="<?php echo esc_attr(trim($css_class));?> row" data-masonry="<?php echo esc_attr(json_encode($masonry_opts));?> ">
        <div class="red-masonry-sizer"></div>
        <div class="red-masonry-gutter"></div>
        <?php
        // limit cat for cat show in view
        $terms_limit_show = array();
        foreach ($posts as $post):
            $terms = fr_get_terms_by_post( $post->ID, $cat_slug );
            $groups= array();// array('"all"');
            if(in_array($post->ID,$posts_in_all_filter_view['ids']))
                $groups[] = '';
            foreach ( $terms as $term ) {
                $term_slug = $term->slug;
                if(empty($terms_limit_show[$term_slug]))
                    $terms_limit_show[$term_slug] = 0;
                if($terms_limit_show[$term_slug] < $number_menu)
                {
                    $groups[] = $term_slug;
                    $terms_limit_show[$term_slug]++;
                }
                $filter_class = implode(' ',$groups);
            }
            ;
            ?>
            <div class="<?php echo alacarte_optimize_css_class(implode(' ',$grid_item_css_class).' '.$filter_class); ?> col-md-12 col-lg-6">
                <div class="menu-post <?php echo alacarte_optimize_css_class(implode(' ', $item_css_class)); ?> ">
                    <?php
                    $post_meta = fr_get_post_meta($post->ID);
                    $term = wp_get_post_terms($post->ID, $cat_slug);
                    $term = (isset($term[0]))? $term[0] : '';
                    ?>
                    <div class="post-item" >
                        <div class="post-item-inner">
                            <div class="img-thumb">
                                <?php  //$thumbnail = wp_get_attachment_image($post_meta['_thumbnail_id'][0],$img_size);
                                // echo wp_kses_post($thumbnail);
                                alacarte_image_by_size([
                                    'id'      => $post_meta['_thumbnail_id'][0],
                                    'size'    => $img_size,
                                    'class'   => '',
                                    'default' => true
                                ]);
                                ?>
                            </div>
                            <div class="content-right">
                                <div class="content-right-inner">
                                    <div class="content-right-center">
                                        <?php if (!empty(fr_get_the_hot_trend($post->ID,false))){?>
                                            <div class="hot">
                                                <?php if(function_exists('fr_get_the_hot_trend'))echo fr_get_the_hot_trend($post->ID,false) ?>
                                            </div>
                                        <?php }?>
                                        <h3>
                                            <?php echo esc_html($post->post_title); ?>
                                        </h3>
                                        <div class="block-icon">
                                            <i class="flaticon-ribbon"></i>
                                        </div>
                                        <div class="content-desc" ><?php echo alacarte_get_limit_str($post->post_content, 0, 90); ?> </div>
                                        <div class="price"> <?php if(function_exists('fr_the_price'))fr_the_price($post->ID,false,'sale-regular') ?> </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
