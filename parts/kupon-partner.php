<?php
if ( is_bkdk_user_logged_in() != true ) {
wp_redirect(site_url().'/login/');
}
$customerid = get_customerid();
$movieLists = get_user_movies($customerid);
$findReplace = findReplace();
$findDate = $findReplace[0];
$replaceDate = $findReplace[1];
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
  <div class="kuponPanel">
    <div class="row">
      <div class="small-12 medium-11 medium-centered large-8 large-centered columns text-center">
        <header class="article-header">
          <?php the_title('<h3 class="page-title">', '</h3>'); ?>
        </header>
        <section class="entry-content" itemprop="articleBody">
          <?php the_content(); ?>
        </section>
      </div>
    </div>
    <div class="row">
      <div class="small-12 medium-11 medium-centered large-8 large-centered columns">
        <div class="row couponSteps columns">
          <div class="medium-6 large-6 columns">
            <a class="filmCoupon callSpin" href="<?php echo site_url(); ?>/coupon/">Dine Filmkuponer</a>
          </div>
          <div class="medium-6 large-6 active columns">
            <a class="partnerCoupon callSpin" href="<?php echo site_url(); ?>/partner-coupon/">Dine fordelskuponer</a>
          </div>
        </div>
        <div class="movie-list">
          <?php
          $categoryName = $_GET['category_name'];
          $query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'partnervoucher' ,'cat' => '-45' , 'category_name' => $categoryName, 'post_status' => 'publish' , 'posts_per_page' => -1 ) ); ?>
          <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
          $expire_date = get_field('end_date');
          $validtoDate=date_create($expire_date);
          $date = new DateTime(date_format($validtoDate, "d. F Y") );
          ?>
          <div class="row column">
            <div class="medium-8 large-8 columns movieBG">
              <?php
              the_title('<h3>', '</h3>');
              echo '<p class="date dkDate">Udløber: ' . str_replace( $findDate, $replaceDate, $date->format("d. F Y")) . '</p>';
              ?>
            </div>
            <div class="medium-4 large-4 columns kuponBtn">
              <a href="<?php the_permalink() ?>" rel="bookmark" title="Link to <?php the_title_attribute(); ?>" class="button callSpin pbutton">SE KUPONER</a>
            </div>
          </div> <hr>
          <?php endwhile;  wp_reset_postdata(); else : ?>
            <?php the_excerpt(); ?>
          <?php endif; ?>
        </div>
        <div class="row columns">
          <div class="large-12 text-center">
            <?php
            if (!empty($movieLists)) {
            echo '<p><a class="callSpin" href="' . site_url() . '/gem-papirkuponer/">Vil du gemme flere papirkuponer?</a></p>';
            } else{
            echo '<p><a class="callSpin" href="' . site_url() . '/gem-papirkuponer/">Hvis du har modtaget en papirkupon, kan du gemme den her</a></p>';
            }?>
          </div>
        </div>
      </div>
    </div>
  </div>
</article>