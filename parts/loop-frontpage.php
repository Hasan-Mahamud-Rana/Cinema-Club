<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
	<header class="article-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>
    <section class="entry-content" itemprop="articleBody">
	    <?php the_content(); ?>
	    <!--a data-open="aboutMembership">Læs om vores medlemskaber.</a-->
	</section>
</article>
<!--div class="large-12 columns">
    <?php //$query = new WP_Query( array( 'page_id' => 117, 'post_status' => 'publish' , 'posts_per_page' => 1 ) ); ?>
    <?php //if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
    <div class="reveal" id="aboutMembership" data-reveal>
      <p class="overlayHeading"><?php //the_title(); ?></p>
    <div class="small-12 FilmpakkenPopUp">
        <?php //the_content(); ?>
        <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
  </div>
  <?php //endwhile;  wp_reset_postdata(); else : ?>
  <?php //_e( 'Sorry, no posts matched your criteria.' ); ?>
  <?php //endif; ?>
</div-->