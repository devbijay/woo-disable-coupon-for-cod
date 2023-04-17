<?php
/*
Plugin Name: Woocommerce Disable Coupon For COD Orders Order
Plugin URI: https://github.com/devbijay/woo-disable-coupon-for-cod
Description: This plugin does something cool.
Version: 1.0
Author: John Doe
Author URI: https://example.com
*/

// Check if WooCommerce is installed and activated
function check_woocommerce() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        // WooCommerce is not installed or activated, display an error message
        wp_die( 'Please install and activate WooCommerce before activating this plugin.' );
    }
}

// Hook into the activate_plugin action to check if WooCommerce is set up
add_action( 'activate_plugin', 'check_woocommerce' );

// Disable coupon for COD orders
add_filter( 'woocommerce_coupon_is_valid', 'disable_coupon_for_cod_orders', 10, 2 );
function disable_coupon_for_cod_orders( $is_valid, $coupon ) {
    // Check if COD is selected
    if ( isset( $_POST['payment_method'] ) && $_POST['payment_method'] == 'cod' ) {
        $is_valid = false;
        wc_add_notice( __( 'Sorry, you cannot use a coupon for COD orders.' ), 'error' );
    }
    return $is_valid;
}
