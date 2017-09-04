<?php
/**
 * Speaker metaboxes
 *
 * Register metabox for the theme with the wolf_do_metaboxes function
 * This function can be overwritten in a child theme
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_do_metaboxes' ) ) {
	/**
	 * Set theme metaboxes
	 *
	 * Allow to add specific style options for each page
	 */
	function wolf_do_metaboxes() {

		$wolf_header_background_metabox = array(

			'background' => array(
					
				'title' => __( 'Section Settings', 'wolf' ),
				'page' => array( 'page' ),

				'metafields' => array(

					array(
						'label'	=> __( 'Small Width', 'wolf' ),
						'id'	=> '_section_small_width',
						'desc'    => __( '740px width max', 'wolf' ),
						'type'	=> 'checkbox',
					),

					array(
						'label'	=> __( 'Full Width', 'wolf' ),
						'id'	=> '_section_full_width',
						'desc'    => __( '92% width', 'wolf' ),
						'type'	=> 'checkbox',
					),

					array(
						'label'	=> __( 'Full Window', 'wolf' ),
						'desc'    => __( 'Will take the full screen width and height', 'wolf' ),
						'id'	=> '_section_full_window',
						'type'	=> 'checkbox',
					),

					array(
						'label'	=> __( 'Hide from menu', 'wolf' ),
						'desc'    => __( 'Won\'t be displayed in the menu', 'wolf' ),
						'id'	=> '_section_menu_hide',
						'type'	=> 'checkbox',
					),

					array(
						'label'	=> __( 'Mosaic Gallery', 'wolf' ),
						'desc'    => __( 'If a gallery is inserted in your post, it will be displayed as a full width mosaic gallery', 'wolf' ),
						'id'	=> '_section_mosaic',
						'type'	=> 'checkbox',
					),

					array(
						'label'	=> __( 'Section Font Color', 'wolf' ),
						'id'	=> '_section_font_color',
						'type'	=> 'select',
						'options' => array(
							'dark' => __( 'Dark', 'wolf' ),
							'light' => __( 'Light', 'wolf' ),
						)
					),

					array(
						'label'	=> __( 'Section Background', 'wolf' ),
						'id'	=> '_section_bg',
						'type'	=> 'background',
						'parallax' => true
					),

					array(
						'label'	=> __( 'Video Background mp4 file', 'wolf' ),
						'id'	=> '_section_video_bg',
						'type'	=> 'file',
					),

					array(
						'label'	=> __( 'Video Background webm file (cross browser fallback)', 'wolf' ),
						'id'	=> '_section_video_bg_webm',
						'type'	=> 'file',
					),

					array(
						'label'	=> __( 'Video Background ogv file (cross browser fallback)', 'wolf' ),
						'id'	=> '_section_video_bg_ogv',
						'type'	=> 'file',
					),

					array(
						'label'	=> __( 'Video Opacity (in percent)', 'wolf' ),
						'id'	=> '_section_video_bg_opacity',
						'type'	=> 'int',
					),

					array(
						'label'	=> __( 'Padding Top', 'wolf' ),
						'id'	=> '_section_padding_top',
						'desc'	=> __( 'e.g : 50px', 'wolf' ),
						'type'	=> 'text'
					),

					array(
						'label'	=> __( 'Padding Bottom', 'wolf' ),
						'id'	=> '_section_padding_bottom',
						'desc'	=> __( 'e.g : 50px', 'wolf' ),
						'type'	=> 'text'
					),

					array(
						'label'	=> __( 'Custom CSS (will be applied on this section only)', 'wolf' ),
						'id'	=> '_section_custom_css',
						'desc'	=> __( 'e.g : h1{ color:red }', 'wolf' ),
						'type'	=> 'textarea',
					),
					
				),

			),

		);

		$wolf_do_header_background_metabox = new Wolf_Theme_Admin_Metabox( $wolf_header_background_metabox );
	} // end function

	wolf_do_metaboxes(); // do metaboxes

} // end function check