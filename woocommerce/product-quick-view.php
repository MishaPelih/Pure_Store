<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');

    /**
     * woocommerce_before_single_product hook.
     *
     * @hooked wc_print_notices - 10
     */
    do_action( 'woocommerce_before_single_product' );

    if ( post_password_required() ) {
        echo get_the_password_form();
        return;
    }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="row">
        <div class="col-md-6 images-wrap">
            <div class="images">
                <?php
                    echo woocommerce_get_product_thumbnail( 'extra_large' );
                ?>
            </div>
        </div>

        <div class="col-md-6 summary-wrap">
            <div class="summary entry-summary">
                <h1 itemprop="name" class="product_title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <?php
                    woocommerce_template_single_rating();
                    woocommerce_template_single_price();
                ?>
                <div itemprop="description">
                    <label>Overview:</label>
                    <div class="desc-content">
                        <?php echo get_the_content(); ?>
                    </div>
                </div>
                <div class="actions">
                    <?php woocommerce_template_loop_add_to_cart();
                    echo pure_product_wishlist_button(); ?>
                </div>
                <?php woocommerce_template_single_meta(); ?>

            </div><!-- /.summary -->
        </div><!-- /.summary-wrap -->
    </div>

    <meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->