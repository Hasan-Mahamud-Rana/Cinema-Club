<?php
$customerid = get_customerid();
$userDetails = get_user_info($customerid);

if ( is_bkdk_user_logged_in() == true ) {
	$purchasable_flex_membership = $userDetails->purchasable_flex_membership;
	$active_flex_membership = $userDetails->active_flex_membership;
	if ($purchasable_flex_membership != true || $active_flex_membership == true) {
		$flexActive = "flexActive";
	}
}

$flexNumber =  $_COOKIE['basketFlexNumber'];

if (!empty($flexNumber)) {
	$basketflexNumber = 1;
} else{
	$basketflexNumber = 0;
}

$basisNumber =  $_COOKIE['basketBasisNumber'];

if ($basisNumber != 0) {
	$basketbasisNumber = 1;
} else{
	$basketbasisNumber = 0;
}

$premiumNumber =  $_COOKIE['basketPremiumNumber'];

if ($premiumNumber != 0) {
	$basketPremiumNumber = 1;
} else{
	$basketPremiumNumber = 0;
}

$customerid = get_customerid();
$purchasableMemberships = get_purchasable_memberships($customerid);

foreach($purchasableMemberships as $purchasableMembership){
	$membershipproductid = $purchasableMembership->membershipproductid;
	$membershipProductTypeName = $purchasableMembership->membership_product_type_name;

	if ((strpos($membershipProductTypeName, 'BasePackage') !== false)){
		$basis_product_name = $purchasableMembership->product_name;
		$basis_wp_movie_list_category = $purchasableMembership->wp_movie_list_category;
	}
	if ((strpos($membershipProductTypeName, 'BaseAndOptionalPackage') !== false)){
		$premium_product_name = $purchasableMembership->product_name;
		$premium_wp_movie_list_category = $purchasableMembership->wp_movie_list_category;
	}
	if ((strpos($membershipProductTypeName, 'FlexPackage') !== false)){
		$flex_membershipproductid1 = $purchasableMembership->membershipproductid;
		$flex_product_type_name1 = $purchasableMembership->membership_product_type_name;
		$flex_wp_movie_list_category1 = $purchasableMembership->wp_movie_list_category;
	}
	if ((strpos($membershipProductTypeName, 'FlexPackage') !== false)){
		if ($membershipproductid != $flex_membershipproductid1){
			$flex_wp_movie_list_category2 = $purchasableMembership->wp_movie_list_category;
		}
	}
}


?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
	<div class="purchasePanel">
		<div class="row">
			<header class="article-header">
				<h3 class="page-title"><?php the_title(); ?></h3>
			</header>
			<section class="entry-content" itemprop="articleBody">
			<?php
			if($basketflexNumber != 0){
				echo '<p>Du har Flex i kurven.<br/>Bemærk at Flex ikke kan købes sammen med Basis eller Premium, da Flex er personligt og tilknyttet dit betalingskort.</p>';
			}elseif($basketbasisNumber != 0 && $basketPremiumNumber != 1){
				echo '<p>Du har ' . $basisNumber . ' Basis i kurven.<br/>Bemærk at Basis ikke kan købes sammen med Flex, da Flex er personligt og tilknyttet dit betalingskort.</p>';
			}elseif($basketPremiumNumber != 0 && $basketbasisNumber != 1){
				echo '<p>Du har ' . $premiumNumber . ' Premium i kurven.<br/>Bemærk at Premium ikke kan købes sammen med Flex, da Flex er personligt og tilknyttet dit betalingskort.</p>';
			}elseif($basketbasisNumber != 0 && $basketPremiumNumber != 0){
				echo '<p>Du har ' . $basisNumber . ' Basis og ' . $premiumNumber . ' Premium i kurven.<br/>Bemærk at Basis og Premium ikke kan købes sammen med Flex, da Flex er personligt og tilknyttet dit betalingskort.</p>';
			}else{
				the_content();
			}
			?>
			</section>
		</div>
		<div class="row movie-packages small-up-1 medium-up-3 large-up-3">
			<?php $query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'package' , 'post_status' => 'publish' , 'posts_per_page' => -1 ) ); ?>
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
			<div class="column <?php the_title(); echo '_'. $basketflexNumber . $basketbasisNumber . $basketPremiumNumber. ' ';the_title(); echo ' '.$flexActive; ?>" >
				<div>
					<div class="moviePackagesData">
						<h3><?php the_title(); ?></h3>
						<div class="priceAmount">
							<?php
										$price = get_field('price');
										if( !empty($price) ):
										if ( urlForApp() ) {
							?> <?php # Add btn which opens coupons inside App...
							}
							else {
							?>
							<h1><?php echo $price; ?> kr.</h1>
							<?php } ?>
							<?php endif; ?>
							<?php
										$movieAmount = get_field('movie_amount');
										if ( !empty($movieAmount) ):
										if ( urlForApp() ) {
							?> <?php # Add btn which opens coupons inside App...
							}
							else {
							?>
							<h4><?php echo $movieAmount; ?> FILM</h4>
							<?php } ?>
							<?php endif; ?>
						</div>
						<div class="purchaseButton">
						<?php
						$package_link = get_field('package_link');
						if(!empty($package_link)){
						echo '<p><a class="button callSpin" href="' . $package_link . '">Vælg <?php the_title(); ?></a></p>';
						}
						?>
					</div>
						<?php the_content(); ?>
					</div>
					<?php
						$movie_list = get_field('movie_list');
						if( !empty($movie_list) ):
						if ( urlForApp() ) {
					?> <?php # Add btn which opens coupons inside App...
					}
					else {
					?>
					<p>
					<a class="filmPackage" data-open="<?php echo $movie_list; ?>">Se filmene i denne filmpakke</a></p>
					<?php } ?>
					<?php endif; ?>
				</div>
				<div class="<?php echo $flexActive; ?>">
				</div>
			</div>
			<?php endwhile;  wp_reset_postdata(); else : ?>
			<?php _e( 'Sorry, no posts matched your criteria.' ); ?>
			<?php endif; ?>
		</div>
	</div>
</article>

<div class="reveal" id="<?php echo $flex_product_type_name1 ?>" data-reveal>
	<p class="overlayHeading">Flex</p>
	<div class="small-12 large-centered FilmpakkenPopUp">
		<?php
		$categoryName1 = $flex_wp_movie_list_category1;
		//$categoryName2 = $flex_wp_movie_list_category2;
		$query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' , 'cat' => '-13' , 'category_name' => $categoryName1 . ', ' . $categoryName2, 'post_status' => 'publish' , 'posts_per_page' => -1 ) ); ?>
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

<div class="reveal" id="<?php echo $basis_wp_movie_list_category ?>" data-reveal>
	<p class="overlayHeading"><?php echo $basis_product_name ?></p>
	<div class="small-12 large-centered FilmpakkenPopUp">
		<?php
		$categoryName = $basis_wp_movie_list_category;;
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

<div class="reveal" id="<?php echo $premium_wp_movie_list_category ?>" data-reveal>
	<p class="overlayHeading"><?php echo $premium_product_name ?></p>
	<div class="small-12 large-centered FilmpakkenPopUp">
		<?php
		$categoryName = $premium_wp_movie_list_category;;
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