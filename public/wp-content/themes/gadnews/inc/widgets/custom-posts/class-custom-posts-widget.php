<?php
class Gadnews_Custom_Posts_Widget extends Cherry_Abstract_Widget {

	/**
	 * Constructor
	 *
	 * @since  1.0.0
	 */
	public function __construct() {
		$this->widget_name = esc_html__( 'Custom Posts', 'gadnews' );
		$this->widget_description = esc_html__( 'Display custom posts your site.', 'gadnews' );
		$this->widget_id = apply_filters( 'gadnews_custom_posts_widget_ID', 'widget-custom-postson' );
		$this->widget_cssclass = apply_filters( 'gadnews_custom_posts_widget_cssclass', 'widget-custom-postson' );

		$this->settings = array(
			'title' => array(
				'type'				=> 'text',
				'value'				=> esc_html__( 'Custom Posts', 'gadnews' ),
				'label'				=> esc_html__( 'Title', 'gadnews' ),
			),
			'terms_type' => array(
				'type'				=> 'radio',
				'value'				=> 'category_name',
				'options'			=> array(
					'category_name' => array(
						'label'		=> esc_html__( 'Category', 'gadnews' ),
						'slave'	=> 'terms_type_post_category',
					),
					'tag'		=> array(
						'label'		=> esc_html__( 'Tag', 'gadnews' ),
						'slave'	=> 'terms_type_post_tag',
					),
					'post_format'		=> array(
						'label'		=> esc_html__( 'Post Format', 'gadnews' ),
						'slave'	=> 'terms_type_post_format',
					),
				),
				'label'				=> esc_html__( 'Choose taxonomy type', 'gadnews' ),
			),
			'category_name' => array(
				'type'				=> 'select',
				'size'				=> 1,
				'value'				=> '',
				'options_callback'	=> array( $this, 'get_terms_list', array( 'category', 'slug' ) ),
				'options'			=> false,
				'label'				=> esc_html__( 'Select category', 'gadnews' ),
				'multiple'			=> true,
				'placeholder'		=> esc_html__( 'Select category', 'gadnews' ),
				'master'			=> 'terms_type_post_category',
			),
			'tag' => array(
				'type'				=> 'select',
				'size'				=> 1,
				'value'				=> '',
				'options_callback'	=> array( $this, 'get_terms_list', array( 'post_tag', 'slug' ) ),
				'options'			=> false,
				'label'				=> esc_html__( 'Select tags', 'gadnews' ),
				'multiple'			=> true,
				'placeholder'		=> esc_html__( 'Select tags', 'gadnews' ),
				'master'			=> 'terms_type_post_tag',
			),
			'post_format' => array(
				'type'				=> 'select',
				'size'				=> 1,
				'value'				=> '',
				'options_callback'	=> array( $this, 'get_terms_list', array( 'post_format', 'slug' ) ),
				'options'			=> false,
				'label'				=> esc_html__( 'Select post format', 'gadnews' ),
				'multiple'			=> true,
				'placeholder'		=> esc_html__( 'Select post format', 'gadnews' ),
				'master'			=> 'terms_type_post_format',
			),
			'posts_per_page' => array(
				'type'				=> 'stepper',
				'value'				=> 10,
				'max_value'			=> 50,
				'min_value'			=> 0,
				'label'				=> esc_html__( 'Posts count ( Set 0 to show all. )', 'gadnews' ),
			),
			'post_offset' => array(
				'type'				=> 'stepper',
				'value'				=> '0',
				'max_value'			=> '10000',
				'min_value'			=> '0',
				'step_value'		=> '1',
				'label'				=> esc_html__( 'Offset post', 'gadnews' ),
			),
			'title_length' => array(
				'type'				=> 'stepper',
				'value'				=> '10',
				'max_value'			=> '500',
				'min_value'			=> '0',
				'step_value'		=> '1',
				'label'				=> esc_html__( 'Title words length ( Set 0 to hide title. )', 'gadnews' ),
			),
			'excerpt_length' => array(
				'type'				=> 'stepper',
				'value'				=> '10',
				'max_value'			=> '500',
				'min_value'			=> '0',
				'step_value'		=> '1',
				'label'				=> esc_html__( 'Excerpt words length ( Set 0 to hide excerpt. )', 'gadnews' ),
			),
			'mate_data' => array(
				'type'				=> 'checkbox',
				'value'				=> array(
					'date'				=> 'true',
					'author'			=> 'false',
					'comment_count'		=> 'false',
					'category'			=> 'false',
					'tag'				=> 'false',
					'more_button'				=> 'false',
				),
				'options'				=> array(
					'date'				=> esc_html__( 'Date', 'gadnews' ),
					'author'			=> esc_html__( 'Author', 'gadnews' ),
					'comment_count'		=> esc_html__( 'Comment count', 'gadnews' ),
					'category'			=> esc_html__( 'Category', 'gadnews' ),
					'post_tag'			=> esc_html__( 'Tag', 'gadnews' ),
					'more_button'		=> esc_html__( 'More Button', 'gadnews' ),
				),
				'label'				=> esc_html__( 'Display post meta data', 'gadnews' ),
			),
			'button_text' => array(
				'type'				=> 'text',
				'value'				=> 'Read More',
				'label'				=> esc_html__( 'Post read more button label', 'gadnews' ),
			),
		);

		parent::__construct();
	}

	/**
	 * Get blog user list array
	 *
	 * @since  1.0.0
	 * @param string $tax - category, post_tag, post_format
	 * @param string $key - slug, term_id
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
	 * Cut text
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function cut_text( $text, $length ) {
		return ( '0' !== $length ) ? wp_trim_words( $text, $length, esc_html__( ' ...', 'gadnews' ) ) : '' ;
	}

	/**
	 * Get post excerpt
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_excerpt( $post_value, $length ) {
		$excerpt = $post_value->post_excerpt;

		return ( '0' !== $length && $excerpt ) ? '<p>' . $this->cut_text( $post_value->post_excerpt, $length ) . '</p>' : '' ;
	}

	/**
	 * Get post title
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_title( $post_value, $length ) {
		if ( '0' !== $length ) {
			$permalink = $this -> get_post_permalink();
			$title = $post_value->post_title;

			return '<h5 class="widget-title"><a href="' . $permalink . '" title="' . $title . '">' . $this->cut_text( $title, $length ) . '</a></h5>';
		} else {
			return '';
		}
	}


	/**
	 * Get post date
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_post_date( $visible = 'true' ) {
		if ( $visible === 'true') {
			$post_format = get_option( 'date_format' );
			$time = get_the_time( $post_format );
			$date_icon = apply_filters( 'gadnews_custom_posts_date_icon', '<i class="material-icons">schedule</i>' );
			$permalink = $this->get_post_permalink();

			return '<div class="post__date"><a href="' . $permalink . '"><time class="entry-date published" datetime="' . get_the_time( 'Y-m-d\TH:i:sP' ) . '">' . $date_icon . $time . '</time></a></div>';
		} else {
			return '';
		}
	}

	/**
	 * Get post permalink
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_post_permalink() {
		return esc_url( get_the_permalink() );
	}

	/**
	 * Get post author
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_the_author( $user_id, $visible = 'true' ) {
		if ( $visible === 'true' ) {
			$author = get_the_author();
			$html= '<div class="post-author">' . esc_html__( 'by ', 'gadnews' ) . $author . '</div>';

			return $html;
		} else {
			return '';
		}
	}

	/**
	 * Get comment count
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_comment_count( $count , $visible = 'true' ) {
		return ( $visible === 'true' ) ? '<div class="post_comments"><i class="fa fa-comment-o"></i>' . $count . '</div>' : '' ;
	}

	/**
	 * Get post terms
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_post_terms( $post, $term_type = 'category' , $visible = 'true' ) {
		if ( $visible === 'true' ) {
			$terms = get_the_terms($post, $term_type);
			$html = '';

			foreach ( $terms as $term ) {
				$href = get_term_link( $term->term_id , $term_type );
				$html .= '<a href="' . $href . '" class="post_term ' . $term_type . ' ' . $term->slug . '">' . $term->name . '</a>';
			}

			return '<div class="' . $term_type . '">' . $html . '</div>';
		} else {
			return '';
		}
	}

	/**
	 * Get image size
	 *
	 * @since  1.0.0
	 * @return array
	 */
	private function get_image_size( $wp_image_size ) {
		global $_wp_additional_image_sizes;

		return $_wp_additional_image_sizes[ $wp_image_size ];
	}

	/**
	 * Get post image
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_post_image( $post, $image_size = '_tm-thumb-m', $image_mobile_size = '_tm-thumb-s' ) {
		$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
		$size= wp_is_mobile() ? $image_mobile_size : $image_size ;

		if( $post_thumbnail_id ){
			$attr = array(
				'class' => 'wp-post-image',
				'alt' => $post->post_title,
			);
			$html = wp_get_attachment_image( $post_thumbnail_id, $size , false, $attr );
		}else{
			$size= $this->get_image_size( $size );

			// Place holder defaults attr
			$placeholder_attr = apply_filters( 'gadnews_custom_posts_placeholder_default_args',
				array(
					'width'			=> $size['width'],
					'height'		=> $size['height'],
					'background'	=> get_theme_mod( 'regular_accent_color_1', gadnews_theme()->customizer->get_default( 'regular_accent_color_1' ) ),
					'foreground'	=> get_theme_mod( 'regular_accent_color_2', gadnews_theme()->customizer->get_default( 'regular_accent_color_2' ) ),
					'title'			=> $size['width'] . 'x' . $size['height'],
				)
			);

			$image_src = 'http://fakeimg.pl/' . $placeholder_attr['width'] . 'x' . $placeholder_attr['height'] . '/'. $placeholder_attr['background'] .'/'. $placeholder_attr['foreground'] . '/?text=' . $placeholder_attr['title'] . '';
			$html = '<img class="wp-post-image" src="' . $image_src . '" alt="" title="' . $post->post_title . '">';
		}

		return $html;
	}

	/**
	 * Get post more button
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_button( $text = '', $visible = 'true' ){
		if ( $visible === 'true' ) {
			$permalink = $this->get_post_permalink();
			$icon = apply_filters( 'gadnews_custom_posts_read_more_icon', '' ); //<span class="btn__icon"></span>
			$html = '<a class="btn" href="' . $permalink . '"><span class="btn__text">' . $text . '</span>' . $icon . '</a>';

			return $html;
		} else {
			return '';
		}
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @since  1.0.0
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

		extract( $instance, EXTR_OVERWRITE );

		if ( !isset( $instance[ $terms_type ] ) || !$instance[ $terms_type ] ) {
			return;
		}

		$posts_per_page  = ( '0' === $posts_per_page ) ? -1 : ( int ) $posts_per_page ;
		$post_args = array(
			'post_type'		=> 'post',
			'offset'		=> $post_offset,
			'numberposts'	=> $posts_per_page,
		);
		$post_args[ $terms_type ] = implode( ',', $instance[ $terms_type ] );
		$grid_class_array = array(
				'default'				=> 'col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-4',
				'before-content-area'	=> 'col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-4',
				'after-content-area'	=> 'col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-4',
				'sidebar-primary'		=> 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12',
				'sidebar-secondary'		=> 'col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12',
				'before-loop-area'		=> 'col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6',
				'after-loop-area'		=> 'col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6',
				'footer-area'			=> 'col-xs-6 col-sm-6 col-md-12 col-lg-12 col-xl-12',
			);
		$grid_class = isset( $grid_class_array[ $args['id'] ] ) ? $grid_class_array[ $args['id'] ] : $grid_class_array[ 'default' ] ;

		$posts = get_posts( $post_args );

		if ( $posts ) {
			global $post;

			$holder_view_dir = locate_template( 'inc/widgets/custom-posts/views/custom-post-view.php' );
			$image_size = apply_filters( 'gadnews_playlist_thumbnail_image_size', '_tm-thumb-m' );
			$image_mobile_size = apply_filters( 'gadnews_playlist_thumbnail_size_mobile', '_tm-thumb-s' );

			echo '<div class="custom-posts-holder row" >';

				if ( $holder_view_dir ) {
					foreach ( $posts as $post ) {
						setup_postdata( $post );

						$image = $this->get_post_image( $post, $image_size, $image_mobile_size );
						$permalink = $this->get_post_permalink();
						$title = $this->get_title( $post, $title_length );
						$excerpt = $this->get_excerpt( $post, $excerpt_length );
						$date = $this->get_post_date( $mate_data['date'] );
						$author = $this->get_the_author( $post->post_author, $mate_data['author'] );
						$button = $this->get_button( $button_text, $mate_data['more_button'] );

						$count = $this->get_comment_count( $post->comment_count, $mate_data['comment_count'] );
						$category = $this->get_post_terms( $post, 'category', $mate_data['category'] );
						$tag = $this->get_post_terms( $post, 'post_tag', $mate_data['post_tag'] );

						require( $holder_view_dir );
					}
				}

			echo '</div>';
		}

		$this->widget_end( $args );
		$this->reset_widget_data();
		wp_reset_postdata();

		echo $this->cache_widget( $args, ob_get_clean() );
	}
}

add_action( 'widgets_init', 'gadnews_register_custom_posts_widget' );
function gadnews_register_custom_posts_widget() {
	register_widget( 'Gadnews_Custom_Posts_Widget' );
}