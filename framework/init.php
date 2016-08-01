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
    get_template_part( 'framework/widgets/myaccount-dropdown' );
    get_template_part( 'framework/shortcodes/static-block' );
    get_template_part( 'framework/shortcodes/social-icons' );
    get_template_part( 'framework/post-types/static-block' );
    get_template_part( 'framework/tgm-plugin-activation/class-tgm-plugin-activation' );
    get_template_part( 'framework/lib/VideoUrlParser.class' );
