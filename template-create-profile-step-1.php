<?php
/*
Template Name: CreateProfile Step-1
*/
?>
<?php get_header(); ?>
	<div id="content" <?php post_class('createProfile'); ?> style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)" data-equalizer>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      	<div class="row">
    			<div class="large-12 columns profileStep text-center">
    				<?php the_title('<h3>','</h3>'); ?>
      			<?php the_content(); ?>
      		</div>
      	</div>
				<?php get_template_part( 'parts/create', 'profile-step-1' ); ?>
			<?php endwhile; endif; ?>
	</div> <!-- end #content -->
<?php get_template_part( 'parts/slider', 'featured-movies' ); ?>
<?php get_footer(); ?>