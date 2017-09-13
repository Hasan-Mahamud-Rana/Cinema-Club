<?php
/*
Template Name: Tag Flex 2
*/
?>

<?php get_header(); ?>
	<div id="content" <?php body_class(); ?>>
		<div id="inner-content" class="row movieIntro">
		    <main id="main" class="small-12 medium-12 large-12" role="main">
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
	<section class="entry-content" itemprop="articleBody">
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
		<h1>Flex 2</h1>
	</section>
</article>
<div class="small-12 medium-12 large-12">
	<?php
	$query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' , 'post_status' => 'publish' ,'tag'=>'flex-2', 'cat' => '-13' , 'posts_per_page' => -1 ) ); ?>
	<?php //$query = new WP_Query( array( 'order' => 'dsc' , 'post_type' => 'movie' , 'cat' => '-13', 'post_status' => 'publish' , 'posts_per_page' => -1 ) ); ?>
	<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
		<div class="movieInfoWrapper" style="background-image: url(<?php if(get_field('trailer_placeholder')){ echo ''. get_field('trailer_placeholder') . '';}?>)">
			<div class="movieInfoForWeb">
<span class="movieTag">
<?php $post_tags = get_the_tags();
if ( $post_tags ) {
  foreach( $post_tags as $tag ) {
		$tagName = $tag->name;
		$tagSlug = $tag->slug;
		if($tagName === "Premium"){
			echo '<a class="t_'. $tagName .'" href="' . site_url() . '/tag/'. $tagSlug .'/" rel="tag">'. $tagName .'</a> ';
		}
  }
  foreach( $post_tags as $tag ) {
		$tagName = $tag->name;
		$tagSlug = $tag->slug;
		if($tagName === "Basis"){
			echo '<a class="t_'. $tagName .'" href="' . site_url() . '/tag/'. $tagSlug .'/" rel="tag">'. $tagName .'</a> ';
		}
  }
  foreach( $post_tags as $tag ) {
		$tagName = $tag->name;
		$tagSlug = $tag->slug;
		if(($tagName != "Premium") && ($tagName != "Basis")){
			echo '<a class="t_'. $tagName .'" href="' . site_url() . '/tag/'. $tagSlug .'/" rel="tag">'. $tagName .'</a> ';
		}
  }
}
?>
</span><br/>

				<span class="movie-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></span><br/>
				<?php
					$field_name_premiere = "premiere";
					$field_premiere = get_field_object($field_name_premiere);
					echo '<span class="premiereDate">'.$field_premiere['label'] .' '. $field_premiere['value']. '</span>';
				?>
			</div>
			<a class="trickyLink" href="<?php the_permalink() ?>" rel="bookmark" title="Læs mere om <?php the_title_attribute(); ?>"></a>

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


<a href="<?php the_permalink() ?>" rel="bookmark" title="Læs mere om <?php the_title_attribute(); ?>">
<div class="large-12 movieInfoForApp">
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
			</main> <!-- end #main -->
		</div> <!-- end #inner-content -->
	</div> <!-- end #content -->

<?php //get_template_part( 'parts/slider', 'featured-movies' ); ?>
<?php get_footer(); ?>
