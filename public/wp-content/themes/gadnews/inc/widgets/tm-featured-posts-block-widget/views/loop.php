<?php
/**
 * Template part to display a single post while in a layout posts loop
 *
 * @package    gadnews/widgets
 */

?>
<div class="tm_fpblock__item tm_fpblock__item-<?php print $item_count; ?> post-<?php the_ID(); ?> tm_fpblock__item-<?php print esc_attr( $special_class ); ?>">

	<?php $preview_url = get_the_post_thumbnail_url( null, $image_size ); ?>
	<div class="tm_fpblock__item__preview" style="background-image: url('<?php print esc_attr( $preview_url ); ?>');">
		<img src="<?php print esc_attr( $preview_url ); ?>">

	</div>

	<?php if ( 'true' === $this->instance['checkboxes']['categories'] ) : ?>
		<?php print $this->post_categories(
			array(
				'before' => '<div class="tm_fpblock__item__categories post__cats">',
				'after'  => '</div>',
				'format' => '<a href="%1$s" class="tm_fpblock__item__category">%2$s</a>',
			)
		); ?>
	<?php endif; ?>

	<div class="tm_fpblock__item__description">
		<?php if ( 'true' === $this->instance['checkboxes']['title'] ) : ?>
			<?php the_title( sprintf( '<h2 class="tm_fpblock__item__title"><a href="%s">', esc_url( get_the_permalink() ) ), '</a></h2>' ); ?>
		<?php endif; ?>

		<?php if ( 'true' === $this->instance['checkboxes']['excerpt'] ) : ?>
			<div class="tm_fpblock__item__content">
				<?php wp_trim_words( the_excerpt(), $this->instance['excerpt_length'] || 55 ); ?>
			</div>
		<?php endif; ?>

		<div class="entry-meta">
			<?php if ( 'true' === $this->instance['checkboxes']['date'] ) : ?>
				<?php print $this->post_date(
					array(
						'for_human'   => false,
						'date_format' => 'M n, Y',
						'format'      => '<div class="tm_fpblock__item__date post__date"><a href="%1$s">%2$s</a></div>',
					)
				); ?>
			<?php endif; ?>

			<?php if ( 'true' === $this->instance['checkboxes']['author'] ) : ?>
				<?php print $this->post_author(
					array(
						'before'  => '<div class="tm_fpblock__item__author post-author">',
						'after'   => '</div>',
						'format' => '<a href="%1$s">%2$s</a>',
					)
				); ?>
			<?php endif; ?>

			<?php if ( 'true' === $this->instance['checkboxes']['comments_count'] ) : ?>
				<?php print $this->post_comments_count(
					array(
						'before'       => '<div class="tm_fpblock__item__comments_count post__comments"><i class="fa fa-comment-o"></i>',
						'after'        => '</div>',
						'has_comments' => '<a href="%1$s">%2$s</a>',
						'no_comments'  => '<span>%2$s</span>',
					)
				); ?>
			<?php endif; ?>

			<?php if ( 'true' === $this->instance['checkboxes']['tags'] ) : ?>
				<?php print $this->post_tags(
					array(
						'before' => '<div class="tm_fpblock__item__tags post__tags">',
						'after'  => '</div>',
						'format' => '<a href="%1$s" class="tm_fpblock__item__tag">%2$s</a>',
					)
				); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
