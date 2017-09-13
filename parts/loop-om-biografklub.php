<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">
	<header class="article-header">
		<h3 class="page-title"><?php the_title(); ?></h3>
	</header>
	<section class="entry-content" itemprop="articleBody">
		<?php the_content(); ?>
		<?php
		$purchase_button_label = get_field('purchase_button_label');
		if( !empty($purchase_button_label) ):
		if ( !urlForApp() ) {
			echo $purchase_button_label;
		} ?>
		<?php endif; ?>
		<?php wp_link_pages(); ?>
	</section>
</article>