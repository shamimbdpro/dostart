<?php
/**
 * Dostart Theme Customizer
 *
 * @package dostart
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Dostart Customizer Class
 */
if ( ! class_exists( 'Dostart_Customizer' ) ) {

	/**
	 * Customizer Class
	 */
	class Dostart_Customizer {

		/**
		 * Instance
		 *
		 * @access private
		 * @var    object
		 */
		private static $instance;

		/**
		 * Making instance of the class
		 *
		 * @return object
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'customize_register', array( $this, 'dostart_customize_register' ) );
			add_action( 'customize_preview_init', array( $this, 'dostart_customize_preview_js' ) );
		}

		/**
		 * Register customizer settings and controls
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function dostart_customize_register( $wp_customize ) {

			/**
			 * Move Default Sections to Panels
			 */
			$wp_customize->get_section( 'header_image' )->panel     = 'dostart_header';
			$wp_customize->get_section( 'colors' )->panel           = 'dostart_general_settings';
			$wp_customize->get_section( 'title_tagline' )->panel    = 'dostart_header';
			$wp_customize->get_section( 'background_image' )->panel = 'dostart_general_settings';

			/*=======================================================================*/
			/* [ General Settings Panel ]
			/*=======================================================================*/

			$wp_customize->add_panel(
				'dostart_general_settings',
				array(
					'priority'       => 19,
					'title'          => esc_html__( 'Global', 'dostart' ),
					'capability'     => 'edit_theme_options',
				)
			);

			/*---------------------------------
			  [ Basic Settings Section ]
			---------------------------------*/
			$wp_customize->add_section(
				'dostart_basic_settings',
				array(
					'priority' => 30,
					'title'    => esc_html__( 'Basic Settings', 'dostart' ),
					'panel'    => 'dostart_general_settings',
				)
			);

			// Google Analytics Tracking ID
			$wp_customize->add_setting(
				'dostart_google_analytics_id',
				array(
					'default'           => '',
					'sanitize_callback' => 'sanitize_text_field',
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				'dostart_google_analytics_id',
				array(
					'label'       => esc_html__( 'Google Analytics Tracking ID Ex: UA-XXX', 'dostart' ),
					'section'     => 'dostart_basic_settings',
					'type'        => 'text',
					'priority'    => 10,
				)
			);

			// Google Adsense Publisher ID
			$wp_customize->add_setting(
				'dostart_google_adsense_publisher_id',
				array(
					'default'           => '',
					'sanitize_callback' => 'sanitize_text_field',
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				'dostart_google_adsense_publisher_id',
				array(
					'label'       => esc_html__( 'Google Adsense Publisher ID Ex: pub-XXX', 'dostart' ),
					'section'     => 'dostart_basic_settings',
					'type'        => 'text',
					'priority'    => 10,
				)
			);

			// Typography - Font Family (Google Fonts)
			$wp_customize->add_setting(
				'dostart_typography_font_family',
				array(
					'default'           => 'Source Sans Pro',
					'sanitize_callback' => 'dostart_sanitize_font_choice',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'dostart_typography_font_family',
				array(
					'label'       => esc_html__( 'Font Family', 'dostart' ),
					'section'     => 'dostart_basic_settings',
					'type'        => 'select',
					'choices'     => dostart_get_google_fonts_list(),
					'priority'    => 10,
				)
			);

			// Typography - Font Size
			$wp_customize->add_setting(
				'dostart_typography_font_size',
				array(
					'default'           => '16px',
					'sanitize_callback' => 'sanitize_text_field',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'dostart_typography_font_size',
				array(
					'label'       => esc_html__( 'Font Size', 'dostart' ),
					'section'     => 'dostart_basic_settings',
					'type'        => 'text',
					'priority'    => 10,
				)
			);

			// Typography - Line Height
			$wp_customize->add_setting(
				'dostart_typography_line_height',
				array(
					'default'           => '1.5',
					'sanitize_callback' => 'sanitize_text_field',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'dostart_typography_line_height',
				array(
					'label'       => esc_html__( 'Line Height', 'dostart' ),
					'section'     => 'dostart_basic_settings',
					'type'        => 'text',
					'priority'    => 10,
				)
			);

			// Typography - Color
			$wp_customize->add_setting(
				'dostart_typography_color',
				array(
					'default'           => '#666666',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'dostart_typography_color',
					array(
						'label'    => esc_html__( 'Text Color', 'dostart' ),
						'section'  => 'dostart_basic_settings',
						'priority' => 10,
					)
				)
			);

			// Box Layout Switch
			$wp_customize->add_setting(
				'dostart_theme_layout',
				array(
					'default'           => '',
					'sanitize_callback' => 'dostart_sanitize_switch',
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				'dostart_theme_layout',
				array(
					'label'       => esc_html__( 'Box Layouts', 'dostart' ),
					'section'     => 'dostart_basic_settings',
					'type'        => 'checkbox',
					'priority'    => 10,
				)
			);

			/*---------------------------------
			  [ Social Media Icons Section ]
			---------------------------------*/
			$wp_customize->add_section(
				'dostart_social_icons',
				array(
					'priority'    => 30,
					'title'       => esc_html__( 'Social Media Icons', 'dostart' ),
					'description' => esc_html__( 'Social Media links', 'dostart' ),
					'panel'       => 'dostart_general_settings',
				)
			);

			// Open New Tab Checkbox
			$wp_customize->add_setting(
				'social_open_new_tab',
				array(
					'default'           => false,
					'sanitize_callback' => 'wp_validate_boolean',
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				'social_open_new_tab',
				array(
					'label'       => esc_html__( 'Open New Tab', 'dostart' ),
					'section'     => 'dostart_social_icons',
					'type'        => 'checkbox',
					'priority'    => 10,
				)
			);

			// Social Media Links
			$social_networks = array(
				'facebook'  => esc_html__( 'Facebook', 'dostart' ),
				'twitter'   => esc_html__( 'Twitter', 'dostart' ),
				'youtube'   => esc_html__( 'Youtube', 'dostart' ),
				'pinterest' => esc_html__( 'Pinterest', 'dostart' ),
				'behance'   => esc_html__( 'Behance', 'dostart' ),
				'linkedin'  => esc_html__( 'Linkedin', 'dostart' ),
				'instagram' => esc_html__( 'Instagram', 'dostart' ),
			);

			$priority = 20;
			foreach ( $social_networks as $network => $label ) {
				$wp_customize->add_setting(
					'dostart_social_' . $network,
					array(
						'default'           => '',
						'sanitize_callback' => 'esc_url_raw',
						'transport'         => 'refresh',
					)
				);

				$wp_customize->add_control(
					'dostart_social_' . $network,
					array(
						'label'       => $label,
						'section'     => 'dostart_social_icons',
						'type'        => 'url',
						'priority'    => $priority++,
					)
				);
			}

			/*---------------------------------
			  [ Theme Global Color Section ]
			---------------------------------*/
			$wp_customize->add_section(
				'dostart_theme_colors',
				array(
					'priority' => 30,
					'title'    => esc_html__( 'Theme Colors', 'dostart' ),
					'panel'    => 'dostart_general_settings',
				)
			);

			// Theme Primary Color
			$wp_customize->add_setting(
				'dostart_theme_primary_color',
				array(
					'default'           => '#065FD4',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'dostart_theme_primary_color',
					array(
						'label'    => esc_html__( 'Theme Primary Color', 'dostart' ),
						'section'  => 'dostart_theme_colors',
						'priority' => 10,
					)
				)
			);

			// Theme Title Color
			$wp_customize->add_setting(
				'dostart_theme_title_color',
				array(
					'default'           => '#212121',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'dostart_theme_title_color',
					array(
						'label'    => esc_html__( 'Theme Title Color', 'dostart' ),
						'section'  => 'dostart_theme_colors',
						'priority' => 10,
					)
				)
			);

			// Back To Top Background
			$wp_customize->add_setting(
				'dostart_backtotop_bg',
				array(
					'default'           => '#065FD4',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'dostart_backtotop_bg',
					array(
						'label'    => esc_html__( 'Back To Top Background', 'dostart' ),
						'section'  => 'dostart_theme_colors',
						'priority' => 10,
					)
				)
			);

			/*=======================================================================*/
			/* [ Header Panel ]
			/*=======================================================================*/

			$wp_customize->add_panel(
				'dostart_header',
				array(
					'priority'   => 19,
					'title'      => esc_html__( 'Header', 'dostart' ),
					'capability' => 'edit_theme_options',
				)
			);

			/*---------------------------------
			  [ Breadcrumb Section ]
			---------------------------------*/
			$wp_customize->add_section(
				'dostart_breadcrumb',
				array(
					'priority' => 30,
					'title'    => esc_html__( 'Breadcrumb', 'dostart' ),
					'panel'    => 'dostart_header',
				)
			);

			// Breadcrumb Background Color
			$wp_customize->add_setting(
				'dostart_breaccrumb_bg_color',
				array(
					'default'           => '#065fd4',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'dostart_breaccrumb_bg_color',
					array(
						'label'    => esc_html__( 'Breadcrumb Background Color', 'dostart' ),
						'section'  => 'dostart_breadcrumb',
						'priority' => 10,
					)
				)
			);

			// Breadcrumb Background Image
			$wp_customize->add_setting(
				'dostart_breaccrumb_bg_image',
				array(
					'default'           => '',
					'sanitize_callback' => 'esc_url_raw',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'dostart_breaccrumb_bg_image',
					array(
						'label'       => esc_html__( 'Breadcrumb Background Image', 'dostart' ),
						'description' => esc_html__( 'Set Background Image for Breadcrumb', 'dostart' ),
						'section'     => 'dostart_breadcrumb',
						'priority'     => 10,
					)
				)
			);

			// Breadcrumb Title Color
			$wp_customize->add_setting(
				'dostart_breadcrumb_title_color',
				array(
					'default'           => '#ffffff',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'dostart_breadcrumb_title_color',
					array(
						'label'       => esc_html__( 'Breadcrumb Title Color', 'dostart' ),
						'description' => esc_html__( 'Pick Breadcrumb Title Color Default: #ffffff', 'dostart' ),
						'section'     => 'dostart_breadcrumb',
						'priority'     => 10,
					)
				)
			);

			/*---------------------------------
			  [ Primary Menu Section ]
			---------------------------------*/
			$wp_customize->add_section(
				'dostart_primary_menu',
				array(
					'priority' => 30,
					'title'    => esc_html__( 'Primary Menu', 'dostart' ),
					'panel'    => 'dostart_header',
				)
			);

			// Primary Menu Color
			$wp_customize->add_setting(
				'dostart_primary_menu_color',
				array(
					'default'           => '#333',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'dostart_primary_menu_color',
					array(
						'label'    => esc_html__( 'Menu Text Color', 'dostart' ),
						'section'  => 'dostart_primary_menu',
						'priority' => 10,
					)
				)
			);

			// Menu Arrow Down Switch
			$wp_customize->add_setting(
				'dostart_menu_arrow_down',
				array(
					'default'           => true,
					'sanitize_callback' => 'wp_validate_boolean',
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				'dostart_menu_arrow_down',
				array(
					'label'       => esc_html__( 'Menu Icon', 'dostart' ),
					'section'     => 'dostart_primary_menu',
					'type'        => 'checkbox',
					'priority'     => 10,
				)
			);

			/*=======================================================================*/
			/* [ Footer Section ]
			/*=======================================================================*/

			$wp_customize->add_section(
				'dostart_footer',
				array(
					'priority' => 30,
					'title'    => esc_html__( 'Footer', 'dostart' ),
				)
			);

			// Footer Widget Background
			$wp_customize->add_setting(
				'dostart_footer_widget_bg',
				array(
					'default'           => '#2f2e2e',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'dostart_footer_widget_bg',
					array(
						'label'    => esc_html__( 'Footer Widget Background', 'dostart' ),
						'section' => 'dostart_footer',
						'priority' => 10,
					)
				)
			);

			// Footer Background
			$wp_customize->add_setting(
				'dostart_footer_bg',
				array(
					'default'           => '#222222',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'dostart_footer_bg',
					array(
						'label'    => esc_html__( 'Footer Background', 'dostart' ),
						'section' => 'dostart_footer',
						'priority' => 10,
					)
				)
			);

			// Footer Text Color
			$wp_customize->add_setting(
				'dostart_copyright_text_color',
				array(
					'default'           => '#666666',
					'sanitize_callback' => 'sanitize_hex_color',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'dostart_copyright_text_color',
					array(
						'label'    => esc_html__( 'Copyright Text Color', 'dostart' ),
						'section' => 'dostart_footer',
						'priority' => 10,
					)
				)
			);

			// Copyright Text
			$wp_customize->add_setting(
				'dostart_copyright_text',
				array(
					'default'           => esc_html__( '© Powered by WordPress 2020', 'dostart' ),
					'sanitize_callback' => 'wp_kses_post',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'dostart_copyright_text',
				array(
					'label'       => esc_html__( 'Copyright Text', 'dostart' ),
					'section'     => 'dostart_footer',
					'type'        => 'textarea',
					'priority'    => 10,
				)
			);

			/*=======================================================================*/
			/* [ Blog Panel ]
			/*=======================================================================*/

			$wp_customize->add_panel(
				'dostart_blog',
				array(
					'priority'   => 30,
					'title'      => esc_html__( 'Blog', 'dostart' ),
					'capability' => 'edit_theme_options',
				)
			);

			/*---------------------------------
			  [ Blog Basic Settings Section ]
			---------------------------------*/
			$wp_customize->add_section(
				'dostart_blog_basic_settings',
				array(
					'priority' => 30,
					'title'    => esc_html__( 'Settings', 'dostart' ),
					'panel'    => 'dostart_blog',
				)
			);

			// Blog/Archive Title
			$wp_customize->add_setting(
				'dostart_blog_or_archive_title',
				array(
					'default'           => 'Latest news',
					'sanitize_callback' => 'sanitize_text_field',
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				'dostart_blog_or_archive_title',
				array(
					'label'       => esc_html__( 'Blog / Archive Title Breadcrumb Title', 'dostart' ),
					'section'     => 'dostart_blog_basic_settings',
					'type'        => 'text',
					'priority'    => 10,
				)
			);

			// Blog Excerpt Length
			$wp_customize->add_setting(
				'dostart_blog_excerpt_length',
				array(
					'default'           => 42,
					'sanitize_callback' => 'absint',
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				'dostart_blog_excerpt_length',
				array(
					'label'       => esc_html__( 'Excerpt Length', 'dostart' ),
					'section'     => 'dostart_blog_basic_settings',
					'type'        => 'number',
					'input_attrs' => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
					'priority'    => 10,
				)
			);

			/*---------------------------------
			  [ Blog Details Section ]
			---------------------------------*/
			$wp_customize->add_section(
				'dostart_blog_details',
				array(
					'priority' => 30,
					'title'    => esc_html__( 'Blog Details', 'dostart' ),
					'panel'    => 'dostart_blog',
				)
			);

			// Blog Single Layout
			$wp_customize->add_setting(
				'dostart_blog_single_layout',
				array(
					'default'           => 'sidebar',
					'sanitize_callback' => 'dostart_sanitize_select',
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				'dostart_blog_single_layout',
				array(
					'label'       => esc_html__( 'Page Layout', 'dostart' ),
					'section'     => 'dostart_blog_details',
					'type'        => 'select',
					'choices'     => array(
						'full'    => esc_html__( 'Full Width', 'dostart' ),
						'sidebar' => esc_html__( 'Sidebar Layout', 'dostart' ),
					),
					'priority'    => 10,
				)
			);

			// Blog Navigation Switch
			$wp_customize->add_setting(
				'dostart_blog_navigation_switch',
				array(
					'default'           => true,
					'sanitize_callback' => 'wp_validate_boolean',
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				'dostart_blog_navigation_switch',
				array(
					'label'       => esc_html__( 'Post Navigation (Next/Previous)', 'dostart' ),
					'section'     => 'dostart_blog_details',
					'type'        => 'checkbox',
					'priority'    => 10,
				)
			);

			// Related Post Switch
			$wp_customize->add_setting(
				'dostart_blog_related_post',
				array(
					'default'           => false,
					'sanitize_callback' => 'wp_validate_boolean',
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				'dostart_blog_related_post',
				array(
					'label'       => esc_html__( 'Show Related Post', 'dostart' ),
					'section'     => 'dostart_blog_details',
					'type'        => 'checkbox',
					'priority'    => 10,
				)
			);

			// Related Post Title
			$wp_customize->add_setting(
				'dostart_related_post_title',
				array(
					'default'           => 'Related Post',
					'sanitize_callback' => 'sanitize_text_field',
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				'dostart_related_post_title',
				array(
					'label'           => esc_html__( 'Related Post Title', 'dostart' ),
					'section'         => 'dostart_blog_details',
					'type'            => 'text',
					'priority'        => 10,
					'active_callback' => function() {
						return get_theme_mod( 'dostart_blog_related_post', false );
					},
				)
			);

			// Related Post Limit
			$wp_customize->add_setting(
				'dostart_related_post_limit',
				array(
					'default'           => 3,
					'sanitize_callback' => 'absint',
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				'dostart_related_post_limit',
				array(
					'label'           => esc_html__( 'Blog Related Post Limit', 'dostart' ),
					'description'     => esc_html__( 'Related posts per page', 'dostart' ),
					'section'         => 'dostart_blog_details',
					'type'            => 'number',
					'input_attrs'     => array(
						'min'  => 1,
						'max'  => 4,
						'step' => 1,
					),
					'priority'        => 10,
					'active_callback' => function() {
						return get_theme_mod( 'dostart_blog_related_post', false );
					},
				)
			);

			// Blog Post Columns
			$wp_customize->add_setting(
				'dostart_blog_post_column',
				array(
					'default'           => '4',
					'sanitize_callback' => 'dostart_sanitize_select',
					'transport'         => 'refresh',
				)
			);

			$wp_customize->add_control(
				'dostart_blog_post_column',
				array(
					'label'           => esc_html__( 'Related Posts Per Row', 'dostart' ),
					'section'         => 'dostart_blog_details',
					'type'            => 'select',
					'choices'         => array(
						'12' => esc_html__( 'One Column', 'dostart' ),
						'6'  => esc_html__( 'Two Columns', 'dostart' ),
						'4'  => esc_html__( 'Three Columns', 'dostart' ),
						'3'  => esc_html__( 'Four Columns', 'dostart' ),
						'2'  => esc_html__( 'Six Columns', 'dostart' ),
					),
					'priority'        => 10,
					'active_callback' => function() {
						return get_theme_mod( 'dostart_blog_related_post', false );
					},
				)
			);
		}

		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		public function dostart_customize_preview_js() {
			wp_enqueue_script(
				'dostart-customizer',
				get_template_directory_uri() . '/assets/js/customizer.js',
				array( 'jquery', 'customize-preview' ),
				DOSTART_THEME_VERSION,
				true
			);
		}
	}
}

/**
 * Get list of Google Fonts
 *
 * @return array
 */
function dostart_get_google_fonts_list() {
	return array(
		'' => esc_html__( 'Default (System Font)', 'dostart' ),
		'Source Sans Pro' => 'Source Sans Pro',
		'Open Sans' => 'Open Sans',
		'Roboto' => 'Roboto',
		'Lato' => 'Lato',
		'Montserrat' => 'Montserrat',
		'Oswald' => 'Oswald',
		'Raleway' => 'Raleway',
		'PT Sans' => 'PT Sans',
		'Merriweather' => 'Merriweather',
		'Playfair Display' => 'Playfair Display',
		'Poppins' => 'Poppins',
		'Ubuntu' => 'Ubuntu',
		'Droid Sans' => 'Droid Sans',
		'Droid Serif' => 'Droid Serif',
		'Lora' => 'Lora',
		'Noto Sans' => 'Noto Sans',
		'Noto Serif' => 'Noto Serif',
		'Slabo 27px' => 'Slabo 27px',
		'Roboto Condensed' => 'Roboto Condensed',
		'Roboto Slab' => 'Roboto Slab',
		'PT Serif' => 'PT Serif',
		'Dancing Script' => 'Dancing Script',
		'Crimson Text' => 'Crimson Text',
		'Josefin Sans' => 'Josefin Sans',
		'Libre Baskerville' => 'Libre Baskerville',
		'Arimo' => 'Arimo',
		'Bitter' => 'Bitter',
		'Fira Sans' => 'Fira Sans',
		'Indie Flower' => 'Indie Flower',
		'Inconsolata' => 'Inconsolata',
		'Pacifico' => 'Pacifico',
		'Quicksand' => 'Quicksand',
		'Vollkorn' => 'Vollkorn',
		'Work Sans' => 'Work Sans',
		'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
		'Nunito' => 'Nunito',
		'Cabin' => 'Cabin',
		'Dosis' => 'Dosis',
		'Karla' => 'Karla',
		'Muli' => 'Muli',
		'PT Sans Narrow' => 'PT Sans Narrow',
		'Titillium Web' => 'Titillium Web',
		'Abel' => 'Abel',
		'Anton' => 'Anton',
		'Bebas Neue' => 'Bebas Neue',
		'Comfortaa' => 'Comfortaa',
		'Exo' => 'Exo',
		'Fjalla One' => 'Fjalla One',
		'Lobster' => 'Lobster',
		'Righteous' => 'Righteous',
		'Satisfy' => 'Satisfy',
		'Shadows Into Light' => 'Shadows Into Light',
		'Signika' => 'Signika',
		'Source Code Pro' => 'Source Code Pro',
		'Teko' => 'Teko',
		'Varela Round' => 'Varela Round',
	);
}

/**
 * Sanitize font choice
 *
 * @param string $input Input value.
 * @return string
 */
function dostart_sanitize_font_choice( $input ) {
	$fonts = dostart_get_google_fonts_list();
	if ( array_key_exists( $input, $fonts ) ) {
		return $input;
	}
	return 'Source Sans Pro'; // Default fallback
}

/**
 * Sanitize switch/checkbox value
 *
 * @param mixed $input Input value.
 * @return string
 */
function dostart_sanitize_switch( $input ) {
	if ( 'on' === $input || true === $input || 1 === $input ) {
		return 'on';
	}
	return 'off';
}

/**
 * Sanitize select value
 *
 * @param string $input Input value.
 * @param object $setting Setting object.
 * @return string
 */
function dostart_sanitize_select( $input, $setting = null ) {
	$input = sanitize_text_field( $input );
	if ( $setting ) {
		$choices = $setting->manager->get_control( $setting->id )->choices;
		if ( array_key_exists( $input, $choices ) ) {
			return $input;
		}
	}
	return $setting ? $setting->default : '';
}

/**
 * Initialize Customizer
 */
Dostart_Customizer::get_instance();
