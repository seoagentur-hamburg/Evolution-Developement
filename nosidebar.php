<?php
/**
 * The Evolution Framework.
 * 
 * Template Name: No Sidebar
 * Description: A page template without sidebar. 900px width of content.
 *
 * WARNING: This file is part of the core Evolution Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Evolution\Templates\
 * @author  Andreas Hecht
 * @license GPL-2.0+
 * @link https://andreas-hecht.com/wordpress-themes/evolution-wordpress-framework/
 */

get_header();

do_action( 'evolution_before_page' );

/**
 * Functions hooked in to 'evolution_page' action
 * 
 * @see /inc/structure/evolution-loops.php
 * @see /inc/structure/evolution-hooks.php
 * 
 * @hooked  evolution_top_markup - 5
 * @hooked  evolution_before_page_loop
 * @hooked  evolution_after_page_loop
 * @hooked  evolution_bottom_markup - 30
 */
do_action( 'evolution_do_page' );

get_footer();
