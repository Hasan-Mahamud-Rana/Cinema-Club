<?php

function update_basket($basisValue, $basisID, $basisPrice, $premiumValue, $premiumID, $premiumPrice) {
	setcookie( 'basketBasisNumber', $basisValue, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['basketBasisNumber'] = $basisValue;

	setcookie( 'basketBasisID', $basisID, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['basketBasisID'] = $basisID;

	setcookie( 'basketBasisPrice', $basisPrice, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['basketBasisPrice'] = $basisPrice;

	setcookie( 'basketPremiumNumber', $premiumValue, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['basketPremiumNumber'] = $premiumValue;

	setcookie( 'basketPremiumID', $premiumID, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['basketPremiumID'] = $premiumID;

	setcookie( 'basketPremiumPrice', $premiumPrice, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['basketPremiumPrice'] = $premiumPrice;

	$cartValue = $basisValue + $premiumValue;
	setcookie( 'basketCartNumber', $cartValue, 30 * DAYS_IN_SECONDS, '/');

	$_COOKIE['basketCartNumber'] = $cartValue;

	return $cartValue;
}

function update_flex_basket($flexValue, $flexID, $flexID1, $flexID2, $price, $flexPrice1, $flexPrice2){

	setcookie( 'basketFlexNumber', $flexValue, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['basketFlexNumber'] = $flexValue;

	setcookie( 'basketFlexID', $flexID, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['basketFlexID'] = $flexID;

	setcookie( 'basketFlexID1', $flexID1, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['basketFlexID1'] = $flexID1;

	setcookie( 'basketFlexID2', $flexID2, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['basketFlexID2'] = $flexID2;

	setcookie( 'basketFlexPrice', $price, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['basketFlexPrice'] = $price;

	setcookie( 'basketFlexPrice1', $flexPrice1, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['basketFlexPrice1'] = $flexPrice1;

	setcookie( 'basketFlexPrice2', $flexPrice2, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['basketFlexPrice2'] = $flexPrice2;

	$flexCartValue = 1;
	setcookie( 'basketFlexCartNumber', $flexCartValue, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['basketFlexCartNumber'] = $flexCartValue;

	return $flexCartValue;
}
function update_deliveryMethod($deliveryMethod) {
	setcookie( 'basketDeliveryMethod', $deliveryMethod, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['basketDeliveryMethod'] = $deliveryMethod;
}

function reset_basket() {
	setcookie( 'basketBasisNumber', ' ', time() - 3600 );
	setcookie( 'basketBasisNumber', ' ', time() - 3600, '/');

	setcookie( 'basketBasisID', ' ', time() - 3600 );
	setcookie( 'basketBasisID', ' ', time() - 3600, '/');

	setcookie( 'basketBasisPrice', ' ', time() - 3600 );
	setcookie( 'basketBasisPrice', ' ', time() - 3600, '/');

 	setcookie( 'basketPremiumNumber', ' ', time() - 3600 );
	setcookie( 'basketPremiumNumber', ' ', time() - 3600, '/');

	setcookie( 'basketPremiumID', ' ', time() - 3600 );
	setcookie( 'basketPremiumID', ' ', time() - 3600, '/');

	setcookie( 'basketPremiumPrice', ' ', time() - 3600 );
	setcookie( 'basketPremiumPrice', ' ', time() - 3600, '/');

	setcookie( 'basketCartNumber', ' ', time() - 3600 );
	setcookie( 'basketCartNumber', ' ', time() - 3600, '/');

	setcookie( 'basketDeliveryMethod', ' ', time() - 3600 );
	setcookie( 'basketDeliveryMethod', ' ', time() - 3600, '/');

	reset_flex_cart();
}

function reset_flex_cart(){
	setcookie( 'basketFlexNumber', ' ', time() - 3600 );
	setcookie( 'basketFlexNumber', ' ', time() - 3600, '/');

	setcookie( 'basketFlexCartNumber', ' ', time() - 3600 );
	setcookie( 'basketFlexCartNumber', ' ', time() - 3600, '/');

	setcookie( 'basketFlexID', ' ', time() - 3600 );
	setcookie( 'basketFlexID', ' ', time() - 3600, '/');

	setcookie( 'basketFlexID1', ' ', time() - 3600 );
	setcookie( 'basketFlexID1', ' ', time() - 3600, '/');

	setcookie( 'basketFlexID2', ' ', time() - 3600 );
	setcookie( 'basketFlexID2', ' ', time() - 3600, '/');

	setcookie( 'basketFlexPrice', ' ', time() - 3600 );
	setcookie( 'basketFlexPrice', ' ', time() - 3600, '/');

	setcookie( 'basketFlexPrice1', ' ', time() - 3600 );
	setcookie( 'basketFlexPrice1', ' ', time() - 3600, '/');

	setcookie( 'basketFlexPrice2', ' ', time() - 3600 );
	setcookie( 'basketFlexPrice2', ' ', time() - 3600, '/');
}

function reset_basket_from_cartBar() {
	reset_basket();
	wp_redirect(site_url().'/purchase/');
}

function get_purchasable_memberships($customerid) {
  //$url = API_HOST . '/api/memberships?contact_id=' . $customerid;
	$url = API_HOST . '/api/contacts/' . $customerid . '/purchasable_memberships';

  $body = null;

  $response = fetch_bkdk_api_data($url, $body);
  return $response->memberships;
}


function call_for_payment($customerid) {

  $basket_totalcost = $_POST['basket_totalcost']; #integer
  settype($basket_totalcost, "integer");

	$delivery_method = $_POST['delivery_method'];

	$cardHolderName = $_POST['cardHolderName'];
	$pieces = explode(" ", $cardHolderName);
	$first_name = $pieces[0];
	$last_name = $pieces[1];

	$number = $_POST['number'];
	$month = $_POST['month'];
	$year = $_POST['expire'];
	$verification_value = $_POST['verification_value'];
	$card_type = $_POST['card_type'];
	$userIP = $_POST['userip'];

	$membershipproductid = $_POST['membershipproductid']; #
	$quantity = $_POST['quantity'];

return bkdk_payment($basket_totalcost, $delivery_method, $first_name, $last_name, $number, $month, $year, $verification_value, $card_type, $userIP, $membershipproductid, $quantity, $customerid);
}

function json_basket_content($membershipproductid, $quantity){
	$jsonData1 = [
		'membershipproductid' => intval($membershipproductid[0]),
		'quantity' => intval($quantity[0])
		];

	if (is_present($membershipproductid[1])){
			$jsonData2 = [
			'membershipproductid' => intval($membershipproductid[1]),
	  	'quantity' => intval($quantity[1])
  	];

		$jsonData = [$jsonData1, $jsonData2];
	} else {
		$jsonData = [$jsonData1];
	}
	return $jsonData;
}

function bkdk_payment($basket_totalcost, $delivery_method, $first_name, $last_name, $number, $month, $year, $verification_value, $card_type, $userIP, $membershipproductid, $quantity, $customerid) {

if ( is_present($delivery_method) && is_present($first_name) && is_present($number) && is_present($month) && is_present($year) && is_present($verification_value) && is_present($userIP) && is_present($card_type) && is_present($membershipproductid) && is_present($quantity)  && is_present($customerid)) {

	$body = array("purchase" =>
								array(
									'basket_totalcost' => $basket_totalcost,
									'delivery_method' => $delivery_method,
									'credit_card_details' =>
															array (
										'first_name' => $first_name,
										'last_name' => $last_name,
										'number' => $number,
										'month' => $month,
										'year' => $year,
										'verification_value' => $verification_value,
										'card_type' => $card_type,
										'ip' => $userIP
									),

								'basket_content' => json_basket_content($membershipproductid, $quantity)
				)
	);

 	$url = API_HOST . '/api/contacts/' . $customerid . '/purchases';
	$response = fetch_bkdk_api_data($url, $body, 'post' );

  $success = $response->success;
	if ($success == true) {
	  reset_basket();
	  return $success;
	} else {
	  $errorMessage = $response->message;
	  $errorReport = $response->errors;

	  $errorDeliveryMethod = $errorReport->delivery_method;
		$errorDeliveryMethod = json_encode($errorDeliveryMethod);

		$errorBasketTotalcost = $errorReport->basket_totalcost;
		$errorBasketTotalcost = json_encode($errorBasketTotalcost);

		$errorPurchase = $errorReport->purchase;
		$errorPurchase = json_encode($errorPurchase);

		$errorLastname = $errorReport->last_name;
		$errorLastname = json_encode($errorLastname);

		$errorYear = $errorReport->year;
		$errorYear = json_encode($errorYear);

		$errorNumber = $errorReport->number;
		$errorNumber = json_encode($errorNumber);

		payment_error($errorMessage, $errorDeliveryMethod, $errorBasketTotalcost, $errorPurchase, $errorLastname, $errorYear, $errorNumber);

	  wp_redirect(site_url().'/purchase/buy/');
	  return null;
	}
	return $response->purchase;
}
}

function payment_error($errorMessage, $errorDeliveryMethod, $errorBasketTotalcost, $errorPurchase, $errorLastname, $errorYear, $errorNumber){
	setcookie( 'formErrorMessage', $errorMessage, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorMessage'] = $errorMessage;

	setcookie( 'formErrorDeliveryMethod', $errorDeliveryMethod, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorDeliveryMethod'] = $errorDeliveryMethod;

	setcookie( 'formErrorBasketTotalcost', $errorBasketTotalcost, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorBasketTotalcost'] = $errorBasketTotalcost;

	setcookie( 'formErrorPurchase', $errorPurchase, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorPurchase'] = $errorPurchase;

	setcookie( 'formErrorLastname', $errorLastname, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorLastname'] = $errorLastname;

	setcookie( 'formErrorYear', $errorYear, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorYear'] = $errorYear;

	setcookie( 'formErrorNumber', $errorNumber, 30 * DAYS_IN_SECONDS, '/');
	$_COOKIE['formErrorNumber'] = $errorNumber;
}
function reset_payment_error(){
	setcookie( 'formErrorMessage', ' ', time() - 3600 );
	setcookie( 'formErrorMessage', ' ', time() - 3600, '/');

	setcookie( 'formErrorDeliveryMethod', ' ', time() - 3600 );
	setcookie( 'formErrorDeliveryMethod', ' ', time() - 3600, '/');

	setcookie( 'formErrorBasketTotalcost', ' ', time() - 3600 );
	setcookie( 'formErrorBasketTotalcost', ' ', time() - 3600, '/');

	setcookie( 'formErrorPurchase', ' ', time() - 3600 );
	setcookie( 'formErrorPurchase', ' ', time() - 3600, '/');

	setcookie( 'formErrorLastname', ' ', time() - 3600 );
	setcookie( 'formErrorLastname', ' ', time() - 3600, '/');

	setcookie( 'formErrorYear', ' ', time() - 3600 );
	setcookie( 'formErrorYear', ' ', time() - 3600, '/');

	setcookie( 'formErrorNumber', ' ', time() - 3600 );
	setcookie( 'formErrorNumber', ' ', time() - 3600, '/');
}
?>