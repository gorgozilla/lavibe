<?php
/**
 * Print custom CSS set up in the theme options
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Inline CSS with the theme options
 */
function wolf_theme_options_css() {

	$css = '';

	/*-----------------------------------------------------------------------------------*/
	/*  Header Background
	/*-----------------------------------------------------------------------------------*/
	$selector = '.site-header';
	$url = null;
	$img        = wolf_get_theme_option( 'header_bg_img' );
	$color      = wolf_get_theme_option( 'header_bg_color' );
	$repeat     = wolf_get_theme_option( 'header_bg_repeat' );
	$position   = wolf_get_theme_option( 'header_bg_position' );
	$attachment = wolf_get_theme_option( 'header_bg_attachment' );
	$size       = wolf_get_theme_option( 'header_bg_size' );
	$parallax   = wolf_get_theme_option( 'header_bg_parallax' );

	if ( $img )
		$url = 'url("'. $img .'")';

	if ( $color || $img ) {

		if ( $parallax ) {

			$css .= "$selector {background : $color $url $repeat fixed}";
			$css .= "$selector {background-position : 50% 0}";

		} else {
			$css .= "$selector {background : $color $url $position $repeat $attachment}";
		}

		if ( $size == 'cover' ) {

				$css .= "$selector {
					-webkit-background-size: 100%;
					-o-background-size: 100%;
					-moz-background-size: 100%;
					background-size: 100%;
					-webkit-background-size: cover;
					-o-background-size: cover;
					background-size: cover;
				}";
			}

		if ( $size == 'resize' ) {

			$css .= "$selector {
				-webkit-background-size: 100%;
				-o-background-size: 100%;
				-moz-background-size: 100%;
				background-size: 100%;
			}";
		}
	}

	/*-----------------------------------------------------------------------------------*/
	/*  header font color
	/*-----------------------------------------------------------------------------------*/
	$header_bg_font_color = wolf_get_theme_option( 'header_bg_font_color' );

	if ( 'light' == $header_bg_font_color ) {

		$header_selector = '.site-header';

		$css .= "
			#menu-toggle,
			#search-toggle{
				color:white!important;
				text-shadow: 0 0 2px rgba(0,0,0,0.8);
			}

			$header_selector{
				color:white;
				text-shadow: 0 0 2px rgba(0,0,0,0.8);
			}

			$header_selector h1,
			$header_selector h2,
			$header_selector h3,
			$header_selector h4,
			$header_selector h5,
			$header_selector h6,
			$header_selector p{
				color:white;
				text-shadow: 0 0 2px rgba(0,0,0,0.8);
			}

			#one-page-menu li a,
			#one-page-menu li a.home-menu-item.active,
			$header_selector #header-socials a{
				color:white;
			}

			$header_selector, $header_selector h1, $header_selector h2, $header_selector h3, $header_selector h4,
			$header_selector h1 a, $header_selector h2 a, $header_selector h3 a, $header_selector h4 a, $header_selector h5 a,
			$header_selector .category-description{
				color:#fff;
			}

			$header_selector .theme-button-2,
			$header_selector .button-alt,
			$header_selector .button-alt-big{
				color:#fff!important;
				border-color:#fff;
			}

			$header_selector .entry-title a, $header_selector .widget-entry .widget-entry-title a{
			color:#fff;
			}

			$header_selector hr{
			background: rgba(255,255,255,0.05);
			}

			$header_selector td{
				border-bottom: 4px solid rgba(255,255,255,0.05);
			}

			$header_selector .wolf-tweet-time_big a, $header_selector .wolf-tweet-time_big a:hover{
				color:#f7f7f7;
			}

			$header_selector .wolf-last-post-summary a.more-link:hover{
					color:#fff!important;
				}

			$header_selector .widget_calendar #prev a:hover,
			$header_selector .widget_calendar #next a:hover{
				color:#fff!important;
			}

			$header_selector .wolf-show-entry-link{
				color:#fff;
			}

			";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Heading Font
	/*-----------------------------------------------------------------------------------*/

	$heading_font = wolf_get_theme_option( 'heading_google_font_name' );

	if ( $heading_font ){
		$css .= "h1, h2, h3, h4, h5, h2.entry-title, .widget-title{font-family:'$heading_font'}";
	}

	$heading_font_weight = wolf_get_theme_option( 'heading_font_weight' );

	if ( $heading_font_weight ){
		$css .= "h1, h2, h3, h4, h5, h2.entry-title, .widget-title{font-weight:$heading_font_weight}";
	}

	$heading_font_transform = wolf_get_theme_option( 'heading_font_transform' );

	if ( 'uppercase' == $heading_font_transform ){
		$css .= "h1, h2, h3, h4, h5, h2.entry-title, .widget-title{text-transform:uppercase}";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Menu Font
	/*-----------------------------------------------------------------------------------*/

	$menu_font = wolf_get_theme_option( 'menu_google_font_name' );

	if( $menu_font ){
		$css .= ".nav-menu{ font-family:'$menu_font'}";
	}

	$menu_font_weight = wolf_get_theme_option( 'menu_font_weight' );

	if( $menu_font_weight ){
		$css .= ".nav-menu{font-weight:$menu_font_weight}";
	}

	$menu_font_transform = wolf_get_theme_option( 'menu_font_transform' );

	if ( 'uppercase' == $menu_font_transform ){
		$css .= ".nav-menu{text-transform:uppercase}";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Custom Font
	/*-----------------------------------------------------------------------------------*/

	$custom_font = wolf_get_theme_option( 'custom_google_font_name' );

	if ( $custom_font ){
		$css .= ".custom-font{font-family:'$custom_font'}";
	}

	$custom_font_weight = wolf_get_theme_option( 'custom_font_weight' );

	if ( $custom_font_weight ){
		$css .= ".custom-font{font-weight:$custom_font_weight}";
	}

	$custom_font_transform = wolf_get_theme_option( 'custom_font_transform' );

	if ( 'uppercase' == $custom_font_transform ){
		$css .= ".custom-font{text-transform:uppercase}";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Body Font
	/*-----------------------------------------------------------------------------------*/

	$body_font = wolf_get_theme_option( 'body_google_font_name' );

	if( $body_font ){
		$css .= "body,
		.woocommerce .woocommerce-ordering,
		.woocommerce-page .woocommerce-ordering,
		.woocommerce .woocommerce-tabs ul.tabs li,
		.woocommerce-page .woocommerce-tabs ul.tabs li,
		.share-box .share-title,
		.author-description p,
		.flexslider .flex-caption,
		.wolf-bigtweet-content span.wolf-tweet-text,
		#posts-front-page .entry-content
		{font-family:'$body_font'}";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Entry Font
	/*-----------------------------------------------------------------------------------*/

	$entry_font = wolf_get_theme_option( 'entry_google_font_name' );

	if( $entry_font ){
		$css .= ".entry-content, #container, .comment-content{font-family:'$entry_font'}";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Overlay Color
	/*-----------------------------------------------------------------------------------*/

	$overlay = wolf_get_theme_option( 'overlay_color' );

	if ( $overlay ) {

		$css .= "#overlay{background:$overlay}";

	}

	/*-----------------------------------------------------------------------------------*/
	/*  Custom CSS
	/*-----------------------------------------------------------------------------------*/

	if ( wolf_get_theme_option( 'custom_css' ) ) {
		$css .= stripslashes( wolf_get_theme_option( 'custom_css' ) );
	}

	if ( WOLF_DEBUG ) {
		return $css;
	} else {
		return wolf_compact_css( $css );
	}
} // end function

if ( ! function_exists( 'wolf_output_header_parallax_js' ) ) {
	/**
	 * Parallax
	 */
	function wolf_output_header_parallax_js() {

		global $wolf_custom_options_css;
		$js = '';

		if (
			wolf_get_theme_option( 'header_bg_parallax' )
			&& wolf_is_one_paged()
			&& 'full-video' != wolf_get_theme_option( 'home_header_type' )
			&& 'video' != wolf_get_theme_option( 'home_header_type' )
		) {
			$js .= '$( "#masthead" ).addClass( "section-parallax" );';
		}

		$js .= "\n\n";

		if ( $js )
			return '<script type="text/javascript">jQuery(document).ready(function($) {' . $js . '});</script>'."\n";
	}
}

/**
 * Output the custom CSS
 */
function wolf_output_theme_options_css() {
	echo '<style>';
	echo '/* Theme Options */' . "\n";
    	echo wolf_theme_options_css();
    	echo '</style>';
    	echo wolf_output_header_parallax_js();
}
add_action( 'wp_head', 'wolf_output_theme_options_css' );