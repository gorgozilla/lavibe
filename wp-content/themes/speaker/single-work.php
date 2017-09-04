<?php
/**
 * The Template for displaying all single portfolio posts.
 *
 * This template is added in case Wolf Portfolio is installed
 * http://wolfthemes.com/plugin/wolf-portfolio/
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
get_header();
wolf_post_before();
?>
	<main id="content" class="site-content clearfix" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<section id="post-media">
				<?php
				$media = wolf_post_media();
				if ( $media && ! post_password_required() ) : ?>
				<div id="post-media-container" class="wrap">
					<?php echo $media; ?>
				</div>
				<?php endif; ?>
			</section>
			<section id="post-content" class="small-width">
				<?php wolf_post_start(); ?>
				<main id="content" class="site-content" role="main">
					<div class="work-entry-meta">
						<?php wolf_work_meta(); ?>
					</div><!-- .work-meta-container -->
					<?php if ( '' != wolf_no_media_content() ) : ?>
					<div class="entry-content">
						<?php echo wolf_no_media_content(); ?>
					</div>
					<?php endif; ?>
				</main><!-- #content -->
				<?php wolf_post_end(); ?>
				<?php wolf_post_nav(); ?>
			</section><!-- #post-content -->
		</article><!-- article.post -->
		<?php endwhile; ?>
	<main><!-- .main -->
<?php
wolf_post_after();
get_footer(); 
?>