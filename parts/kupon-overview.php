<?php
if ( is_bkdk_user_logged_in() != true ) {
wp_redirect(site_url().'/login');
}
$customerid = get_customerid();
$movieLists = get_user_movies($customerid);
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
      <div class="small-12 medium-11 medium-centered large-8 large-centered">
        <div class="row couponSteps columns">
          <div class="small-6 medium-6 large-6 active columns">
            <a class="filmCoupon callSpin" href="<?php echo site_url(); ?>/coupon/">Dine filmkuponer</a>
          </div>
          <div class="small-6 medium-6 large-6 columns">
            <a class="partnerCoupon callSpin" href="<?php echo site_url(); ?>/partner-coupon/">Dine fordelskuponer</a>
          </div>
        </div>
        <div class="movie-list">
          <?php
          foreach($movieLists as $movieList)
          {
          $name = $movieList->name;
          $fafFilmid = $movieList->faf_filmid;
          //echo "fafFilmid: " . $fafFilmid;
          $wp_movie_id = $movieList->wp_movie_id;
          //echo "wp_movie_id: " . $wp_movie_id;
          $wpSlugName = $movieList->wp_slug_name;
          echo '<div class="row column">';
            echo '<div class="medium-8 large-8 columns movieBG">';
              echo '<h4>'. ttruncat($name, 15) . '</h4>';
            echo '</div>';
            echo '<div class="medium-4 large-4 columns kuponBtn">';
              if(!empty($fafFilmid)){
              echo '<form action="'. get_permalink(). 'specific?fafFilmid=' .$fafFilmid . '" method="POST" accept-charset="UTF-8">';
                } else {
                echo '<form action="'. get_permalink(). 'specific?movieid=' .$wp_movie_id . '" method="POST" accept-charset="UTF-8">';
                  }
                  echo '<input type="hidden" name="wp_movie_id" value="' .$wp_movie_id . '" />';
                  echo '<input type="hidden" name="wpSlugName" value="' .$wpSlugName . '" />';
                  echo '<input name="utf8" type="hidden" value="✓" />';
                  echo  '<input type="submit" class="button callSpin" value="SE KUPONER">';
                echo '</form>';
              echo '</div>';
            echo '</div> <hr>';
            }
            if (empty($movieLists)) {
            echo '<h4>Du har desværre ingen filmkuponer.</h4>';
            echo '<p class="emptyText">Du modtager filmkuponer, når du køber et medlemskab. Filmkuponerne giver dig halv pris på udvalgte kvalitetsfilm.</p>';
            echo  '<p class="text-center"><a class="button callSpin" href="' . site_url() . '/purchase/">Køb medlemskab</a></p>';
            }
            ?>
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