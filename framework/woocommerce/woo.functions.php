<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * framework/woocommerce/woo.functions.php
 * File which contains functions related to woocommerce.
 * =================================================== *
*/

/**
 * Quick view.
 */
if ( !function_exists( 'pure_product_quick_view' ) ) {
    function pure_product_quick_view() {

        if ( empty( $_POST['prodid'] ) ) {
            echo 'Error: Absent product id';
            die();
        }

        $args = array(
            'p' => (int) $_POST['prodid'],
            'post_type' => 'product'
        );

        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) : $the_query->the_post();
                woocommerce_get_template('product-quick-view.php');
            endwhile;
            wp_reset_query();
            wp_reset_postdata();
        } else {
            echo 'No posts were found!';
        }
        die();
    }
}

/**
 * Cart quantity fragments.
 */
if ( !function_exists( 'pure_cart_quantity' ) ){
    function pure_cart_quantity( $fragments ) {
        ob_start();
        pure_cart_link();
        $fragments['a.cart-quantity'] = ob_get_clean();
        return $fragments;
    }
}

/**
 * Woocommerce breadcrumbs default settings.
 */
if ( !function_exists( 'pure_woocommerce_breadcrumbs' ) ) {
    function pure_woocommerce_breadcrumbs() {
        return array(
            'delimiter'   => '<span class="sep">&nbsp;/&nbsp;</span>',
            'wrap_before' => '<div class="breadcrumbs"><div class="container">',
            'wrap_after'  => '</div></div>',
            'before'      => '<span class="current">',
            'after'       => '</span>',
            'home'        => _x( 'Home', 'breadcrumb', 'pure' )
        );
    }
    add_filter( 'woocommerce_breadcrumb_defaults', 'pure_woocommerce_breadcrumbs' );
}

/**
 * Retrieve qty. of products per page.
 */
function pure_products_per_page_qty() {
    $_per_page = 'pure_products_per_page';
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST[$_per_page] ) ) {
        $per_page_post = $_POST[$_per_page];
        unset( $_POST[$_per_page] );
        setcookie( $_per_page, $per_page_post, 0, '/' );
        return $per_page_post;
    } elseif ( isset( $_COOKIE[$_per_page] ) ) {
        return $_COOKIE[$_per_page];
    }
    setcookie( $_per_page, 12, 0, '/' );
    return 12;
}

/**
 * Woocommerce pagination options.
 */
if ( !function_exists( 'pure_woocommerce_pagination_options' ) ) {
    function pure_woocommerce_pagination_options( $args ) {
        $args['prev_text'] = '<i class="zmdi zmdi-chevron-left"></i>';
        $args['next_text'] = '<i class="zmdi zmdi-chevron-right"></i>';
        return $args;
    }
}