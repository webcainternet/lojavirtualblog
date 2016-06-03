<?php
/**
 * Template part to display subscribe form
 *
 * @package gadnews/widgets
 */
?>
<div class="subscribe-block">
	<div class="subscribe-block__description">
		<?php echo $this->get_block_title( 'subscribe' ); ?>
		<?php echo $this->get_block_message( 'subscribe' ); ?>
	</div>
	<form method="POST" action="" class="subscribe-block__form"><?php
		wp_nonce_field( 'gadnews_subscribe', 'gadnews_subscribe' );
	?><div class="subscribe-block__input-group"><?php
		echo $this->get_subscribe_input();
		$btn = 'btn';
		if ( 'footer-area' === $this->args['id'] ) {
			$btn .= ' btn-secondary';
		}
		if ( 'sidebar-primary' === $this->args['id'] || 'sidebar-secondary' === $this->args['id'] ) {
			$btn .= ' btn-icon';
		}
		echo $this->get_subscribe_submit( $btn );
	?></div><?php
		echo $this->get_subscribe_messages();
	?></form>
</div>