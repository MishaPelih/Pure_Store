<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table shop_table_responsive cart" cellspacing="0">

    <thead>
        <tr>
            <th class="product-number">&#35;</th>
            <th class="product-thumbnail">&nbsp;</th>
            <th class="product-name"><?php _e( 'Items', 'pure' ); ?></th>
            <th class="product-price"><?php _e( 'Price', 'pure' ); ?></th>
            <th class="product-quantity"><?php _e( 'Quantity', 'pure' ); ?></th>
            <th class="product-subtotal"><?php _e( 'Total', 'pure' ); ?></th>
            <th class="product-remove"><?php _e( 'Remove', 'pure' ); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

        <?php
        $pure_item_count = 0;
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                ?>
                <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                    <td class="product-number">
                        <?php $pure_item_count++; echo $pure_item_count; ?>
                    </td>

                    <td class="product-thumbnail">
                        <?php
                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                            if ( ! $_product->is_visible() ) {
                                echo $thumbnail;
                            } else {
                                printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
                            }
                        ?>
                    </td>

                    <td class="product-name" data-title="<?php _e( 'Product', 'pure' ); ?>">
                        <?php
                            if ( ! $_product->is_visible() ) {
                                echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
                            } else {
                                echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
                            }

                            // Meta data
                            echo WC()->cart->get_item_data( $cart_item );

                            // Backorder notification
                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'pure' ) . '</p>';
                            }
                        ?>
                    </td>

                    <td class="product-price" data-title="<?php _e( 'Price', 'pure' ); ?>">
                        <?php
                            echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                        ?>
                    </td>

                    <td class="product-quantity" data-title="<?php _e( 'Quantity', 'pure' ); ?>">
                        <?php
                            if ( $_product->is_sold_individually() ) {
                                $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                            } else {
                                $product_quantity = woocommerce_quantity_input( array(
                                    'input_name'  => "cart[{$cart_item_key}][qty]",
                                    'input_value' => $cart_item['quantity'],
                                    'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                    'min_value'   => '0'
                                ), $_product, false );
                            }

                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                        ?>
                    </td>

                    <td class="product-subtotal" data-title="<?php _e( 'Total', 'pure' ); ?>">
                        <?php
                            echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                        ?>
                    </td>

                    <td class="product-remove">
                        <?php
                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                '<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s"><i class="zmdi zmdi-delete"></i></a>',
                                esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
                                __( 'Remove this item', 'pure' ),
                                esc_attr( $product_id ),
                                esc_attr( $_product->get_sku() )
                            ), $cart_item_key );
                        ?>
                    </td>
                </tr>
                <?php
            }
        }

        do_action( 'woocommerce_cart_contents' );
        do_action( 'woocommerce_after_cart_contents' ); ?>
    </tbody>
</table>

<div class="update-cart-wrap">
    <a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>" class="button continue-shopping">Continiue shopping</a>
    <input type="submit" class="button" name="update_cart" value="<?php esc_attr_e( 'Update Shopping Bag', 'pure' ); ?>" />
</div>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

    <div class="actions row">

        <?php if ( is_active_sidebar( 'widgetarea-cart' ) ): ?>
            <!-- Widgetarea -->
            <div class="col-md-4 action">
                <?php dynamic_sidebar( 'widgetarea-cart' ); ?>
            </div>
        <?php endif; ?>

        <!-- Actions -->
        <div class="col-md-<?php echo is_active_sidebar( 'widgetarea-cart' ) ? 4 : 6 ?> action coupon-wrap">

            <?php if ( wc_coupons_enabled() ) { ?>
                <div class="coupon">

                    <h5 class="form-title"><?php _e( 'Discount codes', 'pure' ); ?>?</h5>
                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Enter coupon code', 'pure' ); ?>" />
                    <input type="submit" class="button button-dark form-button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'pure' ); ?>" />

                    <?php do_action( 'woocommerce_cart_coupon' ); ?>
                </div>
            <?php } ?>

            <?php do_action( 'woocommerce_cart_actions' ); ?>

            <?php wp_nonce_field( 'woocommerce-cart' ); ?>
        </div>

        <!-- Cart Collaterals -->
        <div class="col-md-<?php echo is_active_sidebar( 'widgetarea-cart' ) ? 4 : 6 ?> action cart-collaterals">
            <?php do_action( 'woocommerce_cart_collaterals' ); ?>
        </div><!-- /.cart-collaterals -->

    </div><!-- /.row -->

    <div class="row cross-sells-row">

        <!-- Cross-sells products. -->
        <div class="cart-collaterals col-md-12">
            <?php do_action( 'pure_cart_cross_sells' ); ?>
        </div><!-- /cross-sells -->

    </div><!-- /.row -->

</form>

<?php do_action( 'woocommerce_after_cart' ); ?>