/*!
 * Wolf Gram script
 */

;( function( $ ) {

	'use strict';

	$( document ).ready( function() {
		
		$( '.wolf-instagram-item-container' ).css( { height : $( '.wolf-instagram-item-container' ).first().width() } );

		$( window ).resize( function() {
			$( '.wolf-instagram-item-container' ).css( { height : $( '.wolf-instagram-item-container' ).first().width() } );
		} );
	} );

} )( jQuery );


