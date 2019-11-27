<?php
add_action( 'tgmpa_register', 'alacarte_required_redux_plugins' );
function alacarte_required_redux_plugins() {
    $config = array(
        'default_path' => 'http://spyropress.com/plugins/',
        'is_automatic' => true
    );
    $plugins = array(
        array(
            'name'               => esc_html__('Redux Framework','alacarte'),
            'slug'               => 'redux-framework',
            'required'           => true,
        ),
    );
    tgmpa( $plugins, $config );
}
if(class_exists('ReduxFrameworkPlugin')){
    add_action( 'tgmpa_register', 'alacarte_required_theme_plugins' );
    function alacarte_required_theme_plugins() {
        $config = array(
            'default_path' => 'http://spyropress.com/plugins/'
        );
        $plugins = array(
            array(
                'name'               => esc_html__('Redux Framework','alacarte'),
                'slug'               => 'redux-framework',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('EF5 Systems','alacarte'),
                'slug'               => 'red-systems',
                'source'             => 'alacarte/ef5-systems.zip',
                'required'           => true,
            ),

            array(
                'name'               => esc_html__('Visual Composer','alacarte'),
                'slug'               => 'js_composer',
                'source'             => 'js_composer.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('Revolution Slider','alacarte'),
                'slug'               => 'revslider',
                'source'             => 'revslider.zip',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('Contact Form 7','alacarte'),
                'slug'               => 'contact-form-7',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('NewsLetter','alacarte'),
                'slug'               => 'newsletter',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('WooCommerce','alacarte'),
                'slug'               => 'woocommerce',
                'required'           => false,
            ),

            array(
                'name'               => esc_html__('WP User Avatars','alacarte'),
                'slug'               => 'wp-user-avatars',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('Flex Reservation', 'alacarte'),
                'slug'               => 'flex-reservations',
                'source'             => 'alacarte/flex-reservations.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('Flex Restaurant', 'alacarte'),
                'slug'               => 'flex-restaurants',
                'source'             => 'alacarte/flex-restaurants.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('Revolution Slider','alacarte'),
                'slug'               => 'revslider',
                'source'             => 'revslider.zip',
                'required'           => true,
            ),
        );
        tgmpa( $plugins, $config );
    }
}