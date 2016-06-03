<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package gadnews
 */

?>

<div class="footer-container invert">
	<div class="container">
		<div <?php echo gadnews_get_container_classes( array( 'site-info' ) ); ?>>
			<div class="site-info__flex">
				<div class="site-info__mid-box"><?php
					gadnews_footer_copyright();
				?></div>
				<?php gadnews_social_list( 'footer' ); ?>
			</div>
		</div><!-- .site-info -->
	</div>
</div><!-- .container -->