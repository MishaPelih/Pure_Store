<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * theme/custom-styles.php
 * ============================================ *
*/

add_action('wp_head', 'pure_assets');

/**
 * Init all functions with custom theme styles.
 */
if ( !function_exists( 'pure_assets' ) ) {
    function pure_assets() {

        echo '<style type="text/css" class="pure-custom-style">';
        echo pure_js2tring( pure_custom_css(), true );
        echo pure_js2tring( pure_active_color_style() );
        echo pure_js2tring( pure_header_logo_style() );
        echo '</style>' . "\r\n"; 
    }
}

if ( !function_exists( 'pure_custom_css' ) ) {
    function pure_custom_css() {
        
        $custom_css = pure_get_redux_option( 'custom_css' );
        $custom_css_desktop = pure_get_redux_option( 'custom_css_desktop' );
        $custom_css_tablet = pure_get_redux_option( 'custom_css_tablet' );
        $custom_css_wide_mobile = pure_get_redux_option( 'custom_css_wide_mobile' );
        $custom_css_mobile = pure_get_redux_option( 'custom_css_mobile' );
        $_code = '';

        if( !empty( $custom_css ) ) {
            $_code .= $custom_css;
        }
        if( !empty( $custom_css_desktop ) ) {
            $_code .= '@media (min-width: 992px) { ' . $custom_css_desktop . ' }';
        }
        if( !empty( $custom_css_tablet ) ) {
            $_code .= '@media (min-width: 768px) and (max-width: 991px) {' . $custom_css_tablet . ' }';
        }
        if( !empty( $custom_css_wide_mobile ) ) {
            $_code .= '@media (min-width: 481px) and (max-width: 767px) { ' . $custom_css_wide_mobile . ' }';
        }
        if( !empty( $custom_css_mobile ) ) {
            $_code .= '@media (max-width: 480px) { ' . $custom_css_mobile . ' }';
        }

        if ( !empty( $_code ) ) {
            return $_code;
        }
        return false;
    }
}

if ( !function_exists( 'pure_header_logo_style' ) ) {
    function pure_header_logo_style() { 
        echo 'header.site-header .header-logo { max-width: ' . pure_get_redux_option( 'logo_width' ) . 'px; }';
    }
}

if ( !function_exists( 'pure_active_color_style' ) ) {
    function pure_active_color_style() {

        global $pure_selectors;

        $pure_selectors = array();
        $pure_selectors['active_color'] = "
            .active-color,
            a:hover,
            a:focus,
            .menu-mobile-switcher-wrap button:hover,
            .owl-controls .owl-nav .owl-prev:hover,
            .owl-controls .owl-nav .owl-next:hover,
            .owl-controls .owl-nav .owl-prev:focus,
            .owl-controls .owl-nav .owl-next:focus,
            .breadcrumbs .parent a:hover,
            .breadcrumbs .parent a:focus,
            .prefooter .shipping-service .icon i,
            .header-wrapper.header-white header.site-header .menu > li > a:hover,
            .header-wrapper.header-white header.site-header .menu-main > li > a:hover,
            .header-wrapper.header-white header.site-header .menu > li > a:focus,
            .header-wrapper.header-white header.site-header .menu-main > li > a:focus,
            .header-wrapper.header-dark header.site-header .menu > li > a:hover,
            .header-wrapper.header-dark header.site-header .menu-main > li > a:hover,
            .header-wrapper.header-dark header.site-header .menu > li > a:focus,
            .header-wrapper.header-dark header.site-header .menu-main > li > a:focus,
            header.site-header .menu > li > a:hover,
            header.site-header .menu-main > li > a:hover,
            header.site-header .menu > li > a:focus,
            header.site-header .menu-main > li > a:focus,
            header.site-header .sub-menu .menu-item a:hover,
            header.site-header .sub-menu .menu-item a:focus,
            header.site-header .site-search button:hover,
            header.site-header .site-search button:focus,
            header.site-header .site-search button:active,
            .top-bar .menu-item a:hover,
            .top-bar .menu-item a:focus,
            .top-bar .sub-menu a:hover,
            .top-bar .sub-menu a:focus,
            .top-bar .cart-quantity:hover,
            .top-bar .cart-quantity:focus,
            .top-bar .widget_shopping_cart_content .mini_cart_item a:hover,
            .top-bar .widget_shopping_cart_content .mini_cart_item a:focus,
            .top-bar .widget_shopping_cart_content .total span,
            .top-bar.top-bar-white ul.menu:not(.sub-menu) > .menu-item > a:hover,
            .top-bar.top-bar-white ul.menu:not(.sub-menu) > .menu-item > a:focus,
            .top-bar.top-bar-white .cart-quantity:hover,
            .top-bar.top-bar-white .cart-quantity:focus,
            .top-bar.top-bar-dark ul.menu:not(.sub-menu) > .menu-item > a:hover,
            .top-bar.top-bar-dark ul.menu:not(.sub-menu) > .menu-item > a:focus,
            .top-bar.top-bar-dark .cart-quantity:hover,
            .top-bar.top-bar-dark .cart-quantity:focus,
            header.site-header.fixed .menu .menu-item a:hover,
            header.site-header.fixed .menu .menu-item a:focus,
            .ps-mobile-menu .menu li a:hover,
            .woocommerce-MyAccount-navigation li.is-active a,
            .page .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active > a,
            .page .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab > a:focus,
            .page .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab > a:hover,
            .pagination-wrap .switch-option a:hover,
            .filter-wrap .switch-option a:hover,
            .widget.widget_nav_menu ul.menu a:hover,
            .widget.widget_nav_menu ul.menu a:focus,
            .widget.widget.widget_calendar th,
            .widget.widget.widget_calendar a,
            .widget.pure_widget_posts .post-meta a:hover,
            .widget.pure_widget_posts .post-meta a:focus,
            .widget.widget_product_categories > ul .cat-item a:hover,
            .widget.widget_product_categories > ul .cat-item a:focus,
            .widget.widget_product_categories > ul .cat-item.open .open-this,
            .widget.widget_product_categories > ul .open-this:hover,
            .widget.widget_product_categories > ul > .cat-item > a:hover,
            .widget.widget_product_categories > ul > .cat-item > a:focus,
            article.post .entry-description h2 a:hover,
            article.post .entry-description h2 a:focus,
            article.post a:hover,
            #comments .comment-author a:hover,
            #comments .comment-author a:focus,
            #comments .reply a:hover,
            #comments .reply a:focus,
            .filter-wrap .switch-option.active a,
            .product-quick-view .mfp-close:hover,
            .product-quick-view h1 a:hover,
            .product-quick-view h1 a:focus,
            .woocommerce-message a:hover,
            .woocommerce-info a:hover,
            .woocommerce-message a:focus,
            .woocommerce-info a:focus,
            .quantity span.plus:hover,
            .quantity span.minus:hover,
            table.cart th.product-remove a:hover,
            table.cart th.product-remove a:focus,
            .cart_totals .shop_table tbody tr.shipping td span,
            .single-product .yith-wcwl-add-to-wishlist a:hover:before,
            .product-quick-view .yith-wcwl-add-to-wishlist a:hover:before,
            .single-product .compare:hover:before,
            .product-quick-view .compare:hover:before,
            .single-product .add_to_wishlist:hover:before,
            .product-quick-view .add_to_wishlist:hover:before,
            .single-product .yith-wcwl-add-to-wishlist a:focus:before,
            .product-quick-view .yith-wcwl-add-to-wishlist a:focus:before,
            .single-product .compare:focus:before,
            .product-quick-view .compare:focus:before,
            .single-product .add_to_wishlist:focus:before,
            .product-quick-view .add_to_wishlist:focus:before,
            .single-product .yith-wcwl-add-to-wishlist a:active:before,
            .product-quick-view .yith-wcwl-add-to-wishlist a:active:before,
            .single-product .compare:active:before,
            .product-quick-view .compare:active:before,
            .single-product .add_to_wishlist:active:before,
            .product-quick-view .add_to_wishlist:active:before,
            .products .onsale,
            .products .footer-product .side-button:hover,
            .products .footer-product .side-button:focus,
            .products .price .woocommerce-Price-amount,
            .products .price ins,
            .pure-owl-posts .owl-controls .owl-nav .owl-prev:hover,
            .pure-owl-posts .owl-controls .owl-nav .owl-next:hover,
            .pure-owl-posts .owl-controls .owl-nav .owl-prev:focus,
            .pure-owl-posts .owl-controls .owl-nav .owl-next:focus,
            .woocommerce #content table.wishlist_table.cart a.remove:hover,
            .top-bar .widget_shopping_cart_content .mini_cart_item .remove:hover,
            .widget.widget_calendar a,
            .woocommerce-account .woocommerce-MyAccount-navigation li.is-active a
        ";

        $pure_selectors['bg_color'] = "
            .active-bg-color,
            .site-content .button,
            .site-footer .button,
            .footer-bottom .button,
            .site-content button,
            .site-footer button,
            .footer-bottom button,
            .site-content input[type='submit'],
            .site-footer input[type='submit'],
            .footer-bottom input[type='submit']
            .banner.with_mask .before,
            .owl-controls .owl-dot.active span,
            .top-bar .cart-count,
            .team-member:hover .member-image:before,
            .contact-form-area form input[type='submit'],
            .widget.widget_mc4wp_form_widget input[type='submit'],
            .widget.widget_mc4wp_form_widget input[type='button'],
            .single-product form.comment-form input[type='submit'],
            .single-product table.variations .reset_variations,
            .product-quick-view table.variations .reset_variations,
            .product-quick-view .mfp-close,
            .products .product-mask:hover .product-mask-content .show-quickly:before,
            .products .footer-product .side-button.added,
            .products .add_to_cart_button,
            .pagination-wrap .page-numbers li span.current, 
            .filter-wrap .page-numbers li span.current
        ";

        $pure_selectors['border_color'] = "
            input[type='text']:focus,
            input[type='number']:focus,
            input[type='email']:focus,
            input[type='search']:focus,
            input[type='password']:focus,
            input[type='tel']:focus,
            textarea:focus,
            .prefooter .shipping-service .icon:hover,
            header.site-header .site-search form.focused,
            .top-bar .widget_shopping_cart_content .mini_cart_item .remove:hover,
            .pagination-wrap .page-numbers li.current a,
            .filter-wrap .page-numbers li.current a,
            .pagination-wrap .page-numbers li.current span,
            .filter-wrap .page-numbers li.current span,
            .pagination-wrap .page-numbers li span.current,
            .filter-wrap .page-numbers li span.current,
            .pagination-wrap .switch-option.active a,
            .filter-wrap .switch-option.active a,
            .widget.widget_mc4wp_form_widget input[type='email']:focus,
            .widget.widget_mc4wp_form_widget input[type='text']:focus,
            .woocommerce-checkout .select2-container.select2-dropdown-open .select2-choice,
            .widget.widget_price_filter .ui-slider-handle,
            .widget .noUi-horizontal .noUi-handle,
            .products .footer-product,
            .select2-drop
        ";

        $active_color = pure_get_redux_option( 'active_color' );

        $_code = $pure_selectors['active_color'] . '{ color: ' . $active_color . '; }';
        $_code .= $pure_selectors['bg_color'] . '{ background-color: ' . $active_color . '; }';
        $_code .= $pure_selectors['border_color'] . '{ border-color: ' . $active_color . '; }';

        return $_code;
    }
}