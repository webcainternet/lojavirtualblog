<?php
/**
 * Template part to display about author widget content
 *
 * @package gadnews/widgets
 */
?>
<div class="about-author"><?php
	echo $this->get_author_avatar();
	?><div class="about-author_content"><?php
		echo $this->get_author_name();
		echo $this->get_author_description();
		echo $this->get_author_button();
	?></div>
</div>
