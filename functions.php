<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * functions.php
 * The theme's funcftions and definitions.
 * ============================================ *
*/

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