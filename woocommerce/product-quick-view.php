<?php
    if ( ! defined( 'ABSPATH' ) ) {
    	exit; // Exit if accessed directly
    }

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

    <div class="container product-main">
        <div class="row">
    		<div class="col-md-6 images-wrap">
    			<?php
    				/**
    				 * woocommerce_before_single_product_summary hook.
    				 *
    				 * @hooked woocommerce_show_product_sale_flash - 10
    				 * @hooked woocommerce_show_product_images - 20
    				 */
    				do_action( 'woocommerce_before_single_product_summary' );
    			?>
    		</div>

    		<div class="col-md-6 summary-wrap">
    			<div class="summary entry-summary">

    				<?php
    					/**
    					 * woocommerce_single_product_summary hook.
    					 *
    					 * @hooked woocommerce_template_single_title - 5
    					 * @hooked woocommerce_template_single_rating - 10
    					 * @hooked woocommerce_template_single_price - 10
    					 * @hooked woocommerce_template_single_excerpt - 20
    					 * @hooked woocommerce_template_single_add_to_cart - 30
    					 * @hooked woocommerce_template_single_meta - 40
    					 * @hooked woocommerce_template_single_sharing - 50
    					 */
    					do_action( 'woocommerce_single_product_summary' );
    				?>

    			</div><!-- /.summary -->
    		</div><!-- /.summary-wrap -->
        </div>
    </div>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->
