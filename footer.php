<?php
/**
 * footer.php
 *
 * The template for displaying the footer.
 * ============================================ *
 */
?>		</div><!-- /.container -->
	</div><!-- /.site-content -->

	<!--
	======================================================================
	* - Site Footer.
	======================================================================
	-->
	<footer class="site-footer">
		<div class="footer-wrapper container">
			<div class="row">

				<?php get_sidebar( 'footer' ); ?>

			</div><!-- /.row -->

		</div><!-- /.footer-wrapper -->
	</footer><!-- /.site-footer -->

	<!--
	======================================================================
	* - Footer Bottom.
	======================================================================
	-->
	<div class="footer-bottom">
		<div class="container copyright">
			<div class="row">

				<?php get_sidebar( 'copyright' ); ?>

			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.footer-bottom -->

</div><!-- /.site-wrap -->

<?php wp_footer(); ?>
