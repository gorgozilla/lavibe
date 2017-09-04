<?php
/**
 * Speaker sidebars
 *
 * Register default sidebar for the theme with the wolf_sidebars_init function
 * This function can be overwritten in a child theme
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_sidebars_init' ) ) {
	/**
	 * Register footer widget area and main sidebar
	 *
	 * Add a shop sidebar if WooCommerce is installed
	 *
	 */
	function wolf_sidebars_init() {

		// Main Sidebar
		register_sidebar(
			array(
				'name'          => __( 'Main Sidebar', 'wolf' ),
				'id'            => 'sidebar-main',
				'description'   => __( 'Appears on pages that support a sidebar', 'wolf' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  => '</div></aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// Footer Sidebar
		register_sidebar(
			array(
				'name'          => __( 'Footer Widget Area', 'wolf' ),
				'id'            => 'sidebar-footer',
				'description'   => __( 'Appears in the footer section of the site (supports 4 widgets)', 'wolf' ),
				'before_widget' => '<aside id="%1$s" class="col-3 widget %2$s"><div class="widget-content">',
				'after_widget'  => '</div></aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// Woocommerce Siderbar
		// if ( class_exists( 'Woocommerce' ) ) {
		// 	register_sidebar(
		// 		array(
		// 			'name'          => __( 'Shop Sidebar', 'wolf' ),
		// 			'id'            => 'sidebar-shop',
		// 			'description'   => __( 'Appears in Woocommerce single product pages', 'wolf' ),
		// 			'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="widget-content">',
		// 			'after_widget'  => '</div></aside>',
		// 			'before_title'  => '<h3 class="widget-title">',
		// 			'after_title'   => '</h3>',
		// 		)
		// 	);
		// }
	}
	add_action( 'widgets_init', 'wolf_sidebars_init' );
} // end function check