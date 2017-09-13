<?php get_header(); ?>
<div id="content-error">
	<div id="inner-content" class="row">
		<main id="main" class="large-8 medium-8" role="main">
		<article id="content-not-found">
			<?php $query = new WP_Query( array( 'post_id' => 843, 'post_status' => 'publish' , 'posts_per_page' => 1 ) ); ?>
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
			<header class="article-header">
				<?php the_title('<h1>', '</h1>'); ?>
			</header>
			<section class="entry-content">
				<?php the_content(); ?>
			</section>
			<?php endwhile;  wp_reset_postdata(); else : ?>
			<?php _e( 'Sorry, no posts matched your criteria.' ); ?>
			<?php endif; ?>
		</article>
		</main>
	</div>
</div>
<?php get_footer(); ?>