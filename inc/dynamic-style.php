<?php

/*
 * theme style
 */
if ( ! function_exists('dostart_dynamic_styles') ) {
    function dostart_dynamic_styles() {
        // primary color
        $dostart_primary_color    = empty(get_theme_mod('dostart_theme_primary_color')) ? '' : get_theme_mod('dostart_theme_primary_color');

        $dostart_title_color = empty(get_theme_mod('dostart_theme_title_color')) ? '' : get_theme_mod('dostart_theme_title_color');
        
        $primary_menu_color = empty(get_theme_mod('dostart_primary_menu_color')) ? '' : get_theme_mod('dostart_primary_menu_color');

        // footer widget background
        $footer_widget_bg = empty(get_theme_mod('dostart_footer_widget_bg')) ? '' : get_theme_mod('dostart_footer_widget_bg');

        // footer background color
        $footer_bg = empty(get_theme_mod('dostart_footer_bg')) ? '' : get_theme_mod('dostart_footer_bg');
        // footer copyright text color
        $dostart_copyright_text_color = empty(get_theme_mod('dostart_copyright_text_color')) ? '' : get_theme_mod('dostart_copyright_text_color');

        // footer top background color
        $back_to_top_bg = empty(get_theme_mod('dostart_backtotop_bg')) ? '' : get_theme_mod('dostart_backtotop_bg');

        ob_start();?>
        h1, h2, h3, h4, h5, h6{
            color: <?php echo esc_attr($dostart_title_color); ?>
        }
        .dostart-mainmenu ul li a{
            color: <?php echo esc_attr($primary_menu_color); ?>
        }
        .dostart-breadcrumb-area,
        .dostart-breadcrumb-bg,
        article a.dostart-btn,
        .widget-title:after,
        .widgettitle:after,
        .search-form:after,
        .dostart-single-blog-breadcrumb:before,
        .comment-form p > input[type="submit"],
        .pagination .nav-links .page-numbers.current,
        .pagination .nav-links .page-numbers:hover,
		.search-form::before,
		.woocommerce ul.products li.product .onsale,
        .button{
             background-color: <?php echo esc_attr($dostart_primary_color); ?> !important;
        }
        article.post a,
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
