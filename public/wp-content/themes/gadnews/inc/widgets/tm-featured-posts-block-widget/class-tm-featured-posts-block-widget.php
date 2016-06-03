<?php
/**
 * @package    gadnews
 * @subpackage Widget Class
 * @author     Cherry Team <cherryframework@gmail.com>
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gadnews_Featured_Posts_Block_Widget' ) ) {

	/**
	 * Featured Posts Block Widget
	 */
	class Gadnews_Featured_Posts_Block_Widget extends Cherry_Abstract_Widget {

		/**
		 * Images sizes configuration
		 *
		 * @var array
		 */
		public $image_sizes = array(
				'large'             => '_tm-thumb-880-610',
				'large_2x'          => 'large',
				'small'             => '_tm-thumb-605-305',
				'small_2x'          => 'large',
				'small_2x_vertical' => '_tm-thumb-495-610',
		);

		/**
		 * Default layout
		 *
		 * @var string
		 */
		private $_default_layout = 'layout-1';

		/**
		 * Excerpt length
		 *
		 * @var int
		 */
		private $_excerpt_length = 55;

		/**
		 * Get excerpt length
		 *
		 * @return int
		 */
		public function get_excerpt_length() {
			return $this->_excerpt_length;
		}

		/**
		 * Featured Posts Block widget constructor.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			$this->widget_name        = esc_html__( 'Featured Posts Block', 'gadnews' );
			$this->widget_description = esc_html__( 'This widget displays latest posts', 'gadnews' );
			$this->widget_id          = 'widget-featured-posts-block';
			$this->widget_cssclass    = 'widget-featured-posts-block';

			$layouts = $this->get_layouts();
			$layout_options = array();

			foreach( $layouts as $layout_id => $layout_label ) {
				$layout_options[ $layout_id ] = array(
					'label' => $layout_label,
					'img_src' => GADNEWS_THEME_URI . '/assets/images/admin/widgets/featured-posts-block/featured-posts-block-' . $layout_id . '.svg'
				);
			}

			$this->settings = array(
				'layout'         => array(
					'type'             => 'radio',
					'value'            => $this->_default_layout,
					'label'            => esc_html__( 'Layout', 'gadnews' ),
					'options'          => $layout_options
				),
				'posts_ids' => array(
					'type'      => 'text',
					'value'     => '',
					'label'     => esc_html__( 'Posts IDs (Optional)', 'gadnews' ),
				),
				'checkboxes'     => array(
					'type'    => 'checkbox',
					'value'   => array(
						'title'          => 'false',
						'excerpt'        => 'false',
						'categories'     => 'false',
						'tags'           => 'false',
						'author'         => 'false',
						'date'           => 'false',
						'comments_count' => 'false',
					),
					'options' => array(
						'title'          => esc_html__( 'Show post title', 'gadnews' ),
						'excerpt'        => esc_html__( 'Show post excerpt', 'gadnews' ),
						'categories'     => esc_html__( 'Show post categories', 'gadnews' ),
						'tags'           => esc_html__( 'Show post tags', 'gadnews' ),
						'author'         => esc_html__( 'Show post author', 'gadnews' ),
						'date'           => esc_html__( 'Show post date', 'gadnews' ),
						'comments_count' => esc_html__( 'Show post comments count', 'gadnews' ),
					),
				),
				'excerpt_length' => array(
					'type'      => 'stepper',
					'value'     => 55,
					'min_value' => 1,
					'label'     => esc_html__( 'Excerpt length', 'gadnews' ),
				),
			);

			parent::__construct();
		}

		/**
		 * Get posts list array
		 *
		 * @since  1.0.0
		 *
		 * @param string [$key] default = 'ID', key values.
		 *
		 * @return array
		 */
		public function get_posts_list( $key = 'ID' ) {
			$result = array();
			$posts  = get_posts();

			foreach( $posts as $post ) {
				if ( property_exists( $post, $key ) ) {
					$result[ $post->$key ] = get_the_title( $post );
				}
			}

			return $result;
		}

		/**
		 * widget function.
		 *
		 * @see   WP_Widget
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Arguments.
		 * @param array $instance Instance.
		 */
		public function widget( $args, $instance ) {
			if ( true === $this->get_cached_widget( $args ) ) {
				return;
			}

			$layout = $this->_default_layout;
			if ( $this->_validate_layout( $this->instance['layout'] ) ) {
				$layout = $this->instance['layout'];
			}

			ob_start();

			$this->setup_widget_data( $args, $instance );
			$this->widget_start( $args, $instance );

			$this->_excerpt_length = $instance['excerpt_length'];
			add_filter( 'excerpt_length', array( &$this, 'get_excerpt_length' ) );

			$template = locate_template( 'inc/widgets/tm-featured-posts-block-widget/views/widget.php' );

			if ( ! empty( $template ) ) {
				include $template;
			}

			$this->widget_end( $args );
			$this->reset_widget_data();
			wp_reset_postdata();

			echo $this->cache_widget( $args, ob_get_clean() );
		}

		/**
		 * Prepare args before processing loop
		 *
		 * @since 1.0.0
		 *
		 * @param string $layout Layout name.
		 *
		 * @return array
		 */
		private function _prepare_args( $layout ) {
			$posts_limit = 5;
			$special_class = 'large';
			$image_size = $this->image_sizes['large'];
			switch ( $layout ) {
				case 'layout-5' :
					$posts_limit = 3;
					$special_class = 'large-2x';
					$image_size = $this->image_sizes['large_2x'];
					break;
				case 'layout-3' :
				case 'layout-4' :
					$posts_limit = 4;
					break;
				case 'layout-1' :
					$special_class = 'small';
					$image_size = $this->image_sizes['small'];
					break;
			}

			return array(
				'posts_limit'   => $posts_limit,
				'special_class' => $special_class,
				'image_size'    => $image_size,
			);
		}

		/**
		 * Render layout
		 * @param array $options
		 * @return string|boolean
		 */
		public function render_layout( $options = array() ) {
			$defaults = array(
				'layout'    => $this->_default_layout,
				'posts_ids' => '',
				'wrapper'   => '<div class="%1$s">%2$s</div>',
			);

			$settings = array();

			foreach( $defaults as $key => $defaultValue ) {
				$value = $defaultValue;

				if ( isset( $options[ $key ] ) ) {
					$value = $options[ $key ];
				}

				$settings[ $key ] = $value;
			}

			$template = locate_template( 'inc/widgets/tm-featured-posts-block-widget/views/loop.php' );

			if ( ! $template || empty( $template ) ) {
				return false;
			}

			global $post;

			$args          = $this->_prepare_args( $settings['layout'] );
			$posts_limit   = $args['posts_limit'];
			$special_class = $args['special_class'];
			$image_size    = $args['image_size'];
			$ids           = null;
			$query         = array(
				'showposts'      => $posts_limit,
				'orderby'        => 'date',
				'order'          => 'DESC',
			);

			if ( isset( $this->instance['posts_ids'] ) &&
					 ! empty( $this->instance['posts_ids'] ) ) {
		  	$query['include'] = $this->instance['posts_ids'];
				$ids = explode( ",", $this->instance['posts_ids'] );
			}

			// Retrieve posts
			$posts      = get_posts( $query );
			$item_count = 1;

			ob_start();

			if ( sizeof( $posts ) > 0 ) {
				$values = $posts;
				if ( null !== $ids ) {
					$values  = $ids;
				}
				foreach( $values as $post ) {

					if ( null !== $ids ) {
						$post = $this->_find_post( $posts, $post );
					}

					if ( null !== $post ) {
						setup_postdata( $post );
						include $template;

						switch( $settings['layout'] ) {
							case 'layout-5' :
								$item_count = $item_count + 1;
								$special_class = 'small';
								$image_size = $this->image_sizes['small'];
								break;
							case 'layout-4' :
								$item_count = $item_count + 1;
								if ( 2 === $item_count ) {
									$special_class = 'small-2x-vertical';
									$image_size    = $this->image_sizes['small_2x_vertical'];
								} else {
									$special_class = 'small';
									$image_size    = $this->image_sizes['small'];
								}
								break;
							case 'layout-3' :
								$item_count = $item_count + 1;
								if ( 2 === $item_count ) {
									$special_class = 'small-2x';
									$image_size    = $this->image_sizes['small_2x'];
								} else {
									$special_class = 'small';
									$image_size    = $this->image_sizes['small'];
								}
								break;
							case 'layout-2' :
								if ( 0 < $item_count ) {
									$special_class = 'small';
									$image_size    = $this->image_sizes['small'];
								}
								$item_count = $item_count + 1;
								break;
							case 'layout-1' :
								$item_count = $item_count + 1;
								if ( 3 === $item_count ) {
									$special_class = 'large';
									$image_size    = $this->image_sizes['large'];
								} else {
									$special_class = 'small';
									$image_size    = $this->image_sizes['small'];
								}
								break;
							default :
								if ( 0 < $item_count ) {
									$special_class = 'small';
									$image_size = $this->image_sizes['small'];
								}
								$item_count = $item_count + 1;
								break;
						}
					}
				}
			}

			wp_reset_postdata();
			$loop_contents = ob_get_clean();

			if ( 0 < sizeof( $posts ) ) {
				return sprintf(
					$settings['wrapper'],
					$settings['layout'],
					$loop_contents
				);
			}

			return false;
		}

		/**
		 * Check if given layout exists and is valid
		 *
		 * @param string $layout Layout option value.
		 *
		 * @return bool
		 */
		private function _validate_layout( $layout ) {
			if ( ! empty( $layout ) ) {
				$layouts = $this->get_layouts();
				$keys    = array_keys( $layouts );

				return in_array( $layout, $keys );
			}

			return false;
		}

		/**
		 * Get available layouts
		 *
		 * @since 1.0.0
		 * @return array
		 */
		public function get_layouts() {
			return array(
				'layout-1' => esc_html__( 'Layout #1', 'gadnews' ),
				'layout-2' => esc_html__( 'Layout #2', 'gadnews' ),
				'layout-3' => esc_html__( 'Layout #3', 'gadnews' ),
				'layout-4' => esc_html__( 'Layout #4', 'gadnews' ),
				'layout-5' => esc_html__( 'Layout #5', 'gadnews' ),
			);
		}

		/**
		 * Get post featured image
		 *
		 * @since 1.0.0
		 *
		 * @param  array  $args Array, containing size and format options.
		 *
		 * @return string
		 */
		public function post_featured_image( array $args = array() ) {
			$size   = $this->image_sizes['small'];
			$format = '<div style="background-image: url(\'%1$s\');"><img src="%2$s"></div>';

			if ( true === isset( $args['size'] ) &&
					 false === empty( $args['size'] ) ) {
				$size = $args['size'];
		  }

			if ( true === isset( $args['format'] ) &&
					 false === empty( $args['format'] ) ) {
				$format = $args['format'];
			}

			if ( has_post_thumbnail() ) {
				$image_url = get_the_post_thumbnail_url( null, $size );
			} else {
				$width = get_option( "{$size}_size_w" );
				$height = get_option( "{$size}_size_h" );
				$image_url = "http://fakeimg.pl/{$width}x{$height}";
			}

			$image_url = esc_url( $image_url );

			return sprintf( $format, $image_url, $image_url );
		}

		/**
		 * Get post categories
		 *
		 * @since 1.0.0
		 *
		 * @param array $args           Array, containing before, after, format & separator strings.
		 *                              Example:
		 *                              `array(
		 *                              'before' => '<div>',
		 *                              'after' => '</div>',
		 *                              'format' => '<a href="%1$s">%2$s</a>',
		 *                              'separator' => ','
		 *                              )`.
		 *
		 * @return string
		 */
		public function post_categories( array $args = array() ) {
			global $post;
			$result = array();

			$before    = '<div>';
			$after     = '</div>';
			$format    = '<a href="%1$s">%2$s</a>';
			$separator = ' ';

			if ( true === isset( $args['before'] ) &&
				false === empty( $args['before'] )
			) {
				$before = $args['before'];
			}

			if ( true === isset( $args['after'] ) &&
				false === empty( $args['after'] )
			) {
				$after = $args['after'];
			}

			if ( true === isset( $args['format'] ) &&
				false === empty( $args['format'] )
			) {
				$format = $args['format'];
			}

			if ( true === isset( $args['separator'] ) &&
				false === empty( $args['separator'] )
			) {
				$separator = $args['separator'];
			}

			$post_categories = get_the_category( $post->ID );
			if ( 0 < sizeof( $post_categories ) ) {
				array_push( $result, $before );

				foreach ( $post_categories as $category ) {
					array_push( $result, sprintf( $format, esc_attr( get_category_link( $category ) ), esc_html( $category->name ) ) );
				}

				array_push( $result, $after );
			}

			return trim( join( $separator, $result ) );
		}

		/**
		 * Get post comments count
		 *
		 * @since 1.0.0
		 *
		 * @param array $args Array, containing before, after, has_comments and no_comments strings.
		 *
		 * @return string
		 */
		public function post_comments_count( array $args ) {
			global $post;

			$before       = '<div>';
			$after        = '</div>';
			$has_comments = '<a href="%1$s">%2$s</a>';
			$no_comments  = '<span>%2$s</span>';

			if ( true === isset( $args['before'] ) &&
				false === empty( $args['before'] )
			) {
				$before = $args['before'];
			}

			if ( true === isset( $args['after'] ) &&
				false === empty( $args['after'] )
			) {
				$after = $args['after'];
			}

			if ( true === isset( $args['has_comments'] ) &&
				false === empty( $args['has_comments'] )
			) {
				$has_comments = $args['has_comments'];
			}

			if ( true === isset( $args['no_comments'] ) &&
				false === empty( $args['no_comments'] )
			) {
				$no_comments = $args['no_comments'];
			}

			if ( false === comments_open( $post->ID ) ) {
				return '';
			}

			$comments_count = get_comments_number( $post->ID );

			if ( 0 < $comments_count ) {
				$format = $has_comments;
			} else {
				$format = $no_comments;
			}

			return sprintf(
				'%s%s%s',
				$before,
				sprintf( $format, get_comments_link( $post->ID ), esc_html( $comments_count ) ),
				$after
			);
		}

		/**
		 * Get post author
		 *
		 * @since 1.0.0
		 *
		 * @param array $args Array, containing before, after, has_url & no_url strings.
		 *
		 * @return string
		 */
		public function post_author( array $args = array() ) {
			global $post;

			$before  = '<div>';
			$after   = '</div>';
			$format = '<a href="%1$s">%2$s</a>';

			if ( true === isset( $args['before'] ) &&
				false === empty( $args['before'] )
			) {
				$before = $args['before'];
			}

			if ( true === isset( $args['after'] ) &&
				false === empty( $args['after'] )
			) {
				$after = $args['after'];
			}

			if ( true === isset( $args['format'] ) &&
				false === empty( $args['format'] )
			) {
				$format = $args['format'];
			}

			$author_url  = get_author_posts_url( $post->post_author );
			$author_name = get_the_author_meta( 'display_name', $post->post_author );

			return sprintf(
				'%s%s%s',
				$before,
				sprintf( $format, $author_url, $author_name ),
				$after
			);
		}

		/**
		 * Get post date
		 *
		 * @since 1.0.0
		 *
		 * @param array $args                 Array, containing before, after and format or for_human option enabled.
		 *                                    Example:
		 *                                    array(
		 *                                    'for_human' => true, // Will overwrite `format` if it's `true`
		 *                                    'format' => 'H:i:s',
		 *                                    'before' => '<a class="tm_fpblock__item__date">',
		 *                                    'after' => '</a>'
		 *                                    ).
		 *
		 * @return string
		 */
		public function post_date( array $args = array() ) {
			global $post;

			$format      = '<a href="%1$s">%2$s</a>';
			$date_format = get_option( 'date_format' );
			$for_human   = false;

			if ( true === isset( $args['before'] ) &&
				false === empty( $args['before'] )
			) {
				$before = $args['before'];
			}

			if ( true === isset( $args['after'] ) &&
				false === empty( $args['after'] )
			) {
				$after = $args['after'];
			}

			if ( true === isset( $args['format'] ) &&
				false === empty( $args['format'] )
			) {
				$format = $args['format'];
			}

			if ( true === isset( $args['date_format'] ) &&
				false === empty( $args['date_format'] )
			) {
				$date_format = $args['date_format'];
			}

			if ( true === isset( $args['for_human'] ) ) {
				$for_human = !( !$args['for_human'] );
			}

			if ( true === $for_human ) {
				$date = sprintf(
					_x( '%s ago', '%s ago - date when post was written', 'wi-injector' ),
					human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) )
				);
			} else {
				$date = get_the_date( $date_format );
				if ( empty( $date ) ) {
					$date = get_the_modified_date( $date_format );
				}
			}

			return sprintf( $format, esc_url( get_the_permalink() ), $date );
		}

		/**
		 * Get post tags
		 *
		 * @since 1.0.0
		 *
		 * @param array $args           Array, containing before, after, format & separator strings.
		 *                              Example:
		 *                              `array(
		 *                              'before' => '<div>',
		 *                              'after' => '</div>',
		 *                              'format' => '<a href="%1$s">%2$s</a>',
		 *                              'separator' => ','
		 *                              )`.
		 *
		 * @return string
		 */
		public function post_tags( array $args = array() ) {
			global $post;

			$result = array();

			$before    = '<div>';
			$after     = '</div>';
			$format    = '<a href="%1$s">%2$s</a>';
			$separator = ', ';

			if ( true === isset( $args['before'] ) &&
				false === empty( $args['before'] )
			) {
				$before = $args['before'];
			}

			if ( true === isset( $args['after'] ) &&
				false === empty( $args['after'] )
			) {
				$after = $args['after'];
			}

			if ( true === isset( $args['format'] ) &&
				false === empty( $args['format'] )
			) {
				$format = $args['format'];
			}

			if ( true === isset( $args['separator'] ) &&
				false === empty( $args['separator'] )
			) {
				$separator = $args['separator'];
			}

			$post_tags = get_the_tags( $post->ID );
			$i = 0;
			$item = '';

			if ( is_array( $post_tags ) && 0 < sizeof( $post_tags ) ) {
				array_push( $result, $before );

				foreach ( $post_tags as $tag ) {
					$tag = get_tag( $tag );
					$item = sprintf( $format, esc_attr( get_tag_link( $tag ) ), esc_html( $tag->name ) );

					if ( $i < sizeof( $post_tags ) - 1 ) {
						 $item = $item . $separator;
					}

					array_push( $result, $item );
					$i = $i + 1;
				}

				array_push( $result, $after );
			}

			return join( '', $result );
		}

		/**
		 * Find post in the posts array by it's ID
		 * @param  array          $posts  Posts array.
		 * @param  integer|string $postID Post ID.
		 * @return WP_Post|null
		 */
		private function _find_post( $posts, $postID ) {
			foreach( $posts as $post ) {
				if ( $post->ID == $postID ) {
					return $post;
				}
			}
			return null;
		}
	}

	add_action( 'widgets_init', 'gadnews_register_featured_posts_block_widget' );

	if ( false === function_exists( 'gadnews_register_featured_posts_block_widget' ) ) {
		function gadnews_register_featured_posts_block_widget() {
			register_widget( 'Gadnews_Featured_Posts_Block_Widget' );
		}
	}
}
