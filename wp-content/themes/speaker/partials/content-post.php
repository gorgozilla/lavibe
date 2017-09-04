<?php
/**
 * The post content displayed in the loop
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
?>
<article <?php post_class( 'clearfix' ); ?>  id="post-<?php the_ID(); ?>">
		<header class="entry-header">
			<?php wolf_entry_title(); ?>
		</header><!-- header.entry-header -->

		<?php wolf_entry_thumbnail(); ?>

		<?php if ( ! post_password_required() ) : ?>
			<div class="entry-content">
				<?php if ( ! is_search() ) : ?>
					<?php the_content( __( 'Continue reading &rarr;', 'wolf' ) ); ?>
				<?php else : ?>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">

			<?php wolf_entry_meta(); ?>

			<?php if ( comments_open() ) : ?>
			<span class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'wolf' ) . '</span>', __( 'One comment so far', 'wolf' ), __( 'View all % comments', 'wolf' ) ); ?>
			</span><!-- .comments-link -->
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- footer.entry-meta -->
</article><!-- article -->
