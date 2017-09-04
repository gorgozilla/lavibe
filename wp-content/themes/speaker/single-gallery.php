<?php
/**
 * The Template for displaying all single gallery posts.
 *
 * This template is added in case Wolf Albums is installed
 * http://wolfthemes.com/plugin/wolf-albums/
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
get_header();
wolf_post_before();
?>
	<main id="content" class="site-content clearfix" role="main">
		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_content(); ?>
			<?php wolf_post_nav(); ?>
		</article><!-- article.post -->
		<?php endwhile; ?>
	</main>
<?php 
wolf_post_after();
get_footer(); 
?>