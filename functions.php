<?php
/**
 * functions.php
 *
 * The theme's funcftions and definitions.
 * ============================================ *
 */
?>

<?php
	/**
	 * ===================================================================
	 * - Define constants.
	 * ===================================================================
	 */
	define( 'PURE_THEMEROOT', get_stylesheet_directory_uri() );
	define( 'PURE_IMAGES_DIR', PURE_THEMEROOT . '/images' );
	define( 'PURE_SCRIPTS_DIR', PURE_THEMEROOT . '/js' );
	define( 'PURE_STYLES_DIR', PURE_THEMEROOT . '/css' );
	define( 'PURE_FRAMEWORK_DIR', get_template_directory() . '/framework' );
	define( 'PURE_THEME_DIR', get_template_directory() . '/theme' );

	/**
	 * Load the framework.
	 */
	require_once( PURE_FRAMEWORK_DIR . '/init.php' );

	/**
	 * Load theme
	 */
	require_once( PURE_THEME_DIR . '/init.php' );

	/**
	 * Set up the content with value based on the theme's design.
	 */
	if ( !isset( $content_width ) ) {
		$content_width = 800;
	}

	/**
	 * Set up theme default and register various supported features.
	 */
	if ( !function_exists( 'pure_setup' ) ) {
		function pure_setup()
		{
			# Make the theme available for translation.
			$lang_dir = PURE_THEMEROOT . '/languages';
			load_theme_textdomain( 'pure', $lang_dir );

			# Add support for post formats.
			add_theme_support( 'post-formats',
				array(
					'gallery',
					'link',
					'image',
					'video',
					'audio'
				)
			);

			# Add support for post thumbnails.
			add_theme_support( 'post-thumbnails' );

			# Add support for page title.
			add_theme_support( 'title-tag' );

			# Register nav menus.
			register_nav_menus(
				array(
					'main' => __( 'Main Menu', 'pure' ),
					'topbar' => __( 'Topbar Menu', 'pure' ),
					'mobile' => __( 'Mobile Menu', 'pure' )
				)
			);
		}

		add_action( 'after_setup_theme', 'pure_setup' );
	}

	/**
	 * Register the widget areas.
	 */
	if ( !function_exists( 'pure_widget_init' ) ) {
		function pure_widget_init()
		{
			if ( function_exists( 'register_sidebar' ) ) {
				register_sidebar(
					array(
						'name' => __( 'Main sidebar', 'pure' ),
						'id' => 'sidebar-main',
						'description' => __( 'Appears on pages', 'pure' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div><!-- /widget -->',
						'before_title' => '<h5 class="widget-title">',
						'after_title' => '</h5>'
					)
				);
				register_sidebar(
					array(
						'name' => __( 'Blog sidebar', 'pure' ),
						'id' => 'sidebar-blog',
						'description' => __( 'Appears on blog page', 'pure' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div><!-- /widget -->',
						'before_title' => '<h5 class="widget-title">',
						'after_title' => '</h5>'
					)
				);
				register_sidebar(
					array(
						'name' => __( 'Shop sidebar', 'pure' ),
						'id' => 'sidebar-shop',
						'description' => __( 'Appears on blog page', 'pure' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div><!-- /widget -->',
						'before_title' => '<h5 class="widget-title">',
						'after_title' => '</h5>'
					)
				);
				register_sidebar(
					array(
						'name' => __( 'Topbar widget area left', 'pure' ),
						'id' => 'widgetarea-topbar-left',
						'description' => __( 'Appears in topbar', 'pure' ),
						'before_widget' => '<div id="%1$s" class="top-bar-widget %2$s">',
						'after_widget' => '</div><!-- /widget -->',
						'before_title' => '<h5 class="widget-title">',
						'after_title' => '</h5>'
					)
				);
				register_sidebar(
					array(
						'name' => __( 'Topbar widget area right', 'pure' ),
						'id' => 'widgetarea-topbar-right',
						'description' => __( 'Appears in topbar', 'pure' ),
						'before_widget' => '<div id="%1$s" class="top-bar-widget %2$s">',
						'after_widget' => '</div><!-- /widget -->',
						'before_title' => '<h5 class="widget-title">',
						'after_title' => '</h5>'
					)
				);
				register_sidebar(
					array(
						'name' => __( 'Footer widget 1', 'pure' ),
						'id' => 'widgetarea-footer-1',
						'description' => __( 'Appears in footer', 'pure' ),
						'before_widget' => '<div id="%1$s" class="widget col-md-3 col-sm-6 col-xs-12 %2$s">',
						'after_widget' => '</div><!-- /widget -->',
						'before_title' => '<h5 class="widget-title">',
						'after_title' => '</h5>'
					)
				);
				register_sidebar(
					array(
						'name' => __( 'Footer widget 2', 'pure' ),
						'id' => 'widgetarea-footer-2',
						'description' => __( 'Appears in footer', 'pure' ),
						'before_widget' => '<div id="%1$s" class="widget col-md-3 col-sm-6 col-xs-12 %2$s">',
						'after_widget' => '</div><!-- /widget -->',
						'before_title' => '<h5 class="widget-title">',
						'after_title' => '</h5>'
					)
				);
				register_sidebar(
					array(
						'name' => __( 'Footer widget 3', 'pure' ),
						'id' => 'widgetarea-footer-3',
						'description' => __( 'Appears in footer', 'pure' ),
						'before_widget' => '<div id="%1$s" class="widget col-md-3 col-sm-6 col-xs-12 %2$s">',
						'after_widget' => '</div><!-- /widget -->',
						'before_title' => '<h5 class="widget-title">',
						'after_title' => '</h5>'
					)
				);
				register_sidebar(
					array(
						'name' => __( 'Footer widget 4', 'pure' ),
						'id' => 'widgetarea-footer-4',
						'description' => __( 'Appears in footer', 'pure' ),
						'before_widget' => '<div id="%1$s" class="widget col-md-3 col-sm-6 col-xs-12 %2$s">',
						'after_widget' => '</div><!-- /widget -->',
						'before_title' => '<h5 class="widget-title">',
						'after_title' => '</h5>'
					)
				);
				register_sidebar(
					array(
						'name' => __( 'Copyright widget left', 'pure' ),
						'id' => 'widgetarea-copyright-left',
						'description' => __( 'Appears in the site copyright', 'pure' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div><!-- /widget -->',
						'before_title' => '<h5 class="widget-title">',
						'after_title' => '</h5>'
					)
				);
				register_sidebar(
					array(
						'name' => __( 'Copyright widget right', 'pure' ),
						'id' => 'widgetarea-copyright-right',
						'description' => __( 'Appears in the site copyright', 'pure' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div><!-- /widget -->',
						'before_title' => '<h5 class="widget-title">',
						'after_title' => '</h5>'
					)
				);
				register_sidebar(
					array(
						'name' => __( 'Cart widgetarea', 'pure' ),
						'id' => 'widgetarea-cart',
						'description' => __( 'Appears in the Shopping Cart page', 'pure' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget' => '</div><!-- /widget -->',
						'before_title' => '<h5 class="widget-title">',
						'after_title' => '</h5>'
					)
				);
			}
		}
		add_action( 'widgets_init', 'pure_widget_init' );
	}

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
