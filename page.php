<?php
/**
 * page.php
 * The template for displaying all pages.
 * ============================================ *
 */
?>
<?php get_header(); ?>

<div class="container page-container">

    <?php if ( !pure_page_without_sidebar() ) echo '<div class="row">'; ?>

    <div class="content-page<?php echo pure_main_content_classes(); ?>" role="main">
        <?php while( have_posts() ): 
            the_post();
            the_content();
            // wp_link_pages();
        endwhile; ?>
    </div><!-- /.content-page -->

    <?php pure_enable_sidebar() ? get_sidebar() : null; ?>

    <?php if ( !pure_page_without_sidebar() ) echo '</div><!-- /.row -->'; ?>
    
</div><!-- /.page-container -->

<?php get_footer(); ?>