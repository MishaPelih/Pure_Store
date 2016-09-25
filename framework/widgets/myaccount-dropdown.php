<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * Widget API: Pure_Myaccount_Dropdown class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 * ============================================ *
*/
class Pure_My_Account_Menu extends WP_Widget
{
    /**
    * Specifies the widget name, description, class name and instatiates it.
    */
    public function __construct() {

        parent::__construct(
            'pure-my-account',
            __( '[Pure] My Account Menu', 'pure' ),
            array(
                'classname' => 'pure-my-account-menu',
                'description' => __( 'A widget that displays My Account Menu', 'pure' ),
            )
        );
    }

    /**
    * Generates the back-end layout for the widget.
    */
    public function form( $instance ) {

        $title = 'My Account';

        if ( !empty( $instance['title'] ) ) $title = esc_attr( $instance['title'] ); 
        ?>
        <!-- Title -->
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'pure' ); ?></label>
            <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo $title; ?>">
        </p>
        <?php
    }

    /**
    * Process the widget's values.
    */
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        return $instance;
    }

    /**
    * Output the contents of the widget.
    */
    public function widget( $args, $instance ) {

        extract( $args );

        if ( pure_is_woo_exists() && !is_account_page() ) {

            $title = $instance['title'];

            echo $before_widget;
            ?>
            <ul class="menu menu-top-bar">
                <li class="menu-item menu-parent-item">
                    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php echo $title; ?></a>
                    <ul class="sub-menu">
                        <?php

                        woocommerce_login_form();

                        if ( is_user_logged_in() ): ?>

                            <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                                <li class="menu-item <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                                    <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                                </li>
                            <?php endforeach; ?>

                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
            <?php
            echo $after_widget;
        }
    }
}

## Register the widget using an annonymous function.
add_action( 'widgets_init', create_function( '', 'register_widget( "Pure_My_Account_Menu" );' ) );