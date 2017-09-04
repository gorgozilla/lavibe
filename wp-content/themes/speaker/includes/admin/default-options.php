<?php
/**
 * Speaker default options
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function wolf_theme_default_options_init() {

	$theme_options = get_option( 'wolf_theme_options_' . wolf_get_theme_slug() );

	$default_options = array(

		'home_post_count' => 6,
		'breakpoint' => 1030,
		'logo' => wolf_get_theme_uri( '/images/presets/logo.png' ),

		'home_header_type' => 'full-window',
		'header_bg_font_color' => 'light',
		'header_bg_img' => wolf_get_theme_uri( '/images/presets/header.jpg' ),
		'header_bg_size' => 'cover',
		'header_bg_position' => 'center center',
		'header_bg_parallax' => 'true',
		'header_share' => 'true',

		'video_bg_mp4' => 'http://demo.wolfthemes.com/speaker/wp-content/uploads/sites/10/2014/04/back.mp4',

		'lightbox' => 'swipebox',
		'video_lightbox' => 'true',
		'cart_menu_item' => 'true',

		'facebook' => '#',
		'twitter' => '#',

		'blog_sidebar' => 'true',
		'social_meta' => 'true',
		'show_share_box_single' => 'true',
		'share_text' => 'Share',
		'share_facebook' => 'true',
		'share_twitter' => 'true',
		'share_pinterest' => 'true',
		'share_tumblr' => 'true',
		'share_mail' => 'true',
		'share_img' => wolf_get_theme_uri( '/images/presets/share.jpg' ),

		'custom_font_transform' => 'uppercase',
		'custom_font_weight' => 700,
		'menu_font_transform' => 'uppercase',
		'menu_font_weight' => 700,

		'copyright_textbox' => '&copy; Powered by Wordpress',

		'js_min' => 'true',
	);

	if ( ! $theme_options ) {

		add_option( 'wolf_theme_options_' . wolf_get_theme_slug(), $default_options );
		add_option( '_w_' . wolf_get_theme_slug() . '_version_' . WOLF_THEME_VERSION, '' );
		add_option( '_wolf_discography_page_id', true );
		add_option( '_wolf_videos_page_id', true );
		add_option( '_wolf_portfolio_page_id', true );
		add_option( '_wolf_albums_page_id', true );
	}	

	// woo thumbnails
	$catalog = array(
		'width' 	=> '400',	// px
		'height'	=> '400',	// px
		'crop'	=> 1 		// true
	);
 
	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'	=> 1 		// true
	);
 
	$thumbnail = array(
		'width' 	=> '120',	// px
		'height'	=> '120',	// px
		'crop'	=> 0 		// false
	);
 
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail );
}