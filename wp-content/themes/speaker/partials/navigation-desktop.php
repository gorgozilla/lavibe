<?php
/**
 * The Main navigation
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
?>
<div id="navbar-container">
	<div id="navbar" class="navbar clearfix">
		<nav id="site-navigation-primary" class="navigation main-navigation clearfix" role="navigation">
			<?php
				/**
				 * Main Navigation
				 */
				wp_nav_menu( 
					array(
						'theme_location' => 'primary', 
						'menu_class'     => 'nav-menu',
						'menu_id'        => 'one-page-menu',
						'fallback_cb'    => 'wolf_one_page_menu',
						'before'         => '',
						'after'          => '',
						'link_before'    => '',
						'link_after'     => '',
						'depth'          => 0,
						'walker'         => new Wolf_One_Page_Nav_Walker(),
					)
				);
			?>
		</nav><!-- #site-navigation-primary -->
	</div><!-- #navbar -->
</div><!-- #navbar-container -->