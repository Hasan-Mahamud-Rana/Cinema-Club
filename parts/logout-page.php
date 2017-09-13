<?php
  unregister_bkdk_user();
  reset_basket_from_cartBar();
  wp_redirect(site_url().'/login/');
?> 