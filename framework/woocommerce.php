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
     * Disable Woocommerce stylesheets.
     */
    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

    /**
     * Declare woocommerce support.
     */
    add_action( 'after_setup_theme', 'woocommerce_support' );
    function woocommerce_support() { add_theme_support( 'woocommerce' ); }

    /**
     * Change woocommerce breadcrumbs settings.
     */
    if ( !function_exists( 'pure_woocommerce_breadcrumbs' ) ) {
        function pure_woocommerce_breadcrumbs()
        {
            return array(
                'delimiter'   => '<span class="sep"><i class="fa fa-angle-right"></i></span>',
                'wrap_before' => '<div class="container breadcrumbs-area"><div class="row"><div class="col-md-12"><div class="breadcrumbs basic-breadcrumbs">',
                'wrap_after'  => '</div></div></div></div>',
                'before'      => '<span class="current">',
                'after'       => '</span>',
                'home'        => _x( 'Home', 'breadcrumb', 'pure' )
            );
        }
        add_filter( 'woocommerce_breadcrumb_defaults', 'pure_woocommerce_breadcrumbs' );
    }

