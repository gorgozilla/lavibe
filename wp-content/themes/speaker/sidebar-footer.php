<?php
/**
 * The Sidebar containing the footer widget area.
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
	<section id="tertiary" class="sidebar-footer container" role="complementary">
		<div class="sidebar-inner wrap">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-footer' ); ?>
			</div>
		</div>
	</section><!-- #tertiary .sidebar-footer -->
<?php endif; ?>