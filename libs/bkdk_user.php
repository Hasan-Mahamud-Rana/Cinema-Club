<?php

$GLOBALS['customerid_name'] = 'customerid';
$GLOBALS['customerid'] = null;

function get_customerid() {
	$customerid = $GLOBALS['customerid'];
	if ( $customerid == NULL)  {
	  $customerid = $_COOKIE[$GLOBALS['customerid_name']];
	  if ( $customerid == NULL)  {
	  	$customerid = ' ';
	  }
	  $GLOBALS['customerid'] = $customerid;
	}
	return $customerid;
}

function set_customerid($v_value) {
   ob_start();
   setcookie( $GLOBALS['customerid_name'], $v_value, 30 * DAYS_IN_SECONDS, '/');
   $_COOKIE[$GLOBALS['customerid_name']] = $v_value;
   $GLOBALS['customerid'] = $v_value;
   ob_end_flush();
   return $v_value;
}

function is_bkdk_user_logged_in() {
	if (!in_array( get_customerid(), $GLOBALS['blank_values'])) {
		return true;
	}
	$username = $_POST['username'];
	$password = $_POST['password'];
	login_bkdk_user($username, $password, $currentlink);

	return !in_array( get_customerid(), $GLOBALS['blank_values']);
}

function register_bkdk_user($userid) {
  if ( !in_array( $userid, $GLOBALS['blank_values']) ) {
	  set_customerid($userid);
  }
}

function unregister_bkdk_user() {
	setcookie( $GLOBALS['customerid_name'], ' ', time() - 3600 );
	setcookie( $GLOBALS['customerid_name'], ' ', time() - 3600, '/');
}

function login_bkdk_user($username, $password, $currentlink) {

  if (!in_array($username, $GLOBALS['blank_values']) && !in_array($password, $GLOBALS['blank_values']) ) {

 		$url = API_HOST . '/api/login';
	  $body = array(
	      'username' => $username,
	      'password' => $password
	  );

	  $obj = fetch_bkdk_api_data( $url,  $body, 'post');
	  //var_dump($obj);
	  $success = $obj->success;

	  if ($success == true) {
	    register_bkdk_user($obj->contact->contactid);
	    $userDetails = get_user_info($obj->contact->contactid);
			$purchasable_flex_membership = $userDetails->purchasable_flex_membership;
			$active_flex_membership = $userDetails->active_flex_membership;
			if ($purchasable_flex_membership != true || $active_flex_membership == true) {
				reset_flex_cart();
			}
	    reset_login_information_error();
	    if ($currentlink != site_url().'/login/'){
	    	wp_redirect(site_url());
	    }
	    return get_customerid();
	  } else
	  {
		  $errors = $obj->errors;
		  $message = $obj->message;

			$credentials = $errors->credentials;
			$credentials = json_encode($credentials);

		store_login_information_error($message, $credentials);
	  	unregister_bkdk_user();
	  }
	}
}

function store_login_information_error($message, $credentials) {
	setcookie( 'loginErrorMessage', $message, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['loginErrorMessage'] = $message;

	setcookie( 'loginCredentials', $credentials, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['loginCredentials'] = $credentials;
}

function reset_login_information_error() {
	setcookie( 'loginErrorMessage', ' ', time() - 3600 );
	setcookie( 'loginErrorMessage', ' ', time() - 3600, '/');

	setcookie( 'loginCredentials', ' ', time() - 3600 );
	setcookie( 'loginCredentials', ' ', time() - 3600, '/');
}

?>