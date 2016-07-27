<?php
/**
 * footer.php
 *
 * The template for displaying the footer.
 * ============================================ *
 */
?>
		</div><!-- /.container -->
	</div><!-- /.site-content -->

	<!--
	======================================================================
	* - Site Footer.
	======================================================================
	-->
	<footer class="site-footer">
		<div class="footer-wrapper container">

			<!-- *======#| Sidebar-footer. |#======* -->
			<aside class="sidebar-footer">
				<div class="row">

					<?php // get_sidebar( 'footer' ); ?>

				</div><!-- /.row -->
			</aside><!-- /.sidebar-footer -->

		</div><!-- /.footer-wrapper -->
	</footer><!-- /.site-footer -->

	<!--
	======================================================================
	* - Footer Bottom.
	======================================================================
	-->
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="copyright">
						<?php // get_sidebar( 'copyright' ); ?>
					</div>
				</div>
				<div class="col-md-6 payment-methods">
					<div class="widget widget_text">
						<img src="<?php echo PURE_IMAGES_DIR; ?>/pay-pal.jpg" alt="">
					</div>
				</div>
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.footer-bottom -->

</div><!-- /.site-wrap -->

<?php wp_footer(); ?>