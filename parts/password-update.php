<?php
is_bkdk_user_logged_in();
$token = $_GET['token'];
  if (in_array($token, $GLOBALS['blank_values']) ) {
   $customerid = call_for_reset_password(); // can be null if error
  }
?>
<?php if ( is_bkdk_user_logged_in() == true ) { ?>
<div class="login-panel" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)">
  <div class="row" >
  <div class="medium-7 medium-centered large-5 large-centered log-in-form-panel columns">
      <div class="row column log-in-form linkSent">
        <?php the_title( '<h4>', '</h4>' ); ?>
        <?php the_content(); ?>
        <p style="text-align: center;"><a class="lgindbtn button callSpin" href="<?php echo site_url(); ?>">GÅ til forside</a></p>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
<div class="login-panel" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)">
  <div class="row" >
  <div class="medium-7 medium-centered large-4 large-centered log-in-form-panel columns">
      <div class="row column log-in-form linkSent">
        <h4>Not Successful</h4>
        <p> Error</p>
        <p style="text-align: center;"><a class="lgindbtn button callSpin" href="<?php echo site_url(); ?>">GÅ til forside</a></p>
      </div>
    </div>
  </div>
</div>
<?php }?>