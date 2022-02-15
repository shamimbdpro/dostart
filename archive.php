<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dostart
 */

if ( ! defined('ABSPATH') ) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

    <div class="dostart-internal-area dostart-v-composer-disabled">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php
                    if ( have_posts() ) : ?>
                        <?php
                        /* Start the Loop */
                        while ( have_posts() ) : the_post();

                            /*
                            * Include the Post-Format-specific template for the content.
                            * If you want to override this in a child theme, then include a file
                            * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                            */
                            get_template_part('template-parts/content', get_post_format());

                        endwhile; ?>

                        <div class="text-center">
                           <?php
                           the_posts_pagination(
                               array(
                                   'mid_size'  => 2,
                                   'prev_text' => esc_html__( '&#10094; Prev', 'dostart' ),
                                   'next_text' => esc_html__( 'Next &#10095;', 'dostart' ),
                               )
                           );
                           ?>
                        </div>
   
                        <?php else :

                            get_template_part('template-parts/content', 'none');

                        endif; ?>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>

<?php
get_footer();

