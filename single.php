<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dostart
 */

if ( ! defined('ABSPATH') ) {
    exit; // Exit if accessed directly.
}
$dostart_blog_details_post_navigation = get_theme_mod( 'dostart_blog_navigation_switch', true );
$page_layout = get_theme_mod('dostart_blog_single_layout') ? get_theme_mod('dostart_blog_single_layout') : 'sidebar';
get_header(); ?>

    <section class="section-padding">
        <div class="container">
            <div class="row <?php echo esc_attr('full' == $page_layout ? 'justify-content-center' : ''); ?>">
                <div class="col-md-8">
                    <?php
                    while ( have_posts() ) :
                        the_post();

                        do_action('before_single_post_content');

                        get_template_part(
                            'template-parts/content',
                            get_post_format()
                        );

                        do_action('after_single_post_content');

                        // Previous / Next Button.

                        if ( true == $dostart_blog_details_post_navigation ) {
                            the_post_navigation(
                                array(
                                    'prev_text' => esc_html__( '&#171; Previous Post', 'dostart' ),
                                    'next_text' => esc_html__( 'Next Post &#187;', 'dostart' ),
                                )
                            );
                        }
                            
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    endwhile; // End of the loop.
                    ?>
                </div>

                <?php if ( is_active_sidebar( 'sidebar-1' ) && 'sidebar' == $page_layout ) { ?>

                <?php get_sidebar(); ?>

                <?php } ?>


            </div>
        </div>

        <div class="container">
        <?php
            $related_post = get_theme_mod( 'dostart_blog_related_post', true );
            if ( true === $related_post ) {
                dostart_related_posts();
            }

            ?>
        </div>

    </section>

<?php
get_footer();
