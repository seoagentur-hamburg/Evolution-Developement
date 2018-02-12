<?php


/** ---------------------------------------------------------
 * Section
 */

function evolution_section_sc( $atts, $content = null ) {
	extract( shortcode_atts( array( 'background_color' => '', 'text_color' => '', 'title' => '', 'extra_class' => '' ), $atts ) );

	$output = $background_data = $text_color_class = $title_data = null;
	
	if ( $background_color ) {
		$background_data = ' style="background-color:' . $background_color . ';"';
	}

	if ( $text_color == 'light' ) {
		$text_color_class = " text-light";
	}
	
	if ( $title ) {
		$title_data = '<div class="section-title"><h3>' . $title . '</h3></div>';
	}
	
	$output = '
	<section class="row section' . $text_color_class . ' ' . $extra_class . '"' . $background_data . '>
		<div class="row-content buffer even clear-after">
			' . $title_data . do_shortcode( $content ) . '
		</div>
	</section>';
	
    return $output;

}

add_shortcode( 'section', 'evolution_section_sc' );



/** ---------------------------------------------------------
 * Section Small Content 900px
 */

function evolution_smallcontent_sc( $atts, $content = null ) {
    extract( shortcode_atts( array( 'background_color' => '', 'text_color' => '', 'title' => '', 'extra_class' => '' ), $atts ) );

    $output = $background_data = $text_color_class = $title_data = null;

    if ( $background_color ) {
        $background_data = ' style="background-color:' . $background_color . ';"';
    }

    if ( $text_color == 'light' ) {
        $text_color_class = " text-light";
    }

    if ( $title ) {
        $title_data = '<div class="section-title"><h3>' . $title . '</h3></div>';
    }

    $output = '
	<section class="row section' . $text_color_class . ' ' . $extra_class . '"' . $background_data . '>
		<div class="row-content buffer even clear-after smallcontent">
			' . $title_data . do_shortcode( $content ) . '
		</div>
	</section>';

    return $output;

}

add_shortcode( 'smallcontent', 'evolution_smallcontent_sc' );


/** ---------------------------------------------------------
 * Columns
 */

function evolution_columns_sc( $atts, $content = null, $tag ) {
	extract( shortcode_atts( array( 'centered_text' => '', 'last' => '', 'extra_class' => '' ), $atts ) );

	$output = $class_centered_text = $class_last = null;

	/* Replace some shortcode tags */
	if ( strpos( $tag, 'onehalf' ) !== false ) {
	    $tag = str_replace( 'onehalf', ' half', $tag );
	}
	if ( strpos( $tag, 'onethird' ) !== false ) {
	    $tag = str_replace( 'onethird', ' third', $tag );
	}
	if ( strpos( $tag, 'onefourth' ) !== false ) {
	    $tag = str_replace( 'onefourth', ' fourth', $tag );
	}
	if ( strpos( $tag, 'onesixth' ) !== false ) {
	    $tag = str_replace( 'onesixth', ' sixth', $tag );
	}
	if ( strpos( $tag, 'onewhole' ) !== false ) {
	    $tag = str_replace( 'onewhole', ' full', $tag );
	}

	if( $centered_text == 'true' ) {
		$class_centered_text = ' centertxt';
	}

	if( $last == 'true' ) {
		$class_last = ' last';
	}
	
	$output = '
	<div class="column ' . $tag . $class_last . $class_centered_text . ' ' . $extra_class . '">
	' . do_shortcode( $content ) . '
	</div>';
	
	return $output;

}

add_shortcode( 'onehalf', 'evolution_columns_sc' );
add_shortcode( 'onethird', 'evolution_columns_sc' );
add_shortcode( 'twothirds', 'evolution_columns_sc' );
add_shortcode( 'onefourth', 'evolution_columns_sc' );
add_shortcode( 'threefourths', 'evolution_columns_sc' );
add_shortcode( 'onesixth', 'evolution_columns_sc' );
add_shortcode( 'fivesixths', 'evolution_columns_sc' );
add_shortcode( 'onewhole', 'evolution_columns_sc' );

/** ---------------------------------------------------------
 * Button
 */

function evolution_button_sc( $atts ) {
	extract( shortcode_atts( array( 'text' => '', 'url' => '', 'color' => '', 'style' => '', 'open_new_tab' => '', 'extra_class' => '' ), $atts) );

	$output = $target_data = $style_class = null;

	if ( $text ) {
		
		if ( $open_new_tab == 'true' ) {
			$target_data = ' target="_blank"';
		}

		if ( $style == 'transparent' ) {
			$style_class = ' transparent';
		}
		
		$output = '<a class="button ' . $color . $style_class . ' ' . $extra_class . '" href="' . $url . '"' . $target_data . '>' . $text . '</a>';
		
	}	

	return $output;

}

add_shortcode( 'button', 'evolution_button_sc' );

/** ---------------------------------------------------------
 * Icon
 */

function evolution_icon_sc( $atts ) {
	extract( shortcode_atts( array( 'color' => '', 'type' => '', 'extra_class' => '' ), $atts ) );

	$output = $color_class = null;

	if ( $type ) {

		if ( $color && $color != 'none' ) {
			$color_class = $color;
		} 
		
		$output = '<i class="' . $type . ' ' . $color_class . ' ' . $extra_class . '"></i>';

	}
	
	return $output;

}

add_shortcode( 'icon', 'evolution_icon_sc' );

/** ---------------------------------------------------------
 * CTA
 */

function evolution_cta_sc( $atts, $content = null ) {
	extract( shortcode_atts( array( 'button_text' => '', 'button_url' => '', 'button_color' => '', 'button_style' => '', 'open_new_tab' => '', 'animation' => '' ), $atts) );
	
	$output = $animation_class = $button_data = $target_data = $button_style_class = null;

	if ( $animation == 'true' ) {
		$animation_class = ' onscreen-animation';
	}
	
	if ( $button_text ) {
		
		if ( $open_new_tab == 'true' ) {
			$target_data = ' target="_blank"';
		}

		if ( $button_style == 'transparent' ) {
			$button_style_class = ' transparent';
		}
		
		$button_data = '<a class="button ' . $button_color . $button_style_class . '" href="' . $button_url . '"' . $target_data . '>' . $button_text . '</a>';
		
	}
	
	$output = '
	<div class="call-to-action' . $animation_class . '">
		<p>' . do_shortcode( $content ) . '</p>
		' . $button_data . '
	</div>';

	return $output;

}

add_shortcode( 'cta', 'evolution_cta_sc' );

/** ---------------------------------------------------------
 * Slogan
 */

function evolution_slogan_sc( $atts, $content = null ) {
	extract( shortcode_atts( array( 'title' => '', 'animation' => '' ), $atts ) );
	
	$output = $title_data = $content_data = $animation_class = null;

	if ( $title ) {
		$title_data = '<h2>' . $title . '</h2>';
	}

	if ( $content ) {
		$content_data = '<p>' . $content . '</p>';
	}

	if ( $animation == 'true' ) {
		$animation_class = ' onscreen-animation';
	}
	
	$output = '<div class="slogan' . $animation_class . '">' . $title_data . $content_data . '</div>';
	
	return $output;

}

add_shortcode( 'slogan', 'evolution_slogan_sc' );

/** ---------------------------------------------------------
 * Skills Rings
 */

function evolution_skills_rings_sc( $atts ) {
	extract( shortcode_atts( array( 'percent' => '', 'label' => '', 'color' => '', 'animation_time' => '' ), $atts ) );

	$output = null;

	$animation_data = ' data-animate="2000"';
	if ( $animation_time ) {
		$animation_data = ' data-animate="' . $animation_time . '"';
	}

	$color_data = '';
	if ( $color ) {
		$color_data = ' data-bar-color="' . $color . '"';
	}	
		
	$output = '
	<div class="chart" data-percent="' . $percent . '"' . $color_data . $animation_data . '>
		<div class="chart-content">
			<div class="percent"></div>
			<div class="chart-title">' . $label . '</div>
		</div>
	</div>';
	
	return $output;

}

add_shortcode( 'skills_ring', 'evolution_skills_rings_sc' );


/** ---------------------------------------------------------
 * Services
 */

function evolution_service_sc( $atts, $content = null ) {
	extract( shortcode_atts( array( 'icon_size' => '', 'icon_color' => '', 'icon_type' => '', 'title' => '' ), $atts ) );

	$output = $icon_color_class = $title_data = $content_data = null;

	$icon_size_class = 'small-icon';
	$content_size_class = 'xs';
	if ( $icon_size == 'big' ) {
		$icon_size_class = 'big-icon';
		$content_size_class = 's';
	}

	if ( $icon_color && $icon_color != 'none' ) {
		$icon_color_class = $icon_color;
	}

	if ( $title ) {
		$title_data = '<h4>' . $title . '</h4>';
	}

	if ( $content ) {
		$content_data = '<p class="text-' . $content_size_class . '">' . do_shortcode( $content ) . '</p>';
	}

	if ( $icon_type ) {

		$output = '
		<div class="' . $icon_size_class . ' ' . $icon_color_class . '"><i class="icon ' . $icon_type . '"></i></div>
		<div class="' . $icon_size_class . '-text clear-after">' . $title_data . $content_data . '</div>';

	}

	return $output;

}

add_shortcode( 'service', 'evolution_service_sc' );

/** ---------------------------------------------------------
 * Team Member
 */

function evolution_team_member_sc( $atts ) {
	extract( shortcode_atts( array( 'image_url' => '', 'name' => '', 'role' => '', 'social' => '' ), $atts ) );

	$output = null;

	if ( $name ) {

		$output = '<figure class="about-us">';

		if ( $image_url ) {
			
			$output .= '<img src="' . aq_resize( $image_url, 640, 640, true, true, true ) . '" alt="' . $name . '">';

		} else {

			$output .= '<img src="' . get_template_directory_uri() . '/evolution/includes/img/team-member-default.jpg" alt="' . $name . '">';

		}

		$output .= '<figcaption>';
		$output .= '<h4>' . $name . '</h4>';
		
		if ( $role ) {

			$output .= '<p>' . $role . '</p>';

		}

		/* Social links */
		if ( $social ) {

			$social_arr = explode( ',', $social );
			
			$output .= '<div class="social-icons"><ul class="social-link">';	

			for ( $i = 0; $i < count( $social_arr ); $i = $i + 2 ) {

				/* Open in a new page if the link points to another domain */
				$target = null;
	     	    $url_host = parse_url( $social_arr[ $i + 1 ], PHP_URL_HOST );
			    $base_url_host = parse_url( get_template_directory_uri(), PHP_URL_HOST );
			    if( $url_host != $base_url_host || empty( $url_host ) ) {
			    	$target = 'target="_blank"';
			    }
	         		
				$social_name = strtolower( str_replace( ' ', '-', trim( $social_arr[ $i ] ) ) );
				$social_url = trim( $social_arr[ $i + 1 ] );
				$output .= '<li><a ' . $target . ' href="' . $social_url . '" class="' . $social_name . '-share border-box"><i class="icon-' . $social_name . '"></i></a></li>';  
	        }

			$output .= '</ul></div>';

		}

		$output .= '</figcaption>';
		$output .= '</figure>';

	}
	
	return str_replace( '\r\n', '', $output );

}

add_shortcode( 'team_member', 'evolution_team_member_sc' );


/** ---------------------------------------------------------
 * Map
 */

function evolution_map_sc( $atts ) {
	extract( shortcode_atts( array( 'latitude' => '', 'longitude' => '', 'zoom' => '', 'style' => '', 'height' => '', 'marker' => '', 'tooltip' => '', 'extra_class' => '' ), $atts ) );
	
	/* Load Google Maps scripts */
	wp_enqueue_script( array( 'google-map', 'evolution-map' ) );

	$output = null;

	if ( $latitude && $longitude ) {

		$zoom_data = 3;
		if ( $zoom ) {
			$zoom_data = $zoom; 
		}

		$style_data = 'default';
		if ( $style ) {
			$style_data = $style; 
		}

		$height_data = 22.222;
		if ( $height ) {
			$height_data = $height; 
		}

		$output .= '
		<section class="row section">
			<div class="map ' . $extra_class . '" data-maplat="' . $latitude . '" data-maplon="' . $longitude . '" data-mapzoom="' . $zoom_data . '" data-color="' . $style_data . '" data-height="' . $height_data . '" data-img="' . $marker . '" data-info="' . $tooltip . '"></div>
		</section>';
	
	}
	
	return $output;

}

add_shortcode( 'map', 'evolution_map_sc' );



/** ---------------------------------------------------------
 * Mockup Slider
 */

/* Full Width Mockup */
function evolution_mockup_sc( $atts, $content = null ) {
	extract( shortcode_atts( array( 'device' => '', 'color' => '', 'arrows_color' => '', 'autoplay' => '', 'rewind_speed' => '' ), $atts ) );

	$output = $autoplay_data = null;

	$device_class = ' iphone-slider';
	if ( $device ) {
		$device_class = ' ' . $device . '-slider';
	}

	$color_class = ' black';
	if ( $color ) {
		$color_class = ' ' . $color;
	}	

	$arrows_color_class = ' dark-controls';
	if ( $arrows_color == 'white') {
		$arrows_color_class = ' white-controls';
	}

	if ( $autoplay ) {
		$autoplay_data = ' data-autoplay="' . $autoplay . '"';
	}

	if ( $rewind_speed ) {
		$rewind_data = ' data-rewind="' . $rewind_speed . '"';
	} else {
		$rewind_data = ' data-rewind="1000"';
	}	
	
	$output = null;
	$output .= '
	<div class="mockup-wrapper' . $device_class . $color_class . $arrows_color_class . '"' . $autoplay_data . $rewind_data . '>
		' . do_shortcode( $content ) . '
	</div>';
	
	return $output;

}

add_shortcode( 'mockup', 'evolution_mockup_sc' );


/* Half Mockup */
function evolution_half_mockup_sc( $atts, $content = null ) {
	extract( shortcode_atts( array( 'device' => '', 'color' => '', 'layout' => '', 'autoplay' => '' ), $atts ) );
	
	$output = $autoplay_data = null;

	$device_class = ' iphone-slider';
	if ( $device ) {
		$device_class = ' ' . $device . '-slider';
	}

	$color_class = ' black';
	if ( $color ) {
		$color_class = ' ' . $color;
	}	

	$layout_class = ' left';
	if ( $layout == 'right' ) {
		$layout_class = ' right';
	}	

	if ( $autoplay ) {
		$autoplay_data = ' data-autoplay="' . $autoplay . '"';
	}

	$output = null;
	$output .= '
	<div class="mockup-wrapper side-mockup' . $layout_class . '-mockup' . $device_class . $color_class . '"' . $autoplay_data . '>
		' . do_shortcode( $content ) . '
	</div>';
	
	return $output;

}

add_shortcode( 'mockup_half', 'evolution_half_mockup_sc' );



	/* Mockup Screens */
	function evolution_mockup_screens_sc( $atts ) {
		extract( shortcode_atts( array( 'url'  =>  '' ), $atts ) );
		
		$output = null;

		if ( $url ) {

			$url_arr = explode( ',', $url );

			$output = '<div class="slider">';
			$output .= '<figure>';

			foreach ( $url_arr as $url_link ) {

				$output .=  '<div><img src="' . $url_link . '" alt=""></div>'; 

			}

			$output .= '</figure>';
			$output .= '</div>';

		} else {

			$output .= '<div class="slider">' . __( 'Please, make sure to select some screens to make the mockup appear!', evolution_THEME_NAME ) . '</div>';

		}

		return str_replace( '\r\n', '', $output );		

	}

	add_shortcode( 'mockup_screens', 'evolution_mockup_screens_sc' );

	/* Half page label (Side Mockup) */
	add_shortcode( 'mockup_aside', 'evolution_half_aside_sc' );



/** ---------------------------------------------------------
 * Testimonial
 */

function evolution_testimonial_sc( $atts, $content = null ) {
	extract( shortcode_atts( array( 'autoplay' => '', 'transition' => '', 'pagination' => '', 'centered_text' => '' ), $atts ) );

	$output = $autoplay_data = $pagination_data = $transition_data = $class_centered_text = null;

	if ( $autoplay ) {
		$autoplay_data = ' data-autoplay="' . $autoplay . '"';
	}

	if ( $pagination ) {
		$pagination_data = ' data-pagination="' . $pagination . '"';
	}

	if ( $transition ) {
		$transition_data = ' data-transition="' . $transition . '"';
	}

	if( $centered_text == 'true' ) {
		$class_centered_text = ' centertxt';
	}

	$output = '
	<div class="testimonial-slider ' . $class_centered_text . '"' . $autoplay_data . $pagination_data . $transition_data . '>
	' . do_shortcode( $content ) . '
	</div>';
	
	
	return $output;

}

add_shortcode( 'testimonial', 'evolution_testimonial_sc' );



	/* Quote - Part of Testimonial */
	function evolution_quote_sc( $atts, $content = null ) {
		extract( shortcode_atts( array( 'author' => '', 'website' => '', 'image_url' => '' ), $atts ) );

		$output = $author_data = null;  

		if ( $author ) {
			$author_data = '<div class="author"><strong>' . $author . '</strong> &ndash; ';
		}
        if ( $website ) {
			$website_data = '<span class="website"><a href="'. $website . '" target="_blank">' . $website . '</a></span></div>';
		}	
		
		/* Check if image exists */
		if ( $image_url ) {
			$output = '
			<div class="quote">
				<div class="column two">
					<figure class="testimonial-img">
						<img src="' . aq_resize( $image_url, 320, 320, true, true, true ) . '" alt="' . $author . '">
					</figure>
				</div>
				<div class="column ten last">';
		} else {
			$output = '
			<div class="quote">
				<div class="column twelve last">';
		} 

		$output .= '
				<p>' . $content . '</p>' . $author_data .'';
                
        $output .= '' .$website_data . '        
			</div>
		</div>';
		
		
		return $output;

	}

	add_shortcode( 'quote', 'evolution_quote_sc' );


/** ---------------------------------------------------------
 * Custom Carousel
 */

function evolution_custom_carousel_sc( $atts, $content = null ) {
	extract( shortcode_atts( array( 'autoplay' => '', 'transition' => '', 'pagination' => '' ), $atts ) );

	$output = $autoplay_data = $pagination_data = $transition_data = null;

	if ( $autoplay ) {
		$autoplay_data = ' data-autoplay="' . $autoplay . '"';
	}

	if ( $pagination ) {
		$pagination_data = ' data-pagination="' . $pagination . '"';
	}

	if ( $transition ) {
		$transition_data = ' data-transition="' . $transition . '"';
	}
		
	$output = '
	<div class="custom-carousel"' . $autoplay_data . $pagination_data . $transition_data . '>
		' . do_shortcode( $content ) . '
	</div>';
	
	return $output;

}

add_shortcode( 'custom_carousel', 'evolution_custom_carousel_sc' );

	/* Carousel Item */
	function evolution_carousel_item_sc( $atts, $content = null ) {
			
		$output = null;

		$output = '
		<div class="carousel-item">
			' . do_shortcode( $content ) . '
		</div>';
		
		return $output;

	}

	add_shortcode( 'carousel_item', 'evolution_carousel_item_sc' );



/** ---------------------------------------------------------
 * Social
 */

function evolution_social_sc( $atts ) {
	extract( shortcode_atts( array( 'title' => '', 'links' => '' ), $atts ) );

	$output = $title_data = null;

	if ( $title ) {
		$title_data = '<h4 class="widget-title">' . $title . '</h4>';
	}

	if ( $links ) {

		$social_arr = explode( ',', $links );

		$output = '<div class="evolution-social-icons">';
		$output .= $title_data;
		$output .= '<ul class="social-link">';	

		for ( $i = 0; $i < count( $social_arr ); $i = $i + 2 ) {

			/* Open in a new page if the link points to another domain */
			$target = null;
     	    $url_host = parse_url( $social_arr[ $i + 1 ], PHP_URL_HOST );
		    $base_url_host = parse_url( get_template_directory_uri(), PHP_URL_HOST );
		    if( $url_host != $base_url_host || empty( $url_host ) ) {
		    	$target = 'target="_blank"';
		    }
		
			$social_name = strtolower( str_replace( ' ', '-', trim( $social_arr[ $i ] ) ) );
			$social_url = trim( $social_arr[ $i + 1 ] );
			$output .= '<li><a ' . $target . ' href="' . $social_url . '" class="' . $social_name . '-share border-box"><i class="icon-' . $social_name . '"></i></a></li>';	

		}

		$output .= '</ul></div>';

	}
			
	return str_replace( '\r\n', '', $output );

}

add_shortcode( 'social', 'evolution_social_sc' );


/** ---------------------------------------------------------
 * Blog
 */

function evolution_blog_posts( $atts ) {
    extract( shortcode_atts( array( 'category' => '', 'articles' => '', 'style' => '', 'button_text' => '', 'button_url' => '', 'button_color' => '', 'button_style' => '', 'open_new_tab' => '' ), $atts ) );

    global $evolution, $more;

    $blog_content = $sizer = $button_data = $target_data = $button_style_class = null;

    /* Set dynamic posts_per_page and offset values */
    $latest_post = get_posts('numberposts=1');
    $latest_id = $latest_post[0]->ID;

    if ( $articles ) {
        if ( has_post_thumbnail( $latest_id ) && $style == 'masonry' ) {
            $articles_data = $articles -1;
        } else {
            $articles_data = $articles;
        }		
    } else {
        $articles_data = 4;			
    }

    if( $category == 'all' || $category == '' ) {
        $category = null;
    }	

    if ( $style != 'masonry' ) {

        $style_class = 'list-style';
        $buffer = 'buffer-left buffer-right buffer-bottom clear-after';	

    } else {

        $style_class = 'masonry-style grid-items preload';
        $buffer = 'buffer clear-after';
        $sizer = '<div class="shuffle-sizer three"></div>';

    }

    $blog_sc_args = array(
        'post_type' => 'post',
        'posts_per_page' => $articles_data,
        'category_name' => $category
    );

    query_posts( $blog_sc_args );


    if ( $button_text ) {

        if ( $open_new_tab == 'true' ) {
            $target_data = ' target="_blank"';
        }

        if ( $button_style == 'transparent' ) {
            $button_style_class = ' transparent';
        }

        $button_data = '<div class="more-btn"><a class="button ' . $button_color . $button_style_class . '" href="' . $button_url . '"' . $target_data . '>' . $button_text . '</a></div>';

    }   

    ob_start(); 

?>

<div class="blog-section <?php echo $style_class; ?> clear-after">

    <?php

    if ( have_posts() ) :

    while ( have_posts() ) : the_post();

    $more = 0;

    if ( $style != 'masonry' ) {

        get_template_part( 'template-parts/content', 'list' );

    } else {

        get_template_part( 'template-parts/listed', 'article-masonry' );

    }

    endwhile;

    echo $sizer;

    else :

    get_template_part( 'template-parts/content', 'none' );

    endif;

    ?>

</div>


<?php

    wp_reset_query();

    $blog_content = ob_get_contents();
    $blog_content .= $button_data;

    ob_end_clean();

    return $blog_content;

}

add_shortcode( 'blog', 'evolution_blog_posts' );



/** ---------------------------------------------------------
 * Portfolio
 */

function evolution_portfolio_sc( $atts ) {
	extract( shortcode_atts( array( 'id' => '', 'columns' => '', 'items' => '', 'lightbox' => '', 'button_text' => '', 'button_url' => '', 'button_color' => '', 'button_style' => '', 'open_new_tab' => '' ), $atts ) );

	$portfolio_content = $button_data = $target_data = $button_style_class = null;

	global $grid_class, $sc_lightbox;

	if ( $columns ) {
		$columns_data = $columns;		
	} else {
		$columns_data = 3;			
	}

	if ( $items ) {
		$items_data = $items;		
	} else {
		$items_data = $columns_data;			
	}		

	if ( $lightbox == 'true' ) {
		$lightbox_data = ' lightbox';		
	} else {
		$lightbox_data = null;			
	}

	$sc_lightbox = $lightbox;	

	switch ( $columns_data ) {
	    case '4' :
	        $grid_class = 'three';
	        break;
	    case '3' :
	        $grid_class = 'four';
	        break;
	    case '2' :
	        $grid_class = 'six';
	        break;
	}

	$sizer = '<div class="shuffle-sizer ' . $grid_class . '"></div>';

    $portfolio_sc_args = array(
        'post_type' => 'portfolio-' . $id,
        'posts_per_page' => $items_data
    );

    $wp_query = new WP_Query( $portfolio_sc_args );

    
    if ( $button_text ) {
    	
    	if ( $open_new_tab == 'true' ) {
    		$target_data = ' target="_blank"';
    	}

    	if ( $button_style == 'transparent' ) {
    		$button_style_class = ' transparent';
    	}
    	
    	$button_data = '<div class="more-btn"><a class="button ' . $button_color . $button_style_class . '" href="' . $button_url . '"' . $target_data . '>' . $button_text . '</a></div>';
    	
    }     

	ob_start(); 

	?>

	<div class="portfolio-section clear-after">

		<div class="grid-items preload<?php echo $lightbox_data; ?>">

			<?php

		    if ( $wp_query->have_posts() ) :

		        while ( $wp_query->have_posts() ) : $wp_query->the_post();

					get_template_part( 'listed', 'item' );

		        endwhile;

		        echo $sizer;

		    else :

		        get_template_part( 'content', 'none' );

		    endif;

		    ?>

		</div>

    </div>


    <?php

    wp_reset_postdata();

    $portfolio_content = ob_get_contents();
    $portfolio_content .= $button_data;

    ob_end_clean();
    
    return $portfolio_content;

}

add_shortcode( 'portfolio', 'evolution_portfolio_sc' );

/** ---------------------------------------------------------
 * Current year
 */

function evolution_year_sc() {

	$year = date('Y');

	return $year;

}

add_shortcode( 'current_year', 'evolution_year_sc' );


/** ---------------------------------------------------------
 * Remove empty <p> tags in shortcodes https://gist.github.com/bitfade/4555047
 * http://themeforest.net/forums/thread/how-to-add-shortcodes-in-wp-themes-without-being-rejected/98804?page=4#996848
 */
 
function evolution_the_content_filter( $content ) {

	/* Array of shortcodes requiring the fix */
	$block = join( '|', array( 'section', 'onehalf', 'onethird', 'twothirds', 'onefourth', 'threefourths', 'onesixth', 'fivesixth', 'onewhole', 'cta', 'skills_ring','service', 'map', 'timeline', 'timeline_aside', 'mockup', 'mockup_half', 'mockup_screens', 'mockup_aside', 'testimonial', 'quote', 'custom_carousel', 'carousel_item', 'text_widget', 'blog', 'portfolio', 'dribbble' ) );
 
	/* Opening tag */
	$rep = preg_replace( "/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", "[$2$3]" , $content );
		
	/* Closing tag */
	$rep = preg_replace( "/(<p>)?\[\/($block)](<\/p>|<br \/>)?/", "[/$2]", $rep );
 
	return $rep;
 
}

add_filter( 'the_content', 'evolution_the_content_filter' );