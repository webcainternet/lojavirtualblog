<?php
/**
 * The template for displaying author bio.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package gadnews
 */
?>
<div class="post-author-bio invert">
	<div class="post-author__holder clear">
		<div class="post-author__avatar"><?php
			echo get_avatar( get_the_author_meta( 'user_email' ), 120, '', esc_attr( get_the_author_meta( 'nickname' ) ) );
		?></div>
		<h4 class="post-author__title"><?php
			printf( esc_html__( 'Written by %s', 'gadnews' ), gadnews_get_the_author_posts_link() );
		?></h4>
		<div class="post-author__content"><?php
			echo get_the_author_meta( 'description' );
		?></div>
	</div>
</div>