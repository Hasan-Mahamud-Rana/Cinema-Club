<?php
function register_membership($code, $customerid){

  if (is_present($code) && is_present($customerid) ) {
  //echo "call register_membership";
  $url = API_HOST . '/api/contacts/' . $customerid . '/barcode_pages/' . $code;
  $body = null;

  $response = fetch_bkdk_api_data($url, $body, 'put' );

  $success = $response->success;
  if ($success == true) {
    reset_code();
  } else {
    $message = $response->message;

    $errorBarcode = $response->errors->barcode_page;
      foreach($errorBarcode as $barcode){
          $barcode;
        }
      store_code($code);
      store_code_error($message, $barcode);
    wp_redirect(site_url().'/gem-papirmedlemskab/failed/');
    }
  return $response;
  }
}

function membership_status($code){
  $code = $_POST['code'];

  if (is_present($code)) {
  $url = API_HOST . '/api/barcode_pages/' . $code;
  $body = NULL;

  $response = fetch_bkdk_api_data($url, $body);

  $success = $response->success;
    if ($success != true) {
    $message = $response->message;

    $errorBarcode = $response->errors->barcode_page;
      foreach($errorBarcode as $barcode){
          $barcode;
        }
      store_code($code);
      store_code_error($message, $barcode);
    wp_redirect(site_url().'/gem-papirmedlemskab/failed/');
    }

  return $response;
  }
}
?>