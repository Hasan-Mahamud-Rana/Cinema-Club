<?php
/*
Template Name: Site cookies
*/
?>

<?php get_header(); ?>
	<div id="content" <?php body_class(); ?>>
		<div id="inner-content" class="row">
		    <main id="main" class="small-12 columns" role="main">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php get_template_part( 'parts/loop', 'om-biografklub' ); ?>
				<?php endwhile; endif; ?>
			</main>
		</div>
	</div>
<?php get_footer(); ?>