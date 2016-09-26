<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * framework/sidebars.php
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
                    'name' => __( 'Topbar sidebar left', 'pure' ),
                    'id' => 'sidebar-topbar-left',
                    'description' => __( 'Appears in topbar', 'pure' ),
                    'before_widget' => '<div id="%1$s" class="top-bar-widget %2$s">',
                    'after_widget' => '</div><!-- /widget -->',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Topbar sidebar right', 'pure' ),
                    'id' => 'sidebar-topbar-right',
                    'description' => __( 'Appears in topbar', 'pure' ),
                    'before_widget' => '<div id="%1$s" class="top-bar-widget %2$s">',
                    'after_widget' => '</div><!-- /widget -->',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Footer sidebar 1', 'pure' ),
                    'id' => 'sidebar-footer-1',
                    'description' => __( 'Appears in footer', 'pure' ),
                    'before_widget' => $before_footer_widget,
                    'after_widget' => $after_footer_widget,
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Footer sidebar 2', 'pure' ),
                    'id' => 'sidebar-footer-2',
                    'description' => __( 'Appears in footer', 'pure' ),
                    'before_widget' => $before_footer_widget,
                    'after_widget' => $after_footer_widget,
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Footer sidebar 3', 'pure' ),
                    'id' => 'sidebar-footer-3',
                    'description' => __( 'Appears in footer', 'pure' ),
                    'before_widget' => $before_footer_widget,
                    'after_widget' => $after_footer_widget,
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Footer sidebar 4', 'pure' ),
                    'id' => 'sidebar-footer-4',
                    'description' => __( 'Appears in footer', 'pure' ),
                    'before_widget' => $before_footer_widget,
                    'after_widget' => $after_footer_widget,
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Copyright sidebar left', 'pure' ),
                    'id' => 'sidebar-copyright-left',
                    'description' => __( 'Appears in the site copyright', 'pure' ),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div><!-- /widget -->',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            register_sidebar(
                array(
                    'name' => __( 'Copyright sidebar right', 'pure' ),
                    'id' => 'sidebar-copyright-right',
                    'description' => __( 'Appears in the site copyright', 'pure' ),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div><!-- /widget -->',
                    'before_title' => $before_title,
                    'after_title' => $after_title
                )
            );
            if ( class_exists( 'WooCommerce' ) ) {
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
                        'name' => __( 'Cart sidebar', 'pure' ),
                        'id' => 'sidebar-cart',
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