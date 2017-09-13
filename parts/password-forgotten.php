<?php
if ( is_bkdk_user_logged_in() == true ) {
  wp_redirect(site_url().'/movies/');
}

$message =  $_COOKIE['storeForgottenErrorMessage'];
$errors = $_COOKIE['storeForgottenErrorErrors'];
$email = $_COOKIE['storeForgottenErrorEmail'];

reset_forgotten_error();
?>

<?php if ( is_bkdk_user_logged_in() == true ) { ?>
  <p>You are logged in</p>
<?php } else { ?>
  <div class="login-panel" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)">
    <div class="row" >
    <div class="medium-7 medium-centered large-5 large-centered log-in-form-panel columns">
      <form action='<?php echo site_url(); ?>/link-sent/' method="POST" data-parsley-validate>
        <div class="row column log-in-form">
          <?php
            if(!empty($message)){
              echo '<h4>'. $message . '</h4>';
            } else {
              the_title('<h4>', '</h4>'); }

            if(!empty($errors)){
              echo '<p>'. $errors . '</p>';
            } else {
              the_content(); }
 ?>
            <div class="small-12 large-10 large-centered columns">
                <input type="text" placeholder="E-mail" name='email' data-parsley-type="email" data-parsley-required-message="Indtast gyldig emailadresse" value="<?php echo $email; ?>" required autofocus>
            </div>
            <div class="small-12 columns text-center calculatedButton">
              <input type="submit" class=" button callSpin" value="Send Link">
            </div>
            <div class="small-12 columns">
              <p class="lpss text-center"><a class="backTo callSpin" href="<?php echo site_url(); ?>/login">Tilbag til login</a></p>
            </div>
        </div>
      </form>
      </div>
    </div>
  </div>
<?php } ?>