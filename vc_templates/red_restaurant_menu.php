<?php
if (!function_exists('fr_get_tax_by')) {
    return;
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$cat_slug = (!empty($choose_menu)) ? $choose_menu : '';
$number_menu = (!empty($number_menu)) ? $number_menu : 100;
$current_tax = fr_get_tax_by($cat_slug);
if(empty($current_tax['terms'])) { esc_html__('Please choose a category menu!','alacarte');return;}
$terms = $current_tax['terms'];
// get term by cat
// get post by term
$number_row=4;
    if($layout_template == '2'){

        $large_item=1;
    }
    elseif($layout_template == '3'){

    $large_item=1;
}
    else{
        $large_item=2;
    }
wp_enqueue_script('owl-carousel');
wp_enqueue_script('owl-carousel-theme');
wp_enqueue_style( 'owl-carousel');
wp_enqueue_script('red-menu-carousel', get_template_directory_uri() . '/assets/js/red-menu-carousel.js',  array('jquery'), 1.0, true);
wp_localize_script('red-menu-carousel', 'NavOptions', ['nav_text' => ['<i class="fal fa-chevron-left"></i><span class="text">'.esc_html__('Prev Menu','alacarte').'</span>','<span class="text">'.esc_html__('Next Menu','alacarte').'</span><i class="fal fa-chevron-right"></i>'],'small_item'=> 1,'large_item'=>$large_item,'nav_large_item'=>false,'data_nav'=>$show_nav,'data_dot'=>$show_dot,'data_loop'=>$show_loop]);
wp_enqueue_script('red-menu-carousel');
?>

<div class="cms-menu-food red-restaurant-carousel-layout<?php echo esc_attr($layout_template);?>">
    <div class="cms-grid-masonry">
    <?php
    switch ($layout_template) {
        case'3':?>
            <div class="menu-post owl-carousel">
                <?php foreach ($terms as $term): ?>
                    <?php $posts = fr_get_posts_by_term($current_tax['slug'], $term, $number_menu)  ?>
                    <?php $term_meta = fr_get_term_meta($term->term_id) ;

                    ?>
                        <div class="menu-type-item">
                            <div class="menu-type-item-left">
                                <div class="menu-title"
                                     style="background-image: url(<?php echo wp_get_attachment_url($term_meta['layout']) ?>);">

                                </div>
                            </div>
                            <div class="red-menu-slider-wrap">
                                    <?php
                                    $counter = 0;
                                    $total_menu = count($posts);
                                    foreach ($posts as $menu_item) {
                                        ?>
                                        <?php
                                        $post_meta = fr_get_post_meta($menu_item->ID);
                                        $current_unit = fr_get_currency();
                                        ?>
                                        <div class="post-item">
                                            <div class="post-item-inner">
                                                <div class="content-right">
                                                    <div class="menu-item-title">
                                                        <h3>
                                            <span><?php echo esc_html($menu_item->post_title); ?>
                                            </span>

                                                        </h3>
                                                        <span class="price">
                                                <?php if (!empty($post_meta['fs_sale_price'][0])) { ?><span
                                                        class="sale-price"><?php echo esc_html($current_unit['character']) . esc_html($post_meta['fs_sale_price'][0]); ?> </span><?php } ?>
                                             <span class="regular-price" <?php if (!empty($post_meta['fs_sale_price'][0])) {
                                                                echo 'style="text-decoration: line-through;padding-left: 10px;';
                                                            } ?>"><?php echo esc_html($current_unit['character']) . esc_html($post_meta['fs_regular_price'][0]); ?> </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>
                                </div>

                        </div>
                <?php endforeach; ?>
            </div>
            <?php  break;
        case '2':
            $posts = fr_get_posts_by_tax($cat_slug, array(), $limit = $number_menu, $type = 'all','date','DESC');
            ?>

            <div class="menu-type-item cms-grid-item clearfix">
                <div class="red-menu-slider-wrap">
                    <div class="menu-post owl-carousel">
                        <?php
                        $count= count($posts['body']['posts']);
                        $counter = 0;
                        $rows = 1;
                        foreach ($posts['body']['posts'] as $post){
                            $post_meta = fr_get_post_meta($post->ID);
                            $term = wp_get_post_terms($post->ID, $cat_slug);
                            $term = (isset($term[0]))? $term[0] : '';
                            $counter++;
                            if ($rows == 1) {
                                echo '<div class="cs-team-carousel-item-wrap">';
                            } else {
                                if ($counter % $rows == 1) {
                                    echo '<div class="cs-team-carousel-item-wrap">';
                                }
                            }
                            ?>
                            <div class="post-item">
                                <div class="post-item-inner">
                                    <div class="img-thumb">
                                        <?php  $thumbnail = wp_get_attachment_image($post_meta['_thumbnail_id'][0],'alacarte-436-544');
                                        echo wp_kses_post($thumbnail);
                                        ?>
                                    </div>
                                    <div class="content-right">
                                        <div class="menu-item-title">
                                            <h3>
                                                   <?php echo esc_html($post->post_title); ?>
                                            </h3>

                                        </div>
                                        <div class="price h4">
                                            <?php if(function_exists('fr_the_price'))fr_the_price($post->ID,false,'sale-regular') ?>
                                        </div>
                                        <div class="content-desc"><?php   echo alacarte_get_limit_str($post->post_content, 0,400); ?> </div>
                                        <div class="footer-menu-wrap">
                                            <a href="#form-app-popup" class="mfp-inline red-btn accent outline">
                                                <?php echo esc_html('Book a Table','alacarte'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php

                            if ($rows == 1) {
                                echo '</div>';
                            } else {
                                if (($counter % $rows == 0) || ($counter == $count)) {
                                    echo '</div>';
                                }
                            }

                            ?>

                        <?php } ?>
                    </div>
                </div>

            </div>

        <?php break;
        default:
            foreach ($terms as $term): ?>
            <?php $posts = fr_get_posts_by_term($current_tax['slug'], $term, $number_menu)  ?>
            <?php $term_meta = fr_get_term_meta($term->term_id) ;

            ?>
            <div class="menu-type-item cms-grid-item clearfix">
                <div class="menu-title" style="background-image: url(<?php echo wp_get_attachment_url($term_meta['background']) ?>);">
                    <h6 class="menu-desc">  <?php echo esc_html($term->description); ?></h6>
                    <h3> <?php echo esc_html($term->name); ?></h3>

                </div>
                <div class="red-menu-slider-wrap">
                    <div class="container">
                        <div class="menu-post owl-carousel">
                            <?php
                            $counter =0;
                            $rows = $number_row;
                            $total_menu= count($posts);
                            foreach ($posts as $menu_item){?>
                                <?php

                                $post_meta = fr_get_post_meta($menu_item->ID);

                                $current_unit = fr_get_currency();
                                $counter ++;
                                if($rows == 1){
                                    echo '<div class="cs-team-carousel-item-wrap">';
                                } else {
                                    if($counter % $rows == 1){
                                        echo '<div class="cs-team-carousel-item-wrap">';
                                    }
                                }
                                ?>
                                <div class="post-item">
                                    <div class="post-item-inner">
                                        <div class="img-thumb">
                                            <?php  $thumbnail = wp_get_attachment_image($post_meta['_thumbnail_id'][0],'thumbnail');
                                            echo wp_kses_post($thumbnail);
                                            ?>
                                        </div>
                                        <div class="content-right">
                                            <div class="menu-item-title">
                                                <h3>
                                                <span><?php echo esc_html($menu_item->post_title); ?>
                                                </span>

                                                </h3>
                                             <span class="price">
                                                    <?php if (!empty($post_meta['fs_sale_price'][0])){ ?><span class="sale-price"><?php echo esc_html($current_unit['character']) . esc_html($post_meta['fs_sale_price'][0]); ?> </span><?php }?>
                                                 <span class="regular-price" <?php if (!empty($post_meta['fs_sale_price'][0])){ echo 'style="text-decoration: line-through;padding-left: 10px;';}?>"><?php echo esc_html($current_unit['character']) . esc_html($post_meta['fs_regular_price'][0]); ?> </span>
                                                </span>
                                            </div>

                                            <div class="content-desc"><?php   echo alacarte_get_limit_str($menu_item->post_content, 0,200); ?> </div>
                                        </div>
                                    </div>
                                </div>
                                <?php

                                if($rows == 1){
                                    echo '</div>';
                                }else{
                                    if(($counter % $rows == 0) || ($counter==$total_menu)){
                                        echo '</div>';
                                    }
                                }

                                ?>

                            <?php } ?>
                        </div>
                    </div>

                </div>

            </div>
        <?php endforeach; ?>
        <?php  break;} ?>
    </div>
    <?php if ($layout_template=='2'){ ?>
        <div id="form-app-popup" class="mfp-hide  red-animation fall-perspective app_popup">
            <div class="container">
                <?php echo do_shortcode('[reservation]'); ?>
            </div>
        </div>
    <?php  }?>
</div>
