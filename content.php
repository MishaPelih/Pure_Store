<?php
/**
 * content.php
 * The default template for displaying content.
 * ============================================
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( !post_password_required() ): ?>

        <!-- Post header -->
        <header class="entry-header">
            <div class="entry-thumbnail post-thumbnail">
                <?php if( has_post_thumbnail() ): ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( is_single() ): ?>
                            <?php the_post_thumbnail( 'large' ); ?>
                        <?php else: ?>
                            <?php the_post_thumbnail( 'medium_large' ); ?>
                        <?php endif ?>
                    </a>
                <?php endif; ?>
                <div class="date-mask">
                    <div class="meta-date">
                        <span class="day"><?php echo get_the_date('d'); ?></span>
                        <span class="month"><?php echo get_the_date('F'); ?></span>
                    </div>
                </div>
            </div>
        </header><!-- /.entry-header -->
    <?php endif; ?>

    <!-- Post wrapper -->
    <div class="post-wrap <?php if( has_post_thumbnail() ) echo 'has-thumbnail'; ?>">

        <!-- Post description -->
        <div class="entry-description">

            <div class="entry-meta">
                <div class="meta-post">
                    <?php pure_post_meta(); ?>
                </div>
            </div>

            <?php if ( is_single() ): ?>
                <h2><?php the_title(); ?></h2>
            <?php else: ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php endif; ?>

        </div><!-- /.entry-description -->

        <!-- Post content -->
        <div class="entry-content">
            <?php if ( !is_single() ): ?>
                <?php if ( !is_search() ): ?>
                    <?php the_excerpt(); ?>
                <?php else: ?>
                    <?php the_content(); ?>
                <?php endif; ?>
                <a href="<?php get_permalink(); ?>" class="read-more">Continue reading</a>
            <?php else: ?>
                <?php the_content(); ?>
            <?php endif; ?>
        </div><!-- /.post-content -->
    </div><!-- /.post-wrap -->

    <?php
    # If we have a single page and the author biography exists, display it
    if( is_single() && get_the_author_meta( 'description' ) ): ?>
        <!-- ====| Entry-footer |==== -->
        <footer class="entry-footer">
            <h3><?php echo __( 'Written by ', 'pure' ) . get_the_author(); ?></h3>
            <p><?php echo the_author_meta( 'description' ); ?></p>
        </footer><!-- /.entry-footer -->
    <?php endif; ?>

</article>