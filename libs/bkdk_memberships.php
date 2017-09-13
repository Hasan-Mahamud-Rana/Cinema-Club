<?php

function get_all_memberships() {
  $url = API_HOST . '/api/memberships';
  $body = null;

  $response = fetch_bkdk_api_data($url, $body);
  return $response->memberships;
}

function get_membership_product($membership_product_id) {
  $url = API_HOST . '/api/memberships/'. $membership_product_id;
  $body = null;

  $response = fetch_bkdk_api_data($url, $body);
  return $response->membership_product;
}

function get_my_memberships($customerid) {

  $url = API_HOST . '/api/contacts/' . $customerid . '/memberships';
  //$url = API_HOST . '/api/memberships?contact_id=' . $customerid;
  $body = null;

  $response = fetch_bkdk_api_data($url, $body);
  return $response->memberships;
}

function get_single_membership($customerid, $membershiporderlineid ){
	$membershiporderlineid = $_POST['membershiporderlineid'];
	if (is_present($membershiporderlineid) && is_present($customerid) ) {
		$url = API_HOST . '/api/contacts/' . $customerid . '/memberships/' . $membershiporderlineid;
		$body = null;

		$response = fetch_bkdk_api_data($url, $body);
		return $response->membership;
	}
}

function cancel_flex_membership($customerid, $membershiporderlineid ){
  $membershiporderlineid = $_POST['membershiporderlineid'];
  if (is_present($membershiporderlineid) && is_present($customerid) ) {
    $url = API_HOST . '/api/contacts/' . $customerid . '/memberships/' . $membershiporderlineid;
    $body = null;

    $response = fetch_bkdk_api_data($url, $body, 'delete');
    //var_dump($response);
    return $response->membership;
  }
}

function skip_flex_membership($customerid, $membershiporderlineid ){
  $membershiporderlineid = $_POST['membershiporderlineid'];
  if (is_present($membershiporderlineid) && is_present($customerid) ) {
    $url = API_HOST . '/api/contacts/' . $customerid . '/memberships/' . $membershiporderlineid . '/skip';
    $body = null;

    $response = fetch_bkdk_api_data($url, $body, 'put');
    return $response->membership;
  }
}

function undo_skip_flex_membership($customerid, $membershiporderlineid ){
  $membershiporderlineid = $_POST['membershiporderlineid'];
  if (is_present($membershiporderlineid) && is_present($customerid) ) {
    $url = API_HOST . '/api/contacts/' . $customerid . '/memberships/' . $membershiporderlineid . '/undo-skip';
    $body = null;

    $response = fetch_bkdk_api_data($url, $body, 'put');
    return $response->membership;
  }
}
?>