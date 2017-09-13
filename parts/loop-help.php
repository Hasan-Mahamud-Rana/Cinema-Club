<div class="help-panel">
  <div class="row helpSection" >
    <div class="large-12">
      <ul class="accordion" data-accordion data-allow-all-closed="true">
        <?php $query = new WP_Query( array( 'order' => 'asc' , 'post_type' => 'help' , 'post_status' => 'publish', 'posts_per_page' => -1  ) ); ?>
        <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
        <li class="accordion-item" data-accordion-item>
          <a href="#" class="accordion-title"><?php the_title(); ?></a>
          <div class="accordion-content" data-tab-content>
            <?php the_content(); ?>
            <?php
            $purchase_button_label = get_field('purchase_button_label');
            if( !empty($purchase_button_label) ):
            if ( urlForApp() ) {
            ?>
            <?php }
            else {
            ?>
            <?php echo $purchase_button_label; ?>
            <?php } ?>
            <?php endif; ?>
          </div>
        </li>
        <?php endwhile;  wp_reset_postdata(); else : ?>
        <?php _e( 'Sorry, no posts matched your criteria.' ); ?>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</div>