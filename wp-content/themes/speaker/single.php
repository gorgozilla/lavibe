<?php
/**
 * The Template for displaying all single blog posts.
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
get_header();
wolf_post_before();
?>
	<div id="primary" class="content-area">
		<main id="content" class="site-content clearfix" role="main">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php wolf_post_start(); ?>

				<header class="entry-header">
					
					<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<?php wolf_entry_thumbnail(); ?>
					<?php endif; ?>

					<div class="entry-meta">
						<?php wolf_entry_meta(); ?>
						<?php if ( comments_open() ) : ?>
						<span class="comments-link">
							<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'wolf' ) . '</span>', __( 'One comment so far', 'wolf' ), __( 'View all % comments', 'wolf' ) ); ?>
						</span><!-- .comments-link -->
						<?php endif; // comments_open() ?>
						<?php edit_post_link( __( 'Edit', 'wolf' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</header>

				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'wolf' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div>
				
				<?php wolf_post_end(); ?>
				<?php wolf_post_nav(); ?>
				
				<?php comments_template(); ?>
				
			</article><!-- article.post -->
		<?php endwhile; ?>
		</main><!-- main#content .site-content-->
	</div><!-- #primary .content-area -->
<?php
get_sidebar();
wolf_post_after();
get_footer(); 
?>