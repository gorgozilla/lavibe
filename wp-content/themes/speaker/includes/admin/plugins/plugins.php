<?php
/**
 * Speaker recommended plugins
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

// delete_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice' );

require( WOLF_FRAMEWORK_DIR . '/classes/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'wolf_theme_register_required_plugins' );
function wolf_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'    => 'Wolf Tour Dates',
			'slug'   => 'wolf-tour-dates', 
			'source'   => 'http://plugins.wolfthemes.com/wolf-tour-dates/wolf-tour-dates.zip',
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => 'http://plugins.wolfthemes.com/wolf-tour-dates/wolf-tour-dates.zip',
		),

		array(
			'name'    => 'Wolf Twitter',
			'slug'   => 'wolf-twitter', 
			'source'   => 'http://plugins.wolfthemes.com/wolf-twitter/wolf-twitter.zip',
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => 'http://plugins.wolfthemes.com/wolf-twitter/wolf-twitter.zip',
		),

		array(
			'name'    => 'WolfGram',
			'slug'   => 'wolf-gram', 
			'source'   => 'http://plugins.wolfthemes.com/wolf-gram/wolf-gram.zip',
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => 'http://plugins.wolfthemes.com/wolf-gram/wolf-gram.zip',
		),

		array(
			'name'    => 'Wolf Shortcodes',
			'slug'   => 'wolf-shortcodes', 
			'source'   => 'http://plugins.wolfthemes.com/wolf-shortcodes/wolf-shortcodes.zip',
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => 'http://plugins.wolfthemes.com/wolf-shortcodes/wolf-shortcodes.zip',
		),

		array(
			'name'    => 'Wolf Discography',
			'slug'   => 'wolf-discography', 
			'source'   => 'http://plugins.wolfthemes.com/wolf-discography/wolf-discography.zip',
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => 'http://plugins.wolfthemes.com/wolf-discography/wolf-discography.zip',
		),

		array(
			'name'    => 'Wolf jPlayer',
			'slug'   => 'wolf-jplayer', 
			'source'   => 'http://plugins.wolfthemes.com/wolf-jplayer/wolf-jplayer.zip',
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => 'http://plugins.wolfthemes.com/wolf-jplayer/wolf-jplayer.zip',
		),

		array(
			'name'    => 'Wolf Videos',
			'slug'   => 'wolf-videos', 
			'source'   => 'http://plugins.wolfthemes.com/wolf-videos/wolf-videos.zip',
			'required' => false,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => 'http://plugins.wolfthemes.com/wolf-videos/wolf-videos.zip',
		),

		array(
			'name' 		=> 'WooCommerce',
			'slug' 		=> 'woocommerce',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false,
		)

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'wolf';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',       
	);

	tgmpa( $plugins, $config );
}