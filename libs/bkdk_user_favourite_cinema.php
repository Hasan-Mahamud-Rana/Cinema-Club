<?php

function get_all_cinema($customerid, $lat, $lon) {
  $url = API_HOST . '/api/favorite_cinemas?lat='.$lat.'&lon='.$lon;
  $body = null;

  $response = fetch_bkdk_api_data($url, $body);
  return $response->favorite_cinemas;
}

function get_my_cinemas($customerid, $lat, $lon) {
  $url = API_HOST . '/api/contacts/' . $customerid .'/contact_favorite_cinemas?lat='.$lat.'&lon='.$lon;
  $body = null;

  $response = fetch_bkdk_api_data($url, $body);
  return $response->contact_favorite_cinemas;
}

function call_choose_cinema($customerid) {
	$favoritecinemaids = $_POST['favoritecinemaids'];
	return choose_cinema($favoritecinemaids, $customerid);
}

function choose_cinema($favoritecinemaids, $customerid) {
if (is_present($customerid)) {
	$body = array("contact_favorite_cinemas" =>
								array(
									'favoritecinemaids' => $favoritecinemaids
								)
	);
	$url = API_HOST . '/api/contacts/' . $customerid .'/contact_favorite_cinemas';

	$response = fetch_bkdk_api_data($url, $body, 'post' );
  //var_dump($response);
  return $response->contact;
  $success = $response->success;
	if ($success != true) {
			wp_redirect(site_url() . '/create-profile/step-3/');
		return null;
	}
}
}


?>