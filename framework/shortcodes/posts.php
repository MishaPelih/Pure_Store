<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * framework/shortcodes/posts.php
 * 
 * Shortcode for displaying Posts.
 * ============================================ *
 */
?>
<?php
if ( !function_exists( 'pure_posts' ) ) {
    function pure_posts( $attrs, $content = null )
    {
        $attrs = extract(shortcode_atts(
            array(
                'post_type' => '',
                'per_page' => '',
                'columns' => '',
                'order_by' => '',
                'sort_order' => '',
                'enable_carousel' => '',
                'carousel_loop' => 'false'
            ), $attrs
        ));

        if ( empty($per_page ) || !is_int( (int)$per_page ) ) {
            $per_page = 4;
        }

        if ( empty( $columns ) || !is_int( (int)$columns ) ) {
            $columns = 4;
        }

        $post_classes = array();

        if ( !$enable_carousel ) {
            array_push( $post_classes, 'row-count-' . $columns  );
        } else {
            array_push( $post_classes, 'pure-owl-posts'  );
        }

        $el_class_rand = 'pure-owl-posts-' . rand( 1000000, 9999999 );
        $el_id_rand = 'pure-owl-posts-' . rand( 1000000, 9999999 );
        array_push( $post_classes, $el_class_rand  );

        $post_classes = implode( ' ', $post_classes );

        if ( $post_type == 'post' ) {
            $el_wrapper_start = '<div id="' . $el_id_rand . '" class="posts row posts-grid ' . $post_classes . '">';
            $el_wrapper_end = '</div>';
        } elseif ( $post_type == 'product' ) {
            $el_wrapper_start = '<ul id="' . $el_id_rand . '" class="products ' . $post_classes . '">';
            $el_wrapper_end = '</ul>';
        }

        ob_start();

        if ( $enable_carousel ): ?>
            <script>
                jQuery(document).ready(function($) {
                    $( '#<?php echo $el_id_rand; ?>.<?php echo $el_class_rand; ?>' ).owlCarousel({
                        items: <?php echo $columns; ?>,
                        loop: <?php echo $carousel_loop; ?>,
                        nav: true,
                        dots: false,
                        margin: 30,
                        navText: [
                            '<i class="zmdi zmdi-chevron-left"></i>',
                            '<i class="zmdi zmdi-chevron-right"></i>'
                        ]
                    });
                });
            </script>
        <?php endif;

        echo $el_wrapper_start;

        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => $per_page,
            'orderby' => $order_by,
            'order' => $sort_order
        );
        $loop = new WP_Query( $args );

        if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) {
                $loop->the_post();
                if ( $post_type == 'post' ) {
                    get_template_part( 'content', get_post_format() );
                } elseif ( $post_type == 'product' ) {
                    wc_get_template_part( 'content', 'product' );
                }
			}
		}
		wp_reset_postdata();

        echo $el_wrapper_end;

        $staff = ob_get_clean();
        return $staff;
    }
    add_shortcode( 'pure_posts', 'pure_posts' );
}

if ( !function_exists( 'pure_posts_VC' ) ) {
    function pure_posts_VC()
    {
        vc_map( array(
            "name" => __( "[Pure] Posts", "pure" ),
            "base" => "pure_posts",
            "category" => __( "Pure", "pure" ),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __( "Sort order", "pure" ),
                    "param_name" => "post_type",
                    "value" => array(
                        __( 'Post', 'pure' ) => 'post',
                        __( 'Product', 'pure' ) => 'product',
                    ),
                    'save_always' => true,
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => __( "Per page", "pure" ),
                    "param_name" => "per_page",
                    'value' => 4,
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => __( "Columns", "pure" ),
                    "param_name" => "columns",
                    'value' => 4,
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __( "Order by", "pure" ),
                    "param_name" => "order_by",
                    "value" => array(
                        __( 'Date', 'pure' ) => 'date',
                        __( 'ID', 'pure' ) => 'ID',
                        __( 'Author', 'pure' ) => 'author',
                        __( 'Title', 'pure' ) => 'title',
                        __( 'Modified', 'pure' ) => 'modified',
                        __( 'Random', 'pure' ) => 'rand',
                        __( 'Comment count', 'pure' ) => 'comment_count',
                        __( 'Menu order', 'pure' ) => 'menu_order'
                    ),
                    'save_always' => true,
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __( "Sort order", "pure" ),
                    "param_name" => "sort_order",
                    "value" => array(
                        __( 'Ascending', 'pure' ) => 'ASC',
                        __( 'Descending', 'pure' ) => 'DESC',
                    ),
                    'save_always' => true,
                ),
                array(
                    "type" => "checkbox",
                    "holder" => "div",
                    "param_name" => "enable_carousel",
                    "value" => array( __( 'Enable carousel', 'pure' ) => true ),
                ),
                array(
                    "type" => "checkbox",
                    "holder" => "div",
                    "param_name" => "carousel_loop",
                    "value" => array( __( 'Enable loop', 'pure' ) => true ),
                    'dependency' => array(
                        'element' => 'enable_carousel',
                        'not_empty' => true,
                    ),
                ),
            )
        ) );
    };

    add_action( 'vc_before_init', 'pure_posts_VC' );
}
