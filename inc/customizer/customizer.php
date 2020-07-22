<?php

/**
 * dostart Theme Customizer
 *
 * @package dostart
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Customizer Loader
 */
if (!class_exists('Dostart_Customizer')) {

    /**
     * Declear Class
     */
    class Dostart_Customizer
    {

        /**
         * Instance
         *
         * @access private
         * @var object
         */
        private static $instance;

        /**
         * making instatance of the class
         */
        public static function get_instance()
        {
            if (!isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Constructor
         */
        public function __construct()
        {
            add_action('customize_preview_init', array($this, 'dostart_customize_preview_js'));
            add_action('customize_register', array($this, 'dostart_customize_register'));
        }

        /**
         * Add postMessage support for site title and description for the Theme Customizer.
         *
         * @param WP_Customize_Manager $wp_customize Theme Customizer object.
         */

        public function dostart_customize_register($wp_customize)
        {

            if (isset($wp_customize->selective_refresh)) {
                $wp_customize->selective_refresh->add_partial(
                    'blogname',
                    array(
                        'selector' => '.site-title a',
                    )
                );
                $wp_customize->selective_refresh->add_partial(
                    'blogdescription',
                    array(
                        'selector' => '.site-description',
                    )
                );
            }

            /**
             * Move Default Section
             */
            $wp_customize->get_section('header_image')->panel     = 'dostart_header';
            $wp_customize->get_section('colors')->panel           = 'dostart_general_settings';
            $wp_customize->get_section('title_tagline')->panel    = 'dostart_header';
            $wp_customize->get_section('background_image')->panel = 'dostart_general_settings';

            /**
             * List of sections
             * 1. dostart_general_settings
             * 2. dostart_footer
             * 3. dostart_social_icons
             */

            /*=======================================================================*/
            /* [ General Customizer ]
            /*=======================================================================*/
            $wp_customize->add_panel('dostart_general_settings', array(
                'title'    => 'General Settings',
                'priority' => 30,
            ));

            // [----Theme Primary Color |  Subsection | colors ----- ]
            $wp_customize->add_setting('dostart_theme_primary_color', array(
                'default'           => '#0052a5',
                'sanitize_callback' => array($this, 'dostart_sanitize_color'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dostart_theme_primary_color', array(
                'label'    => __('Theme Primary Color', 'dostart'),
                'section'  => 'colors',
                'settings' => 'dostart_theme_primary_color',
                'type'     => 'color',
            )
            ));

            // [----THeme Title Color |  Subsection | colors ----- ]
            $wp_customize->add_setting('dostart_theme_title_color', array(
                'default'           => '#212121',
                'sanitize_callback' => array($this, 'dostart_sanitize_color'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dostart_theme_title_color', array(
                'label'    => __('Theme Title color', 'dostart'),
                'section'  => 'colors',
                'settings' => 'dostart_theme_title_color',
                'type'     => 'color',
            )
            ));

            // [----Back To Top Background |  Subsection | colors ----- ]
      
            $wp_customize->add_setting('dostart_backtotop_bg', array(
                'default'           => '#0052a5',
                'sanitize_callback' => array($this, 'dostart_sanitize_color'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dostart_backtotop_bg', array(
                'label'    => __('Back To Top Background', 'dostart'),
                'section'  => 'colors',
                'settings' => 'dostart_backtotop_bg',
                'type'     => 'color',
            )
            ));

         	
            /*------------------------------------------------------------------------*/
            /* [ Container ]
            /*------------------------------------------------------------------------*/
            $wp_customize->add_section('dostart_basic_settings', array(
                'title'    => __('Basic Settings', 'dostart'),
                'priority' => 20,
                'panel'    => 'dostart_general_settings',
            ));

            // [ Theme Layout ]
              
            $wp_customize->add_setting('dostart_theme_layout', array(
                'default'           => 0,
                'sanitize_callback' => array($this, 'dostart_sanitize_select'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dostart_theme_layout', array(
                'label'    => __('Theme Box Layout', 'dostart'),
                'section'  => 'dostart_basic_settings',
                'settings' => 'dostart_theme_layout',
                'type'     => 'select',
                'choices'  => array(
                    1 => __('Enabled', 'dostart'),
                    0 => __('Disabled', 'dostart'),
                ),
            )
            ));

            /*========================================================================*/
            /* [ Header Customizer ]
            /*========================================================================*/

            $wp_customize->add_panel('dostart_header', array(
                'title'    => 'Header',
                'priority' => 30,
            ));

            /*------------------------------------------------------------------------*/
            /* [ Primary Menu ] 
            /*------------------------------------------------------------------------*/

            $wp_customize->add_section('dostart_primary_menu', array(
                'title'    => __( 'Primary Menu', 'dostart' ),
                'priority' => 1,
                'panel'    => 'dostart_header',
            ));
            // [ Primary Menu Color ]
            $wp_customize->add_setting('dostart_primary_menu_color', array(
                'default' => '#333333',
                'sanitize_callback' => array($this, 'dostart_sanitize_color'),
            ));
            $wp_customize->add_control('dostart_primary_menu_color', array(
                'label'   => __( 'Primary Menu Color', 'dostart' ),
                'section' => 'dostart_primary_menu',
                'type'    => 'color',
            )
            );
              // [ Primary Menu Color ]
            $wp_customize->add_setting('dostart_menu_arrow_down', array(
                'default' => 1,
               'sanitize_callback' => array($this, 'dostart_sanitize_select'),
            ));
            $wp_customize->add_control('dostart_menu_arrow_down', array(
                'label'   => __( 'Menu Dropdown Arrow', 'dostart' ),
                'section' => 'dostart_primary_menu',
                'type'    => 'select',
                'choices' => array(
                    1 => __('Show', 'dostart'),
                    0 => __('Hide', 'dostart'),
                ),
            )
            );

            /*=======================================================================-*/
            /* [ Footer Customizer ]
            /*========================================================================*/
            $wp_customize->add_section('dostart_footer', array(
                'title'    => __('Footer', 'dostart'),
                'priority' => 30,
            ));

            // [ Footer Widget Background ]
            $wp_customize->add_setting('dostart_footer_widget_bg', array(
                'default'           => '#2f2e2e',
                'sanitize_callback' => array($this, 'dostart_sanitize_color'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dostart_footer_widget_bg', array(
                'label'    => __('Footer Widget Background', 'dostart'),
                'section'  => 'dostart_footer',
                'settings' => 'dostart_footer_widget_bg',
                'type'     => 'color',
            )
            ));

            // [ Footer Background ]
            $wp_customize->add_setting('dostart_footer_bg', array(
                'default'           => '#222222',
                'sanitize_callback' => array($this, 'dostart_sanitize_color'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dostart_footer_bg', array(
                'label'    => __('Footer Background', 'dostart'),
                'section'  => 'dostart_footer',
                'settings' => 'dostart_footer_bg',
                'type'     => 'color',
            )
            ));

            // [ Copyright Text ]
            $wp_customize->add_setting('dostart_copyright_text', array(
                'default'           => '© Powered by WordPress 2020',
                'transport'         => 'postMessage',
                'sanitize_callback' => array($this, 'dostart_sanitize_text_field'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dostart_copyright_text', array(
                'label'    => __('Copyright Text', 'dostart'),
                'section'  => 'dostart_footer',
                'settings' => 'dostart_copyright_text',
            )
            ));

            $wp_customize->selective_refresh->add_partial(
                'dostart_copyright_text',
                array(
                    'selector' => '.copyright-text',
                )
            );

            /*=========================================================================*/
            /* [ Social Media Customizer ]
            /*=========================================================================*/
            $wp_customize->add_section('dostart_social_icons', array(
                'title'       => __('Social Media Icons', 'dostart'),
                'description' => __('Social Media links', 'dostart'),
                'priority'    => 30,
                'panel'		  => 'dostart_general_settings'
            ));

            // Setting & control facebook icon
            $wp_customize->add_setting('dostart_social_facebook', array(
                'default'           => '',
                'sanitize_callback' => array($this, 'dostart_esc_url_raw'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dostart_social_facebook', array(
                'label'    => __('Enter facebook link', 'dostart'),
                'section'  => 'dostart_social_icons',
                'settings' => 'dostart_social_facebook',
                'type'     => 'url',
            )
            ));

            // Setting & control twitter icon
            $wp_customize->add_setting('dostart_social_twitter', array(
                'default'           => '',
                'sanitize_callback' => array($this, 'dostart_esc_url_raw'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dostart_social_twitter', array(
                'label'    => __('Enter twitter link', 'dostart'),
                'section'  => 'dostart_social_icons',
                'settings' => 'dostart_social_twitter',
            )
            ));

            // Setting & control youtube icon
            $wp_customize->add_setting('dostart_social_youtube', array(
                'default'           => '',
                'sanitize_callback' => array($this, 'dostart_esc_url_raw'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dostart_social_youtube', array(
                'label'    => __('Enter youtube link', 'dostart'),
                'section'  => 'dostart_social_icons',
                'settings' => 'dostart_social_youtube',
            )
            ));

            // Setting & control google plus icon
            $wp_customize->add_setting('dostart_social_pinterest', array(
                'default'           => '',
                'sanitize_callback' => array($this, 'dostart_esc_url_raw'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dostart_social_pinterest', array(
                'label'    => __('Enter pinterest link', 'dostart'),
                'section'  => 'dostart_social_icons',
                'settings' => 'dostart_social_pinterest',
            )
            ));

            // Setting & control behance icon
            $wp_customize->add_setting('dostart_social_behance', array(
                'default'           => '',
                'sanitize_callback' => array($this, 'dostart_esc_url_raw'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dostart_social_behance', array(
                'label'    => __('Enter behance link', 'dostart'),
                'section'  => 'dostart_social_icons',
                'settings' => 'dostart_social_behance',
            )
            ));

            // Setting & control linkedin icon
            $wp_customize->add_setting('dostart_social_linkedin', array(
                'default'           => '',
                'sanitize_callback' => array($this, 'dostart_esc_url_raw'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dostart_social_linkedin', array(
                'label'    => __('Enter linkedin link', 'dostart'),
                'section'  => 'dostart_social_icons',
                'settings' => 'dostart_social_linkedin',
            )
            ));

            // Setting & control instagram icon
            $wp_customize->add_setting('dostart_social_instagram', array(
                'default'           => '',
                'sanitize_callback' => array($this, 'dostart_esc_url_raw'),
            ));

            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'dostart_social_instagram', array(
                'label'    => __('Enter instagram link', 'dostart'),
                'section'  => 'dostart_social_icons',
                'settings' => 'dostart_social_instagram',
            )
            ));

            $wp_customize->selective_refresh->add_partial(
                'dostart_social_facebook',
                array(
                    'selector' => '.footer-social-icon',
                )
            );

        }

        /*--------------------------------------
         * [ Sanitization ]
        /*-------------------------------------*/

        public function dostart_sanitize_checkbox($checked)
        {
            // Boolean check.
            return ((isset($checked) && true == $checked) ? true : false);
        }

        public function dostart_sanitize_text_field($str)
        {
            $filtered = _sanitize_text_fields($str, false);
            return apply_filters('sanitize_text_field', $filtered, $str);
        }

        public function dostart_sanitize_select($input, $setting)
        {
            // Ensure input is a slug.
            $input = sanitize_key($input);

            // Get list of choices from the control associated with the setting.
            $choices = $setting->manager->get_control($setting->id)->choices;

            // If the input is a valid key, return it; otherwise, return the default.
            return (array_key_exists($input, $choices) ? $input : $setting->default);
        }

        public function dostart_sanitize_color($color)
        {
            if (empty($color) || is_array($color)) {
                return '';
            }

            // If string does not start with 'rgba', then treat as hex.
            // sanitize the hex color and finally convert hex to rgba
            if (false === strpos($color, 'rgba')) {
                return sanitize_hex_color($color);
            }

            // By now we know the string is formatted as an rgba color so we need to further sanitize it.
            $color = str_replace(' ', '', $color);
            sscanf($color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha);

            return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
        }

        public function dostart_esc_url_raw($url, $protocols = null)
        {
            return esc_url($url, $protocols, 'db');
        }

        /**
         * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
         */
        public function dostart_customize_preview_js()
        {
            wp_enqueue_script('dostart-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
        }

    }
}

/**
 *  calling class by get_instance()
 */

Dostart_Customizer::get_instance();