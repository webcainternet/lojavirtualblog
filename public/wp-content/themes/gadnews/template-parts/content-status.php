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

	<?php gadnews_meta_categories( 'loop' ); ?>
	<?php gadnews_sticky_label(); ?>

	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php

			$embed_args = array(
				'fields' => array( 'twitter', 'facebook' ),
				'height' => 300,
				'width'  => 300,
			);
			$embed_content = apply_filters( 'cherry_get_embed_post_formats', false, $embed_args );

			if ( false === $embed_content ) {
				gadnews_blog_content();
			} else {
				printf( '<div class="embed-wrapper">%s</div>', $embed_content );
			}
		?>
	</div><!-- .entry-content -->

	<?php if ( 'post' === get_post_type() ) : ?>

		<div class="entry-meta">
			<?php
				gadnews_meta_date( 'loop', array(
					'before' => '<i class="material-icons">event</i>',
				) );

				gadnews_meta_comments( 'loop', array(
					'before' => '<i class="material-icons">mode_comment</i>',
					'zero'   => esc_html__( 'Leave a comment', 'gadnews' ),
					'one'    => '1',
					'plural' => '%',
				) );

				gadnews_meta_tags( 'loop', array(
					'before'    => '<i class="material-icons">folder_open</i>',
					'separator' => ', ',
				) );
			?>
		</div><!-- .entry-meta -->

	<?php endif; ?>

	<footer class="entry-footer">
		<?php gadnews_share_buttons( 'loop' ); ?>
		<?php gadnews_read_more(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
