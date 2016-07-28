<?php
/**
  * sidebar-copyright.php
  * ============================================ *
  */ 
?>

<?php if ( 
		is_active_sidebar( 'widgetarea-copyright-left' ) ||
		is_active_sidebar( 'widgetarea-copyright-right' )
	): ?>

	<?php if ( is_active_sidebar( 'widgetarea-copyright-left' ) ):  ?>
		<div class="col-md-6 copyright-left">
			<?php dynamic_sidebar( 'widgetarea-copyright-left' ); ?>
		</div>
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'widgetarea-copyright-right' ) ):  ?>
		<div class="col-md-6 copyright-right">
			<?php dynamic_sidebar( 'widgetarea-copyright-right' ); ?>
		</div>
	<?php endif; ?>

<?php endif;
