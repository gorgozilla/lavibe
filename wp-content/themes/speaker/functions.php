<?php
/**
 * The main functions file
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

/**
 * Set up the content width value based on the theme's design.
 */
if ( ! isset( $content_width ) )
	$content_width = 1140;

/**
 *  Require the framework core file to do the magic
 */
require_once get_template_directory() . '/wp-wolf-framework/wp-wolf-core.php';

/**
 * We use the Wolf_Theme class to set the theme settings in an array (wp-wolf-framework/wolf-core.php).
 */
$wolf_theme = array(

	/* Menus (id => name) */
	'menus' => array(
		'primary' => 'Main Menu',
	),

	/**
	 *  The thumbnails :
	 *  We define wordpress thumbnail sizes that we will use in our design
	 */
	'images' => array(

		/**
		 *  max width, max height, true|false -> hardcrop or not
		 */

		// Default post image
		'image-thumb' => array( 740, 1000, false ),

		// Release thumb
		'item-thumb' => array( 410, 410, true ),

		// Slides & gallery
		'post-slide' => array( 800, 400, true ),
		'photo-bg' =>  array( 800, 1000, false ),
		'slide' => array( 1200, 1000, false ),
		'gallery-thumb' => array( 300, 250, true ),
		'gallery-big-thumb' => array( 525, 348, true ),

		// Masonry Gallery
		'masonry-thumb' => array( 410, 700, false ),

		// Overwrite portfolio plugin thumb image size
		'portfolio-thumb' => array( 420, 560, true ),
		'portfolio-video-thumb' => array( 270, 360, true ),

		// Large
		'large' => array( 1140, 960, false ),

		// Big image
		'extra-large' => array( 1920, 1280, false ),

		// RSS image
		'archive-thumb' => array( 400, 300, false ),
	),
);
$wolf_do_theme = new Wolf_Framework( $wolf_theme );

// add_filter('show_admin_bar', '__return_false'); // used for debug

// Recommend plugins with TGM plugins activation
include( 'includes/admin/plugins/plugins.php' );