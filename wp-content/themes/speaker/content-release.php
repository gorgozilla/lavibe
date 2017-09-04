<?php
/**
 * The Template for displaying the release content in a grid layout
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
global $more;
$more = 0;

$post_id = get_the_ID();

/* Metaboxes and Taxonomy */

// label
$band = '';

if ( strip_tags( get_the_term_list( $post_id, 'band', '', ', ', '' ) ) != '' ) {
	
	$band =  '<strong>' . __( 'Band ', 'wolf') . '</strong> : ' . strip_tags( get_the_term_list( $post_id, 'band', '', ', ', '' ) ) . '<br>';

}

if ( wolf_get_release_option( 'use_band_tax' ) ) {
	$band = get_the_term_list( $post_id, 'band', '<strong>' . __( 'Band ', 'wolf') . '</strong> : ', ', ', '<br>' );
}
	
// label
$label = '';

if ( strip_tags( get_the_term_list( $post_id, 'label', '', ', ', '' ) ) != '' ) {
	
	$label =  '<strong>' . __( 'Label ', 'wolf') . '</strong> : ' . strip_tags( get_the_term_list( $post_id, 'label', '', ', ', '' ) ) . '<br>';

}

if ( wolf_get_release_option( 'use_label_tax' ) ) {
	$label = get_the_term_list( $post_id, 'label', '<strong>' . __( 'Label ', 'wolf') . '</strong> : ', ', ', '<br>' );
}

$release_title = get_post_meta( $post_id, '_wolf_release_title', true );
$release_date = get_post_meta( $post_id, '_wolf_release_date', true );
$release_label = get_post_meta( $post_id, '_wolf_release_label', true );
$release_catalog = get_post_meta( $post_id, '_wolf_release_catalog_number', true );
$release_type = get_post_meta( $post_id, '_wolf_release_type', true );

$display_date = '';
if ( $release_date ) {
	list( $month, $day, $year ) = explode( "-", $release_date );
	$sql_date = $year . '-' . $month . '-' . $day . ' 00:00:00';
	$display_date = mysql2date( get_option( 'date_format' ), $sql_date );
}

$thumbnail_size = get_post_meta( $post_id, '_wolf_release_type', true ) == 'DVD' || get_post_meta( $post_id, '_wolf_release_type', true ) == 'K7' ? 'DVD' : 'CD';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'wolf-release', 'clearfix' ) ); ?>>
	<div class="entry-thumbnail">
		<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wolf' ), the_title_attribute( 'echo=0' ) ) ); ?>">
			<?php the_post_thumbnail( 'CD' ); ?>
		</a>
		<?php endif; ?>
		<h3 class="entry-title">
			<a class="entry-link" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wolf' ), the_title_attribute( 'echo=0' ) ) ); ?>">
				<?php the_title(); ?>
			</a>
		</h3>
	</div>
</article><!-- .wolf-release -->