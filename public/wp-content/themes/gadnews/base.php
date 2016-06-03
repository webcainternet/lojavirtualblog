<?php get_header( gadnews_template_base() ); ?>

	<?php do_action( 'gadnews_render_widget_area', 'full-width-header-area' ); ?>

	<?php gadnews_site_breadcrumbs(); ?>

	<div class="container">

		<?php do_action( 'gadnews_render_widget_area', 'before-content-area' ); ?>

		<div class="row">

			<?php get_sidebar( 'secondary' ); // Loads the sidebar-secondary.php template. ?>

			<div id="primary" <?php gadnews_primary_content_class(); ?>>

				<?php do_action( 'gadnews_render_widget_area', 'before-loop-area' ); ?>

				<main id="main" class="site-main" role="main">

					<?php include gadnews_template_path(); ?>

				</main><!-- #main -->

				<?php do_action( 'gadnews_render_widget_area', 'after-loop-area' ); ?>

			</div><!-- #primary -->

			<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template.  ?>

		</div><!-- .row -->

		<?php do_action( 'gadnews_render_widget_area', 'after-content-area' ); ?>

	</div><!-- .container -->

	<?php do_action( 'gadnews_render_widget_area', 'after-content-full-width-area' ); ?>

<?php get_footer( gadnews_template_base() ); ?>
