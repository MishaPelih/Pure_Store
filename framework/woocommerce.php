<?php
/**
 * woocommerce.php
 *
 * File which contains functions and hooks related to woocommerce.
 * ============================================================= *
 */
?>

<?php
	/**
	 * Global options.
	 * ============================================================= *
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
	if ( !function_exists( 'pure_before_main_content_wrap' ) ) {
		function pure_before_main_content_wrap()
		{
			echo '<div class="row">';
			echo '<div class="content-page shop ' . pure_main_content_classes( 'shop' ) . '" role="main">';
		}
	}

	add_action( 'woocommerce_after_main_content', 'pure_after_main_content_wrap' );
	if ( !function_exists( 'pure_after_main_content_wrap' ) ) {
		function pure_after_main_content_wrap()
		{
			echo '</div><!-- /.content-page -->';
			pure_enable_sidebar( 'shop' ) ? get_sidebar( 'shop' ) : remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );;
			echo '</div><!-- /.row -->';
		}
	}

	/**
	 * Remove woocommerce default breadcrumb.
	 */
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

	/**
	 * Removes the page title on the main shop page.
	 */
	add_filter( 'woocommerce_show_page_title' , 'pure_hide_page_title' );
	function pure_hide_page_title(){ return false; }

    /**
     * Change woocommerce breadcrumbs settings.
     */
    if ( !function_exists( 'pure_woocommerce_breadcrumbs' ) ) {
        function pure_woocommerce_breadcrumbs()
        {
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
	 * Posts per page.
	 */
	add_filter( 'loop_shop_per_page', 'pure_shop_per_page', 20 );

	function pure_shop_per_page()
	{
		$products_per_page_post = $_POST['products_per_page'];
		$products_per_page_cookie = $_COOKIE['products_per_page'];

		if ( $_SERVER['REQUEST_METHOD'] === 'POST' && $products_per_page_post ) {
			unset( $_POST['products_per_page'] );
			setcookie( 'pure_products_per_page', $products_per_page_post, 0, get_permalink( woocommerce_get_page_id( 'shop' ) ) );
			return $products_per_page_post;
		} elseif ( $products_per_page_cookie ) {
			return $products_per_page_cookie;
		}
		return false;
	}



	/**
	 * Shop Page options.
	 * ============================================================= *
	 */

	/**
	 * Before Woocommerce Shop loop.
	 */
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

	add_action( 'woocommerce_before_shop_loop', 'pure_before_before_shop_loop' );
	if ( !function_exists( 'pure_before_before_shop_loop' ) ) {
		function pure_before_before_shop_loop()
		{
			?>
			<div class="filter-wrap top">
				<div class="filter-content">
					<div class="switch">
						<div class="grid-view switch-option active">
							<a href="#">
								<i class="zmdi zmdi-apps"></i>
							</a>
						</div>
						<div class="list-view switch-option">
							<a href="#">
								<i class="zmdi zmdi-menu"></i>
							</a>
						</div>
					</div>
					<?php woocommerce_catalog_ordering(); ?>
					<form class="products_per_page_form" method="POST">
						<select name="products_per_page" class="per-page-select wild-select" style="display: none;">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="9">9</option>
							<option value="12">12</option>
							<option value="24">24</option>
							<option value="36">36</option>
							<option value="-1">All</option>
						</select>
					</form>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * After Woocommerce Shop loop.
	 */
	remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

	add_action( 'woocommerce_after_shop_loop', 'pure_before_after_shop_loop' );
	if ( !function_exists( 'pure_before_after_shop_loop' ) ) {
		function pure_before_after_shop_loop()
		{
			?>
			<div class="filter-wrap top">
				<div class="filter-content">
					<div class="switch">
						<div class="grid-view switch-option active">
							<a href="#">
								<i class="zmdi zmdi-apps"></i>
							</a>
						</div>
						<div class="list-view switch-option">
							<a href="#">
								<i class="zmdi zmdi-menu"></i>
							</a>
						</div>
					</div>
					<?php woocommerce_pagination(); ?>
					<?php woocommerce_catalog_ordering(); ?>
				</div>
			</div>
			<?php
		}
	}

	/**
	 * Woocommerce pagination options.
	 */
    if ( !function_exists( 'pure_woocommerce_pagination_options' ) ) {
        function pure_woocommerce_pagination_options( $args )
        {
            $args['prev_text'] = '<i class="zmdi zmdi-chevron-left"></i>';
            $args['next_text'] = '<i class="zmdi zmdi-chevron-right"></i>';

            return $args;
        }
    }
    add_filter( 'woocommerce_pagination_args',  'pure_woocommerce_pagination_options' );

	/**
	 * Product content.
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
		    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 10);

				# Add product Image Thumbnail.
			    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

				# Add product Show quickly icon.
			    add_action( 'woocommerce_before_shop_loop_item_title', 'pure_show_quickly', 10 );

			# Add link on product which wrapped  only wrapps image thumbnail (end).
			add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 10);

			# Footer (Start)
			add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_footer_start', 10 );

				# Compare button.
				add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_compare_button', 10 );

				# Add-to-cart button.
				add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );

				# Wishlist button.
				add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_wishlist_button', 10 );

			# Footer (End)
			add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_footer_end', 10 );

		# Product mask content. (End)
	    add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_mask_content_end', 10 );

	# Product mask. (End)
    add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_mask_end', 10 );

	# Product details. (Start)
    add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_details_start', 10 );

		# Add Product Title with link.
		add_action('woocommerce_shop_loop_item_title','pure_product_title',5);

		# Add Product Price.
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 5);

		# Add Product Rating.
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

    add_action( 'woocommerce_after_shop_loop_item_title', 'pure_product_details_end', 10 );



	# Functions.
	if ( !function_exists( 'pure_show_quickly' ) ) {
		function pure_show_quickly()
		{ ?>
			<span class="icon">
				<i class="zmdi zmdi-plus-circle-o"></i>
			</span>
			<?php
		}
	}

	if ( !function_exists( 'pure_product_title' ) ) {
        function pure_product_title()
        { ?>
            <h3 class="product-title">
				<a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link">
					<?php the_title(); ?>
				</a>
			</h3>
			<?php
        }
    }

	if ( !function_exists( 'pure_product_details_start' ) ) {
        function pure_product_details_start()
        {
            echo "<div class='product-details'>";
        }
    }

	if ( !function_exists( 'pure_product_details_end' ) ) {
        function pure_product_details_end()
        {
			echo "</div><!-- /.product-details -->";
        }
    }


	if ( !function_exists( 'pure_product_compare_button' ) ) {
        function pure_product_compare_button()
        {
            echo '<a href="#" class="refresh button side-button">';
			echo '<i class="zmdi zmdi-refresh"></i>';
			echo '</a>';
        }
    }

	if ( !function_exists( 'pure_product_wishlist_button' ) ) {
        function pure_product_wishlist_button()
        {
            echo '<a href="#" class="add-to-wishlist button side-button">';
			echo '<i class="zmdi zmdi-favorite-outline"></i>';
			echo '</a>';
        }
    }

	if ( !function_exists( 'pure_product_footer_start' ) ) {
        function pure_product_footer_start()
        {
            echo '<footer class="footer-product">';
        }
    }

    if ( !function_exists( 'pure_product_footer_end' ) ) {
        function pure_product_footer_end()
        {
            echo "</footer>";
        }
    }

	if ( !function_exists( 'pure_product_mask_start' ) ) {
        function pure_product_mask_start()
        {
            echo "<div class='product-mask'>";
        }
    }

    if ( !function_exists( 'pure_product_mask_end' ) ) {
        function pure_product_mask_end()
        {
           echo "</div><!-- /.product-mask -->";
        }
    }

	if ( !function_exists( 'pure_product_mask_content_start' ) ) {
        function pure_product_mask_content_start()
        {
            echo "<div class='product-mask-content'>";
        }
    }

	if ( !function_exists( 'pure_product_mask_content_end' ) ) {
        function pure_product_mask_content_end()
        {
           echo "</div><!-- /.product-mask-content -->";
        }
    }
