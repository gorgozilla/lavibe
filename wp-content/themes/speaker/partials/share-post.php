<?php
/**
 * Share links
 *
 * @package WordPress
 * @subpackage Speaker
 * @since Speaker 1.0.0
 */
$text = wolf_get_theme_option( 'share_text' );
$link = urlencode( get_permalink() );
$title = urlencode( get_the_title() );
$pin_img = wolf_get_post_thumbnail_url( 'full' );
?>
<div class="share-box clearfix">
	<div class="share-box-inner clearfix">
		<div class="share-box-title">
			<span class="share-title"><?php echo $text; ?></span>
		</div><!-- .share-box-title -->
		<div class="share-box-icons">
			<?php if ( wolf_get_theme_option( 'share_facebook' ) ) : ?>
				<a data-popup="true" data-width="580" data-height="320" href="http://www.facebook.com/sharer.php?u=<?php echo $link; ?>&amp;t=<?php echo $title; ?>" class="theme-icon-facebook share-link" title="<?php printf( __( 'Share on %s', 'wolf' ), ucfirst( 'facebook' ) ); ?>"></a>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'share_twitter' ) ) : ?>
				<a data-popup="true" href="http://twitter.com/home?status=<?php echo $title . ' - ' . $link; ?>" class="theme-icon-twitter share-link" title="<?php printf( __( 'Share on %s', 'wolf' ), ucfirst( 'twitter' ) ); ?>"></a>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'share_pinterest' ) ) : ?>
				<a data-popup="true" data-width="580" data-height="300" href="http://pinterest.com/pin/create/button/?url=<?php echo $link; ?>&amp;media=<?php echo $pin_img; ?>&amp;description=<?php echo $title; ?>" class="theme-icon-pinterest share-link" title="<?php printf( __( 'Share on %s', 'wolf' ), ucfirst( 'pinterest' ) ); ?>"></a>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'share_google_plus' ) ) : ?>
				<a data-popup="true" data-height="500" href="https://plus.google.com/share?url=<?php echo $link; ?>" class="theme-icon-googleplus share-link" title="<?php printf( __( 'Share on %s', 'wolf' ), ucfirst( 'google plus' ) ); ?>"></a>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'share_tumblr' ) ) : ?>
				<a data-popup="true" href="http://tumblr.com/share/link?url=<?php echo $link; ?>&amp;name=<?php echo $title; ?>" class="theme-icon-tumblr share-link" title="<?php printf( __( 'Share on %s', 'wolf' ), ucfirst( 'tumblr' ) ); ?>"></a>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'share_stumbleupon' ) ) : ?>
				<a data-popup="true" data-width="800" data-height="600" href="http://www.stumbleupon.com/submit?url=<?php echo $link; ?>&amp;title=<?php echo $title; ?>" class="theme-icon-stumbleupon share-link" title="<?php printf( __( 'Share on %s', 'wolf' ), ucfirst( 'stumbleupon' ) ); ?>"></a>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'share_linkedin' ) ) : ?>
				<a data-popup="true" data-height="380" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $link; ?>&amp;title=<?php echo $title; ?>" class="theme-icon-linkedin share-link" title="<?php printf( __( 'Share on %s', 'wolf' ), ucfirst( 'linkedin' ) ); ?>"></a>
			<?php endif; ?>
			<?php if ( wolf_get_theme_option( 'share_mail' ) ) : ?>
				<a data-popup="true" href="mailto:?subject=<?php echo $title; ?>&amp;body=<?php echo $link; ?>" class="theme-icon-envelope share-link" title="<?php printf( __( 'Share by %s', 'wolf' ), ucfirst( 'email' ) ); ?>"></a>
			<?php endif; ?>
		</div><!-- .share-box-icons -->
	</div><!-- .share-box-inner -->
</div><!-- .share-box -->