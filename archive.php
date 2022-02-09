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

    <div class="dostart-breadcrumb-area blog-breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    the_archive_title('<h1 class="page-title">', '</h1>');
                    the_archive_description('<div class="archive-description">', '</div>');
                    ?>
                  
                </div>
            </div>
        </div>
    </div>

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

                        endwhile;

                        // Previous / Next Button.

                        the_post_navigation(
                                array(
                                    'prev_text' => esc_html__( '&#171; Previous Post', 'dostart' ),
                                    'next_text' => esc_html__( 'Next Post &#187;', 'dostart' ),
                                )
                            );

                        else :

                            get_template_part('template-parts/content', 'none');

                        endif; ?>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>

<?php
get_footer();

