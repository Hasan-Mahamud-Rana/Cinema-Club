<?php
$userIP = get_client_ip();

$customerid = get_customerid();
$purchasableMemberships = get_purchasable_memberships($customerid);
foreach($purchasableMemberships as $purchasableMembership){
$product_name = $purchasableMembership->product_name;
$membershipproductid = $purchasableMembership->membershipproductid;
	if ($product_name == "Basis"){
		$basisID = $purchasableMembership->membershipproductid;
		$basisPrice = $purchasableMembership->price;
	}
	if ($product_name == "Premium"){
		$premiumID =  $purchasableMembership->membershipproductid;
		$premiumPrice = $purchasableMembership->price;
	}
}
$flexValue =  $_COOKIE['basketFlexNumber'];
$flexID =  $_COOKIE['basketFlexID'];
$flexPrice =  $_COOKIE['basketFlexPrice'];
$basisNumber =  $_COOKIE['basketBasisNumber'];
$basis_value = $basisNumber;
$basisTotal = $basis_value * $basisPrice;
$premiumNumber =  $_COOKIE['basketPremiumNumber'];
$premium_value = $premiumNumber;
$premiumTotal = $premium_value * $premiumPrice;
$basket_totalcost = ($basisTotal + $premiumTotal + ($flexPrice * 100) );
$cart = $basis_value + $premium_value;
$deliveryMethod = $_COOKIE['basketDeliveryMethod'];
if ($basisNumber != 0){
	$b = 1;
} else{
	$b = 0;
}
if ($premiumNumber != 0){
	$p = 1;
} else {
	$p = 0;
}
$bp = $b.$p;
$tempErrorMessage = $_COOKIE['formErrorMessage'];
$tempErrorDeliveryMethod = $_COOKIE['formErrorDeliveryMethod'];
$tempErrorDeliveryMethod = stripslashes($tempErrorDeliveryMethod);
$tempErrorDeliveryMethod = json_decode($tempErrorDeliveryMethod, true);
$tempErrorBasketTotalcost = $_COOKIE['formErrorBasketTotalcost'];
$tempErrorBasketTotalcost = stripslashes($tempErrorBasketTotalcost);
$tempErrorBasketTotalcost = json_decode($tempErrorBasketTotalcost, true);
$tempErrorPurchase = $_COOKIE['formErrorPurchase'];
$tempErrorPurchase = stripslashes($tempErrorPurchase);
$tempErrorPurchase = json_decode($tempErrorPurchase, true);
$tempErrorLastname = $_COOKIE['formErrorLastname'];
$tempErrorLastname = stripslashes($tempErrorLastname);
$tempErrorLastname = json_decode($tempErrorLastname, true);
$tempErrorYear = $_COOKIE['formErrorYear'];
$tempErrorYear = stripslashes($tempErrorYear);
$tempErrorYear = json_decode($tempErrorYear, true);
$tempErrorNumber = $_COOKIE['formErrorNumber'];
$tempErrorNumber = stripslashes($tempErrorNumber);
$tempErrorNumber = json_decode($tempErrorNumber, true);
reset_payment_error();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
	<div class="purchasePackageHead">
		<div class="row">
			<header class="article-header">
				<?php //the_title('<h3 class="page-title">', '</h3>'); ?>
			</header>
			<section class="entry-content" itemprop="articleBody">
				<?php the_content(); ?>
			</section>
		</div>
	</div>
	<div class="createProfile-panel cBlock">
		<div class="row">
			<div class="medium-11 medium-centered large-9 large-centered createProfile-form-panel">
				<div class="row purchaseStep small-up-1 medium-up-5 large-up-5 columns">
					<div class="column">
						<?php
								if ($flexValue != NUll) {
								echo "MEDLEMSKAB";
																	}	elseif ($basis_value != 0 || $premium_value != 0) {
																		echo "Antal";	} else {
								echo "Packages";
								}
						?>
					</div>
					<div class="column sa">
						Kurv
					</div>
					<div class="column sa">
						Navn & adresse
					</div>
					<div class="column sa">
						Bekræft
					</div>
					<div class="column sa active">
						Betaling
					</div>
				</div>
				<form id="purchasePackage" action='<?php echo site_url(); ?>/purchase/success/' method="POST" accept-charset="UTF-8" data-parsley-validate autocomplete="off">
					<div class="row column purchasePackage-form">
						<?php if(!empty($tempErrorDeliveryMethod) || !empty($tempErrorBasketTotalcost) || !empty($tempErrorPurchase)) { ?>
						<div class="small-12 columns alert callout piError" data-closable>
							<?php
							echo '<h5>'. $tempErrorMessage . '</h5>';
							if (!empty($tempErrorDeliveryMethod)){
								foreach($tempErrorDeliveryMethod as $ErrorDeliveryMethod){ echo '<p>' . $ErrorDeliveryMethod . '</p>'; }
							}
							if (!empty($tempErrorBasketTotalcost)){
								foreach($tempErrorBasketTotalcost as $ErrorBasketTotalcost){ echo '<p>'. $ErrorBasketTotalcost . '</p>'; }
							}
							if (!empty($tempErrorPurchase)){
								foreach($tempErrorPurchase as $ErrorPurchase){ echo '<p>'. $ErrorPurchase . '</p>'; }
							}
							?>
							<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php } ?>
						<div class="small-12 medium-10 medium-centered large-9 large-centered">
							<div class="large-12 columns">
								<input type="hidden" name='basket_totalcost' value="<?php echo $basket_totalcost; ?>">
								<input type="hidden" name='delivery_method' value="<?php echo $deliveryMethod; ?>">
							</div>
							<div class="large-12 columns">
								<?php if (!empty($tempErrorLastname)){ ?>
								<input class="serverError" type="text" placeholder="<?php foreach($tempErrorLastname as $ErrorLastname){ echo "Lastname " . $ErrorLastname; }?>" name='cardHolderName' data-parsley-required-message="Indtast dit navn" data-parsley-length="[5, 200]" data-parsley-length-message="Indtast venligst hele dit kortholders navn" required>
								<?php } else { ?>
								<input type="text" placeholder="Kortholders navn" name='cardHolderName' data-parsley-required-message="Indtast dit navn" data-parsley-length="[5, 200]" data-parsley-length-message="Indtast venligst hele dit kortholders navn" required>
								<?php } ?>
							</div>
							<div class="large-12 columns">
								<select name='card_type' id="card_type" data-parsley-required-message="Vælg dit kort" required>
									<option value="default" disabled selected hidden>Betalingskort</option>
									<option value="VISA/Dankort" <?PHP if($card_type==1) echo "selected";?>>Visa/Dankort</option>
									<option value="Visa" <?PHP if($card_type==2) echo "selected";?>>Visa</option>
									<option value="MasterCard" <?PHP if($card_type==3) echo "selected";?>>MasterCard</option>
								</select>
							</div>
							<div class="large-12 columns">
								<?php if (!empty($tempErrorNumber)){ ?>
								<input class="serverError" type="text" placeholder="<?php foreach($tempErrorNumber as $ErrorNumber){ echo $ErrorNumber; } ?>" name='number' maxlength="16" data-parsley-maxlength="16" minlength="16" data-parsley-minlength="16" data-parsley-required-message="Indtast venligst 16 cifre" required>
								<?php } else { ?>
								<input type="text" placeholder="Kortnummer" name='number' data-parsley-type="digits" data-parsley-minlength="16" data-parsley-maxlength="16" maxlength="16" data-parsley-minlength-message="Indtast venligst 16 cifre"  data-parsley-required-message="Indtast venligst 16 cifre"  required>
								<?php } ?>
							</div>
							<div class="large-12 columns expire">
								<label>Udløbsdato:</label>
								<div class="row">
									<div class="small-4 medium-4 large-4 columns">
										<select name='month' id="month" required>
											<option value="default" disabled selected hidden>Måned</option>
											<option value="1"  <?PHP if($month==1) echo "selected";?>>01</option>
											<option value="2"  <?PHP if($month==2) echo "selected";?>>02</option>
											<option value="3"  <?PHP if($month==3) echo "selected";?>>03</option>
											<option value="4"  <?PHP if($month==4) echo "selected";?>>04</option>
											<option value="5"  <?PHP if($month==5) echo "selected";?>>05</option>
											<option value="6"  <?PHP if($month==6) echo "selected";?>>06</option>
											<option value="7"  <?PHP if($month==7) echo "selected";?>>07</option>
											<option value="8"  <?PHP if($month==8) echo "selected";?>>08</option>
											<option value="9"  <?PHP if($month==9) echo "selected";?>>09</option>
											<option value="10" <?PHP if($month==10) echo "selected";?>>10</option>
											<option value="11" <?PHP if($month==11) echo "selected";?>>11</option>
											<option value="12" <?PHP if($month==12) echo "selected";?>>12</option>
										</select>
									</div>
									<div class="small-4 medium-4 large-4 columns">
										<?php if (!empty($tempErrorYear)){ ?>
										<select class="serverError" name='expire' id="year" required>
											<option value="default" disabled selected hidden><?php foreach($tempErrorYear as $ErrorYear){ echo $ErrorYear; } ?></option>
											<?php } else { ?>
											<select name='expire' id="year" required>
												<option value="default" disabled selected hidden>År</option>
												<?php } ?>
												<?PHP
												$i = date("Y");
												while($i <= date("Y")+10){
												echo "<option value='$i'>$i</option>";
												$i++;
												}
												?>
											</select>
										</div>
										<div class="small-4 medium-4 large-4 columns">
											<input type="text" placeholder="Kontrolcifre" name='verification_value'  data-parsley-type="digits" data-parsley-length="[3, 3]" data-parsley-length-message="Indtast 3 cifre" data-parsley-required-message="Indtast 3 cifre" required>
										</div>
									</div>
								</div>
								<?php if ($basisNumber != 0 && $premiumNumber != 0) { ?>
								<div class="large-12 columns">
									<input type="hidden" name='membershipproductid[0]' value="<?php echo $basisID; ?>">
									<input type="hidden" name='quantity[0]' value="<?php echo $basisNumber; ?>">
									<input type="hidden" name='membershipproductid[1]' value="<?php echo $premiumID; ?>">
									<input type="hidden" name='quantity[1]' value="<?php echo $premiumNumber; ?>">
								</div>
								<?php
								}
								if ($bp == 10) {
								?>
								<div class="large-12 columns">
									<input type="hidden" name='membershipproductid[0]' value="<?php echo $basisID; ?>">
									<input type="hidden" name='quantity[0]' value="<?php echo $basisNumber; ?>">
								</div>
								<?php }
								if ($bp == 01)  { ?>
								<div class="large-12 columns">
									<input type="hidden" name='membershipproductid[0]' value="<?php echo $premiumID; ?>">
									<input type="hidden" name='quantity[0]' value="<?php echo $premiumNumber; ?>">
								</div>
								<?php } ?>
								<?php if ($flexValue != NUll) { ?>
								<div class="large-12 columns">
									<input type="hidden" name='membershipproductid[0]' value="<?php echo $flexID; ?>">
									<input type="hidden" name='quantity[0]' value="1">
								</div>
								<?php } ?>
								<div class="large-12 columns buyAccept">
									<input id="accept" type="checkbox" data-parsley-validate-if-empty data-parsley-success-class="t" data-parsley-required-message="Acceptér venligst for at fortsætte." required><label for="accept">Jeg accepterer <span class="acceptTC" data-open="purchaseConfirmation">betingelserne</span></label>
								</div>
								<div class="large-12 columns text-center calculatedButton">
									<input name="utf8" type="hidden" value="✓" />
									<input type="hidden" id="refresh" value="no">
									<input type="hidden" name='userip' value="<?php echo $userIP; ?>">
									<input type="submit" class="pConfirmButton button callSpin" value="GENNEMFØR KØB">
									<p class="lpss text-center">
										<a class="backTo callSpin" href="javascript:history.back()">Tilbage</a>
									</p>
								</div>
							</div>
						<div class="small-12 columns">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</article>
	<div class="large-12 columns">
		<?php $query = new WP_Query( array( 'page_id' => 225, 'post_status' => 'publish' , 'posts_per_page' => 1 ) ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class="reveal" id="purchaseConfirmation" aria-labelledby="exampleModalHeader11" data-reveal>
			<p class="overlayHeading"><?php the_title(); ?></p>
			<div class="small-12 FilmpakkenPopUp">
				<?php the_content(); ?>
				<button class="close-button" data-close aria-label="Close modal" type="button">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
		<?php endwhile;  wp_reset_postdata(); else : ?>
		<?php _e( 'Sorry, no posts matched your criteria.' ); ?>
		<?php endif; ?>
	</div>
<script type="text/javascript">
jQuery(function () {
	jQuery('form#purchasePackage').parsley().on('field:validated', function() {
		jQuery( "input.parsley-error" ).each(function() {
		var placeholder = jQuery(this).attr("data-parsley-required-message");
		jQuery(this).attr("placeholder", placeholder);
		});
	})
	jQuery("form#purchasePackage").on('submit', function(e){
    var form = jQuery(this);
    form.parsley().validate();
    if (form.parsley().isValid()){
      jQuery("input.pConfirmButton").prop('disabled', true);
    }
  });
});

var d = new Date();
var n = d.getMonth() + 1;
var y = d.getFullYear();
/* jQuery("select#month").on('change', function() {
		var selectedM = jQuery("select#month").val();
		if (selectedM <= n ){
			jQuery('select#year option[value="'+ y +'"]').remove();
		} else{
			if (jQuery('select#year option[value="'+ y +'"]').length == 0 ){
				jQuery("select#year").prepend('<option value="2016">2016</option>');
			}
		}
});*/

jQuery("select#month, select#year").on('change', function() {
		var selectedM = jQuery("select#month").val();
		var selectedY = jQuery("select#year").val();

		if (selectedY == y && selectedM <= n ){
			jQuery("select#month").addClass("parsley-error");
			jQuery("select#year").addClass("parsley-error");
		} else{
			jQuery("select#month").removeClass("parsley-error");
			jQuery("select#year").removeClass("parsley-error");
		}
});

jQuery(document).ready(function(e) {
  //jQuery('#refresh').val() == 'yes' ? location.reload(true) : jQuery('#refresh').val('yes');
  var siteUrl = '<?php echo site_url() ;?>';
  jQuery('#refresh').val() == 'yes' ? window.location.replace(siteUrl + "/purchase/") : jQuery('#refresh').val('yes');

});
</script>