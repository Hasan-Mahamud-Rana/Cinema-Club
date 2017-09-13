<?php
if ( is_bkdk_user_logged_in() != true ) {
wp_redirect(site_url().'/login');
}
$customerid = get_customerid();
if ($customerid != NULL || $customerid  != ' ') {
  $userDetails = get_user_info($customerid);
//var_dump($userDetails);
  $receivegeneralnewsletter = $userDetails->receivegeneralnewsletter;
  $receive_season_newsletter = $userDetails->receive_season_newsletter;
  $receive_voucher_newsletter = $userDetails->receive_voucher_newsletter;
  $receivespecializednewsletter = $userDetails->receivespecializednewsletter;
  $receive_lottery_newsletter = $userDetails->receive_lottery_newsletter;
  $receive_survey_newsletter = $userDetails->receive_survey_newsletter;
  $active_flex_membership = $userDetails->active_flex_membership;
}
$tempStoreSuccess = $_COOKIE['storeSuccess'];
$tempStoreSuccess = stripslashes($tempStoreSuccess);
$tempStoreSuccess = json_decode($tempStoreSuccess, true);
?>
<div class="createProfile-panel notification">
  <div class="row">
    <div class="medium-11 medium-centered large-9 large-centered createProfile-form-panel columns">
<?php if ( $active_flex_membership == true) { ?>
      <div class="row steps small-up-1 medium-up-4 large-up-4 columns">
        <div class="column">
          <a class="callSpin" href="<?php echo site_url(); ?>/profile/personal-information/">Navn og adresse</a>
        </div>
        <div class="column sa active">
          <a class="callSpin" href="<?php echo site_url(); ?>/profile/notifications/">Notifikationer</a>
        </div>
        <div class="column si">
          <a class="callSpin" href="<?php echo site_url(); ?>/profile/favourite-cinema/">Din favoritbiograf</a>
        </div>
        <div class="column sa">
            <a class="callSpin" href="<?php echo site_url(); ?>/profile/update-card/">Betalingsoplysninger</a>
          </div>
      </div>
<?php } else { ?>
   <div class="row steps small-up-1 medium-up-3 large-up-3 columns">
        <div class="column">
          <a class="callSpin" href="<?php echo site_url(); ?>/profile/personal-information/">Navn og adresse</a>
        </div>
        <div class="column sa active">
          <a class="callSpin" href="<?php echo site_url(); ?>/profile/notifications/">Notifikationer</a>
        </div>
        <div class="column si">
          <a class="callSpin" href="<?php echo site_url(); ?>/profile/favourite-cinema/">Din favoritbiograf</a>
        </div>
      </div>
<?php } ?>
      <form action='<?php echo site_url(); ?>/profile/save' method="POST">
        <div class="row column createProfile-form notificationText">
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
          <div class="row">
            <div class="small-12 medium-10 medium-centered  large-9 large-centered columns">
              <div class="large-12 columns notificationText">
                <p>Her kan du vælge, hvordan du vil holdes opdateret med nyheder og gode tilbud fra Biografklub Danmark.</p>
              </div>
              <div class="large-12 columns text-right">
                <p><label>E-MAIL</label></p>
              </div>
              <div class="large-12 columns">
                <div class="row">
                  <div class="small-9 columns notificationLabel">
                    <label for="receivegeneralnewsletter">Nyheder, tilbud og invitationer</label>
                  </div>
                  <div class="small-3 columns text-right newsletter">
                      <?php if(!empty($receivegeneralnewsletter)) { ?>
                      <input id="receivegeneralnewsletter" name='receivegeneralnewsletter' type="checkbox" checked>
                      <?php } else { ?>
                      <input id="receivegeneralnewsletter" name='receivegeneralnewsletter' type="checkbox">
                      <?php } ?>
                    <label for="receivegeneralnewsletter"></label>
                  </div>
                </div>
              </div>
              <div class="large-12 columns">
                <div class="row">
                  <div class="small-9 columns notificationLabel">
                    <label for="receive_season_newsletter">Filmpakker på vej</label>
                  </div>
                  <div class="small-3 columns text-right newsletter">
                    <?php if(!empty($receive_season_newsletter)) { ?>
                      <input id="receive_season_newsletter" name='receive_season_newsletter' type="checkbox" checked>
                      <?php } else { ?>
                      <input id="receive_season_newsletter" name='receive_season_newsletter' type="checkbox">
                      <?php } ?>
                    <label for="receive_season_newsletter"></label>
                  </div>
                </div>
              </div>
              <div class="large-12 columns">
                <div class="row">
                  <div class="small-9 columns notificationLabel">
                    <label for="receivespecializednewsletter">Filmpremierer</label>
                  </div>
                  <div class="small-3 columns text-right newsletter">
                      <?php if(!empty($receivespecializednewsletter)) { ?>
                      <input id="receivespecializednewsletter" name='receivespecializednewsletter' type="checkbox" checked>
                      <?php } else { ?>
                      <input id="receivespecializednewsletter" name='receivespecializednewsletter' type="checkbox">
                      <?php } ?>
                  <label for="receivespecializednewsletter"></label>
                  </div>
                </div>
              </div>
              <div class="large-12 columns">
                <div class="row">
                  <div class="small-9 columns notificationLabel">
                    <label for="receive_voucher_newsletter">Dine film- og fordelskuponer</label>
                  </div>
                  <div class="small-3 columns text-right newsletter">
                    <?php if(!empty($receive_voucher_newsletter)) { ?>
                    <input id="receive_voucher_newsletter" name='receive_voucher_newsletter' type="checkbox" checked>
                    <?php } else { ?>
                    <input id="receive_voucher_newsletter" name='receive_voucher_newsletter' type="checkbox">
                    <?php } ?>
                  <label for="receive_voucher_newsletter"></label>
                  </div>
                </div>
              </div>
              <div class="large-12 columns notificationLabel">
                <div class="row">
                  <div class="small-9 columns">
                    <label for="receive_lottery_newsletter">Dine lodder, lodtrækninger og vinderbeskeder</label>
                  </div>
                  <div class="small-3 columns text-right newsletter">
                      <?php if(!empty($receive_lottery_newsletter)) { ?>
                      <input id="receive_lottery_newsletter" name='receive_lottery_newsletter' type="checkbox" checked>
                      <?php } else { ?>
                      <input id="receive_lottery_newsletter" name='receive_lottery_newsletter' type="checkbox">
                      <?php } ?>
                    <label for="receive_lottery_newsletter"></label>
                  </div>
                </div>
              </div>
              <div class="large-12 columns notificationLabel">
                <div class="row">
                  <div class="small-9 columns">
                    <label for="receive_survey_newsletter">Undersøgelser og spørgeskemaer</label>
                  </div>
                  <div class="small-3 columns text-right newsletter">
                      <?php if(!empty($receive_survey_newsletter)) { ?>
                      <input id="receive_survey_newsletter" name='receive_survey_newsletter' type="checkbox" checked>
                      <?php } else { ?>
                      <input id="receive_survey_newsletter" name='receive_survey_newsletter' type="checkbox">
                      <?php } ?>
                    <label for="receive_survey_newsletter"></label>
                  </div>
                </div>
              </div>
              <div class="large-12 columns" style="display: none;">
                <input id="notifications" type="checkbox" name='notifications' value="1" checked>
              </div>
              <div class="large-12 columns text-center calculatedButton">
                <input type="submit" class="button callSpin" value="GEM">
              </div>
              <div class="large-12 columns">
                <p class="lpss text-center"><a class="backTo callSpin" href="<?php echo site_url(); ?>">Fortryd og gå til forside</a></p></div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>