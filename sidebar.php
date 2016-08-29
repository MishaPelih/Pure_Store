<?php
/**
 * sidebar.php
 *
 * The primary sidebar.
 */
?>
<!-- ====| Sidebar |==== -->
<?php if ( is_active_sidebar( 'sidebar-blog' ) ): ?>
	<aside class="sidebar sidebar-blog col-md-3 col-sm-12 col-xs-12" role="complementary">
		<?php dynamic_sidebar( 'sidebar-blog' ); ?>
	</aside><!-- /sidebar -->
<?php endif;
