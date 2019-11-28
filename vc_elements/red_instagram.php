<?php
vc_map(array(
    'name'          => 'Red Instagram',
    'base'          => 'red_instagram',
    'category'      => esc_html__('RedExp', 'sunix'),
    'description'   => esc_html__('Show your Instagram image', 'sunix'),
    'icon'         => 'red_el_icon',
    'params'      => array_merge(
        array(
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('User ID','sunix'),
                'description'   =>'Ex: https://www.instagram.com/zooka.studio/. Get zooka.studio',
                'param_name'    => 'instagram_api_username',
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Access Token','sunix'),
                'description'   =>'Ex: 7649855718.1677ed0.8af377c900424e75a331caef49a74baf',
                'param_name'    => 'instagram_api_access_key',
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Client ID','sunix'),
                'description'   =>'Get numbers before dot from Access Token, ex: 7649855718',
                'param_name'    => 'instagram_api_client_id',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Layout','sunix'),
                'param_name'    => 'el_layout_mode',
                'value'         => array(
                    esc_html__('Default', 'sunix')       => 'layout-default',
                    esc_html__('Layout 2', 'sunix')       => 'layout-2',
                ),
                'std'           => 'layout-default'
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Number Image','sunix'),
                'param_name'    => 'el_number',
                'std'           => '8',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Number Columns','sunix'),
                'param_name'    => 'el_columns',
                'value'         => array(1,2,3,4,6,12),
                'std'           => '4'
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Columns Space','sunix'),
                'param_name'    => 'el_columns_space',
                'value'         => array(0,2,5,10,15,20,30),
                'std'           => '2'
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Image Size','sunix'),
                'param_name'    => 'el_size',
                'value'         => array(
                    esc_html__('Thumbnail (300x300)', 'sunix')       => 'thumbnail',
                    esc_html__('Large (640x640)', 'sunix')           => 'large',
                ),
                'std'           => 'thumbnail',
                'description'   => esc_html__('Auto-detect means that the plugin automatically sets the image resolution based on the size of your feed.','sunix')
            ),
            array(
                'type'          => 'checkbox',
                'heading'       => esc_html__('Show Author','sunix'),
                'param_name'    => 'el_show_author',
                'std'           => 'true' 
            ),
            array(
                'type'          => 'checkbox',
                'heading'       => esc_html__('Show Text Follow us','sunix'),
                'param_name'    => 'show_text_follow',
                'std'           => 'false',
                'dependency'    => array(
                    'element'   => 'el_show_author',
                    'value'     => 'true',
                ),
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Author Text','sunix'),
                'param_name'    => 'el_author_text',
                'value'         => esc_html__('Follow Us Now', 'sunix'),
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'sunix'),
                'dependency'    => array(
                    'element'   => 'el_show_author',
                    'value'     => 'true',
                ),
            ),

            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_like',
                'value'         => array(
                    esc_html__('Show like count?','sunix') => true
                ),
                'std'           => false,
            ),
            array(
                'type'          => 'checkbox',
                'param_name'    => 'show_comments',
                'value'         => array(
                    esc_html__('Show comment count?','sunix') => true
                ),
                'std'           => false,
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__('Open Link in?','sunix'),
                'param_name'    => 'el_target',
                'value'         => array(
                    esc_html__('Current window', 'sunix')       => '_self',
                    esc_html__('New Window ', 'sunix')      => '_blank',
                ),
                'std'           => '_self',
                'dependency'    => array(
                    'element'   => 'el_show_author',
                    'value'     => 'true',
                ),
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__('Extra Class','sunix'),
                'param_name'    => 'el_class',
                'value'         => '',
                'description' => esc_html__('Style particular content element differently - add a class name and refer to it in custom CSS.', 'sunix'),
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
    function sunix_el_instagram($id, $api, $count = 6) {


            $remote = wp_remote_get("https://api.instagram.com/v1/users/".$id."/media/recent/?access_token=".$api."&count=".$count, true);

            if (is_wp_error($remote))
                return new WP_Error('site_down', esc_html__('Unable to communicate with Instagram.', 'sunix'));

            if ( 200 != wp_remote_retrieve_response_code( $remote ) )
                return new WP_Error('invalid_response', esc_html__('Instagram did not return a 200.', 'sunix'));

            $insta_array = json_decode($remote['body'], TRUE);

            if (!$insta_array)
                return new WP_Error('bad_json', esc_html__('Instagram has returned invalid data.', 'sunix'));

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
    function sunix_instsgram_images_only($media_item) {
        if ($media_item['type'] == 'image')  return true;
        return false;
    }
    function getInstaID($username, $client_id){
        $username = strtolower($username); // sanitization
        $url = "https://api.instagram.com/v1/users/search?q=".$username."&client_id=".$client_id;
        $get = wp_remote_get($url);
        if (is_wp_error($get))
            return new WP_Error('site_down', esc_html__('Unable to communicate with Instagram.', 'sunix'));

        if ( 200 != wp_remote_retrieve_response_code( $get ) )
            return new WP_Error('invalid_response', esc_html__('Instagram did not return a 200.', 'sunix'));
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