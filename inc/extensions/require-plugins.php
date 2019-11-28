<?php
add_action( 'tgmpa_register', 'sunix_required_redux_plugins' );
function sunix_required_redux_plugins() {
    $config = array(
        'default_path' => 'http://spyropress.com/plugins/',
        'is_automatic' => true
    );
    $plugins = array(
        array(
            'name'               => esc_html__('Redux Framework','sunix'),
            'slug'               => 'redux-framework',
            'required'           => true,
        ),
    );
    tgmpa( $plugins, $config );
}
if(class_exists('ReduxFrameworkPlugin')){
    add_action( 'tgmpa_register', 'sunix_required_theme_plugins' );
    function sunix_required_theme_plugins() {
        $config = array(
            'default_path' => 'http://spyropress.com/plugins/'
        );
        $plugins = array(
            array(
                'name'               => esc_html__('Redux Framework','sunix'),
                'slug'               => 'redux-framework',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('EF5 Systems','sunix'),
                'slug'               => 'red-systems',
                'source'             => 'sunix/ef5-systems.zip',
                'required'           => true,
            ),

            array(
                'name'               => esc_html__('Visual Composer','sunix'),
                'slug'               => 'js_composer',
                'source'             => 'js_composer.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('Revolution Slider','sunix'),
                'slug'               => 'revslider',
                'source'             => 'revslider.zip',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('Contact Form 7','sunix'),
                'slug'               => 'contact-form-7',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('NewsLetter','sunix'),
                'slug'               => 'newsletter',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('WooCommerce','sunix'),
                'slug'               => 'woocommerce',
                'required'           => false,
            ),

            array(
                'name'               => esc_html__('WP User Avatars','sunix'),
                'slug'               => 'wp-user-avatars',
                'required'           => false,
            ),
            array(
                'name'               => esc_html__('Flex Reservation', 'sunix'),
                'slug'               => 'flex-reservations',
                'source'             => 'sunix/flex-reservations.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('Flex Restaurant', 'sunix'),
                'slug'               => 'flex-restaurants',
                'source'             => 'sunix/flex-restaurants.zip',
                'required'           => true,
            ),
            array(
                'name'               => esc_html__('Revolution Slider','sunix'),
                'slug'               => 'revslider',
                'source'             => 'revslider.zip',
                'required'           => true,
            ),
        );
        tgmpa( $plugins, $config );
    }
}