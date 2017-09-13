<?php
$customerid = get_customerid();
	call_choose_cinema($customerid);
?>
<div class="createConfirm" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)" data-equalizer>
	<div class="row">
		<main id="main" class="small-12 medium-6 large-7" role="main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php get_template_part( 'parts/loop', 'page' ); ?>
		<a class="button callSpin" href="<?php echo site_url(); ?>">Tilbage Til Forsiden</a>
		<?php endwhile; endif; ?>
		</main>
	</div>
</div>