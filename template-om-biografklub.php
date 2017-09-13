<?php
/*
Template Name: Om Biografklub
*/
?>

<?php get_header(); ?>
	<div id="content" <?php body_class(); ?>>
		<div id="inner-content" class="row">
		    <main id="main" class="small-12 medium-9 large-9  columns" role="main">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php get_template_part( 'parts/loop', 'om-biografklub' ); ?>
				<?php endwhile; endif; ?>
			</main> <!-- end #main -->
<?php
if ( !urlForApp() ) {
get_template_part( 'parts/side', 'om-biografklub' );
?>
		</div> <!-- end #inner-content -->
	</div> <!-- end #content -->
<?php
get_template_part( 'parts/slider', 'featured-movies' );
} else { ?>

		</div> <!-- end #inner-content -->
	</div> <!-- end #content -->
<?php	} ?>
<?php get_footer(); ?>