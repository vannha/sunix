<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '4.1.1');

if ( ! empty( $tabs ) ) : ?>
	<div id="accordionPorduct" class="red-accordion accordion woocommerce-tabs wc-tabs-wrapper">
        <?php foreach ( $tabs as $key => $tab ) : ?>
            <div class="card">
                <div class="card-header" id="heading-<?php echo esc_attr($key);?>">

                       <h5 data-toggle="collapse" data-target="#collapse-<?php echo esc_attr( $key ); ?>" aria-expanded="true" aria-controls="collapse-<?php echo esc_attr( $key ); ?>">
                           <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
                   </h5>

                </div>
                <div id="collapse-<?php echo esc_attr( $key ); ?>" class="collapse <?php if($key == ('description')) { echo 'show'; } ?>" aria-labelledby="heading-<?php echo esc_attr( $key ); ?>" data-parent="#accordionPorduct">
                    <div class="card-body">
                        <?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
	</div>
<?php endif; ?>
