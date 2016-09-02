<div class="header-wrapper transparent">

	<?php get_template_part('headers/parts/top-bar'); ?>

	<!-- *======#| Header |#======* -->
	<header class="header site-header">
		<div class="container">
			<div class="container-wrap">

				<!-- Logo -->
				<div class="header-logo">
					<a href="index.php">
						<img src="<?php echo pure_get_logo_url(); ?>" alt="">
					</a>
				</div><!-- /.header-logo -->

				<!-- Navigation -->
				<div class="menu-wrap">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'main',
								'menu_class' => 'menu menu-main',
								'menu_id' => 'menu-main',
								'container_class' => 'menu-main-container',
							)
						);
					?>
				</div><!-- /.menu-wrap -->

				<!-- Search -->
				<div class="site-search">
					<form role="search" action="#" method="get" id="searchform" class="searchform">
				        <!-- <input type="hidden" name="post_type" class="search-type" value="post"> -->
				        <input type="text" name="s" id="search-content" class="search-content" placeholder="Search" />
				        <button type="submit" class="searchsubmit">
				        	<i class="zmdi zmdi-search"></i>
				        </button>
					</form>
				</div>

				<!-- Open Mobile Menu Button -->
				<button type="button" class="open-mobile-menu">
					<i class="zmdi zmdi-menu"></i>
				</button>

			</div><!-- /.container-wrap -->
		</div><!-- /.container -->
	</header><!-- /site-header -->

	<?php if( pure_get_redux_option( 'fixed_header_enabled' ) && pure_get_redux_option( 'fixed_header_enabled' ) !== false ):
		get_header( 'fixed' );
	endif; ?>

	<!-- *======#| Mobile Menu |#======* -->
	<div class="ps-mobile-menu">
		<div class="mobile-menu-content">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'mobile',
						'menu_class' => 'menu menu-mobile',
						'menu_id' => 'menu-mobile',
						'container_class' => 'menu-mobile-container',
					)
				);
			?>
		</div><!-- /.mobile-menu-content -->
	</div><!-- /.ps-mobile-menu -->
	<div class="close-mobile-menu-full-screen"></div>

</div><!-- /.header-wrapper -->