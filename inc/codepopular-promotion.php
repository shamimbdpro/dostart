<?php

add_action( 'load-index.php', 
    function(){
      add_action( 'admin_notices', 'codepopular_promotions');
    }
);


if ( ! function_exists( 'codepopular_promotions' ) ) {
	/**
	 * Function to get dashboard widget data.
	 */
	function codepopular_promotions() { ?>
		<div class="notice notice-info is-dismissible">
			<p>Thank you for using dostart theme. You can make a amazing business website with this theme. The theme author available for freelance job. <a target="_blank" href="<?php echo esc_url_raw('https://codepopular.com/contact');?>"><button class="button-primary"><?php esc_html_e('Hire Me', 'dostart');?></button></a></p>
		</div>
		
	<?php }
}

