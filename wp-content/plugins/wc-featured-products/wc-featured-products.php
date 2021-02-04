<?php

/**
 * Plugin Name: WC Featured Products
 * Plugin URI: 
 * Description: An eCommerce toolkit used to show featured or exclusive products first priority basis.
 * Version: 1.0.2
 * Author: itzmekhokan
 * Author URI: https://itzmekhokan.wordpress.com/
 * Text Domain: wc-featured-products
 * Domain Path: /languages/
 * Requires at least: 4.4
 * Tested up to: 5.4
 * WC requires at least: 3.0
 * WC tested up to: 4.0.1
 *
 * @package wc-featured-products
 */
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define WC_FEATURED_PRODUCTS_PLUGIN_FILE.
if ( !defined( 'WC_FEATURED_PRODUCTS_PLUGIN_FILE' ) ) {
    define( 'WC_FEATURED_PRODUCTS_PLUGIN_FILE', __FILE__ );
}

// Include the main WC_Featured_Products class.
if ( !class_exists( 'WC_Featured_Products' ) ) {
    include_once dirname(__FILE__) . '/includes/class-wc-featured-products.php';
}

/**
 * Main instance of WC_Featured_Products.
 *
 * Returns the main instance of WC_Featured_Products to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return WC_Featured_Products
 */
function WC_Featured_Products() {
    return WC_Featured_Products::instance();
}

// Global for backwards compatibility.
$GLOBALS['wc_featured_products'] = WC_Featured_Products();
