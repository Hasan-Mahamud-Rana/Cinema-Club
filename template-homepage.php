<?php
/*
Template Name: Homepage
*/
?>
<?php get_header();
error_reporting(E_ERROR | E_PARSE);
?>
<?php
if ( !urlForApp() ) {
?>
<div style="display:none;" id="cookiesPopup">
<?php //get_template_part('parts/loop','cookies');?>
</div>
<?php } ?>
<?php if ( is_bkdk_user_logged_in() == true ) { ?>
<div class="homePageMovieTrailerPanel">
	<div class="row movieIntro">
		<div class="small-12">
			<?php get_template_part( 'parts/loop', 'movie-for-homepage' ); ?>
		</div>
	</div>
</div>
<?php }?>
<?php
$userDetails = get_user_info($customerid);
//var_dump(get_user_info($customerid));
$activeMembership = $userDetails->active_membership;
$invalid_credit_card = $userDetails->invalid_credit_card;
?>
<?php if ($invalid_credit_card == true) { ?>
<div class="alert callout piError invalid_credit_card_notice" data-closable>
	<?php
	echo '<h5> Ups! Dit betalingskort er udløbet"</h5>';
	echo '<p>Derfor kan vi desværre ikke forny dit medlemskab. For at forny dit medlemskab skal du opdatere dine <a class="invalid_credit_card_link" href='. site_url().'/profile/update-card/>betalingskort-informationer</a> under "Profil og indstillinger".</p>';
	?>
	<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
	<span aria-hidden="true">&times;</span>
	</button>
</div>
<?php } ?>
<?php if ($activeMembership != 1 || $activeMembership == '') { ?>
<div id="content" class="frontpage" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)" data-equalizer>
	<div id="inner-content" class="row">
		<main id="main" class="small-12 large-7 columns" role="main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php get_template_part( 'parts/loop', 'frontpage' ); ?>
		<?php endwhile; endif; ?>
		</main>
	</div>
</div>
<?php } ?>
<?php
if ( is_bkdk_user_logged_in() == true ) {
	get_template_part( 'parts/app', 'notice' );
	get_template_part( 'parts/bkdk', 'events' );
}
?>
<?php get_template_part( 'parts/slider', 'featured-movies' ); ?>
<?php get_template_part( 'parts/login', 'form' ); ?>
<?php get_footer(); ?>