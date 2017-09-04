<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Wolf_Shortcodes_Button_Colors_Mixins' ) ) {
/**
 * Button Color Mixins Class
 *
 * Contains the main functions for Wolf_Shortcodes_Button_Mixins
 *
 * @class Wolf_Shortcodes_Button_Mixins
 * @version 1.4.9
 * @since 1.4.9
 * @package WolfShortcodes
 * @author WpWolf
 */

class Wolf_Shortcodes_Button_Colors_Mixins{


	/**
	 * Convert a hex color to rgb format
	 */
	public function hex_to_rgb( $hex ) {
		
		$hex = str_replace( "#", "", $hex );

		if ( strlen( $hex ) == 3) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex,0,1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex,1,1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex,2,1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = array( $r, $g, $b );
		return implode( ",", $rgb ); // returns the rgb values separated by commas
		//return $rgb; // returns an array with the rgb values
	}


	/**
	 * 
	 */
	public function brightness( $hex, $percent ) {

		$steps = ( ceil( ( $percent*200 ) / 100 ) ) * 2;

		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max( -255, min( 255, $steps ) );

		// Format the hex color string
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$hex = str_repeat( substr( $hex,0,1 ), 2 ).str_repeat( substr( $hex,1,1 ), 2 ).str_repeat( substr( $hex, 2, 1 ), 2 );
		}

		// Get decimal values
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );

		// Adjust number of steps and keep it inside 0 to 255
		$r = max( 0, min( 255, $r + $steps ) );
		$g = max( 0, min( 255, $g + $steps ) );  
		$b = max( 0, min( 255, $b + $steps ) );

		$r_hex = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
		$g_hex = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
		$b_hex = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

		return '#' . $r_hex . $g_hex . $b_hex;
	}


	public function flat_button( $color = null ) {

		if ( ! $color )
			return;

		$css = 'box-shadow : 0 4px 0 ' . $this->brightness( $color, -15% ) ) . ';';
		$css .= '-webkit-box-shadow : 0 4px 0 ' . $this->brightness( $color, -15% ) ) . ';';
		$css .= '-o-box-shadow : 0 4px 0 ' . $this->brightness( $color, -15% ) ) . ';';


		return $this->compact_css( $css );

	}


	/**
	 * Remove spaces in inline CSS
	 */
	public function compact_css( $css  ) {

		return preg_replace( '/\s+/', ' ', $css );

	}

} // end class



} // end class check