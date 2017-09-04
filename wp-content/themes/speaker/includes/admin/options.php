<?php
/**
 * Speaker theme options
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wolf_theme_options;
$wolf_theme_options = array(

/*-----------------------------------------------------------------------------------*/
/*  General
/*-----------------------------------------------------------------------------------*/
array( 
	'type' => 'open', 
	'name' => __( 'General', 'wolf' ),
),

	array( 
		'name' => __( 'Main Settings', 'wolf' ),
 		'type' => 'section_open',
	),

		array( 
			'name' => __( 'Logo', 'wolf' ),
			'id' =>'logo',
			'type' => 'image',
		),

		array(
			'name' => __( 'Lightbox', 'wolf' ),
			'id' => 'lightbox',
			'type' => 'select',
			'options' => array(

				'swipebox' => 'swipebox',
				'fancybox' => 'fancybox',
				'none'     => __( 'None', 'wolf' ),
			),
		),

		array( 
			'name' => __( 'Menu Breakpoint in pixels', 'wolf' ),
			'desc' => __( 'Below each point would you like to display the mobile menu?', 'wolf' ),
			'id' => 'breakpoint',
			'type' => 'int',
		),

		array( 
			'name' => __( 'Disable smooth scroll when mobile menu is on', 'wolf' ),
			'id' => 'no_smooth_scroll',
			'type' => 'checkbox',
		),

		array( 
			'name' => __( 'Hide sidebar on small screen (less than 500px width)', 'wolf' ),
			'id' => 'hide_sidebar_phone',
			'type' => 'checkbox',
		),

		array(
			'name' => __( 'Copyright Text', 'wolf' ),
			'id' => 'copyright_textbox',
			'desc' => __( 'Will be displayed at the very bottom of the page', 'wolf' ),
			'type' => 'text'
		),

	array( 'type' => 'section_close' ),

array( 'type' => 'close' ),

/*-----------------------------------------------------------------------------------*/
/*  Header
/*-----------------------------------------------------------------------------------*/

array( 
	'type' => 'open', 
	'name' => __( 'Header', 'wolf' ),
),

	array( 
		'name' => __( 'Home Header Settings', 'wolf' ),
 		'type' => 'section_open',
	),

		array( 
			'name' => __( 'Home Header Type', 'wolf' ),
			'desc' => __( 'What do you want to display in your home page header?', 'wolf' ),
			'id' => 'home_header_type',
			'type' => 'select',
			'options' => array(
				'standard' => __( 'Standard', 'wolf' ),
				'full-window' => __( 'Full Window', 'wolf' ),
				'video' => __( 'Video Background', 'wolf' ),
				'full-video' => __( 'Full Window Video Background', 'wolf' ),
			),
		),

		array( 
			'name' => __( 'Header Background Parallax', 'wolf' ),
			'id' =>'header_bg_parallax',
			'type' => 'checkbox',
		),

		array( 
			'name' => __( 'Header Share Buttons', 'wolf' ),
			'id' =>'header_share',
			'type' => 'checkbox',
		),

		array( 
			'name' => __( 'Content Editor', 'wolf' ),
			'desc' => __( 'Optional content to display in the home page header below the logo', 'wolf' ),
			'id' => 'home_header_content',
			'type' => 'editor'
		),

		array( 
			'name' => __( 'Header Min Height', 'wolf' ),
			'id' =>'home_header_height',
			'desc' => __( 'The header height in percent', 'wolf' ),
			'type' => 'int',
		),
	
	array( 'type' => 'section_close' ),

	array( 
		'name' => __( 'Header Background', 'wolf' ),
		'id' =>'header_bg',
		'type' => 'background',
		'font_color' => true
	),

	array( 
		'name' => __( 'Video background', 'wolf' ),
 		'type' => 'section_open',
 		'desc' => __( 'If you choose the video background option above', 'wolf' )
 	),

		array(
			'name' => __( 'Video URL mp4', 'wolf' ),
			'id' => 'video_bg_mp4',
			'type' => 'file'
		),

		array( 
			'name' => __( 'Video URL webm', 'wolf' ),
			'desc' => __( 'This field is optional but adding a webm file improves cross browser compatibility', 'wolf' ),
			'id' => 'video_bg_webm',
			'type' => 'file'
		),

		array( 
			'name' => __( 'Video URL ogv', 'wolf' ),
			'desc' => __( 'This field is optional but adding an ogv file improves cross browser compatibility', 'wolf' ),
			'id' => 'video_bg_ogv',
			'type' => 'file'
		),

		// array( 
		// 	'name' => __( 'Video opacity (in percent)', 'wolf' ),
		// 	'id' => 'video_bg_opacity',
		// 	'type' => 'int'
		// ),

		// array( 
		// 	'name' => __( 'Video background color', 'wolf' ),
		// 	'desc' => __( 'Set a background color if you want to play with the video opacity', 'wolf' ),
		// 	'id' => 'video_bg_color',
		// 	'type' => 'colorpicker'
		// ),

		// array( 
		// 	'name' => __( 'Video image fallback', 'wolf' ),
		// 	'desc' => __( 'Background to display if the browser doesn\'t support video background (mainly mobile devices).', 'wolf' ),
		// 	'id' => 'video_bg_fallback',
		// 	'type' => 'image'
		// ),

	array( 'type' => 'section_close' ),

array( 'type' => 'close' ),


/*-----------------------------------------------------------------------------------*/
/*  Blog
/*-----------------------------------------------------------------------------------*/

array( 
	'type' => 'open',
	'name' =>__( 'Blog', 'wolf' )
),

	array( 
		'name' => __( 'Blog', 'wolf' ),
		'type' => 'section_open',
	),

	array( 
		'name' => __( 'Display sidebar', 'wolf' ),
		'id' => 'blog_sidebar',
		'type' => 'checkbox',
	),

	array( 
		'name' => __( 'Home page post count', 'wolf' ),
		'desc' => __( 'The number of post to display on the home page blog section if set (multiple of 3)', 'wolf' ),
		'id' => 'home_post_count',
		'type' => 'int',
	),

	array( 
		'name' => __( 'Show author bio', 'wolf' ),
		'desc' => __( 'Show the author bio below each single blog post? The author must have entered his descirption in his profile to display his bio.', 'wolf' ),
		'id' => 'show_author_box',
		'type' => 'checkbox',
	),

	array( 
		'name' => __( 'Share Links', 'wolf' ),
		'desc' => __( 'Display "share" links below each single post ?', 'wolf' ),
		'id' => 'show_share_box_single',
		'type' => 'checkbox',

	),

	array( 'type' => 'section_close' ),

array( 'type' => 'close' ),

/*-----------------------------------------------------------------------------------*/
/*  Share
/*-----------------------------------------------------------------------------------*/

array( 
	'type' => 'open', 
	'name' =>__( 'Share', 'wolf' )
),

	array( 
		'name' => __( 'Share Links', 'wolf' ),
		'type' => 'section_open',
	),

	array( 
		'name' => __( 'Generate Facebook & Google plus meta', 'wolf' ),
		'desc' => __( 'Would you like to generate facebook and google plus metadata? Disable this function if you use a SEO plugin.', 'wolf' ),
		'id' => 'social_meta',
		'type' => 'checkbox',
	),

	array( 
		'name' => __( 'Default Share image (used for facebook and google plus)', 'wolf' ),
		'desc' => __( 'By default, the post featured image will be shown when you share a post/page on facebook. Here you can set the default image that will be displayed if no featured image is set', 'wolf' ),
		'id' => 'share_img',
		'type' => 'image',
	),

	array( 
		'name' => __( 'Share Text', 'wolf' ),
		'id' => 'share_text',
		'type' => 'text',
	),

	array( 
		'name' => __( 'Facebook', 'wolf' ),
		'id' => 'share_facebook',
		'type' => 'checkbox',
	),

	array( 
		'name' => __( 'Twitter', 'wolf' ),
		'id' => 'share_twitter',
		'type' => 'checkbox',
	),

	array( 
		'name' => __( 'Pinterest', 'wolf' ),
		'id' => 'share_pinterest',
		'type' => 'checkbox',
	),

	array( 
		'name' => __( 'Google plus', 'wolf' ),
		'id' => 'share_google_plus',
		'type' => 'checkbox',
	),

	array( 
		'name' => __( 'Tumblr', 'wolf' ),
		'id' => 'share_tumblr',
		'type' => 'checkbox',
	),

	array( 
		'name' => __( 'Stumbleupon', 'wolf' ),
		'id' => 'share_stumbleupon',
		'type' => 'checkbox',
	),

	array( 
		'name' => __( 'Linked In', 'wolf' ),
		'id' => 'share_linkedin',
		'type' => 'checkbox',
	),

	array( 
		'name' => __( 'Email', 'wolf' ),
		'id' => 'share_mail',
		'type' => 'checkbox',
	),

	array( 'type' => 'section_close' ),


array( 'type' => 'close' ),

/*-----------------------------------------------------------------------------------*/
/*  Google fonts
/*-----------------------------------------------------------------------------------*/
array(
	'type' => 'open',  
	'name' => __( 'Google Fonts', 'wolf' ) 
),
	

	array( 
		'name' => __( 'Headings', 'wolf' ),
		'type' => 'section_open',
		'desc' =>  __( 'Leave the fields below empty to use the default font', 'wolf' )
	),

	array( 
		'name' => __( 'Titles google font code', 'wolf' ),
		'id' => 'heading_google_font_code',
		'desc' => __( 'eg: Lora:400,700<br> 400 and 700 are the available font weights', 'wolf' ),
		'help' => 'google-fonts',
		'type' => 'text',
	),

	array( 
		'name' => __( 'Titles font name', 'wolf' ),
		'id' => 'heading_google_font_name',
		'desc' => __( 'eg: Lora', 'wolf' ),
		'type' => 'text',
	),

	array( 
		'name' => __( 'Titles font weight', 'wolf' ),
		'id' => 'heading_font_weight',
		'desc' => __( 'For example: 400 is normal, 700 is bold.<br> The available font weights depend on the font.', 'wolf' ),
		'type' => 'int',
		'def' => 700,
	),

	array( 
		'name' => __( 'Titles text transform', 'wolf' ),
		'id' => 'heading_font_transform',
		'type' => 'select',
		'options' => array(
			'standard' => __( 'Standard', 'wolf' ),
			'uppercase' => __( 'Uppercase', 'wolf' ),
		)

	),

	array( 'type' => 'section_close' ),

		array( 
			'name' => __( 'Menu', 'wolf' ),
			'type' => 'section_open',
			'desc' =>  __( 'Leave the fields below empty to use the default font', 'wolf' )
		),

		array( 
			'name' => __( 'Menu google font code', 'wolf' ),
			'id' => 'menu_google_font_code',
			'desc' => __( 'eg: Lora:400,700', 'wolf' ),
			'type' => 'text',
		),

		array( 
			'name' => __( 'Menu font name', 'wolf' ),
			'id' => 'menu_google_font_name',
			'desc' => __( 'eg: Lora', 'wolf' ),
			'type' => 'text',
		),

		array( 
			'name' => __( 'Menu font weight', 'wolf' ),
			'id' => 'menu_font_weight',
			'type' => 'int',
			'def' => 700,
		),

		array( 
			'name' => __( 'Menu text transform', 'wolf' ),
			'id' => 'menu_font_transform',
			'type' => 'select',
			'options' => array(
				'standard' => __( 'Standard', 'wolf' ),
				'uppercase' => __( 'Uppercase', 'wolf' ),
			)

		),

	array( 'type' => 'section_close' ),

		array( 
			'name' => __( 'Custom Font', 'wolf' ),
			'type' => 'section_open',
			'desc' => __( 'To use this custom font add the "custom-font" class to any element e.g <code>&lt;h1 class=&quot;custom-font&quot;&gt;My Custom Title&lt;/h1&gt;</code>', 'wolf' ),

		),

		array( 
			'name' => __( 'Menu google font code', 'wolf' ),
			'id' => 'custom_google_font_code',
			'desc' => __( 'eg: Lora:400,700', 'wolf' ),
			'type' => 'text',
		),

		array( 
			'name' => __( 'Menu font name', 'wolf' ),
			'id' => 'custom_google_font_name',
			'desc' => __( 'eg: Lora', 'wolf' ),
			'type' => 'text',
		),

		array( 
			'name' => __( 'Custom font weight', 'wolf' ),
			'id' => 'custom_font_weight',
			'desc' => __( 'For example: 400 is normal, 700 is bold.<br> The available font weights depend on the font.', 'wolf' ),
			'type' => 'int',
			'def' => 700,
		),

		array( 
			'name' => __( 'Custom font text transform', 'wolf' ),
			'id' => 'custom_font_transform',
			'type' => 'select',
			'options' => array(
				'standard' => __( 'Standard', 'wolf' ),
				'uppercase' => __( 'Uppercase', 'wolf' ),
			)

		),

	array( 'type' => 'section_close' ),

		array( 
			'name' => __( 'Body', 'wolf' ),
			'type' => 'section_open',
			'desc' => __( 'The default font for your page body', 'wolf' )
		),

		array( 
			'name' => __( 'Body google font code', 'wolf' ),
			'id' => 'body_google_font_code',
			'desc' => __( 'eg: Lora:400,700', 'wolf' ),
			'type' => 'text',
		),

		array( 
			'name' => __( 'Body font name', 'wolf' ),
			'id' => 'body_google_font_name',
			'desc' => __( 'eg: Lora', 'wolf' ),
			'type' => 'text',
		),

	array( 'type' => 'section_close' ),

		array( 
			'name' => __( 'Entry', 'wolf' ),
			'type' => 'section_open',
			'desc' => __( 'The font used for the post content', 'wolf' )
		),

		array( 
			'name' => __( 'Entry google font code', 'wolf' ),
			'id' => 'entry_google_font_code',
			'desc' => __( 'eg: Lora:400,700', 'wolf' ),
			'type' => 'text',
		),

		array( 
			'name' => __( 'Entry font name', 'wolf' ),
			'id' => 'entry_google_font_name',
			'desc' => __( 'eg: Lora', 'wolf' ),
			'type' => 'text',
		),

	array( 'type' => 'section_close' ),


array( 'type' => 'close' ),


/*-----------------------------------------------------------------------------------*/
/*  CSS
/*-----------------------------------------------------------------------------------*/

array( 'type' => 'open', 'name' => 'CSS' ),

	array( 'name' => 'CSS',
		'type' => 'section_open',
	),

		'css' => array( 
			'name' => __( 'Custom CSS', 'wolf' ),
			'desc' => __( 'Want to add any custom CSS code? Put in here, and the rest is taken care of.', 'wolf' ),
			'id' => 'custom_css',
			'type' => 'textarea',
		),

	array( 'type' => 'section_close' ),


array( 'type' => 'close' ),


/*-----------------------------------------------------------------------------------*/
/*  Analytics
/*-----------------------------------------------------------------------------------*/

array( 'type' => 'open', 'name' => __( 'Tracking Code', 'wolf' ) ),
	
	array( 'name' => __( 'Tracking Code', 'wolf' ),
		'type' => 'section_open' ),

	
		array( 'name' => __( 'Tracking Code', 'wolf' ),
			'desc' => __( 'You can paste your <strong>Google Analytics</strong> or other tracking code in this box. 
				<br>Note that your tracking code will not be output when you\'re logged in to not count your own page views.', 'wolf' ),
			'id' => 'tracking_code',
			'type' => 'javascript',
		),

	array( 'type' => 'section_close' ),

		
array( 'type' => 'close' ),


/*-----------------------------------------------------------------------------------*/
/*  Misc
/*-----------------------------------------------------------------------------------*/

array( 
	'type' => 'open', 
	'name' => __( 'Misc', 'wolf'  ) 
),

	array( 
		'name' => __( 'Misc', 'wolf' ),
		'type' => 'section_open',
	),

		array( 
			'name' => __( 'No loader', 'wolf' ),
			'id' => 'no_loader',
			'type' => 'checkbox',
			'desc' => __( 'Disable loading overlay animation.', 'wolf' ),
		),

		array( 
			'name' => __( 'Loading Overlay Color', 'wolf' ),
			'id' => 'overlay_color',
			'type' => 'colorpicker',
		),

		array(

			'name' => __( 'Admin Login Logo', 'wolf' ),
			'id' => 'login_logo',
			'desc' => __( 'Login page logo ( 80px X 80px )', 'wolf' ),
			'type' => 'image',

		),

		array(	
			'name' => __( 'Custom Default Avatar (80px X 80px)', 'wolf' ),
			'id' => 'custom_avatar',
			'desc' => sprintf( __( 'Once uploaded and saved, select your new avatar in the <a href="%s">discussion settings</a>', 'wolf' ), esc_url( admin_url( 'options-discussion.php' ) ) ),
			'type' => 'image',
			'help' => 'custom-avatar'
		),

		array( 
			'name' => __( 'Use minified JS files', 'wolf' ),
			'id' => 'js_min',
			'type' => 'checkbox',
			'desc' => __( 'It can increase performance a little bit. Disable this option if you want to edit the JS files.', 'wolf' ),
		),

	array( 'type' => 'section_close' ),

array( 'type' => 'close' ),

/*-----------------------------------------------------------------------------------*/
/*  Socials
/*-----------------------------------------------------------------------------------*/

	array( 'type' => 'open',  'name' => __( 'Social Links', 'wolf'  ) ),
		
		array( 'name' => __( 'Socials', 'wolf' ),
			'type' => 'section_open',
			'desc' => __( 'Set your social network profile URLs here. The social icons will be automatically displayed in the header', 'wolf' )
		),
	
	//array( 'type' => 'close' ),

); // end theme options array


$socials = array(
		'facebook',
		'twitter',
		'instagram',
		'youtube',
		'vimeo',
		'soundcloud',
		'spotify',
		'myspace',
		'grooveshark',
		'lastfm' ,
		'googleplus',
		'pinterest',
		'tumblr',
		//'skype' ,
		'linkedin',
		'digg',
		'dribbble',
		'deviantart',
		'github',
		'delicious' ,
		'stumbleupon' ,
		'forrst',
		'foursquare',
		'zerply',
		'evernote',
		'behance',
		'500px',
		'feed'
);

$social_fields = array();

foreach ( $socials as $s ) {
	$label =  ucfirst( $s );
	
	$wolf_theme_options[] = array( 
		'name' => $label . ' URL',
		'id' => $s,
		'type' => 'url',
	);
}
$wolf_theme_options[] = array( 
		'name' => 'Skype URL',
		'id' => 'skype',
		'type' => 'text',
	);

	$wolf_theme_options[] = array( 'type' => 'section_close' );

$wolf_theme_options[] = array( 'type' => 'close' );


/*-----------------------------------------------------------------------------------*/
/*  Plugin Settings
/*-----------------------------------------------------------------------------------*/

/* Display this section only if woocommerce or revslider is installed */
if ( 	
	class_exists( 'Wolf_Videos' ) 
	|| class_exists( 'Wolf_Discography' ) 
	|| class_exists( 'WooCommerce' ) 
) {

	$wolf_theme_options[] = array( 'type' => 'open' ,  'name' => __( 'Plugin', 'wolf'  ) );

		$wolf_theme_options[] = array( 'name' => __( 'Plugin Settings', 'wolf' ),
					'type' => 'section_open',
		);

		if ( class_exists( 'WooCommerce' ) ) {
			
			$wolf_theme_options[] =array( 'name' => __( 'Display WooCommerce cart menu item', 'wolf' ),
					'id' => 'cart_menu_item',
					'type' => 'checkbox',
			);
		}

		if ( class_exists( 'Wolf_Videos' ) ) {
			
			$wolf_theme_options[] =array( 'name' => __( 'Open Videos in a lightbox', 'wolf' ),
					'id' => 'video_lightbox',
					'type' => 'checkbox',
			);
		}

		$wolf_theme_options[] = array( 'type' => 'section_close' );

	$wolf_theme_options[] = array( 'type' => 'close' );
}

/* end options */

if ( ! is_child_theme() ) {
	
	$child_theme_message = sprintf(
		__( 'Want to add any custom CSS code? Put in here, and the rest is taken care of. If you need more CSS customization, you should create a <a href="%s" target="_blank">Child Theme</a>', 'wolf' ),
		'http://codex.wordpress.org/Child_Themes'
	);

	$wolf_theme_options['css']['desc'] = $child_theme_message;
}