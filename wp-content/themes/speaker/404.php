<?php 
/**
 * The template for displaying 404 pages (Not Found).
 * 
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
get_header();
?>
	<div id="primary" class="content-area entry-content">
		<div id="content" class="site-content" role="main">
			<article id="post-0" class="post error404 not-found center">
				<h1>:(</h1>
				<h2><?php _e( '404 Page not found !', 'wolf' ); ?></h2>
				<p><?php _e( 'You\'ve tried to reach a page that doesn\'t exist or has moved.', 'wolf' ); ?></p>
				<p><a href="<?php echo home_url(); ?>/">&larr; <?php _e( 'back home', 'wolf' ); ?></a></p>
			</article>
		</div><!-- #content .site-content-->
	</div><!-- #primary .content-area -->
<?php 
get_footer(); 
?>