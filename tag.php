<?php get_header(); ?>
<div id="content">

	<div id="inner-content" class="row">

		<main id="main" class="small-12 columns" role="main">

		<header>
			<h1 class="page-title"><?php the_archive_title();?></h1>
			<?php the_archive_description('<div class="taxonomy-description">', '</div>');?>
		</header>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<!-- To see additional archive styles, visit the /parts directory -->
		<?php get_template_part( 'parts/loop', 'movie' ); ?>

		<?php endwhile; ?>
		<?php joints_page_navi(); ?>

		<?php else : ?>

		<?php get_template_part( 'parts/content', 'missing' ); ?>

		<?php endif; ?>

		</main>


	</div>

</div>
<?php get_footer(); ?>