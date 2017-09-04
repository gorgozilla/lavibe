<?php
/**
 * Speaker customizer options
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $customizer_options;
$customizer_options = array(

	'presets' => array(

		'id' => 'presets',
		'title' => __( 'Presets', 'wolf' ),
		'desc' => __( 'The skin presets will update your layout options but keep your uploaded background images.', 'wolf' ),
		'options' => array(

			'skin' => array(

				'id' => 'skin',
				'label' => __( 'Preset Skins', 'wolf' ),
				'type' => 'skins',
				'default' => 'dark',
				'choices' => array(
					//'light' => __( 'light', 'wolf' ),
					'dark' => __( 'dark', 'wolf' ),
				),
				'transport' => 'postMessage',
			),
		),
	),

	'main' => array(

		'id' => 'main',
		'title' => __( 'Accent Color', 'wolf' ),
		'desc' => __( 'The accent color used for links and keypoints', 'wolf' ),
		'options' => array(

			'accent_color' => array(

				'id' => 'accent_color',
				'label' => __( 'Accent Color', 'wolf' ),
				'type' => 'color',
			),
		),
	),

	'page' => array(
		'id' => 'page',
		'title' => __( 'Page', 'wolf' ),
		'desc' => __( 'The main content area visible on standard pages', 'wolf' ),
		
		'options' => array(

			'page_bg' => array(
				'id' =>'page_bg',
				'desc' => __( 'The main page content that is visible on standard page', 'wolf' ),
				'label' => __( 'Page Content', 'wolf' ),
				'type' => 'background',
			),
		),
	),

	'site_footer_bg' => array(
		'id' =>'site_footer_bg',
		'label' => __( 'Footer', 'wolf' ),
		'background' => true,
		'font_color' => false,

	),
);

if ( function_exists( 'wolf_music_network' ) ) {
	$customizer_options['music_network_bg'] = array(

		'id' =>'music_network_bg',
		'desc' => __( 'The music logos area at the bottom of the page.', 'wolf' ),
		'label' => __( 'Music Network background', 'wolf' ),
		'background' => true,
		'font_color' => false,
	);
}

if ( class_exists( 'Wolf_Theme_Customizer' ) && is_user_logged_in() ) {
	new Wolf_Theme_Customizer( $customizer_options );
}