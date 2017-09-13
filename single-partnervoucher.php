<?php get_header(); ?>
	<div id="content" data-equalizer>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php get_template_part( 'parts/single', 'partner-voucher' ); ?>
		<?php endwhile; else : ?>
		  <?php get_template_part( 'parts/content', 'missing' ); ?>
		<?php endif; ?>
	</div>
<?php
if ( !urlForApp() ) {
?>
	<?php get_template_part( 'parts/slider', 'featured-movies' ); ?>
<?php } ?>
<?php get_footer(); ?>