<?php
/*
 WARNING: This file is part of the core Evolution framework. DO NOT edit
 this file under any circumstances. Please do all modifications
 in the form of a child theme.
 */

/**
 * Building the Shortcode Panel
 *
 * @category    Evolution Framework
 * @package     Admin
 * @author        Evolution Themes
 * @license        http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link              https://evolution-themes.com/wordpress-themes/evolution-pro
 */


/**
 * Loading Scripts & Styles
 */
function enqueue_shortcodes_scripts() {

    wp_enqueue_style( 'evolution-shortcode-css', get_template_directory_uri() . '/inc/shortcodes/includes/css/evolution-shortcode.css' ); 
    wp_enqueue_style( 'chosen', get_template_directory_uri() . '/inc/shortcodes/includes/css/chosen/chosen.css' ); 
    wp_enqueue_style( 'noUi-Slider-css', get_template_directory_uri() . '/inc/shortcodes/includes/css/jquery.nouislider.css' ); 
    
    wp_register_style( 'evolution-fontawesome', get_template_directory_uri() . '/css/font-awesome.css' );
    wp_enqueue_style('evolution-fontawesome');
		 
    wp_enqueue_script( 'chosen', get_template_directory_uri() . '/inc/shortcodes/includes/js/chosen.jquery.min.js','jquery','1.1.0 ', TRUE );
    wp_enqueue_script( 'noUi-Slider-js', get_template_directory_uri() . '/inc/shortcodes/includes/js/jquery.nouislider.all.js','jquery','7.0.9 ', TRUE );
	
    wp_enqueue_style( 'magnific', get_template_directory_uri() . '/inc/shortcodes/includes/css/magnific-popup.css' ); 
    wp_enqueue_script( 'magnific', get_template_directory_uri() . '/inc/shortcodes/includes/js/magnific-popup.js','jquery','0.9.7 ', TRUE );
    
    wp_enqueue_script( 'wp-color-picker' );
	
    wp_enqueue_script( 'evolution-shortcode-js', get_template_directory_uri() . '/inc/shortcodes/includes/js/evolution-shortcode.js','jquery',EVOLUTION_THEME_VERSION , TRUE );
	
}

add_action( 'admin_enqueue_scripts','enqueue_shortcodes_scripts' );


/**
 * Shortcodes
 */
function content_display() {
		
	$evolution_shortcodes['header_sections'] = array( 
		'type' => 'heading', 
		'title' => __( 'Fullwidth Sections', 'evolution-pro' )
	);

	$evolution_shortcodes['section'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'Fullwidth Section', 'evolution-pro' ), 
		'attr' => array( 
			'background_color' => array(
				'type' => 'color',
				'title'  => __( 'Background color', 'evolution-pro' )
			),
			'text_color' => array(
				'type' => 'select',
				'title' => __( 'Text color', 'evolution-pro' ),
				'values' => array(
				    'dark' => 'Dark',
			  		'light' => 'Light'
				)			
			),
			'title' => array(
				'type' => 'text', 
				'title' => __( 'Section title', 'evolution-pro' )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', 'evolution-pro' ),
				'desc' => __( 'Type a custom class name for CSS purposes', 'evolution-pro' )
			),			
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', 'evolution-pro' ),
				'desc' => __( 'Use <strong>Full Width Sections</strong> only on <strong>Blank page</strong> templates!', 'evolution-pro' )
			)					
		)
	);
    
    $evolution_shortcodes['smallcontent'] = array( 
        'type' => 'enclosing', 
        'title' => __( 'Small Content (900px) Section', 'evolution-pro' ), 
        'attr' => array( 
            'background_color' => array(
                'type' => 'color',
                'title'  => __( 'Background color', 'evolution-pro' )
            ),
            'text_color' => array(
                'type' => 'select',
                'title' => __( 'Text color', 'evolution-pro' ),
                'values' => array(
                    'dark' => 'Dark',
                    'light' => 'Light'
                )			
            ),
            'title' => array(
                'type' => 'text', 
                'title' => __( 'Section title', 'evolution-pro' )
            ),
            'extra_class' => array(
                'type' => 'text', 
                'title' => __( 'Extra class', 'evolution-pro' ),
                'desc' => __( 'Type a custom class name for CSS purposes', 'evolution-pro' )
            ),				
            'info' => array(
                'type' => 'infobox',
                'title' => __( 'Note:', 'evolution-pro' ),
                'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>small content</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', 'evolution-pro' )
            )			
        )
    );

	$evolution_shortcodes['header_columns'] = array( 
		'type' => 'heading', 
		'title' => __( 'Columns', 'evolution-pro' )
	);

	$evolution_shortcodes['onehalf'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'One Half (1/2)', 'evolution-pro' ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', 'evolution-pro' )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', 'evolution-pro' ),
				'desc' => __( 'Check this to center the column content', 'evolution-pro' )
			),
			'last' => array(
				'type' => 'checkbox',
				'title' => __( 'Last column', 'evolution-pro' ),
				'desc' => __( 'Check this if it&lsquo;s the last column in the row', 'evolution-pro' )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', 'evolution-pro' ),
				'desc' => __( 'Type a custom class name for CSS purposes', 'evolution-pro' )
			),	
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', 'evolution-pro' ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template,  nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', 'evolution-pro' )
			)
		)
	);

	$evolution_shortcodes['onethird'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'One Third (1/3)', 'evolution-pro' ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', 'evolution-pro' )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', 'evolution-pro' ),
				'desc' => __( 'Check this to center the column content', 'evolution-pro' )
			),
			'last' => array(
				'type' => 'checkbox',
				'title' => __( 'Last column', 'evolution-pro' ),
				'desc' => __( 'Check this if it&lsquo;s the last column in the row', 'evolution-pro' )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', 'evolution-pro' ),
				'desc' => __( 'Type a custom class name for CSS purposes', 'evolution-pro' )
			),	
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', 'evolution-pro' ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', 'evolution-pro' )
			)
		)
	);

	$evolution_shortcodes['twothirds'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'Two Thirds (2/3)', 'evolution-pro' ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', 'evolution-pro' )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', 'evolution-pro' ),
				'desc' => __( 'Check this to center the column content', 'evolution-pro' )
			),
			'last' => array(
				'type' => 'checkbox',
				'title' => __( 'Last column', 'evolution-pro' ),
				'desc' => __( 'Check this if it&lsquo;s the last column in the row', 'evolution-pro' )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', 'evolution-pro' ),
				'desc' => __( 'Type a custom class name for CSS purposes', 'evolution-pro' )
			),	
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', 'evolution-pro' ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', 'evolution-pro' )
			)
		)
	);

	$evolution_shortcodes['onefourth'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'One Fourth (1/4)', 'evolution-pro' ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', 'evolution-pro' )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', 'evolution-pro' ),
				'desc' => __( 'Check this to center the column content', 'evolution-pro' )
			),
			'last' => array(
				'type' => 'checkbox',
				'title' => __( 'Last column', 'evolution-pro' ),
				'desc' => __( 'Check this if it&lsquo;s the last column in the row', 'evolution-pro' )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', 'evolution-pro' ),
				'desc' => __( 'Type a custom class name for CSS purposes', 'evolution-pro' )
			),	
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', 'evolution-pro' ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', 'evolution-pro' )
			)
		)
	);

	$evolution_shortcodes['threefourths'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'Three Fourths (3/4)', 'evolution-pro' ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', 'evolution-pro' )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', 'evolution-pro' ),
				'desc' => __( 'Check this to center the column content', 'evolution-pro' )
			),
			'last' => array(
				'type' => 'checkbox',
				'title' => __( 'Last column', 'evolution-pro' ),
				'desc' => __( 'Check this if it&lsquo;s the last column in the row', 'evolution-pro' )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', 'evolution-pro' ),
				'desc' => __( 'Type a custom class name for CSS purposes', 'evolution-pro' )
			),	
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', 'evolution-pro' ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', 'evolution-pro' )
			)
		)
	);

	$evolution_shortcodes['onesixth'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'One Sixth (1/6)', 'evolution-pro' ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', 'evolution-pro' )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', 'evolution-pro' ),
				'desc' => __( 'Check this to center the column content', 'evolution-pro' )
			),
			'last' => array(
				'type' => 'checkbox',
				'title' => __( 'Last column', 'evolution-pro' ),
				'desc' => __( 'Check this if it&lsquo;s the last column in the row', 'evolution-pro' )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', 'evolution-pro' ),
				'desc' => __( 'Type a custom class name for CSS purposes', 'evolution-pro' )
			),	
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', 'evolution-pro' ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', 'evolution-pro' )
			)
		)
	);

	$evolution_shortcodes['fivesixths'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'Five Sixth (5/6)', 'evolution-pro' ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', 'evolution-pro' )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', 'evolution-pro' ),
				'desc' => __( 'Check this to center the column content', 'evolution-pro' )
			),
			'last' => array(
				'type' => 'checkbox',
				'title' => __( 'Last column', 'evolution-pro' ),
				'desc' => __( 'Check this if it&lsquo;s the last column in the row', 'evolution-pro' )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', 'evolution-pro' ),
				'desc' => __( 'Type a custom class name for CSS purposes', 'evolution-pro' )
			),	
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', 'evolution-pro' ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', 'evolution-pro' )
			)
		)
	);

	$evolution_shortcodes['onewhole'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'One Whole (1/1)', 'evolution-pro' ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Column content', 'evolution-pro' )
			),
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered text', 'evolution-pro' ),
				'desc' => __( 'Check this to center the column content', 'evolution-pro' )
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', 'evolution-pro' ),
				'desc' => __( 'Type a custom class name for CSS purposes', 'evolution-pro' )
			),				
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', 'evolution-pro' ),
				'desc' => __( 'If you are using a <strong>Blank page</strong> template, we recommend to nest <strong>columns</strong> shortcodes into a <strong>Full Width Section</strong> shortcode.', 'evolution-pro' )
			)			
		)
	);

	$evolution_shortcodes['header_elements'] = array( 
		'type' => 'heading', 
		'title' => __( 'Element Shortcodes', 'evolution-pro' )
	); 

	$evolution_shortcodes['button'] = array( 
		'type' => 'self_closing',
		'title' => __( 'Buttons', 'evolution-pro' ), 
		'attr' => array(
			'text' => array(
				'type' => 'text', 
				'title' => __( 'Button text', 'evolution-pro' ),
				'default' => __( 'Button', 'evolution-pro' )
			),	
			'url' => array(
				'type' => 'text', 
				'title' => __( 'Button link', 'evolution-pro' )
			),
			'style' => array(
				'type' => 'select',
				'title' => __( 'Button style', 'evolution-pro' ),
				'values' => array(
				    'solid' => __( 'Solid', 'evolution-pro' ),
			  		'transparent' => __( 'Transparent', 'evolution-pro' )
				)			
			),					
			'color' => array(
			    'type' => 'select',
			    'title' => __( 'Button color', 'evolution-pro' ),
			    'values' => array(
			        'red' => __( 'Red', 'evolution-pro' ),
			        'green' => __( 'Green', 'evolution-pro' ),
			        'blue' => __( 'Blue', 'evolution-pro' ), 
			        'white' => __( 'White', 'evolution-pro' ),
			        'dark-grey' => __( 'Dark grey', 'evolution-pro' )                                                       
			    )
			), 
			'open_new_tab' => array(
				'type' => 'checkbox', 
				'title' => __( 'Open link in a new tab?', 'evolution-pro' ),
				'desc' => __( 'Check this if you want to open the link in a new page', 'evolution-pro' ),
				//'default' => 'on'			
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', 'evolution-pro' ),
				'desc' => __( 'Type a custom class name for CSS purposes', 'evolution-pro' )
			)			
		) 
	);
	$fa_icons = array(
		'icon-glass' => 'icon-glass',
		'icon-music' => 'icon-music',
		'icon-search' => 'icon-search',
		'icon-envelope-o' => 'icon-envelope-o',
		'icon-heart' => 'icon-heart',
		'icon-star' => 'icon-star',
		'icon-star-o' => 'icon-star-o',
		'icon-user' => 'icon-user',
		'icon-film' => 'icon-film',
		'icon-th-large' => 'icon-th-large',
		'icon-th' => 'icon-th',
		'icon-th-list' => 'icon-th-list',
		'icon-check' => 'icon-check',
		'icon-remove' => 'icon-remove',
		'icon-search-plus' => 'icon-search-plus',
		'icon-search-minus' => 'icon-search-minus',
		'icon-power-off' => 'icon-power-off',
		'icon-signal' => 'icon-signal',
		'icon-cog' => 'icon-cog',
		'icon-trash-o' => 'icon-trash-o',
		'icon-home' => 'icon-home',
		'icon-file-o' => 'icon-file-o',
		'icon-clock-o' => 'icon-clock-o',
		'icon-road' => 'icon-road',
		'icon-download' => 'icon-download',
		'icon-arrow-circle-o-down' => 'icon-arrow-circle-o-down',
		'icon-arrow-circle-o-up' => 'icon-arrow-circle-o-up',
		'icon-inbox' => 'icon-inbox',
		'icon-play-circle-o' => 'icon-play-circle-o',
		'icon-repeat' => 'icon-repeat',
		'icon-refresh' => 'icon-refresh',
		'icon-list-alt' => 'icon-list-alt',
		'icon-lock' => 'icon-lock',
		'icon-flag' => 'icon-flag',
		'icon-headphones' => 'icon-headphones',
		'icon-volume-off' => 'icon-volume-off',
		'icon-volume-down' => 'icon-volume-down',
		'icon-volume-up' => 'icon-volume-up',
		'icon-qrcode' => 'icon-qrcode',
		'icon-barcode' => 'icon-barcode',
		'icon-tag' => 'icon-tag',
		'icon-tags' => 'icon-tags',
		'icon-book' => 'icon-book',
		'icon-bookmark' => 'icon-bookmark',
		'icon-print' => 'icon-print',
		'icon-camera' => 'icon-camera',
		'icon-font' => 'icon-font',
		'icon-bold' => 'icon-bold',
		'icon-italic' => 'icon-italic',
		'icon-text-height' => 'icon-text-height',
		'icon-text-width' => 'icon-text-width',
		'icon-align-left' => 'icon-align-left',
		'icon-align-center' => 'icon-align-center',
		'icon-align-right' => 'icon-align-right',
		'icon-align-justify' => 'icon-align-justify',
		'icon-list' => 'icon-list',
		'icon-outdent' => 'icon-outdent',
		'icon-indent' => 'icon-indent',
		'icon-video-camera' => 'icon-video-camera',
		'icon-image' => 'icon-image',
		'icon-pencil' => 'icon-pencil',
		'icon-map-marker' => 'icon-map-marker',
		'icon-adjust' => 'icon-adjust',
		'icon-tint' => 'icon-tint',
		'icon-edit' => 'icon-edit',
		'icon-share-square-o' => 'icon-share-square-o',
		'icon-check-square-o' => 'icon-check-square-o',
		'icon-arrows' => 'icon-arrows',
		'icon-step-backward' => 'icon-step-backward',
		'icon-fast-backward' => 'icon-fast-backward',
		'icon-backward' => 'icon-backward',
		'icon-play' => 'icon-play',
		'icon-pause' => 'icon-pause',
		'icon-stop' => 'icon-stop',
		'icon-forward' => 'icon-forward',
		'icon-fast-forward' => 'icon-fast-forward',
		'icon-step-forward' => 'icon-step-forward',
		'icon-eject' => 'icon-eject',
		'icon-chevron-left' => 'icon-chevron-left',
		'icon-chevron-right' => 'icon-chevron-right',
		'icon-plus-circle' => 'icon-plus-circle',
		'icon-minus-circle' => 'icon-minus-circle',
		'icon-times-circle' => 'icon-times-circle',
		'icon-check-circle' => 'icon-check-circle',
		'icon-question-circle' => 'icon-question-circle',
		'icon-info-circle' => 'icon-info-circle',
		'icon-crosshairs' => 'icon-crosshairs',
		'icon-times-circle-o' => 'icon-times-circle-o',
		'icon-check-circle-o' => 'icon-check-circle-o',
		'icon-ban' => 'icon-ban',
		'icon-arrow-left' => 'icon-arrow-left',
		'icon-arrow-right' => 'icon-arrow-right',
		'icon-arrow-up' => 'icon-arrow-up',
		'icon-arrow-down' => 'icon-arrow-down',
		'icon-share' => 'icon-share',
		'icon-expand' => 'icon-expand',
		'icon-compress' => 'icon-compress',
		'icon-plus' => 'icon-plus',
		'icon-minus' => 'icon-minus',
		'icon-asterisk' => 'icon-asterisk',
		'icon-exclamation-circle' => 'icon-exclamation-circle',
		'icon-gift' => 'icon-gift',
		'icon-leaf' => 'icon-leaf',
		'icon-fire' => 'icon-fire',
		'icon-eye' => 'icon-eye',
		'icon-eye-slash' => 'icon-eye-slash',
		'icon-warning' => 'icon-warning',
		'icon-plane' => 'icon-plane',
		'icon-calendar' => 'icon-calendar',
		'icon-random' => 'icon-random',
		'icon-comment' => 'icon-comment',
		'icon-magnet' => 'icon-magnet',
		'icon-chevron-up' => 'icon-chevron-up',
		'icon-chevron-down' => 'icon-chevron-down',
		'icon-retweet' => 'icon-retweet',
		'icon-shopping-cart' => 'icon-shopping-cart',
		'icon-folder' => 'icon-folder',
		'icon-folder-open' => 'icon-folder-open',
		'icon-arrows-v' => 'icon-arrows-v',
		'icon-arrows-h' => 'icon-arrows-h',
		'icon-bar-chart' => 'icon-bar-chart',
		'icon-twitter-square' => 'icon-twitter-square',
		'icon-facebook-square' => 'icon-facebook-square',
		'icon-camera-retro' => 'icon-camera-retro',
		'icon-key' => 'icon-key',
		'icon-cogs' => 'icon-cogs',
		'icon-comments' => 'icon-comments',
		'icon-thumbs-o-up' => 'icon-thumbs-o-up',
		'icon-thumbs-o-down' => 'icon-thumbs-o-down',
		'icon-star-half' => 'icon-star-half',
		'icon-heart-o' => 'icon-heart-o',
		'icon-sign-out' => 'icon-sign-out',
		'icon-linkedin-square' => 'icon-linkedin-square',
		'icon-thumb-tack' => 'icon-thumb-tack',
		'icon-external-link' => 'icon-external-link',
		'icon-sign-in' => 'icon-sign-in',
		'icon-trophy' => 'icon-trophy',
		'icon-github-square' => 'icon-github-square',
		'icon-upload' => 'icon-upload',
		'icon-lemon-o' => 'icon-lemon-o',
		'icon-phone' => 'icon-phone',
		'icon-square-o' => 'icon-square-o',
		'icon-bookmark-o' => 'icon-bookmark-o',
		'icon-phone-square' => 'icon-phone-square',
		'icon-twitter' => 'icon-twitter',
		'icon-facebook' => 'icon-facebook',
		'icon-github' => 'icon-github',
		'icon-unlock' => 'icon-unlock',
		'icon-credit-card' => 'icon-credit-card',
		'icon-rss' => 'icon-rss',
		'icon-hdd-o' => 'icon-hdd-o',
		'icon-bullhorn' => 'icon-bullhorn',
		'icon-bell' => 'icon-bell',
		'icon-certificate' => 'icon-certificate',
		'icon-hand-o-right' => 'icon-hand-o-right',
		'icon-hand-o-left' => 'icon-hand-o-left',
		'icon-hand-o-up' => 'icon-hand-o-up',
		'icon-hand-o-down' => 'icon-hand-o-down',
		'icon-arrow-circle-left' => 'icon-arrow-circle-left',
		'icon-arrow-circle-right' => 'icon-arrow-circle-right',
		'icon-arrow-circle-up' => 'icon-arrow-circle-up',
		'icon-arrow-circle-down' => 'icon-arrow-circle-down',
		'icon-globe' => 'icon-globe',
		'icon-wrench' => 'icon-wrench',
		'icon-tasks' => 'icon-tasks',
		'icon-filter' => 'icon-filter',
		'icon-briefcase' => 'icon-briefcase',
		'icon-arrows-alt' => 'icon-arrows-alt',
		'icon-group' => 'icon-group',
		'icon-link' => 'icon-link',
		'icon-cloud' => 'icon-cloud',
		'icon-flask' => 'icon-flask',
		'icon-cut' => 'icon-cut',
		'icon-copy' => 'icon-copy',
		'icon-paperclip' => 'icon-paperclip',
		'icon-save' => 'icon-save',
		'icon-square' => 'icon-square',
		'icon-reorder' => 'icon-reorder',
		'icon-list-ul' => 'icon-list-ul',
		'icon-list-ol' => 'icon-list-ol',
		'icon-strikethrough' => 'icon-strikethrough',
		'icon-underline' => 'icon-underline',
		'icon-table' => 'icon-table',
		'icon-magic' => 'icon-magic',
		'icon-truck' => 'icon-truck',
		'icon-pinterest' => 'icon-pinterest',
		'icon-pinterest-square' => 'icon-pinterest-square',
		'icon-google-plus-square' => 'icon-google-plus-square',
		'icon-google-plus' => 'icon-google-plus',
		'icon-money' => 'icon-money',
		'icon-caret-down' => 'icon-caret-down',
		'icon-caret-up' => 'icon-caret-up',
		'icon-caret-left' => 'icon-caret-left',
		'icon-caret-right' => 'icon-caret-right',
		'icon-columns' => 'icon-columns',
		'icon-sort' => 'icon-sort',
		'icon-sort-down' => 'icon-sort-down',
		'icon-sort-up' => 'icon-sort-up',
		'icon-envelope' => 'icon-envelope',
		'icon-linkedin' => 'icon-linkedin',
		'icon-undo' => 'icon-undo',
		'icon-legal' => 'icon-legal',
		'icon-dashboard' => 'icon-dashboard',
		'icon-comment-o' => 'icon-comment-o',
		'icon-comments-o' => 'icon-comments-o',
		'icon-bolt' => 'icon-bolt',
		'icon-sitemap' => 'icon-sitemap',
		'icon-umbrella' => 'icon-umbrella',
		'icon-paste' => 'icon-paste',
		'icon-lightbulb-o' => 'icon-lightbulb-o',
		'icon-exchange' => 'icon-exchange',
		'icon-cloud-download' => 'icon-cloud-download',
		'icon-cloud-upload' => 'icon-cloud-upload',
		'icon-user-md' => 'icon-user-md',
		'icon-stethoscope' => 'icon-stethoscope',
		'icon-suitcase' => 'icon-suitcase',
		'icon-bell-o' => 'icon-bell-o',
		'icon-coffee' => 'icon-coffee',
		'icon-cutlery' => 'icon-cutlery',
		'icon-file-text-o' => 'icon-file-text-o',
		'icon-building-o' => 'icon-building-o',
		'icon-hospital-o' => 'icon-hospital-o',
		'icon-ambulance' => 'icon-ambulance',
		'icon-medkit' => 'icon-medkit',
		'icon-fighter-jet' => 'icon-fighter-jet',
		'icon-beer' => 'icon-beer',
		'icon-h-square' => 'icon-h-square',
		'icon-plus-square' => 'icon-plus-square',
		'icon-angle-double-left' => 'icon-angle-double-left',
		'icon-angle-double-right' => 'icon-angle-double-right',
		'icon-angle-double-up' => 'icon-angle-double-up',
		'icon-angle-double-down' => 'icon-angle-double-down',
		'icon-angle-left' => 'icon-angle-left',
		'icon-angle-right' => 'icon-angle-right',
		'icon-angle-up' => 'icon-angle-up',
		'icon-angle-down' => 'icon-angle-down',
		'icon-desktop' => 'icon-desktop',
		'icon-laptop' => 'icon-laptop',
		'icon-tablet' => 'icon-tablet',
		'icon-mobile-phone' => 'icon-mobile-phone',
		'icon-circle-o' => 'icon-circle-o',
		'icon-quote-left' => 'icon-quote-left',
		'icon-quote-right' => 'icon-quote-right',
		'icon-spinner' => 'icon-spinner',
		'icon-circle' => 'icon-circle',
		'icon-reply' => 'icon-reply',
		'icon-github-alt' => 'icon-github-alt',
		'icon-folder-o' => 'icon-folder-o',
		'icon-folder-open-o' => 'icon-folder-open-o',
		'icon-smile-o' => 'icon-smile-o',
		'icon-frown-o' => 'icon-frown-o',
		'icon-meh-o' => 'icon-meh-o',
		'icon-gamepad' => 'icon-gamepad',
		'icon-keyboard-o' => 'icon-keyboard-o',
		'icon-flag-o' => 'icon-flag-o',
		'icon-flag-checkered' => 'icon-flag-checkered',
		'icon-terminal' => 'icon-terminal',
		'icon-code' => 'icon-code',
		'icon-reply-all' => 'icon-reply-all',
		'icon-star-half-o' => 'icon-star-half-o',
		'icon-location-arrow' => 'icon-location-arrow',
		'icon-crop' => 'icon-crop',
		'icon-code-fork' => 'icon-code-fork',
		'icon-unlink' => 'icon-unlink',
		'icon-question' => 'icon-question',
		'icon-info' => 'icon-info',
		'icon-exclamation' => 'icon-exclamation',
		'icon-superscript' => 'icon-superscript',
		'icon-subscript' => 'icon-subscript',
		'icon-eraser' => 'icon-eraser',
		'icon-puzzle-piece' => 'icon-puzzle-piece',
		'icon-microphone' => 'icon-microphone',
		'icon-microphone-slash' => 'icon-microphone-slash',
		'icon-shield' => 'icon-shield',
		'icon-calendar-o' => 'icon-calendar-o',
		'icon-fire-extinguisher' => 'icon-fire-extinguisher',
		'icon-rocket' => 'icon-rocket',
		'icon-maxcdn' => 'icon-maxcdn',
		'icon-chevron-circle-left' => 'icon-chevron-circle-left',
		'icon-chevron-circle-right' => 'icon-chevron-circle-right',
		'icon-chevron-circle-up' => 'icon-chevron-circle-up',
		'icon-chevron-circle-down' => 'icon-chevron-circle-down',
		'icon-html5' => 'icon-html5',
		'icon-css3' => 'icon-css3',
		'icon-anchor' => 'icon-anchor',
		'icon-unlock-alt' => 'icon-unlock-alt',
		'icon-bullseye' => 'icon-bullseye',
		'icon-ellipsis-h' => 'icon-ellipsis-h',
		'icon-ellipsis-v' => 'icon-ellipsis-v',
		'icon-rss-square' => 'icon-rss-square',
		'icon-play-circle' => 'icon-play-circle',
		'icon-ticket' => 'icon-ticket',
		'icon-minus-square' => 'icon-minus-square',
		'icon-minus-square-o' => 'icon-minus-square-o',
		'icon-level-up' => 'icon-level-up',
		'icon-level-down' => 'icon-level-down',
		'icon-check-square' => 'icon-check-square',
		'icon-pencil-square' => 'icon-pencil-square',
		'icon-external-link-square' => 'icon-external-link-square',
		'icon-share-square' => 'icon-share-square',
		'icon-compass' => 'icon-compass',
		'icon-toggle-down' => 'icon-toggle-down',
		'icon-toggle-up' => 'icon-toggle-up',
		'icon-toggle-right' => 'icon-toggle-right',
		'icon-eur' => 'icon-eur',
		'icon-gbp' => 'icon-gbp',
		'icon-usd' => 'icon-usd',
		'icon-inr' => 'icon-inr',
		'icon-jpy' => 'icon-jpy',
		'icon-rub' => 'icon-rub',
		'icon-krw' => 'icon-krw',
		'icon-btc' => 'icon-btc',
		'icon-file' => 'icon-file',
		'icon-file-text' => 'icon-file-text',
		'icon-sort-alpha-asc' => 'icon-sort-alpha-asc',
		'icon-sort-alpha-desc' => 'icon-sort-alpha-desc',
		'icon-sort-amount-asc' => 'icon-sort-amount-asc',
		'icon-sort-amount-desc' => 'icon-sort-amount-desc',
		'icon-sort-numeric-asc' => 'icon-sort-numeric-asc',
		'icon-sort-numeric-desc' => 'icon-sort-numeric-desc',
		'icon-thumbs-up' => 'icon-thumbs-up',
		'icon-thumbs-down' => 'icon-thumbs-down',
		'icon-youtube-square' => 'icon-youtube-square',
		'icon-youtube' => 'icon-youtube',
		'icon-xing' => 'icon-xing',
		'icon-xing-square' => 'icon-xing-square',
		'icon-youtube-play' => 'icon-youtube-play',
		'icon-dropbox' => 'icon-dropbox',
		'icon-stack-overflow' => 'icon-stack-overflow',
		'icon-instagram' => 'icon-instagram',
		'icon-flickr' => 'icon-flickr',
		'icon-adn' => 'icon-adn',
		'icon-bitbucket' => 'icon-bitbucket',
		'icon-bitbucket-square' => 'icon-bitbucket-square',
		'icon-tumblr' => 'icon-tumblr',
		'icon-tumblr-square' => 'icon-tumblr-square',
		'icon-long-arrow-down' => 'icon-long-arrow-down',
		'icon-long-arrow-up' => 'icon-long-arrow-up',
		'icon-long-arrow-left' => 'icon-long-arrow-left',
		'icon-long-arrow-right' => 'icon-long-arrow-right',
		'icon-apple' => 'icon-apple',
		'icon-windows' => 'icon-windows',
		'icon-android' => 'icon-android',
		'icon-linux' => 'icon-linux',
		'icon-dribbble' => 'icon-dribbble',
		'icon-skype' => 'icon-skype',
		'icon-foursquare' => 'icon-foursquare',
		'icon-trello' => 'icon-trello',
		'icon-female' => 'icon-female',
		'icon-male' => 'icon-male',
		'icon-gittip' => 'icon-gittip',
		'icon-sun-o' => 'icon-sun-o',
		'icon-moon-o' => 'icon-moon-o',
		'icon-archive' => 'icon-archive',
		'icon-bug' => 'icon-bug',
		'icon-vk' => 'icon-vk',
		'icon-weibo' => 'icon-weibo',
		'icon-renren' => 'icon-renren',
		'icon-pagelines' => 'icon-pagelines',
		'icon-stack-exchange' => 'icon-stack-exchange',
		'icon-arrow-circle-o-right' => 'icon-arrow-circle-o-right',
		'icon-arrow-circle-o-left' => 'icon-arrow-circle-o-left',
		'icon-toggle-left' => 'icon-toggle-left',
		'icon-dot-circle-o' => 'icon-dot-circle-o',
		'icon-wheelchair' => 'icon-wheelchair',
		'icon-vimeo-square' => 'icon-vimeo-square',
		'icon-try' => 'icon-try',
		'icon-plus-square-o' => 'icon-plus-square-o',
		'icon-space-shuttle' => 'icon-space-shuttle',
		'icon-slack' => 'icon-slack',
		'icon-envelope-square' => 'icon-envelope-square',
		'icon-wordpress' => 'icon-wordpress',
		'icon-openid' => 'icon-openid',
		'icon-institution' => 'icon-institution',
		'icon-mortar-board' => 'icon-mortar-board',
		'icon-yahoo' => 'icon-yahoo',
		'icon-google' => 'icon-google',
		'icon-reddit' => 'icon-reddit',
		'icon-reddit-square' => 'icon-reddit-square',
		'icon-stumbleupon-circle' => 'icon-stumbleupon-circle',
		'icon-stumbleupon' => 'icon-stumbleupon',
		'icon-delicious' => 'icon-delicious',
		'icon-digg' => 'icon-digg',
		'icon-pied-piper' => 'icon-pied-piper',
		'icon-pied-piper-alt' => 'icon-pied-piper-alt',
		'icon-drupal' => 'icon-drupal',
		'icon-joomla' => 'icon-joomla',
		'icon-language' => 'icon-language',
		'icon-fax' => 'icon-fax',
		'icon-building' => 'icon-building',
		'icon-child' => 'icon-child',
		'icon-paw' => 'icon-paw',
		'icon-spoon' => 'icon-spoon',
		'icon-cube' => 'icon-cube',
		'icon-cubes' => 'icon-cubes',
		'icon-behance' => 'icon-behance',
		'icon-behance-square' => 'icon-behance-square',
		'icon-steam' => 'icon-steam',
		'icon-steam-square' => 'icon-steam-square',
		'icon-recycle' => 'icon-recycle',
		'icon-car' => 'icon-car',
		'icon-cab' => 'icon-cab',
		'icon-tree' => 'icon-tree',
		'icon-spotify' => 'icon-spotify',
		'icon-deviantart' => 'icon-deviantart',
		'icon-soundcloud' => 'icon-soundcloud',
		'icon-database' => 'icon-database',
		'icon-file-pdf-o' => 'icon-file-pdf-o',
		'icon-file-word-o' => 'icon-file-word-o',
		'icon-file-excel-o' => 'icon-file-excel-o',
		'icon-file-powerpoint-o' => 'icon-file-powerpoint-o',
		'icon-file-photo-o' => 'icon-file-photo-o',
		'icon-file-zip-o' => 'icon-file-zip-o',
		'icon-file-sound-o' => 'icon-file-sound-o',
		'icon-file-movie-o' => 'icon-file-movie-o',
		'icon-file-code-o' => 'icon-file-code-o',
		'icon-vine' => 'icon-vine',
		'icon-codepen' => 'icon-codepen',
		'icon-jsfiddle' => 'icon-jsfiddle',
		'icon-support' => 'icon-support',
		'icon-circle-o-notch' => 'icon-circle-o-notch',
		'icon-ra' => 'icon-ra',
		'icon-ge' => 'icon-ge',
		'icon-git-square' => 'icon-git-square',
		'icon-git' => 'icon-git',
		'icon-hacker-news' => 'icon-hacker-news',
		'icon-tencent-weibo' => 'icon-tencent-weibo',
		'icon-qq' => 'icon-qq',
		'icon-wechat' => 'icon-wechat',
		'icon-send' => 'icon-send',
		'icon-send-o' => 'icon-send-o',
		'icon-history' => 'icon-history',
		'icon-circle-thin' => 'icon-circle-thin',
		'icon-header' => 'icon-header',
		'icon-paragraph' => 'icon-paragraph',
		'icon-sliders' => 'icon-sliders',
		'icon-share-alt' => 'icon-share-alt',
		'icon-share-alt-square' => 'icon-share-alt-square',
		'icon-bomb' => 'icon-bomb',
		'icon-soccer-ball-o' => 'icon-soccer-ball-o',
		'icon-tty' => 'icon-tty',
		'icon-binoculars' => 'icon-binoculars',
		'icon-plug' => 'icon-plug',
		'icon-slideshare' => 'icon-slideshare',
		'icon-twitch' => 'icon-twitch',
		'icon-yelp' => 'icon-yelp',
		'icon-newspaper-o' => 'icon-newspaper-o',
		'icon-wifi' => 'icon-wifi',
		'icon-calculator' => 'icon-calculator',
		'icon-paypal' => 'icon-paypal',
		'icon-google-wallet' => 'icon-google-wallet',
		'icon-cc-visa' => 'icon-cc-visa',
		'icon-cc-mastercard' => 'icon-cc-mastercard',
		'icon-cc-discover' => 'icon-cc-discover',
		'icon-cc-amex' => 'icon-cc-amex',
		'icon-cc-paypal' => 'icon-cc-paypal',
		'icon-cc-stripe' => 'icon-cc-stripe',
		'icon-bell-slash' => 'icon-bell-slash',
		'icon-bell-slash-o' => 'icon-bell-slash-o',
		'icon-trash' => 'icon-trash',
		'icon-copyright' => 'icon-copyright',
		'icon-at' => 'icon-at',
		'icon-eyedropper' => 'icon-eyedropper',
		'icon-paint-brush' => 'icon-paint-brush',
		'icon-birthday-cake' => 'icon-birthday-cake',
		'icon-area-chart' => 'icon-area-chart',
		'icon-pie-chart' => 'icon-pie-chart',
		'icon-line-chart' => 'icon-line-chart',
		'icon-lastfm' => 'icon-lastfm',
		'icon-lastfm-square' => 'icon-lastfm-square',
		'icon-toggle-off' => 'icon-toggle-off',
		'icon-toggle-on' => 'icon-toggle-on',
		'icon-bicycle' => 'icon-bicycle',
		'icon-bus' => 'icon-bus',
		'icon-ioxhost' => 'icon-ioxhost',
		'icon-angellist' => 'icon-angellist',
		'icon-cc' => 'icon-cc',
		'icon-shekel' => 'icon-shekel',
		'icon-meanpath' => 'icon-meanpath'
	);

	$evolution_shortcodes['icon'] = array( 
		'type' => 'self_closing', 
		'title' => __( 'Icons', 'evolution-pro' ), 
		'attr' => array(
			'color' => array(
			    'type' => 'select',
			    'title' => __( 'Icon color', 'evolution-pro' ),
			    'values' => array(
			    	'none' => __( 'None', 'evolution-pro' ),
			        'red' => __( 'Red', 'evolution-pro' ),
			        'orange' => __( 'Orange', 'evolution-pro' ),
			        'yellow' => __( 'Yellow', 'evolution-pro' ),
			        'green' => __( 'Green', 'evolution-pro' ),
			        'blue' => __( 'Blue', 'evolution-pro' ),
			        'white' => __( 'White', 'evolution-pro' ),
			        'grey' => __( 'Grey', 'evolution-pro' ), 
			        'dark-grey' => __( 'Dark grey', 'evolution-pro' )                                                       
			    )
			), 
			'type' => array(
				'type' => 'icon', 
				'title' => __( 'Icon set', 'evolution-pro' ),
				'values' => array(
					'fa-icons' => array(
						'title' => __( 'Font Awesome', 'evolution-pro' ),
						'iconopt' => $fa_icons
					),
				)
			),
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', 'evolution-pro' ),
				'desc' => __( 'Type a custom class name for CSS purposes', 'evolution-pro' )
			)
		) 
	);

	$evolution_shortcodes['cta'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'Call To Action', 'evolution-pro' ), 
		'attr' => array( 
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Call To Action Slogan', 'evolution-pro' ),
				'default' => __( 'This is Evolution, the one and only WordPress Framework.', 'evolution-pro' )
			),
			'button_text' => array(
				'type' => 'text', 
				'title' => __( 'Button text', 'evolution-pro' ),
				'default' => __( 'Button', 'evolution-pro' )
			),
			'button_url' => array(
				'type' => 'text', 
				'title' => __( 'Button link', 'evolution-pro' )
			),
			'button_style' => array(
				'type' => 'select',
				'title' => __( 'Button style', 'evolution-pro' ),
				'values' => array(
				    'solid' => __( 'Solid', 'evolution-pro' ),
			  		'transparent' => __( 'Transparent', 'evolution-pro' )
				)			
			),	
			'button_color' => array(
			    'type' => 'select',
			    'title' => __( 'Button color', 'evolution-pro' ),
			    'values' => array(
			        'red' => __( 'Red', 'evolution-pro' ),
			        'orange' => __( 'Orange', 'evolution-pro' ),
			        'yellow' => __( 'Yellow', 'evolution-pro' ),
			        'green' => __( 'Green', 'evolution-pro' ),
			        'blue' => __( 'Blue', 'evolution-pro' ),
			        'white' => __( 'White', 'evolution-pro' ),
			        'grey' => __( 'Grey', 'evolution-pro' ), 
			        'dark-grey' => __( 'Dark grey', 'evolution-pro' )                                                       
			    )
			), 
			'open_new_tab' => array(
				'type' => 'checkbox', 
				'title' => __( 'Open link in a new tab?', 'evolution-pro' ),
				'desc' => __( 'Check this if you want to open the link in a new page', 'evolution-pro' )				
			),
			'animation' => array(
				'type' => 'checkbox', 
				'title' => __( 'Enable animation', 'evolution-pro' ),
				'desc' => __( 'Check this to enable a reveal animation', 'evolution-pro' )	
			)					
		)
	);

	$evolution_shortcodes['slogan'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'Slogan', 'evolution-pro' ), 
		'attr' => array( 
			'title' => array(
				'type' => 'text', 
				'title' => __( 'Title', 'evolution-pro' ),
				'default' => __( 'A title for your slogan', 'evolution-pro' )
			),		
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Content', 'evolution-pro' ),
				'default' => __( 'This is Evolution, the one and only WordPress Framework', 'evolution-pro' )
			),
			'animation' => array(
				'type' => 'checkbox', 
				'title' => __( 'Enable animation', 'evolution-pro' ),
				'desc' => __( 'Check this to enable a cool animation', 'evolution-pro' )
			)			
		)
	);

	$evolution_shortcodes['skills_ring'] = array( 
		'type' =>'self_closing', 
		'title' => __( 'Animated Skills Ring', 'evolution-pro' ), 
		'attr' => array( 
			'percent' => array(
				'type' => 'percent',
				'desc' => __( 'The percent number of your ring (from 1 to 100)', 'evolution-pro' ),
				'title' => __( 'Percent', 'evolution-pro' )
			),
			'label' => array(
				'type' => 'text',
				'desc' => __( 'The label to display under the number', 'evolution-pro' ),
				'title' => __( 'Ring label', 'evolution-pro' )
			),
			'color' => array(
				'type' => 'color',
				'title'  => __( 'Ring color', 'evolution-pro' )
			),
			'animation_time' => array(
				'type' => 'text', 
				'title' => __( 'Animation time', 'evolution-pro' ),
				'desc' => __( 'The number of milliseconds it should take to finish counting (e.g. type "2000" for 2 seconds)', 'evolution-pro' ),
				'default' => 2000
			)
		)
	);	

	$evolution_shortcodes['milestone'] = array( 
		'type' =>'self_closing', 
		'title' => __( 'Milestone with Icon', 'evolution-pro' ), 
		'attr' => array( 
			'label' => array(
				'type' => 'text',
				'desc' => __( 'The label to show under the number', 'evolution-pro' ),
				'title' => __( 'Label', 'evolution-pro' ),
				'default' => __( 'Visitors', 'evolution-pro' ),
			),			
			'count_from' => array(
				'type' => 'text',
				'desc' => __( 'The number to start counting from', 'evolution-pro' ),
				'title' => __( 'Start number', 'evolution-pro' ),
				'default' => 0
			),
			'count_to' => array(
				'type' => 'text',
				'desc' => __( 'The number to stop counting at', 'evolution-pro' ),
				'title' => __( 'End number', 'evolution-pro' ),
				'default' => 750
			),
			'animation_time' => array(
				'type' => 'text', 
				'title' => __( 'Animation time', 'evolution-pro' ),
				'desc' => __( 'The number of milliseconds it should take to finish counting (e.g. type "2000" for 2 seconds)', 'evolution-pro' ),
				'default' => 2000
			),
			'refresh_interval' => array(
				'type' => 'text', 
				'title' => __( 'Refresh interval', 'evolution-pro' ),
				'desc' => __( 'The number of milliseconds to wait between refreshing the counter', 'evolution-pro' ),
				'default' => 25
			),					
			'icon_color' => array(
			    'type' => 'select',
			    'title' => __( 'Icon color', 'evolution-pro' ),
			    'values' => array(
			    	'none' => __( 'None', 'evolution-pro' ),
			        'red' => __( 'Red', 'evolution-pro' ),
			        'orange' => __( 'Orange', 'evolution-pro' ),
			        'yellow' => __( 'Yellow', 'evolution-pro' ),
			        'green' => __( 'Green', 'evolution-pro' ),
			        'blue' => __( 'Blue', 'evolution-pro' ),
			        'white' => __( 'White', 'evolution-pro' ),
			        'grey' => __( 'Grey', 'evolution-pro' ), 
			        'dark-grey' => __( 'Dark grey', 'evolution-pro' )                                                       
			    )
			), 
			'icon_type' => array(
				'type' => 'icon', 
				'title' => __( 'Icon set', 'evolution-pro' ),
				'values' => array(
					'fa-icons' => array(
						'title' => __( 'Font Awesome', 'evolution-pro' ),
						'iconopt' => $fa_icons
					),
				)
			),
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', 'evolution-pro' ),
				'desc' => __( 'For better results, we recommend to nest each <strong>milestones</strong> items into <strong>columns</strong> shortcodes.', 'evolution-pro' )
			)
		)
	);	

	$evolution_shortcodes['service'] = array( 
		'type' => 'enclosing', 
		'title' => __( 'Service with Icons', 'evolution-pro' ), 
		'attr' => array( 
			'icon_size' => array(
				'type' => 'radio', 
				'title' => __( 'Icon size', 'evolution-pro' ), 
				'values' => array(
					'small' => __( 'Small', 'evolution-pro' ), 
					'big' => __( 'Big', 'evolution-pro' )
				),
				'default' => 'small'
			), 	
			'icon_color' => array(
			    'type' => 'select',
			    'title' => __( 'Icon color', 'evolution-pro' ),
			    'values' => array(
			    	'none' => __( 'None', 'evolution-pro' ),
			        'red' => __( 'Red', 'evolution-pro' ),
			        'orange' => __( 'Orange', 'evolution-pro' ),
			        'yellow' => __( 'Yellow', 'evolution-pro' ),
			        'green' => __( 'Green', 'evolution-pro' ),
			        'blue' => __( 'Blue', 'evolution-pro' ),
			        'white' => __( 'White', 'evolution-pro' ),
			        'grey' => __( 'Grey', 'evolution-pro' ), 
			        'dark-grey' => __( 'Dark grey', 'evolution-pro' )                                                       
			    )
			), 
			'icon_type' => array(
				'type' => 'icon', 
				'title' => __( 'Icon set', 'evolution-pro' ),
				'values' => array(
					'fa-icons' => array(
						'title' => __( 'Font Awesome', 'evolution-pro' ),
						'iconopt' => $fa_icons
					),
				)
			),
			'title' => array(
				'type' => 'text',
				'title' => __( 'Title', 'evolution-pro' )
			),
			'content_inside' => array(
				'type' => 'textarea',
				'title' => __( 'Content', 'evolution-pro' )
			),
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', 'evolution-pro' ),
				'desc' => __( 'For better results, we recommend to nest each <strong>service</strong> element into <strong>columns</strong> shortcodes.', 'evolution-pro' )
			)		
		)
	);

	$evolution_shortcodes['team_member'] = array( 
		'type' => 'self_closing', 
		'title' => __( 'Team Member', 'evolution-pro' ), 
		'attr' => array( 
			'image_url' => array(
				'type' => 'image',
				'title' => __( 'Image', 'evolution-pro' ),
				'desc' => __( 'Min. recommended size: 320x320px', 'evolution-pro' )
			),
			'name' => array(
				'type' => 'text',
				'title' => __( 'Name', 'evolution-pro' )
			),
			'role' => array(
				'type' => 'text',
				'title' => __( 'Role', 'evolution-pro' )
			),
			'social' => array(
				'type' => 'textarea',
				'title' => __( 'Social buttons', 'evolution-pro' ),
				'desc' => __( 'Enter any social media links with a comma separated list (e.g. Facebook,http://facebook.com, Twitter,http://twitter.com)', 'evolution-pro' )
			),
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', 'evolution-pro' ),
				'desc' => __( 'Nest each <strong>team member</strong> items into <strong>columns</strong> shortcodes.', 'evolution-pro' )
			)
		)
	);

	$evolution_shortcodes['map'] = array( 
		'type' => 'self_closing', 
		'title' => __( 'Map Shortcode', 'evolution-pro' ), 
		'attr' => array( 
			'latitude' => array(
				'type' => 'text',
				'title'  => __( 'Map Latitude', 'evolution-pro' ),
				'desc' => __( 'Set the latitude (find it out <a href="http://itouchmap.com/latlong.html" target="_blank">here</a>)', 'evolution-pro' ),
				'default' => 53.59002
			),
			'longitude' => array(
				'type' => 'text',
				'title'  => __( 'Map Longitude', 'evolution-pro' ),
				'desc' => __( 'Set the longitude (find it out <a href="http://itouchmap.com/latlong.html" target="_blank">here</a>)', 'evolution-pro' ),
				'default' => 9.989795
			),
			'info' => array(
				'type' => 'infobox',
				'title' => __( 'Note:', 'evolution-pro' ),
				'desc' => __( 'Don&lsquo;t leave latitude and longitude empty or the map does not show up', 'evolution-pro' )
			),	
			'zoom' => array(
				'type' => 'text',
				'title' => __( 'Map zoom level', 'evolution-pro' ),
				'desc' => __( 'The initial resolution at which to display the map', 'evolution-pro' ),
				'default' => 3
			),	
			'style' => array(
				'type' => 'select',
				'title' => __( 'Map style', 'evolution-pro' ),
				'desc' => __( 'Choose a style preset for your map', 'evolution-pro' ),                        
				'values' => array(
	                'default' => __( 'Default', 'evolution-pro' ),
	                'invert' => __( 'Reversed colors', 'evolution-pro' ) 
				)			
			),
			'height' => array(
				'type' => 'text',
				'title'  => __( 'Map height', 'evolution-pro' ),
				'desc' => __( 'Map height in em', 'evolution-pro' ),
				'default' => 22.222
			),
			'marker' => array(
				'type' => 'image',
				'title' => __( 'Image marker', 'evolution-pro' ),
	            'desc' => __( 'Set a different image for the marker. Default marker URL:<br><strong>' . get_template_directory_uri() . '/admin/includes/img/marker-red.png</strong>', 'evolution-pro' ) 
			),		
			'tooltip' => array(
				'type' => 'text',
				'title'  => __( 'Tooltip content', 'evolution-pro' ),
	            'desc' => __( 'Type here what you want to show in the tooltip', 'evolution-pro' ),
	            'default' => __( 'Here lives WordPress', 'evolution-pro' )                        
			),	
			'extra_class' => array(
				'type' => 'text', 
				'title' => __( 'Extra class', 'evolution-pro' ),
				'desc' => __( 'Type a custom class name for CSS purposes', 'evolution-pro' )
			)					
		)
	);

	$evolution_shortcodes['mockup'] = array( 
		'type' => 'custom', 
		'title' => __( 'Mockup Slider', 'evolution-pro' ), 
		'attr' => array(
			'device' => array(
				'type' => 'select', 
				'title'  => __( 'Mockup device', 'evolution-pro' ),
				'values' => array(
				    'iphone' => __( 'iPhone', 'evolution-pro' ),
			  		'ipad' => __( 'iPad', 'evolution-pro' ),
			  		'desktop' => __( 'Desktop', 'evolution-pro' )
				)
			),
			// adding new options here or changing some lines in the array below may break some js functions
			'color' => array(
				'type' => 'select', 
				'title'  => __( 'Mockup color', 'evolution-pro' ),
				'desc' => __( 'Note: This option has no effect on "Desktop" mockups', 'evolution-pro' ),				
				'values' => array(
				    'black' => __( 'Black', 'evolution-pro' ),
			  		'white' => __( 'White', 'evolution-pro' )
				)
			),
			'arrows_color' => array(
				'type' => 'select', 
				'title'  => __( 'Arrows color', 'evolution-pro' ),
				'values' => array(
				    'dark' => __( 'Dark', 'evolution-pro' ),
			  		'white' => __( 'White', 'evolution-pro' )
				)
			),
			'autoplay' => array(
				'type' => 'text', 
				'title' => __( 'Autoplay', 'evolution-pro' ),
				'desc' => __( 'Ms (milliseconds e.g. type "5000" for 5 seconds). Leave it blank to disable autoplay', 'evolution-pro' )
			),	
			'rewind_speed' => array(
				'type' => 'text', 
				'title' => __( 'Rewind speed', 'evolution-pro' ),
				'desc' => __( 'Rewind speed in milliseconds value (e.g. type "1000" for 1 seconds)', 'evolution-pro' )
			),				
			'mockup_screens' => array(
				'type' => 'special',
				'title' => __( 'Screen', 'evolution-pro' ),
				'desc' => __( 'iPhone image size: <strong>375x667px (min)</strong> or <strong>750x1334px (max)</strong><br>iPad image size: <strong>504x378px (min)</strong> or <strong>1008x756px (max)</strong><br>Desktop image size: <strong>574x315px (min)</strong> or <strong>1148x630px (max)</strong>', 'evolution-pro' )
			)
		)
	); 

	$evolution_shortcodes['mockup_half'] = array( 
		'type' => 'custom', 
		'title' => __( 'Half Mockup Slider', 'evolution-pro' ), 
		'attr' => array(		
			'device' => array(
				'type' => 'select', 
				'title'  => __( 'Mockup device', 'evolution-pro' ),
				'values' => array(
				    'iphone' => __( 'iPhone', 'evolution-pro' ),
			  		'ipad' => __( 'iPad', 'evolution-pro' ),
			  		'desktop' => __( 'Desktop', 'evolution-pro' )
				)
			),
			// adding new options here or changing some lines in the array below may break some js functions
			'color' => array(
				'type' => 'select', 
				'title'  => __( 'Device color', 'evolution-pro' ),
				'desc' => __( 'Note: This option has no effect on "Desktop" mockups', 'evolution-pro' ),			
				'values' => array(
				    'black' => __( 'Black', 'evolution-pro' ),
			  		'white' => __( 'White', 'evolution-pro' )
				)
			),
			'layout' => array(
				'type' => 'select', 
				'title'  => __( 'Mockup position', 'evolution-pro' ),
				'values' => array(
				    'left' => __( 'Align left', 'evolution-pro' ),
			  		'right' => __( 'Align right', 'evolution-pro' )
				)
			),		
			'autoplay' => array(
				'type' => 'text', 
				'title' => __( 'Autoplay', 'evolution-pro' ),
				'desc' => __( 'Ms (milliseconds e.g. type "5000" for 5 seconds). Leave it blank to disable autoplay', 'evolution-pro' )
			),
			'aside_title' => array(
				'type' => 'text', 
				'title' => __( 'Aside title', 'evolution-pro' ),
				'default' => __( 'Title of the aside section', 'evolution-pro' ),
				'skip' => true
			),	
			'aside_content' => array(
				'type' => 'textarea',
				'title' => __( 'Aside content', 'evolution-pro' ),
				'default' => __( 'Lorem ipsum ...', 'evolution-pro' ),
				'skip' => true
			),								
			'mockup_screens' => array(
				'type' => 'special',
				'title'  => __( 'Screen', 'evolution-pro' ),
				'desc' => __( 'iPhone image size: <strong>375x667px (min)</strong> or <strong>750x1334px (max)</strong><br>iPad image size: <strong>504x378px (min)</strong> or <strong>1008x756px (max)</strong><br>Desktop image size: <strong>574x315px (min)</strong> or <strong>1148x630px (max)</strong>', 'evolution-pro' )
			)
		)
	); 

	$evolution_shortcodes['testimonial'] = array( 
		'type' => 'custom', 
		'title' => __( 'Testimonials', 'evolution-pro' ), 
		'attr' => array(		
			'autoplay' => array(
				'type' => 'text', 
				'title' => __( 'Autoplay', 'evolution-pro' ),
				'desc' => __( 'Ms (milliseconds e.g. type "5000" for 5 seconds). Leave it blank to disable autoplay', 'evolution-pro' ),
				'default' => 5000
			),
			'pagination' => array(
				'type' => 'checkbox', 
				'title' => __( 'Show bullets', 'evolution-pro' ),
				'desc' => __( 'Check this if you want to show pagination bullets', 'evolution-pro' ),
			),
			'transition' => array(
				'type' => 'select', 
				'title'  => __( 'Transition Style', 'evolution-pro' ),
				'desc' => __( 'CSS transition style for the slider', 'evolution-pro' ),			
				'values' => array(
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
			'centered_text' => array(
				'type' => 'checkbox',
				'title' => __( 'Centered Text', 'evolution-pro' ),
				'desc' => __( 'Check this to center the content', 'evolution-pro' )
			),
			'testimonials' => array(
				'type' => 'special',
				'desc' => __( 'Min. recommended size: 160x160px', 'evolution-pro' )
			)		
		)
	); 

	$evolution_shortcodes['custom_carousel'] = array( 
		'type' => 'custom', 
		'title' => __( 'Custom Carousel', 'evolution-pro' ), 
		'attr' => array(		
			'autoplay' => array(
				'type' => 'text', 
				'title' => __( 'Autoplay', 'evolution-pro' ),
				'desc' => __( 'Ms (milliseconds e.g. type "5000" for 5 seconds). Leave it blank to disable autoplay', 'evolution-pro' ),
				'default' => 5000
			),
			'pagination' => array(
				'type' => 'checkbox', 
				'title' => __( 'Show bullets', 'evolution-pro' ),
				'desc' => __( 'Check this if you want to show pagination bullets', 'evolution-pro' ),
			),
			'transition' => array(
				'type' => 'select', 
				'title'  => __( 'Transition style', 'evolution-pro' ),
				'desc' => __( 'CSS transition style for the slider', 'evolution-pro' ),			
				'values' => array(
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
			)	
		)
	); 

	$evolution_shortcodes['social'] = array( 
		'type' => 'self_closing', 
		'title' => __( 'Social Widget', 'evolution-pro' ), 
		'attr' => array( 
			'title' => array(
				'type' => 'text', 
				'title' => __( 'Widget title', 'evolution-pro' )
			),
			'links' => array(
				'type' => 'textarea',
				'title' => __( 'Social buttons', 'evolution-pro' ),
				'desc' => __( 'Enter any social media links with a comma separated list (e.g. Facebook,http://facebook.com, Twitter,http://twitter.com)', 'evolution-pro' )
			),
		)
	);
    
// Alerts #####################################################    

    $evolution_shortcodes['alertbox'] = array( 
		'type' => 'self_closing',
		'title' => __( 'Alert boxes', 'evolution-pro' ), 
		'attr' => array(
			'text' => array(
				'type' => 'textarea', 
				'title' => __( 'Alert text', 'evolution-pro' ),
				'default' => __( 'Your text...', 'evolution-pro' )
			),					
			'color' => array(
			    'type' => 'select',
			    'title' => __( 'Alert box color', 'evolution-pro' ),
			    'values' => array(
			        'red' => __( 'Red', 'evolution-pro' ),
			        'green' => __( 'Green', 'evolution-pro' ),
			        'blue' => __( 'Blue', 'evolution-pro' ), 
			        'grey' => __( 'Grey', 'evolution-pro' )                                                       
			    )
			), 
			'icon_type' => array(
				'type' => 'icon', 
				'title' => __( 'Alert icon', 'evolution-pro' ),
				'values' => array(
					'fa-icons' => array(
						'title' => __( 'Font Awesome', 'evolution-pro' ),
						'iconopt' => $fa_icons
					),
				)
			),			
		) 
	);
		
	/* The HTML inside the popup */
	$html_options = $shortcode_html = null;
	?>

	<div id="evolution-sc-heading">
		<div id="evolution-sc-generator" class="mfp-hide mfp-with-anim">				
			<div class="shortcode-content">
			<div class="shortcode-header">
			<h1><?php echo __( 'Evolution Shortcodes Generator', 'evolution-pro' ) ?></h1>
			</div>
				<div id="evolution-sc-header">			
					<div class="content">
						<select id="evolution-shortcodes" data-placeholder="<?php echo __( 'Choose a shortcode', 'evolution-pro' ) ?>">
						    <option val=""></option>

						    <?php							
							foreach( $evolution_shortcodes as $shortcode => $options ) {

								/* If shortcode 'type' => 'heading' output <optgroup> */
								if( $options['type'] == 'heading' ) {	

									$shortcode_html .= '<optgroup label="' . $options['title'] . '">';

								} else {

									$shortcode_html .= '<option value="' . $shortcode . '">' . $options['title'] . '</option>';
									$html_options .= '<div class="shortcode-options" id="options-' . $shortcode . '" data-name="' . $shortcode . '" data-type="' . $options['type'] . '">';
									
									if( !empty( $options['attr'] ) ) {

										foreach( $options['attr'] as $name => $attr_option ) {
											$html_options .= evolution_option_element( $name, $attr_option, $options['type'], $shortcode );
										}

									}
					
									$html_options .= '</div>'; 

								}
								
							}
							?> 

							<?php echo $shortcode_html ?>

						</select>
					</div>
				</div> 			

				<?php echo $html_options; ?>
		    <div class="shortcode-button">
			<code class="shortcode_storage">
				<span id="shortcode-storage-opening"></span>
				<span id="shortcode-storage-content"></span>
				<span id="shortcode-storage-closing"></span>
			</code>
			<a class="btn" id="add-shortcode"><?php echo __( 'Add Shortcode', 'evolution-pro' ); ?></a>
			</div>
		</div>
	</div>	
		
<?php 
}

add_action( 'admin_footer','content_display' );


/** ---------------------------------------------------------
 * Option element function
 */
function evolution_option_element( $name, $attr_option, $type, $shortcode ) {
	
	$option_element = null;

	/* Default */
	( isset( $attr_option['default'] ) ) ? $default = $attr_option['default'] : $default = '';
	
	/* Desc */
	( isset( $attr_option['desc'] ) && !empty( $attr_option['desc'] ) ) ? $desc = '<p class="description">' . $attr_option['desc'] . '</p>' : $desc = '';

	/* Skip processing */
	( isset( $attr_option['skip'] ) && $attr_option['skip'] == true ) ? $skip_class = 'skip-processing' : $skip_class = '';	

	/* Define type cases */
	switch( $attr_option['type'] ) {

		case 'text':		
		default:

		    $option_element .= '
			<div class="label label-text label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' . $attr_option['title'] . '</strong></label></div>
			<div class="content content-text content-' . $name . '"><input type="text" data-attrname="' . $name . '" id="' . $shortcode . '-' . $name . '" class="attr ' . $skip_class . '" value="' . $default . '">' . $desc . '</div>';
		    
		    break;			

		case 'textarea':

			$option_element .= '
			<div class="label label-textarea label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' .$attr_option['title'].'</strong></label></div>
			<div class="content content-textarea content-' . $name . '"><textarea data-attrname="' . $name . '" id="' . $shortcode . '-' . $name . '" class="' . $skip_class . '">' . $default . '</textarea> ' . $desc . '</div>';
			
			break;	
		
		case 'radio':
		    
			$option_element .= '
			<div class="label label-radio label-' . $name . '"><strong>' . $attr_option['title'] . '</strong></div>
			<div class="content content-radio content-' . $name . '">';

		    foreach( $attr_option['values'] as $val => $title ) {
		    				
				$option_element .= '
				<label for="' . $shortcode . '-' . $name . '-' . $val . '">
					<input class="attr" type="radio" data-attrname="' . $name . '" name="' . $shortcode .'-' . $name . '" value="' . $val . '" id="' . $shortcode . '-' . $name . '-' . $val . '"' . ( $default == $val ? ' checked="checked"' : '' ) . '>
					<span>' . $title . '</span>
				</label>';
		    
		    }
			
			$option_element .= $desc . '</div>';
			
		    break;
			
		case 'checkbox':
			
			$option_element .= '
			<div class="label label-checkbox label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' . $attr_option['title'] . '</strong></label></div>
			<div class="content content-checkbox"><input type="checkbox" data-attrname="' . $name . '" id="' . $shortcode . '-' . $name . '"' . ( $default == 'on' ? ' checked="checked"' : '' ) . '>' . $desc . '</div>';
			
			break;	
		
		case 'select':

			$option_element .= '
			<div class="label label-select label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' . $attr_option['title'] . '</strong></label></div>
			<div class="content content-select content-' . $name . '">
			<select id="' . $shortcode . '-' . $name . '" data-attrname="' . $name . '" class="' . $skip_class . '">';

				$values = $attr_option['values'];

				foreach( $values as $val => $title ) {
			    	$option_element .= '<option value="' . $val . '">' . $title . '</option>';
				}

			$option_element .= '</select>' . $desc . '</div>';

			break;
		
		case 'multi-select':
			
			$option_element .= '
			<div class="label label-multiselect label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' . $attr_option['title'] . '</strong></label></div>
			<div class="content content-multiselect content-' . $name . '">
				<select multiple="multiple" id="' . $shortcode . '-' . $name . '" data-attrname="' . $name . '">';

					$values = $attr_option['values'];

					foreach( $values as $val => $title ) {
				    	$option_element .= '<option value="' . $val . '">' . $title . '</option>';
					}

				$option_element .= '</select>' . $desc . '</div>';
			
			break;

		case 'icon':

			$option_element .= '
			<div class="label label-icons label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' . $attr_option['title'] . '</strong></label></div>
			<div class="content content-icons content-' . $name . '">
				<select id="' . $shortcode . '-' . $name . '" data-attrname="icon-select" class="skip-processing">';

				$values = $attr_option['values'];

				/* Output font options */
				foreach( $values as $val => $set ) {
			    	$option_element .= '<option value="' . $val . '">' . $set['title'] . '</option>';
				}

				$option_element .= '</select>' . $desc . '</div>';
				$option_element .= '<div class="clear no-line"></div>';
				$option_element .= '<div class="icons-container" data-attrname="' . $name . '">';

				/* Output icons */
				foreach( $values as $val => $set ) {

					$option_element .= '<div class="icon-option ' . $val . '">';

						foreach( $set['iconopt'] as $iconopt ) {
					    	$option_element .= '<i class="' . $iconopt . '"></i>';
						}

					$option_element .= '</div>';

				}

				$option_element .= '</div>';
			
			break;	

		case 'color':
				
	        $option_element .= '<div class="label label-color label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' . $attr_option['title'] . '</strong></label></div>';

			if( get_bloginfo( 'version' ) >= '3.5' ) {

			   $option_element .= '<div class="content content-color content-' . $name . '"><input type="text" id="' . $shortcode . '-' . $name . '" data-attrname="' . $name . '" class="popup-colorpicker wp-color-picker" data-default-color="" value=""></div>';

	        } else {

	           $option_element .= __( 'You&lsquo;re using an outdated version of WordPress. Please update to use this feature.', EVOLUTION_THEME_NAME );

	        }	

			break;	

		case 'image':

		    $option_element .= '
			<div class="label label-image label-' . $name . '"><label><strong>' . $attr_option['title'] . '</strong></label></div>
			<div class="content content-image content-' . $name . '">
				<input type="hidden" id="options-item">
				<img class="image-screenshot" id="' . $shortcode . '-' . $name . '" data-attrname="' . $name . '" src="">
				<a data-update="' . __( 'Select File', 'evolution-pro' ) . '" data-choose="' . __( 'Choose a file', 'evolution-pro' ) . '" href="javascript:void(0);" class="image-upload button-secondary" rel-id="">' . __( 'Upload', 'evolution-pro' ) . '</a>
				<a href="javascript:void(0);" class="image-upload-remove" style="display: none;">' . __( 'Remove Upload', 'evolution-pro' ) . '</a>
				' . $desc . '
			</div>';

		    break;		

		case 'infobox':

			$option_element .= '
			<div class="info"><div class="info-title">' . $attr_option['title'] . '</div>
			<div class="info-content">' . $desc . '</div></div>';

			break;  

		case 'percent':

		    $option_element .= '
			<div class="label label-slider label-' . $name . '"><label for="' . $shortcode . '-' . $name . '"><strong>' . $attr_option['title'] . '</strong></label></div>
			<div class="content dd-percent content-slider content-' . $name . '"><input type="text" data-attrname="' . $name . '" id="' . $shortcode . '-' . $name . '" class="attr percent" value="">
				<div class="percent-slider"></div>' . $desc . '
			</div>';

		    break;				
			
		case 'special':	
			
			if( $name == 'testimonials' ) {
				$option_element .= '
				<div class="shortcode-dynamic-items testimonials" data-name="' . $name . '">
					<div class="shortcode-dynamic-item">
						<div class="field">
							<div class="label label-text label-' . $name . '"><label><strong>' . __( 'Author', 'evolution-pro' ) . '</strong></label></div>
							<div class="content content-text content-' . $name . '"><input class="shortcode-dynamic-item-input skip-processing" type="text" name="" value=""  /></div>
						</div>
                        <div class="field">
							<div class="label label-website label-' . $name . '"><label><strong>' . __( 'Website', 'evolution-pro' ) . '</strong></label></div>
							<div class="content content-website content-' . $name . '"><input class="website skip-processing" type="text" name="" value="" data-attrname="website_inside" /></div>
						</div>
						<div class="field">
							<div class="label label-textarea label-' . $name . '"><label><strong>' . __( 'Quote', 'evolution-pro' ) . '</strong></label></div>
							<div class="content content-textarea content-' . $name . '"><textarea class="quote" name="quote" data-attrname="content_inside"></textarea></div>
						</div>
						<div class="label label-image label-' . $name . '"><label><strong>' . __( 'Image', 'evolution-pro' ) . '</strong></label></div>
						<div class="content content-image content-' . $name . '">
							<input type="hidden" id="options-item">
							<img class="image-screenshot skip-processing" data-attrname="' . $name . '" src="">
							<a data-update="' . __( 'Select File', 'evolution-pro' ) . '" data-choose="' . __( 'Choose a file', 'evolution-pro' ) . '" href="javascript:void(0);" class="image-upload button-secondary" rel-id="">' . __( 'Upload', 'evolution-pro' ) . '</a>
							<a href="javascript:void(0);" class="image-upload-remove" style="display: none;">' . __( 'Remove Upload', 'evolution-pro' ) . '</a>
							' . $desc . '
						</div>

					</div>
				</div>
				<a href="#" class="btn blue remove-list-item">' .__( 'Remove Testimonial', 'evolution-pro' ). '</a> <a href="#" class="btn blue add-list-item">' .__( 'Add Testimonial', 'evolution-pro' ).'</a>';
				
			} 

			else if( $name == 'mockup_screens' ) {
				$option_element .= '
				<div class="shortcode-dynamic-items mockup-screens" data-name="' . $name . '">
					<div class="shortcode-dynamic-item">
						<div class="label label-image label-' . $name . '"><label><strong>' . __( 'Screen', 'evolution-pro' ) . '</strong></label></div>
						<div class="content content-image content-' . $name . '">
							<input type="hidden" id="options-item">
							<img class="image-screenshot skip-processing" data-attrname="' . $name . '" src="">
							<a data-update="' . __( 'Select File', 'evolution-pro' ) . '" data-choose="' . __( 'Choose a file', 'evolution-pro' ) . '" href="javascript:void(0);" class="image-upload button-secondary" rel-id="">' . __( 'Upload', 'evolution-pro' ) . '</a>
							<a href="javascript:void(0);" class="image-upload-remove" style="display: none;">' . __( 'Remove Upload', 'evolution-pro' ) . '</a>
							' . $desc . '
						</div>
					</div>
				</div>
				<a href="#" class="btn blue remove-list-item">' . __( 'Remove Screen', 'evolution-pro' ) . '</a> <a href="#" class="btn blue add-list-item">' . __( 'Add Screen', 'evolution-pro' ) . '</a>';
			}
			
		break;
				  

    }
	
	$option_element .= '<div class="clear"></div>';
	
    return $option_element;

}