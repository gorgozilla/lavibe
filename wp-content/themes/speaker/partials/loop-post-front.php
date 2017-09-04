<?php
/**
 * The post loop on front page
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
$args = array(
	'post_type' => 'post',
	'posts_per_page' => wolf_get_theme_option( 'home_post_count', 6 ),
);

$loop = new WP_Query( $args );
?>
<?php /* The loop */ ?>
<?php if ( $loop->have_posts() ) : ?>
<div id="posts-front-page">
	<?php while ( $loop->have_posts() ) : $loop->the_post(); 
		$format = get_post_format() ? get_post_format() : 'standard';
		$custom_bg = '';
		$custom_bg_class = '';

		if ( wolf_is_one_paged() && has_post_thumbnail() && ( $format == 'aside' || $format == 'status' || $format == 'link' || $format == 'quote' ) ) {
			$custom_bg = ' style="background-image:url('. wolf_get_post_thumbnail_url( 'image-thumb' ) .');
			background-position:center center, 
			background-attachment:scroll;
			background-repeat:no-repeat, 
			-webkit-background-size: 100%; 
			-o-background-size: 100%; 
			-moz-background-size: 100%; 
			background-size: 100%;
			-webkit-background-size: cover;
			-o-background-size: cover; 
			background-size: cover;"';
			$custom_bg = wolf_compact_css( $custom_bg );
			$custom_bg_class = ' has-bg';
		}
		global $more;
		$more = 0;
	?>
		<article <?php post_class( 'clearfix' ); ?>  id="post-<?php the_ID(); ?>">

			<div class="entry-frame">
				<header class="entry-header">
					<?php 
					$media = wolf_post_media();
					if ( $media && ! post_password_required() ) : ?>
						<div id="post-media-container" class="clearfix<?php echo $custom_bg_class; ?>"<?php echo $custom_bg; ?>>
							<?php echo $media; ?>
						</div>
					<?php endif; ?>
				</header><!-- header.entry-header -->
				
				<div class="entry-inner">

					<?php if ( $format != 'aside' && $format != 'status' && $format != 'link' && $format != 'quote' ) : ?>
						<h2 class="entry-title">
							<a class="entry-link" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h2>
					<?php endif; ?>

					<?php if ( ! wolf_is_one_paged() || is_search() ) : ?>
						<div class="entry-meta">
							
							<?php wolf_entry_meta(); ?>
							
							<?php if ( comments_open() ) : ?>
								<span class="comments-link">
									<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'wolf' ) . '</span>', __( 'One comment so far', 'wolf' ), __( 'View all % comments', 'wolf' ) ); ?>
								</span><!-- .comments-link -->
							<?php endif; // comments_open() ?>
							<?php edit_post_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- footer.entry-meta -->
					<?php endif; // endif masonry ?>

					<?php if ( ! post_password_required() ) : ?>
						<div class="entry-content">
							<?php if ( $format != 'aside' && $format != 'status' && $format != 'link' && $format != 'quote' ) : ?>
								
								<?php if ( ! is_search() ) : ?>
									<?php echo wolf_no_media_content(); ?>
								<?php else : ?>
									<?php the_excerpt(); ?>
								<?php endif; ?>
							
							<?php elseif ( $format == 'aside' || $format == 'status' ) : ?>	

								<?php the_content( wolf_more_text() ); ?>

							<?php endif; ?>
						</div><!-- .entry-content -->
						<?php if ( ! wolf_is_one_paged() ) : ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'wolf' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						<?php endif; ?>
					<?php endif; ?>


					<?php if ( wolf_is_one_paged() && ! is_search() ) : ?>
						<footer class="entry-meta">
							
							<?php wolf_entry_meta(); ?>
							
							<?php if ( comments_open() ) : ?>
							<span class="comments-link">
								<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'wolf' ) . '</span>', __( 'One comment so far', 'wolf' ), __( 'View all % comments', 'wolf' ) ); ?>
							</span><!-- .comments-link -->
							<?php endif; // comments_open() ?>
							<?php edit_post_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '</span>' ); ?>
						</footer><!-- footer.entry-meta -->
					<?php endif; // endif masonry ?>
				</div><!-- .entry-inner -->
			</div><!-- .entry-frame -->
		</article><!-- article -->
	<?php endwhile; wp_reset_query(); ?>
</div>
<?php
$button_class = get_post_meta( get_option( 'page_for_posts' ), '_section_font_color', true ) == 'dark' ? 'button-alt' : 'button-alt-light';
?>
<p class="text-center"><a href="<?php echo wolf_get_blog_url(); ?>" class="<?php echo $button_class; ?> read-more-news-button"><?php _e( 'Read More News', 'wolf' ); ?></a></p>
<?php else : ?>
	<p class="text-center"><?php _e( 'No post published yet.', 'wolf' ); ?></p>
<?php endif; ?>
