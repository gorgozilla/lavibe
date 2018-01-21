<?php
/**
 * Speaker common functions
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Allow Shortcodes in Text Widget
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );

if ( ! function_exists( 'wolf_gravatar' ) ) {
	/**
	 * Custom Default Avatar
	 *
	 * @param array $avatar_defaults
	 * @return array
	 */
	function wolf_gravatar( $avatar_defaults ) {

		if ( wolf_get_theme_option( 'custom_avatar' ) ) {
			$custom_avatar = wolf_get_theme_option( 'custom_avatar' );
			$avatar_defaults[$custom_avatar] = __( 'Custom avatar', 'wolf' );
		}

		return $avatar_defaults;
	}
	add_filter( 'avatar_defaults', 'wolf_gravatar' );
}

if ( ! function_exists( 'wolf_favicons' ) ) {
	/**
	 * Add favicons (images/favicons)
	 *
	 * @return string
	 */
	function wolf_favicons() {
		?>
	<!-- Favicons -->
	<link rel="shortcut icon" href="<?php echo esc_url( wolf_get_theme_uri( '/images/favicons/favicon.ico' ) ); ?>">
	<link rel="apple-touch-icon" href="<?php echo esc_url( wolf_get_theme_uri( '/images/favicons/touch-icon-57x57.png' ) ); ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url( wolf_get_theme_uri( '/images/favicons/touch-icon-72x72.png' ) ); ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url( wolf_get_theme_uri( '/images/favicons/touch-icon-114x114.png' ) ); ?>">
		<?php
	}
	add_action( 'wolf_meta_head', 'wolf_favicons' );
}

if ( ! function_exists( 'wolf_custom_login_logo' ) ) {
	/**
	 * Custom Login Logo Option
	 *
	 * @return int
	 */
	function wolf_custom_login_logo() {

		$login_logo = wolf_get_theme_option( 'login_logo' );

		if ( $login_logo )
			echo '<style  type="text/css"> h1 a { background-image:url(' . $login_logo .' )  !important; } </style>';
	}
	add_action( 'login_head',  'wolf_custom_login_logo' );
}

if ( ! function_exists( 'wolf_credits' ) ) {
	/**
	 * Copyright/site info text
	 *
	 * @return string
	 */
	function wolf_credits() {

		$footer_text = wolf_get_theme_option( 'copyright_textbox', '' );

		if ( $footer_text ) {

			echo '<div class="site-infos text-center">';
			echo sanitize_text_field( $footer_text );
			echo '</div>';
		}
	}
	add_action( 'wolf_site_info', 'wolf_credits' );
}

if ( ! function_exists( 'wolf_tracking_code' ) ) {
	/**
	 * Output Analitycs code in the page footer
	 *
	 * @return int
	 */
	function wolf_tracking_code() {

		$tracking_code = wolf_get_theme_option( 'tracking_code' );

		if ( $tracking_code && ! is_user_logged_in() ) {
			echo stripslashes( $tracking_code );
		}
	}
	add_action( 'wolf_body_end', 'wolf_tracking_code' );
}

if ( ! function_exists( 'wolf_remove_more_jump_link' ) ) {
	/**
	 * Avoid page jump when clicking on more link
	 *
	 * @param string $link
	 * @return string $link
	 */
	function wolf_remove_more_jump_link( $link )  {
		$offset = strpos( $link, '#more-' );
		if ( $offset ) { $end = strpos( $link, '"',$offset ); }
		if ( $end ) { $link = substr_replace( $link, '', $offset, $end-$offset ); }
		return $link;
	}
	add_filter( 'the_content_more_link', 'wolf_remove_more_jump_link' );
}

if ( ! function_exists( 'wolf_is_woocommerce' ) ) {
	/**
	 * Check if we are on a woocommerce page
	 *
	 * @return bool
	 */
	function wolf_is_woocommerce() {

		if ( class_exists( 'Woocommerce' ) ) {

			if ( is_woocommerce() ) {
				return true;
			}

			if ( is_shop() ) {
				return true;
			}

			if ( is_checkout() || is_order_received_page() ) {
				return true;
			}

			if ( is_cart() ) {
				return true;
			}

			if ( is_account_page() ) {
				return true;
			}
		}
	}
}

/**
 * Check if the home page is set to default
 *
 * Returns true if not page for post and front page are set in the reading settings
 *
 * @return bool
 */
function wolf_is_home_as_blog() {
	return ! get_option( 'page_for_posts' ) && ! get_option( 'page_on_front' ) && is_home();
}

/**
 * Check if we're on the blog index page
 *
 * @return bool
 */
function wolf_is_blog_index() {

	global $wp_query;

	return wolf_is_home_as_blog() || ( is_object( $wp_query ) && isset( $wp_query->queried_object ) && isset( $wp_query->queried_object->ID ) && $wp_query->queried_object->ID == get_option( 'page_for_posts' ) );
}

/**
 * Check if we're on a blog page
 *
 * @return bool
 */
function wolf_is_blog() {

	$is_blog = ( wolf_is_home_as_blog() || wolf_is_blog_index() || is_search() || is_archive() ) && ! wolf_is_woocommerce() && 'post' == get_post_type();
	return ( true == $is_blog );
}

if ( ! function_exists( 'wolf_get_blog_url' ) ) {
	/**
	 * Get blog page URL
	 *
	 * @return string
	 */
	function wolf_get_blog_url() {

		if ( get_option( 'page_for_posts' ) )
			return get_permalink( get_option( 'page_for_posts' ) );
	}
}

if ( ! function_exists( 'wolf_comment' ) ) {
	/**
	 * Basic Comments function
	 *
	 * @param object $comment
	 * @param array $args
	 * @param int $depth
	 * @return void
	 */
	function wolf_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :

		case 'pingback' :

		case 'trackback' :
			// Display trackbacks differently than normal comments. ?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<p><?php _e( 'Pingback:', 'wolf' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'wolf' ), '<span class="ping-meta"><span class="edit-link">', '</span></span>' ); ?></p>
			<?php
					break;

		default :
				// Proceed with normal comments.
			?>
			<li id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
					<div class="comment-author vcard">
						<?php echo get_avatar( $comment, 80 ); ?>
					</div><!-- .comment-author -->

					<header class="comment-meta">
						<cite class="fn"><?php comment_author_link(); ?></cite>
							<?php printf(
								'<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								sprintf( _x( '%1$s at %2$s', '1: date, 2: time', 'wolf' ), get_comment_date(), get_comment_time() )
							);
							edit_comment_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '<span>' );
						?>
					</header><!-- .comment-meta -->

					<div class="comment-content">
						<?php if ( '0' == $comment->comment_approved ) { ?>
							<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wolf' ); ?></p>
						<?php } ?>
						<?php comment_text(); ?>
					</div><!-- .comment-content -->

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'wolf' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
				</article><!-- #comment-## -->
			<?php
				break;
			endswitch; // End comment_type check.
	}
} // ends check for wolf_comment()