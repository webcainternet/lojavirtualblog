<?php
class Gadnews_Playlist_Slider_Widget extends Cherry_Abstract_Widget {

	private $posts = null;

	public $instance = null;

	private $layout_settings = array();

	//private $slider_setting = null;

	/**
	 * Constructor
	 *
	 * @since  1.0.0
	 */
	public function __construct() {
		Cherry_Utility::utility_composition( $this );

		$this->widget_name = esc_html__( 'Playlist Slider', 'gadnews' );
		$this->widget_description = esc_html__( 'Display playlist slider on your site.', 'gadnews' );
		$this->widget_id = apply_filters( 'gadnews_playlist_slider_widget_ID', 'widget-playlist-slider' );
		$this->widget_cssclass = apply_filters( 'gadnews_playlist_slider_widget_cssclass', 'widget-playlist-slider' );

		$this->settings = array(
			'title' => array(
				'type'				=> 'text',
				'value'				=> esc_html__( 'Playlist Slider', 'gadnews' ),
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
				),
				'label'				=> esc_html__( 'Choose taxonomy type', 'gadnews' ),
			),
			'category_name' => array(
				'type'				=> 'select',
				'size'				=> 1,
				'value'				=> '',
				'options_callback'	=> array( $this->utility->satellite, 'get_terms_array', array( 'category', 'slug' ) ),
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
				'options_callback'	=> array( $this->utility->satellite, 'get_terms_array', array( 'post_tag', 'slug' ) ),
				'options'			=> false,
				'label'				=> esc_html__( 'Select tags', 'gadnews' ),
				'multiple'			=> true,
				'placeholder'		=> esc_html__( 'Select tags', 'gadnews' ),
				'master'			=> 'terms_type_post_tag',
			),
			'posts_per_page' => array(
				'type'				=> 'stepper',
				'value'				=> 10,
				'max_value'			=> 50,
				'min_value'			=> 0,
				'label'				=> esc_html__( 'Posts count ( Set 0 to show all. )', 'gadnews' ),
			),
			'width' => array(
				'type'  => 'text',
				'value' => '100%',
				'label' => esc_html__( 'Slider width ( px, %, rem )', 'gadnews' ),
			),
			'height' => array(
				'type' => 'text',
				'value' => '500',
				'label' => esc_html__( 'Slider height ( px, rem )', 'gadnews' ),
			),
			'thumbnail_controls' => array(
				'type'				=> 'select',
				'size'				=> 1,
				'value'				=> true,
				'options'			=> array(
					false		=> esc_html__( 'Hide', 'gadnews' ),
					true		=> esc_html__( 'Buttons', 'gadnews' ),
				),
				'label'				=> esc_html__( 'Select Thumbnail Controls', 'gadnews' ),
				'placeholder'		=> esc_html__( 'Select Thumbnail Controls', 'gadnews' ),
			),
			'slider_controls' => array(
				'type'				=> 'select',
				'size'				=> 1,
				'value'				=> true,
				'options'			=> array(
					false			=> esc_html__( 'Hide', 'gadnews' ),
					true			=> esc_html__( 'Buttons', 'gadnews' ),
				),
				'label'					=> esc_html__( 'Select Slider Controls', 'gadnews' ),
				'placeholder'					=> esc_html__( 'Select Thumbnail Controls', 'gadnews' ),
			),
			'title_length' => array(
				'type'				=> 'stepper',
				'value'				=> '10',
				'max_value'			=> '500',
				'min_value'			=> '0',
				'step_value'		=> '1',
				'label'				=> esc_html__( 'Title words length ( Set 0 to hide title. )', 'gadnews' ),
			),
			'mate_data' => array(
				'type'				=> 'checkbox',
				'value'				=> array(
					'date'				=> 'true',
					'author'			=> 'false',
					'category'			=> 'false',
					'tag'				=> 'false',
				),
				'options'				=> array(
					'date'				=> esc_html__( 'Date', 'gadnews' ),
					'author'			=> esc_html__( 'Author', 'gadnews' ),
					'category'			=> esc_html__( 'Category', 'gadnews' ),
					'post_tag'			=> esc_html__( 'Tag', 'gadnews' ),
				),
				'label'				=> esc_html__( 'Display post meta data', 'gadnews' ),
			),
		);

		parent::__construct();

		//default
		$widget_area_settings_0 = array(
			'thumbnailWidth'		=> 400,
			'thumbnailHeight'		=> 122,
			'thumbnailsPosition'	=>'right',
			'breakpoints'		=> array(
				'1200'				=> array(
					'thumbnailWidth'		=> 139,
					'thumbnailHeight'		=> 165,
					'thumbnailsPosition'	=>'bottom',
				),
				'992'				=> array(
					'thumbnailWidth'		=> 165,
					'thumbnailHeight'		=> 165,
					'thumbnailsPosition'	=>'bottom',
				),
				'768'				=> array(
					'thumbnailWidth'		=> 172,
					'thumbnailHeight'		=> 172,
					'thumbnailsPosition'	=>'bottom',
				),
				'544'				=> array(
					'thumbnailWidth'		=> 156,
					'thumbnailHeight'		=> 156,
					'thumbnailsPosition'	=>'bottom',
				),
			),
		);

		//sidebar-primary , sidebar-secondary
		$widget_area_settings_1 = array(
			'thumbnailWidth'		=> 105,
			'thumbnailHeight'		=> 105,
			'thumbnailsPosition'	=>'bottom',
			'breakpoints'		=> array(
				'1200'				=> array(
					'thumbnailWidth'		=> 149,
					'thumbnailHeight'		=> 149,
					'thumbnailsPosition'	=>'bottom',
				),
				'992'				=> array(
					'thumbnailWidth'		=> 130,
					'thumbnailHeight'		=> 130,
					'thumbnailsPosition'	=>'bottom',
				),
				'768'				=> array(
					'thumbnailWidth'		=> 172,
					'thumbnailHeight'		=> 172,
					'thumbnailsPosition'	=>'bottom',
				),
				'544'				=> array(
					'thumbnailWidth'		=> 156,
					'thumbnailHeight'		=> 156,
					'thumbnailsPosition'	=>'bottom',
				),
			),
		);
		//before-loop-area, after-loop-area
		$widget_area_settings_2 = array(
			'thumbnailWidth'		=> 400,
			'thumbnailHeight'		=> 122,
			'thumbnailsPosition'	=>'right',
			'breakpoints'		=> array(
				'1200'				=> array(
					'thumbnailWidth'		=> 125,
					'thumbnailHeight'		=> 125,
					'thumbnailsPosition'	=>'bottom',
				),
				'992'				=> array(
					'thumbnailWidth'		=> 153,
					'thumbnailHeight'		=> 153,
					'thumbnailsPosition'	=>'bottom',
				),
				'768'				=> array(
					'thumbnailWidth'		=> 172,
					'thumbnailHeight'		=> 172,
					'thumbnailsPosition'	=>'bottom',
				),
				'544'				=> array(
					'thumbnailWidth'		=> 156,
					'thumbnailHeight'		=> 156,
					'thumbnailsPosition'	=>'bottom',
				),
			),
		);
		//footer-area
		$widget_area_settings_3 = array(
			'thumbnailWidth'		=> 121,
			'thumbnailHeight'		=> 121,
			'thumbnailsPosition'	=>'bottom',
			'breakpoints'		=> array(
				'1200'				=> array(
					'thumbnailWidth'		=> 140,
					'thumbnailHeight'		=> 140,
					'thumbnailsPosition'	=>'bottom',
				),
				'992'				=> array(
					'thumbnailWidth'		=> 103,
					'thumbnailHeight'		=> 103,
					'thumbnailsPosition'	=>'bottom',
				),
				'768'				=> array(
					'thumbnailWidth'		=> 80,
					'thumbnailHeight'		=> 80,
					'thumbnailsPosition'	=>'bottom',
				),
				'544'				=> array(
					'thumbnailWidth'		=> 163,
					'thumbnailHeight'		=> 163,
					'thumbnailsPosition'	=>'bottom',
				),
			),
		);

		$this->layout_settings = apply_filters( 'gadnews_playlist_slider_size',
			array(
				'default'			=> $widget_area_settings_0,
				'sidebar-primary'	=> $widget_area_settings_1,
				'sidebar-secondary'	=> $widget_area_settings_1,
				'before-loop-area'	=> $widget_area_settings_2,
				'after-loop-area'	=> $widget_area_settings_2,
				'footer-area'		=> $widget_area_settings_3,
			)
		);

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ), 9 );
	}

	/**
	 * Echo thumbnail view
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function the_thumbnail_view() {
		$thumbnails_view_dir = locate_template( 'inc/widgets/playlist-slider/views/playlist-thumbnails-view.php' );

		if ( $thumbnails_view_dir ) {

			foreach ( $this->posts as $post ) {
				$title = $this->utility->attributes->get_title(
					array(
						'html'	=> '<h6 %1$s>%4$s</h6>',
					),
					'post',
					$post
				);
				$image = $this->utility->media->get_image(
					array(
						'class'			=> 'playlist-img',
						'html'			=> '<span style="background-image: url(\'%1$s\');" title="%2$s" %3$s ></span>',
					),
					'post',
					$post
				 );

				require( $thumbnails_view_dir );
			}
		}
	}

	/**
	 * echo slider view
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function the_slides_view() {
		$slides_view_dir = locate_template( 'inc/widgets/playlist-slider/views/playlist-slides-view.php' );

		if ( $slides_view_dir ) {
			global $post;

			foreach ( $this->posts as $post) {
				setup_postdata($post);

				$title = $this->utility->attributes->get_title( array(
					'length'	=> $this->instance['title_length'],
					'class'		=> 'title',
					'html'		=> '<h2 %1$s><a href="%2$s" title="%3$s">%4$s</a></h2>',
				) );

				$date = $this->utility->meta_data->get_date( array(
					'visible'	=> $this->instance['mate_data']['date'],
				) );

				$author = $this->utility->meta_data->get_author( array(
					'visible'	=> $this->instance['mate_data']['author'],
				) );

				$category = $this->utility->meta_data->get_terms( array(
					'type'		=> 'category',
					'class'		=> 'post_term',
					'visible'	=> $this->instance['mate_data']['category'],
				) );

				$tag = $this->utility->meta_data->get_terms( array(
					'type'		=> 'post_tag',
					'class'		=> 'post_term',
					'visible'	=> $this->instance['mate_data']['post_tag'],
				) );

				$permalink = $this->utility->attributes->get_post_permalink();

				$post_format = get_post_format( $post->ID );

				switch ( $post_format ) {

					//case 'link':
					case 'video':
						$slide = $this->utility->media->get_video( array(
								'size'			=> '_tm-thumb-xl',
								'mobile_size'	=> '_tm-thumb-m',
						) );
					break;

					default:
						$slide = $this->utility->media->get_image( array(
								'class'			=> 'playlist-img',
								'size'			=> '_tm-thumb-xl',
								'mobile_size'	=> '_tm-thumb-m',
								'html'			=> '<span style="background-image: url(\'%1$s\');" title="%2$s" %3$s ></span>',
						) );
					break;

				}

				require( $slides_view_dir );
			}

			wp_reset_postdata();
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

		$this->instance = $instance;

		$this->setup_widget_data( $args, $instance );
		$this->widget_start( $args, $instance );

		extract( $instance, EXTR_OVERWRITE );

		if ( !isset( $instance[ $terms_type ] ) || !$instance[ $terms_type ] ) {
			return;
		}

		$layout_settings = isset( $this->layout_settings[ $args['id'] ] ) ? $this->layout_settings[ $args['id'] ] : $this->layout_settings[ 'default' ] ;
		$layout_settings['breakpoints']['992']['height'] = ( int ) $height * 0.75;
		$layout_settings['breakpoints']['768']['height'] = ( int ) $height * 0.5;
		$layout_settings['breakpoints']['544']['height'] = ( int ) $height * 0.5;

		$posts_per_page  = ( '0' === $posts_per_page ) ? -1 : ( int ) $posts_per_page ;
		$post_args = array(
			'post_type'		=> 'post',
			'numberposts'	=> $posts_per_page,
		);
		$post_args[ $terms_type ] = implode( ',', $instance[ $terms_type ] );

		$this->posts = get_posts( $post_args );

		if ( $this->posts ) {
			$slider_settings = array(
				'width'				=> $width,
				'height'			=> $height,
				'arrows'			=> ( boolean ) $slider_controls,
				'buttons'			=> apply_filters( 'gadnews_playlist_buttons', false ),
				'thumbnailArrows'	=> ( boolean ) $thumbnail_controls,
				'thumbnailsPosition'=> $layout_settings['thumbnailsPosition'],
				'thumbnailWidth'	=> $layout_settings['thumbnailWidth'],
				'thumbnailHeight'	=> $layout_settings['thumbnailHeight'],
				'breakpoints'		=> json_encode( $layout_settings['breakpoints'] ),
			);
			$slider_settings = json_encode( $slider_settings );

			$holder_view_dir = locate_template( 'inc/widgets/playlist-slider/views/playlist-holder-view.php' );

			if ( $holder_view_dir ){

				echo '<div class="playlist-slider" style="height:' . $height . 'px;" data-settings=\'' . $slider_settings . '\' >';

					require( $holder_view_dir );

				echo '</div>';
			}
		}

		$this->widget_end( $args );
		$this->reset_widget_data();

		echo $this->cache_widget( $args, ob_get_clean() );
	}

	/**
	 * Enqueue javascript and stylesheet
	 *
	 * @since  1.0.0
	 */
	public function enqueue_assets() {
		wp_enqueue_script( 'jquery-slider-pro' );
		wp_enqueue_style( 'jquery-slider-pro' );
	}
}

add_action( 'widgets_init', 'gadnews_register_playlist_slider_widget' );
function gadnews_register_playlist_slider_widget() {
	register_widget( 'Gadnews_Playlist_Slider_Widget' );
}