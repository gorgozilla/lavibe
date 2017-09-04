<?php
/**
 * Template Name: Instagram Gallery
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
get_header();

	if ( function_exists( 'wolf_instagram_gallery' ) ) wolf_instagram_gallery();

get_footer(); 
?>