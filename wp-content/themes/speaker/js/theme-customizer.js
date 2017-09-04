/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * Things like site title, description, and background color changes.
 */

 var console = console || {};

;( function( $ ) {

	'use strict';

	/**
	 * Background
	 */
	var backgrounds = {
		'page_bg' : '#main',
		'site_footer_bg' : '#colophon',
		'music_network_bg' : '.music-social-icons-container'
	},

	options = [ 'repeat', 'position', 'attachment' ];

	$.each( backgrounds, function( key, bg ) {

		$.each( options, function( k, o ) {
			
			wp.customize( key + '_' + o, function( value ) {

				value.bind( function( to ) {

					var prop = 'background-' + o;
					$( bg ).css( prop , to );

				} );
			} );
		} );

		/* Color
		---------------*/
		// alert( $(bg).css( 'background-color' ) );

		/* Size
		---------------*/
		wp.customize( key + '_size', function( value ) {
			
			value.bind( function( to ) {

				if ( to === 'cover' ) {
					$( bg ).css( {
						'background-size' : 'cover',
						'-webkit-background-size' : 'cover',
						'-moz-background-size' : 'cover',
						'-o-background-size' : 'cover'
					} );

				} else if ( to === 'resize' ) {
					
					$( bg ).css( {
						'background-size' : '100% auto',
						'-webkit-background-size' : '100% auto',
						'-moz-background-size' : '100% auto',
						'-o-background-size' : '100% auto'
					} );

				} else if ( to === 'normal' ) {
					
					$( bg ).css( {
						'background-size' : 'auto',
						'-webkit-background-size' : 'auto',
						'-moz-background-size' : 'auto',
						'-o-background-size' : 'auto'
					} );
				}
			} );
		} );
	} ); // end for each background

} )( jQuery );