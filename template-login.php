<?php
/*
Template Name: Login
*/
?>
<?php
	get_header();
if ( is_bkdk_user_logged_in() == true ) {
	$userDetails = get_user_info($customerid);
	$activeMembership = $userDetails->active_membership;
	if ($activeMembership != 1 || $activeMembership == '') {
	  wp_redirect(site_url());
	} else {
		wp_redirect(site_url() . '/movies/');
	}
}
?>
	<div id="content" <?php post_class(''); ?> data-equalizer>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php get_template_part( 'parts/login', 'form' ); ?>
			<?php endwhile; endif; ?>
	</div> <!-- end #content -->
	<?php get_template_part( 'parts/slider', 'featured-movies' ); ?>
<?php get_footer(); ?>