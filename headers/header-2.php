<div class="header-wrapper header-type-2<?php pure_header_classes(); ?>">

    <?php get_template_part('headers/parts/top-bar'); ?>

    <!-- *======#| Header |#======* -->
    <header class="header site-header">
        <div class="container">
            <div class="container-wrap">
            <?php # Header Templates.
                pure_site_search_tpl();
                pure_get_menu();
                pure_logo_tpl();
                if ( pure_is_woo_exists() ) {
                    pure_widget_cart_tpl();
                } 
                pure_mobile_menu_tpl( 'switcher' ); 
            ?>
            </div><!-- /.container-wrap -->
        </div><!-- /.container -->
    </header><!-- /site-header -->

    <?php get_header( 'fixed' ); ?>
    <?php pure_mobile_menu_tpl(); ?>

</div><!-- /.header-wrapper -->