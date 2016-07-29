<?php
/**
 * functions.php
 *
 * Contains framework functions.
 * ============================================ *
 */
?>

<?php

    /**
     * Get main content classes.
     */
    if ( !function_exists( 'pure_main_content_classes' ) ) {
        function pure_main_content_classes( $option = 'blog' )
        {
            $option = pure_get_redux_option( $option . '_sidebar_position' );

            if ( $option ) {

                $classes = array();

                if ( $option === 'disable' ) {
                    array_push( $classes, 'col-md-12' );
                } else {
                    array_push( $classes, 'col-md-9' );
                    if ( $option === 'left' ) {
                        array_push( $classes, 'pull-right' );
                    } if ( $option === 'right' ) {
                        array_push( $classes, 'pull-left' );
                    }
                }
                return implode( ' ', $classes );
            }
            return;
        }
    }

    /**
     * Check if sidebar enabled.
     */
    if ( !function_exists( 'pure_enable_sidebar' ) ) {
        function pure_enable_sidebar( $option = 'blog' )
        {
            $option = pure_get_redux_option( $option . '_sidebar_position' );

            if ( $option && $option === 'disable' ) {
                return false;
            }
            return true;
        }
    }

    /**
     * Get Product Loop Start classes.
     */
    if ( !function_exists( 'pure_get_products_classes' ) ) {
        function pure_get_products_classes()
        {
            $classes = array();
            array_push( $classes, 'products' );

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
        function pure_get_redux_option( $id, $type = null )
        {
            global $redux_pure;

            if ( !$type ) {
                return !empty( $redux_pure ) ? $redux_pure[$id] : false;
            }
            return !empty( $redux_pure ) ? $redux_pure[$id][$type] : false;
        }
    }

    /**
     * Get cmb2 option.
     */
    if ( !function_exists( 'pure_get_cmb2_option' ) ) {
        function pure_get_cmb2_option( $option, $parent = null )
        {
            if ( $parent ) {
                $cmb_option = get_post_meta( get_the_ID(), 'pure_' . $parent, true )[0][$option];
            } else {
                $cmb_option = get_post_meta( get_the_ID(), 'pure_' . $option, true );
            }
            return $cmb_option ? $cmb_option : false;
        }
    }

	/**
	 * Get the logo URL.
	 */
	if ( !function_exists( 'pure_get_logo_url' ) ) {
        function pure_get_logo_url( $option = null )
        {
            if ( !$option ) {
                $option = 'main';
            }

			$option = 'header_' . $option . '_logo';

            if ( !empty( pure_get_redux_option( $option, 'url' ) ) ) {
                return esc_url( pure_get_redux_option( $option, 'url' ) );
			}
			return esc_url( PURE_IMAGES_DIR . '/logo-main.png' );
        }
	}

    /**
     * Post Views Counter.
     */
    function pure_update_post_views()
    {
        if ( !$_COOKIE['pure_post_view'] && is_single() ): ?>

            <?php $post_id = get_the_ID(); ?>

            <script>
                jQuery(document).ready(function($)
                {
                    var cname = 'pure_post_view';
                    var cvalue = true;
                    if ( getCookie( 'pure_post_view' ) === false ) {
                        var d = new Date();
                        d.setTime(d.getTime() + (2*24*60*60*1000));
                        var expires = "expires="+ d.toUTCString();
                        document.cookie = cname + "=" + cvalue + "; " + expires;
                    }

                    function getCookie( name ) {
                        var value = "; " + document.cookie;
                        var parts = value.split("; " + name + "=");
                        if (parts.length == 2) {
                            return parts.pop().split(";").shift();
                        }
                        return false;
                    }
                });
            </script>

            <?php
            $post_meta = get_post_meta( $post_id );

            if ( !$post_meta['_post_views'] ) {
                update_post_meta( $post_id, '_post_views', 1 );
            } else {
                $post_views = $post_meta['_post_views'][0];
                (int)$post_views++;
                update_post_meta( $post_id, '_post_views', $post_views );
            }
        endif;
    }

    /**
     * Get post views count.
     */
    function pure_get_post_views() {
        $post_meta = get_post_meta( get_the_ID() );
        return $post_meta['_post_views'][0] ? $post_meta['_post_views'][0] : 0;
    }

    /**
     * Check if Woocommerce plugin has been installed.
     */
	if ( !function_exists( 'pure_is_woo_exists' ) ) {
        function pure_is_woo_exists()
        {
            return is_plugin_active('woocommerce/woocommerce.php');
        }
    }

    /**
     * Get the breadcrumb.
     */
    if ( !function_exists( 'pure_get_breadcrumbs' ) ) {
        function pure_get_breadcrumbs()
        {
            // if it is any woocommerce page or not.
            if ( pure_is_woo_exists() && ( is_shop() || is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) {
                woocommerce_breadcrumb();
            } elseif( !is_front_page() ) {
                pure_breadcrumbs();
            }
        }
    }

    /**
     * Check If woocommerce plugin installed.
     */
    if ( !function_exists( 'pure_is_woo_exists' ) ) {
        function pure_is_woo_exists()
        {
            return is_plugin_active('woocommerce/woocommerce.php');
        }
    }
