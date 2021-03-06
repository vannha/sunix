<?php
vc_map(array(
    'name'        => 'sunix Google Maps',
    'base'        => 'red_googlemap',
    'icon'        => 'icon-wpb-map-pin',
    'category'    => esc_html__('RedExp', 'sunix'),
    'description' => esc_html__('Add Google Maps', 'sunix'),
    'params'      => array(
        array(
            'type'        => 'heading',
            'heading'     => esc_html__('API Key', 'sunix'),
            'param_name'  => 'api_hidden',
            'description' => sprintf( __( '<a href="%s" target="_blank">Click Here</a> then enter your Google Map API key to get your map show right away', 'sunix' ), site_url('/').'wp-admin/admin.php?page=theme-options#19_section_group_li_a' ),
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Address', 'sunix'),
            'param_name'  => 'address',
            'value'       => '81 Thomas Street, New York, NY',
            'description' => esc_html__('Enter address of Map', 'sunix'),
            'admin_label' => true
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Coordinate', 'sunix'),
            'param_name'  => 'coordinate',
            'value'       => '41.082606,-73.469718',
            'description' => esc_html__('Enter coordinate of Map, format input (latitude, longitude)', 'sunix')
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Marker Coordinate', 'sunix'),
            'param_name'  => 'markercoordinate',
            'value'       => '',
            'std'         => '',
            'description' => esc_html__('Enter marker coordinate of Map, format input (latitude, longitude)', 'sunix'),
            'group'       => esc_html__('Marker','sunix')
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Marker Title', 'sunix'),
            'param_name'  => 'markertitle',
            'value'       => '',
            'std'         => '',
            'description' => esc_html__('Enter Title Info windows for marker', 'sunix'),
            'group'       => esc_html__('Marker','sunix')
        ),
        array(
            'type'        => 'textarea',
            'heading'     => esc_html__('Marker Description', 'sunix'),
            'param_name'  => 'markerdesc',
            'value'       => '',
            'std'         => '',
            'description' => esc_html__('Enter Description Info windows for marker', 'sunix'),
            'group'       => esc_html__('Marker','sunix')
        ),
        array(
            'type'        => 'attach_image',
            'heading'     => esc_html__('Marker Icon', 'sunix'),
            'param_name'  => 'markericon',
            'std'         => '',
            'description' => esc_html__('Select image icon for marker', 'sunix'),
            'group'       => esc_html__('Marker','sunix')
        ),
        array(
            'type'       => 'textarea_raw_html',
            'heading'    => esc_html__('Marker List', 'sunix'),
            'param_name' => 'markerlist',
            'value'      => '',
            'std'        => '',
            'description' => esc_html__('
                [{"coordinate":"41.058846,-73.539423","icon":"ICON_PATH","title":"YOUR_TITLE_HERE","desc":"YOUR_DESCRIPTION"},
                {"coordinate":"40.975699,-73.717636","icon":"ICON_PATH","title":"YOUR_TITLE_HERE","desc":"YOUR_DESCRIPTION"},
                {"coordinate":"41.082606,-73.469718","icon":"ICON_PATH","title":"YOUR_TITLE_HERE","desc":"YOUR_DESCRIPTION"}]
                ', 
                'sunix'
            ),
            'group'       => esc_html__('Marker','sunix')
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'infoclick',
            'value'      => array(
                esc_html__('Click to show info', 'sunix') => 1
            ),
            "description" => esc_html__('Click on marker to show info window (Default Show).', 'sunix' ),
            'std'         => 0,
            'group'       => esc_html__('Marker','sunix')
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Info Window Max Width', 'sunix'),
            'param_name'  => 'infowidth',
            'value'       => '200',
            'std'         => '200',
            'description' => esc_html__('Set max width for info window', 'sunix'),
            'group'       => esc_html__('Marker','sunix')
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Map Type', 'sunix'),
            'param_name' => 'type',
            'value'      => array(
                'ROADMAP'   => 'ROADMAP',
                'HYBRID'    => 'HYBRID',
                'SATELLITE' => 'SATELLITE',
                'TERRAIN'   => 'TERRAIN'
            ),
            'std'         =>  'ROADMAP',
            'description' => esc_html__('Select the map type.', 'sunix'),
            'group'       => esc_html__('Map Style','sunix')
        ),
        array(
            'type'       => 'dropdown',
            'heading'    => esc_html__('Style Template', 'sunix'),
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
            'description' => esc_html__('Select your heading size for title.','sunix'),
            'group'       => esc_html__('Map Style','sunix')
        ),
        array(
            'type'        => 'textarea_raw_html',
            'heading'     => esc_html__('Custom Template', 'sunix'),
            'param_name'  => 'content',
            'value'       => '',
            'description' => sprintf( __( 'Easy to <a href="%s" target="_blank">Get Your Template Here</a>', 'sunix' ), 'http://snazzymaps.com' ),
            'dependency'    => array(
              'element'   => 'style',
              'value'     => 'custom',
            ),
            'group'       => esc_html__('Map Style','sunix')
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Zoom', 'sunix'),
            'param_name'  => 'zoom',
            'value'       => '16',
            'description' => esc_html__('zoom level of map', 'sunix'),
            'group'       => esc_html__('Map Style','sunix')
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Width', 'sunix'),
            'param_name'  => 'width',
            'value'       => 'auto',
            'description' => esc_html__('Width of map without pixel, default is auto', 'sunix'),
            'group'       => esc_html__('Map Style','sunix')
        ),
        array(
            'type'        => 'textfield',
            'heading'     => esc_html__('Height', 'sunix'),
            'param_name'  => 'height',
            'value'       => '300px',
            'std'         => '300px',
            'description' => esc_html__('Height of map without pixel, default is 350px', 'sunix'),
            'group'       => esc_html__('Map Style','sunix'),
            'admin_label' => true
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'scrollwheel',
            'value'      => array(
                esc_html__('Scroll Wheel', 'sunix') => 1
            ),
            'std'         =>  0,
            'description' => esc_html__('If checked, show scrollwheel zooming on the map.', 'sunix')
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'pancontrol',
            'value'      => array(
                esc_html__('Pan Control', 'sunix') => 1
            ),
            'std'         =>  0,
            'description' => esc_html__('Show or hide Pan control.', 'sunix')
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'zoomcontrol',
            'value'      => array(
                esc_html__('Zoom Control', 'sunix') => 1
            ),
            'std'         =>  0,
            'description' => esc_html__('Show or hide Zoom Control.', 'sunix')
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'scalecontrol',
            'value'      => array(
                esc_html__('Scale Control', 'sunix') => 1
            ),
            'std'         =>  0,
            'description' => esc_html__('Show or hide Scale Control.', 'sunix')
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'maptypecontrol',
            'value'      => array(
                esc_html__('Map Type Control', 'sunix') => 1
            ),
            'std'         =>  0,
            'description' => esc_html__('Show or hide Map Type Control.', 'sunix')
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'streetviewcontrol',
            'value'      => array(
                esc_html__('Street View Control', 'sunix') => 1
            ),
            'std'         => 0,
            'description' => esc_html__('Show or hide Street View Control.', 'sunix')
        ),
        array(
            'type'       => 'checkbox',
            'param_name' => 'overviewmapcontrol',
            'value'      => array(
                esc_html__('Over View Map Control', 'sunix') => 1
            ),
            'std'         =>  0,
            'description' => esc_html__('Show or hide Over View Map Control.', 'sunix')
        ),
        array(
            'type'       => 'textarea_safe',
            'param_name' => 'default_map',
            'value'      => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3007.5971361187576!2d-73.4679436843303!3d41.07779797929389!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDHCsDA0JzQwLjEiTiA3M8KwMjcnNTYuNyJX!5e0!3m2!1sen!2s!4v1556958138646!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>',
            'std'        => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3007.5971361187576!2d-73.4679436843303!3d41.07779797929389!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDHCsDA0JzQwLjEiTiA3M8KwMjcnNTYuNyJX!5e0!3m2!1sen!2s!4v1556958138646!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>',
            'description' => esc_html__('This map only show when you not enter your Google Map API key in theme options', 'sunix'),
            'group'       => esc_html__('Default Maps','sunix')
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