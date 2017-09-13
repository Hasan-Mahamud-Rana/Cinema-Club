<?php
if ( is_bkdk_user_logged_in() != true ) {
  wp_redirect(site_url().'/login/');
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
{
  $contactid = $_POST['contactid'];

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $address = $_POST['address'];
  $postnumber = $_POST['postnumber'];
  $by = $_POST['postdistrict'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $gender = $_POST['gender'];
  $birth_day = $_POST['birth_day'];
  $birth_month = $_POST['birth_month'];
  $birth_year = $_POST['birth_year'];

  $receivegeneralnewsletter = $_POST['receivegeneralnewsletter'];
  $receive_season_newsletter = $_POST['receive_season_newsletter'];
  $receive_voucher_newsletter = $_POST['receive_voucher_newsletter'];
  $receive_lottery_newsletter = $_POST['receive_lottery_newsletter'];
  $receive_survey_newsletter = $_POST['receive_survey_newsletter'];

  $notifications = $_POST['notifications'];
  $profileInformation = $_POST['profileInformation'];
  $profileInformationFB = $_POST['profileInformationFB'];

  $favoritecinemaids = $_POST['favoritecinemaids'];
  $removedcinemaids = $_POST['removedcinemaids'];
  $favouriteCinema = $_POST['favouriteCinema'];

  $cardupdate = $_POST['cardupdate'];
  $cardHolderName = $_POST['cardHolderName'];
  $month = $_POST['month'];
  $year = $_POST['expire'];
  $verification_value = $_POST['verification_value'];
  $card_type = $_POST['card_type'];
  $userIP = $_POST['userip'];
  $membershiporderlineid = $_POST['membershiporderlineid'];
}


  if ($profileInformationFB == 1 ) {
    call_facebook_update_profile($contactid);
  }

  $customerid = get_customerid();

  if ($profileInformation == 1 ) {
    call_profile_settings_update_profile($customerid);
  }

  if($notifications == 1){
    call_profile_settings_notifications($customerid);
  }
  if($favouriteCinema == 1 && !empty($favoritecinemaids)){
    call_profile_settings_favourite_cinema($customerid);
  }
  if($favouriteCinema == 1 && !empty($removedcinemaids)){
    call_profile_settings_remove_cinema($customerid);
  }

  if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET)) {
    $remove_fb_login =  $_GET['remove_fb_login'];
  }
  if($remove_fb_login == 1){
    facebook_disconnect($remove_fb_login, $customerid);
  }

 if ($cardupdate == 1 ) {
    call_update_card($customerid);
  }
?>