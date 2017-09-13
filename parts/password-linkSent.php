<?php
if ( is_bkdk_user_logged_in() == true ) {
  wp_redirect(site_url().'/movies/');
}
  call_for_forgotten_password();
?>

<?php if ( is_bkdk_user_logged_in() == true ) { ?>
  <p>You are logged in</p>
<?php } else { ?>
  <div class="login-panel" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)">
    <div class="row" >
    <div class="medium-7 medium-centered large-5 large-centered log-in-form-panel columns">
      <form action='' method="POST">
        <div class="row column log-in-form linkSent">
          <?php the_title( '<h4>', '</h4>' ); ?>
          <?php the_content(); ?>
          <p style="text-align: center;"><a class="lgindbtn button callSpin" href="<?php echo site_url(); ?>">GÅ til forside</a></p>
        </div>
      </form>
      </div>
    </div>
  </div>
<?php } ?>