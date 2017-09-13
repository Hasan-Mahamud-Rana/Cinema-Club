<div class="large-12 columns">
<div class="reveal text-center kuponReveal" id="recommendToaFriendButton" data-reveal>
  <p class="overlayHeading">Anbefal Biografklub Danmark til en ven</p>
  <p class="overlayText">Vil du invitere dine venner til at blive medlem af Biografklub Danmark? Så kan I gå i biografen sammen og dele de gode filmoplevelser.</p>
  <form id="recommendToAfriend" action='<?php echo site_url(); ?>/recommend-to-a-friend/' method="POST"  data-parsley-validate data-parsley-focus="none">
	<div class="small-12 medium-10 medium-centered large-10 large-centered columns">
    <div class="large-12 columns">
      <input class="myName" type="text" placeholder="Din vens navn" name='myname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast din vens navn" data-parsley-required-message="Indtast din vens navn" required>
    </div>
    <div class="large-12 columns">
      <input class="myEmail" type="text" placeholder="Din vens e-mail" name='email' data-parsley-type="email" data-parsley-minlength="2" data-parsley-minlength-message="Udfyld venligst din vens e-mail og nav" data-parsl
      ey-required-message="Udfyld venligst din vens e-mail og nav" required>
    </div>
    <div class="large-12 columns">
      <textarea class="myMessage" type="text" name='message' maxlength="500" placeholder="Skriv en besked til din ven om, hvorfor du anbefaler Biografklub Danmark (valgfrit)"  rows="5"></textarea>
    </div>
    </div>
    <input type="hidden" name="currentlink" value="<?php echo $current_link; ?>" />
    <input class="calculatedButton sendBarcodeComplete overlay button callSpin" type="submit" name="" value="Send">
    <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
    </button>
  </form>
</div>
</div>
<script type="text/javascript">
  jQuery(function () {
    jQuery('form#recommendToAfriend').parsley().on('field:validated', function() {
        jQuery( "input.parsley-error" ).each(function() {
        var placeholder = jQuery(this).attr("data-parsley-required-message");
        jQuery(this).attr("placeholder", placeholder);
        });
    })
});
</script>