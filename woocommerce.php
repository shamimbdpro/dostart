<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dostart
 */

get_header(); ?>

<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php woocommerce_content(); ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
