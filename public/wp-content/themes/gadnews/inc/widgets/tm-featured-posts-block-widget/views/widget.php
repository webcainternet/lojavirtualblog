<?php
/**
 * Template part to display a single layout
 *
 * @package    gadnews/widgets
 */

?><div class="tm_fpblock__wrapper">
	<?php echo $this->render_layout( array(
		'layout'    => $this->instance['layout'],
		'wrapper'   => '<div class="tm_fpblock tm_fpblock-%1$s">%2$s</div>',
 	) ); ?>
</div>
