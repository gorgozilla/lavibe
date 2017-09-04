/*-----------------------------------------------------------------------------------*/
/*	Masonry Gallery
/*-----------------------------------------------------------------------------------*/

var WolfThemeGallery = WolfThemeGallery || {};

/* jshint -W062 */
WolfThemeGallery = function ( $ ) {

	'use strict';

	return {

		init : function () {
			this.addOverlay();
			this.masonry();
		},

		addOverlay : function () {
			$( '.masonry-gallery ul li a' ).append( '<span class="gallery-item-overlay" />' );
		},

		masonry : function () {
			var $this = this,
				$gallery = $( '.masonry-gallery ul' );

			$gallery.imagesLoaded( function() {
				$this.setColumnWidth( '.masonry-gallery ul li' );
				$gallery.isotope( {
					itemSelector : '.masonry-gallery ul li'
				} );
			} );

			$( window ).resize( function() {
				$this.setColumnWidth( '.masonry-gallery ul li' );
				$gallery.isotope( {
					itemSelector : '.masonry-gallery ul li'
				} );
			} ).resize();
		},

		/**
		 * Get column number depending on container width
		 */
		getNumColumns : function() {
			var winWidth = $( '#main' ).width(),
				column = 4;
			if ( 767 > winWidth ) {
				column = 2;
			} else if ( winWidth >= 767 && winWidth < 1200 ) {
				column = 3;
			
			} else if ( winWidth >=1200 && winWidth < 1600 ) {
				column = 4;

			} else if ( winWidth >=1600 ) {
				column = 5;
			}
			return column;
		},
		
		/**
		 * Get column width depending on column number
		 */
		getColumnWidth : function() {
			var columns = this.getNumColumns(),
				wrapperWidth,
				columnWidth;

			wrapperWidth = $( '#main' ).width();
			columnWidth = Math.floor( wrapperWidth/columns );
			return columnWidth;
		},

		/**
		 * Set column width
		 */
		setColumnWidth : function( selector ) {
			var ColumnWidth = this.getColumnWidth();
			$( selector ).each( function() {
				$( this ).css( { 'width' : ColumnWidth + 'px' } );
			} );
		}
	};

}( jQuery );

;( function( $ ) {

	'use strict';

	$( document ).ready( function() {
		WolfThemeGallery.init();
	} );
	
} )( jQuery );