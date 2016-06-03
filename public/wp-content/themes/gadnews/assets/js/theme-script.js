(function ($) {
    "use strict";

    CherryJsCore.utilites.namespace('theme_script');
    CherryJsCore.theme_script = {
        init: function () {
            var self = this;

            // Document ready event check
            if (CherryJsCore.status.is_ready) {
                self.document_ready_render(self);
            } else {
                CherryJsCore.variable.$document.on('ready', self.document_ready_render(self));
            }

            // Windows load event check
            if (CherryJsCore.status.on_load) {
                self.window_load_render(self);
            } else {
                CherryJsCore.variable.$window.on('load', self.window_load_render(self));
            }
        },

        document_ready_render: function (self) {
            var self = self;

            self.smart_slider_init(self);
            self.playlist_slider_widget_init(self);
            self.swiper_carousel_init(self);
            self.featured_posts_block_init(self);
            self.news_smart_box_init(self);
            self.post_formats_custom_init(self);
            self.navbar_init(self);
            self.subscribe_init(self);
            self.main_menu(self, $('.main-navigation'));
            self.to_top_init(self);
        },

        window_load_render: function (self) {
            var self = self;
            self.page_preloader_init(self);
        },

        smart_slider_init: function( self ) {
            $( '.gadnews-smartslider' ).each( function() {
                var slider = $(this),
                    sliderId = slider.data('id'),
                    sliderWidth = slider.data('width'),
                    sliderHeight = slider.data('height'),
                    sliderOrientation = slider.data('orientation'),
                    slideDistance = slider.data('slide-distance'),
                    slideDuration = slider.data('slide-duration'),
                    sliderFade = slider.data('slide-fade'),
                    sliderNavigation = slider.data('navigation'),
                    sliderFadeNavigation = slider.data('fade-navigation'),
                    sliderPagination = slider.data('pagination'),
                    sliderAutoplay = slider.data('autoplay'),
                    sliderFullScreen = slider.data('fullscreen'),
                    sliderShuffle = slider.data('shuffle'),
                    sliderLoop = slider.data('loop'),
                    sliderThumbnailsArrows = slider.data('thumbnails-arrows'),
                    sliderThumbnailsPosition = slider.data('thumbnails-position'),
                    sliderThumbnailsWidth = slider.data('thumbnails-width'),
                    sliderThumbnailsHeight = slider.data('thumbnails-height');

                if ( $('.gadnews-smartslider__slides', '#' + sliderId ).length > 0 ) {
                    $( '#' + sliderId ).sliderPro( {
                        width: sliderWidth,
                        height: sliderHeight,
                        orientation: sliderOrientation,
                        slideDistance: slideDistance,
                        slideAnimationDuration: slideDuration,
                        fade: sliderFade,
                        arrows: sliderNavigation,
                        fadeArrows: sliderFadeNavigation,
                        buttons: sliderPagination,
                        autoplay: sliderAutoplay,
                        fullScreen: sliderFullScreen,
                        shuffle: sliderShuffle,
                        loop: sliderLoop,
                        waitForLayers: false,
                        thumbnailArrows: sliderThumbnailsArrows,
                        thumbnailsPosition: sliderThumbnailsPosition,
                        thumbnailWidth: sliderThumbnailsWidth,
                        thumbnailHeight: sliderThumbnailsHeight,
                        init: function() {
                            $( this ).resize();
                        },
                        sliderResize: function( event ) {
                            var thisSlider = $( '#' + sliderId ),
                                slides = $( '.sp-slide', thisSlider );

                            slides.each( function(){

                                if ( $( '.sp-title a', this ).width() > $( this ).width() ){
                                    $( this ).addClass('text-wrapped');
                                }else{
                                    $( this ).removeClass('text-wrapped');
                                }

                            } );
                        },
                        breakpoints: {
                            991: {
                                height: parseFloat( sliderHeight ) * 0.75
                            },
                            767: {
                                height: parseFloat( sliderHeight ) * 0.6
                            }
                        }
                    } );
                }
            });//each end
        },

        playlist_slider_widget_init: function ( self ) {
            $( '.widget-playlist-slider .playlist-slider' ).each( function() {
                var $this = $( this ),
                    settings = $this.data('settings'),
                    breakpoints = JSON.parse( settings.breakpoints );

                $this.sliderPro( {
                    autoplay: false,
                    waitForLayers: false,
                    touchSwipe:false,
                    updateHash:false,
                    width: settings['width'],
                    height: settings['height'],
                    arrows: settings['arrows'],
                    buttons: settings['buttons'],
                    thumbnailArrows: settings['thumbnailArrows'],
                    thumbnailsPosition: settings['thumbnailsPosition'],
                    thumbnailWidth: settings['thumbnailWidth'],
                    thumbnailHeight: settings['thumbnailHeight'],
                    breakpoints: breakpoints,
                    init: function() {
                        $this.resize().fadeTo(0, 1);
                    },
                    gotoSlideComplete: function( event ) {
                        var prevSlide =  $( '.sp-slide',  $this ).eq( event.previousIndex ),
                            iframe = prevSlide.find( 'iframe' ),
                            html5Video = prevSlide.find( 'video' );

                        if ( iframe[0] ) {
                            var iframeSrc = iframe.attr( 'src' );

                            iframe.attr( 'src', iframeSrc );
                        } else if( html5Video[0] ) {
                            html5Video[0].stop();
                        }
                    }
                });
            });


        },

        swiper_carousel_init: function (self) {

            // Enable swiper carousels
            jQuery('.gadnews-carousel').each(function () {
                var swiper = null,
                    uniqId = jQuery(this).data('uniq-id'),
                    slidesPerView = parseFloat(jQuery(this).data('slides-per-view')),
                    slidesPerGroup = parseFloat(jQuery(this).data('slides-per-group')),
                    slidesPerColumn = parseFloat(jQuery(this).data('slides-per-column')),
                    spaceBetweenSlides = parseFloat(jQuery(this).data('space-between-slides')),
                    durationSpeed = parseFloat(jQuery(this).data('duration-speed')),
                    swiperLoop = jQuery(this).data('swiper-loop'),
                    freeMode = jQuery(this).data('free-mode'),
                    grabCursor = jQuery(this).data('grab-cursor'),
                    mouseWheel = jQuery(this).data('mouse-wheel');

                var swiper = new Swiper('#' + uniqId, {
                        slidesPerView: slidesPerView,
                        slidesPerGroup: slidesPerGroup,
                        slidesPerColumn: slidesPerColumn,
                        spaceBetween: spaceBetweenSlides,
                        speed: durationSpeed,
                        loop: swiperLoop,
                        freeMode: freeMode,
                        grabCursor: grabCursor,
                        mousewheelControl: mouseWheel,
                        paginationClickable: true,
                        nextButton: '#' + uniqId + '-next',
                        prevButton: '#' + uniqId + '-prev',
                        pagination: '#' + uniqId + '-pagination',
                        onInit: function () {
                            $('#' + uniqId + '-next').css({'display': 'block'});
                            $('#' + uniqId + '-prev').css({'display': 'block'});
                        },
                        breakpoints: {
                            1500: {
                                slidesPerView: Math.floor(slidesPerView * 0.75),
                                spaceBetween: Math.floor(spaceBetweenSlides * 0.75)
                            },
                            991: {
                                slidesPerView: Math.floor(slidesPerView * 0.5),
                                spaceBetween: Math.floor(spaceBetweenSlides * 0.5)
                            },
                            767: {
                                slidesPerView: Math.floor(slidesPerView * 0.25)
                            },
                        }
                    }
                );
            });
        },

        news_smart_box_init: function ( self ) {
            jQuery('.news-smart-box__instance').each( function() {
                var uniqId = $( this ).data( 'uniq-id' ),
                    instanceSettings = $( this ).data( 'instance-settings' ),
                    instance = $( '#' + uniqId ),
                    $termItemList = $( '.terms-list .term-item', instance ),
                    $currentTerm = $( '.current-term span', instance ),
                    $listContainer = $( '.news-smart-box__wrapper', instance ),
                    $ajaxPreloader = $( '.nsb-spinner', instance ),
                    ajaxGetNewInstance = null,
                    ajaxGetNewInstanceSuccess = true,
                    showNewItems = null;

                $termItemList.on( 'click', function(){
                    var slug = $( this ).data( 'slug' ),
                        data = {
                            action: 'new_smart_box_instance',
                            value_slug: slug,
                            instance_settings: instanceSettings
                        },
                        currentTermName = $( 'span', this ).text(),
                        counter = 0;

                    $currentTerm.html( currentTermName );

                    if ( ajaxGetNewInstance !== null ) {
                        ajaxGetNewInstance.abort();
                    }
                    ajaxGetNewInstance = $.ajax({
                        type: 'GET',
                        url: gadnews.ajaxurl,
                        data: data,
                        cache: false,
                        beforeSend: function(){
                            ajaxGetNewInstanceSuccess = false;
                            $ajaxPreloader.css( { 'display' : 'block' } ).fadeTo( 300, 1 );
                        },
                        success: function( response ){
                            ajaxGetNewInstanceSuccess = true;

                            $ajaxPreloader.fadeTo( 300, 0, function() {
                                $( this ).css( { 'display' : 'none' } );
                            });

                            $( '.news-smart-box__listing', $listContainer ).html( response );

                            counter = 0;
                            $( '.news-smart-box__listing .post .inner', $listContainer ).addClass( 'animate-cycle-show' );
                            $( '.news-smart-box__listing .post', $listContainer ).each( function() {
                                showItem( $( this ), 100 * parseInt( counter ) + 200 );
                                counter++;
                            })

                        }
                    });

                });

                var showItem = function( itemList, delay ) {
                    var timeOutInterval = setTimeout( function() {
                        $('.inner', itemList).removeClass( 'animate-cycle-show' );
                    }, delay );
                }
            });
        },

        post_formats_custom_init: function (self) {
            CherryJsCore.variable.$document.on('cherry-post-formats-custom-init', function (event) {

                if ('slider' !== event.object) {
                    return;
                }

                var uniqId = '#' + event.item.attr('id'),
                    swiper = new Swiper(uniqId, {
                        pagination: uniqId + ' .swiper-pagination',
                        paginationClickable: true,
                        nextButton: uniqId + ' .swiper-button-next',
                        prevButton: uniqId + ' .swiper-button-prev',
                        spaceBetween: 30,
                        onInit: function () {
                            $(uniqId + ' .swiper-button-next').css({'display': 'block'});
                            $(uniqId + ' .swiper-button-prev').css({'display': 'block'});
                        },
                    });

                event.item.data('initalized', true);
            });
            var items = [];

            $('.mini-gallery .post-thumbnail__link').on('click', function(event) {
                event.preventDefault();

                $(this).parents('.mini-gallery').find('.post-gallery__slides > a[href]').each(function() {
                    items.push({
                        src: $(this).attr('href'),
                        type: 'image'
                    });
                });

                $.magnificPopup.open({
                    items: items,
                    gallery: {
                        enabled: true
                    }
                });
            });
        },

        navbar_init: function (self) {

            $(window).load(function () {

                var $navbar = $('.header-container');

                if (!$.isFunction(jQuery.fn.stickUp) || !$navbar.length) {
                    return !1;
                }

                if ($('#wpadminbar').length) {
                    $navbar.addClass('has-bar');
                }

                $navbar.stickUp();

            });
        },

        subscribe_init: function( self ) {
			CherryJsCore.variable.$document.on( 'click', '.subscribe-block__submit', function( event ){

				event.preventDefault();

				var $this       = $(this),
					form       = $this.parents( 'form' ),
					nonce      = form.find( 'input[name="gadnews_subscribe"]' ).val(),
					mail_input = form.find( 'input[name="subscribe-mail"]' ),
					mail       = mail_input.val(),
					error      = form.find( '.subscribe-block__error' ),
					success    = form.find( '.subscribe-block__success' ),
					hidden     = 'hidden';

				if ( '' == mail ) {
					mail_input.addClass( 'error' );
					return !1;
				}

				if ( $this.hasClass( 'processing' ) ) {
					return !1;
				}

				$this.addClass( 'processing' );
				error.empty();
                mail_input.removeClass( 'error' );

				if ( ! error.hasClass( hidden ) ) {
					error.addClass( hidden );
				}

				if ( ! success.hasClass( hidden ) ) {
					success.addClass( hidden );
				}

				$.ajax({
					url: gadnews.ajaxurl,
					type: 'post',
					dataType: 'json',
					data: {
						action: 'gadnews_subscribe',
						mail: mail,
						nonce: nonce
					},
					error: function() {
						$this.removeClass( 'processing' );
					}
				}).done( function( response ) {

					$this.removeClass( 'processing' );

					if ( true === response.success ) {
						success.removeClass( hidden );
						mail_input.val('');
						return 1;
					}

					error.removeClass( hidden ).html( response.data.message );
                    mail_input.addClass( 'error' );
					return !1;

				});

			})
		},

        main_menu: function ( self, target ) {

            var menu = target,
                duration_timeout,
                closeSubs,
                hideSub,
                showSub,
                init;

            closeSubs = function() {
                $( '.menu-hover > a', menu ).each(
                    function() {
                        hideSub( $(this) );
                    }
                );
            };

            hideSub = function( anchor ) {

                anchor.parent().removeClass( 'menu-hover' ).triggerHandler( 'close_menu' );

                anchor.siblings('ul').addClass('in-transition');

                clearTimeout( duration_timeout );
                duration_timeout = setTimeout(
                    function() {
                        anchor.siblings('ul').removeClass( 'in-transition' );
                    },
                    200
                );
            };

            showSub = function( anchor ) {

                // all open children of open siblings
                var item = anchor.parent();

                item
                    .siblings()
                    .find( '.menu-hover' )
                    .addBack( '.menu-hover' )
                    .children( 'a' )
                    .each(function() {
                        hideSub( $( this ), true );
                    });

                item.addClass( 'menu-hover' ).triggerHandler( 'open_menu' );
            };

            init = function() {
                var $mainNavigation = $( '.main-navigation' ),
                    $mainMenu = $( 'ul.menu', $mainNavigation ),
                    $menuToggle = $( '.menu-toggle', $mainNavigation ),
                    $liWithChildren = $( 'li.menu-item-has-children, li.page_item_has_children', menu ),
                    $self;

                $liWithChildren.hoverIntent( {
                    over   : function() {
                        showSub( $( this ).children( 'a' ) );
                    },
                    out    : function() {
                        if ( $( this ).hasClass( 'menu-hover' ) ) {
                            hideSub( $( this ).children( 'a' ) );
                        }
                    },
                    timeout: 300
                } );

                $menuToggle.on('click', function () {
                    $mainNavigation.toggleClass('toggled');
                });

                var currentItem = -1;
                $mainNavigation.find( '#main-menu > li[class*="children"] > a' )
                    .on( 'click', function( $jqEvent ) {
                        $self = $( this );

                        if ( currentItem !== $self.index() ) {
                            $jqEvent.preventDefault();
                        }

                        currentItem = $self.index();
                    } );

                CherryJsCore.variable.$document.on( 'touchend', function( $jqEvent ) {
                    if ( $( $jqEvent.target ).parent().hasClass( 'menu-hover' ) === false ) {
                        closeSubs();
                        currentItem = -1;
                    }
                } );
            };
            init();
        },

        page_preloader_init: function (self) {

            if ($('.page-preloader-cover')[0]) {
                $('.page-preloader-cover').delay(500).fadeTo(500, 0, function () {
                    $(this).remove();
                });
            }
        },

        to_top_init: function (self) {
            if ($.isFunction(jQuery.fn.UItoTop)) {
                $().UItoTop({
                    text: '',
                    scrollSpeed: 600
                });
            }
        },

        featured_posts_block_init: function ( self ) {
            var $wrappers = $( '.tm_fpblock' ),
                $wrapper    = null,
                $item       = null,
                $items      = [],
                offset      = 0,
                height      = 0;

            /**
             * Update images height
             *
             * @return {boolean}
             */
            function _scaleImage() {
                if ( ! $wrappers ||
                    0 === $wrappers.length ) {
                    return false;
                }

                $wrappers.each( function() {
                    $wrapper = $( this );

                    if ( $wrapper.hasClass( 'tm_fpblock-layout-4' ) ) {

                        $item  = $wrapper.find( '.tm_fpblock__item-2' );
                        height = $item.prev().height();

                        $item.find( '.tm_fpblock__item__preview' ).css( 'height', height );

                        if ( 992 > $( window ).width() && 767 < $( window ).width() ) {
                            $item  = $wrapper.find( '.tm_fpblock__item-1' );
                            offset = ( $item.height() / 2 );

                            $wrapper.find( '.tm_fpblock__item-small:last' ).css( 'top', offset + 'px' );
                        } else {
                            $wrapper.find( '.tm_fpblock__item-small:last' ).css( 'top', 'auto' );
                        }

                        $item  = $wrapper.find( '.tm_fpblock__item:first' );
                        height = $item.height();

                        $items = $wrapper.find( '.tm_fpblock__item:not(.tm_fpblock__item-1):not(.tm_fpblock__item-2)' );

                        if ( 767 < $( window ).width() ) {
                            height = height / 2;
                        }

                        $items.each( function() {
                            $item = $( this );
                            $item.css( 'height', height );
                            $item.find( '.tm_fpblock__item__preview' ).css( 'height', height );
                            $item.find( '.tm_fpblock__item__preview > img' ).css( 'height', height );
                        } );
                    } else if ( $wrapper.hasClass( 'tm_fpblock-layout-2' ) ||
                        $wrapper.hasClass( 'tm_fpblock-layout-3' ) ||
                        $wrapper.hasClass( 'tm_fpblock-layout-5' ) ) {

                        $item  = $wrapper.find( '.tm_fpblock__item:first' );
                        height = $item.height();

                        $items = $wrapper.find( '.tm_fpblock__item:not(:first)' );

                        if ( 767 < $( window ).width() ) {
                            height = height / 2;
                        }

                        $items.each( function() {
                            $item = $( this );

                            $item.css( 'height', height );
                            $item.find( '.tm_fpblock__item__preview' ).css( 'height', height );
                            $item.find( '.tm_fpblock__item__preview > img' ).css( 'height', height );
                        } );
                    } else if ( $wrapper.hasClass( 'tm_fpblock-layout-1' ) ) {

                        $item  = $wrapper.find( '.tm_fpblock__item-large' );
                        height = $item.height();

                        $items = $wrapper.find( '.tm_fpblock__item:not(.tm_fpblock__item-large)' );

                        if ( 767 < $( window ).width() ) {
                            height = height / 2;
                        }

                        $items.each( function() {
                            $item = $( this );

                            $item.css( 'height', height );
                            $item.find( '.tm_fpblock__item__preview' ).css( 'height', height );
                            $item.find( '.tm_fpblock__item__preview > img' ).css( 'height', height );
                        } );
                    }
                } );

                return true;
            }

            $wrappers.find( 'img' ).one( 'load', function( $jqEvent ) {
                _scaleImage();
            } ).each( function() {
                if ( this.complete ) {
                    $( this ).load();
                }
            } );

            window.onresize = _scaleImage;
        }
    };
    CherryJsCore.theme_script.init();
}(jQuery));
