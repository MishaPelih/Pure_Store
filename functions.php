<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * functions.php
 *
 * The theme's funcftions and definitions.
 * ============================================ *
 */
?>
<?php
	/**
	 * Define constants.
	 */
	define( 'PURE_THEMEROOT', get_stylesheet_directory_uri() );
	define( 'PURE_IMAGES_DIR', PURE_THEMEROOT . '/images' );
	define( 'PURE_SCRIPTS_DIR', PURE_THEMEROOT . '/js' );
	define( 'PURE_STYLES_DIR', PURE_THEMEROOT . '/css' );
	define( 'PURE_FRAMEWORK_DIR', get_template_directory() . '/framework' );
	define( 'PURE_THEME_DIR', get_template_directory() . '/theme' );

	/**
	 * Load theme setup.
	 */
	require_once( PURE_THEME_DIR . '/theme-setup.php' );

	/**
	 * Load the framework.
	 */
	require_once( PURE_FRAMEWORK_DIR . '/init.php' );

	/**
	 * Load theme.
	 */
	require_once( PURE_THEME_DIR . '/init.php' );

	/**
	 * Set up the content with value based on the theme's design.
	 */
	if ( !isset( $content_width ) ) $content_width = 800;

	/**
	 * Remove wpadminbar stylesheets.
	 */
	// add_action( 'get_header', create_function( "", "remove_action( 'wp_head', '_admin_bar_bump_cb' );" ) );

	/**
	 * Load the custom scripts for the theme.
	 */
	if ( ! function_exists( 'pure_scripts' ) ) {
        function pure_scripts() {

            # Adds support for pages with threaded comments
            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }

            # Register scripts
		    wp_register_script( 'bootstrap-js', PURE_SCRIPTS_DIR . '/lib/bootstrap.min.js', array( 'jquery' ), false, true );
			wp_register_script( 'owl-carousel', PURE_SCRIPTS_DIR . '/lib/owl.carousel.min.js');
			wp_register_script( 'magnific-popup', PURE_SCRIPTS_DIR . '/lib/jquery.magnific-popup.min.js', array( 'jquery' ), false, true );
			wp_register_script( 'nouislider', PURE_SCRIPTS_DIR . '/lib/nouislider.min.js', array( 'jquery' ), false, true );
			wp_register_script( 'custom-scroll', PURE_SCRIPTS_DIR . '/lib/jquery.custom-scroll.min.js', array( 'jquery' ), false, true );
			wp_register_script( 'slick', PURE_SCRIPTS_DIR . '/lib/slick.min.js', array( 'jquery' ), false, true );
			wp_register_script( 'wildjs', PURE_SCRIPTS_DIR . '/wild.js', array( 'jquery' ), false, true );
			wp_register_script( 'purestore', PURE_SCRIPTS_DIR . '/pstore.js', array( 'jquery' ), false, true );

			wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'bootstrap-js' );
            wp_enqueue_script( 'owl-carousel' );
            wp_enqueue_script( 'magnific-popup' );
            wp_enqueue_script( 'nouislider' );
            wp_enqueue_script( 'custom-scroll' );
            wp_enqueue_script( 'slick' );
            wp_enqueue_script( 'wildjs' );
			wp_enqueue_script( 'purestore' );

			if( function_exists( 'YITH_WCWL' ) ){
				$wishlist_url = YITH_WCWL()->get_wishlist_url();
			}

			if ( pure_is_woo_exists() ) {
				$wo_exists = true;
			} else {
				$wo_exists = null;
			}

			$pureConf = array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'wishlisturl' => $wishlist_url,
				'woocommerce' => $wo_exists,
			);

			wp_localize_script( 'purestore', 'pureConfig', $pureConf );

            # Load the stylesheets
            wp_enqueue_style( 'bootstrap', PURE_STYLES_DIR . '/bootstrap.min.css' );
            wp_enqueue_style( 'material-design-iconic-font', PURE_STYLES_DIR . '/material-design-iconic-font.min.css' );
            wp_enqueue_style( 'owl-carousel', PURE_STYLES_DIR . '/owl.carousel.css' );
            wp_enqueue_style( 'magnific-popup', PURE_STYLES_DIR . '/magnific-popup.css' );
            wp_enqueue_style( 'nouislider', PURE_STYLES_DIR . '/nouislider.css' );
            wp_enqueue_style( 'pure-master', PURE_THEMEROOT . '/style.css' );
        }
        add_action( 'wp_enqueue_scripts', 'pure_scripts' );
    }