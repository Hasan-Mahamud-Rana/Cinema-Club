<div class="small-12 columns">
  <?php custom_breadcrumbs(); ?>
</div>
<article id="post-<?php the_ID(); ?>" class="singleMovieContentWrapper" role="article" itemscope itemtype="http://schema.org/BlogPosting">
  <div class="row ForApp">
    <div class="small-12 columns mDewtailsForApp" >
      <div class="row">
        <div class="small-6 columns" >
          <?php
          $director = "director";
          $director = get_field_object($director);
          if( !empty($director) ): ?>
          <?php echo "<h4>" . $director['label'] . ":</h4>";
          echo "<p>" . $director['value'] . "</p>"; ?>
          <?php endif; ?>
          <?php
          $cast = "medvirkende";
          $cast = get_field_object($cast);
          if( !empty($cast) ): ?>
          <?php echo "<h4>" . $cast['label'] . ":</h4>";
          echo "<p>" . $cast['value'] . "</p>"; ?>
          <?php endif; ?>
        </div>
        <div class="small-6 columns text-right" >
          <?php
          $genre = "genre";
          $genre = get_field_object($genre);
          if( !empty($genre) ): ?>
          <?php echo "<h6>" . $genre['label'] . ":</h6>";
          echo "<p>" . $genre['value'] . "</p>"; ?>
          <?php endif; ?>
          <?php
          $duration = "spilletid";
          $duration = get_field_object($duration);
          if( !empty($duration) ): ?>
          <?php echo "<h6>" . $duration['label'] . ":</h6>";
          echo "<p>" . $duration['value'] . " minutter</p>"; ?>
          <?php endif; ?>
          <?php
          $movieName = "originaltitel";
          $movieName = get_field_object($movieName);
          if( !empty($movieName) ): ?>
          <?php echo "<h6>" . $movieName['label'] . ":</h6>";
          echo "<p>" . $movieName['value'] . "</p>"; ?>
          <?php endif; ?>
        </div>
      </div>
      <div class="row">
        <div class="small-12 columns" >
          <h4>Om Filmen:</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="small-12 medium-12 large-6 columns" >
    <div class="singleMovieShortInfo">
      <span class="movieTag">
<?php $post_tags = get_the_tags();
if ( $post_tags ) {
  foreach( $post_tags as $tag ) {
    $tagName = $tag->name;
    $tagSlug = $tag->slug;
    if($tagName === "Premium"){
      echo '<a class="t_'. $tagName .'" href="' . site_url() . '/tag/'. $tagSlug .'/" rel="tag">'. $tagName .'</a> ';
    }
  }
  foreach( $post_tags as $tag ) {
    $tagName = $tag->name;
    $tagSlug = $tag->slug;
    if($tagName === "Basis"){
      echo '<a class="t_'. $tagName .'" href="' . site_url() . '/tag/'. $tagSlug .'/" rel="tag">'. $tagName .'</a> ';
    }
  }
  foreach( $post_tags as $tag ) {
    $tagName = $tag->name;
    $tagSlug = $tag->slug;
    if(($tagName != "Premium") && ($tagName != "Basis")){
      echo '<a class="t_'. $tagName .'" href="' . site_url() . '/tag/'. $tagSlug .'/" rel="tag">'. $tagName .'</a> ';
    }
  }
}
?>
</span><br/>
      <div class="large-12 movie-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?>">
        <?php the_title(); ?>
      </a></div>
      <?php
      $field_name_premiere = "premiere";
      $field_premiere = get_field_object($field_name_premiere);
      echo '<span class="premiereDate">'.$field_premiere['label'] .' '. $field_premiere['value']. '</span>';
      ?>
    <br/></div>
    <?php the_content(); ?>
    <?php
    if ( is_bkdk_user_logged_in() == true ) {
    global $post;
    $wpSlugName=$post->post_name;
    $faf_film_id = get_field('faf_film_id');
    if(!empty($faf_film_id)) {
    echo '<form action="' . site_url() . '/coupon/specific/" method="POST">';
      echo '<input type="hidden" name="fafFilmid" value="' .$faf_film_id . '" />';
      echo '<input type="hidden" name="wpSlugName" value="' .$wpSlugName . '" />';
      echo '<input type="submit" class="button callSpin" value="SE dine FILMKUPONER">';
    echo '</form>';
    }
    }
    ?>
  </div>
  <div class="small-12 medium-12 large-6 columns" >
    <div class="row">
      <div class="small-12 columns ForWeb" >
        <div class="callout secondary">
          <div class="row">
            <div class="small-6 columns" >
              <?php
              $director = "director";
              $director = get_field_object($director);
              if( !empty($director) ): ?>
              <?php echo "<h4>" . $director['label'] . ":</h4>";
              echo "<p>" . $director['value'] . "</p>"; ?>
              <?php endif; ?>
              <?php
              $cast = "medvirkende";
              $cast = get_field_object($cast);
              if( !empty($cast) ): ?>
              <?php echo "<h4>" . $cast['label'] . ":</h4>";
              echo "<p>" . $cast['value'] . "</p>"; ?>
              <?php endif; ?>
            </div>
            <div class="small-6 columns text-right" >
              <?php
              $genre = "genre";
              $genre = get_field_object($genre);
              if( !empty($genre) ): ?>
              <?php echo "<h6>" . $genre['label'] . ":</h6>";
              echo "<p>" . $genre['value'] . "</p>"; ?>
              <?php endif; ?>
              <?php
              $duration = "spilletid";
              $duration = get_field_object($duration);
              if( !empty($duration) ): ?>
              <?php echo "<h6>" . $duration['label'] . ":</h6>";
              echo "<p>" . $duration['value'] . " minutter</p>"; ?>
              <?php endif; ?>
              <?php
              $movieName = "originaltitel";
              $movieName = get_field_object($movieName);
              if( !empty($movieName) ): ?>
              <?php echo "<h6>" . $movieName['label'] . ":</h6>";
              echo "<p>" . $movieName['value'] . "</p>"; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="small-12 columns galleryForApp" >
        <div class="callout secondary">
          <?php
          $movieGallery = "galleri";
          $movieGallery = get_field_object($movieGallery);
          if( !empty($movieGallery) ): ?>
          <?php
          echo "<h4>" . $movieGallery['label'] . "</h4>";
          echo '<div class="small-12 movieGallery" style="display: none;">' . $movieGallery['value'] . '</div>';
          echo '<div class="small-12 movieGalleryThumb" style="display: none;">' . $movieGallery['value'] . '</div>';
          ?>
          <?php endif;?>
        </div>
      </div>
      <?php
      if ( !urlForApp() ) {
      ?>
      <div class="small-12 columns galleryForApp" >
        <div class="callout secondary">
          <a class="fb-share" onClick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" target="_parent" href="javascript: void(0)">DEL PÅ FACEBOOK</a>
        </div>
        <?php } ?>
      </div>
    </div>
  </article>
  <script type="text/javascript">
  jQuery("a.bread-cat.bread-custom-post-type-movie[href='http://test.bordingvista.com/BiografklubDK/movie/']").attr('href', 'http://test.bordingvista.com/BiografklubDK/movies/');
  jQuery("a.bread-cat.bread-custom-post-type-movie").text("Film");
  </script>