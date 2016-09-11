
<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
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
		$_per_page = 'pure_products_per_page';
		if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST[$_per_page] ) ) {
			$per_page_post = $_POST[$_per_page];
			unset( $_POST[$_per_page] );
			setcookie( $_per_page, $per_page_post, 0, '/' );
			return $per_page_post;
		} elseif ( $_COOKIE[$_per_page] ) {
			return $_COOKIE[$_per_page];
		}
		setcookie( $_per_page, 12, 0, '/' );
		return 12;
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
						<?php
							$grid_class = ' active';
							$list_class = '';

							if ( isset( $_GET['view_mode'] ) && $_GET['view_mode'] == 'list' ) {
								$list_class = ' active';
								$grid_class = '';
							}
						?>
						<div class="grid-view switch-option<?php echo $grid_class; ?>">
							<a href="<?php echo add_query_arg( 'view_mode', 'grid', remove_query_arg( 'view_mode' )); ?>">
								<i class="zmdi zmdi-apps"></i>
							</a>
						</div>
						<div class="list-view switch-option<?php echo $list_class; ?>">
							<a href="<?php echo add_query_arg( 'view_mode', 'list', remove_query_arg( 'view_mode' )); ?>">
								<i class="zmdi zmdi-menu"></i>
							</a>
						</div>
					</div>
					<?php woocommerce_catalog_ordering(); ?>
					<form class="products_per_page_form" method="POST">
						<select name="pure_products_per_page" class="per-page-select wild-select" style="display: none;">
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
		function pure_before_after_shop_loop() { ?>
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
		    add_action( 'woocommerce_before_shop_loop_item_title', 'pure_show_quickly_area_start', 10);
			// add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 10);

				# Add product Image Thumbnail.
			    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

				# Add product Show quickly icon.
			    add_action( 'woocommerce_before_shop_loop_item_title', 'pure_show_quickly', 10 );

			# Add link on product which wrapped  only wrapps image thumbnail (end).
			add_action( 'woocommerce_before_shop_loop_item_title', 'pure_show_quickly_area_end', 10);
			// add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 10);

			# Footer (Start)
			add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_footer_start', 10 );

				# Compare button.
				add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_compare_button', 10 );

				# Add-to-cart button.
				add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );

				# Wishlist button.
				add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_wishlist_button', 10 );
				// add_action( 'woocommerce_before_shop_loop_item_title', create_function( '', 'echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );' ), 10 );


			# Footer (End)
			add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_footer_end', 10 );

		# Product mask content. (End)
	    add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_mask_content_end', 10 );

	# Product mask. (End)
    add_action( 'woocommerce_before_shop_loop_item_title', 'pure_product_mask_end', 10 );

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

    add_action( 'woocommerce_after_shop_loop_item_title', 'pure_product_details_end', 10 );


	/**
	 * Functions.
	 */
	# Compare Button
	if ( ! function_exists( 'pure_product_compare_button' ) ) {
		function pure_product_compare_button() {
			$comp = new YITH_Woocompare_Frontend();
			$product_list = $comp->products_list;
			$added = '';
			foreach  ( $product_list as $key => $value ) {
				if ( $value == get_the_ID() ) $added = ' added';
			}
			echo '<a href="' . pure_get_permalink_without_dominian() . '?action=yith-woocompare-add-product&id=' . get_the_ID() . '" data-product_id="' . get_the_ID() . '" rel="nofollow" class="button side-button compare' . $added . '"></a>';
		}
	}

	# Wishlist Button
	if ( ! function_exists( 'pure_product_wishlist_button' ) ) {
		function pure_product_wishlist_button() { 
			$added = '';
			if ( YITH_WCWL()->is_product_in_wishlist( get_the_ID() ) ) {
				$href = pure_get_permalink_without_dominian() . '?add_to_wishlist=' . get_the_ID();
				$added = ' added';
			} else {
				$href = YITH_WCWL()->get_wishlist_url();
			}
			echo '<a href="<?php echo $href; ?>" rel="nofollow" data-product-id="' . get_the_ID() . '" data-product-type="simple" class="button side-button add_to_wishlist yith-wcwl-add-to-wishlist add-to-wishlist-' . get_the_ID() . $added . '"></a>';
		}
	}

	if ( !function_exists( 'pure_close_div' ) ) {
		function pure_close_div() {
			echo '</div>';
		}
	}

	if ( !function_exists( 'pure_product_meta_wrap_start' ) ) {
		function pure_product_meta_wrap_start() {
			echo '<div class="pure-meta-wrap">';
		}
	}

	if ( ! function_exists('pure_comment_count' ) ) {
		function pure_comment_count() { ?>
			<div id="reviews" class="woocommerce-review-link">
				<a href="<?php echo the_permalink(); ?>#reviews">(<?php echo get_comments_number(); ?>)</a>
			</div>
		<?php
		}
	}

	if ( !function_exists( 'pure_show_quickly_area_start' ) ) {
		function pure_show_quickly_area_start() {
			global $post;
			echo '<div class="show-quickly" data-prodid="' . $post->ID . '">';
		}
	}

	if ( !function_exists( 'pure_show_quickly_area_end' ) ) {
		function pure_show_quickly_area_end() {
			echo '</div><!-- /.show-quickly -->';
		}
	}

	if ( !function_exists( 'pure_product_excerpt' ) ) {
		function pure_product_excerpt() { ?>
			<div class="product-excerpt">
				<?php the_excerpt(); ?>
			</div>
			<?php
		}
	}
	if ( !function_exists( 'pure_show_quickly' ) ) {
		function pure_show_quickly() { ?>
			<span class="icon">
				<i class="zmdi zmdi-plus-circle-o"></i>
			</span>
			<?php
		}
	}

	if ( !function_exists( 'pure_product_title' ) ) {
        function pure_product_title() { ?>
            <h3 class="product-title">
				<a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link">
					<?php the_title(); ?>
				</a>
			</h3>
			<?php
        }
    }

	if ( !function_exists( 'pure_product_details_start' ) ) {
        function pure_product_details_start() {
            echo "<div class='product-details'>";
        }
    }

	if ( !function_exists( 'pure_product_details_end' ) ) {
        function pure_product_details_end() {
			echo "</div><!-- /.product-details -->";
        }
    }

	if ( !function_exists( 'pure_product_footer_start' ) ) {
        function pure_product_footer_start() {
            echo '<footer class="footer-product">';
        }
    }

    if ( !function_exists( 'pure_product_footer_end' ) ) {
        function pure_product_footer_end() {
            echo "</footer>";
        }
    }

	if ( !function_exists( 'pure_product_mask_start' ) ) {
        function pure_product_mask_start() {
            echo "<div class='product-mask'>";
        }
    }

    if ( !function_exists( 'pure_product_mask_end' ) ) {
        function pure_product_mask_end() {
           echo "</div><!-- /.product-mask -->";
        }
    }

	if ( !function_exists( 'pure_product_mask_content_start' ) ) {
        function pure_product_mask_content_start() {
            echo "<div class='product-mask-content'>";
        }
    }

	if ( !function_exists( 'pure_product_mask_content_end' ) ) {
        function pure_product_mask_content_end() {
           echo "</div><!-- /.product-mask-content -->";
        }
    }

	add_action('wp_ajax_pure_product_quick_view', 'pure_product_quick_view');
	add_action('wp_ajax_nopriv_pure_product_quick_view', 'pure_product_quick_view');
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
	 * Single Product Page options.
	 * ============================================================= *
	 */

	/**
	 * Remove Sale flash.
	 */
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

    /**
     * Related Products
     */
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    add_action( 'pure_site_content_bottom', 'pure_related_products', 20 );

    if ( !function_exists( 'pure_related_products' ) ) {
        function pure_related_products()
        {
            global $product, $woocommerce_loop;

            if ( !method_exists( $product, 'get_related' ) || is_shop() ) return;

            $related = $product->get_related();

            if ( sizeof($related) == 0 ) return;

            $args = apply_filters('woocommerce_related_products_args', array(
            	'post_type'				=> 'product',
            	'ignore_sticky_posts'	=> 1,
            	'no_found_rows' 		=> 1,
            	'posts_per_page' 		=> $posts_per_page,
            	'orderby' 				=> $orderby,
            	'post__in' 				=> $related
            ));

            $products = new WP_Query( $args );

            $woocommerce_loop['columns'] = $columns;

            if ( $products->have_posts() ) : ?>

            	<div class="related-products">
                    <div class="container">
                        <h2><?php _e('Suggested products', 'pure'); ?></h2>
                		<ul class="products products-grid">
                			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
                				<?php woocommerce_get_template_part( 'content', 'product' ); ?>
                			<?php endwhile; ?>
                		</ul>
                    </div>
            	</div>

            <?php endif;

            wp_reset_postdata();
        }
    }

	/**
     * Upsell Products
     */
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
    add_action( 'pure_site_content_bottom', 'pure_upsell_products', 15 );

	if ( !function_exists( 'pure_upsell_products' ) ) {
		function pure_upsell_products()
		{
			global $product, $woocommerce_loop;

            if ( !method_exists( $product, 'get_upsells' ) || is_shop() ) return;

            $upsells = $product->get_upsells();

            if ( sizeof($upsells) == 0 ) return;

            $args = apply_filters('woocommerce_related_products_args', array(
            	'post_type'				=> 'product',
            	'ignore_sticky_posts'	=> 1,
            	'no_found_rows' 		=> 1,
            	'posts_per_page' 		=> $posts_per_page,
            	'orderby' 				=> $orderby,
            	'post__in' 				=> $upsells
            ));

            $products = new WP_Query( $args );

            $woocommerce_loop['columns'] = $columns;

            if ( $products->have_posts() ) : ?>

            	<div class="upsells-products">
                    <div class="container">
                        <h2><?php _e('Upsells products', 'pure'); ?></h2>
                		<ul class="products products-grid">
                			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
                				<?php woocommerce_get_template_part( 'content', 'product' ); ?>
                			<?php endwhile; ?>
                		</ul>
                    </div>
            	</div>

            <?php endif;

            wp_reset_postdata();
		}
	}

	/**
	 * Shopping Cart Page options.
	 * ============================================================= *
	 */

	# remove Cross-Sells in cart collaterals.
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
	add_action( 'pure_cart_cross_sells', 'woocommerce_cross_sell_display' );
