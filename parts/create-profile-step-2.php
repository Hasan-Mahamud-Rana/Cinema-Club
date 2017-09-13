<?php
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
  $password = $_POST['password'];
  $password_confirmation = $_POST['password_confirmation'];
  $currentlink = $_POST['currentlink'];
  $informationfromfb = $_POST['informationfromfb'];
  store_user_public_information($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $password, $password_confirmation);
  $gender = $_POST['gender'];
  $birth_day = $_POST['birth_day'];
  $birth_month = $_POST['birth_month'];
  $birth_year = $_POST['birth_year'];
  $facebook_login = $_POST['facebook_login'];
}


if($informationfromfb == 1){
  call_for_update_profile_fb($contactid);
} else {
  call_for_create_profile();
}

?>
<div class="createProfile-panel cp2">
  <div class="row">
    <div class="medium-8 medium-centered large-8 large-centered createProfile-form-panel columns">
      <div class="row profileSteps columns">
        <div class="large-4 columns">
          Navn og adresse
        </div>
        <div class="large-4 active sa columns">
          Om dig
        </div>
        <div class="large-4 si columns">
          Favoritbiograf
        </div>
      </div>
      <form action='<?php echo site_url(); ?>/create-profile/step-3/' method="POST" accept-charset="UTF-8" data-parsley-validate>
        <div class="row column createProfile-form">
          <div class="large-12 columns">
            <label>Fødselsdag (valgfrit):</label>
            <div class="row">
              <div class="large-4 columns">
                <select name='birth_day' id="birth_day">
                <?php if(!empty($birth_day)){ ?>
                  <option value="<?php echo $birth_day; ?>" selected hidden><?php echo $birth_day; ?></option>
                <?php } else { ?>
                  <option value="default" disabled selected hidden>Dato</option>
                <?php } ?>
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
              <div class="large-4 columns">
              <select name='birth_month' id="birth_month">
                <?php if(!empty($birth_month)){ ?>
                  <option value="<?php echo $birth_month; ?>" selected hidden><?php echo $birth_month; ?></option>
                <?php } else { ?>
                  <option value="default" disabled selected hidden>Måned</option>
                <?php } ?>
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
              <div class="large-4 columns">
                <select name='birth_year' id="birth_year">
                <?php if(!empty($birth_year)){ ?>
                  <option value="<?php echo $birth_year; ?>" selected hidden><?php echo $birth_year; ?></option>
                <?php } else { ?>
                  <option value="default" disabled selected hidden>År</option>
                <?php } ?>
                  <?PHP
                  $i = date("Y") - 10;
                  while($i > date("Y") - 110){
                  echo "<option value='$i'>$i</option>";
                  $i--;
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="large-12 columns genderBlock">
            <div class="row">
              <fieldset>
                <div class="small-3 columns">
                  <legend>Køn (valgfrit):</legend>
                </div>
                <div class="small-9 columns">
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
          <div class="large-12 columns">
            <input id="receivegeneralnewsletter" type="checkbox" name='receivegeneralnewsletter'><label for="receivegeneralnewsletter">Ja tak til e-mails fra Biografklub Danmark med nyt om forpremierer til halv pris, konkurrencer samt nyheder om biografklubbens film</label>
          </div>
          <div class="large-12 columns accpetCheck">
            <input id="accept" type="checkbox" data-parsley-validate-if-empty data-parsley-success-class="t" data-parsley-required-message="Acceptér venligst for at fortsætte." required><label for="accept">Jeg accepterer <span class="acceptTC" data-open="profileConfirmation">betingelserne</span></label>
          </div>
          <div class="large-12 columns text-center calculatedButton">
            <input name="utf8" type="hidden" value="✓" />
            <input type="submit" class="button callSpin" value="NÆSTE">
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