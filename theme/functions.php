<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * theme/functions.php
 * ============================================ *
*/

/**
 * Load the custom scripts for the theme.
 */
if ( !function_exists( 'pure_theme_scripts' ) ) {
    function pure_theme_scripts() {

        # Adds support for pages with threaded comments
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        # Register scripts
        wp_register_script( 'bootstrap-js', PURE_SCRIPTS_DIR . '/lib/bootstrap.min.js', array( 'jquery' ), false, true );
        wp_register_script( 'owl-carousel', PURE_SCRIPTS_DIR . '/lib/owl.carousel.min.js');
        wp_register_script( 'magnific-popup', PURE_SCRIPTS_DIR . '/lib/jquery.magnific-popup.min.js', array( 'jquery' ), false, true );
        wp_register_script( 'custom-scroll', PURE_SCRIPTS_DIR . '/lib/jquery.custom-scroll.min.js', array( 'jquery' ), false, true );
        wp_register_script( 'slick', PURE_SCRIPTS_DIR . '/lib/slick.min.js', array( 'jquery' ), false, true );
        wp_register_script( 'wildjs', PURE_SCRIPTS_DIR . '/wild.js', array( 'jquery' ), false, true );
        wp_register_script( 'purestore', PURE_SCRIPTS_DIR . '/pstore.js', array( 'jquery' ), false, true );

        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'bootstrap-js' );
        wp_enqueue_script( 'owl-carousel' );
        wp_enqueue_script( 'magnific-popup' );
        wp_enqueue_script( 'custom-scroll' );
        wp_enqueue_script( 'slick' );
        wp_enqueue_script( 'wildjs' );
        wp_enqueue_script( 'purestore' );

        $wishlist_url = null;

        if ( function_exists( 'YITH_WCWL' ) && method_exists( 'YITH_WCWL', 'get_wishlist_url' ) ) {
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
    }
    
    add_action( 'wp_enqueue_scripts', 'pure_theme_scripts' );
}

/**
 * Enqueue styles for Theme.
 */
if ( !function_exists( 'pure_theme_styles' ) ) {
    function pure_theme_styles() {

        wp_enqueue_style( 'bootstrap', PURE_STYLES_DIR . '/bootstrap.css' );
        wp_enqueue_style( 'material-design-iconic-font', PURE_STYLES_DIR . '/material-design-iconic-font.min.css' );
        wp_enqueue_style( 'owl-carousel', PURE_STYLES_DIR . '/owl.carousel.css' );
        wp_enqueue_style( 'magnific-popup', PURE_STYLES_DIR . '/magnific-popup.css' );
        wp_enqueue_style( 'pure-master', PURE_THEMEROOT . '/style.css' );
    }

    add_action( 'wp_enqueue_scripts', 'pure_theme_styles' );
}

/**
 * Plugins activation.
 */
if ( !function_exists( 'pure_register_required_plugins' ) ) {
    function pure_register_required_plugins() {
        
        $plugins = array(
            array(
                'name'                  => 'Redux Framework',
                'slug'                  => 'redux-framework',
                'required'              => true,
            ),
            array(
                'name'                  => 'CMB2',
                'slug'                  => 'cmb2',
                'required'              => true,
            ),
            array(
                'name'                  => 'WooCommerce', // The plugin name
                'slug'                  => 'woocommerce', // The plugin slug (typically the folder name)
                //'source'                  => get_template_directory_uri() . '/framework/plugins/screets-chat.zip', // The plugin source
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
                'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'          => 'woocommerce', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'                  => 'Visual Composer',
                'slug'                  => 'js_composer',
                'source'                => get_template_directory_uri() . '/theme/plugins/js_composer.zip',
                'required'              => true,
                'version'               => '',
                'force_activation'      => false,
                'force_deactivation'    => false,
                'external_url'          => '',
            ),
            array(
                'name'                  => 'YITH WooCommerce Wishlist',
                'slug'                  => 'yith-woocommerce-wishlist',
                'required'              => false,
            ),
            array(
                'name'      => 'YITH WooCommerce Compare',
                'slug'      => 'yith-woocommerce-compare',
                'required'  => false,
            ),
            array(
                'name'                  => 'Contact form 7',
                'slug'                  => 'contact-form-7',
                'required'              => false,
            ),
            array(
                'name'                  => 'Mailchimp',
                'slug'                  => 'mailchimp-for-wp',
                'required'              => false,
            ),
        );

        /*
         * Array of configuration settings. Amend each line as needed.
         *
         * TGMPA will start providing localized text strings soon. If you already have translations of our standard
         * strings available, please help us make TGMPA even better by giving us access to these translations or by
         * sending in a pull-request with .po file(s) with the translations.
         *
         * Only uncomment the strings in the config array if you want to customize the strings.
         */
        $config = array(
            'id'           => 'pure',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu'         => 'tgmpa-install-plugins', // Menu slug.
            'has_notices'  => true,                    // Show admin notices or not.
            'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message'      => '',                      // Message to output right before the plugins table.
        );

        tgmpa( $plugins, $config );
    }
}

add_action( 'tgmpa_register', 'pure_register_required_plugins' );