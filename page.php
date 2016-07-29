<?php
/**
 * page.php
 *
 * The template for displaying all pages.
 * ============================================ *
 */
?>

<?php get_header(); ?>

	<div class="row">
		<div class="content-page col-md-9" role="main">

			<!-- ====| Entry-content |==== -->
			<div class="entry-content">
				<?php while( have_posts() ): the_post(); ?>
					<?php
						the_content();
						// wp_link_pages();
					?>
				<?php endwhile; ?>
			</div><!-- /.entry-content -->
		</div><!-- /.content-page -->

		<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>
