<?php
/**
 * Gadnews Theme Customizer.
 *
 * @package gadnews
 */

/**
 * Retrieve a holder for Customizer options.
 *
 * @since  1.0.0
 * @return array
 */
function gadnews_get_customizer_options() {
	/**
	 * Filter a holder for Customizer options (for theme/plugin developer customization).
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'gadnews_get_customizer_options' , array(
		'prefix'     => 'gadnews',
		'capability' => 'edit_theme_options',
		'type'       => 'theme_mod',
		'options'    => array(

			/** 'Site Indentity' section */
			'show_tagline' => array(
				'title'    => esc_html__( 'Show tagline after logo', 'gadnews' ),
				'section'  => 'title_tagline',
				'priority' => 60,
				'default'  => false,
				'field'    => 'checkbox',
				'type'     => 'control',
			),
			'totop_visibility' => array(
				'title'   => esc_html__( 'Enable topTop button', 'gadnews' ),
				'section' => 'title_tagline',
				'priority' => 61,
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'page_preloader' => array(
				'title'    => esc_html__( 'Show preloader when open a page', 'gadnews' ),
				'section'  => 'logo_favicon',
				'priority' => 72,
				'default'  => true,
				'field'    => 'checkbox',
				'type'     => 'control',
			),

			/** `Logo & Favicon` section */
			'logo_favicon' => array(
				'title'       => esc_html__( 'Logo &amp; Favicon', 'gadnews' ),
				'description' => esc_html__( 'Description', 'gadnews' ),
				'priority'    => 25,
				'type'        => 'section',
			),
			'header_logo_type' => array(
				'title'   => esc_html__( 'Logo Type', 'gadnews' ),
				'section' => 'logo_favicon',
				'default' => 'text',
				'field'   => 'radio',
				'choices' => array(
					'image' => esc_html__( 'Image', 'gadnews' ),
					'text'  => esc_html__( 'Text', 'gadnews' ),
				),
				'type' => 'control',
			),
			'header_logo_url' => array(
				'title'           => esc_html__( 'Logo Upload', 'gadnews' ),
				'description'     => esc_html__( 'Logo upload description', 'gadnews' ),
				'section'         => 'logo_favicon',
				'default'         => '%s/assets/images/logo.png',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'gadnews_is_header_logo_image',
			),
			'retina_header_logo_url' => array(
				'title'           => esc_html__( 'Retina Logo Upload', 'gadnews' ),
				'description'     => esc_html__( 'Upload logo for retina-ready devices', 'gadnews' ),
				'section'         => 'logo_favicon',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'gadnews_is_header_logo_image',
			),
			'header_logo_font_family' => array(
				'title'           => esc_html__( 'Font Family', 'gadnews' ),
				'section'         => 'logo_favicon',
				'default'         => 'Montserrat',
				'field'           => 'fonts',
				'type'            => 'control',
				'active_callback' => 'gadnews_is_header_logo_text',
			),
			'header_logo_font_style' => array(
				'title'           => esc_html__( 'Font Style', 'gadnews' ),
				'section'         => 'logo_favicon',
				'default'         => 'normal',
				'field'           => 'select',
				'choices'         => gadnews_get_font_styles(),
				'type'            => 'control',
				'active_callback' => 'gadnews_is_header_logo_text',
			),
			'header_logo_font_weight' => array(
				'title'           => esc_html__( 'Font Weight', 'gadnews' ),
				'section'         => 'logo_favicon',
				'default'         => 'normal',
				'field'           => 'select',
				'choices'         => gadnews_get_font_weight(),
				'type'            => 'control',
				'active_callback' => 'gadnews_is_header_logo_text',
			),
			'header_logo_font_size' => array(
				'title'           => esc_html__( 'Font Size, px', 'gadnews' ),
				'section'         => 'logo_favicon',
				'default'         => '22',
				'field'           => 'number',
				'input_attrs'     => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type'            => 'control',
				'active_callback' => 'gadnews_is_header_logo_text',
			),
			'header_logo_character_set' => array(
				'title'           => esc_html__( 'Character Set', 'gadnews' ),
				'section'         => 'logo_favicon',
				'default'         => 'latin',
				'field'           => 'select',
				'choices'         => gadnews_get_character_sets(),
				'type'            => 'control',
				'active_callback' => 'gadnews_is_header_logo_text',
			),

			/** `Breadcrumbs` section */
			'breadcrumbs' => array(
				'title'    => esc_html__( 'Breadcrumbs', 'gadnews' ),
				'priority' => 30,
				'type'     => 'section',
			),
			'breadcrumbs_path_type' => array(
				'title'   => esc_html__( 'Show full/minified breadcrumbs path', 'gadnews' ),
				'section' => 'breadcrumbs',
				'default' => 'full',
				'field'   => 'select',
				'choices' => array(
					'full'     => esc_html__( 'Full', 'gadnews' ),
					'minified' => esc_html__( 'Minified', 'gadnews' ),
				),
				'type'    => 'control',
			),
			'breadcrumbs_page_title' => array(
				'title'   => esc_html__( 'Enable page title in breadcrumbs area', 'gadnews' ),
				'section' => 'breadcrumbs',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_visibillity' => array(
				'title'   => esc_html__( 'Enable Breadcrumbs', 'gadnews' ),
				'section' => 'breadcrumbs',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_front_visibillity' => array(
				'title'   => esc_html__( 'Enable Breadcrumbs on front page', 'gadnews' ),
				'section' => 'breadcrumbs',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Color Scheme` panel */
			'color_scheme' => array(
				'title'       => esc_html__( 'Color Scheme', 'gadnews' ),
				'description' => esc_html__( 'Configure Color Scheme', 'gadnews' ),
				'priority'    => 40,
				'type'        => 'panel',
			),

			/** `Regular scheme` section */
			'regular_scheme' => array(
				'title'       => esc_html__( 'Regular scheme', 'gadnews' ),
				'description' => esc_html__( 'Some description for the options in the Regular scheme', 'gadnews' ),
				'priority'    => 1,
				'panel'       => 'color_scheme',
				'type'        => 'section',
			),
			'regular_accent_color_1' => array(
				'title'   => esc_html__( 'Accent color (1)', 'gadnews' ),
				'section' => 'regular_scheme',
				'default' => '#30b5e1',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_accent_color_2' => array(
				'title'   => esc_html__( 'Accent color (2)', 'gadnews' ),
				'section' => 'regular_scheme',
				'default' => '#47CAF5',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_accent_color_3' => array(
				'title'   => esc_html__( 'Accent color (3)', 'gadnews' ),
				'section' => 'regular_scheme',
				'default' => '#b0bbd2',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_accent_color_4' => array(
				'title'   => esc_html__( 'Accent color (4)', 'gadnews' ),
				'section' => 'regular_scheme',
				'default' => '#001130',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_darken_color_1' => array(
				'title'   => esc_html__( 'Darken color (1)', 'gadnews' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_darken_color_2' => array(
				'title'   => esc_html__( 'Darken color (2)', 'gadnews' ),
				'section' => 'regular_scheme',
				'default' => '#464c59',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_text_color' => array(
				'title'   => esc_html__( 'Text color', 'gadnews' ),
				'section' => 'regular_scheme',
				'default' => '#7c8a97',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_link_color' => array(
				'title'   => esc_html__( 'Link color', 'gadnews' ),
				'section' => 'regular_scheme',
				'default' => '#30b5e1',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_link_hover_color' => array(
				'title'   => esc_html__( 'Link hover color', 'gadnews' ),
				'section' => 'regular_scheme',
				'default' => '#52628c',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h1_color' => array(
				'title'   => esc_html__( 'H1 color', 'gadnews' ),
				'section' => 'regular_scheme',
				'default' => '#333870',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h2_color' => array(
				'title'   => esc_html__( 'H2 color', 'gadnews' ),
				'section' => 'regular_scheme',
				'default' => '#333870',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h3_color' => array(
				'title'   => esc_html__( 'H3 color', 'gadnews' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h4_color' => array(
				'title'   => esc_html__( 'H4 color', 'gadnews' ),
				'section' => 'regular_scheme',
				'default' => '#464c59',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h5_color' => array(
				'title'   => esc_html__( 'H5 color', 'gadnews' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h6_color' => array(
				'title'   => esc_html__( 'H6 color', 'gadnews' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Invert scheme` section */
			'invert_scheme' => array(
				'title'       => esc_html__( 'Invert scheme', 'gadnews' ),
				'description' => esc_html__( 'Some description for the options in the Invert scheme', 'gadnews' ),
				'priority'    => 1,
				'panel'       => 'color_scheme',
				'type'        => 'section',
			),
			'invert_accent_color_1' => array(
				'title'   => esc_html__( 'Accent color (1)', 'gadnews' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_accent_color_2' => array(
				'title'   => esc_html__( 'Accent color (2)', 'gadnews' ),
				'section' => 'invert_scheme',
				'default' => '#adadad',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_accent_color_3' => array(
				'title'   => esc_html__( 'Accent color (3)', 'gadnews' ),
				'section' => 'invert_scheme',
				'default' => '',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_accent_color_4' => array(
					'title'   => esc_html__( 'Accent color (4)', 'gadnews' ),
					'section' => 'invert_scheme',
					'default' => '',
					'field'   => 'hex_color',
					'type'    => 'control',
			),
			'invert_text_color' => array(
				'title'   => esc_html__( 'Text color', 'gadnews' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_link_color' => array(
				'title'   => esc_html__( 'Link color', 'gadnews' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_link_hover_color' => array(
				'title'   => esc_html__( 'Link hover color', 'gadnews' ),
				'section' => 'invert_scheme',
				'default' => '#30b5e1',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h1_color' => array(
				'title'   => esc_html__( 'H1 color', 'gadnews' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h2_color' => array(
				'title'   => esc_html__( 'H2 color', 'gadnews' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h3_color' => array(
				'title'   => esc_html__( 'H3 color', 'gadnews' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h4_color' => array(
				'title'   => esc_html__( 'H4 color', 'gadnews' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h5_color' => array(
				'title'   => esc_html__( 'H5 color', 'gadnews' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h6_color' => array(
				'title'   => esc_html__( 'H6 color', 'gadnews' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Typography Settings` panel */
			'typography' => array(
				'title'       => esc_html__( 'Typography', 'gadnews' ),
				'description' => esc_html__( 'Configure typography settings', 'gadnews' ),
				'priority'    => 45,
				'type'        => 'panel',
			),

			/** `Body text` section */
			'body_typography' => array(
				'title'       => esc_html__( 'Body text', 'gadnews' ),
				'description' => esc_html__( 'Some description for the options in the Body text', 'gadnews' ),
				'priority'    => 5,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'body_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'gadnews' ),
				'section' => 'body_typography',
				'default' => 'Noto Sans',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'body_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'gadnews' ),
				'section' => 'body_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => gadnews_get_font_styles(),
				'type'    => 'control',
			),
			'body_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'gadnews' ),
				'section' => 'body_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => gadnews_get_font_weight(),
				'type'    => 'control',
			),
			'body_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'gadnews' ),
				'section'     => 'body_typography',
				'default'     => '14',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type' => 'control',
			),
			'body_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'gadnews' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'gadnews' ),
				'section'     => 'body_typography',
				'default'     => '1.642856',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'body_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'gadnews' ),
				'section'     => 'body_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'body_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'gadnews' ),
				'section' => 'body_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => gadnews_get_character_sets(),
				'type'    => 'control',
			),
			'body_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'gadnews' ),
				'section' => 'body_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => gadnews_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H1 Heading` section */
			'h1_typography' => array(
				'title'       => esc_html__( 'H1 Heading', 'gadnews' ),
				'description' => esc_html__( 'Some description for the options in the H1 Heading', 'gadnews' ),
				'priority'    => 10,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h1_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'gadnews' ),
				'section' => 'h1_typography',
				'default' => 'Merriweather',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h1_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'gadnews' ),
				'section' => 'h1_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => gadnews_get_font_styles(),
				'type'    => 'control',
			),
			'h1_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'gadnews' ),
				'section' => 'h1_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => gadnews_get_font_weight(),
				'type'    => 'control',
			),
			'h1_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'gadnews' ),
				'section'     => 'h1_typography',
				'default'     => '32',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h1_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'gadnews' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'gadnews' ),
				'section'     => 'h1_typography',
				'default'     => '1.3125',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h1_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'gadnews' ),
				'section'     => 'h1_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h1_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'gadnews' ),
				'section' => 'h1_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => gadnews_get_character_sets(),
				'type'    => 'control',
			),
			'h1_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'gadnews' ),
				'section' => 'h1_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => gadnews_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H2 Heading` section */
			'h2_typography' => array(
				'title'       => esc_html__( 'H2 Heading', 'gadnews' ),
				'description' => esc_html__( 'Some description for the options in the H2 Heading', 'gadnews' ),
				'priority'    => 15,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h2_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'gadnews' ),
				'section' => 'h2_typography',
				'default' => 'Merriweather',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h2_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'gadnews' ),
				'section' => 'h2_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => gadnews_get_font_styles(),
				'type'    => 'control',
			),
			'h2_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'gadnews' ),
				'section' => 'h2_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => gadnews_get_font_weight(),
				'type'    => 'control',
			),
			'h2_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'gadnews' ),
				'section'     => 'h2_typography',
				'default'     => '24',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h2_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'gadnews' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'gadnews' ),
				'section'     => 'h2_typography',
				'default'     => '1.4166666',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h2_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'gadnews' ),
				'section'     => 'h2_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h2_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'gadnews' ),
				'section' => 'h2_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => gadnews_get_character_sets(),
				'type'    => 'control',
			),
			'h2_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'gadnews' ),
				'section' => 'h2_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => gadnews_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H3 Heading` section */
			'h3_typography' => array(
				'title'       => esc_html__( 'H3 Heading', 'gadnews' ),
				'description' => esc_html__( 'Some description for the options in the H3 Heading', 'gadnews' ),
				'priority'    => 20,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h3_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'gadnews' ),
				'section' => 'h3_typography',
				'default' => 'Merriweather',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h3_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'gadnews' ),
				'section' => 'h3_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => gadnews_get_font_styles(),
				'type'    => 'control',
			),
			'h3_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'gadnews' ),
				'section' => 'h3_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => gadnews_get_font_weight(),
				'type'    => 'control',
			),
			'h3_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'gadnews' ),
				'section'     => 'h3_typography',
				'default'     => '20',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h3_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'gadnews' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'gadnews' ),
				'section'     => 'h3_typography',
				'default'     => '1.7',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h3_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'gadnews' ),
				'section'     => 'h3_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h3_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'gadnews' ),
				'section' => 'h3_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => gadnews_get_character_sets(),
				'type'    => 'control',
			),
			'h3_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'gadnews' ),
				'section' => 'h3_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => gadnews_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H4 Heading` section */
			'h4_typography' => array(
				'title'       => esc_html__( 'H4 Heading', 'gadnews' ),
				'description' => esc_html__( 'Some description for the options in the H4 Heading', 'gadnews' ),
				'priority'    => 25,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h4_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'gadnews' ),
				'section' => 'h4_typography',
				'default' => 'Merriweather',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h4_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'gadnews' ),
				'section' => 'h4_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => gadnews_get_font_styles(),
				'type'    => 'control',
			),
			'h4_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'gadnews' ),
				'section' => 'h4_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => gadnews_get_font_weight(),
				'type'    => 'control',
			),
			'h4_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'gadnews' ),
				'section'     => 'h4_typography',
				'default'     => '18',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h4_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'gadnews' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'gadnews' ),
				'section'     => 'h4_typography',
				'default'     => '1.325',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h4_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'gadnews' ),
				'section'     => 'h4_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h4_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'gadnews' ),
				'section' => 'h4_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => gadnews_get_character_sets(),
				'type'    => 'control',
			),
			'h4_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'gadnews' ),
				'section' => 'h4_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => gadnews_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H5 Heading` section */
			'h5_typography' => array(
				'title'       => esc_html__( 'H5 Heading', 'gadnews' ),
				'description' => esc_html__( 'Some description for the options in the H5 Heading', 'gadnews' ),
				'priority'    => 30,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h5_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'gadnews' ),
				'section' => 'h5_typography',
				'default' => 'Merriweather',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h5_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'gadnews' ),
				'section' => 'h5_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => gadnews_get_font_styles(),
				'type'    => 'control',
			),
			'h5_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'gadnews' ),
				'section' => 'h5_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => gadnews_get_font_weight(),
				'type'    => 'control',
			),
			'h5_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'gadnews' ),
				'section'     => 'h5_typography',
				'default'     => '16',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h5_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'gadnews' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'gadnews' ),
				'section'     => 'h5_typography',
				'default'     => '1.325',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h5_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'gadnews' ),
				'section'     => 'h5_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h5_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'gadnews' ),
				'section' => 'h5_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => gadnews_get_character_sets(),
				'type'    => 'control',
			),
			'h5_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'gadnews' ),
				'section' => 'h5_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => gadnews_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H6 Heading` section */
			'h6_typography' => array(
				'title'       => esc_html__( 'H6 Heading', 'gadnews' ),
				'description' => esc_html__( 'Some description for the options in the H6 Heading', 'gadnews' ),
				'priority'    => 35,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'h6_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'gadnews' ),
				'section' => 'h6_typography',
				'default' => 'Merriweather',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h6_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'gadnews' ),
				'section' => 'h6_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => gadnews_get_font_styles(),
				'type'    => 'control',
			),
			'h6_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'gadnews' ),
				'section' => 'h6_typography',
				'default' => '700',
				'field'   => 'select',
				'choices' => gadnews_get_font_weight(),
				'type'    => 'control',
			),
			'h6_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'gadnews' ),
				'section'     => 'h6_typography',
				'default'     => '14',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h6_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'gadnews' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'gadnews' ),
				'section'     => 'h6_typography',
				'default'     => '1.325',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h6_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'gadnews' ),
				'section'     => 'h6_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h6_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'gadnews' ),
				'section' => 'h6_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => gadnews_get_character_sets(),
				'type'    => 'control',
			),
			'h6_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'gadnews' ),
				'section' => 'h6_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => gadnews_get_text_aligns(),
				'type'    => 'control',
			),

			/** `Body text` section */
			'breadcrumbs_typography' => array(
				'title'       => esc_html__( 'Breadcrumbs text', 'gadnews' ),
				'description' => esc_html__( 'Some description for the options in the breadcrumbs text', 'gadnews' ),
				'priority'    => 45,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'breadcrumbs_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'gadnews' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'Noto Sans',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'breadcrumbs_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'gadnews' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => gadnews_get_font_styles(),
				'type'    => 'control',
			),
			'breadcrumbs_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'gadnews' ),
				'section' => 'breadcrumbs_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => gadnews_get_font_weight(),
				'type'    => 'control',
			),
			'breadcrumbs_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'gadnews' ),
				'section'     => 'breadcrumbs_typography',
				'default'     => '12',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type' => 'control',
			),
			'breadcrumbs_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'gadnews' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'gadnews' ),
				'section'     => 'breadcrumbs_typography',
				'default'     => '2',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'breadcrumbs_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, px', 'gadnews' ),
				'section'     => 'breadcrumbs_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -10,
					'max'  => 10,
					'step' => 1,
				),
				'type' => 'control',
			),
			'breadcrumbs_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'gadnews' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => gadnews_get_character_sets(),
				'type'    => 'control',
			),
			'breadcrumbs_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'gadnews' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'left',
				'field'   => 'select',
				'choices' => gadnews_get_text_aligns(),
				'type'    => 'control',
			),

			/** `Social links` section */
			'social_links' => array(
				'title'       => esc_html__( 'Social links', 'gadnews' ),
				'description' => esc_html__( 'Some description', 'gadnews' ),
				'priority'    => 50,
				'type'        => 'section',
			),
			'header_social_links' => array(
				'title'   => esc_html__( 'Show social links in header', 'gadnews' ),
				'section' => 'social_links',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'footer_social_links' => array(
				'title'   => esc_html__( 'Show social links in footer', 'gadnews' ),
				'section' => 'social_links',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Page Layout` section */
			'page_layout' => array(
				'title'       => esc_html__( 'Page Layout', 'gadnews' ),
				'description' => esc_html__( 'Some description', 'gadnews' ),
				'priority'    => 55,
				'type'        => 'section',
			),
			'page_layout_type' => array(
				'title'   => esc_html__( 'Type', 'gadnews' ),
				'section' => 'page_layout',
				'default' => 'fullwidth',
				'field'   => 'select',
				'choices' => array(
					'boxed'     => esc_html__( 'Boxed', 'gadnews' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'gadnews' ),
				),
				'type' => 'control',
			),
			'container_width' => array(
				'title'       => esc_html__( 'Container width (px)', 'gadnews' ),
				'section'     => 'page_layout',
				'default'     => 1200,
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 960,
					'max'  => 1920,
					'step' => 1,
				),
				'type' => 'control',
			),
			'sidebar_width' => array(
				'title'   => esc_html__( 'Sidebar width', 'gadnews' ),
				'section' => 'page_layout',
				'default' => '1/3',
				'field'   => 'select',
				'choices' => array(
					'1/3' => '1/3',
					'1/4' => '1/4',
				),
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'control',
			),

			/** `Header` panel */
			'header_options' => array(
				'title'       => esc_html__( 'Header', 'gadnews' ),
				'description' => esc_html__( 'Some description', 'gadnews' ),
				'priority'    => 60,
				'type'        => 'panel',
			),

			/** `Header styles` section */
			'header_styles' => array(
				'title'       => esc_html__( 'Header Styles', 'gadnews' ),
				'description' => esc_html__( 'Some description', 'gadnews' ),
				'priority'    => 5,
				'panel'       => 'header_options',
				'type'        => 'section',
			),
			'header_bg_color' => array(
				'title'   => esc_html__( 'Background Color', 'gadnews' ),
				'section' => 'header_styles',
				'field'   => 'hex_color',
				'default' => '#001130',
				'type'    => 'control',
			),
			'header_bg_image' => array(
				'title'   => esc_html__( 'Background Image', 'gadnews' ),
				'section' => 'header_styles',
				'field'   => 'image',
				'type'    => 'control',
			),
			'header_bg_repeat' => array(
				'title'   => esc_html__( 'Background Repeat', 'gadnews' ),
				'section' => 'header_styles',
				'default' => 'no-repeat',
				'field'   => 'select',
				'choices' => array(
					'no-repeat'  => esc_html__( 'No Repeat', 'gadnews' ),
					'repeat'     => esc_html__( 'Tile', 'gadnews' ),
					'repeat-x'   => esc_html__( 'Tile Horizontally', 'gadnews' ),
					'repeat-y'   => esc_html__( 'Tile Vertically', 'gadnews' ),
				),
				'type' => 'control',
			),
			'header_bg_position_x' => array(
				'title'   => esc_html__( 'Background Position', 'gadnews' ),
				'section' => 'header_styles',
				'default' => 'center',
				'field'   => 'select',
				'choices' => array(
					'left'   => esc_html__( 'Left', 'gadnews' ),
					'center' => esc_html__( 'Center', 'gadnews' ),
					'right'  => esc_html__( 'Right', 'gadnews' ),
				),
				'type' => 'control',
			),
			'header_bg_attachment' => array(
				'title'   => esc_html__( 'Background Attachment', 'gadnews' ),
				'section' => 'header_styles',
				'default' => 'scroll',
				'field'   => 'select',
				'choices' => array(
					'scroll' => esc_html__( 'Scroll', 'gadnews' ),
					'fixed'  => esc_html__( 'Fixed', 'gadnews' ),
				),
				'type' => 'control',
			),
			'header_layout_type' => array(
				'title'   => esc_html__( 'Layout', 'gadnews' ),
				'section' => 'header_styles',
				'default' => 'minimal',
				'field'   => 'select',
				'choices' => array(
					'minimal'  => esc_html__( 'Minimal', 'gadnews' ),
					'centered' => esc_html__( 'Centered', 'gadnews' ),
					'default'  => esc_html__( 'Default', 'gadnews' ),
				),
				'type' => 'control',
			),

			/** `Top Panel` section */
			'header_top_visibility' => array(
				'title'   => esc_html__( 'Enable top panel', 'gadnews' ),
				'section' => 'header_top_panel',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_top_panel' => array(
				'title'       => esc_html__( 'Top Panel', 'gadnews' ),
				'description' => esc_html__( 'Some description', 'gadnews' ),
				'priority'    => 10,
				'panel'       => 'header_options',
				'type'        => 'section',
			),
			'top_panel_text' => array(
				'title'       => esc_html__( 'Disclaimer Text', 'gadnews' ),
				'description' => esc_html__( 'HTML formatting support', 'gadnews' ),
				'section'     => 'header_top_panel',
				'default'     => gadnews_get_default_top_panel_text(),
				'field'       => 'textarea',
				'type'        => 'control',
			),
			'top_panel_search' => array(
				'title'   => esc_html__( 'Enable search', 'gadnews' ),
				'section' => 'header_top_panel',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'top_panel_bg' => array(
				'title'   => esc_html__( 'Background color', 'gadnews' ),
				'section' => 'header_top_panel',
				'default' => '#001130',
				'field'   => 'hex_color',
				'type'    => 'control',
			),


			/** `Main Menu` section */
			'header_main_menu' => array(
				'title'       => esc_html__( 'Main Menu', 'gadnews' ),
				'description' => esc_html__( 'Some description', 'gadnews' ),
				'priority'    => 15,
				'panel'       => 'header_options',
				'type'        => 'section',
			),
			'header_menu_sticky' => array(
				'title'   => esc_html__( 'Enable sticky menu', 'gadnews' ),
				'section' => 'header_main_menu',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_menu_attributes' => array(
				'title'   => esc_html__( 'Enable title attributes', 'gadnews' ),
				'section' => 'header_main_menu',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Sidebar` section */
			'sidebar_settings' => array(
				'title'    => esc_html__( 'Sidebar', 'gadnews' ),
				'priority' => 105,
				'type'     => 'section',
			),
			'sidebar_position_listing' => array(
				'title'   => esc_html__( 'Sidebar Position Post Listing', 'gadnews' ),
				'section' => 'sidebar_settings',
				'default' => 'fullwidth',
				'field'   => 'select',
				'choices' => array(
						'one-left-sidebar'  => esc_html__( 'Sidebar on left side', 'gadnews' ),
						'one-right-sidebar' => esc_html__( 'Sidebar on right side', 'gadnews' ),
						'two-sidebars'      => esc_html__( '2 sidebars', 'gadnews' ),
						'fullwidth'         => esc_html__( 'No sidebars', 'gadnews' ),
				),
				'type' => 'control',
			),
			'sidebar_position' => array(
				'title'   => esc_html__( 'Sidebar Position', 'gadnews' ),
				'section' => 'sidebar_settings',
				'default' => 'one-right-sidebar',
				'field'   => 'select',
				'choices' => array(
					'one-left-sidebar'  => esc_html__( 'Sidebar on left side', 'gadnews' ),
					'one-right-sidebar' => esc_html__( 'Sidebar on right side', 'gadnews' ),
					'two-sidebars'      => esc_html__( '2 sidebars', 'gadnews' ),
					'fullwidth'         => esc_html__( 'No sidebars', 'gadnews' ),
				),
				'type' => 'control',
			),

			/** `Footer` panel */
			'footer_options' => array(
				'title'       => esc_html__( 'Footer', 'gadnews' ),
				'description' => esc_html__( 'Some description', 'gadnews' ),
				'priority'    => 110,
				'type'        => 'section',
			),
			'footer_logo_url' => array(
				'title'   => esc_html__( 'Logo upload', 'gadnews' ),
				'section' => 'footer_options',
				'field'   => 'image',
				'default' => '%s/assets/images/footer-logo.png',
				'type'    => 'control',
			),
			'footer_copyright' => array(
				'title'   => esc_html__( 'Copyright text', 'gadnews' ),
				'section' => 'footer_options',
				'default' => gadnews_get_default_footer_copyright(),
				'field'   => 'textarea',
				'type'    => 'control',
			),
			'footer_widget_columns' => array(
				'title'   => esc_html__( 'Widget Area Columns', 'gadnews' ),
				'section' => 'footer_options',
				'default' => '4',
				'field'   => 'select',
				'choices' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'type' => 'control'
			),
			'footer_layout_type' => array(
				'title'   => esc_html__( 'Layout', 'gadnews' ),
				'section' => 'footer_options',
				'default' => 'default',
				'field'   => 'select',
				'choices' => array(
					'default'  => esc_html__( 'Default', 'gadnews' ),
					'centered' => esc_html__( 'Centered', 'gadnews' ),
					'minimal'  => esc_html__( 'Minimal', 'gadnews' ),
				),
				'type' => 'control'
			),
			'footer_widgets_bg' => array(
				'title'   => esc_html__( 'Footer Widgets Area color', 'gadnews' ),
				'section' => 'footer_options',
				'default' => '#001130',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'footer_bg' => array(
				'title'   => esc_html__( 'Footer Background color', 'gadnews' ),
				'section' => 'footer_options',
				'default' => '#001130',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Blog Settings` panel */
			'blog_settings' => array(
				'title'       => esc_html__( 'Blog Settings', 'gadnews' ),
				'description' => esc_html__( 'Some description', 'gadnews' ),
				'priority'    => 115,
				'type'        => 'panel',
			),

			/** `Blog` section */
			'blog' => array(
				'title'           => esc_html__( 'Blog', 'gadnews' ),
				'description'     => esc_html__( 'Some description', 'gadnews' ),
				'panel'           => 'blog_settings',
				'priority'        => 10,
				'type'            => 'section',
				'active_callback' => 'is_home',
			),
			'blog_title' => array(
				'title'   => __( 'Title', 'gadnews' ),
				'section' => 'blog',
				'default' => __( 'Latest News', 'gadnews' ),
				'field'   => 'text',
				'type'    => 'control',
			),
			'blog_layout_type' => array(
				'title'   => esc_html__( 'Layout', 'gadnews' ),
				'section' => 'blog',
				'default' => 'masonry-3-cols',
				'field'   => 'select',
				'choices' => array(
					'default'        => esc_html__( 'Default', 'gadnews' ),
					'minimal'        => esc_html__( 'Minimal', 'gadnews' ),
					'grid-2-cols'    => esc_html__( 'Grid (2 Columns)', 'gadnews' ),
					'grid-3-cols'    => esc_html__( 'Grid (3 Columns)', 'gadnews' ),
					'masonry-2-cols' => esc_html__( 'Masonry (2 Columns)', 'gadnews' ),
					'masonry-3-cols' => esc_html__( 'Masonry (3 Columns)', 'gadnews' ),
				),
				'type' => 'control'
			),
			'blog_sticky_label' => array(
				'title'       => __( 'Featured Post Label', 'gadnews' ),
				'description' => __( 'Label for sticky post.', 'gadnews' ),
				'section'     => 'blog',
				'default'     => 'icon:material:star_border',
				'field'       => 'text',
				'type'        => 'control',
			),
			'blog_posts_content' => array(
				'title'   => esc_html__( 'Post content', 'gadnews' ),
				'section' => 'blog',
				'default' => 'excerpt',
				'field'   => 'select',
				'choices' => array(
					'excerpt' => esc_html__( 'Only excerpt', 'gadnews' ),
					'full'    => esc_html__( 'Full content', 'gadnews' ),
				),
				'type' => 'control'
			),
			'blog_featured_image' => array(
				'title'   => esc_html__( 'Featured image', 'gadnews' ),
				'section' => 'blog',
				'default' => 'fullwidth',
				'field'   => 'select',
				'choices' => array(
					'small'     => esc_html__( 'Small', 'gadnews' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'gadnews' ),
				),
				'type' => 'control'
			),
			'blog_read_more_text' => array(
				'title'   => __( 'Read More button text', 'gadnews' ),
				'section' => 'blog',
				'default' => __( 'Continue reading', 'gadnews' ),
				'field'   => 'text',
				'type'    => 'control',
			),
			'blog_post_author' => array(
				'title'   => __( 'Show post author', 'gadnews' ),
				'section' => 'blog',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_publish_date' => array(
				'title'   => __( 'Show publish date', 'gadnews' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_categories' => array(
				'title'   => __( 'Show categories', 'gadnews' ),
				'section' => 'blog',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_tags' => array(
				'title'   => __( 'Show tags', 'gadnews' ),
				'section' => 'blog',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_comments' => array(
				'title'   => __( 'Show comments', 'gadnews' ),
				'section' => 'blog',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_share_buttons' => array(
				'title'   => esc_html__( 'Show social sharing', 'gadnews' ),
				'section' => 'blog',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Post` section */
			'blog_post' => array(
				'title'           => esc_html__( 'Post', 'gadnews' ),
				'description'     => esc_html__( 'Some description', 'gadnews' ),
				'panel'           => 'blog_settings',
				'priority'        => 20,
				'type'            => 'section',
				'active_callback' => 'callback_single',
			),
			'single_post_author' => array(
				'title'   => __( 'Show post author', 'gadnews' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_publish_date' => array(
				'title'   => __( 'Show publish date', 'gadnews' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_categories' => array(
				'title'   => __( 'Show categories', 'gadnews' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_tags' => array(
				'title'   => __( 'Show tags', 'gadnews' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_comments' => array(
				'title'   => __( 'Show comments', 'gadnews' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_share_buttons' => array(
				'title'   => esc_html__( 'Show social sharing', 'gadnews' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_author_block' => array(
				'title'   => __( 'Enable the author block after each post', 'gadnews' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'mailchimp' => array(
				'title'       => esc_html__( 'MailChimp', 'gadnews' ),
				'description' => esc_html__( 'Setup MailChimp settings for subscribe widget', 'gadnews' ),
				'priority'    => 109,
				'type'        => 'section',
			),
			'mailchimp_api_key' => array(
				'title'   => __( 'MailChimp API key', 'gadnews' ),
				'section' => 'mailchimp',
				'field'   => 'text',
				'type'    => 'control',
			),
			'mailchimp_list_id' => array(
				'title'   => __( 'MailChimp list ID', 'gadnews' ),
				'section' => 'mailchimp',
				'field'   => 'text',
				'type'    => 'control',
			),
	) ) );
}

/**
 * Return true if logo in header has image type. Otherwise - return false.
 *
 * @param  object $control
 * @return bool
 */
function gadnews_is_header_logo_image( $control ) {

	if ( $control->manager->get_setting( 'header_logo_type' )->value() == 'image' ) {
		return true;
	}

	return false;
}

/**
 * Return true if logo in header has text type. Otherwise - return false.
 *
 * @param  object $control
 * @return bool
 */
function gadnews_is_header_logo_text( $control ) {

	if ( $control->manager->get_setting( 'header_logo_type' )->value() == 'text' ) {
		return true;
	}

	return false;
}

// Move native `site_icon` control (based on WordPress core) in custom section.
add_action( 'customize_register', 'gadnews_customizer_change_core_controls', 20 );
function gadnews_customizer_change_core_controls( $wp_customize ) {
	$wp_customize->get_control( 'site_icon' )->section = 'gadnews_logo_favicon';
}

////////////////////////////////////
// Typography utility function    //
////////////////////////////////////
function gadnews_get_font_styles() {
	return apply_filters( 'gadnews_get_font_styles', array(
		'normal'  => esc_html__( 'Normal', 'gadnews' ),
		'italic'  => esc_html__( 'Italic', 'gadnews' ),
		'oblique' => esc_html__( 'Oblique', 'gadnews' ),
		'inherit' => esc_html__( 'Inherit', 'gadnews' ),
	) );
}

function gadnews_get_character_sets() {
	return apply_filters( 'gadnews_get_character_sets', array(
		'latin'        => esc_html__( 'Latin', 'gadnews' ),
		'greek'        => esc_html__( 'Greek', 'gadnews' ),
		'greek-ext'    => esc_html__( 'Greek Extended', 'gadnews' ),
		'vietnamese'   => esc_html__( 'Vietnamese', 'gadnews' ),
		'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'gadnews' ),
		'latin-ext'    => esc_html__( 'Latin Extended', 'gadnews' ),
		'cyrillic'     => esc_html__( 'Cyrillic', 'gadnews' ),
	) );
}

function gadnews_get_text_aligns() {
	return apply_filters( 'gadnews_get_text_aligns', array(
		'inherit' => esc_html__( 'Inherit', 'gadnews' ),
		'center'  => esc_html__( 'Center', 'gadnews' ),
		'justify' => esc_html__( 'Justify', 'gadnews' ),
		'left'    => esc_html__( 'Left', 'gadnews' ),
		'right'   => esc_html__( 'Right', 'gadnews' ),
	) );
}

function gadnews_get_font_weight() {
	return apply_filters( 'gadnews_get_font_weight', array(
		'normal' => esc_html__( 'Normal', 'gadnews' ),
		'bold'   => esc_html__( 'Bold', 'gadnews' ),
		'100'    => '100',
		'200'    => '200',
		'300'    => '300',
		'400'    => '400',
		'500'    => '500',
		'600'    => '600',
		'700'    => '700',
		'800'    => '800',
		'900'    => '900',
	) );
}

/**
 * Return array of arguments for dynamic CSS module
 *
 * @return array
 */
function gadnews_get_dynamic_css_options() {
	return apply_filters( 'gadnews_get_dynamic_css_options', array(
		'prefix'    => 'gadnews',
		'type'      => 'theme_mod',
		'single'    => true,
		'css_files' => array(
			GADNEWS_THEME_DIR . '/assets/css/dynamic.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/widgets/widget-default.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/widgets/taxonomy-tiles.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/widgets/image-grid.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/widgets/carousel.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/widgets/smart-slider.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/widgets/instagram.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/widgets/facebook.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/widgets/featured-posts-block.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/site/top-panel.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/site/search-form.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/site/social.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/site/main-navigation.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/site/footer.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/site/elements.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/site/post.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/site/pagination.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/site/misc.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/widgets/custom-posts.css',
			GADNEWS_THEME_DIR . '/assets/css/dynamic/widgets/playlist-slider.css',
		),
		'options'   => array(
			'header_logo_font_style',
			'header_logo_font_weight',
			'header_logo_font_size',
			'header_logo_font_family',

			'body_font_style',
			'body_font_weight',
			'body_font_size',
			'body_line_height',
			'body_font_family',
			'body_letter_spacing',
			'body_text_align',

			'h1_font_style',
			'h1_font_weight',
			'h1_font_size',
			'h1_line_height',
			'h1_font_family',
			'h1_letter_spacing',
			'h1_text_align',

			'h2_font_style',
			'h2_font_weight',
			'h2_font_size',
			'h2_line_height',
			'h2_font_family',
			'h2_letter_spacing',
			'h2_text_align',

			'h3_font_style',
			'h3_font_weight',
			'h3_font_size',
			'h3_line_height',
			'h3_font_family',
			'h3_letter_spacing',
			'h3_text_align',

			'h4_font_style',
			'h4_font_weight',
			'h4_font_size',
			'h4_line_height',
			'h4_font_family',
			'h4_letter_spacing',
			'h4_text_align',

			'h5_font_style',
			'h5_font_weight',
			'h5_font_size',
			'h5_line_height',
			'h5_font_family',
			'h5_letter_spacing',
			'h5_text_align',

			'h6_font_style',
			'h6_font_weight',
			'h6_font_size',
			'h6_line_height',
			'h6_font_family',
			'h6_letter_spacing',
			'h6_text_align',

			'breadcrumbs_font_style',
			'breadcrumbs_font_weight',
			'breadcrumbs_font_size',
	        'breadcrumbs_line_height',
	        'breadcrumbs_font_family',
			'breadcrumbs_letter_spacing',
			'breadcrumbs_text_align',

			'regular_accent_color_1',
			'regular_accent_color_2',
			'regular_accent_color_3',
			'regular_accent_color_4',
			'regular_darken_color_1',
			'regular_darken_color_2',
			'regular_text_color',
			'regular_link_color',
			'regular_link_hover_color',
			'regular_h1_color',
			'regular_h2_color',
			'regular_h3_color',
			'regular_h4_color',
			'regular_h5_color',
			'regular_h6_color',

			'invert_accent_color_1',
			'invert_accent_color_2',
			'invert_accent_color_3',
			'invert_accent_color_4',
			'invert_text_color',
			'invert_link_color',
			'invert_link_hover_color',
			'invert_h1_color',
			'invert_h2_color',
			'invert_h3_color',
			'invert_h4_color',
			'invert_h5_color',
			'invert_h6_color',

			'header_bg_color',
			'header_bg_image',
			'header_bg_repeat',
			'header_bg_position_x',
			'header_bg_attachment',

			'top_panel_bg',

			'container_width',

			'footer_widgets_bg',
			'footer_bg',
		)
	) );
}

/**
 * Return array of arguments for Google Fonta loader module
 *
 * @return array
 */
function gadnews_get_fonts_options() {
	return apply_filters( 'gadnews_get_fonts_options', array(
		'prefix'  => 'gadnews',
		'type'    => 'theme_mod',
		'single'  => true,
		'options' => array(
			'body' => array(
				'family'  => 'body_font_family',
				'style'   => 'body_font_style',
				'weight'  => 'body_font_weight',
				'charset' => 'body_character_set',
			),
			'h1' => array(
				'family'  => 'h1_font_family',
				'style'   => 'h1_font_style',
				'weight'  => 'h1_font_weight',
				'charset' => 'h1_character_set',
			),
			'h2' => array(
				'family'  => 'h2_font_family',
				'style'   => 'h2_font_style',
				'weight'  => 'h2_font_weight',
				'charset' => 'h2_character_set',
			),
			'h3' => array(
				'family'  => 'h3_font_family',
				'style'   => 'h3_font_style',
				'weight'  => 'h3_font_weight',
				'charset' => 'h3_character_set',
			),
			'h4' => array(
				'family'  => 'h4_font_family',
				'style'   => 'h4_font_style',
				'weight'  => 'h4_font_weight',
				'charset' => 'h4_character_set',
			),
			'h5' => array(
				'family'  => 'h5_font_family',
				'style'   => 'h5_font_style',
				'weight'  => 'h5_font_weight',
				'charset' => 'h5_character_set',
			),
			'h6' => array(
				'family'  => 'h6_font_family',
				'style'   => 'h6_font_style',
				'weight'  => 'h6_font_weight',
				'charset' => 'h6_character_set',
			),
			'header_logo' => array(
				'family'  => 'header_logo_font_family',
				'style'   => 'header_logo_font_style',
				'weight'  => 'header_logo_font_weight',
				'charset' => 'header_logo_character_set',
			),
		)
	) );
}

/**
 * Get default top panel text
 *
 * @since  1.0.0
 * @return string
 */
function gadnews_get_default_top_panel_text() {
	return sprintf(
		__( 'Technical portal: news, reviews, videos, howto guides and more...', 'gadnews' )
	);
}

/**
 * Get default footer copyright.
 *
 * @since  1.0.0
 * @return string
 */
function gadnews_get_default_footer_copyright() {
	return __('&copy; %%year%% oh my GadNews. All Rights reserved', 'gadnews');
}
