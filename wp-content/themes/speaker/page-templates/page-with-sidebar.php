<?php
/*
* Template Name: Page with Sidebar
*/
get_header(); 
wolf_page_before();
?>
	<div id="primary" class="content-area">
		<main id="content" class="site-content" role="main">
		
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php get_template_part( 'partials/content', 'page' ); ?>

			<?php endwhile; ?>

		</main><!-- main#content .site-content-->
	</div><!-- #primary .content-area -->
<?php 
get_sidebar();
wolf_page_after(); 
get_footer(); 
?>