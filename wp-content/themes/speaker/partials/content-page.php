<?php
/**
 * The template for displaying the page content
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail( 'extra-large' ); ?>
			</div>
		<?php endif; ?>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'wolf' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->

<?php // comments_template(); ?>