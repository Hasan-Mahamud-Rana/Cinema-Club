<?php
/*
Template Name: Pdf Generator
*/
if ( is_bkdk_user_logged_in() != true ) {
wp_redirect(site_url().'/movies');
}
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
	{
		$printAll =  $_POST['printAll'];
		$fafFilmid =  $_POST['fafFilmid'];
		$wpSlugName =  $_POST['wpSlugName'];
		$printMe =  $_POST['printMe'];
		$barcodeComplete =  $_POST['barcode_complete'];
	}
	$customerid = get_customerid();
	if ($printAll == 1){
		$getAllKupon = print_all_kupon($customerid, $fafFilmid, $wpSlugName);
	}
	if ($printMe == 1){
		$getSingleKupon = print_single_kupon($customerid, $fafFilmid, $wpSlugName, $barcodeComplete);
	}
?>