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
                       <?php global $dostart_option;?>
                       <?php if ( empty($dostart_option['footer-text']) ) : ?>
                          <p> &copy; <?php esc_html_e(' Powered by ', 'dostart');?> <a target="_balnk" href="<?php echo esc_url('https://wordpress.org/'); ?>"><?php esc_html_e('WordPress', 'dostart');?></a> <?php echo esc_html(date_i18n(__('Y ', 'dostart'))); ?></p>
                       <?php else : ?>

                          <p><?php echo esc_html($dostart_option['footer-text']); ?></p>
                       <?php endif?>
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
