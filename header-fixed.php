<?php
/**
 * header-fixed.php
 * ============================================ *
 */
if ( pure_get_redux_option( 'fixed_header_enabled' ) && pure_get_redux_option( 'fixed_header_enabled' ) !== false ): ?>
<!-- *======#| Header Fixed |#======* -->
<header class="header fixed-header fixed">
    <div class="container">
        <div class="container-wrap">
        <?php
            pure_logo_tpl( 'fixed' );
            pure_get_menu();
            if ( pure_is_woo_exists() ) {
                pure_widget_cart_tpl();
            } 
            pure_mobile_menu_tpl( 'switcher' );
        ?>
        </div><!-- /.container-wrap -->
    </div><!-- /.container -->
</header><!-- /fixed-header -->
<?php endif; ?>