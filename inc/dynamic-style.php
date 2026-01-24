<?php

/*
 * theme style
 */
if ( ! function_exists('dostart_dynamic_styles') ) {
    function dostart_dynamic_styles() {
        // primary color
        $dostart_primary_color = get_theme_mod('dostart_theme_primary_color', '');

        $dostart_title_color = get_theme_mod('dostart_theme_title_color', '');
        
        $primary_menu_color = get_theme_mod('dostart_primary_menu_color', '');

        // footer widget background
        $footer_widget_bg = get_theme_mod('dostart_footer_widget_bg', '');

        // footer background color
        $footer_bg = get_theme_mod('dostart_footer_bg', '');
        // footer copyright text color
        $dostart_copyright_text_color = get_theme_mod('dostart_copyright_text_color', '');

        // footer top background color
        $back_to_top_bg = get_theme_mod('dostart_backtotop_bg', '');

        // Typography settings
        $typography_font_family = get_theme_mod('dostart_typography_font_family', 'Source Sans Pro');
        $typography_font_size = get_theme_mod('dostart_typography_font_size', '16px');
        $typography_line_height = get_theme_mod('dostart_typography_line_height', '1.5');
        $typography_color = get_theme_mod('dostart_typography_color', '#666666');
        
        // If no font selected, use system font stack
        if ( empty( $typography_font_family ) ) {
            $font_family_css = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif';
        } else {
            // Escape font family for CSS (handle fonts with spaces)
            $font_family_css = '"' . esc_attr( $typography_font_family ) . '", sans-serif';
        }

        // Breadcrumb settings
        $breadcrumb_bg_color = get_theme_mod('dostart_breaccrumb_bg_color', '#065fd4');
        $breadcrumb_bg_image = get_theme_mod('dostart_breaccrumb_bg_image', '');
        $breadcrumb_title_color = get_theme_mod('dostart_breadcrumb_title_color', '#ffffff');

        ob_start();?>
        h1, h2, h3, h4, h5, h6{
            color: <?php echo esc_attr($dostart_title_color); ?>
        }
        .dostart-mainmenu ul li a{
            color: <?php echo esc_attr($primary_menu_color); ?>
        }
 
        .excerpt-readmore a,
        .back-to-top,
        .dostart-post .excerpt-date,
        .widget-title:before,
        .search-form:after,
        .comment-form p > input[type="submit"],
        .pagination .nav-links .page-numbers.current,
        .pagination .nav-links .page-numbers:hover,
		.search-form::before,
		.woocommerce ul.products li.product .onsale,
        .download-item-image .onsale,
        .preview-btn li a:hover,
        .button{
             background-color: <?php echo esc_attr($dostart_primary_color); ?> !important;
        }

        .preview-btn li a{
            border-color:<?php echo esc_attr($dostart_primary_color); ?> !important;
        }

        .preview-btn li a
        {
             color: <?php echo esc_attr($dostart_primary_color); ?>
        }
        .woocommerce-MyAccount-navigation ul li.is-active a{
            color:<?php echo esc_attr($dostart_primary_color); ?>
        }

        article a.dostart-btn {
            color: #fff;
        }
         header{
            background: url('<?php echo esc_url(header_image()); ?>');
        }
        body {
            font-family: <?php echo $font_family_css; ?>;
            font-size: <?php echo esc_attr($typography_font_size); ?>;
            line-height: <?php echo esc_attr($typography_line_height); ?>;
            color: <?php echo esc_attr($typography_color); ?>;
        }
        .dostart-breadcrumb {
            background-color: <?php echo esc_attr($breadcrumb_bg_color); ?>;
            <?php if ( ! empty($breadcrumb_bg_image) ) : ?>
            background-image: url('<?php echo esc_url($breadcrumb_bg_image); ?>');
            background-repeat: repeat;
            background-position: center center;
            background-size: cover;
            background-attachment: scroll;
            <?php endif; ?>
        }
        .breadcrumb-inner-content h1,
        .dostart-breadcrumb a,
        .dostart-breadcrumb li {
            color: <?php echo esc_attr($breadcrumb_title_color); ?>;
        }
        .footer-top-widgets{
            background: <?php echo esc_attr($footer_widget_bg); ?>;
        }
        .copyright-text p{
            color: <?php echo esc_attr($dostart_copyright_text_color); ?>
        }
        .dostart-footer-area{
            background-color: <?php echo esc_attr($footer_bg); ?>;
        }
        div.back-to-top{
            background: <?php echo esc_attr($back_to_top_bg); ?>
         }

        <?php
        $output = ob_get_clean();
        return $output;
    } //end  dostart_dynamic_styles
} //endif

function dostart_style_method() {

    $custom_css = dostart_dynamic_styles();
    wp_add_inline_style('dostart-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'dostart_style_method');

?>
