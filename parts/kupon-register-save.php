<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
  $code =  $_POST['code'];
}

is_bkdk_user_logged_in();
$customerid = get_customerid();
$storeCode =  $_COOKIE['storeCode'];
$storeCodeFB =  $_COOKIE['storeCodeFB'];

if (!empty($storeCodeFB)){
  $code = $storeCodeFB;
}
if (!empty($storeCode)){
  call_choose_cinema($customerid);
}
if (is_bkdk_user_logged_in() == true && ($customerid != NULL || $customerid  != ' ') ) {
  $registerKupon = register_kupon($code, $customerid);
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
  <div class="kuponPanel">
    <div class="row">
      <div class="small-12 medium-10 medium-centered large-8 large-centered columns">
        <div class="row steps columns">
          <div class="large-12 active columns">
            <h2>Din papirkupon er gemt!</h2>
          </div>
        </div>
        <div class="saveKupon">
          <div class="row columns">
            <div class="large-12 columns">
              <p>Nu er din papirkupon gemt. Du kan se den i menuen under Kuponer.</p>
              <p class="ovrLayBtn text-center callSpin"><a class="button" href="<?php echo site_url(); ?>/coupon/" >Se Kuponer</a></p>
              <p class="ovrLayBtn text-center callSpin"><a class="button secondary" href="<?php echo site_url(); ?>/gem-papirkuponer/" >Gem Flere Kuponer</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</article>