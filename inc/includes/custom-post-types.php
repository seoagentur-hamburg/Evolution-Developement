<?php
/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Register Custom Post Types
 *
 * @category    Evolution Framework
 * @package     Admin
 * @author        Evolution Themes
 * @license        http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link              https://evolution-themes.com/wordpress-themes/evolution-pro
 */

/** ---------------------------------------------------------
 * Register Intro
 */
function evolution_intro_register() {  
    
	$labels = array(
	 	'name' => __( 'Intros', 'taxonomy general name', 'evolution-pro' ),
		'singular_name' => __( 'Intro', 'evolution-pro' ),
		'search_items' =>  __( 'Search Intros', 'evolution-pro' ),
		'all_items' => __( 'All Intros', 'evolution-pro' ),
		'parent_item' => __( 'Parent Intro', 'evolution-pro' ),
		'edit_item' => __( 'Edit Intro', 'evolution-pro' ),
		'update_item' => __( 'Update Intro', 'evolution-pro' ),
		'add_new_item' => __( 'Add New Intro', 'evolution-pro' ),
	    'menu_name' => __( 'Intro Composer', 'evolution-pro' )
	 );
	 
	 $args = array(
			'labels' => $labels,
			'singular_label' => __( 'Intro', 'evolution-pro' ),
			'public' => false,
			'show_ui' => true,
			'hierarchical' => false,
			'menu_position' => 10,
			'menu_icon' => 'dashicons-slides',
			'exclude_from_search' => true,
			'supports' => 'title' 
       );  
   
    register_post_type( 'evolution_intro' , $args );  
}  

add_action('init', 'evolution_intro_register'); 