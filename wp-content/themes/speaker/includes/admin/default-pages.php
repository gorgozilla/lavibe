<?php
/**
 * Set Speaker default pages
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

$default_pages = array();

if ( isset( $_GET['wolf-default-pages'] ) && $_GET['wolf-default-pages'] == 'true' ) {


	$home_page_content = 'This is the standard home page. You can see this text if you choose the default page template for your home page. To display the sections, choose the "One-Page" template and set this page as front page in the Wordpress "Reading" settings.';

	if ( class_exists( 'Wolf_Shortcodes' ) && class_exists( 'Wolf_Jplayer' ) ) {
	$media_section_content = '[wolf_col_6 class="first"]

http://vimeo.com/kimholm/rtf

[/wolf_col_6]

[wolf_col_6 class="last"]

[wolf_jplayer_playlist id="1"]

[/wolf_col_6]';

	} elseif ( class_exists( 'Wolf_Jplayer' ) ) {

		$media_section_content = '[wolf_jplayer_playlist id="1"]';

	} else {
		$media_section_content = 'http://vimeo.com/kimholm/rtf';
	}	 
	
	$photos_section_content = '<p style="text-align:center;">Insert a gallery in this page and select the "Mosaic Gallery" option.</p>
<p style="text-align:center;"><img src="' . WOLF_THEME_URL . '/images/help/mosaic-gallery.jpg' . '"></p>';

$about_section_content = "<h5>Speaker. The Best One Page Music Wordpress Theme.</h5>
Speaker is a music oriented one-page Wordpress theme. When you don't have a lot of content to show, a one page website is the best way to go. It is perfect to present your band or your brand online in an elegant way. Your featured playlist, your discography, tour dates, last photos and videos, your merchandising... the visitors can immediately check the most important informations.
<h5>Customize your page</h5>
Give this theme your own feel is very easy. For each sections, you can set your own background, your color tone and even set a cool video as background. You can put any content in your sections and re-order them very easily.
<h5>Speaker as standard website.</h5>
Even if speaker is built as a one page theme in the first place, it can be easily used as a standard website. There is nothing special you have to do or think of. Simply choose the right template for your page and the rest is taken care of. Anyway, all is explained in the theme documentation. Nothing fancy. Even if you're not familar with wordpress, you will be able to build a cool website without thinking about the technical kaboodle.";

	$default_pages['Home'] = array(
		'title' => 'Home',
		'post_type' => 'page',
		'content' => $home_page_content,
		'template' => 'page-templates/one-page.php',
		'meta' => array(
			'_section_position' => 0,
		),
	);

	$default_pages['Medias'] = array(
		'title' => 'Medias',
		'post_type' => 'page',
		'content' => $media_section_content,
		'template' => 'page-templates/section.php',
		'meta' => array(
			'_section_position' => 1,
			'_section_full_window' => 'true',
			'_section_font_color' => 'light',
			'_section_bg_color' => '#0d0d0d',
			'_section_bg_img' => WOLF_THEME_URL . '/images/presets/medias-bg.jpg',
			'_section_bg_repeat' => 'no-repeat',
			'_section_bg_size' => 'cover',
			'_section_bg_attachment' => 'fixed',
			'_section_bg_parallax' => 'true',
		),
	);

	$default_pages['News'] = array(
		'title' => 'News',
		'post_type' => 'page',
		'content' => '',
		'template' => 'page-templates/section.php',
		'meta' => array(
			'_section_position' => 2,
			'_section_font_color' => 'dark',
		),
	);

	if ( class_exists( 'Wolf_Discography' ) ) {
		
		$default_pages['Releases'] = array(
			'title' => 'Releases',
			'post_type' => 'page',
			'content' => '[wolf_last_releases col="4" count="8"]',
			'template' => 'page-templates/section.php',
			'meta' => array(
				'_section_position' => 3,
				'_section_font_color' => 'light',
				'_section_bg_color' => '#0d0d0d',
				'_section_bg_img' => WOLF_THEME_URL . '/images/presets/dark-bg.png',
				'_section_bg_repeat' => 'repeat',
				'_section_bg_size' => 'normal',
				'_section_bg_attachment' => 'fixed',
			),
		);
	}

	$default_pages['Photos'] = array(
		'title' => 'Photos',
		'post_type' => 'page',
		'content' => $photos_section_content,
		'template' => 'page-templates/section.php',
		'meta' => array(
			'_section_position' => 4,
			'_section_font_color' => 'light',
			'_section_bg_color' => '#333',
		),
	);

	if ( class_exists( 'Wolf_Videos' ) ) {
		
		$default_pages['Videos'] = array(
			'title' => 'Videos',
			'post_type' => 'page',
			'content' => '[wolf_last_videos count="8" col="4"]',
			'template' => 'page-templates/section.php',
			'meta' => array(
				'_section_position' => 5,
				'_section_full_width' => 'true',
				'_section_font_color' => 'dark',
			),
		);
	}

	if ( class_exists( 'Wolf_Tour_Dates' ) ) {
		
		$default_pages['Tour Dates'] = array(
			'title' => 'Tour Dates',
			'post_type' => 'page',
			'content' => '[wolf_tour_dates past="false"]',
			'template' => 'page-templates/section.php',
			'meta' => array(
				'_section_position' => 6,
				'_section_font_color' => 'light',
				'_section_bg_color' => '#0d0d0d',
				'_section_video_bg' => 'http://media.wolfthemes.com/theme-previews/speaker/back.mp4',
				'_section_video_bg_opacity' => 30,
			),
		);
	}
	
	if ( class_exists( 'WooCommerce' ) ) {
		
		$default_pages['Merch'] = array(
			'title' => 'Merch',
			'post_type' => 'page',
			'content' => '[recent_products per_page="4"]',
			'template' => 'page-templates/section.php',
			'meta' => array(
				'_section_position' => 7,
				'_section_font_color' => 'dark',
			),
		);
	}

	$default_pages['About'] = array(
		'title' => 'About',
		'post_type' => 'page',
		'content' => $about_section_content,
		'template' => 'page-templates/section.php',
		'meta' => array(
			'_section_position' => 8,
			'_section_small_width' => 'true',
			'_section_full_window' => 'true',
			'_section_font_color' => 'light',
			'_section_bg_color' => '#333',
			'_section_bg_img' => WOLF_THEME_URL . '/images/presets/about-us-bg.jpg',
			'_section_bg_repeat' => 'no-repeat',
			'_section_bg_size' => 'cover',
			'_section_bg_attachment' => 'fixed',
			'_section_bg_parallax' => 'true',
		),
	);

	if ( defined( 'WPCF7_PLUGIN_DIR' ) ) {
		
		$default_pages['Contact'] = array(
			'title' => 'Contact',
			'post_type' => 'page',
			'content' => '
For booking or any other information, feel free to get in touch!

[contact-form-7 id="1" title="Contact form 1"]',
			'template' => 'page-templates/section.php',
			'meta' => array(
				'_section_position' => 9,
				'_section_small_width' => 'true',
				'_section_font_color' => 'light',
				'_section_bg_color' => '#0d0d0d',
				'_section_bg_img' => WOLF_THEME_URL . '/images/presets/dark-bg.png',
				'_section_bg_repeat' => 'repeat',
				'_section_bg_size' => 'normal',
				'_section_bg_attachment' => 'fixed',
			),
		);
	}

} // end isset default pages

$wolf_do_default_pages = new Wolf_Theme_Admin_Default_Pages( $default_pages );