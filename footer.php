<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dostart
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

?>

    </div><!-- #content -->
    <footer id="colophon" class="dostart-site-footer">
        <?php if ( is_active_sidebar('footer-widgets') ) : ?>
        <div class="footer-top-widgets">
            <div class="container">
                <div class="row">
                    <?php dynamic_sidebar('footer-widgets');?>
                </div>
            </div>
        </div>
        <?php endif;?>

        <div class="dostart-footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                      <div class="footer-social-icon">
                        <ul> 
                          <?php  
                            $social_facebook   = get_theme_mod( 'dostart_social_facebook' );
                            $social_twitter    = get_theme_mod( 'dostart_social_twitter' );
                            $social_youtube    = get_theme_mod( 'dostart_social_youtube' );
                            $social_pinteres   = get_theme_mod( 'dostart_social_pinterest' );
                            $social_behance    = get_theme_mod( 'dostart_social_behance' );
                            $social_linkedin   = get_theme_mod( 'dostart_social_linkedin' );
                            $social_instagram  = get_theme_mod( 'dostart_social_instagram' );
                           ?>
                           <!-- facebook -->
                           <?php if ( ! empty($social_facebook) ) : ?>
                               <li><a href="<?php echo esc_url( $social_facebook ); ?>"><i class="fa fa-facebook"></i></a></li>
                           <?php endif ?>

                            <!-- twitter -->
                           <?php if ( ! empty($social_twitter) ) : ?>
                               <li><a href="<?php echo esc_url( $social_twitter ); ?>"><i class="fa fa-twitter"></i></a></li>
                           <?php endif ?>

                            <!-- youtube -->
                           <?php if ( ! empty($social_youtube) ) : ?>
                               <li><a href="<?php echo esc_url( $social_youtube ); ?>"><i class="fa fa-youtube"></i></a></li>
                           <?php endif ?>

                           <!-- pinterest -->
                           <?php if ( ! empty($social_pinteres) ) : ?>
                               <li><a href="<?php echo esc_url( $social_pinteres ); ?>"><i class="fa fa-pinterest"></i></a></li>
                           <?php endif ?>

                           <!-- behance -->
                           <?php if ( ! empty($social_behance) ) : ?>
                               <li><a href="<?php echo esc_url( $social_behance ); ?>"><i class="fa fa-behance"></i></a></li>
                           <?php endif ?>
 
                           <!-- linkedin -->
                           <?php if ( ! empty($social_linkedin) ) : ?>
                               <li><a href="<?php echo esc_url( $social_linkedin ); ?>"><i class="fa fa-linkedin"></i></a></li>
                           <?php endif ?>


                           <!-- linkedin -->
                           <?php if ( ! empty($social_instagram) ) : ?>
                               <li><a href="<?php echo esc_url( $social_instagram ); ?>"><i class="fa fa-instagram"></i></a></li>
                           <?php endif ?>


                        </ul>
                      </div>
                      <div class="copyright-text">
                         <?php global $dostart_option;?>
                         <?php if ( empty(get_theme_mod('dostart_copyright_text')) ) : ?>
                            <p> &copy; <?php esc_html_e(' Powered by ', 'dostart');?> <a target="_balnk" href="<?php echo esc_url('https://wordpress.org/'); ?>"><?php esc_html_e('WordPress', 'dostart');?></a> <?php echo esc_html(date_i18n(__('Y ', 'dostart'))); ?></p>
                         <?php else : ?>

                            <p><?php echo esc_html(get_theme_mod('dostart_copyright_text')); ?></p>
                         <?php endif?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- #colophon -->
</div><!-- #page wrapper-->

<div class="back-to-top"><i class="fa fa-angle-up"></i></div>
</div><!-- #page -->
<?php wp_footer();?>
</body>
</html>
