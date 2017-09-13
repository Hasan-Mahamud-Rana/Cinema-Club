<?php
define("FB_HOST", "https://graph.facebook.com/oauth/authorize?client_id=453365598200378&redirect_uri=http://test.bordingvista.com/BiografklubDK/fb-redirect/&scope=public_profile,email,user_birthday&type=user_agent&fields=id,first_name,last_name,email,gender,birthday");

function fb_login($accessToken) {
	$accessToken =  $_GET['access_token'];

	if (is_present($accessToken)) {
	$url = API_HOST . '/api/auth/facebook/callback?access_token=' . $accessToken;
	$json = file_get_contents($url);
	$obj = json_decode($json);

	$success = $obj->success;

		if ($success == true) {
			$userDetails = get_user_info($obj->contact->contactid);
			$createFlow = $userDetails->create_flow;
			$dataMissing = $userDetails->data_missing;
			if($createFlow == false){
	     register_bkdk_user($obj->contact->contactid);
	     wp_redirect(site_url().'/movies/');
	    }
	    if($createFlow == true){
	     wp_redirect(site_url().'/create-profile/step-fb/?access_token=' . $accessToken);
	    } elseif ($dataMissing == true) {
	     wp_redirect(site_url().'/profile/personal-information-fb/?access_token=' . $accessToken);
	    }
		}
	}
	return $obj;
}

function fb_login_steps($accessToken) {
	$accessToken =  $_GET['access_token'];
	if (is_present($accessToken)) {
		$url = API_HOST . '/api/auth/facebook/callback?access_token=' . $accessToken;
		$json = file_get_contents($url);
		$obj = json_decode($json);
	}
	return $obj;
}

function call_for_update_profile_fb($contactid) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$address = $_POST['address'];
	$postnumber = $_POST['postnumber'];
	$by = $_POST['postdistrict'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];
	$password_confirmation = $_POST['password_confirmation'];
	$currentlink = $_POST['currentlink'];

	return bkdk_update_profile_fb($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $password, $password_confirmation, $currentlink, $contactid);
}
function bkdk_update_profile_fb($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $password, $password_confirmation, $currentlink, $contactid) {
if (is_present($firstname) && is_present($lastname) && is_present($address) && is_present($postnumber) && is_present($by) && is_present($email) && is_present($currentlink)  && is_present($contactid) ) {

	$url = API_HOST . '/api/contacts/' . $contactid;
  $body = array("contact" =>
								array(
									'firstname' => $firstname,
									'lastname' => $lastname,
									'address' => $address,
									'postnumber' => $postnumber,
									'postdistrict' => $by,
									'email' => $email,
									'phone' => $phone,
									'password' => $password,
									'password_confirmation' => $password_confirmation
								)
	);

	$obj = fetch_bkdk_api_data($url, $body, 'put');
	$success = $obj->success;
	if ($success == true) {
		reset_public_information();
		register_bkdk_user($contactid);

		$brochureproductid = $_POST['brochureproductid'];
		if (!empty($brochureproductid)){
			call_order_brochure($obj->contact->contactid, $basketTotalcost);
		}
		return get_customerid();
	} else
	{
		$errorMessage = $obj->message;
		$errorReport = $obj->errors;

		$errorFirstname = $errorReport->firstname;
		$errorFirstname = json_encode($errorFirstname);

		$errorLastname = $errorReport->lastname;
		$errorLastname = json_encode($errorLastname);

		$errorPostnumber = $errorReport->postnumber;
		$errorPostnumber = json_encode($errorPostnumber);

		$errorPostdistrict = $errorReport->postdistrict;
		$errorPostdistrict = json_encode($errorPostdistrict);

		$errorPhone = $errorReport->phone;
		$errorPhone = json_encode($errorPhone);

		$errorEmail = $errorReport->email;
		$errorEmail = json_encode($errorEmail);

		$errorPassword = $errorReport->password;
		$errorPassword = json_encode($errorPassword);

		$errorPasswordConfirmation = $errorReport->password_confirmation;
		$errorPasswordConfirmation = json_encode($errorPasswordConfirmation);

		$errorEncryptedPassword = $errorReport->encrypted_password;
		$errorEncryptedPassword = json_encode($errorEncryptedPassword);

		store_user_public_information_error($errorMessage, $errorFirstname, $errorLastname, $errorPostnumber, $errorPostdistrict, $errorPhone, $errorEmail, $errorPassword, $errorPasswordConfirmation, $errorEncryptedPassword);
		wp_redirect($currentlink);
		return null;
	}
	}
}

function facebook_disconnect($remove_fb_login, $customerid) {
	$remove_fb_login =  $_GET['remove_fb_login'];

	if (is_present($remove_fb_login) && is_present($customerid)) {
		$body = array("contact" =>
									array(
										'remove_fb_login' => $remove_fb_login
										)
		);
		$url = API_HOST . '/api/contacts/' . $customerid;

		$response = fetch_bkdk_api_data($url, $body, 'put');
	  $success = $response->success;
		if ($success != true) {
			wp_redirect(site_url() . '/profile/personal-information/');
			return null;
		} else {
			wp_redirect(site_url() . '/profile/personal-information/');
		}
		return $response->contact;
	}
}

function fb_login_with_id($accessToken, $customerid){
	$accessToken =  $_GET['token'];

	if (is_present($accessToken) && is_present($customerid)) {
	$url = API_HOST . '/api/auth/facebook/callback?access_token=' . $accessToken . '&contactid=' . $customerid;

	$json = file_get_contents($url);
	$obj = json_decode($json);

	  $success = $obj->success;
		if ($success != true) {
			wp_redirect(site_url() . '/profile/personal-information/');
			return null;
		} else {
			wp_redirect(site_url() . '/profile/personal-information/');
		}
	}
}


function call_facebook_update_profile($contactid) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $address = $_POST['address'];
  $postnumber = $_POST['postnumber'];
  $by = $_POST['postdistrict'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $gender = $_POST['gender'];
  $birth_day = $_POST['birth_day'];
  if (is_present($birth_day)) {
    settype($birth_day, "integer");
  }

  $birth_month = $_POST['birth_month'];
  if (is_present($birth_month)) {
    settype($birth_month, "integer");
  }

  $birth_year = $_POST['birth_year'];
  if (is_present($birth_year)) {
    settype($birth_year, "integer");
  }

  $receivegeneralnewsletter = $_POST['receivegeneralnewsletter'];
  $receivegeneralnewsletter = (isset($receivegeneralnewsletter))?$receivegeneralnewsletter:'0';

	return facebook_update_profile($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $gender, $birth_day, $birth_month, $birth_year, $receivegeneralnewsletter, $contactid);
}
function facebook_update_profile($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $gender, $birth_day, $birth_month, $birth_year, $receivegeneralnewsletter, $contactid) {
if (is_present($firstname) && is_present($lastname) && is_present($address) && is_present($postnumber) && is_present($by) && is_present($email) && is_present($phone) && is_present($contactid)) {

	$body = array("contact" =>
								array(
									'firstname' => $firstname,
									'lastname' => $lastname,
									'address' => $address,
									'postnumber' => $postnumber,
									'postdistrict' => $by,
									'email' => $email,
									'phone' => $phone,
									'gender' => $gender,
									'birth_day' => $birth_day,
									'birth_month' => $birth_month,
									'birth_year' => $birth_year,
									'receivegeneralnewsletter' => $receivegeneralnewsletter
								)
	);

	$url = API_HOST . '/api/contacts/' . $contactid ;

	$response = fetch_bkdk_api_data($url, $body, 'put' );
	//var_dump($response);

  $success = $response->success;
	if ($success != true) {

		$errorMessage = $response->message;
		$errorReport = $response->errors;

		$errorFirstname = $errorReport->firstname;
		$errorFirstname = json_encode($errorFirstname);

		$errorLastname = $errorReport->lastname;
		$errorLastname = json_encode($errorLastname);

		$errorPostnumber = $errorReport->postnumber;
		$errorPostnumber = json_encode($errorPostnumber);

		$errorPostdistrict = $errorReport->postdistrict;
		$errorPostdistrict = json_encode($errorPostdistrict);

		$errorPhone = $errorReport->phone;
		$errorPhone = json_encode($errorPhone);

		$errorEmail = $errorReport->email;
		$errorEmail = json_encode($errorEmail);

		$errorPassword = $errorReport->password;
		$errorPassword = json_encode($errorPassword);

		$errorPasswordConfirmation = $errorReport->password_confirmation;
		$errorPasswordConfirmation = json_encode($errorPasswordConfirmation);

		$errorEncryptedPassword = $errorReport->encrypted_password;
		$errorEncryptedPassword = json_encode($errorEncryptedPassword);

		store_user_public_information_error($errorMessage, $errorFirstname, $errorLastname, $errorPostnumber, $errorPostdistrict, $errorPhone, $errorEmail, $errorPassword, $errorPasswordConfirmation, $errorEncryptedPassword);
		store_user_public_information($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $password, $password_confirmation);

		reset_success();
		wp_redirect(site_url().'/profile/personal-information-fb/');
		return null;
	} else{
		reset_public_information();
		register_bkdk_user($contactid);
		wp_redirect(site_url().'/create-profile/success/');

	}
		return $response->contact;
	}
}

?>