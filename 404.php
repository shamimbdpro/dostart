<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package dostart
 */

if ( ! defined('ABSPATH') ) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="error-title">
                        <h1><?php esc_html_e('404', 'dostart'); ?></h1>
                    </div>
                    <h2><?php esc_html_e('PAGE NOT FOUND', 'dostart'); ?></h2>
                    <h3><?php esc_html_e('UNFORTUNATELY THE PAGE YOU WERE LOOKING FOR DOES NOT EXIST. MAYBE SEARCH CAN HELP.', 'dostart'); ?></h3>

                    <?php
                    get_search_form();
                    ?>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
