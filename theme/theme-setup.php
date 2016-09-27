<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * theme/theme-setup.php
 * ============================================ *
 */

/**
 * Set up theme default and register various supported features.
 */
if ( !function_exists( 'pure_setup' ) ) {
    function pure_setup() {
        
        # Make the theme available for translation.
        $lang_dir = PURE_THEMEROOT . '/languages';
        
        load_theme_textdomain( 'pure', $lang_dir );

        # Add support for post formats.
        add_theme_support( 'post-formats', array( 'gallery', 'link', 'image', 'video', 'audio' ) );

        # Add support for post thumbnails.
        add_theme_support( 'post-thumbnails' );

        # Add support for page title.
        add_theme_support( 'title-tag' );

        # Add support for automatic feed links.
        add_theme_support( 'automatic-feed-links' );

        # Register nav menus.
        register_nav_menus( array(
            'main' => __( 'Main Menu', 'pure' ),
            'topbar' => __( 'Topbar Menu', 'pure' ),
            'mobile' => __( 'Mobile Menu', 'pure' )
        ) );
    }

    add_action( 'after_setup_theme', 'pure_setup' );
    // add_theme_support( 'woocommerce' );
}