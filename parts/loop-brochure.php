<?php
$current_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$customerid = get_customerid();
$userDetails = get_user_info($customerid);
//var_dump($userDetails);
$firstname = $userDetails->firstname;
$lastname = $userDetails->lastname;
$address = $userDetails->address;
$postnumber = $userDetails->postnumber;
$postdistrict = $userDetails->postdistrict;
$email = $userDetails->email;
$phone= $userDetails->phone;
$receivegeneralnewsletter = $userDetails->receivegeneralnewsletter;
$flexValue =  $_COOKIE['basketFlexNumber'];
$basisNumber =  $_COOKIE['basketBasisNumber'];
$premiumNumber =  $_COOKIE['basketPremiumNumber'];
$tempFirstname = $_COOKIE['formFirstname'];
$tempLastname = $_COOKIE['formLastname'];
$tempAddress = $_COOKIE['formAddress'];
$tempPostnumber = $_COOKIE['formPostnumber'];
$tempBy = $_COOKIE['formBy'];

function randomPassword() {
  $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789!@#$%^&*()";
  $pass = array();
  $alphaLength = strlen($alphabet) - 1;
  for ($i = 0; $i < 8; $i++) {
  $n = rand(0, $alphaLength);
  $pass[] = $alphabet[$n];
}
  return implode($pass);
}
$get_all_orderable_brochures = get_all_orderable_brochures();
$brochureproductid = $get_all_orderable_brochures[0]->brochureproductid;
$price = $get_all_orderable_brochures[0]->price;

$randomPassword = randomPassword();
$tempErrorMessage = $_COOKIE['formErrorMessage'];
$tempErrorFirstname = $_COOKIE['formErrorFirstname'];
$tempErrorFirstname = stripslashes($tempErrorFirstname);
$tempErrorFirstname = json_decode($tempErrorFirstname, true);
$tempErrorLastname = $_COOKIE['formErrorLastname'];
$tempErrorLastname = stripslashes($tempErrorLastname);
$tempErrorLastname = json_decode($tempErrorLastname, true);
$tempErrorPostnumber = $_COOKIE['formErrorPostnumber'];
$tempErrorPostnumber = stripslashes($tempErrorPostnumber);
$tempErrorPostnumber = json_decode($tempErrorPostnumber, true);
$tempErrorPostdistrict = $_COOKIE['formErrorPostdistrict'];
$tempErrorPostdistrict = stripslashes($tempErrorPostdistrict);
$tempErrorPostdistrict = json_decode($tempErrorPostdistrict, true);
$tempErrorPhone = $_COOKIE['formErrorPhone'];
$tempErrorPhone = stripslashes($tempErrorPhone);
$tempErrorPhone = json_decode($tempErrorPhone, true);
$tempErrorEmail = $_COOKIE['formErrorEmail'];
$tempErrorEmail = stripslashes($tempErrorEmail);
$tempErrorEmail = json_decode($tempErrorEmail, true);
$tempErrorPassword = $_COOKIE['formErrorPassword'];
$tempErrorPassword = stripslashes($tempErrorPassword);
$tempErrorPassword = json_decode($tempErrorPassword, true);
$tempErrorPasswordConfirmation = $_COOKIE['formErrorPasswordConfirmation'];
$tempErrorPasswordConfirmation = stripslashes($tempErrorPasswordConfirmation);
$tempErrorPasswordConfirmation = json_decode($tempErrorPasswordConfirmation, true);
$tempErrorEncryptedPassword = $_COOKIE['formErrorEncryptedPassword'];
$tempErrorEncryptedPassword = stripslashes($tempErrorEncryptedPassword);
$tempErrorEncryptedPassword = json_decode($tempErrorEncryptedPassword, true);


$tempErrorMessage = $_COOKIE['formErrorMessage'];
$tempErrorPurchase = $_COOKIE['formErrorPurchase'];
$tempErrorPurchase = stripslashes($tempErrorPurchase);
$tempErrorPurchase = json_decode($tempErrorPurchase, true);
reset_public_information();
?>
<div class="brochure">
  <div class="row">
    <div class="medium-10 medium-centered large-8 large-centered createProfile-form-panel columns">
      <div class="row steps columns">
        <div class="small-12 active columns">
          <?php the_title(); ?>
        </div>
      </div>
      <form id="brochure" action='<?php echo site_url(); ?>/brochure/success/' method="POST" data-parsley-validate data-parsley-focus="none">
        <div class="row column createProfile-form">
          <div class="large-12 columns">
            <?php the_content(); ?>
          </div>
          <?php if(!empty($customerid)){
          if (!empty($tempErrorPhone) || !empty($tempErrorEmail)){ ?>
          <div class="large-12 columns"><div class="alert callout piError" data-closable>
            <?php
            echo '<h5>'. $tempErrorMessage . '</h5>';
            if(!empty($tempErrorEmail)) {
            foreach($tempErrorEmail as $ErrorEmail){ echo $ErrorEmail . ' ';}
            }
            if(!empty($tempErrorPhone)) {
            foreach($tempErrorPhone as $ErrorPhone){ echo "<p>Telefonnummer: " . $ErrorPhone . '</p>'; }
            }
            reset_public_information();
            ?>
            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
            <span aria-hidden="true">&times;</span>
            </button>
          </div></div>
          <?php } }?>
          <?php
          if (!empty($tempErrorPurchase)){ ?>
          <div class="large-12 columns"><div class="alert callout piError" data-closable>
            <?php
            echo '<h5>'. $tempErrorMessage . '</h5>';
            if(!empty($tempErrorPurchase)) {
            foreach($tempErrorPurchase as $ErrorPurchase){ echo $ErrorPurchase . ' ';}
            }
            reset_order_error();
            ?>
            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
            <span aria-hidden="true">&times;</span>
            </button>
          </div></div>
          <?php } ?>
          <div class="small-12 medium-10 medium-centered large-9 large-centered">
            <div class="large-12 columns">
              <?php if (!empty($tempErrorFirstname)){ ?>
              <input class="serverError" type="text" placeholder="<?php foreach($tempErrorFirstname as $ErrorFirstname){ echo $ErrorFirstname; }?>" name='firstname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit fornavn" data-parsley-required-message="Indtast dit fornavn" required>
              <?php } else { ?>
              <input  type="text" placeholder="Fornavn" name='firstname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit fornavn" data-parsley-required-message="Indtast dit fornavn" value="<?php if (!empty($tempFirstname)){ echo $tempFirstname; } else { echo $firstname; } ?>" required>
              <?php } ?>
            </div>
            <div class="large-12 columns">
              <?php if (!empty($tempErrorLastname)){ ?>
              <input class="serverError" type="text" placeholder="<?php foreach($tempErrorLastname as $ErrorLastname){ echo $ErrorLastname; }?>" name='lastname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit efternavn" data-parsley-required-message="Indtast dit efternavn" required>
              <?php } else { ?>
              <input type="text" placeholder="Efternavn" name='lastname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit efternavn" data-parsley-required-message="Indtast dit efternavn" value="<?php if (!empty($tempLastname)){ echo $tempLastname; } else { echo $lastname; } ?>" required>
              <?php } ?>
            </div>
            <div class="large-12 columns">
              <input type="text" placeholder="Adresse" name='address' data-parsley-minlength="2" data-parsley-minlength-message="Indtast venligst din adresse" data-parsley-required-message="Indtast din adresse" value="<?php if (!empty($tempAddress)){ echo $tempAddress; } else { echo $address; } ?>" required>
            </div>
            <div class="large-4 columns">
              <?php if (!empty($tempErrorPostnumber)){ ?>
              <input class="serverError" type="text" placeholder="<?php foreach($tempErrorPostnumber as $ErrorPostnumber){ echo $ErrorPostnumber; }?>" name='postnumber' data-parsley-required-message="Indtast et gyldigt postnummer" required>
              <?php } else { ?>
              <input type="text" placeholder="Postnr." name='postnumber' data-parsley-required-message="Indtast et gyldigt postnummer" value="<?php if (!empty($tempPostnumber)){ echo $tempPostnumber; } else { echo $postnumber; } ?>" required>
              <?php } ?>
            </div>
            <div class="large-8 columns">
              <?php if (!empty($tempErrorPostdistrict)){ ?>
              <input class="serverError" type="text" placeholder="<?php foreach($tempErrorPostdistrict as $ErrorPostdistrict){ echo $ErrorPostdistrict; }?>" name='postdistrict' data-parsley-required-message="Indtast by" required>
              <?php } else { ?>
              <input type="text" placeholder="By" name='postdistrict' data-parsley-required-message="Indtast by" value="<?php if (!empty($tempBy)){ echo $tempBy; } else { echo $postdistrict; } ?>" required>
              <?php } ?>
            </div>
            <div class="large-12 columns">
              <?php if (!empty($customerid)){ ?>
              <input class="<?php if (!empty($tempErrorEmail)){ echo "serverError"; }?>" type="text" placeholder="<?php if(!empty($tempErrorEmail)){foreach($tempErrorEmail as $ErrorEmail){ echo $ErrorEmail . ' ';}} else {echo "Email";}?>"  name='email' data-parsley-type="email" data-parsley-required-message="Indtast gyldig emailadresse" value="<?php echo $email; ?>" required>
              <?php } else { ?>
              <input class="t<?php if (!empty($tempErrorEmail)){ echo "serverError"; }?>" type="text" placeholder="Email" name='email' data-parsley-type="email" data-parsley-required-message="Indtast gyldig emailadresse" value="<?php echo $email; ?>" required>
              <?php } ?>
            </div>
            <div class="large-12 columns">
              <?php if (!empty($customerid)){ ?>
              <input class="<?php if (!empty($tempErrorPhone)){ echo "serverError"; }?>" type="text"  placeholder="<?php  if(!empty($tempErrorPhone)){foreach($tempErrorPhone as $ErrorPhone){ echo $ErrorPhone;}}else {echo "Mobilnummer (ikke påkrævet)";}?>" name='phone' maxlength="8" data-parsley-maxlength="8" data-parsley-required-message="Indtast gyldig telefonnummer" data-parsley-type="digits" value="<?php echo $phone; ?>" >
              <?php } else { ?>
              <input class="<?php if (!empty($tempErrorPhone)){ echo "serverError"; }?>" type="text" placeholder="Mobilnummer (ikke påkrævet)" name='phone' maxlength="8" data-parsley-maxlength="8" data-parsley-required-message="Indtast gyldig telefonnummer" data-parsley-type="digits" value="<?php echo $phone; ?>" >
              <?php } ?>
            </div>
            <?php if ( is_bkdk_user_logged_in() != true ) { ?>
            <div class="large-12 columns">
              <input type="hidden" placeholder="Angiv en adgangskode" name='password' minlength="8" id="password" data-parsley-required-message="Kodeord skal bestå af mindst 8 cifre" value="<?php echo $randomPassword; ?>" required>
            </div>
            <div class="large-12 columns">
              <input type="hidden" placeholder="Gentag adgangskode" name='password_confirmation' minlength="8" data-parsley-equalto="#password" data-parsley-required-message="Kodeord og bekræft kodeord er ikke ens" value="<?php echo $randomPassword; ?>" required>
            </div>
            <?php }  ?>
            <?php if ( $receivegeneralnewsletter == true ) { ?>
              <div class="large-12 columns cp2" style="display: none">
                <input id="receivegeneralnewsletter" type="checkbox" name='receivegeneralnewsletter' checked><label for="receivegeneralnewsletter">Ja tak til e-mails fra Biografklub Danmark med nyt om forpremierer til halv pris, konkurrencer samt nyheder om biografklubbens film</label>
              </div>
            <?php } ?>
            <div class="large-12 columns piRow">
              <div class="row">
                <div class="large-4 columns">
                  <select name='quantity' id="quantity" required data-parsley-required-message="Indtast gyldig mængde">
                    <option value="default" disabled selected hidden>Antal</option>
                    <?PHP
                    $i = 1;
                    while($i <= 99){
                    echo "<option value='$i'>$i</option>";
                    $i++;
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="large-12 columns text-center calculatedButton">
              <input type="hidden" name="currentlink" value="<?php echo $current_link; ?>" />
              <input type="hidden" name="brochureproductid" value="<?php echo $brochureproductid; ?>" />
              <input type="hidden" name="price" value="<?php echo $price; ?>" />
              <input type="submit" class="button callSpin" value="NÆSTE">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>