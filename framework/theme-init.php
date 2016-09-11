<?php
/**
 * framework/theme-init.php
 *
 * Framework setup.
 * ============================================ *
 */ 
?>
<?php
	add_action( 'wp_head', 'pure_init' );
	if ( !function_exists( 'pure_init' ) ) {
		function pure_init() { 
			$_out_css = '<style type="text/css">';

			$logo_width = pure_get_redux_option( 'logo_width' );
			$_out_css .= 'header.site-header .header-logo { max-width: ' . $logo_width . 'px; }';

			$_out_css .= "</style>\r\n";
			echo $_out_css;
		}
	}