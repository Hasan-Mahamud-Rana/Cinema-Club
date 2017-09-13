<?php
$customerid = get_customerid();
$loginErrorMessage = $_COOKIE['loginErrorMessage'];
$loginCredentials = $_COOKIE['loginCredentials'];
$loginCredentials = stripslashes($loginCredentials);
$loginCredentials = json_decode($loginCredentials, true);
$current_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

reset_login_information_error();

?>
<?php if (is_bkdk_user_logged_in() != true || $customerid == NULL || $customerid  == ' ')  { ?>
<div class="login-panel" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)">
  <div class="row" >
    <div class="medium-6 medium-centered large-5 large-centered log-in-form-panel columns">
      <form id="login" action='' method="POST" accept-charset="UTF-8" data-parsley-validate data-parsley-focus="none">
        <div class="row column log-in-form">
          <h4>Log ind</h4>
          <?php if(!empty($loginCredentials)) {?>
          <div class="alert callout lError" data-closable>
            <?php
            echo '<h5>' . $loginErrorMessage . '</h5>';
            foreach($loginCredentials as $loginCredential){ echo $loginCredential  . ' ';}
            ?>
            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php } ?>
          <!--p class="dot text-center">•</p-->
          <div class="large-12 columns text-center calculatedButton">
          <!--a class="fblgbtn button" href="<!-- ?php //echo site_url(); ?>/fbconfig.php">Log ind med Facebook</a-->
           <a class="fblgbtn button callSpin" href="<?php echo FB_HOST; ?>">Log ind med Facebook</a></div>
          <div class="large-12 columns text-center">
            <section class="eller"><h5><span>Eller</span></h5></section>
          </div>
          <div class="small-12 large-6 columns">
            <input class="email" type="text" placeholder="E-mail" name='username' data-parsley-type="email" data-parsley-required-message="Indtast gyldig emailadresse" required>
          </div>
          <div class="small-12 large-6 columns">
            <input class="password" type="password" placeholder="Adgangskode" name='password' data-parsley-minlength="6" data-parsley-minlength-message="Kodeord skal bestå af mindst 6 cifre" data-parsley-required-message="Kodeord skal bestå af mindst 8 cifre" required>
          </div>
          <div class="large-12 columns text-center calculatedButton">
            <input type="hidden" name="currentlink" value="<?php echo $current_link; ?>" />
            <input name="utf8" type="hidden" value="✓" />
            <input type="submit" class="lgindbtn button callSpin" value="Log ind">
          </div>
          <div class="large-12 columns">
            <p class="lpss text-center callSpin"><a href="<?php echo site_url(); ?>/forgotten-password/">Har du glemt din adgangskode?</a></p>
            <p class="lpss text-center callSpin"><a href="<?php echo site_url(); ?>/create-profile/step-1/">Har du ikke en profil, kan du oprette den her</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>