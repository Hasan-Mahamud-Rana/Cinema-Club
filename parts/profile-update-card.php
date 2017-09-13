<?php
$userIP = get_client_ip();
$customerid = get_customerid();
if ($customerid != NULL || $customerid  != ' ') {
$userDetails = get_user_info($customerid);
$activeFlexMembership = $userDetails->active_flex_membership;
}
$myMemberships = get_my_memberships($customerid);
foreach($myMemberships as $myMembership){
$membershipproductid = $myMembership->membershipproductid;
$membershipProductTypeName = $myMembership->membership_product_type_name;
$active = $myMembership->active;
  if ($membershipProductTypeName == "FlexPackage" && $active== true){
    $membershiporderlineid = $myMembership->membershiporderlineid;
    $cardNumber = $myMembership->card_number;
    $cardNumber = (string)$cardNumber;
    $addHyphen = str_split($cardNumber, "4");
    $cardNumber_new_format = implode("-", $addHyphen);
    $cardExpMonth = $myMembership->card_exp_month;
    $cardExpYear = $myMembership->card_exp_year;
    $cardName = $myMembership->card_name;
    $cardType = $myMembership->card_type;
    $flexAvailable = 1;
  }
}
$tempErrorMessage = $_COOKIE['formErrorMessage'];
$tempSuccessMessage = $_COOKIE['formSuccessMessage'];
$tempErrorDeliveryMethod = $_COOKIE['formErrorDeliveryMethod'];
$tempErrorDeliveryMethod = stripslashes($tempErrorDeliveryMethod);
$tempErrorDeliveryMethod = json_decode($tempErrorDeliveryMethod, true);
$tempErrorBasketTotalcost = $_COOKIE['formErrorBasketTotalcost'];
$tempErrorBasketTotalcost = stripslashes($tempErrorBasketTotalcost);
$tempErrorBasketTotalcost = json_decode($tempErrorBasketTotalcost, true);
$tempErrorPurchase = $_COOKIE['formErrorPurchase'];
$tempErrorPurchase = stripslashes($tempErrorPurchase);
$tempErrorPurchase = json_decode($tempErrorPurchase, true);
$tempErrorLastname = $_COOKIE['formErrorLastname'];
$tempErrorLastname = stripslashes($tempErrorLastname);
$tempErrorLastname = json_decode($tempErrorLastname, true);
$tempErrorYear = $_COOKIE['formErrorYear'];
$tempErrorYear = stripslashes($tempErrorYear);
$tempErrorYear = json_decode($tempErrorYear, true);
$tempErrorNumber = $_COOKIE['formErrorNumber'];
$tempErrorNumber = stripslashes($tempErrorNumber);
$tempErrorNumber = json_decode($tempErrorNumber, true);
reset_update_card_error_success();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
  <div class="createProfile-panel cBlock updateCard-panel">
    <div class="row">
      <div class="medium-11 medium-centered large-9 large-centered createProfile-form-panel">
        <div class="row steps small-up-1 medium-up-4 large-up-4 columns">
          <div class="column">
            <a class="callSpin" href="<?php echo site_url(); ?>/profile/personal-information/">Navn og adresse</a>
          </div>
          <div class="column sa">
            <a class="callSpin" href="<?php echo site_url(); ?>/profile/notifications/">Notifikationer</a>
          </div>
          <div class="column sa">
            <a class="callSpin" href="<?php echo site_url(); ?>/profile/favourite-cinema/">Din favoritbiograf</a>
          </div>
          <div class="column sa active">
            <a class="callSpin" href="<?php echo site_url(); ?>/profile/update-card/">Betalingsoplysninger</a>
          </div>
        </div>
        <?php if($activeFlexMembership != true) { ?>
        <div class="row column purchasePackage-form">
          <div class="small-12 columns no-flex">
            <h5>Dit betalingskort</h5>
            <p>Hvis du køber et Flex-medlemskab, har du mulighed for at opdatere dit betalingskort herinde, da Flex-medlemskabet automatisk fornyes. Vi gemmer derimod ikke oplysninger om dit betalingskort, når du køber Basis eller Premium.</p>

            <p>Vil du læse mere om Flex eller købe et medlemskab, kan du gøre det <a href='<?php echo site_url(); ?>/purchase/flex/'>her.</a></p>


          </div>
        </div>
        <?php } else {?>
        <form id="updateCard" action='<?php echo site_url(); ?>/profile/save/' method="POST" accept-charset="UTF-8" data-parsley-validate autocomplete="off">
          <div class="row column purchasePackage-form">
            <?php if(!empty($tempSuccessMessage)) { ?>
            <div class="primary callout piSuccess" data-closable>
              <?php
              echo 'Dine profiloplysninger er gemt.';
              ?>
              <button class="close-button" aria-label="Dismiss primary" type="button" data-close>
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php } ?>
          <?php if(!empty($tempErrorMessage)) { ?>
            <div class="small-12 columns alert callout piError" data-closable>
              <?php
              echo '<p>'. $tempErrorMessage . '</p>';
              ?>
              <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php } ?>
            <div class="small-12 medium-6 medium-centered large-6 large-centered">
              <div class="large-12 columns card">
                <h2>Dit betalingskort er: </h2>
                <p>Kortholdersnavn: <?php echo $cardName; ?> </p>
                <p class="cardIcon <?php echo $cardType; ?>">Betalingskort: <?php
function cardTypeName($cardType){
  if (strpos($cardType, 'V-DK') !== false) {
      $cardType = "VISA/Dankort";
  } elseif(strpos($cardType, 'VISA') !== false) {
      $cardType = "VISA";
  } elseif(strpos($cardType, 'MC') !== false) {
      $cardType = "MasterCard";
  } else {
      $cardType = $cardType;
  }
  return $cardType;
}
                 echo cardTypeName($cardType) ?></p>
                <p>Kortnummer: <?php $cardNumber_new_format = strtolower($cardNumber_new_format);
                echo $cardNumber_new_format; ?></p>
                <p>Udløbsdato: <?php echo $cardExpMonth .'/'. $cardExpYear; ?></p>
              </div>
            </div>
            <div class="small-12 medium-10 medium-centered large-9 large-centered cardUpdate">
              <div class="large-12 columns">
                <h4>Jeg vil ændre mit betalingskort til:</h4>
                <?php if (!empty($tempErrorLastname)){ ?>
                <input class="serverError" type="text" placeholder="<?php foreach($tempErrorLastname as $ErrorLastname){ echo "Lastname " . $ErrorLastname; }?>" name='cardHolderName' data-parsley-required-message="Indtast dit navn" data-parsley-length="[5, 40]" data-parsley-length-message="Indtast venligst hele dit kortholders navn" required>
                <?php } else { ?>
                <input type="text" placeholder="Kortholders navn" name='cardHolderName' data-parsley-required-message="Indtast dit navn" data-parsley-length="[5, 40]" data-parsley-length-message="Indtast venligst hele dit kortholders navn" required>
                <?php } ?>
              </div>
              <div class="large-12 columns">
                <select name='card_type' id="card_type" data-parsley-required-message="Vælg dit kort" required>
                  <option value="default" disabled selected hidden>Betalingskort</option>
                  <option value="VISA/Dankort" <?PHP if($card_type==1) echo "selected";?>>Visa/Dankort</option>
                  <option value="Visa" <?PHP if($card_type==2) echo "selected";?>>Visa</option>
                  <option value="MasterCard" <?PHP if($card_type==3) echo "selected";?>>MasterCard</option>
                </select>
              </div>
              <div class="large-12 columns">
                <?php if (!empty($tempErrorNumber)){ ?>
                <input class="serverError" type="text" placeholder="<?php foreach($tempErrorNumber as $ErrorNumber){ echo $ErrorNumber; } ?>" name='number' maxlength="16" data-parsley-maxlength="16" minlength="16" data-parsley-minlength="16" data-parsley-required-message="Indtast venligst 16 cifre" required>
                <?php } else { ?>
                <input type="text" placeholder="Kortnummer" name='number' data-parsley-type="digits" data-parsley-minlength="16" data-parsley-maxlength="16" maxlength="16" data-parsley-minlength-message="Indtast venligst 16 cifre"  data-parsley-required-message="Indtast venligst 16 cifre"  required>
                <?php } ?>
              </div>
              <div class="large-12 columns expire">
                <label>Udløbsdato:</label>
                <div class="row">
                  <div class="small-4 medium-4 large-4 columns">
                    <select name='month' id="month" required>
                      <option value="default" disabled selected hidden>Måned</option>
                      <option value="1"  <?PHP if($month==1) echo "selected";?>>01</option>
                      <option value="2"  <?PHP if($month==2) echo "selected";?>>02</option>
                      <option value="3"  <?PHP if($month==3) echo "selected";?>>03</option>
                      <option value="4"  <?PHP if($month==4) echo "selected";?>>04</option>
                      <option value="5"  <?PHP if($month==5) echo "selected";?>>05</option>
                      <option value="6"  <?PHP if($month==6) echo "selected";?>>06</option>
                      <option value="7"  <?PHP if($month==7) echo "selected";?>>07</option>
                      <option value="8"  <?PHP if($month==8) echo "selected";?>>08</option>
                      <option value="9"  <?PHP if($month==9) echo "selected";?>>09</option>
                      <option value="10" <?PHP if($month==10) echo "selected";?>>10</option>
                      <option value="11" <?PHP if($month==11) echo "selected";?>>11</option>
                      <option value="12" <?PHP if($month==12) echo "selected";?>>12</option>
                    </select>
                  </div>
                  <div class="small-4 medium-4 large-4 columns">
                    <?php if (!empty($tempErrorYear)){ ?>
                    <select class="serverError" name='expire' id="year" required>
                      <option value="default" disabled selected hidden><?php foreach($tempErrorYear as $ErrorYear){ echo $ErrorYear; } ?></option>
                      <?php } else { ?>
                      <select name='expire' id="year" required>
                        <option value="default" disabled selected hidden>År</option>
                        <?php } ?>
                        <?PHP
                        $i = date("Y");
                        while($i <= date("Y")+10){
                        echo "<option value='$i'>$i</option>";
                        $i++;
                        }
                        ?>
                      </select>
                    </div>
                    <div class="small-4 medium-4 large-4 columns">
                      <input type="text" placeholder="Kontrolcifre" name='verification_value'  data-parsley-type="digits" data-parsley-length="[3, 3]" data-parsley-length-message="Indtast 3 cifre" data-parsley-required-message="Indtast 3 cifre" required>
                    </div>
                  </div>
                </div>
                <div class="large-12 columns buyAccept">
                  <input id="accept" type="checkbox" data-parsley-validate-if-empty data-parsley-success-class="t" data-parsley-required-message="Acceptér venligst for at fortsætte." required><label for="accept">Jeg accepterer <span class="acceptTC" data-open="purchaseConfirmation">betingelserne</span></label>
                </div>
                <div class="large-12 columns text-center calculatedButton">
                  <input name="utf8" type="hidden" value="✓" />
                  <input type="hidden" id="refresh" value="no">
                  <input type="hidden" name='userip' value="<?php echo $userIP; ?>">
                  <input type="hidden" name='cardupdate' value="1">
                  <input type="hidden" name='membershiporderlineid' value="<?php echo $membershiporderlineid; ?>">
                  <input type="submit" class="pConfirmButton button callSpin" value="GEM">
                  <p class="lpss text-center">
                    <a class="callSpin" href="<?php echo site_url(); ?>">Fortryd og gå til forside</a>
                  </p>
                </div>
              </div>
              <div class="small-12 columns">
              </div>
            </div>
          </form>
          <?php } ?>
        </div>
      </div>
    </div>
  </article>
  <div class="large-12 columns">
    <?php $query = new WP_Query( array( 'page_id' => 225, 'post_status' => 'publish' , 'posts_per_page' => 1 ) ); ?>
    <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
    <div class="reveal" id="purchaseConfirmation" aria-labelledby="exampleModalHeader11" data-reveal>
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
  <script type="text/javascript">
jQuery(function () {
  jQuery('form#updateCard').parsley().on('field:validated', function() {
    jQuery( "input.parsley-error" ).each(function() {
    var placeholder = jQuery(this).attr("data-parsley-required-message");
    jQuery(this).attr("placeholder", placeholder);
    });
  })
});

  var d = new Date();
  var n = d.getMonth() + 1;
  var y = d.getFullYear();
  jQuery("select#month, select#year").on('change', function() {
  var selectedM = jQuery("select#month").val();
  var selectedY = jQuery("select#year").val();
  if (selectedY == y && selectedM <= n ){
  var placeholder = "Kreditkort er udløbet";
  jQuery("select#month").addClass("parsley-error").attr("placeholder", placeholder);
  jQuery("select#year").addClass("parsley-error").attr("placeholder", placeholder);
  } else {
  jQuery("select#month").removeClass("parsley-error");
  jQuery("select#year").removeClass("parsley-error");
  }
  });
  </script>