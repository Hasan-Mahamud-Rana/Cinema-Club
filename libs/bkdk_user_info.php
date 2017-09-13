<?php
function get_user_info($customerid) {
  if ( $customerid == null || $customerid == undefined )
  {
    return null;
  }

 if ($GLOBALS['customer_data-' .  $customerid] == null)
 {
   $url = API_HOST . '/api/contacts/' . $customerid;
   $body = null;

   $response = fetch_bkdk_api_data($url, $body);
   $GLOBALS['customer_data-' .  $customerid] = $response->contact;
 }
  return $GLOBALS['customer_data-' .  $customerid];
}

?>