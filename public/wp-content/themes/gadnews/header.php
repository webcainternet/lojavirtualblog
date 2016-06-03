<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gadnews
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<link href="//fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet" type="text/css">
<link href="//fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet" type="text/css">
<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400i,300,700" rel="stylesheet" type="text/css">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php gadnews_get_page_preloader(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gadnews' ); ?></a>
	<header id="masthead" <?php gadnews_header_class(); ?> role="banner">
		<?php if(true === get_theme_mod('header_top_visibility')){ ?>
			<div class="top-panel invert">
				<div class="top-panel__wrap container"><?php
					gadnews_top_message( '<div class="top-panel__message">%s</div>' );
					gadnews_top_search( '<div class="top-panel__search">%s</div>' );
					gadnews_top_menu();
					?></div>
			</div><!-- .top-panel -->
		<?php } ?>

		<div class="header-container invert" style="position: fixed; z-index: 9999; width: 100%; margin: auto;">
			<div class="header-container_wrap container">
				<?php get_template_part( 'template-parts/header/layout', get_theme_mod( 'header_layout_type' ) ); ?>
			</div>
		</div><!-- .header-container -->

		<div style="height: 119px;">
			&nbsp;
		</div>
	</header><!-- #masthead -->

	<div id="content" <?php gadnews_content_class(); ?>>
