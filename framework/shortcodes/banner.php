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
					'text_color' => '',
					'enable_button' => '',
					'banner_mask_color' => '',
					'content_mask_color' => '',
                    'enable_mask' => '',
					'enable_bg_scale' => '',
					'enable_mask_animation' => '',
                    'banner_link' => '',
					'button_caption' => null,
					'button_link' => null,
					'button_color' => '',
					'button_bg_color' => ''
				), $attrs
			));

			$bg_image_data = wp_get_attachment_image_src( intval($bg_image_id), "large" );
	       	$bg_image_url = $bg_image_data[0];

			$banner_classes = array();
			array_push( $banner_classes,
				esc_attr( $position_x ),
				esc_attr( $position_y )
			);
			if ( $enable_mask ) {
				array_push( $banner_classes, esc_attr('with_mask') );
			}
			if ( $enable_mask && $enable_mask_animation ) {
				array_push( $banner_classes, esc_attr('mask_animate') );
			}
			if ( $enable_bg_scale ) {
				array_push( $banner_classes, esc_attr('bg_scale') );
			}

			ob_start(); ?>

				<!-- Banner -->
				<div class="banner <?php echo implode( ' ', $banner_classes ) ?>">
					<span class="before" <?php if ( $banner_mask_color ) echo 'style="background-color:' . $banner_mask_color . '"'; ?> ></span>

					<img src="<?php echo esc_url( $bg_image_url ); ?>" alt="" class="banner-img scale-img">

					<?php if ( $banner_link ): ?>
						<a href="<?php echo esc_attr( $banner_link ) ?>" class="banner-link"></a>
					<?php endif; ?>

					<!-- Mask -->
					<div class="mask" style="color:<?php echo $text_color . ';'; if ( $content_mask_color ) echo 'background-color:' . $content_mask_color . ';'; ?>">

						<!-- Content -->
						<div class="content">
							<?php echo do_shortcode( $content ); ?>
							<?php if( $enable_button ): ?>
								<!-- Button content -->
								<?php
									$button_styling = '';
									if ( $button_color || $button_bg_color ) {
										$button_styling .= 'style="';
										if ( $button_color ) {
											$button_styling .= 'color:' . esc_attr( $button_color ) . ';';
										}
										if ( $button_bg_color ) {
											$button_styling .= 'background-color:' . esc_attr( $button_bg_color ) . ';';
										}

										$button_styling .= '"';
									}
								?>
								<a href="<?php echo esc_url( $button_link ) ?>" class="button" <?php echo $button_styling ?>><?php echo $button_caption ?></a>
							<?php endif; ?>
						</div><!-- /banner-content -->
					</div>
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
				"category" => __( "Pure", "pure" ),
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
		                "type" => "colorpicker",
		                "heading" => __( "Text color", "pure" ),
		                "param_name" => "text_color",
		                "value" => '#000',
		                "description" => __( "Text Color", "pure" )
		            ),
                    array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __( "Banner link", "pure" ),
						"param_name" => "banner_link",
					),
					array(
						"type" => "checkbox",
						"holder" => "div",
						"param_name" => "enable_button",
						"value" => array( __( 'Enable Button', 'pure' ) => true ),
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __( "Button caption", "pure" ),
						"param_name" => "button_caption",
						"value" => __( '', "pure" ),
						"group" => __( 'Button', 'pure' ),
						'dependency' => array(
							'element' => 'enable_button',
							'not_empty' => true,
						),
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __( "Button link", "pure" ),
						"param_name" => "button_link",
						"value" => __( '', "pure" ),
						"group" => __( 'Button', 'pure' ),
						'dependency' => array(
							'element' => 'enable_button',
							'not_empty' => true,
						),
					),
					array(
		                "type" => "colorpicker",
		                "heading" => __( "Button Color", "pure" ),
		                "param_name" => "button_color",
		                "value" => "",
						"group" => __( 'Button', 'pure' ),
						'dependency' => array(
							'element' => 'enable_button',
							'not_empty' => true,
						),
		            ),
					array(
		                "type" => "colorpicker",
		                "heading" => __( "Button Background Color", "pure" ),
		                "param_name" => "button_bg_color",
		                "value" => "",
						"group" => __( 'Button', 'pure' ),
						'dependency' => array(
							'element' => 'enable_button',
							'not_empty' => true,
						),
		            ),
                    array(
						"type" => "checkbox",
						"holder" => "div",
						"param_name" => "enable_mask",
						"value" => array( __( 'Enable banner mask', 'pure' ) => true ),
					),
                    // array(
					// 	"type" => "checkbox",
					// 	"holder" => "div",
					// 	"param_name" => "enable_mask_animation",
					// 	"value" => array( __( 'Enable mask animation', 'pure' ) => true ),
					// 	"group" => esc_html__( 'Mask', 'pure' ),
					// 	'dependency' => array(
					// 		'element' => 'enable_mask',
					// 		'not_empty' => true,
					// 	),
					// ),
					array(
		                "type" => "colorpicker",
		                "heading" => __( "Banner Mask color", "pure" ),
		                "param_name" => "banner_mask_color",
		                "value" => "rgba(255,255,255,0)",
		                "description" => __( "Banner Mask Color", "pure" ),
						"group" => esc_html__( 'Mask', 'pure' ),
						'dependency' => array(
							'element' => 'enable_mask',
							'not_empty' => true,
						),
		            ),
					array(
		                "type" => "colorpicker",
		                "heading" => __( "Content Mask color", "pure" ),
		                "param_name" => "content_mask_color",
		                "value" => "rgba(255,255,255,0)",
		                "description" => __( "Content Mask Color", "pure" ),
						"group" => esc_html__( 'Mask', 'pure' ),
						'dependency' => array(
							'element' => 'enable_mask',
							'not_empty' => true,
						),
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
