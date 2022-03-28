<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dostart
 */

if ( ! defined('ABSPATH') ) {
    exit; // Exit if accessed directly.
}

if ( ! is_active_sidebar('sidebar-1') ) {
    return;
}
?>
<div class="col-md-4 blog-sidebar">
	
    <?php do_action('dostart_before_sidebar');?>

    <?php dynamic_sidebar('sidebar-1'); ?>

    <?php do_action('dostart_after_sidebar');?>

</div>
