<?php
/**
 * Template part for minimal Header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package gadnews
 */
?>
<div class="header-container__flex">
	<?php gadnews_social_list( 'header' ); ?>
	<div class="site-branding">
		<?php gadnews_header_logo() ?>
		<?php gadnews_site_description(); ?>
	</div>
	<?php gadnews_main_menu(); ?>
</div>
