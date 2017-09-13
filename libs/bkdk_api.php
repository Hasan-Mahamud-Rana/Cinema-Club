<?php

$GLOBALS['blank_values'] = array("", null, ' ');

function is_present($value){
  return !is_blank($value);
}

function is_blank($value){
  return in_array($value, $GLOBALS['blank_values']);
}

require ('httpful/bootstrap.php');

//define("API_HOST", "https://biografklub.crd.dk");
define("API_HOST", "https://biografklub-staging.crd.dk");

function fetch_bkdk_api_data($url, $body, $method = 'get' ) {
  $headers = array(
      'X-APP-NAME' => 'WEB',
      'X-APP-API-KEY' => 'vrljx049ewdwce3sddgs2d'
  );
  switch ($method) {
  	case 'post':
  		$response = \Httpful\Request::post($url)
        ->addHeaders($headers)
        ->sendsJson()
        ->body($body)
        ->expectsJson()
        ->send();
      break;
  	case 'put':
  		$response = \Httpful\Request::put($url)
        ->addHeaders($headers)
        ->sendsJson()
        ->body($body)
        ->expectsJson()
        ->send();
  		break;
  	case 'delete':
  		 $response = \Httpful\Request::delete($url)
        ->addHeaders($headers)
        ->sendsJson()
        ->body($body)
        ->expectsJson()
        ->send();
  		break;
  	default: # case 'get'
      $response = \Httpful\Request::get($url)
        ->addHeaders($headers)
        ->expectsJson()
        ->send();
  		break;
  }

  try {
    # $obj = json_decode ( $response['body'], true);
  } catch(Exception $e) {
    var_dump($response);
    $obj = array();
    echo 'Caught exception: ',  $e->getMessage(), "\n";
  }

  return $response->body;
}

?>
