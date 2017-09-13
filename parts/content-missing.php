<div id="post-not-found" class="hentry">
	<?php if ( is_search() ) : ?>
	<header class="article-header">
		<h1><?php _e( 'Beklager, ingen resultater.', 'jointswp' );?></h1>
	</header>
	<section class="entry-content">
		<p><?php _e( 'Prøv at søge igen.', 'jointswp' );?></p>
	</section>
	<!-- end search section -->
	<?php else: ?>
	<header class="article-header">
		<h1><?php _e( 'Ups Post ikke fundet!', 'jointswp' ); ?></h1>
	</header>
	<section class="entry-content">
		<p><?php _e( 'Åh åh. Noget mangler. Prøv dobbeltkontrol ting.', 'jointswp' ); ?></p>
	</section>
	<?php endif; ?>
</div>