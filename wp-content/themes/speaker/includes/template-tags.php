<?php
/**
 * Speaker template tags
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_entry_title' ) ) {
	/**
	 * Prints the post title
	 *
	 * The title will be linked to the post if we're on an archive page
	 *
	 */
	function wolf_entry_title( $echo = true ) {

		$title = '';
		$format = get_post_format() ? get_post_format() : 'standard';
		$no_title = array( 'status', 'aside', 'quote','chat' );

		if ( has_post_format( 'link' ) && ! is_single() ) :
			$title = '<h2 class="entry-title"><a href="' . esc_url( wolf_get_first_url() ) . '" class="entry-link" rel="bookmark">' . get_the_title() . '</a></h2>';

		elseif ( is_single() ) :
			$title = '<h1 class="entry-title">' . get_the_title() . '</h1>';
		elseif ( ! in_array( $format, $no_title ) ) :
			$title = '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" class="entry-link" rel="bookmark">' . get_the_title() . '</a></h2>';
		endif;

		if ( $echo )
			echo $title;

		return $title;
	}
}

if ( ! function_exists( 'wolf_entry_meta' ) ) {
	/**
	 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
	 *
	 * Create your own wolf_entry_meta() to override in a child theme.
	 *
	 */
	function wolf_entry_meta() {
		
		if ( is_sticky() && is_home() && ! is_paged() )
			echo '<span class="featured-post">' . __( 'Sticky', 'wolf' ) . '</span>';

		if ( ! has_post_format( 'link' ) && 'post' == get_post_type() || 'work' == get_post_type() )
			wolf_entry_date();

		// Post author
		if ( 'post' == get_post_type() && is_multi_author() ) {
			printf(
				'<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'wolf' ), get_the_author() ) ),
				get_the_author()
			);
		}

		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( __( ', ', 'wolf' ) );
		if ( $categories_list ) {
			echo '<span class="categories-links">' . $categories_list . '</span>';
		}

		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', __( ', ', 'wolf' ) );
		if ( $tag_list ) {
			echo '<span class="tags-links">' . $tag_list . '</span>';
		}
	}
}

if ( ! function_exists( 'wolf_entry_date' ) ) {
	/**
	 * Prints HTML with date information for current post.
	 *
	 * Create your own wolf_entry_date() to override in a child theme.
	 *
	 *
	 * @param boolean $echo Whether to echo the date. Default true.
	 * @return string
	 */
	function wolf_entry_date( $echo = true ) {
		
		$format_prefix = ( has_post_format( 'chat' ) || has_post_format( 'status' ) ) ? _x( '%1$s on %2$s', '1: post format name. 2: date', 'wolf' ): '%2$s';

		$date = sprintf(
			'<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
			esc_url( get_permalink() ),
			esc_attr( sprintf( __( 'Permalink to %s', 'wolf' ), the_title_attribute( 'echo=0' ) ) ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
		);

		if ( $echo )
			echo $date;

		return $date;
	}
}

if ( ! function_exists( 'wolf_entry_thumbnail' ) ) {
	/**
	 * Get a different post thumbnail depending on context
	 *
	 * @param boolean $echo Whether to echo the date. Default true.
	 * @return string
	 */
	function wolf_entry_thumbnail( $echo = true ) {

		$thumbnail = null;
		$format = get_post_format() ? get_post_format() : 'standard';
		$no_thumb = array( 'video', 'gallery', 'link', 'status', 'quote', 'aside', 'link', 'chat' );

		if ( has_post_thumbnail() ) {

			if ( 'image' == $format ) {
				
				$img_excerpt = get_post( get_post_thumbnail_id() )->post_excerpt;
				$img_alt = esc_attr( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) );

				$caption = ( $img_excerpt ) ? $img_excerpt : get_the_title();
				$caption = '';
				
				$img = wolf_get_post_thumbnail_url( 'image-thumb' );

				$full_img = wolf_get_post_thumbnail_url( 'full' );

				$lightbox_class = 'lightbox'; 
				$thumbnail = '<div class="entry-thumbnail">';
				$thumbnail .= "<a title='$caption' class='$lightbox_class zoom' href='$full_img'><img src='$img' alt='$img_alt'></a>";
				$thumbnail .= '</div>';

			} elseif ( ! in_array( $format, $no_thumb ) ) {
				$thumbnail = '<div class="entry-thumbnail">';
				$thumbnail .= '<a href="' . get_permalink( get_the_ID() ) . '">';
				$thumbnail .= get_the_post_thumbnail( get_the_ID(), 'image-thumb' );
				$thumbnail .= '</a>';
				$thumbnail .= '</div>';
			}
		}

		if ( $echo )
			echo $thumbnail;

		return $thumbnail;
	}
}

if ( ! function_exists( 'wolf_paging_nav' ) ) {
	/**
	 * Displays navigation to next/previous set of posts when applicable.
	 *
	 */
	function wolf_paging_nav( $loop = null ) {
		
		if ( ! $loop ) {
			global $wp_query;
			$max = $wp_query->max_num_pages;
		} else {
			$max = $loop->max_num_pages;
		}

		// Don't print empty markup if there's only one page.
		if ( $max < 2 )
			return;
		
		?>
		<nav class="navigation paging-navigation" role="navigation">
			<div class="nav-links clearfix">
				<?php if ( get_next_posts_link( '', $max ) ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'wolf' ), $max ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link( '', $max ) ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'wolf' ), $max ); ?></div>
				<?php endif; ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if ( ! function_exists( 'wolf_post_nav' ) ) {
	/**
	 * Displays navigation to next/previous work post when applicable.
	 *
	 */
	function wolf_post_nav() {
		global $post;

		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
		?>
		<nav class="navigation post-navigation" role="navigation">
			<div class="nav-links clearfix">

				<?php previous_post_link( '%link', '' ); ?>
				<?php next_post_link( '%link', '' ); ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}