<?php
function urlForApp(){
  $urlForApp = ($_GET['urlForApp'] == 1 || $_GET['category_name'] != null || $_GET['s'] != null);
  return $urlForApp;
 }

function findReplace(){
  $findDate = array( 'Sunday','Monday','Wednesday','Tuesday','Thursday','Friday','Saturday','January','February','March','April','May','June','July','August','September','October','November','December');

  $replaceDate = array( 'søndag','mandag','onsdag','tirsdag','torsdag','fredag','lørdag','januar','februar','marts','april','maj','juni','juli','august','september','oktober','november','december');
  return array($findDate, $replaceDate);
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

/*
 //create function with an exception
function checkNum($number) {
  if($number>1) {
    throw new Exception("Der er opstået en fejl på grund af travlhed på serveren. Prøv venligst igen");
  }
  return true;
}

//trigger exception in a "try" block
try {
  checkNum(1);
  //If the exception is thrown, this text will not be shown
  echo 'If you see this, the number is 1 or below';
}

//catch exception
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}*/
?>