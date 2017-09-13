<?php
if ( is_bkdk_user_logged_in() != true ) {
  wp_redirect(site_url().'/login/');
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
  <div class="kuponPanel" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)">
    <div class="row">
      <div class="small-12 medium-11 medium-centered large-8 large-centered columns text-center">
        <header class="article-header">
          <h3 class="page-title">Dine kuponer</h3>
        </header>
        <section class="entry-content" itemprop="articleBody">
          <p>Her er et overblik over alle dine film- og fordelskuponer. Under 'Se kuponer',<br/>kan du se, hvor mange du har, du kan sende dem videre, og du kan printe dem.</p>
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
          $code_optional = get_field('code_optional');
          $expire_date = get_field('end_date');
          $validtoDate=date_create($expire_date);
          $date = new DateTime(date_format($validtoDate, "d. F Y") );
          ?>
          <div class="row column">
            <div class="small-12 medium-10 medium-centered large-8 large-centered columns pKuponBG">
              <?php
              the_title('<h3>', '</h3>');
              echo '<p class="date dkDate">Udløber: ' . str_replace( $findDate, $replaceDate, $date->format("d. F Y")) . '</p>';
              if(!empty($code_optional)){
                echo "<h4><span>" . $code_optional . "</span></h4>";
              }
              the_content();
              ?>
            </div>
            <p class="lpss text-center"><a  data-open="partnerCondition">Læs betingelser</a></p>
          </div>

        </div>
      </div>
    </div>
  </div>
</article>
<?php
$condition = get_field('condition');
if( $condition ):
  $post = $condition;
  setup_postdata( $post );
  ?>
<div class="large-12 columns">
  <div class="reveal" id="partnerCondition" data-reveal>
    <p class="overlayHeading"><?php the_title(); ?></p>
    <div class="small-12">
      <?php the_content(); ?>
      <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
</div>
<?php
  wp_reset_postdata();
  endif;
?>