<?php
function register_kupon($code, $customerid){
  if (is_present($code) && is_present($customerid) ) {
  $url = API_HOST . '/api/contacts/' . $customerid . '/barcodes/';
      $body = array("barcode" =>
                array(
                  'code' => $code
        )
  );

  $response = fetch_bkdk_api_data($url, $body, 'post' );
  $success = $response->success;

  if ($success == true) {
    reset_code();
  } else {
    $message = $response->message;
    $errorBarcode = $response->errors->barcode;
      foreach($errorBarcode as $barcode){
          $barcode;
        }
      store_code($code);
      store_code_error($message, $barcode);
    wp_redirect(site_url().'/gem-papirkuponer/failed/');
    }
  return $response;
  }
}

function kupon_status($code){
  $code = $_POST['code'];

  if (is_present($code)) {
  $url = API_HOST . '/api/barcodes/' . $code;
  $body = NULL;

  $response = fetch_bkdk_api_data($url, $body);

  $success = $response->success;
    if ($success != true) {
    $message = $response->message;

    $errorBarcode = $response->errors->barcode;
      foreach($errorBarcode as $barcode){
          $barcode;
        }
      store_code($code);
      store_code_error($message, $barcode);
    wp_redirect(site_url().'/gem-papirkuponer/failed/');
    }

  return $response;
  }
}

function store_code($code) {
  setcookie( 'storeCode', $code, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['storeCode'] = $code;
}

function store_code_for_fb($code) {
  setcookie( 'storeCodeFB', $code, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['storeCodeFB'] = $code;
}

function reset_code() {
  setcookie( 'storeCode', ' ', time() - 3600 );
  setcookie( 'storeCode', ' ', time() - 3600, '/');

  setcookie( 'storeCodeFB', ' ', time() - 3600 );
  setcookie( 'storeCodeFB', ' ', time() - 3600, '/');
}


function store_code_error($message, $barcode) {
  setcookie( 'storeCodeErrorMessage', $message, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['storeCodeErrorMessage'] = $message;

  setcookie( 'storeCodeErrorBarcode', $barcode, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['storeCodeErrorBarcode'] = $barcode;
}

function reset_code_error() {
  setcookie( 'storeCodeErrorMessage', ' ', time() - 3600 );
  setcookie( 'storeCodeErrorMessage', ' ', time() - 3600, '/');

  setcookie( 'storeCodeErrorBarcode', ' ', time() - 3600 );
  setcookie( 'storeCodeErrorBarcode', ' ', time() - 3600, '/');

  reset_code();
}
?>