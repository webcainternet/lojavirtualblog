<?php
/**
 * Thumbnails configuration.
 *
 * @package    Gadnews
 * @subpackage Config
 * @author     Cherry Team <cherryframework@gmail.com>
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
	die;
}

// Registers custom image sizes for the theme.
add_action( 'init', '_tm_register_image_sizes' );
function _tm_register_image_sizes() {

	if ( ! current_theme_supports( 'post-thumbnails' ) ) {
		return;
	}

	set_post_thumbnail_size( 370, 300, true );

	// Registers a new image sizes.
	add_image_size( '_tm-thumb-masonry', 570, 9999 );
	add_image_size( '_tm-thumb-masonry_2', 370, 9999 );

	add_image_size( '_tm-thumb-70-70', 70, 70, true );
	add_image_size( '_tm-thumb-100-70', 100, 70, true );
	add_image_size( '_tm-thumb-s', 150, 150, true );
	add_image_size( '_tm-thumb-240-100', 240, 100, true );
	add_image_size( '_tm-thumb-370-300', 370, 300, true );
	add_image_size( '_tm-thumb-m', 400, 400, true );
	add_image_size( '_tm-thumb-495-350', 495, 350, true );
	add_image_size( '_tm-thumb-540-410', 540, 410, true );
	add_image_size( '_tm-post-thumbnail-large', 770, 278, true );
	add_image_size( '_tm-thumb-1170-781', 1170, 781, true );
	add_image_size( '_tm-thumb-l', 1170, 480, true );
	add_image_size( '_tm-thumb-xl', 1920, 1080, true );

	add_image_size( '_tm-thumb-880-610', 880, 610, true );
	add_image_size( '_tm-thumb-495-610', 495, 610, true );
	add_image_size( '_tm-thumb-605-305', 605, 305, true );
}