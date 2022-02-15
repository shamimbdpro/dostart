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
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
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

    <?php $header_layout = get_post_meta( get_the_ID(), 'dostart-header-status', true ); ?>
    <?php if ( 'disabled' !== $header_layout ) { ?>
    <header class="dostart-header-area">
        <div class="container">
            <div class="row" style="align-items:center">
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
                            <?php  endif;?>
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
                                    }else {

                                        $dostart_fallback = array(
                                            'theme_location' => $theme_location,
                                        );
                                        wp_page_menu($dostart_fallback);

                                    
                                    }
                                    ?>
                            </nav>
                        </div>
                    </div>


                    <div class="dostart-wc-button">
                    <!-- Woocommere Cart Icon -->
                    <?php if ( function_exists('dostart_header_cart') && class_exists('WooCommerce') ) { ?>
                            <div class="dostart-header-cart" >
                                <?php dostart_header_cart(); ?>
                            </div>  
                    <?php } ?>

                    <div class="dostart-my-account-btn">
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">
                            <?php
                            if ( is_user_logged_in() ) { ?>
                            <span><?php   esc_html_e('My Account', 'digicart'); ?></span>
                        <?php } else {  ?>
                            <span><?php   esc_html_e('Login', 'digicart'); ?></span>
                            <?php } ?>
                        </a>
                    </div> <!-- End my account button. -->
                    </div>

                </div>

            </div>
        </div>
    </header> 
    <?php } ?>

    <?php 
    $breadcrumb_status = get_post_meta( get_the_ID(), 'dostart-breadcrumb-status', true );
    if ( ! is_page_template( 'custom-homepage.php' ) || is_page_template( '404.php' ) ) {
        if('disabled' !== $breadcrumb_status){
            dostart_breadcrumb_display();
        }
	}  ?>

    <div id="content" class="site-content">
