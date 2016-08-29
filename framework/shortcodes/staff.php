<?php
/**
 * staff.php
 *
 * Shortcode for displaying Staff.
 */
?>
<?php
    if ( !function_exists( 'pure_staff' ) ) {
        function pure_staff( $attrs, $content = null )
        {
            $attrs = extract(shortcode_atts(
                array(
                    'mem_name' => '',
                    'mem_position' => '',
                    'description' => '',
                    'image_id' => '',
                    'facebook_link' => '',
                    'twitter_link' => '',
                    'vimeo_link' => '',
                    'google_link' => '',
                    'tumblr_link' => '',
                    'pinterest_link' => '',
                ), $attrs
            ));

            $image_data = wp_get_attachment_image_src( intval($image_id), "large" );
            $image_url = $image_data[0];

            ob_start(); ?>

            <div class="team-member">
                <div class="member-image">
                    <?php if ( $image_url ) echo '<img src="' . esc_url( $image_url ) . '" alt="">'; ?>
                    <div class="member-content">
                        <h5><?php if ( $mem_name ) echo $mem_name; ?></h5>
                        <h6 class="member-position"><?php if ( $mem_position ) echo $mem_position; ?></h6>
                        <p><?php if ( $description ) echo $description; ?></p>
                        <ul class="social-icons">
                            <?php
    							if (!empty($facebook_link)) {
    								  ?>
    								  	<li class="facebook"><a href="<?php echo esc_url($facebook_link); ?>"><i class="zmdi zmdi-facebook"></i></a></li>
    								  <?php
    							}
                            	 ?>
                            	 <?php
                            		if (!empty($twitter_link)) {
                            			  ?>
                            			  	<li class="twitter"><a href="<?php echo esc_url($twitter_link); ?>"><i class="zmdi zmdi-twitter"></i></a></li>
                            			  <?php
                            		}
                            	 ?>
                            	 <?php
                            		if (!empty($vimeo_link)) {
                            			  ?>
                            			  	<li class="vimeo"><a href="<?php echo esc_url($vimeo_link); ?>"><i class="zmdi zmdi-vimeo"></i></a></li>
                            			  <?php
                            		}
                            	 ?>
                            	 <?php
                            		if (!empty($google_link)) {
                            			  ?>
                            			  	<li class="google"><a href="<?php echo esc_url($google_link); ?>"><i class="zmdi zmdi-google-plus"></i></a></li>
                            			  <?php
                            		}
                            	 ?>
                            	 <?php
                            		if (!empty($tumblr_link)) {
                            			  ?>
                            			  	<li class="tumblr"><a href="<?php echo esc_url($tumblr_link); ?>"><i class="zmdi zmdi-tumblr"></i></a></li>
                            			  <?php
                            		}
                            	 ?>
                            	 <?php
                            		if (!empty($pinterest_link)) {
                            			  ?>
                            			  	<li class="pinterest"><a href="<?php echo esc_url($pinterest_link); ?>"><i class="zmdi zmdi-pinterest"></i></a></li>
                            			  <?php
                            		}
                            	 ?>
                        </ul>
                    </div>
                </div>
            </div>

            <?php
            $staff = ob_get_clean();
            return $staff;
        }
        add_shortcode( 'pure_staff', 'pure_staff' );
    }

    if ( !function_exists( 'pure_staff_VC' ) ) {
		function pure_staff_VC()
		{
			vc_map( array(
				"name" => __( "[Pure] Staff", "pure" ),
				"base" => "pure_staff",
				"category" => __( "Pure", "pure" ),
				"params" => array(
                    array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __( "Member name", "pure" ),
						"param_name" => "mem_name",
					),
                    array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __( "Member position", "pure" ),
						"param_name" => "mem_position",
					),
                    array(
						"type" => "textarea",
						"holder" => "div",
						"heading" => __( "Description", "pure" ),
						"param_name" => "description",
						"value" => __( '', "pure" )
					),
                    array(
						"type" => "attach_image",
						"holder" => "div",
						"heading" => __( "Attach image", "pure" ),
						"param_name" => "image_id",
						"value" => __( '', "pure" )
					),
                    array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __( "Facebook link", "pure" ),
						"param_name" => "facebook_link",
					),
                    array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __( "Twitter link", "pure" ),
						"param_name" => "twitter_link",
					),
                    array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __( "Viemo link", "pure" ),
						"param_name" => "vimeo_link",
					),
                    array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __( "Google link", "pure" ),
						"param_name" => "google_link",
					),
                    array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __( "Tumblr link", "pure" ),
						"param_name" => "tumbrl_link",
					),
                    array(
						"type" => "textfield",
						"holder" => "div",
						"heading" => __( "Pinterest link", "pure" ),
						"param_name" => "pinterest_link",
					),
				)
			) );
		};

		add_action( 'vc_before_init', 'pure_staff_VC' );
	}
