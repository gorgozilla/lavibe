<?php
/**
 * Speaker Woocommerce functions
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

add_theme_support( 'woocommerce' ); // add Woocommerce support
add_filter( 'woocommerce_enqueue_styles', '__return_false' ); // disable Woocommerce CSS

if ( ! function_exists( 'loop_columns' ) ) {
	/**
	 * Number of product per row
	 */
	function loop_columns() {

		return 3;
	}
	// add_filter('loop_shop_columns', 'loop_columns');
}