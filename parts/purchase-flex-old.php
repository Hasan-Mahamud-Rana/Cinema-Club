<?php
$basisNumber =  $_COOKIE['basketBasisNumber'];
$premiumNumber =  $_COOKIE['basketPremiumNumber'];
if ($basisNumber != 0 || $premiumNumber != 0) {
	wp_redirect(site_url() . '/purchase/flex/');
}

$customerid = get_customerid();
$purchasableMemberships = get_purchasable_memberships($customerid);

foreach($purchasableMemberships as $purchasableMembership){
	$membershipproductid = $purchasableMembership->membershipproductid;
	$membershipProductTypeName = $purchasableMembership->membership_product_type_name;
if ((strpos($membershipProductTypeName, 'FlexPackage') !== false) && $purchasableMembership == 1){
		$flexID1 =  $purchasableMembership->membershipproductid;
		$startdate1 = $purchasableMembership->startdate;
		$product_name1 = $purchasableMembership->product_name;
		$price1 = $purchasableMembership->price;
		$wp_movie_list_category1 = $purchasableMembership->wp_movie_list_category;
		$date1=date_create($startdate1);
	}
if ((strpos($membershipProductTypeName, 'FlexPackage') !== false) && $purchasableMembership == 2){
	if ($membershipproductid != $flexID1 && $membershipproductid != $flexID3){
		$flexID2 =  $purchasableMembership->membershipproductid;
		$startdate2 = $purchasableMembership->startdate;
		$product_name2 = $purchasableMembership->product_name;
		$price2 = $purchasableMembership->price;
		$wp_movie_list_category2 = $purchasableMembership->wp_movie_list_category;
		$date2=date_create($startdate2);
		}
	}
if ((strpos($membershipProductTypeName, 'FlexPackage') !== false) && $purchasableMembership == 3){
	if ($membershipproductid != $flexID1 && $membershipproductid != $flexID2){
		$flexID3 =  $purchasableMembership->membershipproductid;
		$startdate3 = $purchasableMembership->startdate;
		$product_name3 = $purchasableMembership->product_name;
		$price3 = $purchasableMembership->price;
		$wp_movie_list_category3 = $purchasableMembership->wp_movie_list_category;
		$date2=date_create($startdate3);
		}
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
				<?php the_excerpt(); ?>
			</section>
		</div>
	</div>
	<div class="createProfile-panel">
		<div class="row">
			<div class="medium-11 medium-centered large-9 large-centered createProfile-form-panel">
				<div class="row purchaseStep small-up-1 medium-up-5 large-up-5 columns">
					<div class="column active">
						MEDLEMSKAB
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
						<div class="large-12 text-center">
							<p>Hvornår vil du starte med at se film?</p>
						</div>
						<?php if (!empty($flexID1)) { ?>
						<div class="large-12 text-center ">
							<div class="row">
								<div class="small-12 medium-10 medium-centered large-8 large-centered columns">
									<div class="large-12 flexChoose columns">
										<?php //echo '<p class="flexDate1">'. date_format($date1, "D d. F Y") . '</p>' ;?>
										<input class="amount" type="radio" id="<?php echo $product_name1; ?>" value="<?php echo $product_name1; ?>" name='flexNumber' required/><label for="<?php echo $product_name1; ?>"><?php echo '<h4>' . $product_name1 . '</h4>'?></label>
										<p><a class="filmpakken" data-open="flex1">se film i filmpakken</a></p>
										<input type="hidden" name='flexID1' value="<?php echo $flexID1; ?>">
										<input type="hidden" name='price1' value="<?php echo $price1; ?>">
									</div>
								</div>
							</div>
						</div>
						<?php if (!empty($flexID2)) { ?>
							<div class="large-12 text-center">
								<h5 class="or">ELLER</h5>
							</div>
						<?php } 
						 } ?>
						<?php if (!empty($flexID2)) { ?>
						<div class="large-12 text-center ">
							<div class="row">
								<div class="small-12 medium-10 medium-centered large-8 large-centered columns">
									<div class="large-12 flexChoose columns">
										<?php //echo '<p class="flexDate2">'. date_format($date2, "D d. F Y") . '</p>' ;?>
										<input class="amount" type="radio" id="<?php echo $product_name2; ?>" value="<?php echo $product_name2; ?>" name='flexNumber'/><label for="<?php echo $product_name2; ?>"><?php echo '<h4>' . $product_name2 . '</h4>'?></label>
										<p><a class="filmpakken" data-open="flex2">se film i filmpakken</a></p>
										<input type="hidden" name='flexID2' value="<?php echo $flexID2; ?>">
										<input type="hidden" name='price2' value="<?php echo $price2; ?>">
									</div>
								</div>
							</div>
						</div>
						<?php if (!empty($flexID3)) { ?>
						<div class="large-12 text-center">
							<h5 class="or">ELLER</h5>
						</div>
						<?php } 
						} ?>
						<?php if (!empty($flexID3)) { ?>
						<div class="large-12 text-center ">
							<div class="row">
								<div class="small-12 medium-10 medium-centered large-8 large-centered columns">
									<div class="large-12 flexChoose columns">
										<?php //echo '<p class="flexDate2">'. date_format($date2, "D d. F Y") . '</p>' ;?>
										<input class="amount" type="radio" id="<?php echo $product_name3; ?>" value="<?php echo $product_name3; ?>" name='flexNumber'/><label for="<?php echo $product_name3; ?>"><?php echo '<h4>' . $product_name3 . '</h4>'?></label>
										<p><a class="filmpakken" data-open="flex3">se film i filmpakken</a></p>
										<input type="hidden" name='flexID3' value="<?php echo $flexID3; ?>">
										<input type="hidden" name='price3' value="<?php echo $price3; ?>">
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						<div class="large-12 columns text-center calculatedButton">
							<input type="submit" class="button callSpin" value="NÆSTE">
							<p class="lpss text-center"><a class="backTo callSpin" href="<?php echo site_url(); ?>/purchase/">Tilbage</a></p>
						</div>
					</div>
				</form>
				<div class="row">
					<div class="large-12 columns text-left flexPage">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
<div class="reveal" id="flex1" data-reveal>
	<p class="overlayHeading"><?php echo $product_name1; ?></p>
	<div class="small-12 large-centered FilmpakkenPopUp">
		<?php
		$categoryName = $wp_movie_list_category1;
		$query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' , 'cat' => '-13' , 'category_name' => $categoryName, 'post_status' => 'publish' , 'posts_per_page' => -1 ) ); ?>
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

<div class="reveal" id="flex2" data-reveal>
<p class="overlayHeading"><?php echo $product_name2; ?></p>
<div class="small-12 large-centered FilmpakkenPopUp">
	<?php
	$categoryName = $wp_movie_list_category2;
	$query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' , 'cat' => '-13' , 'category_name' => $categoryName, 'post_status' => 'publish' , 'posts_per_page' => -1 ) ); ?>
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


<div class="reveal" id="flex3" data-reveal>
<p class="overlayHeading"><?php echo $product_name2; ?></p>
<div class="small-12 large-centered FilmpakkenPopUp">
	<?php
	$categoryName = $wp_movie_list_category2;
	$query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' , 'cat' => '-13' , 'category_name' => $categoryName, 'post_status' => 'publish' , 'posts_per_page' => -1 ) ); ?>
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
jQuery("input#Flex1:radio").on("change",  function() {
	jQuery(this).parent().addClass("checked");
	jQuery("input#Flex2").parent().removeClass("checked");
});
jQuery("input#Flex2").on("change",  function() {
	jQuery(this).parent().addClass("checked");
	jQuery("input#Flex1:radio").parent().removeClass("checked");
});
</script>