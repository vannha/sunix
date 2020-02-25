<?php
/**
 * Language direction 
*/
function sunix_direction($return = true){
    $sunix_direction = is_rtl() ? 'dir-right' : 'dir-left';
    if($return)
        return $sunix_direction;
    else 
        echo esc_attr($sunix_direction);
}
/**
 * get text-align left / right for RTL language 
*/
function sunix_align($return = true){
    $sunix_align = is_rtl() ? 'right' : 'left';
    if($return)
        return $sunix_align;
    else 
        echo esc_attr($sunix_align);
}
function sunix_align2($return = true){
    $sunix_align = is_rtl() ? 'left' : 'right';
    if($return)
        return $sunix_align;
    else 
        echo esc_attr($sunix_align);
}

function sunix_optimize_css_class($string){
    //$string = str_replace('  ', ' ', $string);
    $string = preg_replace('!\s+!', ' ', $string);
    return $string;
}
/**
 * Page CSS Class
*/
function sunix_page_css_class($class = ''){
    $cls = apply_filters('sunix_page_css_class',[]);
    $classes = array_merge(
        [
            'red-page',
            'page-header-'.sunix_get_opts('header_layout', '1'),
            $class
        ], 
        $cls
    );
    if(sunix_get_opts('header_ontop', '0') === '1' || sunix_get_opts('header_sticky', '0') === '1'){
       $classes[] = 'page-header-ontop';
    }
    if(sunix_get_opts('page_overlay_hidden', '1') === '0'){
       $classes[] = 'red-page-overlay-initial';
    }
    echo trim(implode(' ', $classes));
}

/*
 * Archive sidebar position 
*/
function sunix_archive_sidebar_position(){
    return apply_filters('sunix_archive_sidebar_position','right');
}
/*
 * Archive content  grid column
*/
function sunix_archive_grid_col(){
    return apply_filters('sunix_archive_grid_col','8');
}
/*
 * Single Post sidebar position 
*/
function sunix_post_sidebar_position(){
    return apply_filters('sunix_post_sidebar_position','right');
}
/*
 * Single Portfolio sidebar position 
*/
function sunix_portfolio_sidebar_position(){
    return apply_filters('sunix_portfolio_sidebar_position','left');
}
/*
 * Content area css class
*/
function sunix_get_sidebar($check = true){
    $sidebar = 'none';
    if(is_post_type_archive('post') || is_singular('post') || is_home()){
        $sidebar = 'sidebar-main';
    } elseif (is_page()) {
        $sidebar = 'sidebar-page';
    } elseif (class_exists('WooCommerce') && (is_woocommerce()) ) {
        $sidebar = 'sidebar-shop';
    } elseif (is_archive() || is_search()){
        $sidebar = 'sidebar-main';
    }
    if($check)
        return is_active_sidebar($sidebar);
    else 
        return $sidebar;

}
function sunix_sidebar_position(){
    if(is_archive() || is_post_type_archive('post') || is_home() || is_search()){

       if (class_exists('WooCommerce') && (is_post_type_archive('product')) ) {
            $sidebar_position = sunix_get_opts('woo_shop_sidebar_pos', 'none');
           if(isset($_GET['layout']) && !empty($_GET['layout']))
               $sidebar_position = $_GET['layout'];

        }
       else{
           $sidebar_position = sunix_get_opts('archive_sidebar_pos', sunix_archive_sidebar_position());
       }
    } elseif(is_post_type_archive('portfolio')){
        $sidebar_position = sunix_get_opts('portfolio_archive_sidebar_pos', sunix_archive_sidebar_position());
    } elseif(is_page()){
        $sidebar_position = sunix_get_opts('page_sidebar_pos','none');
    } elseif (is_singular('post')) {
        $sidebar_position = sunix_get_opts('post_sidebar_pos',sunix_post_sidebar_position());
    } elseif (class_exists('WooCommerce') && (is_singular('product')) ) {
        $sidebar_position = sunix_get_opts('woo_single_sidebar_pos', 'none');
    }else {
        $sidebar_position = 'none';
    }
    return $sidebar_position;
}
function sunix_content_css_class($class=''){
    $classes = [
        'red-content-area',
        $class
    ];
    $sidebar            = sunix_get_sidebar();
    $sidebar_position   = sunix_sidebar_position();
    $content_grid_class = sunix_get_opts('archive_grid_col', sunix_archive_grid_col());
    if($sidebar && ('none' !== $sidebar_position)){
        if (class_exists('WooCommerce') && (is_woocommerce() ) ) {
            $classes[] = 'col-lg-9 col-md-8';
        }
        else{
            $classes[] = 'col-lg-'.$content_grid_class;
            $classes[] = 'col-md-'.$content_grid_class;
        }
        if($sidebar_position == 'left') $classes[] = 'order-lg-1 order-md-1';
    }
    elseif($sidebar && ('none' == $sidebar_position)){

        if (class_exists('WooCommerce') && (is_woocommerce() ) ) {
            $classes[] = 'col-lg-12 col-md-12';
        }
        elseif ( is_page()){
            $classes[] = 'col-lg-12 col-md-12';
        }
        elseif ( is_singular('post')){
            $classes[] = 'col-lg-12 col-md-12';
        }
        else{
            $classes[] = 'col-lg-8 col-md-12 offset-lg-2';
        }
    }
    elseif($sidebar && ('center' == $sidebar_position)){

            $classes[] = 'col-lg-8 col-md-12 offset-lg-2';
    }
    else {
        $classes[] = 'col-12';
    }
    echo sunix_optimize_css_class(implode(' ', $classes));
}
/**
 * Show Sidebar 
*/

function sunix_sidebar(){
    $sidebar            = sunix_get_sidebar(false);
    $sidebar_position   = sunix_sidebar_position();
    if($sidebar_position === 'none' || $sidebar_position === 'center') return;
    if( is_active_sidebar( $sidebar ) ) {
    ?>
        <div id="red-sidebar-area" class="<?php sunix_sidebar_css_class(); ?>">
            <div class="sidebar-inner">
                <?php get_sidebar(); ?>
            </div>
        </div>
    <?php }
}
/*
 * Sidebar area css class
*/
function sunix_sidebar_css_class($class=''){
    $classes = [
        'red-sidebar-area',
        $class
    ];

    if(!is_singular() || is_single() || !is_page_template()) $classes[] = 'red-blogs';
    $content_grid_class = (int) sunix_get_opts('archive_grid_col', sunix_archive_grid_col());
    $sidebar_grid_class = 12 - $content_grid_class;

    if (class_exists('WooCommerce') && (is_woocommerce() ) ) {
        $classes[] = 'col-lg-3 col-md-4';
    }
    else{
        $classes[] = 'col-lg-'.$sidebar_grid_class;
        $classes[] = 'col-md-'.$sidebar_grid_class;
    }

    echo sunix_optimize_css_class(implode(' ', $classes));
}
function sunix_get_post_from_query_seperate_data($data)
{
    $posts = array();
    if(is_array($data) && !empty($data['body'])  && is_array($data['body']))
    {
        $posts_id_added = array();
        foreach ($data['body'] as $cat_data)
        {
            if(!empty( $cat_data['posts']) && is_array( $cat_data['posts']))
            {
                foreach ( $cat_data['posts'] as $cat_post)
                {
                    if(!in_array($cat_post->ID,$posts_id_added))
                    {
                        $posts[] = $cat_post;
                        $posts_id_added[]= $cat_post->ID;;
                    }
                }
            }
        }
    }
    return $posts;
}
function sunix_cms_menu_get_posts_in_all_cat_filter_view($menu_limit,$data)
{
    $posts =  sunix_get_post_from_query_seperate_data($data);
    if(count($posts) <= $menu_limit)
    {
        $posts_in_all_filter_view = array(
            'ids'=>array(),
            'posts'=>$posts
        );
        foreach ($posts as $post)
            $posts_in_all_filter_view['ids'][] = $post->ID;
    }
    else
    {
        $posts_in_all_filter_view = array(
            'ids'=> array(),
            'posts'=>array()
        );
        for ($i = 0;$i<$menu_limit;$i++)
        {
            if(is_array($data) && !empty($data['body'])  && is_array($data['body']))
            {
                foreach ($data['body'] as $cat_data)
                {
                    if(!empty( $cat_data['posts']) && is_array( $cat_data['posts']))
                    {
                        foreach ( $cat_data['posts'] as $cat_post)
                        {
                            if(!in_array($cat_post->ID,$posts_in_all_filter_view['ids']))
                            {
                                $posts_in_all_filter_view['posts'][] = $cat_post;
                                $posts_in_all_filter_view['ids'][]= $cat_post->ID;
                                break;
                            }
                        }
                    }
                    if(count($posts_in_all_filter_view['ids']) >= $menu_limit)
                        break;
                }
            }
            if(count($posts_in_all_filter_view['ids']) >= $menu_limit)
                break;
        }
    }
    return $posts_in_all_filter_view;
}