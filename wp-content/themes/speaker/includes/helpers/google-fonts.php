<?php
/**
 * Speaker google font helper
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wolf_google_fonts;
$wolf_google_fonts = array();
// =============================================

$wolf_google_fonts[] = 'Roboto:400,400italic,700,700italic';
$wolf_google_fonts[] = 'Amaranth:400,400italic,700,700italic';
$wolf_google_fonts[] = 'Noto+Serif:400,700,400italic,700italic';
$wolf_google_fonts[] = 'Droid+Sans:400,700';
$wolf_google_fonts[] = 'Open+Sans:400,700';
/**
* You can add your own google font here
*/

// $wolf_google_fonts[] = 'AnyGoogleFont:400,700';

/* Get google font from theme options */
if ( wolf_get_theme_option( 'heading_google_font_code' ) )
	$wolf_google_fonts[] = wolf_get_theme_option( 'heading_google_font_code' );

if ( wolf_get_theme_option( 'menu_google_font_code' ) )
	$wolf_google_fonts[] = wolf_get_theme_option( 'menu_google_font_code' );

if ( wolf_get_theme_option( 'custom_google_font_code' ) )
	$wolf_google_fonts[] = wolf_get_theme_option( 'custom_google_font_code' );

if ( wolf_get_theme_option( 'body_google_font_code' ) )
	$wolf_google_fonts[] = wolf_get_theme_option( 'body_google_font_code' );

if ( wolf_get_theme_option( 'entry_google_font_code' ) )
	$wolf_google_fonts[] = wolf_get_theme_option( 'entry_google_font_code' );


// =============================================

/**
 * Loads our special font CSS file.
 *
 * To disable in a child theme, use wp_dequeue_style()
 * function mytheme_dequeue_fonts() {
 *     wp_dequeue_style( 'wolf-fonts' );
 * }
 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
 *
 */
function wolf_google_fonts() {

	global $wolf_google_fonts;

	if ( $wolf_google_fonts && is_array( $wolf_google_fonts ) && $wolf_google_fonts != array() ) {

		$protocol   = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' 	=> implode( '|', $wolf_google_fonts ),
			'subset' => 'latin,latin-ext', // can be changed to cyrilic or greek
		);

		wp_enqueue_style( 'wolf-theme-google-fonts', esc_url( add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ) ), array(), null );
	}
}
add_action( 'wp_enqueue_scripts', 'wolf_google_fonts' );
