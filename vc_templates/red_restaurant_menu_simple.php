<?php
if (!function_exists('fr_get_tax_by')) {
    return;
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$cat_slug = (!empty($choose_menu)) ? $choose_menu : '';
$number_menu = (!empty($number_menu)) ? $number_menu : 100;
$posts = fr_get_posts_by_tax($cat_slug, array(), $limit = $number_menu, $type = 'all','date','DESC');
$current_unit = fr_get_currency();

$wrap_css_class = ['red-menu-simple-wrap'];
$css_class_attr = $item_class = array();
$css_class_attr[] = 'red-menu-simple';
$item_class[] = 'menu-item';

if($layout_style === 'carousel'){
    $wrap_css_class[] = alacarte_owl_css_class($atts);
    $css_class_attr[] = 'red-owl team-carousel owl-carousel';
    $item_class[]     = 'red-carousel-item';
} else {
    $css_class_attr[] = 'red-grid row align-items-center justify-content-center';
    $item_class[]     = 'red-grid-item col-'.$col_sm.' col-md-'.$col_md.' col-lg-'.$col_lg.' col-xl-'.$col_xl;
}

/* get space for owl item */
$owl_item_space = '';
if(isset($margin) && (isset($number_row) && $number_row > 1 )){
    $owl_item_space = 'style="margin-bottom:'.$margin.'px"';
}
$number_row= (!empty($number_row) && is_numeric($number_row) && $number_row> 0)  ? $number_row : 5;
?>
<div class="cms-menu-food red-restaurant-menu-simple-wrap">
    <div class="menu-post">
        <?php if (isset($posts['body']['posts']) && !empty($posts['body']['posts'])){ ?>
            <div class="menu-type-item cms-grid-item clearfix">
                <div class="<?php echo trim(implode(' ', $wrap_css_class));?>">
                    <div id="<?php echo esc_attr($el_id);?>" class="<?php echo trim(implode(' ',$css_class_attr));?>">
                    <?php
                         $count= count($posts['body']['posts']);
                            $i=0;

                         foreach ($posts['body']['posts'] as $post){
                            $i++;

                            $post_meta = fr_get_post_meta($post->ID);
                            $term = wp_get_post_terms($post->ID, $cat_slug);
                            $term = (isset($term[0]))? $term[0] : '';
                            if($number_row == 1){?>
                                <div class="post-item <?php echo join(' ',$item_class);?>">
                            <?php } else{
                                if($i % $number_row == 1){?>
                                    <div class="post-item <?php echo join(' ',$item_class);?>">
                               <?php }
                            } ?>
                                <div class="red-item-inner" <?php echo esc_attr($owl_item_space);?>>
                                    <div class="post-item-inner">
                                        <div class="content-right">
                                            <div class="menu-item-title">
                                                <h3>
                                                    <span> <?php echo esc_html($post->post_title); ?>
                                                    </span>

                                                </h3>
                                                 <span class="price">
                                                    <?php if(function_exists('fr_the_price'))fr_the_price($post->ID,false,'sale-regular') ?>
                                                </span>
                                            </div>

                                            <div class="content-desc"><?php   echo alacarte_get_limit_str($post->post_content, 0,200); ?> </div>
                                        </div>
                                    </div>
                                </div>
                            <?php

                            if($number_row == 1){
                                echo '</div>';
                            }else{
                                if(($i % $number_row == 0) || ($i==$count)){
                                    echo '</div>';
                                }
                            }
                            ?>

                         <?php } ?>
                    </div>
                    <?php if($layout_style === 'carousel') {
                        alacarte_loading_animation();
                        alacarte_owl_dots_container($atts);
                        alacarte_owl_nav_container($atts);
                        alacarte_owl_dots_in_nav_container($atts);
                    } ?>
                </div>

            </div>
        <?php } ?>
    </div>

</div>
