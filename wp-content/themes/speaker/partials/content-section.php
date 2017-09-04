<?php
/**
 * The template for displaying the section content
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
?>
<?php
$post_id = get_the_ID();
$video_bg = get_post_meta( $post_id, '_section_video_bg', true );
$video_webm = get_post_meta( $post_id, '_section_video_bg_webm', true );
$video_ogv = get_post_meta( $post_id, '_section_video_bg_ogv', true );
$video_opacity = absint( get_post_meta( $post_id, '_section_video_bg_opacity', true ) ) / 100;
?>
<section id="<?php echo wolf_get_section_slug(); ?>" <?php post_class(); ?>>
	<div class="section-inner container">
		<?php if ( $video_bg ) :
			$video_opacity_style = ( $video_opacity > 0 ) ? ' style="opacity:' . $video_opacity . ';"' : '';
		?>
			<div class="section-video-container">
				<video<?php echo $video_opacity_style; ?> class="section-video" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0">
					<source src="<?php echo esc_url( $video_bg ); ?>" type="video/mp4">
					<?php if ( $video_webm ) : ?>
						<source src="<?php echo esc_url( $video_webm ); ?>" type="video/webm">
					<?php endif; ?>
					<?php if ( $video_ogv ) : ?>
						<source src="<?php echo esc_url( $video_ogv ); ?>" type="video/ogg">
					<?php endif; ?>
				</video>
			</div>
		<?php endif; ?>
		<div class="section-wrap wrap">
			<?php if ( get_option( 'page_for_posts' ) == $post_id ) : ?>
				<?php get_template_part( 'partials/loop', 'post-front' ); ?>
			<?php else : ?>
				<?php the_content(); ?>
			<?php endif; ?>
		</div><!-- .entry-content -->
		<?php edit_post_link( __( 'Edit Section', 'wolf' ), '<span class="edit-section-link">', '</span>', $post_id ); ?>
	</div><!-- .section-inner -->
</section><!-- section#<?php echo wolf_get_section_slug(); ?> -->