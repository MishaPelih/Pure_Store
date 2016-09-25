<?php if ( !defined('ABSPATH') ) exit('No direct script access allowed');
/**
 * framework/template-tags.php
 * Contains framework functions.
 * ============================================ *
*/

/**
 * Returns navigations.
 */
if ( !function_exists( 'pure_get_menu' ) ) {
    function pure_get_menu( $type = 'main' ) {

        wp_nav_menu(
            array(
                'theme_location' => $type,
                'menu_class' => 'menu menu-' . $type,
                'menu_id' => 'menu-' . $type,
                'container_class' => 'menu-wrap menu-' . $type . '-wrap',
            )
        );
    }
}

/**
 * Display mobile menu template.
 */
if ( !function_exists( 'pure_mobile_menu_tpl' ) ) {
    function pure_mobile_menu_tpl( $opt = null ) { 

        if ( $opt !== 'switcher' ): ?>
            <!-- *======#| Mobile Menu |#======* -->
            <div class="pure-menu-mobile">
                <div class="menu-content">
                    <?php pure_search_tpl( 'menu-mobile-search' ); ?>
                    <?php pure_get_menu( 'mobile' ); ?>
                </div>
            </div><!-- /.pure-menu-mobile -->
            <div class="close-menu-mobile-full-screen"></div>
        <?php else: ?>
            <!-- Open Mobile Menu Button -->
            <div class="menu-mobile-switcher-wrap">
                <button type="button" class="menu-mobile-switcher">
                    <i class="zmdi zmdi-menu"></i>
                </button>
            </div>
        <?php endif;
    }
}

/**
 * Display site search.
 */
if ( !function_exists( 'pure_search_tpl' ) ) {
    function pure_search_tpl( $extra_class = null ) { ?>
        <!-- Search -->
        <div class="search<?php if ( $extra_class ) echo " $extra_class"; ?>">
            <form role="search" action="#" method="get" id="searchform" class="searchform">
                <input type="text" name="s" id="search-content" class="search-content" placeholder="Search" />
                <button type="submit" class="searchsubmit">
                    <i class="zmdi zmdi-search"></i>
                </button>
            </form>
        </div>
    <?php
    }
}

/**
 * Display Logo template.
 */
if ( !function_exists( 'pure_logo_tpl' ) ) {
    function pure_logo_tpl( $type = 'main' ) {

        if ( pure_get_logo_url( $type ) ): ?>
            <!-- Logo -->
            <div class="header-logo">
                <a href="index.php">
                    <img src="<?php echo pure_get_logo_url( $type ); ?>" alt="">
                </a>
            </div><!-- /.header-logo -->
        <?php endif;
    }
}

/**
 * Get the different sidebars.
 */
if ( !function_exists( 'pure_get_sidebar' ) ) {
    function pure_get_sidebar( $sr_type = 'blog' ) {

        if ( !$sr_type ) return;
        switch ( $sr_type ) {

            # Default sidebar.
            case 'blog':
                if ( is_active_sidebar( 'sidebar-blog' ) ): ?>
                    <!-- ====| Sidebar |==== -->
                    <aside class="sidebar sidebar-blog col-md-3 col-sm-12 col-xs-12" role="complementary">
                        <?php dynamic_sidebar( 'sidebar-blog' ); ?>
                    </aside><!-- /sidebar -->
                <?php endif;
                break;

            # Shop sidebar.
            case 'shop':
                if ( is_active_sidebar( 'sidebar-shop' ) && is_shop() && pure_is_woo_exists() ): ?>
                    <!-- ====| Sidebar |==== -->
                    <aside class="sidebar sidebar-shop col-md-3 col-sm-12 col-xs-12" role="complementary">
                        <?php dynamic_sidebar( 'sidebar-shop' ); ?>
                    </aside>
                <?php endif;
                break;

            # Footer widgetarea.
            case 'footer':
                $wr_f = 'widgetarea-footer-';
                if ( is_active_sidebar( $wr_f . '1' ) || is_active_sidebar( $wr_f . '2' ) || is_active_sidebar( $wr_f . '3' ) || is_active_sidebar( $wr_f . '4' ) ): ?>
                    <!-- *======#| Site-footer. |#======* -->
                    <footer class="site-footer">
                        <div class="footer-wrapper container">
                            <aside class="sidebar-footer" role="complementary">
                                <div class="row">
                                    <?php for ( $i=1; $i <= 4; $i++ ) {
                                        if ( is_active_sidebar( 'widgetarea-footer-' . $i ) ) {
                                            dynamic_sidebar( 'widgetarea-footer-' . $i );
                                        }
                                    } ?>
                                </div>
                            </aside><!-- /sidebar -->
                        </div><!-- /.footer-wrapper -->
                    </footer><!-- /.site-footer -->
                <?php endif;
                break;

            # Copyright widgetarea.
            case 'copyright': ?>
                <!-- *======#| Footer-bottom. |#======* -->
                <div class="footer-bottom">
                    <div class="container copyright">
                        <div class="row"><?php
                        $wr_c_left = 'widgetarea-copyright-left';
                        $wr_c_right = 'widgetarea-copyright-right';
                        
                        if ( is_active_sidebar( $wr_c_left ) || is_active_sidebar( $wr_c_right ) ): ?>
                            <?php if ( is_active_sidebar( $wr_c_left ) ):  ?>
                                <div class="col-md-6 copyright-left">
                                    <?php dynamic_sidebar( $wr_c_left ); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ( is_active_sidebar( $wr_c_right ) ):  ?>
                                <div class="col-md-6 copyright-right">
                                    <?php dynamic_sidebar( $wr_c_right ); ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </div><!-- /.footer-bottom --><?php
                break;

            # Left topbar.
            case 'topbar-left':
                if ( is_active_sidebar( 'widgetarea-topbar-left' ) ) {
                    dynamic_sidebar( 'widgetarea-topbar-left' );
                }
                break;

            # Right topbar.
            case 'topbar-right':
                if ( is_active_sidebar( 'widgetarea-topbar-right' ) ) {
                    dynamic_sidebar( 'widgetarea-topbar-right' );
                }
                break;
            
            default:
                return false;
                break;
        }
    }
}

/**
 * Display the post meta.
 */
if ( !function_exists( 'pure_post_meta' ) ) {
    function pure_post_meta() { ?>
        <ul class="list-inline entry-meta">
            <?php if ( get_post_type() === 'post' ): ?>
                <li class="meta-author">
                    <i class="zmdi zmdi-account"></i>
                    By
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )
                        ) ); ?>" class="entry-meta-link" rel="author">
                        <?php echo get_the_author(); ?>
                    </a>
                </li>

                <?php if ( has_post_format( 'video' ) ): ?>
                    <li class="meta-date">
                        <i class="zmdi zmdi-calendar"></i>
                        <?php echo get_the_date('d F'); ?>
                    </li>
                <?php endif; ?>

                <?php if ( comments_open() ): ?>
                    <li class="meta-comment">
                        <div class="meta-reply">
                            <?php
                                $icon = '<i class="zmdi zmdi-comment-outline"></i>&nbsp;';
                                comments_popup_link(
                                    $icon . '<span class="count">(0)</span>',
                                    $icon . '<span class="count">(1)</span>',
                                    $icon . '<span class="count">(%)</span>'
                                ); ?>
                        </div>
                    </li>
                <?php endif; ?>

                <li class="meta-views">
                    <i class="zmdi zmdi-eye"></i>
                    <span class="count">
                        (<?php echo pure_get_post_views() ?>)
                    </span>
                </li>

            <?php endif; ?>
        </ul>
        <?php
    }
}

/**
 * Get the pagination.
 */
if ( !function_exists( 'pure_paging_nav' ) ) {
    function pure_paging_nav() {

        // if all posts fit in one page.
        if( is_singular() ) return;

        global $wp_query;

        if ( $wp_query->max_num_pages > 1 ) {

            echo '<div class="pagination-wrap">';

            $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
            $max   = intval( $wp_query->max_num_pages );

            //  Add current page to the array
            if ( $paged >= 1 ) $links[] = $paged;

            //  Add the pages around the current page to the array
            if ( $paged >= 3 ) {
                $links[] = $paged - 1;
                $links[] = $paged - 2;
            }

            if ( ( $paged + 2 ) <= $max ) {
                $links[] = $paged + 2;
                $links[] = $paged + 1;
            }

            echo '<div class="woocommerce-pagination">';
            echo '<ul class="page-numbers">';

            // Previous Post Link
            if ( get_previous_posts_link() ) {
                printf( '<li>%s</li>', get_previous_posts_link( '<i class="fa fa-angle-left"></i>' ) );
            }

            //  Link to first page, plus ellipses if necessary
            if ( ! in_array( 1, $links ) ) {
                $class = 1 == $paged ? ' class="current active-bg-color"' : '';

                printf( '<li%s><a href="%s">%s</a></li>', $class, esc_url( get_pagenum_link( 1 ) ), '1' );

                if ( ! in_array( 2, $links ) ) echo '<li><span>...</span></li>';
            }

            // Link to current page, plus 2 pages in either direction if necessary
            sort( $links );
            foreach ( (array) $links as $link ) {
                $class = $paged == $link ? ' class="current active-bg-color"' : '';
                printf( '<li%s><a href="%s" class="pag-object">%s</a></li>', $class, esc_url( get_pagenum_link( $link ) ), $link );
            }

            //  Link to last page, plus ellipses if necessary
            if ( ! in_array( $max, $links ) ) {
                if ( ! in_array( $max - 1, $links ) )
                    echo '<li><span>...</span></li>';

                $class = $paged == $max ? ' class="current active-bg-color"' : '';
                printf( '<li%s><a href="%s" class="pag-object">%s</a></li>', $class, esc_url( get_pagenum_link( $max ) ), $max );
            }

            //  Next Post Link
            if ( get_next_posts_link() ) {
                printf( '<li>%s</li>', get_next_posts_link( '<i class="fa fa-angle-right"></i>' ) );
            }

            echo '</ul><!-- /.page-numbers -->';
            echo '</div><!-- /.woocommerce-pagination -->';
            echo '</div><!-- /.pagination-block -->';
        }
    }
}

/**
 * This function return the blanc custom breadcrumbs.
 */
if ( !function_exists( 'pure_breadcrumbs' ) ) {
    function pure_breadcrumbs() {

        $text['home'] = get_the_title( get_option( 'page_on_front', true ) );
        $text['blog'] = get_the_title( get_option('page_for_posts', true) );
        $text['category'] = '%s';
        $text['search'] = 'Search results by %s';
        $text['tag'] = '%s';
        $text['author'] = 'Article by: %s';
        $text['404'] = 'Error 404';
        $text['page'] = 'Page %s';
        $text['cpage'] = 'Comments page %s';

        $wrap_before = '<div class="breadcrumbs"><div class="container">';
        $wrap_after = '</div></div><!-- .breadcrumbs -->';
        $sep = '&#47;';
        $sep_before = '<span class="sep">';
        $sep_after = '</span>';
        $show_home_link = 1;
        $show_on_home = 1;
        $show_current = 1;
        $before = '<span class="current active-color">';
        $after = '</span>';

        global $post;

        $home_link = home_url('/');
        $link_before = '<span>';
        $link_after = '</span>';
        $link_attr = ' itemprop="url"';
        $link_in_before = '<span itemprop="title">';
        $link_in_after = '</span>';
        $link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
        $frontpage_id = get_option('page_on_front');
        $parent_id = !empty( $post->post_parent ) ? $post->post_parent : null;
        $sep = '&nbsp;' . $sep_before . $sep . $sep_after . '&nbsp;';


        if ( is_home() || is_front_page() ) {
            if ( $show_on_home && get_query_var('paged') ) {
                echo $wrap_before . sprintf( $link, $home_link, $text['home'] ) . $sep . sprintf( $link, $home_link, $text['blog'] ) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after . $wrap_after;
            } elseif ( $show_on_home ) {
                echo $wrap_before . sprintf( $link, $home_link, $text['home'] ) . $sep . $before . $text['blog'] . $after . $wrap_after;
            }
        } else {

            echo $wrap_before;

            if ( $show_home_link ) echo sprintf( $link, $home_link, $text['home'] );
                if ( is_category() ) {
                    $cat = get_category(get_query_var('cat'), false);

                    if ($cat->parent != 0) {
                        $cats = get_category_parents($cat->parent, TRUE, $sep);
                        $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
                        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);

                        if ($show_home_link) echo $sep;

                        echo $cats;
                    }

                    if ( get_query_var('paged') ) {
                        $cat = $cat->cat_ID;
                        echo $sep . sprintf( $link, $home_link, $text['blog'] ) . $sep . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                    } else {

                        // if press on category
                        if ($show_current) echo $sep . $link_before . '<a href="' . get_permalink( get_page_by_path( 'blog' ) ) . '">' . $link_in_before . $text['blog'] . $link_in_after . '</a>' . $link_after . $sep . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
                    }

                } elseif ( is_search() ) {
                    if (have_posts()) {
                        if ( $show_home_link && $show_current ) echo $sep;
                        if ( $show_current ) echo $before . sprintf($text['search'], get_search_query()) . $after;
                    } else {
                        if ($show_home_link) echo $sep;
                        echo $before . sprintf($text['search'], get_search_query()) . $after;
                    }

                } elseif ( is_day() ) {
                    if ($show_home_link) echo $sep;
                        echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
                        echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
                    if ($show_current) echo $sep . $before . get_the_time('d') . $after;

                } elseif ( is_month() ) {
                    if ($show_home_link) echo $sep;
                        echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
                    if ($show_current) echo $sep . $before . get_the_time('F') . $after;

                } elseif ( is_year() ) {
                    if ($show_home_link && $show_current) echo $sep;
                    if ($show_current) echo $before . get_the_time('Y') . $after;

                } elseif ( is_single() && !is_attachment() ) {
                    if ($show_home_link) echo $sep;
                    if ( get_post_type() != 'post' ) {
                        $post_type = get_post_type_object(get_post_type());
                        $slug = $post_type->rewrite;

                        printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);

                        if ($show_current) echo $sep . $before . get_the_title() . $after;

                    } else {
                        $cat = get_the_category(); $cat = $cat[0];
                        $cats = get_category_parents($cat, TRUE, $sep);

                        // if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
                        // $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
                        // echo $cats;
                        if ( get_query_var('cpage') ) {
                            echo $sep . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
                        } else {
                            // if user locates on single post
                            if ($show_current) echo $link_before . '<a href="' . get_permalink( get_page_by_path( 'blog' ) ) . '">' . $link_in_before . $text['blog'] . $link_in_after . '</a>' . $link_after . $before . $sep . get_the_title() . $after;
                        }
                    }

                // custom post type
                } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                    $post_type = get_post_type_object(get_post_type());
                    if ( get_query_var('paged') ) {
                        echo $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                    } else {
                        if ($show_current) echo $sep . $before . $post_type->label . $after;
                    }
                } elseif ( is_attachment() ) {
                    if ($show_home_link) echo $sep;
                        $parent = get_post($parent_id);
                        $cat = get_the_category( $parent->ID ); $cat = $cat[0];
                    if ($cat) {
                        $cats = get_category_parents( $cat, TRUE, $sep );
                        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
                        echo $cats;
                    }
                    printf($link, get_permalink($parent), $parent->post_title);
                    if ($show_current) echo $sep . $before . get_the_title() . $after;

                } elseif ( is_page() && !$parent_id ) {
                    if ($show_current) echo $sep . $before . get_the_title() . $after;

                } elseif ( is_page() && $parent_id ) {
                    if ( $show_home_link ) echo $sep;
                    if ( $parent_id != $frontpage_id ) {
                        $breadcrumbs = array();
                        while ($parent_id) {
                            $page = get_page($parent_id);
                            if ($parent_id != $frontpage_id) {
                                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                            }
                            $parent_id = $page->post_parent;
                        }
                        $breadcrumbs = array_reverse($breadcrumbs);
                        for ($i = 0; $i < count($breadcrumbs); $i++) {
                            echo $breadcrumbs[$i];
                            if ($i != count($breadcrumbs)-1) echo $sep;
                        }
                    }
                    if ($show_current) echo $sep . $before . get_the_title() . $after;

                } elseif ( is_tag() ) {
                    if ( get_query_var('paged') ) {
                        $tag_id = get_queried_object_id();
                        $tag = get_tag($tag_id);
                        echo $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                    } else {
                        if ($show_current) echo $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
                    }

                } elseif ( is_author() ) {
                    global $author;
                        $author = get_userdata($author);
                    if ( get_query_var('paged') ) {
                    if ($show_home_link) echo $sep;
                        echo sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                    } else {
                        if ($show_home_link && $show_current) echo $sep;
                        if ($show_current) echo $before . sprintf($text['author'], $author->display_name) . $after;
                    }

                } elseif ( is_404() ) {
                    if ($show_home_link && $show_current) echo $sep;
                    if ($show_current) echo $before . $text['404'] . $after;

                } elseif ( has_post_format() && !is_singular() ) {
                    if ($show_home_link) echo $sep;
                    echo get_post_format_string( get_post_format() );
                }

            echo $wrap_after;
        }
    }
}