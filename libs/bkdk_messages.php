<?php

function get_all_messages($customerid) {
  $url = API_HOST . '/api/contacts/' . $customerid . '/messages';
  $body = null;

  $response = fetch_bkdk_api_data($url, $body); # , $method = 'get' );
  return $response->system_messages;
}

function mark_as_read($customerid, $messageid) {
  $url = API_HOST . '/api/contacts/' . $customerid . '/messages/' . $messageid;
  $body =  array("system_message" => array("read" => true));

  $response = fetch_bkdk_api_data($url, $body, 'put' );
  return $response->system_message;
}

function delete_messages($customerid, $messageid) {
  $url = API_HOST . '/api/contacts/' . $customerid . '/messages/' . $messageid;
  $body = null;

  $response = fetch_bkdk_api_data($url, $body, 'delete' );

  $success = $response->success;
  if ($success != true) {
    return NULL;
  } else {
    wp_redirect(site_url().'/messages/');
  }
  return $response->system_message;
}
?>