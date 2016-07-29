<?php
/**
 * index.php
 *
 * The main template file.
 * ============================================ *
 */
?>

	<?php get_header(); ?>

	<div class="row">

		<!-- ====| Main Content |==== -->
		<div class="content-page blog <?php echo pure_main_content_classes(); ?>" role="main">
			<div class="entry-content">

				<div class="row row-count-2">
					<?php if ( have_posts() ): ?>

						<?php while( have_posts() ): the_post(); ?>
							<div class="col-md-6">
								<?php get_template_part( 'content', get_post_format() ); ?>
							</div>
						<?php endwhile; ?>

						<?php pure_paging_nav(); ?>

					<?php else: ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif ?>

				</div><!-- /.row -->
			</div><!-- /.entry-content -->
		</div><!-- /.content-page -->

		<?php pure_enable_sidebar() ? get_sidebar() : null; ?>

	</div><!-- /.row -->

	<?php get_footer(); ?>
