<?php 


add_filter( 'comment_form_fields', 'dostart_comment_field_to_bottom' );

/**
 * Comment Field to Bottom
 * @param $fields
 * @return mixed
 */
function dostart_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}


/**
 * Hide Dostart Theme Notice.
 */
add_action( 'wp_ajax_dostart_admin_notice_ajax_object_save', 'dostart_admin_notice_ajax_object_callback' );

function dostart_admin_notice_ajax_object_callback() {
   

	$data = isset($_POST['data']) ? sanitize_text_field(wp_unslash($_POST['data'])) : array();
	if ( $data ) {
		
		// Check valid request form user.
		check_ajax_referer('dostart_theme_notice_status');
	
		update_option('dostart_theme_notice', $data);  

		$response['message'] = 'sucess';
		wp_send_json_success($response);
	}

	wp_die();

}




