<?php
/**
 * comments.php
 *
 * The template for displaying comments.
 * ============================================ *
 */
?>
<?php
	## Prevent the direct loading of comments.php.
	if ( ! empty( $_SERVER['SCRIPT-FILENAME'] ) && basename( $_SERVER['SCRIPT-FILENAME'] ) == 'comments.php' ) {
		die( __( 'You cannot access this page directly.', 'pure' ) );
	}
?>

<?php
	## If the post is password protected, display info text and return.
	if ( post_password_required() ): ?>
		<p>
			<?php
				_e( 'This post is password protected. Enter the password to view the comments.', 'pure' );
				return;
			?>
		</p>
	<?php endif;
?>

<!-- ====| Comments Area |==== -->
<div class="comments-area" id="comments">
    <?php if ( have_comments() ): ?>

        <!-- comments -->
		<ul class="comments">
			<?php
				$comments_params = array(
					'max_depth' => 4,
					'avatar_size' => 30
				);
			?>
			<?php wp_list_comments( $comments_params ); ?>
		</ul>

        <?php
			## If the comments are paginated, display the controls.
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ):
		?>
			<!-- comments navigation -->
			<nav class="comment-nav" role="navigation">
				<p class="comment-nav-prev">
					<?php previous_comments_link( __( '&larr; Older Comments', 'pure' ) ); ?>
				</p>
				<p class="comment-nav-next">
					<?php next_comments_link( __( ' Newer Comments &larr;', 'pure' ) ); ?>
				</p>
			</nav><!-- comment-nav -->
		<?php endif; ?>

		<?php
		## If the comments are closed, display an info text.
		if ( ! comments_open() && get_comments_number() ): ?>
			<p class="no-comments">
				<?php _e( 'Comments are closed.', 'pure' ); ?>
			</p>
		<?php endif; ?>
    <?php else: ?>
        <!-- <h2 class="comments-title single-title none">No comments yet</h2> -->
	<?php endif; ?>

	<?php comment_form(); ?>
</div>
