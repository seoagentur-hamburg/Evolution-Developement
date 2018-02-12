<?php
/**
* The Evolution Framework
*
* WARNING: This file is part of the core Evolution Framework. DO NOT edit this file under any circumstances.
* Please do all modifications in the form of a child theme.
*
* This file contains some helper functions
*
* @package Evolution\Functions\
* @author  Andreas Hecht
* @license GPL-2.0+
* @link    https://andreas-hecht.com/wordpress-themes/evolution-wordpress-framework/
*/


if ( ! function_exists( 'evolution_remove_tag_cloud_style' ) ) :
/**
 * Remove the inline styles from tag cloud
 * 
 * @return filter
 */
function evolution_remove_tag_cloud_style( $input ) {
    
    return preg_replace( '/ style=("|\')(.*?)("|\')/','',$input );
    
}
add_filter( 'wp_generate_tag_cloud', 'evolution_remove_tag_cloud_style', 10,1 );
endif;




/**
 * Managing contact fields for author bio
 */
$Evolution_Contactfields = new Evolution_Contactfields(
    array (
        'Feed',
        'Twitter',
        'Facebook',
        'GooglePlus',
        'Flickr',
        'Xing',
        'Github',
        'Instagram',
        'LinkedIn',
        'Pinterest',
        'Vimeo',
        'Youtube'
    )
);

class Evolution_Contactfields {
    public
        $new_fields
        ,	$active_fields
        ,	$replace
        ;

    /**
	 * @param array $fields New fields: array ('Twitter', 'Facebook')
	 * @param bool $replace Replace default fields?
	 */
    public function __construct($fields, $replace = TRUE)
    {
        foreach ( $fields as $field )
        {
            $this->new_fields[ mb_strtolower($field, 'utf-8') ] = $field;
        }

        $this->replace = (bool) $replace;

        add_filter('user_contactmethods', array( $this, 'add_fields' ) );
    }

    /**
	 * Changing contact fields
	 * @param  $original_fields Original WP fields
	 * @return array
	 */
    public function add_fields($original_fields)
    {
        if ( $this->replace )
        {
            $this->active_fields = $this->new_fields;
            return $this->new_fields;
        }

        $this->active_fields = array_merge($original_fields, $this->new_fields);
        return $this->active_fields;
    }

    /**
	 * Helper function
	 * @return array The currently active fields.
	 */
    public function get_active_fields()
    {
        return $this->active_fields;
    }
}



/**
 * Clean wp-caption Output without the 10px WordPress is adding
 * 
 */
if ( ! function_exists( 'evolution_cleaner_caption' ) ) : 

function evolution_cleaner_caption( $output, $attr, $content ) {

    /* We're not worried abut captions in feeds, so just return the output here. */
    if ( is_feed() )
        return $output;

    /* Set up the default arguments. */
    $defaults = array(
        'id' => '',
        'align' => 'alignnone',
        'width' => '',
        'caption' => ''
    );

    /* Merge the defaults with user input. */
    $attr = shortcode_atts( $defaults, $attr );

    /* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
    if ( 1 > $attr['width'] || empty( $attr['caption'] ) )
        return $content;

    /* Set up the attributes for the caption <div>. */
    $attributes = ( !empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
    $attributes .= ' class="wp-caption ' . esc_attr( $attr['align'] ) . '"';
    $attributes .= ' style="width: ' . esc_attr( $attr['width'] ) . 'px"';

    /* Open the caption <div>. */
    $output = '<div' . $attributes .'>';

    /* Allow shortcodes for the content the caption was created for. */
    $output .= do_shortcode( $content );

    /* Append the caption text. */
    $output .= '<p class="wp-caption-text"><span class="fa fw fa-camera fa-1x"></span>' . $attr['caption'] . '</p>';

    /* Close the caption </div>. */
    $output .= '</div>';

    /* Return the formatted, clean caption. */
    return $output;
} 
endif;

add_filter( 'img_caption_shortcode', 'evolution_cleaner_caption', 10, 3 );




/**
 * Add custom classes to the body.
 */
function evolution_body_classes( $classes ) {
    if ( is_page_template( 'fullwidth.php' ) ) {
        $classes[] = 'full-width';
    } elseif ( ! is_active_sidebar( 'sidebar' ) || is_page_template( 'nosidebar.php' ) || is_404() ) {
        $classes[] = 'no-sidebar';
    } else {
        $classes[] = 'has-sidebar';
    }

    $footer_widgets = 0;
    $footer_widgets_max = 4;
    for( $i = 1; $i <= $footer_widgets_max; $i++ ) {
        if ( is_active_sidebar( 'footer-' . $i ) ) {
            $footer_widgets++;
        }
    }
    $classes[] = 'footer-' . $footer_widgets;

    if ( get_option( 'show_avatars' ) ) {
        $classes[] = 'has-avatars';
    }

    return $classes;
}
add_filter( 'body_class', 'evolution_body_classes' );




if ( ! function_exists( 'evolution_fullwidth_content_width' ) ) :
/**
 * Adjust content_width value for full width template.
 */
function evolution_fullwidth_content_width() {
    
    if ( is_page_template( 'page_fullwidth.php' ) ) {
        global $content_width;
        $content_width = 1020;
    }
}
add_action( 'template_redirect', 'evolution_fullwidth_content_width' );
endif;



if ( ! function_exists( 'evolution_nosidebar_content_width' ) ) :
/**
 * Adjust content_width value for nosidebar template.
 */
function evolution_nosidebar_content_width() {
    
    if ( is_page_template( 'nosidebar.php' ) ) {
        global $content_width;
        $content_width = 900;
    }
}
add_action( 'template_redirect', 'evolution_nosidebar_content_width' );
endif;


/**
 * Returns an accessibility-friendly link to edit a post or page.
 *
 * This also gives us a little context about what exactly we're editing
 * (post or page?) so that users understand a bit more where they are in terms
 * of the template hierarchy and their content. Helpful when/if the single-page
 * layout with multiple posts/pages shown gets confusing.
 */
if ( ! function_exists( 'evolution_edit_link' ) ) :

function evolution_edit_link() {
    edit_post_link(
        sprintf(
            /* translators: %s: Name of current post */
            __( 'Edit<span class="screen-reader-text"> "%s"</span>', 'evolution' ),
            get_the_title()
        ),
        '<span class="edit-link">',
        '</span>'
    );
}
endif;




if ( ! function_exists( 'evolution_shorten_text' ) ) :
/**
 * Shorten text.
 */
function evolution_shorten_text( $text, $length ) {
    $text = wp_kses( $text, array() );
    if( mb_strlen( $text ) > $length ) {
        $text = mb_substr( $text ,0 ,$length );
        return $text . '...';
    } else {
        return $text;
    }
}
endif;



/* Enable/disable SVG images support https://wordpress.org/support/topic/add-code-to-htaccess-through-theme-activation */
function enable_svg_support( $oldname, $oldtheme = false ) {
    require_once( ABSPATH . '/wp-admin/includes/file.php' );
    require_once( ABSPATH . '/wp-admin/includes/misc.php' );
    $rules = array();
    $rules[] = 'AddType image/svg+xml svg';
    $rules[] = 'AddType image/svg+xml svgz';
    $rules[] = 'AddEncoding x-gzip .svgz';

    $htaccess_file = ABSPATH . '.htaccess';
    insert_with_markers( $htaccess_file, 'Svg images support', ( array ) $rules );
}

function disable_svg_support( $newname, $newtheme ) {
    require_once( ABSPATH . '/wp-admin/includes/file.php' );
    require_once( ABSPATH . '/wp-admin/includes/misc.php' );
    $htaccess_file = ABSPATH . '.htaccess';
    insert_with_markers( $htaccess_file, 'Svg images support', '' );
}

add_action( 'after_switch_theme', 'enable_svg_support', 10 , 2 ); // Theme activation
add_action( 'switch_theme', 'disable_svg_support', 10 , 2 ); // Theme deactivation



/* Filters wp_title to print a neat <title> tag based on what is being viewed */
function evolution_wp_title( $title, $sep ) {
    if ( is_feed() ) {
        return $title;
    }

    global $page, $paged;

    // Add the blog name
    $title .= get_bloginfo( 'name', 'display' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " $sep $site_description";
    }

    // Add a page number if necessary:
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
        $title .= " $sep " . sprintf( __( 'Page %s', 'evolution-pro' ), max( $paged, $page ) );
    }

    return $title;
}
add_filter( 'wp_title', 'evolution_wp_title', 10, 2 );





/* Get homepage page */
function get_evolution_home_page() {
    return end( get_pages( array( 'number' => 1, 'meta_key' => '_wp_page_template', 'meta_value' => 'template-home.php' ) ) );
}

/* Get meta values */
function get_meta( $type, $value ) {
    return isset( $type[ $value ] ) && ! empty( $type[ $value ] ) ? $type[ $value ] : false;
}

/* Helper function for evolution shortcode generator conditional */
function is_edit_page( $new_edit = null ) {

    global $pagenow;

    //make sure we are on the backend
    if ( !is_admin() ) return false;

    if( $new_edit == 'edit' )

        return in_array( $pagenow, array( 'post.php',  ) );

    elseif( $new_edit == 'new' ) //check for new post page

        return in_array( $pagenow, array( 'post-new.php' ) );

    else //check for either new or edit

        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );

}




/* Spot first post */
function is_first_post() {
    global $wp_query;
    if( $wp_query->current_post == 0 && !is_paged() ) return true;
    return false;
}

/* Query theme's post type */
function what_evolution_post_type( $type ) {
    global $wp_query;
    if( $type == get_post_type( $wp_query->post->ID ) ) return true;
    return false;
}