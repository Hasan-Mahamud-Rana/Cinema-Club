<?php
if ( is_bkdk_user_logged_in() != true ) {
wp_redirect(site_url().'/movies');
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
{
$membershiporderlineid =  $_POST['membershiporderlineid'];
$wp_movie_list_category =  $_POST['wp_movie_list_category'];
}
$customerid = get_customerid();
skip_flex_membership($customerid, $membershiporderlineid);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
	<div class="flexPanel">
		<div class="row">
			<div class="small-12 medium-8 medium-centered large-8 large-centered flexCancel-panel columns">
				<div class="row flexCancel-heading">
					<?php the_title('<h3>', '</h3>') ?>
				</div>
				<div class="row flex-movie-slider" >
					<div class="large-12 text-center">
						<div class="tricky flexMovie" style="display: none;">
							<?php $query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' ,'category_name' => $wp_movie_list_category, 'cat' => '-13', 'post_status' => 'publish' , 'posts_per_page' => -1 ) ); ?>
							<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
							<a class="medium-12 large-12" href="<?php the_permalink() ?>" rel="bookmark" title="Link to <?php the_title_attribute(); ?>" style="height:213px; background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)">&nbsp;</a>
							<?php endwhile;  wp_reset_postdata(); else : ?>
							<?php _e( '</div><div class="small-12 movieNotDeclared">&nbsp;</div><div class="small-12 text-center"><h4>Film på vej</h4></div><div>' ); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<section class="entry-content" itemprop="articleBody"><br/>
					<?php
					the_content();
					echo '<p class="lgindbtn text-center calculatedButton callSpin"><a class="button" href="'.site_url().'/my-membership/">Mit Medlemskab</a></p>';
					?>
				</section>
			</div>
		</div>
	</div>
</article>