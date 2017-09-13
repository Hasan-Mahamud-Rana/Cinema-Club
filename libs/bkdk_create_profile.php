<?php
function call_for_create_profile() {
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

	return bkdk_create_profile($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $password, $password_confirmation, $currentlink);
}
function bkdk_create_profile($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $password, $password_confirmation, $currentlink) {
if (is_present($firstname) && is_present($lastname) && is_present($address) && is_present($postnumber) && is_present($by) && is_present($email) && is_present($password) && is_present($password_confirmation)&& is_present($currentlink) ) {
	//echo 'API call for create profile<br/>';
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

	$url = API_HOST . '/api/contacts';
	$obj = fetch_bkdk_api_data( $url,  $body, 'post');
	$success = $obj->success;
	if ($success == true) {
		register_bkdk_user($obj->contact->contactid);
		$flexBasket = $_POST['flexBasket'];

		if(!empty($flexBasket)){
			$userDetails = get_user_info($obj->contact->contactid);
			$purchasable_flex_membership = $userDetails->purchasable_flex_membership;
			$purchasable_flex_memberships = $userDetails->purchasable_flex_memberships;

			if (in_array($flexBasket, $purchasable_flex_memberships)) {
			  $flexAlreadyBought = false;
			} else {
				$flexAlreadyBought = true;
			}

		$active_flex_membership = $userDetails->active_flex_membership;
			if ($purchasable_flex_membership != true || $active_flex_membership == true || $flexAlreadyBought == true) {
				reset_flex_cart();
	    	wp_redirect($currentlink);
	    	$flexErrorOccurred = true;
	    	store_flexErrorOccurred($flexErrorOccurred);
			}
		}

		reset_public_information();
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

function store_flexErrorOccurred($flexErrorOccurred){
	setcookie( 'flexErrorTrue', $flexErrorOccurred, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['flexErrorTrue'] = $flexErrorOccurred;
}
function reset_flexErrorOccurred() {
	setcookie( 'flexErrorTrue', ' ', time() - 3600 );
	setcookie( 'flexErrorTrue', ' ', time() - 3600, '/');
}
function store_user_public_information_error($errorMessage, $errorFirstname, $errorLastname, $errorPostnumber, $errorPostdistrict, $errorPhone, $errorEmail, $errorPassword, $errorPasswordConfirmation, $errorEncryptedPassword) {
	setcookie( 'formErrorMessage', $errorMessage, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorMessage'] = $errorMessage;

	setcookie( 'formErrorFirstname', $errorFirstname, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorFirstname'] = $errorFirstname;

	setcookie( 'formErrorLastname', $errorLastname, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorLastname'] = $errorLastname;

	setcookie( 'formErrorPostnumber', $errorPostnumber, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorPostnumber'] = $errorPostnumber;

	setcookie( 'formErrorPostdistrict', $errorPostdistrict, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorPostdistrict'] = $errorPostdistrict;

	setcookie( 'formErrorPhone', $errorPhone, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorPhone'] = $errorPhone;

	setcookie( 'formErrorEmail', $errorEmail, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorEmail'] = $errorEmail;

	setcookie( 'formErrorPassword', $errorPassword, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorPassword'] = $errorPassword;

	setcookie( 'formErrorPasswordConfirmation', $errorPasswordConfirmation, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorPasswordConfirmation'] = $errorPasswordConfirmation;

	setcookie( 'formErrorEncryptedPassword', $errorEncryptedPassword, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorEncryptedPassword'] = $errorEncryptedPassword;
}

function store_user_public_information($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $password, $password_confirmation) {

	setcookie( 'formFirstname', $firstname, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formFirstname'] = $firstname;

	setcookie( 'formLastname', $lastname, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formLastname'] = $lastname;

	setcookie( 'formAddress', $address, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formAddress'] = $address;

	setcookie( 'formPostnumber', $postnumber, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formPostnumber'] = $postnumber;

	setcookie( 'formBy', $by, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formBy'] = $by;

	setcookie( 'formEmail', $email, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formEmail'] = $email;

	setcookie( 'formPhone', $phone, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formPhone'] = $phone;

	setcookie( 'formPassword', $password, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formPassword'] = $password;

	setcookie( 'formPassword_confirmation', $password_confirmation, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formPassword_confirmation'] = $password_confirmation;

}

function reset_public_information() {
	setcookie( 'formFirstname', ' ', time() - 3600 );
	setcookie( 'formFirstname', ' ', time() - 3600, '/');

	setcookie( 'formLastname', ' ', time() - 3600 );
	setcookie( 'formLastname', ' ', time() - 3600, '/');

	setcookie( 'formAddress', ' ', time() - 3600 );
	setcookie( 'formAddress', ' ', time() - 3600, '/');

 	setcookie( 'formPostnumber', ' ', time() - 3600 );
	setcookie( 'formPostnumber', ' ', time() - 3600, '/');

	setcookie( 'formBy', ' ', time() - 3600 );
	setcookie( 'formBy', ' ', time() - 3600, '/');

	setcookie( 'formEmail', ' ', time() - 3600 );
	setcookie( 'formEmail', ' ', time() - 3600, '/');

	setcookie( 'formPhone', ' ', time() - 3600 );
	setcookie( 'formPhone', ' ', time() - 3600, '/');

	setcookie( 'formPassword', ' ', time() - 3600 );
	setcookie( 'formPassword', ' ', time() - 3600, '/');

	setcookie( 'formPassword_confirmation', ' ', time() - 3600 );
	setcookie( 'formPassword_confirmation', ' ', time() - 3600, '/');

	setcookie( 'formErrorMessage', ' ', time() - 3600 );
	setcookie( 'formErrorMessage', ' ', time() - 3600, '/');

	setcookie( 'formErrorFirstname', ' ', time() - 3600 );
	setcookie( 'formErrorFirstname', ' ', time() - 3600, '/');

	setcookie( 'formErrorLastname', ' ', time() - 3600 );
	setcookie( 'formErrorLastname', ' ', time() - 3600, '/');

	setcookie( 'formErrorPostnumber', ' ', time() - 3600 );
	setcookie( 'formErrorPostnumber', ' ', time() - 3600, '/');

	setcookie( 'formErrorPostdistrict', ' ', time() - 3600 );
	setcookie( 'formErrorPostdistrict', ' ', time() - 3600, '/');

	setcookie( 'formErrorPhone', ' ', time() - 3600 );
	setcookie( 'formErrorPhone', ' ', time() - 3600, '/');

	setcookie( 'formErrorEmail', ' ', time() - 3600 );
	setcookie( 'formErrorEmail', ' ', time() - 3600, '/');

	setcookie( 'formErrorPassword', ' ', time() - 3600 );
	setcookie( 'formErrorPassword', ' ', time() - 3600, '/');

	setcookie( 'formErrorPasswordConfirmation', ' ', time() - 3600 );
	setcookie( 'formErrorPasswordConfirmation', ' ', time() - 3600, '/');

	setcookie( 'formErrorEncryptedPassword', ' ', time() - 3600 );
	setcookie( 'formErrorEncryptedPassword', ' ', time() - 3600, '/');
}

function call_for_update_profile($customerid) {
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

	return bkdk_update_profile($gender, $birth_day, $birth_month, $birth_year, $receivegeneralnewsletter, $customerid);
}
function bkdk_update_profile($gender, $birth_day, $birth_month, $birth_year, $receivegeneralnewsletter, $customerid) {
if (is_present($receivegeneralnewsletter) && is_present($customerid)) {
	$body = array("contact" =>
								array(
									'gender' => $gender,
									'birth_day' => $birth_day,
									'birth_month' => $birth_month,
									'birth_year' => $birth_year,
									'receivegeneralnewsletter' => $receivegeneralnewsletter
									)
	);

	$url = API_HOST . '/api/contacts/' . $customerid ;

	$response = fetch_bkdk_api_data($url, $body, 'put' );

  $success = $response->success;
	if ($success != true) {
		wp_redirect(site_url() . '/create-profile/step-2/');
		return null;
	}
	return $response->contact;
}
}


function cfc_update_profile($customerid) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$address = $_POST['address'];
	$postnumber = $_POST['postnumber'];
	$by = $_POST['postdistrict'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$receivegeneralnewsletter = $_POST['receivegeneralnewsletter'];
	$receivegeneralnewsletter = (isset($receivegeneralnewsletter))?$receivegeneralnewsletter:'0';
	$currentlink = $_POST['currentlink'];

	return bkdk_cfc_update_profile($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $receivegeneralnewsletter, $customerid, $currentlink);
}
function bkdk_cfc_update_profile($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $receivegeneralnewsletter, $customerid, $currentlink) {
if (is_present($firstname) && is_present($lastname) && is_present($address) && is_present($postnumber) && is_present($by) && is_present($email) && is_present($phone) && is_present($receivegeneralnewsletter) && is_present($currentlink) && is_present($customerid)) {

	$body = array("contact" =>
								array(
									'firstname' => $firstname,
									'lastname' => $lastname,
									'address' => $address,
									'postnumber' => $postnumber,
									'postdistrict' => $by,
									'email' => $email,
									'phone' => $phone,
									'receivegeneralnewsletter' => $receivegeneralnewsletter
								)
	);

	$url = API_HOST . '/api/contacts/' . $customerid;

	$response = fetch_bkdk_api_data($url, $body, 'put' );


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
		wp_redirect($currentlink);
		return null;
	}
	return $response->contact;
	}
}

?>