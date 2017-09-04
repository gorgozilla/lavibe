<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Wolf_One_Page_Nav_Walker' ) ) {

	class Wolf_One_Page_Nav_Walker extends Walker_Nav_Menu {
		
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			
			global $wp_query;
			
			$indent = ( $depth ) ? str_repeat( "", $depth ) : '';
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="'. esc_attr( $class_names ) . '"';
			
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
			
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			
			if ( $item->object == 'page' ) {

				$prefix = wolf_is_one_paged() ? '' : esc_url( home_url( '/' ) );

				$varpost = get_post( $item->object_id );
				$post_id = $varpost->ID;

				$is_page = get_post_meta( $post_id, '_wp_page_template', true ) != 'page-templates/section.php';
				$hide = get_post_meta( $post_id, '_section_menu_hide', true );
				
				$class = ( wolf_is_one_paged() && ! $is_page ) ? 'scroll' : '';
				
				$href = $prefix . '#' . wolf_get_section_slug( $post_id );

				if ( $is_page ) {
					$href = get_permalink( $post_id );
				}

				if ( wolf_is_one_paged() && $post_id == wolf_get_one_page_id() ) {
					
					$href = '#top';
					$class = 'scroll home-menu-item';
				
				} elseif ( $post_id == wolf_get_one_page_id() ) {
					$class = 'home-menu-item';
				}

				if ( $hide ) {
					$class = ' hide';
				}

				// if ( wolf_is_one_paged() ) {
					
				// 	$attributes .= ' href="#' . $varpost->post_name . '"';
				
				// } else {
					
				// 	$attributes .= ' href="' . home_url() . '/#' . $varpost->post_name . '"';
				// }

				$attributes .= ' href="' . $href . '"';

				if ( $class ) {

					$attributes .= " class='$class'";
				}
			
			} else {
			
				$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
			}

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
			$item_output .= $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}