<?php
/*
Template Name: Movie
*/
?>
<?php get_header(); ?>
<div id="content" <?php body_class(); ?>>
	<div id="inner-content" class="row movieIntro">
		<main id="main" class="small-12 medium-12 large-12" role="main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php get_template_part( 'parts/loop', 'movie' ); ?>
		<?php endwhile; endif; ?>
		</main>
	</div>
</div>
<?php get_footer(); ?>