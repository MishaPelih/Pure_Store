<?php
/**
 * theme-config.php
 * ============================================ *
 */
?>
<?php
	/**
	 * ReduxFramework Redux Config File
	 * For full documentation, please visit: http://docs.reduxframework.com/
	 */
	if ( ! class_exists( 'Redux' ) ) {
		return;
	}

	// This is your option name where all the Redux data is stored.
	$opt_name = "redux_pure";

	// This line is only for altering the demo. Can be easily removed.
	$opt_name = apply_filters( 'redux_pure/opt_name', $opt_name );

	/*
	 *
	 * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
	 *
	 */


	/**
	 * ---> SET ARGUMENTS
	 * All the possible arguments for Redux.
	 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
	 * */

	$theme = wp_get_theme(); // For use with some settings. Not necessary.

	$args = array(
		// TYPICAL -> Change these values as you need/desire
		'opt_name'             => $opt_name,
		// This is where your data is stored in the database and also becomes your global variable name.
		'display_name'         => $theme->get( 'Name' ),
		// Name that appears at the top of your panel
		'display_version'      => $theme->get( 'Version' ),
		// Version that appears at the top of your panel
		'menu_type'            => 'menu',
		//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
		'allow_sub_menu'       => true,
		// Show the sections below the admin menu item or not
		'menu_title'           => __( 'Theme Options', 'pure' ),
		'page_title'           => __( 'Theme Options', 'pure' ),
		// You will need to generate a Google API key to use this feature.
		// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
		'google_api_key'       => '',
		// Set it you want google fonts to update weekly. A google_api_key value is required.
		'google_update_weekly' => false,
		// Must be defined to add google fonts to the typography module
		'async_typography'     => true,
		// Use a asynchronous font on the front end or font string
		//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
		'admin_bar'            => true,
		// Show the panel pages on the admin bar
		'admin_bar_icon'       => 'dashicons-portfolio',
		// Choose an icon for the admin bar menu
		'admin_bar_priority'   => 50,
		// Choose an priority for the admin bar menu
		'global_variable'      => '',
		// Set a different name for your global variable other than the opt_name
		'dev_mode'             => true,
		// Show the time the page took to load, etc
		'update_notice'        => true,
		// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
		'customizer'           => true,
		// Enable basic customizer support
		//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
		//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

		// OPTIONAL -> Give you extra features
		'page_priority'        => null,
		// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
		'page_parent'          => 'themes.php',
		// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
		'page_permissions'     => 'manage_options',
		// Permissions needed to access the options panel.
		'menu_icon'            => '',
		// Specify a custom URL to an icon
		'last_tab'             => '',
		// Force your panel to always open to a specific tab (by id)
		'page_icon'            => 'icon-themes',
		// Icon displayed in the admin panel next to your menu_title
		'page_slug'            => '',
		// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
		'save_defaults'        => true,
		// On load save the defaults to DB before user clicks save or not
		'default_show'         => false,
		// If true, shows the default value next to each field that is not the default value.
		'default_mark'         => '',
		// What to print by the field's title if the value shown is default. Suggested: *
		'show_import_export'   => true,
		// Shows the Import/Export panel when not used as a field.

		// CAREFUL -> These options are for advanced use only
		'transient_time'       => 60 * MINUTE_IN_SECONDS,
		'output'               => true,
		// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
		'output_tag'           => true,
		// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
		// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

		// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
		'database'             => '',
		// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
		'use_cdn'              => true,
		// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

		// HINTS
		'hints'                => array(
			'icon'          => 'el el-question-sign',
			'icon_position' => 'right',
			'icon_color'    => 'lightgray',
			'icon_size'     => 'normal',
			'tip_style'     => array(
				'color'   => 'red',
				'shadow'  => true,
				'rounded' => false,
				'style'   => '',
			),
			'tip_position'  => array(
				'my' => 'top left',
				'at' => 'bottom right',
			),
			'tip_effect'    => array(
				'show' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'mouseover',
				),
				'hide' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'click mouseleave',
				),
			),
		)
	);

	Redux::setArgs( $opt_name, $args );

	/*
	 * ---> END ARGUMENTS
	 */

	/*
	 *
	 * ---> START SECTIONS
	 *
	 */

	/**
	 * General.
	 */
	Redux::setSection( $opt_name, array(
        'title' => __( 'General', 'pure' ),
        'id' => 'general',
        'icon' => 'el-icon-home',
    ) );

    Redux::setSection( $opt_name, array(
        'title' => 'Header Settings',
        'id' => 'general-header_settings',
        'icon' => 'el-icon-cog',
        'subsection' => true,
        'fields' => array (
            array(
                'id'       => 'fixed_header_enabled',
                'type'     => 'switch',
                'title'    => __( 'Enable Fixed Header', 'pure' ),
                'default'  => true
            ),
            array(
                'id' => 'header_overlap',
                'type' => 'switch',
                'title' => __( 'Header overlaps the content', 'pure' ),
                'default' => false,
            ),
            array(
                'id' => 'header_color',
                'type' => 'select',
                'title' => __( 'Header text color', 'pure' ),
                'options' => array(
                    'dark' => __( 'Dark', 'pure' ),
                    'white' => __( 'White', 'pure' ),
                ),
                'default' => 'white'
            ),
            array(
                'id' => 'header_bg',
                'type' => 'background',
                'title' => __( 'Header background', 'pure' ),
                'output' => array('.header-wrapper:not(.header-type-transparent)')
            ),
            array(
	            'id' => 'enable_top_bar',
	            'type' => 'switch',
	            'title' => __( 'Enable top bar', 'pure' ),
	            'default' => true,
            ),
            array(
                'id' => 'top_bar_bg',
                'type' => 'background',
                'title' => __( 'Top bar background', 'pure' ),
                'output' => array('.header-wrapper:not(.header-type-transparent) .top-bar')
            ),
            array(
                'id' => 'top_bar_color',
                'type' => 'select',
                'title' => __( 'Top bar text color', 'pure' ),
                'options' => array(
                    'dark' => __( 'Dark', 'pure' ),
                    'white' => __( 'White', 'pure' ),
                ),
                'default' => 'white'
            ),
            array(
                'id'       => 'logo_header_main',
                'type'     => 'media',
                'title'    => __( 'Logo image', 'pure' ),
                'desc'     => __( 'Upload image: png, jpg or gif file.', 'pure' ),
                'default'  => ''
            ),
            array(
                'id'       => 'logo_header_fixed',
                'type'     => 'media',
                'title'    => __( 'Logo image for fixed header', 'pure' ),
                'desc'     => __( 'Upload image: png, jpg or gif file.', 'pure' ),
                'default'  => ''
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => 'Header Type',
        'id' => 'general-header',
        'icon' => 'el-icon-cog',
        'subsection' => true,
        'fields' => array (
            array(
				'id'       => 'header_type',
				'type'     => 'button_set',
				'title'    => __( 'Header type', 'pure' ),
				'desc'     => '',
				'options' => array(
					'header-1' => __( 'Header 1', 'pure' ),
					'header-2' => __( 'Header 2', 'pure' ),
					'header-transparent' => __( 'Transparent Header', 'pure' ),
				),
				'default'  => 'header-1'
			),
        ),
    ) );


	/**
	 * E-commerce
	 */
	Redux::setSection( $opt_name, array(
        'title' => __( 'E-Commerce', 'pure' ),
        'id' => 'shop',
        'icon' => 'el-icon-shopping-cart',
    ));

    Redux::setSection( $opt_name, array(
        'title' => __( 'Products Page Layout', 'pure' ),
        'id' => 'shop-product_page_layout',
        'icon' => 'el-icon-view-mode',
        'subsection' => true,
        'fields' => array (
            array(
				'id'       => 'products_per_row',
				'type'     => 'button_set',
				'title'    => __( 'Products per row', 'pure' ),
				'desc'     => '',
				'options' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
				'default'  => '3'
			),
			array(
                'id'       => 'shop_sidebar_position',
                'type'     => 'button_set',
                'title'    => __( 'Sidebar position', 'pure' ),
                'desc'     => '',
				'options' => array(
			        'left' => __( 'Left', 'pure' ),
			        'right' => __( 'Right', 'pure' ),
			        'disable' => __( 'Disable', 'pure' ),
			    ),
                'default' => 'left'
            ),
        ),
    ));


	/**
	 * Blog
	 */
	Redux::setSection( $opt_name, array(
        'title' => __( 'Blog', 'pure' ),
        'id' => 'blog',
        'icon' => 'el-icon-wordpress',
    ));

    Redux::setSection( $opt_name, array(
        'title' => __( 'Blog Layout', 'pure' ),
        'id' => 'blog-blog_layout',
        'subsection' => true,
        'icon' => 'el-icon-wordpress',
        'fields' => array (
            array(
				'id'       => 'posts_per_row',
				'type'     => 'button_set',
				'title'    => __( 'Posts per row', 'pure' ),
				'desc'     => '',
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'default'  => '3'
			),
            array(
                'id'       => 'blog_sidebar_position',
                'type'     => 'button_set',
                'title'    => __( 'Blog sidebar position', 'pure' ),
                'desc'     => '',
				'options' => array(
			        'left' => __( 'Left', 'pure' ),
			        'right' => __( 'Right', 'pure' ),
			        'disable' => __( 'Disable', 'pure' ),
			    ),
                'default' => 'left'
            ),
        ),
    ));