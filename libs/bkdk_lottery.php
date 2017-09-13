<?php

function get_lottery_details($customerid) {
  $url = API_HOST . '/api/contacts/' . $customerid . '/lottery_tickets';
  $body = null;

  $response = fetch_bkdk_api_data($url, $body);
  return $response->lottery_tickets;
}

?>