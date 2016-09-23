<?php
/**
 * index.php
 *
 * The main template file.
 * ============================================ *
 */
?>
<?php get_header(); ?>

<div class="container page-container">
	<div class="row">

		<!-- ====| Main Content |==== -->
		<div class="content-page blog <?php echo pure_main_content_classes(); ?>" role="main">
			<div class="entry-content">
				
				<?php if ( have_posts() ): ?>

					<div class="<?php echo pure_get_posts_classes( array( 'row' ) ); ?>">

						<?php while( have_posts() ): the_post(); ?>
							<?php get_template_part( 'content', get_post_format() ); ?>
						<?php endwhile; ?>

					</div><!-- /.row -->

					<?php pure_paging_nav(); ?>

				<?php else: ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>

			</div><!-- /.entry-content -->
		</div><!-- /.content-page -->

		<?php pure_enable_sidebar() ? get_sidebar() : null; ?>

	</div><!-- /.row -->
</div><!-- /.page-container -->

<?php get_footer(); ?>