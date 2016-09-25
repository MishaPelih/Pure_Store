<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * framework/init.php
 * Load the frameworks.
 * ============================================ *
*/

/**
 * Load main frameworks .
 */
get_template_part( 'framework/sidebars' );
get_template_part( 'framework/theme-functions' );
get_template_part( 'framework/template-tags' );
get_template_part( 'framework/theme-config' );
get_template_part( 'framework/tgm-plugin-activation/class-tgm-plugin-activation' );
get_template_part( 'framework/metabox' );

/**
 * Load Post Types.
 */
get_template_part( 'framework/post-types/static-block' );

/**
 * Load Widgets.
 */
get_template_part( 'framework/widgets/popular-posts' );
get_template_part( 'framework/widgets/static-block' );
get_template_part( 'framework/widgets/myaccount-dropdown' );

/**
 * Load Shortcodes.
 */
get_template_part( 'framework/shortcodes/static-block' );
get_template_part( 'framework/shortcodes/social-icons' );
get_template_part( 'framework/shortcodes/banner' );
get_template_part( 'framework/shortcodes/staff' );
get_template_part( 'framework/shortcodes/posts' );
get_template_part( 'framework/shortcodes/simple-carousel' );
get_template_part( 'framework/shortcodes/products-carousel' );

/**
 * Load woocommerce framework.
 */
get_template_part( 'framework/woocommerce/woo.hooks' );
get_template_part( 'framework/woocommerce/woo.functions' );
get_template_part( 'framework/woocommerce/woo.template-tags' );

/**
 * Load Theme Libs.
 */
get_template_part( 'framework/libs/tgm-plugin-activation.class' );
get_template_part( 'framework/libs/VideoUrlParser.class' );

// $_url_rdx = pure_get_redux_option( 'logo_header_main', 'url' );
// echo isset( $_url_rdx );
// echo empty( $_url_rdx );
// echo $_url_rdx;