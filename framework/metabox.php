<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
  * metabox.php
  *
  * Contains tgm2 options.
  * ============================================ *
  */
?>
<?php
	/**
	 * Define the metabox and field configurations.
	 */
	if ( !function_exists( 'pure_metaboxes' ) ) {
		function pure_metaboxes()
		{
		    $prefix = 'pure_';

		    /**
		     * Posts boxes.
		     * ============================================ *
		     */
		    $cmb_post = new_cmb2_box( array(
		        'id'            => 'post_options',
		        'title'         => __( '[Pure] Post options', 'pure' ),
		        'object_types'  => array( 'post' ), // Post type
		        'context'       => 'normal',
		        'priority'      => 'high',
		        'show_names'    => true,
		        // 'cmb_styles' => false,
		        // 'closed'     => true,
		    ) );

		    # [Post format - video] options.
			$group_field_id = $cmb_post->add_field( array(
			    'id'          => $prefix . 'post_format_video_group',
			    'type'        => 'group',
			    'repeatable'  => false,
			    'options'     => array(
			        'group_title'   => __( 'Options for [Video] post format', 'pure' ),
			        'sortable'      => true,
			        // 'add_button'    => __( 'Add Another Entry', 'pure' ),
			        // 'remove_button' => __( 'Remove Entry', 'pure' ),
			        // 'closed'     => true,
			    ),
			) );

			$cmb_post->add_group_field( $group_field_id,  array(
			    'name'    => __( 'Post featured video (upload file)', 'pure' ),
				'id'      => $prefix . 'post_video_file',
				'type'    => 'file',
				'description' => __( 'Upload a file or enter an URL', 'pure' ),
				'options' => array(
					'url' => true,
				),
				'text'    => array(
					'add_upload_file_text' => __( 'Add or Upload File', 'pure' )
				),
				'allow' => array( 'url', 'attachment' )
			) );


			/**
			 * Page boxes.
			 * ============================================ *
			 */
		    $cmb = new_cmb2_box( array(
		        'id'            => 'page_options',
		        'title'         => __( '[Pure] Page options', 'pure' ),
		        'object_types'  => array( 'page', ),
		        'context'       => 'normal',
		        'priority'      => 'high',
		        'show_names'    => true,
		    ) );

		    # [Header] options.
		    $group_field_id = $cmb->add_field( array(
			    'id'          => $prefix . 'header_options',
			    'type'        => 'group',
			    'repeatable'  => false,
			    'options'     => array(
			        'group_title'   => __( 'Header', 'pure' ),
			        'sortable'      => true,
			    ),
			) );

			$cmb->add_group_field( $group_field_id, array(
			    'name'    => 'Header type',
			    'id' => $prefix . 'header_type',
			    'type'    => 'select',
				'default' => 'default',
				'options'          => array(
					'default' => '&nbsp;--&nbsp;&nbsp;' . __( 'Select', 'pure' ) . '&nbsp;&nbsp;--&nbsp;',
			        'header-1' => __( 'Header 1', 'pure' ),
			        'header-2' => __( 'Header 2', 'pure' ),
			        'header-transparent' => __( 'Transparent Header', 'pure' ),
			    ),
			) );

			$cmb->add_group_field( $group_field_id,  array(
			    'name'    => __( 'Header overlaps the content', 'pure' ),
				'id'      => $prefix . 'header_overlap',
				'type'    => 'radio_inline',
				'default' => 'default',
				'options'          => array(
					'default' => __( 'Inherit', 'pure' ),
			        'on' => __( 'On', 'pure' ),
			        'off' => __( 'Off', 'pure' )
			    ),
			) );

			$cmb->add_group_field( $group_field_id,  array(
			    'name'    => __( 'Upload header logo', 'pure' ),
				'id'      => $prefix . 'logo_header_main',
				'type'    => 'file',
				'description' => __( 'Upload a file or enter an URL', 'pure' ),
				'options' => array(
					'url' => true,
				),
				'text'    => array(
					'add_upload_file_text' => __( 'Add or Upload File', 'pure' )
				),
				'allow' => array( 'url', 'attachment' )
			) );

			$cmb->add_group_field( $group_field_id,  array(
			    'name'    => __( 'Upload logo for fixed header', 'pure' ),
				'id'      => $prefix . 'logo_header_fixed',
				'type'    => 'file',
				'description' => __( 'Upload a file or enter an URL', 'pure' ),
				'options' => array(
					'url' => true,
				),
				'text'    => array(
					'add_upload_file_text' => __( 'Add or Upload File', 'pure' )
				),
				'allow' => array( 'url', 'attachment' )
			) );

			$cmb->add_group_field( $group_field_id,  array(
			    'name'    => __( 'Header text color', 'pure' ),
				'id'      => $prefix . 'header_color',
				'type'    => 'select',
				'default' => 'default',
				'options'          => array(
					'default' => '&nbsp;--&nbsp;&nbsp;' . __( 'Select', 'pure' ) . '&nbsp;&nbsp;--&nbsp;',
			        'dark' => __( 'Dark', 'pure' ),
			        'white' => __( 'White', 'pure' )
			    ),
			) );

			# [Top-bar] options.
			$group_field_id = $cmb->add_field( array(
			    'id'          => $prefix . 'top_bar_options',
			    'type'        => 'group',
			    'repeatable'  => false,
			    'options'     => array(
			        'group_title'   => __( 'Top-bar', 'pure' ),
			        'sortable'      => true,
			    ),
			) );

			$cmb->add_group_field( $group_field_id,  array(
			    'name'    => __( 'Top-bar text color', 'pure' ),
				'id'      => $prefix . 'top_bar_color',
				'type'    => 'select',
				'default' => 'default',
				'options'          => array(
					'default' => '&nbsp;--&nbsp;&nbsp;' . __( 'Select', 'pure' ) . '&nbsp;&nbsp;--&nbsp;',
			        'dark' => __( 'Dark', 'pure' ),
			        'white' => __( 'White', 'pure' )
			    ),
			) );

			# [Page Layout] options.
		    $group_field_id = $cmb->add_field( array(
			    'id'          => $prefix . 'page_layout',
			    'type'        => 'group',
			    'repeatable'  => false,
			    'options'     => array(
			        'group_title'   => __( 'Page layout', 'pure' ),
			        'sortable'      => true,
			    ),
			) );

			$cmb->add_group_field( $group_field_id, array(
			    'name'    => 'Sidebar position',
			    'id' => $prefix . 'sidebar_position',
			    'type'    => 'radio_inline',
				'default' => 'default',
				'options'          => array(
					'default' => __( 'Inherit', 'pure' ),
			        'left' => __( 'Left', 'pure' ),
			        'right' => __( 'Right', 'pure' ),
			        'disable' => __( 'Disable', 'pure' ),
			    ),
			) );
		}
		add_action( 'cmb2_admin_init', 'pure_metaboxes' );
	}
