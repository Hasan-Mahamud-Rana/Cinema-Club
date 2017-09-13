<?php
/*
Template Name: Message Inbox
*/
?>

<?php get_header(); ?>
	<div id="content" <?php body_class(); ?>>
		<div id="inner-content" class="row">
		    <main id="main" class="small-12" role="main">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
					  <section class="entry-content" itemprop="articleBody">
					      <?php the_title('<h4><strong>', '</strong></h4>'); ?>
					      <hr class="inbox">
					      <?php the_content(); ?>
					  </section>
					</article>
				<?php endwhile; endif; ?>
			</main> <!-- end #main -->
		</div> <!-- end #inner-content -->
		<?php get_template_part( 'parts/message', 'inbox' ); ?>
	</div> <!-- end #content -->
<?php get_template_part( 'parts/slider', 'featured-movies' ); ?>
<?php get_footer(); ?>