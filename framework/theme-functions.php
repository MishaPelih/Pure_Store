<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * framework/theme-functions.php
 * Contains framework functions.
 * ============================================ *
*/

/**
 * Returns body classes.
 */
if ( !function_exists( 'pure_get_body_classes' ) ) {
    function pure_get_body_classes() {

        $_classes = array();

        if ( pure_enable_sidebar() ) array_push( $_classes, 'sidebar-enabled' );
        return implode( ' ', $_classes );
    }
}

/**
 * Returns classes for heders.
 */
if ( !function_exists( 'pure_header_classes' ) ) {
    function pure_header_classes() {

        $_classes = array();
        $cmb_parent_option = 'header_options';
        $overlap_rdx = pure_get_redux_option( 'header_overlap' );
        $overlap_cmb = pure_get_cmb2_option( 'header_overlap', $cmb_parent_option );

        if ( !$overlap_cmb || $overlap_cmb == 'default' ) {
            if ( $overlap_rdx && $overlap_rdx != false ) {
                $overlap = true;
            } else {
                $overlap = false;
            }
        } elseif( $overlap_cmb == 'on' ) {
            $overlap = true;
        } elseif( $overlap_cmb == 'off' ) {
            $overlap = false;
        }

        if ( $overlap && $overlap === true ) array_push( $_classes, 'header-overlap' );

        # Header text color.
        $hdr_color_rdx = pure_get_redux_option( 'header_color' );
        $hdr_color_cmb = pure_get_cmb2_option( 'header_color', $cmb_parent_option );

        if ( $hdr_color_cmb && $hdr_color_cmb != 'default' ) {
            $hdr_color = $hdr_color_cmb;
        } else {
            $hdr_color = $hdr_color_rdx;
        }

        if ( $hdr_color ) array_push( $_classes, 'header-' . $hdr_color );

        if ( count( $_classes ) > 0 ) array_unshift( $_classes, '' );

        $_classes = implode( ' ', $_classes );
        
        echo $_classes;
    }
}

/**
 * Returns classes for Top-bar.
 */
if ( !function_exists( 'pure_top_bar_classes' ) ) {
    function pure_top_bar_classes() {

        $_classes = array();
        $cmb_parent_option = 'top_bar_options';

        # Top-bar text color.
        $tb_color_rdx = pure_get_redux_option( 'top_bar_color' );
        $tb_color_cmb = pure_get_cmb2_option( 'top_bar_color', $cmb_parent_option );

        if ( $tb_color_cmb && $tb_color_cmb != 'default' ) {
            $tb_color = $tb_color_cmb;
        } else {
            $tb_color = $tb_color_rdx;
        }

        if ( $tb_color ) array_push( $_classes, 'top-bar-' . $tb_color );

        if ( count( $_classes ) > 0 ) array_unshift( $_classes, '' );

        $_classes = implode( ' ', $_classes );
        
        echo $_classes;
    }
}

/**
 * Get permalink wihtout domain.
 */
if ( !function_exists( 'pure_get_permalink_without_dominian' ) ) {
    function pure_get_permalink_without_dominian() {
        return str_replace( 'http://' . $_SERVER['HTTP_HOST'], '', get_permalink() );
    }
}

/**
 * Get main content classes.
 */
if ( !function_exists( 'pure_main_content_classes' ) ) {
    function pure_main_content_classes( $option = 'blog' ) {

        $classes = array();

        if ( pure_enable_sidebar( $option ) && is_active_sidebar( 'sidebar-' . $option ) ) {

            $cmb_option = pure_get_cmb2_option( 'sidebar_position', 'page_layout' );
            $redux_option = pure_get_redux_option( $option . '_sidebar_position' );
            $redux = false;

            if ( isset( $cmb_option ) ) {
                if ( $cmb_option === 'left' ) {
                    array_push( $classes, 'pull-lg-right' );
                } elseif ( $cmb_option === 'right' ) {
                    array_push( $classes, 'pull-lg-left' );
                } else {
                    $redux = true;
                }
            } else {
                $redux = true;
            }

            if ( $redux_option && $redux === true && ( pure_is_woo_exists() && !is_product() ) ) {
                if ( $redux_option === 'left' ) {
                    array_push( $classes, 'pull-lg-right' );
                } elseif ( $redux_option === 'right' ) {
                    array_push( $classes, 'pull-lg-left' );
                }
            }

            array_push( $classes, 'col-md-9' );

        } else {
            array_push( $classes, 'col-md-12' );
        }

        return implode( ' ', $classes );
    }
}

/**
 * Check if sidebar enabled.
 */
if ( !function_exists( 'pure_enable_sidebar' ) ) {
    function pure_enable_sidebar( $option = 'blog' ) {

        $cmb_option = pure_get_cmb2_option( 'sidebar_position', 'page_layout' );
        $redux_option = pure_get_redux_option( $option . '_sidebar_position' );
        $redux = false;

        if ( isset( $cmb_option ) && !empty( $cmb_option ) ) {

            if ( $cmb_option === 'disable' ) {
                return false;
            } 
            elseif ( $cmb_option === 'default' ) {
                $redux = true;
            } 
            else {
                return true;
            }
        } else {
            $redux = true;
        }

        if ( isset( $redux_option ) && !empty( $redux_option ) && $redux === true ) {
            if ( $redux_option === 'disable' ) {
                return false;
            } else {
                return true;
            }
        }

        return false;
    }
}

/**
 * Get posts classes.
 */
if ( !function_exists( 'pure_get_posts_classses' ) ) {
    function pure_get_posts_classes( $plug_classes = null ) {

        $classes = array();

        array_push( $classes, 'posts' );

        if ( $plug_classes ) $classes = array_merge( $classes, $plug_classes );

        if ( pure_get_redux_option( 'posts_per_row' ) ) {
            array_push( $classes, 'posts-grid' );
            array_push( $classes, 'row-count-' . pure_get_redux_option( 'posts_per_row' ) );
        }

        return implode( ' ', $classes );
    }
}

/**
 * Get Product Loop Start classes.
 */
if ( !function_exists( 'pure_get_products_classes' ) ) {
    function pure_get_products_classes() {

        $classes = array();

        array_push( $classes, 'products' );

        $view_mode = null;

        if ( isset( $_GET['view_mode'] ) ) $view_mode = $_GET['view_mode'];

        if ( $_SERVER['REQUEST_METHOD'] === 'GET' && $view_mode && $view_mode == ( 'list' || 'grid' ) ) {
            array_push( $classes, 'products-' . $view_mode );
        } else {
            array_push( $classes, 'products-grid' );
        }

        if ( pure_get_redux_option( 'products_per_row' ) ) {
            array_push( $classes, 'row-count-' . pure_get_redux_option( 'products_per_row' ) );
        }

        return implode( ' ', $classes );
    }
}

/**
 * Get redux option.
 */
if ( !function_exists( 'pure_get_redux_option' ) ) {
    function pure_get_redux_option( $id ) {

        global $redux_pure;

        if ( isset( $redux_pure ) && !empty( $redux_pure ) && isset( $redux_pure[$id] ) ) {
            return $redux_pure[$id];
        }
        return false;
    }
}

/**
 * Get cmb2 option.
 */
if ( !function_exists( 'pure_get_cmb2_option' ) ) {
    function pure_get_cmb2_option( $option, $parent = null ) {

        $id = get_the_ID();

        if ( pure_is_woo_exists() ) {
            if ( is_shop() ) {
                $id = get_option( 'woocommerce_shop_page_id' );
            }
            if ( is_checkout() ) {
                $id = get_option( 'woocommerce_checkout_page_id' );
            }
        }

        if ( pure_is_blog() ) $id = get_option( 'page_for_posts' );

        if ( in_the_loop() ) $id = get_the_ID();

        if ( $parent && get_post_meta( $id, 'pure_' . $parent, true ) ) {
            @$cmb_option = get_post_meta( $id, 'pure_' . $parent, true )[0]['pure_' . $option];
        } else {
            @$cmb_option = get_post_meta( $id, 'pure_' . $option, true );
        }

        return $cmb_option;
    }
}

/**
 * Check if current page is page for posts.
 */
if ( !function_exists( 'pure_is_blog' ) ) {
    function pure_is_blog() {

        global $post;

        $posttype = get_post_type( $post );
        return ( ( ( is_archive() ) || ( is_author() ) || ( is_category() ) || ( is_home() ) || ( is_single() ) || ( is_tag() ) ) && ( $posttype == 'post' )  ) ? true : false ;
    }
}

/**
 * Get relevant header.
 */
if ( !function_exists( 'pure_get_relevant_header' ) ) {
    function pure_get_relevant_header() {

        $header_type_rdx = pure_get_redux_option('header_type');
        $header_type_cmb = pure_get_cmb2_option( 'header_type', 'header_options' );

        if ( $header_type_cmb && $header_type_cmb !== 'default' ) {
            $header_type = $header_type_cmb;
        } elseif ( $header_type_rdx ) {
            $header_type = $header_type_rdx;
        } else {
            $header_type = 'main';
        }

        get_template_part( 'headers/' . $header_type );
    }
}

/**
 * Get the logo URL.
 */
if ( !function_exists( 'pure_get_logo_url' ) ) {
    function pure_get_logo_url( $option = 'main' ) {

        $_url_rdx = pure_get_redux_option( 'logo_header_' . $option );
        $_url_rdx = isset( $_url_rdx['url'] ) ? $_url_rdx['url'] : null;
        $_url_cmb = pure_get_cmb2_option( 'logo_header_' . $option, 'header_options' );
        $_url = false;

        if ( !isset( $_url_cmb ) || empty( $_url_cmb ) && ( isset( $_url_rdx ) && !empty( $_url_rdx ) ) ) {
            $_url = esc_url( $_url_rdx );
        } else {
            $_url = esc_url( $_url_cmb );
        }

        return $_url;
    }
}

/**
 * Post Views Counter.
 */
if ( !function_exists( 'pure_update_post_views' ) ) {
    function pure_update_post_views() {

        if ( !isset( $_COOKIE['pure_post_view'] ) && is_single() ): ?>
            <?php $post_id = get_the_ID(); ?>
            <script>
                jQuery(document).ready(function($) {

                    var cname = 'pure_post_view';
                    var cvalue = true;

                    if ( getCookie( 'pure_post_view' ) === false ) {

                        var d = new Date();
                        d.setTime( d.getTime() + (2*24*60*60*1000) );
                        var expires = "expires=" + d.toUTCString();
                        document.cookie = cname + "=" + cvalue + "; " + expires;
                    }

                    function getCookie( name ) {

                        var value = "; " + document.cookie;
                        var parts = value.split( "; " + name + "=" );

                        if ( parts.length == 2 ) {
                            return parts.pop().split(";").shift();
                        }
                        return false;
                    }
                });
            </script>

            <?php
            $post_meta = get_post_meta( $post_id );

            if ( !isset( $post_meta['_post_views'] ) ) {
                update_post_meta( $post_id, '_post_views', 1 );
            } 
            else {
                $post_views = $post_meta['_post_views'][0];
                (int)$post_views++;
                update_post_meta( $post_id, '_post_views', $post_views );
            }
        endif;
    }
}

/**
 * Get post views count.
 */
function pure_get_post_views() {

    $post_meta = get_post_meta( get_the_ID() );
    return isset( $post_meta['_post_views'][0] ) ? $post_meta['_post_views'][0] : 0;
}

/**
 * Check if Woocommerce plugin has been installed.
 */
if ( !function_exists( 'pure_is_woo_exists' ) ) {
    function pure_is_woo_exists() {
        return class_exists( 'WooCommerce' ) ? true : false;
    }
}

/**
 * Get the breadcrumb.
 */
if ( !function_exists( 'pure_get_breadcrumbs' ) ) {
    function pure_get_breadcrumbs() {

        // if it is any woocommerce page or not.
        if ( pure_is_woo_exists() && ( is_shop() || is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) {
            woocommerce_breadcrumb();
        } elseif ( !is_front_page() ) {
            pure_breadcrumbs();
        } else {
            return false;
        }
    }
}

/**
 * Check If woocommerce plugin installed.
 */
if ( !function_exists( 'pure_is_woo_exists' ) ) {
    function pure_is_woo_exists() {
        return is_plugin_active('woocommerce/woocommerce.php');
    }
}

if ( !function_exists( 'pure_js2tring' ) ) {
    function pure_js2tring( $str = '', $remove_extra_whitespaces = false ) {

        $final_str = trim( preg_replace( "/('|\"|\t|\r?\n)/", '', $str ) );

        if ( $remove_extra_whitespaces === true ) {
           $final_str = trim( preg_replace("/\s{2,}/", " ", $final_str) );
        }

        return $final_str;
    } 
}