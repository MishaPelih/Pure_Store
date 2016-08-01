<?php
/**
  * metabox.php
  *
  * Contains tgm2 options.
  * ============================================ *
  */ 
?>

<?php
/**
 * metabox.php
 *
 * The file which contain metaboxes.
 */
?>

<?php

	/**
	 * Define the metabox and field configurations.
	 */
	if ( !function_exists( 'pure_metaboxes' ) ) {
		function pure_metaboxes()
		{
		    // Start with an underscore to hide fields from custom fields list
		    $prefix = 'pure_';

		    /**
		     * Initiate the metabox
		     */
		    $cmb_post = new_cmb2_box( array(
		        'id'            => 'post_options',
		        'title'         => __( '[Pure] Post options', 'pure' ),
		        'object_types'  => array( 'post' ), // Post type
		        'context'       => 'normal',
		        'priority'      => 'high',
		        'show_names'    => true, // Show field names on the left
		        // 'cmb_styles' => false, // false to disable the CMB stylesheet
		        // 'closed'     => true, // Keep the metabox closed by default
		    ) );

			$group_field_id = $cmb_post->add_field( array(
			    'id'          => $prefix . 'post_format_video_group',
			    'type'        => 'group',
			    // 'description' => __( '', 'pure' ),
			    'repeatable'  => false, // use false if you want non-repeatable group
			    'options'     => array(
			        'group_title'   => __( 'Options for [Video] post format', 'pure' ),
			        'sortable'      => true,
			        // 'add_button'    => __( 'Add Another Entry', 'pure' ),
			        // 'remove_button' => __( 'Remove Entry', 'pure' ),
			        // 'closed'     => true, // true to have the groups closed by default
			    ),
			) );

			$cmb_post->add_group_field( $group_field_id,  array(
			    'name'    => __( 'Post featured video (upload file)', 'pure' ),
				'id'      => $prefix . 'post_video_file',
				'type'    => 'file',
				'description' => __( 'Upload a file or enter an URL' ),
				'options' => array(
					'url' => true, // Hide the text input for the url
				),
				'text'    => array(
					'add_upload_file_text' => 'Add or Upload File'
				)
			) );

			// $cmb_post->add_group_field( $group_field_id, array(
			// 	'id' => $prefix . 'post_video_url',
			// 	'name' => __( 'Post featured video (insert url)', 'pure' ),
			// 	'type' => 'oembed',
			// 	'default' => ''
			// ) );		    
		}
		add_action( 'cmb2_admin_init', 'pure_metaboxes' );
	}