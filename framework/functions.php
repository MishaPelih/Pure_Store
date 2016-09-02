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
     * Get permalink wihtout domain.
     */
    if ( !function_exists( 'pure_get_permalink_without_dominian' ) ) {
        function pure_get_permalink_without_dominian() {
            $permalink = get_permalink();
            return str_replace( 'http://'.$_SERVER['HTTP_HOST'], "", $permalink );
        }
    }

    /**
     * Add pure_cart_quantity function to woocommerce ajax.
     */
    add_filter( 'woocommerce_add_to_cart_fragments', 'pure_cart_quantity' );

    if ( !function_exists( 'pure_cart_quantity' ) ){
        function pure_cart_quantity( $fragments )
        {
            ob_start();
            pure_cart_link();
            $fragments['a.cart-quantity'] = ob_get_clean();
            return $fragments;
        }
    }

    if ( !function_exists( 'pure_cart_link' ) ){
        function pure_cart_link() { ?>
            <a href="<?php echo WC()->cart->get_cart_url(); ?>" class="cart-contents within-inline cart-quantity">
                <i class="zmdi zmdi-shopping-basket"></i>
                <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count();?></span>
            </a>
        <?php
        }
    }

    /**
     * Get main content classes.
     */
    if ( !function_exists( 'pure_main_content_classes' ) ) {
        function pure_main_content_classes( $option = 'blog' )
        {
            $classes = array();

            if ( pure_enable_sidebar( $option ) ) {

                $cmb_option = pure_get_cmb2_option( 'sidebar_position' );
                $redux_option = pure_get_redux_option( $option . '_sidebar_position' );
                $redux = false;

                if ( $cmb_option ) {
                    if ( $cmb_option === 'left' ) {
                        array_push( $classes, 'pull-right' );
                    } elseif ( $cmb_option === 'right' ) {
                        array_push( $classes, 'pull-left' );
                    } else {
                        $redux = true;
                    }
                } else {
                    $redux = true;
                }

                if ( $redux_option  && $redux === true ) {
                    if ( $redux_option === 'left' ) {
                        array_push( $classes, 'pull-right' );
                    } elseif ( $redux_option === 'right' ) {
                        array_push( $classes, 'pull-left' );
                    }
                }

                if ( is_single() ) {
                    array_push( $classes, 'col-md-12' );
                } else {
                    array_push( $classes, 'col-md-9' );
                }

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
        function pure_enable_sidebar( $option = 'blog' )
        {
            $cmb_option = pure_get_cmb2_option( 'sidebar_position' );
            $redux_option = pure_get_redux_option( $option . '_sidebar_position' );
            $redux = false;

            if ( $cmb_option ) {
                if ( $cmb_option === 'disable' ) {
                    return false;
                } elseif ( $cmb_option === 'default' ) {
                    $redux = true;
                } else {
                    return true;
                }
            } else {
                $redux = true;
            }

            if ( $redux_option && $redux === true ) {
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
        function pure_get_posts_classes( $plug_classes = null )
        {
            $classes = array();
            array_push( $classes, 'posts' );

            if ( $plug_classes ) {
                $classes = array_merge( $classes, $plug_classes );
            }

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
        function pure_get_products_classes()
        {
            $classes = array();
            array_push( $classes, 'products' );

            $view_mode = $_GET['view_mode'];

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
        function pure_get_redux_option( $id, $type = null )
        {
            global $redux_pure;

            if ( !empty( $redux_pure ) && $redux_pure[$id] ) {
                if ( $type ) {
                    return $redux_pure[$id][$type];
                }
                return $redux_pure[$id];
            }
            return false;
        }
    }

    /**
     * Get cmb2 option.
     */
    if ( !function_exists( 'pure_get_cmb2_option' ) ) {
        function pure_get_cmb2_option( $option, $parent = null )
        {
            $id = get_the_ID();

            if ( pure_is_woo_exists() ) {
                if ( is_shop() ) {
                    $id = get_option( 'woocommerce_shop_page_id' );
                }
                if ( is_checkout() ) {
                    $id = get_option( 'woocommerce_checkout_page_id' );
                }
            }
            if ( pure_is_blog() ) {
                $id = get_option( 'page_for_posts' );
            }
            if ( in_the_loop() ) {
                $id = get_the_ID();
            }

            if ( $parent && get_post_meta( $id, 'pure_' . $parent, true ) ) {
                @$cmb_option = get_post_meta( $id, 'pure_' . $parent, true )[0]['pure_' . $option];
            } else {
                @$cmb_option = get_post_meta( $id, 'pure_' . $option, true );
            }
            // $cmb_option = get_post_meta( $id, 'pure_' . $option, true );
            return $cmb_option;
        }
    }

    /**
     * Check if current page is page for posts.
     */
    if ( !function_exists( 'pure_is_blog' ) ) {
        function pure_is_blog ()
        {
            global $post;
            $posttype = get_post_type( $post );
            return ( ( (is_archive() ) || ( is_author() ) || ( is_category() ) || ( is_home() ) || ( is_single() ) || ( is_tag() ) ) && ( $posttype == 'post' )  ) ? true : false ;
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
        function pure_get_logo_url( $option = 'main' )
        {
            $_url = pure_get_redux_option( 'logo_header_' . $option, 'url' );

            if ( $_url && !empty( $_url ) ) {
                return esc_url( $_url );
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
