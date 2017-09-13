<?php get_header(); ?>
	<div id="content" data-equalizer>
	<?php
if ( !urlForApp() ) {
?>
	<?php get_template_part( 'parts/slider', 'all-movies' ); ?>
<?php } ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="movieIntroPanel">
					<div class="row movieIntro">
						<?php get_template_part( 'parts/single', 'movie-trailer' ); ?>
					</div>
				</div>
				<div class="row movieContent">
					<?php get_template_part( 'parts/single', 'movie-content' ); ?>
				</div>
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
