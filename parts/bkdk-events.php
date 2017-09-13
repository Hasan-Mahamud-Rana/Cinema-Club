<?php $query = new WP_Query( array( 'order' => 'asc' ,'category_name' => 'event', 'cat' => '50','post_status' => 'publish' , 'posts_per_page' => 1 ) ); ?>
<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
<div class="events-panel" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)">
  <div class="row">
    <div class="small-12 columns">
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>
    </div>
  </div>
</div>
<?php endwhile;  wp_reset_postdata(); endif; ?>