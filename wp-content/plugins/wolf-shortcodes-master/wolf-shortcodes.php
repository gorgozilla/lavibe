<?php
/**
 * Plugin Name: Wolf Shortcodes
 * Plugin URI: http://wpwolf.com/plugin/wolf-shortcodes
 * Description: A Complete Shortcode Set : buttons, columns, tabs, accordion, toggles, notifications, hightlighted text, testimonials slider and google map.
 * Version: 1.5.1
 * Author: WpWolf
 * Author URI: http://wpwolf.com/about
 * Requires at least: 3.5
 * Tested up to: 3.8
 *
 * Text Domain: wolf
 * Domain Path: /lang/
 *
 * @package WolfShortcodes
 * @author WpWolf
 *
 * Being a free product, this plugin is distributed as-is without official support. 
 * Verified customers however, who have purchased a premium theme
 * at http://themeforest.net/user/BrutalDesign/portfolio?ref=BrutalDesign
 * will have access to support for this plugin in the forums
 * http://help.wpwolf.com/
 *
 * Copyright (C) 2014 Constantin Saguin
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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Wolf_Shortcodes' ) ) {
	/**
	 * Main Wolf_Shortcodes Class
	 *
	 * Contains the main functions for Wolf_Shortcodes
	 *
	 * @class Wolf_Shortcodes
	 * @version 1.5.1
	 * @since 1.0.0
	 * @package WolfShortcodes
	 * @author WpWolf
	 */
	class Wolf_Shortcodes{

		/**
		 * @var string
		 */
		public $version = '1.5.1';

		/**
		 * @var string
		 */
		private $update_url = 'http://plugins.wpwolf.com/update';

		/**
		 * @var string
		 */
		public $plugin_url;

		/**
		 * @var string
		 */
		public $plugin_path;

		/**
		 * WolfShortcodes Constructor.
		 *
		 */
		public function __construct() {

			define( 'WOLF_SHORTCODES_PLUGIN_URL', $this->plugin_url() );
			define( 'WOLF_SHORTCODES_PLUGIN_DIR', $this->plugin_path() );
			define( 'WOLF_SHORTCODES_VERSION', $this->version );

			// Updates
			add_action( 'admin_init', array( $this, 'update' ), 5 );

			// CSS styles
			add_action( 'wp_enqueue_scripts', array( $this, 'frontend_styles' ) );

			// Admin tinyMCE and styles
			add_action( 'admin_init', array( $this, 'mce_init' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

			// Initialize
			add_action( 'init', array( $this, 'init' ), 0 );	

		}

		/**
		 * plugin update notification.
		 */
		public function update() {
			
			$plugin_data = get_plugin_data( __FILE__ );

			$current_version = $plugin_data['Version'];
			$plugin_slug = plugin_basename( dirname( __FILE__ ) );
			$plugin_path = plugin_basename( __FILE__ );
			$remote_path = $this->update_url . '/' . $plugin_slug;
			
			if ( ! class_exists( 'Wolf_WP_Update' ) )
				include_once( 'classes/class-wp-update.php' );
			
			$plugin_update = new Wolf_WP_Update( $current_version, $remote_path, $plugin_path );
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 */
		public function includes() {

			// shortcode functions
			require_once( 'includes/shortcodes.php' );

		}

		/**
		 * Init WolfShortcodes when WordPress Initialises.
		 */
		public function init() {

			// Set up localisation
			$this->load_plugin_textdomain();

			$this->includes();

		}

		/**
		 * Load Localisation files.
		 *
		 * Note: the first-loaded translation file overrides any following ones if the same translation is present
		 *
		 */
		public function load_plugin_textdomain() {

			$domain = 'wolf';
			$locale = apply_filters( 'wolf', get_locale(), $domain );
			load_textdomain( $domain, WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo' );
			load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

		}

		/**
		 * Registers TinyMCE rich editor buttons.
		 */
		public function mce_init() {
			
			if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) )
				return;
		
			if ( get_user_option( 'rich_editing' ) == 'true' ) {
				add_filter( 'mce_external_plugins', array( $this, 'add_plugin' ) );
				add_filter( 'mce_buttons', array( $this, 'register_button' ) );
			}
		}

		/**
		 * Register/queue frontend styles.
		 */
		public function frontend_styles() {

			wp_enqueue_style( 'wolf-shortcodes', $this->plugin_url() . '/assets/css/shortcodes.min.css', array(), $this->version );

		}

		/**
		 * Defines TinyMCE rich editor js plugin.
		 *
		 * @param array $plugin_array
		 */
		public function add_plugin( $plugin_array ) {

			if ( version_compare( get_bloginfo( 'version' ), 3.9, '>=' ) ) {

				$plugin_array['WolfShortcodes'] = $this->plugin_url() . '/tinymce/plugin.js';

			} else {
				$plugin_array['WolfShortcodes'] = $this->plugin_url() . '/tinymce/plugin.old.js';
			}
			
			return $plugin_array;
		}
		
		/**
		 * Adds TinyMCE rich editor buttons.
		 *
		 * @param array $button
		 */
		public function register_button( $buttons ) {
			array_push( $buttons, 'wolf_shortcodes_button' );
			return $buttons;
		}

		/**
		 * Register/queue admin styles.
		 *
		 */
		public function admin_styles() {
			wp_enqueue_style( 'wolf-popup', $this->plugin_url() . '/tinymce/css/popup.css', false, '1.0', 'all' );		
		}

		/**
		 * Register/queue admin scripts.
		 *
		 */
		public function admin_scripts() {

			wp_localize_script( 'jquery', 'Wolf_Shortcodes', array( 'plugin_folder' => $this->plugin_url() . '/tinymce/' ) );
		}

		/**
		 * Get the plugin url.
		 *
		 * @return string
		 */
		public function plugin_url() {
			if ( $this->plugin_url ) return $this->plugin_url;
			return $this->plugin_url = untrailingslashit( plugins_url( '/', __FILE__ ) );
		}

		/**
		 * Get the plugin path.
		 *
		 * @return string
		 */
		public function plugin_path() {
			if ( $this->plugin_path ) return $this->plugin_path;
			return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
		}
		
	} // end class

	$wolf_shortcodes = new Wolf_Shortcodes;

} // end class exist check