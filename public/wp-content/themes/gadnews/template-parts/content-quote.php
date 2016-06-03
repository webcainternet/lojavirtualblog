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

	<div class="post-featured-content invert">
		<?php gadnews_sticky_label(); ?>
		<?php do_action( 'cherry_post_format_quote' ); ?>
	</div><!-- .post-featured-content -->

	<header class="entry-header">
		<?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		}
		?>
	</header><!-- .entry-header -->

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
