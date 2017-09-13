<?php
/*
Template Name: Help
*/
?>
<?php get_header(); ?>
	<div id="content" <?php body_class(); ?>>
		<div id="inner-content" class="row help-content">
		    <main id="main" class="small-12 medium-12 large-12" role="main">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
					    <section class="entry-content" itemprop="articleBody">
					      <?php the_title('<p>', '</p>'); ?>
					      <?php the_content(); ?>
					  	</section>
					</article>
				<?php endwhile; endif; ?>
			</main> <!-- end #main -->
		</div> <!-- end #inner-content -->
		<?php get_template_part( 'parts/loop', 'help' ); ?>
	</div> <!-- end #content -->
<?php
$urlForApp = $_GET['urlForApp'];
if ( $urlForApp != 1 ) {
get_template_part( 'parts/slider', 'featured-movies' );
}?>
<?php get_footer(); ?>