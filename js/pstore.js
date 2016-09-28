;(function($) {

    /**
     * pstore.js - Theme main script.
     * @author Misha Pelykh
     * @version 1.0.0
     * =============================================== *
     */

    "use strict";

    var pureStore = {
        init: function() {
            this.mobileMenu();
            this.fixedHeader();
            this.siteSearch();
            this.wildSelectInit();
            this.owlCarouselInit();
            this.customScrollInit();
            this.spinButtons();
            this.sidebarDropdowns();
            this.dropdownMenusOverflovDefender();
            if ( pureConfig.woocommerce ) {
                this.woocommerceOrderingForm();
                this.priceFilter();
                this.productsPerPage();
                this.singleProductsThumbnails();
                this.addToWishlistBtn();
                this.wishlistTfootRemove();
                if ( pureConfig.ajaxurl ) {
                    this.quickView();
                }
            }
        },

        quickView: function() {

            $(document.body).on('click', '.show-quickly', (function() {

                var thisBtn = $(this);
                var prodid = thisBtn.data('prodid');
                var magnificPopup;

                $.ajax({
                    url: pureConfig.ajaxurl,
                    method: 'POST',
                    data: {
                        'action': 'pure_product_quick_view',
                        'prodid': prodid
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        thisBtn.addClass('loading');
                        thisBtn.find('.icon').html('<i class="zmdi zmdi-spinner"></i>');
                    },
                    complete: function()  {
                        thisBtn.removeClass('loading');
                        thisBtn.find('.icon').html('<i class="zmdi zmdi-plus-circle-o"></i>');
                    },
                    success: function( response ) {
                        $.magnificPopup.open({
                            items: { src: '<div class="product-quick-view mfp-with-anim"><div class="container product-quick-view-wrap"><div class="product-quick-view-content">' + response + '</div></div></div>' },
                            type: 'inline',
                            removalDelay: 500,
                        }, 0);
                    }
                });

                $('body').on('click', '.quick-view-popup .main-images a', function(e) {
                    e.preventDefault();
                });
            }));
        },

        mobileMenu: function() {

            var mobileMenu = $('.pure-menu-mobile');
            var wpadminbar = $( '#wpadminbar' );
            var position = {
                get: function( element ) { return element.css( 'position' ); },
                set: function( element, new_pos ) {
                    element.css({ position: new_pos });
                },
            }

            if ( wpadminbar.length ) {

                $(window).bind('load scroll resize', function() {

                    var ABHeight = wpadminbar.innerHeight();
                    var scrolled = window.pageYOffset || document.documentElement.scrollTop;
                    var windowHeight = $(window).outerHeight(true);

                    mobileMenu.css({

                        top: function() {

                            if ( position.get( wpadminbar ) == 'absolute' ) {

                                if ( scrolled < ABHeight ) {
                                    position.set( mobileMenu, 'absolute' );
                                    return ABHeight + 'px';
                                }
                                position.set( mobileMenu, 'fixed' );
                                return '';
                            }
                            position.set( mobileMenu, 'fixed' );
                            return ABHeight + 'px';
                        },

                        height: function() {

                            if ( position.get( wpadminbar ) == 'absolute' ) {

                                if ( scrolled < ABHeight ) {
                                    return windowHeight - ABHeight + scrolled + 'px';
                                }
                                return '';
                            }
                            return windowHeight - ABHeight + 'px';
                        }
                    });
                });
            }

            mobileMenu.find('form.searchform').filter(function(){

                var form = $(this);
                var input = form.find('input');

                input.focus(function(){ form.addClass( 'focused' ); });
                input.focusout(function(){ form.removeClass( 'focused' ); });
            });

            mobileMenu.find('li.menu-item-has-children').each(function(){

                var menuItem = $(this);

                menuItem.prepend('<span class="open-this"></span>');
                menuItem.find('.open-this').click(function(){
                    menuItem.toggleClass('open');
                });
            });

            mobileMenu.find( '.open-this' ).each(function(){

                var openThis = $(this);
                var thisLi = openThis.parent();
                var subMenu = openThis.siblings('.sub-menu');
                var animHeight = function( element, action = 'toggle', speed = 'fast' ){
                    element.animate({ height: action }, speed );
                };

                openThis.click(function(){

                    var index = thisLi.index();

                    if ( thisLi.hasClass('open') ) {
                        thisLi.parent().find('li').each(function(){
                            if ( $(this).hasClass('open') && $(this).index() != index ) { 
                                $(this).toggleClass('open');
                                animHeight( $(this).find('.sub-menu'), 'hide' );
                            }
                        });
                    }
                    animHeight( subMenu );
                });
            });

            $('.close-menu-mobile, .close-menu-mobile-full-screen, .menu-mobile-switcher').click(function(){
                $('body').toggleClass('menu-mobile-open');
            });
        },

        fixedHeader: function() {

            $(window).scroll(function() {

                var header = $('header.header.fixed');

                if ( $(window).scrollTop() >= $('.header-wrapper').innerHeight() ) {
                   header.addClass('active');
                   wpadminbarHeightOffset();
                } else {
                    header.removeClass('active');
                    header.css({ 'top': '' });
                }
            });

            $(window).resize(function(){ wpadminbarHeightOffset() });

            var wpadminbarHeightOffset = function() {

                var wpadminbar = $( '#wpadminbar' );

                if ( wpadminbar.length ) {
                    $( 'header.header.fixed.active' ).css( 'top', function() {
                        if ( wpadminbar.css( 'position' ) == 'fixed' ) {
                            return wpadminbar.innerHeight() + 'px';
                        }
                        return '';
                    });
                }
            }
        },

        siteSearch: function() {

            var input = $('.site-search .searchform').find('input');
            var form = input.parent();

            input.focus(function(){ form.addClass( 'focused' ); });
            input.focusout(function(){ form.removeClass( 'focused' ); });
        },

        wildSelectInit: function() {

            $('.wild-select, .woocommerce-ordering .orderby').wildSelect({
                animation: 'flyUp',
                dropdownIcon: '<i class="zmdi zmdi-chevron-down"></i>'
            });
        },

        owlCarouselInit: function() {

            var navIcons = ['<i class="zmdi zmdi-chevron-left"></i>','<i class="zmdi zmdi-chevron-right"></i>'];

            $('.related-products, .upsells-products, .cross-sells').find('.products').owlCarousel({
                loop: true,
                dots: false,
                margin: 30,
                navText: navIcons,
                responsive:{
                    0: { items: 1, nav: false },
                    480: { items: 2, nav: false },
                    620: { items: 3, nav: false },
                    768: { items: 4, nav: false },
                    1200: { items: 4, nav: true }
                }
            });

            $( '.pure-carousel' ).owlCarousel({
                items: 5,
                loop: true,
                nav: true,
                dots: false,
                margin: 60,
                navText: navIcons
            });
        },

        singleProductsThumbnails: function() {

            $('.thumbnails').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                vertical: true,
                speed: 170,
                verticalSwiping: true,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            vertical: false,
                            verticalSwiping: false,
                            slidesToShow: 3,
                            focusOnSelect: true,
                            padding: '20px',
                        }
                    },
                ]
            });
        },

        customScrollInit: function() {
            $('.widget_layered_nav ul, .ps_widget_brands ul').customScroll();
        },

        spinButtons: function() {

            // Add spin buttons after AJAX request has been stopped.
            $( document ).ajaxStop(function() {
                $("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").find('input').wrap('<div class="quantity-content"></div>');
                $("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass("buttons_added").find('input').after('<div class="qty-btn-wrap"><span class="plus"><i class="zmdi zmdi-chevron-up"></i></span><span class="minus"><i class="zmdi zmdi-chevron-down"></i></span></div>');
            });

            // Spin Buttons actions.
            if ( !$('.woocommerce form .quantity .qty-btn-wrap').length ) {
                $("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").find('input').wrap('<div class="quantity-content"></div>');
                $("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass("buttons_added").find('input').after('<div class="qty-btn-wrap"><span class="plus"><i class="zmdi zmdi-chevron-up"></i></span><span class="minus"><i class="zmdi zmdi-chevron-down"></i></span></div>'), $(document).on("click", ".qty-btn-wrap .plus, .qty-btn-wrap .minus", function() {
                    var t = $(this).closest(".quantity").find(".qty"),
                        a = parseFloat(t.val()),
                        n = parseFloat(t.attr("max")),
                        s = parseFloat(t.attr("min")),
                        e = t.attr("step");
                    a && "" !== a && "NaN" !== a || (a = 0), ("" === n || "NaN" === n) && (n = ""), ("" === s || "NaN" === s) && (s = 0), ("any" === e || "" === e || void 0 === e || "NaN" === parseFloat(e)) && (e = 1), $(this).is(".plus") ? t.val(n && (n == a || a > n) ? n : a + parseFloat(e)) : s && (s == a || s > a) ? t.val(s) : a > 0 && t.val(a - parseFloat(e)), t.trigger("change")
                })
            }
        },

        addToWishlistBtn: function() {

            $('.product').find('.add_to_wishlist').click(function( event ) {

                var addBtn = $(this);

                if ( $(this).hasClass( 'added' ) ) {
                    event.stopPropagation();
                    addBtn.attr( 'href', pureConfig.wishlisturl )
                        .removeAttr( 'rel' );
                } else {
                    addBtn.addClass( 'added' );
                }
            });
        },

        wishlistTfootRemove: function() { $('.wishlist_table').find('tfoot').remove(); },

        dropdownMenusOverflovDefender: function() {

            $(window).bind('load resize', function() {

                var windowWidth = $(window).width();

                if ( windowWidth >= 768 ) {
                    $('header.header .sub-menu').find('.sub-menu').each(function(){
                        var child = $(this);
                        if ( child.offset().left + child.innerWidth() > windowWidth ) {
                            child.css({ transform: 'translateX(-100%)'});
                        }
                    });
                }
            });
        },

        sidebarDropdowns: function() {

            $('.product-categories .open-this').click(function(){

                var children = $(this).siblings('.children');

                $(this).parent().toggleClass('open');
                children.toggleClass('open');

                if ( children.hasClass('open') ) {
                    children.show('fast');
                } else {
                    children.hide('fast');
                }
            });
        },

        woocommerceOrderingForm: function() {

            $( '.woocommerce-ordering' ).find('.wild-options li').click(function(){
                $(this).closest('form').submit();
            });
        },

        priceFilter: function() {

            if ( $('#nonlinear').length ) {

                var nonLinearSlider = document.getElementById('nonlinear');

                noUiSlider.create(nonLinearSlider, {
                    connect: true,
                    behaviour: 'tap',
                    start: [ 100, 500 ],
                    step: 10,
                    range: {
                    'min': 0,
                    'max': 1000,
                    }
                });

                // Write the CSS 'left' value to a span.
                function leftValue ( handle ) {
                    return handle.parentElement.style.left;
                }

                var lowerValue = document.getElementById('lower-value'),
                upperValue = document.getElementById('upper-value'),
                handles = nonLinearSlider.getElementsByClassName('noUi-handle');

                // Display the slider value and how far the handle moved
                // from the left edge of the slider.
                nonLinearSlider.noUiSlider.on('update', function ( values, handle ) {
                    if ( !handle ) {
                        lowerValue.innerHTML = '$' + values[handle];
                    } else {
                        upperValue.innerHTML = '$' + values[handle];
                    }
                });
            }
        },

        productsPerPage: function() {

            var perPageForm = $( '.products_per_page_form' );
            var perPageCookie = 'pure_products_per_page';

            perPageForm.find( '.wild-options li' ).click(function(){
                $(this).closest('form').submit();
            });

            perPageForm.find( 'select option' ).each(function(){
                var option = $(this);
                if ( option.attr( 'value' ) == pureStore.getCookie( perPageCookie ) ) {
                    option.attr( 'selected', 'selected' );
                }
            });

            perPageForm.find( '.wild-select .wild-options li' ).each(function(){
                var option = $(this);
                if ( option.attr( 'data-value' ) == pureStore.getCookie( perPageCookie ) ) {
                    option.attr( 'selected', 'selected' );
                    option.parent().siblings( '.wild-trigger' ).find('.wild-caption').text( option.text() );
                }
            });
        },

        getCookie: function( name ) {

            var value = "; " + document.cookie;
            var parts = value.split("; " + name + "=");

            if (parts.length == 2) {
                return parts.pop().split(";").shift();
            }
            return false;
        },
    }

    jQuery(document).ready(function($) {
        pureStore.init();
    });

})(jQuery);