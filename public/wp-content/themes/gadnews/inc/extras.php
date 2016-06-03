<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package gadnews
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function gadnews_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'gadnews_body_classes' );

/**
 * Set post specific sidebar position
 *
 * @param  string $position Default sidebar position.
 * @return string
 */
function gadnews_set_sidebar_position( $position ) {

	if(is_home() || is_archive() || is_search()){
		return get_theme_mod('sidebar_position_listing', gadnews_theme()->customizer->get_default( 'sidebar_position_home' ));
	}

	if ( is_front_page() || ! is_singular() ) {
		return $position;
	}

	$post_id = get_the_id();

	if ( ! $post_id ) {
		return $position;
	}

	$post_position = get_post_meta( $post_id, '_tm_sidebar_position', true );

	if ( ! $post_position || 'inherit' === $post_position ) {
		return $position;
	}

	return $post_position;

}
add_filter( 'theme_mod_sidebar_position', 'gadnews_set_sidebar_position' );

/**
 * Render existing macros in passed string.
 *
 * @since  1.0.0
 * @param  string $string String to parse.
 * @return string
 */
function gadnews_render_macros( $string ) {

	$macros = apply_filters( 'gadnews_data_macros', array(
		'/%%year%%/' => date( 'Y' ),
		'/%%date%%/' => date( get_option( 'date_format' ) ),
	) );

	return preg_replace( array_keys( $macros ), array_values( $macros ), $string );

}

/**
 * Render font icons in content
 *
 * @param  string $content content to render
 * @return string
 */
function gadnews_render_icons( $content ) {

	$icons     = gadnews_get_render_icons_set();
	$icons_set = implode( '|', array_keys( $icons ) );

	$regex = '/icon:(' . $icons_set . ')?:?([a-zA-Z0-9-_]+)/';

	return preg_replace_callback( $regex, 'gadnews_render_icons_callback', $content );
}

/**
 * Callback for icons render.
 *
 * @param  array $matches Search matches array.
 * @return string
 */
function gadnews_render_icons_callback( $matches ) {

	if ( empty( $matches[1] ) && empty( $matches[2] ) ) {
		return $matches[0];
	}

	if ( empty( $matches[1] ) ) {
		return sprintf( '<i class="fa fa-%s"></i>', $matches[2] );
	}

	$icons = gadnews_get_render_icons_set();

	if ( ! isset( $icons[ $matches[1] ] ) ) {
		return $matches[0];
	}

	return sprintf( $icons[ $matches[1] ], $matches[2] );
}

/**
 * Get list of icons to render
 *
 * @return array
 */
function gadnews_get_render_icons_set() {
	return apply_filters( 'gadnews_render_icons_set', array(
		'fa'       => '<i class="fa fa-%s"></i>',
		'material' => '<i class="material-icons">%s</i>',
	) );
}

/**
 * Get spesific template part name for current post.
 *
 * @return string
 */
function gadnews_get_template_part_name() {

	static $layout = null;

	if ( null === $layout ) {
		$layout = ( is_home() && 'minimal' == get_theme_mod( 'blog_layout_type' ) ) ? 'minimal' : false;
	}

	if ( 'minimal' === $layout ) {
		return $layout;
	}

	return get_post_format();

}

/**
 * Replace %s with theme URL.
 *
 * @param  string $url Formatted URL to parse.
 * @return string
 */
function gadnews_render_theme_url( $url ) {
	return sprintf( $url, get_stylesheet_directory_uri() );
}

/**
 * Get thumbnail size depending from seleted layout
 *
 * @return string
 */
function gadnews_get_thumbnail_size() {

	$layout = get_theme_mod( 'blog_layout_type', gadnews_theme()->customizer->get_default( 'blog_layout_type' ) );

	if ( 'default' !== $layout && ! ( is_sticky() && is_home() && ! is_paged() ) ) {
		return 'post-thumbnail';
	}

	return '_tm-post-thumbnail-large';
}

/**
 * Get image ID by url
 *
 * @param  string $image_src Image URL to search it in database.
 * @return int|bool false
 */
function gadnews_get_image_id_by_url( $image_src ) {

	global $wpdb;

	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	$id    = $wpdb->get_var( $query );

	return $id;
}

function gadnews_post_formats_gallery() {
	if ( ! in_array( get_theme_mod( 'blog_layout_type' ), array( 'masonry-2-cols', 'masonry-3-cols' ) ) ) {
		return do_action( 'cherry_post_format_gallery', array(
				'size' => gadnews_get_thumbnail_size(),
		) );
	}
	$images = gadnews_theme()->get_core()->modules['cherry-post-formats-api']->get_gallery_images(false);
	if ( is_string( $images ) && ! empty( $images ) ) {
		return $images;
	}
	$items             = array();
	$first_item        = null;
	$size              = gadnews_get_thumbnail_size();
	$format            = '<div class="mini-gallery post-thumbnail--fullwidth">%1$s<div class="post-gallery__slides" style="display: none;">%2$s</div></div>';
	$first_item_format = '<a href="%1$s" class="post-thumbnail__link">%2$s</a>';
	$item_format       = '<a href="%1$s">%2$s</a>';
	foreach( $images as $img ) {
		$image = wp_get_attachment_image( $img, $size );
		$url   = wp_get_attachment_url( $img );
		if ( sizeof( $items ) === 0 ) {
			$first_item = sprintf( $first_item_format, $url, $image );
		}
		$items[] = sprintf( $item_format, $url, $image );
	}
	printf( $format, $first_item, join( "\r\n", $items ) );
}