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

if ( ! defined( 'ABSPATH' ) ) {
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
    <div id="page-wrapper" class="site-wrapper <?php echo esc_html( get_theme_mod('dostart_theme_layout') === '1' ? 'box-layout' : '' ); ?>">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'dostart'); ?></a>
    <header class="dostart-header-area">
        <div class="dostart-main-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 logo_col">     
                        <div class="site-logo">
                            <?php
                            if ( has_custom_logo() ) {
                                 the_custom_logo();
                            } ?>
                            <div class="site-text-logo">
                                <?php if ( is_front_page() && is_home() ) :  ?>
                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( bloginfo( 'name' ) ); ?></a></h1>
                                <?php
                                else :
                                ?>
                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( bloginfo( 'name' ) ); ?></a></h1>
                                <?php  endif;
                                $dostart_description = get_bloginfo( 'description', 'display' );
                                if ( $dostart_description || is_customize_preview() ) : ?>
                                <p class="site-description"><?php echo esc_html( $dostart_description );?></p>
                               <?php endif; ?>
                            </div>
                        </div>                            
                    </div>
                      <div class="col-md-9 menu_col">
                         <a href="#" class="toggle"><span></span></a>
                         <div class="mainmenu">
                              <nav class="nav-menu" id="site-navigation">
                                 <?php
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'primary',
                                            'menu_id' => 'primary-menu',
                                            'walker'         => new Dostart_Nav_Walker(),
                                        )
                                    );
                                    ?>
                              </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header> 
    <div id="content" class="site-content">
