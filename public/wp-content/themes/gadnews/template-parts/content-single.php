<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Gadnews
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			the_title( '<h1 class="entry-title">', '</h1>' );
		?>

		<?php if ( 'post' === get_post_type() ) : ?>

			<div class="entry-meta">
				<?php gadnews_meta_categories( 'single' ); ?>
				<div class="entry-meta-center">
					<?php
						gadnews_meta_date( 'single');

						gadnews_meta_author('single');

						gadnews_meta_comments( 'single', array(
							'before' => '<i class="fa fa-comment-o"></i>',
							'zero'   => esc_html__( 'Leave a comment', 'gadnews' ),
							'one'    => '1',
							'plural' => '%',
						) );
					?>
				</div>
				<?php gadnews_share_buttons( 'single' ); ?>

			</div><!-- .entry-meta -->

		<?php endif; ?>

	</header><!-- .entry-header -->

	<figure class="post-thumbnail">
		<?php gadnews_post_thumbnail( false ); ?>

		<?php if(has_post_format( 'link' )){ ?>
			<div class="post-thumbnail__format-link">
				<?php do_action( 'cherry_post_format_link', array( 'render' => true, 'class' => 'invert' ) ); ?>
			</div>
		<?php }?>
	</figure><!-- .post-thumbnail -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gadnews' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			gadnews_meta_tags( 'single', array(
				'before'    => '',
				'separator' => ' ',
			) );
		?>
		<?php
			gadnews_share_buttons( 'single', array(), array(
				'before' => __( '<span class="share-btns__text">Share this post</span>', 'gadnews' ),
			) );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
