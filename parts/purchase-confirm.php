<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$address = $_POST['address'];
	$postnumber = $_POST['postnumber'];
	$by = $_POST['postdistrict'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];
	$password_confirmation = $_POST['password_confirmation'];
	$receivegeneralnewsletter = $_POST['receivegeneralnewsletter'];
	$currentlink = $_POST['currentlink'];
	$flexBasket = $_POST['flexBasket'];
}

$customerid = get_customerid();
if (empty($customerid) || $customerid == NULL || $customerid == ' ' ) {
	call_for_create_profile();
	store_user_public_information($firstname, $lastname, $address, $postnumber, $by, $email, $phone, $password, $password_confirmation);
}
else {
 cfc_update_profile($customerid);
}

$basisNumber =  $_COOKIE['basketBasisNumber'];
$basis_value = $basisNumber;
$basisPrice = $_COOKIE['basketBasisPrice'];
$basisTotal = $basis_value * $basisPrice;

$premiumNumber =  $_COOKIE['basketPremiumNumber'];
$premium_value = $premiumNumber;
$premiumPrice = $_COOKIE['basketPremiumPrice'];
$premiumTotal = $premium_value * $premiumPrice;

$cart = $basis_value + $premium_value;

$flexValue =  $_COOKIE['basketFlexNumber'];
$flexPrice =  $_COOKIE['basketFlexPrice'];


if ($flexValue != NUll) {
	$deliveryMethod = "digital";
	//echo "digital";
	$deliveryMethodValue = update_deliveryMethod($deliveryMethod);
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
{
	$deliveryMethod =  $_POST['delivery_method'];
	if ($basis_value != 0 || $premium_value != 0)  {
		//echo "delivery_method called";
		$deliveryMethodValue = update_deliveryMethod($deliveryMethod);
	}
}

$grandTotal = ($basisTotal + $premiumTotal + ($flexPrice * 100 )) / 100;

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
						echo "Antal";
					} else {
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
					<div class="column sa active">
						Bekræft
					</div>
					<div class="column si">
						Betaling
					</div>
				</div>
				<form action='<?php echo site_url(); ?>/purchase/buy' method="POST">
					<div class="row column purchasePackage-form">
						<div class="small-12 medium-10 medium-centered large-9 large-centered columns">
						<?php if ($flexValue != NUll) { ?>
						<div class="large-12 text-center flexCalulation">
							<div class="row  small-up-2 medium-up-2 large-up-2">
								<div class="column text-left">
									<h1><?php echo $flexValue; ?></h1>
									<p><span class="flexSpanValue">1</span> stk. á <span class="flexUnitPrice"><?php echo $flexPrice; ?></span> kr.</p>
								</div>

								<div class="column text-right">
									<p class="fTotal"><span class="flexTotal"><?php echo $flexPrice; ?></span> kr.</p>
								</div>
							</div>
						</div>
						<?php } ?><?php if ($basis_value != 0) { ?>
							<div class="large-12 text-center basisCalulation">
								<div class="row small-up-2 medium-up-2 large-up-2">
									<div class="column text-left">
										<h1>Basis</h1>
										<p><span class="basisSpanValue"><?php echo $basis_value; ?></span> stk. á <span class="basisUnitPrice"><?php echo $basisPrice / 100; ?></span> kr.</p>
									</div>
									<div class="column text-right">
										<p class="bTotal"><span class="basisTotal"><?php echo $basisTotal / 100; ?></span> kr.</p>
									</div>
								</div>
							</div>
							<?php } ?>
							<?php if ($premium_value != 0) { ?>
							<div class="large-12 text-center premiumCalulation">
								<div class="row  small-up-2 medium-up-2 large-up-2">
									<div class="column text-left">
										<h1>Premium</h1>
										<p><span class="premiumSpanValue"><?php echo $premium_value; ?></span> stk. á <span class="premiumUnitPrice"><?php echo $premiumPrice / 100; ?></span> kr.</p>
									</div>
									<div class="column text-right">
										<p class="pTotal"><span class="premiumTotal"><?php echo $premiumTotal / 100; ?></span> kr.</p>
									</div>
								</div>
							</div>
							<?php } ?>
							<div class="large-12 premiumCalulation text-right">
							<hr class="single">
								<p class="calculatedPrice">Pris i alt: <span class="grandTotal"><?php echo $grandTotal; ?></span><span class="grandTotalCurrency"> kr.</span></p>
							<hr class="bolder">
							</div>
							<div class="large-12 premiumCalulation text-left">
							<?php
							echo '<p>'. $firstname.' '.$lastname . '<br/>';
							echo $address. '<br/>';
							echo $postnumber.' '.$by . '</p>';

							echo '<p>E-mail: '. $email . '<br/>';
							if(!empty($phone)){
								echo 'Mobiltelefon nr.: '. $phone. '</p>';
							}
							?>
							</div>
								<div class="large-12 columns text-center calculatedButton">
								<input type="submit" class="button callSpin" value="NÆSTE">
								<p class="lpss text-center"><a class="backTo callSpin" href="javascript:history.back()">Tilbage</a></p>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</article>