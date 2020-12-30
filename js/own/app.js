/**
 * Created by markusdittrich on 11.02.17.
 */
function App() {
    this.init = function () {

        var app = this,
            $window = $(window);

        ////////////////////////////////////////////
        /////////////// LAYOUT /////////////////////
        ////////////////////////////////////////////

        if (typeof Us_columnsections === 'function') {
            var usColumnsections = new Us_columnsections();
            usColumnsections.layout();

            // check for end of window resize event
            $window.resize(function () {
                usColumnsections.layout();
            });

            // store it in the app-object
            app.usColumnsections = usColumnsections;
        }


        ////////////////////////////////////////////////////
        /////////////////// US-HEIGHT //////////////////////
        ////////////////////////////////////////////////////

        if (typeof UsHeight === 'function') {
            var usHeight = new UsHeight();

            usHeight.init_height();

            app.usHeight = usHeight;

            $window.resize(function () {
                usHeight.init_height();
            });
        }


        ////////////////////////////////////////////
        /////////////// SLIDER //////////////////////
        ////////////////////////////////////////////

		
		// OLD SLIDER JS:
		
        /*var $slideshowWrapper = $('.slideshow-wrapper');
        if ($slideshowWrapper.length) {

            // check if autoplay is active
            var autoplay = $slideshowWrapper.attr("slide-autoplay");
			var $animation = $slideshowWrapper.attr("animation-type");
			
            if (autoplay) {
                // create the unslider
                var $slider = $slideshowWrapper.unslider({
					animation: $animation,
                    autoplay: true,
                    delay: 5000,
                    arrows: {
                        prev: '<a class="unslider-arrow prev"><i us-icon="prev-slide"></i></a>',
                        next: '<a class="unslider-arrow next"><i us-icon="next-slide"></i></a>'
                    }
                });
            } else {
                // create the unslider
                var $slider = $slideshowWrapper.unslider({
					animation: $animation,
                    arrows: {
                        prev: '<a class="unslider-arrow prev"><i us-icon="prev-slide"></i></a>',
                        next: '<a class="unslider-arrow next"><i us-icon="next-slide"></i></a>'
                    }
                });
            }


            // store it in the app-object
            app.slider = {};
            app.slider.$el = $slider;
            app.slider.data = $slider.data('unslider');

            //TODO: Handle multiple instances of sliders (i.e. one at the top and bottom of the page)
        }*/
		
		
		
		// NEW SLIDER JS:
		//initialize swiper when document ready
		var $swiperEls = $('.swiper-container'),
			swipers = [];
		
		for (var i=0;i<$swiperEls.length;i++){
			var swiperEl = $swiperEls[i],
				direction = swiperEl.getAttribute('data-direction') || 'horizontal',
				animationType = swiperEl.getAttribute('data-animation') || slide,
				autoplay = (swiperEl.getAttribute('data-autoplay') == 'true') || false,
				loop = (swiperEl.getAttribute('data-loop') == 'true') || false,
				navigationNextEl = $('.swiper-button-next', swiperEl).get(0),
				navigationPrevEl = $('.swiper-button-prev', swiperEl).get(0),
				paginationEl = $('.swiper-pagination', swiperEl).get(0),
				// not set in backend:
				centered = (swiperEl.getAttribute('data-centered') == 'true') || false;
				
			var mySwiper = new Swiper (swiperEl, {
			// Optional parameters
			direction: direction,
			loop: loop,
			effect: animationType,
			navigation: {
				nextEl: navigationNextEl,
				prevEl: navigationPrevEl,
			},
			pagination: {
				el: paginationEl,
				type: 'bullets',
				clickable: true,
			},
			autoplay: autoplay,
				
			slidesPerView: 'auto',
			centeredSlides: centered,
		});
			
			swipers.push(mySwiper);
		}
		
	    app.swipers = swipers;	
		
		
		


        ////////////////////////////////////////////////////
        /////////////// BURGER-BUTTON //////////////////////
        ////////////////////////////////////////////////////

        $("#burger-button").click(function () {
            $("body").toggleClass("menu");
        });

        $("#mobile-menu-wrapper").click(function () {
            $("body").removeClass("menu");
        });


        /* NEW !!! */
        //////////////////////////////////////////////////////////////////////////////////////////
        /////////////// DETECT IF SCROLLED SOMEWHERE ON THE TOP OF THE PAGE //////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////

        function detectTopScroll() {

            var scrollPosition = $(window).scrollTop();

            var switchPosition = 500; // scroll position where to remove the .scrolltop class from the body element

            var switchPosition_2 = 5; // scroll position where to remove the .scrolltop class from the body element

            if (scrollPosition < switchPosition) {
                $("body").addClass("scrolltop");
            } else {
                $("body").removeClass("scrolltop");
            }
			
			if (scrollPosition < switchPosition_2) {
                $("body").addClass("scrolltotaltop");
            } else {
                $("body").removeClass("scrolltotaltop");
            }

        }

        detectTopScroll();

        $(window).scroll(function () {
            detectTopScroll();
        });


        ////////////////////////////////////////////
        /////////////// ICONS //////////////////////
        ////////////////////////////////////////////

        if (typeof UsIcons === 'function') {
            var usIcons = new UsIcons();

            usIcons.init_svgimages(function () {
                // execute this function when ajax-call inside init_svgimages was successful
                if (typeof usColumnsections != 'undefined') {
                    usColumnsections.layout();
                }
            });
            usIcons.init_createsvgicons(function () {
                // execute this function when ajax-call inside init_createsvgicons was successful
                if (typeof usColumnsections != 'undefined') {
                    usColumnsections.layout();
                }
            });

            // store it in the app-object
            app.usIcons = usIcons;
        }


        ////////////////////////////////////////////
        //////// SMOOTH-ANCHOR SCROLL //////////////
        ////////////////////////////////////////////


        if (typeof smoothScroll != 'undefined') {
            smoothScroll.init({
                selector: 'a[href^="#"]', // Selector for links (must be a class, ID, data attribute, or element tag)
                selectorHeader: null, // Selector for fixed headers (must be a valid CSS selector) [optional]
                speed: 500, // Integer. How fast to complete the scroll in milliseconds
                easing: 'easeInOutCubic', // Easing pattern to use
                offset: window.innerHeight / 4, // Integer or Function returning an integer. How far to offset the scrolling anchor location in pixels
                callback: function (anchor, toggle) {
                } // Function to run after scrolling
            });
        } else {
        }


        ////////////////////////////////////////////////////
        //////////////////// PARALLAX //////////////////////
        ////////////////////////////////////////////////////

        if (jQuery().parallax) {
            setTimeout(function () {
                console.log('commencing parallaxing');
                var $parallaxEls = $('.parallax-window');

                $parallaxEls.each(function () {
                    var $this = $(this),
                        path = $this.attr('data-image-src');

                    $this.parallax({
                        imageSrc: path
                    });
                });
            }, 0);

        }


    };

    ////////////////////////////////////////////////////
    ////////////////////// POPUPS //////////////////////
    ////////////////////////////////////////////////////

    // sample markup: <a class="popup" data-ajax-link="myCoolLink.html"></a>

    if (jQuery().magnificPopup) {
        console.log('looking for popups');
        $popups = $('.popup');

        $popups.each(function () {
            var $this = $(this),
                $link = $('> a', $this).attr('href') || $this.attr('data-ajax-link');

            console.log('$link', $link);

            if ($this.hasClass('gallery')) {
                var galleryImages = $this.data('links').split(',');
                var items = [];
                for (var i = 0; i < galleryImages.length; i++) {
                    items.push({
                        src: galleryImages[i],
                        title: ''
                    });
                }
                $this.magnificPopup({
                    mainClass: 'mfp-fade',
                    items: items,
                    gallery: {
                        enabled: true,
                        tPrev: $(this).data('prev-text'),
                        tNext: $(this).data('next-text')
                    },
                    type: 'image'
                });
            } else {
                $this.magnificPopup({
                    items: {
                        src: $link,
                        type: 'ajax'
                    },
                    removalDelay: 300,
                    mainClass: 'mfp-fade',
                    callbacks: {
                        parseAjax: function (mfpResponse) {
                            // mfpResponse.data is a "data" object from ajax "success" callback
                            // for simple HTML file, it will be just String
                            // You may modify it to change contents of the popup
                            // For example, to show just #some-element:
                            // mfpResponse.data = $(mfpResponse.data).find('#some-element');

                            // mfpResponse.data must be a String or a DOM (jQuery) element
                            //console.log('Hello???');
                            console.log('Ajax content loaded:', mfpResponse);
                            //mfpResponse.data = $(mfpResponse.data).find('body');
                            var responseDOM,
                                parser = new DOMParser(),
                                doc = parser.parseFromString(mfpResponse.data, "application/xhtml+xml");

                            console.log('doc', doc);
                        },
                        ajaxContentAdded: function () {
                            // Ajax content is loaded and appended to DOM
                            console.log('this.content', this.content);
                        }
                    }
                });
            }


            // Add it after jquery.magnific-popup.js and before first initialization code
            $.extend(true, $.magnificPopup.defaults, {
                tClose: 'Schließen (Esc)', // Alt text on close button
                tLoading: 'Wird geladen...', // Text that is displayed during loading. Can contain %curr% and %total% keys
                gallery: {
                    tPrev: 'Zurück (Linke Pfeiltaste)', // Alt text on left arrow
                    tNext: 'Vorwärts (Rechte Pfeiltaste)', // Alt text on right arrow
                    tCounter: '%curr% von %total%' // Markup for "1 of 7" counter
                },
                image: {
                    tError: '<a href="%url%">Das Bild</a> konnte nicht geladen werden.' // Error message when image could not be loaded
                },
                ajax: {
                    tError: '<a href="%url%">Der Inhalt</a> konnte nicht geladen werden.' // Error message when ajax request failed
                }
            });

        });
    }


    ////////////////////////////////////////////////////////
    /////////////// RUN INIT-FUNCTION //////////////////////
    ////////////////////////////////////////////////////////

    this.init();
}

$(document).ready(function () {
    var app = new App();

    window.usBootstrapApp = app;
    console.log('app-reference from parent', app);
});

// Wait for window load
$(window).load(function () {
    // Animate loader off screen
    $("#loader").fadeOut("slow");

});
