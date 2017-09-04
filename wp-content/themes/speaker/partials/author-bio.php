<?php
/**
 * The template for displaying Author bios.
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
?>
<div class="author-info clearfix">
	<div class="author-avatar col-2 alpha">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 80 ); ?>
		<?php wolf_display_author_socials(); ?>
	</div><!-- .author-avatar -->
	<div class="author-description col-10 omega">
		<h5><?php printf( __( 'About %s', 'wolf' ), get_the_author() ); ?></h5>
		<p>
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'wolf' ), get_the_author() ); ?>
			</a>
		</p>
	</div><!-- .author-description -->
</div><!-- .author-info -->