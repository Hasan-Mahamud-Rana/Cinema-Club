<div class="singleMovieTrailer">
<div class="small-12 medium-12 large-12">
  <div class="movieInfoWrapper" style="background-image: url(<?php if(get_field('trailer_placeholder')){ echo ''. get_field('trailer_placeholder') . '';}?>)">
    <div class="large-4 movieInfoForWeb"> <span class="movieTag">
      <?php the_tags(' ', ', ', ' ' ); ?>
      </span><br/>
      <span class="movie-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?>">
      <?php the_title(); ?>
      </a></span><br/>
      <?php
							$field_name_premiere = "premiere";
							$field_premiere = get_field_object($field_name_premiere);
							echo '<span class="premiereDate">'.$field_premiere['label'] .' '. $field_premiere['value']. '</span>';
						?>
    </div>
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
  <div class="large-12 movieInfoForApp"> <span><a href="<?php the_permalink() ?>" rel="bookmark" title="Go to <?php the_title_attribute(); ?>">
    <?php the_title(); ?>
    </a></span><br/>
    <?php
			$field_name_premiere = "premiere";
			$field_premiere = get_field_object($field_name_premiere);
			echo '<span>'.$field_premiere['label'] .' '. $field_premiere['value']. '</span>';
		?>
  </div>
</div>
</div>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
  <header class="article-header">
    <h1 class="entry-title single-title" itemprop="headline">
      <?php the_title(); ?>
    </h1>
  </header>
  <!-- end article header -->
  <section class="entry-content" itemprop="articleBody">
    <?php the_post_thumbnail('full'); ?>
    <?php the_content(); ?>
  </section>
  <!-- end article section -->
</article>
<!-- end article -->
