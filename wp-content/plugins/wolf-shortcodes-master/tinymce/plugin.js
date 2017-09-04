;( function( $ ) {
	'use strict';   
 
	//Shortcodes
	tinymce.PluginManager.add( 'WolfShortcodes', function( editor, url ) {

		editor.addCommand( 'wolfPopup', function ( a, params )
		{
			var popup = params.identifier;
			// console.log( popup );
			tb_show( 'Insert Shortcode', url + "/popup.php?popup=" + popup + "&width=" + 800 );
		});

		editor.addButton( 'wolf_shortcodes_button', {
			type: 'splitbutton',
			icon: false,
			title:  'Shortcodes',
			menu: [
				{ text: 'Buttons',onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: 'Buttons', identifier: 'button' } )
				} },
				{ text: 'Columns',onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: 'Columns', identifier: 'columns' } )
				} },
				{ text: 'Notifications',onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: 'Notifications', identifier: 'notifications' } )
				} },
				{ text: 'Highlight',onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: 'Highlight', identifier: 'highlight' } )
				} },
				{ text: 'Tabs',onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: 'Tabs', identifier: 'tabs' } )
				} },
				{ text: 'Toggles',onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: 'Toggles', identifier: 'toggles' } )
				} },
				{ text: 'Accordion',onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: 'Accordion', identifier: 'accordion' } )
				} },
				{ text: 'Testimonials',onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: 'Testimonials', identifier: 'testimonials' } )
				} },
				{ text: 'Vertical Space',onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: 'Vertical Space', identifier: 'spacer' } )
				} },
				{ text: 'Last Posts',onclick:function() {
					editor.execCommand( 'wolfPopup', false, { title: 'Last Posts', identifier: 'last-posts' } )
				} },
			]
		} );
	} );
 
} )( jQuery );