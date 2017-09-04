<?php
/**
 * Speaker hook functions
 *
 * Inject content through template hooks
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_output_message_bar' ) ) {
	/**
	 * Output message bar plugin function
	 */
	function wolf_output_message_bar() {

		if ( function_exists( 'wolf_message_bar' ) )
			wolf_message_bar();
	}
	add_action( 'wolf_body_start', 'wolf_output_message_bar' );
}

if ( ! function_exists( 'wolf_scroll_arrow' ) ) {
	/**
	 * Output scroll arrow
	 */
	function wolf_scroll_arrow() {

		?>
		<div id="top"></div><a id="top-arrow" class="scroll" href="#top"></a>
		<?php
	}
	add_action( 'wolf_body_start', 'wolf_scroll_arrow' );
}

if ( ! function_exists( 'wolf_page_loader' ) ) {
	/**
	 * Output loader overlay
	 */
	function wolf_page_loader() {

		if ( ! wolf_get_theme_option( 'no_loader' ) ) :
		?>
		<div id="overlay"><div id="loader"><span class="theme-icon-spin theme-icon-spinner"></span></div></div>
		<?php
		endif;
	}
	add_action( 'wolf_header_before', 'wolf_page_loader' );
}

if ( ! function_exists( 'wolf_top_socials' ) ) {
	/**
	 * Display Share buttons && social links
	 */
	function wolf_top_socials() {

		?>
		<div id="header-social-bar">
			<?php
			if ( wolf_get_theme_option( 'header_share' ) ) :
				$permalink = wolf_get_meta_permalink();
				$site_title = wolf_get_wp_title();
			?>
				<div id="header-share">
					<div id="twitter">
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $permalink; ?>" data-text="<?php echo $site_title; ?>">Tweet</a>
					</div>

					<div id="fb">
						<div class="fb-like" data-href="<?php echo $permalink; ?>" data-send="false" data-layout="button_count" data-width="110" data-show-faces="false" data-colorscheme="light" data-action="like"></div>
					</div>
					<style>/*#google-plus{ display: inline-block; }*/</style>
					<!-- <div id="google-plus">
						<div class="g-plusone" data-size="medium"></div>
					</div> -->
				</div>
			<?php endif; ?>
			<?php if ( wolf_theme_socials() ) : ?>
				<div id="header-socials">
					<?php echo wolf_theme_socials(); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
	add_action( 'wolf_header_start', 'wolf_top_socials' );
}

if ( ! function_exists( 'wolf_share_buttons_script' ) ) {
	/**
	 * Outpu Share buttons script
	 */
	function wolf_share_buttons_script() {

		if ( wolf_get_theme_option( 'header_share' ) ) :
		?>
	<!-- share buttons -->
	<script type="text/javascript">
		(function(doc, script) {
	 	var js,
	 	fjs = doc.getElementsByTagName(script)[0],
	 	add = function(url, id) {
	 	if (doc.getElementById(id)) {return;}
	 	js = doc.createElement(script);
	 	js.src = url;
	 	id && (js.id = id);
	 	fjs.parentNode.insertBefore(js, fjs);
	 	};
	 	add("//connect.facebook.net/en_US/all.js#xfbml=1", "facebook-jssdk");
	 	add("//platform.twitter.com/widgets.js", "twitter-wjs");
	 	add("https://apis.google.com/js/plusone.js");
	 	}(document, "script"));
	</script>
	<!-- end share buttons -->
		<?php
		endif;
	}
	add_action( 'wolf_body_end', 'wolf_share_buttons_script' );
}

if ( ! function_exists( 'wolf_main_menu' ) ) {
	/**
	 * Output desktop menu
	 */
	function wolf_main_menu() {

		get_template_part( 'partials/navigation', 'desktop' );
	}
	add_action( 'wolf_header_start', 'wolf_main_menu' );
}

if ( ! function_exists( 'wolf_mobile_menu' ) ) {
	/**
	 * Output mobile menu
	 */
	function wolf_mobile_menu() {

		get_template_part( 'partials/navigation', 'mobile' );
	}
	add_action( 'wolf_body_start', 'wolf_mobile_menu' );
}

if ( ! function_exists( 'wolf_hero' ) ) {
	/**
	 * Output home page header content
	 */
	function wolf_hero() {

		if ( is_front_page() ) {
			get_template_part( 'partials/header', 'home' );
		}
	}
	add_action( 'wolf_header_end', 'wolf_hero' );
}

if ( ! function_exists( 'wolf_output_title' ) ) {
	/**
	 * Display Page Title
	 */
	function wolf_output_title() {

		if ( ! is_front_page() ) : ?>
			<div class="page-header-container text-center">
				<div class="page-header wrap">
					<?php wolf_logo(); ?>
					<?php echo wolf_get_page_title(); ?>
				</div>
			</div>
		<?php endif;
	}
	add_action( 'wolf_header_end', 'wolf_output_title' );
}

if ( ! function_exists( 'wolf_share_links' ) ) {
	/**
	 * Share links below single posts
	 *
	 * @param bool $display
	 * @return string
	 */
	function wolf_share_links() {

		if ( wolf_get_theme_option( 'show_share_box_single' ) ) { // is theme option checked

			get_template_part( 'partials/share', 'post' );
		}
	}
	add_action( 'wolf_post_end_singular', 'wolf_share_links' );
}

if ( ! function_exists( 'wolf_author_meta' ) ) {
	/**
	 * Output author bio box
	 */
	function wolf_author_meta() {

		if (
			// 1 == 1
			//is_multi_author()
			get_the_author_meta( 'description' )
			&& wolf_get_theme_option( 'show_author_box' )
			&& 'post' == get_post_type() || 'review' == get_post_type()
		)
		{
			get_template_part( 'partials/author-bio' );
		}
	}
	add_action( 'wolf_post_end_singular', 'wolf_author_meta' );
}

if ( ! function_exists( 'wolf_output_music_network' ) ) {
	/**
	 * Output music network icons
	 */
	function wolf_output_music_network() {

		if ( function_exists( 'wolf_music_network' ) ) {
			echo '<div class="music-social-icons-container">';
				wolf_music_network();
			echo '</div>';
		}

	}
	add_action( 'wolf_footer_before', 'wolf_output_music_network' );
}