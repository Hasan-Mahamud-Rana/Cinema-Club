<div class="cookies-style-footer small-12 medium-12 large-12 columns">
	<div class="row cookie-content-footer">
		<?php $query = new WP_Query( array( 'category_name' => 'footer-cookies' , 'post_status' => 'publish', 'order' => 'ASC' , 'posts_per_page' => 1 ) ); ?>
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
			<?php the_content(); ?>
				<p style="text-align: center;"><button class="button-footer" type="button">Ok</button></p>
				<p style="text-align: center;"><a class="callSpin" href="<?php echo site_url(); ?>/cookie-og-privatlivspolitik/" target="_blank">Læs mere</a></p>
			<?php endwhile;  wp_reset_postdata(); else : ?>
			<?php _e( 'Sorry, no posts matched your criteria.' ); ?>
    <?php endif; ?>
	</div>
</div>
<script type="text/javascript">
	jQuery('.cookies-style-footer .button-footer').click(function(e) {
    jQuery('#cookiesPopupFooter').fadeOut();
  });
</script>