<?php
/**
 * header.php.
 *
 * The Header for theme.
 * ============================================ *
 */
?>
<!DOCTYPE html>
<!--[if IE 8]><html <?php language_attributes(); ?> class="ie8"><![endif]-->
<!--[if !IE]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="description" content="<?php bloginfo( 'description' ) ?>">
	<!-- Mobile specific meta -->
	<meta name="viewport" content="width=device-width, initioal-scale=1, maximum-scale=1.5">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<!-- Site wrapper -->
	<div class="site-wrap">

		<div class="header-wrapper main">

			<!-- *======#| Top-bar menu |#======* -->
			<div class="top-bar">
				<div class="container">
					<div class="top-bar-content">

						<div class="top-bar-left top-bar-part">

			                <?php if ( is_active_sidebar( 'widgetarea-topbar-left' ) ): ?>
			                	<?php dynamic_sidebar( 'widgetarea-topbar-left' ); ?>
			                <?php endif; ?>

						</div><!-- /.languages-area -->

						<div class="top-bar-right top-bar-part">

							<?php if ( is_active_sidebar( 'widgetarea-topbar-right' ) ): ?>
			                	<?php dynamic_sidebar( 'widgetarea-topbar-right' ); ?>
			                <?php endif; ?>

							<div class="site-header-cart">
								<?php if ( pure_is_woo_exists() ): ?>
									<div class="site-header-cart-content-wrap">
										<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="cart-contents within-inline cart-quantity">
											<i class="zmdi zmdi-shopping-basket"></i>
											<span class="cart-count">3</span>
										</a>
										<?php if ( !is_cart() ): ?>
											<!-- <div class="widget_shopping_cart_content shopping-cart-content"></div> -->
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div><!-- /.site-header-cart -->

						</div><!-- /.top-links -->

					</div><!-- /.top-bar-content -->
				</div><!-- /.container -->
			</div><!-- /.top-bar -->

			<!-- *======#| Header |#======* -->
			<header class="header">
				<div class="container">
					<div class="container-wrap">

						<!-- Logo -->
						<div class="header-logo">
							<a href="index.php">
								<img src="<?php echo PURE_IMAGES_DIR; ?>/logo-main.png" alt="">
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

			<?php get_header( 'fixed' ); ?>
		
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

		<?php pure_get_breadcrumbs(); ?>

		<!-- ====| Main content area |==== -->
		<div class="site-content" id="content">
			<div class="container">