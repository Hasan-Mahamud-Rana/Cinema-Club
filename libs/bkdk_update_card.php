<?php

function call_update_card($customerid){
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

  $membershiporderlineid = $_POST['membershiporderlineid'];

  if (is_present($membershiporderlineid) && is_present($customerid) ) {

    $url = API_HOST . '/api/contacts/' . $customerid . '/memberships/' . $membershiporderlineid . '/update';

    $body = array("membership" =>
                array(
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
                  )
        )
  );
  $response = fetch_bkdk_api_data($url, $body, 'put');
  $success = $response->success;

  if ($success != true) {
    $errorMessage = $response->errors[0]->credit_card;

    $errorLastname = $errorReport->last_name;
    $errorLastname = json_encode($errorLastname);

    $errorYear = $errorReport->year;
    $errorYear = json_encode($errorYear);

    $errorNumber = $errorReport->number;
    $errorNumber = json_encode($errorNumber);

    update_card_error($errorMessage, $errorLastname, $errorYear, $errorNumber);
    wp_redirect(site_url().'/profile/update-card/');
    return null;
  } else{
    $message = $response->message;
    update_card_success($message);
    wp_redirect(site_url().'/profile/update-card/');
  }
    return $response->membership;
  }
}

function update_card_error($errorMessage, $errorLastname, $errorYear, $errorNumber){
  setcookie( 'formErrorMessage', $errorMessage, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['formErrorMessage'] = $errorMessage;

  setcookie( 'formErrorLastname', $errorLastname, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['formErrorLastname'] = $errorLastname;

  setcookie( 'formErrorYear', $errorYear, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['formErrorYear'] = $errorYear;

  setcookie( 'formErrorNumber', $errorNumber, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['formErrorNumber'] = $errorNumber;
}
function update_card_success($message){
  setcookie( 'formSuccessMessage', $message, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['formSuccessMessage'] = $message;
}

function reset_update_card_error_success(){
  setcookie( 'formErrorMessage', ' ', time() - 3600 );
  setcookie( 'formErrorMessage', ' ', time() - 3600, '/');

  setcookie( 'formSuccessMessage', ' ', time() - 3600 );
  setcookie( 'formSuccessMessage', ' ', time() - 3600, '/');

  setcookie( 'formErrorLastname', ' ', time() - 3600 );
  setcookie( 'formErrorLastname', ' ', time() - 3600, '/');

  setcookie( 'formErrorYear', ' ', time() - 3600 );
  setcookie( 'formErrorYear', ' ', time() - 3600, '/');

  setcookie( 'formErrorNumber', ' ', time() - 3600 );
  setcookie( 'formErrorNumber', ' ', time() - 3600, '/');
}
?>