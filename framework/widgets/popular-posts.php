<?php
/**
 * Widget API: Pure_Popular_Posts class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 * ============================================ *
 */
 ?>
<?php
    class Pure_Popular_Posts extends WP_Widget
    {
        /**
         * Specifies the widget name, description, class name and instatiates it.
         */
		function __construct()
		{
			parent::__construct(
                'pure_info_widget',
                __( 'Pure: Popular Posts', 'pure' ),
                array(
                    'classname' => 'pure_widget_posts',
                    'description' => __( 'A widget that displays popular posts', 'pure' ),
                    'customize_selective_refresh' => true,
                )
            );
		}


        /**
         * Output the contents of the widget.
         */
        public function widget( $args, $instance )
        {
        	extract( $args );

            $title = apply_filters( 'widget_title', $instance['title'] );
            
            if ($instance['posts_count'] <= 0 ) {
               $posts_count = 1;
            }else{
                $posts_count = $instance['posts_count'];
            }

            ## create WP_Query object.
			$query = new WP_Query(
                array(
                   'order' => 'DESC',
                   'orderby' => 'meta_value',
                   'meta_key'  => '_post_views',
                   'posts_per_page' => $posts_count,
               )
            );

            ## Display the markup before the widget ( as defined in functions.php )
            echo $before_widget; ?>

            	<?php if ( $query->have_posts() ): ?>

                    <?php if ( $title ): ?>
                        <h5 class="widget-title"><?php echo esc_html($title); ?></h5>
                    <?php endif; ?>
                        <ul>
                            <?php while( $query->have_posts() ): ?>

                                <?php $query->the_post(); ?>

                                    <li>
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('thumbnail'); ?>
                                            </a>
                                        </div>
                                        <div class="content">
                                            <div class="post-title">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </div>
                                            <div class="post-meta">
                                                <span>
                                                    <?php _e('Posted By','pure') ?>
                                                    <?php the_author_posts_link(); ?>
                                                    <?php echo get_the_date('d F'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                
                            <?php endwhile; ?>
                        </ul>
                <?php endif; ?>

            <?php echo $after_widget;
        }


        /**
         * Process the widget's values.
         */
        public function update( $new_instance, $old_instance )
        {
            $insistance = $old_instance;

            ## Update values
            $insistance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
            $insistance['posts_count'] = strip_tags( stripslashes( intval($new_instance['posts_count']) ) );

            return $insistance;
        }


         /**
         * Generates the back-end layout for the widget.
         */
        public function form( $instance )
        {
            ## Default widget settings
            $defaults = array(
                'title' => 'Popular Posts',
                'posts_count' => '3'
            );

            $instance = wp_parse_args( (array) $instance, $defaults );

            ## The widget content ?>

            <!-- Title -->
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'pure' ); ?></label>
                <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
            </p>

            <!-- Posts count -->
            <p>
                <label for="<?php echo $this->get_field_id( 'posts_count' ); ?>"><?php _e( 'Number of posts to show:', 'pure' ); ?></label>
                <input type="number" name="<?php echo $this->get_field_name( 'posts_count' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'posts_count' ); ?>" value="<?php echo $instance['posts_count']; ?>">
            </p>
           <?php
        }
    }

    ## Register the widget using an annonymous function.
    add_action( 'widgets_init', create_function( '', 'register_widget( "Pure_Popular_Posts" );' ) );
