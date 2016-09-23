<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * Widget API: Pure_Statick_Block_Widget class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 * ============================================ *
*/
class Pure_Statick_Block_Widget extends WP_Widget
{
   public function __construct() {

      parent::__construct(
         'pure-static-block', 
         '[' . __( 'Pure', 'pure' ) . '] ' . __( 'Static Block', 'pure' ),
         array(
            'classname' => 'pure_widget_satick_block',
            'description' => esc_html__( "Insert a static block", 'pure'),
            'customize_selective_refresh' => true
          
      );
   }

   public function widget( $args, $instance ) {

      extract( $args );

      $block_id = $instance['block_id'];
      $post_title = $instance['post_title'];

      echo $before_widget;

      if ( $post_title ) echo '<h5 class="widget-title static_title">' . $post_title . '</h5>';
      echo pure_get_block( $block_id );
      echo $after_widget;
   }

   public function update( $new_instance, $old_instance ) {

      $instance = $old_instance;
      $instance['block_id'] = $new_instance['block_id'];
      $instance['post_title'] = $new_instance['post_title'];
      return $instance;
   }

   public function form( $instance ) {

      $post_title = '';
      $block_id = 0;

      if ( !empty( $instance['block_id'] ) ) $block_id = esc_attr( $instance['block_id'] );

      if ( !empty( $instance['post_title'] ) ) $post_title = esc_attr( $instance['post_title'] ); ?>
      <!-- Title -->
      <p>
         <label for="<?php echo $this->get_field_id( 'post_title' ); ?>"><?php _e( 'Title:', 'pure' ); ?></label>
         <input type="text" name="<?php echo $this->get_field_name( 'post_title' ); ?>" id="<?php echo $this->get_field_id( 'post_title' ); ?>" value="<?php echo $post_title; ?>">
      </p>

      <!-- Block Name -->
      <p>
         <label for="<?php echo $this->get_field_id('block_id'); ?>"><?php esc_html_e('Static Block name:', 'pure'); ?></label>

         <?php $static_blocks = pure_get_static_blocks(); ?>

         <select name="<?php echo $this->get_field_name('block_id'); ?>" id="<?php echo $this->get_field_id('block_id'); ?>">
            <option>--</option>
            <?php if ( count( $static_blocks > 0 ) ): ?>

               <?php foreach ($static_blocks as $key): ?>
                  <option value="<?php echo $key['static_block_id']; ?>" <?php selected( $block_id, $key['static_block_id'] ); ?>><?php echo $key['static_block_title'] ?></option>
               <?php endforeach; ?>

            <?php endif; ?>
         </select>
      </p>
      <?php
   }
}

add_action( 'widgets_init', create_function( '', 'register_widget( "Pure_Statick_Block_Widget" );' ) );