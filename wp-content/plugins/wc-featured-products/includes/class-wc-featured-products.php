<?php

/**
 * WC_Featured_Products setup
 *
 * @package  WC_Featured_Products
 * @since    1.0.0
 */
defined('ABSPATH') || exit;

/**
 * Main WC_Featured_Products Class.
 *
 * @class WC_Featured_Products
 */
final class WC_Featured_Products {

    /**
     * WC_Featured_Products version.
     *
     * @var string
     */
    public $version = '1.0.2';
    
    /**
     * instance of the core class.
     *
     * @var WC_Featured_Products_Core
     */
    public $core = null;
    
    /**
     * instance of the core class.
     *
     * @var WC_Featured_Products_Admin
     */
    public $admin = null;

    /**
     * The single instance of the class.
     *
     * @var WC_Featured_Products
     * @since 1.0.0
     */
    protected static $_instance = null;

    /**
     * Main WC_Featured_Products Instance.
     *
     * Ensures only one instance of WC_Featured_Products is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @see WC_Featured_Products()
     * @return WC_Featured_Products - Main instance.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * WC_Featured_Products Constructor.
     */
    public function __construct() {
        $this->define_constants();
        add_action( 'plugins_loaded', array( $this, 'load_classes' ), 9 );
        add_action( 'init', array( $this, 'init' ) );
        add_action( 'activated_plugin', array( $this, 'activated_plugin' ) );
        add_action( 'deactivated_plugin', array( $this, 'deactivated_plugin' ) );
        do_action( 'wc_featured_products_loaded' );
    }

    /**
     * Define WC Constants.
     */
    private function define_constants() {
        if ( !defined( 'WC_FEATURED_PRODUCTS_ABSPATH' ) )
            define( 'WC_FEATURED_PRODUCTS_ABSPATH', dirname(WC_FEATURED_PRODUCTS_PLUGIN_FILE) . '/' );
        if ( !defined( 'WC_FEATURED_PRODUCTS_BASENAME' ) )
            define( 'WC_FEATURED_PRODUCTS_BASENAME', plugin_basename(WC_FEATURED_PRODUCTS_PLUGIN_FILE) );
        if (!defined( 'WC_FEATURED_PRODUCTS_VERSION' ) )
            define( 'WC_FEATURED_PRODUCTS_VERSION', $this->version );
    }

    /**
     * Include required core files used in admin and on the frontend.
     */
    public function includes() {
        /**
         * Core classes and functions.
         */
        $this->core = include_once WC_FEATURED_PRODUCTS_ABSPATH . 'includes/class-wc-featured-products-core.php';

        if ( ( !is_admin() || defined('DOING_AJAX') ) && !defined('DOING_CRON') ) {
            include_once WC_FEATURED_PRODUCTS_ABSPATH . 'includes/class-wc-featured-products-frontend.php';
        }
        
    }

    /**
     * Init WooCommerce when WordPress Initialises.
     */
    public function init() {
        // Before init action.
        do_action( 'before_wc_featured_products_init' );
        // Set up localisation.
        $this->load_plugin_textdomain();
        // Init action.
        do_action( 'wc_featured_products_init' );
    }

    /**
     * Load Localisation files.
     */
    public function load_plugin_textdomain() {
        $locale = is_admin() && function_exists('get_user_locale') ? get_user_locale() : get_locale();
        $locale = apply_filters( 'plugin_locale', $locale, 'wc-featured-products' );

        unload_textdomain( 'wc-featured-products' );
        load_textdomain( 'wc-featured-products', WP_LANG_DIR . '/wc-featured-products/wc-featured-products-' . $locale . '.mo');
        load_plugin_textdomain( 'wc-featured-products', false, plugin_basename( dirname (WC_FEATURED_PRODUCTS_PLUGIN_FILE ) ) . '/languages' );
    }

    /**
     * Instantiate classes when woocommerce is activated
     */
    public function load_classes() {
        if ( $this->is_woocommerce_activated() === false ) {
            add_action( 'admin_notices', array( $this, 'need_woocommerce' ) );
            return;
        }

        // all systems ready - GO!
        $this->includes();
    }

    /**
     * Check if woocommerce is activated
     */
    public function is_woocommerce_activated() {
        $blog_plugins = get_option( 'active_plugins', array() );
        $site_plugins = is_multisite() ? (array) maybe_unserialize( get_site_option( 'active_sitewide_plugins' ) ) : array();

        if ( in_array( 'woocommerce/woocommerce.php', $blog_plugins ) || isset( $site_plugins['woocommerce/woocommerce.php'] ) ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * WooCommerce not active notice.
     *
     * @return string Fallack notice.
     */
    public function need_woocommerce() {
        $error = sprintf( __('WooCommerce Feature Products requires %sWooCommerce%s to be installed & activated!', 'wc-featured-products'), '<a href="http://wordpress.org/extend/plugins/woocommerce/">', '</a>' );

        $message = '<div class="error"><p>' . $error . '</p></div>';

        echo $message;
    }

    /**
     * Get the plugin url.
     *
     * @return string
     */
    public function plugin_url() {
        return untrailingslashit( plugins_url( '/', WC_FEATURED_PRODUCTS_PLUGIN_FILE ) );
    }

    /**
     * Get the plugin path.
     *
     * @return string
     */
    public function plugin_path() {
        return untrailingslashit( plugin_dir_path( WC_FEATURED_PRODUCTS_PLUGIN_FILE ) );
    }
    
    /**
     * Ran when any plugin is activated.
     *
    */
    public function activated_plugin( $filename ) {
        $settings = array(
            'is_global_featured_first' => true
        );
        update_option( 'wcfp_settings_general', $settings );
    }
    
    /**
     * Ran when any plugin is deactivated.
     *
    */
    public function deactivated_plugin( $filename ) {
        
    }

}
