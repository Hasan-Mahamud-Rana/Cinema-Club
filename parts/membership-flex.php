<?php
if ( is_bkdk_user_logged_in() != true ) {
	wp_redirect(site_url().'/login/');
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST))
{
	$membershiporderlineid =  $_POST['membershiporderlineid'];
}
$customerid = get_customerid();
$singleMembership = get_single_membership($customerid, $membershiporderlineid);
//var_dump($singleMembership);
$wp_movie_list_category_next = $singleMembership->wp_movie_list_category_next;
//echo $wp_movie_list_category_next;
//$subscription_status = $singleMembership->subscription_status;
$product_name = $singleMembership->product_name;
$next_purchase_product_name = $singleMembership->next_purchase_product_name;
//echo 'subscription_status: '. $subscription_status;
//if ( $subscription_status != active || $subscription_status != skipped || $subscription_status == NULL || $subscription_status == ' ' ){
	//wp_redirect(site_url().'/movies');
	//echo 'Status: '. $subscription_status;
//}
$nextPurchaseDate = $singleMembership->next_purchase_date;
$nextPurchaseDate = date_create($nextPurchaseDate);
$releaseDate = new DateTime(date_format($nextPurchaseDate, "d. F Y") );
$skipDate = new DateTime(date_format($nextPurchaseDate, "d. F Y") );
$skipDate->sub(new DateInterval('P14D'));
$findReplace = findReplace();
$findDate = $findReplace[0];
$replaceDate = $findReplace[1];
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
	<div class="flexPanel">
		<div class="row">
			<div class="small-12 medium-8 medium-centered large-8 large-centered flexPanel-panel columns">
				<div class="row flex-movie-slider" >
					<h3>Dit Flex-medlemskab</h3>
					<div class="large-12 text-center">
						<div class="tricky flexMovie" style="display: none;">
							<?php $query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' ,'category_name' => $wp_movie_list_category_next, 'cat' => '-13', 'post_status' => 'publish' , 'posts_per_page' => -1 ) ); ?>
							<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
							<a class="medium-12 large-12" href="<?php the_permalink() ?>" rel="bookmark" title="Link to <?php the_title_attribute(); ?>" style="height:213px; background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)">&nbsp;</a>
							<?php endwhile;  wp_reset_postdata(); else : ?>
							<?php _e( '</div><div class="small-12 movieNotDeclared">&nbsp;</div><div class="small-12 text-center"><h4>Film på vej</h4></div><div>' ); ?>							<?php endif; ?>
						</div>
					</div>
				</div>
				<section class="entry-content" itemprop="articleBody">
					<?php
							if (!empty($product_name)){
								echo "<h3>" . $product_name . "</h3>";
							} else {
								the_title('<h3>', '</h3>');
							}
							the_content();
						echo '<p class="dkDate">Den næste filmpakke (' . $next_purchase_product_name . ') kommer d. '. str_replace( $findDate, $replaceDate, $releaseDate->format("d. F Y")) . '. Hvis du ønsker at springe næste filmpakke over, skal du gøre det senest d. '. str_replace( $findDate, $replaceDate, $skipDate->format("d. F Y")) . '.</p>';
							echo	'<p class="lgindbtn text-center ovrLayBtn"><a class="button" data-open="skipConfirmation">SPRING FILMPAKKE OVER</a></p>';
						echo '<p><strong>Opsig medlemskab</strong></p>';
						echo '<p>Vil du stoppe med at se udvalgte kvalitetsfilm til halv pris?</p>';
								echo	'<p class="lgindbtn text-center ovrLayBtn"><a class="secondary button" data-open="cancelConfirmation">OPSIG MEDLEMSKAB</a></p>';
						echo '<p class="lpss text-center callSpin"><a href="'.site_url().'">Fortryd og gå til forside</a></p><br>';
					?>
				</section>
			</div>
		</div>
	</div>
</article>
<div class="large-12 columns">
	<div class="reveal" id="cancelConfirmation" data-reveal>
		<p class="overlayHeading">Er du sikker på, du vil opsige dit Flex-medlemskab?</p>
		<p class="overlayText">Hvis du ikke længere ønsker at se udvalgte kvalitetsfilm til halv pris, få invitationer til forpremierer og andre gode fordele, kan du opsige dit medlemskab her.</p>
		<p class="text-center ovrLayBtn"><input type="button" class="button" data-close aria-label="Close modal" value="NEJ, OPSIG IKKE"></p>
		<form action="<?php echo site_url() ?>/my-membership/flex-cancel" method="POST">
			<input type="hidden" name="membershiporderlineid" value="<?php echo $membershiporderlineid ?>" />
			<input type="hidden" name="wp_movie_list_category" value="<?php echo $wp_movie_list_category_next ?>" />
			<p class="text-center ovrLayBtn"><input type="submit" class="secondary button" value="JA, OPSIG MEDLEMSKAB"></p>
		</form>
		<button class="close-button" data-close aria-label="Close modal" type="button">
		<span aria-hidden="true">&times;</span>
		</button>
	</div>
</div>
<div class="large-12 columns">
	<div class="reveal" id="skipConfirmation" data-reveal>
		<p class="overlayHeading">Er du sikker?</p>
		<p class="overlayText">Hvis du springer den næste filmpakke over, går du glip af udvalgte kvalitetsfilm til halv pris.</p>
		<p class="text-center ovrLayBtn"><input type="button" class="button" data-close aria-label="Close modal" value="NEJ, SPRING IKKE OVER"></p>
		<form action="<?php echo site_url() ?>/my-membership/flex-skip" method="POST">
			<input type="hidden" name="membershiporderlineid" value="<?php echo $membershiporderlineid ?>" />
			<input type="hidden" name="wp_movie_list_category" value="<?php echo $wp_movie_list_category_next ?>" />
			<p class="text-center ovrLayBtn"><input type="submit" class="secondary button" value="JA, SPRING OVER"></p>
		</form>
		<button class="close-button" data-close aria-label="Close modal" type="button">
		<span aria-hidden="true">&times;</span>
		</button>
	</div>
</div>