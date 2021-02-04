<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( !class_exists( 'WC_Featured_Products_Frontend' ) ) :

    /**
     * WC_Featured_Products_Frontend.
     *
     * Frontend Event Handler.
     *
     * @class    WC_Featured_Products_Frontend
     * @package  WC_Featured_Products/Classes
     * @category Class
     * @author   itzmekhokan
     */
    class WC_Featured_Products_Frontend {

        /**
         * Constructor for the frontend class. Hooks in methods.
         */
        public function __construct() {
            add_action( 'woocommerce_shop_loop_item_title', array( $this, 'wcfp_add_featured_label_tags' ), 20 );
            add_action( 'woocommerce_before_single_product_summary', array( $this, 'wcfp_add_featured_label_tags' ), 10 );
            add_filter( 'wcfp_is_enabled_featured_products', array( $this, 'wcfp_is_enabled_featured_products' ), 10, 2 );
        }

        public function wcfp_add_featured_label_tags() {
            global $product;
            if ( !$product->is_featured() ) return;
            echo '<span class="onsale">' . apply_filters( 'wcfp_featured_label_tags_html', esc_html__('Featured!', 'woocommerce'), $product ) . '</span>';
        }
        
        public function wcfp_is_enabled_featured_products( $flag, $query ) {
            if( !isset($query->query_vars['wc_query'] ) ) $flag = false; // if query not related to product
            if( isset( $query->is_post_type_archive ) && $query->is_post_type_archive ) $flag = true;
            return $flag;
        }

    }

    endif; // class_exists

return new WC_Featured_Products_Frontend();
