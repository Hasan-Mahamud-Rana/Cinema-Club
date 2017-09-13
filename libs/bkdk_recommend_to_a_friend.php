<?php

function call_recommend_to_a_friend($customerid){

	$name =  $_POST['myname'];
  $email =  $_POST['email'];
  $message =  $_POST['message'];

if (is_present($name) && is_present($email) && is_present($customerid)) {

  $url = API_HOST . '/api/contacts/' . $customerid . '/invitations/';
  $body = array(
                  'invitation' =>
                    array (
                    'email' => $email,
                    'text' => $message,
                    'name' => $name
                  )
  );

  $response = fetch_bkdk_api_data($url, $body, 'post');
  $success = $response->success;
  //if ($success != true) {
    //wp_redirect(site_url().'/purchase/congratulations/');
  //}
  return $response;
	}
}
?>