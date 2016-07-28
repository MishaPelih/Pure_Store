<?php
/**
  * sidebar-footer.php
  * ============================================ *
  */ 
?>

<?php if ( 
		is_active_sidebar( 'widgetarea-footer-1' ) ||
		is_active_sidebar( 'widgetarea-footer-2' ) ||
		is_active_sidebar( 'widgetarea-footer-3' ) ||
		is_active_sidebar( 'widgetarea-footer-4' )
	): ?>

	<!-- *======#| Sidebar-footer. |#======* -->
	<aside class="sidebar-footer" role="complementary">
		<div class="row">
			<?php for ( $i=1; $i <= 4; $i++ ) 
	 		{ 
	 			if ( is_active_sidebar( 'widgetarea-footer-' . $i ) ) {
	 				dynamic_sidebar( 'widgetarea-footer-' . $i );
	 			}
	 		}
			?>
		</div>
	</aside><!-- /sidebar -->

<?php endif;
