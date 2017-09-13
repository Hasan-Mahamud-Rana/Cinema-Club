<?php
/*
Template Name: Events
*/
?>
<?php get_header(); ?>

<?php
if ( !urlForApp() ) {
?>
<div style="display:none;" id="cookiesPopup">
<?php get_template_part('parts/loop','cookies');?>
</div>
<?php } ?>
<?php get_template_part( 'parts/bkdk', 'events' ); ?>
<?php get_template_part( 'parts/slider', 'featured-movies' ); ?>
<?php get_footer(); ?>