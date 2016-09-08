<?php if ( pure_get_redux_option( 'enable_top_bar' ) ): ?>

	<!-- *======#| Top-bar menu |#======* -->
	<?php $tb_txt_color = pure_get_redux_option( 'top_bar_color' ); ?>
	<div class="top-bar<?php pure_top_bar_classes(); ?>">
		<div class="container">
			<div class="top-bar-content">

				<div class="top-bar-left top-bar-part">
	                <?php pure_get_sidebar( 'topbar-left' ); ?>
				</div><!-- /.languages-area -->

				<div class="top-bar-right top-bar-part">

					<?php pure_get_sidebar( 'topbar-right' ); ?>

					<div class="site-header-cart menu-parent-item">

						<?php if ( pure_is_woo_exists() ): ?>
							<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="cart-contents within-inline cart-quantity">
				                <i class="zmdi zmdi-shopping-basket"></i>
				                <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count();?></span>
				            </a>
							<?php if ( !is_cart() ): ?>
								<div class="widget_shopping_cart_content shopping-cart-content sub-menut"></div>
							<?php endif; ?>
						<?php endif; ?>
					</div><!-- /.site-header-cart -->

				</div><!-- /.top-links -->

			</div><!-- /.top-bar-content -->
		</div><!-- /.container -->
	</div><!-- /.top-bar -->
<?php endif ?>