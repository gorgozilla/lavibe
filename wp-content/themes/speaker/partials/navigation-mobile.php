<?php
/**
 * The Main navigation
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
?>
<div id="navbar-mobile-container">
	<div id="navbar-mobile" class="navbar clearfix">
		<span id="close-menu">&times;</span>
		<h3 id="menu-toggle"><span id="menu-toggle-overlay"></span></h3>
		<nav id="site-navigation-primary-mobile" class="navigation main-navigation clearfix" role="navigation">
			<?php
				/**
				 * Main Navigation
				 */
				wp_nav_menu( 
					array(
						'theme_location' => 'primary', 
						'menu_class'     => 'nav-menu',
						'menu_id'        => 'one-page-mobile-menu',
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