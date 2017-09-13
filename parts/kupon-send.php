<?php
if ( is_bkdk_user_logged_in() != true ) {
  wp_redirect(site_url().'/movies');
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
  $barcodeComplete =  $_POST['barcodeComplete'];
  $name =  $_POST['myname'];
  $email =  $_POST['email'];
  $message =  $_POST['message'];
  $fafFilmid =  $_POST['fafFilmid'];
  $wpSlugName =  $_POST['wpSlugName'];
  $countValue =  $_POST['countValue'];
  $wp_movie_id =  $_POST['wp_movie_id'];
  $currentlink = $_POST['currentlink'];
}

  $customerid = get_customerid();
  send_single_movie_kupon($customerid, $barcodeComplete, $name, $email, $message);
?>