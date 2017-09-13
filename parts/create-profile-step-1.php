<?php
if ( is_bkdk_user_logged_in() == true ) {
wp_redirect(site_url().'/movies/');
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
$code =  $_POST['code'];
store_code($code);
}
$tempFirstname = $_COOKIE['formFirstname'];
$tempLastname = $_COOKIE['formLastname'];
$tempAddress = $_COOKIE['formAddress'];
$tempPostnumber = $_COOKIE['formPostnumber'];
$tempBy = $_COOKIE['formBy'];
$tempEmail = $_COOKIE['formEmail'];
$tempPhone = $_COOKIE['formPhone'];
$tempPassword = $_COOKIE['formPassword'];
$tempPassword_confirmation = $_COOKIE['formPassword_confirmation'];
$current_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
reset_public_information();
?>
<div class="createProfile-panel">
  <div class="row">
    <div class="medium-8 medium-centered large-8 large-centered createProfile-form-panel columns">
      <div class="row profileSteps columns">
        <div class="large-4 active columns">
          Navn og adresse
        </div>
        <div class="large-4 si columns">
          Om dig
        </div>
        <div class="large-4 sa columns">
          Favoritbiograf
        </div>
      </div>
      <form class="createProfile" action='<?php echo site_url(); ?>/create-profile/step-2/' method="POST" accept-charset="UTF-8" data-parsley-validate data-parsley-focus="none">
        <div class="row column createProfile-form">
          <?php if (!empty($tempErrorFirstname)){ ?>
          <div class="large-12 columns serverError">
            <input type="text" placeholder="<?php foreach($tempErrorFirstname as $ErrorFirstname){ echo $ErrorFirstname; }?>" name='firstname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit fornavn" data-parsley-required-message="Indtast dit fornavn" required>
          </div>
          <?php } else { ?>
          <div class="large-12 columns">
            <input type="text" placeholder="Fornavn" name='firstname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit fornavn" data-parsley-required-message="Indtast dit fornavn" value="<?php echo $tempFirstname; ?>" required>
          </div>
          <?php } ?>
          <?php if (!empty($tempErrorLastname)){ ?>
          <div class="large-12 columns serverError">
            <input type="text" placeholder="<?php foreach($tempErrorLastname as $ErrorLastname){ echo $ErrorLastname; }?>" name='lastname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit efternavn" data-parsley-required-message="Indtast dit efternavn" required>
          </div>
          <?php } else { ?>
          <div class="large-12 columns">
            <input type="text" placeholder="Efternavn" name='lastname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit efternavn" data-parsley-required-message="Indtast dit efternavn" value="<?php echo $tempLastname; ?>" required>
          </div>
          <?php } ?>
          <div class="large-12 columns">
            <input type="text" placeholder="Adresse" name='address' data-parsley-minlength="2" data-parsley-minlength-message="Indtast venligst din adresse" data-parsley-required-message="Indtast din adresse" value="<?php echo $tempAddress; ?>" required>
          </div>
          <?php if (!empty($tempErrorPostnumber)){ ?>
          <div class="large-3 columns serverError">
            <input type="text" placeholder="<?php foreach($tempErrorPostnumber as $ErrorPostnumber){ echo $ErrorPostnumber; }?>" name='postnumber' data-parsley-required-message="Indtast et gyldigt postnummer" required>
          </div>
          <?php } else { ?>
          <div class="large-3 columns">
            <input type="text" placeholder="Postnr." name='postnumber' data-parsley-required-message="Indtast et gyldigt postnummer" value="<?php echo $tempPostnumber; ?>" required>
          </div>
          <?php } ?>
          <?php if (!empty($tempErrorPostdistrict)){ ?>
          <div class="large-9 columns serverError">
            <input type="text" placeholder="<?php foreach($tempErrorPostdistrict as $ErrorPostdistrict){ echo $ErrorPostdistrict; }?>" name='postdistrict' data-parsley-required-message="Indtast by" value="<?php echo $tempBy; ?>" required>
          </div>
          <?php } else { ?>
          <div class="large-9 columns">
            <input type="text" placeholder="By" name='postdistrict' data-parsley-required-message="Indtast by" value="<?php echo $tempBy; ?>" required>
          </div>
          <?php } ?>
          <?php if (!empty($tempErrorEmail)){ ?>
          <div class="large-12 columns serverError">
            <input type="text" placeholder="<?php foreach($tempErrorEmail as $ErrorEmail){ echo $ErrorEmail . ' '; }?>" name='email' data-parsley-type="email" data-parsley-required-message="Indtast gyldig emailadresse" required>
          </div>
          <?php } else { ?>
          <div class="large-12 columns">
            <input type="text" placeholder="Email" name='email' data-parsley-type="email" data-parsley-required-message="Indtast gyldig emailadresse" value="<?php echo $tempEmail; ?>" required>
          </div>
          <?php } ?>
          <?php if (!empty($tempErrorPhone)){ ?>
          <div class="large-12 columns serverError">
            <input type="text" placeholder="<?php foreach($tempErrorPhone as $ErrorPhone){ echo "Mobilnummer: " . $ErrorPhone; } ?>" name='phone' maxlength="8" data-parsley-maxlength="8" data-parsley-required-message="Indtast gyldig telefonnummer" data-parsley-type="digits" >
          </div>
          <?php } else { ?>
          <div class="large-12 columns">
            <input type="text" placeholder="Mobilnummer (ikke påkrævet)" name='phone' maxlength="8" data-parsley-maxlength="8" data-parsley-required-message="Indtast gyldig telefonnummer" data-parsley-type="digits" value="<?php echo $tempPhone; ?>" >
          </div>
          <?php } ?>
          <?php if (!empty($tempErrorPassword)){ ?>
          <div class="large-12 columns serverError">
            <input type="password" placeholder="<?php foreach($tempErrorPassword as $ErrorPassword){ echo $ErrorPassword; } ?>" name='password' minlength="8" id="password" data-parsley-required-message="Kodeord skal bestå af mindst 8 cifre" required>
          </div>
          <?php } elseif (!empty($tempErrorEncryptedPassword)){ ?>
          <div class="large-12 columns serverError">
            <input type="password" placeholder="<?php foreach($tempErrorEncryptedPassword as $ErrorEncryptedPassword){ echo $ErrorEncryptedPassword; } ?>" name='password' minlength="8" id="password" data-parsley-required-message="Kodeord skal bestå af mindst 8 cifre" required>
          </div>
          <?php } else { ?>
          <div class="large-12 columns">
            <input type="password" placeholder="Angiv en adgangskode (mindst 8 tegn)" name='password' minlength="8" id="password" data-parsley-required-message="Kodeord skal bestå af mindst 8 cifre" value="<?php echo $tempPassword; ?>" required>
          </div>
          <?php } ?>
          <?php if (!empty($tempErrorPasswordConfirmation)){ ?>
          <div class="large-12 columns serverError">
            <input type="password" placeholder="<?php foreach($tempErrorPasswordConfirmation as $ErrorPasswordConfirmation){ echo $ErrorPasswordConfirmation; } ?>" name='password_confirmation' minlength="8" data-parsley-equalto="#password" data-parsley-required-message="Kodeord og bekræft kodeord er ikke ens" required>
          </div>
          <?php } else { ?>
          <div class="large-12 columns">
            <input type="password" placeholder="Gentag adgangskode" name='password_confirmation' minlength="8" data-parsley-equalto="#password" data-parsley-required-message="Kodeord og bekræft kodeord er ikke ens" value="<?php echo $tempPassword_confirmation; ?>" required>
          </div>
          <?php } ?>
          <div class="large-12 columns text-center calculatedButton">
            <input type="hidden" name="currentlink" value="<?php echo $current_link; ?>" />
            <input name="utf8" type="hidden" value="✓" />
            <input type="submit" class="button callSpin" value="NÆSTE">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>