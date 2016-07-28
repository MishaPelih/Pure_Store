;'use strict';


(function() {

	jQuery(document).ready(function($) 
	{
		/**
		 * ===================================================================
		 * - Mobile Menu.
		 * ===================================================================
		 */
		$('.open-mobile-menu').click(function() {
			$('body').toggleClass('mobile-menu-open');	
		});

		$('.close-mobile-menu, .close-mobile-menu-full-screen').click(function() {
			$('body').toggleClass('mobile-menu-open');	
		});


		/**
		 * ===================================================================
		 * - Site Searchform onfocus event.
		 * ===================================================================
		 */
		$('.site-search .searchform').find('input').focus(function(){
			$(this).parent().addClass( 'focused' );
		});
		$('.site-search .searchform').find('input').focusout(function(){
			$(this).parent().removeClass( 'focused' );
		});


		/**
		 * ===================================================================
		 * - Fixed Header.
		 * ===================================================================
		 */
		$(window).scroll(function()
		{
			var header = $('header.header.fixed');

			if ( $(window).scrollTop() >= $('.header-wrapper').innerHeight() )
			{
			   header.addClass('active');
			   wpadminbarHeightOffset();
			} else
			{
				header.removeClass('active');
				header.css({ 'top': '' });
			}
		});

		$(window).resize(function(){ wpadminbarHeightOffset() });

		var wpadminbarHeightOffset = function()
		{
			if ( $( '#wpadminbar' ).length ) {
				$( 'header.header.fixed.active' ).css( 'top', function()
				{
					if ( $( '#wpadminbar' ).css( 'position' ) == 'fixed' ) {
						return $( '#wpadminbar' ).innerHeight() + 'px';
					}
					return '';
				});
			}
		}


		/**
		 * ===================================================================
		 * - Radiogroups.
		 * ===================================================================
		 */
		$('.ps-radiogroup li label').click(function(){
			var label = $(this);
			label.closest('.ps-radiogroup').find('li')
				.each(function(){
					$(this).find('input').removeAttr('checked');
				});
			label.siblings('input').attr( 'checked', 'checked' );
		});


		/**
		 * ===================================================================
		 * - Dropdowns in Checkout page.
		 * ===================================================================
		 */
		$('.fade-area').find('.fade-content').css('display', 'none');

		$('.fade-area').find('.fade-trigger').click(function()
		{
			var content = $(this).siblings('.fade-content');
			var parent = content.parent();

			parent.toggleClass('open');

			if ( parent.hasClass('open') ) {
				content.show('medium');
			} else {
				content.hide('medium');
			}
		});


		/**
		 * ===================================================================
		 * - Removing products in Cart page.
		 * ===================================================================
		 */
		$('.product-remove a').click(function( event ){
			event.preventDefault();
			$(this).closest('.cart_item').remove();
			if ( !$.trim( $('.cart tbody').html() ) ) { 
				$('table.cart').remove();
				$('.cart-form').prepend('<div class="woocommerce-message">Cart is empty <a href="?page=shop" class="button">Go to shop</a></div>');
			}
			giveNumbers();
		})

		giveNumbers();

		function giveNumbers()
		{
			$('.cart_item').each(function(){
				$(this).find('.product-number').text( $(this).index() + 1 );
			});
		}


		/**
		 * ===================================================================
		 * - Your mark (Rating).
		 * ===================================================================
		 */
		$('.stars span').click(function(){
			$(this).parent().addClass('selected');
			$(this).addClass('active').siblings('.active').removeClass('active');
		});


		/**
		 * ===================================================================
		 * - Spin Buttons for Cart page.
		 * ===================================================================
		 */

		/* Add spin buttons after AJAX request has been stopped.
		------------------------------------------------*/
		$( document ).ajaxStop(function() {
			$("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").find('input').wrap('<div class="quantity-content"></div>');
			$("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass("buttons_added").find('input').after('<div class="qty-btn-wrap"><span class="plus"><i class="zmdi zmdi-chevron-up"></i></span><span class="minus"><i class="zmdi zmdi-chevron-down"></i></span></div>');
		});

		/* Spin Buttons actions.
		------------------------------------------------*/
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

		
		/**
		 * ===================================================================
		 * - Slick carousel initialisation.
		 * ===================================================================
		 */
		$('.slick-thumbnails').slick({
			infinite: true,
			slidesToShow: 4,
			slidesToScroll: 1,
			vertical: true,
			speed: 170,
			verticalSwiping: true,
			arrows: false
		});

		
		/**
		 * ===================================================================
		 * - Custom scroll init.
		 * ===================================================================
		 */
		$('.widget_layered_nav.filter_color ul').customScroll();
		$('.ps_widget_brands ul').customScroll();

		
		/**
		 * ===================================================================
		 * - Price filter init.
		 * ===================================================================
		 */
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

		
		/**
		 * ===================================================================
		 * - Dropdown with 'show' animation..
		 * ===================================================================
		 */
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

		
		/**
		 * ===================================================================
		 * - Change posts layout.
		 * ===================================================================
		 */
		$('.switch-option').click(function(event){
			event.preventDefault();
			var option = $(this);
			option.toggleClass('active');
			option.siblings('.active').not(option).toggleClass('active');
			if ( option.hasClass('grid-view') ) {
				$('.products-list').addClass('products-grid').removeClass('products-list');
			} else {
				$('.products-grid').addClass('products-list').removeClass('products-grid');
			}
		});


		/**
		 * ===================================================================
		 * - Wild select init.
		 * ===================================================================
		 */
		$('.wild-select').wildSelect({
			animation: 'flyUp',
			dropdownIcon: '<i class="zmdi zmdi-chevron-down"></i>'
		});


		/**
		 * ===================================================================
		 * - Map options.
		 * ===================================================================
		 */
		$(document).ready(function(){
			$('.map-wrap .map').find('iframe').css("pointer-events", "none");
		});

		var onMapMouseleaveHandler = function(event) {
			var that = $(this);
			that.on('click', onMapClickHandler);
			that.off('mouseleave', onMapMouseleaveHandler);
			that.find('iframe').css("pointer-events", "none");
		}

		var onMapClickHandler = function(event) {
			var that = $(this);
			that.off('click', onMapClickHandler);
			that.find('iframe').css("pointer-events", "auto");
			that.on('mouseleave', onMapMouseleaveHandler);
		}

		$('.map-wrap .map').on('click', onMapClickHandler);


		/**
		 * ===================================================================
		 * - OWL Carousel elements init.
		 * ===================================================================
		 */
		var popupOpen = true;

		$( '.site-slider' ).owlCarousel({
			items: 1,
			loop: true,
			nav: true,
			navText: ['<i class="zmdi zmdi-chevron-left"></i>','<i class="zmdi zmdi-chevron-right"></i>']
		});

		$( '.fullscreen-slider' ).owlCarousel({
			items: 1,
			loop: true,
			dots: true
		});

		$( '.owl-products .products' ).owlCarousel({
			touchDrag: true,
		    // mouseDrag: false,
			items: 4,
			loop: true,
			nav: true,
			dots: false,
			margin: 30,
			navText: ['<i class="zmdi zmdi-chevron-left"></i>','<i class="zmdi zmdi-chevron-right"></i>']
		});

		$( '.partners-area .partners' ).owlCarousel({
			items: 5,
			loop: true,
			nav: true,
			dots: false,
			margin: 30,
			navText: ['<i class="zmdi zmdi-chevron-left"></i>','<i class="zmdi zmdi-chevron-right"></i>']
		}); 

		$('.show-quickly').magnificPopup({
			type: 'image',
			closeOnContentClick: true,
			closeBtnInside: false,
			fixedContentPos: true,
			mainClass: 'mfp-no-margins mfp-with-zoom',
			image: {
				verticalFit: true
			},
			zoom: {
				enabled: true,
				duration: 300
			},
			disableOn: function() {
				return window.popupOpen;
			}
		});

		/* Function which disable popup when you dragging the carousel
		---------------------------------------*/
		$('.show-quickly').mousedown(function(e) {
			window.popupOpen = true;
			var mouseStartCoords = e.pageX; 
			$(this).mouseup(function(e) { 
				// var timeStart = performance.now();
				var mouseEndCoords = e.pageX; 
				if( mouseStartCoords != mouseEndCoords ){ 
					window.popupOpen = false;
				} else {
					window.popupOpen = true;
				}
				// var timeEnd = performance.now();
				// console.log( timeEnd - timeStart );
			}); 
		});
	});

})();