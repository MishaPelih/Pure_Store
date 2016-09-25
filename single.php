<?php
/**
 * single.php
 * The template for displaying single posts.
 * ============================================ *
 */
?>
<?php get_header(); ?>

<?php pure_update_post_views(); ?>
    
    <div class="container page-container">
        <div class="row">
            <!-- ====| Main Content |==== -->
            <div class="content-page col-md-9" role="main">

                <?php if ( have_posts() ) : ?>

                    <!-- Post content. -->
                    <?php while( have_posts() ): the_post(); ?>
                        <div class="post-single">
                            <?php get_template_part( 'content', get_post_format() ); ?>
                        </div><!-- /.single-post -->
                    <?php endwhile; ?>

                    <!-- Comments section  -->
                    <?php comments_template(); ?>

                <?php else : ?>
                    <?php get_template_part( 'content', 'none' ); ?>
                <?php endif; ?>

            </div><!-- /.main-content -->

            <?php get_sidebar(); ?>
            
        </div><!-- /.row -->
    </div><!-- /.page-container -->

<?php get_footer(); ?>