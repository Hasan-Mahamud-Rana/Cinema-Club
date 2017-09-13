<?php
$customerid = get_customerid();
$message = $_COOKIE['storeCodeErrorMessage'];
$barcode = $_COOKIE['storeCodeErrorBarcode'];
$storeCode =  $_COOKIE['storeCode'];
reset_code_error();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
  <div class="kuponPanel">
    <div class="row">
      <div class="small-12 medium-12 medium-centered columns text-center">
        <header class="article-header">
          <?php the_title('<h3 class="page-title">', '</h3>'); ?>
        </header>
        <section class="entry-content" itemprop="articleBody">
          <?php the_content(); ?>
        </section>
      </div>
    </div>
    <div class="row">
      <div class="small-12 medium-10 medium-centered large-8 large-centered">
        <div class="row couponSteps columns">
          <div class="small-6 medium-6 large-6 columns">
            <a class="registerMembership callSpin" href="<?php echo site_url(); ?>/gem-papirmedlemskab/">Gem papirmedlemskab</a>
          </div>
          <div class="small-6 medium-6 large-6 active columns">
            <a class="registerCoupon callSpin" href="<?php echo site_url(); ?>/gem-papirkuponer/">Gem papirkuponer</a>
          </div>
        </div>
        <div class="saveKupon">
          <?php if(!empty($message)) { ?>
          <div class="alert callout krError" data-closable>
            <?php
            echo '<h5>'. $message . '</h5>';
            ?>
            <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php } ?>
          <div class="row columns">
            <div class="large-12 columns">
              <?php
              if(!empty($barcode)){
              echo '<p>'. $barcode . '</p>';
              } else {
              the_excerpt();
              }
              ?>
            </div>
          </div>
          <div class="row columns">
            <div class="small-12 medium-10 medium-centered large-10 large-centered columns">
              <?php
              if ( is_bkdk_user_logged_in() == true && ($customerid != NULL || $customerid  != ' ') ) { ?>
              <form action="<?php echo site_url(); ?>/gem-papirkuponer/save/" method="POST" data-parsley-validate data-parsley-focus="none">
                <?php } if ( is_bkdk_user_logged_in() != true && ($customerid == NULL || $customerid  == ' ') ) { ?>
                <form action="<?php echo site_url(); ?>/gem-papirkuponer/login/" method="POST" data-parsley-validate data-parsley-focus="none">
                  <?php } ?>
                  <input type="text" name="code" data-parsley-minlength="17" data-parsley-minlength-message="Indtast gyldig stregkode" data-parsley-required-message="Indtast gyldig stregkode" placeholder="Indtast stregkoden" maxlength="17" value="<?php echo $storeCode; ?>" required autofocus>
                  <p class="text-center calculatedButton"><input type="submit" class="button callSpin" value="Gem kupon"></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</article>