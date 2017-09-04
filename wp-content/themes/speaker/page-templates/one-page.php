<?php
/*
 * Template Name: One-Page
 */
get_header();
wolf_page_before();
$loop = wolf_one_page_loop();
?>
	<main id="content" class="site-content" role="main">
		<?php /* The loop */ ?>
		<?php if ( $loop->have_posts() ) : ?>
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				
				<?php get_template_part( 'partials/content', 'section' ); ?>

			<?php endwhile; ?>
		<?php endif; ?>
	</main><!-- #content .site-content-->
<?php
wolf_page_after();
get_footer(); 
?>