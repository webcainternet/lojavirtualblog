<?php
/**
 * Template part for displaying posts in minimal layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gadnews
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item' ); ?>>

	<?php
		the_date( get_option( 'date_format' ), '<p><time class="post__new-date">', '</time></p>' );

		gadnews_meta_date( 'loop', array( 'format' => 'H:i' ) );

		the_title( '<h5 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' );
	?>
</article><!-- #post-## -->
