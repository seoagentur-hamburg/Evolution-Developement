jQuery(document).ready(function($){

	// Hide/Show Add Shortocode button
	function handleButton() {
		if ( $('.chosen-single').hasClass('chosen-default') ) {
			$('#add-shortcode').hide();
		} else {
			$('#add-shortcode').show();
		}
	} 

	$('#evolution-shortcodes').change(function() {
		handleButton();
	});
    
    
    $('.wp-color-picker').wpColorPicker();


	// Upload function
	function initUpload(clone) {
			
		var itemToInit = null;

		itemToInit = typeof clone !== 'undefined' ? clone : $('.content-image');
			
        itemToInit.find('.image-upload').on('click',function( event ) {
				
            var activeFileUploadContext = jQuery(this).parent();
            var relid = jQuery(this).attr('rel-id');
			
            event.preventDefault();
            
            // if its not null, its broking custom_file_frame's onselect "activeFileUploadContext"
            custom_file_frame = null;

            // Create the media frame.
            custom_file_frame = wp.media.frames.customHeader = wp.media({

                // Set the title of the modal.
                title: jQuery(this).data('choose'),

                // Tell the modal to show only images. Ignore if want ALL
                library: {
                    type: 'image'
                },
                // Customize the submit button.
                button: {
                    // Set the text of the button.
                    text: jQuery(this).data('update')
                }

            });

            custom_file_frame.on( 'select', function() {
       
                // Grab the selected attachment.
                var attachment = custom_file_frame.state().get('selection').first();

                // Update value of the targetfield input with the attachment url.
                jQuery('.image-screenshot',activeFileUploadContext).attr('src', attachment.attributes.url);
                jQuery('#' + relid ).val(attachment.attributes.url).trigger('change');

                jQuery('.image-upload',activeFileUploadContext).hide();
                jQuery('.image-screenshot',activeFileUploadContext).show();
                jQuery('.image-upload-remove',activeFileUploadContext).show();

        	});

        	custom_file_frame.open();

        });

	   	itemToInit.find('.image-upload-remove').on('click', function( event ) {

	        var activeFileUploadContext = jQuery(this).parent();
	        var relid = jQuery(this).attr('rel-id');
	
	        event.preventDefault();
	
	        jQuery('#' + relid).val('');
	        jQuery(this).prev().fadeIn('slow');
	        jQuery('.image-screenshot',activeFileUploadContext).fadeOut('slow');
	        jQuery(this).fadeOut('slow');

	    });

	}

	// Skills rings        		
	function skillsPercent() {

		var $output = $("<span>");
		$output.addClass('output');
		
		$("div.shortcode-options[data-name=skills_ring] .shortcode-dynamic-items > div:last-child .content.dd-percent").append($output);
		$("[data-slider]").bind("slider:ready slider:changed", function (event, data) {
		 	$(this).nextAll(".output:first").html(data.value + '%').attr('data-num',data.value);
		});

		// init if it's a skills ring
		$('.percent-slider').noUiSlider({
			start: 50,
			range: {
				'min': 1,
				'max': 100
			},
			step: 1,
			connect: 'lower',
			behaviour: 'tap-drag',
			format: wNumb({
				decimals: 0
			})
		});

		$('.percent-slider').Link('lower').to($('.percent'));

	}		


	// Open shortcode popup
	$('body').on('click','.evolution-shortcode-generator', function(e) {
    	e.preventDefault();
    	handleButton(); // handleButton again
 
        $.magnificPopup.open({
            mainClass: 'mfp-zoom-in',
 		 	items: {
  	     		src: '#evolution-sc-generator'
        	},
         	type: 'inline',
            removalDelay: 500
	    }, 0);         
 
	}); 	


	// Init chosen plugin to make select boxes user-friendly (http://harvesthq.github.io/chosen/)
	$('select#evolution-shortcodes').chosen();

	// call function to upload images
	initUpload();

	// init skills rings slider
	skillsPercent();


    function custom_content() {
   	
		var code = '';

		// mockups -> screens (for both normal and side mockup carousels)
		$('.mockup-screens').each(function() {

			if( $(this).is(':visible') ) {

				// check if it is an Half Mockup to output the aside
				if ( $(this).closest('.shortcode-options').is('#options-mockup_half') ) {

					asideTitle = $('#options-mockup_half').find('input[data-attrname="aside_title"]').val();
					asideContent = ($('#options-mockup_half').find('textarea[data-attrname="aside_content"]').val().length > 0) ? $('#options-mockup_half').find('textarea[data-attrname="aside_content"]').val() : '';

					var asideTitleData = '';

					if ( asideTitle != '' ) {
						asideTitleData = ' title="' + asideTitle + '"';
					}

					code += '&lt;br&gt;[mockup_aside' + asideTitleData + ']' + asideContent + '[/mockup_aside]';

				}

				screens = $(this).find('.shortcode-dynamic-item');
				data = [];

				screens.each(function() {
					
					screenImage = $(this).find('.image-screenshot:first').attr('src');

					if ( screenImage != '' ) {

						data.push(screenImage);

					}
					
				});

				code += '&lt;br&gt;[mockup_screens url="' + data.join(',') + '"]&lt;br&gt;';

			}				

		});

		// timeline -> aside
		if( $('#options-timeline').is(':visible') ) {

			asideTitle = $('#options-timeline').find('input[data-attrname="aside_title"]').val();
			asideContent = ($('#options-timeline').find('textarea[data-attrname="aside_content"]').val().length > 0) ? $('#options-timeline').find('textarea[data-attrname="aside_content"]').val() : '';

			var asideTitleData = '';

			if ( asideTitle != '' ) {
				asideTitleData = ' title="' + asideTitle + '"';
			}

			code += '&lt;br&gt;[timeline_aside' + asideTitleData + ']' + asideContent + '[/timeline_aside]&lt;br&gt;';

		}

		// testimonial
		else if( $('#options-testimonial').is(':visible') ) {
			$('#options-testimonial .shortcode-dynamic-item').each(function() {
				testimonialAuthor = $(this).find('.shortcode-dynamic-item-input:nth-child(1)').val();
				testimonialQuote = ($(this).find('textarea[data-attrname="content_inside"]').val().length > 0) ? $(this).find('textarea[data-attrname="content_inside"]').val() : '';
				testimonialImage = $(this).find('.image-screenshot:first').attr('src');

				var testimonialImageData = testimonialAuthorData = '';

				if ( testimonialImage != '' ) {
					testimonialImageData = ' image_url="' + testimonialImage + '"';
				}

				if ( testimonialAuthor != '' ) {
					testimonialAuthorData = ' author="' + testimonialAuthor + '"';
				}
				
				code += '&lt;br&gt;[quote' + testimonialImageData + testimonialAuthorData + ']' + testimonialQuote + '[/quote]'; 
			});
			code += '&lt;br&gt;';
		}			

		// custom carousel
		else if( $('#options-custom_carousel').is(':visible') ) {
			code = '&lt;br&gt;' + 
			'[carousel_item] Carousel content [/carousel_item]&lt;br&gt;' + 
			'[carousel_item] Carousel content [/carousel_item]&lt;br&gt;' + 
			'[carousel_item] Carousel content [/carousel_item]&lt;br&gt;';
		}
		
		// output
		$('#shortcode-storage-content').html(code);

    }  

    
    function store_shortcode() {
		
		var name = $('#evolution-shortcodes').val();
		var dataType = $('#options-' + name).attr('data-type');
		var attr_text = attr_textarea = attr_radio = attr_checkbox = attr_select = attr_multiselect = attr_image = attr_icon = '';
				
		// take care of custom shortcodes
		custom_content();

		// opening shortcode
		opening = '[' + name;

		// text loop for extra attrs (valid for colorpicker too)
		$('#options-' + name + ' input[type=text]:not([data-attrname="content_inside"], .skip-processing)').each(function() {
			if( $(this).val() != '' ) { // if input is not empty
				attr_text += ' ' + $(this).attr('data-attrname') + '="' + $(this).val() + '"';	
			}
		});

		opening += attr_text;

		// textarea loop for extra attrs
		$('#options-' + name + ' textarea:not([data-attrname="content_inside"], .skip-processing)').each(function() {
			if( $(this).val() != '' ) { // if textarea is not empty
				attr_textarea += ' ' + $(this).attr('data-attrname') + '="' + $(this).val() + '"';	
			}
		});
		
		opening += attr_textarea;	

		// radio loop for extra attrs
		$('#options-' + name + ' input[type=radio]:not(.skip-processing)').each(function() {
			if( $(this).attr('checked') == 'checked' ) { // if radio is checked
				attr_radio += ' ' + $(this).attr('data-attrname') + '="' + $(this).attr('value') + '"';
			}
		});
		
		opening += attr_radio;				
		 
		// checkbox loop for extra attrs
		$('#options-' + name + ' input[type=checkbox]:not(.skip-processing)').each(function() {
			if( $(this).attr('checked') == 'checked' ) { // if checkbox is checked
				attr_checkbox += ' ' + $(this).attr('data-attrname') + '="true"';
			};	
		});
		
		opening += attr_checkbox;	
		
		// select loop for extra attrs
		$('#options-' + name + ' select:not([multiple=multiple], .skip-processing)').each(function() {
			if( $(this).val() != 'none' ) { // if select value is not 'none'
				attr_select += ' ' + $(this).attr('data-attrname') + '="' + $(this).attr('value') + '"';
			}	
		});
		
		opening += attr_select;
		
		// multiselect loop for extra attrs
		$('#options-' + name + ' select[multiple=multiple]:not(.skip-processing)').each(function() {
			var $categories = ( $(this).val() != null && $(this).val().length > 0 ) ? $(this).val() : 'all';
			attr_multiselect += ' ' + $(this).attr('data-attrname') + '="' + $categories + '"';	
		});
		
		opening += attr_multiselect;
		
		// image upload loop for extra attrs
		$('#options-' + name + ' img.image-screenshot:not(.skip-processing)').each(function() {
			if( $(this).attr('src') != '' ) { // if image is not empty
				attr_image += ' ' + $(this).attr('data-attrname') + '="' + $(this).attr('src') + '"';	
			}
		});
		
		opening += attr_image;
		
		// icon loop for extra attrs
		$('#options-' + name + ' .icon-option i.selected:not(.skip-processing)').each(function() {
			if( $(this).length > 0 ) {
				attr_icon += ' ' + $(this).closest('.icons-container').attr('data-attrname') + '="' + $(this).attr('class').split(' ')[0] + '"';
			}
		});
		
		opening += attr_icon;
		
		opening += ']';

		// closing shortcode
		closing = '[/' + name + ']';

		// output opening shortcode with attrs
		$('#shortcode-storage-opening').html(opening);	

		// output content inside shortcode tags
		$('[data-type="enclosing"]').each(function() {

			var enclosings = $(this),
				contentInside = enclosings.find('[data-attrname="content_inside"]');

			if( contentInside.length > 0 && enclosings.is(':visible') ) {

				content = (contentInside.val().length > 0) ? contentInside.val() : '';
				$('#shortcode-storage-content').html(content);

			}

		});

		// output content inside shortcode tags for custom shortcodes
		if( dataType == 'custom' ) {
			custom_content();
		}

		// output closing shortcode
		if( dataType != 'self_closing' ) {
			$('#shortcode-storage-closing').html(closing);
		}
		
	 }
     
	// Click on Add Shortcode
    $('#add-shortcode').click(function() {
    	
    	var name = $('#evolution-shortcodes').val(),
    		dataType = $('#options-' + name).attr('data-type');
    	
    	store_shortcode();
						
		window.wp.media.editor.insert( $('#shortcode-storage-opening').text() + $('#shortcode-storage-content').text() + $('#shortcode-storage-closing').text() );
		$.magnificPopup.close();
		
		// wipe out storage 
		$('#shortcode-storage-opening, #shortcode-storage-content, #shortcode-storage-closing').text('');
		
		resetFileds();
			
		return false;

    });

    // Select another shortcode
    $('#evolution-shortcodes').change(function(){

		$('.shortcode-options').hide();
		$('#options-' + $(this).val()).show();

    });
 	
 	// Handle repeatable items
    $('.add-list-item').click(function() {
    	
    	if(!$(this).parent().find('.remove-list-item').is(':visible')) $(this).parent().find('.remove-list-item').show();
    	
    	//clone item 
    	var $clone = $(this).parent().find('.shortcode-dynamic-item:first').clone();
    	$clone.find('input[type=text],textarea').attr('value','');  	
    	
    	//init new upload button and clear image if it's an upload
    	if( $clone.find('.image-upload').length > 0 ) {
    		$clone.find('.image-screenshot').attr('src','');
    		$clone.find('.image-upload-remove').hide();
    		$clone.find('.image-upload').css('display','inline-block');
    		setTimeout(function() { initUpload($clone) }, 200);
    	}
    	
    	//append clone
		$(this).prevAll('.shortcode-dynamic-items').append($clone);
			
		return false;

    });
	
    $('body').on('click', '.remove-list-item', function(){
    	if($(this).parent().find('.shortcode-dynamic-item').length > 1){
    		$(this).parent().find('.shortcode-dynamic-item:last').remove();
			// custom_content();	
    	}
    	if($(this).parent().find('.shortcode-dynamic-item').length == 1) $(this).hide();
    	
		return false;

    });
    
    // hide remove button first
    $('.remove-list-item').hide();
	
	// $('body').on('keyup','.shortcode-dynamic-item-input', function() { custom_content(); });
	// $('body').on('input propertychange', '.shortcode-dynamic-item textarea', function() { custom_content(); });
	
	// icon selection
	$('.icon-option i').click(function() {
		$('.icon-option i').removeClass('selected');
		$(this).addClass('selected');
	});
	
	// icon set selection
	$('select[data-attrname="icon-select"]').change(function() {
		var $selected_set = $(this).val();
		$(this).parents('.shortcode-options').find('.icon-option').hide();
		$(this).parents('.shortcode-options').find('.icon-option.' + $selected_set).stop(true,true).fadeIn();
	});
	$('select[data-attrname="icon-select"]').trigger('change');

	
	function resetFileds() {
		//reset data
		// $('#evolution-sc-generator').find('input:text, input:password, input:file, textarea').val('');
		// $('#evolution-sc-generator').find('select:not(#evolution-shortcodes) option:first-child').attr("selected", "selected");
		//$('#evolution-sc-generator').find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
		// $('#evolution-sc-generator').find('.shortcode-options').each(function() {
		// 	$(this).find('.shortcode-dynamic-item').addClass('marked-for-removal');
		// 	$(this).find('.shortcode-dynamic-item:first').removeClass('marked-for-removal');
		// 	$(this).find('.shortcode-dynamic-item.marked-for-removal').remove();
		// });
		$('#evolution-sc-generator').find('.image-screenshot').attr('src','');
		$('#evolution-sc-generator').find('.image-upload-remove').hide();
		$('#evolution-sc-generator').find('.image-upload').show();
		$('#evolution-sc-generator').find('.wp-color-result').attr('style','');
		$('#evolution-sc-generator').find('input.wp-color-picker').val('');
		$('select[name="icon-set-select"]').trigger('change');
		
		// reset mockupColor()
		$('select[data-attrname="device"]').parents('.content-device').nextAll('.content-color').show();
		$('select[data-attrname="device"]').parents('.content-device').nextAll('.label-color').show();
		$('select[data-attrname="device"]').parents('.content-device').nextAll('.content-color').next('.clear').show();
		$('select[data-attrname="device"]').parents('.content-device').nextAll('.content-color').find('select').removeClass('skip-processing');
	
		//reset icons
		$('#evolution-sc-generator').find('.icon-option i').removeClass('selected');
		
	}	

	// Mockup Carousel -> Disable device color if "Desktop" device is selected
	// If you want to remove this function, consider to remove the 4 lines of code from resetFields() too!
	function mockupColor() {

		$('select[data-attrname="device"]').each(function() {

			if ( $(this).val() == 'desktop' ) {

				$(this).parents('.content-device').nextAll('.content-color').slideUp();
				$(this).parents('.content-device').nextAll('.label-color').slideUp();
				$(this).parents('.content-device').nextAll('.content-color').next('.clear').slideUp();
				$(this).parents('.content-device').nextAll('.content-color').find('select').addClass('skip-processing');

			} else {

				$(this).parents('.content-device').nextAll('.content-color').fadeIn('slow');
				$(this).parents('.content-device').nextAll('.label-color').fadeIn('slow');
				$(this).parents('.content-device').nextAll('.content-color').next('.clear').fadeIn('slow');
				$(this).parents('.content-device').nextAll('.content-color').find('select').removeClass('skip-processing');

			}

		});

	}

	$('select[data-attrname="device"]').change(function() {
		mockupColor();
	});

	$('select[data-attrname="device"]').trigger('change');

});
