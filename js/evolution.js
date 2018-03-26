/*
 *   Evolution Fuctions JS
 *   @based on Code by Pasquale Vitiello (pasqualevitiello@gmail.com),
 *   https://evolution-themes.com
 */

jQuery(document).ready(function ($) {

    'use strict';

    /* Define some vars */

    var win = $(window),
        body = $('body'),
        retina = window.devicePixelRatio > 1,
        header = $('#masthead'),
        headerNav = $('nav'),
        content = $('main'),
        pxWrapper = $('#intro-wrap'),
        pxContainer = $('#intro'),
        pxImg = $('.intro-item'),
        pxImgImage = $('.intro-item-image'),
        pxImgCaption = pxContainer.find('.caption'),
        testimonial = $('.testimonial-slider'),
        cCarousel = $('.custom-carousel'),
        loaderIntro = '<div class="landing landing-slider"><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>',
        loader = '<div class="landing landing-els"><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>',
        loaderLightbox = '<div class="landing landing-els lightbox"><div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>',
        darkover = '<div class="darkover"></div>',
        moreBtnIcon = '<div class="more"><a class="smooth-scroll" href="#main"><i class="linecon-icon-scroll"></i></a></div>',
        grid = $('.grid-items'),
        moreTrigger = $('.load-more');


    /* Determine viewport width matching with media queries */

    function viewport() {

        var e = window,
            a = 'inner';

        if (!('innerWidth' in window)) {

            a = 'client';
            e = document.documentElement || document.body;

        }

        return {
            width: e[a + 'Width'],
            height: e[a + 'Height']
        };

    }


    /* Retina class + Retina Logo Fallback */

    function logoRetina() {

        $('#default-logo').show();

    }

    if ( retina ) {

        body.addClass( 'retina' );

        if ( ! $('#retina-logo' ).length ) {

            logoRetina();

        }

    }


    /* Toggle "mobile" class */

    function mobileClass() {

        var vpWidth = viewport().width; // This should match media queries

        if ((vpWidth <= 768) && (!body.hasClass('mobile'))) {

            body.addClass('mobile');

        } else if ((vpWidth > 768) && (body.hasClass('mobile'))) {

            body.removeClass('mobile');

        }

    }

    mobileClass();
    $(window).resize(mobileClass);


    /* Intro Height */

    function introHeight() {

        var $this = pxWrapper,
            dataHeight = $this.data('height');

        if ($this.hasClass('full-height')) {

            var recalcHeaderH = header.outerHeight(true);

            if (!body.hasClass('mobile')) {

                $this.css({
                    'height': (win.height())
                });

            } else {

                $this.css({
                    'height': (win.height() - recalcHeaderH)
                });

            }

        } else {

            $this.css({
                'height': dataHeight + 'em'
            });

        }

    }


    /* Initialize Intro */

    function initIntro() {

        var $this = pxContainer;

        $this.append(loaderIntro);

        $this.addClass(function () {
            return $this.find('.intro-item').length > 1 ? "big-slider" : "";
        });

        $this.waitForImages({

            finished: function () {

                // console.log('All images have loaded.');
                $('.landing-slider').remove();

                if ($this.hasClass('big-slider')) {

                    var autoplay = $this.data('autoplay'),
                        navigation = $this.data('navigation'),
                        pagination = $this.data('pagination'),
                        transition = $this.data('transition');

                    $this.owlCarousel({
                        singleItem: true,
                        autoPlay: autoplay || false, // || = if data- is empty or if it does not exists
                        transitionStyle: transition || false,
                        stopOnHover: true,
                        responsiveBaseWidth: ".slider",
                        responsiveRefreshRate: 0,
                        addClassActive: true,
                        navigation: navigation || false,
                        navigationText: [
                            "<i class='icon-arrow-left'></i>",
                            "<i class='icon-arrow-right'></i>"
                        ],
                        pagination: pagination || false,
                        rewindSpeed: 1000,
                    });

                }

                $this.removeClass('preload');

                if ($this.hasClass('darken')) {
                    pxImgImage.append(darkover);
                }

                if (pxWrapper.length && $this.hasClass('more-button') && $this.attr('data-pagination') !== 'true') {
                    $this.append(moreBtnIcon);
                    smoothScroll();
                }

            },
            waitForAll: true
        });

    }

    if (pxContainer.length) {

        initIntro();
        introHeight();
        $(window).resize(introHeight);

    }


    /* Smooth scroll */

    function smoothScroll() {

        $('a.smooth-scroll[href*="#"]:not([href="#"])').click(function () {

            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);

                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

                if (target.length) {

                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 500);

                    return false;

                }

            }

        });

    }

    smoothScroll();


    /* Parallax data attributes according to #intro's height */

    function parallax() {

        var headerHeight = header.outerHeight(true);

        if (pxWrapper.length) {

            var touchDevice = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

            if (touchDevice) {

                if (!body.hasClass('no-parallax')) {

                    body.addClass('no-parallax');

                }

            } 

            if (!body.hasClass('mobile') && !body.hasClass('no-parallax')) {

                pxContainer.attr('data-anchor-target', '#intro-wrap');
                pxContainer.attr('data-top', 'transform:translateY(0px);');
                header.attr('data-anchor-target', '#intro-wrap');
                header.attr('data-top', 'transform:translateY(0px);');
                if (touchDevice) {
                    pxContainer.attr('data-top-bottom', 'transform:translateY(0px);');
                    header.attr('data-top-bottom', 'transform:translateY(0px);');
                    header.addClass('transition');
                    // console.log('Disable Parallax');

                } else {
                    pxContainer.attr('data-top-bottom', 'transform:translateY(' + '-' + pxWrapper.height() / 4 + 'px);');
                    header.attr('data-top-bottom', 'transform:translateY(' + '-' + pxWrapper.height() / 4 + 'px);');
                }
                var animDone = false;

                skrollr.init({
                    forceHeight: false,
                    smoothScrolling: false,
                    mobileCheck: function () {
                        //hack - forces mobile version to be off
                        return false;
                    },
                    /* easing: 'swing', */
                    render: function () {

                        if (header.hasClass('skrollable-after')) {

                            if (!animDone) {

                                animDone = true;
                                header.addClass('fixed-header').css({
                                    'display': 'none'
                                }).fadeIn(300);

                            }

                        } else {

                            animDone = false;
                            header.removeClass('fixed-header');

                        }

                    }

                }).refresh();

                pxImgCaption.each(function () {

                    var $this = $(this);

                    $this.css({
                        top: ((pxWrapper.height() + headerHeight / 2) - $this.outerHeight()) / 2
                    });

                });

            } else {

                if (!touchDevice) {

                    skrollr.init().destroy();
                    content.css({
                        marginTop: 0 + 'px'
                    });

                    var parallaxEls = $('#masthead, #intro'),
                        attrs = parallaxEls[0].attributes,
                        name,
                        index;

                    for (index = attrs.length - 1; index >= 0; --index) {
                        name = attrs[index].nodeName;

                        if (name.substring(0, 5) === "data-") {
                            parallaxEls.removeAttr(name);
                        }

                    }

                    parallaxEls.css({
                        '-webkit-transform': '',
                        '-moz-transform': '',
                        'transform': '',
                        'backgroundPosition': ''
                    }).removeClass('skrollable-after');

                }

                pxImgCaption.each(function () {

                    var $this = $(this);

                    if (!body.hasClass('mobile') && body.hasClass('no-parallax')) {

                        $this.css({
                            top: ((pxWrapper.height() + headerHeight) - $this.outerHeight()) / 2
                        });

                    } else {

                        $this.css({
                            top: (pxWrapper.height() - $this.outerHeight()) / 2
                        });

                    }

                });

            }

        }

    }

    parallax();
    $(window).resize(parallax);

    /* Show Header */
    header.show();

    /* Menu */

    var menuToggle = $('#menu-toggle'),
        headerNavUl = headerNav.children('ul');

    menuToggle.click(function () {

        headerNavUl.slideToggle(200);
        $(this).children('i').toggleClass('active');

        return false;

    });

    $(window).resize(function () {

        if (!body.hasClass('mobile')) {

            headerNavUl.removeAttr('style');
            menuToggle.children('i').removeClass('active');

        }

    });


    /* Make page's odd sections darker */

    var page = $('.page'),
        pageSections = page.find('.section'),
        oddSections = pageSections.filter(':odd');

    if (body.hasClass('page') && pageSections.length > 1) {

        oddSections.addClass('greyish');

    }


    /* Overlay content absolute centering */

    function centerOverlay() {

        var PortfolioOverlay = $('.overlay-content'),
            BlogOverlay = $('.blog-overlay');

        if (PortfolioOverlay.length) {

            PortfolioOverlay.each(function () {

                var $this = $(this),
                    itemPortfolioHeight = $this.closest('.item').height(),
                    PortfolioOverlayHeight = $this.height(),
                    PortfolioIcon = $this.children('.post-type'),
                    PortfolioIconHeight = PortfolioIcon.children('i').height();

                if ((PortfolioOverlayHeight + 30) > itemPortfolioHeight) {

                    $this.children('p').css({
                        'visibility': 'hidden'
                    });
                    $this.children('h2').css({
                        'visibility': 'hidden'
                    });

                    $this.css({
                        marginTop: (itemPortfolioHeight - PortfolioIconHeight) / 2
                    });

                } else {

                    $this.children('p').css({
                        'visibility': 'visible'
                    });
                    $this.children('h2').css({
                        'visibility': 'visible'
                    });
                    $this.css({
                        marginTop: (itemPortfolioHeight - PortfolioOverlayHeight) / 2
                    });

                }

            });

        }

        if (BlogOverlay.length) {

            BlogOverlay.each(function () {

                var $this = $(this),
                    itemBlogHeight = $this.siblings('img').height(),
                    BlogOverlayIcon = $this.children('i'),
                    BlogOverlayIconHeight = BlogOverlayIcon.height();

                BlogOverlayIcon.css({
                    top: (itemBlogHeight - BlogOverlayIconHeight) / 2
                });

            });

        }

    }

    centerOverlay();
    $(window).on('load', centerOverlay);
    $(window).on('resize', centerOverlay);


    /* fix Blog Excerpt Heights */

    var blogExcerpt = $('.item.column.three .blog-excerpt');

    function fixBlogH() {

        var gridW = parseInt($('.grid-items').width()),
            sizerBigW = (gridW / 100) * 48,
            sizerBigH = sizerBigW * 0.75,
            sizerSmallW = (gridW / 100) * 22.05,
            sizerSmallH = sizerSmallW * 0.75,
            difference = sizerBigH - sizerSmallH + 0.5;

        // console.log(difference);

        if (!body.hasClass('mobile')) {

            $('.item.column.three .blog-excerpt.w-thumb').css({
                'height': difference
            });

            $('.item.column.three .blog-excerpt.no-thumb').css({
                'height': sizerBigH
            });            

        } else {

            $('.item.column.three .blog-excerpt.w-thumb').css({
                'height': 'auto'
            });

            $('.item.column.three .blog-excerpt.no-thumb').css({
                'height': 'auto'
            });            

        }

    }

    if (blogExcerpt.length) {

        fixBlogH();
        $(window).on('resize', fixBlogH);

    }


    /* Masonry */

    function masonry() {

        grid.each(function () {

            var $this = $(this),
                filterOptions = $this.prev('.filter-options'),
                sizer = $this.find('.shuffle-sizer');

            $this.append(loader);

            $this.waitForImages({

                finished: function () {

                    $this.children('.landing-els').remove();

                    $this.shuffle({
                        itemSelector: '.item',
                        sizer: sizer,
                        speed: 500,
                        easing: 'ease-out'
                    });

                    if (filterOptions.length) {

                        var btns = filterOptions.children();
                        btns.on('click', function () {
                            var $this = $(this),
                                parentGrid = filterOptions.next(grid),
                                isActive = $this.hasClass('active'),
                                group = isActive ? 'all' : $this.data('group');

                            // Hide current label, show current label in title
                            if (!isActive) {
                                $('.filter-options .active').removeClass('active');
                            }

                            $this.toggleClass('active');

                            // Filter elements
                            parentGrid.shuffle('shuffle', group);
                        });

                        btns = null;

                        handleFilters(); // check if there are filters to hide or new filters to show

                    }

                    $this.removeClass('preload');
                    centerOverlay();

                },
                waitForAll: true
            });

        });

    }

    if (grid.length) {

        masonry();

    }


    /* Load more content */

    function loadMore() {

        moreTrigger.on( 'click', function(e) {

            e.preventDefault();

            if ( moreTrigger.hasClass('idle') )
                return;
            
            moreTrigger.addClass('idle');

            $.ajax({
                url: moreTrigger.children('a').attr('href'),
                dataType: 'html'
            })
            .done( function(result) {
                
                var data = $(result),
                    items = data.find('.grid-items > .item'),
                    href = data.find('.load-more a').attr('href');
                
                // add new items
                items
                    .css( 'opacity', '0' ) // FIX: temporary hide items before showing up them grid.shuffle('appended', items); to run finBlogH() in the meantime
                    .appendTo(grid);

                // if it is a blog page, fix post heights
                if (blogExcerpt.length) {

                    fixBlogH();

                }

                grid.waitForImages({ // just to be sure ...

                    finished: function () {

                        // 4) Tell shuffle items have been appended
                        grid.shuffle('appended', items);

                        centerOverlay(); // center the icons again

                        handleFilters(); // check if there are filters to hide or new filters to show

                    },

                    waitForAll: true
                });
                                                        
                href ? moreTrigger.children('a').attr('href', href) : moreTrigger.remove();
                                        
            })
            .always( function() {
            
                moreTrigger.removeClass('idle');
                
            });

        });

    }

    if ( moreTrigger.length ) {

        loadMore();

    } 


    /* Portfolio filters visibility */

    function handleFilters() {

        var filterOptions = $('.filter-options li');

        filterOptions.hide();

        var tagArray = $('.grid-items').find('article').map(function() {
            return $(this).data('groups');
        }).get();

        // Remove duplicates
        var uniqueTags = [];

        $.each(tagArray, function(i, el) {

            if($.inArray(el, uniqueTags) === -1) uniqueTags.push(el);

        });

        filterOptions.each(function() {

            $this = $(this);

            if ($.inArray($this.data('group'), uniqueTags) !== -1) {

                $this.show();

            }

        });

    }



    /* Trim pagination post titles */

    function trimPagTitles() {

        var trimLenght = parseInt(27);

        $('.post-nav').find(".label").each(function() {

            if ($(this).text().length > trimLenght ) {

                $(this).text($(this).text().substring( 0, trimLenght ) + '...');

            }

        });

    }

    if( $('.post-nav').length ) {

        trimPagTitles();
        $(window).resize(trimPagTitles);

    }


    /* Dribbble API */

    if($('.dribbble-items').length) {

        if (passed_data.dribbbleToken) {

            $('.dribbble-items').each(function() {

                var $this = $(this);

                if( $this.is('.dribbble-three-cols') ) {

                    var columnClass = ' four';

                } else {

                    var columnClass = ' three';                

                }

                var username = $this.data('username'),
                    elemNr = $this.data('elements');

                $.jribbble.setToken(passed_data.dribbbleToken);

                $.jribbble.users(username).shots({per_page: elemNr}).then(function(shots) {
                    var html = [];

                    shots.forEach(function(shot) {
                        html.push('<div class="item column' + columnClass + '"><figure>');
                        html.push('<img src="' + shot.images.normal + '" ');
                        html.push('alt="' + shot.title + '"></figure>');
                        html.push('<a class="overlay" href="' + shot.html_url + '">');
                        html.push('<div class="overlay-content">');
                        html.push('<div class="post-type"><i class="icon-dribbble"></i></div>');
                        html.push('<p class="reset">' + shot.views_count + ' views</p>');
                        html.push('<p class="reset">' + shot.likes_count + ' likes</p>');
                        html.push('</div></a></div>');
                    });

                    $this.html(html.join('')).append(loader);

                    if( $this.is('.dribbble-three-cols') ) {
                        $this.find('.item:nth-of-type(3n)').addClass('last');
                    } else {
                        $this.find('.item:nth-of-type(4n)').addClass('last');
                    }

                    $this.waitForImages({

                        finished: function () {

                            $this.removeClass('preload');
                            $this.children('.landing-els').remove(); 
                            centerOverlay(); 

                        },
                        waitForAll: true
                    });

                });   

            });

        } else {

            $('.dribbble-items').append('Set your Dribbble app&lsquo;s client access token in <strong>Beetle Options -> General settings</strong> to display the shots. If you do not have a token, <a href="https://dribbble.com/account/applications/new" target="_blank">create a new Dribbble app</a>. Read the documentation for further details.');

        }

    }


    /* Chart numbers absolute centering */

    var chart = $('.chart'),
        chartNr = $('.chart-content'),
        chartParent = chart.parent();

    function centerChartsNr() {

        chartNr.css({
            top: (chart.height() - chartNr.outerHeight()) / 2
        });

    }

    if (chart.length) {

        centerChartsNr();
        $(window).resize(centerChartsNr);

        chartParent.each(function () {

            $(this).onScreen({
                doIn: function () {
                    $(this).find('.chart').easyPieChart({
                        scaleColor: false,
                        lineWidth: 12,
                        size: 178,
                        trackColor: false,
                        lineCap: 'square',
                        animate: 2000,
                        onStep: function (from, to, percent) {
                            $(this.el).find('.percent').text(Math.round(percent));
                        }
                    });
                },
            });

            $(this).find('.chart').wrapAll('<div class="centertxt" />');

        });

    }


    /* Testimonial Carousel */

    function initTestimonial() {

        testimonial.each(function () {

            var $this = $(this),
                autoplay = $this.data('autoplay'),
                pagination = $this.data('pagination'),
                transition = $this.data('transition');

            $this.owlCarousel({
                singleItem: true,
                autoPlay: autoplay || false,
                transitionStyle: transition || false,
                autoHeight: false,
                stopOnHover: true,
                responsiveBaseWidth: ".slider",
                responsiveRefreshRate: 0,
                addClassActive: true,
                pagination: pagination || false,
                rewindSpeed: 1000
            });

        });

    }

    if (testimonial.length) {

        initTestimonial();

    }


    /* Custom Carousel */

    function initCCarousel() {

        cCarousel.each(function () {

            var $this = $(this),
                autoplay = $this.data('autoplay'),
                pagination = $this.data('pagination'),
                transition = $this.data('transition');

            $this.owlCarousel({
                singleItem: true,
                autoPlay: autoplay || false,
                transitionStyle: transition || false,
                autoHeight: false,
                stopOnHover: true,
                responsiveBaseWidth: ".slider",
                responsiveRefreshRate: 0,
                addClassActive: true,
                pagination: pagination || false,
                rewindSpeed: 1000
            });

        });

    }

    if (cCarousel.length) {

        initCCarousel();

    }


    /* onScreen Animations */

    var onScreenAnims = $('.onscreen-animation');

    if (onScreenAnims.length) {

        onScreenAnims.each(function() {

            $(this).onScreen({
                toggleClass: false,
                doIn: function () {
                    $(this).addClass('onscreen')
                }
            });

        });

    }


    /* Return the right mockup according to the class & initialize sliders */

    var findDevice = $('.mockup-wrapper');

    function useMockup() {

        findDevice.each(function () {

            var $this = $(this),
                slideHeight = $this.find('.owl-item').outerHeight(true),
                iphoneBlack = '<div class="mockup iphone-mockup black"></div>',
                iphoneWhite = '<div class="mockup iphone-mockup white"></div>',
                ipadBlack = '<div class="mockup ipad-mockup black"></div>',
                ipadWhite = '<div class="mockup ipad-mockup white"></div>',
                desktop = '<div class="mockup desktop-mockup"></div>',
                deviceWrapper = $this.parent('.row-content'),
                mockupslider = $this.find('figure'),
                autoplay = $this.data('autoplay'),
                rewindSpeed = $this.data('rewind');               

            if (!$this.hasClass('side-mockup')) {

                mockupslider.owlCarousel({
                    singleItem: true,
                    autoPlay: autoplay || false,
                    stopOnHover: true,
                    responsiveBaseWidth: ".slider",
                    responsiveRefreshRate: 0,
                    addClassActive: true,
                    navigation: true,
                    navigationText: [
                        "<i class='icon-chevron-left'></i>",
                        "<i class='icon-chevron-right'></i>"
                    ],
                    pagination: false,
                    rewindSpeed: false
                });

            } else {

                mockupslider.owlCarousel({
                    singleItem: true,
                    autoPlay: autoplay || false,
                    stopOnHover: true,
                    transitionStyle: "fade",
                    responsiveBaseWidth: ".slider",
                    responsiveRefreshRate: 0,
                    addClassActive: true,
                    navigation: false,
                    pagination: true,
                    rewindSpeed: rewindSpeed || false,
                    mouseDrag: false,
                    touchDrag: false
                });

            }

            if ($this.hasClass('iphone-slider black')) {

                $this.find('.owl-wrapper-outer').after(iphoneBlack);

            } else if ($this.hasClass('iphone-slider white')) {

                $this.find('.owl-wrapper-outer').after(iphoneWhite);

            } else if ($this.hasClass('ipad-slider black')) {

                $this.find('.owl-wrapper-outer').after(ipadBlack);

            } else if ($this.hasClass('ipad-slider white')) {

                $this.find('.owl-wrapper-outer').after(ipadWhite);

            } else if ($this.hasClass('desktop-slider')) {

                $this.find('.owl-wrapper-outer').after(desktop);

            }

            $this.waitForImages({

                finished: function () {

                    $this.find('.slider').fadeIn('slow');

                },
                waitForAll: true
            });

            // deviceWrapper.css({
            //     'padding-left': '0',
            //     'padding-right': '0'
            // })

        });

    }

    function fixArrowPos() {

        findDevice.each(function () {

            var slideHeight = $(this).find('.owl-item').outerHeight(true);

            $(this).find('.owl-prev, .owl-next').css('top', slideHeight / 2);

        });

    }

    function mockupInit() {

        if ((findDevice.length) && (!findDevice.hasClass('gallery'))) {

            useMockup();
            fixArrowPos();

            fixArrowPos();
            $(window).resize(fixArrowPos);

        }

    }

    mockupInit();


    /* Side mockups fixes */

    var sideMockup = $('.side-mockup');

    function sideMockups() {

        sideMockup.each(function () {

            var $this = $(this),
                sideMockupSlider = $this.find('.slider'),
                sideMockupHeight = parseInt(sideMockupSlider.height()),
                sideMockupParentPad = parseInt($this.css('padding-top')),
                sideMockupFix = sideMockupHeight + (sideMockupParentPad * 2) + 'px';

            if (!body.hasClass('mobile')) {

                if ($this.hasClass('right-mockup')) {

                    sideMockupSlider.css({
                        'position': 'absolute',
                        'left': '52%'
                    });

                } else if ($this.hasClass('left-mockup')) {

                    sideMockupSlider.css({
                        'position': 'absolute',
                        'right': '52%'
                    });

                }

                $this.css({
                    'position': 'relative',
                    'min-height': sideMockupFix
                });

            } else {

                sideMockupSlider.css({
                    'position': 'relative',
                    'left': 'auto',
                    'right': 'auto'
                });

                $this.css({
                    'position': 'relative',
                    'min-height': '0'
                });

            }

        });

    }


    if (sideMockup.length) {

        sideMockups();
        $(window).resize(sideMockups);

    }


    /* Initialize Gallery Sliders */

    var galleryslidercontainer = $('.gallery.slider');

    function gallerySlider() {

        galleryslidercontainer.each(function () {

            var $this = $(this),
                galleryslider = $this.children('figure'),
                autoplay = $this.data('autoplay'),
                autoheight = $this.data('autoheight');

            galleryslider.owlCarousel({
                singleItem: true,
                autoHeight: autoheight || false,
                autoPlay: autoplay || false,
                transitionStyle: "fade",
                stopOnHover: true,
                responsiveBaseWidth: ".slider",
                responsiveRefreshRate: 0,
                addClassActive: true,
                navigation: true,
                navigationText: [
                    "<i class='icon-arrow-up'></i>",
                    "<i class='icon-arrow-down'></i>"
                ],
                pagination: false,
                rewindSpeed: 1000,
            });

            $this.fadeIn('slow');

        });

    }

    if (galleryslidercontainer.length) {

        gallerySlider();

    }


    /* Create unique data-lightbox attributes http://stackoverflow.com/questions/11044876/how-to-auto-generate-id-for-child-div-in-jquery */

    var lightboxContainer = $('.lightbox');

    if (lightboxContainer.length) {

        var $this = lightboxContainer;

        for (var i = 0; i < $this.length; i++) {

            $($this[i]).find('.item a').attr("data-lightbox", "gallery-" + i);

        }

        lightboxContainer.each(function () {

            var $this = $(this);

            var activityIndicatorOn = function () {
                $(loaderLightbox).appendTo('body');
            },
                activityIndicatorOff = function () {
                    $('.landing-els').remove();
                },
                overlayOn = function () {
                    $('<div id="imagelightbox-overlay"></div>').appendTo('body');
                },
                overlayOff = function () {
                    $('#imagelightbox-overlay').remove();
                },
                closeButtonOn = function (instance) {
                    $('<a href="#" id="imagelightbox-close"><i class="icon-close"></i></a>').appendTo('body').on('click', function () {
                        $(this).remove();
                        instance.quitImageLightbox();
                        return false;
                    });
                },
                closeButtonOff = function () {
                    $('#imagelightbox-close').remove();
                },
                captionOn = function () {
                    var description = $('a[href="' + $('#imagelightbox').attr('src') + '"]').find('h2').html();
                    if (description.length > 0)
                        $('<div id="imagelightbox-caption"><h3>' + description + '</h3></div>').appendTo('body');
                },
                captionOff = function () {
                    $('#imagelightbox-caption').remove();
                };


            var instance = $this.find('.item a[data-lightbox^="gallery-"]').imageLightbox({
                onStart: function () {
                    overlayOn();
                    closeButtonOn(instance);
                },
                onEnd: function () {
                    overlayOff();
                    captionOff();
                    closeButtonOff();
                    activityIndicatorOff();
                },
                onLoadStart: function () {
                    captionOff();
                    activityIndicatorOn();
                },
                onLoadEnd: function () {
                    captionOn();
                    activityIndicatorOff();
                }
            });

        });

    }

    /* Icons on Contact Form 7 input fields */

    if( $('.wpcf7').length ) {

        var iconName = '<span class="pre-input"><i class="linecon-icon-user"></i></span>',
            iconEmail = '<span class="pre-input"><i class="linecon-icon-email"></i></span>',
            iconSubject = '<span class="pre-input"><i class="linecon-icon-horizontal-tag"></i></span>';

        $('.wpcf7').each(function() {

            var $this = $(this);

            $this.find('.your-name').prepend(iconName);
            $this.find('.your-email').prepend(iconEmail);
            $this.find('.your-subject').prepend(iconSubject);

        });      

    }
    

    /* Add some "last" classes */

    headerNav.find('.menu-item').last('li').addClass('last');
    $('.blog.list-style').find('article').last('article').addClass('last');
    $('.search.list-style').find('article').last('article').addClass('last');
    $('.related').find('.item').last('.item').addClass('last');


    /* Clear columns */

    var lastColumn = $('.column.last');

    if (lastColumn.length) {

        lastColumn.after('<div class="clear"></div>');

    }

});