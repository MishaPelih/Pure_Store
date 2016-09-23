<?php
/**
 * footer.php
 *
 * The template for displaying the footer.
 * ============================================ *
 */
?>
      <?php do_action( 'pure_site_content_bottom' ); ?>
   </div><!-- /.site-content -->

   <?php pure_get_sidebar( 'footer' ); ?>
   <?php pure_get_sidebar( 'copyright' ); ?>

</div><!-- /.site-wrap -->

<?php wp_footer(); ?>