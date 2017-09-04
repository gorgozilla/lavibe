<?php
/**
 * Custom One-Page functions
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_is_one_paged' ) ) {
	/**
	 * Check if we're on the main page
	 *
	 * @return bool
	 */
	function wolf_is_one_paged() {

		return is_page_template( 'page-templates/one-page.php' );
	}
}

if ( ! function_exists( 'wolf_get_one_page_id' ) ) {
	/**
	 * Check if we're on the main page
	 *
	 * @return int
	 */
	function wolf_get_one_page_id() {

		$pages = get_pages( array(
			'meta_key' => '_wp_page_template',
			'meta_value' => 'page-templates/one-page.php',
		) );
		if ( $pages && isset( $pages[0] ) ) {
			return  $pages[0]->ID;
		}
	}
}

if ( ! function_exists( 'wolf_one_page_menu' ) ) {
	/**
	 * One page menu fallback
	 *
	 */
	function wolf_one_page_menu() {

		$prefix = null;
		$output = '';

		if ( ! wolf_is_one_paged() )
			$prefix = esc_url( home_url( '/' ) );

		$args = array(
			'post_type' => 'page',
			'order'     => 'ASC',
			'meta_key' => '_section_position',
			'orderby'   => 'meta_value_num',
			'posts_per_page' => -1,

		);
		$loop = new WP_Query( $args );

		if ( $loop->have_posts() ) {

			$output .= '<ul class="nav-menu" id="one-page-menu">';

			while ( $loop->have_posts()) {
				$loop->the_post();

				$post_id = get_the_ID();
				$is_page = get_post_meta( $post_id, '_wp_page_template', true ) != 'page-templates/section.php';
				$hide = get_post_meta( $post_id, '_section_menu_hide', true );

				$class = ( wolf_is_one_paged() && ! $is_page ) ? ' scroll ' : '';

				$href = $prefix . '#' . wolf_get_section_slug();

				if ( $is_page ) {
					$href = get_permalink();
				}

				if ( wolf_is_one_paged() && $post_id == wolf_get_one_page_id() )
					$href = '#top';

				if ( $post_id == wolf_get_one_page_id() ) {
					$class = ' scroll home-menu-item ';
				}

				if ( is_page( $post_id ) && ! wolf_is_one_paged() )
					$class = ' active ';

				if ( ! $hide ) {
					$output .= '<li>';
					$output .= '<a class="' . $class . 'menu-item-' . wolf_get_section_slug() . '" href="' . $href  . '">';
					$output .= get_the_title();
					$output .= '</a>';
					$output .= '</li>';
				}
			}

			$output .= '</ul>';

		}
		wp_reset_postdata();
		echo $output;
	}
}

if ( ! function_exists( 'wolf_get_section_slug' ) ) {
	/**
	 * Get post slug
	 *
	 * @return string
	 */
	function wolf_get_section_slug( $post_id = null ) {

		$post_id = ( $post_id ) ? $post_id : get_the_ID();

		$slug = basename( get_permalink( $post_id ) );

		if (  get_option( 'page_on_front' ) == $post_id ) {
			$slug = 'top';
		}

		do_action( 'before_slug', $slug );

		$slug = apply_filters ('slug_filter', $slug );

		do_action( 'after_slug', $slug );

		return sanitize_title( $slug );
	}
}

if ( ! function_exists( 'wolf_save_one_page_menu_order' ) ) {
	/**
	 * Save Menu Hook
	 *
	 * Set a meta to each page/section when the menu order is updated
	 */
	function wolf_save_one_page_menu_order() {
		global $post;

		$menu = array();

		/* Check the new menu item order */
		if ( isset( $_POST['menu-locations'] ) && isset( $_POST['menu-locations']['primary'] ) ) {

			foreach( $_POST['menu-item-position'] as $menu_id => $position ) {
				$related_post_id = get_post_meta( $menu_id, '_menu_item_object_id', true );
				update_post_meta( $related_post_id, '_section_position', $position );
				$menu[ $related_post_id ] = $position;
			}

			// var_dump($menu);

			/**
			 * Update the post meta for each page
			 * and delete it if the page is not in the menu anymore
			 */
			$loop = wolf_one_page_loop();

			if ( $loop->have_posts() ) {
				while ( $loop->have_posts()) {

					$loop->the_post();
					$post_id = get_the_ID();

					if ( ! isset( $menu[ $post_id ] ) ) {

						delete_post_meta( $post_id, '_section_position' );
					}
				}
			}
			wp_reset_postdata();
		}

	}
	add_action( 'save_post', 'wolf_save_one_page_menu_order' );
}

if ( ! function_exists( 'wolf_one_page_loop' ) ) {
	/**
	 * Return custom page loop to display all page in one
	 */
	function wolf_one_page_loop() {
		global $wpdb, $options;

		$blog_id = get_option( 'page_for_posts' );

		$args = array(
		         	'post_type' => array( 'page' ),
		         	'meta_key' => '_section_position',
		             'order'     => 'ASC',
		         	'orderby'   => 'meta_value_num',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => '_wp_page_template',
					'value'   => 'page-templates/section.php',
					'compare' => '='
				)
			)
		);

		$loop = new WP_Query( $args );
		wp_reset_postdata();
		return $loop;
	}
}

if ( ! function_exists( 'wolf_one_page_loop_ids' ) ) {
	/**
	 * Return custom page loop to display all page in one
	 */
	function wolf_one_page_loop_ids() {

		$ids = array();
		$loop = wolf_one_page_loop();
		if( $loop->have_posts() ) {
			while ( $loop->have_posts() ) {
				$loop->the_post();
				$ids[] = get_the_ID();
			}
		}
		wp_reset_postdata();
		return $ids;
	}
}

if ( ! function_exists( 'wolf_add_section_class' ) ) {
	/**
	 * Add specific class to sections
	 */
	function wolf_add_section_class( $classes ) {

		$post_id = get_the_ID();
		$content = get_the_content();
		$pattern = get_shortcode_regex();

		if ( wolf_is_one_paged() || is_page_template( 'page-templates/section.php' ) ) {
			$classes[] = 'section';
			$classes[] = 'section-' . $post_id;

			$classes[] = 'section-font-' . get_post_meta( $post_id, '_section_font_color', true );

			if ( get_post_meta( $post_id, '_section_bg_parallax', true ) )
				$classes[] = 'section-parallax';

			if ( get_post_meta( $post_id, '_section_full_width', true ) )
				$classes[] = 'section-full-width';

			if ( get_post_meta( $post_id, '_section_small_width', true ) )
				$classes[] = 'section-small-width';

			if ( get_post_meta( $post_id, '_section_full_window', true ) )
				$classes[] = 'section-full-window';

			if ( get_post_meta( $post_id, '_section_video_bg', true ) )
				$classes[] = 'section-video-bg';

			if ( get_option( 'page_for_posts' ) == $post_id )
				$classes[] = 'section-front-posts';

			if ( preg_match( "/$pattern/s", $content, $match ) ) {

				if ( 'gallery' == $match[2] && get_post_meta( $post_id, '_section_mosaic', true ) ) {
					$classes[] = 'is-section-masonry-gallery';
				}
			}

			if ( preg_match( "/$pattern/s", $content, $match )  ) {
				if ( 'wolfgram_gallery' == $match[2] ) {
					$classes[] = 'is-wolfgram-section';
				}
			}
		}
		return $classes;
	}
	add_filter( 'post_class', 'wolf_add_section_class' );
}

if ( ! function_exists( 'wolf_output_section_inline_styles' ) ) {
	/**
	 * Output section inline CSS and JS
	 *
	 * @param string $content
	 * @return string
	 */
	function wolf_output_section_inline_styles( $post_id ) {

		if ( ! wolf_is_one_paged() )
			return;

		global $post;

		$inline_css = '';
		$inline_js = '';
		$post_id = $post_id ? $post_id :  $post->ID;

		if ( wolf_get_sections_css( $post_id ) ) {
			$inline_css .= '<style type="text/css">'."\n";
			$inline_css .= '/* Sections CSS */'."\n";
			$inline_css .= wolf_compact_css( wolf_get_sections_css( $post_id ) ) ."\n";
			$inline_css .= '</style>'."\n";
		}

		echo $inline_css;
	}
	add_action( 'wp_head', 'wolf_output_section_inline_styles' );
}

if ( ! function_exists( 'wolf_get_sections_css' ) ) {
	/**
	 * Get section style options
	 *
	 * @param int $post_id
	 * @return string
	 */
	function wolf_get_sections_css( $post_id ) {

		if ( ! $post_id )
			return;

		$css = '';
		$sections = wolf_one_page_loop_ids();

		if ( $sections && $sections != array() ) {

			foreach ( $sections as $section_id ) {

				$css .= wolf_get_single_section_css( $section_id );
			}
		}

		return $css;
	}
}

if ( ! function_exists( 'wolf_get_single_section_css' ) ) {
	/**
	 * Get single section CSS
	 */
	function wolf_get_single_section_css( $post_id  ) {

		if ( $post_id ) {
			$css = '';
			$meta_id = '_section_bg';
			$selector = '.section-' . $post_id;

			$url = null;
			$img = get_post_meta( $post_id, $meta_id . '_img', true );
			$color = get_post_meta( $post_id, $meta_id . '_color', true );
			$repeat = get_post_meta( $post_id, $meta_id . '_repeat', true );
			$position = get_post_meta( $post_id, $meta_id . '_position', true );
			$attachment = get_post_meta( $post_id, $meta_id . '_attachment', true );
			$size = get_post_meta( $post_id, $meta_id . '_size', true );
			$parallax = get_post_meta( $post_id, $meta_id . '_parallax', true );

			if ( $img )
				$url = 'url("'. $img .'")';

			if ( $color || $img ) {

				if ( $parallax ) {

					$css .= "$selector {background : $color $url $repeat fixed}";
					$css .= "$selector {background-position : 50% 0}";

				} else {
					$css .= "$selector {background : $color $url $position $repeat $attachment}";
				}

				if ( $size == 'cover' ) {

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

				if ( $size == 'resize' ) {

					$css .= "$selector {
						-webkit-background-size: 100%;
						-o-background-size: 100%;
						-moz-background-size: 100%;
						background-size: 100%;
					}";
				}
			}

			$padding_top = get_post_meta( $post_id, '_section_padding_top', true );
			$padding_bottom = get_post_meta( $post_id, '_section_padding_bottom', true );

			if ( $padding_top )
				$css .= "$selector .section-inner { padding-top:$padding_top }";

			if ( $padding_bottom )
				$css .= "$selector .section-inner { padding-bottom:$padding_bottom }";

			$custom_css = get_post_meta( $post_id, '_section_custom_css', true );


			if ( '' != $custom_css ) {
				$parsed_css =  wolf_parse_section_css( $custom_css );
				foreach ( $parsed_css as $rule ) {
			 		$css .= $selector . ' ' . $rule ;
			 	}
			}

			return wolf_compact_css( $css );
		}
	}
}

if ( ! function_exists( 'wolf_output_single_section_css' ) ) {
	/**
	 * Outpu section CSS on section single page view
	 *
	 * Mainly use for previewing sections
	 *
	 */
	function wolf_output_single_section_css() {

		if ( is_page() && is_page_template( 'page-templates/section.php' ) )
			echo '<style>' . wolf_get_single_section_css( get_the_ID() ) . '</style>';

	}
	add_action( 'wolf_page_before', 'wolf_output_single_section_css' );
}

if ( ! function_exists( 'wolf_parse_section_css' ) ) {
	/**
	 * Parse CSS rule to an array
	 *
	 * Used for the custom CSS field.
	 * We will add the section id before every CSS rule
	 *
	 * @return array
	 */
	function wolf_parse_section_css( $css = null ) {

		if ( ! $css )
			return;

		$results = array();

		preg_match_all( '/(.+?)\s?\{\s?(.+?)\s?\}/', $css, $matches );

		if ( $matches && isset( $matches[0] ) ) {
			foreach( $matches[0] as $i => $original) {
				$results[] = $original;
			}
		}

		return $results;
	}
}