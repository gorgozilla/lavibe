<?php
/**
 * Instagram Widget
 *
 * Displays Instagram widget
 *
 * @author WpWolf
 * @category Widgets
 * @package WolfGram
 * @version 1.3.5
 * @extends WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wolf_Widget_Instagram extends WP_Widget {

	var $wh_widget_cssclass;
	var $wh_widget_description;
	var $wh_widget_idbase;
	var $wh_widget_name;

	/**
	 * Constructor
	 */
	public function __construct() {

		/* Widget variable settings. */
		$this->wh_widget_cssclass 	= 'wolfgram-widget';
		$this->wh_widget_description = esc_html__( 'Display your last instagram shots', 'wolf' );
		$this->wh_widget_idbase	= 'wolfgram-widget';
		$this->wh_widget_name 	= esc_html__( 'Instagram', 'wolf' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->wh_widget_cssclass, 'description' => $this->wh_widget_description );

		/* Create the widget. */
		parent::__construct( 'wolfgram-widget', $this->wh_widget_name, $widget_ops );
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {

		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );
		$desc = $instance['desc'];
		$layout = $instance['layout'];
		$timeout = $instance['timeout'];

		$slideshow = false;
		if( $layout == '1' )
			$slideshow = true;

		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		if ( ! empty( $desc ) ) {
			echo '<p>';
			echo $desc;
			echo '</p>';
		}
		wolf_instagram_widget_images( $instance['count'], $slideshow, $timeout );
		echo $after_widget;

	}

	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['desc'] = $new_instance['desc'];
		$instance['count'] = $new_instance['count'];
		$instance['layout'] = $new_instance['layout'];
		$instance['timeout'] = $new_instance['timeout'];

		if( $instance['timeout'] == 0 || $instance['timeout'] == '' ) $instance['timeout'] = 3500;

		if( $instance['count'] == 0 || $instance['count'] == '' ) $instance['count'] = 12;
		return $instance;
	}


	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {
			// Set up some default widget settings
			$defaults = array( 'title' => esc_html__( 'Instagrams', 'wolf' ), 'desc' => '', 'count' => 12, 'layout' => '0', 'timeout' => '3500' );
			$instance = wp_parse_args( (array) $instance, $defaults );

		?>
		<script type="text/javascript">
			jQuery( function( $ ) {
				$( document ).on( 'change', '.wolf-instagram-layout-select', function() {

					var val = $( this ).val();

					if ( val == '1' ) {
						$( this ).parent().next().show();
					} else {
						$( this ).parent().next().hide();
					}
				} );
			} );
		</script>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Optional Text', 'wolf' ); ?>:</label>
			<textarea class="widefat"  id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" ><?php echo $instance['desc']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Count', 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php _e( 'Display', 'wolf' ); ?>:</label>
			<select class="wolf-instagram-layout-select"  name="<?php echo $this->get_field_name( 'layout' ); ?>" id="<?php echo $this->get_field_id( 'layout' ); ?>">
				<option value="0" <?php if( $instance['layout'] == '0' ) echo 'selected="selected"'; ?>><?php _e( 'thumbnails', 'wolf' ); ?></option>
				<option value="1" <?php if( $instance['layout'] == '1' ) echo 'selected="selected"'; ?>><?php _e( 'slideshow', 'wolf' ); ?></option>
			</select>
		</p>
		<p <?php if( $instance['layout'] == '0' )  echo 'style="display:none"';  ?>>
			<label for="<?php echo $this->get_field_id( 'timeout' ); ?>"><?php _e( 'Time between animation in milliseconds', 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'timeout' ); ?>" name="<?php echo $this->get_field_name( 'timeout' ); ?>" value="<?php echo $instance['timeout']; ?>">
		</p>
		<?php
	}

}

if ( ! function_exists( 'wolf_widget_instagram_init' ) ) {

	/**
	 * Init Instagram Widget
	 */
	function wolf_widget_instagram_init() {

		register_widget( 'Wolf_Widget_Instagram' );

	}
	add_action( 'widgets_init', 'wolf_widget_instagram_init' );

}