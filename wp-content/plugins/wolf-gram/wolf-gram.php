<?php
/**
 * Plugin Name: WolfGram
 * Plugin URI: http://wolfgram.wolfthemes.com/download
 * Description: WolfGram is a Wordpress plugin that uses the Instagram API to display your Instagram Feed. It includes a shortcode and a widget.
 * Version: 1.4.4
 * Author: Wolf Themes
 * Author URI: http://wolfthemes.com
 * Requires at least: 3.5
 * Tested up to: 4.5.3
 *
 * Text Domain: wolf
 * Domain Path: /lang/
 *
 * @package WolfGram
 * @author Wolf Themes
 *
 * Being a free product, this plugin is distributed as-is without official support.
 * Verified customers however, who have purchased a premium theme
 * at http://themeforest.net/user/BrutalDesign/portfolio?ref=BrutalDesign
 * will have access to support for this plugin in the forums
 * http://help.wolfthemes.com/
 *
 * Copyright (C) 2013 Constantin Saguin
 * This WordPress Plugin is a free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * It is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * See http://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Wolf_Instagram' ) ) {
/**
 * Main Wolf_Instagram Class
 *
 * Contains the main functions for Wolf_Instagram
 *
 * @class Wolf_Instagram
 * @version 1.4.3
 * @since 1.0.0
 * @package WolfGram
 * @author WolfThemes
 */
class Wolf_Instagram{

	/**
	 * @var string
	 */
	public $version = '1.4.3';

	/**
	 * @var string
	 */
	public $update_url = 'http://plugins.wolfthemes.com/update';

	/**
	 * @var string
	 */
	public $cache_duration_hour = 1; // cache duration in hour (can be decimal e.g : 0.5)

	/**
	 * WolfGram Constructor.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		define( 'WOLFGRAM_URL', plugins_url( '/' . basename( dirname( __FILE__ ) ) ) );
		define( 'WOLFGRAM_DIR', dirname( __FILE__ ) );

		register_activation_hook( __FILE__, array( $this, 'activate' ) );

		require_once( WOLFGRAM_DIR . '/wolf-gram-widget.php' );

		add_action( 'init', array( $this, 'plugin_textdomain' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_head', array( $this, 'twenty_eleven_css_fix' ) );
		add_shortcode( 'wolfgram_gallery' , array( $this, 'shortcode' ) );

		add_action( 'admin_init', array( $this, 'settings_init' ) );
		add_action( 'admin_menu', array( $this, 'menu_init' ) );
		add_action( 'admin_init', array( $this, 'plugin_update' ) );

	}

	public function debug( $var ) {
		echo "<pre>";
		print_r( $var );
		echo "</pre>";
	}

	public function activate( $network_wide ) {
		$this->options_init();
	} // end activate

	/**
	 * Enqueue jQuery if it's not
	 */
	public function enqueue_scripts() {
		/* Styles */
		wp_register_style( 'wolf-gram', WOLFGRAM_URL . '/assets/css/instagram.css',array(), $this->version, 'all' );
		wp_register_style( 'fancybox', WOLFGRAM_URL . '/assets/fancybox/jquery.fancybox.css', array(), '2.1.4' );
		wp_register_style( 'swipebox', WOLFGRAM_URL. '/assets/swipebox/swipebox.min.css', array(), '1.3.0' );

		/* Main CSS */
		wp_enqueue_style( 'wolf-gram' );

		if ( $this->get_instagram_option( 'lightbox' ) == 'fancybox' ) {

			wp_enqueue_style( 'fancybox' );


		} elseif ( $this->get_instagram_option( 'lightbox' ) == 'swipebox' ) {

			wp_enqueue_style( 'swipebox' );
		}

		/* Script */
		wp_register_script( 'cycle', WOLFGRAM_URL . '/assets/js/jquery.cycle.lite.js', array( 'jquery' ), '1.3.2' );

		wp_enqueue_script( 'wolf-gram', WOLFGRAM_URL . '/assets/js/instagram.js', array( 'jquery' ), $this->version, true );
	}


	public function twenty_eleven_css_fix() {
		if ( function_exists( 'wp_get_theme' ) ) {
			$theme_data = wp_get_theme();
			$theme_name = $theme_data['Name'];

			if ( $theme_name == 'Twenty Eleven' ) {
				echo '<style type="text/css">#branding {z-index:9!important}</style>';
			}
		}
	}


	/**
	 * Loads the plugin text domain for translation
	 */
	public function plugin_textdomain() {

		$domain = 'wolf';
		$locale = apply_filters( 'wolf', get_locale(), $domain );
		load_textdomain( $domain, WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo' );
		load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

	}


	/**
	 * Add Contextual menu
	 *
	 */
	public function menu_init() {
		$icon = WOLFGRAM_URL.'/img/menu.png';
		$icon = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0ZWQgYnkgSWNvTW9vbi5pbyAtLT4KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHdpZHRoPSIyOCIgaGVpZ2h0PSIyOCIgdmlld0JveD0iMCAwIDI4IDI4Ij4KPHBhdGggZmlsbD0iIzQ0NDQ0NCIgZD0iTTIxLjI4MSAyMi4yODF2LTEwLjEyNWgtMi4xMDlxMC4zMTMgMC45ODQgMC4zMTMgMi4wNDcgMCAxLjk2OS0xIDMuNjMzdC0yLjcxOSAyLjYzMy0zLjc1IDAuOTY5cS0zLjA3OCAwLTUuMjY2LTIuMTE3dC0yLjE4OC01LjExN3EwLTEuMDYyIDAuMzEzLTIuMDQ3aC0yLjIwM3YxMC4xMjVxMCAwLjQwNiAwLjI3MyAwLjY4dDAuNjggMC4yNzNoMTYuNzAzcTAuMzkxIDAgMC42NzItMC4yNzN0MC4yODEtMC42OHpNMTYuODQ0IDEzLjk1M3EwLTEuOTM3LTEuNDE0LTMuMzA1dC0zLjQxNC0xLjM2N3EtMS45ODQgMC0zLjM5OCAxLjM2N3QtMS40MTQgMy4zMDUgMS40MTQgMy4zMDUgMy4zOTggMS4zNjdxMiAwIDMuNDE0LTEuMzY3dDEuNDE0LTMuMzA1ek0yMS4yODEgOC4zMjh2LTIuNTc4cTAtMC40MzgtMC4zMTMtMC43NTh0LTAuNzY2LTAuMzJoLTIuNzE5cS0wLjQ1MyAwLTAuNzY2IDAuMzJ0LTAuMzEzIDAuNzU4djIuNTc4cTAgMC40NTMgMC4zMTMgMC43NjZ0MC43NjYgMC4zMTNoMi43MTlxMC40NTMgMCAwLjc2Ni0wLjMxM3QwLjMxMy0wLjc2NnpNMjQgNS4wNzh2MTcuODQ0cTAgMS4yNjYtMC45MDYgMi4xNzJ0LTIuMTcyIDAuOTA2aC0xNy44NDRxLTEuMjY2IDAtMi4xNzItMC45MDZ0LTAuOTA2LTIuMTcydi0xNy44NDRxMC0xLjI2NiAwLjkwNi0yLjE3MnQyLjE3Mi0wLjkwNmgxNy44NDRxMS4yNjYgMCAyLjE3MiAwLjkwNnQwLjkwNiAyLjE3MnoiPjwvcGF0aD4KPC9zdmc+Cg==';
		add_menu_page( 'Instagram', 'Instagram', 'activate_plugins', basename(__FILE__), array( $this,  'instagram_login_form' ), $icon );
	}

	/**
	 * Settings Init
	 *
	 */
	public function settings_init() {
		register_setting( 'wolf-instagram-settings', 'wolf_instagram_settings', array($this, 'settings_validate' ) );
		add_settings_section( 'wolf-instagram-settings', '', array($this, 'section_intro' ), 'wolf-instagram-settings' );
		add_settings_field( 'count', esc_html__( 'Number of photos to display in the Instagram gallery (max 30)', 'wolf' ), array($this, 'setting_count' ), 'wolf-instagram-settings', 'wolf-instagram-settings' );
		add_settings_field( 'lightbox', esc_html__( 'Lightbox (thumbnails widgets)', 'wolf' ) , array($this, 'setting_lightbox' ), 'wolf-instagram-settings', 'wolf-instagram-settings' );
		add_settings_field( 'widget_link', esc_html__( 'Widget Images Link', 'wolf' ) , array($this, 'setting_widget_link' ), 'wolf-instagram-settings', 'wolf-instagram-settings' );
		add_settings_field( 'gallery_link', esc_html__( 'Gallery Images Link', 'wolf' ) , array($this, 'setting_gallery_link' ), 'wolf-instagram-settings', 'wolf-instagram-settings' );
		add_settings_field( 'instructions', esc_html__( 'Instructions' , 'wolf' ), array($this, 'setting_instructions' ), 'wolf-instagram-settings', 'wolf-instagram-settings' );
	}

	/**
	 * Set Default Settings
	 *
	 */
	public function options_init() {
		global $options;

		if ( false === get_option( 'wolf_instagram_settings' ) ) {

			$default = array(
				'count' => 20,
				'lightbox' => 'swipebox',
				'widget_link' => 'lightbox',
				'gallery_link' => 'external'
			);

			add_option( 'wolf_instagram_settings', $default );
		}
	}

	/**
	 * Get Instagram Setting
	 *
	 */
	public function get_instagram_option( $value = null) {
		global $options;

		$wolf_instagram_settings = get_option( 'wolf_instagram_settings' );

		if ( isset( $wolf_instagram_settings[$value] ) )
			return $wolf_instagram_settings[$value];
	}

	/**
	 * Validate data
	 *
	 */
	public function settings_validate( $input) {
		$input['count'] = intval( $input['count'] );
		if ( $input['count'] > 30 ) {
			$input['count']= 30;
		}

		$input['lightbox'] = sanitize_title( $input['lightbox'] );

		return $input;
	}

	/**
	 * Intro section used for debug
	 *
	 */
	public function section_intro() {
		// global $options;
		// $this->debug(get_option( 'wolf_instagram_settings' ) );
	}

	/**
	 * Gallery Count
	 *
	 */
	public function setting_count() {
		echo '<input type="text" name="wolf_instagram_settings[count]" class="regular-text" value="'. $this->get_instagram_option( 'count' ) .'" />';
	}

	/**
	 * Lightbox Option
	 *
	 */
	public function setting_lightbox() {
		?>
		<select name="wolf_instagram_settings[lightbox]">
			<option <?php if ( $this->get_instagram_option( 'lightbox' ) == 'swipebox' ) echo 'selected="selected"'; ?>>swipebox</option>
			<option <?php if ( $this->get_instagram_option( 'lightbox' ) == 'fancybox' ) echo 'selected="selected"'; ?>>fancybox</option>
			<option <?php if ( $this->get_instagram_option( 'lightbox' ) == 'none' ) echo 'selected="selected"'; ?>>none</option>
		</select>
		<?php
	}

	/**
	 * Widget Link
	 *
	 */
	public function setting_widget_link() {
		?>
		<select name="wolf_instagram_settings[widget_link]">
			<option value="lightbox" <?php if ( $this->get_instagram_option( 'widget_link' ) == 'lightbox' ) echo 'selected="selected"'; ?>><?php _e( 'Open in lightbox', 'wolf' ); ?></option>
			<option value="external" <?php if ( $this->get_instagram_option( 'widget_link' ) == 'external' ) echo 'selected="selected"'; ?>><?php _e( 'Open Instagram Page', 'wolf' ); ?></option>
		</select>
		<?php
	}

	/**
	 * Gallery Link
	 *
	 */
	public function setting_gallery_link() {
		?>
		<select name="wolf_instagram_settings[gallery_link]">
			<option value="lightbox" <?php if ( $this->get_instagram_option( 'gallery_link' ) == 'lightbox' ) echo 'selected="selected"'; ?>><?php _e( 'Open in lightbox', 'wolf' ); ?></option>
			<option value="external" <?php if ( $this->get_instagram_option( 'gallery_link' ) == 'external' ) echo 'selected="selected"'; ?>><?php _e( 'Open Instagram Page', 'wolf' ); ?></option>
		</select>
		<?php
	}

	/**
	 * Instructions
	 *
	 */
	public function setting_instructions() {
		?>
		<p><?php _e( 'You can display the gallery in your post or page with the following shortcde:', 'wolf' )  ?></p>
		<p><code>[wolfgram_gallery count="15"]</code></p>
		<?php
	}

	/**
	 * Admin login form
	 *
	 */
	public function instagram_login_form() {

		if ( isset( $_POST['wolf_instagram_logout'] ) && wp_verify_nonce( $_POST['wolf_instagram_logout_nonce'],'wolf_instagram_logout' ) ) {
			$this->instagram_logout();
		}
		?>
		<div class="wrap">
			<div id="icon-themes" class="icon32"></div>
			<h2>Instagram</h2>
		<?php if ( ! $this->instagram_login() ): // if not logged ?>
			<p><?php _e( 'WolfGram is a Wordpress plugin that uses the Instagram API to display your Instgram feed.', 'wolf' ); ?></p>
			<p><?php _e( 'You need to link the WolfGram app to your Instagram account and get your access key to be able to use the WolfGram features.', 'wolf' ); ?></p>
			<p><?php _e( 'To do so, simply follow the link below and follow the instructions.', 'wolf' ); ?></p>
			<p><a target="_blank" href="http://wolfgram.wolfthemes.com/"><?php _e( 'Get your access key', 'wolf' ); ?></a></p>
			<form action="<?php echo esc_url(admin_url( 'admin.php?page=wolf-gram.php' ) ); ?>" method="post">
				<?php wp_nonce_field( 'wolf_instagram_login', 'wolf_instagram_login_nonce' ); ?>
				<p><?php _e( 'Access Key', 'wolf' ); ?>: <br><input style="width:200px;" type="text" name="wolf_instagram_code"></p>
				<p><input name="wolf_instagram_login" type="submit" class="button-primary" value="<?php _e( 'Link your Instagram account', 'wolf' ); ?>"></p>
			</form>
		</div><!-- .wrap -->
		<?php
			if ( isset( $_POST['wolf_instagram_login'] )
				&& ! $this->get_instagram_auth()
				&& wp_verify_nonce( $_POST['wolf_instagram_login_nonce'],'wolf_instagram_login' ) ):

				echo '<strong>';
				_e( 'Wrong code', 'wolf' );
				echo '</strong>';
			endif;

		else: // if login

		$auth = $this->get_instagram_auth();

		?>
			<p><?php _e( 'You can now use the WolfGram.', 'wolf' ); ?></p>
			<p><?php _e( 'You can log out to change your account and get a new code.', 'wolf' ); ?></p>

			<form action="<?php echo admin_url( 'admin.php?page=wolf-gram.php' ); ?>" method="post">
			<?php wp_nonce_field( 'wolf_instagram_logout', 'wolf_instagram_logout_nonce' ); ?>
			<p><input name="wolf_instagram_logout" type="submit" class="button-primary" value="<?php _e( 'Reset', 'wolf' ); ?>"></p>
			</form>
			<hr>
			<h3><?php _e( 'Settings', 'wolf' ); ?></h3>
			<form action="options.php" method="post">
				<?php settings_fields( 'wolf-instagram-settings' ); ?>
				<?php do_settings_sections( 'wolf-instagram-settings' ); ?>
				<p class="submit"><input name="save" type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'wolf' ); ?>" /></p>
			</form>
		</div><!-- .wrap -->
		<?php endif;
	}

	/**
	 * Login function
	 * @return boolean
	 */
	public function instagram_login( $access_token = null) {

		if ( $this->get_instagram_auth() ) {
			return true;
		}

		if ( isset( $_POST['wolf_instagram_login'] ) && wp_verify_nonce( $_POST['wolf_instagram_login_nonce'],'wolf_instagram_login' ) ) {
			if ( isset( $_POST['wolf_instagram_code'] ) ) {
				$access_token = $_POST['wolf_instagram_code'];
			}
		}

		if ( ! $this->get_instagram_auth() && $access_token ) {
			if ( $this->verify_access_token( $access_token ) ) {
				add_option( 'wolf_instagram_access_token', $access_token  );
				return true;
			} else {
				return false;
			}


		} elseif ( ! $this->get_instagram_auth() && ! $access_token ) {
		 	return false;
		}
	}

	/**
	 * Authentification
	 */
	public function verify_access_token( $access_token) {
		$apiurl = "https://api.instagram.com/v1/users/self/media/recent?count=1&access_token=".$access_token;

		$response = wp_remote_get( $apiurl,
			array(
				'sslverify' => apply_filters( 'https_local_ssl_verify', false)
			)
		);

		if ( ! is_wp_error( $response) && $response['response']['code'] < 400 && $response['response']['code'] >= 200) {

			return true;

		}
	}

	/**
	 * Log Out
	 *
	 */
	public function instagram_logout() {
		$trans_key = 'wolf_instagram_data';
		delete_transient( $trans_key );
		delete_option( 'wolf_instagram_access_token' );
	}

	/**
	 * Get Instagram auth access token from options
	 *
	 */
	public function get_instagram_auth() {
		global $options;
		if (get_option( 'wolf_instagram_access_token' ) )
			return get_option( 'wolf_instagram_access_token' );
	}

	/**
	 * Get instagram feed and cache the data in a WP transient key
	 *
	 */
	public function instagram( $count = 30 ) {



		$trans_key = 'wolf_instagram_data';
		$cache_duration = ceil( $this->cache_duration_hour * 3600 );

		if ( $cache_duration < 1 ) $cache_duration = 1;

		$images = array();
		$access_token = $this->get_instagram_auth();

		// delete_transient( 'wolf_instagram_data' );

		if ( $access_token ) {

			if ( false === ( $cached_data = get_transient( $trans_key ) ) || ! get_transient( $trans_key ) ) {

				$apiurl = "https://api.instagram.com/v1/users/self/media/recent?count=$count&access_token=" . $access_token;

				$response = wp_remote_get( $apiurl,
					array(
						'sslverify' => apply_filters( 'https_local_ssl_verify', false )
					)
				);

				if ( ! is_wp_error( $response) && $response['response']['code'] < 400 && $response['response']['code'] >= 200 ) {
					$data =  json_decode( $response['body'] );
					if ( $data && $data->meta->code == 200) {
						foreach( $data->data as $item) {
							$images[] = array(
								"image_small" => $item->images->thumbnail->url,
								"image_middle" => $item->images->low_resolution->url,
								"image_large" => $item->images->standard_resolution->url,
								"link" => $item->link
							);
						}
					}
				}
				// $this->debug( 'cache not used' );
				set_transient( $trans_key, $images, $cache_duration );
			}
			// $this->debug( 'cache used' );
			return get_transient( $trans_key );

		} else {

			return false;

		}
	}

	/**
	 * Display message when no image found
	 *
	 */
	public function no_image() {

		$output = '';

		if ( ! $this->get_instagram_auth() ) {

			if ( is_user_logged_in() )
				$output = '<p>'.esc_html__( 'Please enter your access key and link your Instagram account through your admin panel to display your images.', 'wolf' ).'</p>';
			else
				$output = '<p>'.esc_html__( 'No Instagram image yet.', 'wolf' ).'</p>';

		}

		if ( $this->get_instagram_auth() != false )
			if ( is_user_logged_in() )
				$output = '<p>'.esc_html__( 'No Instagram photo found. Try to reset your access key.', 'wolf' ).'</p>';
			else
				$output = '<p>'.esc_html__( 'No Instagram photo found.', 'wolf' ).'</p>';


		return $output;

	}

	/**
	 * Display Gallery
	 *
	 */
	public function gallery( $count = null, $tmpl = true ) {

		$output = '';

		if ( $this->get_instagram_auth() ) {

			if ( $tmpl && $this->get_instagram_option( 'count' ) )

				$count = $this->get_instagram_option( 'count' );

			elseif ( ! $tmpl && ! $count ) {
				$count = 20;
			}

			$images = $this->instagram();

			if ( $count > count( $images) ) {
				$count = count( $images);
			}

			$lightbox = 'swipebox';
			$value = 'link';
			$target = '  target="_blank"';
			$rand = rand( 0, 999 );

			if ( $this->get_instagram_option( 'gallery_link' ) == 'lightbox' ) {

				if ( $this->get_instagram_option( 'lightbox' ) == 'fancybox' ) {

					$lightbox = 'fancybox';
					$value = 'image_large';
					$target = null;

					wp_enqueue_script( 'fancybox', WOLFGRAM_URL. '/assets/fancybox/jquery.fancybox.pack.js', array( 'jquery' ), '2.1.4' );


				} elseif ( $this->get_instagram_option( 'lightbox' ) == 'swipebox' ) {

					$lightbox = 'swipebox';
					$value = 'image_large';
					$target = null;

					wp_enqueue_script( 'swipebox', WOLFGRAM_URL. '/assets/swipebox/jquery.swipebox.min.js', array( 'jquery' ), '1.2.1' );
				}

				$output .= "<script type=\"text/javascript\">jQuery(document).ready(function($){
					$( '.$lightbox-wolfgram-$rand' ).$lightbox();});
				</script>";

			}


			$output .= '<div id="wolf-instagram">';

			for( $i=0; $i < $count; $i++ ) {

				$img = $images[ $i ];
				$src = str_replace( 's150x150', 's640x640', $img['image_small'] );

				$output .= '<div class="wolf-instagram-item-container" style="background-image:url( ' . esc_url( $src ) . ' );">
				<div class="wolf-instagram-item">
				<a' . $target . ' rel="wolfgram-gallery" class="' . esc_attr( $lightbox ) . '-wolfgram-' . absint( $rand ) . ' wolf-instagram-link" href="'. esc_url( $images[ $i ][ $value ] ).'">
					<div class="wolf-instagram-overlay"></div>
				</a></div></div>';
			}

			// <img src="'.$images[$i]['image_middle'].'" alt="wolfgram-thumbnail">

			$output .= '</div><div style="clear:both; float:none"></div>';

		} else {

			$output = '<div style="margin: 180px auto 300px; text-align:center">' . $this->no_image() . '</div>';

		}

		return $output;

	}

	/**
	 * Get Widget Images
	 *
	 */
	public function widget_images( $count = 9, $slideshow = false, $timeout = 3500) {

		wp_enqueue_style( 'wolf-instagram' );

		$output = '';

		if ( $this->get_instagram_auth() ) {

			$images = $this->instagram();

			if ( $count > count( $images) )
				$count = count( $images);

			if ( $slideshow) {
				wp_enqueue_script( 'cycle' );
				$output .= '<script type="text/javascript">
				jQuery(function( $) {
				    jQuery(".wolf-slidegram-container").cycle({
						fx: "fade",
						timeout : ' . $timeout . '
					});
				});

				</script>';
				$output .= '<div class="wolf-slidegram-container">';
				$fluid_fix = ' wolf-slidegram-fluid-fix';

				for( $i=0; $i<$count; $i++) {

					$output .= '<div class="wolf-slidegram';
					if ( $i == 0 ) $output .= $fluid_fix;
					$output .= '">
					<a target="_blank" href="'. esc_url( $images[ $i ]['link'] ).'">
						<img src="'. esc_url( $images[ $i ]['image_middle'] ).'"></a>
					</div>';
				}
				$output .= '</div>';

			} else {

				$lightbox = null;
				$value = 'link';
				$target = '  target="_blank';
				$rand = rand(0, 999);

				if ( $this->get_instagram_option( 'widget_link' ) == 'lightbox' || ! $this->get_instagram_option( 'widget_link' ) ) {


					if ( $this->get_instagram_option( 'lightbox' ) == 'fancybox' ) {

						$lightbox = 'fancybox';
						$value = 'image_large';
						$target = null;

						wp_enqueue_script( 'fancybox', WOLFGRAM_URL. '/assets/fancybox/jquery.fancybox.pack.js', array( 'jquery' ), '2.1.4' );


					} elseif ( $this->get_instagram_option( 'lightbox' ) == 'swipebox' ) {

						$lightbox = 'swipebox';
						$value = 'image_large';
						$target = null;

						wp_enqueue_script( 'swipebox', WOLFGRAM_URL. '/assets/swipebox/jquery.swipebox.min.js', array( 'jquery' ), '1.2.1' );
					}

					$output .= "<script type=\"text/javascript\">jQuery(document).ready(function($){
						$( '.$lightbox-wolfgram-$rand' ).$lightbox();});
					</script>";

				}



				$output .= '<ul class="wolf-instagram-list">';
				for ( $i=0; $i<$count; $i++) {

					$output .= '<li><a' . $target . ' rel="wolfgram-widget" class="' . $lightbox . '-wolfgram-' . absint( $rand ) . '" href="' . esc_url( $images[ $i ][ $value ] ).'"><img src="' . esc_url( $images[ $i ]['image_small'] ) . '" alt="wolfgram-thumbnail"></a></li>';

				}
				$output .= '</ul>';
			}

		} else {

			$output = $this->no_image();
		}

		return $output;
	}

	/**
	 * Gallery Shortcode
	 */
	public function shortcode( $atts ) {

		$default_count = 10;

		if ( $this->get_instagram_option( 'count' ) )
			$default_count = $this->get_instagram_option( 'count' );

		extract( shortcode_atts( array(
			'count' => $default_count,
		), $atts) );

		return $this->gallery( $count, false );

	}

	/**
	 * Plugin update
	 */
	public function plugin_update() {

		$plugin_data = get_plugin_data( __FILE__ );

		$current_version = $plugin_data['Version'];
		$plugin_slug = plugin_basename( dirname( __FILE__ ) );
		$plugin_path = plugin_basename( __FILE__ );
		$remote_path = $this->update_url . '/' . $plugin_slug;

		if ( ! class_exists( 'Wolf_WP_Update' ) )
			include_once('classes/class-wp-update.php');

		new Wolf_WP_Update( $current_version, $remote_path, $plugin_path );
	}


} // end class

global $wolf_instagram;
$wolf_instagram = new Wolf_Instagram;

if ( ! function_exists( 'wolf_instagram_gallery' ) ) {
	/**
	 * Output gallery
	 */
	function wolf_instagram_gallery() {
		global $wolf_instagram;
		echo $wolf_instagram->gallery();
	}
}

if ( ! function_exists( 'wolf_instagram_widget_images' ) ) {
	/**
	 * Output Widget
	 */
	function wolf_instagram_widget_images( $count = 9, $slideshow = false, $timeout = 3500 ) {
		global $wolf_instagram;
		echo $wolf_instagram->widget_images( $count , $slideshow , $timeout );
	}

}

} // end class check
