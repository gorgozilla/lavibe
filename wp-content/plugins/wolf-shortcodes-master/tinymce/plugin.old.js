;(function ()
{
	// create WolfShortcodes plugin
	tinymce.create('tinymce.plugins.WolfShortcodes',
	{

		init: function ( ed, url )
		{	
			// set the path to the plugin
			wolf_shortcodes_plugin_url = url;
			
			ed.addCommand('wolfShortcodePopup', function ( a, params )
			{
				var popup = params.identifier;
				alert(url + '/popup.php');
				// load popup
				tb_show('Insert Shortcode', wolf_shortcodes_plugin_url + '/popup.php?popup='+popup+'&width=' + 640);
			});

		},
		createControl: function ( btn, e )
		{
			if ( btn == 'wolf_shortcodes_button' )
			{	
				// console.log(wolf_shortcodes_plugin_url);
				var a = this;

				var btn = e.createSplitButton('wolf_shortcodes_button', {
                    				title: 'Insert Shortcode',
					image: wolf_shortcodes_plugin_url + '/icons/icon.png',
					icons: false
               			});

				btn.onRenderMenu.add(function (c, b)
				{					
					a.addWithPopup( b, 'Buttons', 'button' );
					a.addWithPopup( b, 'Columns', 'columns' );
					a.addWithPopup( b, 'Notifications', 'notifications' );
					a.addWithPopup( b, 'Highlight', 'highlight' );
					a.addWithPopup( b, 'Tabs', 'tabs' );
					a.addWithPopup( b, 'Toggles', 'toggles' );
					a.addWithPopup( b, 'Accordion', 'accordion' );
					a.addWithPopup( b, 'Google map', 'googlemap' );
					a.addWithPopup( b, 'Testimonials', 'testimonials' );
					a.addWithPopup( b, 'Vertical Space', 'spacer' );
					a.addWithPopup( b, 'Last Posts', 'last-posts' );

				});
                
                			return btn;
			}
			
			return null;
		},
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand('wolfShortcodePopup', false, {
						title: title,
						identifier: id
					})
				}
			})
		},
		
		addImmediate: function ( ed, title, sc) {
			ed.add({
				title: title,
				onclick: function () {
					if(window.tinyMCE){
						window.parent.send_to_editor(sc);
						tb_remove();
						return false;
					}
					//tinyMCE.activeEditor.execCommand( 'mceInsertContent', false, sc )
				}
			})
		},

		getInfo: function () {
			return {
				longname: 'Wolf Shortcodes',
				author: 'Constantin Saguin',
				authorurl: 'http://wpwolf.com',
				infourl: 'http://www.tinymce.com/wiki.php',
				version: '1.5.0'
			}
		}
	});
	
	tinymce.PluginManager.add('WolfShortcodes', tinymce.plugins.WolfShortcodes);
})();