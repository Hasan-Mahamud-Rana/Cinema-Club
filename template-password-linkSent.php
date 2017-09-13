<?php
/*
Template Name: Password LinkSent
*/
?>
<?php get_header(); ?>
	<div id="content" <?php post_class(''); ?> data-equalizer>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php get_template_part( 'parts/password', 'linkSent' ); ?>
			<?php endwhile; endif; ?>
	</div> <!-- end #content -->
	<?php get_template_part( 'parts/slider', 'featured-movies' ); ?>
<?php get_footer(); ?>