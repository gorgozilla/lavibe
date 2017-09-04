<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
if ( 
	( is_active_sidebar( 'sidebar-main' ) && wolf_get_theme_option( 'blog_sidebar' ) && ( 'post' == get_post_type() || is_search() ) ) 
	|| is_page()
) : ?>
	<div id="secondary" class="sidebar-container" role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">

				<?php dynamic_sidebar( 'woocommerce' ); ?>

				<?php if ( function_exists( 'wolf_sidebar' ) ) : ?>

					<?php  wolf_sidebar(); ?>

				<?php else : ?>

					<?php  dynamic_sidebar( 'sidebar-main' ); ?>
					
				<?php endif; ?>

			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	</div><!-- #secondary .sidebar-container -->
<?php endif; ?>