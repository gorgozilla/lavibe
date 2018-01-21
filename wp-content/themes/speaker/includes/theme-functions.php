<?php
/**
 * Speaker specific functions
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_set_lang' ) ) {
	/**
	 * Set your language here
	 *
	 * Uncomment the line below the function to make the wolf_set_lang function active
	 * The .po and .mo files can be found in the languages/ folder
	 * http://help.wolfthemes.com/2013/11/translate-your-wordpress-theme/
	 * 
	 * @param string $locale
	 * @return string
	 */
	function wolf_set_lang( $locale ) {
		return 'fr_FR';
	}
	// add_filter( 'locale', 'wolf_set_lang' );
}

/**
 * Enqueue CSS stylsheets
 * JS scripts are separated and can be found in includes/scripts.php 
 */
function wolf_enqueue_style() {
	global $wp_styles;

	// normalize
	wp_enqueue_style( 'normalize', WOLF_THEME_URL. '/css/lib/normalize.css', array(), '3.0.0' );

	// Bagpakk
	wp_enqueue_style( 'bagpakk', WOLF_THEME_URL. '/css/lib/bagpakk-wordpress.min.css', array(), '1.0.0' );

	// WP icons
	wp_enqueue_style( 'dashicons' );

	/* Ensure to overwrite styles enqueued by a plugin */
	wp_dequeue_style( 'flexslider' );
	wp_deregister_style( 'flexslider' );
	wp_dequeue_style( 'swipebox' );
	wp_deregister_style( 'swipebox' );

	$lightbox = wolf_get_theme_option( 'lightbox' );

	if ( 'swipebox' == $lightbox ) {

		wp_enqueue_style( 'swipebox', WOLF_THEME_URL. '/css/lib/swipebox.min.css', array(), '1.2.8' );

	} elseif ( 'fancybox' == $lightbox ) {

		wp_enqueue_style( 'fancybox', WOLF_THEME_URL. '/css/lib/fancybox.css', array(), '2.1.5' );

	}
	
	// Flexslider
	wp_enqueue_style( 'flexslider', WOLF_THEME_URL. '/css/lib/flexslider.css', array(), '2.2.0' );

	// Main Stylesheet
	wp_enqueue_style( 'speaker-style', get_stylesheet_uri(), array(), WOLF_THEME_VERSION );
	
	// Loads the Internet Explorer 8 specific stylesheet. */
	wp_enqueue_style( 'speaker-ie8-style', WOLF_THEME_URL . '/css/ie8.css' );
	$wp_styles->add_data( 'speaker-ie8-style', 'conditional', 'lte IE 8' );
}
add_action( 'wp_enqueue_scripts', 'wolf_enqueue_style' );

if ( ! function_exists( 'wolf_body_classes' ) ) {
	/**
	 * Add specific class to the body depending on theme options and page template
	 *
	 * @param array $classes
	 * @return array $classes
	 */
	function wolf_body_classes( $classes ) {

		global $wp_customize;

		if ( isset( $wp_customize ) ) {
			$classes[] = 'is-customizer';
		}

		$classes[] = 'wolf';

		$classes[] = wolf_get_theme_slug();

		$classes[] = 'wolf-mailchimp';

		/*
		 * This class will be removed with javascript on safari on big screen 
		 * For some reason CSS transition transform sucks on safari on big screens
		 */
		$classes[] = 'do-transform';

		if ( wolf_is_one_paged() )
			$classes[] = 'is-one-paged';

		if ( is_page_template( 'page-templates/section.php' ) && is_page() )
			$classes[] = 'section-page';

		/* Page template clean classes */
		if ( is_page_template( 'page-templates/full-width.php' ) )
			$classes[] = 'full-width';

		if ( is_page_template( 'page-templates/post-archives.php' ) )
			$classes[] = 'post-archives';

		if ( is_page_template( 'page-templates/page-with-sidebar.php' ) )
			$classes[] = 'has-page-sidebar';

		/* Add a class if the blog sidebar is active */
		if ( is_active_sidebar( 'sidebar-main' ) && wolf_get_theme_option( 'blog_sidebar' ) )
			$classes[] = 'has-blog-sidebar';

		/* Add a class if the shop sidebar is active */
		// if ( is_active_sidebar( 'sidebar-shop' ) )
			// $classes[] = 'has-shop-sidebar';

		/* Header has content */
		if ( wolf_get_theme_option( 'home_header_content' ) )
			$classes[] = 'has-hero';

		/* Add a class to hide the sidebar on mobile */
		if ( wolf_get_theme_option( 'hide_sidebar_phone' ) )
			$classes[] = 'hide-sidebar-phone';

		/* No loader option class */
		if ( wolf_get_theme_option( 'no_loader' ) )
			$classes[] = 'no-loader';

		/* Home Header Type */
		if ( ( wolf_get_theme_option( 'home_header_type' ) == 'full-window' || wolf_get_theme_option( 'home_header_type' ) == 'full-video' ) && is_front_page() && ! wolf_is_revslider_in_home_header() )
			$classes[] = 'home-header-full-window';

		if ( ( wolf_get_theme_option( 'home_header_type' ) == 'video' || wolf_get_theme_option( 'home_header_type' ) == 'full-video' ) && is_front_page() && ! wolf_is_revslider_in_home_header() )
			$classes[] = 'header-has-video-bg';

		if ( is_multi_author() )
			$classes[] = 'is-multi-author';

		if ( 'post' == get_post_type() && ! is_single() && ! is_search() && ! is_404() )
			$classes[] = 'is-blog';

		/* Add a class if the blog sidebar is active */
		if ( is_active_sidebar( 'sidebar-main' ) )
			$classes[] = 'sidebar-active';

		return $classes;
	}
	add_filter( 'body_class', 'wolf_body_classes' );
}

if ( ! function_exists( 'wolf_is_revslider_in_home_header_body_class' ) ) {
	/**
	 * Add body class if there is a rev slider in home header
	 *
	 * @param array $classes
	 * @return array $classes
	 */
	function wolf_is_revslider_in_home_header_body_class( $classes ) {

		if ( wolf_is_revslider_in_home_header() ) {

			$classes[] = 'home-header-has-revslider';
			
		} else {
			$classes[] = 'home-header-no-revslider';
		}

		return $classes;

	}
	add_filter( 'body_class', 'wolf_is_revslider_in_home_header_body_class' );
}

if ( ! function_exists( 'wolf_is_revslider_in_home_header' ) ) {
	/**
	 * Check if a revslider shortcode is in the home header content
	 *
	 * @return bool
	 */
	function wolf_is_revslider_in_home_header() {

		$hero    = wolf_get_theme_option( 'home_header_content' );
		$pattern = get_shortcode_regex();

		if ( $hero && preg_match( "/$pattern/s", $hero, $match ) ) {

			if ( 'rev_slider' == $match[2] ) {
				return true;
			}
		}
	}
}

if ( ! function_exists( 'wolf_logo' ) ) {
	/**
	 * Output the Logo
	 *
	 * @return string
	 */
	function wolf_logo() {

		// $logo = get_theme_mod( 'logo' );
		$logo = wolf_get_theme_option( 'logo' );

		if ( $logo ) {
			
			$output = '<div id="logo-container"><div id="logo">
			<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">
				<img src="' . $logo . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">
			</a>
			</div></div>';
			echo $output;
		}
	}
}

if ( ! function_exists( 'wolf_excerpt_length' ) ) {
	/**
	 * Excerpt length hook 
	 * Set the number of character to display in the excerpt
	 *
	 * @access 
	 * @param int $length
	 * @return int
	 */
	function wolf_excerpt_length( $length ) {
		return 30; 
	}
	add_filter( 'excerpt_length', 'wolf_excerpt_length' );
}

if ( ! function_exists( 'wolf_more_text' ) ) {
	/**
	 * Excerpt more
	 * Render "Read more" link text differenttly depending on post format
	 * the_content( wolf_more_text() )
	 *
	 * @return string
	 */
	function wolf_more_text() {
		global $post;

		$format = null;
		$text = __( 'Continue reading &rarr;', 'wolf' );
		$format = get_post_format();
		
		if ( $format ) {

			if ( 'video' == $format ) {

			 	$text = __( 'More about this video &rarr;', 'wolf' );

			} elseif ( 'gallery' == $format || 'image' == $format ) {

				$text = __( 'View more &rarr;', 'wolf' );

			} elseif ( 'audio' == $format ) {

				$text = __( 'More infos &rarr;', 'wolf' );

			} else {
				$text = __( 'Continue reading &rarr;', 'wolf' );
			}
		}
		return $text;
	}
}

if ( ! function_exists( 'wolf_excerpt_more' ) ) {
	/**
	 * Excerpt "more" link
	 *
	 * @param string $more
	 * @return string
	 */
	function wolf_excerpt_more( $more ) {
		
		return ' [...]<p><a rel="bookmark" class="more-link button" href="'. get_permalink() . '">' . wolf_more_text() . '</a></p>';
	}
	add_filter( 'excerpt_more', 'wolf_excerpt_more' );
}

if ( ! function_exists( 'wolf_add_more_link_class' ) ) {
	/**
	 * Add custom class to the more link
	 *
	 * @param string $link
	 * @param string $text
	 */
	function wolf_add_more_link_class( $link, $text ) {
		return str_replace(
			'more-link',
			'more-link button',
			$link
		);
	}
	add_action( 'the_content_more_link', 'wolf_add_more_link_class', 10, 2 );
}

if ( ! function_exists( 'wolf_add_author_socials' ) ) {
	/**
	 * Add social networks to author profile
	 *
	 * @param array $contactmethods
	 * @return array $contactmethods
	 */
	function wolf_add_author_socials( $contactmethods ) {
		$contactmethods = array();
		$contactmethods['twitter'] = 'Twitter';
		$contactmethods['facebook'] = 'Facebook';
		return $contactmethods;
	}
	add_filter( 'user_contactmethods', 'wolf_add_author_socials',10,1 );
}

if ( ! function_exists( 'wolf_display_author_socials' ) ) {
	/**
	 * Display social networks in author bio box
	 *
	 * @return string
	 */
	function wolf_display_author_socials() {
		$facebook = get_the_author_meta( 'facebook' );
		$twitter = get_the_author_meta( 'twitter' );
		$website = get_the_author_meta( 'user_url' );
		$name = get_the_author_meta( 'user_nicename' );
		if ( $facebook ) {
			echo '<a target="_blank" title="' . sprintf( __( 'View %s facebook profile', 'wolf' ), $name ) . '" href="'. $facebook .'" class="author-link theme-icon-facebook"></a>';
		}
		if ( $twitter ) {
			echo '<a target="_blank" title="' . sprintf( __( 'Follow %s on twitter', 'wolf' ), $name ) . '" href="'. $twitter .'" class="author-link theme-icon-twitter"></a>';
		}
			
		if ( $website ) {
			echo '<a target="_blank" title="' . sprintf( __( 'Visit %s website', 'wolf' ), $name ) . '" href="'. $website .'" class="author-link theme-icon-website"></a>';
		}	
	}
}

if ( ! function_exists( 'wolf_theme_socials' ) ) {
	/**
	 * Returns social icons from theme options
	 *
	 * @return string
	 */
	function wolf_theme_socials() {

		$output = null;

		$socials = array(
			'facebook',
			'twitter',
			'linkedin',
			'digg',
			'instagram',
			'dribbble',
			'youtube',
			'googleplus',
			'pinterest',
			'vimeo',
			'deviantart',
			'github',
			'tumblr',
			'skype' ,
			'lastfm' ,
			'soundcloud',
			'spotify',
			'delicious' ,
			'stumbleupon' ,
			'forrst',
			'foursquare',
			'zerply',
			'myspace',
			'grooveshark',
			'evernote',
			'behance',
			'500px',
			'feed'
		);
		foreach ( $socials as $s ) :

			$social = wolf_get_theme_option( $s );
			if ( $social ) {
				$output .= '<a href="' . $social . '" class="theme-icon-' . $s . '" title="'. ucfirst($s) . '" target="_blank"></a>';
			}

		endforeach;

		return $output;
	}
}

if ( ! function_exists( 'wolf_top_tags' ) ) {
	/**
	 * Display the most used tags
	 *
	 * @return int
	 */
	function wolf_top_tags( $text = '', $nb = 10 ) {
		$tags = get_tags();
		
		$list = '';

		if ( empty( $tags ) )
			return;
		
		$counts = $tag_links = array();
		
		foreach ( (array) $tags as $tag ) {
			$counts[$tag->name] = $tag->count;
			$tag_links[$tag->name] = get_tag_link( $tag->term_id );
		}
		asort( $counts );
		$counts = array_reverse( $counts, true );
		$i = -1;
		foreach ( $counts as $tag => $count ) {
			$i++;
			$tag_link = esc_url( $tag_links[$tag] );
		
			$tag = str_replace( ' ', '&nbsp;', esc_html( $tag ) );
			
			if ( $i < $nb ){
				$list .= "<a href=\"$tag_link\">$tag</a>, ";
			}
		}

		return '<div class="most-used-tags">' . $text . substr( $list, 0, -2 ) . '</div>';
	}
}

if ( ! function_exists( 'wolf_posts_link_next_title' ) ) {
	/**
	 * Add title attribute to next link post navigation
	 *
	 * @return string
	 */
	function wolf_posts_link_next_title() {
		return 'title="' . __( 'Older', 'wolf' ) . '"';
	}
	add_filter( 'next_posts_link_attributes', 'wolf_posts_link_next_title' );
}

if ( ! function_exists( 'wolf_posts_link_prev_title' ) ) {
	/**
	 * Add title attribute to previous link post navigation
	 *
	 * @return string
	 */
	function wolf_posts_link_prev_title() {
		return 'title="' . __( 'Newer', 'wolf' ) . '"';
	}
	add_filter( 'previous_posts_link_attributes', 'wolf_posts_link_prev_title' );
}

if ( ! function_exists( 'wolf_get_page_title' ) ) {
	/**
	 * Returns page title outside the loop
	 *
	 * @return string
	 */
	function wolf_get_page_title() {
		
		global $post, $wp_query;
		$title = null;
		$desc = null;
		$output = null;

		if ( have_posts() ) {
			
			/* Main condition not 404 and not woocommerce page */
			if ( ! is_404() && ! wolf_is_woocommerce() && ! is_singular( 'release' ) ) {

				if ( is_category() ) {
					
					$title   = single_cat_title( '', false );
					$desc = category_description();
						
				} elseif ( is_tag() ) {
					
					$title   = single_tag_title( '', false );
					$desc = category_description();

				} elseif ( is_author() ) {
					
					the_post();
					$title = get_the_author();
					rewind_posts();

				} elseif ( is_day() ) {
					
					get_the_date();

				} elseif ( is_month() ) {
					
					$title = get_the_date( 'F Y' );

				} elseif ( is_year() ) {
					
					$title = get_the_date( 'Y' );

				} elseif ( is_tax() ) {
					$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
					if ( $the_tax && $wp_query && isset($wp_query->queried_object->name) ) {

						$title  = $wp_query->queried_object->name;
						$desc = category_description();
						
					}

				} elseif ( is_search() ) {
				
					$title = sprintf( __( 'Search Results for: %s', 'wolf' ), get_search_query() );

				} elseif ( is_single() ) {
					
					$format = get_post_format();
					$title = get_the_title(); 
					
					/* is blog index */
				} elseif (
					$wp_query && isset( $wp_query->queried_object->ID ) 
					&& $wp_query->queried_object->ID == get_option( 'page_for_posts' )
				) {
				
					$title  = $wp_query->queried_object->post_title;
					$desc = wolf_get_theme_option( 'blog_tagline' ); // blog tagline from theme options

				} elseif ( $wp_query && isset( $wp_query->queried_object->ID )  ) {
				
					$title = $wp_query->queried_object->post_title;
				}

			} elseif ( wolf_is_woocommerce() ) { // shop title
			
				if ( is_woocommerce() ) {
					$title = woocommerce_page_title( false );
				}
			}
		
		} // end have posts

		if ( $title ) 
			$output .= "<h1 class='page-title'>$title</h1>";

		if ( $desc ) 
			$output .= "<div class='category-description'>$desc</div>";

		return $output;
	}
}

if ( ! function_exists( 'wolf_search_filter' ) ) {
	/**
	 * Exlude post types from search
	 *
	 * @param object $query
	 * @return object $query
	 */
	function wolf_search_filter( $query ) {
		if ( $query->is_search ) {
			$query->set( 'post_type', array( 'post' ) );
		}
		return $query;
	}
	add_filter( 'pre_get_posts', 'wolf_search_filter' );
}

if ( ! function_exists( 'wolf_search_menu_item' ) ) {
	/**
	 * Add a search menu item
	 */
	function wolf_search_menu_item ( $items, $args ) {

		if ( class_exists( 'WooCommerce' ) && function_exists( 'wc_get_page_id' ) && wolf_get_theme_option( 'cart_menu_item' ) ) {
			global $woocommerce;
			$item_count = $woocommerce->cart->cart_contents_count;
			$cart_url = get_permalink( wc_get_page_id( 'cart' ) );

			$items .= '<li class="cart-menu-item">
				<a class="cart-menu-item-link" href="' . $cart_url . '"><span class="cart-text">' . __( 'Cart', 'wolf' ) . '</span></a>
					<span class="cart-menu-panel">
						<a href="' . $cart_url . '">
							<span class="icon-cart"></span>' . sprintf( _n( 'Your cart : %d item', 'Your cart : %d items', $item_count, 'wolf' ), $item_count ) . '<br>
							' . __( 'View Cart &rarr;', 'wolf' ) . '
						</a>
					</span>
			</li>';
		}
		
		return $items;
	}
	add_filter( 'wp_nav_menu_items', 'wolf_search_menu_item', 10, 2 );
}