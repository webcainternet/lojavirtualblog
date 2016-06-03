<footer class="comment-meta">
	<div class="comment-author vcard">
		<?php echo gadnews_comment_author_avatar(); ?>
	</div>
	<div class="comment-metadata">
		<?php printf( __( '<span class="posted-by"></span> %s', 'gadnews' ), gadnews_get_comment_author_link() ); ?>
		<?php echo gadnews_get_human_time_diff(); ?>
	</div>
</footer>
<div class="comment-content">
	<?php echo gadnews_get_comment_text(); ?>
	<div class="reply">
		<?php echo gadnews_get_comment_reply_link( array( 'reply_text' => esc_html__('Reply', '_tm') ) ); ?>
	</div>
</div>