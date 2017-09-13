<?php
if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET)) {
  $accessToken =  $_GET['access_token'];
  if (!empty($accessToken)){
    $userDetails = fb_login_steps($accessToken);
    $userDetails = $userDetails->contact;

    $contactid = $userDetails->contactid;
    $firstname = $userDetails->firstname;
    $lastname = $userDetails->lastname;
    $address = $userDetails->address;
    $postnumber = $userDetails->postnumber;
    $postdistrict = $userDetails->postdistrict;
    $email = $userDetails->email;
    $phone= $userDetails->phone;
    $receivegeneralnewsletter = $userDetails->receivegeneralnewsletter;
    $gender = $userDetails->gender;
    $birth_day = $userDetails->birth_day;
    $birth_month = $userDetails->birth_month;
    $birth_year = $userDetails->birth_year;
    $facebook_login = $userDetails->facebook_login;
  }
}
$tempFirstname = $_COOKIE['formFirstname'];
$tempLastname = $_COOKIE['formLastname'];
$tempAddress = $_COOKIE['formAddress'];
$tempPostnumber = $_COOKIE['formPostnumber'];
$tempBy = $_COOKIE['formBy'];
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
$tempStoreSuccess = $_COOKIE['storeSuccess'];
$tempStoreSuccess = stripslashes($tempStoreSuccess);
$tempStoreSuccess = json_decode($tempStoreSuccess, true);
reset_public_information();
?>
<div class="createProfile-panel">
  <div class="row">
    <div class="medium-11 medium-centered large-9 large-centered createProfile-form-panel columns">
      <div class="row steps small-up-1 columns">
        <div class="column active">
          <a href="<?php echo site_url(); ?>/profile/personal-information/">Navn og adresse</a>
        </div>
      </div>
      <form action='<?php echo site_url(); ?>/profile/save' method="POST" data-parsley-validate data-parsley-focus="none">
        <div class="row column createProfile-form">
          <?php if(!empty($tempStoreSuccess)) { ?>
          <div class="primary callout piSuccess" data-closable>
            <?php
            echo 'Dine profiloplysninger er gemt.';
            reset_success();
            ?>
            <button class="close-button" aria-label="Dismiss primary" type="button" data-close>
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php } ?>
          <?php if(!empty($tempErrorPhone) || !empty($tempErrorEncryptedPassword) || !empty($tempErrorPassword) || !empty($tempErrorEmail)) { ?>
          <div class="alert callout piError" data-closable>
            <?php
            echo '<h5>'. $tempErrorMessage . '</h5>';
            if(!empty($tempErrorEmail)) {
            foreach($tempErrorEmail as $ErrorEmail){ echo $ErrorEmail . ' ';}
            }
            if(!empty($tempErrorPhone)) {
            foreach($tempErrorPhone as $ErrorPhone){ echo "<p>Telefonnummer: " . $ErrorPhone . '</p>'; }
            }
            if(!empty($tempErrorPassword)) {
            foreach($tempErrorPassword as $ErrorPassword){ echo "<p>Password: " . $ErrorPassword . '</p>'; }
            }
            if(!empty($tempErrorEncryptedPassword)) {
            foreach($tempErrorEncryptedPassword as $ErrorEncryptedPassword){ echo "<p>Encrypted Password: " . $ErrorEncryptedPassword . '</p>'; }
            }
            reset_public_information();
            ?>
            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php } ?>
          <div class="row">
            <div class="small-12 medium-10 medium-centered large-9 large-centered columns pi">
              <div class="large-12 columns">
                <label>Fornavn
                  <?php if (!empty($tempErrorFirstname)){ ?>
                  <input class="serverError" type="text" placeholder="<?php foreach($tempErrorFirstname as $ErrorFirstname){ echo $ErrorFirstname; }?>" name='firstname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit fornavn" data-parsley-required-message="Indtast dit fornavn" required>
                  <?php } else { ?>
                  <input  type="text" placeholder="Fornavn" name='firstname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit fornavn" data-parsley-required-message="Indtast dit fornavn" value="<?php if (!empty($tempFirstname)){ echo $tempFirstname; } else { echo $firstname; } ?>" required>
                  <?php } ?>
                </label>
              </div>
              <div class="large-12 columns">
                <label>Efternavn
                  <?php if (!empty($tempErrorLastname)){ ?>
                  <input class="serverError" type="text" placeholder="<?php foreach($tempErrorLastname as $ErrorLastname){ echo $ErrorLastname; }?>" name='lastname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit efternavn" data-parsley-required-message="Indtast dit efternavn" required>
                  <?php } else { ?>
                  <input type="text" placeholder="Efternavn" name='lastname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit efternavn" data-parsley-required-message="Indtast dit efternavn" value="<?php if (!empty($tempLastname)){ echo $tempLastname; } else { echo $lastname; } ?>" required>
                  <?php } ?>
                </label>
              </div>
              <div class="large-12 columns">
                <label>Adresse
                  <input type="text" placeholder="Adresse" name='address' data-parsley-minlength="2" data-parsley-minlength-message="Indtast venligst din adresse" data-parsley-required-message="Indtast din adresse" value="<?php if (!empty($tempAddress)){ echo $tempAddress; } else { echo $address; } ?>" required>
                </label>
              </div>
              <div class="large-4 columns">
                <label>Postnr.
                  <?php if (!empty($tempErrorPostnumber)){ ?>
                  <input class="serverError" type="text" placeholder="<?php foreach($tempErrorPostnumber as $ErrorPostnumber){ echo $ErrorPostnumber; }?>" name='postnumber' data-parsley-required-message="Indtast et gyldigt postnummer" required>
                  <?php } else { ?>
                  <input type="text" placeholder="Postnr." name='postnumber' data-parsley-required-message="Indtast et gyldigt postnummer" value="<?php if (!empty($tempPostnumber)){ echo $tempPostnumber; } else { echo $postnumber; } ?>" required>
                  <?php } ?>
                </label>
              </div>
              <div class="large-8 columns">
                <label>By
                  <?php if (!empty($tempErrorPostdistrict)){ ?>
                  <input class="serverError" type="text" placeholder="<?php foreach($tempErrorPostdistrict as $ErrorPostdistrict){ echo $ErrorPostdistrict; }?>" name='postdistrict' data-parsley-required-message="Indtast by" required>
                  <?php } else { ?>
                  <input type="text" placeholder="By" name='postdistrict' data-parsley-required-message="Indtast by" value="<?php if (!empty($tempBy)){ echo $tempBy; } else { echo $postdistrict; } ?>" required>
                  <?php } ?>
                </label>
              </div>
              <div class="large-12 columns">
                <label>E-mail
                  <input class="<?php if (!empty($tempErrorEmail)){ echo "serverError"; }?>" type="text" placeholder="Email" name='email' data-parsley-type="email" data-parsley-required-message="Indtast gyldig emailadresse" value="<?php echo $email; ?>" required>
                </label>
              </div>
              <div class="large-12 columns">
                <label>Mobilnummer
                  <input class="<?php if (!empty($tempErrorPhone)){ echo "serverError"; }?>" type="text" placeholder="Mobilnummer" name='phone' maxlength="8" data-parsley-maxlength="8" data-parsley-required-message="Indtast gyldig telefonnummer" data-parsley-type="digits" value="<?php echo $phone; ?>" >
                </label>
              </div>
              <div class="large-12 columns piRow">
                <div class="row">
                  <fieldset>
                    <div class="small-4 columns">
                      <legend>Køn (valgfrit):</legend>
                    </div>
                    <div class="small-8 columns">
                      <?php if($gender == "m"){ ?>
                      <input type="radio" name='gender' value="f" id="genderFemale"><label for="genderFemale">Kvinde</label>
                      <input type="radio" name='gender' value="m" id="genderMale" checked><label for="genderMale">Mand </label>
                      <?php } elseif($gender == "f") { ?>
                      <input type="radio" name='gender' value="f" id="genderFemale" checked><label for="genderFemale">Kvinde</label>
                      <input type="radio" name='gender' value="m" id="genderMale"><label for="genderMale">Mand</label>
                      <?php } else { ?>
                      <input type="radio" name='gender' value="f" id="genderFemale"><label for="genderFemale">Kvinde</label>
                      <input type="radio" name='gender' value="m" id="genderMale"><label for="genderMale">Mand</label>
                      <?php } ?>
                    </div>
                  </fieldset>
                </div>
              </div>
              <div class="large-12 columns piRow">
                <label>Fødselsdag (valgfrit):</label>
                <div class="row">
                  <div class="small-4 large-4 columns">
                    <select name='birth_day' id="birth_day" >
                      <option value="<?php echo $birth_day; ?>" selected hidden><?php echo $birth_day; ?></option>
                      <option value="1"  <?PHP if($day==1) echo "selected";?>>1</option>
                      <option value="2"  <?PHP if($day==2) echo "selected";?>>2</option>
                      <option value="3"  <?PHP if($day==3) echo "selected";?>>3</option>
                      <option value="4"  <?PHP if($day==4) echo "selected";?>>4</option>
                      <option value="5"  <?PHP if($day==5) echo "selected";?>>5</option>
                      <option value="6"  <?PHP if($day==6) echo "selected";?>>6</option>
                      <option value="7"  <?PHP if($day==7) echo "selected";?>>7</option>
                      <option value="8"  <?PHP if($day==8) echo "selected";?>>8</option>
                      <option value="9"  <?PHP if($day==9) echo "selected";?>>9</option>
                      <option value="10" <?PHP if($day==10) echo "selected";?>>10</option>
                      <option value="11" <?PHP if($day==11) echo "selected";?>>11</option>
                      <option value="12" <?PHP if($day==12) echo "selected";?>>12</option>
                      <option value="13" <?PHP if($day==13) echo "selected";?>>13</option>
                      <option value="14" <?PHP if($day==14) echo "selected";?>>14</option>
                      <option value="15" <?PHP if($day==15) echo "selected";?>>15</option>
                      <option value="16" <?PHP if($day==16) echo "selected";?>>16</option>
                      <option value="17" <?PHP if($day==17) echo "selected";?>>17</option>
                      <option value="18" <?PHP if($day==18) echo "selected";?>>18</option>
                      <option value="19" <?PHP if($day==19) echo "selected";?>>19</option>
                      <option value="20" <?PHP if($day==20) echo "selected";?>>20</option>
                      <option value="21" <?PHP if($day==21) echo "selected";?>>21</option>
                      <option value="22" <?PHP if($day==22) echo "selected";?>>22</option>
                      <option value="23" <?PHP if($day==23) echo "selected";?>>23</option>
                      <option value="24" <?PHP if($day==24) echo "selected";?>>24</option>
                      <option value="25" <?PHP if($day==25) echo "selected";?>>25</option>
                      <option value="26" <?PHP if($day==26) echo "selected";?>>26</option>
                      <option value="27" <?PHP if($day==27) echo "selected";?>>27</option>
                      <option value="28" <?PHP if($day==28) echo "selected";?>>28</option>
                      <option value="29" <?PHP if($day==29) echo "selected";?>>29</option>
                      <option value="30" <?PHP if($day==30) echo "selected";?>>30</option>
                      <option value="31" <?PHP if($day==31) echo "selected";?>>31</option>
                    </select>
                  </div>
                  <div class="small-4 large-4 columns">
                    <select name='birth_month' id="birth_month">
                      <option value="<?php echo $birth_month; ?>" selected hidden><?php echo $birth_month; ?></option>
                      <option value="1"  <?PHP if($month==Januar) echo "selected";?>>Januar</option>
                      <option value="2"  <?PHP if($month==Februar) echo "selected";?>>Februar</option>
                      <option value="3"  <?PHP if($month==Marts) echo "selected";?>>Marts</option>
                      <option value="4"  <?PHP if($month==April) echo "selected";?>>April</option>
                      <option value="5"  <?PHP if($month==Maj) echo "selected";?>>Maj</option>
                      <option value="6"  <?PHP if($month==Juni) echo "selected";?>>Juni</option>
                      <option value="7"  <?PHP if($month==Juli) echo "selected";?>>Juli</option>
                      <option value="8"  <?PHP if($month==August) echo "selected";?>>August</option>
                      <option value="9"  <?PHP if($month==September) echo "selected";?>>September</option>
                      <option value="10" <?PHP if($month==Oktober) echo "selected";?>>Oktober</option>
                      <option value="11" <?PHP if($month==November) echo "selected";?>>November</option>
                      <option value="12" <?PHP if($month==December) echo "selected";?>>December</option>
                    </select>
                  </div>
                  <div class="small-4 large-4 columns">
                    <select name='birth_year' id="birth_year">
                      <option value="<?php echo $birth_year; ?>" selected hidden><?php echo $birth_year; ?></option>
                      <?PHP
                      $i = date("Y") - 10 ;
                      while($i > date("Y") - 110){
                      echo "<option value='$i'>$i</option>";
                      $i--;
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <?php if ( $receivegeneralnewsletter != true ) { ?>
              <div class="large-12 columns cp2">
                <input id="receivegeneralnewsletter" type="checkbox" name='receivegeneralnewsletter'><label for="receivegeneralnewsletter">Ja tak til e-mails fra Biografklub Danmark med nyt om forpremierer til halv pris, konkurrencer samt nyheder om biografklubbens film</label>
              </div>
              <?php } else { ?>
              <div class="large-12 columns cp2">
                <input id="receivegeneralnewsletter" type="checkbox" name='receivegeneralnewsletter' checked><label for="receivegeneralnewsletter">Ja tak til e-mails fra Biografklub Danmark med nyt om forpremierer til halv pris, konkurrencer samt nyheder om biografklubbens film</label>
              </div>
              <?php } ?>
              <div class="large-12 columns cp2 accpetCheck">
                <input id="accept" type="checkbox" data-parsley-validate-if-empty data-parsley-success-class="t" data-parsley-required-message="Acceptér venligst for at fortsætte." required><label for="accept">Jeg accepterer <span class="acceptTC" data-open="profileConfirmation">betingelserne</span></label>
              </div>
              <div class="large-12 columns text-center calculatedButton">
<input type="hidden" id="contactid" name='contactid' value="<?php echo $contactid; ?>"  checked>
<input id="profileInformationFB" type="hidden" name='profileInformationFB' value="1" checked>
                <input type="submit" class="button callSpin" value="GEM">
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="large-12 columns">
  <?php $query = new WP_Query( array( 'page_id' => 223, 'post_status' => 'publish' , 'posts_per_page' => 1 ) ); ?>
  <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
  <div class="reveal" id="profileConfirmation" aria-labelledby="exampleModalHeader11" data-reveal>
    <p class="overlayHeading"><?php the_title(); ?></p>
    <div class="small-12 FilmpakkenPopUp">
      <?php the_content(); ?>
      <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
  <?php endwhile;  wp_reset_postdata(); else : ?>
  <?php _e( 'Sorry, no posts matched your criteria.' ); ?>
  <?php endif; ?>
</div>