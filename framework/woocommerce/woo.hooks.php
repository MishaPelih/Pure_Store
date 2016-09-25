<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * framework/woocommerce/woo.hooks.php
 * File which contains hooks related to woocommerce.
 * =============================================== *
*/

/**
 * Global options.
 * ============================================================= *
 * 
*/

/**
 * Disable Woocommerce stylesheets.
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Declare woocommerce support.
 */
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() { add_theme_support( 'woocommerce' ); }

/**
 * Unhook the WooCommerce wrappers.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Add the PureStore wrappers.
 */
add_action( 'woocommerce_before_main_content', 'pure_before_main_content_wrap' );
add_action( 'woocommerce_after_main_content', 'pure_after_main_content_wrap' );

/**
 * Remove woocommerce default breadcrumb.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * Removes the page title on the main shop page.
 */
add_filter( 'woocommerce_show_page_title' , create_function( '', 'return false;' ) );

/**
 * Posts per page.
 */
add_filter( 'loop_shop_per_page', 'pure_products_per_page_qty', 20 );


/**
 * Shop Page options.
 * ============================================================= *
 * 
*/

/**
 * Before Woocommerce Shop loop.
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'woocommerce_before_shop_loop', 'pure_before_before_shop_loop' );

/**
 * After Woocommerce Shop loop.
 */
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'pure_before_after_shop_loop' );

/**
 * Woocommerce pagination options.
 */
add_filter( 'woocommerce_pagination_args',  'pure_woocommerce_pagination_options' );

/**
* Product content hooks.
*/
# Remove link which wrapped all product (start).
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

# Remove link which wrapped all product (end).
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

# Remove Add-To-Cart Button.
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

# Remove Product Thumbnail.
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

# Remove Product Rating.
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

# Remove Product Price.
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

# Remove Product Title.
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

# Product mask. (Start)
add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_mask_start', 10 );

# Product mask content. (Start)
add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_mask_content_start', 10 );

# Add link on product which wrapped  only wrapps image thumbnail (start).
add_action( 'woocommerce_before_shop_loop_item_title', 'pure_show_quickly_area_start', 10);

# Add product Image Thumbnail.
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

# Add product Show quickly icon.
add_action( 'woocommerce_before_shop_loop_item_title', 'pure_show_quickly', 10 );

# Add link on product which wrapped  only wrapps image thumbnail (end).
add_action( 'woocommerce_before_shop_loop_item_title', create_function( '', 'echo "</div><!-- /.show-quickly -->";' ), 10);

# Footer (Start)
add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_footer_start', 10 );

# Compare button.
add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_compare_button', 10 );

# Add-to-cart button.
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );

# Wishlist button.
add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_wishlist_button', 10 );

# Footer (End)
add_action( 'woocommerce_before_shop_loop_item_title', create_function( '', 'echo "</footer>";' ), 10 );

# Product mask content. (End)
add_action( 'woocommerce_before_shop_loop_item_title', create_function( '', 'echo "</div><!-- /.product-mask-content -->";' ), 10 );

# Product mask. (End)
add_action( 'woocommerce_before_shop_loop_item_title', create_function( '', 'echo "</div><!-- /.product-mask -->";' ), 10 );

# Product details. (Start)
add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_details_start', 10 );

# Add Product Title with link.
add_action('woocommerce_shop_loop_item_title','pure_product_title',5 );

# Add Product Price.
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );

# Add meta wrap.
add_action( 'woocommerce_shop_loop_item_title', 'pure_product_meta_wrap_start', 5 );

# Add Product Rating.
add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

# Add Comment count.
add_action( 'woocommerce_shop_loop_item_title', 'pure_comment_count', 5 );

# Close div
add_action( 'woocommerce_shop_loop_item_title', 'pure_close_div', 5 );

# Add Product Excerpt.
add_action( 'woocommerce_shop_loop_item_title', 'pure_product_excerpt', 5 );

add_action( 'woocommerce_after_shop_loop_item_title', create_function( '', 'echo "</div><!-- /.product-details -->";' ), 10 );

/**
 * Quick view.
 */
add_action('wp_ajax_pure_product_quick_view', 'pure_product_quick_view');
add_action('wp_ajax_nopriv_pure_product_quick_view', 'pure_product_quick_view');


/**
 * Single Product Page options.
 * ============================================================= *
 * 
*/

/**
 * Remove Sale flash.
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

/**
 * Related Products
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/**
 * Upsell Products
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );


/**
 * Shopping Cart Page options.
 * ============================================================= *
 * 
*/

/**
 * Remove Cross-Sells in cart collaterals..
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'pure_cart_cross_sells', 'woocommerce_cross_sell_display' );

/**
 * Add pure_cart_quantity function to woocommerce ajax.
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'pure_cart_quantity' );