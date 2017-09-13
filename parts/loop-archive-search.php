<div class="small-12">
	<header class="article-header-result rana">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	</header>
	<section class="entry-content resultArticle" itemprop="articleBody">
		<?php
		$excerpt= get_the_excerpt();
		echo substr($excerpt, 0, 300)."..."; ?>
		<a href="<?php the_permalink() ?>">Læs mere</a>
	</section>
</div>