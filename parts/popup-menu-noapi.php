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