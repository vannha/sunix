<?php 
/**
 * Get Page List 
 * @return array
*/
if(!function_exists('alacarte_list_page')){
    function alacarte_list_page($default = []){
        $page_list = array();
        if(!empty($default))
            $page_list[$default['value']] = $default['label'];
        $pages = get_pages(array('hierarchical' => 0, 'posts_per_page' => '-1'));
        foreach($pages as $page){
            $page_list[$page->post_name] = $page->post_title;
        }
        return $page_list;
    }
}

/**
 * Get Post List
 * @return array
*/
if(!function_exists('alacarte_list_post')){
    function alacarte_list_post($post_type = 'post', $default = false){
        $post_list = array();
        if($default){
            $post_list['none'] = esc_html__('None','alacarte');
            $post_list['-1']   = esc_html__('Default','alacarte');
        }
        $posts = get_posts(array('post_type' => $post_type,'posts_per_page' => '-1'));
        foreach($posts as $post){
            $post_list[$post->post_name] = $post->post_title;
        }
        return $post_list;
    }
}

/**
 * Get post thumbnail as image options
 * @return array
 *
*/
function alacarte_list_post_thumbnail($post_type = 'post', $default = false){
    $layouts = [];
    $posts = get_posts(array('post_type' => $post_type,'posts_per_page' => '-1'));
    foreach($posts as $post){
        $layouts[$post->post_name] = get_the_post_thumbnail_url($post->ID, 'full');
    }
    return $layouts;
}

/**
 * get list menu.
 * @return array
 */
if(!function_exists('alacarte_get_nav_menu')){
    function alacarte_get_nav_menu($args = []){
        $args = wp_parse_args($args, [
            'default' => false, 
            'none'    => false
        ]);
        $menus = array(
            '0' => esc_html__('Primary Menu','alacarte')
        );
        $obj_menus = wp_get_nav_menus();
        if($args['default']) $menus['-1'] = esc_html__('Default','alacarte');
        if($args['none']) $menus['none'] = esc_html__('None','alacarte');

        foreach ($obj_menus as $obj_menu){
            $menus[$obj_menu->slug] = $obj_menu->name;
        }
        return $menus;
    }
}
/**
 * Get list of user by user role for post options
 * 
 * @param $user_role
*/
function alacarte_list_user_by_role_for_opts($args = []){
    $args = wp_parse_args($args, [
        'role'    => 'subcrible',
        'orderby' => 'user_nicename',
        'order'   => 'ASC'
    ]);
    $users = get_users( $args );
    $options = [];
    foreach ( $users as $user ) {
        $options[$user->user_email] = $user->display_name;
    }
    return $options;
}
/**
 * Get RevSlider List 
 * @return array
*/
if(!function_exists('alacarte_get_list_rev_slider')){
    function alacarte_get_list_rev_slider() {
        if (class_exists('RevSlider')) {
            $slider = new RevSlider();
            $arrSliders = $slider->getArrSliders();
            $revsliders = array();
            if ($arrSliders) {
                foreach ($arrSliders as $slider) {
                    /* @var $slider RevSlider */
                    $revsliders[$slider->getAlias()] = $slider->getTitle();
                }
            }
            return $revsliders;
        }
    }
}

/**
 * Get Contact Form 7 List
 * @return array
*/
if(!function_exists('alacarte_get_list_cf7')){
    function alacarte_get_list_cf7($defaule = false) {
        if(!class_exists('WPCF7')) return;
        $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
        $contact_forms = array();
        if($defaule){
            $contact_forms['-1'] = esc_html__('Default From Theme Option','alacarte');
        }

        foreach ( $cf7 as $cform ) {
            $contact_forms[ $cform->post_title ] = $cform->post_title;
        }
        
        return $contact_forms;
    }
}
function alacarte_get_limit_str($str,$start,$limit,$add_tag = '')
{
    $str = trim($str);
    if(strlen($str) <= $limit)
        return $str;
    return substr(wp_strip_all_tags($str),$start,$limit).$add_tag;
}
function alacarte_single_events_gallery(){
    $event_gallery = alacarte_get_post_format_value('event-gallery-images','');
    if(!empty($event_gallery)):
        $images_arr = explode( ',', $event_gallery );
        ?>
        <div class="single-event-gallery red-gal-image">
            <h2><?php echo esc_html__('Event Gallery','alacarte');?></h2>
            <div class="row red-gallery">
                <?php
                foreach ( $images_arr as $i => $image ) {
                    if ( $image > 0 ) {
                        $img = wpb_getImageBySize( array(
                            'attach_id' => $image,
                            'thumb_size' => '500x399',
                            'class' => 'gal-image',
                        ));

                        $thumbnail = $img['thumbnail'];

                        $large_img = wp_get_attachment_image_src($image, 'full');
                        $image_large_src = $large_img[0];
                        ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <div class="gallery-item">
                                <a class="light-box" href="<?php echo esc_url($image_large_src); ?>" >
                                </a>
                                <?php echo wp_kses_post($thumbnail); ?>

                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php
    endif;
}


function alacarte_single_events_footer(){
    ?>
    <div class="single-event-footer ">
        <?php
            echo '<div class="red-social circle bt-colored">';
        alacarte_post_share(array('show_title' => false,'show_tooltip'  =>false, 'social_args' => ['class' => 'size-28 shape-circle outline colored-hover']));
            echo '</div>';
        ?>
    </div>
    <?php
}
