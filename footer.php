<?php
/**
 * footer.php
 * The template for displaying the footer.
 * ============================================ *
*/

do_action( 'pure_site_content_bottom' );

echo '</div><!-- /.site-content -->';

pure_get_sidebar( 'footer' );
pure_get_sidebar( 'copyright' );

echo '</div><!-- /.site-wrap -->';

wp_footer();