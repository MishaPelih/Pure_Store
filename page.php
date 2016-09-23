<?php
/**
 * page.php
 *
 * The template for displaying all pages.
 * ============================================ *
 */
?>
<?php get_header(); ?>

<div class="container page-container">
   <div class="row">
      <div class="content-page <?php echo pure_main_content_classes(); ?>" role="main">

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

      <?php pure_enable_sidebar() ? get_sidebar() : null; ?>

   </div><!-- /.row -->
</div><!-- /.page-container -->

<?php get_footer(); ?>