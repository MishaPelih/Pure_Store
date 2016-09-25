<?php
/**
 * framework/shortcodes/products-carousel.php
 *
 * Shortcode for displaying Products Carousel.
 * ============================================ *
*/

if ( !function_exists( 'pure_products_carousel' ) ) {
    function pure_products_carousel( $attrs, $content = null ) {

        $attrs = extract( shortcode_atts(
            array(
                'per_page' => '',
                'columns' => '',
                'order_by' => '',
                'sort_order' => ''
            ), $attrs
        ) );

        ob_start(); ?>

        <ul class="products pure-owl-products">
            <?php
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => $per_page,
                'orderby' => $order_by,
                'order' => $sort_order
            );
            $loop = new WP_Query( $args );

            if ( $loop->have_posts() ) {

                while ( $loop->have_posts() ) {
                    $loop->the_post();
                    wc_get_template_part( 'content', 'product' );
                }
            }

            wp_reset_postdata(); ?>
        </ul>

        <?php
        $staff = ob_get_clean();
        return $staff;
    }

    add_shortcode( 'pure_products_carousel', 'pure_staff' );
}

if ( !function_exists( 'pure_products_carousel_VC' ) ) {
    function pure_products_carousel_VC() {

        vc_map( array(
            "name" => __( "[Pure] Staff", "pure" ),
            "base" => "pure_staff",
            "category" => __( "Pure", "pure" ),
            "params" => array(
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => __( "Per page", "pure" ),
                    "param_name" => "per_page",
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => __( "Columns", "pure" ),
                    "param_name" => "columns",
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __( "Order by", "pure" ),
                    "param_name" => "order_by",
                    "value" => array(),
                    'save_always' => true,
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __( "Sort order", "pure" ),
                    "param_name" => "sort_order",
                    "value" => array(),
                    'save_always' => true,
                ),
            )
        ) );
    };

    add_action( 'vc_before_init', 'pure_products_carousel_VC' );
}
