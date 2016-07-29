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
			echo '<div class="content-page shop col-md-9" role="main">';
		}
	}

	add_action( 'woocommerce_after_main_content', 'pure_after_main_content_wrap' );
	if ( !function_exists( 'pure_after_main_content_wrap' ) ) {
		function pure_after_main_content_wrap()
		{
			echo '</div><!-- /.content-page -->';
			get_sidebar( 'shop' );
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
					<select name="products_per_page" onchange="this.form.submit()" class="per-page-select wild-select" style="display: none;">
						<option value="12">12</option>
						<option value="24">24</option>
						<option value="36">36</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="9">9</option>
						<option value="-1">All</option>
					</select>
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
