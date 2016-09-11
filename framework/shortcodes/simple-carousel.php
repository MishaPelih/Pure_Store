<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * framework/shortcodes/simple-carousel.php
 *
 * Shortcode for displaying Simple Carousel.
 * ============================================ *
 */
?>
<?php
    if ( !function_exists( 'pure_simple_carousel' ) ) {
        function pure_simple_carousel( $attrs, $content = null )
        {
            $attrs = extract(shortcode_atts(
                array(
                    'carousel_group' => '',
                ), $attrs
            ));
            $carousel_group = json_decode(urldecode($carousel_group));

            ob_start(); ?>

                <div class="pure-carousel">
                    <?php foreach ($carousel_group as $key => $value): ?>
                        <div class="pc-item">
                            <?php
                            $carousel_image_data = wp_get_attachment_image_src( intval( $value->carousel_image ), "large" );
                            $carousel_image_url = $carousel_image_data[0];
                            $carousel_link = $value->carousel_link;

                            if ( $carousel_link ) echo '<a href="' . esc_url( $carousel_link ) . '">';
                            if ( $carousel_image_url ) {
                                echo '<img src="' . esc_url( $carousel_image_url ) . '">';
                            }
                            if ( $carousel_link ) echo '</a>';
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php
            $carousel = ob_get_clean();
            return $carousel;
        }
        add_shortcode( 'pure_simple_carousel', 'pure_simple_carousel' );
    }

    if ( !function_exists( 'pure_simple_carousel_VC' ) ) {
		function pure_simple_carousel_VC()
		{
			vc_map( array(
				"name" => __( "[Pure] Simple Carousel", "pure" ),
				"base" => "pure_simple_carousel",
				"category" => __( "Pure", "pure" ),
				"params" => array(
                    array(
                        'type' => 'param_group',
                        'value' => '',
                        'param_name' => 'carousel_group',
                        'params' => array(
                            array(
        						"type" => "attach_image",
        						"holder" => "div",
        						"heading" => __( "Attach image", "pure" ),
        						"param_name" => "carousel_image",
        						"value" => __( '', "pure" )
        					),
                            array(
        						"type" => "textfield",
        						"holder" => "div",
        						"heading" => __( "Carousel link", "pure" ),
        						"param_name" => "carousel_link",
        					),
                        )
                    )
				)
			) );
		};

		add_action( 'vc_before_init', 'pure_simple_carousel_VC' );
	}
