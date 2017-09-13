<?php

function get_all_orderable_brochures() {
  $url = API_HOST . '/api/brochures/';
  $body = null;

  $response = fetch_bkdk_api_data($url, $body);
  return $response->brochures;
}

function call_brochure_create_profile() {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$address = $_POST['address'];
	$postnumber = $_POST['postnumber'];
	$by = $_POST['postdistrict'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];

	$currentlink = $_POST['currentlink'];

	$brochureproductid = $_POST['brochureproductid'];
  settype($brochureproductid, "integer");
  $quantity = $_POST['quantity'];
  settype($quantity, "integer");

  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $basketTotalcost = $quantity * $price;

  settype($basketTotalcost, "integer");

	return bkdk_brochure_create_profile($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $brochureproductid, $quantity, $basketTotalcost, $currentlink);
}
function bkdk_brochure_create_profile($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $brochureproductid, $quantity, $basketTotalcost, $currentlink) {
if (is_present($firstname) && is_present($lastname) && is_present($address) && is_present($postnumber) && is_present($by) && is_present($email) && is_present($currentlink) && is_present($brochureproductid) && is_present($quantity) ) {

	$url = API_HOST . '/api/purchases/';
	$body = array("contact" =>
								array(
									'firstname' => $firstname,
									'lastname' => $lastname,
									'address' => $address,
									'postnumber' => $postnumber,
									'postdistrict' => $by,
									'email' => $email,
									'phone' => $phone
								),
				"purchase" =>
        				array(
         					'basket_totalcost' => $basketTotalcost,
         					'basket_content' =>
         					array (
          					 array (
          							'brochureproductid' => $brochureproductid,
          							'quantity' => $quantity
        										)
												)
    								)
);

	$response = fetch_bkdk_api_data( $url,  $body, 'post');

	$success = $response->success;
	if ($success == true) {
		reset_public_information();
	} else
	{
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
	}
}

function call_order_brochure($customerid) {

	$brochureproductid = $_POST['brochureproductid'];
  settype($brochureproductid, "integer");
  $quantity = $_POST['quantity'];
  settype($quantity, "integer");

  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $basketTotalcost = $quantity * $price;

  settype($basketTotalcost, "integer");

return order_brochure($brochureproductid, $quantity, $basketTotalcost, $customerid);
}

function order_brochure($brochureproductid, $quantity, $basketTotalcost, $customerid) {

if ( is_present($brochureproductid) && is_present($quantity) && is_present($customerid)) {

$body = array("purchase" =>
        array(
         'basket_totalcost' => $basketTotalcost,
         'basket_content' => array (
           array (
          'brochureproductid' => $brochureproductid,
          'quantity' => $quantity
        )
			)
    )
 );
	//var_dump($body);
 	$url = API_HOST . '/api/contacts/' . $customerid . '/purchases';
	$response = fetch_bkdk_api_data($url, $body, 'post' );
  //var_dump($response);

  $success = $response->success;
	if ($success == true) {
	  return $success;
	  reset_public_information();
	  reset_order_error();
	} else {
	  $errorMessage = $response->message;
	  $errorReport = $response->errors;

		$errorPurchase = $errorReport->purchase;
		$errorPurchase = json_encode($errorPurchase);

		order_error($errorMessage, $errorPurchase);

	  wp_redirect(site_url().'/brochure/');
	  return null;
	}
	return $response->purchase;
}
}

function order_error($errorMessage, $errorPurchase){
	setcookie( 'formErrorMessage', $errorMessage, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorMessage'] = $errorMessage;

	setcookie( 'formErrorPurchase', $errorPurchase, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorPurchase'] = $errorPurchase;
}

function reset_order_error(){
	setcookie( 'formErrorMessage', ' ', time() - 3600 );
	setcookie( 'formErrorMessage', ' ', time() - 3600, '/');

	setcookie( 'formErrorPurchase', ' ', time() - 3600 );
	setcookie( 'formErrorPurchase', ' ', time() - 3600, '/');
}
?>