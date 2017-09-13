<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
{
$basisValue =  $_POST['basisNumber'];
$basisID=  $_POST['basisID'];
$basisPrice =  $_POST['basisPrice'];
$premiumValue =  $_POST['premiumNumber'];
$premiumID =  $_POST['premiumID'];
$premiumPrice =  $_POST['premiumPrice'];
$cartValue = update_basket($basisValue, $basisID, $basisPrice, $premiumValue, $premiumID, $premiumPrice);
}
$current_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$customerid = get_customerid();
$userDetails = get_user_info($customerid);
$membership_product_id = $_COOKIE['basketFlexID'];
$membershipProduct = get_membership_product($membership_product_id);

$flexErrorOccurred = $_COOKIE['flexErrorTrue'];
reset_flexErrorOccurred();

$firstname = $userDetails->firstname;
$lastname = $userDetails->lastname;
$address = $userDetails->address;
$postnumber = $userDetails->postnumber;
$postdistrict = $userDetails->postdistrict;
$email = $userDetails->email;
$phone= $userDetails->phone;
$receivegeneralnewsletter = $userDetails->receivegeneralnewsletter;
$flexValue =  $_COOKIE['basketFlexNumber'];
$basisNumber =  $_COOKIE['basketBasisNumber'];
$premiumNumber =  $_COOKIE['basketPremiumNumber'];
$tempFirstname = $_COOKIE['formFirstname'];
$tempLastname = $_COOKIE['formLastname'];
$tempAddress = $_COOKIE['formAddress'];
$tempPostnumber = $_COOKIE['formPostnumber'];
$tempBy = $_COOKIE['formBy'];
$tempPassword = $_COOKIE['formPassword'];
$tempPassword_confirmation = $_COOKIE['formPassword_confirmation'];
$tempErrorMessage = $_COOKIE['formErrorMessage'];
$tempErrorFirstname = $_COOKIE['formErrorFirstname'];
$tempErrorFirstname = stripslashes($tempErrorFirstname);
$tempErrorFirstname = json_decode($tempErrorFirstname, true);
$tempErrorLastname = $_COOKIE['formErrorLastname'];
$tempErrorLastname = stripslashes($tempErrorLastname);
$tempErrorLastname = json_decode($tempErrorLastname, true);
$tempErrorPostnumber = $_COOKIE['formErrorPostnumber'];
$tempErrorPostnumber = stripslashes($tempErrorPostnumber);
$tempErrorPostnumber = json_decode($tempErrorPostnumber, true);
$tempErrorPostdistrict = $_COOKIE['formErrorPostdistrict'];
$tempErrorPostdistrict = stripslashes($tempErrorPostdistrict);
$tempErrorPostdistrict = json_decode($tempErrorPostdistrict, true);
$tempErrorPhone = $_COOKIE['formErrorPhone'];
$tempErrorPhone = stripslashes($tempErrorPhone);
$tempErrorPhone = json_decode($tempErrorPhone, true);
$tempErrorEmail = $_COOKIE['formErrorEmail'];
$tempErrorEmail = stripslashes($tempErrorEmail);
$tempErrorEmail = json_decode($tempErrorEmail, true);
$tempErrorPassword = $_COOKIE['formErrorPassword'];
$tempErrorPassword = stripslashes($tempErrorPassword);
$tempErrorPassword = json_decode($tempErrorPassword, true);
$tempErrorPasswordConfirmation = $_COOKIE['formErrorPasswordConfirmation'];
$tempErrorPasswordConfirmation = stripslashes($tempErrorPasswordConfirmation);
$tempErrorPasswordConfirmation = json_decode($tempErrorPasswordConfirmation, true);
$tempErrorEncryptedPassword = $_COOKIE['formErrorEncryptedPassword'];
$tempErrorEncryptedPassword = stripslashes($tempErrorEncryptedPassword);
$tempErrorEncryptedPassword = json_decode($tempErrorEncryptedPassword, true);
reset_public_information();
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
	<div class="createProfile-panel naBlock">
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
					<div class="column sa">
						Kurv
					</div>
					<div class="column sa active">
						Navn & adresse
					</div>
					<div class="column si">
						Bekræft
					</div>
					<div class="column sa">
						Betaling
					</div>
				</div>
				<form id="na" action='<?php echo site_url(); ?>/purchase/confirm' method="POST" method="POST" accept-charset="UTF-8" data-parsley-validate data-parsley-focus="none">
					<div class="row column createProfile-form">
						<?php if(!empty($customerid)){
						if (!empty($tempErrorPhone) || !empty($tempErrorEmail)){ ?>
						<div class="alert callout piError" data-closable>
							<?php
							echo '<h5>'. $tempErrorMessage . '</h5>';
							if(!empty($tempErrorEmail)) {
							foreach($tempErrorEmail as $ErrorEmail){ echo $ErrorEmail . ' ';}
							}
							if(!empty($tempErrorPhone)) {
							foreach($tempErrorPhone as $ErrorPhone){ echo "<p>Telefonnummer: " . $ErrorPhone . '</p>'; }
							}
							reset_public_information();
							?>
							<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php } }?>
						<div class="row">
							<div class="small-12 medium-10 medium-centered large-9 large-centered columns">
								<div class="large-12 columns text-center">
									<?php the_excerpt(); ?>
								</div>
								<div class="large-12 columns">
									<?php if (!empty($tempErrorFirstname)){ ?>
									<input class="serverError" type="text" placeholder="<?php foreach($tempErrorFirstname as $ErrorFirstname){ echo $ErrorFirstname; }?>" name='firstname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit fornavn" data-parsley-required-message="Indtast dit fornavn" required>
									<?php } else { ?>
									<input  type="text" placeholder="Fornavn" name='firstname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit fornavn" data-parsley-required-message="Indtast dit fornavn" value="<?php if (!empty($tempFirstname)){ echo $tempFirstname; } else { echo $firstname; } ?>" required>
									<?php } ?>
								</div>
								<div class="large-12 columns">
									<?php if (!empty($tempErrorLastname)){ ?>
									<input class="serverError" type="text" placeholder="<?php foreach($tempErrorLastname as $ErrorLastname){ echo $ErrorLastname; }?>" name='lastname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit efternavn" data-parsley-required-message="Indtast dit efternavn" required>
									<?php } else { ?>
									<input type="text" placeholder="Efternavn" name='lastname' data-parsley-minlength="2" data-parsley-maxlength="20" data-parsley-minlength-message="Indtast venligst hele dit efternavn" data-parsley-required-message="Indtast dit efternavn" value="<?php if (!empty($tempLastname)){ echo $tempLastname; } else { echo $lastname; } ?>" required>
									<?php } ?>
								</div>
								<div class="large-12 columns">
									<input type="text" placeholder="Adresse" name='address' data-parsley-minlength="2" data-parsley-minlength-message="Indtast venligst din adresse"  data-parsley-required-message="Indtast din adresse" value="<?php if (!empty($tempAddress)){ echo $tempAddress; } else { echo $address; } ?>" required>
								</div>
								<div class="large-4 columns">
									<?php if (!empty($tempErrorPostnumber)){ ?>
									<input class="serverError" type="text" placeholder="<?php foreach($tempErrorPostnumber as $ErrorPostnumber){ echo $ErrorPostnumber; }?>" name='postnumber' data-parsley-required-message="Indtast et gyldigt postnummer" required>
									<?php } else { ?>
									<input type="text" placeholder="Postnr." name='postnumber' data-parsley-required-message="Indtast et gyldigt postnummer" value="<?php if (!empty($tempPostnumber)){ echo $tempPostnumber; } else { echo $postnumber; } ?>" required>
									<?php } ?>
								</div>
								<div class="large-8 columns">
									<?php if (!empty($tempErrorPostdistrict)){ ?>
									<input class="serverError" type="text" placeholder="<?php foreach($tempErrorPostdistrict as $ErrorPostdistrict){ echo $ErrorPostdistrict; }?>" name='postdistrict' data-parsley-required-message="Indtast by" required>
									<?php } else { ?>
									<input type="text" placeholder="By" name='postdistrict' data-parsley-required-message="Indtast by" value="<?php if (!empty($tempBy)){ echo $tempBy; } else { echo $postdistrict; } ?>" required>
									<?php } ?>
								</div>
								<div class="large-12 columns">
									<?php if (!empty($customerid)){ ?>
									<input class="<?php if (!empty($tempErrorEmail)){ echo "serverError"; }?>" type="text" placeholder="<?php	if(!empty($tempErrorEmail)){foreach($tempErrorEmail as $ErrorEmail){ echo $ErrorEmail . ' ';}} else {echo "Email";}?>"	name='email' data-parsley-type="email" data-parsley-required-message="Indtast gyldig emailadresse" value="<?php echo $email; ?>" required>
									<?php } else { ?>
									<input class="t<?php if (!empty($tempErrorEmail)){ echo "serverError"; }?>" type="text" placeholder="Email" name='email' data-parsley-type="email" data-parsley-required-message="Indtast gyldig emailadresse" value="<?php echo $email; ?>" required>
									<?php } ?>
								</div>
								<div class="large-12 columns">
									<?php if (!empty($customerid)){ ?>
									<input class="<?php if (!empty($tempErrorPhone)){ echo "serverError"; }?>" type="text" placeholder="<?php	if(!empty($tempErrorPhone)){foreach($tempErrorPhone as $ErrorPhone){ echo $ErrorPhone;}}else {echo "Mobilnummer (ikke påkrævet)";}?>" name='phone' maxlength="8" data-parsley-maxlength="8" data-parsley-required-message="Indtast gyldig telefonnummer" data-parsley-type="digits" value="<?php echo $phone; ?>" >
									<?php } else { ?>
									<input class="<?php if (!empty($tempErrorPhone)){ echo "serverError"; }?>" type="text" placeholder="Mobilnummer (ikke påkrævet)" name='phone' maxlength="8" data-parsley-maxlength="8" data-parsley-required-message="Indtast gyldig telefonnummer" data-parsley-type="digits" value="<?php echo $phone; ?>" >
									<?php } ?>
								</div>
								<?php if ( is_bkdk_user_logged_in() != true ) { ?>
								<div class="large-12 columns">
									<input type="password" placeholder="Angiv en adgangskode (mindst 6 tegn)" name='password' minlength="6" id="password" data-parsley-required-message="Kodeord skal bestå af mindst 6 cifre" value="<?php if (!empty($tempPassword)){ echo $tempPassword; } ?>" required>
								</div>
								<div class="large-12 columns">
									<input type="password" placeholder="Gentag adgangskode" name='password_confirmation' minlength="6" data-parsley-equalto="#password" data-parsley-required-message="Kodeord og bekræft kodeord er ikke ens" value="<?php if (!empty($tempPassword_confirmation)){ echo $tempPassword_confirmation; } ?>" required>
								</div>
								<?php }  ?>
								<?php if ( $receivegeneralnewsletter != true ) { ?>
								<div class="large-12 columns calculatedButton">
									<input id="receivegeneralnewsletter" type="checkbox" name='receivegeneralnewsletter'><label for="receivegeneralnewsletter">Ja tak til e-mails fra Biografklub Danmark med nyt om forpremierer til halv pris, konkurrencer samt nyheder om biografklubbens film</label>
								</div>
								<?php } else { ?>
								<div class="large-12 columns" style="display: none;">
									<input id="receivegeneralnewsletter" type="checkbox" name='receivegeneralnewsletter' checked>
								</div>
								<?php } ?>
								<?php if ( is_bkdk_user_logged_in() != true ) { ?>
								<div class="large-12 columns accpetCheck">
									<input id="accept" type="checkbox" data-parsley-validate-if-empty data-parsley-success-class="t" data-parsley-required-message="Acceptér venligst for at fortsætte." required><label for="accept">Jeg accepterer <span class="acceptTC" data-open="profileConfirmation">betingelserne</span></label>
								</div>
								<?php } ?>
								<?php if ($basisNumber != 0 || $premiumNumber != 0) { ?>
								<div class="large-12 columns text-center calculatedButton">
									<p class="tooltipText">Hvordan skal kuponerne sendes? <span data-tooltip aria-haspopup="true" class="has-tip top iImage" data-disable-hover="false" tabindex="2" title="Du kan vælge at modtage dine kuponer fysisk eller digitalt. Digitale kuponer gemmes på din profil på vores hjemmeside, og du har mulighed for selv at printe dem (print-selv) eller sende dem videre til din e-mail. Fysiske kuponer afsendes inden for 3 hverdage med Post Danmark. OBS Post Danmark er overgået til B post og det kan derfor tage op til 10 hverdage inden du modtager kuponerne."> </span></p>
								</div>
								<div class="large-12 columns text-center">
									<fieldset class="deliveryMethod">
										<input type="radio" name='delivery_method' value="digital" id="digital" checked required><label for="digital">Digital</label>
										<input type="radio" name='delivery_method' value="mail" id="mail" ><label for="mail">Post</label>
									</fieldset>
								</div>
								<?php } ?>
								<div class="large-12 columns text-center calculatedButton">
									<input type="hidden" name="currentlink" value="<?php echo $current_link; ?>" />
									<input type="hidden" name="flexBasket" value="<?php echo $flexValue; ?>" />
									<input name="utf8" type="hidden" value="✓" />
									<input type="submit" class="button callSpin" value="NÆSTE">
									<p class="lpss text-center"><a class="backTo callSpin" href="javascript:history.back()">Tilbage</a></p>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</article>
<div class="large-12 columns">
	<?php $query = new WP_Query( array( 'page_id' => 223, 'post_status' => 'publish' , 'posts_per_page' => 1 ) ); ?>
	<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
	<div class="reveal" id="profileConfirmation" aria-labelledby="exampleModalHeader11" data-reveal>
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

<?php if(!empty($flexErrorOccurred) && $flexErrorOccurred == 1){?>
<span><a class="flexErrorRevealButton" data-open="flexErrorTruePopup">&nbsp;</a></span>
<div class="large-12 columns">
<div class="reveal text-center flexErrorReveal" id="flexErrorTruePopup" data-reveal data-close-on-click="false" data-close-on-esc="false">
  <p class="overlayHeading">Flex-pakke er allerede købt</p>
  <p class="overlayText">Du kan ikke købe den valgte flex-pakke, da du tidligere har købt den.</p>
	<p class="calculatedButton"><a class="button callSpin" href="<?php echo site_url(); ?>/purchase/">Start forfra</a></p>
</div>
</div>

<script type="text/javascript">
if(jQuery(".flexErrorRevealButton").length > 0){
	setTimeout( function(){
		jQuery('.flexErrorRevealButton').click();
	},500 );
}
</script>
<?php } ?>