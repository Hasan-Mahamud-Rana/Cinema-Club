<?php
  $token = $_GET['token'];
  if (in_array($token, $GLOBALS['blank_values']) ) {
    call_for_reset_password();
  }
?>

<div class="login-panel" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)">
  <div class="row" >
  <div class="medium-7 medium-centered large-5 large-centered log-in-form-panel columns">
    <form action='<?php echo site_url(); ?>/password-update' method="POST" data-parsley-validate>
      <input type="hidden" name='token' value="<?php echo $token; ?>">
      <div class="row column log-in-form linkSent">
        <?php the_title( '<h4>', '</h4>' ); ?>
        <?php the_content(); ?>
          <div class="small-12 medium-6 large-6 columns">
              <input type="password" placeholder="Indtast ny adgangskode" name='password' minlength="8" id="password" data-parsley-required-message="Kodeord skal bestå af mindst 8 cifre" required>
          </div>
          <div class="small-12 medium-6 large-6 columns">
              <input type="password" placeholder="Gentag adgangskode" name='password_confirmation' minlength="8" data-parsley-equalto="#password" data-parsley-required-message="Kodeord og bekræft kodeord er ikke ens" required>
          </div>
          <div class="small-12 columns text-center calculatedButton">
            <input type="submit" class="button callSpin" value="GEM">
          </div>
      </div>
    </form>
    </div>
  </div>
</div>