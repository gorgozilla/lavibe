<?php
/**
 * Speaker gallery function
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'wolf_image_attachment_add_custom_fields' ) ) {
	/**
	 * Add custom field to attachment to customize mosaic gallery
	 */
	function wolf_image_attachment_add_custom_fields( $form_fields, $post ) {

		/* Image disposition */
		$field_value = get_post_meta( $post->ID, 'wolf_custom_size', true );

		$form_fields["wolf_custom_size"] = array(
			'label' => __( 'Custom Size', 'wolf' ),
			'input' => 'html',
			'helps' => __( 'This settings will be applied for the "mosaic gallery" only.', 'wolf' ),
			'application' => 'image',
			'exclusions'   => array( 'audio', 'video' ),
		);

		$selected = 'selected="selected"';
		$options = array(
			'small-square' => __( 'Small Square', 'wolf' ),
			'big-square' => __( 'Big Square', 'wolf' ),
			'portrait' => __( 'portrtait', 'wolf' ),
			'landscape' => __( 'landscape', 'wolf' ),

		);

		$html = '<select name="attachments[' . $post->ID . '][wolf_custom_size]">';

		// Browse and add the options
		foreach ( $options as $k => $v ) {
			// Set the option selected or not
			if ( $field_value == $k )
				$selected = ' selected="selected"';
			else
				$selected = '';

			$html .= '<option' . $selected . ' value="' . $k . '">' . $v . '</option>';
		}

		$html .= '</select>';


		$form_fields['wolf_custom_size']['html'] = $html;

		/* Image position */
		$field_value = get_post_meta( $post->ID, 'wolf_custom_position', true );

		$form_fields["wolf_custom_position"] = array(
			'label' => __( 'Position', 'wolf' ),
			'input' => 'html',
			'helps' => __( 'This settings will be applied for the "mosaic gallery" only.', 'wolf' ),
			'application' => 'image',
			'exclusions'   => array( 'audio', 'video' ),
		);

		$selected = 'selected="selected"';

		$options = array(
			'center center' => 'center center',
			'center top' => 'center top',
			'left top' => 'left top',
			'right top' => 'right top',
			'center bottom' => 'center bottom',
			'left bottom' => 'left bottom',
			'right bottom' => 'right bottom',
			'left center' => 'left center',
			'right center' => 'right center',
		);

		$html = '<select name="attachments[' . $post->ID . '][wolf_custom_position]">';

		// Browse and add the options
		foreach ( $options as $k => $v ) {
			// Set the option selected or not
			if ( $field_value == $k )
				$selected = ' selected="selected"';
			else
				$selected = '';

			$html .= '<option' . $selected . ' value="' . $k . '">' . $v . '</option>';
		}

		$html .= '</select>';

		$form_fields['wolf_custom_position']['html'] = $html;

		return $form_fields;
	}
	add_filter( 'attachment_fields_to_edit', 'wolf_image_attachment_add_custom_fields', null, 2);
}

if ( ! function_exists( 'wolf_image_attachment_save_custom_fields' ) ) {
	/**
	 * Save custom field value
	 */
	function wolf_image_attachment_save_custom_fields( $post, $attachment ) {

		$size = 'small-square';
		$position = 'center center';

		if (isset($attachment['wolf_custom_size'])) {
			$size = $attachment['wolf_custom_size'];
		}
		if (isset($attachment['wolf_custom_position'])) {
			$position = $attachment['wolf_custom_position'];
		}

		update_post_meta($post['ID'], 'wolf_custom_size', $size);
		update_post_meta($post['ID'], 'wolf_custom_position', $position);

		return $post;
	}
	add_filter( 'attachment_fields_to_save', 'wolf_image_attachment_save_custom_fields', null , 2);
}

// if ( ! function_exists( 'wolf_image_attachment_save_custom_fields_ajax' ) ) {
// 	/**
// 	 * Save custom field value with ajax on media manager window ( ???)
// 	 */
// 	function wolf_image_attachment_save_custom_fields_ajax() {
// 		$post_id = $_POST['ID'];

// 		$size = 'small-square';
// 		$position = 'center center';

// 		if (isset($_POST['wolf_custom_size'])) {
// 			$size = $_POST['wolf_custom_size'];
// 		}
// 		if (isset($_POST['wolf_custom_position'])) {
// 			$size = $_POST['wolf_custom_position'];
// 		}

// 		update_post_meta($post_id, 'wolf_custom_size', $size);
// 		update_post_meta($post_id, 'wolf_custom_position', $position);
// 		clean_post_cache($post_id);
// 	}
// 	add_action( 'wp_ajax_save-attachment-compat', 'wolf_image_attachment_save_custom_fields_ajax', 0, 1);
// }

if ( ! function_exists( 'wolf_custom_gallery' ) ) {
	/**
	 * Custom Wordpress gallery shortcode output
	 * Renders WP gallery differently depending on context (masonry gallery, slider, default)
	 *
	 */
	add_filter( 'use_default_gallery_style', '__return_false' );
	add_filter( 'post_gallery', 'wolf_custom_gallery', 10, 2 );
	function wolf_custom_gallery( $output, $attr ) {
		global $post, $wp_locale;

		$size = 'thumbnail'; // default image size

		$post_id = get_the_ID();
		$content = get_the_content();
		$pattern = get_shortcode_regex();

		$is_section_gallery = false;
		$is_masonry_blog = false;

		if ( wolf_is_one_paged() || is_page_template( 'page-templates/section.php' ) ) {

			if ( 'post' == get_post_type() ) {
				$is_masonry_blog = true;
			}

			if ( preg_match( "/$pattern/s", $content, $match ) ) {
				if ( 'gallery' == $match[2] && get_post_meta( $post_id, '_section_mosaic', true ) ) {
					$is_section_gallery = true;
				}
			}
		}

		$is_masonry_gallery = is_singular( 'gallery' );

		static $instance = 0;
		$instance++;

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );

			if ( ! $attr['orderby'] )
				unset( $attr['orderby'] );
		}

		extract(
			shortcode_atts(
				array(
					'order'      => 'ASC',
					'orderby'    => 'menu_order ID',
					'id'         => $post_id,
					'itemtag'    => 'li',
					'icontag'    => 'div',
					'captiontag' => 'dd',
					'columns'    => 3,
					'size'       => $size,
					'include'    => '',
					'exclude'    => '',
					'slider' => 'false',
					'background' => 'none',
					'class' => ''
				), $attr
			)
		);

		$is_slider  = ( $is_masonry_blog || 'true' == $slider || 'none' != $background ) && ! $is_section_gallery;
		$is_default = ! $is_slider && ! $is_masonry_gallery && ! $is_section_gallery;
		$is_grid = $is_default;
		$is_work = is_singular( 'work' );

		if ( $is_slider )
			$size = 'post-slide';

		if ( $is_slider && $is_work )
			$size = 'large';

		if ( $is_masonry_gallery )
			$size = 'masonry-thumb';

		if ( 'tablet' == $background )
			$size = 'tablet-slide';

		if ( 'laptop' == $background )
			$size = 'laptop-slide';

		if ( 'desktop' == $background )
			$size = 'desktop-slide';

		$id = intval( $id );
		if ( 'RAND' == $order )
			$orderby = 'none';

		if ( ! empty( $include ) ) {
			$include = preg_replace( '/[^0-9,]+/', '', $include );
			$_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( ! empty( $exclude ) ) {
			$exclude     = preg_replace( '/[^0-9,]+/', '', $exclude );
			$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
		} else {
			$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
		}

		if ( empty( $attachments ) )
			return '';

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
			return $output;
		}

		$itemtag    = tag_escape( $itemtag );
		$captiontag = tag_escape( $captiontag );
		$columns    = intval( $columns );
		$itemwidth  = $columns > 0 ? floor( 100 / $columns ) : 100;
		$float = is_rtl() ? 'right' : 'left';

		$rand = rand( 1,999 );
		$gallery_id = $post_id.$rand;
		$selector   = "gallery-$gallery_id";

		$get_class = 'clearfix gallery default-gallery';

		if ( $is_masonry_gallery ) {

			$get_class = 'clearfix gallery masonry-gallery';

		} elseif ( $is_grid ) {

			$get_class = 'clearfix gallery grid-gallery';
			//$columns   = ( 1 < $columns ) ? $columns - 1 : 1;

		} elseif ( $is_section_gallery ) {
			$get_class = 'clearfix gallery masonry-section-gallery';
		}


		$open_tag = "<div id='$selector' class='$get_class'>";

		if ( ! $is_section_gallery )
			$open_tag .= '<ul>';

		if ( $is_slider )
			$open_tag = "<div class='slider-background-$background $class'><div id='$selector' class='clearfix flexslider wolf-gallery-slider'><ul class='slides'>";

		$gallery_style = '';

		if ( $is_default  ){
			$gallery_style = "<style type='text/css'>
			#{$selector}.default-gallery {
				margin: auto;
				margin-bottom:1em;
			}
			#{$selector}.default-gallery ul li {
				float: {$float};
				margin-top: 10px;
				text-align: center;
				width: {$itemwidth}%;
			}
			#{$selector}.default-gallery img {
				border: 2px solid #cfcfcf;
			}
			#{$selector}.default-gallery .gallery-caption {
				margin-left: 0;
			}
			</style>";
		}

		if ( $is_grid ) {

			$itemwidth = $columns > 0 ? number_format( 100 / $columns, 2 ) : 100;

			$gallery_style = "<style type='text/css'>
			#{$selector} {
				margin: auto;
				margin-bottom:1em!important;
			}
			#{$selector} ul li {
				float: {$float};
				margin-top: 0;
				text-align: center;
				width: {$itemwidth}%;
			}

			#{$selector} ul li:first-child{
				width: 100%;
			}

			#{$selector} ul li a img{
				width: 100%;
			}

		        </style>";
		}

		$output = apply_filters(
			'gallery_style', "$gallery_style
			<!-- see gallery_shortcode() in wp-includes/media.php -->
		$open_tag"
		);

		$i = 0;
		foreach ( $attachments as $id => $attachment ) {

			$i++;

			if ( $is_work && ! $is_slider ) {
				if ( $i == 1 ) {
					$size = 'large';
				} elseif ( $i > 1 && $columns == 1 ) {
					$size = 'large';
				} elseif ( $i > 1 && 3 >= $columns ) {
					$size = 'gallery-big-thumb';
				} elseif ( $i > 1 && 3 < $columns ) {
					$size = 'gallery-thumb';
				}
			}

			// var_dump( $size );

			if ( ! $is_work ) {
				if ( $i == 1 && $is_grid )
					$size = 'post-slide';
				elseif ( $i > 1 && $is_grid )
					$size = 'gallery-thumb';
			}

			$caption    = '';
			$link_class = '';
			$img = wp_get_attachment_image_src( $id, $size, false, false );
			$full = wp_get_attachment_image_src( $id, 'full', false, false );
			$photo_bg = wp_get_attachment_image_src($id, 'photo-bg', false, false);

			if ( $captiontag && trim( $attachment->post_excerpt ) )
				$caption = wolf_sample( wptexturize( $attachment->post_excerpt ), 88 );

			if ( $img[0] && $full[0] && $photo_bg[0] ) {

				$src = $img[0];
				$full_size = $full[0];
				$photo_bg = $photo_bg[0];

				if ( ! $is_slider ){

					$link_class = ' class="lightbox"';
				}

				$img = '<a'. $link_class .' title="'. $caption .'" href="'. $full_size .'" rel="lightbox[gallery-' . $post->ID . ']">
	<img src="' . $src . '" alt="'. wptexturize( $attachment->post_title ) .'"></a>';
			}

			$link = isset($attr['link']) && 'post' == $attr['link'] ? wp_get_attachment_link( $id, $size, true, false ) : $img;


			if ( $is_masonry_blog )
				$link = '<a'. $link_class .' title="'. $caption .'" href="'. get_permalink() .'" rel="lightbox[gallery-' . $post->ID . ']">
	<img src="' . $src . '" alt="'. wptexturize( $attachment->post_title ) .'"></a>';

			if ( $is_slider )
				$link = '<img src="' . $src . '" alt="'. wptexturize( $attachment->post_title ) .'">';

			if ( $is_section_gallery ){
				$disposition = 'small-square';
				$position = 'center center';

				if ( get_post_meta( $attachment->ID, 'wolf_custom_size', true ) )
					$disposition = get_post_meta($attachment->ID, 'wolf_custom_size', true);

				if ( get_post_meta( $attachment->ID, 'wolf_custom_position', true ) )
					$position = get_post_meta($attachment->ID, 'wolf_custom_position', true);

				$link = '<div class="photo-item ' . $disposition .'"><a title="' . $caption . '" href="' . $full_size . '" class="lightbox photo-full-size-link">
					<span class="img-container" style="background-image:url(' . $photo_bg .'); background-position:' . $position . '"></span>
				</a></div>';
			}

			if ( $is_slider ){
				$output .= "<{$itemtag} class='slide'";

				//$output .= $data_thumb_attr;

				$output .= '>';

			} elseif( ! $is_section_gallery ) {
				$output .= "<{$itemtag}>";
			}

			$output .= "$link";

			if ( $caption && $is_slider )
				$output .= "<p class='flex-caption'>$caption</p>";

			if( ! $is_section_gallery )
				$output .= "</{$itemtag}>";
		}

		if ( $is_section_gallery )
			$open_tag .=  "</div>\n";
		else
			$output .= "</ul></div>\n";

		if ( $is_slider )
			$output .= "</div>\n";

		return $output;
	}
} // end if gallery