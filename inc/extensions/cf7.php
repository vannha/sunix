<?php
/*
* Replace cf7 form submit with button 
* http://www.featheredowl.com/contact-form-7-submit-button-element/
* @ Thanks Ant Cullen
*/
if(!class_exists('WPCF7')) return;

function zk_charixy_fowl_wpcf7_submit_button() {
    if(function_exists('wpcf7_remove_form_tag')) {
        wpcf7_remove_form_tag('submit');
        remove_action( 'wpcf7_admin_init', 'wpcf7_add_tag_generator_submit', 55 );
    }
}
add_action('after_setup_theme','zk_charixy_fowl_wpcf7_submit_button');