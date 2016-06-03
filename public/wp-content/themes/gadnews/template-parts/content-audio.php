<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gadnews
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'posts-list__item card' ); ?>>

	<header class="entry-header">
		<?php gadnews_meta_categories( 'loop' ); ?>
		<?php gadnews_sticky_label(); ?>
		<?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>
	</header><!-- .entry-header -->

	<div class="post-featured-content invert">
		<?php do_action( 'cherry_post_format_audio' ); ?>
	</div><!-- .post-featured-content -->


	<div class="entry-content">
		<?php

			$embed_args = array(
				'fields' => array( 'soundcloud' ),
				'height' => 310,
				'width'  => 310,
			);
			$embed_content = apply_filters( 'cherry_get_embed_post_formats', false, $embed_args );

			if ( false === $embed_content ) {
				gadnews_blog_content();
			} else {
				printf( '<div class="embed-wrapper">%s</div>', $embed_content );
			}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php gadnews_read_more(); ?>

		<?php if ( 'post' === get_post_type() ) : ?>

			<div class="entry-meta">
				<?php
				gadnews_meta_date( 'loop' );

				gadnews_meta_author( 'loop' );

				gadnews_meta_comments( 'loop', array(
						'before' => '<i class="fa fa-comment-o"></i>',
						'zero'   => '0',
						'one'    => '1',
						'plural' => '%',
				) );
				?>
			</div><!-- .entry-meta -->

		<?php endif; ?>

		<?php gadnews_share_buttons( 'loop' ); ?>

		<?php gadnews_meta_tags( 'loop', array(
				'before'    => '',
				'separator' => ', ',
		) );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
