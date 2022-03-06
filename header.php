<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dostart
 */

if ( ! defined('ABSPATH') ) {
    exit; // Exit if accessed directly.
}

$dostart_google_analytics_id = get_theme_mod( 'dostart_google_analytics_id' );
$dostart_google_adsense_publisher_id = get_theme_mod( 'dostart_google_adsense_publisher_id' );

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>

    <?php if ( $dostart_google_analytics_id ) {?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($dostart_google_analytics_id); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', '<?php echo esc_attr($dostart_google_analytics_id); ?>');
    </script>
    <?php } ?>

    <?php if ( $dostart_google_adsense_publisher_id ) { ?>
    <!-- Google Adsense Code -->
    <script data-ad-client="ca-<?php echo esc_attr($dostart_google_adsense_publisher_id); ?>" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Google Adsense Code -->
    <?php } ?>


</head>

<body <?php body_class(); ?>>
    <?php
    if ( function_exists('wp_body_open') ) {
        wp_body_open();
    } else {
        do_action('wp_body_open');
    }
    ?>
    <div id="page-wrapper" class="site-wrapper <?php echo esc_html(false === get_theme_mod('dostart_theme_layout') ? '' : 'box-layout'); ?>">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'dostart'); ?></a>
        <?php do_action('dostart_before_header');?>
        <?php $header_layout = get_post_meta(get_the_ID(), 'dostart-header-status', true); ?>
        <?php if ( 'disabled' !== $header_layout ) { ?>
            <header class="dostart-header-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 logo_col">
                            <div class="site-logo">
                                <?php
                                if ( has_custom_logo() ) {
                                    the_custom_logo();
                                } ?>
                                <div class="site-text-logo">
                                    <?php if ( is_front_page() && is_home() ) :  ?>
                                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php echo esc_html(bloginfo('name')); ?></a></h1>
                                    <?php
                                    else :
                                    ?>
                                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php echo esc_html(bloginfo('name')); ?></a></h1>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 menu_col">
                            <div class="primary_header">
                                <a href="#" class="toggle"><span></span></a>
                                <div class="dostart-mainmenu">
                                    <nav class="nav-menu" id="site-navigation">
                                        <?php
                                        $theme_location = 'primary';
                                        if ( has_nav_menu($theme_location) ) {
                                            wp_nav_menu(
                                                array(
                                                    'theme_location' => $theme_location,
                                                    'menu_id' => 'primary-menu',
                                                    'walker'  => new Dostart_Nav_Walker(),
                                                )
                                            );
                                        } else {

                                            $dostart_fallback = array(
                                                'theme_location' => $theme_location,
                                            );
                                            wp_page_menu($dostart_fallback);
                                        }
                                        ?>
                                    </nav>
                                </div>
                            </div>

                            <?php if ( class_exists('WooCommerce') ) { ?>
                                <div class="dostart-wc-button">
                                    <!-- Woocommere Cart Icon -->
                                    <?php if ( function_exists('dostart_header_cart') ) { ?>
                                        <div class="dostart-header-cart">
                                            <?php dostart_header_cart(); ?>
                                        </div>
                                    <?php } ?>

                                    <div class="dostart-my-account-btn">
                                        <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>">
                                            <?php
                                            if ( is_user_logged_in() ) { ?>
                                                <span><?php esc_html_e('My Account', 'dostart'); ?></span>
                                            <?php } else {  ?>
                                                <span><?php esc_html_e('Login', 'dostart'); ?></span>
                                            <?php } ?>
                                        </a>
                                    </div> <!-- End my account button. -->
                                </div>
                            <?php } ?>

                        </div>

                    </div>
                </div>
            </header>
        <?php } ?>

        <?php do_action('dostart_after_header');?>

        <?php do_action('dostart_before_breadcrumb');?>
        <?php $breadcrumb_status = get_post_meta(get_the_ID(), 'dostart-breadcrumb-status', true);
        if ( ! is_page_template('custom-homepage.php') || is_page_template('404.php') ) {
            if ( 'disabled' !== $breadcrumb_status ) {
                dostart_breadcrumb_display();
            }
        }  ?>

        <?php do_action('dostart_after_breadcrumb');?>

        <div id="content" class="site-content">