<?php
/*! http://keith-wood.name/countdown.html
 * Countdown for jQuery v2.1.0.
 * Written by Keith Wood (wood.keith{at}optusnet.com.au) January 2008.
 * Available under the MIT (http://keith-wood.name/licence.html) license. 
*/
vc_map(array(
    'name'        => 'Red CountDown',
    'base'        => 'red_countdown',
    'icon'        => '',
    'category'    => esc_html__('RedExp', 'sunix'),
    'description' => esc_html__('Choose your time remaining', 'sunix'),
    'params'      => array(
        array(
            'type'       => 'img',
            'heading'    => esc_html__('Layout Mode','sunix'),
            'param_name' => 'layout_template',
            'value'      =>  array(
                '1' => get_template_directory_uri().'/vc_extends/layouts/countdown/layout-1.jpg',
                '2' => get_template_directory_uri().'/vc_extends/layouts/countdown/layout-2.jpg',
            ),
            'std'        => '1',
            'admin_label' => true
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'color',
            'heading'     => esc_html__( 'Color', 'sunix' ),
            'value'       => array_merge(
                array(
                    esc_html__('Default','sunix')      => '',
                    esc_html__('Accent Color','sunix') => 'accent',
                    esc_html__('White','sunix')        => 'white'
                )
            ),
            'std'         => '',
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'size',
            'heading'     => esc_html__( 'Size', 'sunix' ),
            'value'       => array(
                esc_html__('Default','sunix') => ''
            ),
            'std' => ''
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'shape',
            'heading'     => esc_html__( 'Shape', 'sunix' ),
            'value'       => array(
                esc_html__( 'Default', 'sunix' )         => '',
            ),
            'std' => ''
        ),
        array(
            'type'        => 'ef5_datetime', 
            'param_name'  => 'time',
            'value'       => '',
            'heading'     => esc_html__( 'Target Time For Countdown', 'sunix' ),
            'description' => esc_html__( 'Choose your time remaining. Date and time format (yyyy/mm/dd hh:mm:ss). Default will is next : 2 week 0 days 8 hours 32 minutes 50 seconds', 'sunix' ),
            'holder'      => 'div',
            'group'       => esc_html__('Timer','sunix')
        ),
        array(
            'type'        => 'textfield',
            'param_name'  => 'time_label',
            'value'       => 'Years, Month, Week, Days, Hours, Minutes, Secons',
            'heading'     => esc_html__( 'Lable Time For Countdown', 'sunix' ),
            'description' => esc_html__( 'Enter your time for label. Separated by Comma \',\'! IMPORTANT: You need fill all label value for: Year, Month, Week, Day, Hour, Minute, Second', 'sunix' ),
            'group'       => esc_html__('Timer','sunix')
        ),
        array(
            'type'        => 'dropdown',
            'param_name'  => 'time_format',
            'value'       => array(
                'Years, Month, Week, Days, Hours, Minute, Second' => '1',
                'Month, Week, Days, Hours, Minute, Second'        => '2',
                'Month, Days, Hours, Minute, Second'              => '3',
                'Week, Days, Hours, Minute, Second'               => '4',
                'Days, Hours, Minute, Second'                     => '5',
                'Hours, Minute, Second'                           => '6',
            ),
            'std'         => '5',
            'heading'     => esc_html__( 'Format Time For Countdown', 'sunix' ),
            'description' => esc_html__( 'Choose time format you want!', 'sunix' ),
            'group'       => esc_html__('Timer','sunix')
        )
    )
));

class WPBakeryShortCode_red_countdown extends WPBakeryShortCode
{
    protected function content($atts, $content = null)
    {
    	wp_enqueue_script('countdown');
    	wp_enqueue_script('countdown-theme');
        return parent::content($atts, $content);
    }
}