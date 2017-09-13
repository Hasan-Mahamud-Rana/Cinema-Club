<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){

	if( isset($_POST['flexNumber']) )	{
	  $flexValue =  $_POST['flexNumber'];
	}
	$basisValue =  $_POST['basisNumber'];
	$premiumValue =  $_POST['premiumNumber'];

	if( isset($_POST['price1']) )	{
	  $flexPrice1 =  $_POST['price1'];
	}
	if( isset($_POST['price2']) )	{
	  $flexPrice2=  $_POST['price2'];
	}

	if( isset($_POST['flexID1']) )	{
	  $flexID1=  $_POST['flexID1'];
	}
	if( isset($_POST['flexID2']) )	{
	  $flexID2=  $_POST['flexID2'];
	}

	$basisID =  $_POST['basisID'];
	$basisPrice =  $_POST['basisPrice'];

	$premiumID =  $_POST['premiumID'];
	$premiumPrice =  $_POST['premiumPrice'];

}

if (isset($_COOKIE['basketFlexNumber'])){
	$flexValue =  $_COOKIE['basketFlexNumber'];
}
if (isset($_COOKIE['basketBasisNumber'])){
	$basisValue =  $_COOKIE['basketBasisNumber'];
}
if (isset($_COOKIE['basketPremiumNumber'])){
	$premiumValue =  $_COOKIE['basketPremiumNumber'];
}
if (isset($_COOKIE['basketBasisID'])){
		$basisID =  $_COOKIE['basketBasisID'];
}
if (isset($_COOKIE['basketBasisPrice'])){
		$basisPrice =  $_COOKIE['basketBasisPrice'];
}
if (isset($_COOKIE['basketPremiumID'])){
		$premiumID =  $_COOKIE['basketPremiumID'];
}
if (isset($_COOKIE['basketPremiumPrice'])){
		$premiumPrice =  $_COOKIE['basketPremiumPrice'];
}
if (isset($_COOKIE['basketFlexID1'])){
		$flexID1 =  $_COOKIE['basketFlexID1'];
}
if (isset($_COOKIE['basketFlexID2'])){
		$flexID2 =  $_COOKIE['basketFlexID2'];
}
if (isset($_COOKIE['basketFlexPrice1'])){
		$flexPrice1 =  $_COOKIE['basketFlexPrice1'];
}
if (isset($_COOKIE['basketFlexPrice2'])){
		$flexPrice2 =  $_COOKIE['basketFlexPrice2'];
		//echo 'flexPrice2' . $flexPrice2;
}

if ($flexValue == "Flex1"){
	$flexID =  $flexID1;
	$price = $flexPrice1 / 100;
} elseif ($flexValue == "Flex2"){
	$flexID =  $flexID2;
	$price = $flexPrice2 / 100;
}
if ($flexValue != NUll) {
	$flexCartValue = update_flex_basket($flexValue, $flexID, $flexID1, $flexID2, $price, $flexPrice1, $flexPrice2);
	//$flexCartValue = update_flex_basket($flexValue, $flexID, $price);
}
if ($basisValue != 0 || $premiumValue != 0) {
	$cartValue = update_basket($basisValue, $basisID, $basisPrice, $premiumValue, $premiumID, $premiumPrice);
}
$basisTotal = $basisValue * $basisPrice;
$premiumTotal = $premiumValue * $premiumPrice;
$grandTotal = ($basisTotal + $premiumTotal + ($price* 100)) / 100;
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
	<div class="createProfile-panel basketBlock">
		<div class="row">
			<div class="medium-11 medium-centered large-9 large-centered createProfile-form-panel">
				<div class="row purchaseStep small-up-1 medium-up-5 large-up-5 columns">
					<div class="column">
						<?php
							if ($flexValue != NUll) {
							echo "MEDLEMSKAB";
							}	elseif ($basisValue != 0 || $premiumValue != 0) {
								echo "Antal";	} else {
							echo "Packages";
							}
						?>
					</div>
					<div class="column sa active">
						Kurv
					</div>
					<div class="column si">
						Navn & adresse
					</div>
					<div class="column sa">
						Bekræft
					</div>
					<div class="column sa">
						Betaling
					</div>
				</div>
				<form action='<?php echo site_url(); ?>/purchase/name-address' method="POST">
					<div class="row column purchasePackage-form">
						<div class="small-12 medium-10 medium-centered large-9 large-centered columns removePackage">
							<?php if ($flexValue != NUll) { ?>
							<div class="large-12 text-center flexCalulation amIHere">
								<div class="row small-up-2 medium-up-2 large-up-2 columns">
									<div class="column text-left">
										<h4><?php echo $flexValue; ?><span class="deletePackage fDp" aria-hidden="true"></span></h4>
										<p><span class="flexSpanValue">1</span> stk. á <span class="flexUnitPrice"><?php echo $price; ?></span> kr.</p>
									</div>
									<div class="column text-right">
										<p class="fTotal"><span class="flexTotal"><?php echo $price; ?></span> kr.</p>
									</div>
								</div>
							</div>
							<?php } ?>
							<?php if ($basisValue != 0) { ?>
							<div class="large-12 text-center basisCalulation amIHere">
								<div class="row small-up-2 medium-up-2 large-up-2">
									<div class="column text-left">
										<h1>Basis <span class="deletePackage" aria-hidden="true"></span></h1>
										<p><span class="basisSpanValue"><?php echo $basisValue; ?></span> stk. á <span class="basisUnitPrice"><?php echo $basisPrice / 100; ?></span> kr.</p>
									</div>
									<div class="column text-right">
										<div class="row">
											<div class="small-6 columns">
												<input class="basisInputValue" type="number" value="<?php echo $basisValue; ?>" min="0" max="99" name='basisNumber'>
												<input type="hidden" name='basisID' value="<?php echo $basisID; ?>" />
												<input type="hidden" name='basisPrice' value="<?php echo $basisPrice; ?>" />
											</div>
											<div class="small-6 columns"><p class="bTotal"><span class="basisTotal"><?php echo $basisTotal / 100; ?></span> kr.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						<?php if ($premiumValue != 0) { ?>
						<div class="large-12 text-center premiumCalulation amIHere">
							<div class="row  small-up-2 medium-up-2 large-up-2">
								<div class="column text-left">
									<h1>Premium <span class="deletePackage" aria-hidden="true"></span></h1>
									<p><span class="premiumSpanValue"><?php echo $premiumValue; ?></span> stk. á <span class="premiumUnitPrice"><?php echo $premiumPrice / 100; ?></span> kr.</p>
								</div>
								<div class="column text-right">
									<div class="row">
										<div class="small-6 columns">
											<input class="premiumInputValue" type="number" value="<?php echo $premiumValue; ?>" min="0" max="99" name='premiumNumber'>
											<input type="hidden" name='premiumID' value="<?php echo $premiumID; ?>" />
											<input type="hidden" name='premiumPrice' value="<?php echo $premiumPrice; ?>" />
										</div>
										<div class="small-6 columns"><p class="pTotal"><span class="premiumTotal"><?php echo $premiumTotal / 100; ?></span> kr.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<div class="large-12 premiumCalulation text-right">
						<hr class="single">
						<p class="calculatedPrice">Pris i alt: <span class="grandTotal"><?php echo $grandTotal; ?></span> kr.</p>
						<hr class="bolder">
					</div>
					<?php if ($flexValue != NUll) { ?>
					<div class="large-12 columns text-center">
						<input type="submit" class="calculatedButton button callSpin" value="NÆSTE">
						<p class="lpss text-center"><a class="backTo callSpin" href="<?php echo site_url(); ?>/purchase/flex/">Tilbage</a></p>
					</div>
					<?php } ?>
					<?php if ($basisValue != 0 || $premiumValue != 0) { ?>
					<div class="large-12 columns text-center">
						<a class="calculatedButton button" data-open="confirmation">NÆSTE</a>
						<p class="lpss text-center"><a class="backTo callSpin" href="<?php echo site_url(); ?>/purchase/basic/">Tilbage</a></p>
						<div class="reveal" id="confirmation" data-reveal>
							<p class="overlayHeading">Vil du købe flere medlemskaber, inden du går til betaling?</p>
							<p class="overlayText">Husk at du kan købe flere forskellige typer medlemskaber samtidig. Du kan også købe ekstra medlemskaber på et senere tidspunkt.</p>
							<p class="text-center ovrLayBtn"><input type="submit" class="button callSpin" value="GÅ TIL BETALING"></p>
							<p class="text-center ovrLayBtn"><a class="secondary button callSpin" href="javascript:history.back()">Køb flere medlemskaber</a></p>
							<button class="close-button" data-close aria-label="Close modal" type="button">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</form>
	</div>
</div>
</div>
</article>
<span class="packageRemoved" data-open="packageRemoved"></span>
<div class="full reveal packageRemoved" id="packageRemoved" data-reveal data-close-on-click="false" data-close-on-esc="false">
<div class="text-center" style="margin-top: 35vh;">
	<h1 class="text-center">Indkøbskurven er tom</h1>
	<h2>Du har ikke lagt nogle medlemskaber i indkøbskurven.</h2>
	<form action="<?php echo site_url(); ?>/purchase/success/" method="POST">
       <input type="hidden" name="resetCart" value="1" />
       <input class="button calculatedButton" type="submit" value="KØB MEDLEMSKAB">
       </form>
	</div>
</div>

<script type="text/javascript">
	jQuery("input.basisInputValue").on("change",  function() {
	calculateBasis();
	});
	function calculateBasis (){
	var basisInputValue = jQuery("input.basisInputValue").val();
	jQuery("span.basisSpanValue").html(basisInputValue);
	var basisUnitPrice = jQuery("span.basisUnitPrice").html();
	var totalBasisPrice = basisInputValue * basisUnitPrice;
	jQuery("span.basisTotal").html(totalBasisPrice);
	calculateGrandTotal ();
	}
	jQuery("input.premiumInputValue").on("change",  function() {
	calculatePremium();
	});
	function calculatePremium (){
	var premiumInputValue = jQuery("input.premiumInputValue").val();
	jQuery("span.premiumSpanValue").html(premiumInputValue);
	var premiumUnitPrice = jQuery("span.premiumUnitPrice").html();
	var totalPremiumPrice = premiumInputValue * premiumUnitPrice;
	jQuery("span.premiumTotal").html(totalPremiumPrice);
	calculateGrandTotal ();
	}
	function calculateGrandTotal (){
	var basisTotal = parseInt(jQuery("span.basisTotal").html());
if(isNaN(basisTotal)) {
var basisTotal = 0;
}
	var premiumTotal = parseInt(jQuery("span.premiumTotal").html());
if(isNaN(premiumTotal)) {
var premiumTotal = 0;
}
	var grandTotal = basisTotal + premiumTotal;
	jQuery("span.grandTotal").html(grandTotal);
	}

jQuery("span.deletePackage").click(function() {
  jQuery(this).parent().parent().parent().parent().remove();
  amIHere ();
  calculateGrandTotal ();
});

function amIHere (){
	if (!jQuery("div.removePackage").children().hasClass("amIHere")) {
		jQuery("span.packageRemoved").click();
	}
}
</script>