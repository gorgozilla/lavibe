<?php
/**
 * The Home Page Header
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
$header_type = wolf_get_theme_option( 'home_header_type' );
$hero        = wolf_format_custom_content_output( stripslashes( wolf_get_theme_option( 'home_header_content' ) ) );
$video_mp4   = wolf_get_theme_option( 'video_bg_mp4' );
$video_webm  = wolf_get_theme_option( 'video_bg_webm' );
$video_ogv  = wolf_get_theme_option( 'video_bg_ogv' );
$video_fallback = wolf_get_theme_option( 'video_bg_fallback' );

if (
	( $header_type == 'video' || $header_type == 'full-video' ) && ( $video_webm || $video_mp4 )
) : ?>
	<div class="section-video-container">
		<video class="section-video" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
			<?php if ( $video_mp4 ) : ?>
				<source src="<?php echo esc_url( $video_mp4 ); ?>" type="video/mp4">
			<?php endif; ?>
			<?php if ( $video_webm ) : ?>
				<source src="<?php echo esc_url( $video_webm ); ?>" type="video/webm">
			<?php endif; ?>
			<?php if ( $video_ogv ) : ?>
				<source src="<?php echo esc_url( $video_ogv ); ?>" type="video/ogg">
			<?php endif; ?>
			<?php if ( $video_fallback ) : ?>
				<img src="<?php echo esc_url( $video_fallback ); ?>">
			<?php endif; ?>
		</video>
	</div>
<?php endif ?>

<?php
if ( ! wolf_is_revslider_in_home_header() ) : ?>
	<div id="hero">
		<div id="hero-content">
			<div class="wrap">
				<?php wolf_logo(); ?>
				<?php echo $hero; ?>
			</div>
		</div>
	</div>
<?php elseif (  wolf_is_revslider_in_home_header() ) : ?>
	<div class="wolf_revslider_container"><?php echo $hero; ?></div>
<?php endif; ?>

