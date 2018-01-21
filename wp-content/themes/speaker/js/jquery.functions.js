/**
 *  Speaker
 */
/* jshint -W062 */
var WolfThemeParams =  WolfThemeParams || {},
	WolfThemeUi = WolfThemeUi || {},
	console = console || {};

WolfThemeUi = function( $ ) {

	'use strict';

	return {
		body : $( 'body' ),
		toolbarOffset : $( 'body' ).is( '.admin-bar' ) ? 32 : 0,
		isMobile : navigator.userAgent !== 'undefined' && navigator.userAgent.match( /(iPad)|(iPhone)|(iPod)|(Android)|(PlayBook)|(BB10)|(BlackBerry)|(Opera Mini)|(IEMobile)|(webOS)|(MeeGo)/i ),
		overlay : $( '#overlay' ),
		loader : $( '#loader' ),
		clock : 0,
		timer : null,
		resizeTime : null,
		resizeClock : 0,

		/**
		 * Init UI
		 */
		init : function () {

			var _this = this;

			$( window ).trigger( 'resize' ); // trigger resize event to force all window size related calculation

			this.loaderOverlay();

			if ( this.isMobile ) {
				this.body.addClass( 'is-mobile' );
				// this.hideOverlay(); // ensure to not display the overlay on mobile
			}

			this.resizeTimer();
			this.addIntroClass( $( window ).scrollTop() );
			this.fullWindowHeader();
			this.fullWindowSection();
			this.parallax();
			this.videoBackground();
			this.breakPoint();
			this.fluidVideos();
			this.wmode();
			this.removeVimeoTitle();
			this.smoothScroll();
			this.shareLinkPopup();
			this.mailchimpPlaceholder();
			this.variousFixes();
			this.toggleMenu();
			this.masonryPhotoGrid();
			this.masonryFrontPosts();
			this.lightbox();

			/**
			 * Resize event
			 */
			$( window ).resize( function() {
				_this.fullWindowHeader();
				_this.fullWindowSection();
				_this.parallax();
				_this.videoBackground();
				_this.breakPoint();
				_this.bigScreenSafariClass();
			} ).resize();

			/**
			 * Scroll event
			 */
			$( window ).scroll( function() {
				_this.addIntroClass( $( window ).scrollTop() );
				_this.stickyMenu( $( window ).scrollTop() );
				_this.topLinkAnimation( $( window ).scrollTop() );
				_this.setActiveMenuItem( $( window ).scrollTop() );
			} );
		},

		/**
		 * Trigger window resize event on page load
		 */
		resizeTimer : function () {

			var _this = this;

			if ( this.body.hasClass( 'is-one-paged' ) && $( '.section-front-posts' ).length ) {

				_this.resizeTime = setInterval( function() {
					_this.resizeClock++;
					$( window ).trigger( 'resize' );

					if ( _this.resizeClock === 5 ) {
						_this.clearResizeTime();
					}
					// console.log( _this.resizeClock );
				}, 2000 );
			}
		},

		/**
		 * Clear resize time
		 */
		clearResizeTime : function () {
			clearInterval( this.resizeTime );
		},

		/**
		 * Loader
		 */
		loaderOverlay : function () {

			var _this = this;

			// timer to display the loader if loading last more than 1 sec
			_this.timer = setInterval( function() {

				_this.clock++;
				if ( _this.clock === 1 ) {
					$( '#loader' ).fadeIn();
				}

				/**
				 * If the loading time last more than 2 sec, we hide the overlay anyway
				 * An iframe such as a video or a google map probably takes too much time to load
				 * So let's show the page
				 */
				if ( _this.clock === 3 ) {
					_this.hideOverlay();
				}

			}, 1000 );
		},

		/**
		 * Check if browser supports vh units
		 * not used
		 */
		detectVUnit : function () {
			var div = $( '<div style="height:0; height:100vh" />' ),
				bool;

			if ( 0 < div.height() ) {
				bool = true;
			}

			return bool;
		},

		/**
		 * Full Window Home Header
		 */
		fullWindowHeader : function () {

			if (
				this.body.hasClass( 'home' ) && this.body.hasClass( 'home-header-full-window' )
			) {

				var winHeight = $( window ).height() - this.toolbarOffset,
					header = $( '#masthead' );

				header.css( { 'height' : winHeight } );
			}
		},

		/**
		 * Full Window Section
		 */
		fullWindowSection : function () {

			var _this = this;

			$( '.section-full-window' ).each( function() {

				$( this ).css( { 'height' : $( window ).height() - _this.toolbarOffset } );

			} );
		},

		/**
		 * Video Background
		 */
		videoBackground : function () {

			var videoContainer = $( '.section-video-bg, .home-header-full-video .site-header, .header-has-video-bg .site-header' );

			if ( ! this.isMobile ) {

				videoContainer.each( function() {

					var containerWidth = $( this ).width(),
						containerHeight = $( this ).height(),
						ratioWidth = 640,
						ratioHeight = 360,
						ratio = ratioWidth/ratioHeight,
						video = $( this ).find( '.section-video' ),
						newHeight,
						newWidth,
						newMarginLeft,
						newmarginTop,
						newCss;

					if ( ( containerWidth / containerHeight ) >= ratio ) {

						newWidth = containerWidth;
						newHeight = Math.floor( ( containerWidth/ratioWidth ) * ratioHeight ) + 2;
						newmarginTop =  Math.floor( ( containerHeight - newHeight ) / 2 );

						newCss = {
							width : newWidth,
							height : newHeight,
							marginTop :  newmarginTop,
							marginLeft : 0
						};

						video.css( newCss );

					} else if ( ( containerWidth / containerHeight ) < ratio ) {

						newHeight = containerHeight;
						newWidth = Math.floor( ( containerHeight/ratioHeight )*ratioWidth );
						newMarginLeft =  Math.floor( ( containerWidth - newWidth ) / 2 );


						newCss = {
							width : newWidth,
							height : newHeight,
							marginLeft :  newMarginLeft,
							marginTop : 0
						};

						video.css( newCss );
					}
				} );

			} else {
				$( '.section-video-container' ).hide();
			}
		},

		/**
		 * Add a specific class when we're at the top of the page in full window header mode
		 */
		addIntroClass : function ( scrollTop ) {

			if ( this.body.hasClass( 'home' ) && this.body.hasClass( 'home-header-full-window' ) ) {

				if ( scrollTop <  200 ) {
					this.body.addClass( 'intro' );
				} else {
					this.body.removeClass( 'intro' );
				}
			}
		},

		/**
		 * Add a custom class for safari on big screen as it doesn't handle CSS transform transition smoothly (for the menu animation).
		 * It is dirty, but it works.
		 * Why Safary ? please, stahp
		 */
		bigScreenSafariClass : function () {

			var winWidth = $( window ).width(),
				isSafari = navigator.userAgent.indexOf( 'Safari' ) !== -1 && navigator.userAgent.indexOf( 'Chrome' ) === -1,
				SafariBreakPoint = 1200;

			if ( isSafari ) {
				if ( SafariBreakPoint < winWidth ) {
					this.body.removeClass( 'do-transform' )
						.addClass( 'do-animate' );
				} else {
					this.body.removeClass( 'do-animate' )
						.addClass( 'do-transform' );
				}
			}
		},

		/**
		 *  Add a breakpoint class
		 */
		breakPoint : function () {

			var breakpoint = WolfThemeParams.breakPoint;

			if ( breakpoint > $( window ).width() ) {
				this.body.addClass( 'breakpoint' );
			} else {
				this.body.removeClass( 'breakpoint' );
			}
		},

		/**
		 * Fluid Video wrapper
		 */
		fluidVideos : function ( container ) {

			container = container || $( '#page' );

			var videoSelectors = [
				'iframe[src*="player.vimeo.com"]',
				'iframe[src*="youtube.com"]',
				'iframe[src*="youtube-nocookie.com"]',
				'iframe[src*="kickstarter.com"][src*="video.html"]',
				'iframe[src*="screenr.com"]',
				'iframe[src*="blip.tv"]',
				'iframe[src*="dailymotion.com"]',
				'iframe[src*="viddler.com"]',
				'iframe[src*="qik.com"]',
				'iframe[src*="revision3.com"]',
				'iframe[src*="hulu.com"]',
				'iframe[src*="funnyordie.com"]',
				'iframe[src*="flickr.com"]',
				'embed[src*="v.wordpress.com"]'
			];

			container.find( videoSelectors.join( ',' ) ).wrap( '<span class="fluid-video" />' );
			$( '.rev_slider_wrapper' ).find( videoSelectors.join( ',' ) ).unwrap(); // disabled for revslider videos
		},

		/**
		 * Fix z-index bug with youtube videos
		 */
		wmode : function() {

			var iframes = $( 'iframe' );

			if ( iframes.length ) {

				iframes.each(function(){

					var url = $( this ).attr( 'src' );

					if ( url.match( /(youtube.com)|(youtu.be)/i ) ) {

						if ( url.indexOf( '?' ) !== -1) {

							$( this ).attr( 'src', url + '&wmode=transparent' );

						} else {

							$( this ).attr('src', url + '?wmode=transparent' );
						}
					}
				} );
			}
		},

		/**
		 * Remove title from vimeo videos
		 */
		removeVimeoTitle : function() {

			var iframes = $( 'iframe' );

			if ( iframes.length ) {

				iframes.each(function(){

					var url = $( this ).attr( 'src' );

					if ( '' !== url && url.match( /(vimeo.com)/i ) ) {

						if ( url.indexOf( '?' ) !== -1) {

							$( this ).attr( 'src', url + '&title=0&byline=0&portrait=0' );

						} else {

							$( this ).attr('src', url + '?title=0&byline=0&portrait=0' );
						}
					}
				} );
			}
		},

		/**
		 * Back to top arrow
		 */
		smoothScroll : function () {

			var _this = this,
				doNotSmoothScroll = WolfThemeParams.doNotSmoothScroll === 'true' && this.body.hasClass( 'breakpoint' ) ? true : false;

			if ( this.body.hasClass( 'breakpoint' ) ) {
				_this.toolbarOffset = 0;
			}

			$( '.scroll' ).bind( 'click',function( event ) {
				event.preventDefault();
				event.stopPropagation();
				var $anchor = $( this ),
					scrollOffset = _this.toolbarOffset,
					$section = $( $anchor.attr( 'href' ) );

				if ( $section.length ) {

					if ( $section.hasClass( 'is-section-masonry-gallery' ) && ! _this.body.hasClass( 'breakpoint' ) ) {
						scrollOffset = scrollOffset + 54;
					}

					if ( _this.body.hasClass( 'breakpoint' ) && _this.body.hasClass( 'toggled-on' ) && ! $( this ).parent().hasClass( 'menu-item-has-children' ) ) {
						_this.body.removeClass( 'toggled-on' );
					}

					if ( doNotSmoothScroll === false ) {
						$( 'html, body' ).stop().animate( {
							scrollTop: $section.offset().top - scrollOffset
						}, 1E3, 'swing' );
					}
				}
			} );
		},

		/**
		 * Back to the top link animation
		 */
		topLinkAnimation : function( scrollTop ){

			if ( scrollTop >=550 ) {
				$('a#top-arrow').show();
			} else {
				$('a#top-arrow').hide();
			}
		},

		/**
		 * Share Links Popup
		 */
		shareLinkPopup : function () {

			var _this = this;

			$( '.share-link' ).click( function() {

				if ( $( this ).data( 'popup' ) === true && ! _this.isMobile ){

					var $link = $( this ),
						url = $link.attr( 'href' ),
						height = $link.data( 'height' ) || 250,
						width = $link.data( 'width' ) || 500,
						popup = window.open( url,'null', 'height=' + height + ',width=' + width + ', top=150, left=150' );



					if ( window.focus ) {
						popup.focus();
					}

					return false;
				}
			} );
		},

		/**
		 * Hide Overlay
		 */
		hideOverlay : function () {

			var _this = this;

			_this.loader.fadeOut( 'fast', function() {

				_this.overlay.fadeOut( 'slow', function() {
					clearInterval( _this.timer );
					_this.body.addClass( 'loaded' );
				} );
			} );
		},

		/**
		 * Move mailchimp label in placeholder attribute
		 */
		mailchimpPlaceholder : function () {

			var input = $( '#mc_mv_EMAIL' );

			input.each( function() {
				if ( $( this ).attr( 'placeholder' ) === '' ) {
					$( this ).attr( 'placeholder', WolfThemeParams.newsletterPlaceholder );
				}
			} );
		},

		/**
		 * Additional lil hacks
		 */
		variousFixes : function () {

			$( '[id*="more-"]' ).parent( 'p' ).css({ marginTop : 0, marginBottom : 0 }); // no margin for the "more" anchor p parent tag
			$( '.fluid-video' ).parent( 'p' ).css({ marginTop : 0 }); // no margin top for the "fluid-video" p parent tag
			$( '#posts-front-page' ).find( '.wp-video' ).css( { 'width' : $( '#post-media-container' ).width() } );
		},

		/**
		 * Sticky Menu
		 */
		stickyMenu : function ( scrollTop ) {

			if ( scrollTop > $( '#masthead' ).outerHeight() - $( '#navbar-container' ).outerHeight() ) {

				this.body.addClass( 'sticky-menu' );

			} else {
				this.body.removeClass( 'sticky-menu' );
			}
		},

		/**
		 * Mobile Menu
		 */
		toggleMenu : function () {

			var _this = this,
				nav = $( '#site-navigation-primary-mobile' ),
				button,
				menu,
				dropDown = $( '#one-page-mobile-menu li.menu-item-has-children a, #one-page-mobile-menu li.page_item_has_children a' );

			if ( ! nav ) {
				return;
			}

			button = $( '#menu-toggle' ),
				menu = nav.find( '#one-page-mobile-menu' );

			if ( ! button ) {
				return;
			}

			// Hide button if menu is missing or empty.
			if ( ! menu || ! menu.children().length ) {
				button.hide();
				return;
			}

			button.on( 'click', function() {

				if ( ! _this.body.hasClass( 'toggled-on' ) ) {
					_this.body.addClass( 'toggled-on' );
				}

			} );

			$( 'body' ).on( 'click', function( event ) {

				var target = $( event.target ),
					targetId = event.target.id,
					isLink = target.is( 'a' );

				if ( ! isLink && targetId !== 'navbar' && targetId !== 'menu-toggle' && _this.body.hasClass( 'toggled-on' ) ) {
					_this.body.removeClass( 'toggled-on' );
				}
			} );

			dropDown.each( function() {

				if ( $( this ).parent().find( 'ul:first' ).length ) {

					$( this ).toggle( function( event ) {

						event.preventDefault();

						$( this ).parent().find( 'ul:first' ).slideDown();

					}, function() {

						$( this ).parent().find( 'ul:first' ).slideUp();

					} );
				}
			} );
		},

		/**
		 *  Parallax Background
		 */
		parallax : function () {

			if ( ! this.isMobile ) {
				$( '.section-parallax' ).each( function() {
					$( this ).parallax( '50%', 0.1 );
				} );
			}
		},

		/**
		 * Masonry Photo Section
		 */
		masonryPhotoGrid : function () {

			if ( this.body.hasClass( 'is-one-paged' ) || this.body.hasClass( 'section-page' ) ) {

				$( '.masonry-section-gallery' ).imagesLoaded( function() {
					$( '.masonry-section-gallery' ).isotope( {
						masonry: {
							columnWidth: 2
						}
					} );
				} );
			}
		},

		/**
		 * Masonry Post front page
		 */
		masonryFrontPosts : function () {

			if ( this.body.hasClass( 'is-one-paged' ) ) {

				var $posts = $( '#posts-front-page' );

				$posts.imagesLoaded( function() {
					$posts.isotope( {
						itemSelector : '#posts-front-page .post'
					} );
				} );

				$( window ).resize( function() {
					$posts.isotope( {
						itemSelector : '#posts-front-page .post'
					} );
				} ).resize();
			}
		},

		/**
		 * Set lightbox depending on user's theme options
		 */
		lightbox : function() {

			if ( $.isFunction( $.swipebox ) && WolfThemeParams.lightbox === 'swipebox' ) {

				$( '.lightbox, .wolf-show-flyer, .wolf-show-flyer-single, .last-photos-thumbnails' ).swipebox();

				if ( WolfThemeParams.videoLightbox !== null ) {
					$( '.video-item-container .entry-link' ).swipebox();
				}


			} else if ( $.isFunction( $.fancybox ) && WolfThemeParams.lightbox === 'fancybox' ) {

				$( '.lightbox, .wolf-show-flyer, .wolf-show-flyer-single, .last-photos-thumbnails' ).fancybox();

				if ( WolfThemeParams.videoLightbox !== null ) {
					$( '.video-item-container .entry-link' ).fancybox( {
						padding : 0,
						nextEffect : 'none',
						prevEffect : 'none',
						openEffect  : 'none',
						closeEffect : 'none',
						helpers : {
							media : {},
							title : {
								type : 'outside'
							},
							overlay : {
								opacity: 0.9
							}
						}
					} );
				}
			}

			/**
			 * Add replace entry link by video link
			 */
			if ( $( '.video-item-container' ).length && WolfThemeParams.videoLightbox !== null && WolfThemeParams.lightbox !== 'none' ) {

				var videoItem = $( '.video-item-container' ),
					postId,
					data;

				videoItem.each( function() {

					var _this = $( this );

					postId = _this.attr( 'id' ).replace( 'post-', '' );

					data = {
						action: 'wolf_get_video_url_from_post_id',
						id : postId
					};

					$.post( WolfThemeParams.ajaxUrl , data, function(response){

						// console.log( response );
						if ( response ) {
							_this.find( '.entry-link' ).attr( 'href', response );
						}

					});
				} );

				$( '.video-item-container .entry-link' ).each( function(){ $( this ).attr( 'rel','video-gallery' ); } );
			}

			$( '.gallery .lightbox' ).each( function(){ $( this ).attr( 'rel','gallery' ); } );
		},

		/**
		 * FlexSlider
		 */
		flexSlider : function() {

			if ( $.isFunction( $.flexslider ) ) {

				/* Post slider */
				$( '.format-gallery .flexslider, .wolf-gallery-slider' ).flexslider( {
					animation: 'slide',
					slideshow : true,
					smoothHeight : true
				} );
			}
		},

		/**
		 * Set active menu item
		 */
		setActiveMenuItem : function ( scrollTop ) {

			if ( this.body.hasClass( 'is-one-paged' ) ) {

				var menuItems = $( '#one-page-menu a' ),
					menuItem,
					sectionOffset,
					threshold = 150, i;

				for ( i = 0; i < menuItems.length; i++ ) {

					menuItem = $( menuItems[ i ] );

					if (  menuItem.hasClass( 'scroll' ) ) {

						if ( $( menuItem.attr( 'href' ) ).length ) {

							sectionOffset = $( menuItem.attr( 'href' ) ).offset().top;

							if ( scrollTop > sectionOffset - threshold && scrollTop < sectionOffset + threshold ) {
								menuItems.removeClass( 'active' );
								menuItem.addClass( 'active' );
							}
						}
					}
				}
			}
		},

		/**
		 * Page Load
		 */
		pageLoad : function() {

			// Hide loader overlay if visible
			if ( this.overlay.is( ':visible' ) ) {

				this.hideOverlay();

			} else {

				if ( ! this.body.hasClass( 'loaded' ) ) {
					this.body.addClass( 'loaded' );
				}
			}

			this.flexSlider();
		}
	};

}( jQuery );

;( function( $ ) {

	'use strict';
	WolfThemeUi.init();

	$( window ).load( function() {
		WolfThemeUi.pageLoad();
	} );

} )( jQuery );