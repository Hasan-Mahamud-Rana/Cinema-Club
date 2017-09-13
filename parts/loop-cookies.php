<div class="cookies-style small-12 medium-12 large-12 columns">
	<div class="row cookie-content">
		<?php $query = new WP_Query( array( 'category_name' => 'cookies' , 'post_status' => 'publish', 'order' => 'ASC' , 'posts_per_page' => 1 ) ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
		<?php the_title('<h1 class="page-title">', '</h1>'); ?>
		<section class="entry-content">
			<?php the_content(); ?>
			<button class="button" type="button">VIDERE TIL GODE FILMOPLEVELSER</button>
		</section>
		<?php endwhile;  wp_reset_postdata(); else : ?>
		<?php _e( 'Sorry, no posts matched your criteria.' ); ?>
		<?php endif; ?>
	</div>
</div>
<script type="text/javascript">
jQuery('.cookies-style .button').click(function() {
  jQuery('#cookiesPopup').fadeOut();
});
</script>