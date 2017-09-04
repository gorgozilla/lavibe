<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main section and all content after
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
?>
		<?php wolf_content_end(); ?>
		</div><!-- .site-wrapper -->
	</section><!-- section#main -->
	<?php wolf_content_after(); ?>
	
	<?php wolf_footer_before(); ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php wolf_footer_start(); ?>

		<?php get_sidebar( 'footer' ); ?>
		
		<?php wolf_footer_end(); ?>
		
		<?php wolf_site_info(); ?>
	</footer><!-- footer#colophon .site-footer -->
	<?php wolf_footer_after(); ?>
</div><!-- #page .hfeed .site -->

<?php wolf_body_end(); ?>
<?php wp_footer(); ?>
</body>
</html>