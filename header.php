<?php ob_start(); ?>
<!doctype html>
<html class="no-js"  <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="description" xml:lang="dk" content="">
    <meta name="keywords" xml:lang="dk" content="">
    <meta name="robots" content="index, nofollow">
    <meta name="title" content="<?php the_title(''); ?> - <?php bloginfo('name'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta class="foundation-mq">
    <meta http-equiv="content-language" content="dk">
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) { ?>
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/apple-touch-icon/apple-icon-touch.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/assets/apple-touch-icon/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/assets/apple-touch-icon/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/assets/apple-touch-icon/touch-icon-ipad-retina.png">
    <!--[if IE]>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <![endif]-->
    <meta name="msapplication-TileColor" content="#f01d4f">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/images/win8-tile-icon.png">
    <meta name="theme-color" content="#121212">
    <?php } ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <title><?php wp_title('-', true, 'right'); ?></title>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <?php if ( !urlForApp() ){ ?><div id="loader"></div><?php } ?>
    <div class="off-canvas-wrapper">
      <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
        <?php get_template_part( 'parts/content', 'offcanvas' ); ?>
        <div class="off-canvas-content" data-off-canvas-content>
          <?php
          if ( !urlForApp() ){
          ?>
          <div class="noticeDestination"></div>
           <header class="header" role="banner">
            <?php get_template_part('parts/nav', 'offcanvas-topbar'); ?>
            </header>
            <?php } ?>
            <?php
            $basketCartNumber = $_COOKIE['basketCartNumber'];
            $basketFlexCartNumber = $_COOKIE['basketFlexCartNumber'];
            if (!empty($basketCartNumber) || !empty($basketFlexCartNumber)){
            ?>
            <div class="cart" role="shopping">
              <?php get_template_part( 'parts/cart', 'bar' ); ?>
            </div>
            <?php } ?>