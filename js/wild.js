;(function( $ ) {

    'use strict';

	/**
     * - Wild Select - jQuery plugin.
     * ========================================================== *
     *
     * @author Misha Pelykh
     * @version 1.3.0
     */

	$.fn.wildSelect = function( options )
	{
		/* Options.
		============================== */
		var settings = $.extend({
			animation: false,
			animationSpeed: 0.2,
			dropdownIcon: 'default',
			wrapClass: false,
		}, options );

		/* Global Variables.
		============================== */
		var allDefaultSelects = $(this),
		allWildTriggers,
		allWildOptions,
		wildSelect,
		wildWrapHTML,
		triggerHTML;

        // Hide raw selects.
		allDefaultSelects.css('display','none');

        // Create select wrapper and push it into variable.
		wildWrapHTML = '<div class=\"wild-select wild-area';
		if ( typeof settings.wrapClass === 'string' )
		{
			wildWrapHTML += ' ' + settings.wrapClass
				.replace(/\s+/g, ' ')
				.replace(/^\s|\s$/g, '')
				.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g,'');
		}
		wildWrapHTML += '\"></div>';
		allDefaultSelects.wrap(wildWrapHTML);
		wildSelect = allDefaultSelects.parent();

		// Add the wild select after default select.
		allDefaultSelects.after('<ul class="wild-options"></ul>');
		allWildOptions = allDefaultSelects.siblings( 'ul.wild-options' );

		// Add a trigger.
		triggerHTML = '<div class="wild-trigger"><span class="caption"></span>';
		if ( typeof settings.dropdownIcon === 'string' )
		{
			var dropdownIcon = settings.dropdownIcon;
			if ( dropdownIcon == 'default' ) {
				dropdownIcon = '<i class="fa fa-angle-down"></i>';
			}
			triggerHTML += '<span class="icon">' + dropdownIcon + '</span>';
		}
		triggerHTML += '</div>';
		allDefaultSelects.after(triggerHTML);
		allWildTriggers = allDefaultSelects.siblings( 'div.wild-trigger' );

		// Option: Animation.
		$(document).ready(function() {
			if ( settings.animation ) {
				switch ( settings.animation ) {

					case 'opacity':
						wildSelect.addClass( 'animation-opacity' );
						break;

					case 'flyUp':
						wildSelect.addClass( 'animation-fly-up' );
						break;
				}
			}
		});

		// Option: Animation Speed.
		if ( typeof settings.animationSpeed === 'number' && settings.animationSpeed >= 0 ) {
			allWildOptions.css({
				'transition': 'all ' + settings.animationSpeed + 's linear'
			});
			allWildTriggers.css({
				'transition': 'all ' + settings.animationSpeed + 's linear'
			});
		}

		//If Wild select is open on click on window hide this.
		$(window).click(function( event ) {
			if ( allWildOptions.hasClass('open') ) {
				allWildTriggers.removeClass( 'open' );
				allWildOptions.removeClass( 'open' );
			}
		});

		// For each Wild Select loop.
		allDefaultSelects.each(function(i) {

			var defaultSelect = $(this);
			var wildOptions = defaultSelect.siblings('ul.wild-options');
			var wildTrigger = defaultSelect.siblings('.wild-trigger');

			wildTrigger.find('.caption').text(
				defaultSelect.find('option').filter(':first-child').text()
			);

			wildTrigger.click(function( event )
			{
				event.stopPropagation();
				$('.wild-select div.wild-trigger.open').not($(this)).removeClass( 'open' );
				$('.wild-select ul.wild-options.open').not($(this).siblings('ul.wild-options.open'))
					.removeClass( 'open' );
				wildTrigger.toggleClass( 'open' );
				wildOptions.toggleClass( 'open' );
			});

			// For each select option loop.
			defaultSelect.find('option').each(function(j)
			{
				var defaultOption = $(this);
				var defaultOptionText = defaultOption.text();
				var defaultOptionValue = defaultOption.attr( 'value' );

				if ( defaultOptionValue || defaultOptionValue == '' ) {
					wildOptions.append(
						'<li data-value="' + defaultOptionValue + '">' + defaultOptionText + '</li>'
					);
				} else {
					wildOptions.append(
						'<li>' + defaultOptionText + '</li>'
					);
				}
			});

			// On wild-select > option click action.
			wildOptions.find('li').click(function( event ) {

				event.stopPropagation();

				var wildOption = $(this);
				var wildOptionText = wildOption.text();
				var wildOptionValue = wildOption.attr( 'data-value' );

				addSelectedAttr( function() {

					var filter;

					if ( wildOptionValue || wildOptionValue == '' ) {
						filter = '[value="'+ wildOptionValue +'"]';
					} else {
						filter = ':contains("'+ wildOptionText +'")';
					}
					return defaultSelect.find('option').filter(filter);
				});

				wildOptions.removeClass( 'open' );
				wildTrigger.removeClass( 'open' );
				wildTrigger.find('.caption').text( wildOptionText );
			});
		});


		/* Functions.
		============================== */

		// Add attr 'selected' to option and remove it in current option.
		function addSelectedAttr( element ) {
			var preparedElement;
			typeof element === 'function' ? preparedElement = element() : preparedElement = element;
			preparedElement.attr("selected", "selected").siblings().removeAttr('selected');
		}

		return this;
	};

})(jQuery);