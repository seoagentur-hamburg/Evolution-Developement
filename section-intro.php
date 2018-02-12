<?php
global $post, $intro_meta, $intro_featured;

if ( is_single() ) :

    if ( $intro_featured ) : // Check if an intro has been selected in posts/portfolios - $intro_featured = intro ID

        $page_id = ( is_home() ) ? get_option( 'page_for_posts' ) : get_the_ID();

        // Store metabox values -> Select Intro, Settings
        $intro_full_height = get_post_meta( $page_id, '_evolution_intro_single_full_height', true );
        $intro_scroll_arrow = get_post_meta( $page_id, '_evolution_intro_single_scroll_arrow', true );
        $intro_darken = get_post_meta( $page_id, '_evolution_intro_single_darken', true );

        $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'full' );

    ?>

        <div id="intro-wrap" class="<?php if ( $intro_full_height ) echo 'full-height' ?>" data-height="33.333">

            <div id="intro" class="preload <?php if ( $intro_scroll_arrow ) echo 'more-button' ?> <?php if ( $intro_darken ) echo 'darken' ?>">

                <div class="intro-item intro-item-image" style="background-image: url('<?php echo esc_url( $image_attributes[0] ) ?>');"></div>

            </div>

        </div>

    <?php

    endif;

else :

    if ( $intro_meta) : // Check if an intro has been selected in pages - $intro_meta = intro ID

        $page_id = ( is_home() ) ? get_option( 'page_for_posts' ) : get_the_ID();

        // Store metabox values -> Select Intro, Settings
        $intro_full_height = get_post_meta( $page_id, '_evolution_intro_full_height', true );
        $intro_autoplay = get_post_meta( $page_id, '_evolution_intro_autoplay', true );
        $intro_navigation = get_post_meta( $page_id, '_evolution_intro_navigation', true );
        $intro_pagination = get_post_meta( $page_id, '_evolution_intro_pagination', true );
        $intro_scroll_arrow = get_post_meta( $page_id, '_evolution_intro_scroll_arrow', true );
        $intro_darken = get_post_meta( $page_id, '_evolution_intro_darken', true );

        if ( $intro_autoplay == '' ) { 
            $intro_autoplay = '';
        }
        if ( $intro_navigation ) { 
            $intro_navigation = 'true';
        }   
        if ( $intro_pagination ) { 
            $intro_pagination = 'true';
        }  

        // Select intro -> Featured image
        if ( $intro_meta == 'featured_image' ) :
            $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'full' );

        ?>

            <div id="intro-wrap" class="<?php if ( $intro_full_height ) echo 'full-height' ?>" data-height="33.333">

                <div id="intro" class="preload <?php if ( $intro_scroll_arrow ) echo 'more-button' ?> <?php if ( $intro_darken ) echo 'darken' ?>" data-autoplay="<?php echo $intro_autoplay ?>" data-navigation="<?php esc_attr_e( $intro_navigation ) ?>" data-pagination="<?php esc_attr_e( $intro_pagination ) ?>" data-transition="fade">

                    <div class="intro-item intro-item-image" style="background-image: url('<?php echo esc_url( $image_attributes[0] ) ?>');"></div>

                </div>

            </div>

        <?php

        // Select intro -> Precomposed Intro
        else :

            $slides = get_post_meta( $intro_meta, '_evolution_single_slide', true ); // true per entrare dentro l'array

            if ( $slides ) :
                         
            ?>

                <div id="intro-wrap" class="<?php if ( $intro_full_height ) echo 'full-height' ?>" data-height="33.333">

                    <div id="intro" class="preload <?php if ( $intro_scroll_arrow ) echo 'more-button' ?> <?php if ( $intro_darken ) echo 'darken' ?>" data-autoplay="<?php echo $intro_autoplay ?>" data-navigation="<?php esc_attr_e( $intro_navigation ) ?>" data-pagination="<?php esc_attr_e( $intro_pagination ) ?>" data-transition="fade">

                        <?php foreach ( $slides as $slide ) : ?>

                            <?php
                            // Store metabox values -> Single Slide, Settings
                            $slide_type = get_meta( $slide, '_evolution_slide_type' );
                            $bg_color = get_meta( $slide, '_evolution_slide_bg_color' );
                            $bg_image_id = get_meta( $slide, '_evolution_slide_select_image_id' );
                            $bg_image = wp_get_attachment_image_src( $bg_image_id, 'intro' );
                            $bg_image_url = $bg_image[0];
                            $bg_img_alt = get_post_meta( $bg_image_id, '_wp_attachment_image_alt', true );
                            $font_color = get_meta( $slide, '_evolution_slide_font_color' );
                            $slide_title = get_meta( $slide, '_evolution_slide_title' );
                            $slide_subtitle = get_meta( $slide, '_evolution_slide_subtitle' );
                            $credits_box = get_meta( $slide, '_evolution_slide_credits_box' );                    
                            $show_button = get_meta( $slide, '_evolution_slide_button_show' );
                            $button_text = get_meta( $slide, '_evolution_slide_button_text' );
                            $button_link = get_meta( $slide, '_evolution_slide_button_link' );
                            $button_style = get_meta( $slide, '_evolution_slide_button_style' );                    
                            $button_color = get_meta( $slide, '_evolution_slide_button_color' );
                            $button_new_tab = get_meta( $slide, '_evolution_slide_button_new_tab' );
                            $mockup_caption = get_meta( $slide, '_evolution_slide_mockup_layout');
                            $map_latitude = get_meta( $slide, '_evolution_map_latitude' );
                            $map_longitude = get_meta( $slide, '_evolution_map_longitude' );
                            $map_zoom = get_meta( $slide, '_evolution_map_zoom' );
                            $map_style = get_meta( $slide, '_evolution_map_style' );
                            $map_marker = get_meta( $slide, '_evolution_map_marker' );
                            $map_tooltip = get_meta( $slide, '_evolution_map_tooltip' );
                            $extra_class = get_meta( $slide, '_evolution_slide_extra_class' );
                            ?>

                            <?php

                            // Reset vars
                            $bgAttr = $bgClass = $fontColor = $btnStyle = $btnColor = $btnTarget = $mockupClass = $mockupCaptionClass = $mapStyle = $mapMarker = $mapTooltip = '';

                            // Background & image
                            if ( $bg_color ) {
                                $bgAttr .= 'background-color: ' . $bg_color . ';';
                            }
                            if ( $slide_type && $slide_type === 'image_bg' && $bg_image ) {
                                $bgAttr .= ' background-image: url(' . $bg_image_url . ');';
                                $bgClass .= 'intro-item-image';
                            }

                            // Font color
                            if ( $font_color && $font_color === 'font_dark' ) {
                                $fontColor = 'dark';
                            }

                            // Button options
                            if ( $button_style && $button_style === 'transparent' ) {
                                $btnStyle = $button_style;
                            }
                            if ( $button_color ) {
                                $btnColor = $button_color;
                            }
                            if ( $button_new_tab ) {
                                $btnTarget = ' target="_blank"';
                            }

                            // Mockup captions
                            if ( $mockup_caption === 'left_caption' ) {  
                                $mockupClass = 'caption-left column six';
                                $mockupCaptionClass = 'intro-right column six last-special';
                            } else if ( $mockup_caption === 'right_caption' ) {
                                $mockupClass = 'caption-right column six last-special';
                                $mockupCaptionClass = 'intro-left column six';
                            }  

                            // Map
                            // Fix map offset when there are no images into the intro
                            $placeholderUrl = get_template_directory_uri() . '/evolution/includes/img/placeholder.png';
                            $placeholder = 'background-image: url(' . $placeholderUrl . ');';

                            if ( $map_style ) {
                                $mapStyle = $map_style;
                            }
                            if ( $map_marker ) {
                                $mapMarker = $map_marker;
                            } else {
                                $mapMarker = $placeholderUrl;
                            }
                            if ( $map_latitude == '' ) {
                                $map_latitude = 40.714353;
                            }
                            if ( $map_longitude == '' ) {
                                $map_longitude = -74.005973;
                            }
                            if ( $map_zoom == '' ) {
                                $map_zoom = 7;
                            } 
                            if ( $map_tooltip !== '' ) {
                                $mapTooltip = $map_tooltip;
                            }                                        
                            ?>

                            <?php if ( $slide_type && $slide_type === 'image_bg' ) : // Slide is an image ?>

                                <div class="intro-item <?php esc_attr_e( $bgClass ) ?> <?php esc_attr_e( $extra_class ) ?>" style="<?php echo $bgAttr ?>">

                                    <?php if ( $slide_title || $slide_subtitle || $show_button ) : ?>

                                        <div class="caption <?php esc_attr_e( $fontColor ) ?>">
                                            
                                            <div class="caption-inner">

                                            <?php if ( $slide_title ) : ?>

                                                <h2><?php esc_html_e( $slide_title ) ?></h2>
                                            
                                            <?php endif; ?>

                                            <?php if ( $slide_subtitle ) : ?>

                                                <p><?php echo $slide_subtitle ?></p>

                                            <?php endif; ?>

                                            <?php if ( $show_button ) : ?>

                                                <a class="button <?php esc_attr_e( $btnStyle ) ?> <?php esc_attr_e( $btnColor ) ?>" href="<?php if ( $button_link ) echo esc_url( $button_link ) ?>"<?php echo $btnTarget ?>><?php if ( $button_text ) esc_html_e( $button_text ) ?></a>

                                            <?php endif; ?>
                                            
                                            </div>

                                        </div>

                                    <?php endif; ?>

                                    <?php if ( $credits_box ) : ?>

                                        <div class="photocaption">

                                            <h4><?php echo $credits_box ?></h4>

                                        </div>  

                                    <?php endif; ?> 

                                </div>

                            <?php elseif ( $slide_type && $slide_type === 'device_mockup' ) : // Slide is a mockup ?>

                                <div class="intro-item <?php esc_attr_e( $bgClass ) ?> <?php esc_attr_e( $extra_class ) ?>" style="<?php echo $bgAttr ?>">

                                    <div class="intro-mockup-wrapper">

                                        <div class="caption-mockup <?php esc_attr_e( $fontColor ) ?> <?php esc_attr_e( $mockupClass ) ?>">

                                            <?php if ( $slide_title ) : ?>

                                                <h2><?php esc_html_e( $slide_title ) ?></h2>
                                            
                                            <?php endif; ?>

                                            <?php if ( $slide_subtitle ) : ?>

                                                <p><?php echo $slide_subtitle ?></p>

                                            <?php endif; ?>

                                            <?php if ( $show_button ) : ?>

                                                <a class="button <?php esc_attr_e( $btnStyle ) ?> <?php esc_attr_e( $btnColor ) ?>" href="<?php echo esc_url( $button_link ) ?>"<?php echo $btnTarget ?>><?php esc_html_e( $button_text ) ?></a>

                                            <?php endif; ?>

                                        </div>

                                        <?php if ( $credits_box ) : ?>

                                            <div class="photocaption">

                                                <h4><?php echo $credits_box ?></h4>

                                            </div>  

                                        <?php endif; ?> 

                                        <div class="intro-mockup <?php esc_attr_e( $mockupCaptionClass ) ?>">

                                            <?php if ( $bg_image ) : ?>

                                                <img src="<?php esc_attr_e( $bg_image_url ) ?>" alt="<?php esc_attr_e( $bg_img_alt ) ?>">

                                            <?php endif; ?>

                                        </div> 

                                    </div>

                                </div>

                            <?php elseif ( $slide_type && $slide_type === 'intro_map' ) : // Slide is a map ?>

                                <?php wp_enqueue_script( array( 'google-map', 'beetle-map' ) ); // Load Google Maps scripts ?>

                                <div class="intro-item map <?php esc_attr_e( $extra_class ) ?>" style="<?php echo $bgAttr ?> <?php esc_attr_e( $placeholder ) ?>" data-maplat="<?php echo $map_latitude ?>" data-maplon="<?php echo $map_longitude ?>" data-mapzoom="<?php echo $map_zoom ?>" data-color="<?php esc_attr_e( $mapStyle ) ?>" data-img="<?php echo esc_url( $mapMarker ) ?>" data-info="<?php esc_attr_e( $mapTooltip ) ?>"></div>

                            <?php endif; ?> 

                        <?php endforeach; ?>

                    </div><!-- intro -->

                </div><!-- intro-wrap -->

            <?php

            endif;

        endif;

    endif;

endif;

?>