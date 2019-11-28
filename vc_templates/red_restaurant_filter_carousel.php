<?php if (!function_exists('fr_get_posts_by_tax')) {
return;
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
if (!isset($choose_menu)) {
    return;
}
$number_menu = (!empty($number_menu) && is_numeric($number_menu) && $number_menu> 0)  ? $number_menu : 100;
if($layout_template=='2'){
    $large_item=2;
}
elseif($layout_template=='3'){
    $large_item=2;
}
else{
    $large_item=1;
}
$cat_slug = (!empty($choose_menu)) ? $choose_menu : '';
$current_tax = fr_get_tax_by($cat_slug);
if(empty($current_tax['terms'])) { esc_html__('Please choose a category menu!','sunix');return;}
$terms = $current_tax['terms'];
wp_enqueue_script('red-menu-filter-carousel', get_template_directory_uri() . '/assets/js/red-menu-filter-carousel.js',  array('jquery'), 1.0, true);
wp_enqueue_script('owl-carousel');
wp_enqueue_script('owl-carousel-theme');
wp_enqueue_style( 'owl-carousel');
wp_enqueue_script('red-menu-carousel', get_template_directory_uri() . '/assets/js/red-menu-carousel.js',  array('jquery'), 1.0, true);
wp_localize_script('red-menu-carousel', 'NavOptions', ['nav_text' => ['<i class="fal fa-chevron-left"></i><span class="text">'.esc_html__('Prev Menu','sunix').'</span>','<span class="text">'.esc_html__('Next Menu','sunix').'</span><i class="fal fa-chevron-right"></i>'],'small_item'=> 1,'large_item'=>$large_item,'nav_large_item'=>true,'data_nav'=>$show_nav,'data_dot'=>$show_dot,'data_loop'=>$show_loop]);
wp_enqueue_script('red-menu-carousel');
$number_row= (!empty($number_row) && is_numeric($number_row) && $number_row> 0)  ? $number_row : 6;
?>
<div class="red-filter-carousel-menu tabs js-tabs layout-<?php echo esc_attr($layout_template);?>">
    <div class="tabs-nav js-tabs-nav" id="filter-menu">
        <ul class="tabs-nav__list">
            <?php
            $i=0;
            foreach ($terms as $term){
                $i++;?>
                <li class="tabs-nav__item js-tabs-item <?php  if ($i==1) echo 'active';?>">
                    <a class="tabs-nav__link js-tabs-link" href="#<?php echo ''.$term->slug; ?>"><?php echo esc_html($term->name); ?></a>
                </li>
            <?php } ?>
        </ul>
        <span class="tabs-nav__drag js-tabs-drag"></span>
    </div>
    <div class="cms-menu-food tabs-content js-tabs-wrap ">
        <?php $j=0; foreach ($terms as $term): $j++ ?>
            <?php $posts = fr_get_posts_by_term($current_tax['slug'], $term, $number_menu)  ?>
            <?php $term_meta = fr_get_term_meta($term->term_id) ;
            ?>
            <div class="menu-type-item tab js-tabs-content <?php  if ($j==1) echo 'active';?>" id="<?php echo esc_attr($term->slug); ?>">
                <?php
                switch ($layout_template) {
                    case '3':
                        ?>
                        <div class="cms-grid-masonry">
                            <div class="menu-type-item cms-grid-item clearfix">
                                <div class="red-menu-slider-wrap">
                                    <div class="menu-post owl-carousel">
                                        <?php
                                        $counter = 0;
                                        $rows = $number_row;
                                        $total_menu = count($posts);
                                        foreach ($posts as $menu_item) {
                                            ?>
                                            <?php
                                            $post_meta = fr_get_post_meta($menu_item->ID);

                                            $current_unit = fr_get_currency();
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
                                                            <span class="price red-heading">
                                                    <?php if (!empty($post_meta['fs_sale_price'][0])){ ?><span class="sale-price"><?php echo esc_html($current_unit['character']) . esc_html($post_meta['fs_sale_price'][0]); ?> </span><?php }?>
                                                 <span class="regular-price" <?php if (!empty($post_meta['fs_sale_price'][0])){ echo 'style="text-decoration: line-through;padding-left: 10px;';}?>"><?php echo esc_html($current_unit['character']) . esc_html($post_meta['fs_regular_price'][0]); ?> </span>
                                                            </span>
                                                        </div>

                                                        <div class="content-desc"><?php   echo sunix_get_limit_str($menu_item->post_content, 0,200); ?> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php

                                            if ($rows == 1) {
                                                echo '</div>';
                                            } else {
                                                if (($counter % $rows == 0) || ($counter == $total_menu)) {
                                                    echo '</div>';
                                                }
                                            }

                                            ?>

                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                        break;
                    case '2':
                        ?>
                        <div class="cms-grid-masonry">
                            <div class="menu-type-item cms-grid-item clearfix">
                                <div class="red-menu-slider-wrap">
                                    <div class="menu-post owl-carousel">
                                        <?php
                                        $counter = 0;
                                        $rows = $number_row;
                                        $total_menu = count($posts);
                                        foreach ($posts as $menu_item) {
                                            ?>
                                            <?php
                                            $post_meta = fr_get_post_meta($menu_item->ID);

                                            $current_unit = fr_get_currency();
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

                                                        <div class="content-desc"><?php   echo sunix_get_limit_str($menu_item->post_content, 0,200); ?> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php

                                            if ($rows == 1) {
                                                echo '</div>';
                                            } else {
                                                if (($counter % $rows == 0) || ($counter == $total_menu)) {
                                                    echo '</div>';
                                                }
                                            }

                                            ?>

                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                        break;
                    default:
                        ?>
                        <div class="cms-grid-masonry">
                            <div class="menu-type-item cms-grid-item clearfix">
                                <div class="menu-type-item-left">
                                
                                    <div class="menu-title"
                                         style="background-image: url(<?php echo wp_get_attachment_url($term_meta['layout']) ?>);">

                                    </div>
                                </div>
                                <div class="red-menu-slider-wrap">
                                    <div class="menu-post owl-carousel">
                                        <?php
                                        $counter = 0;
                                        $rows = $number_row;
                                        $total_menu = count($posts);
                                        foreach ($posts as $menu_item) {
                                            ?>
                                            <?php
                                            $post_meta = fr_get_post_meta($menu_item->ID);

                                            $current_unit = fr_get_currency();
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

                                                        <div class="content-desc"><?php echo sunix_get_limit_str($menu_item->post_content, 0, 200); ?> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php

                                            if ($rows == 1) {
                                                echo '</div>';
                                            } else {
                                                if (($counter % $rows == 0) || ($counter == $total_menu)) {
                                                    echo '</div>';
                                                }
                                            }

                                            ?>

                                        <?php } ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                        break;
                } ?>

            </div>
        <?php endforeach; ?>
    </div>



</div>
