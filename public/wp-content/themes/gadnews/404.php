<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package gadnews
 */
?>

<section class="error-404 not-found invert">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( '404', 'gadnews' ); ?></h1>
		<h1 class="page-subtitle"><?php _e( 'Sorry! <br> The page not found', 'gadnews' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<h4><?php _e( 'Unfortunately the page you were looking for could not be found.<br> Maybe search can help.', 'gadnews' ); ?></h4>
		<?php get_search_form(); ?>
		<p><a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Homepage', 'gadnews' ); ?></a></p>

	</div><!-- .page-content -->
</section><!-- .error-404 -->