<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * framework/woocommerce/woo.template-tags.php
 * File which contains templates related to woocommerce.
 * =================================================== *
*/

/**
 * Main Content Wrappers.
 */
if ( !function_exists( 'pure_before_main_content_wrap' ) ) {
    function pure_before_main_content_wrap() {
        if ( !is_product() ) echo '<div class="container page-container">';
        if ( !pure_page_without_sidebar() ) echo '<div class="row">';
        echo '<div class="content-page shop' . pure_main_content_classes( 'shop' ) . '" role="main">';
    }
}

if ( !function_exists( 'pure_after_main_content_wrap' ) ) {
    function pure_after_main_content_wrap() {
        echo '</div><!-- /.content-page -->';
        pure_enable_sidebar( 'shop' ) ? get_sidebar( 'shop' ) : remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );;
        if ( !pure_page_without_sidebar() ) echo '</div><!-- /.row -->';
        if ( !is_product() ) echo '</div><!-- /.page-container -->';
    }
}

/**
 * Before before Woocommerce Shop loop.
 */
if ( !function_exists( 'pure_before_before_shop_loop' ) ) {
    function pure_before_before_shop_loop() { ?>
        <div class="filter-wrap top">
            <div class="filter-content">
                <div class="switch">
                    <?php
                        $grid_class = ' active';
                        $list_class = '';

                        if ( isset( $_GET['view_mode'] ) && $_GET['view_mode'] == 'list' ) {
                            $list_class = ' active';
                            $grid_class = '';
                        }
                    ?>
                    <div class="grid-view switch-option<?php echo $grid_class; ?>">
                        <a href="<?php echo add_query_arg( 'view_mode', 'grid', remove_query_arg( 'view_mode' )); ?>">
                            <i class="zmdi zmdi-apps"></i>
                        </a>
                    </div>
                    <div class="list-view switch-option<?php echo $list_class; ?>">
                        <a href="<?php echo add_query_arg( 'view_mode', 'list', remove_query_arg( 'view_mode' )); ?>">
                            <i class="zmdi zmdi-menu"></i>
                        </a>
                    </div>
                </div>
                <?php woocommerce_catalog_ordering(); ?>
                <form class="products_per_page_form" method="POST">
                    <select name="pure_products_per_page" class="per-page-select wild-select" style="display: none;">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="9">9</option>
                        <option value="12">12</option>
                        <option value="24">24</option>
                        <option value="36">36</option>
                        <option value="-1">All</option>
                    </select>
                </form>
            </div>
        </div>
        <?php
    }
}

/**
 * Before after Woocommerce Shop loop.
 */
if ( !function_exists( 'pure_before_after_shop_loop' ) ) {
    function pure_before_after_shop_loop() { ?>
        <div class="filter-wrap top">
            <div class="filter-content">
                <div class="switch">
                    <div class="grid-view switch-option active">
                        <a href="#">
                            <i class="zmdi zmdi-apps"></i>
                        </a>
                    </div>
                    <div class="list-view switch-option">
                        <a href="#">
                            <i class="zmdi zmdi-menu"></i>
                        </a>
                    </div>
                </div>
                <?php woocommerce_pagination(); ?>
                <?php woocommerce_catalog_ordering(); ?>
            </div>
        </div>
        <?php
    }
}

/**
 * Compare Button.
 */
if ( ! function_exists( 'pure_product_compare_button' ) ) {
    function pure_product_compare_button() {

        $comp = new YITH_Woocompare_Frontend();
        $product_list = $comp->products_list;
        $added = '';

        foreach  ( $product_list as $key => $value ) {
            if ( $value == get_the_ID() ) $added = ' added';
        }

        echo '<a href="' . pure_get_permalink_without_dominian() . '?action=yith-woocompare-add-product&id=' . get_the_ID() . '" data-product_id="' . get_the_ID() . '" rel="nofollow" class="button side-button compare' . $added . '"></a>';
    }
}

/**
 * Wishlist Button.
 */
if ( ! function_exists( 'pure_product_wishlist_button' ) ) {
    function pure_product_wishlist_button() {

        $added = '';

        if ( YITH_WCWL()->is_product_in_wishlist( get_the_ID() ) ) {
            $href = pure_get_permalink_without_dominian() . '?add_to_wishlist=' . get_the_ID();
            $added = ' added';
        } else {
            $href = YITH_WCWL()->get_wishlist_url();
        }

        echo '<a href="<?php echo $href; ?>" rel="nofollow" data-product-id="' . get_the_ID() . '" data-product-type="simple" class="button side-button add_to_wishlist yith-wcwl-add-to-wishlist add-to-wishlist-' . get_the_ID() . $added . '"></a>';
    }
}

if ( !function_exists( 'pure_related_products' ) ) {
    function pure_related_products() {
        
        global $product;

        if ( !method_exists( $product, 'get_related' ) || is_shop() ) return;

        $related = $product->get_related();

        if ( sizeof($related) == 0 ) return;

        $args = apply_filters('woocommerce_related_products_args', array(
            'post_type'             => 'product',
            'ignore_sticky_posts'   => 1,
            'no_found_rows'         => 1,
            'posts_per_page'        => 10,
            'post__in'              => $related
        ));

        $products = new WP_Query( $args );

        if ( $products->have_posts() ) : ?>

            <div class="related-products pure-owl-posts">
                <div class="container pure-content">
                    <h2 class="page-heading"><?php _e('Suggested products', 'pure'); ?></h2>
                    <ul class="products products-grid">
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>

        <?php endif;

        wp_reset_postdata();
    }
}

if ( !function_exists( 'pure_upsell_products' ) ) {
    function pure_upsell_products() {
        
        global $product;

        if ( !method_exists( $product, 'get_upsells' ) || is_shop() ) return;

        $upsells = $product->get_upsells();

        if ( sizeof($upsells) == 0 ) return;

        $args = apply_filters('woocommerce_related_products_args', array(
            'post_type'             => 'product',
            'ignore_sticky_posts'   => 1,
            'no_found_rows'         => 1,
            'posts_per_page'        => 10,
            'post__in'              => $upsells
        ));

        $products = new WP_Query( $args );

        if ( $products->have_posts() ) : ?>

            <div class="upsells-products pure-owl-posts">
                <div class="container pure-content">
                    <h2 class="page-heading"><?php _e('Upsells products', 'pure'); ?></h2>
                    <ul class="products products-grid">
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>

        <?php endif;

        wp_reset_postdata();
    }
}

if ( ! function_exists('pure_comment_count' ) ) {
    function pure_comment_count() { ?>
        <div id="reviews" class="woocommerce-review-link">
            <a href="<?php echo the_permalink(); ?>#reviews">(<?php echo get_comments_number(); ?>)</a>
        </div>
    <?php
    }
}

if ( !function_exists( 'pure_show_quickly_area_start' ) ) {
    function pure_show_quickly_area_start() {
        global $post;
        echo '<div class="show-quickly" data-prodid="' . $post->ID . '">';
    }
}

if ( !function_exists( 'pure_product_excerpt' ) ) {
    function pure_product_excerpt() { ?>
        <div class="product-excerpt">
            <?php the_excerpt(); ?>
        </div>
        <?php
    }
}
if ( !function_exists( 'pure_show_quickly' ) ) {
    function pure_show_quickly() { ?>
        <span class="icon">
            <i class="zmdi zmdi-plus-circle-o"></i>
        </span>
        <?php
    }
}

if ( !function_exists( 'pure_product_title' ) ) {
    function pure_product_title() { ?>
        <h3 class="product-title">
            <a href="<?php the_permalink(); ?>" class="woocommerce-LoopProduct-link">
                <?php the_title(); ?>
            </a>
        </h3>
        <?php
    }
}

if ( !function_exists( 'pure_close_div' ) ) {
    function pure_close_div() { echo '</div>'; }
}

if ( !function_exists( 'pure_product_meta_wrap_start' ) ) {
    function pure_product_meta_wrap_start() { echo '<div class="pure-meta-wrap">'; }
}

if ( !function_exists( 'pure_product_details_start' ) ) {
    function pure_product_details_start() { echo "<div class='product-details'>"; }
}

if ( !function_exists( 'pure_product_footer_start' ) ) {
    function pure_product_footer_start() { echo '<footer class="footer-product">'; }
}

if ( !function_exists( 'pure_product_mask_start' ) ) {
    function pure_product_mask_start() { echo "<div class='product-mask'>"; }
}

if ( !function_exists( 'pure_product_mask_content_start' ) ) {
    function pure_product_mask_content_start() { echo "<div class='product-mask-content'>"; }
}