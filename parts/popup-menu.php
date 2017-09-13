<?php
$customerid = get_customerid();
if ($customerid != NULL || $customerid  != ' ') {
  $userDetails = get_user_info($customerid);
  $firstname = $userDetails->firstname;
  $lastname = $userDetails->lastname;
  $lottery_tickets_amount_sum = $userDetails->lottery_tickets_amount_sum;
  $user_picture_url = $userDetails->user_picture_url;
}
if ($customerid == NULL || $customerid  == ' ' || empty($customerid)) {
?>
<div class="reveal full menu-modal" id="menuModalMain" data-animation-out="fade-out" data-reveal>
  <div class="row">
    <div class="small-12">
      <button class="close-button-menu" data-close aria-label="Close modal" type="button">
      <a class="crossText">LUK MENU</a>
      </button>
    </div>
  </div>
  <div class="row menuWrapper">
    <div class="small-12">
      <?php
      $mainMenuPublic = array(
      'menu'           => 'Main Menu Public',
      'theme_location' => '__no_such_location'
      );
      wp_nav_menu($mainMenuPublic);
      ?>
    </div>
  </div>
</div>
<?php } else {
  $purchasable_flex_membership = $userDetails->purchasable_flex_membership;
  $active_flex_membership = $userDetails->active_flex_membership;

  if ( $active_flex_membership != true) {
    $flexNotActive = "flex_not_active";
}
?>
<div class="reveal full menu-modal" id="menuModalMain" data-animation-out="fade-out" data-reveal>
  <div class="row">
    <div class="small-12">
      <div class="row">
        <div class="small-7 medium-8 large-9 columns">
          <button class="close-button-menu" data-close aria-label="Close modal" type="button">
          <a class="crossText">LUK MENU</a>
          </button>
        </div>
        <div class="small-5 medium-4 large-3 columns userImageName">
          <img class="myImage" src="<?php echo $user_picture_url; ?>" alt="User Picture" />
          <?php
          echo '<p class="myName">' . $firstname . ' ' . $lastname . '</p>';
          echo '<p class="myTicket">' . $lottery_tickets_amount_sum . ' lodder</p>';
          ?>
        </div>
      </div>
    </div>
  </div>
  <div class="row menuWrapper">
    <div class="small-12">
      <?php
      $mainMenuUserSpecific = array(
      'menu'           => 'Main Menu User Specific',
      'theme_location' => '__no_such_location'
      );
      wp_nav_menu($mainMenuUserSpecific);
      ?>
    </div>
    <span class="<?php echo $flexNotActive;  ?>"></span>
  </div>
</div>
<?php } ?>