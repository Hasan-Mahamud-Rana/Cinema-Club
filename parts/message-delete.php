<?php
  if ( is_bkdk_user_logged_in() != true ) {
		wp_redirect(site_url().'/login/');
  }

  $message_id = $_GET['systemmessageid'];
  if (!in_array( $message_id, $GLOBALS['blank_values'])) {
    $message = delete_messages( get_customerid(), $message_id);
  }
?>