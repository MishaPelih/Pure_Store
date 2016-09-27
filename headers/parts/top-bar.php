<?php if ( pure_get_redux_option( 'enable_top_bar' ) && ( is_active_sidebar( 'sidebar-topbar-left' ) || is_active_sidebar( 'sidebar-topbar-right' ) || pure_is_woo_exists() ) ): ?>
<!-- *======#| Top-bar menu |#======* -->
<div class="top-bar<?php pure_top_bar_classes(); ?>">
    <div class="container">
        <div class="top-bar-content">
        <?php
            pure_get_sidebar( 'topbar-left' );
            pure_get_sidebar( 'topbar-right' );
            if ( pure_is_woo_exists() ) {
                pure_widget_cart_tpl( 'top-bar-part' );
            }
        ?>
        </div><!-- /.top-bar-content -->
    </div><!-- /.container -->
</div><!-- /.top-bar -->
<?php endif; ?>