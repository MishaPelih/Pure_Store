<?php
/**
 * header-fixed.php
 * ============================================ *
 */
?>
<?php if( pure_get_redux_option( 'fixed_header_enabled' ) && pure_get_redux_option( 'fixed_header_enabled' ) !== false ): ?>
<!-- *======#| Header Fixed |#======* -->
<header class="header fixed-header fixed">
	<div class="container">
		<div class="container-wrap">
			<?php pure_logo_tpl( 'fixed' ); ?>
			<?php pure_get_menu(); ?>
		</div><!-- /.container-wrap -->
	</div><!-- /.container -->
</header><!-- /fixed-header -->
<?php endif; ?>