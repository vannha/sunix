<?php
    wp_enqueue_style('animate-css');
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    $username      = $instagram_api_username;
    $id            = $instagram_api_client_id;
    $api           = $instagram_api_access_key;
    $layout        = $el_layout_mode;
    $limit         = $el_number;
    $target  = $el_target;
    $size = $el_size;
    $columns_space = $el_columns_space;

    switch ($el_columns) {
        case 1:
            $span = "col-12";
            break;
        case 2:
            $span = "col-6";
            break;
        case 3:
            $span = "col-4";
            break;
        case 4:
            $span = "col-3";
            break;
        case 6:
            $span = "col-2";
            break;
        case 12:
            $span = "col-1";
            break;
        case 8:
            $span = "col-auto";
            break;
        default:
            $span = "col-4";
    }

    if ($id != '') {
        $media_array = $this->sunix_el_instagram($id, $api, $limit);
        if ( is_wp_error($media_array) ) {
           echo esc_html($media_array->get_error_message());
        } else {
            // filter for images only?
            if ( $images_only = apply_filters( 'sunix_instagram_images_only', FALSE ) )
                $media_array = array_filter( $media_array, array( $this, 'sunix_instsgram_images_only' ) );

            ?>
            <div class="<?php echo trim(implode(' ', array('red-instagram', $layout, $el_class))); ?>">
                <div class="row gutters-<?php echo esc_attr($columns_space);?> clearfix">
                <?php foreach ($media_array as $item) { ?>

                    <div class="<?php echo trim(implode(' ', array('instagram-item', $span, 'overlay-wrap')));?>">
                        <div class="img-wrap">
                            <a href="<?php echo esc_url( $item['link'] ); ?>" target="<?php echo esc_attr( $target );?>">
                                <img src="<?php echo esc_url($item[$size]['url']);?>" alt="<?php echo esc_attr(get_option('blogname'));?>" />
                            </a>
                            <div class="overlay">
                                <a href="<?php echo esc_url( $item['link'] ); ?>" target="<?php echo esc_attr( $target );?>">
                                    <i class="flaticon-instagram"></i>
                                </a>
                                <div class="overlay-inner col-12 text-center">
                                    <?php if( $show_like):?><a class="like" href="<?php echo esc_url( $item['link'] );?>" target="<?php echo esc_attr( $target );?>"><span class="fa fa-heart-o"></span>&nbsp;<?php echo esc_html($item['likes']);?></a><?php endif; ?>
                                    <?php if( $show_comments):?><a class="comments" href="<?php echo esc_url( $item['link'] );?>" target="<?php echo esc_attr( $target ) ;?>"><span class="fa fa-comment-dots"></span>&nbsp;<?php echo esc_html($item['comments']);?></a><?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php } ?>
                </div>
                <?php  if ($el_show_author) {
                    ?><div class="user">
                    <a href="//instagram.com/<?php echo trim($username); ?>" target="<?php echo esc_attr( $target ); ?>"> <?php if($show_text_follow) echo esc_html__('Follow us ','sunix');?> <?php if(!empty($el_author_text)) echo '<span class="author-text">'.esc_html($el_author_text).'</span>'; ?> </span></a></div><?php
                } ?>
            </div>
            <?php
        }
    }