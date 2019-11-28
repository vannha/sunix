<?php
// Enable Instagram Widget
if(!function_exists('enable_instagram_widget')){
    add_filter('enable_instagram_widget', 'sunix_instagram');
    function sunix_instagram(){
        return true;
    }
}
// Update Instagrame username from theme options to widget
if(!function_exists('sunix_instagram_api_username')){
    add_filter('ef5_instagram_api_username', 'sunix_instagram_api_username');
    function sunix_instagram_api_username(){
        return sunix_get_opts('instagram_api_username','thuylinh3112507');
    }
}
// Custom layout 
if(!function_exists('sunix_instagram_custom_layout')){

    function sunix_instagram_custom_layout(){
        return [
            '1' => esc_html__('Layout 1','sunix'),
            '2' => esc_html__('Layout 2','sunix'),
            '3' => esc_html__('Layout 3','sunix'),
        ];
    }
}
// Output HTML 
if(!function_exists('sunix_instagram_html_output')){
    add_filter('ef5systems_instagram_output_html','sunix_instagram_html_output', 10, 11);
    function sunix_instagram_html_output($layout_mode, $span, $columns_space, $media_array, $size, $target, $show_like, $show_cmt, $show_author, $author_text, $username){
        switch ($layout_mode) {
            default:
                echo '<div class="red-instagram layout'.$layout_mode.'">';
                    ?>
                    <div class="row grid-gutters-<?php echo esc_attr($columns_space);?> clearfix">
                    <?php
                    foreach ($media_array as $item) {
                    ?>
                        <div class="<?php echo trim(implode(' ', array('instagram-item', $span, 'overlay-wrap')));?>">
                            <a sunix"<?php echo esc_url( $item['link'] ); ?>" target="<?php echo esc_attr( $target );?>">
                                <img src="<?php echo esc_url($item[$size]);?>" alt="<?php echo esc_attr(get_bloginfo('name'));?>" />
                            </a>
                            <div class="overlay d-flex align-items-center animated" data-animation-in="zoomIn" data-animation-out="zoomOut">
                                <div class="overlay-inner col-12 text-center">
                                    <a class="d-block" href="<?php echo esc_url( $item['link'] );?>" target="<?php echo esc_attr( $target );?>"><span class="fa fa-instagram"></span></a>
                                    <?php if( $show_like):?><a class="like" href="<?php echo esc_url( $item['link'] );?>" target="<?php echo esc_attr( $target );?>"><span class="fa fa-heart-o"></span>&nbsp;<?php echo esc_html($item['likes']);?></a><?php endif; ?>
                                    <?php if( $show_cmt):?><a class="comments" href="<?php echo esc_url( $item['link'] );?>" target="<?php echo esc_attr( $target ) ;?>"><span class="fa fa-comments-o"></span>&nbsp;<?php echo esc_html($item['comments']);?></a><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    </div>
                    <?php

                if ($show_author) {
                    ?><div class="user">
                        <a href="//instagram.com/<?php echo trim($username); ?>" target="<?php echo esc_attr( $target ); ?>"><?php if(!empty($author_text)) echo '<span class="author-text">'.esc_html($author_text).'</span>'; ?> <span class="author-name">@<?php echo trim($username); ?></span></a></div><?php
                }
                echo '</div>';
                break;
        }
    }
}