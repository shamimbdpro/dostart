<?php
if ( 1 != get_option('dostart_theme_notice') ) {
	add_action(
		'load-index.php',
		function () {
			add_action('admin_notices', 'codepopular_promotions');
		}
	);
}


if ( ! function_exists('codepopular_promotions') ) {

	/**
	 * Function to get dashboard widget data.
	 */
	function codepopular_promotions() { ?>
		<div class="notice notice-success is-dismissible hideThemeNotice">
			<div class="codepopular_notice">
				<h4>Thank you for using our theme Dostart!</h4>
				<p>We are glad that you are using our theme and we hope you are satisfied with it. If you want, you can support us in the development of the theme by buying us a coffee and adding a theme review. This is very important and gives us the opportunity to create even better tools for you. Thank you to everyone. </p>
				<div class="codepopular__buttons">
					<a href="https://ko-fi.com/codepopular" target="_blank" class="codepopular__button btn__green dashicons-heart">
						Buy us a coffee </a>
					<a href="https://wordpress.org/support/theme/dostart/reviews/#new-post" target="_blank" class="codepopular__button btn__yellow dashicons-star-filled">
						Add a theme review </a>

					<a href="https://codepopular.com/contact" target="_blank" class="codepopular__button btn__dark dashicons-email">Contact Us</a>
					<button type="button" id="hideDostarNotice" class="codepopular__button btn__blue dashicons-no">Hide and do not show again</button>
				</div>
			</div>

		</div>

<?php }
}
