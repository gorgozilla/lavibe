<?php
/*-----------------------------------------------------------------------------------*/
/*
/*	Shortcodes
/*
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wolf_shortcode_content_format' ) ) {
	/**
	 * Format shortcode content output
	 *
	 * Remove empty p tag around shortcodes
	 */
	function wolf_shortcode_content_format( $content ) {
		$array = array(
			'<p>[' => '[',
			']</p>' => ']',
			']<br />' => ']'
		);
		$content = strtr($content, $array);
		return $content;
	}
	add_filter( 'the_content', 'wolf_shortcode_content_format' );
}

if ( ! function_exists( 'wolf_columns_shortcode' ) ) {
	/**
	 * Columns Shortcode
	 */
	function wolf_columns_shortcode( $atts, $content = null, $tag ) {
		
		extract( shortcode_atts(  array(
			'class' => '',
			'style' => ''
		), $atts ) );

		$col = $tag;
		$output = '';
		$inline_style = ( $style ) ? ' style="' . $style . '"' : '';
		$class = str_replace( array( 'alpha', 'first', 'omega', 'last' ), array( 'wolf_col_alpha', 'wolf_col_first', 'wolf_col_omega', 'wolf_col_last' ), $class );

		if ( $class == 'wolf_col_alpha' || $class == 'wolf_col_first' || $col == 'wolf_col_12' ) {
			$output .='<div class="wolf_shortcode_clear"></div>';
		}
			
		
		$output .= '<div class="' . $col . ' ' . $class . '"' . $inline_style . '>' . do_shortcode( $content ) . '</div>';
		
		if ( $class == 'wolf_col_omega' || $class == 'wolf_col_last' || $col == 'wolf_col_12' ) {
			$output .='<div class="wolf_shortcode_clear"></div>';
		}
			

		return $output;

	}

	$tags = array(
		'1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'
	);

	foreach( $tags as $tag ) {
		add_shortcode( 'wolf_col_' . $tag, 'wolf_columns_shortcode'  );
	}
}

if ( ! function_exists( 'wolf_highlight_shortcode_text' ) ) {
	/**
	 * Highlighted Text
	 */
	function wolf_highlight_shortcode_text( $atts, $content = null ) {
		return '<span class="wolf-highlight-'.$atts['color'].'">'.$content.'</span>';
	}
	add_shortcode( 'wolf_highlight_text', 'wolf_highlight_shortcode_text' );
}

if ( ! function_exists( 'wolf_notif_shortcode' ) ) {
	/**
	 * Notifications
	 */
	function wolf_notif_shortcode( $atts, $content = null ) {
		
		if ( ! wp_script_is( 'jquery' ) )
			wp_enqueue_script( 'jquery' );
		
		wp_enqueue_script( 'wolf-notifications', WOLF_SHORTCODES_PLUGIN_URL . '/assets/js/min/notifications.min.js', 'jquery', WOLF_SHORTCODES_VERSION, true );
		return '<div class="wolf-notif '.$atts['type'].'"><div><strong>'.ucfirst($atts['type']).'</strong>  : '.do_shortcode( $content ).'<a href="#" class="wolf-notif-close">&times;</a></div></div>';
	}
	add_shortcode( 'wolf_notif', 'wolf_notif_shortcode' );
}

if ( ! function_exists( 'wolf_button') ) {
	/**
	 * Buttons
	 */
	function wolf_button( $atts, $content = null ) {
		
		extract( shortcode_atts( array(
			'url' => '#',
			'target' => '_self',
			'color' => 'yellow',
			'custom_color' => null,
			'size' => 'small',
			'type' => 'square',
			'download' => 'false',
			'download_pdf' => 'false',
			'tagline' => ''
		), $atts ) );

		if ( $custom_color )
			$color = '';

		$inline_style = '';
		$dl = '';
		$tl = '';

		if ( $download == 'true' ) {
			$dl = '<span class="wolf-download-arrow"></span>';
		}
			

		if ( $download_pdf == 'true' ) {
			$dl = '<span class="wolf-download-pdf"></span>';
		}

		if ( $tagline ) {
			$tl = '<span class="wolf-button-tagline">' . $tagline . '</span>';
		}

		return '<a' . $inline_style . ' target="' . $target . '" class="wolf-button ' . $size . ' ' . $color . ' ' . $type . '" href="'.$url.'">' . do_shortcode( $content ) . $dl . $tl . '</a>';
	}
	add_shortcode( 'wolf_button', 'wolf_button' );
}


/*-----------------------------------------------------------------------------------*/
/*  jQuery UI shortcode (tabs & accordion)
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'wolf_accordion_start_shortcode' ) ) {
	/**
	 * jQuery-UI Accordion
	 */
	function wolf_accordion_start_shortcode( $atts, $content ) {
		
		extract( shortcode_atts( array(
			'skin' => 'light'
		), $atts ) );

		if ( ! wp_script_is( 'jquery' ) )
			wp_enqueue_script( 'jquery' );

		if ( ! wp_script_is('jquery-ui-accordion') )
			wp_enqueue_script( 'jquery-ui-accordion', true );
		
		wp_enqueue_script( 'wolf-accordion', WOLF_SHORTCODES_PLUGIN_URL . '/assets/js/min/accordion.min.js', 'jquery', WOLF_SHORTCODES_VERSION, true );

		return '<div class="wolf-accordion wolf-accordion-skin-'.$skin.' wolf-accordion-shortcode">';
	}
	add_shortcode( 'wolf_accordion_start', 'wolf_accordion_start_shortcode' );
}

if ( ! function_exists( 'wolf_accordion_end_shortcode' ) ) {
	function wolf_accordion_end_shortcode() {
		return '</div><div class="wolf_shortcode_clear"></div>';
	}
	add_shortcode( 'wolf_accordion_end', 'wolf_accordion_end_shortcode');
}

if ( ! function_exists( 'wolf_accordion_panel_shortcode' ) ) {
	function wolf_accordion_panel_shortcode( $atts, $content ) {
		
		extract( shortcode_atts( array(
			'title' => ''
		), $atts ) );
		
		return '<h6><a href="#">'.$title.'</a></h6><div>' . do_shortcode( $content ) . '</div>';
	}
	add_shortcode( 'wolf_panel', 'wolf_accordion_panel_shortcode' );
}

if ( ! function_exists( 'wolf_jqtools_tab_group' ) ) {
	/**
	* jQuery-UI Tabs
	*/
	function wolf_jqtools_tab_group( $atts, $content ) {

		extract( shortcode_atts( array(
			'skin' => 'light'
		), $atts ) );
		
		if ( ! wp_script_is( 'jquery' ) )
			wp_enqueue_script( 'jquery' );

		if ( ! wp_script_is('jquery-ui-tabs') )
			wp_enqueue_script( 'jquery-ui-tabs', true );

		wp_enqueue_script( 'wolf-tabs', WOLF_SHORTCODES_PLUGIN_URL . '/assets/js/min/tabs.min.js', 'jquery', WOLF_SHORTCODES_VERSION, true );
		$GLOBALS['tab_count'] = 0;
		$i=0;
		do_shortcode( $content );

		if ( is_array( $GLOBALS['tabs'] ) ) {
			foreach( $GLOBALS['tabs'] as $tab ) {
				$i++;
				$tabs[] = '<li><a class="" href="#tab-'.$i.'">'.$tab['title'].'</a></li>';
				$panes[] = '<div id="tab-'.$i.'">'.do_shortcode($tab['content']).'</div>';
			}
				$return = "\n".'<!-- the tabs --><ul class="tabs-menu">'.implode( "\n", $tabs ).'</ul><div style="clear:both"></div><div class="tabs-container">'.implode( "\n", $panes ).'</div>'."\n";
		}
		return '<div class="wolf-tabgroup wolf-tabgroup-skin-'.$skin.' wolf-tabgroup-shortcode">'.$return.'</div>';
	}
	add_shortcode( 'wolf_tabgroup', 'wolf_jqtools_tab_group' );
}

if ( ! function_exists( 'wolf_jqtools_tab' ) ) {
	function wolf_jqtools_tab( $atts, $content ) {
		extract( shortcode_atts( array(
			'title' => 'Tab %d'
		), $atts ) );

		$x = $GLOBALS['tab_count'];
		$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

		$GLOBALS['tab_count']++;
	}
	add_shortcode( 'wolf_tab', 'wolf_jqtools_tab' );
}

if ( ! function_exists( 'wolf_toggle_shortcode' ) ) {
	/**
	 * Toggles
	 */
	function wolf_toggle_shortcode( $atts, $content = null ) {
		
		if ( ! wp_script_is( 'jquery' ) )
			wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'wolf-toggles', WOLF_SHORTCODES_PLUGIN_URL . '/assets/js/min/toggles.min.js', 'jquery', WOLF_SHORTCODES_VERSION, true );

		extract( shortcode_atts( array(
			'title' => 'Title',
			'open' => 'false',
		), $atts ) );

		$open_class = '';

		if ( $open == 'true' )
			$open_class = ' open';
		
		return '<div class="wolf-toggle'. $open_class .'"><h5 class="wolf-toggle-title"><span class="wolf-toggle-button"><span class="wolf-toggle-sign"></span></span>'. $title .'</h5><div class="wolf-toggle-content">' . do_shortcode($content) . '</div></div>';
	}
	add_shortcode( 'wolf_toggle', 'wolf_toggle_shortcode');
}

if ( ! function_exists( 'wolf_google_maps_shortcode' ) ) {
	/**
	 * Google Map
	 */
	function wolf_google_maps_shortcode( $atts, $content = null ) {
		
		extract( shortcode_atts( array(
			'width' => '100%',
			'height' => '250',
			'src' => ''
		), $atts ) );
	  
		return '<div class="wolf-google-map">
			<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&output=embed">
		</iframe></div>';
	}
	add_shortcode( 'wolf_googlemap', 'wolf_google_maps_shortcode' );
}

if ( ! function_exists( 'wolf_testimonials_start_shortcode' ) ) {
	/**
	 * Testimonials - Flexslider
	 */
	function wolf_testimonials_start_shortcode( $atts, $content = null ) {
		
		$output = '';

		if ( ! wp_script_is( 'jquery' ) )
			wp_enqueue_script( 'jquery' );

		if ( ! wp_style_is( 'flexslider' ) )
			wp_enqueue_style( 'flexslider', WOLF_SHORTCODES_PLUGIN_URL. '/assets/flexslider/flexslider.css', array(), '2.0' );

		if ( ! wp_script_is( 'flexslider' ) )
			wp_enqueue_script( 'flexslider', WOLF_SHORTCODES_PLUGIN_URL . '/assets/flexslider/jquery.flexslider.min.js', 'jquery', '2.1', true );

		
		$output .= '<script type="text/javascript">jQuery(document).ready(function($) {';
		$output .= 'jQuery( ".wolf-testimonials" ).flexslider({
			slideshow : true,
			animation : "slide",
			smoothHeight: true,
			directionNav: false
		});';
		$output .= '});</script>';

		$output .= '<div class="wolf-testimonials flexslider"><ul class="slides">';

		return $output;
	}
	add_shortcode( 'wolf_testimonials_start', 'wolf_testimonials_start_shortcode' );

	function wolf_testimonials_end_shortcode() {
		return '</ul></div><div class="wolf_shortcode_clear"></div>';
	}
	add_shortcode( 'wolf_testimonials_end', 'wolf_testimonials_end_shortcode');

	
	function wolf_testimonial_slide_shortcode( $atts, $content = null ) {
		$output = '';

		extract( shortcode_atts( array(
			'cite' => ''
		), $atts ) );
		
		$output .= '<li><div><blockquote>' . do_shortcode( $content ) . '<cite>' . $cite . '</cite></blockquote></div></li>';

		return $output;
	}
	add_shortcode( 'wolf_testimonial_slide', 'wolf_testimonial_slide_shortcode');
}

/* Last Posts Module
-----------------------------------------------*/

if ( ! function_exists( 'wolf_get_blog_url' ) ) {
	function wolf_get_blog_url() {
		if ( $posts_page_id = get_option( 'page_for_posts' ) ) {
			return home_url( get_page_uri( $posts_page_id ) );
		} else {
			return home_url();
		}
	}
}

if ( ! function_exists( 'wolf_custom_last_posts' ) ) {
	function wolf_custom_last_posts( $count , $cat, $tag ) {
		ob_start();

		$args = array( 
			'post_type' => array( 'post' ),
			'posts_per_page' => $count,
			'ignore_sticky_posts' => 1
		);

		if ( $cat ) 
			$args['category_name'] = str_replace( ' ', '', $cat );

		if ( $tag )
			$args['tag'] = str_replace( ' ', '', $tag );

		$last_post_loop = new WP_Query( $args );
		
		if ( $last_post_loop->have_posts() ) : ?>
		<div class="wolf-last-post">
		<?php while ( $last_post_loop->have_posts() ) : $last_post_loop->the_post(); 
		$format_prefix = ( has_post_format( 'chat' ) || has_post_format( 'status' ) ) ? _x( '%1$s on %2$s', '1: post format name. 2: date', 'wolf' ): '%2$s';

		$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
			esc_url( get_permalink() ),
			esc_attr( sprintf( __( 'Permalink to %s', 'wolf' ), the_title_attribute( 'echo=0' ) ) ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
		);
		?>
			<article <?php post_class(); ?>   id="post-<?php the_ID(); ?>">
				<h3 class="wolf-last-post-entry-title entry-title">
					<a class="entry-link" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wolf' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h3>
				
				<span class="wolf-last-post-summary<?php echo get_the_excerpt() != '' ? ' wolf-post-has-summary"' : ''; ?>">
					<?php if ( has_post_thumbnail() ) : ?>
					<a class="wolf-last-post-thumbnail" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wolf' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
						<?php the_post_thumbnail( 'thumbnail' ); ?>
					</a>
					<?php endif; ?>
					<span class="entry-meta"><?php echo $date; ?></span><br>
					<?php echo get_the_excerpt(); ?>
				</span>
			</article>
		<?php endwhile; ?>
			<a href="<?php echo wolf_get_blog_url(); ?>" class="more-link">
				<?php _e( 'Read more posts', 'wolf' ); ?>
			</a>
		</div>
		<?php endif;
		wp_reset_postdata();
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
}

if ( ! function_exists( 'wolf_custom_last_posts_shortcode' ) ) {
	/**
	 * Last Posts
	 */
	function wolf_custom_last_posts_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'count' => get_option( 'posts_per_page' ),
			'category' => null,
			'tag' => null
		), $atts ) );
		if ( function_exists( 'wolf_custom_last_posts' ) )
			return wolf_custom_last_posts( $count, $category, $tag );
	}
	add_shortcode( 'wolf_last_posts', 'wolf_custom_last_posts_shortcode' );
}

if ( ! function_exists( 'wolf_spacer_shortcode' ) ) {
	/**
	 * Vertical Space Shortcode
	 */
	function wolf_spacer_shortcode ( $atts ) {
		extract(shortcode_atts(array(
		        'height' => 10,
		     ), $atts));
		return '<div style="height:' . $height . 'px;"></div>';
	}
	add_shortcode( 'wolf_spacer', 'wolf_spacer_shortcode' );
}
