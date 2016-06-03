<?php

class GADNEWS_News_Smart_Box_Widget extends Cherry_Abstract_Widget {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass = 'gadnews widget_news_smart_box';
		$this->widget_description = esc_html__( 'Display a list of your posts on your site.', 'gadnews' );
		$this->widget_id = 'widget_news_smart_box';
		$this->widget_name = esc_html__( 'GADNEWS New Smart Box Widget', 'gadnews' );
		$this->settings = array(
			'title' => array(
				'type'  => 'text',
				'value' => esc_html__( 'News Smart Box', 'gadnews' ),
				'label' => esc_html__( 'Title', 'gadnews' ),
			),
			'layout_type' => array(
				'type'				=> 'radio',
				'value'				=> 'layout_type_1',
				'options'			=> array(
					'layout_type_1' => array(
						'label'		=> esc_html__( 'Layout type 1', 'gadnews' ),
						'img_src'	=> GADNEWS_THEME_URI . '/assets/images/admin/widgets/news-smart-box/news-smart-box-layout-1.svg',
					),
					'layout_type_2' => array(
						'label'		=> esc_html__( 'Layout type 2', 'gadnews' ),
						'img_src'	=> GADNEWS_THEME_URI . '/assets/images/admin/widgets/news-smart-box/news-smart-box-layout-2.svg',
					),
					'layout_type_3' => array(
						'label'		=> esc_html__( 'Layout type 3', 'gadnews' ),
						'img_src'	=> GADNEWS_THEME_URI . '/assets/images/admin/widgets/news-smart-box/news-smart-box-layout-3.svg',
					),
				),
				'label'				=> esc_html__( 'Choose layout type', 'gadnews' ),
			),
			'terms_type' => array(
				'type'				=> 'radio',
				'value'				=> 'category',
				'options'			=> array(
					'category' => array(
						'label'		=> esc_html__( 'Category', 'gadnews' ),
						'slave'		=> 'terms_type_category',
					),
					'post_tag' => array(
						'label'		=> esc_html__( 'Tag', 'gadnews' ),
						'slave'		=> 'terms_type_post_tag',
					),
				),
				'label'				=> esc_html__( 'Choose taxonomy type', 'gadnews' ),
			),
			'current_category' => array(
				'type'				=> 'select',
				'value'				=> '',
				'options_callback'	=> array( $this, 'get_terms_list', array( 'category', 'slug' ) ),
				'options'			=> false,
				'label'				=> esc_html__( 'Select category', 'gadnews' ),
				'placeholder'		=> esc_html__( 'Select category', 'gadnews' ),
				'master'			=> 'terms_type_category',
			),
			'categories' => array(
				'type'				=> 'select',
				'size'				=> 1,
				'value'				=> '',
				'options_callback'	=> array( $this, 'get_terms_list', array( 'category', 'slug' ) ),
				'options'			=> false,
				'label'				=> esc_html__( 'Select secondary categories', 'gadnews' ),
				'multiple'			=> true,
				'placeholder'		=> esc_html__( 'Select categories', 'gadnews' ),
				'master'			=> 'terms_type_category',
			),
			'current_tag' => array(
				'type'				=> 'select',
				'value'				=> '',
				'options_callback'	=> array( $this, 'get_terms_list', array( 'post_tag', 'slug' ) ),
				'options'			=> false,
				'label'				=> esc_html__( 'Select tag', 'gadnews' ),
				'placeholder'		=> esc_html__( 'Select tag', 'gadnews' ),
				'master'			=> 'terms_type_post_tag',
			),
			'tags' => array(
				'type'				=> 'select',
				'size'				=> 1,
				'value'				=> '',
				'options_callback'	=> array( $this, 'get_terms_list', array( 'post_tag', 'slug' ) ),
				'options'			=> false,
				'label'				=> esc_html__( 'Select secondary tags', 'gadnews' ),
				'multiple'			=> true,
				'placeholder'		=> esc_html__( 'Select tags', 'gadnews' ),
				'master'			=> 'terms_type_post_tag',
			),
			'posts_per_page' => array(
				'type' => 'stepper',
				'value' => 6,
				'max_value' => 20,
				'min_value' => 1,
				'label'  => esc_html__( 'Posts count', 'gadnews' ),
			),
			'trim_title_words' => array(
				'type' => 'slider',
				'value' => 5,
				'max_value' => 55,
				'min_value' => 1,
				'step_value' => 1,
				'label'  => esc_html__( 'Title words trimmed count', 'gadnews' ),
			),
			'trim_content_words' => array(
				'type' => 'slider',
				'value' => 15,
				'max_value' => 55,
				'min_value' => 1,
				'step_value' => 1,
				'label'  => esc_html__( 'Content words trimmed count', 'gadnews' ),
			),
			'date_visibility' => array(
				'type' => 'switcher',
				'value' => 'true',
				'style' => ( wp_is_mobile() ) ? 'normal' : 'small',
				'label' => esc_html__( 'Display date', 'gadnews' ),
			),
			'author_visibility' => array(
				'type' => 'switcher',
				'value' => 'true',
				'style' => ( wp_is_mobile() ) ? 'normal' : 'small',
				'label' => esc_html__( 'Display author', 'gadnews' ),
			),
			'comment_visibility' => array(
				'type' => 'switcher',
				'value' => 'true',
				'style' => ( wp_is_mobile() ) ? 'normal' : 'small',
				'label' => esc_html__( 'Display comments', 'gadnews' ),
			),
		);

		parent::__construct();

		add_action( 'wp_ajax_new_smart_box_instance', array( $this, 'new_smart_box_instance' ) );
		add_action( 'wp_ajax_nopriv_new_smart_box_instance', array( $this, 'new_smart_box_instance' ) );
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @since 1.0.0
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		ob_start();

		$this->setup_widget_data( $args, $instance );
		$this->widget_start( $args, $instance );

		$html = '';

		$categories_array = ( isset( $this->instance['categories'] ) ) ? $this->instance['categories'] : array();
		$tags_array = ( isset( $this->instance['tags'] ) ) ? $this->instance['tags'] : array();

		switch ( $this->instance['terms_type'] ) {
			case 'category':
				$current_term_slug = $this->instance['current_category'];
				$alt_terms_slug_list = $categories_array;
				break;
			case 'post_tag':
				$current_term_slug = $this->instance['current_tag'];
				$alt_terms_slug_list = $tags_array;
				break;
		}

		$instance = uniqid();
		$instance_settings = json_encode( $this->instance );

		$data_attr_line = 'class="news-smart-box__instance ' . $this->instance['layout_type'] . '"';
		$data_attr_line .= ' data-uniq-id="news-smart-box-' . $instance . '"';
		$data_attr_line .= " data-instance-settings='" . $instance_settings . "' ";

		echo '<div class="news-smart-box">';
			echo '<div id="news-smart-box-' . $instance . '" ' . $data_attr_line . '>';
				echo $this->get_navigation_box( $current_term_slug, $alt_terms_slug_list );
				echo '<div class="news-smart-box__wrapper">';
					echo '<div class="news-smart-box__listing">';
						$this->get_new_instance( $current_term_slug );
					echo '</div>';
			echo '</div>';
		echo '</div>';

		$this->widget_end( $args );
		$this->reset_widget_data();
		wp_reset_postdata();

		echo $this->cache_widget( $args, ob_get_clean() );
	}

	/**
	 * Get new instance
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function get_new_instance( $current_term_slug ) {

		$tax_query = array();
		$alt_terms_slug_list = array();

		// The Query.
		$posts_query = $this->get_query_items( array(
			'posts_per_page'	=> $this->instance['posts_per_page'],
			'tax_query'			=> array(
				array(
					'taxonomy'	=> $this->instance['terms_type'],
					'field'		=> 'slug',
					'terms'		=> array( $current_term_slug ),
				),
			),
		) );

		if ( $posts_query ) {
			echo '<div class="row">';
				$this->get_smart_box_loop( $posts_query );
				echo '<div class="clear"></div>';
			echo '</div>';
		}
	}

	/**
	 * Get news items.
	 *
	 * @since  1.0.0
	 * @param  array|string $args Arguments to be passed to the query.
	 * @return array|bool         Array if true, boolean if false.
	 */
	public function get_query_items( $query_args = array() ) {

		$defaults_query_args = apply_filters( 'gadnews_carousel_default_query_args', array(
			'posts_per_page' => '5',
			'post_type'      => 'post',
			'orderby'        => 'date',
			'order'          => 'DESC',
			'posts_per_page' => -1,
			'tax_query'      => array(),
		) );

		$query_args = wp_parse_args( $query_args, $defaults_query_args );
		$query_args = array_intersect_key( $query_args, $defaults_query_args );

		// The Query.
		$posts_query = new WP_Query( $query_args );
		$this->posts_query = $posts_query;

		if ( !is_wp_error( $posts_query ) ) {
			return $posts_query;
		} else {
			return false;
		}
	}

	/**
	 * Get slider items.
	 *
	 * @since  1.0.0
	 * @param  array         $posts_query      List of WP_Post objects.
	 * @return string
	 */
	public function get_smart_box_loop( $posts_query ) {
		$post_counter = 0;

		if ( $posts_query->have_posts() ) {
			while ( $posts_query->have_posts() ) : $posts_query->the_post();
				$post_id = $posts_query->post->ID;
				$date = get_the_date();
				$title = get_the_title( $post_id );
				$permalink = get_permalink();

				$thumb_id = get_post_thumbnail_id();

				$placeholder_args = apply_filters( 'gadnews_news_smart_box_placeholder_args',
					array(
						'width'			=> 560,
						'height'		=> 350,
						'background'	=> '000',
						'foreground'	=> 'fff',
						'title'			=> $title,
					)
				);

				$image_size = apply_filters( 'gadnews_carousel_image_size', '_tm-thumb-540-410' );
				$image = '<a class="post-thumbnail__link" href="' . $permalink . '">' . $this->get_image( $post_id, $image_size, $placeholder_args ) .'</a>';

				$trim_title_words = isset( $this->instance['trim_title_words'] ) ? $this->instance['trim_title_words'] : 5;
				$title = '<a href="' . $permalink . '">' . $this->get_trimed_content( $title, (int) $trim_title_words ) . '</a>';

				$trim_content_words = isset( $this->instance['trim_content_words'] ) ? $this->instance['trim_content_words'] : 15;
				$content = '<p class="post__excerpt">' . $this->get_trimed_content( get_the_content(), (int) $trim_content_words ) . '</p>';

				$date = '<a href="' . $permalink . '">' . $this->get_post_date( $post_id ) . '</a>';
				$comments = $this->get_post_comments( $post_id );
				$author = $this->get_post_author( $post_id );
				$terms_line = $this->get_terms_line( $post_id, $this->instance['terms_type'] );

				$full_view_dir = locate_template( 'inc/widgets/news-smart-box/views/tm-news-smart-box-full-view.php' );
				$mini_view_dir = locate_template( 'inc/widgets/news-smart-box/views/tm-news-smart-box-mini-view.php' );
				$view_type = $full_view_dir;

				$grid_class_line = 'col-xs-12 col-sm-6 col-md-6';
				$type_class = 'full-type';
				$order_class = 'post-item-' . $post_counter;

				switch ( $this->instance['layout_type'] ) {
					case 'layout_type_1':
						if ( 1 <= $post_counter ) {
							$view_type = $mini_view_dir;
							$type_class = 'mini-type';
						}
						break;
					case 'layout_type_2':
						if ( 1 < $post_counter  ) {
							$view_type = $mini_view_dir;
							$type_class = 'mini-type';
						}
						break;
					case 'layout_type_3':
						if ( 1 <= $post_counter ) {
							$view_type = $mini_view_dir;
							$type_class = 'mini-type';
							$grid_class_line = 'col-xs-12 col-sm-6 col-md-6';
						}else{
							$grid_class_line = 'col-xs-12 col-sm-12 col-md-12';
						}
						break;
				}

				echo '<article class="post ' . $grid_class_line . ' ' . $type_class . ' ' . $order_class . '">';
					if ( $view_type ) {
						require( $view_type );
					}
				echo '</article>';

			$post_counter++;
			endwhile;
		} else {
			echo '<h4>' . esc_html__( 'Posts not found', 'gadnews' ) . '</h4>';
		}
		// Reset the query.
		wp_reset_postdata();
	}

	/**
	 * Get navigation box
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function get_navigation_box( $current_term_slug, $alt_terms_slug_list = array() ) {
		$current_term_name = $this->get_term_name_by_slug( $current_term_slug );

		$html = '<div class="news-smart-box__navigation">';
			$html .= '<div class="current-term">';
				$html .= '<span>' . $current_term_name . '</span>';
				$html .= '<div class="nsb-spinner"><div class="double-bounce-1"></div><div class="double-bounce-2"></div></div>';

			$html .= '</div>';
			if ( ! empty( $alt_terms_slug_list ) ) {
				$html .= '<div class="terms-list">';
					$html .= '<div class="terms-container">';
						foreach ( $alt_terms_slug_list as $key => $term_slug ) {
							$html .= '<div class="term-item" data-slug=' . $term_slug . '><span>' . $this->get_term_name_by_slug( $term_slug ) . '</span></div>';
						}
					$html .= '</div>';
				$html .= '</div>';
			}
		$html .= '<div class="clear"></div>';
		$html .= '</div>';

		return $html;
	}

	/**
	 * Ajax get instance
	 *
	 * @since 4.0.0
	 */
	public function new_smart_box_instance(){
		if ( ! empty( $_GET ) && array_key_exists( 'value_slug', $_GET ) && array_key_exists( 'instance_settings', $_GET ) ) {
			$value_slug = $_GET['value_slug'];
			$instance_settings = $_GET['instance_settings'];

			$this->instance = $instance_settings;

			$this->get_new_instance( $value_slug );

			exit();
		}
	}

	/**
	 * Get post attached image.
	 *
	 * @since  1.0.0
	 * @param  int $id post id.
	 * @param  array, string
	 * @return string(HTML-formatted).
	 */
	public function get_image( $id, $size, $placeholder_attr, $only_url = false ) {

		// Place holder defaults attr
		$default_placeholder_attr = apply_filters( 'gadnews_news_smart_box_placeholder_default_args',
			array(
				'width'			=> 900,
				'height'		=> 500,
				'background'	=> '000',
				'foreground'	=> 'fff',
				'title'			=> '',
				'class'			=> '',
			)
		);
		$placeholder_attr = wp_parse_args( $placeholder_attr, $default_placeholder_attr );
		$image = '';

		// Check the attached image, if not attached - function replaces on the placeholder
		if ( has_post_thumbnail( $id ) ) {
			$thumbnail_id = get_post_thumbnail_id( intval( $id ) );
			$attachment_image = wp_get_attachment_image_src( $thumbnail_id, $size );

			if( $only_url ){
				return $attachment_image[0];
			}

			$image_html_attrs = 'class="smart-box-image"';
			$image_html_attrs .= ' src="' . $attachment_image[0] . '"';
			$image = sprintf( '<img %s alt="">', $image_html_attrs );
		}else{
			$placeholder_link = 'http://fakeimg.pl/' . $placeholder_attr['width'] . 'x' . $placeholder_attr['height'] . '/'. $placeholder_attr['background'] .'/'. $placeholder_attr['foreground'] . '/?text=' . $placeholder_attr['title'] . '';
			$image = '<img class="smart-box-image ' . $placeholder_attr['class'] . '" src="' . $placeholder_link . '" alt="' . $placeholder_attr['title'] . '">';
		}
		return $image;
	}

	/**
	 * Get trimmed content
	 *
	 * @since 1.0.0
	 * @param  string  $content        Post content
	 * @param  integer $excerpt_length Post content excerptlength
	 * @return string
	 */
	public function get_trimed_content( $content = '', $excerpt_length = 55 ) {
		$trimed_content = strip_shortcodes( $content );
		$trimed_content = apply_filters( 'the_content', $trimed_content );
		$trimed_content = str_replace(']]>', ']]&gt;', $trimed_content );
		$trimed_content = wp_trim_words( $trimed_content, $excerpt_length );

		return $trimed_content;
	}

	/**
	 * Get post comments count and link
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function get_post_comments( $post_id ) {
		$post_type = get_post_type( $post_id );

		if ( post_type_supports( $post_type, 'comments' ) ) {
			$comments = ( comments_open() || get_comments_number() ) ? get_comments_number() : '';
		}

		$title_comments =  sprintf( _n( '1', '%s', $comments, 'gadnews' ), $comments );
		$comments = ( ! empty( $comments ) ) ? sprintf( '<span class="post-comments-link"><a href="%1$s">%2$s</a></span>', esc_url( get_comments_link() ), $title_comments ) : esc_html__( '0', 'gadnews' );

		return $comments;
	}

	/**
	 * Get post author
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function get_post_author( $post_id ) {

		return sprintf( '<a href="%1$s" rel="author">%2$s</a>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() );
	}

	/**
	 * Get post date
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function get_post_date( $post_id ) {
		/**
		 * Filter for post date format string
		 *
		 * @var string
		 */
		$date_format = apply_filters( 'gadnews_carousel_post_dateformat', 'M d, Y' );

		return sprintf( '<time class="post-date" datetime="%1$s">%2$s</time>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date( $date_format ) ) );
	}

	/**
	 * Get blog user list array
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public function get_terms_list( $tax = 'category', $key = 'slug' ) {
		$all_terms = ( array ) get_terms( $tax, array( 'hide_empty' => false ) );
		foreach ( $all_terms as $term ) {
			$terms[ $term->$key ] = $term->name;
		}

		return $terms;
	}

	/**
	 * Get term's name by slug value
	 *
	 * @param  string $slug Slug value
	 * @return string|bool
	 */
	public function get_term_name_by_slug( $slug ) {
		$all_terms = (array) get_terms( array( 'post_tag', 'category' ), array( 'hide_empty' => false ) );

		foreach ( $all_terms as $key => $term_info ) {
			if ( $term_info->slug == $slug ) {
				return $term_info->name;
			}
		}

		return false;
	}

	/**
	 * Get terms line
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public function get_terms_line( $post_id, $tax = 'category' ) {
		$terms_line = '';
		$post_taxonomy = ! is_wp_error( get_the_terms( $post_id, $tax ) ) ? get_the_terms( $post_id, $tax ) : array();

		if ( $post_taxonomy ) {
				foreach ( $post_taxonomy as $taxonomy => $taxonomy_value ) {
					$terms_line .= '<a href="' . get_term_link( $taxonomy_value->term_id, $tax ) . '">' . $taxonomy_value->name . '</a>';
				}
			return $terms_line;
		}else{
			return false;
		}
	}
}

add_action( 'widgets_init', 'tm_register_news_smart_box_widgets' );
function tm_register_news_smart_box_widgets() {
	register_widget( 'GADNEWS_News_Smart_Box_Widget' );
}