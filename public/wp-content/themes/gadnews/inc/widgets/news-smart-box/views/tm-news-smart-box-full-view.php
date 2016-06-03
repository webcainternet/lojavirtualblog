<div class="inner">
	<header class="entry-header">
		<?php echo $image; ?>
		<div class="post__cats"><?php echo $terms_line; ?></div>
	</header>
	<div class="entry-content">
		<h2><?php echo $title; ?></h2>
		<?php echo $content; ?>
		<div class="entry-meta">
			<?php if ( 'true' == $this->instance['date_visibility'] ) { ?>
				<span class="post__date"><?php echo $date; ?></span> <?php
			} ?>
			<?php if ( 'true' == $this->instance['author_visibility'] ) { ?>
				<div class="post__author vcard"><span><?php echo esc_html__( '', 'gadnews' ); ?></span><?php echo $author; ?></div> <?php
			} ?>
			<?php if ( 'true' == $this->instance['comment_visibility'] ) { ?>
				<span class="post__comments"><i class="fa fa-comment-o"></i><?php echo $comments; ?></span> <?php
			} ?>
		</div>
	</div>
</div>