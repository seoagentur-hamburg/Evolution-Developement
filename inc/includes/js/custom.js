/* Custom metabox functions for Evolution Shortcodes */

jQuery( function ($) {

	// Intro metaboxes behaviour

	function introMb() {

		$('select[name*="[_evolution_slide_type]"]').each(function() {

			var trigger = $(this),
				slidePanel = trigger.closest('.cmb-repeatable-grouping'),
				bgImage = trigger.find('option[value="image_bg"]'),
				bgMockup = trigger.find('option[value="device_mockup"]'),
				bgMap = trigger.find('option[value="intro_map"]'),
				bgImageDisable = slidePanel.find('[class*="slide-mockup-layout"], [class*="map-latitude"], [class*="map-longitude"], [class*="map-zoom"], [class*="map-style"], [class*="map-marker"], [class*="map-tooltip"]'),
				bgMockupDisable = slidePanel.find('[class*="map-latitude"], [class*="map-longitude"], [class*="map-zoom"], [class*="map-style"], [class*="map-marker"], [class*="map-tooltip"]'),
				bgMapDisable = slidePanel.find('[class*="select-image"], [class*="slide-font-color"], [class*="slide-title"], [class*="slide-subtitle"], [class*="slide-button"], [class*="slide-mockup-layout"], [class*="credits-box"]');

		    if ( bgImage.is(':selected') ) {

		    	bgMockupDisable.removeClass('visuallyhidden');
		    	bgMapDisable.removeClass('visuallyhidden');	    	
		    	bgImageDisable.addClass('visuallyhidden');	   

		    } else if ( bgMockup.is(':selected') ) {

		    	bgImageDisable.removeClass('visuallyhidden');
		    	bgMapDisable.removeClass('visuallyhidden');	    	
		    	bgMockupDisable.addClass('visuallyhidden');	   

		    } else if ( bgMap.is(':selected') ) {

		    	bgImageDisable.removeClass('visuallyhidden');
		    	bgMockupDisable.removeClass('visuallyhidden');	    	
		    	bgMapDisable.addClass('visuallyhidden');	   

		    }

		});

	}

	introMb();
	$('#_evolution_single_slide_repeat').on('change', 'select[name*="[_evolution_slide_type]"]', introMb );
	$('.cmb-repeatable-group').on( 'click', '.cmb-shift-rows', introMb );



	// Slider panel expand/collapse

	function togglePanel() {

		var trigger = $(this),
			slidePanel = trigger.closest('.cmb-repeatable-grouping'),
			notToHide = '[class*="slide-select-image"], [class*="slide-type"], [class*="slide-more-options-trigger"], .cmb-group-title, .cmb-remove-field-row',
			togglingItems = slidePanel.find('.cmb-nested').find('.cmb-row').not(notToHide);

		if ( slidePanel.hasClass('expanded') ) {

		    slidePanel.removeClass('expanded').addClass('closed');
		    togglingItems.hide();
		    if ( trigger.is('.intro-more-options') ) {
		    	trigger.text(passed_data.closedString) // vars are stored in evolution/start.php - original string is into meta/meta-config.php
		    } else {
		    	slidePanel.find('.intro-more-options').text(passed_data.closedString)
		    }

		}  else if ( slidePanel.hasClass('closed') ) {

		    slidePanel.removeClass('closed').addClass('expanded');
		    togglingItems.fadeIn();
		    if ( trigger.is('.intro-more-options') ) {		    
		    	trigger.text(passed_data.expandedString) // vars are stored in evolution/start.php - original string is into meta/meta-config.php
		    } else {
		    	slidePanel.find('.intro-more-options').text(passed_data.expandedString)
		    }

		} else {

		    slidePanel.addClass('expanded');
		    togglingItems.fadeIn();
		    if ( trigger.is('.intro-more-options') ) {		    
		    	trigger.text(passed_data.expandedString) // vars are stored in evolution/start.php - original string is into meta/meta-config.php
		    } else {
		    	slidePanel.find('.intro-more-options').text(passed_data.expandedString)
		    }

		}

	}

	$('#_evolution_single_slide_repeat').on('click', '.cmb-repeatable-grouping .cmb-th', togglePanel );
	$('#_evolution_single_slide_repeat').on('click', '.intro-more-options', togglePanel );


	// PX to EM live converter

	var trigger = $('#_evolution_intro_height');

	function emToPx() {

		if ( trigger.val() != '' ) {

	  		var em = trigger.val() * 18;
	  		
	  		trigger.next('.cmb2-metabox-description').find('.approxpx').text(Math.round(em)+"px");

	  	} else {

	  		trigger.next('.cmb2-metabox-description').find('.approxpx').text("600px");

	  	}

	}

	emToPx();
	trigger.keyup(function() { 
		emToPx();
	});


	// Show/hide Intro Settings extra fields on Pages
	function introSettings() {

		var selectContainer = $('[id*="evolution_select_intro_parse"]'),
			subEls = $('#cmb2-metabox-select_intro .cmb-row:not(.cmb2-id--evolution-select-intro-parse)');

		selectContainer.on('change', function() {

			// console.log($(this).val());

			if( $(this).val() == '' ) {
				subEls.hide();
				$('#cmb2-metabox-select_intro .cmb2-id--evolution-select-intro-parse').addClass('no-border');
			} else {
				subEls.fadeIn('slow');
				$('#cmb2-metabox-select_intro .cmb2-id--evolution-select-intro-parse').removeClass('no-border');
			}

		});

		selectContainer.trigger('change');

	}

	if( $('[id*="evolution_select_intro_parse"]').length > 0 ) {
		introSettings();
	}

});