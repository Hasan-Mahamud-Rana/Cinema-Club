<?php
$flexValue =  $_COOKIE['basketFlexNumber'];
$basisNumber =  $_COOKIE['basketBasisNumber'];
$premiumNumber =  $_COOKIE['basketPremiumNumber'];

if ($flexValue != NUll) {
	wp_redirect(site_url() . '/purchase/flex/');
}
$customerid = get_customerid();
$purchasableMemberships = get_purchasable_memberships($customerid);

foreach($purchasableMemberships as $purchasableMembership){
	$product_name = $purchasableMembership->product_name;
	$membershipproductid = $purchasableMembership->membershipproductid;
	if ($product_name == "Basis"){
		$basisID =  $purchasableMembership->membershipproductid;
		$product_name = $purchasableMembership->product_name;
		$basisPrice = $purchasableMembership->price;
	}
	if ($product_name == "Premium"){
		$premiumID =  $purchasableMembership->membershipproductid;
		$product_name = $purchasableMembership->product_name;
		$premiumPrice = $purchasableMembership->price;
	}
}
reset_basket();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
	<div class="purchasePackageHead">
		<div class="row">
			<header class="article-header">
				<?php the_title('<h3 class="page-title">', '</h3>'); ?>
			</header>
			<section class="entry-content" itemprop="articleBody">
				<?php the_content(); ?>
			</section>
		</div>
	</div>
	<div class="createProfile-panel">
		<div class="row">
			<div class="medium-11 medium-centered large-9 large-centered createProfile-form-panel">
				<div class="row purchaseStep small-up-1 medium-up-5 large-up-5 columns">
					<div class="column active">
						Antal
					</div>
					<div class="column si">
						Kurv
					</div>
					<div class="column sa">
						Navn & adresse
					</div>
					<div class="column sa">
						Bekræft
					</div>
					<div class="column sa">
						Betaling
					</div>
				</div>
				<form action='<?php echo site_url(); ?>/purchase/basket' method="POST">
					<div class="row column purchasePackage-form">
						<div class="large-12 text-center bptextForMobile">
							<?php the_excerpt(); ?>
						</div>
						<div class="large-12 text-center subHead">
							<p>Vælg antal Premium-medlemskaber</p>
						</div>
						<div class="large-12 text-center premiumPackageCounter">
							<div class="row  small-up-3 medium-up-3 large-up-3 columns">
								<div class="column ">
									<input class="minus" type="button" onclick="premiumDecrementValue()" value="-" />
								</div>
								<div class="column">
								  <?php if(!empty($premiumNumber)) { ?>
									<input class="amount" type="text" id="premiumNumber" value="<?php echo $premiumNumber ?>" min="0" max="99" name='premiumNumber' required/>
									<?php } else { ?>
									<input class="amount" type="text" id="premiumNumber" value="0" min="0" max="99" name='premiumNumber' required/>
									<?php } ?>
									<input type="hidden" name='premiumID' value="<?php echo $premiumID; ?>" />
									<input type="hidden" name='premiumPrice' value="<?php echo $premiumPrice; ?>" />
									<p class="hide-for-small-only">medlemskaber</p>
								</div>
								<div class="column">
									<input class="plus" type="button" onclick="premiumIncrementValue()" value="+" />
								</div>
							</div>
						</div>
						<div class="large-12 text-center">
							<a class="filmpakken" data-open="premiumFilmpakken">se film i Premium filmpakken</a>
							<hr style="width: 60%">
						</div>
						<div class="large-12 text-center bptextForMobile">
							<h4>Vil du også købe Basis-medlemskaber,<br/>inden du går til betaling, kan du gøre det her.</h4>
							<p>Basis-medlemskabet består af 7 filmkuponer, og du kan købe så mange, du vil.</p>
						</div>
						<div class="large-12 text-center subHead">
							<p>Vælg antal basis-medlemskaber</p>
						</div>
						<div class="large-12 text-center basisPackageCounter">
							<div class="row  small-up-3 medium-up-3 large-up-3 columns">
								<div class="column ">
									<input class="minus" type="button" onclick="basisDecrementValue()" value="-" />
								</div>
								<div class="column">
								<?php if(!empty($basisNumber)) { ?>
									<input class="amount" type="text" id="basisNumber" value="<?php echo $basisNumber ?>" min="0" max="99" name='basisNumber' required/>
								<?php } else { ?>
									<input class="amount" type="text" id="basisNumber" value="0" min="0" max="99" name='basisNumber' required/>
								<?php } ?>
									<input type="hidden" name='basisID' value="<?php echo $basisID; ?>" />
									<input type="hidden" name='basisPrice' value="<?php echo $basisPrice; ?>" />
									<p class="hide-for-small-only">medlemskaber</p>
								</div>
								<div class="column">
									<input class="plus" type="button" onclick="basisIncrementValue()" value="+" />
								</div>
							</div>
						</div>
						<div class="large-12 text-center">
							<a class="filmpakken" data-open="basisFilmpakken">se film i Basis filmpakken</a>
							<hr style="width: 60%">
						</div>
						<div class="large-12 columns text-center">
							 <input type="submit" class="button callSpin" value="NÆSTE">
							 <p class="lpss text-center"><a class="backTo callSpin" href="<?php echo site_url(); ?>/purchase/">Tilbage</a></p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</article>
<div class="reveal" id="basisFilmpakken" data-reveal>
	<p class="overlayHeading">Basis filmpakken</p>
	<div class="small-12 large-centered FilmpakkenPopUp">
		<?php
		$query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' , 'cat' => '-13' , 'tag' => 'basis', 'post_status' => 'publish' , 'posts_per_page' => -1 ) ); ?>
		<?php //$query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' , 'cat' => '-13', 'post_status' => 'publish' , 'posts_per_page' => -1 ) ); ?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class="movieInfoWrapper popupMovie" style="background-image: url(<?php if(get_field('trailer_placeholder')){ echo ''. get_field('trailer_placeholder') . '';}?>)">
			<?php if(false && get_field('movie_trailer')){
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
<a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?>">
	<div class="large-12 movieInfoForPopUp">
		<?php the_title('<p class="movie-title">' , '</p>'); ?>
		<?php
			$field_name_premiere = "premiere";
			$field_premiere = get_field_object($field_name_premiere);
			echo '<p class="premiere">'.$field_premiere['label'] .' '. $field_premiere['value']. '</p>';
		?>
	</div></a>
	<?php endwhile;  wp_reset_postdata(); else : ?>
	<?php _e( 'Sorry, no posts matched your criteria.' ); ?>
	<?php endif; ?>
</div>
<button class="close-button" data-close aria-label="Close modal" type="button">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="reveal" id="premiumFilmpakken" data-reveal>
<p class="overlayHeading">Premium filmpakken</p>
<div class="small-12 large-centered FilmpakkenPopUp">
	<?php
	$query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' , 'cat' => '-13' , 'tag' => 'premium', 'post_status' => 'publish' , 'posts_per_page' => -1 ) ); ?>
	<?php //$query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' , 'cat' => '-13', 'post_status' => 'publish' , 'posts_per_page' => -1 ) ); ?>
	<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
	<div class="movieInfoWrapper popupMovie" style="background-image: url(<?php if(get_field('trailer_placeholder')){ echo ''. get_field('trailer_placeholder') . '';}?>)">
		<?php if(false && get_field('movie_trailer')){
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
<a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?>">
<div class="large-12 movieInfoForPopUp">
	<?php the_title('<p class="movie-title">' , '</p>'); ?>
	<?php
		$field_name_premiere = "premiere";
		$field_premiere = get_field_object($field_name_premiere);
		echo '<p class="premiere">'.$field_premiere['label'] .' '. $field_premiere['value']. '</p>';
	?>
</div></a>
<?php endwhile;  wp_reset_postdata(); else : ?>
<?php _e( 'Sorry, no posts matched your criteria.' ); ?>
<?php endif; ?>
</div>
<button class="close-button" data-close aria-label="Close modal" type="button">
<span aria-hidden="true">&times;</span>
</button>
</div>
<script type="text/javascript">
	function basisIncrementValue()
	{
	var value = parseInt(document.getElementById('basisNumber').value, 10);
	if (value != 99){
	value = isNaN(value) ? 0 : value;
	value++;
	document.getElementById('basisNumber').value = value;
	}
	}
	function basisDecrementValue()
	{
	if (value !== 0){
	var value = parseInt(document.getElementById('basisNumber').value, 10);
	value = isNaN(value) ? 0 : value;
	value--;
	document.getElementById('basisNumber').value = value;
	}
	}
	function premiumIncrementValue()
	{
	var value = parseInt(document.getElementById('premiumNumber').value, 10);
	if (value != 99){
	value = isNaN(value) ? 0 : value;
	value++;
	document.getElementById('premiumNumber').value = value;
	}
	}
	function premiumDecrementValue()
	{
	if (value !== 0){
	var value = parseInt(document.getElementById('premiumNumber').value, 10);
	value = isNaN(value) ? 0 : value;
	value--;
	document.getElementById('premiumNumber').value = value;
	}
	}
</script>