<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * framework/post-types/static-block.php
 *
 * Register static posts type.
 * ============================================ *
*/

if ( !function_exists( 'pure_post_type_static_block' ) ) {
   function pure_post_type_static_block() {

      $labels = array(
         'name'               => _x( 'Static block', 'Static block', 'pure' ),
         'singular_name'      => _x( 'Static block', 'Static block',  'pure' ),
         'add_new'            => _x( 'Add New', 'Add New', 'pure' ),
         'add_new_item'       => __( 'Add New Static block', 'pure' ),
         'edit_item'          => __( 'Edit Static block', 'pure' ),
         'new_item'           => __( 'New Static block', 'pure' ),
         'all_items'          => __( 'All Static blocks', 'pure' ),
         'view_item'          => __( 'View Static block', 'pure' ),
         'search_items'       => __( 'Search for Static blocks', 'pure' ),
         'not_found'          => __( 'No static blocks found', 'pure' ),
         'not_found_in_trash' => __( 'No static blocks found in the Trash', 'pure' ),
         'parent_item_colon'  => '',
         'menu_name'          => __( 'Static blocks', 'pure' )
      );
      $args = array(
         'taxonomies'    => array( 'category', 'post_tag' ),
         'labels'        => $labels,
         'description'   => __( 'Static block', 'pure' ),
         'public'        => true,
         'menu_position' => 5,
         'menu_icon' => 'dashicons-welcome-widgets-menus',
         'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
         'has_archive'   => true,
      );
      register_post_type( 'static_block', $args );
   }
   add_action( 'init', 'pure_post_type_static_block' );
}


if ( !function_exists( 'pure_get_static_blocks' ) ) {
   function pure_get_static_blocks() {

      $return_array = array();
      $args = array( 
         'post_type' => 'static_block',
         'posts_per_page' => 50
      );
        
      $my_posts = get_posts( $args );
      $i=0;

      foreach ( $my_posts as $post ) {
         $i++;
         $return_array[$i]['static_block_id'] = $post->ID;
         $return_array[$i]['static_block_title'] = get_the_title($post->ID);
      }

      return $return_array;
   }
}


if ( !function_exists( 'pure_get_block' ) ) {
   function pure_get_block( $id = false ) {

      if( !$id ) return;

      $output = wp_cache_get( $id, 'pure_get_block' );

      if ( !$output ) {

         $args = array( 
            'include' => $id,
            'post_type' => 'static_block',
            'posts_per_page' => 1 
         );
         $output = '';
         $my_posts = get_posts( $args );

         foreach ( $my_posts as $post ) {
            $output = do_shortcode( $post->post_content );
         }

         wp_cache_add( $id, $output, 'pure_get_block' );
      }

      return $output;
   }
}