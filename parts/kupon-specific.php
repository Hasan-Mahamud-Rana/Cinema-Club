<?php
if ( is_bkdk_user_logged_in() != true ) {
wp_redirect(site_url().'/movies/');
}
$customerid = get_customerid();
if(count($_GET)>0){
$fafFilmid =  $_GET['fafFilmid'];
$singleMovieKupons = get_single_movie_kupon($customerid, $fafFilmid);
$getMovieDetails = get_movie_slug($customerid, $fafFilmid);
$wpSlugName = $getMovieDetails->wp_slug_name;
$movieName = $getMovieDetails->name;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
{
  $wp_movie_id =  $_POST['wp_movie_id'];
  $wpSlugName =  $_POST['wpSlugName'];
}
if (!empty($fafFilmid)){
  $singleMovieKupons = get_single_movie_kupon($customerid, $fafFilmid);
}
$current_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$getKuponStats = get_kupon_stats($customerid, $fafFilmid);
$free = $getKuponStats->free;
$total = $getKuponStats->total;
$errorMessage = $_COOKIE['storeErrorMessage'];
$errorBarcode = $_COOKIE['storeErrorBarcode'];
$errorRecipient = $_COOKIE['storeErrorRecipient'];
$errorSender = $_COOKIE['storeErrorSender'];
$successName = $_COOKIE['storeSuccessName'];
$successTicketnumber = $_COOKIE['storeSuccessTicketnumber'];
reset_send_single_movie_kupon_error();
?>
<?php if(!empty($errorMessage) || !empty($successName) ) { ?>
<div class="reveal" id="kuponProcess" data-reveal>
  <div class="kuponOverlay">
    <div class="text-center kuponSendSuccess">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="kuponreveal">
        <p class="overlayHeading">KUPON <?php echo $successTicketnumber; ?></p>
        <?php
        $query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' , 'cat' => '-13' , 'name' => $wpSlugName, 'post_status' => 'publish' , 'posts_per_page' => 1 ) ); ?>
        <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
        <?php the_title('<h4 class="movieTitle">','</h4>'); ?>
        <?php
        if(!empty($errorMessage)) {
          echo "<h4>" . $errorMessage . "</h4>";
          echo "<p>" . $errorBarcode . "</p>";
          echo "<p>" . $errorRecipient . "</p>";
          echo "<p>" . $errorSender . "</p>";
        }
        ?>
        <?php if(!empty($successName) ) { ?>
        <p>Kuponen er sendt til <?php echo $successName ?>.<br/>
          Du har <?php echo $free ?>
          <?php if ($free == 1){
          echo "filmkupon";
          } else{
          echo "filmkuponer";
          }  ?>
        tilbage til <?php the_title( ); ?>.</p>
        <?php } ?>
      </div>
      <?php endwhile;  wp_reset_postdata(); else : ?>
      <?php _e( 'Sorry, no posts matched your criteria.' ); ?>
      <?php endif; ?>
      <?php endwhile; endif; ?>
    </div>
  </div>
  <button class="close-button" data-close aria-label="Close modal" type="button">
  <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php } ?>
<a class="openWhenPageload" data-open="kuponProcess">Click</a>
<div id="content" <?php body_class(); ?>>
  <div id="inner-content" class="row KuponMovieIntro">
    <main id="main" class="small-12 medium-12 large-12" role="main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
      <div class="small-12 medium-12 large-12">
        <?php
        $query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' , 'cat' => '-13' , 'name' => $wpSlugName, 'post_status' => 'publish' , 'posts_per_page' => 1 ) ); ?>
        <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
        <div class="movieInfoWrapper" style="background-image: url(<?php if(get_field('trailer_placeholder')){ echo ''. get_field('trailer_placeholder') . '';}?>)">
          <div class="movieInfoForWeb">
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
            <span class="movie-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Læs mere om <?php the_title_attribute(); ?>"><?php the_title(); ?></a></span><br/>
            <?php
            $field_name_premiere = "premiere";
            $field_premiere = get_field_object($field_name_premiere);
            echo '<span class="premiereDate">'.$field_premiere['label'] .' '. $field_premiere['value']. '</span>';
            ?>
          </div>
          <?php if( get_field('movie_trailer')){
          $videoClass = 'video-js vjs-default-skin';
          //echo $videoClass;
          $field_name_videoPlaceholder = "trailer_placeholder";
          $videoPlaceholder = get_field_object($field_name_videoPlaceholder);
          //echo $videoPlaceholder['value'];
          $field_name_movie_trailer = "movie_trailer";
          $movieTrailer = get_field_object($field_name_movie_trailer);
          //echo $movieTrailer['value'];
          echo '<video class="'.$videoClass.'" controls preload="none" poster="'.$videoPlaceholder['value'].'" data-setup="{}">';
            echo '<source src="'.$movieTrailer['value'].'" type="video/mp4">';
            echo '<source src=" " type="video/webm">';
            echo '<source src=" " type="video/ogg">';
          echo '<track kind="captions" src=" " srclang="en" label="English"></track>';
        echo '<track kind="subtitles" src=" " srclang="en" label="English"></track>';
        echo '<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>';
      echo '</video>';
      } ?>
    </div>
    <div class="large-12 movieReadMore text-center">
      <a class="button callSpin" href="<?php the_permalink() ?>" rel="bookmark" title="Læs mere om <?php the_title_attribute(); ?>">Læs mere om filmen</a>
    </div>
    <a href="<?php the_permalink() ?>" rel="bookmark" title="Læs mere om <?php the_title_attribute(); ?>">
      <div class="large-12 movieInfoForApp">
        <?php the_title('<p class="movie-title">' , '</p>'); ?>
        <?php
        $field_name_premiere = "premiere";
        $field_premiere = get_field_object($field_name_premiere);
        echo '<p class="premiere">'.$field_premiere['label'] .' '. $field_premiere['value']. '</p>';
        ?>
      </div>
    </a>
    <?php endwhile;  wp_reset_postdata(); else : ?>
    <?php _e( 'Sorry, no posts matched your criteria.' ); ?>
    <?php endif; ?>
  </div>
</article>
<?php endwhile; endif; ?>
</main> <!-- end #main -->
</div> <!-- end #inner-content -->
</div> <!-- end #content -->
<div class="kupon-slider">
  <div class="row">
    <div class="large-12">
      <p><a class="back callSpin" href="<?php echo site_url(); ?>/coupon/">Se alle kuponer</a></p>
      <h2>Klik på filmkuponen, hvis du vil sende den videre eller udskrive den.</h2>
      <ul class="tricky kuponSlider" style="display: none;">
        <?php
        if (!empty($fafFilmid)){
        $count = 1;
        foreach($singleMovieKupons as $singleMovieKupon)
        {
        $barcodeComplete = $singleMovieKupon->barcode_complete;
        $status = $singleMovieKupon->status;
        $recipientData = $singleMovieKupon->recipient_data;
        echo '<li class="singleKupon"><div class="couponBg" myattr="b_'. $barcodeComplete .'">';
          echo '<p class="mName">' . ttruncat($movieName, 15) . '</p>';
          if($status == active){
          echo '<p class="kText">Kupon <span class="countValue">' . $count . '</span> af <span class="countValue">' . $total . '</span></p>';
          }
          if($status == sent || $status == brugt){
          echo '<div class="s">';
            echo '<p class="kText">Kupon <span class="countValue">' . $count . '</span> af <span class="countValue">' . $total . '</span></p>';
            }
            echo '<img class="barcode" src="'.get_template_directory_uri().'/libs/barcode/barcode.php?text='. $barcodeComplete .'" alt="'. $barcodeComplete .'" />';
            if($status == sent || $status == brugt){
          echo '</div>';
          }
          if($status == sent){
          echo '<img class="sendBarcode" src="'.get_template_directory_uri().'/assets/images/sendt.png"/>';
          }
          if($status == brugt){
          echo '<img class="sendBarcode" src="'.get_template_directory_uri().'/assets/images/brugt.png"/>';
          }
          if($status == sent || $status == brugt){
          echo '<div class="s">';
            }
            echo '<p class="barcodeComplete">'. $barcodeComplete .'</p>';
            if($status == active){
            echo '<p class="sendPrintCall text-center">•••</p>';
            }
            if($status == sent || $status == brugt){
          echo '</div>';
          }
          if($status != active){
          echo '<p>Kuponen er sendt til<br/>'. $recipientData .'</p>';
          }
        echo '</div>';
        if($status == active){
        echo '<div class="b_'. $barcodeComplete .'"><div class="arrow-up"></div><div class="sendPrintWrapper">';
        echo '<ul class="sendPrint"><li class="liSend">';
          echo '<p class="text-center"><a class="sendkuponButton" data-open="sendkuponButton" myvalue="' . $count . '" myBarCode="' . $barcodeComplete . '"  style="padding: 5px 20px;">Send</a></p></li><li class="liPrint">';
          echo '<form action="'. site_url() . '/coupon/pdf/?barcode-' . $wpSlugName . '-' .$barcodeComplete . '.pdf" method="POST" target="_blank">';
            echo '<input type="hidden" name="fafFilmid" value="' .$fafFilmid . '" />';
            echo '<input type="hidden" name="wpSlugName" value="' .$wpSlugName . '" />';
            echo '<input type="hidden" name="barcode_complete" value="' .$barcodeComplete . '" />';
            echo '<input type="hidden" name="printMe" value="1" />';
            echo '<p class="text-center"><input type="submit" class="callSpin" value="Udskriv"></p>';
          echo '</form></li></ul>';
        echo '</div></div>';
        }
      echo '</li>';
      $count++;
      }
    }
      ?>
    </ul>
  </div>
</div>
<div class="row">
  <div class="large-12">
    <?php
    if($free != 0){
    echo '<form action="'. site_url() . '/coupon/pdf/?barcodes-' . $wpSlugName . '.pdf" method="POST" target="_blank">';
      echo '<input type="hidden" name="fafFilmid" value="' .$fafFilmid . '" />';
      echo '<input type="hidden" name="wpSlugName" value="' .$wpSlugName . '" />';
      echo '<input type="hidden" name="printAll" value="1" />';
      echo '<p class="text-center"><input type="submit" class="button callSpin" value="UDSKRIV ALLE KUPONER"></p>';
      echo '<p class="text-center">Vil du udskrive hele dit billetark, skal du gøre det via den e-mail, du har modtaget</p>';
      echo '</form>';
    }
    ?>
  </div>
</div>
</div>
<div class="large-12 columns">
<div class="reveal text-center kuponReveal" id="sendkuponButton" data-reveal>
  <p class="overlayHeading">KUPON <span class="countfromCount"> </span> af <span class="countValue"><?php echo $total ?></span></p>
  <?php
  $query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' , 'cat' => '-13' , 'name' => $wpSlugName, 'post_status' => 'publish' , 'posts_per_page' => 1 ) ); ?>
  <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
  <?php the_title('<h4 class="movieTitle">','</h4>'); ?>
  <?php endwhile;  wp_reset_postdata(); else : ?>
  <?php _e( 'Sorry, no posts matched your criteria.' ); ?>
  <?php endif; ?>
  <p class="overlayText">Udfyld felterne og send filmkuponen til en ven.</p>
  <form id="sendkuponToFriend" action='<?php echo site_url(); ?>/coupon/send/' method="POST"  data-parsley-validate data-parsley-focus="none">
    <div class="large-12 columns">
      <input class="myName" type="text" placeholder="Din vens navn" name='myname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast dit navn" data-parsley-required-message="Indtast dit navn" required>
      <input class="barcodeComplete" type="hidden" name='barcodeComplete'>
      <input class="fafFilmid" type="hidden" name='fafFilmid' value="<?php echo $fafFilmid ?>">
      <input class="wp_movie_id" type="hidden" name='wp_movie_id' value="<?php echo $wp_movie_id ?>">
      <input class="wpSlugName" type="hidden" name='wpSlugName' value="<?php echo $wpSlugName ?>">
    </div>
    <div class="large-12 columns">
      <input class="myEmail" type="text" placeholder="Din vens e-mail" name='email' data-parsley-type="email" data-parsley-minlength="2" data-parsley-minlength-message="Udfyld venligst din vens e-mail og nav" data-parsley-required-message="Udfyld venligst din vens e-mail og nav" required>
    </div>
    <div class="large-12 columns">
      <textarea class="myMessage" type="text" name='message' maxlength="306" placeholder="Skriv en besked til din ven (valgfrit)"></textarea>
    </div>
    <input type="hidden" name="currentlink" value="<?php echo $current_link; ?>" />
    <input class="calculatedButton sendBarcodeComplete overlay button callSpin" type="submit" name="" value="Send">
    <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
    </button>
  </form>
</div>
</div>

<script>
jQuery("a.sendkuponButton").click(function(){
  var countValue = jQuery(this).attr("myvalue");
  jQuery("span.countfromCount").html(countValue);

  var barcodeComplete = jQuery(this).attr("myBarCode");
  jQuery("input.barcodeComplete").val(barcodeComplete);
});

  jQuery(function () {
    jQuery('form#sendkuponToFriend').parsley().on('field:validated', function() {
        jQuery( "input.parsley-error" ).each(function() {
        var placeholder = jQuery(this).attr("data-parsley-required-message");
        jQuery(this).attr("placeholder", placeholder);
        });
    })
});
</script>