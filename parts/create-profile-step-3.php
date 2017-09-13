<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
{
  $gender = $_POST['gender'];
  $birth_day = $_POST['birth_day'];
  $birth_month = $_POST['birth_month'];
  $birth_year = $_POST['birth_year'];
  $receivegeneralnewsletter = $_POST['receivegeneralnewsletter'];
}
$customerid = get_customerid();
$customer = call_for_update_profile($customerid); # Returns updated profile object

if ($customer == null) {
  $customer = get_user_info($customerid);
}
$lat = $customer->latitude;
$lon = $customer->longitude;

$cinemas = get_all_cinema($customerid, $lat, $lon);
$storeCode =  $_COOKIE['storeCode'];

?>
<div class="createProfile-panel">
  <div class="row">
    <div class="medium-8 medium-centered large-8 large-centered createProfile-form-panel columns">
      <div class="row profileSteps columns">
        <div class="large-4 columns">
          Navn og adresse
        </div>
        <div class="large-4 sa columns">
          Om dig
        </div>
        <div class="large-4 active sa columns">
          Favoritbiograf
        </div>
      </div>
      <?php if (!empty($storeCode)){
          if (strlen($storeCode) != 17){
      ?>
        <form action="<?php echo site_url(); ?>/gem-papirmedlemskab/save/" method="POST" accept-charset="UTF-8" >
        <input type="hidden" name="code" value="<?php echo $storeCode; ?>" maxlength="17" />
        <?php } else  { ?>
        <form action="<?php echo site_url(); ?>/gem-papirkuponer/save/" method="POST" accept-charset="UTF-8" >
        <input type="hidden" name="code" value="<?php echo $storeCode; ?>" maxlength="17" />
      <?php }
      } else  { ?>
      <form action="<?php echo site_url(); ?>/create-profile/success/" method="POST" accept-charset="UTF-8" >
      <?php } ?>
          <div class="row columns createProfile-form">
            <div id="cinema" class="large-12 columns">
              <input class="search small-12 cinemaListSearch" placeholder="Søg" />
              <div class="row">
                <div class="small-12 medium-6 large-6 columns">
                  <h2 class="cinemaListHeading">Alle biografer</h2>
                </div>
                <div class="small-12 medium-6 large-6 columns">
                  <h2 class="cinemaListHeading">Dine favoritbiografer <span>(</span><span class="choosenValue">0</span><span> valgt)</span></h2>
                </div>
              </div>
              <div class="row cinemaList">
                <div class="small-12 medium-6 large-6 columns allCinemas">
                  <ul class="list">
                    <?php
                    foreach($cinemas as $cinema){
                    $distance = $cinema->distance;
                    echo '<li class="favoritecinemaid_' . $cinema->favoritecinemaid . ' show" style="display:none;"><input class="listofcinema" type="checkbox" name="favoritecinemaids[]" id="'. $cinema->favoritecinemaid .'" value="'. $cinema->favoritecinemaid .'"><label for="' . $cinema->favoritecinemaid . '"><span class="name">'. ttruncat($cinema->name , 23). '</span><br/>';
                    if(!empty($distance)){
                      echo '<span class="address distance">'. $cinema->adresse . '</span><br/>';
                    } else{
                      echo '<span class="address">'. $cinema->adresse . '</span><br/>';

                    }
                    echo '<span class="zipcode">'. $cinema->zipcode .'</span> <span class="city">'. $cinema->city . '</span><br/>';
                    if(!empty($distance)){
                      echo '<p class="placeholder"><span class="distance">'. sprintf ("%.2f", $distance) .'</span> km</p></label></li>';
                    }
                    }
                    ?>
                  </ul>
                  <ul class="list searchResult" style="display:none;">
                    <?php
                    $i = 1;
                    foreach($cinemas as $cinema){
                    echo '<li class="favoritecinemaid_' . $cinema->favoritecinemaid . ' show" style="display:none;"><input class="listofcinema" type="checkbox" name="favoritecinemaids[]" id="'. $cinema->favoritecinemaid .'_s" value="'. $cinema->favoritecinemaid .'"><label for="' . $cinema->favoritecinemaid . '_s"><span class="name">'. ttruncat($cinema->name , 23). '</span><br/>';
                    if(!empty($distance)){
                      echo '<span class="address distance">'. $cinema->adresse . '</span><br/>';
                    } else{
                      echo '<span class="address">'. $cinema->adresse . '</span><br/>';

                    }
                    echo '<span class="zipcode">'. $cinema->zipcode .'</span> <span class="city">'. $cinema->city . '</span><br/>';
                    if(!empty($distance)){
                      echo '<p class="placeholder"><span class="distance">'. sprintf ("%.2f", $distance) .'</span> km</p></label></li>';
                    }

                     if($i == 3) break;
                     $i++;
                   }
                    ?>
                  </ul>
                </div>
                <div class="small-12 medium-6 large-6 columns allCinemas">
                  <ul id="fList" class="favouritList">
                  </ul>
                </div>
              </div>
            </div>
            <div class="large-12 columns text-center calculatedButton">
                  <input name="utf8" type="hidden" value="✓" />
                  <input type="submit" class="button callSpin" value="AFSLUT">
            </div>
            <!--div class="large-12 columns">
              <p class="lpss text-center"><a class="backTo" href="<?php echo site_url(); ?>/create-profile/step-2/">Tilbage</a></p>
            </div-->
          </div>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript">
  function countFav(){
  var cValue = jQuery("ul.favouritList li").length;
  jQuery("span.choosenValue").html(cValue);
  //bindAddressEvent();
  }
/*
function bindAddressEvent(){
  jQuery("ul.list>li>input.listofcinema").change(function(){
    var self = jQuery(this);
    var li = self.parent();
    jQuery(li).appendTo("ul.favouritList");
    countFav();
});

  jQuery("ul.favouritList>li>input.listofcinema").change(function(){
    var self = jQuery(this);
    var li = self.parent();
    jQuery(li).prependTo("ul.list");
    countFav();
    });
  }
bindAddressEvent();

*/

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
  var className = jQuery(this).removeClass("selected").attr("class");
  //alert(className);
  if (jQuery("ul.list li." + className).hasClass(className)) {
    jQuery("ul.list li." + className).addClass("show");
  }

  jQuery(this).remove();
  countFav();
});

</script>