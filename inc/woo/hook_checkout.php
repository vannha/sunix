<?php
/**
 * WooCommerce Template Hooks
 *
 * Action/filter hooks used for WooCommerce functions/templates.
 *
 * @author      Red Team
 * @category    Core
 * @package     WooCommerce/Templates
 * @version     3.x
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Remove field label
 * add_filter( 'woocommerce_form_field_args' , 'syring_override_woocommerce_form_field' );
 */
add_filter( 'woocommerce_form_field_args' , 'syring_override_woocommerce_form_field' );
function syring_override_woocommerce_form_field($args)
{
    $args['label'] = false;
    return $args;
}

add_action('woocommerce_before_checkout_form','syring_wc_before_checkout_form');
function syring_wc_before_checkout_form(){
    echo '<div class="checkout-heading">';
    echo '<h3 class="checkout-heading-title">'.esc_html__( 'Cart Checkout','sunix' ).'</h3>';
    echo '<span class="silent-heading"><a href="'.esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ).'">'.esc_html__( 'Return to shoping cart','sunix' ).'</a></span>';
    echo '</div>';
}

/* Overide checkout field */
add_filter( 'woocommerce_checkout_fields' , 'syring_override_checkout_fields' );
function syring_override_checkout_fields( $fields ) {
    $fields['billing']['billing_first_name']['placeholder'] = esc_html__('First Name *','sunix');
    $fields['billing']['billing_last_name']['placeholder'] = esc_html__('Last Name *','sunix');
    $fields['billing']['billing_company']['placeholder'] = esc_html__('Company Name','sunix');
    $fields['billing']['billing_email']['placeholder'] = esc_html__('Email Address *','sunix');
    $fields['billing']['billing_phone']['placeholder'] = esc_html__('Phone *','sunix');
    $fields['billing']['billing_city']['placeholder'] = esc_html__('Town / City *','sunix');
    $fields['billing']['billing_postcode']['placeholder'] = esc_html__('Postcode *','sunix');
    $fields['billing']['billing_state']['placeholder'] = esc_html__('State *','sunix');
    $fields['billing']['billing_country']['placeholder'] = esc_html__('Country *','sunix');

    $fields['shipping']['shipping_first_name']['placeholder'] = esc_html__('First Name *','sunix');
    $fields['shipping']['shipping_last_name']['placeholder'] = esc_html__('Last Name *','sunix');
    $fields['shipping']['shipping_company']['placeholder'] = esc_html__('Company Name','sunix');
    $fields['shipping']['shipping_city']['placeholder'] = esc_html__('Town / City *','sunix');
    $fields['shipping']['shipping_postcode']['placeholder'] = esc_html__('Postcode *','sunix');
    $fields['shipping']['shipping_state']['placeholder'] = esc_html__('State *','sunix');
    $fields['shipping']['shipping_country']['placeholder'] = esc_html__('Country *','sunix');

    $fields['order']['order_comments']['placeholder'] = esc_html__('Order Notes','sunix');


return $fields;
}

/**
 * Reordering Checkout form field
 */
add_filter("woocommerce_default_address_fields", "syring_woocommerce_default_address_fields");
if(!function_exists('syring_woocommerce_default_address_fields')){
    function syring_woocommerce_default_address_fields($fields)
    {
        $fields['country']['priority'] = 1;
        $fields['first_name']['placeholder'] = esc_html__('First Name *', 'sunix');
        $fields['last_name']['placeholder'] = esc_html__('Last Name *', 'sunix');
        $fields['company']['placeholder'] = esc_html__('Company Name', 'sunix');
        $fields['city']['placeholder'] = esc_html__('City', 'sunix');
        $fields['state']['placeholder'] = esc_html__('State', 'sunix');
        $fields['postcode']['placeholder'] = esc_html__('Postcode', 'sunix');

        return $fields;
    }
}
/**
 * Reordering Address My Account form field
 */
add_filter("woocommerce_billing_fields", "syring_woocommerce_billing_fields");
if(!function_exists('syring_woocommerce_billing_fields')){
    function syring_woocommerce_billing_fields($fields)
    {
        $fields['billing_phone']['placeholder'] = esc_html__('Phone', 'sunix');
        $fields['billing_email']['placeholder'] = esc_html__('Email Address', 'sunix');
        return $fields;
    }
}
