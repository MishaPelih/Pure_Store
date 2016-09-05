<?php
/**
 * footer.php
 *
 * The template for displaying the footer.
 * ============================================ *
 */
?>		</div><!-- /.container -->
		<?php do_action( 'pure_site_content_bottom' ); ?>
	</div><!-- /.site-content -->

	<!--
	======================================================================
	* - Site Footer.
	======================================================================
	-->
	<footer class="site-footer">
		<div class="footer-wrapper container">
			<?php get_sidebar( 'footer' ); ?>
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
