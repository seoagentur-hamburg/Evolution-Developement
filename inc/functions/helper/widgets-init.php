<?php
/**
* The Evolution Framework
*
* WARNING: This file is part of the core Evolution Framework. DO NOT edit this file under any circumstances.
* Please do all modifications in the form of a child theme.
*
* This file defines the widget areas
*
* @package Evolution\Functions\
* @author  Andreas Hecht
* @license GPL-2.0+
* @link    https://andreas-hecht.com/wordpress-themes/evolution-wordpress-framework/
*/



/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function evolution_widgets_init() {

    register_sidebar( array( 
        'name'          => esc_html__( 'Header Right', 'evolution' ),
        'id'            => 'header-right',
        'description'   => esc_html__( 'This is the header widget area. It typically appears next to the site title or logo. This widget area is not suitable to display every type of widget, and works best with a search form, or the Social Follow Widget.', 'evolution' ),
        'before_widget' => '<aside id="%1$s" class="header-widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '',
        'after_title'   => '',
    ) );  
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'evolution' ),
        'id'            => 'sidebar',
        'description'   => esc_html__( 'This is the normal sidebar. If you do not use this sidebar, the page will be a one-column design.', 'evolution' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'WooCommerce Sidebar', 'evolution' ),
        'id'            => 'woocommerce',
        'description'   => esc_html__( 'This is the sidebar for your WooCommerce Shop. If you do not use this sidebar, your shop will be a one-column design.', 'evolution' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1', 'evolution' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'From left to right there are 4 sequential footer widget areas, and the width is auto-adjusted based on how many you use. If you do not use a footer widget, nothing will be displayed.', 'evolution' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2', 'evolution' ),
        'id'            => 'footer-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 3', 'evolution' ),
        'id'            => 'footer-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer 4', 'evolution' ),
        'id'            => 'footer-4',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'evolution_widgets_init' );





/**
 * Temporary function to work around the default widgets that get added to
 * Header Right when switching themes.
 *
 * The $defaults array contains a list of the IDs of the widgets that are added
 * to the first sidebar in a new default install. If this exactly matches the
 * widgets in Header Right after switching themes, then they are removed.
 *
 * This works around a perceived WP problem for new installs.
 *
 * If a user amends the list of widgets in the first sidebar before switching to
 * a Genesis child theme, then this function won't do anything.
 * 
 * @author StudioPress
 *
 * @since 1.0.0
 *
 * @return void Return early if not just switched to a new theme.
 */
function evolution_remove_default_widgets_from_header_right() {

    // Some tomfoolery for a faux activation hook.
    if ( ! isset( $_REQUEST['activated'] ) || 'true' !== $_REQUEST['activated'] ) {
        return;
    }

    $widgets  = get_option( 'sidebars_widgets' );
    $defaults = array( 0 => 'search-2', 1 => 'recent-posts-2', 2 => 'recent-comments-2', 3 => 'archives-2', 4 => 'categories-2', 5 => 'meta-2', );

    if ( isset( $widgets['header-right'] ) && $defaults === $widgets['header-right'] ) {
        $widgets['header-right'] = array();
        update_option( 'sidebars_widgets', $widgets );
    }

}
add_action( 'load-themes.php', 'evolution_remove_default_widgets_from_header_right' );