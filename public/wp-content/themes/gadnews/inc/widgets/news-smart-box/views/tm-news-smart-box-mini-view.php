<div class="inner">
	<header class="entry-header">
		<?php echo $image; ?>
	</header>
	<div class="entry-content">
		<h5><?php echo $title; ?></h5>
		<?php echo $content; ?>
		<div class="entry-meta">
			<?php if ( 'true' == $this->instance['date_visibility'] ) { ?>
			<span class="post__date"><?php echo $date; ?></span> <?php
			} ?>
		</div>
	</div>
</div>