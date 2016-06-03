<?php
/**
 * Template part for posts pagination.
 *
 * @package Gadnews
 */
the_posts_pagination(
	array(
		'prev_text' => __('Back', '_tm'),
		'next_text' => __('Next', '_tm')
	)
);
