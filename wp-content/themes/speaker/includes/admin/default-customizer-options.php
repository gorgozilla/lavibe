<?php
/**
 * Voolium default customizer settings
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */

function wolf_theme_customizer_options_init() {
	
	global $options;

	$customized = get_option( 'wolf_customizer_init' );

	if ( ! $customized ) {

		wolf_remove_customizer_options();
			
		// then reset default options
		$options = array(
			'accent_color' => '#86b775',
		);

		foreach ( $options as $id => $val) {
				
			// debug( $id . ' => ' . $val  );
			set_theme_mod( $id, $val );

		}

		add_option( 'wolf_customizer_init', true );
	}

}


/**
 * Set customizer preset skins
 */
function wolf_theme_customizer_skin( $skin = null ) {
	
	$options = array();

	//delete_option( 'wolf_customizer_init' );
	//wolf_theme_customizer_options_init();

	if ( $skin ) {

		if ( $skin == 'reset' ) {
			delete_option( 'wolf_customizer_init' );
			wolf_theme_customizer_options_init();
		}

		if ( $skin == 'light' ) {

			$options = array(

			);


		}

		if ( $skin == 'dark' ) {
			
			$options = array(

				'page_bg_font_color' => 'light',
				'page_bg_color' => '#333'

			);

		}

		foreach ( $options as $id => $val) {
			
			//debug( $id . ' => ' . $val  );
			set_theme_mod( $id, $val );

		}

		return true;
	}

}


function wolf_remove_customizer_options() {

	global $customizer_options;

	//debug($customizer_options);

	if ( isset( $customizer_options ) ) {

		// first remove all options
		foreach ( $customizer_options as $section ) {
			
			$section_id = $section['id'];
			$is_background = isset( $section['background'] ) && $section['background'] == true;


			if ( $is_background ) {

				$background = $section; // name it background so it's more clear
				$background_id = $section_id;
				$bg_options = array( 
					'color' => '',
					'opacity' => '100',
					'img' => '', 
					'repeat' => 'repeat', 
					'attachment' => 'scroll', 
					'position' => 'center center', 
					'size' => 'normal', 
					'parallax' => '', 
					'none' => '', 
					'font_color' => 'dark'
				);

				foreach ( $bg_options as $bg_option => $default ) {

					set_theme_mod( $background_id . '_' . $bg_option, $default );
				}
				

			} else {

				$options = isset( $section['options'] ) ? $section['options'] : array();
				foreach ( $options as $option ) {

					$option_id = $option['id'];

					if ( $option['type'] == 'background' ){
						$bg_options = array( 
							'color' => '',
							'opacity' => '100',
							'img' => '', 
							'repeat' => 'repeat', 
							'attachment' => 'scroll', 
							'position' => 'center center', 
							'size' => 'normal', 
							'parallax' => '', 
							'none' => '', 
							'font_color' => 'dark'
						);

						foreach ( $bg_options as $bg_option => $default ) {

							set_theme_mod( $option_id . '_' . $bg_option, $default );
						}
					}
					set_theme_mod( $option_id , '' );

				}
			}


		}
	}
}

function wolf_live_presets() {

	extract( $_POST );
	if ( isset( $_POST['skin'] ) ) {


		$skin = esc_attr( $_POST['skin'] );
		//echo $skin;
		if ( wolf_theme_customizer_skin( $skin ) )
			echo 'OK';


	}
	exit;


}
add_action('wp_ajax_wolf_live_presets', 'wolf_live_presets');

function wolf_theme_customizer_presets() {
	wp_enqueue_script('customizer-presets', WOLF_THEME_URL . '/js/customizer-presets.js');
	wp_localize_script( 'customizer-presets', 'WolfCustomizer', array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'resetOptionsConfirmMessage' => __( 'Are you sure to want to reset all styles to default ?', 'wolf' )
		)
	);
}
add_action( 'customize_controls_print_footer_scripts', 'wolf_theme_customizer_presets' );