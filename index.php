<?php
/**
 * index.php
 * The main template file.
 * ============================================ *
 */
?>
<?php get_header(); ?>

<?php if ( have_posts() ): ?>

<div class="container page-container">
    <div class="row">

        <!-- ====| Page Content |==== -->
        <div class="content-page blog<?php echo pure_main_content_classes(); ?>" role="main">
            <div class="<?php echo pure_get_posts_classes( array( 'row' ) ); ?>">
                <?php while( have_posts() ): 
                    the_post(); 
                    get_template_part( 'content', get_post_format() );
                endwhile; ?>
            </div><!-- /.row -->
            <?php pure_paging_nav(); ?>
        </div><!-- /.content-page -->

        <?php pure_enable_sidebar() ? get_sidebar() : null; ?>

    </div><!-- /.row -->
</div><!-- /.page-container -->

<?php endif; ?>

<?php get_footer(); ?>