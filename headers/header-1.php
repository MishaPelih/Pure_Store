<div class="header-wrapper header-type-1<?php pure_header_classes(); ?>">

	<?php get_template_part('headers/parts/top-bar'); ?>

	<!-- *======#| Header |#======* -->
	<header class="header site-header">
		<div class="container">
			<div class="container-wrap">

				<?php if ( pure_get_logo_url() ): ?>
					<!-- Logo -->
					<div class="header-logo">
						<a href="index.php">
							<img src="<?php echo pure_get_logo_url(); ?>" alt="">
						</a>
					</div><!-- /.header-logo -->
				<?php endif; ?>

				<?php pure_get_menu(); ?>

				<?php pure_site_search_tpl(); ?>

				<?php pure_mobile_menu_tpl( 'switcher' ); ?>

			</div><!-- /.container-wrap -->
		</div><!-- /<div class="c"></div>ontainer -->
	</header><!-- /site-header -->

	<?php get_header( 'fixed' ); ?>

	<?php pure_mobile_menu_tpl(); ?>

</div><!-- /.header-wrapper -->