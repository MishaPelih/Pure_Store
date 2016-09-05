<?php
/**
 * init.php
 *
 * Load the frameworks.
 * ============================================ *
 */
?>
<?php
    # Necessary components.
    get_template_part( 'framework/theme-functions' );
    get_template_part( 'framework/woocommerce' );
    get_template_part( 'framework/template-tags' );
    get_template_part( 'framework/theme-config' );
    get_template_part( 'framework/tgm-plugin-activation/class-tgm-plugin-activation' );
    get_template_part( 'framework/metabox' );

    # Widgets.
    get_template_part( 'framework/widgets/popular-posts' );
    get_template_part( 'framework/widgets/static-block' );
    get_template_part( 'framework/widgets/myaccount-dropdown' );

    # Shortcodes.
    get_template_part( 'framework/shortcodes/static-block' );
    get_template_part( 'framework/shortcodes/social-icons' );
    get_template_part( 'framework/shortcodes/banner' );
    get_template_part( 'framework/shortcodes/staff' );
    get_template_part( 'framework/shortcodes/posts' );
    get_template_part( 'framework/shortcodes/simple-carousel' );
    get_template_part( 'framework/shortcodes/products-carousel' );

    # Libs.
    get_template_part( 'framework/tgm-plugin-activation/class-tgm-plugin-activation' );
    get_template_part( 'framework/lib/VideoUrlParser.class' );

    # Other.
    get_template_part( 'framework/post-types/static-block' );
