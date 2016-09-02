<?php
/**
  * sidebar-copyright.php
  * ============================================ *
  */
?>
<?php 
	$wr_c_left = 'widgetarea-copyright-left';
	$wr_c_right = 'widgetarea-copyright-right';
	
	if ( is_active_sidebar( $wr_c_left ) || is_active_sidebar( $wr_c_right ) ): ?>

		<?php if ( is_active_sidebar( $wr_c_left ) ):  ?>
			<div class="col-md-6 copyright-left">
				<?php dynamic_sidebar( $wr_c_left ); ?>
			</div>
		<?php endif; ?>
		<?php if ( is_active_sidebar( $wr_c_right ) ):  ?>
			<div class="col-md-6 copyright-right">
				<?php dynamic_sidebar( $wr_c_right ); ?>
			</div>
		<?php endif; ?>

	<?php endif;
