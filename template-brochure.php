<?php
/*
Template Name: Brochure
*/
?>
<?php get_header(); ?>
<div id="content" <?php post_class('createProfile'); ?> style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)" data-equalizer>
  <?php
    if (have_posts()) : while (have_posts()) : the_post();
      get_template_part( 'parts/loop', 'brochure' );
    endwhile; endif; ?>
</div>
<?php get_template_part( 'parts/slider', 'featured-movies' ); ?>
<?php get_footer(); ?>