<?php
if ( is_bkdk_user_logged_in() != true ) {
wp_redirect(site_url().'/login/');
}
$customerid = get_customerid();
$userDetails = get_user_info($customerid);
$active_flex_membership = $userDetails->active_flex_membership;

//var_dump($userDetails);
$lat = $userDetails->latitude;
$lon = $userDetails->longitude;
$allCinemas = get_all_cinema($customerid, $lat, $lon);
$myCinemas = get_my_cinemas($customerid, $lat, $lon);
$restCinemas = array_diff_key($allCinemas, $myCinemas);
$tempStoreSuccess = $_COOKIE['storeSuccess'];
$tempStoreSuccess = stripslashes($tempStoreSuccess);
$tempStoreSuccess = json_decode($tempStoreSuccess, true);
?>
<div class="createProfile-panel">
  <div class="row">
    <div class="medium-11 medium-centered large-9 large-centered createProfile-form-panel columns">
<?php if ( $active_flex_membership == true) { ?>
      <div class="row steps small-up-1 medium-up-4 large-up-4 columns">
        <div class="column">
          <a class="callSpin" href="<?php echo site_url(); ?>/profile/personal-information/">Navn og adresse</a>
        </div>
        <div class="column sa">
          <a class="callSpin" href="<?php echo site_url(); ?>/profile/notifications/">Notifikationer</a>
        </div>
        <div class="column sa active">
          <a class="callSpin" href="<?php echo site_url(); ?>/profile/favourite-cinema/">Din favoritbiograf</a>
        </div>
        <div class="column si">
            <a class="callSpin" href="<?php echo site_url(); ?>/profile/update-card/">Betalingsoplysninger</a>
          </div>
      </div>
<?php } else { ?>
      <div class="row steps small-up-1 medium-up-3 large-up-3 columns">
        <div class="column">
          <a class="callSpin" href="<?php echo site_url(); ?>/profile/personal-information/">Navn og adresse</a>
        </div>
        <div class="column sa">
          <a class="callSpin" href="<?php echo site_url(); ?>/profile/notifications/">Notifikationer</a>
        </div>
        <div class="column sa active">
          <a class="callSpin" href="<?php echo site_url(); ?>/profile/favourite-cinema/">Din favoritbiograf</a>
        </div>
      </div>
<?php } ?>
      <form action='<?php echo site_url(); ?>/profile/save' method="POST">
        <div class="row columns createProfile-form">
          <?php if(!empty($tempStoreSuccess)) { ?>
          <div class="primary callout piSuccess" data-closable>
            <?php
            echo 'Dine profiloplysninger er gemt.';
            reset_success();
            ?>
            <button class="close-button" aria-label="Dismiss primary" type="button" data-close>
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php } ?>
          <div class="large-12 columns">
            <div class="row">
              <div class="small-12 columns">
                <h2 class="cinemaListHeading">Dine favoritbiografer <span>(</span><span class="choosenValue">0</span><span> valgt)</span></h2>
              </div>
            </div>
            <div class="row cinemaList">
              <div class="small-12 columns allCinemas myCinemas">
                <ul id="fList" class="favouritList">
                  <?php
                  foreach($myCinemas as $myCinema){
                  echo '<li class="favoritecinemaid_' . $myCinema->favoritecinemaid . ' show" style="display:none;"><input type="checkbox" name="favoritecinemaids[]" id="'. $myCinema->favoritecinemaid .'" value="'. $myCinema->favoritecinemaid .'" checked><label for="' . $myCinema->favoritecinemaid . '" ><span class="name">'. $myCinema->name . '</span><br/>';
                  echo '<span class="address">'. $myCinema->adresse . '</span><br/>';
                  echo '<span class="zipcode">'. $myCinema->zipcode .'</span> <span class="city">'. $myCinema->city . '</span><br/>';
                  echo '<p class="placeholder"><span class="distance">'. sprintf ("%.2f", $myCinema->distance) .'</span> km</p></label></li>';
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>
          <div id="cinema" class="large-12 columns">
            <input class="search small-12 cinemaListSearch" placeholder="Søg" />
            <div class="row">
              <div class="small-12 medium-6 large-6 columns">
                <h2 class="cinemaListHeading">Alle biografer</h2>
              </div>
            </div>
            <div class="row cinemaList">
              <div class="small-12 columns allCinemas">
                <ul class="list">
                  <?php
                  foreach($restCinemas as $restCinema){
                  echo '<li class="favoritecinemaid_' . $restCinema->favoritecinemaid . ' show" style="display:none;"><input class="listofcinema" type="checkbox" name="favoritecinemaids[]" id="'. $restCinema->favoritecinemaid .'_all" value="'. $restCinema->favoritecinemaid .'"><label for="' . $restCinema->favoritecinemaid . '_all"><span class="name">'. $restCinema->name . '</span><br/>';
                  echo '<span class="address">'. $restCinema->adresse . '</span><br/>';
                  echo '<span class="zipcode">'. $restCinema->zipcode .'</span> <span class="city">'. $restCinema->city . '</span><br/>';
                  echo '<p class="placeholder"><span class="distance">'. sprintf ("%.2f", $restCinema->distance) .'</span> km</p></label></li>';
                  }
                  ?>
                </ul>
                <ul class="list searchResult">
                  <?php
                  $i = 1;
                  foreach($restCinemas as $restCinema){
                  echo '<li class="favoritecinemaid_' . $restCinema->favoritecinemaid . ' show" style="display:none;"><input class="listofcinema" type="checkbox" name="favoritecinemaids[]" id="'. $restCinema->favoritecinemaid .'_s" value="'. $restCinema->favoritecinemaid .'"><label for="' . $restCinema->favoritecinemaid . '_s"><span class="name">'. $restCinema->name . '</span><br/>';
                  echo '<span class="address">'. $restCinema->adresse . '</span><br/>';
                  echo '<span class="zipcode">'. $restCinema->zipcode .'</span> <span class="city">'. $restCinema->city . '</span><br/>';
                  echo '<p class="placeholder"><span class="distance">'. sprintf ("%.2f", $restCinema->distance) .'</span> km</p></label></li>';
                  if($i == 3) break;
                  $i++;
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="large-12 columns" style="display: none;">
            <ul class="removedList">
            </ul>
            <input id="favouriteCinema" type="checkbox" name='favouriteCinema' value="1" checked>
          </div>
          <div class="large-12 columns text-center calculatedButton">
            <input type="submit" class="button callSpin" value="GEM">
          </div>
          <div class="large-12 columns">
            <p class="lpss text-center"><a class="backTo callSpin" href="<?php echo site_url(); ?>">Fortryd og gå til forside</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
countFav();

jQuery("ul.list>li>input.listofcinema").change(function(){
  if ((this.checked ) == true)  {
    jQuery(this).parent().removeClass("show");
    var className = jQuery(this).parent().attr("class");
    jQuery(jQuery.parseHTML(jQuery("ul.list li." + className).clone().wrap('<li>').parent().html())).appendTo("ul.favouritList");

      if (jQuery("ul.favouritList li." + className).hasClass(className)) {
        jQuery("ul.favouritList li." + className).addClass("selected");
        jQuery("ul.favouritList>li>input.listofcinema").prop("checked", true);
      }
      countFav();
    }
});

jQuery("ul#fList.favouritList").on("click", "li", function() {
  if (jQuery(this).hasClass("show"))  {
      var className = jQuery(this).removeClass("show").attr("class");
    jQuery(jQuery.parseHTML(jQuery("ul#fList.favouritList li." + className).clone().wrap('<li>').parent().html())).appendTo("ul.removedList");

      if (jQuery("ul.removedList li." + className).hasClass(className)) {
        jQuery("ul.removedList>li>input").attr('name', 'removedcinemaids[]');
        jQuery("ul.removedList>li>input").prop("checked", true);
      }
  }
if (jQuery(this).hasClass("selected"))  {
  var className = jQuery(this).removeClass("selected").attr("class");
  if (jQuery("ul.list li." + className).hasClass(className)) {
    jQuery("ul.list li." + className +">input").prop( "checked", false );
    jQuery("ul.list li." + className).addClass("show");
  }
    jQuery("ul#fList.favouritList li." + className).remove();
  }

  countFav();
});
function countFav(){
  var cValue = jQuery("ul.favouritList li").length;
  jQuery("span.choosenValue").html(cValue);
}
</script>