<?php

function call_for_reset_password() {
	$password = $_POST['password'];
	$password_confirmation = $_POST['password_confirmation'];
	return reset_bkdk_password($password, $password_confirmation);
}

function reset_bkdk_password($password, $password_confirmation) {
  if (!in_array($password, $GLOBALS['blank_values']) && !in_array($password_confirmation, $GLOBALS['blank_values']) ) {
	//echo 'API call<br/>';
  $body = array("contact" =>
							array(
							  'password' => $password,
							  'password_confirmation' => $password_confirmation
							)
	  );

	  $response = fetch_bkdk_api_data( 'https://biografklub.crd.dk/api/reset_pw/'.$_POST['token'],  $body, 'put');

	  $success = $response->success;

	  if ($success == true) {
	    register_bkdk_user( $response->contact->contactid);
	    reset_forgotten_error();
	    return get_customerid();
	  } else
	  {
			$message = $response->message;
    	$errors = $response->errors;
	      foreach($errors as $error){ 
	        $error; 
	      }
			store_forgotten_error($message, $errors, $email);
    	wp_redirect(site_url().'/forgotten-password/');
	  	unregister_bkdk_user();
	  	return null;
	  }
	}
}


function call_for_forgotten_password() {
	$email = $_POST['email'];
	return bkdk_forgotten_password($email);
}
function bkdk_forgotten_password($email) {
  if (!in_array($email, $GLOBALS['blank_values'])) {
	//echo 'API call for forgotten password<br/>';
  $body = array("contact" =>
							array(
							  'email' => $email
							)
	);
	$response = fetch_bkdk_api_data( 'https://biografklub.crd.dk/api/reset_pw/',  $body, 'post');

	  $success = $response->success;

	  if ($success == true) {
	    register_bkdk_user( $response->contact->contactid);
	    reset_forgotten_error();
	    return get_customerid();
	  } else {
	  	$message = $response->message;
    	$errors = $response->errors;
	   //var_dump($errors);
  foreach($errors as $error){ 
	        $error; 
	      }
			store_forgotten_error($message, $errors, $email);
    	wp_redirect(site_url().'/forgotten-password/');
	  	unregister_bkdk_user();
	  	return null;
	  }
	}
}

function store_forgotten_error($message, $errors, $email) {
  setcookie( 'storeForgottenErrorMessage', $message, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['storeForgottenErrorMessage'] = $message;

  setcookie( 'storeForgottenErrorErrors', $errors, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['storeForgottenErrorErrors'] = $errors;

  setcookie( 'storeForgottenErrorEmail', $email, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['storeForgottenErrorEmail'] = $email;
}

function reset_forgotten_error() {
  setcookie( 'storeForgottenErrorMessage', ' ', time() - 3600 );
  setcookie( 'storeForgottenErrorMessage', ' ', time() - 3600, '/');

  setcookie( 'storeForgottenErrorErrors', ' ', time() - 3600 );
  setcookie( 'storeForgottenErrorErrors', ' ', time() - 3600, '/');
	
	setcookie( 'storeForgottenErrorEmail', ' ', time() - 3600 );
  setcookie( 'storeForgottenErrorEmail', ' ', time() - 3600, '/');
}

?>