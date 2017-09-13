<div style="display:none;" id="cookiesPopupFooter">
  <?php get_template_part('parts/loop','cookies-footer');?>
</div>
<?php if ( !urlForApp() ) { ?>
<div class="floatingPurchase Button">
  <a class="nav-purchase" href="<?php echo site_url(); ?>/purchase/">KØB MEDLEMSKAB</a>
</div>
<?php } ?>
<footer class="footer" role="contentinfo">
  <?php if ( !urlForApp() ) { ?>
  <div id="inner-footer" class="row">
    <div class="large-12 medium-12 columns">
      <nav role="navigation">
        <?php
        joints_footer_links();
        $customerid = get_customerid();
        ?>
      </nav>
    </div>
    <div class="large-12 medium-12 columns copyright">
      <p class="source-org">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> - Vognmagergade 10, 1. sal - 1120 København K - Tlf.: 33 11 36 32</p>
      <span><a class="f-icon" href="https://www.facebook.com/BiografklubDanmark/" target="_blank">Følg os på Facebook</a></span>
      <?php
      if ($customerid == NULL || $customerid == ' ' || empty($customerid)) {
      echo "";
      } else { ?>
      | <span><a data-open="recommendToaFriendButton">Anbefal til en ven</a></span>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
</footer>
<?php
if ( !urlForApp() ) {
get_template_part( 'parts/popup', 'menu' );
get_template_part( 'parts/popup', 'search' );
if ($customerid == NULL || $customerid == ' ' || empty($customerid)) {
echo "";
} else {
get_template_part( 'parts/popup', 'recommend-to-a-friend' );
}
}
?>
</div>
</div>
</div>
<?php wp_footer(); ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.2.0/list.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js"></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri() ?>/assets/js/scripts.js'></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/assets/js/slick-lightbox.js"></script>
<script src="https://vjs.zencdn.net/ie8/1.1.0/videojs-ie8.min.js"></script>
<script src="https://vjs.zencdn.net/5.0.2/video.js"></script>
</body>
</html>