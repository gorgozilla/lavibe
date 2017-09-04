<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
get_header();
wolf_page_before(); // before page hook
?>
	<div id="primary" class="content-area">
		<main id="content" class="site-content clearfix" role="main">
		<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
					/**
					 * The post content template
					 */
					get_template_part( 'partials/content', 'post' );

				?>
			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'partials/content', 'none' ); ?>
		<?php endif; ?>

		</main><!-- #content -->

		<?php
			/**
			 * Pagination numbers
			 */
			wolf_pagination();
		?>

	</div><!-- #primary -->
<?php
get_sidebar();
wolf_page_after(); // after page hook
get_footer();
?>