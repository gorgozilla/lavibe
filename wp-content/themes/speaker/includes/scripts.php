<?php
/**
 * Speaker Scripts
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_enqueue_scripts' ) ) {
	/**
	 * Register theme scripts for Speaker
	 *
	 * We will use the wp_enqueue_scripts function in framework/wolf-core.php to enqueue scripts
	 *
	 */
	function wolf_enqueue_scripts() {

		// Ensure to overwrite scripts enqueued by a plugin
		wp_dequeue_script( 'flexslider' );
		wp_deregister_script( 'flexslider' );

		wp_dequeue_script( 'swipebox' );
		wp_deregister_script( 'swipebox' );
		
		// Register theme script dependencies
		wp_register_script( 'isotope', WOLF_THEME_URL . '/js/lib/isotope.pkgd.min.js', 'jquery', '2.0.1', true );
		wp_register_script( 'imageloaded', WOLF_THEME_URL . '/js/lib/imagesloaded.pkgd.min.js', 'jquery', '3.1.8', true );
		wp_register_script( 'parallax', WOLF_THEME_URL . '/js/lib/jquery.parallax.min.js', 'jquery', '1.1.3', true );
		wp_register_script( 'flexslider', WOLF_THEME_URL . '/js/lib/jquery.flexslider.min.js', 'jquery', '2.2.2', true );
		wp_register_script( 'swipebox', WOLF_THEME_URL . '/js/lib/jquery.swipebox.min.js', 'jquery', '1.2.9', true );
		wp_register_script( 'fancybox', WOLF_THEME_URL . '/js/lib/jquery.fancybox.pack.js', 'jquery', '2.1.5', true );
		wp_register_script( 'fancybox-media', WOLF_THEME_URL.'/js/lib/jquery.fancybox-media.js', 'jquery', '1.0.6', true );
		wp_register_script( 'speaker', WOLF_THEME_URL . '/js/jquery.functions.js', 'jquery', WOLF_THEME_VERSION, true );
		
		// Register theme specific scripts
		if ( wolf_get_theme_option( 'js_min' ) ) {
			wp_register_script( 'gallery', WOLF_THEME_URL . '/js/min/jquery.gallery.min.js', 'jquery', WOLF_THEME_VERSION, true );
			wp_register_script( 'speaker', WOLF_THEME_URL . '/js/min/jquery.functions.min.js', 'jquery', WOLF_THEME_VERSION, true );
		} else {
			wp_register_script( 'gallery', WOLF_THEME_URL . '/js/jquery.gallery.js', 'jquery', WOLF_THEME_VERSION, true );
			wp_register_script( 'speaker', WOLF_THEME_URL . '/js/jquery.functions.js', 'jquery', WOLF_THEME_VERSION, true );
		}

		// Add JS global variables
		wp_localize_script(
			'speaker', 'WolfThemeParams', array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'headerPercent' => wolf_get_theme_option( 'home_header_height', 60 ),
				'homeHeaderType' => wolf_get_theme_option( 'home_header_type' ),
				'breakPoint' => wolf_get_theme_option( 'breakpoint', 900 ),
				'videoLightbox' => wolf_get_theme_option( 'video_lightbox' ),
				'lightbox' => wolf_get_theme_option( 'lightbox' ),
				'doNotSmoothScroll' => wolf_get_theme_option( 'no_smooth_scroll' ),
			)
		);

		// Enqueue theme scripts
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'parallax' );
		wp_enqueue_script( 'flexslider' );

		// Enqueue Isotope on main page and gallery single pages
		if ( wolf_is_one_paged() || is_singular( 'gallery' ) || is_page_template( 'page-templates/section.php' ) ) {
			wp_enqueue_script( 'imageloaded' );
			wp_enqueue_script( 'isotope' );
		}

		// Enqueue scripts conditionaly for the gallery
		if ( is_singular( 'gallery' ) ) {
			wp_enqueue_script( 'imageloaded' );
			wp_enqueue_script( 'gallery' );
		}

		// Check lightbox option
		if ( 'swipebox' == wolf_get_theme_option( 'lightbox' ) ) {

			wp_enqueue_script( 'swipebox' );

		} elseif ( 'fancybox' == wolf_get_theme_option( 'lightbox' ) ) {
			
			wp_enqueue_script( 'fancybox' );
			wp_enqueue_script( 'fancybox-media');
		}
		
		// Enqueue main theme script
		wp_enqueue_script( 'speaker' );
		
		// loads the javascript required for threaded comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) 
			wp_enqueue_script( 'comment-reply' );

	}
	add_action( 'wp_enqueue_scripts', 'wolf_enqueue_scripts' );
} // end function check