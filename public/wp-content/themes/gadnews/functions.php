<?php
if ( ! class_exists( 'Gadnews_Theme_Setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since 1.0.0
	 */
	class Gadnews_Theme_Setup {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * A reference to an instance of cherry framework core class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private $core = null;

		/**
		 * Holder for CSS layout scheme
		 *
		 * @since 1.0.0
		 * @var   array
		 */
		public $layout = array();

		/**
		 * Holder for current customizer module instance
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		public $customizer = null;

		/**
		 * Sets up needed actions/filters for the theme to initialize.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			// Set the constants needed by the theme.
			add_action( 'after_setup_theme', array( $this, 'constants' ), 0 );

			// Load the core functions/classes required by the rest of the theme.
			add_action( 'after_setup_theme', array( $this, 'get_core' ), 1 );

			// Language functions and translations setup.
			add_action( 'after_setup_theme', array( $this, 'l10n' ), 2 );

			// Handle theme supported features.
			add_action( 'after_setup_theme', array( $this, 'theme_support' ), 3 );

			// Load the theme includes.
			add_action( 'after_setup_theme', array( $this, 'includes' ), 4 );

			// Initialization of modules.
			add_action( 'after_setup_theme', array( $this, 'init' ), 10 );

			// Load admin files.
			add_action( 'wp_loaded', array( $this, 'admin' ), 1 );

			// Load admin assets.
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );

			// Load public assets.
			add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ), 9 );

			// Load public assets.
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ), 10 );

		}

		/**
		 * Defines the constant paths for use within the core theme, parent theme, and child theme.
		 *
		 * @since 1.0.0
		 */
		public function constants() {
			/**
			 * Fires before definitions the constant.
			 *
			 * @since 1.0.0
			 */
			do_action( 'cherry_constants_before' );

			global $content_width;

			$template  = get_template();
			$theme_obj = wp_get_theme( $template );

			/** Sets the theme version number. */
			define( 'GADNEWS_THEME_VERSION', $theme_obj->get( 'Version' ) );

			/** Sets the path to the theme directory. */
			define( 'GADNEWS_THEME_DIR', get_template_directory() );

			/** Sets the path to the theme directory URI. */
			define( 'GADNEWS_THEME_URI', get_template_directory_uri() );

			/** Sets the path to the core framework directory. */
			define( 'CHERRY_DIR', trailingslashit( GADNEWS_THEME_DIR ) . 'cherry-framework' );

			/** Sets the path to the core framework directory URI. */
			define( 'CHERRY_URI', trailingslashit( GADNEWS_THEME_URI ) . 'cherry-framework' );

			// Sets the content width in pixels, based on the theme's design and stylesheet.
			if ( ! isset( $content_width ) ) {
				$content_width = 710;
			}
		}

		/**
		 * Loads the core functions. These files are needed before loading anything else in the
		 * theme because they have required functions for use.
		 *
		 * @since  1.0.0
		 */
		public function get_core() {
			/**
			 * Fires before loads the core theme functions.
			 *
			 * @since  1.0.0
			 */
			do_action( 'cherry_core_before' );

			if ( null !== $this->core ) {
				return $this->core;
			}

			if ( ! class_exists( 'Cherry_Core' ) ) {
				require_once( CHERRY_DIR . '/cherry-core.php' );
			}

			$this->core = new Cherry_Core( array(
				'base_dir' => CHERRY_DIR,
				'base_url' => CHERRY_URI,
				'modules'  => array(
					'cherry-js-core' => array(
						'priority' => 999,
						'autoload' => true,
					),
					'cherry-ui-elements' => array(
						'priority' => 999,
						'autoload' => false,
					),
					'cherry-widget-factory' => array(
						'priority' => 999,
						'autoload' => true,
					),
					'cherry-post-formats-api' => array(
						'priority' => 999,
						'autoload' => true,
						'args'     => array(
							'rewrite_default_gallery' => true,
							'gallery_args'            => array(
								'size'           => '_tm-thumb-1170-781',
								'base_class'     => 'post-gallery',
								'container'      => '<div class="%2$s swiper-container" id="%4$s" %3$s><div class="swiper-wrapper">%1$s</div><div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div><div class="swiper-button-next"><i class="fa fa-angle-right"></i></div></div>',
								'slide'          => '<figure class="%2$s swiper-slide">%1$s</figure>',
								'img_class'      => 'swiper-image',
								'slider_handle'  => 'jquery-swiper',
								'slider'         => 'sliderPro',
								'slider_init'    => array(
									'buttons' => false,
									'arrows'  => true,
								),
								'popup'          => 'magnificPopup',
								'popup_handle'   => 'magnific-popup',
								'popup_init'     => array(
									'type' => 'image',
								),
							),
							'image_args' => array(
								'size'         => '_tm-thumb-1170-781',
								'popup'        => 'magnificPopup',
								'popup_handle' => 'magnific-popup',
								'popup_init'   => array(
									'type' => 'image',
								),
							),
						),
					),
					'cherry-customizer' => array(
						'priority' => 999,
						'autoload' => false,
					),
					'cherry-dynamic-css' => array(
						'priority' => 999,
						'autoload' => false,
					),
					'cherry-google-fonts-loader' => array(
						'priority' => 999,
						'autoload' => false,
					),
					'cherry-term-meta' => array(
						'priority' => 999,
						'autoload' => false,
					),
					'cherry-post-meta' => array(
						'priority' => 999,
						'autoload' => false,
					),
					'cherry-breadcrumbs' => array(
						'priority' => 999,
						'autoload' => false,
					),
					'cherry-utility' => array(
						'priority' => 999,
						'autoload' => true,
					),
				),
			) );

			return $this->core;
		}

		/**
		 * Loads the theme translation file.
		 *
		 * @since 1.0.0
		 */
		public function l10n() {
			/*
			 * Make theme available for translation.
			 * Translations can be filed in the /languages/ directory.
			 */
			load_theme_textdomain( 'gadnews', GADNEWS_THEME_DIR . '/languages' );
		}

		/**
		 * Adds theme supported features.
		 *
		 * @since 1.0.0
		 */
		public function theme_support() {

			$this->layout = array(
				'one-right-sidebar' => array(
					'1/3' => array(
						'content' => array( 'col-xs-12', 'col-md-8' ),
						'sidebar' => array( 'col-xs-12', 'col-md-4' ),
					),
					'1/4' => array(
						'content' => array( 'col-xs-12', 'col-md-9' ),
						'sidebar' => array( 'col-xs-12', 'col-md-3' ),
					),
				),
				'one-left-sidebar' => array(
					'1/3' => array(
						'content' => array( 'col-xs-12', 'col-md-8', 'col-md-push-4' ),
						'sidebar' => array( 'col-xs-12', 'col-md-4', 'col-md-pull-8' ),
					),
					'1/4' => array(
						'content' => array( 'col-xs-12', 'col-md-9', 'col-md-push-3' ),
						'sidebar' => array( 'col-xs-12', 'col-md-3', 'col-md-pull-9' ),
					),
				),
				'two-sidebars' => array(
					'1/3' => array(
						'content' => array( 'col-xs-12', 'col-md-4' ),
						'sidebar' => array( 'col-xs-12', 'col-md-4' ),
					),
					'1/4' => array(
						'content' => array( 'col-xs-12', 'col-md-6' ),
						'sidebar' => array( 'col-xs-12', 'col-md-3' ),
					),
				),
				'fullwidth' => array(
					array(
						'content' => array( 'col-xs-12', 'col-md-12' ),
					),
				),
			);

			register_nav_menus( array(
				'top'    => __( 'Top', 'gadnews' ),
				'main'   => __( 'Main', 'gadnews' ),
				'footer' => __( 'Footer', 'gadnews' ),
				'social' => __( 'Social', 'gadnews' ),
			) );

			// Enable support for Post Thumbnails.
			add_theme_support( 'post-thumbnails' );

			// Enable HTML5 markup structure.
			add_theme_support( 'html5', array(
				'comment-list', 'comment-form', 'search-form', 'gallery', 'caption',
			) );

			// Enable default title tag.
			add_theme_support( 'title-tag' );

			// Enable post formats.
			add_theme_support(
				'post-formats',
				array( 'aside', 'gallery', 'image', 'link', 'quote', 'video', 'audio', 'status' )
			);

			// Enable custom BG.
			add_theme_support( 'custom-background', array( 'default-color' => 'ffffff', ) );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );
		}

		/**
		 * Loads the theme files supported by themes and template-related functions/classes.
		 *
		 * @since 1.0.0
		 */
		public function includes() {
			require_once GADNEWS_THEME_DIR . '/config/thumbnails.php';
			require_once GADNEWS_THEME_DIR . '/inc/template-tags.php';
			require_once GADNEWS_THEME_DIR . '/inc/template-comment.php';
			require_once GADNEWS_THEME_DIR . '/inc/extras.php';
			require_once GADNEWS_THEME_DIR . '/inc/customizer.php';
			require_once GADNEWS_THEME_DIR . '/inc/hooks.php';
			require_once GADNEWS_THEME_DIR . '/inc/register-plugins.php';

			/**
			 * Widgets
			 */
			require_once GADNEWS_THEME_DIR . '/inc/widgets/tm-about-author-widget/class-tm-about-author-widget.php';
			require_once GADNEWS_THEME_DIR . '/inc/widgets/tm-image-grid-widget/class-tm-image-grid-widget.php';
			require_once GADNEWS_THEME_DIR . '/inc/widgets/tm-taxonomy-tiles-widget/class-tm-taxonomy-tiles-widget.php';
			require_once GADNEWS_THEME_DIR . '/inc/widgets/tm-carousel-widget/class-tm-carousel-widget.php';
			require_once GADNEWS_THEME_DIR . '/inc/widgets/tm-smart-slider-widget/class-tm-smart-slider-widget.php';
			require_once GADNEWS_THEME_DIR . '/inc/widgets/tm-subscribe-follow-widget/class-tm-subscribe-follow-widget.php';
			require_once GADNEWS_THEME_DIR . '/inc/widgets/tm-instagram-widget/class-tm-instagram-widget.php';
			require_once GADNEWS_THEME_DIR . '/inc/widgets/tm-featured-posts-block-widget/class-tm-featured-posts-block-widget.php';
			require_once GADNEWS_THEME_DIR . '/inc/widgets/playlist-slider/class-playlist-slider-widget.php';
			require_once GADNEWS_THEME_DIR . '/inc/widgets/custom-posts/class-custom-posts-widget.php';
			require_once GADNEWS_THEME_DIR . '/inc/widgets/news-smart-box/class-tm-news-smart-box-widget.php';

			/**
			 * Classes
			 */
			require_once GADNEWS_THEME_DIR . '/inc/classes/class-tm-wrapping.php';
			require_once GADNEWS_THEME_DIR . '/inc/classes/class-tm-widget-area.php';
			require_once GADNEWS_THEME_DIR . '/inc/classes/class-tgm-plugin-activation.php';
		}

		/**
		 * Run initialization of modules.
		 *
		 * @since 1.0.0
		 */
		public function init() {
			$this->customizer = $this->get_core()->init_module( 'cherry-customizer', gadnews_get_customizer_options() );
			$this->get_core()->init_module( 'cherry-dynamic-css', gadnews_get_dynamic_css_options() );
			$this->get_core()->init_module( 'cherry-google-fonts-loader', gadnews_get_fonts_options() );
			$this->get_core()->init_module( 'cherry-term-meta', array(
				'tax'      => 'category',
				'priority' => 10,
				'fields'   => array(
					'_tm_thumb' => array(
						'type'               => 'media',
						'value'              => '',
						'multi_upload'       => false,
						'library_type'       => 'image',
						'upload_button_text' => __( 'Set thumbnail', 'gadnews' ),
						'label'              => __( 'Category thumbnail', 'gadnews' ),
					),
				),
			) );
			$this->get_core()->init_module( 'cherry-term-meta', array(
				'tax'      => 'post_tag',
				'priority' => 10,
				'fields'   => array(
					'_tm_thumb' => array(
						'type'               => 'media',
						'value'              => '',
						'multi_upload'       => false,
						'library_type'       => 'image',
						'upload_button_text' => __( 'Set thumbnail', 'gadnews' ),
						'label'              => __( 'Tag thumbnail', 'gadnews' ),
					),
				),
			) );
			$this->get_core()->init_module( 'cherry-post-meta', array(
				'id'            => 'post-layout',
				'title'         => __( 'Post Layout', 'gadnews' ),
				'page'          => array( 'post', 'page' ),
				'context'       => 'normal',
				'priority'      => 'high',
				'callback_args' => false,
				'fields'        => array(
					'_tm_sidebar_position' => array(
						'type'        => 'radio',
						'title'       => __( 'Layout', 'gadnews' ),
						'value'         => 'inherit',
						'display_input' => false,
						'options'       => array(
							'inherit' => array(
								'label'   => __( 'Inherit', 'gadnews' ),
								'img_src' => GADNEWS_THEME_URI . '/assets/images/admin/inherit.svg',
							),
							'one-left-sidebar' => array(
								'label'   => __( 'Sidebar on left side', 'gadnews' ),
								'img_src' => GADNEWS_THEME_URI . '/assets/images/admin/page-layout-left-sidebar.svg',
							),
							'one-right-sidebar' => array(
								'label'   => __( 'Sidebar on right side', 'gadnews' ),
								'img_src' => GADNEWS_THEME_URI . '/assets/images/admin/page-layout-right-sidebar.svg',
							),
							'two-sidebars' => array(
								'label'   => __( '2 sidebars', 'gadnews' ),
								'img_src' => GADNEWS_THEME_URI . '/assets/images/admin/page-layout-both-sidebar.svg',
							),
							'fullwidth' => array(
								'label'   => __( 'No sidebar', 'gadnews' ),
								'img_src' => GADNEWS_THEME_URI . '/assets/images/admin/page-layout-fullwidth.svg',
							),
						)
					),
				),
			) );
		}

		/**
		 * Load admin files for the theme.
		 *
		 * @since 1.0.0
		 */
		public function admin() {

		// Check if in the WordPress admin.
			if ( ! is_admin() ) {
				return;
			}
		}

		/**
		 * Enqueue admin-specific styles.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_admin_assets() {
			wp_enqueue_script( 'admin_theme_script', GADNEWS_THEME_URI . '/assets/js/admin-theme-script.js', array( 'jquery' ), GADNEWS_THEME_VERSION, true );
		}

		/**
		 * Enqueue assets.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function register_assets() {

			// SliderPro assets register
			wp_register_script( 'jquery-slider-pro', GADNEWS_THEME_URI . '/assets/js/jquery.sliderPro.min.js', array( 'jquery' ), '1.2.4', true );
			wp_register_style( 'jquery-slider-pro', GADNEWS_THEME_URI . '/assets/css/slider-pro.min.css', array(), '1.2.4', 'all');

			// Swiper assets register
			wp_register_script( 'jquery-swiper', GADNEWS_THEME_URI . '/assets/js/swiper.jquery.min.js', array( 'jquery' ), '3.3.0', true );
			wp_register_style( 'jquery-swiper', GADNEWS_THEME_URI . '/assets/css/swiper.min.css', array(), '3.3.0', 'all' );

			// Magnific popup assets
			wp_register_script( 'magnific-popup', GADNEWS_THEME_URI . '/assets/js/jquery.magnific-popup.min.js', array(), '1.0.1', true );
			wp_register_style( 'magnific-popup', GADNEWS_THEME_URI . '/assets/css/magnific-popup.css', array(), '1.0.1', 'all' );

			// Font icons
			wp_register_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', array(), '4.5.0' );
			wp_register_style( 'material-icons', GADNEWS_THEME_URI . '/assets/css/material-icons.css', array(), '2.1.0', 'all' );

			// Sticky menu
			wp_register_script( 'jquery-stickup', GADNEWS_THEME_URI . '/assets/js/jquery.stickup.js', array(), '1.0.0', true );

			// To top
			wp_register_script( 'jquery-totop', GADNEWS_THEME_URI . '/assets/js/jquery.ui.totop.min.js', array(), '1.0.0', true );

			// Threaded Comments.
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		/**
		 * Enqueue assets.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_assets() {

			$script_depends = apply_filters( 'gadnews_theme_script_depends', array( 'jquery', 'hoverIntent' ) );

			wp_enqueue_style( 'gadnews-style', get_stylesheet_uri(), array( 'font-awesome', 'material-icons', 'magnific-popup' ), GADNEWS_THEME_VERSION );
			wp_enqueue_script( 'gadnews-theme-script', GADNEWS_THEME_URI . '/assets/js/theme-script.js', $script_depends, GADNEWS_THEME_VERSION, true );

			wp_localize_script( 'gadnews-theme-script', 'gadnews', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
		}



		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
	}
}

/**
 * Returns instanse of main theme configuration class
 *
 * @return object
 */
function gadnews_theme() {
	return Gadnews_Theme_Setup::get_instance();
}

gadnews_theme();
