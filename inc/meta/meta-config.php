<?php
/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Config Meta Boxes
 *
 * @category    Evolution Framework
 * @package     Admin
 * @author        Evolution Themes
 * @license        http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link              https://evolution-themes.com/wordpress-themes/evolution-pro
 */


function evolution_config_metaboxes( array $meta_boxes ) {

    $prefix = '_evolution_';

    /* Intro Composer */
    $meta_boxes['intro_composer'] = array(
        'id' => 'intro_composer',
        'title' => __( 'Compose Intro', 'evolution-pro' ),
        'object_types' => array('evolution_intro'),
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'id' => $prefix . 'single_slide',
                'type' => 'group',
                'options' => array(
                    'group_title' => __( 'Slide {#}', 'evolution-pro' ), // since version 1.1.4, {#} gets replaced by row number
                    'add_button' => __( 'Add Another Slide', 'evolution-pro' ),
                    'remove_button' => __( 'Remove Slide', 'evolution-pro' ),
                    'sortable' => true, // beta
                ),
                // Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
                'fields'      => array(
                    array(
                        'name' => __( 'Slide type', 'evolution-pro' ),
                        'description' => __( 'What kind of slide is this?', 'evolution-pro' ),
                        'id' => $prefix . 'slide_type',
                        'type' => 'select',
                        'default' => 'image_bg',
                        'options' => array(
                            'image_bg' => __( 'Image Background', 'evolution-pro' ),
                            'device_mockup' => __( 'Device Mockup', 'evolution-pro' ),
                            'intro_map' => __( 'Map', 'evolution-pro' )
                        )
                    ),
                    array(
                        'name' => __( 'Select image', 'evolution-pro' ),
                        'id' => $prefix . 'slide_select_image',
                        'description' => __( 'Upload the image or type the image URL', 'evolution-pro' ),                        
                        'type' => 'file',
                        'preview_size' => array( 150, 150 )
                        // 'options' => array(
                        //     'url' => false
                        // )
                    ), 
                    array(
                        'name' => __( 'Background color', 'evolution-pro' ),
                        'id' => $prefix . 'slide_bg_color',
                        'type' => 'colorpicker',
                        'default' => '#363842'
                    ),  
                    array(
                        'name' => __( 'Slide font color', 'evolution-pro' ),
                        'id' => $prefix . 'slide_font_color',
                        'type' => 'select',
                        'default' => 'font_light',
                        'options' => array(
                            'font_light' => __( 'Light', 'evolution-pro' ),
                            'font_dark' => __( 'Dark', 'evolution-pro' )
                        )
                    ),
                    array(
                        'name' => __( 'Slide title', 'evolution-pro' ),
                        'id' => $prefix . 'slide_title',
                        'type' => 'text',
                    ),  
                    array(
                        'name' => __( 'Slide subtitle', 'evolution-pro' ),
                        'id' => $prefix . 'slide_subtitle',
                        'type' => 'textarea_code',
                        'description' => __( 'HTML is allowed', 'evolution-pro' ),
                        'attributes'  => array(
                            'rows' => 3
                        )                                                
                    ),   
                    array(
                        'name' => __( 'Credits box', 'evolution-pro' ),
                        'id' => $prefix . 'slide_credits_box',
                        'type' => 'textarea_code',
                        'description' => __( 'HTML is allowed', 'evolution-pro' ),
                        'attributes'  => array(
                            'rows' => 3
                        )                       
                    ), 
                    array(
                        'name' => __( 'Show button', 'evolution-pro' ),
                        'id' => $prefix . 'slide_button_show',
                        'type' => 'checkbox',
                        'description' => __( 'Disable if you want to hide the button', 'evolution-pro' )                        
                    ),   
                    array(
                        'name' => __( 'Button text', 'evolution-pro' ),
                        'id' => $prefix . 'slide_button_text',
                        'type' => 'text'
                    ),   
                    array(
                        'name' => __( 'Button link', 'evolution-pro' ),
                        'id' => $prefix . 'slide_button_link',
                        'type' => 'text_url'
                    ), 
                    array(
                        'name' => __( 'Button style', 'evolution-pro' ),
                        'id' => $prefix . 'slide_button_style',
                        'type' => 'select',
                        'options' => array(
                            'solid' => __( 'Solid', 'evolution-pro' ),
                            'transparent' => __( 'Transparent', 'evolution-pro' )                                                     
                        )                
                    ),   
                    array(
                        'name' => __( 'Button color', 'evolution-pro' ),
                        'id' => $prefix . 'slide_button_color',
                        'type' => 'select',
                        'default' => 'white',
                        'options' => array(
                            'red' => __( 'Red', 'evolution-pro' ),
                            'green' => __( 'Green', 'evolution-pro' ),
                            'blue' => __( 'Blue', 'evolution-pro' ),
                            'white' => __( 'White', 'evolution-pro' ),
                            'grey' => __( 'Grey', 'evolution-pro' ), 
                            'dark-grey' => __( 'Dark grey', 'evolution-pro' )                                                       
                        )
                    ), 
                    array(
                        'name' => __( 'Open link in a new tab?', 'evolution-pro' ),
                        'id' => $prefix . 'slide_button_new_tab',
                        'type' => 'checkbox',
                        'description' => __( 'Check this if you want to open the link in a new page', 'evolution-pro' )                        
                    ),   
                    array(
                        'name' => __( 'Mockup layout', 'evolution-pro' ),
                        'description' => __( 'Specify the caption position', 'evolution-pro' ),                        
                        'id' => $prefix . 'slide_mockup_layout',
                        'type' => 'select',
                        'default' => 'top_caption',
                        'options' => array(
                            'top_caption' => 'Top Caption',
                            'left_caption' => 'Left Caption',
                            'right_caption' => 'Right Caption'             
                        )
                    ),
                    array(
                        'name' => __( 'Map Latitude', 'evolution-pro' ),
                        'description' => __( 'Specify the latitude for the pin (find it out <a href="http://itouchmap.com/latlong.html" target="_blank">here</a>)', 'evolution-pro' ),
                        'id' => $prefix . 'map_latitude',
                        'type' => 'text_small',
                        'default' => '40.714353' 
                    ),  
                    array(
                        'name' => __( 'Map Longitude', 'evolution-pro' ),
                        'description' => __( 'Specify the longitude for the pin (find it out <a href="http://itouchmap.com/latlong.html" target="_blank">here</a>)', 'evolution-pro' ),
                        'id' => $prefix . 'map_longitude',
                        'type' => 'text_small',
                        'default' => '-74.005973' 
                    ),   
                    array(
                        'name' => __( 'Map zoom level', 'evolution-pro' ),
                        'description' => __( 'The initial resolution at which to display the map', 'evolution-pro' ),
                        'id' => $prefix . 'map_zoom',
                        'type' => 'text_small',
                        'default' => '7' 
                    ),
                    array(
                        'name' => __( 'Map style', 'evolution-pro' ),
                        'id' => $prefix . 'map_style',
                        'type' => 'select',
                        'description' => __( 'Choose a style preset for your map', 'evolution-pro' ),                        
                        'default' => 'default',
                        'options' => array(
                            'default' => __( 'Default', 'evolution-pro' ),
                            'invert' => __( 'Reversed colors', 'evolution-pro' )                                                          
                        )
                    ),  
                    array(
                        'name' => __( 'Image marker', 'evolution-pro' ),
                        'id' => $prefix . 'map_marker',
                        'description' => __( 'Set a different image for the marker. Default marker URL:<br><strong>' . get_template_directory_uri() . '/evolution/includes/img/marker-red.png</strong>', 'evolution-pro' ),                        
                        'type' => 'file'
                    ),     
                    array(
                        'name' => __( 'Tooltip content', 'evolution-pro' ),
                        'id' => $prefix . 'map_tooltip',
                        'type' => 'text',
                        'description' => __( 'Type here what you want to show in the tooltip', 'evolution-pro' )                        
                    ),                                                                                                 
                    array(
                        'name' => __( 'Extra class', 'evolution-pro' ),
                        'id' => $prefix . 'slide_extra_class',
                        'type' => 'text',
                        'description' => __( 'Type a custom class name for CSS purposes', 'evolution-pro' )
                    ),
                    array(
                        'name' => __( '<span class="intro-more-options">[+] Show more options</span>', 'evolution-pro' ),
                        'type' => 'title',
                        'id' => $prefix . 'slide_more_options_trigger'
                    )                                                                                                                                                                                                                                                               
                )
            )
        )
    );
//$screens = get_post_types();
    /* Call Intro */
    $meta_boxes['select_intro'] = array(
        'id' => 'select_intro',
        'title' => __( 'Intro settings', 'evolution-pro' ),
        'object_types' => get_post_types( array(
                'public' => true
            ) ), //Add Intros to all existing and new created post types
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __( 'Select Intro', 'evolution-pro' ),
                'desc' => __( 'Choose one', 'evolution-pro' ),
                'description' => __( 'Pick an <a href="'. admin_url( 'edit.php?post_type=evolution_intro' ) .'">precomposed intro</a> or use the <strong>Featured image</strong> to show into the intro area', 'evolution-pro' ),
                'id' => $prefix . 'select_intro_parse',
                'type' => 'pw_select',
                'sanitization_cb' => 'pw_select2_sanitise',
                'options' => cmb_get_post_options( array( 'post_type' => 'evolution_intro', 'posts_per_page' => -1 ) ),
            ),
            array(
                'name' => __( 'Height', 'evolution-pro' ),
                'description' => __( 'Intro height in em (e.g. 33,333). <span>It is about <strong class="approxpx"></strong> on desktop version</span>', 'evolution-pro' ),
                'id' => $prefix . 'intro_height',
                'type' => 'text_small',
                //'default' => '33.333',
                'attributes' => array(
                    'type' => 'number',
                    'step' => 0.001,
                    'pattern' => '\d*',
                )  
            ),  
            array(
                'name' => __( 'Full height', 'evolution-pro' ),
                'id' => $prefix . 'intro_full_height',
                'type' => 'checkbox',
                'description' => __( 'When checked, this setting overwrites any height value', 'evolution-pro' )                        
            ),    
            array(
                'name' => __( 'Autoplay', 'evolution-pro' ),
                'id' => $prefix . 'intro_autoplay',
                'type' => 'text_small',
                'description' => __( 'Ms (milliseconds) value (e.g. type &quot;5000&quot; for 5 seconds). Leave it blank to disable autoplay', 'evolution-pro' ),
                //'default' => '5000',
                'attributes' => array(
                    'type' => 'number',
                    'step' => 100,
                    'pattern' => '\d*',                    
                )                                         
            ),
            array(
                'name' => __( 'Transition', 'evolution-pro' ),
                'id' => $prefix . 'intro_transition',
                'type' => 'select',
                'description' => __( 'CSS transition style for the slider', 'evolution-pro' ),                        
                'default' => 'fade',
                'options' => array(
                    'none' => __( 'None', 'evolution-pro' ),                    
                    'fade' => __( 'Fade', 'evolution-pro' ),
                    'backSlide' => __( 'Back Slide', 'evolution-pro' ),
                    'goDown' => __( 'Go Down', 'evolution-pro' ),
                    'fadeUp' => __( 'Fade Up', 'evolution-pro' ),
                    'scaleDown' => __( 'Scale Down', 'evolution-pro' ),
                    'scaleDownRight' => __( 'Scale Down Right', 'evolution-pro' ),                    
                    'scaleUpLeft' => __( 'Scale Up Left', 'evolution-pro' ),
                    'fadeTop' => __( 'Fade top', 'evolution-pro' ),
                    'overlap' => __( 'Overlap', 'evolution-pro' )                                                                                
                )
            ),    
            array(
                'name' => __( 'Show arrows', 'evolution-pro' ),
                'id' => $prefix . 'intro_navigation',
                'type' => 'checkbox',
                'description' => __( 'Arrows show up just in case intro has two or more slide', 'evolution-pro' )                        
            ), 
            array(
                'name' => __( 'Show bullets', 'evolution-pro' ),
                'id' => $prefix . 'intro_pagination',
                'type' => 'checkbox',
                'description' => __( 'Bullets show up just in case intro has two or more slide', 'evolution-pro' )                        
            ), 
            array(
                'name' => __( 'Show scroll arrow', 'evolution-pro' ),
                'id' => $prefix . 'intro_scroll_arrow',
                'type' => 'checkbox',
                'description' => __( 'Disabled if &lsquo;Show bullets&rsquo; is enabled', 'evolution-pro' )                        
            ),   
            array(
                'name' => __( 'Darken layer', 'evolution-pro' ),
                'id' => $prefix . 'intro_darken',
                'type' => 'checkbox',
                'description' => __( 'Enable to make images darker. It has no effect on &lsquo;Device mockup&rsquo; slides', 'evolution-pro' )                        
            )                                                                                            
        )      
    );
    
    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'evolution_config_metaboxes' );

/* See https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Adding-your-own-field-types#example-3-posts-or-other-post_type-dropdown-store-post_id */
function cmb_get_post_options( $query_args ) {

    $args = wp_parse_args( $query_args, array(
        'post_type' => 'evolution_intro',
        'posts_per_page' => -1
    ) );

    $intros = get_posts( $args );

    $intro_options = array();
    if ( $intros ) {
        foreach ( $intros as $intro ) {
           $intro_options[] = array(
               'name' => $intro->post_title,
               'value' => $intro->ID
           );
        }
    }

    // Set a new array for featured image
    $thumb_image = array(
        'name' => __( 'Use the Featured image', 'evolution-pro' ),
        'value' => 'featured_image'
    );

    // Unshift array: http://php.net/manual/en/function.array-unshift.php
    array_unshift( $intro_options, $thumb_image );

    return $intro_options;
}
