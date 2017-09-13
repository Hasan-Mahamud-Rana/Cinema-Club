<?php

function call_profile_settings_update_profile($customerid) {
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

	return profile_settings_update_profile($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $gender, $birth_day, $birth_month, $birth_year, $receivegeneralnewsletter, $customerid);
}
function profile_settings_update_profile($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $gender, $birth_day, $birth_month, $birth_year, $receivegeneralnewsletter, $customerid) {
if (is_present($firstname) && is_present($lastname) && is_present($address) && is_present($postnumber) && is_present($by) && is_present($email) && is_present($receivegeneralnewsletter) && is_present($customerid)) {

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

	$url = API_HOST . '/api/contacts/' . $customerid ;

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
		store_user_public_information($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $password, $password_confirmation);

		reset_success();
		wp_redirect(site_url().'/profile/personal-information/');
		return null;
	} else{
		reset_public_information();
		store_success($success);
		wp_redirect(site_url().'/profile/personal-information/');

	}
		return $response->contact;
	}
}


function call_profile_settings_notifications($customerid) {

$receivegeneralnewsletter = $_POST['receivegeneralnewsletter'];
$receivegeneralnewsletter = (isset($receivegeneralnewsletter))?$receivegeneralnewsletter:'0';

$receive_season_newsletter = $_POST['receive_season_newsletter'];
$receive_season_newsletter = (isset($receive_season_newsletter))?$receive_season_newsletter:'0';

$receive_voucher_newsletter = $_POST['receive_voucher_newsletter'];
$receive_voucher_newsletter = (isset($receive_voucher_newsletter))?$receive_voucher_newsletter:'0';

$receive_lottery_newsletter = $_POST['receive_lottery_newsletter'];
$receive_lottery_newsletter = (isset($receive_lottery_newsletter))?$receive_lottery_newsletter:'0';

$receive_survey_newsletter = $_POST['receive_survey_newsletter'];
$receive_survey_newsletter = (isset($receive_survey_newsletter))?$receive_survey_newsletter:'0';

$receivespecializednewsletter = $_POST['receivespecializednewsletter'];
$receivespecializednewsletter = (isset($receivespecializednewsletter))?$receivespecializednewsletter:'0';

	return profile_settings_notifications($receivegeneralnewsletter, $receive_season_newsletter, $receive_voucher_newsletter, $receive_lottery_newsletter, $receive_survey_newsletter, $receivespecializednewsletter, $customerid);
}
function profile_settings_notifications($receivegeneralnewsletter, $receive_season_newsletter, $receive_voucher_newsletter, $receive_lottery_newsletter, $receive_survey_newsletter, $receivespecializednewsletter, $customerid) {

if (is_present($receivegeneralnewsletter) && is_present($receive_season_newsletter) && is_present($receive_voucher_newsletter) && is_present($receive_lottery_newsletter) && is_present($receive_survey_newsletter) && is_present($receivespecializednewsletter) && is_present($customerid)) {

	$body = array("contact" =>
								array(
									'receivegeneralnewsletter' => $receivegeneralnewsletter,
									'receive_season_newsletter' => $receive_season_newsletter,
									'receive_voucher_newsletter' => $receive_voucher_newsletter,
									'receive_lottery_newsletter' => $receive_lottery_newsletter,
									'receive_survey_newsletter' => $receive_survey_newsletter,
									'receivespecializednewsletter' => $receivespecializednewsletter
								)
	);

	$url = API_HOST . '/api/contacts/' . $customerid ;

	$response = fetch_bkdk_api_data($url, $body, 'put' );
  	$success = $response->success;
	if ($success != true) {
		wp_redirect(site_url().'/profile/notifications/');
		echo "success" ;
		return null;
	} else{
		store_success($success);
		wp_redirect(site_url().'/profile/notifications/');
	}
		return $response->contact;
	}
}

function call_profile_settings_favourite_cinema($customerid) {
	$favoritecinemaids = $_POST['favoritecinemaids'];
	return profile_settings_favourite_cinema($favoritecinemaids, $customerid);
}

function profile_settings_favourite_cinema($favoritecinemaids, $customerid) {
if (is_present($customerid)) {
	//echo 'API call for call_profile_settings_favourite_cinema<br/>' . $favoritecinemaids . ' for customer ' .  $customerid;
	$body = array("contact_favorite_cinemas" =>
								array(
									'favoritecinemaids' => $favoritecinemaids
								)
	);
	$url = API_HOST . '/api/contacts/' . $customerid .'/contact_favorite_cinemas';

	$response = fetch_bkdk_api_data($url, $body, 'post' );
 $success = $response->success;

  if ($success != true) {
		wp_redirect(site_url().'/profile/favourite-cinema/');
		return null;
	} else {
		store_success($success);
		wp_redirect(site_url().'/profile/favourite-cinema/');
	}
	return $response->contact;
}
}


function call_profile_settings_remove_cinema($customerid) {
	$removedcinemaids = $_POST['removedcinemaids'];
	return profile_settings_remove_cinema($removedcinemaids, $customerid);
}

function profile_settings_remove_cinema($removedcinemaids, $customerid) {
if (is_present($removedcinemaids) && is_present($customerid)) {

		//echo 'API call for profile_settings_remove_cinema<br/>';
	$body = array("contact_favorite_cinemas" =>
								array(
									'favoritecinemaids' => $removedcinemaids
								)
	);
	$url = API_HOST . '/api/contacts/' . $customerid .'/contact_favorite_cinemas';

	$response = fetch_bkdk_api_data($url, $body, 'delete' );
//var_dump($response );
  $success = $response->success;

  if ($success != true) {
		wp_redirect(site_url().'/profile/favourite-cinema/');
		return null;
	} else{
		store_success($success);
		wp_redirect(site_url().'/profile/favourite-cinema/');
	}
	return $response->contact;
}
}


function store_success($success) {
	setcookie( 'storeSuccess', $success, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['storeSuccess'] = $success;
}

function reset_success() {
	setcookie( 'storeSuccess', ' ', time() - 3600 );
	setcookie( 'storeSuccess', ' ', time() - 3600, '/');

}

?>