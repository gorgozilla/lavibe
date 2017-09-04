<?php
/**
 * Speaker Customizer CSS
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

 function wolf_get_customizer_bg_options( $selectors = array() ) {

	$css = '';
	
	foreach ( $selectors as $id => $selector ) {
		
		$img = '';
		$color = get_theme_mod( $id . '_color' );
		$repeat = get_theme_mod( $id . '_repeat' );
		$position = get_theme_mod( $id . '_position' );
		$attachment = get_theme_mod( $id . '_attachment' );
		$size = get_theme_mod( $id . '_size' );
		$none = get_theme_mod( $id . '_none' );
		$parallax = get_theme_mod( $id . '_parallax' );
		$opacity = intval(get_theme_mod( $id . '_opacity', 100 )) / 100;
		$color_rgba = 'rgba(' . wolf_hex_to_rgb( $color ) . ', ' . $opacity .')';
	
		/* Backgrounds
		---------------------------------*/
		if ( '' == $none ) {
			
			if ( get_theme_mod( $id . '_img' ) )
				$img = 'url("'. get_theme_mod( $id . '_img' ) .'")';

			if ( $color || $img ) {
				
				if ( ! $img ) {
					$css .= "$selector {background-color:$color;background-color:$color_rgba;}";
				}
	
				if ( $img )  {

					if ( $parallax ) {

						$css .= "$selector {background : $color $img $repeat fixed}";
						$css .= "$selector {background-position : 50% 0}";

					} else {
						$css .= "$selector {background : $color $img $position $repeat $attachment}";
					}
					
					if ( 'cover' == $size ) {

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

					if ( 'resize' == $size ) {

						$css .= "$selector {
							-webkit-background-size: 100%; 
							-o-background-size: 100%; 
							-moz-background-size: 100%; 
							background-size: 100%;
						}";
					}	
				}
			} 
		} else {
			$css .= "$selector {background:none;}";
		}

	} // end foreach selectors
	
	return $css;
}

/**
 * Inline CSS with the customizer options
 */
function wolf_customizer_css() {

	$css = '';

	$accent = get_theme_mod( 'accent_color' );

	if ( $accent ) {

		$css .= "
		
		a, .themecolor,
		h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover,
		.entry-link:hover,
		.wolf-show-flyer:hover,
		.wolf-show-entry-link:hover,
		#one-page-menu li a:hover,
		#one-page-menu li a.active,
		.comment-reply-link, .album-thumb p, .wolf-bigtweet-content a,
		.site-footer a:hover{ color:$accent; }
		
		.entry-link:hover, .entry-meta a:hover, .edit-link a:hover,
		#main .wolf-show-entry-link:hover,
		#one-page-menu li a.home-menu-item:hover,
		#header-socials a:hover{color:$accent!important; }

		#one-page-menu li.menu-item-has-children:hover > a,
		#one-page-menu li ul.sub-menu li a,
		#one-page-menu li ul.children li a{
			background-color: $accent;
			color: #FFF!important;
		}

		.mejs-container .mejs-controls .mejs-time-rail .mejs-time-current,
		.mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
		  background: $accent !important;
		}


		.button-alt:hover,
		.button-alt-light:hover,
		.button-alt-big:hover,
		.button-alt-light-big:hover{
			background-color:$accent!important;
			border-color : $accent!important;
		}

		.button,
		.button-big,
		input[type='submit']{
			background-color:$accent!important;
		}

		.button,
		input[type='submit']{
			box-shadow: 0 4px 0 " . wolf_color_brightness( $accent, -15 ) . "!important;
		}

		.button-big{
			box-shadow: 0 6px 0 " . wolf_color_brightness( $accent, -15 ) . "!important;
		}

		.button:hover,
		input[type='submit']:hover{
			box-shadow: 0 2px 0 " . wolf_color_brightness( $accent, -15 ) . "!important;
		}

		.button-big:hover{
			box-shadow: 0 4px 0 " . wolf_color_brightness( $accent, -15 ) . "!important;
		}

		.button:active,
		.button:focus,
		input[type='submit']:active,
		input[type='submit']:focus,
		.button-big:active,
		.button-big:focus{
			box-shadow: 0 0 0 " . wolf_color_brightness( $accent, -15 ) . "!important;
		}

		#work-filter li a:hover, 
		#videos-filter li a:hover, 
		#albums-filter li a:hover,
		#work-filter li a.active, 
		#videos-filter li a.active, 
		#albums-filter li a.active{
			background-color:$accent!important;
			border-color : $accent!important;
		}

		.nav-previous:hover, .nav-links a[rel='prev']:hover, .previous:hover,
		.nav-next:hover, .nav-links a[rel='next']:hover, .next:hover,
		.pagination ul.page-numbers li .page-numbers.current,
		.woocommerce-pagination ul.page-numbers li .page-numbers.current {background-color: $accent!important;}
		.pagination ul.page-numbers li .page-numbers.current,
		.woocommerce-pagination ul.page-numbers li .page-numbers.current {border-color:$accent}

		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle{
			background:" . wolf_color_brightness( $accent, -5 ) . ";
		}

		.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
		.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,
		.woocommerce span.onsale,
		.woocommerce-page span.onsale,
		.woocommerce .woocommerce-tabs .panel,
		.woocommerce-page .woocommerce-tabs .panel,
		.woocommerce .woocommerce-tabs ul.tabs li.active,
		.woocommerce-page .woocommerce-tabs ul.tabs li.active{
			background:$accent;
		}

		.wolf-mailchimp .site-footer .widget_mailchimpsf_widget #mc_signup_submit:active,
		.wolf-mailchimp .site-footer .widget_mailchimpsf_widget #mc_signup_submit:hover,
		.wolf-mailchimp .site-footer .widget_mailchimpsf_widget #mc_signup_submit:focus{
			background-color:$accent!important;
			border-color : $accent!important;
		}

		.cart-menu-panel{
			background-color:$accent!important;
		}
		.cart-menu-item:hover a{
			background-color:$accent!important;
		}

		.wolf-release-buttons a:hover{
			color:$accent!important; 
		}
		";
	}

	/*-----------------------------------------------------------------------------------*/
	/*  Main Font Color
	/*-----------------------------------------------------------------------------------*/
	
	$font_color = get_theme_mod( 'page_bg_font_color' );

	if ( 'light' == $font_color ) {

		$css .= "
		.share-box .share-link:before{
			color:#fff;
		}

		.comment-list > li:after,
		.comment-list .children > li:before{
			background:rgba(255,255,255,0.05)
		}

		#main h1, #main h2, #main h3, #main h4,
		#main h1 a, #main h2 a, #main h3 a, #main h4 a, #main h5 a{
			color:#fff;
		}

		#main .entry-title a, #main .widget-entry .widget-entry-title a{
			color:#fff;
		}

		#main hr{
			background: rgba(255,255,255,0.05);
		}

		#main td{
			border-bottom: 4px solid rgba(255,255,255,0.05);
		}

		#main .wolf-tweet-time_big a, #main .wolf-tweet-time_big a:hover{
			color:#f7f7f7;
		}

		#main .wolf-last-post-summary a.more-link:hover{
			color:#fff!important;
		}

		#main .widget_calendar #prev a:hover,
		#main .widget_calendar #next a:hover{
			color:#fff!important;
		}

		#main .wolf-show-entry-link{
			color:#fff;
		}

		.comment-meta .fn, .comment-meta .fn a{
			color:#fff;
		}

		#work-filter-container #work-filter li a,  
		#videos-filter-container #videos-filter li a,
		#albums-filter-container  #albums-filter li a,
		#plugin-filter ul li a{
			color:#fff;
			border-color:#fff;
		}

		#main blockquote{
			color:#fff;
		}

		#main{
			color:#f7f7f7;
		}

		.entry-content a, .comment-content a{
			color:#fff;
		}

		#main .work-thumbnail .work-title{
			color:#fff!important;
		}

		.pagination ul.page-numbers li .page-numbers,
		.woocommerce-pagination ul.page-numbers li .page-numbers {
			background:white;
		}
	";

	}

	$backgrounds = array(
		'body_bg' => 'body',
		'page_bg' => '#main',
		'menu_bg' => '#navbar',
		'site_footer_bg' => '#colophon',
		'music_network_bg' => '.music-social-icons-container'
	);

	$css .= wolf_get_customizer_bg_options( $backgrounds );

	if ( WOLF_DEBUG ) {
		return $css;
	} else {
		return wolf_compact_css( $css );
	}
} // end function

/**
 * Output the custom CSS
 */
function wolf_output_customizer_options() {
	echo '<style>';
	echo '/* Customizer */' . "\n";
    	echo wolf_customizer_css();
    	echo '</style>';
}
add_action( 'wp_head', 'wolf_output_customizer_options' );