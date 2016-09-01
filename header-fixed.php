<?php
/**
 * header-fixed.php
 * ============================================ *
 */
?>
<!-- *======#| Header Fixed |#======* -->
<header class="header fixed">
	<div class="container">
		<div class="container-wrap">

			<!-- Logo -->
			<div class="header-logo">
				<a href="index.php">
					<img src="<?php echo pure_get_logo_url( 'fixed' ); ?>" alt="">
				</a>
			</div><!-- /.header-logo -->

			<!-- Navigation -->
			<div class="menu-wrap">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'main',
							'menu_class' => 'menu menu-fixed',
							'menu_id' => 'menu-fixed',
							'container_class' => 'menu-fixed-container',
						)
					); 
				?>
			</div><!-- /.menu-wrap -->
		</div><!-- /.container-wrap -->
	</div><!-- /.container -->
</header><!-- /fixed-header -->