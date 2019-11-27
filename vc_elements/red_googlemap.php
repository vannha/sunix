<?php
vc_map(array(
    'name'        => 'AlaCarte Google Maps',
    'base'        => 'red_googlemap',
    'icon'        => 'icon-wpb-map-pin',
    'category'    => esc_html__('RedExp', 'alacarte'),
    'description' => esc_html__('Add Google Maps', 'alacarte'),
    'params'      => array(
        array(
            'type'        => 'heading',
            'heading'     => esc_html__('API Key', 'alacarte'),
            'param_name'  => 'api_hidden',
            'description' => sprintf( __( '<a href="%s" target="_blank">Click Here</a> then enter your Google Map API key to get your map show right away', 'alacarte' ), site_url('/').'wp-admin/admin.php?page=theme-options#19_section_group_li_a' ),
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Address', 'alacarte'),
            'param_name'  => 'address',
            'value'       => '81 Thomas Street, New York, NY',
            'description' => esc_html__('Enter address of Map', 'alacarte'),
            'admin_label' => true
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Coordinate', 'alacarte'),
            'param_name'  => 'coordinate',
            'value'       => '41.082606,-73.469718',
            'description' => esc_html__('Enter coordinate of Map, format input (latitude, longitude)', 'alacarte')
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Marker Coordinate', 'alacarte'),
            'param_name'  => 'markercoordinate',
            'value'       => '',
            'std'         => '',
            'description' => esc_html__('Enter marker coordinate of Map, format input (latitude, longitude)', 'alacarte'),
            'group'       => esc_html__('Marker','alacarte')
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Marker Title', 'alacarte'),
            'param_name'  => 'markertitle',
            'value'       => '',
            'std'         => '',
            'description' => esc_html__('Enter Title Info windows for marker', 'alacarte'),
            'group'       => esc_html__('Marker','alacarte')
        ),
        array(
            'type'        => 'textarea',
            'heading'     => esc_html__('Marker Description', 'alacarte'),
            'param_name'  => 'markerdesc',
            'value'       => '',
            'std'         => '',
            'description' => esc_html__('Enter Description Info windows for marker', 'alacarte'),
            'group'       => esc_html__('Marker','alacarte')
        ),
        array(
            'type'        => 'attach_image',
            'heading'     => esc_html__('Marker Icon', 'alacarte'),
            'param_name'  => 'markericon',
            'std'         => '',
            'description' => esc_html__('Select image icon for marker', 'alacarte'),
            'group'       => esc_html__('Marker','alacarte')
        ),
        array(
            'type'       => 'textarea_raw_html',
            'heading'    => esc_html__('Marker List', 'alacarte'),
            'param_name' => 'markerlist',
            'value'      => '',
            'std'        => '',
            'description' => esc_html__('
                [{"coordinate":"41.058846,-73.539423","icon":"ICON_PATH","title":"YOUR_TITLE_HERE","desc":"YOUR_DESCRIPTION"},
                {"coordinate":"40.975699,-73.717636","icon":"ICON_PATH","title":"YOUR_TITLE_HERE","desc":"YOUR_DESCRIPTION"},
                {"coordinate":"41.082606,-73.469718","icon":"ICON_PATH","title":"YOUR_TITLE_HERE","desc":"YOUR_DESCRIPTION"}]
                ', 
                'alacarte'
            ),
            'group'       => esc_html__('Marker','alacarte')
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'infoclick',
            'value'      => array(
                esc_html__('Click to show info', 'alacarte') => 1
            ),
            "description" => esc_html__('Click on marker to show info window (Default Show).', 'alacarte' ),
            'std'         => 0,
            'group'       => esc_html__('Marker','alacarte')
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Info Window Max Width', 'alacarte'),
            'param_name'  => 'infowidth',
            'value'       => '200',
            'std'         => '200',
            'description' => esc_html__('Set max width for info window', 'alacarte'),
            'group'       => esc_html__('Marker','alacarte')
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Map Type', 'alacarte'),
            'param_name' => 'type',
            'value'      => array(
                'ROADMAP'   => 'ROADMAP',
                'HYBRID'    => 'HYBRID',
                'SATELLITE' => 'SATELLITE',
                'TERRAIN'   => 'TERRAIN'
            ),
            'std'         =>  'ROADMAP',
            'description' => esc_html__('Select the map type.', 'alacarte'),
            'group'       => esc_html__('Map Style','alacarte')
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Style Template', 'alacarte'),
            'param_name' => 'style',
            'value'      => array(
                'Default'            => '',
                'Light Monochrome'   => 'light-monochrome',
                'Blue water'         => 'blue-water',
                'Midnight Commander' => 'midnight-commander',
                'Paper'              => 'paper',
                'Red Hues'           => 'red-hues',
                'Hot Pink'           => 'hot-pink',
                'Custom'             => 'custom'
            ),
            'description' => esc_html__('Select your heading size for title.','alacarte'),
            'group'       => esc_html__('Map Style','alacarte')
        ),
        array(
            'type'        => 'textarea_raw_html',
            'heading'     => esc_html__('Custom Template', 'alacarte'),
            'param_name'  => 'content',
            'value'       => '',
            'description' => sprintf( __( 'Easy to <a href="%s" target="_blank">Get Your Template Here</a>', 'alacarte' ), 'http://snazzymaps.com' ),
            'dependency'    => array(
              'element'   => 'style',
              'value'     => 'custom',
            ),
            'group'       => esc_html__('Map Style','alacarte')
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Zoom', 'alacarte'),
            'param_name'  => 'zoom',
            'value'       => '16',
            'description' => esc_html__('zoom level of map', 'alacarte'),
            'group'       => esc_html__('Map Style','alacarte')
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Width', 'alacarte'),
            'param_name'  => 'width',
            'value'       => 'auto',
            'description' => esc_html__('Width of map without pixel, default is auto', 'alacarte'),
            'group'       => esc_html__('Map Style','alacarte')
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Height', 'alacarte'),
            'param_name'  => 'height',
            'value'       => '300px',
            'std'         => '300px',
            'description' => esc_html__('Height of map without pixel, default is 350px', 'alacarte'),
            'group'       => esc_html__('Map Style','alacarte'),
            'admin_label' => true
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'scrollwheel',
            'value'      => array(
                esc_html__('Scroll Wheel', 'alacarte') => 1
            ),
            'std'         =>  0,
            'description' => esc_html__('If checked, show scrollwheel zooming on the map.', 'alacarte')
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'pancontrol',
            'value'      => array(
                esc_html__('Pan Control', 'alacarte') => 1
            ),
            'std'         =>  0,
            'description' => esc_html__('Show or hide Pan control.', 'alacarte')
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'zoomcontrol',
            'value'      => array(
                esc_html__('Zoom Control', 'alacarte') => 1
            ),
            'std'         =>  0,
            'description' => esc_html__('Show or hide Zoom Control.', 'alacarte')
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'scalecontrol',
            'value'      => array(
                esc_html__('Scale Control', 'alacarte') => 1
            ),
            'std'         =>  0,
            'description' => esc_html__('Show or hide Scale Control.', 'alacarte')
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'maptypecontrol',
            'value'      => array(
                esc_html__('Map Type Control', 'alacarte') => 1
            ),
            'std'         =>  0,
            'description' => esc_html__('Show or hide Map Type Control.', 'alacarte')
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'streetviewcontrol',
            'value'      => array(
                esc_html__('Street View Control', 'alacarte') => 1
            ),
            'std'         => 0,
            'description' => esc_html__('Show or hide Street View Control.', 'alacarte')
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'overviewmapcontrol',
            'value'      => array(
                esc_html__('Over View Map Control', 'alacarte') => 1
            ),
            'std'         =>  0,
            'description' => esc_html__('Show or hide Over View Map Control.', 'alacarte')
        ),
        array(
            'type'       => 'textarea_safe',
            'param_name' => 'default_map',
            'value'      => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3007.5971361187576!2d-73.4679436843303!3d41.07779797929389!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDHCsDA0JzQwLjEiTiA3M8KwMjcnNTYuNyJX!5e0!3m2!1sen!2s!4v1556958138646!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>',
            'std'        => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3007.5971361187576!2d-73.4679436843303!3d41.07779797929389!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDHCsDA0JzQwLjEiTiA3M8KwMjcnNTYuNyJX!5e0!3m2!1sen!2s!4v1556958138646!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>',
            'description' => esc_html__('This map only show when you not enter your Google Map API key in theme options', 'alacarte'),
            'group'       => esc_html__('Default Maps','alacarte')
        )
    )
));

class WPBakeryShortCode_red_googlemap extends WPBakeryShortCode
{

    protected function content($atts, $content = null)
    {
        wp_enqueue_script('red-googlemap');
        return parent::content($atts, $content);
    }
}