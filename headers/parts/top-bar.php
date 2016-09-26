<?php if ( pure_get_redux_option( 'enable_top_bar' ) && ( is_active_sidebar( 'sidebar-topbar-left' ) || is_active_sidebar( 'sidebar-topbar-right' ) || pure_is_woo_exists() ) ): ?>
<!-- *======#| Top-bar menu |#======* -->
<div class="top-bar<?php pure_top_bar_classes(); ?>">
    <div class="container">
        <div class="top-bar-content">

            <?php pure_get_sidebar( 'topbar-left' ); ?>

            <?php pure_get_sidebar( 'topbar-right' ); ?>

            <?php if ( pure_is_woo_exists() ): ?>

                <div class="widget-cart-wrapper menu-parent-item top-bar-part">
                    <div class="widget-cart">
                        <a href="<?php echo WC()->cart->get_cart_url(); ?>" class="cart-contents within-inline cart-quantity">
                            <i class="zmdi zmdi-shopping-basket"></i>
                            <span class="cart-count">
                                <?php echo WC()->cart->get_cart_contents_count(); ?>
                            </span>
                        </a>
                    
                        <?php if ( !is_cart() ): ?>
                            <div class="widget_shopping_cart_content shopping-cart-content"></div>
                        <?php endif; ?>
                    </div>
                </div><!-- /.site-header-cart -->
            <?php endif; ?>

        </div><!-- /.top-bar-content -->
    </div><!-- /.container -->
</div><!-- /.top-bar -->
<?php endif; ?>