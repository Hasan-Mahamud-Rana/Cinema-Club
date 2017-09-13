<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
{
  $code =  $_POST['code'];
}
store_code_for_fb($code);
$customerid = get_customerid();
if ( is_bkdk_user_logged_in() != true && ($customerid == NULL || $customerid  == ' ') ) {
  $kuponStatus = kupon_status($code);
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
  <?php //if($success != 1) { ?>
  <div class="kuponPanel kuponLoginForm">
    <div class="row">
      <div class="small-12 medium-10 medium-centered large-8 large-centered columns">
        <div class="row steps columns">
          <div class="large-12 active columns">
            <?php the_title('<h2>', '</h2>'); ?>
          </div>
        </div>
        <div class="saveKupon">
          <div class="row columns">
            <div class="large-12 columns">
              <?php the_content(); ?>
              <form action="<?php echo site_url(); ?>/create-profile/step-1/" method="POST">
                <input type="hidden" name="code" value="<?php echo $code; ?>" maxlength="17" />
                <input type="submit" class="lgindbtn button callSpin" value="Opret Profil">
              </form>
            </div>
          </div>
          <form action="<?php echo site_url(); ?>/gem-papirkuponer/save" method="POST" data-parsley-validate>
            <div class="row column log-in-form">
              <hr>
              <a class="fblgbtn button callSpin" href="<?php echo FB_HOST; ?>">Log ind med Facebook</a>
              <section class="eller"><h5><span>Eller</span></h5></section>
              <div class="small-12 medium-6 large-6 columns">
              <input type="text" placeholder="E-mail" name='username' data-parsley-type="email" data-parsley-required-message="Indtast gyldig emailadresse" required>            </div>
              <div class="small-12 medium-6 large-6 columns">
                <input type="password" placeholder="Adgangskode" name='password' data-parsley-required-message="Kodeord skal bestå af mindst 8 cifre" required>
              </div>
              <div class="small-12 columns">
                <input type="hidden" name="code" value="<?php echo $code; ?>" maxlength="17" />
              </div>
              <div class="small-12 columns text-center calculatedButton">
                <input type="submit" class="button callSpin" value="Log ind">
                <p class="lpss"><a class="backTo callSpin" href="<?php echo site_url(); ?>/forgotten-password/">Har du glemt dit password?</a></p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php //} ?>
</article>