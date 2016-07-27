<?php
/**
 * init.php
 *
 * Load the frameworks.
 * ============================================ *
 */
?>

<?php
    get_template_part( 'framework/functions' );
    get_template_part( 'framework/woocommerce' );
    get_template_part( 'framework/template-tags' );
    get_template_part( 'framework/theme-config' );
    get_template_part( 'framework/tgm-plugin-activation/class-tgm-plugin-activation' );
    get_template_part( 'framework/metabox' );
    get_template_part( 'framework/widgets/popular-posts' );
    get_template_part( 'framework/widgets/static-block' );
    get_template_part( 'framework/shortcodes/static-block' );
    get_template_part( 'framework/post-types/static-block' );
    get_template_part( 'framework/tgm-plugin-activation/class-tgm-plugin-activation' );
    get_template_part( 'framework/lib/VideoUrlParser.class' );

    // print_r( pure_get_static_blocks() );
    echo '<br>';

    $static_blocks = pure_get_static_blocks();
    $all_elems = array();

    foreach ( $static_blocks as $key => $value ) {
        $current_elem = array(
            $key[$value]['static_block_title'] => $key[$value]['static_block_id']
        );
        array_merge( $all_elems, $current_elem );
        // echo $key;
        // echo '<br>';
        // print_r( $value );
        // echo '<br>';
    }

    print_r( $all_elems );