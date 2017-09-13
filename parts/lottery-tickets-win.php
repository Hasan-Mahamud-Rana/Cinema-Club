<div class="lottery-panel">
  <div class="row" >
    <div class="large-12 columns">
      <h5>Du kan bl.a vinde</h5>
    </div>
  </div>
  <div class="row lottery-slider" >
    <div class="large-12 text-center">
      <div class="tricky lottery" style="display: none;">
        <?php $query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'award' ,'category_name' => 'active', 'cat' => '-29', 'post_status' => 'publish' , 'posts_per_page' => -1 ) ); ?>
        <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
        <div class="lottery-slider-content">
          <div class="small-12" style="height:100px; background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>); background-size: cover;">&nbsp;</div>
          <p class="lsc"><?php the_title();?></p>
          <hr class="lsc">
        </div>
        <?php endwhile;  wp_reset_postdata(); else : ?>
        <?php _e( 'Sorry, no posts matched your criteria.' ); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="row" >
    <div class="large-12 columns text-right">
      <p><a class="front" data-open="winnerConfirmation">Se tidligere vindere</a></p>
      <hr class="magentaBorder">
    </div>
  </div>
</div>
<div class="large-12 columns">
  <div class="reveal" id="winnerConfirmation" data-reveal>
    <?php $query = new WP_Query( array( 'page_id' => 187, 'post_status' => 'publish' , 'posts_per_page' => 1 ) ); ?>
    <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
    <p class="overlayHeading"><?php the_title(); ?></p>
    <div class="small-12">
      <?php the_content(); ?>
      <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <?php endwhile;  wp_reset_postdata(); else : ?>
    <?php _e( 'Sorry, no posts matched your criteria.' ); ?>
    <?php endif; ?>
  </div>
</div>