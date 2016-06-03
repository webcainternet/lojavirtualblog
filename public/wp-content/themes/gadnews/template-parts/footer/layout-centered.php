<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package gadnews
 */

?>
<div class="footer-container invert">
	<div <?php echo gadnews_get_container_classes( array( 'site-info' ) ); ?>>

		<?php
		gadnews_footer_logo();
		gadnews_social_list( 'footer' );
		gadnews_footer_copyright();
		?>
	</div><!-- .site-info -->

</div><!-- .container -->