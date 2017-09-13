<script type="text/javascript">
document.location.href = String( document.location.href ).replace( "#", "&" );
</script>
<?php

if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET)) {
	$accessToken =  $_GET['access_token'];
}
if (is_bkdk_user_logged_in() != true || $customerid == NULL || $customerid  == ' ')  {
	if (!empty($accessToken)){
		fb_login($accessToken);
	}
}

$storeCodeFB =  $_COOKIE['storeCodeFB'];
$customerid = get_customerid();

if (!empty($accessToken) && !empty($customerid)){
	fb_login_with_id($accessToken, $customerid);
}

if(!empty($storeCodeFB)){
	if(strlen($storeCodeFB) === 17){
		wp_redirect(site_url().'/gem-papirkuponer/save/');
	} else{
		wp_redirect(site_url().'/gem-papirmedlemskab/save/');
	}
}

?>
