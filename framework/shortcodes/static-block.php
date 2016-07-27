<?php
/**
  * static-block.php
  * ============================================ *
  */ 
?>

<?php
	
	if ( !function_exists( 'pure_static_block' ) ) {
		function pure_static_block( $attrs, $content = null )
		{
			$attrs = extract(shortcode_atts(
				array(
					'block_id' => ''
				), $attrs 
			));

            echo pure_get_block( $block_id );			
		}
		add_shortcode( 'pure_static_block', 'pure_static_block' );
	}

	if ( !function_exists( 'pure_static_block_VC' ) ) {
		function pure_static_block_VC()
		{
			$static_blocks = pure_get_static_blocks();
			$all_elems = array();

			foreach ($static_blocks as $key => $value) {
				$current_elem = array(
					$key[$value]['static_block_title'] => $key[$value]['static_block_id']
				);
				array_merge( $all_elems, $current_elem );
			}

			// print_r( $all_elems );

			vc_map( array(
				"name" => __( "Pure: Static", "pure" ),
				"base" => "pure_static_block",
				"category" => __( "Pure", "pure"),
				"params" => array(
					array(
						"type" => "dropdown",
						"holder" => "div",
						"heading" => __( "Choose the static block", "pure" ),
						"param_name" => "block_id",
						"value" => $all_elems,
						'save_always' => true,
						// "value" => array(
						// 	// __( '--', 'pure' ) => '',
						// 	__( 'Left', 'pure' ) => 'left',
						// 	__( 'Center', 'pure' ) =>'center',
						// 	__( 'Right', 'pure' ) => 'right'
						// ),
					),
				)
			) );
		};

		add_action( 'vc_before_init', 'pure_static_block_VC' );
	}