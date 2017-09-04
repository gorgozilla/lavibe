<?php
/**
 * Speaker ajax functions
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

if ( ! function_exists( 'wolf_get_video_url_from_post_id' ) ) {
	/**
	 * Get Video URL
	 */
	function wolf_get_video_url_from_post_id() {

		extract( $_POST );

		$post_id = $_POST['id'];
		$content_post = get_post( $post_id );
		$content = $content_post->post_content;

		$has_video_url = 
		// youtube
		preg_match( '#(?:\www.)?\youtube.com/watch\?v=([A-Za-z0-9\-_]+)#', $content, $match )
		|| preg_match( '#(?:\www.)?\youtu.be/([A-Za-z0-9\-_]+)#', $content, $match )
		
		// vimeo
		|| preg_match( '#vimeo\.com/([0-9]+)#', $content, $match )

		// other
		|| preg_match( '#http://blip.tv/.*#', $content, $match )
		|| preg_match( '#https?://(www\.)?dailymotion\.com/.*#', $content, $match )
		|| preg_match( '#http://dai.ly/.*#', $content, $match )
		|| preg_match( '#https?://(www\.)?hulu\.com/watch/.*#', $content, $match )
		|| preg_match( '#https?://(www\.)?viddler\.com/.*#', $content, $match )
		|| preg_match( '#http://qik.com/.*#', $content, $match )
		|| preg_match( '#http://revision3.com/.*#', $content, $match )
		|| preg_match( '#http://wordpress.tv/.*#', $content, $match )
		|| preg_match( '#https?://(www\.)?funnyordie\.com/videos/.*#', $content, $match )
		|| preg_match( '#https?://(www\.)?flickr\.com/.*#', $content, $match )
		|| preg_match( '#http://flic.kr/.*#', $content, $match );


		$video_url = ( $has_video_url ) ? esc_url( $match[0] ) : null;

		$video_meta = get_post_meta( $post_id, '_format_video_embed', true );
					
		if ( $video_meta  )
			$video_url = wolf_get_iframe_video_url( $video_meta );
		
		echo $video_url;

		exit;

	}
	add_action('wp_ajax_wolf_get_video_url_from_post_id', 'wolf_get_video_url_from_post_id');
	add_action('wp_ajax_nopriv_wolf_get_video_url_from_post_id', 'wolf_get_video_url_from_post_id');
}