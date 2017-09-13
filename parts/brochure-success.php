<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
  $firstname = $_POST['firstname'];
  //echo $firstname;
  $lastname = $_POST['lastname'];
  //echo $lastname;
  $address = $_POST['address'];
  //echo $address;
  $postnumber = $_POST['postnumber'];
  //echo $postnumber;
  $by = $_POST['postdistrict'];
  //echo $by;
  $email = $_POST['email'];
  //echo $email;
  $phone = $_POST['phone'];
  //echo $phone;
  $receivegeneralnewsletter = $_POST['receivegeneralnewsletter'];
  $currentlink = $_POST['currentlink'];
  //echo $currentlink;

  $brochureproductid = $_POST['brochureproductid'];
  //echo $brochureproductid;
  $quantity = $_POST['quantity'];
  //echo $quantity;
  $price = $_POST['price'];
  //echo $price;
}

$customerid = get_customerid();
if (empty($customerid) || $customerid == NULL || $customerid == ' ' ) {
  call_brochure_create_profile();
  store_user_public_information_error($errorMessage, $errorFirstname, $errorLastname, $errorPostnumber, $errorPostdistrict, $errorPhone, $errorEmail, $errorPassword, $errorPasswordConfirmation, $errorEncryptedPassword);
}
else {
  cfc_update_profile($customerid);
  call_order_brochure($customerid);
}

?>
<div class="brochure">
  <div class="row">
    <div class="medium-8 medium-centered large-8 large-centered createProfile-form-panel columns">
      <div class="row steps columns">
        <div class="small-12 active columns">
          <?php the_title(); ?>
        </div>
      </div>
      <div class="row column createProfile-form">
        <div class="large-12 columns">
          <?php the_content(); ?>
        </div>
        <div class="large-12 columns text-center calculatedButton">
          <a class="button callSpin" href="<?php echo site_url(); ?>/movies/">LÆS OM FILMENE</a>
        </div>
      </div>
    </div>
  </div>
</div>