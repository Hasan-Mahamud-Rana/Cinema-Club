<?php
if ( is_bkdk_user_logged_in() != true ) {
wp_redirect(site_url().'/login/');
}
$customerid = get_customerid();
$userDetails = get_user_info($customerid);
$firstname = $userDetails->firstname;
$lastname = $userDetails->lastname;
//var_dump($userDetails);
$myMemberships = get_my_memberships($customerid);
	foreach($myMemberships as $myMembership)
	{
		$membershipproductid = $myMembership->membershipproductid;
		$membershipProductTypeName = $myMembership->membership_product_type_name;

		if ($membershipProductTypeName == "FlexPackage"){
			$flexAvailable = 1;
		}
		if ($membershipProductTypeName == "BasePackage"){
			$basisAvailable = 1;
		}
		if ($membershipProductTypeName == "BaseAndOptionalPackage"){
			$premiumAvailable = 1;
		}
	}

$findReplace = findReplace();
$findDate = $findReplace[0];
$replaceDate = $findReplace[1];
 ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
	<div class="purchasePanel membershipOverview">
		<div class="row">
			<header class="article-header">
				<h3 class="page-title"><?php echo $firstname .' '. $lastname ?></h3>
			</header>
			<section class="entry-content" itemprop="articleBody">
				<?php
					if(!empty($myMemberships)){
						the_content();
					} else {
						the_excerpt();
					}
				?>
			</section>
		</div>
		<?php if(!empty($myMemberships)) { ?>
		<div class="row membership-packages small-up-1 medium-up-3 large-up-3" style="display:none;">
		<?php
			if (!empty($premiumAvailable)){
			echo '<div class="column"><div><div class="membershipData"><h3>Premium</h3><div class="bpItem">';
				foreach($myMemberships as $myMembership)
				{
					$membershipproductid = $myMembership->membershipproductid;
					$membershipProductTypeName = $myMembership->membership_product_type_name;
						if ($membershipProductTypeName == "BaseAndOptionalPackage"){
						$totalQuantity = $myMembership->total_quantity;
						$active = $myMembership->active;
						$season_description =  $myMembership->season_description;
								echo '<p class="mP">Du har:</p>';
								echo '<p class="mPp">' . $totalQuantity . ' Premium-medlemskaber,</p>';
								echo '<p>gælder i ' . $season_description . '.</p><hr>';
						}
				}
			echo '</div></div></div></div>';
		}
			?>
			<?php
			if (!empty($basisAvailable)){
			echo '<div class="column" ><div><div class="membershipData"><h3>Basis</h3><div class="bpItem">';
				foreach($myMemberships as $myMembership)
				{
					$membershipproductid = $myMembership->membershipproductid;
					$membershipProductTypeName = $myMembership->membership_product_type_name;

						if ($membershipProductTypeName == "BasePackage"){
						$totalQuantity = $myMembership->total_quantity;
						$active = $myMembership->active;
						$season_description =  $myMembership->season_description;
								echo '<p class="mP">Du har:</p>';
								echo '<p class="mPp">' . $totalQuantity . ' Basis-medlemskaber,</p>';
								echo '<p>gælder i ' . $season_description . '.</p><hr>';
						}
				}
			echo '</div></div></div></div>';
		}
			?>
			<?php
			if (!empty($flexAvailable)){
			echo '<div class="column" ><div><div class="membershipData"><h3>Flex</h3><div>';
				foreach($myMemberships as $myMembership)
				{
						$membershipproductid = $myMembership->membershipproductid;
						$membershipProductTypeName = $myMembership->membership_product_type_name;

							if ($membershipProductTypeName == "FlexPackage"){
									$subscriptionStatus = $myMembership->subscription_status;
									$active = $myMembership->active;
									$skipped = $myMembership->skipped;
									$skipNext = $myMembership->skip_next;
									$productName = $myMembership->product_name;
									$membershipproductid = $myMembership->membershipproductid;
									$totalQuantity = $myMembership->total_quantity;
									$membershiporderlineid = $myMembership->membershiporderlineid;
									$nextPurchaseDate = $myMembership->next_purchase_date;
									//var_dump($nextPurchaseDate);
									$nextPurchaseDate = date_create($nextPurchaseDate);
									$date = new DateTime(date_format($nextPurchaseDate, "d. F Y") );
									//$date->add(new DateInterval('P1D'));
										if(($active == true && $skipNext == false) || ($skipped == true && $skipNext == false)){
												echo '<p class="mP">Du har et Flex-medlemskab</p>';
												echo '<form action="'. get_permalink(). 'flex" method="POST">';
														//echo '<p class="mPp">et Flex-medlemskab</p>';
														echo '<p class="dkDate">Vi trækker betaling for den næste filmpakke d. ' . str_replace( $findDate, $replaceDate, $date->format("d. F Y")) . '.</p>';
														echo '<input type="hidden" name="membershiporderlineid" value="' .$membershiporderlineid . '" />';
																echo	'<p class="text-center"><input type="submit" class="button callSpin" value="Redigér medlemskab" style="padding: 10px 15px;"></p><hr>';
												echo '</form>';
										} elseif($active == true && $skipNext == true){
												echo '<p class="mP">Du har et Flex-medlemskab</p>';
												echo '<form action="'. get_permalink(). 'flex-skipped" method="POST">';
														//echo '<p class="mPp">et Flex-medlemskab</p>';
														echo '<p class="dkDate">Du har valgt at springe den næste filmpakke over. Derfor modtager du ikke de næste tre kuponer.<br/>Vi trækker betaling for den næste filmpakke d. ' . str_replace( $findDate, $replaceDate, $date->format("d. F Y")) . '.</p>';
														echo '<input type="hidden" name="membershiporderlineid" value="' .$membershiporderlineid . '" />';
																echo	'<p class="text-center"><input type="submit" class="button callSpin" value="Redigér medlemskab" style="padding: 10px 15px;"></p><hr>';
												echo '</form>';
										} else {
												echo '<p class="mPp">Opsagt dit ' .$productName. ' medlemskab.</p>';
												echo '<p>Hvis du fortryder, kan du købe et nyt ved at gå til Køb medlemskab.</p><hr>';
										}
							}
				}
			echo '</div></div></div></div>';
		}
			?>

		</div>
		<?php } else { ?>
		<div class="row">
			<div class="small-12 medium-8 medium-centered large-8 large-centered columns">
				<p>Tegn abonnement på Biografklub Danmark og se udvalgte kvalitetsfilm til halv pris.</p>
				<p class="text-center calculatedButton"><a class="button" href="<?php echo site_url(); ?>/purchase/">KØB MEDLEMSKAB</a></p></div>
		</div>
		<?php } ?>
	</div>
</article>