<?php
/**
  * social-icons.php
  * ============================================ *
  */ 
?>

<?php

	if ( ! function_exists( 'pure_social_icons' ) ){
		function pure_social_icons( $atts,$content = null)
		{
			$atts = shortcode_atts( array(
				'facebook_link' => '',
				'twitter_link' => '',
				'vimeo_link' => '',
				'google_link' => '',
				'tumblr_link' => '',
				'pinterest_link' => '',
			 ), $atts );

			$facebook_link = $atts['facebook_link'];
			$twitter_link = $atts['twitter_link'];
			$vimeo_link = $atts['vimeo_link'];
			$google_link = $atts['google_link'];
			$tumblr_link = $atts['tumblr_link'];
			$pinterest_link = $atts['pinterest_link'];

			ob_start();
				?>
					<ul class="social-icons">
						<?php 
							if (!empty($facebook_link)) {
								  ?>
								  	<li><a href="<?php echo esc_url($facebook_link); ?>"><i class="zmdi zmdi-facebook"></i></a></li>
								  <?php
							}
						 ?>	
						 <?php 
							if (!empty($twitter_link)) {
								  ?>
								  	<li><a href="<?php echo esc_url($twitter_link); ?>"><i class="zmdi zmdi-twitter"></i></a></li>
								  <?php
							}
						 ?>	
						 <?php 
							if (!empty($vimeo_link)) {
								  ?>
								  	<li><a href="<?php echo esc_url($vimeo_link); ?>"><i class="zmdi zmdi-vimeo"></i></a></li>
								  <?php
							}
						 ?>	
						 <?php 
							if (!empty($google_link)) {
								  ?>
								  	<li><a href="<?php echo esc_url($google_link); ?>"><i class="zmdi zmdi-google-plus"></i></a></li>
								  <?php
							}
						 ?>	
						 <?php 
							if (!empty($tumblr_link)) {
								  ?>
								  	<li><a href="<?php echo esc_url($tumblr_link); ?>"><i class="zmdi zmdi-tumblr"></i></a></li>
								  <?php
							}
						 ?>	
						 <?php 
							if (!empty($pinterest_link)) {
								  ?>
								  	<li><a href="<?php echo esc_url($pinterest_link); ?>"><i class="zmdi zmdi-pinterest"></i></a></li>
								  <?php
							}
						 ?>	
					</ul>
				<?php
				$social_icons = ob_get_clean();

			return $social_icons;
		}
		add_shortcode( 'social_icons', 'pure_social_icons' );
	}


	if ( ! function_exists( 'pure_social_icons_VC' ) ){
		function pure_social_icons_VC()
		{
		   vc_map( array(
				"name" => __( "[Pure] : Social Icons", "pure" ),
				"base" => "social_icons",
				"class" => "",
				"category" => __( "Content", "pure"),
				"params" => array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Facebook Link", "pure" ),
					"param_name" => "facebook_link",
					"value"       => '',
					"description" => __( "Facebook Link", "pure" )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Twitter Link", "pure" ),
					"param_name" => "twitter_link",
					"value"       => '',
					"description" => __( "Twitter Link", "pure" )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Google Link", "pure" ),
					"param_name" => "google_link",
					"value"       => '',
					"description" => __( "Google Link", "pure" )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Tumblr Link", "pure" ),
					"param_name" => "tumblr_link",
					"value"       => '',
					"description" => __( "Tumblr Link", "pure" )
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Pinterest Link", "pure" ),
					"param_name" => "pinterest_link",
					"value"       => '',
					"description" => __( "Pinterest Link", "pure" )
				),
			  )
		   ) );
		}
		add_action( 'vc_before_init', 'pure_social_icons_VC' );
	}