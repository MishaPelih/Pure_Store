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
		<div class="content-page blog col-md-9" role="main">
			<div class="blog-post">

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
			</div><!-- /.blog-post -->
		</div><!-- /.main-content -->

		<?php get_sidebar(); ?>

	</div><!-- /.row -->

	<?php get_footer(); ?>