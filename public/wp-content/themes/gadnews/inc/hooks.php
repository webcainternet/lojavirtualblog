<?php
/**
 * Gadnews Theme hooks.
 *
 * @package gadnews
 */

// Menu description
add_filter( 'walker_nav_menu_start_el', 'gadnews_nav_menu_description', 10, 4 );
// Rewrite thumbnail size for non-deafult blog formats
add_filter( 'gadnews_post_thumbail_size', 'gadnews_set_thumb_sizes' );
// Sidebars classes.
add_filter( 'gadnews_widget_area_classes', 'gadnews_set_sidebar_classes', 10, 2 );
// Add row to footer area classes
add_filter( 'gadnews_widget_area_classes', 'gadnews_add_footer_widgets_wrapper_classes', 10, 2 );
// Set footer columns
add_filter( 'dynamic_sidebar_params', 'gadnews_get_footer_widget_layout' );
// Adapt default image post format classes to current theme
add_filter( 'cherry_post_formats_image_css_model', 'gadnews_add_image_format_classes', 10, 2 );
// Enqueue sticky menu if required
add_filter( 'gadnews_theme_script_depends', 'gadnews_enqueue_misc' );
// Add has/no thumbnail classes for posts
add_filter( 'post_class', 'gadnews_post_thumb_classes' );
// Modify a comment form.
add_filter( 'comment_form_defaults', 'gadnews_modify_comment_form' );
//Modify a breadcrumbs args
add_filter('cherry_breadcrumb_args', 'gadnews_breadcrumb_args');
//Add custom image size to media library
add_filter( 'image_size_names_choose', 'gadnews_custom_sizes' );
//change custom posts date icon
add_filter('gadnews_custom_posts_date_icon', 'gadnews_change_custom_posts_date_icon');
//change icon meta-date
add_filter('cherry_terms_icon', 'gadnews_terms_icon');
add_filter('cherry_date_icon', 'gadnews_date_icon');
add_filter('cherry_author_icon', 'gadnews_author_icon');

/**
 * Append description into nav items
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string
 */
function gadnews_nav_menu_description( $item_output, $item, $depth, $args ) {

	if ( 'main' !== $args->theme_location || ! $item->description ) {
		return $item_output;
	}

	$descr_enabled = get_theme_mod(
		'header_menu_attributes',
		gadnews_theme()->customizer->get_default( 'header_menu_attributes' )
	);

	if ( ! $descr_enabled ) {
		return $item_output;
	}

	$current     = $args->link_after . '</a>';
	$description = '<div class="menu-item_description">' . $item->description . '</div>';
	$item_output = str_replace( $current, $description . $current, $item_output );

	return $item_output;

}

/**
 * Rewrite thumbnail size for non-deafult blog template
 *
 * @param  bool|string $size Default size.
 * @return string
 */
function gadnews_set_thumb_sizes( $size ) {

	if ( is_single() ) {
		return '_tm-thumb-1170-781';
	}

	$layout = get_theme_mod( 'blog_layout_type', gadnews_theme()->customizer->get_default( 'blog_layout_type' ) );

	if ( 'masonry-3-cols' === $layout && ! ( is_sticky() && is_home() && ! is_paged() ) ) {
		return '_tm-thumb-masonry_2';
	}

	if ( 'masonry-2-cols' === $layout && ! ( is_sticky() && is_home() && ! is_paged() ) ) {
		return '_tm-thumb-masonry';
	}

	if ( 'grid-3-cols' === $layout || 'grid-2-cols' === $layout && ! ( is_sticky() && is_home() && ! is_paged() ) ) {
		return '_tm-thumb-370-300';
	}

	if ( 'default' === $layout && ! ( is_sticky() && is_home() && ! is_paged() ) ) {
		return $size;
	}

	if ( 'default' !== $layout && ! ( is_sticky() && is_home() && ! is_paged() ) ) {
		return 'post-thumbnail';
	}

	return '_tm-post-thumbnail-large';
}

/**
 * Set layout classes for sidebars.
 *
 * @since  1.0.0
 * @uses   gadnews_get_layout_classes.
 * @param  array  $classes Additional classes.
 * @param  string $area_id Sidebar ID.
 * @return array
 */
function gadnews_set_sidebar_classes( $classes, $area_id ) {

	if ( ! in_array( $area_id, array( 'sidebar-primary' , 'sidebar-secondary' ) ) ) {
		return $classes;
	}

	return gadnews_get_layout_classes( 'sidebar', $classes );
}

/**
 * Set layout classes for sidebars.
 *
 * @since  1.0.0
 * @param  array  $classes Additional classes.
 * @param  string $area_id Sidebar ID.
 * @return array
 */
function gadnews_add_footer_widgets_wrapper_classes( $classes, $area_id ) {

	if ( 'footer-area' !== $area_id ) {
		return $classes;
	}

	$classes[] = 'row';

	return $classes;
}


/**
 * Get footer widgets layout class
 *
 * @since  1.0.0
 * @param  string $params Existing widget classes.
 * @return string
 */
function gadnews_get_footer_widget_layout( $params ) {

	if ( empty( $params[0]['id'] ) || 'footer-area' !== $params[0]['id'] ) {
		return $params;
	}

	if ( empty( $params[0]['before_widget'] ) ) {
		return $params;
	}

	$columns = get_theme_mod(
		'footer_widget_columns',
		gadnews_theme()->customizer->get_default( 'footer_widget_columns' )
	);

	$columns = intval( $columns );
	$classes = 'class="col-xs-12 col-sm-%2$s col-md-%1$s %3$s ';

	switch ( $columns ) {
		case 4:
			$md_col = 3;
			$sm_col = 6;
			$extra  = '';
			break;

		case 3:
			$md_col = 4;
			$sm_col = 4;
			$extra  = '';
			break;

		case 2:
			$md_col = 6;
			$sm_col = 6;
			$extra  = '';
			break;

		default:
			$md_col = 12;
			$sm_col = 12;
			$extra  = 'footer-area--centered';
			break;
	}

	$params[0]['before_widget'] = str_replace(
		'class="',
		sprintf( $classes, $md_col, $sm_col, $extra ),
		$params[0]['before_widget']
	);

	return $params;
}

/**
 * Filter image CSS model
 *
 * @param  array $css_model Default CSS model.
 * @param  array $args      Post formats module arguments.
 * @return array
 */
function gadnews_add_image_format_classes( $css_model, $args ) {
	$css_model['link'] .= ' post-thumbnail--fullwidth';
	return $css_model;
}

/**
 * Add jQuery Stickup to theme script dependencies if required.
 *
 * @param  array $depends Default dependencies.
 * @return array
 */
function gadnews_enqueue_misc( $depends ) {

	$header_menu_sticky = get_theme_mod( 'header_menu_sticky', gadnews_theme()->customizer->get_default( 'header_menu_sticky' ) );

	if ( $header_menu_sticky && ! wp_is_mobile() ) {
		$depends[] = 'jquery-stickup';
	}

	$totop_visibility = get_theme_mod( 'totop_visibility', gadnews_theme()->customizer->get_default( 'totop_visibility' ) );

	if ( $totop_visibility ) {
		$depends[] = 'jquery-totop';
	}

	return $depends;

}

/**
 * Add has/no thumbnail classes for posts
 *
 * @param  array $classes Existing classes.
 * @return array
 */
function gadnews_post_thumb_classes( $classes ) {

	$thumb = 'no-thumb';

	if ( has_post_thumbnail() ) {
		$thumb = 'has-thumb';
	}

	$classes[] = $thumb;

	if ( is_home() && 'minimal' == get_theme_mod( 'blog_layout_type' ) ) {
		$key = array_search( 'hentry', $classes );
		unset( $classes[ $key ] );
	}

	return $classes;
}

/**
 * Add placeholder attributes for comment form fields.
 *
 * @param  array $args Argumnts for comment form.
 * @return array
 */
function gadnews_modify_comment_form( $args ) {
	$args = wp_parse_args( $args );

	if ( ! isset( $args['format'] ) ) {
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
	}

	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$html_req  = ( $req ? " required='required'" : '' );
	$html5     = 'html5' === $args['format'];
	$commenter = wp_get_current_commenter();

	$args['label_submit'] = __( 'Submit Comment', 'gadnews' );

	$args['fields']['author'] = '<p class="comment-form-author"><input id="author" class="comment-form__field" name="author" type="text" placeholder="' . __( 'Name', 'gadnews' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>';

	$args['fields']['email'] = '<p class="comment-form-email"><input id="email" class="comment-form__field" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' placeholder="' . __( 'E-mail', 'gadnews' ) . ( $req ? ' *' : '' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>';

	$args['fields']['url'] = '<p class="comment-form-url"><input id="url" class="comment-form__field" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' placeholder="' . __( 'Website', 'gadnews' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

	$args['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" class="comment-form__field" name="comment" placeholder="' . __( 'Comments *', 'gadnews' ) . '" cols="45" rows="8" aria-required="true" required="required"></textarea></p>';

	$args['title_reply_before'] = '<h2 id="reply-title" class="comment-reply-title">';

	$args['title_reply_after'] = '</h2>';

	$args['title_reply'] = __('Leave a Reply', '_tm');

	return $args;
}

/**
 * Modify a breadcrumbs args
 *
 * @param $args
 *
 * @return mixed
 */

function gadnews_breadcrumb_args ($args){
	$args['separator'] = '<span class="fa fa-angle-right"></span>';
	return $args;
}


/**
 * Add custom image size to media library
 *
 * @param $sizes
 *
 * @return array
 */
function gadnews_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'_tm-thumb-70-70' => 'Small',
	) );
}

/**
 * Change custom posts date icon
 *
 * @return string
 */
function gadnews_change_custom_posts_date_icon(){
	return $date_icon = '';
}

/**
 * Change terms icon
 *
 * @return string
 */
function gadnews_terms_icon (){
	$icon = '';
	return $icon;
}

/**
 *  Change date icon
 *
 * @return string
 */
function gadnews_date_icon(){
	$icon = '';
	return $icon;
}

/**
 *  Change author icon
 *
 * @return string
 */
function gadnews_author_icon(){
	$icon = '';
	return $icon;
}