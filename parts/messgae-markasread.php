<?php
if ( is_bkdk_user_logged_in() != true ) {
		wp_redirect(site_url().'/login/');
}
	$customerid = get_customerid();
$message_id = $_GET['message_id'];
if (!in_array( $message_id, $GLOBALS['blank_values'])) {
$message = mark_as_read( $customerid, $message_id);
}
?>