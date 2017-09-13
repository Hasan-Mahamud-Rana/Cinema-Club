<div class="movie-panel">
<div class="row" >
    <div class="large-12 text-center columns">
      <h2>Biografklub Danmark udvælger de bedste film til dig og dine venner</h2>
    </div>
</div>
<div class="row movie-slider" >
    <div class="large-12 text-center">
      <div class="tricky movie" style="display: none;">
        <?php $query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' ,'category_name' => 'featured-movies', 'cat' => '-13', 'post_status' => 'publish' , 'posts_per_page' => -1 ) ); ?>
        <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
        <a class="medium-12 large-12" href="<?php the_permalink() ?>" rel="bookmark" title="Link to <?php the_title_attribute(); ?>" style="height:320px; background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)">&nbsp;</a>
      <?php endwhile;  wp_reset_postdata(); else : ?>
      <?php _e( 'Sorry, no posts matched your criteria.' ); ?>
    <?php endif; ?>
  </div>
</div>
</div>
</div>