<?php
function ttruncat($text,$numb) {
if (strlen($text) > $numb) {
  $text = substr($text, 0, $numb);
  $text = substr($text,0,strrpos($text," "));
  $etc = " ...";
  $text = $text.$etc;
  }
return $text;
}

function get_user_movies($customerid) {
  $url = API_HOST . '/api/contacts/' . $customerid . '/movies';
  $body = null;

  $response = fetch_bkdk_api_data($url, $body);
  return $response->movies;
}

function get_single_movie_kupon($customerid, $fafFilmid){
  //$fafFilmid = $_POST['fafFilmid'];
  if (is_present($fafFilmid) && is_present($customerid) ) {
    $url = API_HOST . '/api/contacts/' . $customerid . '/movies/' . $fafFilmid . '/barcodes';
    $body = null;

    $response = fetch_bkdk_api_data($url, $body);
    return $response->barcodes;
  }
}

function get_single_movie_kupon_movieid($customerid, $wp_movie_id){
  //$fafFilmid = $_POST['fafFilmid'];
  if (is_present($fafFilmid) && is_present($customerid) ) {
    $url = API_HOST . '/api/contacts/' . $customerid . '/movies/' . $wp_movie_id . '/barcodes';
    $body = null;

    $response = fetch_bkdk_api_data($url, $body);
    return $response->barcodes;
  }
}
function get_movie_slug($customerid, $fafFilmid){
  $fafFilmid =  $_GET['fafFilmid'];
  if (is_present($fafFilmid) && is_present($customerid) ) {
    $url = API_HOST . '/api/contacts/' . $customerid . '/movies/' . $fafFilmid;
    $body = null;

    $response = fetch_bkdk_api_data($url, $body);
    return $response->movie;
  }
}

function get_kupon_stats($customerid, $fafFilmid){
  $fafFilmid =  $_GET['fafFilmid'];
  if (is_present($fafFilmid) && is_present($customerid) ) {
    $url = API_HOST . '/api/contacts/' . $customerid . '/movies/' . $fafFilmid;
    $body = null;

    $response = fetch_bkdk_api_data($url, $body);
    return $response->movie->barcodes_stats;
  }
}

function print_all_kupon($customerid, $fafFilmid, $wpSlugName){
  $fafFilmid =  $_POST['fafFilmid'];
  $wpSlugName =  $_POST['wpSlugName'];

  if (is_present($fafFilmid) && is_present($wpSlugName) && is_present($customerid) ) {
    $url = API_HOST . '/api/reports/movie_barcodes_list.json?contact_id=' . $customerid . '&faf_film_id=' . $fafFilmid;

    $body = null;
    $response = fetch_bkdk_api_data($url, $body);
    $pdf_data = base64_decode( $response->data);

  header('Content-type: application/pdf');
  header('Content-disposition: inline; filename="barcodes-' . $wpSlugName . '.pdf"');
  echo $pdf_data;
  exit();
  }
}

function print_single_kupon($customerid, $fafFilmid, $wpSlugName, $barcodeComplete){
  $fafFilmid =  $_POST['fafFilmid'];
  $wpSlugName =  $_POST['wpSlugName'];
  $barcodeComplete =  $_POST['barcode_complete'];

  if (is_present($fafFilmid) && is_present($wpSlugName) && is_present($barcodeComplete) && is_present($customerid) ) {
    $url = API_HOST . '/api/reports/movie_barcodes_list.json?contact_id=' . $customerid . '&faf_film_id=' . $fafFilmid . '&barcode_complete=' . $barcodeComplete;

    $body = null;
    $response = fetch_bkdk_api_data($url, $body);
    $pdf_data = base64_decode( $response->data);

    header('Content-type: application/pdf');
    header('Content-disposition: inline; filename="barcodes-' . $wpSlugName . '-' . $barcodeComplete .'.pdf"');
    echo $pdf_data;

    exit();
  }
}

function send_single_movie_kupon($customerid, $barcodeComplete, $name, $email, $message){

$barcodeComplete =  $_POST['barcodeComplete'];
$name =  $_POST['myname'];
$email =  $_POST['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  $email =  $_POST['email'];
} else {
  $mobilephone =  $_POST['email'];
}

$message =  $_POST['message'];
$currentlink = $_POST['currentlink'];

  if (is_present($barcodeComplete) && is_present($name) && is_present($customerid) && is_present($currentlink) ) {
    $url = API_HOST . '/api/contacts/' . $customerid . '/barcodes/' . $barcodeComplete;
      $body = array("barcode" =>
                array(
                  'recipient' =>
                              array (
                    'name' => $name,
                    'email' => $email,
                    'mobilephone' => $mobilephone
                  ),
                'message' => $message
        )
  );
  $response = fetch_bkdk_api_data($url, $body, 'put' );

  $success = $response->success;
  if ($success != true) {
    $errorMessage = $response->message;
    $errorSender = $response->errors[0]->sender;
    $errorRecipient = $response->errors[0]->recipient;
    $errorBarcode = $response->errors[0]->barcode;
  send_single_movie_kupon_error($errorMessage, $errorBarcode, $errorRecipient, $errorSender);
  } else {
    $successTicketnumber = $response->barcode->ticketnumber;
    send_single_movie_kupon_success($name, $successTicketnumber);
  }
  $fafFilmid =  $_POST['fafFilmid'];
  $wp_movie_id =  $_POST['wp_movie_id'];

  wp_redirect($currentlink);
  return $response->barcode;
  }
}

function send_single_movie_kupon_error($errorMessage, $errorBarcode, $errorRecipient, $errorSender) {
  setcookie( 'storeErrorMessage', $errorMessage, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['storeErrorMessage'] = $errorMessage;

  setcookie( 'storeErrorBarcode', $errorBarcode, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['storeErrorBarcode'] = $errorBarcode;

  setcookie( 'storeErrorRecipient', $errorRecipient, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['storeErrorRecipient'] = $errorRecipient;

  setcookie( 'storeErrorSender', $errorSender, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['storeErrorSender'] = $errorSender;
}

function send_single_movie_kupon_success($name, $successTicketnumber) {
  setcookie( 'storeSuccessName', $name, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['storeSuccessName'] = $name;

  setcookie( 'storeSuccessTicketnumber', $successTicketnumber, 30 * DAYS_IN_SECONDS, '/');
  $_COOKIE['storeSuccessTicketnumber'] = $successTicketnumber;
}

function reset_send_single_movie_kupon_error() {
  setcookie( 'storeErrorMessage', ' ', time() - 3600 );
  setcookie( 'storeErrorMessage', ' ', time() - 3600, '/');

  setcookie( 'storeErrorBarcode', ' ', time() - 3600 );
  setcookie( 'storeErrorBarcode', ' ', time() - 3600, '/');

  setcookie( 'storeErrorRecipient', ' ', time() - 3600 );
  setcookie( 'storeErrorRecipient', ' ', time() - 3600, '/');

  setcookie( 'storeErrorSender', ' ', time() - 3600 );
  setcookie( 'storeErrorSender', ' ', time() - 3600, '/');

  setcookie( 'storeSuccessName', ' ', time() - 3600 );
  setcookie( 'storeSuccessName', ' ', time() - 3600, '/');

  setcookie( 'storeSuccessTicketnumber', ' ', time() - 3600 );
  setcookie( 'storeSuccessTicketnumber', ' ', time() - 3600, '/');
}

?>