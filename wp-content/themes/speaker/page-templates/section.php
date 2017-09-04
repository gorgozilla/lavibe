<?php
/*
 * Template Name: Section
 */
get_header(); 
wolf_page_before();
?>
	<main id="content" class="site-content clearfix" role="main">

		<?php /* The loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php get_template_part( 'partials/content', 'section' ); ?>

		<?php endwhile; ?>

	</main><!-- main#content .site-content-->
<?php
wolf_page_after(); 
get_footer(); 
?>