<?php
vc_map(array(
    'name'          => 'Red Instagram',
    'base'          => 'red_instagram',
    'category'      => esc_html__('RedExp', 'alacarte'),
    'description'   => esc_html__('Show your Instagram image', 'alacarte'),
    'icon'         => 'red_el_icon',
    'params'      => array_merge(
        array(
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('User ID','alacarte'),
                'description'   =>'Ex: https://www.instagram.com/zooka.studio/. Get zooka.studio',
                'param_name'    => 'instagram_api_username',
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Access Token','alacarte'),
                'description'   =>'Ex: 7649855718.1677ed0.8af377c900424e75a331caef49a74baf',
                'param_name'    => 'instagram_api_access_key',
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Client ID','alacarte'),
                'description'   =>'Get numbers before dot from Access Token, ex: 7649855718',
                'param_name'    => 'instagram_api_client_id',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Layout','alacarte'),
                'param_name'    => 'el_layout_mode',
                'value'         => array(
                    esc_html__('Default', 'alacarte')       => 'layout-default',
                    esc_html__('Layout 2', 'alacarte')       => 'layout-2',
                ),
                'std'           => 'layout-default'
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Number Image','alacarte'),
                'param_name'    => 'el_number',
                'std'           => '8',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Number Columns','alacarte'),
                'param_name'    => 'el_columns',
                'value'         => array(1,2,3,4,6,12),
                'std'           => '4'
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Columns Space','alacarte'),
                'param_name'    => 'el_columns_space',
                'value'         => array(0,2,5,10,15,20,30),
                'std'           => '2'
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Image Size','alacarte'),
                'param_name'    => 'el_size',
                'value'         => array(
                    esc_html__('Thumbnail (300x300)', 'alacarte')       => 'thumbnail',
                    esc_html__('Large (640x640)', 'alacarte')           => 'large',
                ),
                'std'           => 'thumbnail',
                'description'   => esc_html__('Auto-detect means that the plugin automatically sets the image resolution based on the size of your feed.','alacarte')
            ),
            array(
                'type'          => 'checkbox',
                'heading'       => esc_html__('Show Author','alacarte'),
                'param_name'    => 'el_show_author',
                'std'           => 'true' 
            ),
            array(
                'type'          => 'checkbox',
                'heading'       => esc_html__('Show Text Follow us','alacarte'),
                'param_name'    => 'show_text_follow',
                'std'           => 'false',
                'dependency'    => array(
                    'element'   => 'el_show_author',
                    'value'     => 'true',
                ),
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Author Text','alacarte'),
                'param_name'    => 'el_author_text',
                'value'         => esc_html__('Follow Us Now', 'alacarte'),
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'alacarte'),
                'dependency'    => array(
                    'element'   => 'el_show_author',
                    'value'     => 'true',
                ),
            ),

            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_like',
                'value'         => array(
                    esc_html__('Show like count?','alacarte') => true
                ),
                'std'           => false,
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_comments',
                'value'         => array(
                    esc_html__('Show comment count?','alacarte') => true
                ),
                'std'           => false,
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Open Link in?','alacarte'),
                'param_name'    => 'el_target',
                'value'         => array(
                    esc_html__('Current window', 'alacarte')       => '_self',
                    esc_html__('New Window ', 'alacarte')      => '_blank',
                ),
                'std'           => '_self',
                'dependency'    => array(
                    'element'   => 'el_show_author',
                    'value'     => 'true',
                ),
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Extra Class','alacarte'),
                'param_name'    => 'el_class',
                'value'         => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'alacarte'),
            )
        )
    )
));
class WPBakeryShortCode_red_instagram extends WPBakeryShortCode{
    protected function content($atts, $content = null)
    {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        extract( $atts );
        return parent::content($atts, $content);
    }
    function alacarte_el_instagram($id, $api, $count = 6) {


            $remote = wp_remote_get("https://api.instagram.com/v1/users/".$id."/media/recent/?access_token=".$api."&count=".$count, true);

            if (is_wp_error($remote))
                return new WP_Error('site_down', esc_html__('Unable to communicate with Instagram.', 'alacarte'));

            if ( 200 != wp_remote_retrieve_response_code( $remote ) )
                return new WP_Error('invalid_response', esc_html__('Instagram did not return a 200.', 'alacarte'));

            $insta_array = json_decode($remote['body'], TRUE);

            if (!$insta_array)
                return new WP_Error('bad_json', esc_html__('Instagram has returned invalid data.', 'alacarte'));

            $images = $insta_array['data'];

            $instagram = array();

            foreach ($images as $image) {
                    $image['link']                          = preg_replace( "/^http:/i", "", $image['link'] );
                    $image['images']['thumbnail']           = preg_replace( "/^http:/i", "", $image['images']['thumbnail'] );
                    $image['images']['standard_resolution'] = preg_replace( "/^http:/i", "", $image['images']['standard_resolution'] );
                    $instagram[] = array(
                        /*'description'   => $image['caption']['text'],*/
                        'link'          => $image['link'],
                        'time'          => $image['created_time'],
                        'comments'      => $image['comments']['count'],
                        'likes'         => $image['likes']['count'],
                        'thumbnail'     => $image['images']['thumbnail'],
                        'large'         => $image['images']['standard_resolution'],
                        'type'          => $image['type']
                    );
            }

        return array_slice($instagram, 0, $count);
    }
    function alacarte_instsgram_images_only($media_item) {
        if ($media_item['type'] == 'image')  return true;
        return false;
    }
    function getInstaID($username, $client_id){
        $username = strtolower($username); // sanitization
        $url = "https://api.instagram.com/v1/users/search?q=".$username."&client_id=".$client_id;
        $get = wp_remote_get($url);
        if (is_wp_error($get))
            return new WP_Error('site_down', esc_html__('Unable to communicate with Instagram.', 'alacarte'));

        if ( 200 != wp_remote_retrieve_response_code( $get ) )
            return new WP_Error('invalid_response', esc_html__('Instagram did not return a 200.', 'alacarte'));
        $json = json_decode($get['body']);

        foreach($json->data as $user)
        {
            if($user->username == $username)
            {
                return $user->id;
            }
        }
        return '00000000'; // return this if nothing is found
    }
}