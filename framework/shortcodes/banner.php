<?php
/**
 * main-banner.php
 *
 * Shortcode for displaying Main Banner.
 */
?>

<?php

	if ( !function_exists( 'pure_main_banner' ) ) {
		function pure_main_banner( $attrs, $content = null )
		{
			$attrs = extract(shortcode_atts(
				array(
					'bg_image_id' => '',
					'position_x' => '',
					'position_y' => '',
					'color_scheme' => '',
                    'enable_mask' => '',
					'enable_bg_scale' => '',
					'enable_mask_animation' => '',
                    'banner_link' => '',
					'button_caption' => null,
					'button_link' => null,
				), $attrs
			));

			$bg_image_data = wp_get_attachment_image_src( intval($bg_image_id), "large" );
	       	$bg_image_url = $bg_image_data[0];

	       	ob_start(); ?>

	       		<!-- Banner -->
				<div class="banner<?php echo ' ' . esc_attr( $position_x ); ?><?php echo ' ' . esc_attr( $position_y ); ?><?php if ( $color_scheme ) echo ' ' . esc_attr( $color_scheme ); ?><?php if( $enable_mask ) echo ' ' . esc_attr('with_mask'); ?><?php if( $enable_mask && $enable_mask_animation ) echo ' ' . esc_attr('mask_animate');  ?><?php if( $enable_bg_scale ) echo ' ' . esc_attr('bg_scale'); ?>">
                    <?php if ( $banner_link ): ?>
                        <a href="<?php echo esc_attr( $banner_link ); ?>">
                    <?php endif; ?>

					<img src="<?php echo esc_url( $bg_image_url ); ?>" alt="" class="banner-img scale-img">

					<!-- Mask -->
					<div class="mask">

						<!-- Content -->
						<div class="content">
							<?php echo do_shortcode( $content ); ?>
						</div><!-- /banner-content -->

						<?php if( $button_caption && $button_link ): ?>
							<!-- Button content -->
							<div class="button-content">
								<a href="<?php echo $button_link ?>" class="button"><?php echo $button_caption ?></a>
							</div><!-- /button-content -->
						<?php endif; ?>

					</div><!-- /banner-mask -->

                    <?php if ( $banner_link ): ?>
                        </a>
                    <?php endif; ?>

				</div><!-- /banner -->

	       	<?php

			$banner = ob_get_clean();
			return $banner;
		}
		add_shortcode( 'pure_main_banner', 'pure_main_banner' );
	}

	if ( !function_exists( 'pure_main_banner_VC' ) ) {
		function pure_main_banner_VC()
		{
			vc_map( array(
				"name" => __( "[Pure] Main Banner", "pure" ),
				"base" => "pure_main_banner",
				"category" => __( "Pure", "pure"),
				"params" => array(
					array(
						"type" => "textarea_html",
						"holder" => "div",
						"heading" => __( "Banner content", "pure" ),
						"param_name" => "content",
						"value" => __( '', "pure" )
					),
					array(
						"type" => "attach_image",
						"holder" => "div",
						"heading" => __( "Background image", "pure" ),
						"param_name" => "bg_image_id",
						"value" => __( '', "pure" )
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"heading" => __( "Position-x", "pure" ),
						"param_name" => "position_x",
						"value" => array(
							// __( '--', 'pure' ) => '',
							__( 'Left', 'pure' ) => 'left',
							__( 'Center', 'pure' ) =>'center',
							__( 'Right', 'pure' ) => 'right'
						),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"heading" => __( "Position-y", "pure" ),
						"param_name" => "position_y",
						"value" => array(
							// __( '--', 'pure' ) => '',
							__( 'Top', 'pure' ) => 'top',
							__( 'Middle', 'pure' ) =>'middle',
							__( 'Bottom', 'pure' ) => 'bottom'
						),
						'save_always' => true,
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"heading" => __( "Coloe scheme", "pure" ),
						"param_name" => "color_scheme",
						"value" => array(
							__( '--', 'pure' ) => null,
							__( 'White', 'pure' ) => 'white',
							__( 'Black', 'pure' ) => 'black',
						),
						'save_always' => true,
					),
                    array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __( "Banner link", "pure" ),
						"param_name" => "banner_link",
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __( "Button caption", "pure" ),
						"param_name" => "button_caption",
						"value" => __( '', "pure" )
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __( "Button link", "pure" ),
						"param_name" => "button_link",
						"value" => __( '', "pure" )
					),
                    array(
						"type" => "checkbox",
						"holder" => "div",
						"param_name" => "enable_mask",
						"value" => array( __( 'Enable banner mask', 'pure' ) => true ),
					),
                    array(
						"type" => "checkbox",
						"holder" => "div",
						"param_name" => "enable_mask_animation",
						"value" => array( __( 'Enable mask animation', 'pure' ) => true ),
					),
					array(
						"type" => "checkbox",
						"holder" => "div",
						"param_name" => "enable_bg_scale",
						"value" => array( __( 'Enable the background scale animation', 'pure' ) => true ),
					),
				)
			) );
		};

		add_action( 'vc_before_init', 'pure_main_banner_VC' );
	}
