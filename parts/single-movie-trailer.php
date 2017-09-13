<div class="singleMovieTrailer">
	<div class="small-12 medium-12 large-12">
		<div class="movieInfoWrapper" style="background-image: url(<?php if(get_field('trailer_placeholder')){ echo ''. get_field('trailer_placeholder') . '';}?>)">
			<?php if(get_field('movie_trailer')){
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
	<div class="large-12 movieInfoForApp">
		<?php the_title('<p class="movie-title">' , '</p>'); ?>
		<?php
			$field_name_premiere = "premiere";
			$field_premiere = get_field_object($field_name_premiere);
			echo '<p class="premiere">'.$field_premiere['label'] .' '. $field_premiere['value']. '</p>';
		?>
	</div>
</div>
</div>