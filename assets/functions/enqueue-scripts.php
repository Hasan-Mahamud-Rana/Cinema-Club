<?php
function site_scripts() {
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
    // Load What-Input files in footer
    wp_enqueue_script( 'what-input', get_template_directory_uri() . '/vendor/what-input/what-input.min.js', array(), '', true );
    // Adding Foundation scripts file in the footer
    wp_enqueue_script( 'foundation', get_template_directory_uri() . '/vendor/foundation-sites/dist/foundation.min.js', array( jquery ), '6.0', true );

    // Register Motion-UI
    wp_enqueue_style( 'motion-ui', get_template_directory_uri() . '/vendor/motion-ui/dist/motion-ui.min.css', array(), '', 'all' );
	  // Select which grid system you want to use (Foundation Grid by default)
    wp_enqueue_style( 'foundation', get_template_directory_uri() . '/vendor/foundation-sites/dist/foundation.min.css', array(), '', 'all' );
    wp_enqueue_style( 'lightbox-stylesheet', get_template_directory_uri() .'/assets/css/slick-lightbox.css' );

    // Register main stylesheet
    wp_enqueue_style( 'site', get_template_directory_uri() . '/assets/css/style.css', array(), '', 'all' );
    // Comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }

}
add_action('wp_enqueue_scripts', 'site_scripts', 999);

function movies_slider_scripts() {
  wp_enqueue_style( 'slick', get_template_directory_uri() .'/assets/slider/slick.css' );
  wp_enqueue_style( 'slick-theme', get_template_directory_uri() .'/assets/slider/slick-theme.css' );
  wp_enqueue_style( 'video', get_template_directory_uri() .'/assets/css/video-js.css' );
 }
add_action( 'wp_enqueue_scripts', 'movies_slider_scripts' );

function spin_scripts() {
  wp_enqueue_script( 'spin', get_template_directory_uri() .'/assets/spin/spin.min.js', array(), '', true );
 }
add_action( 'wp_enqueue_scripts', 'spin_scripts' );

function flipclock_scripts() {
wp_enqueue_style( 'flipclock', get_template_directory_uri() .'/assets/countdown/flipclock.css' );
  wp_enqueue_script( 'flipclock', get_template_directory_uri() .'/assets/countdown/flipclock.js', array(), '', true );
  //wp_enqueue_script( 'clock', get_template_directory_uri() .'/assets/countdown/clock.js', array(), '', true );
 }
add_action( 'wp_enqueue_scripts', 'flipclock_scripts' );

function cookie_scripts() {
//Cookies file enqueue
  wp_enqueue_script( 'cookie','https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js', array(), '', true );
 }
add_action( 'wp_enqueue_scripts', 'cookie_scripts' );

function validation_scripts() {
//wp_enqueue_style( 'validation', get_template_directory_uri() .'/assets/validator/parsley.css' );
  wp_enqueue_script( 'validation', get_template_directory_uri() .'/assets/validator/parsley.min.js', array(), '', true );
 }
add_action( 'wp_enqueue_scripts', 'validation_scripts' );