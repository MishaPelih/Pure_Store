<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * framework/sidebars.php
 *
 * Register the widget areas.
 * ============================================ *
*/ 

if ( !function_exists( 'pure_widget_init' ) ) {
    function pure_widget_init() {
        
        $before_title = '<h5 class="widget-title">';
        $after_title = '</h5>';
        $before_footer_widget = '<div class="col-md-3 col-sm-6 col-xs-12"><div id="%1$s" class="widget %2$s">';
        $after_footer_widget = '</div><!-- /footer-widget --></div>';
        
        if ( function_exists( 'register_sidebar' ) ) {
            register_sidebar(
                array(
                    'name' => __( 'Main sidebar', 'pure' ),
                    'id' => 'sidebar-main',
                    'description' => __( 'Appears on pages', 'pure' ),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div><!-- /widget -->',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Blog sidebar', 'pure' ),
                    'id' => 'sidebar-blog',
                    'description' => __( 'Appears on blog page', 'pure' ),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div><!-- /widget -->',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Topbar widget area left', 'pure' ),
                    'id' => 'widgetarea-topbar-left',
                    'description' => __( 'Appears in topbar', 'pure' ),
                    'before_widget' => '<div id="%1$s" class="top-bar-widget %2$s">',
                    'after_widget' => '</div><!-- /widget -->',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Topbar widget area right', 'pure' ),
                    'id' => 'widgetarea-topbar-right',
                    'description' => __( 'Appears in topbar', 'pure' ),
                    'before_widget' => '<div id="%1$s" class="top-bar-widget %2$s">',
                    'after_widget' => '</div><!-- /widget -->',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Footer widget 1', 'pure' ),
                    'id' => 'widgetarea-footer-1',
                    'description' => __( 'Appears in footer', 'pure' ),
                    'before_widget' => $before_footer_widget,
                    'after_widget' => $after_footer_widget,
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Footer widget 2', 'pure' ),
                    'id' => 'widgetarea-footer-2',
                    'description' => __( 'Appears in footer', 'pure' ),
                    'before_widget' => $before_footer_widget,
                    'after_widget' => $after_footer_widget,
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Footer widget 3', 'pure' ),
                    'id' => 'widgetarea-footer-3',
                    'description' => __( 'Appears in footer', 'pure' ),
                    'before_widget' => $before_footer_widget,
                    'after_widget' => $after_footer_widget,
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Footer widget 4', 'pure' ),
                    'id' => 'widgetarea-footer-4',
                    'description' => __( 'Appears in footer', 'pure' ),
                    'before_widget' => $before_footer_widget,
                    'after_widget' => $after_footer_widget,
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Copyright widget left', 'pure' ),
                    'id' => 'widgetarea-copyright-left',
                    'description' => __( 'Appears in the site copyright', 'pure' ),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div><!-- /widget -->',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Copyright widget right', 'pure' ),
                    'id' => 'widgetarea-copyright-right',
                    'description' => __( 'Appears in the site copyright', 'pure' ),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div><!-- /widget -->',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            if ( class_exists('WooCommerce') ) {
                register_sidebar(
                    array(
                        'name' => __( 'Shop sidebar', 'pure' ),
                        'id' => 'sidebar-shop',
                        'description' => __( 'Appears on blog page', 'pure' ),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div><!-- /widget -->',
                        'before_title' => $before_title,
                        'after_title' => $after_title
                    )
                );
                register_sidebar(
                    array(
                        'name' => __( 'Cart widgetarea', 'pure' ),
                        'id' => 'widgetarea-cart',
                        'description' => __( 'Appears in the Shopping Cart page', 'pure' ),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div><!-- /widget -->',
                        'before_title' => $before_title,
                        'after_title' => $after_title
                    )
                );
            }
        }
    }
    add_action( 'widgets_init', 'pure_widget_init' );
}