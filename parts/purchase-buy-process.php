<?php
if ( is_bkdk_user_logged_in() != true ) {
	wp_redirect(site_url().'/login/');
}
$flexValue =  $_COOKIE['basketFlexNumber'];
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
	$basket_totalcost = $_POST['basket_totalcost']; #integer
	$delivery_method = $_POST['delivery_method'];
	$cardHolderName = $_POST['cardHolderName'];
	$number = $_POST['number'];
	$month = $_POST['month'];
	$year = $_POST['expire'];
	$verification_value = $_POST['verification_value'];
	$card_type = $_POST['card_type'];
	$userIP = $_POST['userip'];
	$membershipproductid = $_POST['membershipproductid']; #
	$quantity = $_POST['quantity'];
}
$customerid = get_customerid();
$payment = call_for_payment($customerid);
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
{
$resetCart =  $_POST['resetCart'];
if ($resetCart == 1){
	reset_basket_from_cartBar();
}
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
	<div class="createProfile-panel buyConfirmation">
		<div class="row">
			<div class="medium-11 medium-centered large-9 large-centered createProfile-form-panel columns">
				<div class="row purchasePackage-form">
					<?php if ($payment != true) { ?>
					<div class="large-12">
						<header class="article-header pPayment">
							<p class="page-title">Some thing Went Wrong</p>
						</header>
					</div>
					<?php }  ?>
					<?php if ($payment == true) {
						if (empty($flexValue)) {
							header("Location: ".site_url()."/purchase/congratulations/");
						} else  {
							header("Location: ".site_url()."/purchase/congratulation/");
						}
					} ?>
				</div>
			</div>
		</div>
	</div>
</article>