<?php
/*
Template Name: Password Reset
*/
?>
<?php get_header(); ?>
	<div id="content" <?php post_class(''); ?> data-equalizer>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php get_template_part( 'parts/password', 'reset' ); ?>
				<?php endwhile; endif; ?>
	</div> <!-- end #content -->
<?php get_footer(); ?>